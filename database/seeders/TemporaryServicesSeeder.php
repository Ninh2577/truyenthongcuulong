<?php
use App\Models\Service;
use App\Enums\PillarGroup;
use Illuminate\Support\Str;

$services = [
    [
        'title' => 'Sản Xuất Phim Doanh Nghiệp',
        'group' => PillarGroup::Media->value,
        'icon' => 'heroicon-o-video-camera',
        'summary' => 'Dịch vụ quay dựng video giới thiệu công ty chất lượng 4K.',
        'content' => '<p>Dịch vụ quay dựng video giới thiệu công ty chất lượng 4K. Kịch bản sáng tạo, thiết bị hiện đại.</p>'
    ],
    [
        'title' => 'Thiết Kế Website',
        'group' => PillarGroup::Technology->value,
        'icon' => 'heroicon-o-computer-desktop',
        'summary' => 'Thiết kế website doanh nghiệp chuẩn SEO, kiến trúc clean-code.',
        'content' => '<p>Thiết kế website doanh nghiệp chuẩn SEO, kiến trúc clean-code. Bàn giao mã nguồn đầy đủ, bảo hành trọn đời.</p>'
    ],
    [
        'title' => 'Marketing Tổng Thể',
        'group' => PillarGroup::Marketing->value,
        'icon' => 'heroicon-o-megaphone',
        'summary' => 'Xây dựng chiến lược và thực thi các chiến dịch truyền thông số.',
        'content' => '<p>Xây dựng chiến lược và thực thi các chiến dịch truyền thông số mang lại hiệu quả chuyển đổi cao nhất.</p>'
    ]
];

foreach ($services as $s) {
    Service::firstOrCreate(['slug' => Str::slug($s['title'])], $s);
}

echo "Done\n";
