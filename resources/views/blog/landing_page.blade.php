@extends('layouts.app')

@php
    $hideHeader = false;
    $hideFooter = false;
    $hideCtaBand = true;
    $hideFloatingContact = false;
    $hideChatWidget = false;

    $cleanTitle = $post->meta_title ?: $post->title;
    $cleanDesc = $post->meta_description ?: ($post->summary ?: \Illuminate\Support\Str::limit(strip_tags($post->content), 160));
    $postThumbnail = $post->thumbnail ? $post->thumbnail_url : asset('images/logo-ttcl.png');
    if (str_starts_with((string)$postThumbnail, 'http://') && (app()->isProduction() || str_contains((string)$postThumbnail, 'truyenthongcuulong.com'))) {
        $postThumbnail = preg_replace('#^http://#', 'https://', $postThumbnail);
    }
    $authorName = $post->author ? $post->author->name : 'Truyền Thông Cửu Long';
    $canonicalUrl = app(\App\Services\Seo\SchemaService::class)->getBaseUrl() . '/' . ltrim($post->slug, '/');
    $hotline = get_setting('company_phone', '0939.363.262');
    $cleanHotline = preg_replace('/[^0-9]/', '', $hotline);
    $companyEmail = get_setting('company_email', 'contact@truyenthongcuulong.com');
    $companyAddress = get_setting('company_address', 'Số 06, đường D3, KDC Hồng Loan, P. Hưng Thạnh, Q. Cái Răng, TP. Cần Thơ');

    \Illuminate\Support\Facades\View::share('currentPost', $post);
    \Illuminate\Support\Facades\View::share('canonicalUrl', $canonicalUrl);
@endphp

@section('title', $cleanTitle . ' | Truyền Thông Cửu Long')
@section('meta_description', $cleanDesc)
@section('canonical', $canonicalUrl)

@section('og_type', 'website')
@section('og_url', $canonicalUrl)
@section('og_title', $cleanTitle)
@section('og_description', $cleanDesc)
@section('og_image', $postThumbnail)
@section('og_image_alt', $cleanTitle)

@section('twitter_card', 'summary_large_image')
@section('twitter_title', $cleanTitle)
@section('twitter_description', $cleanDesc)
@section('twitter_image', $postThumbnail)
@section('twitter_image_alt', $cleanTitle)

@section('content')
<div class="landing-page-wrapper bg-slate-50 text-slate-800 antialiased selection:bg-orange-500 selection:text-white">

    <!-- ========================================== -->
    <!-- 2. HIGH-CONVERTING HERO SECTION            -->
    <!-- ========================================== -->
    <section class="relative overflow-hidden bg-gradient-to-br from-slate-900 via-slate-800 to-slate-950 text-white pt-16 pb-20 lg:pt-20 lg:pb-28">
        <!-- Background Lighting Effects -->
        <div class="pointer-events-none absolute -top-40 -right-40 w-96 h-96 rounded-full bg-orange-500/20 blur-3xl"></div>
        <div class="pointer-events-none absolute -bottom-40 -left-40 w-96 h-96 rounded-full bg-amber-500/15 blur-3xl"></div>
        <div class="absolute inset-0 bg-[radial-gradient(#ffffff_1px,transparent_1px)] opacity-5 [background-size:24px_24px]"></div>

        <div class="relative z-10 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <!-- Category / Value Badge -->
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-orange-500/15 border border-orange-500/30 text-orange-400 text-xs sm:text-sm font-bold uppercase tracking-wider mb-6 shadow-inner">
                <span class="w-2 h-2 rounded-full bg-orange-500 animate-pulse"></span>
                <span>{{ $post->category ? $post->category->name : 'Dịch Vụ & Giải Pháp Chuyên Nghiệp' }}</span>
            </div>

            <!-- Main Heading H1 -->
            <h1 class="font-headline text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-black text-white leading-tight tracking-tight mb-6">
                {{ $post->title }}
            </h1>

            <!-- Summary / Subheading -->
            @if(!empty($post->summary))
            <p class="text-base sm:text-lg md:text-xl text-slate-300 max-w-3xl mx-auto leading-relaxed mb-8">
                {{ $post->summary }}
            </p>
            @endif

            <!-- Hero Action Buttons -->
            <div class="flex flex-wrap items-center justify-center gap-4 mb-12">
                <a href="#lead-form" class="inline-flex items-center gap-2 px-8 py-4 rounded-2xl text-base sm:text-lg font-extrabold text-white bg-gradient-to-r from-orange-500 via-orange-600 to-amber-600 hover:from-orange-600 hover:to-amber-700 shadow-xl shadow-orange-500/30 hover:shadow-2xl hover:shadow-orange-500/40 transition-all transform hover:-translate-y-0.5">
                    <span>Nhận Tư Vấn & Báo Giá Miễn Phí</span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/></svg>
                </a>

                <a href="tel:{{ $cleanHotline }}" class="inline-flex items-center gap-2 px-6 py-4 rounded-2xl text-base font-bold text-slate-200 bg-white/10 hover:bg-white/15 border border-white/20 hover:border-white/30 backdrop-blur-md transition-all">
                    <svg class="w-5 h-5 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                    <span>Gọi Ngay: {{ $hotline }}</span>
                </a>
            </div>

            <!-- Trust Proof Highlights -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 sm:gap-4 max-w-3xl mx-auto pt-6 border-t border-slate-700/60 text-left">
                <div class="flex items-center gap-3 p-3 rounded-xl bg-white/5 border border-white/10">
                    <div class="w-9 h-9 rounded-lg bg-emerald-500/20 text-emerald-400 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                    </div>
                    <div class="text-xs">
                        <strong class="block text-white font-bold">Cam kết chất lượng</strong>
                        <span class="text-slate-400">100% hài lòng kết quả</span>
                    </div>
                </div>

                <div class="flex items-center gap-3 p-3 rounded-xl bg-white/5 border border-white/10">
                    <div class="w-9 h-9 rounded-lg bg-orange-500/20 text-orange-400 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    </div>
                    <div class="text-xs">
                        <strong class="block text-white font-bold">Triển khai thần tốc</strong>
                        <span class="text-slate-400">Đúng tiến độ cam kết</span>
                    </div>
                </div>

                <div class="flex items-center gap-3 p-3 rounded-xl bg-white/5 border border-white/10">
                    <div class="w-9 h-9 rounded-lg bg-blue-500/20 text-blue-400 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                    </div>
                    <div class="text-xs">
                        <strong class="block text-white font-bold">Bảo hành & Hỗ trợ</strong>
                        <span class="text-slate-400">Đồng hành trọn vòng đời</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========================================== -->
    <!-- 3. MAIN EDITORIAL CONTENT (NỘI DUNG CHÍNH) -->
    <!-- ========================================== -->
    <section class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-14 lg:py-20">
        <!-- Quick TOC if enabled -->
        @if($post->show_toc && !empty($toc) && count($toc) > 1)
        <div class="mb-12 p-6 rounded-2xl bg-white border border-slate-200 shadow-sm" x-data="{ open: true }">
            <button @click="open = !open" type="button" class="w-full flex items-center justify-between text-left font-bold text-slate-900">
                <span class="flex items-center gap-2 text-base">
                    <span class="material-symbols-outlined text-orange-600 text-[22px]">list_alt</span>
                    Nội Dung Chính Trong Trang
                </span>
                <span class="text-xs text-orange-600 flex items-center gap-1 font-semibold">
                    <span x-text="open ? 'Thu gọn' : 'Xem mục lục'">Thu gọn</span>
                    <svg class="w-4 h-4 transform transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </span>
            </button>
            <nav x-show="open" x-transition class="mt-4 pt-4 border-t border-slate-100">
                <ul class="space-y-2 text-sm text-slate-600">
                    @foreach($toc as $item)
                    <li class="{{ $item['level'] == 3 ? 'pl-4' : 'font-medium' }}">
                        <a href="#{{ $item['id'] }}" class="hover:text-orange-600 transition-colors flex items-center gap-2">
                            <span class="w-1.5 h-1.5 rounded-full {{ $item['level'] == 3 ? 'bg-slate-300' : 'bg-orange-500' }}"></span>
                            <span>{{ $item['title'] }}</span>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </nav>
        </div>
        @endif

        <!-- Editorial Content Area -->
        <article class="prose prose-lg prose-slate max-w-none prose-headings:font-headline prose-headings:font-bold prose-headings:text-slate-900 prose-h2:text-2xl sm:prose-h2:text-3xl prose-h2:mt-10 prose-h2:mb-4 prose-h2:scroll-mt-24 prose-h3:text-xl sm:prose-h3:text-2xl prose-h3:mt-8 prose-h3:mb-3 prose-h3:scroll-mt-24 prose-p:text-slate-700 prose-p:leading-relaxed prose-p:mb-6 prose-a:text-orange-600 prose-a:font-semibold hover:prose-a:text-orange-700 prose-img:rounded-2xl prose-img:shadow-lg prose-img:my-8 prose-strong:text-slate-900">
            {!! $post->content !!}
        </article>

        <!-- In-content Quick CTA Banner -->
        <div class="my-14 p-8 rounded-3xl bg-gradient-to-r from-orange-500 via-orange-600 to-amber-600 text-white shadow-xl flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="space-y-2 text-center md:text-left">
                <h3 class="text-xl sm:text-2xl font-black text-white">Bạn cần giải pháp thiết kế riêng cho doanh nghiệp?</h3>
                <p class="text-orange-100 text-sm">Đội ngũ chuyên gia của chúng tôi luôn sẵn sàng lắng nghe và xây dựng kế hoạch tối ưu.</p>
            </div>
            <a href="#lead-form" class="shrink-0 px-6 py-3.5 rounded-xl font-extrabold text-orange-600 bg-white hover:bg-orange-50 shadow-md transition-all whitespace-nowrap">
                Nhận Báo Giá Ngay &rarr;
            </a>
        </div>
    </section>

    <!-- ========================================== -->
    <!-- 4. HIGH-CONVERTING LEAD CAPTURE FORM       -->
    <!-- ========================================== -->
    @if($post->show_cta_form)
    <section id="lead-form" class="relative overflow-hidden bg-slate-900 text-white py-16 lg:py-24 scroll-mt-10">
        <div class="pointer-events-none absolute -bottom-20 -right-20 w-80 h-80 rounded-full bg-orange-600/20 blur-3xl"></div>
        <div class="pointer-events-none absolute -top-20 -left-20 w-80 h-80 rounded-full bg-amber-500/20 blur-3xl"></div>

        <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="rounded-3xl bg-slate-800/90 border border-slate-700 shadow-2xl p-6 sm:p-10 lg:p-12">
                <div class="text-center max-w-2xl mx-auto mb-10">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-orange-500/20 text-orange-400 text-xs font-bold uppercase tracking-wider mb-3">
                        ⚡ ĐĂNG KÝ NHẬN TƯ VẤN NHANH
                    </span>
                    <h2 class="font-headline text-2xl sm:text-3xl md:text-4xl font-black text-white leading-tight">
                        Nhận Báo Giá & Tư Vấn Giải Pháp Chi Tiết
                    </h2>
                    <p class="text-sm sm:text-base text-slate-300 mt-3 leading-relaxed">
                        Điền thông tin bên dưới, chuyên viên Truyền Thông Cửu Long sẽ liên hệ và gửi bản kế hoạch chi tiết trong vòng <strong>15 phút</strong>.
                    </p>
                </div>

                <form action="{{ route('contact.submit') }}" method="POST" class="space-y-5">
                    @csrf
                    <!-- Honeypot anti-spam -->
                    <div style="display: none !important;">
                        <input type="text" name="website_url" tabindex="-1" autocomplete="off">
                    </div>
                    <!-- Hidden tracking fields for Customer 360 -->
                    <input type="hidden" name="source_url" value="{{ url()->current() }}">
                    <input type="hidden" name="channel" value="landing_page">
                    <input type="hidden" name="service" value="{{ $post->title }}">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <!-- Full Name -->
                        <div>
                            <label for="lp_name" class="block text-xs font-bold text-slate-200 uppercase tracking-wider mb-2">
                                Họ và tên của bạn <span class="text-orange-400">*</span>
                            </label>
                            <input 
                                type="text" 
                                id="lp_name" 
                                name="name" 
                                required 
                                placeholder="Nguyễn Văn A" 
                                class="w-full px-4 py-3.5 rounded-xl bg-slate-900/90 border border-slate-700 text-white placeholder-slate-500 text-sm focus:outline-hidden focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20 transition-all"
                            >
                        </div>

                        <!-- Phone Number -->
                        <div>
                            <label for="lp_phone" class="block text-xs font-bold text-slate-200 uppercase tracking-wider mb-2">
                                Số điện thoại liên hệ <span class="text-orange-400">*</span>
                            </label>
                            <input 
                                type="tel" 
                                id="lp_phone" 
                                name="phone" 
                                required 
                                placeholder="0901 xxx xxx" 
                                class="w-full px-4 py-3.5 rounded-xl bg-slate-900/90 border border-slate-700 text-white placeholder-slate-500 text-sm focus:outline-hidden focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20 transition-all"
                            >
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <!-- Email -->
                        <div>
                            <label for="lp_email" class="block text-xs font-bold text-slate-200 uppercase tracking-wider mb-2">
                                Địa chỉ Email
                            </label>
                            <input 
                                type="email" 
                                id="lp_email" 
                                name="email" 
                                placeholder="email@doanhnghiep.com" 
                                class="w-full px-4 py-3.5 rounded-xl bg-slate-900/90 border border-slate-700 text-white placeholder-slate-500 text-sm focus:outline-hidden focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20 transition-all"
                            >
                        </div>

                        <!-- Company / Organization -->
                        <div>
                            <label for="lp_company" class="block text-xs font-bold text-slate-200 uppercase tracking-wider mb-2">
                                Doanh nghiệp / Tổ chức
                            </label>
                            <input 
                                type="text" 
                                id="lp_company" 
                                name="company" 
                                placeholder="Tên công ty hoặc thương hiệu" 
                                class="w-full px-4 py-3.5 rounded-xl bg-slate-900/90 border border-slate-700 text-white placeholder-slate-500 text-sm focus:outline-hidden focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20 transition-all"
                            >
                        </div>
                    </div>

                    <!-- Message / Requirements -->
                    <div>
                        <label for="lp_message" class="block text-xs font-bold text-slate-200 uppercase tracking-wider mb-2">
                            Yêu cầu hoặc mục tiêu dự án của bạn
                        </label>
                        <textarea 
                            id="lp_message" 
                            name="message" 
                            rows="3" 
                            placeholder="Mô tả ngắn gọn ngân sách, thời gian dự kiến hoặc yêu cầu chi tiết..." 
                            class="w-full px-4 py-3.5 rounded-xl bg-slate-900/90 border border-slate-700 text-white placeholder-slate-500 text-sm focus:outline-hidden focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20 transition-all"
                        ></textarea>
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-3">
                        <button 
                            type="submit" 
                            class="w-full py-4 px-8 rounded-2xl font-headline font-black text-white text-base sm:text-lg bg-gradient-to-r from-orange-500 via-orange-600 to-amber-600 hover:from-orange-600 hover:to-amber-700 shadow-xl shadow-orange-500/30 hover:shadow-2xl hover:shadow-orange-500/40 transition-all transform hover:-translate-y-0.5 active:translate-y-0 flex items-center justify-center gap-2 cursor-pointer"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                            <span>GỬI YÊU CẦU TƯ VẤN NGAY</span>
                        </button>
                    </div>

                    <!-- Guarantee Note -->
                    <div class="pt-2 text-center text-xs text-slate-400 flex items-center justify-center gap-2">
                        <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        <span>Cam kết bảo mật 100% dữ liệu. Không làm phiền nếu không phù hợp nhu cầu.</span>
                    </div>
                </form>
            </div>
        </div>
    </section>
    @endif

    <!-- ========================================== -->
    <!-- 5. SOCIAL PROOF & KEY METRICS              -->
    <!-- ========================================== -->
    <section class="py-14 bg-white border-y border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 text-center">
                <div class="p-6 rounded-2xl bg-slate-50 border border-slate-100">
                    <div class="font-headline text-3xl sm:text-4xl font-black text-orange-600 mb-1">500+</div>
                    <div class="text-xs sm:text-sm font-bold text-slate-700">Dự án hoàn thành</div>
                    <div class="text-[11px] text-slate-400 mt-1">Truyền thông & Công nghệ</div>
                </div>

                <div class="p-6 rounded-2xl bg-slate-50 border border-slate-100">
                    <div class="font-headline text-3xl sm:text-4xl font-black text-slate-900 mb-1">99.8%</div>
                    <div class="text-xs sm:text-sm font-bold text-slate-700">Khách hàng hài lòng</div>
                    <div class="text-[11px] text-slate-400 mt-1">Đánh giá 5 sao thực tế</div>
                </div>

                <div class="p-6 rounded-2xl bg-slate-50 border border-slate-100">
                    <div class="font-headline text-3xl sm:text-4xl font-black text-orange-600 mb-1">10+</div>
                    <div class="text-xs sm:text-sm font-bold text-slate-700">Năm kinh nghiệm</div>
                    <div class="text-[11px] text-slate-400 mt-1">Đội ngũ chuyên nghiệp</div>
                </div>

                <div class="p-6 rounded-2xl bg-slate-50 border border-slate-100">
                    <div class="font-headline text-3xl sm:text-4xl font-black text-slate-900 mb-1">24/7</div>
                    <div class="text-xs sm:text-sm font-bold text-slate-700">Hỗ trợ kỹ thuật</div>
                    <div class="text-[11px] text-slate-400 mt-1">Sẵn sàng phản hồi nhanh</div>
                </div>
            </div>
        </div>
    </section>



    <!-- ========================================== -->
    <!-- 7. STICKY MOBILE CTA BAR (< 768px)         -->
    <!-- ========================================== -->
    <div class="md:hidden fixed bottom-0 left-0 right-0 z-40 bg-white/95 backdrop-blur-md border-t border-slate-200 p-2.5 shadow-2xl flex items-center gap-2">
        <a href="tel:{{ $cleanHotline }}" class="flex-1 py-3 px-3 rounded-xl bg-slate-900 text-white font-bold text-xs flex items-center justify-center gap-1.5 shadow-sm">
            <svg class="w-4 h-4 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
            <span>Gọi Hotline</span>
        </a>

        <a href="#lead-form" class="flex-1 py-3 px-3 rounded-xl bg-gradient-to-r from-orange-500 to-amber-600 text-white font-black text-xs flex items-center justify-center gap-1.5 shadow-md shadow-orange-500/20">
            <span>Nhận Báo Giá</span>
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
        </a>
    </div>

</div>
@endsection
