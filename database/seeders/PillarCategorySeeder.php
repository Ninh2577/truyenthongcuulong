<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Post;

class PillarCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Ánh xạ tường minh cho các danh mục cha và danh mục chính
        $pillarMappings = [
            // Trụ cột 1: Tech Lab (Web & Nền tảng số)
            'cong-nghe-giai-phap' => ['pillar' => 'tech', 'order' => 10, 'is_filter' => false],
            'thiet-ke-website'     => ['pillar' => 'tech', 'order' => 11, 'is_filter' => false],
            'website-seo'          => ['pillar' => 'tech', 'order' => 12, 'is_filter' => false],
            'cong-nghe'            => ['pillar' => 'tech', 'order' => 13, 'is_filter' => false],
            'template-website'     => ['pillar' => 'tech', 'order' => 14, 'is_filter' => false],
            'kien-thuc'            => ['pillar' => 'tech', 'order' => 15, 'is_filter' => false],
            'tin-tuc'              => ['pillar' => 'tech', 'order' => 16, 'is_filter' => false],
            'kien-thuc-tin-tuc'    => ['pillar' => 'tech', 'order' => 17, 'is_filter' => false],

            // Trụ cột 2: Studio (Quay Phim & Media)
            'truyen-thong'         => ['pillar' => 'studio', 'order' => 20, 'is_filter' => false],
            'media'                => ['pillar' => 'studio', 'order' => 21, 'is_filter' => false],
            'socical-media'        => ['pillar' => 'studio', 'order' => 22, 'is_filter' => false],

            // Trụ cột 3: Agency (Digital Marketing & PR Ads)
            'chia-se'              => ['pillar' => 'agency', 'order' => 30, 'is_filter' => false],
            'marketing-online'     => ['pillar' => 'agency', 'order' => 31, 'is_filter' => false],
            'tu-van-marketing'     => ['pillar' => 'agency', 'order' => 32, 'is_filter' => false],
            'quang-cao'            => ['pillar' => 'agency', 'order' => 33, 'is_filter' => false],

            // Trụ cột 4: Resource (Download & Tài nguyên)
            'tai-nguyen-tuyen-dung'=> ['pillar' => 'resource', 'order' => 40, 'is_filter' => false],
            'abc'                  => ['pillar' => 'resource', 'order' => 41, 'is_filter' => false], // Download Center

            // Trụ cột 5: Corporate (Tuyển dụng & Doanh nghiệp)
            'tuyen-dung'           => ['pillar' => 'corporate', 'order' => 50, 'is_filter' => false],

            // 13 Danh mục ngành nghề cũ -> đánh dấu is_industry_filter = true
            'bat-dong-san'         => ['pillar' => null, 'order' => 101, 'is_filter' => true],
            'thoi-trang'           => ['pillar' => null, 'order' => 102, 'is_filter' => true],
            'doanh-nghiep'         => ['pillar' => null, 'order' => 103, 'is_filter' => true],
            'blog-tin-tuc'         => ['pillar' => null, 'order' => 104, 'is_filter' => true],
            'nha-hang-khach-san'   => ['pillar' => null, 'order' => 105, 'is_filter' => true],
            'giao-duc'             => ['pillar' => null, 'order' => 106, 'is_filter' => true],
            'suc-khoe-lam-dep'     => ['pillar' => null, 'order' => 107, 'is_filter' => true],
            'do-gia-dung'          => ['pillar' => null, 'order' => 108, 'is_filter' => true],
            'noi-that-trang-tri'   => ['pillar' => null, 'order' => 109, 'is_filter' => true],
            'sach-van-phong-pham'  => ['pillar' => null, 'order' => 110, 'is_filter' => true],
            'o-to-xe-may'          => ['pillar' => null, 'order' => 111, 'is_filter' => true],
            'the-thao-du-lich'     => ['pillar' => null, 'order' => 112, 'is_filter' => true],
        ];

        foreach ($pillarMappings as $slug => $data) {
            DB::table('categories')
                ->where('slug', $slug)
                ->update([
                    'pillar_group' => $data['pillar'],
                    'display_order' => $data['order'],
                    'is_industry_filter' => $data['is_filter'],
                ]);
        }

        // Đổi tên dễ đọc cho 'abc' thành 'Download Center' nếu cần
        DB::table('categories')->where('slug', 'abc')->update(['name' => 'Download Center']);

        // 2. Xử lý thủ công 6 bài viết "chưa phân loại" (thuộc cat 5 và cat 6)
        $reassigned = [
            13872 => 'abc',               // [DOWNLOAD_CENTER] KREDIVO -> Download Center (resource)
            17141 => 'chia-se',           // Hành trình xuyên rừng trekking Tà Đùng -> Chia sẻ (agency)
            19605 => 'kien-thuc',         // Bai viet thu nghiem tu Cuu Long ERP -> Kiến thức (tech)
            689   => 'tin-tuc',           // Giới thiệu về Công ty Truyền thông Cửu Long -> Tin tức (corporate/tech)
            3917  => 'marketing-online',  // Sự khác biệt giữa Marketing Online và Content Writer -> Marketing Online (agency)
            6287  => 'thiet-ke-website',   // 3 thành phần cơ bản của website -> Thiết kế website (tech)
        ];

        foreach ($reassigned as $postId => $targetSlug) {
            $catId = DB::table('categories')->where('slug', $targetSlug)->value('id');
            if ($catId) {
                DB::table('posts')->where('id', $postId)->update(['category_id' => $catId]);
            }
        }

        // Đặt pillar cho 2 danh mục 5 & 6 để an toàn
        DB::table('categories')->where('id', 5)->update(['pillar_group' => 'tech', 'display_order' => 99]);
        DB::table('categories')->where('id', 6)->update(['pillar_group' => 'tech', 'display_order' => 99]);

        // 3. In log tổng kết kiểm tra
        $summary = DB::table('posts')
            ->join('categories', 'posts.category_id', '=', 'categories.id')
            ->select('categories.pillar_group', DB::raw('count(posts.id) as total'))
            ->groupBy('categories.pillar_group')
            ->get();

        echo "\n=== BÁO CÁO ÁNH XẠ PILLAR GROUP CHO 488 BÀI VIẾT ===\n";
        $totalAll = 0;
        foreach ($summary as $row) {
            echo sprintf("• Pillar: %-12s => %3d bài viết\n", $row->pillar_group ?? 'NULL', $row->total);
            $totalAll += $row->total;
        }
        echo "-----------------------------------------------------\n";
        echo "Tổng cộng bài viết: {$totalAll} bài (Mục tiêu chuẩn: 488 bài)\n\n";

        // Kiểm tra bài viết mồ côi (nếu có)
        $orphan = DB::table('posts')
            ->leftJoin('categories', 'posts.category_id', '=', 'categories.id')
            ->whereNull('categories.pillar_group')
            ->count();
        echo "Số bài viết thiếu pillar_group: {$orphan} bài\n";
    }
}
