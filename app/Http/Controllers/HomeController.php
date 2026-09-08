<?php

namespace App\Http\Controllers;

use App\Models\CaseStudy;
use App\Models\Category;
use App\Models\Post;
use App\Models\Service;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $mediaServices = Service::where('group', 'media')->where('featured', true)->orderBy('order')->get();
        $techServices = Service::where('group', 'technology')->where('featured', true)->orderBy('order')->get();
        $caseStudies = CaseStudy::where('featured', true)->orderBy('order')->take(4)->get();
        $latestPosts = Post::with('category')->where('status', 'published')->orderByDesc('published_at')->take(6)->get();

        // Query các dự án sự kiện thật từ database cũ (VERIFIED CLIENT SHOWCASE)
        $clientProjects = Post::whereIn('id', [14068, 14064, 13905, 13902, 13886])->get();

        // Query các bài viết chuyên sâu về SEO & Thiết kế Web từ database cũ
        $featuredArticles = Post::whereIn('id', [19566, 3064, 19595])
            ->orWhere(function($query) {
                $query->where('title', 'LIKE', '%SEO Cần Thơ%')
                      ->orWhere('title', 'LIKE', '%Thiết Kế Website%');
            })
            ->where('status', 'published')
            ->orderByDesc('published_at')
            ->take(3)
            ->get();

        // Danh mục 13 ngành nghề cho Kho Giao Diện Website Demo
        $industryMap = [
            'bat-dong-san' => 'Bất Động Sản',
            'nha-hang-khach-san' => 'F&B - Nhà Hàng',
            'noi-that-trang-tri' => 'Nội Thất - Nhà Cửa',
            'thu-cung' => 'Thú Cưng (Pet Shop)',
            'thoi-trang' => 'Thời Trang',
            'giao-duc' => 'Giáo Dục',
            'suc-khoe-lam-dep' => 'Y Tế - Thẩm Mỹ',
            'the-thao-du-lich' => 'Du Lịch',
            'doanh-nghiep' => 'Doanh Nghiệp',
            'cong-nghe' => 'Công Nghệ',
            'do-gia-dung' => 'Đồ Gia Dụng',
            'o-to-xe-may' => 'Ô Tô - Xe Máy',
            'sach-van-phong-pham' => 'Sách - Văn Phòng Phẩm',
            'blog-tin-tuc' => 'Blog - Tin Tức',
        ];

        // 39 bài template-website đã import gán pillar_group=tech
        $websiteTemplates = Post::where('category_id', 18)
            ->where('status', 'published')
            ->orderBy('id')
            ->get()
            ->map(function ($p) use ($industryMap) {
                $slug = $p->slug;
                $ind = 'doanh-nghiep'; // fallback
                if (strpos($slug, 'bat-dong-san') !== false) $ind = 'bat-dong-san';
                elseif (strpos($slug, 'thoi-trang') !== false) $ind = 'thoi-trang';
                elseif (strpos($slug, 'doanh-nghiep') !== false) $ind = 'doanh-nghiep';
                elseif (strpos($slug, 'tin-tuc') !== false || strpos($slug, 'blog') !== false) $ind = 'blog-tin-tuc';
                elseif (strpos($slug, 'nha-hang') !== false || strpos($slug, 'khach-san') !== false) $ind = 'nha-hang-khach-san';
                elseif (strpos($slug, 'giao-duc') !== false) $ind = 'giao-duc';
                elseif (strpos($slug, 'cong-nghe') !== false) $ind = 'cong-nghe';
                elseif (strpos($slug, 'suc-khoe') !== false || strpos($slug, 'lam-dep') !== false) $ind = 'suc-khoe-lam-dep';
                elseif (strpos($slug, 'do-gia-dung') !== false) $ind = 'do-gia-dung';
                elseif (strpos($slug, 'du-lich') !== false || strpos($slug, 'the-thao') !== false) $ind = 'the-thao-du-lich';
                elseif (strpos($slug, 'noi-that') !== false) $ind = 'noi-that-trang-tri';
                elseif (strpos($slug, 'o-to') !== false || strpos($slug, 'xe-may') !== false) $ind = 'o-to-xe-may';
                elseif (strpos($slug, 'sach') !== false || strpos($slug, 'van-phong') !== false) $ind = 'sach-van-phong-pham';
                elseif (strpos($slug, 'thu-cung') !== false || strpos($slug, 'pet') !== false) $ind = 'thu-cung';

                $p->industry_slug = $ind;
                $p->industry_name = $industryMap[$ind] ?? 'Chung';
                $p->clean_title = preg_replace('/^(Mẫu website|Mấu website|Mẫu trang web)\s+/ui', '', $p->title);
                return $p;
            });

        // Xây dựng danh sách chip filter theo ngành (chỉ hiển thị ngành có template, ngành 0 bài tạm ẩn)
        $industryFilters = [];
        foreach ($industryMap as $slug => $name) {
            $count = $websiteTemplates->where('industry_slug', $slug)->count();
            $industryFilters[] = [
                'slug' => $slug,
                'name' => $name,
                'count' => $count,
                'has_templates' => ($count > 0),
            ];
        }

        return view('home', compact(
            'mediaServices', 
            'techServices', 
            'caseStudies', 
            'latestPosts', 
            'clientProjects', 
            'featuredArticles',
            'websiteTemplates',
            'industryFilters'
        ));
    }
}