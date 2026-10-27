<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
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

        // Ensure critical upload and livewire storage directories exist on production
        foreach ([
            storage_path('app/private/livewire-tmp'),
            storage_path('app/public/uploads/' . date('Y')),
            storage_path('app/public/uploads/' . date('Y/m')),
            storage_path('app/public/partners'),
            storage_path('app/public/clients'),
            storage_path('app/public/projects'),
        ] as $storageDir) {
            if (!file_exists($storageDir)) {
                @mkdir($storageDir, 0775, true);
            }
        }

        // Tự động chuẩn hóa tên hiển thị cho tài khoản admin nếu trong DB đang lưu email
        try {
            if (\Illuminate\Support\Facades\Schema::hasTable('users')) {
                \Illuminate\Support\Facades\DB::table('users')
                    ->where('email', 'admin@truyenthongcuulong.com')
                    ->where('name', 'admin@truyenthongcuulong.com')
                    ->update(['name' => 'Quản trị viên']);
            }
        } catch (\Throwable $e) {
            // Safe fallback during installation or migrations
        }

        // Tự động đồng bộ và giữ đúng 8 dự án website phía client vào CSDL case_studies
        try {
            if (\Illuminate\Support\Facades\Schema::hasTable('case_studies')) {
                if (!\Illuminate\Support\Facades\Schema::hasColumn('case_studies', 'views')) {
                    \Illuminate\Support\Facades\Schema::table('case_studies', function (\Illuminate\Database\Schema\Blueprint $table) {
                        $table->unsignedBigInteger('views')->default(0)->after('order');
                    });
                }
                if (!\Illuminate\Support\Facades\Schema::hasColumn('case_studies', 'status')) {
                    \Illuminate\Support\Facades\Schema::table('case_studies', function (\Illuminate\Database\Schema\Blueprint $table) {
                        $table->string('status', 30)->default('active')->after('order');
                    });
                }

                $allowedSlugs = [
                    'website-tui-la-nguoi-mien-tay',
                    'website-cuu-long-camping',
                    'website-phong-kham-can-tho',
                    'website-da-khoa-can-tho',
                    'website-phong-kham-da-khoa-gia-phuoc',
                    'website-da-khoa-gia-phuoc',
                    'website-giat-ui-cong-nghiep-365',
                    'website-tieu-dao-tu',
                ];

                $hasExtra = \Illuminate\Support\Facades\DB::table('case_studies')->whereNotIn('slug', $allowedSlugs)->exists();
                $count = \Illuminate\Support\Facades\DB::table('case_studies')->count();

                if ($hasExtra || $count < 8) {
                    \Illuminate\Support\Facades\DB::table('case_studies')->whereNotIn('slug', $allowedSlugs)->delete();
                    (new \Database\Seeders\CaseStudySeeder())->run();
                    \Illuminate\Support\Facades\Cache::forget('casestudy_counts');
                    \Illuminate\Support\Facades\Cache::forget('home_page_data');
                }
            }
        } catch (\Throwable $e) {
            // Safe fallback during installation or migrations
        }

        // Đảm bảo phân quyền chuẩn: Super Admin & Admin full quyền; Biên Tập Viên đúng vai trò
        try {
            if (\Illuminate\Support\Facades\Schema::hasTable('roles') && \Illuminate\Support\Facades\Schema::hasTable('permissions')) {
                \Illuminate\Support\Facades\Cache::remember('roles_permissions_synced_v3', 86400, function () {
                    app(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();

                    $superAdminRole = \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'super_admin', 'guard_name' => 'web']);
                    $adminRole = \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'Admin', 'guard_name' => 'web']);
                    $editorRole = \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'Biên Tập Viên', 'guard_name' => 'web']);

                    // 1. Super Admin & Admin: FULL QUYỀN (tất cả permissions trong hệ thống)
                    $allPermissions = \Spatie\Permission\Models\Permission::all();
                    $superAdminRole->syncPermissions($allPermissions);
                    $adminRole->syncPermissions($allPermissions);

                    // 2. Biên Tập Viên: Toàn quyền Bài viết, Chuyên mục, Dự án tiêu biểu, Dịch vụ, Khách hàng, Bảng giá, Tài nguyên, Thư viện Media
                    // TUYỆT ĐỐI KHÔNG có quyền Quản lý tài khoản (user), Phân quyền (role), Cài đặt hệ thống, Schema SEO, Menu, Redirect SEO, Spam, Chat AI settings
                    $editorPerms = \Spatie\Permission\Models\Permission::where(function ($q) {
                        $q->where('name', 'like', '%_post')
                            ->orWhere('name', 'like', '%_category')
                            ->orWhere('name', 'like', '%_case::study')
                            ->orWhere('name', 'like', '%_client')
                            ->orWhere('name', 'like', '%_pricing::plan')
                            ->orWhere('name', 'like', '%_service')
                            ->orWhere('name', 'like', '%_resource::post')
                            ->orWhereIn('name', [
                                'page_MediaLibrary',
                                'widget_DashboardOverview',
                                'widget_MediaStatsWidget',
                                'widget_QuickActionsWidget',
                                'widget_SeoHealthWidget',
                                'view_any_contact',
                                'view_contact',
                                'view_any_job::application',
                                'view_job::application',
                            ]);
                    })->where(function ($q) {
                        $q->where('name', 'not like', '%_user')
                            ->where('name', 'not like', '%_role')
                            ->where('name', 'not like', '%_menu%')
                            ->where('name', 'not like', '%_redirect%')
                            ->where('name', 'not like', '%_partner%')
                            ->whereNotIn('name', [
                                'page_GeneralSettings',
                                'page_SchemaSettings',
                                'page_ChatAutomationSettings',
                                'page_ChatAISettings',
                                'page_ChatSpamPage',
                            ]);
                    })->get();

                    $editorRole->syncPermissions($editorPerms);

                    // 3. Chuẩn hóa tài khoản người dùng:
                    // Minh Thành: Giữ vai trò Biên Tập Viên (gỡ Admin để áp dụng đúng phân quyền giới hạn của Biên tập viên)
                    $editorUser = \App\Models\User::where('email', 'Caothanhtctva@gmail.com')->first();
                    if ($editorUser) {
                        $editorUser->syncRoles([$editorRole]);
                    }

                    // Minh (nếu chưa có vai trò): Cấp vai trò Biên Tập Viên
                    $userMinh = \App\Models\User::where('email', 'minhminh3898@gmail.com')->first();
                    if ($userMinh && $userMinh->roles()->count() === 0) {
                        $userMinh->syncRoles([$editorRole]);
                    }

                    // Root Admin & Cửu Long Team: Đảm bảo có quyền Admin & super_admin
                    $rootAdmin = \App\Models\User::where('email', 'admin@truyenthongcuulong.com')->first();
                    if ($rootAdmin) {
                        $rootAdmin->syncRoles([$superAdminRole, $adminRole]);
                    }

                    $cuuLongTeam = \App\Models\User::where('email', 'phucnguyen@truyenthongcuulong.com')->first();
                    if ($cuuLongTeam) {
                        $cuuLongTeam->syncRoles([$superAdminRole, $adminRole]);
                    }

                    app(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();

                    return true;
                });
            }
        } catch (\Throwable $e) {
            // Safe fallback during installation or migrations
        }

        // Super-admin / Root admin full permission bypass with critical security guards
        Gate::before(function ($user, $ability, $arguments = []) {
            // 1. Kiểm tra an toàn bảo vệ vai trò (Role Protection)
            if (in_array($ability, ['delete', 'delete_role'], true)) {
                $targetRole = $arguments[0] ?? null;
                if ($targetRole instanceof \Spatie\Permission\Models\Role) {
                    $check = \App\Services\RolePermissionSecurityService::checkCanDeleteRole($user, $targetRole);
                    if (! $check['allowed']) {
                        return false;
                    }
                }
            }

            // 2. Kiểm tra an toàn bảo vệ người dùng (Super Admin / Self-delete Protection)
            if (in_array($ability, ['delete', 'forceDelete', 'delete_user', 'force_delete_user'], true)) {
                $targetUser = $arguments[0] ?? null;
                if ($targetUser instanceof \App\Models\User) {
                    $check = \App\Services\RolePermissionSecurityService::checkCanDeleteUser($user, $targetUser);
                    if (! $check['allowed']) {
                        return false;
                    }
                }
            }

            // 3. Cho phép bypass gate cho các thao tác hợp lệ
            return ($user->hasRole('Admin') || $user->hasRole('super_admin') || $user->email === 'admin@truyenthongcuulong.com') ? true : null;
        });

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

        \Livewire\Livewire::component(
            'filament-two-factor-authentication::livewire.two-factor-authentication',
            \App\Filament\Livewire\CustomTwoFactorAuthentication::class
        );

        Paginator::useTailwind();

        if (app()->environment('production') || request()->header('X-Forwarded-Proto') === 'https' || request()->isSecure()) {
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