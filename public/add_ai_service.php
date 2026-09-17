<?php
require __DIR__."/../vendor/autoload.php";
$app = require_once __DIR__."/../bootstrap/app.php";
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

\App\Models\Service::updateOrCreate(
    ['slug' => 'tich-hop-ai-solutions'],
    [
        'title' => '3D Motion Design & AI Studio',
        'group' => 'technology',
        'icon' => 'heroicon-o-sparkles',
        'summary' => 'Dịch vụ thiết kế 3D Motion chuyên nghiệp và ứng dụng công nghệ AI tiên tiến.',
        'content' => '<p>Tổ hợp thiết kế 3D Motion chuyên nghiệp kết hợp cùng trung tâm xử lý AI. Chúng tôi cung cấp các giải pháp tiên tiến nhất về diễn họa 3D và ứng dụng trí tuệ nhân tạo vào quy trình sản xuất Media. Đội ngũ kỹ sư và nghệ sĩ 3D của Truyền Thông Cửu Long cam kết mang lại những sản phẩm hình ảnh mãn nhãn, tự động hóa quy trình, giúp doanh nghiệp bứt phá trong kỷ nguyên số.</p>'
    ]
);
echo "Added AI Studio service";
