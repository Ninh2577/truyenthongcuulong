<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TemplateShowcaseController extends Controller
{
    public function index(Request $request): View
    {
        $query = Post::with('category')
            ->where('status', 'published')
            ->whereHas('category', function ($q) {
                $q->where('slug', 'template-website');
            });

        // Filter by selected industry
        $selectedIndustry = $request->input('industry');
        if ($selectedIndustry) {
            $cat = Category::where('slug', $selectedIndustry)->first();
            $keyword = $cat ? $cat->name : $selectedIndustry;

            $industryKeywords = [
                'bat-dong-san' => ['bất động sản', 'nhà đất', 'căn hộ', 'land', 'tower', 'savoye', 'envarch', 'neckle', 'real estate'],
                'ban-le' => ['bán lẻ', 'siêu thị', 'thương mại điện tử', 'shop', 'sản phẩm', 'mart', 'store', 'stationero', 'book', 'ecommerce'],
                'du-lich' => ['du lịch', 'resort', 'khách sạn', 'tour', 'travel', 'holidays', 'stay'],
                'thoi-trang' => ['thời trang', 'mỹ phẩm', 'lookbook', 'vest', 'trang sức', 'kính mắt', 'fashion', 'stylista'],
                'o-to' => ['ô tô', 'xe hơi', 'gara', 'detailing', 'cho thuê xe', 'cứu hộ', 'carpress', 'rentaly'],
                'nong-nghiep' => ['nông nghiệp', 'thực phẩm', 'nông sản', 'thủy hải sản', 'gạo', 'trang trại', 'bacola', 'food'],
                'cong-nghe' => ['công nghệ', 'phần mềm', 'saas', 'ai', 'cyber', 'app', 'it'],
                'y-te' => ['y tế', 'nha khoa', 'bệnh viện', 'phòng khám', 'dược phẩm', 'nhà thuốc'],
                'xay-dung' => ['xây dựng', 'kiến trúc', 'nội thất', 'cons', 'ngoại thất', 'landscape'],
                'doanh-nghiep' => ['doanh nghiệp', 'tập đoàn', 'tư vấn', 'logistics', 'bảo vệ', 'công ty', 'cloudhost'],
                'nha-hang' => ['nhà hàng', 'f&b', 'sushi', 'quán cà phê', 'bánh ngọt', 'trà sữa', 'ẩm thực', 'osteria'],
                'spa-lam-dep' => ['spa', 'thẩm mỹ', 'salon', 'massage', 'make up', 'làm đẹp'],
                'giao-duc' => ['giáo dục', 'đào tạo', 'trường', 'anh ngữ', 'khóa học', 'lập trình', 'mầm non'],
                'tai-chinh' => ['tài chính', 'luật', 'kế toán', 'thuế', 'đầu tư', 'bảo hiểm', 'wallet'],
            ];

            $keywords = $industryKeywords[$selectedIndustry] ?? [$keyword, $selectedIndustry];

            $query->where(function($q) use ($keywords, $selectedIndustry) {
                $q->where('slug', 'like', "%{$selectedIndustry}%");
                foreach ($keywords as $kw) {
                    $q->orWhere('title', 'like', "%{$kw}%")
                      ->orWhere('summary', 'like', "%{$kw}%");
                }
            });
        }

        // Search text
        if ($request->filled('q')) {
            $s = $request->input('q');
            $query->where(function($q) use ($s) {
                $q->where('title', 'like', "%{$s}%")
                  ->orWhere('summary', 'like', "%{$s}%")
                  ->orWhere('slug', 'like', "%{$s}%");
            });
        }

        $allTemplates = Post::where('status', 'published')
            ->whereHas('category', fn($q) => $q->where('slug', 'template-website'))
            ->get(['id', 'title', 'slug', 'summary']);

        $totalCount = $allTemplates->count();

        // Pin the flagship benchmark templates (Neckle, Rentaly, Bacola) to top if on "all"
        if (!$selectedIndustry && !$request->filled('q')) {
            $templates = $query->orderByRaw("CASE 
                WHEN slug = 're2-neckle-real-estate-109' THEN 1
                WHEN slug = 'ca2-rentaly-car-rental' THEN 2
                WHEN slug = 'fo1-bacola-food' THEN 3
                ELSE 4 END")
                ->orderByDesc('published_at')
                ->paginate(12)
                ->withQueryString();
        } else {
            $templates = $query->orderByDesc('published_at')->paginate(12)->withQueryString();
        }

        // Satek style clean pill labels
        $cleanPillNames = [
            'bat-dong-san' => 'Bất động sản',
            'ban-le' => 'Ecommerce',
            'du-lich' => 'Du lịch',
            'thoi-trang' => 'Thời trang',
            'o-to' => 'Xe oto',
            'nong-nghiep' => 'Thực phẩm',
            'cong-nghe' => 'Công nghệ',
            'y-te' => 'Y tế',
            'xay-dung' => 'Xây dựng',
            'doanh-nghiep' => 'Doanh nghiệp',
            'nha-hang' => 'Nhà hàng',
            'spa-lam-dep' => 'Spa làm đẹp',
            'giao-duc' => 'Giáo dục',
            'tai-chinh' => 'Tài chính',
        ];

        $industries = Category::industryFilters()->get();

        $industryCounts = [];
        foreach ($industries as $ind) {
            $keywords = [
                'bat-dong-san' => ['bất động sản', 'nhà đất', 'căn hộ', 'vinland', 'metroland', 'greensky', 'savoye', 'envarch', 'neckle', 'real estate'],
                'xay-dung' => ['xây dựng', 'kiến trúc', 'nội thất', 'nordichome', 'an phát cons', 'ngoại thất', 'landscape'],
                'doanh-nghiep' => ['doanh nghiệp', 'tập đoàn', 'tư vấn', 'logistics', 'bảo vệ', 'công ty', 'cloudhost', 'nexuscrop'],
                'cong-nghe' => ['công nghệ', 'phần mềm', 'saas', 'ai tech', 'cyber', 'cloud platform', 'it solution'],
                'nha-hang' => ['nhà hàng', 'f&b', 'sushi', 'cà phê', 'bánh ngọt', 'trà sữa', 'ẩm thực', 'osteria'],
                'du-lich' => ['du lịch', 'resort', 'khách sạn', 'tour', 'travel', 'holidays', 'stay'],
                'y-te' => ['y tế', 'nha khoa', 'bệnh viện', 'phòng khám', 'dược phẩm', 'nhà thuốc'],
                'giao-duc' => ['giáo dục', 'đào tạo', 'trường', 'anh ngữ', 'khóa học', 'lập trình', 'mầm non'],
                'thoi-trang' => ['thời trang', 'mỹ phẩm', 'lookbook', 'vest', 'trang sức', 'kính mắt', 'fashion', 'stylista'],
                'spa-lam-dep' => ['spa', 'thẩm mỹ', 'salon', 'massage', 'make up', 'làm đẹp'],
                'ban-le' => ['bán lẻ', 'siêu thị', 'thương mại điện tử', 'cửa hàng', 'mart', 'store', 'stationero', 'sách', 'ecommerce'],
                'tai-chinh' => ['tài chính', 'luật', 'kế toán', 'thuế', 'đầu tư', 'bảo hiểm', 'wallet'],
                'o-to' => ['ô tô', 'xe hơi', 'gara', 'detailing', 'cho thuê xe', 'cứu hộ', 'carpress', 'rentaly'],
                'nong-nghiep' => ['nông nghiệp', 'thực phẩm', 'nông sản', 'thủy hải sản', 'gạo', 'trang trại', 'bacola', 'food'],
            ][$ind->slug] ?? [$ind->name, $ind->slug];

            $industryCounts[$ind->slug] = $allTemplates->filter(function($item) use ($keywords, $ind) {
                if (str_contains($item->slug, $ind->slug)) return true;
                foreach ($keywords as $kw) {
                    if (mb_stripos($item->title, $kw) !== false || mb_stripos($item->summary, $kw) !== false) {
                        return true;
                    }
                }
                return false;
            })->count();
        }

        return view('templates.index', compact('templates', 'industries', 'selectedIndustry', 'totalCount', 'industryCounts', 'cleanPillNames'));
    }

    /**
     * Show template detail or live demo viewer
     */
    public function show(Request $request, string $slug): View
    {
        $cleanSlug = preg_replace('/\.html$/i', '', $slug);

        $template = Post::with('category')
            ->where('status', 'published')
            ->where(function($q) use ($cleanSlug, $slug) {
                $q->where('slug', $cleanSlug)
                  ->orWhere('slug', $slug);
            })
            ->first();

        if (!$template) {
            $template = Post::where('status', 'published')
                ->where('slug', 'like', "%{$cleanSlug}%")
                ->first();
        }

        if (!$template) {
            $template = Post::where('status', 'published')
                ->whereHas('category', fn($q) => $q->where('slug', 'template-website'))
                ->firstOrFail();
        }

        // Related templates for showcase
        $relatedTemplates = Post::where('status', 'published')
            ->whereHas('category', fn($q) => $q->where('slug', 'template-website'))
            ->where('id', '!=', $template->id)
            ->inRandomOrder()
            ->take(3)
            ->get();

        // If ?view=demo is requested, render the dedicated Full-screen Demo Viewer (Satek Style)
        if ($request->input('view') === 'demo') {
            return view('templates.demo_viewer', compact('template', 'relatedTemplates'));
        }

        // Otherwise render standard high-conversion Template Detail Page
        return view('templates.show', compact('template', 'relatedTemplates'));
    }

    /**
     * Render the standalone live demo preview inside the iframe
     */
    public function preview(Request $request, string $slug): View
    {
        $cleanSlug = preg_replace('/\.html$/i', '', $slug);

        $template = Post::with('category')
            ->where('status', 'published')
            ->where(function($q) use ($cleanSlug, $slug) {
                $q->where('slug', $cleanSlug)
                  ->orWhere('slug', $slug);
            })
            ->first();

        if (!$template) {
            $template = Post::where('status', 'published')
                ->where('slug', 'like', "%{$cleanSlug}%")
                ->first();
        }

        if (!$template) {
            $template = Post::where('status', 'published')
                ->whereHas('category', fn($q) => $q->where('slug', 'template-website'))
                ->firstOrFail();
        }

        return view('templates.live_preview', compact('template'));
    }
}
