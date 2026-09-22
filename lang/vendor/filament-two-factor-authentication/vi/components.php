<?php

return [
    'enable' => [
        'header' => 'Bạn chưa kích hoạt xác thực hai yếu tố (2FA).',
        'description' => 'Khi xác thực hai yếu tố được kích hoạt, bạn sẽ được yêu cầu nhập mã bảo mật OTP ngẫu nhiên trong mỗi lần đăng nhập. Bạn có thể lấy mã này từ ứng dụng Google Authenticator trên điện thoại của mình.',
    ],
    'logout' => [
        'button' => 'Đăng xuất',
    ],
    'enabled' => [
        'header' => 'Bạn đã kích hoạt thành công xác thực hai yếu tố (2FA).',
        'description' => 'Vui lòng lưu trữ các mã khôi phục dự phòng bên dưới vào nơi an toàn. Các mã này được sử dụng để lấy lại quyền truy cập vào tài khoản nếu bạn bị mất thiết bị xác thực hai yếu tố.',
    ],
    'setup_confirmation' => [
        'header' => 'Hoàn tất kích hoạt xác thực hai yếu tố.',
        'description' => 'Khi xác thực hai yếu tố được bật, hệ thống sẽ yêu cầu mã OTP bảo mật mỗi khi đăng nhập. Bạn có thể lấy mã này từ ứng dụng Google Authenticator.',
        'scan_qr_code' => 'Để hoàn tất kích hoạt, hãy quét mã QR bên dưới bằng ứng dụng Google Authenticator hoặc nhập khóa thiết lập (Setup Key) thủ công, sau đó nhập mã OTP 6 chữ số để xác nhận.',
    ],
    'base' => [
        'wrong_user' => 'Đối tượng người dùng đã xác thực phải là Filament Auth model.',
        'rate_limit_exceeded' => 'Quá nhiều yêu cầu thao tác',
        'try_again' => 'Vui lòng thử lại sau :seconds giây',
    ],
    '2fa' => [
        'confirm' => 'Xác nhận kích hoạt',
        'cancel' => 'Hủy bỏ',
        'enable' => 'Bắt đầu kích hoạt 2FA',
        'disable' => 'Tắt xác thực 2FA',
        'confirm_password' => 'Xác nhận mật khẩu tài khoản',
        'wrong_password' => 'Mật khẩu tài khoản đã nhập không chính xác.',
        'code' => 'Nhập mã xác thực (OTP 6 số)',
        'setup_key' => 'Khóa thiết lập thủ công: :setup_key',
        'current_password' => 'Mật khẩu hiện tại',
        'regenerate_recovery_codes' => 'Tạo lại bộ mã khôi phục mới',
    ],
    'passkey' => [
        'add' => 'Tạo khóa truy cập (Passkey)',
        'name' => 'Tên khóa truy cập',
        'added' => 'Đã thêm khóa truy cập Passkey thành công.',
        'login' => 'Đăng nhập bằng Passkey',
    ],
];
