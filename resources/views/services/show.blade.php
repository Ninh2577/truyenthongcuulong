@extends('layouts.app')

@section('title', $service->title . ' - Truyền Thông Cửu Long')
@section('meta_description', $service->summary ?: 'Dịch vụ ' . $service->title . ' chuyên nghiệp tại Truyền Thông Cửu Long.')

@section('content')
<div class="w-full bg-surface bg-dot-grid-subtle pt-28 pb-20 border-b border-slate-200/60">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col gap-16">
        
        <!-- Breadcrumb -->
        <nav class="flex items-center gap-2 text-xs font-headline text-slate-500">
            <a href="{{ route('home') }}" class="hover:text-primary">Trang chủ</a>
            <span>/</span>
            <a href="{{ route('services.index') }}" class="hover:text-primary">Dịch vụ</a>
            <span>/</span>
            <span class="text-navy-base font-bold">{{ $service->title }}</span>
        </nav>

        <!-- Service Hero -->
        <div class="p-8 sm:p-12 rounded-3xl bg-navy-base text-white border border-slate-700 shadow-2xl flex flex-col lg:flex-row items-center justify-between gap-10 relative overflow-hidden">
            <div class="absolute -right-20 -top-20 w-96 h-96 rounded-full bg-primary/20 blur-3xl pointer-events-none"></div>
            <div class="flex flex-col gap-4 max-w-2xl relative z-10">
                <span class="font-mono text-xs text-accent-amber font-bold uppercase tracking-wider">ENTERPRISE SERVICE</span>
                <h1 class="font-headline text-3xl sm:text-5xl font-extrabold text-white tracking-tight leading-tight">
                    {{ $service->title }}
                </h1>
                <p class="font-body text-slate-300 text-sm sm:text-base leading-relaxed">
                    {{ $service->summary ?: 'Giải pháp chuyên sâu được thiết kế riêng biệt nhằm tối ưu hóa hiệu quả nhận diện thương hiệu và chuyển đổi doanh thu cho doanh nghiệp.' }}
                </p>
                <div class="flex flex-wrap items-center gap-4 pt-2">
                    <a href="#booking-form" class="px-7 py-3.5 rounded-full bg-gradient-to-r from-primary to-accent-amber text-white font-headline text-xs font-bold shadow-lg hover:scale-105 transition-all">
                        Đăng Ký Tư Vấn Ngay
                    </a>
                    <a href="{{ route('projects.index') }}" class="px-6 py-3.5 rounded-full bg-white/10 hover:bg-white/20 text-white font-headline text-xs font-bold transition-all">
                        Xem Các Dự Án Đã Làm
                    </a>
                </div>
            </div>
            <div class="w-full lg:w-96 rounded-2xl overflow-hidden bg-slate-800 border border-white/10 shadow-lg shrink-0">
                @if($service->thumbnail)
                <img src="{{ asset('storage/' . $service->thumbnail) }}" alt="{{ $service->title }}" class="w-full h-64 object-cover">
                @else
                <div class="w-full h-64 flex flex-col items-center justify-center bg-gradient-to-br from-navy-surface to-navy-card p-6 text-center text-slate-400">
                    <span class="material-symbols-outlined text-6xl text-primary mb-2">design_services</span>
                    <span class="font-headline text-sm font-bold text-white">{{ $service->title }}</span>
                </div>
                @endif
            </div>
        </div>

        <!-- Service Detailed Content -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
            
            <!-- Left: Description and 5-step Workflow -->
            <div class="lg:col-span-7 flex flex-col gap-10">
                <div class="prose prose-slate max-w-none text-slate-700 leading-relaxed font-body text-base">
                    {!! $service->content ?: '<p>Quy trình triển khai dịch vụ được kiểm soát nghiêm ngặt theo các tiêu chuẩn kỹ thuật hàng đầu, đảm bảo tiến độ bàn giao chính xác và bảo hành dài hạn.</p>' !!}
                </div>

                <!-- 5-step Workflow Section -->
                <div class="p-8 rounded-3xl bg-white border border-slate-200 shadow-xs flex flex-col gap-6">
                    <h3 class="font-headline text-xl font-bold text-navy-base flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">route</span>
                        <span>Quy Trình Triển Khai Dịch Vụ</span>
                    </h3>
                    <div class="space-y-4">
                        <div class="flex items-start gap-4">
                            <span class="w-7 h-7 rounded-full bg-orange-100 text-primary font-bold text-xs flex items-center justify-center shrink-0 mt-0.5">1</span>
                            <div>
                                <h4 class="font-headline text-sm font-bold text-navy-base">Tiếp nhận yêu cầu &amp; Khảo sát hiện trạng</h4>
                                <p class="text-xs text-slate-500 mt-0.5">Chuyên gia Truyền Thông Cửu Long lắng nghe bài toán và phân tích mục tiêu kinh doanh cụ thể.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <span class="w-7 h-7 rounded-full bg-orange-100 text-primary font-bold text-xs flex items-center justify-center shrink-0 mt-0.5">2</span>
                            <div>
                                <h4 class="font-headline text-sm font-bold text-navy-base">Lên phương án kịch bản / Thiết kế kỹ thuật</h4>
                                <p class="text-xs text-slate-500 mt-0.5">Bàn giao proposal chi tiết, báo giá minh bạch và ký hợp đồng cam kết SLA.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <span class="w-7 h-7 rounded-full bg-orange-100 text-primary font-bold text-xs flex items-center justify-center shrink-0 mt-0.5">3</span>
                            <div>
                                <h4 class="font-headline text-sm font-bold text-navy-base">Thực thi sản xuất / Lập trình tính năng</h4>
                                <p class="text-xs text-slate-500 mt-0.5">Ekip Senior trực tiếp bấm máy hoặc đội ngũ kỹ sư tiến hành code hệ thống.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <span class="w-7 h-7 rounded-full bg-orange-100 text-primary font-bold text-xs flex items-center justify-center shrink-0 mt-0.5">4</span>
                            <div>
                                <h4 class="font-headline text-sm font-bold text-navy-base">Hậu kỳ kiểm thử &amp; Tinh chỉnh theo phản hồi</h4>
                                <p class="text-xs text-slate-500 mt-0.5">Chỉnh sửa tối thiểu 02 vòng cho đến khi đạt chất lượng nghiệm thu hoàn hảo.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <span class="w-7 h-7 rounded-full bg-orange-100 text-primary font-bold text-xs flex items-center justify-center shrink-0 mt-0.5">5</span>
                            <div>
                                <h4 class="font-headline text-sm font-bold text-navy-base">Bàn giao bản quyền &amp; Bảo hành dài hạn</h4>
                                <p class="text-xs text-slate-500 mt-0.5">Chuyển giao toàn bộ file gốc Master/Source code và hỗ trợ vận hành 24/7.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right: Dedicated Booking Form -->
            <div id="booking-form" class="lg:col-span-5 p-8 rounded-3xl bg-white border-2 border-orange-200 shadow-xl flex flex-col gap-5 sticky top-28">
                <div class="flex items-center gap-3 border-b border-slate-100 pb-4">
                    <div class="w-10 h-10 rounded-xl bg-orange-100 text-primary flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-[22px]">edit_calendar</span>
                    </div>
                    <div>
                        <h3 class="font-headline text-lg font-bold text-navy-base">Đăng Ký Tư Vấn Dịch Vụ</h3>
                        <p class="text-[11px] text-slate-400">Nhận đề xuất chiến lược &amp; bảng dự toán trong 24h</p>
                    </div>
                </div>

                @if(session('success'))
                <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-300 text-emerald-800 text-xs font-semibold">
                    {{ session('success') }}
                </div>
                @endif

                <form action="{{ route('contact.submit') }}" method="POST" class="flex flex-col gap-3.5">
                    @csrf
                    <input type="hidden" name="service_interested" value="{{ $service->title }}">
                    <div>
                        <label class="block font-headline text-xs font-bold text-slate-700 mb-1">Họ và tên <span class="text-rose-500">*</span></label>
                        <input type="text" name="fullname" placeholder="Nguyễn Văn A" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs text-navy-base focus:ring-2 focus:ring-primary focus:outline-none">
                    </div>
                    <div>
                        <label class="block font-headline text-xs font-bold text-slate-700 mb-1">Số điện thoại liên hệ <span class="text-rose-500">*</span></label>
                        <input type="tel" name="phone" placeholder="0908 xxx xxx" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs text-navy-base focus:ring-2 focus:ring-primary focus:outline-none">
                    </div>
                    <div>
                        <label class="block font-headline text-xs font-bold text-slate-700 mb-1">Email của bạn</label>
                        <input type="email" name="email" placeholder="you@company.com" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs text-navy-base focus:ring-2 focus:ring-primary focus:outline-none">
                    </div>
                    <div>
                        <label class="block font-headline text-xs font-bold text-slate-700 mb-1">Mô tả sơ bộ nhu cầu / Ngân sách dự kiến <span class="text-rose-500">*</span></label>
                        <textarea name="message" rows="3" required placeholder="Ví dụ: Cần quay TVC 60s cho sản phẩm mới..." class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs text-navy-base focus:ring-2 focus:ring-primary focus:outline-none"></textarea>
                    </div>

                    <button type="submit" class="mt-2 w-full py-3 rounded-xl bg-gradient-to-r from-primary to-accent-amber text-white font-headline text-xs font-bold shadow-md hover:brightness-110 transition-all">
                        Gửi Yêu Cầu Cho Dịch Vụ Này
                    </button>
                </form>
            </div>

        </div>

    </div>
</div>
@endsection
