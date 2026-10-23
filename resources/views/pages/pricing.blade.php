@extends('layouts.app')

@section('title', 'Bảng Giá & Khung Chi Phí Phần Mềm - Truyền Thông Cửu Long')
@section('meta_description', 'Khung chi phí minh bạch cho dịch vụ thiết kế Website, phát triển Web App và hệ thống số theo yêu cầu. Báo giá chi tiết theo phạm vi công việc.')

@section('content')
<div class="w-full bg-[#f8f9ff] min-h-screen pt-28 pb-20" style="font-family: var(--font-primary);">
    <x-ui.container class="flex flex-col gap-14 lg:gap-18">
        <!-- Breadcrumb Navigation -->
        <div class="pt-2">
            <x-ui.breadcrumb :items="[
                ['label' => 'Dịch vụ & Giải pháp', 'url' => '/dich-vu'],
                ['label' => 'Bảng giá & Khung chi phí']
            ]" />
        </div>

        <!-- ==================== HERO ==================== -->
        <section class="max-w-4xl mx-auto text-center flex flex-col items-center gap-5">
            <span class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-slate-100 text-slate-700 text-xs font-semibold">
                TRANSPARENT PRICING FRAMEWORK &bull; KHÔNG PHÁT SINH ẨN
            </span>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-[#070f1e] tracking-tight leading-tight">
                Khung Chi Phí Phát Triển
                <span class="block text-slate-600 font-bold mt-1 text-2xl sm:text-3xl lg:text-4xl">
                    Phần Mềm &amp; Nền Tảng Số
                </span>
            </h1>
            <p class="text-slate-600 text-sm sm:text-base leading-relaxed max-w-2xl">
                Phần mềm doanh nghiệp không phải là sản phẩm đóng gói sẵn trên kệ. Chi phí được tính toán minh bạch dựa trên đúng phạm vi tính năng, luồng nghiệp vụ và giá trị thực tế mang lại.
            </p>
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-white border border-slate-200/90 text-xs text-slate-600 shadow-2xs">
                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                <span>Phân biệt rõ: <strong>Giá tham khảo cho mô hình chuẩn</strong> &amp; <strong>Báo giá chi tiết theo yêu cầu</strong></span>
            </div>

            <div class="flex flex-wrap items-center justify-center gap-2 pt-2">
                <a href="#web" class="px-3.5 py-1.5 rounded-xl bg-white border border-slate-200 text-xs font-semibold text-slate-700 hover:border-primary hover:text-primary transition-all shadow-2xs">💻 Website &amp; Nền Tảng</a>
                <a href="#ui-ux" class="px-3.5 py-1.5 rounded-xl bg-white border border-slate-200 text-xs font-semibold text-slate-700 hover:border-primary hover:text-primary transition-all shadow-2xs">🎨 Thiết Kế UI/UX</a>
                <a href="#marketing" class="px-3.5 py-1.5 rounded-xl bg-white border border-slate-200 text-xs font-semibold text-slate-700 hover:border-primary hover:text-primary transition-all shadow-2xs">📈 SEO &amp; Marketing</a>
                <a href="#website-care" class="px-3.5 py-1.5 rounded-xl bg-white border border-slate-200 text-xs font-semibold text-slate-700 hover:border-primary hover:text-primary transition-all shadow-2xs">🛠️ Quản Trị Website</a>
                <a href="#event-photography" class="px-3.5 py-1.5 rounded-xl bg-white border border-slate-200 text-xs font-semibold text-slate-700 hover:border-primary hover:text-primary transition-all shadow-2xs">📸 Chụp Ảnh Sự Kiện</a>
                <a href="#event-videography" class="px-3.5 py-1.5 rounded-xl bg-white border border-slate-200 text-xs font-semibold text-slate-700 hover:border-primary hover:text-primary transition-all shadow-2xs">🎥 Quay Phim Sự Kiện</a>
                <a href="#tvc" class="px-3.5 py-1.5 rounded-xl bg-white border border-slate-200 text-xs font-semibold text-slate-700 hover:border-primary hover:text-primary transition-all shadow-2xs">🎬 Sản Xuất Video &amp; TVC</a>
                <a href="#teambuilding" class="px-3.5 py-1.5 rounded-xl bg-white border border-slate-200 text-xs font-semibold text-slate-700 hover:border-primary hover:text-primary transition-all shadow-2xs">🏖️ TeamBuilding</a>
                <a href="#custom-erp" class="px-3.5 py-1.5 rounded-xl bg-white border border-slate-200 text-xs font-semibold text-slate-700 hover:border-primary hover:text-primary transition-all shadow-2xs">⚙️ Phần Mềm Doanh Nghiệp</a>
            </div>
        </section>

        <!-- ==================== CÁC KHUNG DỊCH VỤ CHÍNH ==================== -->
        <section class="flex flex-col gap-12">
            <!-- 01: WEBSITE & NỀN TẢNG SỐ -->
            <div id="web" class="p-8 rounded-2xl bg-white border border-slate-200/90 shadow-sm flex flex-col gap-6 scroll-mt-28">
                <div class="border-b border-slate-100 pb-3 flex flex-col sm:flex-row sm:items-end justify-between gap-2">
                    <div>
                        <span class="text-xs font-bold text-primary uppercase">KHUNG 01</span>
                        <h2 class="text-xl sm:text-2xl font-bold text-[#070f1e] tracking-tight mt-0.5">
                            Website Doanh Nghiệp &amp; Cổng Thông Tin
                        </h2>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="text-xs text-slate-500">Thời gian triển khai: 1 &ndash; 3 tuần</span>
                        <a href="{{ url('/dich-vu/web-app') }}" class="text-xs font-bold text-primary hover:underline inline-flex items-center gap-1">
                            <span>Xem trang dịch vụ</span>
                            <span class="material-symbols-outlined text-[14px]">open_in_new</span>
                        </a>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @forelse($webPlans as $plan)
                        <div class="p-6 rounded-xl {{ $plan->is_featured ? 'bg-white border-2 border-primary/40 ring-4 ring-primary/5 shadow-md' : 'bg-slate-50/70 border border-slate-200/70' }} space-y-4 flex flex-col justify-between transition-all duration-300 hover:shadow-lg">
                            <div class="space-y-3">
                                @if(!empty($plan->thumbnail_url))
                                    <div class="w-full h-36 rounded-lg overflow-hidden bg-slate-100 mb-2">
                                        <img src="{{ $plan->thumbnail_url }}" alt="{{ $plan->tier_name }}" class="w-full h-full object-cover">
                                    </div>
                                @endif
                                <div class="flex items-center justify-between gap-2">
                                    <h3 class="text-base font-bold text-[#070f1e]">{{ $plan->tier_name }}</h3>
                                    @if($plan->is_featured)
                                        <span class="text-xs font-semibold px-2.5 py-1 rounded bg-primary/10 text-primary shrink-0">Nổi bật</span>
                                    @elseif(!empty($plan->price_note))
                                        <span class="text-xs font-semibold px-2.5 py-1 rounded bg-slate-200/70 text-slate-700 shrink-0">{{ $plan->price_note }}</span>
                                    @endif
                                </div>
                                <div class="text-2xl font-extrabold text-[#070f1e]">
                                    {{ $plan->price_display }}
                                </div>
                                @if(!empty($plan->description))
                                    <p class="text-xs text-slate-600 leading-relaxed">
                                        {{ $plan->description }}
                                    </p>
                                @endif
                                @if(!empty($plan->features))
                                    <ul class="text-xs text-slate-600 space-y-1.5 pt-1">
                                        @foreach($plan->features as $feature)
                                            <li class="flex items-center gap-1.5">&bull; {{ $feature }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                            <div class="pt-2 flex flex-col gap-2">
                                <a href="{{ route('contact') }}?service={{ urlencode($plan->tier_name) }}" class="w-full py-2.5 px-4 rounded-xl {{ $plan->is_featured ? 'bg-primary text-white shadow-sm hover:bg-primary/90' : 'bg-slate-200/70 hover:bg-primary hover:text-white text-slate-800' }} font-bold text-xs text-center transition-all inline-flex items-center justify-center gap-1">
                                    <span>{{ $plan->cta_label ?: 'Yêu cầu tư vấn gói' }}</span>
                                    <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
                                </a>
                                @if($plan->target_url)
                                    <a href="{{ $plan->target_url }}" class="text-[11px] font-semibold text-slate-500 hover:text-primary text-center">
                                        Xem chi tiết trên trang &rarr;
                                    </a>
                                @endif
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-slate-500 py-4 col-span-3 text-center">Đang cập nhật bảng giá dịch vụ website...</p>
                    @endforelse
                </div>
            </div>

            <!-- 02: THIẾT KẾ UI/UX THEO YÊU CẦU -->
            <div id="ui-ux" class="p-8 rounded-2xl bg-white border border-slate-200/90 shadow-sm flex flex-col gap-6 scroll-mt-28">
                <div class="border-b border-slate-100 pb-3 flex flex-col sm:flex-row sm:items-end justify-between gap-2">
                    <div>
                        <span class="text-xs font-bold text-primary uppercase">KHUNG 02</span>
                        <h2 class="text-xl sm:text-2xl font-bold text-[#070f1e] tracking-tight mt-0.5">
                            Thiết Kế UI/UX Theo Yêu Cầu
                        </h2>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="text-xs text-slate-500">Giao diện Figma &bull; Prototype tương tác &bull; Design System</span>
                        <a href="{{ url('/dich-vu/ui-ux') }}" class="text-xs font-bold text-primary hover:underline inline-flex items-center gap-1">
                            <span>Xem trang dịch vụ</span>
                            <span class="material-symbols-outlined text-[14px]">open_in_new</span>
                        </a>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @forelse($uiUxPlans as $plan)
                        <div class="p-6 rounded-xl {{ $plan->is_featured ? 'bg-white border-2 border-primary/40 ring-4 ring-primary/5 shadow-md' : 'bg-slate-50/70 border border-slate-200/70' }} space-y-4 flex flex-col justify-between transition-all duration-300 hover:shadow-lg">
                            <div class="space-y-3">
                                <div class="flex items-center justify-between gap-2">
                                    <h3 class="text-base font-bold text-[#070f1e]">{{ $plan->tier_name }}</h3>
                                    @if($plan->is_featured)
                                        <span class="text-xs font-semibold px-2.5 py-1 rounded bg-primary/10 text-primary shrink-0">Phổ biến</span>
                                    @elseif(!empty($plan->price_note))
                                        <span class="text-xs font-semibold px-2.5 py-1 rounded bg-slate-200/70 text-slate-700 shrink-0">{{ $plan->price_note }}</span>
                                    @endif
                                </div>
                                <div class="text-2xl font-extrabold text-[#070f1e]">
                                    {{ $plan->price_display }}
                                </div>
                                @if(!empty($plan->description))
                                    <p class="text-xs text-slate-600 leading-relaxed">
                                        {{ $plan->description }}
                                    </p>
                                @endif
                                @if(!empty($plan->features))
                                    <ul class="text-xs text-slate-600 space-y-1.5 pt-1">
                                        @foreach($plan->features as $feature)
                                            <li class="flex items-center gap-1.5">&bull; {{ $feature }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                            <div class="pt-2 flex flex-col gap-2">
                                <a href="{{ route('contact') }}?service={{ urlencode($plan->tier_name) }}" class="w-full py-2.5 px-4 rounded-xl {{ $plan->is_featured ? 'bg-primary text-white shadow-sm hover:bg-primary/90' : 'bg-slate-200/70 hover:bg-primary hover:text-white text-slate-800' }} font-bold text-xs text-center transition-all inline-flex items-center justify-center gap-1">
                                    <span>{{ $plan->cta_label ?: 'Đăng ký tư vấn →' }}</span>
                                </a>
                                @if($plan->target_url)
                                    <a href="{{ $plan->target_url }}" class="text-[11px] font-semibold text-slate-500 hover:text-primary text-center">
                                        Xem chi tiết trên trang &rarr;
                                    </a>
                                @endif
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-slate-500 py-4 col-span-3 text-center">Đang cập nhật bảng giá thiết kế UI/UX...</p>
                    @endforelse
                </div>
            </div>

            <!-- 03: QUẢNG CÁO & MARKETING -->
            <div id="marketing" class="p-8 rounded-2xl bg-white border border-slate-200/90 shadow-sm flex flex-col gap-6 scroll-mt-28">
                <div class="border-b border-slate-100 pb-3 flex flex-col sm:flex-row sm:items-end justify-between gap-2">
                    <div>
                        <span class="text-xs font-bold text-primary uppercase">KHUNG 03</span>
                        <h2 class="text-xl sm:text-2xl font-bold text-[#070f1e] tracking-tight mt-0.5">
                            Quảng Cáo &amp; Digital Marketing Tăng Trưởng
                        </h2>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="text-xs text-slate-500">Đo lường ROI &bull; Tối ưu chuyển đổi đa kênh</span>
                        <a href="{{ url('/dich-vu/marketing') }}" class="text-xs font-bold text-primary hover:underline inline-flex items-center gap-1">
                            <span>Xem trang dịch vụ</span>
                            <span class="material-symbols-outlined text-[14px]">open_in_new</span>
                        </a>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @forelse($marketingPlans as $plan)
                        <div class="p-6 rounded-xl {{ $plan->is_featured ? 'bg-white border-2 border-primary/40 ring-4 ring-primary/5 shadow-md' : 'bg-slate-50/70 border border-slate-200/70' }} space-y-4 flex flex-col justify-between transition-all duration-300 hover:shadow-lg">
                            <div class="space-y-3">
                                <div class="flex items-center justify-between gap-2">
                                    <h3 class="text-base font-bold text-[#070f1e]">{{ $plan->tier_name }}</h3>
                                    @if($plan->is_featured)
                                        <span class="text-xs font-semibold px-2.5 py-1 rounded bg-primary/10 text-primary shrink-0">Nổi bật</span>
                                    @elseif(!empty($plan->price_note))
                                        <span class="text-xs font-semibold px-2.5 py-1 rounded bg-slate-200/70 text-slate-700 shrink-0">{{ $plan->price_note }}</span>
                                    @endif
                                </div>
                                <div class="text-2xl font-extrabold text-[#070f1e]">
                                    {{ $plan->price_display }}
                                </div>
                                @if(!empty($plan->description))
                                    <p class="text-xs text-slate-600 leading-relaxed">
                                        {{ $plan->description }}
                                    </p>
                                @endif
                                @if(!empty($plan->features))
                                    <ul class="text-xs text-slate-600 space-y-1.5 pt-1">
                                        @foreach($plan->features as $feature)
                                            <li class="flex items-center gap-1.5">&bull; {{ $feature }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                            <div class="pt-2 flex flex-col gap-2">
                                <a href="{{ route('contact') }}?service={{ urlencode($plan->tier_name) }}" class="w-full py-2.5 px-4 rounded-xl {{ $plan->is_featured ? 'bg-primary text-white shadow-sm hover:bg-primary/90' : 'bg-slate-200/70 hover:bg-primary hover:text-white text-slate-800' }} font-bold text-xs text-center transition-all inline-flex items-center justify-center gap-1">
                                    <span>{{ $plan->cta_label ?: 'Tư vấn chiến lược marketing' }}</span>
                                    <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
                                </a>
                                @if($plan->target_url)
                                    <a href="{{ $plan->target_url }}" class="text-[11px] font-semibold text-slate-500 hover:text-primary text-center">
                                        Xem chi tiết trên trang &rarr;
                                    </a>
                                @endif
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-slate-500 py-4 col-span-3 text-center">Đang cập nhật bảng giá dịch vụ marketing...</p>
                    @endforelse
                </div>
            </div>

            <!-- 04: QUẢN TRỊ & CHĂM SÓC WEBSITE -->
            <div id="website-care" class="p-8 rounded-2xl bg-white border border-slate-200/90 shadow-sm flex flex-col gap-6 scroll-mt-28">
                <div class="border-b border-slate-100 pb-3 flex flex-col sm:flex-row sm:items-end justify-between gap-2">
                    <div>
                        <span class="text-xs font-bold text-primary uppercase">KHUNG 04</span>
                        <h2 class="text-xl sm:text-2xl font-bold text-[#070f1e] tracking-tight mt-0.5">
                            Quản Trị &amp; Chăm Sóc Website Doanh Nghiệp
                        </h2>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="text-xs text-slate-500">Bảo mật SSL &bull; Backup dữ liệu &bull; Tối ưu PageSpeed 90+</span>
                        <a href="{{ url('/dich-vu/quan-tri-website') }}" class="text-xs font-bold text-primary hover:underline inline-flex items-center gap-1">
                            <span>Xem trang dịch vụ</span>
                            <span class="material-symbols-outlined text-[14px]">open_in_new</span>
                        </a>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @forelse($websiteCarePlans as $plan)
                        <div class="p-6 rounded-xl {{ $plan->is_featured ? 'bg-white border-2 border-primary/40 ring-4 ring-primary/5 shadow-md' : 'bg-slate-50/70 border border-slate-200/70' }} space-y-4 flex flex-col justify-between transition-all duration-300 hover:shadow-lg">
                            <div class="space-y-3">
                                <div class="flex items-center justify-between gap-2">
                                    <h3 class="text-base font-bold text-[#070f1e]">{{ $plan->tier_name }}</h3>
                                    @if($plan->is_featured)
                                        <span class="text-xs font-semibold px-2.5 py-1 rounded bg-primary/10 text-primary shrink-0">Phổ biến</span>
                                    @elseif(!empty($plan->price_note))
                                        <span class="text-xs font-semibold px-2.5 py-1 rounded bg-slate-200/70 text-slate-700 shrink-0">{{ $plan->price_note }}</span>
                                    @endif
                                </div>
                                <div class="text-2xl font-extrabold text-[#070f1e]">
                                    {{ $plan->price_display }}
                                </div>
                                @if(!empty($plan->features))
                                    <ul class="text-xs text-slate-600 space-y-1.5 pt-1">
                                        @foreach($plan->features as $feature)
                                            <li class="flex items-center gap-1.5">&bull; {{ $feature }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                            <div class="pt-2 flex flex-col gap-2">
                                <a href="{{ route('contact') }}?service={{ urlencode($plan->tier_name) }}" class="w-full py-2.5 px-4 rounded-xl {{ $plan->is_featured ? 'bg-primary text-white shadow-sm hover:bg-primary/90' : 'bg-slate-200/70 hover:bg-primary hover:text-white text-slate-800' }} font-bold text-xs text-center transition-all inline-flex items-center justify-center gap-1">
                                    <span>{{ $plan->cta_label ?: 'Đăng ký ' . $plan->tier_name }}</span>
                                </a>
                                @if($plan->target_url)
                                    <a href="{{ $plan->target_url }}" class="text-[11px] font-semibold text-slate-500 hover:text-primary text-center">
                                        Xem chi tiết trên trang &rarr;
                                    </a>
                                @endif
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-slate-500 py-4 col-span-3 text-center">Đang cập nhật bảng giá quản trị website...</p>
                    @endforelse
                </div>
            </div>

            <!-- 05: SẢN XUẤT VIDEO & TVC -->
            <div id="tvc" class="p-8 rounded-2xl bg-white border border-slate-200/90 shadow-sm flex flex-col gap-6 scroll-mt-28">
                <div class="border-b border-slate-100 pb-3 flex flex-col sm:flex-row sm:items-end justify-between gap-2">
                    <div>
                        <span class="text-xs font-bold text-primary uppercase">KHUNG 05</span>
                        <h2 class="text-xl sm:text-2xl font-bold text-[#070f1e] tracking-tight mt-0.5">
                            Sản Xuất Video &amp; TVC Doanh Nghiệp
                        </h2>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="text-xs text-slate-500">Chuẩn điện ảnh 4K &bull; Kịch bản may đo độc quyền</span>
                        <a href="{{ url('/dich-vu/quay-phim-su-kien') }}" class="text-xs font-bold text-primary hover:underline inline-flex items-center gap-1">
                            <span>Xem trang dịch vụ</span>
                            <span class="material-symbols-outlined text-[14px]">open_in_new</span>
                        </a>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @forelse($tvcPlans as $plan)
                        <div class="p-6 rounded-xl {{ $plan->is_featured ? 'bg-white border-2 border-primary/40 ring-4 ring-primary/5 shadow-md' : 'bg-slate-50/70 border border-slate-200/70' }} space-y-4 flex flex-col justify-between transition-all duration-300 hover:shadow-lg">
                            <div class="space-y-3">
                                <div class="flex items-center justify-between gap-2">
                                    <h3 class="text-base font-bold text-[#070f1e]">{{ $plan->tier_name }}</h3>
                                    @if($plan->is_featured)
                                        <span class="text-xs font-semibold px-2.5 py-1 rounded bg-primary/10 text-primary shrink-0">Nổi bật</span>
                                    @elseif(!empty($plan->price_note))
                                        <span class="text-xs font-semibold px-2.5 py-1 rounded bg-slate-200/70 text-slate-700 shrink-0">{{ $plan->price_note }}</span>
                                    @endif
                                </div>
                                <div class="text-2xl font-extrabold text-[#070f1e]">
                                    {{ $plan->price_display }}
                                </div>
                                @if(!empty($plan->features))
                                    <ul class="text-xs text-slate-600 space-y-1.5 pt-1">
                                        @foreach($plan->features as $feature)
                                            <li class="flex items-center gap-1.5">&bull; {{ $feature }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                            <div class="pt-2 flex flex-col gap-2">
                                <a href="{{ route('contact') }}?service={{ urlencode($plan->tier_name) }}" class="w-full py-2.5 px-4 rounded-xl {{ $plan->is_featured ? 'bg-primary text-white shadow-sm hover:bg-primary/90' : 'bg-slate-200/70 hover:bg-primary hover:text-white text-slate-800' }} font-bold text-xs text-center transition-all inline-flex items-center justify-center gap-1">
                                    <span>{{ $plan->cta_label ?: 'Yêu cầu tư vấn sản xuất' }}</span>
                                    <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
                                </a>
                                @if($plan->target_url)
                                    <a href="{{ $plan->target_url }}" class="text-[11px] font-semibold text-slate-500 hover:text-primary text-center">
                                        Xem chi tiết trên trang &rarr;
                                    </a>
                                @endif
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-slate-500 py-4 col-span-3 text-center">Đang cập nhật bảng giá video & TVC...</p>
                    @endforelse
                </div>
            </div>

            <!-- 06: CHỤP ẢNH SỰ KIỆN DOANH NGHIỆP -->
            <div id="event-photography" class="p-8 rounded-2xl bg-white border border-slate-200/90 shadow-sm flex flex-col gap-6 scroll-mt-28">
                <div class="border-b border-slate-100 pb-3 flex flex-col sm:flex-row sm:items-end justify-between gap-2">
                    <div>
                        <span class="text-xs font-bold text-primary uppercase">KHUNG 06</span>
                        <h2 class="text-xl sm:text-2xl font-bold text-[#070f1e] tracking-tight mt-0.5">
                            Chụp Ảnh Sự Kiện Chuyên Nghiệp
                        </h2>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="text-xs text-slate-500">Hội nghị &bull; Khai trương &bull; Gala Dinner &bull; Live Photo QR</span>
                        <a href="{{ url('/dich-vu/chup-anh-su-kien') }}" class="text-xs font-bold text-primary hover:underline inline-flex items-center gap-1">
                            <span>Xem trang dịch vụ</span>
                            <span class="material-symbols-outlined text-[14px]">open_in_new</span>
                        </a>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @forelse($eventPhotoPlans as $plan)
                        <div class="p-6 rounded-xl {{ $plan->is_featured ? 'bg-white border-2 border-primary/40 ring-4 ring-primary/5 shadow-md' : 'bg-slate-50/70 border border-slate-200/70' }} space-y-4 flex flex-col justify-between transition-all duration-300 hover:shadow-lg">
                            <div class="space-y-3">
                                <div class="flex items-center justify-between gap-2">
                                    <h3 class="text-base font-bold text-[#070f1e]">{{ $plan->tier_name }}</h3>
                                    @if($plan->is_featured)
                                        <span class="text-xs font-semibold px-2.5 py-1 rounded bg-primary/10 text-primary shrink-0">Phổ biến</span>
                                    @elseif(!empty($plan->price_note))
                                        <span class="text-xs font-semibold px-2.5 py-1 rounded bg-slate-200/70 text-slate-700 shrink-0">{{ $plan->price_note }}</span>
                                    @endif
                                </div>
                                <div class="text-2xl font-extrabold text-[#070f1e]">
                                    {{ $plan->price_display }}
                                </div>
                                @if(!empty($plan->features))
                                    <ul class="text-xs text-slate-600 space-y-1.5 pt-1">
                                        @foreach($plan->features as $feature)
                                            <li class="flex items-center gap-1.5">&bull; {{ $feature }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                            <div class="pt-2 flex flex-col gap-2">
                                <a href="{{ route('contact') }}?service={{ urlencode($plan->tier_name) }}" class="w-full py-2.5 px-4 rounded-xl {{ $plan->is_featured ? 'bg-primary text-white shadow-sm hover:bg-primary/90' : 'bg-slate-200/70 hover:bg-primary hover:text-white text-slate-800' }} font-bold text-xs text-center transition-all inline-flex items-center justify-center gap-1">
                                    <span>{{ $plan->cta_label ?: 'Liên hệ nhận báo giá' }}</span>
                                </a>
                                @if($plan->target_url)
                                    <a href="{{ $plan->target_url }}" class="text-[11px] font-semibold text-slate-500 hover:text-primary text-center">
                                        Xem chi tiết trên trang &rarr;
                                    </a>
                                @endif
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-slate-500 py-4 col-span-3 text-center">Đang cập nhật bảng giá chụp ảnh sự kiện...</p>
                    @endforelse
                </div>
            </div>

            <!-- 07: QUAY PHIM SỰ KIỆN CHUYÊN NGHIỆP -->
            <div id="event-videography" class="p-8 rounded-2xl bg-white border border-slate-200/90 shadow-sm flex flex-col gap-6 scroll-mt-28">
                <div class="border-b border-slate-100 pb-3 flex flex-col sm:flex-row sm:items-end justify-between gap-2">
                    <div>
                        <span class="text-xs font-bold text-primary uppercase">KHUNG 07</span>
                        <h2 class="text-xl sm:text-2xl font-bold text-[#070f1e] tracking-tight mt-0.5">
                            Quay Phim Sự Kiện Chuyên Nghiệp
                        </h2>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="text-xs text-slate-500">Máy quay 4K/6K &bull; Gimbal RS3 &bull; Dựng Highlight &amp; Full Recap</span>
                        <a href="{{ url('/dich-vu/quay-phim-su-kien') }}" class="text-xs font-bold text-primary hover:underline inline-flex items-center gap-1">
                            <span>Xem trang dịch vụ</span>
                            <span class="material-symbols-outlined text-[14px]">open_in_new</span>
                        </a>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @forelse($eventVideoPlans as $plan)
                        <div class="p-6 rounded-xl {{ $plan->is_featured ? 'bg-white border-2 border-primary/40 ring-4 ring-primary/5 shadow-md' : 'bg-slate-50/70 border border-slate-200/70' }} space-y-4 flex flex-col justify-between transition-all duration-300 hover:shadow-lg">
                            <div class="space-y-3">
                                <div class="flex items-center justify-between gap-2">
                                    <h3 class="text-base font-bold text-[#070f1e]">{{ $plan->tier_name }}</h3>
                                    @if($plan->is_featured)
                                        <span class="text-xs font-semibold px-2.5 py-1 rounded bg-primary/10 text-primary shrink-0">Phổ biến</span>
                                    @elseif(!empty($plan->price_note))
                                        <span class="text-xs font-semibold px-2 py-0.5 rounded bg-slate-200/70 text-slate-700 shrink-0 text-[10.5px]">{{ $plan->price_note }}</span>
                                    @endif
                                </div>
                                <div class="text-2xl font-extrabold text-[#070f1e]">
                                    {{ $plan->price_display }}
                                </div>
                                @if(!empty($plan->features))
                                    <ul class="text-xs text-slate-600 space-y-1.5 pt-1">
                                        @foreach($plan->features as $feature)
                                            <li class="flex items-center gap-1.5">&bull; {{ $feature }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                            <div class="pt-2 flex flex-col gap-2">
                                <a href="{{ route('contact') }}?service={{ urlencode($plan->tier_name) }}" class="w-full py-2.5 px-4 rounded-xl {{ $plan->is_featured ? 'bg-primary text-white shadow-sm hover:bg-primary/90' : 'bg-slate-200/70 hover:bg-primary hover:text-white text-slate-800' }} font-bold text-xs text-center transition-all inline-flex items-center justify-center gap-1">
                                    <span>{{ $plan->cta_label ?: 'Đăng ký tư vấn' }}</span>
                                </a>
                                @if($plan->target_url)
                                    <a href="{{ $plan->target_url }}" class="text-[11px] font-semibold text-slate-500 hover:text-primary text-center">
                                        Xem chi tiết trên trang &rarr;
                                    </a>
                                @endif
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-slate-500 py-4 col-span-4 text-center">Đang cập nhật bảng giá quay phim sự kiện...</p>
                    @endforelse
                </div>
            </div>

            <!-- 08: CHỤP ẢNH & QUAY PHIM TEAMBUILDING -->
            <div id="teambuilding" class="p-8 rounded-2xl bg-white border border-slate-200/90 shadow-sm flex flex-col gap-6 scroll-mt-28">
                <div class="border-b border-slate-100 pb-3 flex flex-col sm:flex-row sm:items-end justify-between gap-2">
                    <div>
                        <span class="text-xs font-bold text-primary uppercase">KHUNG 08</span>
                        <h2 class="text-xl sm:text-2xl font-bold text-[#070f1e] tracking-tight mt-0.5">
                            Chụp Ảnh &amp; Quay Phim TeamBuilding Doanh Nghiệp
                        </h2>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="text-xs text-slate-500">Lưu giữ năng lượng &amp; tinh thần gắn kết</span>
                        <a href="{{ url('/dich-vu/chup-anh-teambuilding') }}" class="text-xs font-bold text-primary hover:underline inline-flex items-center gap-1">
                            <span>Chụp Teambuilding</span>
                            <span class="material-symbols-outlined text-[14px]">open_in_new</span>
                        </a>
                        <span class="text-slate-300">|</span>
                        <a href="{{ url('/dich-vu/quay-phim-teambuilding') }}" class="text-xs font-bold text-primary hover:underline inline-flex items-center gap-1">
                            <span>Quay Teambuilding</span>
                            <span class="material-symbols-outlined text-[14px]">open_in_new</span>
                        </a>
                    </div>
                </div>

                <!-- Chụp Ảnh Teambuilding Grid -->
                <div class="space-y-4">
                    <h3 class="text-sm font-bold uppercase tracking-wider text-slate-500 flex items-center gap-2">
                        <span class="material-symbols-outlined text-base text-primary">photo_camera</span>
                        <span>Các Gói Chụp Ảnh TeamBuilding</span>
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @foreach($teamPhotoPlans as $plan)
                            <div class="p-6 rounded-xl {{ $plan->is_featured ? 'bg-white border-2 border-primary/40 ring-4 ring-primary/5 shadow-md' : 'bg-slate-50/70 border border-slate-200/70' }} space-y-4 flex flex-col justify-between transition-all duration-300 hover:shadow-lg">
                                <div class="space-y-3">
                                    @if(!empty($plan->thumbnail_url))
                                        <div class="w-full h-36 rounded-lg overflow-hidden bg-slate-100 mb-2">
                                            <img src="{{ $plan->thumbnail_url }}" alt="{{ $plan->tier_name }}" class="w-full h-full object-cover">
                                        </div>
                                    @endif
                                    <div class="flex items-center justify-between gap-2">
                                        <h4 class="text-base font-bold text-[#070f1e]">{{ $plan->tier_name }}</h4>
                                        @if($plan->is_featured)
                                            <span class="text-xs font-semibold px-2.5 py-1 rounded bg-primary/10 text-primary shrink-0">Phổ biến</span>
                                        @elseif(!empty($plan->price_note))
                                            <span class="text-xs font-semibold px-2 py-0.5 rounded bg-slate-200/70 text-slate-700 shrink-0 text-[10.5px]">{{ $plan->price_note }}</span>
                                        @endif
                                    </div>
                                    <div class="text-2xl font-extrabold text-[#070f1e]">
                                        {{ $plan->price_display }}
                                    </div>
                                    @if(!empty($plan->features))
                                        <ul class="text-xs text-slate-600 space-y-1.5 pt-1">
                                            @foreach($plan->features as $feature)
                                                <li class="flex items-center gap-1.5">&bull; {{ $feature }}</li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                                <div class="pt-2 flex flex-col gap-2">
                                    <a href="{{ route('contact') }}?service={{ urlencode($plan->tier_name . ' Chụp Ảnh Teambuilding') }}" class="w-full py-2.5 px-4 rounded-xl {{ $plan->is_featured ? 'bg-primary text-white shadow-sm hover:bg-primary/90' : 'bg-slate-200/70 hover:bg-primary hover:text-white text-slate-800' }} font-bold text-xs text-center transition-all inline-flex items-center justify-center gap-1">
                                        <span>{{ $plan->cta_label ?: 'Liên hệ tư vấn' }}</span>
                                    </a>
                                    @if($plan->target_url)
                                        <a href="{{ $plan->target_url }}" class="text-[11px] font-semibold text-slate-500 hover:text-primary text-center">
                                            Xem chi tiết trên trang &rarr;
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Quay Phim Teambuilding Grid -->
                <div class="space-y-4 pt-6 border-t border-slate-100">
                    <h3 class="text-sm font-bold uppercase tracking-wider text-slate-500 flex items-center gap-2">
                        <span class="material-symbols-outlined text-base text-primary">videocam</span>
                        <span>Các Gói Quay Phim TeamBuilding</span>
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @foreach($teamVideoPlans as $plan)
                            <div class="p-6 rounded-xl {{ $plan->is_featured ? 'bg-white border-2 border-primary/40 ring-4 ring-primary/5 shadow-md' : 'bg-slate-50/70 border border-slate-200/70' }} space-y-4 flex flex-col justify-between transition-all duration-300 hover:shadow-lg">
                                <div class="space-y-3">
                                    @if(!empty($plan->thumbnail_url))
                                        <div class="w-full h-36 rounded-lg overflow-hidden bg-slate-100 mb-2">
                                            <img src="{{ $plan->thumbnail_url }}" alt="{{ $plan->tier_name }}" class="w-full h-full object-cover">
                                        </div>
                                    @endif
                                    <div class="flex items-center justify-between gap-2">
                                        <h4 class="text-base font-bold text-[#070f1e]">{{ $plan->tier_name }}</h4>
                                        @if($plan->is_featured)
                                            <span class="text-xs font-semibold px-2.5 py-1 rounded bg-primary/10 text-primary shrink-0">Phổ biến</span>
                                        @elseif(!empty($plan->price_note))
                                            <span class="text-xs font-semibold px-2 py-0.5 rounded bg-slate-200/70 text-slate-700 shrink-0 text-[10.5px]">{{ $plan->price_note }}</span>
                                        @endif
                                    </div>
                                    <div class="text-2xl font-extrabold text-[#070f1e]">
                                        {{ $plan->price_display }}
                                    </div>
                                    @if(!empty($plan->features))
                                        <ul class="text-xs text-slate-600 space-y-1.5 pt-1">
                                            @foreach($plan->features as $feature)
                                                <li class="flex items-center gap-1.5">&bull; {{ $feature }}</li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                                <div class="pt-2 flex flex-col gap-2">
                                    <a href="{{ route('contact') }}?service={{ urlencode($plan->tier_name . ' Quay Phim Teambuilding') }}" class="w-full py-2.5 px-4 rounded-xl {{ $plan->is_featured ? 'bg-primary text-white shadow-sm hover:bg-primary/90' : 'bg-slate-200/70 hover:bg-primary hover:text-white text-slate-800' }} font-bold text-xs text-center transition-all inline-flex items-center justify-center gap-1">
                                        <span>{{ $plan->cta_label ?: 'Đăng ký tư vấn' }}</span>
                                    </a>
                                    @if($plan->target_url)
                                        <a href="{{ $plan->target_url }}" class="text-[11px] font-semibold text-slate-500 hover:text-primary text-center">
                                            Xem chi tiết trên trang &rarr;
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- 09: HỆ THỐNG THEO YÊU CẦU -->
            <div id="custom-erp" class="p-8 rounded-2xl bg-white border border-slate-200/90 shadow-sm flex flex-col gap-4 scroll-mt-28">
                <div class="border-b border-slate-100 pb-3 flex flex-col sm:flex-row sm:items-end justify-between gap-2">
                    <div>
                        <span class="text-xs font-bold text-primary uppercase">KHUNG 09</span>
                        <h2 class="text-xl sm:text-2xl font-bold text-[#070f1e] tracking-tight mt-0.5">
                            Hệ Thống Phần Mềm Doanh Nghiệp Theo Yêu Cầu (Custom ERP / CRM / App)
                        </h2>
                    </div>
                    <span class="text-xs font-semibold px-2.5 py-1 rounded bg-slate-100 text-slate-700">Khảo sát &bull; Báo giá theo SRS</span>
                </div>

                <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                    Đối với các hệ thống quản trị nội bộ phức hợp, việc đưa ra một con số cố định trước khi khảo sát là thiếu trách nhiệm kỹ thuật. Chúng tôi làm việc trực tiếp cùng ban lãnh đạo để lập <strong>Tài liệu đặc tả yêu cầu phần mềm (SRS - Software Requirements Specification)</strong>, bóc tách từng phân hệ và báo giá chi tiết theo từng mốc bàn giao.
                </p>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 pt-2">
                    <div class="p-4 rounded-xl bg-slate-50 border border-slate-200/60 space-y-1">
                        <span class="text-xs font-bold text-[#070f1e] block">1. Khảo sát &amp; Lập SRS</span>
                        <span class="text-xs text-slate-500">Phân tích luồng nghiệp vụ và lập danh sách tính năng cụ thể.</span>
                    </div>
                    <div class="p-4 rounded-xl bg-slate-50 border border-slate-200/60 space-y-1">
                        <span class="text-xs font-bold text-[#070f1e] block">2. Dự toán theo Module</span>
                        <span class="text-xs text-slate-500">Định lượng ngày công (man-days) cho từng hạng mục minh bạch.</span>
                    </div>
                    <div class="p-4 rounded-xl bg-slate-50 border border-slate-200/60 space-y-1">
                        <span class="text-xs font-bold text-[#070f1e] block">3. Nghiệm thu theo Chặng</span>
                        <span class="text-xs text-slate-500">Thanh toán theo tiến độ hoàn thành các mốc bàn giao thực tế.</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- ==================== CÁC YẾU TỐ ẢNH HƯỞNG CHI PHÍ ==================== -->
        <section class="p-8 rounded-2xl bg-white border border-slate-200/90 shadow-sm flex flex-col gap-6">
            <div class="border-b border-slate-100 pb-3">
                <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Minh bạch định giá</span>
                <h2 class="text-xl sm:text-2xl font-bold text-[#070f1e] tracking-tight mt-1">
                    4 Yếu Tố Ảnh Hưởng Đến Chi Phí Triển Khai
                </h2>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                <div class="space-y-1.5">
                    <span class="text-base font-bold text-primary">01</span>
                    <h3 class="text-sm font-bold text-[#070f1e]">Độ phức tạp quy trình</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Số lượng màn hình nghiệp vụ, công thức tính toán tự động và các trường hợp xử lý ngoại lệ phát sinh.
                    </p>
                </div>

                <div class="space-y-1.5">
                    <span class="text-base font-bold text-primary">02</span>
                    <h3 class="text-sm font-bold text-[#070f1e]">Quy mô phân quyền</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Số lượng cấp tài khoản, phạm vi giới hạn dữ liệu giữa các chi nhánh và yêu cầu giám sát kiểm toán.
                    </p>
                </div>

                <div class="space-y-1.5">
                    <span class="text-base font-bold text-primary">03</span>
                    <h3 class="text-sm font-bold text-[#070f1e]">Tích hợp hệ thống ngoài</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Độ phức tạp khi kết nối với cổng thanh toán ngân hàng, phần mềm hóa đơn điện tử hoặc cơ sở dữ liệu cũ.
                    </p>
                </div>

                <div class="space-y-1.5">
                    <span class="text-base font-bold text-primary">04</span>
                    <h3 class="text-sm font-bold text-[#070f1e]">Yêu cầu bảo mật &amp; tải</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Tiêu chuẩn bảo mật dữ liệu nhạy cảm, cơ chế mã hóa và khả năng đáp ứng lượng truy cập đồng thời lớn.
                    </p>
                </div>
            </div>
        </section>

        <!-- ==================== QUY TRÌNH BÁO GIÁ ==================== -->
        <section class="p-8 rounded-2xl bg-white border border-slate-200/90 shadow-sm flex flex-col gap-6">
            <div class="border-b border-slate-100 pb-3">
                <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Quy chuẩn làm việc</span>
                <h2 class="text-xl sm:text-2xl font-bold text-[#070f1e] tracking-tight mt-1">
                    Quy Trình Tiếp Nhận &amp; Báo Giá
                </h2>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="space-y-1.5">
                    <span class="text-xs font-bold text-slate-400">BƯỚC 01</span>
                    <h3 class="text-sm font-bold text-[#070f1e]">Tiếp nhận yêu cầu</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Lắng nghe sơ bộ về hiện trạng và mục tiêu nghiệp vụ cần xây dựng của khách hàng.
                    </p>
                </div>
                <div class="space-y-1.5">
                    <span class="text-xs font-bold text-slate-400">BƯỚC 02</span>
                    <h3 class="text-sm font-bold text-[#070f1e]">Bóc tách phạm vi (SOW)</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Lập danh mục chức năng rõ ràng, xác định công nghệ phù hợp và thời gian hoàn thành.
                    </p>
                </div>
                <div class="space-y-1.5">
                    <span class="text-xs font-bold text-slate-400">BƯỚC 03</span>
                    <h3 class="text-sm font-bold text-[#070f1e]">Gửi bảng dự toán chi tiết</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Gửi báo giá chính thức kèm timeline tiến độ và các điều khoản nghiệm thu minh bạch.
                    </p>
                </div>
                <div class="space-y-1.5">
                    <span class="text-xs font-bold text-slate-400">BƯỚC 04</span>
                    <h3 class="text-sm font-bold text-[#070f1e]">Ký kết &amp; Triển khai</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Ký kết hợp đồng pháp lý đầy đủ và bắt đầu thực hiện theo các mốc milestone cam kết.
                    </p>
                </div>
            </div>
        </section>

        <!-- ==================== FAQ ==================== -->
        <section class="flex flex-col gap-6">
            <div class="border-b border-slate-200 pb-3">
                <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Hỏi đáp chi phí</span>
                <h2 class="text-xl sm:text-2xl font-bold text-[#070f1e] tracking-tight mt-1">
                    Các Câu Hỏi Thường Gặp Về Chi Phí
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="p-5 rounded-xl bg-white border border-slate-200/90 space-y-2">
                    <h3 class="text-sm font-bold text-[#070f1e]">Có phát sinh chi phí ngoài hợp đồng không?</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Không. Bảng dự toán của Cửu Long bám sát phạm vi công việc (Scope of Work) đã thống nhất bằng văn bản. Chúng tôi chỉ tính thêm phí khi khách hàng chủ động yêu cầu mở rộng tính năng mới ngoài phạm vi ban đầu.
                    </p>
                </div>

                <div class="p-5 rounded-xl bg-white border border-slate-200/90 space-y-2">
                    <h3 class="text-sm font-bold text-[#070f1e]">Phương thức thanh toán như thế nào?</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Thông thường được chia làm 3 đợt: Tạm ứng khi ký hợp đồng (40%), Thanh toán sau khi hoàn thành bản vẽ kiến trúc &amp; nghiệm thu Demo (30%), Thanh toán đợt cuối khi bàn giao mã nguồn chính thức (30%).
                    </p>
                </div>

                <div class="p-5 rounded-xl bg-white border border-slate-200/90 space-y-2">
                    <h3 class="text-sm font-bold text-[#070f1e]">Chi phí duy trì hàng năm bao gồm những gì?</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Doanh nghiệp chỉ cần thanh toán phí duy trì tên miền (domain) và máy chủ lưu trữ (hosting/VPS) cho các nhà cung cấp hạ tầng. Mã nguồn thuộc quyền sở hữu vĩnh viễn của quý khách, không phải thuê bao hàng tháng.
                    </p>
                </div>

                <div class="p-5 rounded-xl bg-white border border-slate-200/90 space-y-2">
                    <h3 class="text-sm font-bold text-[#070f1e]">Doanh nghiệp có nhận toàn bộ mã nguồn không?</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Có. 100% mã nguồn và cơ sở dữ liệu được bàn giao toàn vẹn cho khách hàng sau khi thanh lý hợp đồng. Quý khách hoàn toàn tự do lưu trữ và phát triển tiếp về sau.
                    </p>
                </div>
            </div>
        </section>

        <!-- ==================== FINAL CTA ==================== -->
        <section class="rounded-2xl bg-[#070f1e] text-white p-8 sm:p-12 text-center flex flex-col items-center gap-5 shadow-xl">
            <span class="text-xs text-amber-400 font-bold uppercase tracking-wider">BẮT ĐẦU DỰ ÁN</span>
            <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-white">
                Cần Dự Toán Chính Xác Cho Dự Án Của Bạn?
            </h2>
            <p class="text-slate-300 text-xs sm:text-sm max-w-xl leading-relaxed">
                Hãy gửi cho chúng tôi mô tả yêu cầu hoặc bản phác thảo bài toán của bạn để nhận phân tích kỹ thuật và bảng dự toán chi tiết trong 24 giờ làm việc.
            </p>
            <div class="flex flex-wrap items-center justify-center gap-3 pt-2">
                <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 px-6 py-3.5 rounded-xl bg-amber-400 hover:bg-amber-300 text-slate-950 text-xs sm:text-sm font-bold shadow-sm transition-all">
                    <span>Yêu cầu báo giá chi tiết</span>
                    <span class="material-symbols-outlined text-[16px]" aria-hidden="true">arrow_forward</span>
                </a>
                <a href="tel:{{ preg_replace('/[^0-9+]/', '', get_setting('company_phone', '0939.363.262')) }}" class="inline-flex items-center gap-2 px-6 py-3.5 rounded-xl bg-white/10 hover:bg-white/15 text-white text-xs sm:text-sm font-semibold border border-white/15 transition-all">
                    <span class="material-symbols-outlined text-[16px] text-amber-400" aria-hidden="true">call</span>
                    <span>Tư vấn qua Hotline: {{ get_setting('company_phone', '0939.363.262') }}</span>
                </a>
            </div>
        </section>

    </x-ui.container>
</div>
@endsection
