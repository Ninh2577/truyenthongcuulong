<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\CaseStudy;
use App\Models\Post;
use Illuminate\View\View;

class ServiceController extends Controller
{
    public function index(): View
    {
        $mediaServices = Service::where('group', 'media')->orderBy('order')->get();
        $techServices = Service::where('group', 'technology')->orderBy('order')->get();

        return view('services.index', compact('mediaServices', 'techServices'));
    }

    public function webApp(): View
    {
        $service = Service::where('slug', 'thiet-ke-website-chuyen-nghiep')->first();
        $techCaseStudies = CaseStudy::where('group', 'technology')->orderBy('order')->take(4)->get();
        if ($techCaseStudies->isEmpty()) {
            $techCaseStudies = CaseStudy::orderBy('order')->take(4)->get();
        }
        // 4 dự án công nghệ tiêu biểu hiển thị riêng trên trang Dịch Vụ Web/App
        $featuredTechProjects = [
            [
                'id' => 'erp-clm',
                'badge' => 'NỘI BỘ CLM',
                'status_badge' => 'Đang Vận Hành',
                'status_type' => 'operational',
                'client_name' => 'TRUYỀN THÔNG CỬU LONG',
                'tagline' => 'Quản trị nguồn lực doanh nghiệp & số hóa quy trình',
                'title' => 'Hệ Thống ERP Quản Trị Doanh Nghiệp Nội Bộ',
                'summary' => 'Hệ thống ERP xây dựng riêng cho Truyền Thông Cửu Long, số hóa toàn diện quy trình vận hành: quản lý dự án, tiến độ sản xuất media, chấm công và kiểm soát tài chính nội bộ.',
                'tech_stack' => 'PHP Laravel • React • MySQL',
                'gradient' => 'from-[#0B132B] via-[#162544] to-[#0B132B]',
                'accent_color' => 'text-indigo-300',
                'thumbnail' => 'uploads/projects/erp-dashboard-clm.jpg',
            ],
            [
                'id' => 'clinic-app',
                'badge' => 'HEALTHCARE APP',
                'status_badge' => 'Đã Triển Khai',
                'status_type' => 'live',
                'client_name' => 'PHÒNG KHÁM GIA PHƯỚC',
                'tagline' => 'App quản lý vận hành & đặt lịch khám bệnh',
                'title' => 'Ứng Dụng Quản Lý & Đặt Lịch Phòng Khám Đa Khoa',
                'summary' => 'Giải pháp số hóa toàn diện quy trình tiếp đón và quản lý khám chữa bệnh: đặt lịch trực tuyến, theo dõi hồ sơ bệnh án điện tử và điều phối lịch trực bác sĩ thời gian thực.',
                'tech_stack' => 'PHP Laravel • React • MySQL',
                'gradient' => 'from-[#071F1E] via-[#0D3835] to-[#071F1E]',
                'accent_color' => 'text-emerald-300',
                'thumbnail' => 'uploads/projects/clinic-app-gia-phuoc.jpg',
            ],
            [
                'id' => 'ai-chatbot',
                'badge' => 'AI AUTOMATION',
                'status_badge' => 'Sẵn Sàng Tích Hợp',
                'status_type' => 'ready',
                'client_name' => 'CHATBOT TƯ VẤN',
                'tagline' => 'Hệ thống phản hồi tự động & thu thập lead 24/7',
                'title' => 'Chatbot Tư Vấn Khách Hàng Tự Động Đa Kênh',
                'summary' => 'Trợ lý số hóa thông minh tích hợp trực tiếp trên website, tự động giải đáp thắc mắc, phân loại nhu cầu dịch vụ và đồng bộ dữ liệu khách hàng tiềm năng về CRM tức thì.',
                'tech_stack' => 'Node.js • React • MySQL',
                'gradient' => 'from-[#081B2B] via-[#0E2C44] to-[#081B2B]',
                'accent_color' => 'text-cyan-300',
                'thumbnail' => 'uploads/projects/chatbot-tu-van.jpg',
            ],
            [
                'id' => 'clinic-wp',
                'badge' => 'WORDPRESS CMS',
                'status_badge' => 'Đã Triển Khai',
                'status_type' => 'live',
                'client_name' => 'WEBSITE PHÒNG KHÁM',
                'tagline' => 'Tối ưu SEO y tế & đặt lịch khám trực tuyến',
                'title' => 'Website Phòng Khám Đa Khoa Chuẩn WordPress',
                'summary' => 'Hệ thống website y khoa chuẩn WordPress được tùy biến giao diện chuyên nghiệp, cấu trúc chuẩn SEO Google Onpage, tích hợp tính năng đặt lịch khám bệnh trực tuyến dễ dàng.',
                'tech_stack' => 'WordPress • PHP • MySQL',
                'gradient' => 'from-[#1C1608] via-[#35290E] to-[#1C1608]',
                'accent_color' => 'text-amber-300',
                'thumbnail' => 'uploads/projects/clinic-website-wp.jpg',
            ],
        ];

        // Tuyển chọn 4 mẫu giao diện tiêu biểu thuộc 4 ngành kinh doanh đa dạng
        $preferredSlugs = [
            'mau-website-sach-van-phong-stationero',
            'mau-website-thoi-trang-stylista',
            'mau-website-o-to-xe-may-grand',
            'mau-website-noi-that-trang-tri-furnihaus',
        ];

        $featuredTemplates = Post::with('category')
            ->where('status', 'published')
            ->whereIn('slug', $preferredSlugs)
            ->get()
            ->sortBy(function ($post) use ($preferredSlugs) {
                return array_search($post->slug, $preferredSlugs);
            });

        if ($featuredTemplates->count() < 4) {
            $featuredTemplates = Post::with('category')
                ->where('status', 'published')
                ->whereHas('category', function ($q) {
                    $q->where('slug', 'template-website');
                })
                ->orderByDesc('published_at')
                ->take(4)
                ->get();
        }

        return view('services.web-app', compact('service', 'techCaseStudies', 'featuredTechProjects', 'featuredTemplates'));
    }

    public function media(): View
    {
        $service = Service::where('slug', 'san-xuat-video-media')->first();
        $mediaCaseStudies = CaseStudy::where('group', 'media')->orderBy('order')->take(6)->get();
        if ($mediaCaseStudies->isEmpty()) {
            $mediaCaseStudies = CaseStudy::orderBy('order')->take(6)->get();
        }

        return view('services.media', compact('service', 'mediaCaseStudies'));
    }

    public function marketing(): View
    {
        $service = Service::where('slug', 'digital-marketing-quang-cao')->first();
        $marketingCaseStudies = CaseStudy::orderBy('order')->take(4)->get();

        return view('services.marketing', compact('service', 'marketingCaseStudies'));
    }

    public function show(string $slug): \Illuminate\View\View|\Illuminate\Http\RedirectResponse
    {
        // Redirect legacy service slugs to new dedicated routes if matched
        if ($slug === 'thiet-ke-website-chuyen-nghiep' || $slug === 'web-app') {
            return redirect()->route('services.web-app', [], 301);
        }
        if ($slug === 'san-xuat-video-media' || $slug === 'media') {
            return redirect()->route('services.media', [], 301);
        }
        if ($slug === 'digital-marketing-quang-cao' || $slug === 'marketing') {
            return redirect()->route('services.marketing', [], 301);
        }
        if ($slug === 'booking-media' || $slug === 'booking') {
            return redirect()->route('booking', [], 301);
        }

        $service = Service::where('slug', $slug)->firstOrFail();
        $otherServices = Service::where('id', '!=', $service->id)->take(4)->get();

        return view('services.show', compact('service', 'otherServices'));
    }

    public function booking(): View
    {
        return view('services.booking');
    }
}