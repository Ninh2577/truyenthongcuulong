<?php

use App\Models\PricingPlan;

$descriptions = [
    1 => 'Tối ưu cho TikTok, Facebook Reels, YouTube Shorts thu hút tương tác tự nhiên và chuyển đổi nhanh.',
    2 => 'Nâng tầm vị thế thương hiệu với quy trình tiền kỳ, quay dựng chuẩn điện ảnh 4K ProRes và Flycam không giới hạn.',
    3 => 'Chiến dịch truyền thông quy mô lớn, kỹ xảo 3D CGI tinh xảo và đạo diễn danh tiếng trực tiếp chỉ đạo tiền kỳ.',
    4 => 'Tối ưu chuyên sâu cho phễu bán hàng, chạy quảng cáo Google Ads, Meta Ads và TikTok Ads chuyển đổi cao.',
    5 => 'Website doanh nghiệp cao cấp xây trên Laravel/WordPress hiện đại, bảo mật đa lớp và cấu trúc SEO On-Page tự động.',
    6 => 'Hệ thống ứng dụng di động Flutter (iOS/Android) hoặc nền tảng quản trị ERP/CRM tích hợp trợ lý AI thông minh.',
    7 => 'Tập trung tối ưu 1 kênh quảng cáo mạnh nhất (Google Search hoặc Meta Ads) để tạo dòng khách hàng đều đặn.',
    8 => 'Kết hợp đồng bộ Ads (Google + Meta + TikTok) và sản xuất tư liệu video sáng tạo giúp tối ưu chi phí chuyển đổi.',
    9 => 'Thay thế toàn bộ phòng Marketing in-house với đầy đủ Senior Planner, Content Creator, Designer, Media Buyer và Ekip quay dựng.'
];

foreach ($descriptions as $id => $desc) {
    PricingPlan::where('id', $id)->update(['description' => $desc]);
}

echo "Descriptions updated successfully\n";
