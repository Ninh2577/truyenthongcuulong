@extends('layouts.app')

@section('title', $caseStudy->title . ' - Case Study Truyền Thông Cửu Long')
@section('meta_description', $caseStudy->summary ?: 'Phân tích chi tiết chiến dịch ' . $caseStudy->title . ' do Truyền Thông Cửu Long thực hiện.')

@section('content')
<div class="w-full bg-surface bg-dot-grid-subtle pt-28 pb-20 border-b border-slate-200/60">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col gap-12">
        
        <!-- Breadcrumb -->
        <nav class="flex items-center gap-2 text-xs font-headline text-slate-500">
            <a href="{{ route('home') }}" class="hover:text-primary">Trang chủ</a>
            <span>/</span>
            <a href="{{ route('projects.index') }}" class="hover:text-primary">Dự án</a>
            <span>/</span>
            <span class="text-navy-base font-bold truncate max-w-sm">{{ $caseStudy->title }}</span>
        </nav>

        <!-- Project Hero Header -->
        <div class="flex flex-col gap-4">
            <div class="flex items-center gap-2">
                <span class="px-3.5 py-1 rounded-full bg-orange-100 text-primary font-mono text-xs font-bold border border-orange-300">
                    CASE STUDY CHI TIẾT
                </span>
                <span class="font-mono text-xs text-slate-400">Khách hàng: {{ $caseStudy->client_name ?: 'Đối tác chiến lược' }}</span>
            </div>
            <h1 class="font-headline text-3xl sm:text-5xl font-extrabold text-navy-base tracking-tight leading-tight">
                {{ $caseStudy->title }}
            </h1>
        </div>

        <!-- Featured Media / Video Container -->
        <div class="w-full rounded-3xl overflow-hidden bg-black shadow-2xl border border-slate-200 aspect-video relative group">
            @if($caseStudy->thumbnail)
                <img src="{{ asset('storage/' . $caseStudy->thumbnail) }}" alt="{{ $caseStudy->title }}" class="w-full h-full object-cover">
            @else
                <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuDhvlu1138YzJVrOShzutAvKGkz3j5nSQ6FSRRCOi-qYlq3I4Auibp8apXefm76bwHf-2zrBkZUHfaoXZoXnsMQ793B5GdY66hawqN0_YynY0pHC26dWpNngI9JSXG1yDBHN3WvepMEVpRCDQuLKVPCWllEmUCljDTfvmU_OHs9pqJgLfDmDXFO6gZ4aDGs6861rp3bLHuyOiamlRpq_9zpLsfmH2jfMGse10trwqZt17ok_MAJabJq" 
                    alt="{{ $caseStudy->title }}" class="w-full h-full object-cover opacity-90">
            @endif
        </div>

        <!-- Key KPIs Banner -->
        <div class="grid grid-cols-3 gap-4 p-6 sm:p-8 rounded-3xl bg-navy-base text-white border border-slate-700 shadow-xl text-center">
            <div class="flex flex-col gap-1">
                <span class="font-headline text-2xl sm:text-4xl font-black text-primary">{{ $caseStudy->views_metric ?: '65M+' }}</span>
                <span class="text-xs font-mono text-slate-400 uppercase">Tổng Lượt Xem (Views)</span>
            </div>
            <div class="flex flex-col gap-1 border-x border-slate-700">
                <span class="font-headline text-2xl sm:text-4xl font-black text-white">{{ $caseStudy->reach_metric ?: '12.8M' }}</span>
                <span class="text-xs font-mono text-slate-400 uppercase">Lượt Tiếp Cận (Reach)</span>
            </div>
            <div class="flex flex-col gap-1">
                <span class="font-headline text-2xl sm:text-4xl font-black text-emerald-400">{{ $caseStudy->conversion_metric ?: '+320%' }}</span>
                <span class="text-xs font-mono text-slate-400 uppercase">Tăng Trưởng Chuyển Đổi</span>
            </div>
        </div>

        <!-- Project Story / Details -->
        <div class="prose prose-slate max-w-none text-slate-700 leading-relaxed font-body text-base">
            {!! $caseStudy->content ?: '<p>Dự án là sự kết hợp chặt chẽ giữa nghiên cứu tâm lý hành vi người tiêu dùng, kịch bản hình ảnh chạm cảm xúc và công nghệ tối ưu hóa hiển thị trên mọi nền tảng số.</p>' !!}
        </div>

        <!-- Consultation Box CTA -->
        <div class="p-8 sm:p-10 rounded-3xl bg-gradient-to-r from-primary via-orange-500 to-accent-amber text-white shadow-xl flex flex-col sm:flex-row items-center justify-between gap-6">
            <div class="flex flex-col gap-1 text-center sm:text-left">
                <h3 class="font-headline text-2xl font-bold text-white">Bạn muốn có một dự án thành công tương tự?</h3>
                <p class="text-xs text-white/90">Đặt lịch trao đổi trực tiếp với đạo diễn và chuyên gia chiến lược của Truyền Thông Cửu Long.</p>
            </div>
            <a href="{{ route('contact', ['service' => 'Dự án tương tự: ' . $caseStudy->title]) }}" class="px-8 py-3.5 rounded-full bg-white text-navy-base font-headline text-xs font-bold shadow-md hover:scale-105 transition-transform shrink-0">
                Yêu Cầu Báo Giá Riêng
            </a>
        </div>

    </div>
</div>
@endsection
