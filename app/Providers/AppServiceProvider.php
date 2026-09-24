<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            \Stephenjude\FilamentTwoFactorAuthentication\Pages\Challenge::class,
            \App\Filament\Pages\Auth\CustomTwoFactorChallenge::class
        );

        $this->app->singleton(
            \App\Contracts\Chat\ChatAIServiceInterface::class,
            \App\Services\Chat\AI\ChatAIManager::class
        );
    }

    public function boot(): void
    {
        require_once app_path('helpers.php');

        // SEC-011: Route-level rate limiting for Livewire update endpoint
        RateLimiter::for('livewire-update', function (Request $request) {
            return $request->user()
                ? Limit::perMinute(120)->by('user:'.$request->user()->id)
                : Limit::perMinute(60)->by('ip:'.$request->ip());
        });

        // CHAT-03: Rate limiting for visitor chat session initialization
        RateLimiter::for('chat-session-init', function (Request $request) {
            $limit = (int) config('chat.session_init_rate_limit', 10);
            return Limit::perMinute($limit)->by('ip:'.$request->ip());
        });

        // CHAT-04: Rate limiting for visitor message sending (binds to visitor/session identity)
        RateLimiter::for('chat-message-send', function (Request $request) {
            $limit = (int) config('chat.message_send_rate_limit', 30);
            $visitor = $request->attributes->get('chat_visitor');
            if ($visitor?->visitor_uuid) {
                $key = 'visitor:'.$visitor->visitor_uuid;
            } else {
                $cookie = $request->cookie(config('chat.cookie_name', 'chat_visitor_token'));
                $key = $cookie ? 'token:'.hash('sha256', $cookie) : 'ip:'.$request->ip();
            }

            return Limit::perMinute($limit)->by($key);
        });

        // CHAT-07: Rate limiting for chat attachment uploads (binds to visitor/session identity or authenticated user)
        RateLimiter::for('chat-attachment-upload', function (Request $request) {
            $limit = (int) config('chat.attachment_upload_rate_limit', 20);
            if ($request->user()) {
                return Limit::perMinute($limit)->by('user:'.$request->user()->id);
            }

            $visitor = $request->attributes->get('chat_visitor');
            if ($visitor?->visitor_uuid) {
                $key = 'visitor:'.$visitor->visitor_uuid;
            } else {
                $cookie = $request->cookie(config('chat.cookie_name', 'chat_visitor_token'));
                $key = $cookie ? 'token:'.hash('sha256', $cookie) : 'ip:'.$request->ip();
            }

            return Limit::perMinute($limit)->by($key);
        });

        \Livewire\Livewire::setUpdateRoute(function ($handle) {
            return Route::post('/livewire/update', $handle)
                ->middleware(['web', 'throttle:livewire-update']);
        });

        \Livewire\Livewire::component(
            'filament-two-factor-authentication::pages.challenge',
            \App\Filament\Pages\Auth\CustomTwoFactorChallenge::class
        );

        Paginator::useTailwind();

        if (app()->environment('production')) {
            URL::forceScheme('https');
        }

        \Filament\Forms\Components\Field::configureUsing(function (\Filament\Forms\Components\Field $field) {
            if (method_exists($field, 'extraInputAttributes')) {
                $field->extraInputAttributes(function () use ($field) {
                    if ($field->isRequired()) {
                        $label = mb_strtolower($field->getLabel() ?? 'thông tin này', 'UTF-8');
                        $prefix = in_array(get_class($field), [\Filament\Forms\Components\Select::class, \Filament\Forms\Components\Radio::class, \Filament\Forms\Components\CheckboxList::class]) ? 'chọn' : 'nhập';
                        return [
                            'oninvalid' => "this.setCustomValidity('Vui lòng {$prefix} {$label}')",
                            'oninput' => "this.setCustomValidity('')",
                        ];
                    }
                    return [];
                });
            }
        });

        // Single-use recovery code enforcement: consume used recovery code immediately
        \Illuminate\Support\Facades\Event::listen(
            \Stephenjude\FilamentTwoFactorAuthentication\Events\ValidTwoFactorRecoveryCodeProvided::class,
            function (\Stephenjude\FilamentTwoFactorAuthentication\Events\ValidTwoFactorRecoveryCodeProvided $event) {
                $req = request();
                $submittedCode = null;

                $components = $req->json('components', []);
                foreach ($components as $component) {
                    $snapshot = json_decode($component['snapshot'] ?? '{}', true);
                    if (! empty($snapshot['data']['data']['recovery_code'])) {
                        $submittedCode = $snapshot['data']['data']['recovery_code'];
                        break;
                    }
                    if (! empty($component['updates']['data.recovery_code'])) {
                        $submittedCode = $component['updates']['data.recovery_code'];
                        break;
                    }
                }

                if (! $submittedCode && $req->has('data.recovery_code')) {
                    $submittedCode = $req->input('data.recovery_code');
                }

                if ($submittedCode && $event->user && method_exists($event->user, 'recoveryCodes')) {
                    $validCodes = $event->user->recoveryCodes();
                    foreach ($validCodes as $code) {
                        if (hash_equals((string) $code, (string) $submittedCode)) {
                            $event->user->replaceRecoveryCode($code);
                            break;
                        }
                    }
                }
            }
        );

        // CHAT-10: Automation Engine Event Listeners
        \Illuminate\Support\Facades\Event::listen(
            \App\Events\Chat\ChatMessageCreated::class,
            [\App\Listeners\Chat\HandleChatAutomation::class, 'handle']
        );
        \Illuminate\Support\Facades\Event::listen(
            \App\Events\Chat\ChatConversationUpdated::class,
            [\App\Listeners\Chat\HandleChatAutomation::class, 'handle']
        );

        // CHAT-12: AI Chat Orchestration Event Listener
        \Illuminate\Support\Facades\Event::listen(
            \App\Events\Chat\ChatMessageCreated::class,
            [\App\Listeners\Chat\HandleAIChatOrchestration::class, 'handle']
        );
    }
}