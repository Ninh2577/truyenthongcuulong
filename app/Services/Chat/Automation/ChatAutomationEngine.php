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
                        'message' => "Xin chào! Cảm ơn bạn đã liên hệ Truyền Thông Cửu Long. Bạn có thể chọn các thông tin bên dưới hoặc đặt câu hỏi để được hỗ trợ:\n1. Dự án tiêu biểu\n2. Bảng giá dịch vụ\n3. Liên hệ Zalo tư vấn (Hotline/Zalo: 0939 363 262)",
                    ],
                ],
            ],
        ],
        [
            'id' => 'rule_off_hours',
            'name' => 'Thông báo ngoài giờ làm việc',
            'trigger' => 'message_received',
            'enabled' => false,
            'priority' => 15,
            'conditions' => [
                ['field' => 'outside_business_hours', 'operator' => 'equals', 'value' => true],
            ],
            'actions' => [
                [
                    'type' => 'send_message',
                    'payload' => [
                        'message' => 'Hiện tại đang ngoài giờ làm việc của Truyền Thông Cửu Long (Giờ làm việc: Thứ 2 - Thứ 7, 08:00 - 18:00). Chúng tôi sẽ phản hồi bạn ngay khi bắt đầu ca làm việc tiếp theo. Trong trường hợp cần hỗ trợ khẩn cấp, vui lòng liên hệ Hotline/Zalo: 0939 363 262.',
                    ],
                ],
            ],
            'cooldown_seconds' => 3600,
        ],
        [
            'id' => 'quick_quote_support',
            'name' => 'Phản hồi từ khóa Báo Giá & Bảng Giá Dịch Vụ',
            'trigger' => 'message_received',
            'enabled' => true,
            'priority' => 20,
            'conditions' => [
                ['field' => 'message_contains_any', 'operator' => 'contains', 'value' => ['bảng giá', 'báo giá', 'chi phí', 'giá dịch vụ', 'giá']],
                ['field' => 'message_not_contains_any', 'operator' => 'not_contains', 'value' => ['tvc', 'livestream', 'chụp ảnh', 'website', 'hotline', 'trực tiếp']],
            ],
            'actions' => [
                [
                    'type' => 'send_message',
                    'payload' => [
                        'message' => "Dạ Cửu Long xin gửi bạn bảng giá dịch vụ! Để tư vấn và gửi báo giá chính xác nhất, bạn đang quan tâm đến nhóm dịch vụ nào dưới đây ạ?\n[OPTIONS: 🎬 Sản xuất TVC & Video quảng cáo | 📡 Dịch vụ Livestream sự kiện | 📸 Chụp ảnh sự kiện & Profile | 💻 Thiết kế Website & Phần mềm | 📞 Báo giá trực tiếp qua Hotline/Zalo]",
                    ],
                ],
            ],
        ],
        [
            'id' => 'rule_quote_direct',
            'name' => 'Báo giá trực tiếp qua Hotline/Zalo',
            'trigger' => 'message_received',
            'enabled' => true,
            'priority' => 15,
            'conditions' => [
                ['field' => 'message_contains_any', 'operator' => 'contains', 'value' => ['báo giá trực tiếp', 'hotline/zalo', 'để lại số điện thoại', 'báo giá qua hotline']],
            ],
            'actions' => [
                [
                    'type' => 'send_message',
                    'payload' => [
                        'message' => "Dạ Cửu Long đã ghi nhận yêu cầu của bạn! Chuyên viên tư vấn sẽ liên hệ ngay qua số điện thoại hoặc Zalo để gửi bảng giá chi tiết kèm ưu đãi tốt nhất trong hôm nay ạ. Nếu cần hỗ trợ khẩn cấp, bạn có thể gọi ngay Hotline/Zalo: 0939 363 262!",
                    ],
                ],
            ],
        ],
        [
            'id' => 'rule_quote_tvc',
            'name' => 'Báo giá Sản xuất TVC & Video quảng cáo',
            'trigger' => 'message_received',
            'enabled' => true,
            'priority' => 16,
            'conditions' => [
                ['field' => 'message_contains_any', 'operator' => 'contains', 'value' => ['sản xuất tvc', 'tvc & video', 'video quảng cáo', 'tvc']],
            ],
            'actions' => [
                [
                    'type' => 'send_message',
                    'payload' => [
                        'message' => "Dạ Cửu Long xin gửi bạn các gói Sản xuất TVC & Video quảng cáo:\n• Gói Video ngắn / Reels / TikTok doanh nghiệp: từ 3.000.000đ - 5.000.000đ\n• Gói TVC giới thiệu doanh nghiệp tiêu chuẩn: từ 8.000.000đ - 15.000.000đ\n• Gói TVC cao cấp & kịch bản độc quyền: từ 20.000.000đ+\nBạn có thể gửi số điện thoại hoặc mô tả ngắn nhu cầu, chuyên viên Cửu Long sẽ liên hệ gửi kịch bản mẫu và báo giá chi tiết ngay nhé!\n[OPTIONS: 📞 Báo giá trực tiếp qua Hotline/Zalo | 📡 Dịch vụ Livestream sự kiện | 💻 Thiết kế Website & Phần mềm]",
                    ],
                ],
            ],
        ],
        [
            'id' => 'rule_quote_livestream',
            'name' => 'Báo giá Dịch vụ Livestream sự kiện',
            'trigger' => 'message_received',
            'enabled' => true,
            'priority' => 16,
            'conditions' => [
                ['field' => 'message_contains_any', 'operator' => 'contains', 'value' => ['livestream sự kiện', 'livestream', 'live stream']],
            ],
            'actions' => [
                [
                    'type' => 'send_message',
                    'payload' => [
                        'message' => "Dạ Cửu Long xin gửi bạn bảng giá Dịch vụ Livestream sự kiện chuyên nghiệp:\n• Gói Livestream 1 máy quay (Talkshow, workshop): từ 2.500.000đ - 3.500.000đ\n• Gói Livestream 2-3 máy quay đa góc Full HD: từ 5.000.000đ - 8.000.000đ\n• Gói Livestream 4K & Sự kiện lớn, cầu truyền hình: từ 10.000.000đ+\nSự kiện của bạn dự kiến diễn ra vào ngày nào và tại địa điểm nào ạ?\n[OPTIONS: 📞 Báo giá trực tiếp qua Hotline/Zalo | 🎬 Sản xuất TVC & Video quảng cáo | 📸 Chụp ảnh sự kiện & Profile]",
                    ],
                ],
            ],
        ],
        [
            'id' => 'rule_quote_photo',
            'name' => 'Báo giá Chụp ảnh sự kiện & Profile',
            'trigger' => 'message_received',
            'enabled' => true,
            'priority' => 16,
            'conditions' => [
                ['field' => 'message_contains_any', 'operator' => 'contains', 'value' => ['chụp ảnh sự kiện', 'profile doanh nghiệp', 'profile & chụp ảnh', 'chụp ảnh']],
            ],
            'actions' => [
                [
                    'type' => 'send_message',
                    'payload' => [
                        'message' => "Dạ Cửu Long xin gửi bạn bảng giá Dịch vụ Chụp ảnh sự kiện & Profile doanh nghiệp:\n• Chụp ảnh sự kiện, hội nghị, khai trương: từ 1.500.000đ - 3.000.000đ / buổi\n• Chụp ảnh Profile cá nhân / Ban lãnh đạo: từ 1.000.000đ - 2.500.000đ / người\n• Chụp ảnh kiến trúc, không gian doanh nghiệp: từ 2.000.000đ - 4.000.000đ\n(Đã bao gồm toàn bộ file gốc và chỉnh sửa màu sắc hoàn thiện).\n[OPTIONS: 📞 Báo giá trực tiếp qua Hotline/Zalo | 🎬 Sản xuất TVC & Video quảng cáo | 📡 Dịch vụ Livestream sự kiện]",
                    ],
                ],
            ],
        ],
        [
            'id' => 'rule_quote_web',
            'name' => 'Báo giá Thiết kế Website & Phần mềm',
            'trigger' => 'message_received',
            'enabled' => true,
            'priority' => 16,
            'conditions' => [
                ['field' => 'message_contains_any', 'operator' => 'contains', 'value' => ['thiết kế website', 'website & phần mềm', 'phần mềm theo yêu cầu', 'thiết kế web', 'website']],
            ],
            'actions' => [
                [
                    'type' => 'send_message',
                    'payload' => [
                        'message' => "Dạ Cửu Long xin gửi bạn bảng giá Thiết kế Website & Phần mềm theo yêu cầu:\n• Website doanh nghiệp / Landing Page chuẩn SEO: từ 5.000.000đ - 9.000.000đ\n• Website thương mại điện tử / Bán hàng: từ 10.000.000đ - 18.000.000đ\n• Hệ thống Web App & Phần mềm quản lý tùy biến: Báo giá theo tính năng yêu cầu.\n(Bảo hành trọn đời, bàn giao 100% mã nguồn và tài liệu quản trị).\n[OPTIONS: 📞 Báo giá trực tiếp qua Hotline/Zalo | 🎬 Sản xuất TVC & Video quảng cáo | 📡 Dịch vụ Livestream sự kiện]",
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
            // Also check if rich scripts are configured in chat_automation_scripts_v2
            $scripts = ChatSetting::get('chat_automation_scripts_v2');
            if (is_array($scripts) && ! empty($scripts)) {
                return $this->compileScriptsToRules($scripts);
            }

            return self::DEFAULT_RULES;
        }

        return $rules;
    }

    /**
     * Compile rich automation scripts into executable automation rules.
     */
    public function compileScriptsToRules(array $scripts): array
    {
        $rules = [];
        foreach ($scripts as $s) {
            if (empty($s['enabled'])) {
                continue;
            }

            $id = $s['id'] ?? Str::slug($s['name']);
            $trigger = $s['trigger_type'] ?? 'message_received';
            $botMsg = (string) ($s['preview_bot_msg'] ?? '');
            $options = $s['preview_options'] ?? [];

            if (! empty($options) && ! str_contains($botMsg, '[OPTIONS:')) {
                $botMsg .= "\n[OPTIONS: " . implode(' | ', $options) . ']';
            }

            $conditions = [];
            if ($trigger === 'conversation_created') {
                $conditions[] = ['field' => 'conversation_status', 'operator' => 'equals', 'value' => 'open'];
            } elseif ($id === 'quick_quote_support' || str_contains($id, 'quote')) {
                $conditions[] = [
                    'field' => 'message_contains_any',
                    'operator' => 'contains',
                    'value' => ['bảng giá', 'báo giá', 'chi phí', 'giá dịch vụ', 'giá'],
                ];
                $conditions[] = [
                    'field' => 'message_not_contains_any',
                    'operator' => 'not_contains',
                    'value' => ['tvc', 'livestream', 'chụp ảnh', 'website', 'hotline', 'trực tiếp'],
                ];
            } elseif ($id === 'consulting_general') {
                $conditions[] = [
                    'field' => 'message_contains_any',
                    'operator' => 'contains',
                    'value' => ['dịch vụ là gì', 'danh mục dịch vụ', 'tư vấn dịch vụ'],
                ];
            } elseif ($id === 'new_project_info') {
                $conditions[] = [
                    'field' => 'message_contains_any',
                    'operator' => 'contains',
                    'value' => ['đăng ký nhận tin', 'nhận tin dự án', 'dự án mới', 'bản tin'],
                ];
            } elseif ($id === 'spam_filter') {
                continue; // Handled by spam protection service
            } elseif (! empty($s['trigger']) && preg_match_all('/"([^"]+)"/u', $s['trigger'], $matches)) {
                $keywords = array_values(array_filter(array_map('trim', $matches[1])));
                if (! empty($keywords)) {
                    $conditions[] = [
                        'field' => 'message_contains_any',
                        'operator' => 'contains',
                        'value' => $keywords,
                    ];
                } else {
                    continue;
                }
            } else {
                continue; // Prevent unconditioned rule from catching all messages
            }

            $rules[] = [
                'id' => $id,
                'name' => $s['name'] ?? $id,
                'trigger' => $trigger,
                'enabled' => true,
                'priority' => (int) ($s['priority'] ?? 20),
                'cooldown_seconds' => (int) ($s['cooldown_seconds'] ?? 30),
                'conditions' => $conditions,
                'actions' => [
                    [
                        'type' => 'send_message',
                        'payload' => [
                            'message' => $botMsg,
                            'options' => $options,
                        ],
                    ],
                ],
            ];
        }

        // Merge supplementary default rules (like specific service tier quotes)
        $existingIds = array_column($rules, 'id');
        if (in_array('quick_quote_support', $existingIds) || in_array('rule_keyword_quote', $existingIds)) {
            $existingIds[] = 'quick_quote_support';
            $existingIds[] = 'rule_keyword_quote';
        }
        foreach (self::DEFAULT_RULES as $defRule) {
            if (! in_array($defRule['id'], $existingIds) && ! empty($defRule['enabled'])) {
                $rules[] = $defRule;
            }
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

        // 4. Human Takeover Invariant: Skip human channel, assigned agent or waiting agent
        if ($conversation->channel === \App\Enums\ChatConversationChannel::Human
            || $conversation->assigned_to_user_id !== null
            || $conversation->status === ChatConversationStatus::WaitingAgent
        ) {
            return 0;
        }

        // 5. Loop Protection Invariant:
        // Only visitor messages can trigger message_received automation!
        // System/Bot/Agent messages must NEVER trigger message_received!
        if ($trigger === 'message_received') {
            if (! $message || $message->sender_type !== ChatMessageSenderType::Visitor) {
                return 0;
            }

            // 5.1. Spam Precedence Invariant: Banned keywords prevent automation
            $spamService = app(\App\Services\Chat\Spam\ChatSpamProtectionService::class);
            if ($spamService->checkBannedKeywords((string) $message->message_body)) {
                return 0;
            }

            // 5.2. Human Handoff Precedence Invariant: Handoff requests prevent automation
            $handoffService = app(\App\Services\Chat\AI\ChatHandoffService::class);
            if ($handoffService->isHandoffRequested((string) $message->message_body)) {
                return 0;
            }
        }

        // 6. Retrieve enabled rules matching this trigger
        $matchingRules = $this->getMatchingRules($trigger);
        if (empty($matchingRules)) {
            return 0;
        }

        $executedCount = 0;
        $contextId = $context['event_id'] ?? ($message ? $message->message_uuid : $conversation->conversation_uuid);

        foreach ($matchingRules as $rule) {
            $ruleId = $rule['id'] ?? Str::slug($rule['name']);

            // 7. Evaluate Rule Conditions
            if (! $this->evaluateConditions($rule['conditions'] ?? [], $conversation, $message)) {
                continue;
            }

            // 8. Concurrency & Idempotency Guard:
            // Ensure same event + same rule executes AT MOST ONCE
            $idempKey = "chat_auto:exec:{$ruleId}:{$contextId}";
            $acquired = $this->getCacheStore()->add($idempKey, now()->timestamp, self::IDEMPOTENCY_TTL_SECONDS);
            if (! $acquired) {
                // Already executed for this event context
                continue;
            }

            // 9. Cooldown / Rate Limit Guard:
            // Prevent runaway spam on the same conversation
            $cooldownSeconds = (int) ($rule['cooldown_seconds'] ?? self::DEFAULT_COOLDOWN_SECONDS);
            if ($cooldownSeconds > 0) {
                $cooldownKey = "chat_auto:cooldown:{$ruleId}:{$conversation->id}";
                if ($this->getCacheStore()->has($cooldownKey)) {
                    continue;
                }
                $this->getCacheStore()->put($cooldownKey, 1, $cooldownSeconds);
            }

            // 10. Execute Actions
            $actions = $rule['actions'] ?? [];
            $actionStart = microtime(true);
            $actionError = null;
            try {
                foreach ($actions as $action) {
                    $this->executeAction($action, $conversation, $rule['name'] ?? 'Unnamed Rule', $message);
                }
            } catch (\Throwable $e) {
                $actionError = $e->getMessage();
                $durationMs = (int) round((microtime(true) - $actionStart) * 1000);
                $this->recordExecutionLog([
                    'timestamp' => now()->toIso8601String(),
                    'customer' => $visitor ? ($visitor->name ?: "Visitor #{$visitor->id}") : 'Khách vãng lai',
                    'conversation_id' => $conversation->id,
                    'input' => $message ? (string) $message->message_body : "[Trigger: {$trigger}]",
                    'matched_trigger' => $trigger,
                    'automation' => $rule['name'] ?? $ruleId,
                    'conditions' => count($rule['conditions'] ?? []) . ' điều kiện',
                    'actions' => count($actions) . ' hành động',
                    'result' => 'ERROR',
                    'duration_ms' => max(1, $durationMs),
                    'error' => $actionError,
                ]);
                throw $e;
            }

            $durationMs = (int) round((microtime(true) - $actionStart) * 1000);
            $this->recordExecutionLog([
                'timestamp' => now()->toIso8601String(),
                'customer' => $visitor ? ($visitor->name ?: "Visitor #{$visitor->id}") : 'Khách vãng lai',
                'conversation_id' => $conversation->id,
                'input' => $message ? (string) $message->message_body : "[Trigger: {$trigger}]",
                'matched_trigger' => $trigger,
                'automation' => $rule['name'] ?? $ruleId,
                'conditions' => count($rule['conditions'] ?? []) . ' điều kiện',
                'actions' => count($actions) . ' hành động',
                'result' => 'SUCCESS',
                'duration_ms' => max(1, $durationMs),
                'error' => null,
            ]);

            // Flag message as handled by automation so AI does not duplicate response
            if ($message) {
                $this->getCacheStore()->put("chat_auto:responded:{$message->message_uuid}", true, 60);
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
                case 'message_contains_any':
                    if (! $message) {
                        return false;
                    }
                    $body = mb_strtolower((string) $message->message_body, 'UTF-8');
                    if (is_array($expectedValue)) {
                        $found = false;
                        foreach ($expectedValue as $item) {
                            $expected = mb_strtolower(trim((string) $item), 'UTF-8');
                            if ($expected !== '' && str_contains($body, $expected)) {
                                $found = true;
                                break;
                            }
                        }
                        if (! $found) {
                            return false;
                        }
                    } else {
                        $expected = mb_strtolower((string) $expectedValue, 'UTF-8');
                        if (! str_contains($body, $expected)) {
                            return false;
                        }
                    }
                    break;

                case 'message_not_contains':
                case 'message_not_contains_any':
                    if (! $message) {
                        return true;
                    }
                    $body = mb_strtolower((string) $message->message_body, 'UTF-8');
                    $exclusions = is_array($expectedValue) ? $expectedValue : [$expectedValue];
                    foreach ($exclusions as $ex) {
                        $exClean = mb_strtolower(trim((string) $ex), 'UTF-8');
                        if ($exClean !== '' && str_contains($body, $exClean)) {
                            return false;
                        }
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
    protected function executeAction(array $action, ChatConversation $conversation, string $ruleName, ?ChatMessage $message = null): void
    {
        $type = $action['type'] ?? '';
        $payload = $action['payload'] ?? [];

        switch ($type) {
            case 'send_message':
                $text = (string) ($payload['message'] ?? '');
                if ($text !== '') {
                    $text = $this->enforceBusinessGuard($text, $message);
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
     * Enforce business guard invariants for automated responses:
     * - Media services (quay phim, chụp ảnh, flycam, sản xuất video) are temporarily paused.
     * - Automated rules must never accept or confirm media bookings.
     */
    protected function enforceBusinessGuard(string $responseBody, ?ChatMessage $message = null): string
    {
        $mediaPatterns = ['/quay\s*phim/iu', '/chụp\s*ảnh/iu', '/sản\s*xuất\s*video/iu', '/flycam/iu', '/media/iu', '/booking\s*media/iu'];
        $forbiddenAcceptance = ['/bên\s*em\s*nhận/iu', '/có\s*thể\s*đặt\s*lịch/iu', '/đặt\s*lịch\s*ngay/iu', '/book\s*lịch/iu'];

        $isMediaContext = false;
        if ($message) {
            foreach ($mediaPatterns as $pat) {
                if (preg_match($pat, (string) $message->message_body)) {
                    $isMediaContext = true;
                    break;
                }
            }
        }

        if ($isMediaContext) {
            foreach ($forbiddenAcceptance as $fPat) {
                if (preg_match($fPat, $responseBody)) {
                    return 'Dạ hiện tại Cửu Long Media đang tạm ngưng tiếp nhận các công việc Media (quay phim, chụp ảnh, sản xuất video, flycam) để nâng cấp hệ thống. Quý khách vui lòng liên hệ Hotline/Zalo: 0939 363 262 để được hỗ trợ chi tiết ạ.';
                }
            }
        }

        return $responseBody;
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

    /**
     * Record execution log entry into persistent settings store.
     */
    public function recordExecutionLog(array $entry): void
    {
        try {
            $logs = ChatSetting::get('chat_automation_execution_logs', []);
            if (! is_array($logs)) {
                $logs = [];
            }
            $entry['id'] = $entry['id'] ?? (string) Str::uuid();
            $entry['timestamp'] = $entry['timestamp'] ?? now()->toIso8601String();
            array_unshift($logs, $entry);
            if (count($logs) > 100) {
                $logs = array_slice($logs, 0, 100);
            }
            ChatSetting::set('chat_automation_execution_logs', $logs, 'Nhật ký thực thi kịch bản tự động');
        } catch (\Throwable $e) {
            // Never break runtime execution if log recording fails
        }
    }

    /**
     * Retrieve recent execution logs.
     */
    public function getExecutionLogs(int $limit = 50): array
    {
        $logs = ChatSetting::get('chat_automation_execution_logs', []);
        if (! is_array($logs)) {
            return [];
        }
        return array_slice($logs, 0, $limit);
    }

    /**
     * Record a version snapshot for automations.
     */
    public function recordVersion(string $description, array $data, ?string $userEmail = null): void
    {
        try {
            $versions = ChatSetting::get('chat_automation_versions', []);
            if (! is_array($versions)) {
                $versions = [];
            }
            $verNum = 'v1.' . (count($versions) + 1);
            $newVersion = [
                'id' => 'v_' . now()->format('Ymd_His') . '_' . Str::random(4),
                'version_number' => $verNum,
                'timestamp' => now()->format('H:i d/m/Y'),
                'iso_timestamp' => now()->toIso8601String(),
                'author' => $userEmail ?: (auth()->user()?->email ?? 'System'),
                'change_summary' => $description,
                'data' => $data,
                'count' => count($data),
            ];
            array_unshift($versions, $newVersion);
            if (count($versions) > 20) {
                $versions = array_slice($versions, 0, 20);
            }
            ChatSetting::set('chat_automation_versions', $versions, 'Lịch sử phiên bản kịch bản tự động');
        } catch (\Throwable $e) {
            // Silently ignore snapshot failure
        }
    }

    /**
     * Get recorded versions.
     */
    public function getVersions(): array
    {
        $versions = ChatSetting::get('chat_automation_versions', []);
        return is_array($versions) ? $versions : [];
    }

    /**
     * Restore a specific version.
     */
    public function restoreVersion(string $versionId): ?array
    {
        $versions = $this->getVersions();
        foreach ($versions as $v) {
            if (($v['id'] ?? '') === $versionId) {
                $data = $v['data'] ?? [];
                if (is_array($data) && ! empty($data)) {
                    ChatSetting::set('chat_automation_scripts_v2', $data, 'Khôi phục từ phiên bản ' . ($v['version_number'] ?? ''));
                    $this->recordVersion("Khôi phục về phiên bản {$v['version_number']}", $data);
                    return $data;
                }
            }
        }
        return null;
    }

    /**
     * Detect conflicts across automations.
     */
    public function detectConflicts(array $automations): array
    {
        $conflicts = [];
        $activeAutomations = array_filter($automations, fn($a) => ! empty($a['enabled']));

        // 1. Check duplicate/overlapping keywords
        $keywordMap = [];
        foreach ($activeAutomations as $auto) {
            $name = $auto['name'] ?? $auto['id'];
            $priority = (int) ($auto['priority'] ?? 50);

            // Extract keywords from conditions or trigger text
            $keywords = [];
            if (! empty($auto['conditions'])) {
                foreach ($auto['conditions'] as $cond) {
                    if (($cond['field'] ?? '') === 'message_contains' && ! empty($cond['value'])) {
                        $keywords[] = mb_strtolower(trim((string) $cond['value']), 'UTF-8');
                    }
                }
            }
            // Also extract from desc/trigger if keyword pattern is indicated
            if (empty($keywords) && ! empty($auto['trigger'])) {
                if (preg_match_all('/"([^"]+)"/u', $auto['trigger'], $matches)) {
                    foreach ($matches[1] as $m) {
                        $keywords[] = mb_strtolower(trim($m), 'UTF-8');
                    }
                }
            }

            foreach ($keywords as $kw) {
                if (isset($keywordMap[$kw])) {
                    $prev = $keywordMap[$kw];
                    $level = ($prev['priority'] === $priority) ? 'danger' : 'warning';
                    $conflicts[] = [
                        'id' => 'conflict_kw_' . md5($kw . $prev['id'] . $auto['id']),
                        'level' => $level,
                        'type' => 'duplicate_keyword',
                        'keyword' => $kw,
                        'message' => "Trùng từ khóa kích hoạt: \"{$kw}\" giữa [{$prev['name']}] (Priority: {$prev['priority']}) và [{$name}] (Priority: {$priority}).",
                        'recommendation' => $prev['priority'] === $priority
                            ? "Hai kịch bản có cùng Priority ({$priority}). Hãy thay đổi độ ưu tiên để tránh xung đột thứ tự thực thi."
                            : "Kịch bản [{$prev['name']}] có độ ưu tiên cao hơn và sẽ chiếm quyền thực thi khi từ khóa khớp.",
                        'rules' => [$prev['id'], $auto['id']],
                    ];
                } else {
                    $keywordMap[$kw] = [
                        'id' => $auto['id'],
                        'name' => $name,
                        'priority' => $priority,
                    ];
                }
            }
        }

        // 2. Check identical trigger with identical priority
        $triggerPriorityMap = [];
        foreach ($activeAutomations as $auto) {
            $trigger = $auto['trigger_type'] ?? ($auto['trigger'] ?? 'message_received');
            $priority = (int) ($auto['priority'] ?? 50);
            $key = "{$trigger}:{$priority}";

            if (isset($triggerPriorityMap[$key])) {
                $prev = $triggerPriorityMap[$key];
                $conflicts[] = [
                    'id' => 'conflict_priority_' . md5($key . $prev['id'] . $auto['id']),
                    'level' => 'warning',
                    'type' => 'conflicting_priority',
                    'message' => "Trùng độ ưu tiên ({$priority}) cho cùng loại trigger [{$trigger}] giữa [{$prev['name']}] và [{$auto['name']}].",
                    'recommendation' => "Cân nhắc đặt giá trị Priority khác nhau để đảm bảo thứ tự thực thi xác định.",
                    'rules' => [$prev['id'], $auto['id']],
                ];
            } else {
                $triggerPriorityMap[$key] = [
                    'id' => $auto['id'],
                    'name' => $auto['name'] ?? $auto['id'],
                ];
            }
        }

        return $conflicts;
    }

    /**
     * Get the currently active welcome script for client widget.
     */
    public function getActiveWelcomeScript(): ?array
    {
        $scripts = ChatSetting::get('chat_automation_scripts_v2');
        if (! is_array($scripts) || empty($scripts)) {
            $scripts = $this->getDefaultScripts();
        }

        foreach ($scripts as $s) {
            if (! empty($s['enabled']) && (($s['category'] ?? '') === 'welcome' || ($s['trigger_type'] ?? '') === 'conversation_created' || ($s['id'] ?? '') === 'welcome_customer')) {
                return $s;
            }
        }

        return null;
    }

    /**
     * Default rich scripts for presentation and simulation.
     */
    public function getDefaultScripts(): array
    {
        return [
            [
                'id' => 'welcome_customer',
                'name' => 'Chào mừng khách hàng',
                'desc' => 'Tự động gửi tin nhắn chào mừng khi khách hàng bắt đầu cuộc trò chuyện với website.',
                'category' => 'welcome',
                'category_label' => 'Chào mừng',
                'trigger' => 'Khi khách hàng nhắn tin đầu tiên',
                'trigger_type' => 'conversation_created',
                'priority' => 10,
                'cooldown_seconds' => 30,
                'enabled' => true,
                'usage_count' => 1248,
                'success_count' => 1248,
                'error_count' => 0,
                'preview_trigger' => 'Khách hàng bắt đầu chat',
                'preview_user_msg' => 'Xin chào!',
                'preview_bot_msg' => "Chào bạn! Cảm ơn bạn đã quan tâm đến Cửu Long ID. Bạn cần tư vấn về dịch vụ nào ạ?\n\nVui lòng chọn:",
                'preview_options' => [
                    'Dự án tiêu biểu',
                    'Bảng giá dịch vụ',
                    'Đăng ký tư vấn',
                ],
            ],
            [
                'id' => 'quick_quote_support',
                'name' => 'Hỗ trợ báo giá nhanh',
                'desc' => 'Tự động phản hồi bảng giá và hỏi rõ nhóm dịch vụ khách hàng đang quan tâm.',
                'category' => 'consulting',
                'category_label' => 'Tư vấn dịch vụ',
                'trigger' => 'Khi khách hàng gửi từ khóa ("bảng giá", "chi phí", "giá dịch vụ...")',
                'trigger_type' => 'message_received',
                'priority' => 20,
                'cooldown_seconds' => 30,
                'enabled' => true,
                'usage_count' => 623,
                'success_count' => 623,
                'error_count' => 0,
                'preview_trigger' => 'Khách gửi từ khóa báo giá',
                'preview_user_msg' => 'Bảng giá dịch vụ',
                'preview_bot_msg' => "Dạ Cửu Long xin gửi bạn bảng giá dịch vụ! Để tư vấn và gửi báo giá chính xác nhất, bạn đang quan tâm đến nhóm dịch vụ nào dưới đây ạ?",
                'preview_options' => [
                    '🎬 Sản xuất TVC & Video quảng cáo',
                    '📡 Dịch vụ Livestream sự kiện',
                    '📸 Chụp ảnh sự kiện & Profile',
                    '💻 Thiết kế Website & Phần mềm',
                    '📞 Báo giá trực tiếp qua Hotline/Zalo',
                ],
            ],
            [
                'id' => 'consulting_general',
                'name' => 'Tư vấn dịch vụ chung',
                'desc' => 'Tự động phản hồi thông tin về các dịch vụ của công ty khi khách hàng hỏi.',
                'category' => 'consulting',
                'category_label' => 'Tư vấn dịch vụ',
                'trigger' => 'Khi khách hàng hỏi về dịch vụ (ví dụ: "dịch vụ là gì", "danh mục...")',
                'trigger_type' => 'message_received',
                'priority' => 25,
                'cooldown_seconds' => 30,
                'enabled' => true,
                'usage_count' => 856,
                'success_count' => 854,
                'error_count' => 2,
                'preview_trigger' => 'Khách hỏi dịch vụ',
                'preview_user_msg' => 'Bên mình có những dịch vụ nào vậy?',
                'preview_bot_msg' => "Truyền Thông Cửu Long cung cấp các gói giải pháp dịch vụ truyền thông chuyên nghiệp:",
                'preview_options' => [
                    'Sản xuất Video / TVC',
                    'Livestream sự kiện',
                    'Bảng giá & Khuyến mãi',
                ],
            ],
            [
                'id' => 'spam_filter',
                'name' => 'Chặn tin rác & Spam',
                'desc' => 'Tự động phát hiện và chặn các tin nhắn có nội dung spam, quảng cáo, không phù hợp.',
                'category' => 'other',
                'category_label' => 'Khác',
                'trigger' => 'Khi từ khóa: spam, quảng cáo, casino, số điện thoại lạ...',
                'trigger_type' => 'message_received',
                'priority' => 5,
                'cooldown_seconds' => 10,
                'enabled' => true,
                'usage_count' => 1932,
                'success_count' => 1932,
                'error_count' => 0,
                'preview_trigger' => 'Phát hiện từ khóa nghi vấn',
                'preview_user_msg' => 'Quảng cáo cược uy tín...',
                'preview_bot_msg' => "[Hệ thống tự động phát hiện và chặn tin nhắn theo bộ lọc an toàn]",
                'preview_options' => [
                    'Báo cáo quản trị',
                    'Kiểm tra danh sách chặn',
                ],
            ],
        ];
    }

    /**
     * Safely simulate execution of an incoming message without sending real messages or saving to DB.
     */
    public function simulateExecution(string $inputMessage, array $context = []): array
    {
        $start = microtime(true);
        $rules = $this->getRules();

        // Also check rich scripts if rules is empty or to complement keywords
        $scripts = ChatSetting::get('chat_automation_scripts_v2');
        if (! is_array($scripts) || empty($scripts)) {
            $scripts = $this->getDefaultScripts();
        }
        $activeRules = array_filter($rules, fn($r) => ! empty($r['enabled']));

        $trimmedInput = trim($inputMessage);
        $lowerInput = mb_strtolower($trimmedInput, 'UTF-8');

        $matchedList = [];

        // Check if Spam protection would block this
        $spamService = app(\App\Services\Chat\Spam\ChatSpamProtectionService::class);
        $isSpam = $spamService->checkBannedKeywords($trimmedInput);
        if ($isSpam) {
            $durationMs = (int) round((microtime(true) - $start) * 1000);
            return [
                'result' => 'BLOCKED',
                'status_label' => 'Bị chặn bởi bộ lọc an toàn Spam',
                'input' => $trimmedInput,
                'matched_trigger' => 'Bộ lọc bảo mật & Từ khóa cấm',
                'selected_automation' => 'Chặn tin rác & Spam',
                'duration_ms' => max(1, $durationMs),
                'simulated_output' => '[Hệ thống tự động phát hiện và chặn tin nhắn do chứa nội dung spam/vi phạm]',
                'conditions_detail' => ['Phát hiện từ khóa trong danh sách cấm'],
                'actions_detail' => ['Chặn tin nhắn', 'Đánh dấu hội thoại là Spam'],
                'notes' => 'Tin nhắn không kích hoạt kịch bản chăm sóc do vi phạm chính sách bảo mật.',
            ];
        }

        // Check if Human handoff would intercept this
        $handoffService = app(\App\Services\Chat\AI\ChatHandoffService::class);
        $isHandoff = $handoffService->isHandoffRequested($trimmedInput);
        if ($isHandoff) {
            $durationMs = (int) round((microtime(true) - $start) * 1000);
            return [
                'result' => 'HANDOFF',
                'status_label' => 'Chuyển giao chuyên viên CSKH',
                'input' => $trimmedInput,
                'matched_trigger' => 'Yêu cầu gặp nhân viên (Human Handoff)',
                'selected_automation' => 'Chuyển giao tư vấn viên',
                'duration_ms' => max(1, $durationMs),
                'simulated_output' => 'Dạ em đang kết nối bạn với chuyên viên hỗ trợ của Truyền Thông Cửu Long. Vui lòng đợi trong giây lát ạ!',
                'conditions_detail' => ['Phát hiện ý định yêu cầu gặp nhân viên trực tiếp'],
                'actions_detail' => ['Chuyển trạng thái hội thoại: WaitingAgent', 'Thông báo cho chuyên viên trực ca'],
                'notes' => 'Quy tắc bàn giao nhân viên được ưu tiên trước các kịch bản tự động thông thường.',
            ];
        }

        // Evaluate against all active rules
        foreach ($activeRules as $rule) {
            $trigger = $rule['trigger'] ?? 'message_received';
            if ($trigger !== 'message_received' && $trigger !== 'conversation_created') {
                continue;
            }

            $conditions = $rule['conditions'] ?? [];
            $allMatch = true;
            $condResults = [];

            foreach ($conditions as $c) {
                $field = $c['field'] ?? '';

                if ($field === 'message_contains' || $field === 'message_contains_any') {
                    if (is_array($c['value'] ?? null)) {
                        $matchedAny = false;
                        $matchedKw = '';
                        foreach ($c['value'] as $item) {
                            $itemLower = mb_strtolower(trim((string) $item), 'UTF-8');
                            if ($itemLower !== '' && str_contains($lowerInput, $itemLower)) {
                                $matchedAny = true;
                                $matchedKw = (string) $item;
                                break;
                            }
                        }
                        if ($matchedAny) {
                            $condResults[] = "Khớp từ khóa: '{$matchedKw}'";
                        } else {
                            $allMatch = false;
                            $condResults[] = "Không khớp từ khóa trong danh sách";
                        }
                    } else {
                        $val = mb_strtolower((string) ($c['value'] ?? ''), 'UTF-8');
                        if (str_contains($lowerInput, $val)) {
                            $condResults[] = "Khớp từ khóa: '{$c['value']}'";
                        } else {
                            $allMatch = false;
                            $condResults[] = "Không khớp từ khóa: '{$c['value']}'";
                        }
                    }
                } elseif ($field === 'message_not_contains' || $field === 'message_not_contains_any') {
                    $exclusions = is_array($c['value'] ?? null) ? $c['value'] : [$c['value'] ?? ''];
                    $hasExclusion = false;
                    foreach ($exclusions as $ex) {
                        $exClean = mb_strtolower(trim((string) $ex), 'UTF-8');
                        if ($exClean !== '' && str_contains($lowerInput, $exClean)) {
                            $hasExclusion = true;
                            $allMatch = false;
                            $condResults[] = "Chứa từ khóa loại trừ: '{$ex}'";
                            break;
                        }
                    }
                    if (! $hasExclusion) {
                        $condResults[] = "Không chứa từ khóa loại trừ";
                    }
                } elseif ($field === 'outside_business_hours') {
                    $isOutside = $this->isOutsideBusinessHours();
                    if ($isOutside) {
                        $condResults[] = "Hiện tại ngoài giờ làm việc: Đúng";
                    } else {
                        $allMatch = false;
                        $condResults[] = "Hiện tại trong giờ làm việc: Điều kiện không thỏa mãn";
                    }
                }
            }

            if ($allMatch && ! empty($conditions)) {
                $matchedList[] = [
                    'rule' => $rule,
                    'conditions' => $condResults,
                    'priority' => (int) ($rule['priority'] ?? 100),
                ];
            }
        }

        // Also check rich scripts for keyword matches if needed
        if (empty($matchedList) && is_array($scripts)) {
            foreach ($scripts as $s) {
                if (empty($s['enabled'])) {
                    continue;
                }
                $trig = mb_strtolower($s['trigger'] ?? '', 'UTF-8');
                $name = mb_strtolower($s['name'] ?? '', 'UTF-8');
                $desc = mb_strtolower($s['desc'] ?? '', 'UTF-8');

                // Extract quoted keywords e.g. "bảng giá", "chi phí"
                if (preg_match_all('/"([^"]+)"/u', $s['trigger'] ?? '', $m)) {
                    foreach ($m[1] as $kw) {
                        if (str_contains($lowerInput, mb_strtolower($kw, 'UTF-8'))) {
                            $matchedList[] = [
                                'rule' => [
                                    'id' => $s['id'],
                                    'name' => $s['name'],
                                    'priority' => 20,
                                    'actions' => [
                                        [
                                            'type' => 'send_message',
                                            'payload' => [
                                                'message' => $s['preview_bot_msg'] ?? '',
                                                'options' => $s['preview_options'] ?? [],
                                            ],
                                        ],
                                    ],
                                ],
                                'conditions' => ["Khớp từ khóa: '{$kw}'"],
                                'priority' => 20,
                            ];
                            break;
                        }
                    }
                }

                // Greeting fallback if input contains greeting words
                if (empty($matchedList) && ($s['category'] ?? '') === 'welcome' && (str_contains($lowerInput, 'chào') || str_contains($lowerInput, 'hello') || str_contains($lowerInput, 'hi'))) {
                    $matchedList[] = [
                        'rule' => [
                            'id' => $s['id'],
                            'name' => $s['name'],
                            'priority' => 10,
                            'actions' => [
                                [
                                    'type' => 'send_message',
                                    'payload' => [
                                        'message' => $s['preview_bot_msg'] ?? '',
                                        'options' => $s['preview_options'] ?? [],
                                    ],
                                ],
                            ],
                        ],
                        'conditions' => ["Khớp tin nhắn chào mừng"],
                        'priority' => 10,
                    ];
                }
            }
        }

        $durationMs = (int) round((microtime(true) - $start) * 1000);

        if (empty($matchedList)) {
            return [
                'result' => 'NO_MATCH',
                'status_label' => 'Không có kịch bản phù hợp',
                'input' => $trimmedInput,
                'matched_trigger' => 'Không khớp',
                'selected_automation' => 'Chuyển xử lý cho AI Bot / Trực tuyến',
                'duration_ms' => max(1, $durationMs),
                'simulated_output' => 'Tin nhắn không khớp bất kỳ kịch bản tự động nào đang bật. Sẽ được chuyển tiếp cho AI Bot thông minh hoặc Chuyên viên trực.',
                'conditions_detail' => ['Không có điều kiện kịch bản nào được thỏa mãn'],
                'actions_detail' => ['Ủy quyền cho AI Assistant hoặc CSKH'],
                'notes' => 'Hệ thống an toàn không phản hồi sai lệch khi không chắc chắn.',
            ];
        }

        // Sort by priority ASC
        usort($matchedList, fn($a, $b) => $a['priority'] <=> $b['priority']);
        $winner = $matchedList[0];
        $selectedRule = $winner['rule'];

        $simulatedOutput = '';
        $simulatedOptions = [];
        $actionsDetail = [];

        foreach ($selectedRule['actions'] ?? [] as $act) {
            if (($act['type'] ?? '') === 'send_message') {
                $rawMsg = (string) ($act['payload']['message'] ?? '');
                // Check business guard
                $mockMsg = new \App\Models\ChatMessage(['message_body' => $trimmedInput]);
                $guardedMsg = $this->enforceBusinessGuard($rawMsg, $mockMsg);
                $simulatedOutput = $guardedMsg;
                $simulatedOptions = $act['payload']['options'] ?? [];
                $actionsDetail[] = 'Gửi tin nhắn phản hồi tự động';
            } elseif (($act['type'] ?? '') === 'update_status') {
                $actionsDetail[] = 'Cập nhật trạng thái hội thoại: ' . ($act['payload']['status'] ?? '');
            }
        }

        return [
            'result' => 'PASS',
            'status_label' => 'Kích hoạt thành công',
            'input' => $trimmedInput,
            'matched_trigger' => 'Khớp điều kiện tin nhắn (Priority: ' . $winner['priority'] . ')',
            'selected_automation' => $selectedRule['name'] ?? 'Kịch bản tự động',
            'duration_ms' => max(1, $durationMs),
            'simulated_output' => $simulatedOutput,
            'simulated_options' => $simulatedOptions,
            'conditions_detail' => $winner['conditions'],
            'actions_detail' => $actionsDetail,
            'notes' => count($matchedList) > 1
                ? 'Có ' . count($matchedList) . ' kịch bản khớp. Kịch bản có Priority cao nhất (' . $winner['priority'] . ') đã được chọn thực thi.'
                : 'Kịch bản khớp duy nhất và thực thi chuẩn xác.',
        ];
    }
}

