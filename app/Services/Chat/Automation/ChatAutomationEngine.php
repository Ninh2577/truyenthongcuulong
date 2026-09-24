<?php

namespace App\Services\Chat\Automation;

use App\Enums\ChatConversationStatus;
use App\Enums\ChatMessageSenderType;
use App\Models\ChatConversation;
use App\Models\ChatMessage;
use App\Models\ChatSetting;
use App\Models\ChatVisitor;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class ChatAutomationEngine
{
    public const SETTING_KEY = 'chat_automation_rules';
    public const DEFAULT_COOLDOWN_SECONDS = 30;
    public const IDEMPOTENCY_TTL_SECONDS = 86400; // 24 hours

    public const DEFAULT_RULES = [
        [
            'id' => 'rule_greeting_default',
            'name' => 'Lời chào mừng tự động',
            'trigger' => 'conversation_created',
            'enabled' => false,
            'priority' => 10,
            'conditions' => [
                ['field' => 'conversation_status', 'operator' => 'equals', 'value' => 'open'],
            ],
            'actions' => [
                [
                    'type' => 'send_message',
                    'payload' => [
                        'message' => 'Xin chào! Cảm ơn bạn đã liên hệ Truyền Thông Cửu Long. Chuyên viên tư vấn sẽ hỗ trợ bạn ngay trong giây lát.',
                    ],
                ],
            ],
        ],
        [
            'id' => 'rule_keyword_quote',
            'name' => 'Phản hồi từ khóa Báo Giá',
            'trigger' => 'message_received',
            'enabled' => false,
            'priority' => 20,
            'conditions' => [
                ['field' => 'message_contains', 'operator' => 'contains', 'value' => 'báo giá'],
            ],
            'actions' => [
                [
                    'type' => 'send_message',
                    'payload' => [
                        'message' => 'Dạ Truyền Thông Cửu Long xin gửi bạn thông tin dịch vụ. Bạn có thể tham khảo bảng giá chi tiết trên website hoặc để lại số điện thoại để nhận báo giá nhanh nhất nhé!',
                    ],
                ],
            ],
        ],
        [
            'id' => 'rule_keyword_livestream',
            'name' => 'Phản hồi từ khóa Livestream',
            'trigger' => 'message_received',
            'enabled' => false,
            'priority' => 30,
            'conditions' => [
                ['field' => 'message_contains', 'operator' => 'contains', 'value' => 'livestream'],
            ],
            'actions' => [
                [
                    'type' => 'send_message',
                    'payload' => [
                        'message' => 'Dạ bên em chuyên cung cấp dịch vụ Livestream chuyên nghiệp đa máy quay tại Cần Thơ và các tỉnh ĐBSCL. Sự kiện của bạn dự kiến diễn ra vào ngày nào ạ?',
                    ],
                ],
            ],
        ],
    ];

    public function __construct(
        protected ChatAutomationActionService $actionService
    ) {}

    /**
     * Get all configured automation rules.
     */
    public function getRules(): array
    {
        $rules = ChatSetting::get(self::SETTING_KEY);

        if (! is_array($rules) || empty($rules)) {
            return self::DEFAULT_RULES;
        }

        return $rules;
    }

    /**
     * Save updated automation rules.
     */
    public function saveRules(array $rules): void
    {
        ChatSetting::set(self::SETTING_KEY, $rules, 'Cấu hình quy tắc tự động hóa Chat CSKH');
    }

    /**
     * Dispatch an event to the automation engine.
     * Evaluates security, loop-protection, trigger match, conditions, idempotency, and executes actions.
     *
     * @param string $trigger Trigger type ('conversation_created', 'message_received', 'conversation_updated')
     * @param array $context ['conversation' => ChatConversation, 'message' => ?ChatMessage, 'visitor' => ?ChatVisitor, 'event_id' => ?string]
     * @return int Number of rules successfully executed
     */
    public function handleTrigger(string $trigger, array $context): int
    {
        /** @var ChatConversation|null $conversation */
        $conversation = $context['conversation'] ?? null;
        if (! $conversation) {
            return 0;
        }

        /** @var ChatMessage|null $message */
        $message = $context['message'] ?? null;

        /** @var ChatVisitor|null $visitor */
        $visitor = $context['visitor'] ?? $conversation->visitor;

        // 1. Security & Moderation Invariant: Skip blocked visitors
        if ($visitor && $visitor->blocked_at !== null) {
            return 0;
        }

        // 2. Security & Moderation Invariant: Skip spam conversations
        if ($conversation->status === ChatConversationStatus::Spam) {
            return 0;
        }

        // 3. Security & Moderation Invariant: Skip closed conversations
        if ($conversation->status === ChatConversationStatus::Closed) {
            return 0;
        }

        // 4. Loop Protection Invariant:
        // Only visitor messages can trigger message_received automation!
        // System/Bot/Agent messages must NEVER trigger message_received!
        if ($trigger === 'message_received') {
            if (! $message || $message->sender_type !== ChatMessageSenderType::Visitor) {
                return 0;
            }
        }

        // 5. Retrieve enabled rules matching this trigger
        $matchingRules = $this->getMatchingRules($trigger);
        if (empty($matchingRules)) {
            return 0;
        }

        $executedCount = 0;
        $contextId = $context['event_id'] ?? ($message ? $message->message_uuid : $conversation->conversation_uuid);

        foreach ($matchingRules as $rule) {
            $ruleId = $rule['id'] ?? Str::slug($rule['name']);

            // 6. Evaluate Rule Conditions
            if (! $this->evaluateConditions($rule['conditions'] ?? [], $conversation, $message)) {
                continue;
            }

            // 7. Concurrency & Idempotency Guard:
            // Ensure same event + same rule executes AT MOST ONCE
            $idempKey = "chat_auto:exec:{$ruleId}:{$contextId}";
            $acquired = $this->getCacheStore()->add($idempKey, now()->timestamp, self::IDEMPOTENCY_TTL_SECONDS);
            if (! $acquired) {
                // Already executed for this event context
                continue;
            }

            // 8. Cooldown / Rate Limit Guard:
            // Prevent runaway spam on the same conversation
            $cooldownSeconds = (int) ($rule['cooldown_seconds'] ?? self::DEFAULT_COOLDOWN_SECONDS);
            if ($cooldownSeconds > 0) {
                $cooldownKey = "chat_auto:cooldown:{$ruleId}:{$conversation->id}";
                if ($this->getCacheStore()->has($cooldownKey)) {
                    continue;
                }
                $this->getCacheStore()->put($cooldownKey, 1, $cooldownSeconds);
            }

            // 9. Execute Actions
            $actions = $rule['actions'] ?? [];
            foreach ($actions as $action) {
                $this->executeAction($action, $conversation, $rule['name'] ?? 'Unnamed Rule');
            }

            $executedCount++;
        }

        return $executedCount;
    }

    /**
     * Filter enabled rules matching trigger, sorted deterministically by priority ASC.
     */
    protected function getMatchingRules(string $trigger): array
    {
        $allRules = $this->getRules();

        $matched = array_filter($allRules, function ($rule) use ($trigger) {
            $isEnabled = ! empty($rule['enabled']);
            $isTriggerMatch = ($rule['trigger'] ?? '') === $trigger;

            return $isEnabled && $isTriggerMatch;
        });

        // Sort deterministically by priority ASC, then id ASC
        usort($matched, function ($a, $b) {
            $pA = (int) ($a['priority'] ?? 100);
            $pB = (int) ($b['priority'] ?? 100);

            if ($pA === $pB) {
                return strcmp((string) ($a['id'] ?? ''), (string) ($b['id'] ?? ''));
            }

            return $pA <=> $pB;
        });

        return $matched;
    }

    /**
     * Evaluate rule conditions against conversation and message.
     */
    public function evaluateConditions(array $conditions, ChatConversation $conversation, ?ChatMessage $message): bool
    {
        if (empty($conditions)) {
            return true;
        }

        foreach ($conditions as $cond) {
            $field = $cond['field'] ?? '';
            $operator = $cond['operator'] ?? 'equals';
            $expectedValue = $cond['value'] ?? null;

            switch ($field) {
                case 'message_contains':
                    if (! $message) {
                        return false;
                    }
                    $body = mb_strtolower((string) $message->message_body, 'UTF-8');
                    $expected = mb_strtolower((string) $expectedValue, 'UTF-8');
                    if (! str_contains($body, $expected)) {
                        return false;
                    }
                    break;

                case 'conversation_status':
                    $actualStatus = $conversation->status instanceof \BackedEnum
                        ? $conversation->status->value
                        : (string) $conversation->status;
                    if ($operator === 'equals' && $actualStatus !== (string) $expectedValue) {
                        return false;
                    }
                    if ($operator === 'not_equals' && $actualStatus === (string) $expectedValue) {
                        return false;
                    }
                    break;

                case 'outside_business_hours':
                    if (! $this->isOutsideBusinessHours()) {
                        return false;
                    }
                    break;

                case 'conversation_age_seconds':
                    $age = $conversation->created_at ? $conversation->created_at->diffInSeconds(now()) : 0;
                    if ($operator === 'greater_than' && $age < (int) $expectedValue) {
                        return false;
                    }
                    if ($operator === 'less_than' && $age > (int) $expectedValue) {
                        return false;
                    }
                    break;

                default:
                    // Unknown condition fails closed
                    return false;
            }
        }

        return true;
    }

    /**
     * Check if current local time is outside business hours.
     * Default: Mon-Sat, 08:00 to 18:00 (Asia/Ho_Chi_Minh timezone).
     */
    public function isOutsideBusinessHours(?Carbon $now = null): bool
    {
        $tz = config('app.timezone', 'Asia/Ho_Chi_Minh');
        $now = $now ? $now->setTimezone($tz) : Carbon::now($tz);

        // Sunday is non-working day (dayOfWeekIso == 7)
        if ($now->dayOfWeekIso === 7) {
            return true;
        }

        $hour = (int) $now->format('H');
        $minute = (int) $now->format('i');
        $currentMinutes = ($hour * 60) + $minute;

        $startMinutes = 8 * 60;   // 08:00
        $endMinutes = 18 * 60;    // 18:00

        return $currentMinutes < $startMinutes || $currentMinutes >= $endMinutes;
    }

    /**
     * Execute an individual automation action.
     */
    protected function executeAction(array $action, ChatConversation $conversation, string $ruleName): void
    {
        $type = $action['type'] ?? '';
        $payload = $action['payload'] ?? [];

        switch ($type) {
            case 'send_message':
                $text = (string) ($payload['message'] ?? '');
                if ($text !== '') {
                    $this->actionService->sendAutomatedMessage($conversation, $text, $ruleName);
                }
                break;

            case 'update_status':
                $statusVal = (string) ($payload['status'] ?? '');
                $status = ChatConversationStatus::tryFrom($statusVal);
                if ($status) {
                    $this->actionService->updateConversationStatus($conversation, $status, $ruleName);
                }
                break;
        }
    }

    /**
     * Get the cache repository for idempotency and cooldown tracking.
     * When running under array cache driver, fallback to database store if available
     * so that multi-process workers can share atomic locks and state.
     */
    protected function getCacheStore(): \Illuminate\Contracts\Cache\Repository
    {
        if (config('cache.default') === 'array' && config('cache.stores.database')) {
            try {
                return Cache::store('database');
            } catch (\Throwable $e) {
                return Cache::store();
            }
        }

        return Cache::store();
    }
}

