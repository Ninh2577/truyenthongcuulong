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
                'dich-vu' => ['dịch vụ', 'tư vấn', 'service', 'agency', 'consulting', 'cleaning', 'bảo vệ', 'sửa chữa', 'ser1', 'dich-vu'],
                'khac' => ['thời trang', 'mỹ phẩm', 'spa', 'ô tô', 'nông nghiệp', 'tài chính', 'xây dựng', 'kiến trúc'],
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

        $variant = $this->determineLayoutVariant($template->slug, $template->title);

        return view('templates.live_preview', compact('template', 'variant'));
    }

    /**
     * Resolve unique layout variant for each template/industry
     */
    protected function determineLayoutVariant(string $slug, string $title): string
    {
        $s = mb_strtolower($slug . ' ' . $title);

        // 1. Exact Neckle Real Estate
        if (str_contains($s, 'neckle') || str_contains($s, 're2-neckle')) {
            return 'neckle_real_estate';
        }

        // 2. Vinland Luxury Villa & Resort Estate (Dark Gold Luxury)
        if (str_contains($s, 'vinland') || str_contains($s, 'dinh-thu') || str_contains($s, 'luxury') || str_contains($s, 'manor') || str_contains($s, 'savoye')) {
            return 'luxury_villa_estate';
        }

        // 3. Apartment & High-Rise Condo Tower (GreenSky)
        if (str_contains($s, 'chung-cu') || str_contains($s, 'can-ho') || str_contains($s, 'greensky') || str_contains($s, 'tower') || str_contains($s, 'sky-view')) {
            return 'apartment_condo_tower';
        }

        // 4. Real Estate Listing & MLS Brokerage (MetroLand)
        if (str_contains($s, 'metroland') || str_contains($s, 'san-giao-dich') || str_contains($s, 'bat-dong-san') || str_contains($s, 'nha-dat')) {
            return 'brokerage_portal';
        }

        // 5. School, Academy & Education (Global Pathway)
        if (str_contains($s, 'truong-song-ngu') || str_contains($s, 'global-pathway') || str_contains($s, 'truong-hoc') || str_contains($s, 'mam-non') || str_contains($s, 'giao-duc') || str_contains($s, 'ielts') || str_contains($s, 'hoc-vien') || str_contains($s, 'codeacademy') || str_contains($s, 'bridgeedu')) {
            return 'international_school';
        }

        // 6. Pet Shop & Spa (PetParadise)
        if (str_contains($s, 'thu-cung') || str_contains($s, 'pet') || str_contains($s, 'cho-meo') || str_contains($s, 'petparadise')) {
            return 'pet_shop_spa';
        }

        // 7. Automotive, Car Rental & Detailing (Rentaly / AutoPrime / ProDetailing)
        if (str_contains($s, 'rentaly') || str_contains($s, 'cho-thue-xe') || str_contains($s, 'quickrent') || str_contains($s, 'o-to') || str_contains($s, 'autoprime') || str_contains($s, 'detailing') || str_contains($s, 'xe-hoi')) {
            return 'car_rental';
        }

        // 8. Architecture, Interior & Construction (NordicHome / An Phát Cons / Landscape)
        if (str_contains($s, 'nordichome') || str_contains($s, 'an-phat') || str_contains($s, 'kien-truc') || str_contains($s, 'noi-that') || str_contains($s, 'xay-dung') || str_contains($s, 'landscape') || str_contains($s, 'worksmart')) {
            return 'construction_interior';
        }

        // 9. Luxury Resort, Hotel & Travel / Camping
        if (str_contains($s, 'resort') || str_contains($s, 'pearl-island') || str_contains($s, 'khach-san') || str_contains($s, 'du-lich') || str_contains($s, 'tour') || str_contains($s, 'stay') || str_contains($s, 'viettraveler') || str_contains($s, 'wildcamp') || str_contains($s, 'trekking') || str_contains($s, 'cam-trai')) {
            return 'resort_travel';
        }

        // 10. Restaurant & Fine Dining (Sakura Sushi / Prime Steak / F&B)
        if (str_contains($s, 'nha-hang') || str_contains($s, 'sushi') || str_contains($s, 'steak') || str_contains($s, 'fine-dining') || str_contains($s, 'am-thuc') || str_contains($s, 'osteria') || str_contains($s, 'artisan-roast') || str_contains($s, 'sweetdelight') || str_contains($s, 'bobatea') || str_contains($s, 'tra-sua') || str_contains($s, 'ca-phe')) {
            return 'restaurant_fine_dining';
        }

        // 11. Dental Care & Smile Aesthetics (DentalCare)
        if ((str_contains($s, 'nha-khoa') || str_contains($s, 'dental') || str_contains($s, 'nieng-rang') || str_contains($s, 'rang-su')) && !str_contains($s, 'trang-suc')) {
            return 'dental_care';
        }

        // 12. Hospital & Clinic Healthcare (CarePlus / BabyCare)
        if (str_contains($s, 'benh-vien') || str_contains($s, 'phong-kham') || str_contains($s, 'y-te') || str_contains($s, 'careplus') || str_contains($s, 'babycare') || str_contains($s, 'duoc') || str_contains($s, 'pharmamart')) {
            return 'hospital_clinic';
        }

        // 13. E-Commerce & Retail Products (Bacola / FreshFarm / EcoSnack / Fashion / Products)
        if (str_contains($s, 'bacola') || str_contains($s, 'freshfarm') || str_contains($s, 'sieu-thi') || str_contains($s, 'thuc-pham') || str_contains($s, 'nong-san') || str_contains($s, 'tap-hoa') || str_contains($s, 'ecosnack') || str_contains($s, 'ricegold') || str_contains($s, 'trang-suc') || str_contains($s, 'jewelry') || str_contains($s, 'thoi-trang') || str_contains($s, 'my-pham') || str_contains($s, 'purebotanics') || str_contains($s, 'visionoptic') || str_contains($s, 'kinh-mat') || str_contains($s, 'smarthome') || str_contains($s, 'kidsworld') || str_contains($s, 'proathlete') || str_contains($s, 'harmony-music') || str_contains($s, 'bloomflorist')) {
            return 'ecommerce_grocery';
        }

        // 14. Tech, SaaS, AI & Software (DevCloud / SynapseAI / CyberGuard / HRNext / Apps)
        if (str_contains($s, 'devcloud') || str_contains($s, 'saas') || str_contains($s, 'synapseai') || str_contains($s, 'tri-tue-nhan-tao') || str_contains($s, 'cyberguard') || str_contains($s, 'an-ninh-mang') || str_contains($s, 'phan-mem') || str_contains($s, 'cong-nghe') || str_contains($s, 'hrnext') || str_contains($s, 'smartfin') || str_contains($s, 'visionlab')) {
            return 'tech_saas';
        }

        // 15. Default fallback: Corporate Holding & Enterprise B2B
        return 'corporate_b2b';
    }
}
