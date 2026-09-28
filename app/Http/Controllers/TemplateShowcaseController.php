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
                'bat-dong-san' => ['bất động sản', 'nhà đất', 'căn hộ', 'land', 'tower', 'savoye', 'envarch'],
                'xay-dung' => ['xây dựng', 'kiến trúc', 'nội thất', 'cons', 'ngoại thất', 'landscape'],
                'doanh-nghiep' => ['doanh nghiệp', 'tập đoàn', 'tư vấn', 'logistics', 'bảo vệ', 'công ty', 'cloudhost'],
                'cong-nghe' => ['công nghệ', 'phần mềm', 'saas', 'ai', 'cyber', 'app', 'it'],
                'nha-hang' => ['nhà hàng', 'f&b', 'sushi', 'quán cà phê', 'bánh ngọt', 'trà sữa', 'ẩm thực', 'osteria'],
                'du-lich' => ['du lịch', 'resort', 'khách sạn', 'tour', 'travel', 'holidays', 'stay'],
                'y-te' => ['y tế', 'nha khoa', 'bệnh viện', 'phòng khám', 'dược phẩm', 'nhà thuốc'],
                'giao-duc' => ['giáo dục', 'đào tạo', 'trường', 'anh ngữ', 'khóa học', 'lập trình', 'mầm non'],
                'thoi-trang' => ['thời trang', 'mỹ phẩm', 'lookbook', 'vest', 'trang sức', 'kính mắt', 'fashion', 'stylista'],
                'spa-lam-dep' => ['spa', 'thẩm mỹ', 'salon', 'massage', 'make up', 'làm đẹp'],
                'ban-le' => ['bán lẻ', 'siêu thị', 'thương mại điện tử', 'shop', 'sản phẩm', 'mart', 'store', 'stationero', 'book'],
                'tai-chinh' => ['tài chính', 'luật', 'kế toán', 'thuế', 'đầu tư', 'bảo hiểm', 'wallet'],
                'o-to' => ['ô tô', 'xe hơi', 'gara', 'detailing', 'cho thuê xe', 'cứu hộ', 'carpress'],
                'nong-nghiep' => ['nông nghiệp', 'thực phẩm', 'nông sản', 'thủy hải sản', 'gạo', 'trang trại'],
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
            $query->where('title', 'like', "%{$s}%");
        }

        $templates = $query->orderByDesc('published_at')->paginate(12)->withQueryString();
        $industries = Category::industryFilters()->get();

        return view('templates.index', compact('templates', 'industries', 'selectedIndustry'));
    }
}
