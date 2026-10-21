<?php

namespace App\Services;

use App\Models\ChatVisitor;
use App\Services\Chat\VisitorSessionService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CustomerIdentityResolver
{
    /**
     * Chuẩn hóa số điện thoại Việt Nam.
     * Chuyển tất cả định dạng: 0939363262, 0939 363 262, 0939-363-262, +84939363262
     * về định dạng chuẩn 10 chữ số có số 0 ở đầu (ví dụ: 0939363262).
     */
    public function normalizePhone(?string $phone): ?string
    {
        if (empty($phone)) {
            return null;
        }

        // Nếu chuỗi chứa @ thì đây là email, không phải số điện thoại
        if (str_contains($phone, '@')) {
            return null;
        }

        // Bỏ tất cả ký tự không phải số
        $digits = preg_replace('/[^0-9]/', '', $phone);

        if (empty($digits) || strlen($digits) < 8) {
            return null;
        }

        // Xử lý mã quốc gia 84 (ví dụ 84939363262 -> 0939363262)
        if (str_starts_with($digits, '84') && strlen($digits) >= 11) {
            $digits = '0' . substr($digits, 2);
        }

        // Đảm bảo số điện thoại Việt Nam bắt đầu bằng số 0
        if (!str_starts_with($digits, '0') && strlen($digits) === 9) {
            $digits = '0' . $digits;
        }

        return substr($digits, 0, 20);
    }

    /**
     * Chuẩn hóa email: trim, lowercase, loại bỏ rỗng.
     */
    public function normalizeEmail(?string $email): ?string
    {
        if (empty($email)) {
            return null;
        }

        $email = strtolower(trim($email));

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return null;
        }

        return substr($email, 0, 100);
    }

    /**
     * Kiểm tra xem tên có phải là tên tạm/tracking tự sinh hay không.
     */
    public function isDummyName(?string $name): bool
    {
        if (empty($name)) {
            return true;
        }

        $name = trim($name);
        $lower = strtolower($name);

        if (str_starts_with($lower, 'khách ') || str_starts_with($lower, 'khách #') || str_starts_with($lower, 'visitor')) {
            return true;
        }

        if (str_contains($lower, 'test') || str_contains($lower, 'ẩn danh') || str_contains($lower, 'anonymous')) {
            return true;
        }

        return false;
    }

    /**
     * Định danh và liên kết khách hàng từ dữ liệu Form Tư Vấn.
     * Thứ tự ưu tiên:
     * 1. Phone exact normalized match
     * 2. Email exact normalized match
     * 3. Session/Cookie visitor hiện tại
     * 4. Tạo mới ChatVisitor identified
     */
    public function resolveForConsultation(array $data, ?Request $request = null): ?ChatVisitor
    {
        try {
            $rawPhone = isset($data['phone']) ? trim($data['phone']) : null;
            $rawEmail = isset($data['email']) ? trim($data['email']) : null;
            $fullname = isset($data['fullname']) ? trim($data['fullname']) : (isset($data['name']) ? trim($data['name']) : null);

            // Tự động hoán đổi nếu ô phone chứa email
            if (!empty($rawPhone) && str_contains($rawPhone, '@')) {
                if (empty($rawEmail)) {
                    $rawEmail = $rawPhone;
                }
                $rawPhone = null;
            }

            $normPhone = $this->normalizePhone($rawPhone);
            $normEmail = $this->normalizeEmail($rawEmail);

            // Giới hạn an toàn độ dài theo schema DB (chat_visitors.phone là varchar 20, email là 100)
            $safePhone = $rawPhone ? Str::limit($rawPhone, 20, '') : null;
            $safeEmail = $rawEmail ? Str::limit($rawEmail, 100, '') : null;
            $safeName = $fullname ? Str::limit($fullname, 100, '') : null;

            $visitor = null;

            // 1. Phone exact normalized match
            if ($normPhone) {
                $visitor = ChatVisitor::where('phone_normalized', $normPhone)
                    ->orWhere('phone', $normPhone)
                    ->orWhere('phone', $safePhone)
                    ->orderByDesc('id')
                    ->first();
            }

            // 2. Email exact normalized match (nếu chưa match bằng phone)
            if (!$visitor && $normEmail) {
                $visitor = ChatVisitor::where('email_normalized', $normEmail)
                    ->orWhere('email', $normEmail)
                    ->orWhere('email', $safeEmail)
                    ->orderByDesc('id')
                    ->first();
            }

            // 3. Nếu chưa match qua phone/email, kiểm tra cookie chat session hiện tại
            if (!$visitor && $request) {
                $cookieName = config('chat.cookie_name', 'chat_visitor_token');
                $sessionToken = $request->cookie($cookieName);

                if ($sessionToken) {
                    $sessionService = app(VisitorSessionService::class);
                    $session = $sessionService->authenticate($sessionToken);
                    if ($session && $session->visitor) {
                        $visitor = $session->visitor;
                    }
                }

                // Hoặc kiểm tra visitor_uuid truyền từ client nếu có
                if (!$visitor && $request->filled('visitor_uuid')) {
                    $uuid = trim($request->input('visitor_uuid'));
                    $visitor = ChatVisitor::where('visitor_uuid', $uuid)->first();
                }
            }

            // 4. Nếu tìm thấy visitor hiện có -> cập nhật thông tin định danh
            if ($visitor) {
                $updates = [
                    'is_identified' => true,
                    'last_interaction_at' => now(),
                ];

                // Cập nhật normalized phone & email nếu chưa có
                if ($normPhone && empty($visitor->phone_normalized)) {
                    $updates['phone_normalized'] = $normPhone;
                }
                if ($safePhone && (empty($visitor->phone) || $visitor->phone !== $safePhone)) {
                    $updates['phone'] = $safePhone;
                    $updates['phone_normalized'] = $normPhone;
                }

                if ($normEmail && empty($visitor->email_normalized)) {
                    $updates['email_normalized'] = $normEmail;
                }
                if ($safeEmail && (empty($visitor->email) || $visitor->email !== $safeEmail)) {
                    $updates['email'] = $safeEmail;
                    $updates['email_normalized'] = $normEmail;
                }

                // Nguyên tắc ưu tiên tên: Tên thật từ form tư vấn ưu tiên hơn tên tracking tự sinh
                if ($safeName && !$this->isDummyName($safeName)) {
                    if (empty($visitor->name) || $this->isDummyName($visitor->name) || $visitor->name !== $safeName) {
                        $updates['name'] = $safeName;
                    }
                }

                $visitor->update($updates);

                return $visitor;
            }

            // 5. Nếu không match ai và có phone hoặc email -> tạo mới một ChatVisitor đã định danh
            if ($normPhone || $normEmail || $safeName) {
                return ChatVisitor::create([
                    'visitor_uuid' => (string) Str::uuid(),
                    'name' => $safeName ?: 'Khách hàng',
                    'phone' => $safePhone,
                    'phone_normalized' => $normPhone,
                    'email' => $safeEmail,
                    'email_normalized' => $normEmail,
                    'first_ip' => $request?->ip(),
                    'user_agent' => $request ? Str::limit($request->userAgent(), 500, '') : null,
                    'is_identified' => true,
                    'last_interaction_at' => now(),
                ]);
            }

            return null;
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::warning('CustomerIdentityResolver error: ' . $e->getMessage());
            return null;
        }
    }
}
