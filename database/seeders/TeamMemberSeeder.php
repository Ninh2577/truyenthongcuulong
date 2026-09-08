<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TeamMember;

class TeamMemberSeeder extends Seeder
{
    public function run(): void
    {
        TeamMember::truncate();

        // =========================================================================
        // CẢNH BÁO QUAN TRỌNG TỪ QUẢN TRỊ VIÊN:
        // 4 nhân sự dưới đây là DỮ LIỆU MẪU (placeholder/mock data) phục vụ dựng layout.
        // BẮT BUỘC PHẢI THAY THẾ bằng danh sách nhân sự thật (Họ tên, chức danh,
        // tiểu sử, ảnh chân dung thật) trước khi phát hành Đợt 3 lên production.
        // =========================================================================
        $members = [
            [
                'name' => 'Lê Quang Ninh',
                'role' => 'Tổng Đạo Diễn & Giám Đốc Sáng Tạo (CCO)',
                'photo' => null,
                'bio' => 'Hơn 12 năm kinh nghiệm chỉ đạo sản xuất TVC, phim tài liệu doanh nghiệp và chiến dịch truyền thông đa kênh quốc gia.',
                'order' => 1,
            ],
            [
                'name' => 'Trần Nhật Hoàng',
                'role' => 'Giám Đốc Công Nghệ (CTO & Lead Architect)',
                'bio' => 'Chuyên gia kiến trúc hệ thống phân tán, bảo mật đám mây và ứng dụng trí tuệ nhân tạo (AI/NLP) tối ưu hóa vận hành doanh nghiệp.',
                'photo' => null,
                'order' => 2,
            ],
            [
                'name' => 'Nguyễn Mai Phương',
                'role' => 'Giám Đốc Tiếp Thị & Tăng Trưởng (CMO)',
                'bio' => 'Cựu chuyên gia hoạch định truyền thông cấp cao tại các agency hàng đầu, phụ trách chiến lược PR Báo chí và Performance Ads.',
                'photo' => null,
                'order' => 3,
            ],
            [
                'name' => 'Vũ Đình Khoa',
                'role' => 'Trưởng Phòng Hậu Kỳ & Kỹ Xảo 3D/VFX',
                'bio' => 'Chứng chỉ DaVinci Resolve Master Trainer, chuyên gia chỉnh màu HDR và dựng hình 3D Motion quảng cáo sản phẩm.',
                'photo' => null,
                'order' => 4,
            ],
        ];

        foreach ($members as $m) {
            TeamMember::create($m);
        }
    }
}
