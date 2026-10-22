<?php

namespace App\Services;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;

class MailConfigService
{
    /**
     * Apply dynamic mail configuration from settings or .env.
     */
    public static function applyConfig(): void
    {
        $mailer = get_setting('mail_mailer', env('MAIL_MAILER', 'log'));

        if ($mailer === 'smtp') {
            $host = get_setting('mail_host', env('MAIL_HOST', 'smtp.gmail.com'));
            $port = (int) get_setting('mail_port', env('MAIL_PORT', 587));
            $encryption = get_setting('mail_encryption', env('MAIL_ENCRYPTION', 'tls'));
            if ($encryption === 'none' || $encryption === 'null' || empty($encryption)) {
                $encryption = null;
            }
            $username = get_setting('mail_username', env('MAIL_USERNAME'));
            $password = get_setting('mail_password', env('MAIL_PASSWORD'));
            $fromAddress = get_setting('mail_from_address', env('MAIL_FROM_ADDRESS', 'lienhe@truyenthongcuulong.com'));
            $fromName = get_setting('mail_from_name', env('MAIL_FROM_NAME', 'Truyền Thông Cửu Long'));

            Config::set('mail.default', 'smtp');
            Config::set('mail.mailers.smtp.transport', 'smtp');
            Config::set('mail.mailers.smtp.host', $host);
            Config::set('mail.mailers.smtp.port', $port);
            Config::set('mail.mailers.smtp.encryption', $encryption);
            Config::set('mail.mailers.smtp.username', $username);
            Config::set('mail.mailers.smtp.password', $password);
            Config::set('mail.from.address', $fromAddress);
            Config::set('mail.from.name', $fromName);

            // Purge cached mailer so Laravel rebuilds the transport
            Mail::purge('smtp');
        } else {
            Config::set('mail.default', 'log');
        }
    }

    /**
     * Test sending email and return result.
     *
     * @return array{success: bool, message: string}
     */
    public static function sendTestEmail(string $toEmail): array
    {
        self::applyConfig();

        if (config('mail.default') === 'log') {
            return [
                'success' => false,
                'message' => 'Hệ thống đang ở chế độ MAIL_MAILER=log. Vui lòng chuyển sang SMTP và điền Host, Port, Username, Password để gửi email thực tế.',
            ];
        }

        try {
            Mail::raw("Kính gửi Quý khách,\n\nĐây là email kiểm tra cấu hình SMTP từ hệ thống Truyền Thông Cửu Long.\nThời gian gửi: " . now()->format('d/m/Y H:i:s') . "\n\nNếu bạn nhận được email này, tính năng gửi email đã hoạt động chính xác 100%!", function ($message) use ($toEmail) {
                $fromAddress = config('mail.from.address') ?: 'lienhe@truyenthongcuulong.com';
                $fromName = config('mail.from.name') ?: 'Truyền Thông Cửu Long';

                $message->from($fromAddress, $fromName)
                    ->to($toEmail)
                    ->subject('[Truyền Thông Cửu Long] Kiểm tra kết nối SMTP thành công');
            });

            return [
                'success' => true,
                'message' => 'Đã gửi email thử nghiệm thành công đến: ' . $toEmail . '. Vui lòng kiểm tra hộp thư đến (Inbox) hoặc Spam.',
            ];
        } catch (\Throwable $e) {
            return [
                'success' => false,
                'message' => 'Lỗi kết nối máy chủ SMTP: ' . $e->getMessage(),
            ];
        }
    }
}
