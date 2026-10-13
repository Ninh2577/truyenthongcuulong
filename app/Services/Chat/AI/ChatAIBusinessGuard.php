<?php

namespace App\Services\Chat\AI;

use Illuminate\Support\Facades\Log;

class ChatAIBusinessGuard
{
    public const DEFAULT_FALLBACK_REPLY = 'Dạ hiện tại Cửu Long Media đang tạm ngưng nhận các job Media (quay phim, chụp ảnh, flycam, sản xuất video). Mọi mức giá cung cấp chỉ là giá tham khảo trực tuyến. Quý khách vui lòng liên hệ trực tiếp qua Zalo hoặc Hotline 0939 363 262 để được đội ngũ tư vấn hỗ trợ chi tiết hơn ạ.';

    /**
     * Inspect AI response against strict Cuu Long Media business rules.
     * If hallucination or policy breach is detected, replaces with compliant safe response.
     */
    public function validateAndEnforce(string $reply): string
    {
        $clean = trim($reply);
        if ($clean === '') {
            return self::DEFAULT_FALLBACK_REPLY;
        }

        if ($this->isViolation($clean)) {
            Log::warning('ChatAIBusinessGuard: AI response violated business rules and was replaced.', [
                'preview' => mb_substr($clean, 0, 120),
            ]);

            return self::DEFAULT_FALLBACK_REPLY;
        }

        return $clean;
    }

    /**
     * Check if the generated reply violates Cuu Long Media business constraints:
     * 1. Accepting media jobs / booking when company is temporarily suspended.
     * 2. Quoting official fixed prices instead of reference prices.
     * 3. Executing unauthorized contract or legal guarantees.
     */
    public function isViolation(string $text): bool
    {
        $lower = mb_strtolower($text, 'UTF-8');

        // Check if the reply acknowledges suspension
        $hasSuspensionNotice = str_contains($lower, 'tạm ngưng')
            || str_contains($lower, 'tạm dừng')
            || str_contains($lower, 'ngưng nhận')
            || str_contains($lower, 'không nhận')
            || str_contains($lower, 'chưa nhận');

        // Violation Pattern 1: Asserting media job acceptance or booking without suspension disclaimer
        $acceptsMediaPatterns = [
            '/bên\s+em\s+(nhận|có\s+nhận|sẽ\s+nhận)\s+(quay|chụp|làm|bay|booking)/u',
            '/chúng\s+tôi\s+(nhận|có\s+nhận|sẽ\s+nhận)\s+(quay|chụp|làm|bay)/u',
            '/cửu\s+long\s+media\s+nhận\s+(quay|chụp|sản\s+xuất|booking)/u',
            '/(đặt\s+lịch|xác\s+nhận\s+lịch|hẹn\s+lịch)\s+(quay|chụp|bay\s+flycam)/u',
            '/sẵn\s+sàng\s+(thực\s+hiện|nhận\s+job|nhận\s+dự\s+án)\s+(quay|chụp|media)/u',
            '/(nhận\s+quay\s+phim|nhận\s+chụp\s+ảnh|nhận\s+bay\s+flycam)/u',
        ];

        foreach ($acceptsMediaPatterns as $pattern) {
            if (preg_match($pattern, $lower) && ! $hasSuspensionNotice) {
                return true;
            }
        }

        // Violation Pattern 2: Asserting fixed or official pricing
        $priceViolations = [
            '/giá\s+(chính\s+thức|cố\s+định|chắc\s+chắn|chuẩn\s+xác)\s+là/u',
            '/cam\s+kết\s+mức\s+giá/u',
        ];

        foreach ($priceViolations as $pattern) {
            if (preg_match($pattern, $lower)) {
                return true;
            }
        }

        // Violation Pattern 3: Unauthorized contract signing or legal commitments
        $legalViolations = [
            '/(ký|xác\s+nhận|cam\s+kết)\s+hợp\s+đồng\s+(ngay|trực\s+tuyến|chính\s+thức)/u',
            '/chịu\s+mọi\s+trách\s+nhiệm\s+pháp\s+lý/u',
            '/cam\s+kết\s+bồi\s+thường\s+hợp\s+đồng/u',
        ];

        foreach ($legalViolations as $pattern) {
            if (preg_match($pattern, $lower)) {
                return true;
            }
        }

        // Violation Pattern 4: Hallucinated or incorrect legacy pricing for Flycam
        // Canonical value is strictly 1.000.000đ – 1.500.000đ/lần.
        // Intercept any occurrence of 3.000.000, 5.000.000, 3tr, 5tr or /buổi in Flycam context.
        if (str_contains($lower, 'flycam')) {
            if (preg_match('/(3[\.,]000[\.,]000|5[\.,]000[\.,]000|3tr|5tr|\/\s*buổi)/iu', $lower)) {
                return true;
            }
        }

        return false;
    }
}
