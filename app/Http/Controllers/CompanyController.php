<?php

namespace App\Http\Controllers;

use App\Models\TeamMember;
use App\Models\Post;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    public function about(): \Illuminate\Http\RedirectResponse
    {
        return redirect()->route('profile', [], 301);
    }

    public function process(): \Illuminate\Http\RedirectResponse
    {
        return redirect()->route('profile', [], 301);
    }

    public function partners(): \Illuminate\Http\RedirectResponse
    {
        return redirect()->route('clients', [], 301);
    }

    public function clients(): View
    {
        $clients = \Illuminate\Support\Facades\Cache::remember('clients.clients_page', 86400, function () {
            return \App\Models\Client::active()->forClients()->ordered()->get();
        });

        $caseStudies = \Illuminate\Support\Facades\Cache::remember('clients.case_studies', 3600, function () {
            return \App\Models\CaseStudy::orderBy('order')
                ->orderBy('id', 'desc')
                ->get();
        });
        
        return view('pages.clients', compact('clients', 'caseStudies'));
    }

    public function pricing(): View
    {
        $videoPlans = \Illuminate\Support\Facades\Cache::remember('pricing.tvc', 86400, function () {
            return \App\Models\PricingPlan::active()->where('service_group', 'tvc')->ordered()->get();
        });
        $webPlans = \Illuminate\Support\Facades\Cache::remember('pricing.web', 86400, function () {
            return \App\Models\PricingPlan::active()->where('service_group', 'web')->ordered()->get();
        });
        $marketingPlans = \Illuminate\Support\Facades\Cache::remember('pricing.marketing', 86400, function () {
            return \App\Models\PricingPlan::active()->where('service_group', 'marketing')->ordered()->get();
        });

        return view('pages.pricing', compact('videoPlans', 'webPlans', 'marketingPlans'));
    }

    public function careers(): View
    {
        $jobs = Post::where('status', 'published')
            ->where(function ($q) {
                $q->whereHas('category', function ($cat) {
                    $cat->where('slug', 'tuyen-dung');
                })
                ->orWhere('title', 'like', '%tuyển dụng%')
                ->orWhere('title', 'like', '%tuyen dung%')
                ->orWhere('title', 'like', '%thực tập sinh%');
            })
            ->where('title', 'not like', '%cảnh báo%')
            ->where('title', 'not like', '%canh bao%')
            ->where('title', 'not like', '%Gia Phước%')
            ->orderByDesc('published_at')
            ->get();

        return view('pages.careers', compact('jobs'));
    }

    public function applyJob(Request $request): RedirectResponse
    {
        try {
            $validated = $request->validate([
                'fullname' => 'required|string|min:2|max:100',
                'phone' => 'required|string|max:30',
                'email' => 'required|email|max:100',
                'position' => 'required|string|max:150',
                'cv_file' => 'required|file|mimes:pdf,doc,docx|max:10240',
                'cover_letter' => 'nullable|string|max:2000',
            ], [
                'fullname.required' => 'Vui lòng nhập họ và tên của bạn.',
                'fullname.min' => 'Họ và tên quá ngắn. Vui lòng nhập ít nhất 2 ký tự.',
                'fullname.max' => 'Họ và tên không được quá 100 ký tự.',
                'phone.required' => 'Vui lòng nhập số điện thoại liên hệ.',
                'phone.max' => 'Số điện thoại không được quá 30 ký tự.',
                'email.required' => 'Vui lòng nhập địa chỉ email.',
                'email.email' => 'Địa chỉ email không đúng định dạng (ví dụ: ungvien@gmail.com).',
                'email.max' => 'Email không được quá 100 ký tự.',
                'position.required' => 'Vui lòng chọn vị trí ứng tuyển.',
                'cv_file.required' => 'Vui lòng đính kèm file CV của bạn.',
                'cv_file.mimes' => 'File CV chỉ chấp nhận định dạng: PDF, DOC, DOCX.',
                'cv_file.max' => 'Dung lượng file CV tối đa là 10MB.',
                'cover_letter.max' => 'Lời nhắn giới thiệu không được quá 2000 ký tự.',
            ]);

            $rawPhone = $validated['phone'];
            $cleanChars = preg_replace('/[0-9\s\.\-\+\(\)]/', '', $rawPhone);
            $digits = preg_replace('/[^0-9]/', '', $rawPhone);

            if (!empty($cleanChars) || strlen($digits) < 9 || strlen($digits) > 11) {
                return back()->withErrors(['phone' => 'Số điện thoại không hợp lệ. Vui lòng nhập số điện thoại gồm 9 - 11 chữ số (ví dụ: 0939 363 262).'])->withInput();
            }

            $path = $request->file('cv_file')->store('', 'private_cv');

            JobApplication::create([
                'fullname' => $validated['fullname'],
                'phone' => $validated['phone'],
                'email' => $validated['email'],
                'position' => $validated['position'],
                'cv_path' => $path,
                'cover_letter' => $validated['cover_letter'] ?? null,
                'status' => 'pending',
            ]);

            return back()->with('success', 'Hồ sơ ứng tuyển của bạn đã được gửi thành công! Ban Nhân Sự Truyền Thông Cửu Long sẽ liên hệ phỏng vấn trong vòng 3 ngày làm việc.');
        } catch (\Illuminate\Validation\ValidationException $ve) {
            throw $ve;
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::error('Careers applyJob error: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return back()->withErrors(['cv_file' => 'Hệ thống đang bận khi lưu hồ sơ. Bạn vui lòng gửi CV qua email: contact@truyenthongcuulong.vn hoặc liên hệ hotline 0939.363.262!'])->withInput();
        }
    }

    public function privacy(): View
    {
        return view('pages.privacy');
    }

    public function terms(): View
    {
        return view('pages.terms');
    }
}
