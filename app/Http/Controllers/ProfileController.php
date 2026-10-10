<?php

namespace App\Http\Controllers;

use App\Models\CaseStudy;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function index(): View
    {
        // Cập nhật đổi tên dự án theo yêu cầu người dùng
        $oldProject = CaseStudy::where('slug', 'website-dakhoacantho')
            ->orWhere('title', 'like', '%Đa Khoa Cần Thơ%')
            ->first();

        if ($oldProject) {
            $oldProject->update([
                'title' => 'Hệ Thống ERP Truyền Thông Cửu Long',
                'slug' => 'he-thong-erp-truyen-thong-cuu-long',
                'client_name' => 'Truyền Thông Cửu Long',
                'group' => 'technology',
                'summary' => 'Hệ thống phần mềm quản trị doanh nghiệp ERP tổng thể, tối ưu vận hành nhân sự, dự án truyền thông và tài chính.',
                'thumbnail' => 'images/webapp/webapp_project_3_management.png',
                'featured' => true,
                'meta_data' => array_merge($oldProject->meta_data ?? [], [
                    'problem' => 'Doanh nghiệp truyền thông cần hệ thống quản trị tập trung quy trình sản xuất media, nhân sự và tài chính.',
                    'solution' => 'Phát triển hệ thống ERP chuyên biệt trên nền tảng Laravel hiện đại, bảo mật cao và tự động hóa quy trình nghiệp vụ.',
                    'tech_stack' => 'PHP, Laravel, MySQL, Vue.js, REST API, Tailwind CSS',
                    'result' => 'Hệ thống ERP vận hành trơn tru, số hóa 100% quy trình nghiệp vụ và báo cáo tài chính thời gian thực.',
                ]),
            ]);
        }

        // Lấy 6 dự án tiêu biểu thực tế từ CSDL
        $featuredProjects = CaseStudy::where('featured', true)
            ->orderBy('order')
            ->take(6)
            ->get();

        if ($featuredProjects->count() < 6) {
            $extra = CaseStudy::whereNotIn('id', $featuredProjects->pluck('id'))
                ->orderBy('order')
                ->take(6 - $featuredProjects->count())
                ->get();
            $featuredProjects = $featuredProjects->concat($extra);
        }

        return view('profile', compact('featuredProjects'));
    }
}