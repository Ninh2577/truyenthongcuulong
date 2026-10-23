@extends('layouts.app')

@php
    $hideCtaBand = true;

    $cleanTitle = $post->meta_title ?: $post->title;
    $cleanDesc = $post->meta_description ?: ($post->summary ?: \Illuminate\Support\Str::limit(strip_tags($post->content), 160));
    $postThumbnail = $post->thumbnail ? $post->thumbnail_url : asset('images/logo-ttcl.png');
    if (str_starts_with((string)$postThumbnail, 'http://') && (app()->isProduction() || str_contains((string)$postThumbnail, 'truyenthongcuulong.com'))) {
        $postThumbnail = preg_replace('#^http://#', 'https://', $postThumbnail);
    }
    $authorName = $post->author ? $post->author->name : 'Truyền Thông Cửu Long';
    $canonicalUrl = app(\App\Services\Seo\SchemaService::class)->getBaseUrl() . '/' . ltrim($post->slug, '/');

    \Illuminate\Support\Facades\View::share('currentPost', $post);
    \Illuminate\Support\Facades\View::share('canonicalUrl', $canonicalUrl);
@endphp

@section('title', $cleanTitle . ' - Cẩm Nang Chuyên Sâu | Truyền Thông Cửu Long')
@section('meta_description', $cleanDesc)
@section('canonical', $canonicalUrl)

@section('og_type', 'article')
@section('og_url', $canonicalUrl)
@section('og_title', $cleanTitle)
@section('og_description', $cleanDesc)
@section('og_image', $postThumbnail)
@section('og_image_alt', $cleanTitle)

@section('og_article_tags')
@if($post->published_at)
<meta property="article:published_time" content="{{ $post->published_at->toIso8601String() }}">
@endif
@if($post->updated_at)
<meta property="article:modified_time" content="{{ $post->updated_at->toIso8601String() }}">
@endif
@if($post->category)
<meta property="article:section" content="{{ $post->category->name }}">
@endif
<meta property="article:author" content="{{ $authorName }}">
@endsection

@section('twitter_card', 'summary_large_image')
@section('twitter_title', $cleanTitle)
@section('twitter_description', $cleanDesc)
@section('twitter_image', $postThumbnail)
@section('twitter_image_alt', $cleanTitle)

@section('content')
<!-- Scoped Styles for Pillar Page -->
<style>
    .pillar-editorial {
        color: #334155;
        font-size: 16.5px;
        line-height: 1.85;
    }
    .pillar-editorial h2 {
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 24px;
        font-weight: 800;
        color: #0f172a;
        margin-top: 40px;
        margin-bottom: 18px;
        line-height: 1.35;
        scroll-margin-top: 90px;
    }
    .pillar-editorial h3 {
        font-size: 20px;
        font-weight: 700;
        color: #0f172a;
        margin-top: 30px;
        margin-bottom: 14px;
        line-height: 1.4;
        scroll-margin-top: 90px;
    }
    .pillar-editorial p {
        margin-bottom: 20px;
        color: #334155;
    }
    .pillar-editorial img {
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        max-width: 100%;
        height: auto;
        margin: 28px auto;
        display: block;
    }
    .pillar-editorial blockquote {
        background: #FFFDF9;
        border-left: 4px solid #FF5E14;
        border-radius: 0 16px 16px 0;
        padding: 20px 24px;
        margin: 28px 0;
        color: #1e293b;
        font-style: italic;
    }
    .pillar-editorial ul {
        list-style: none !important;
        padding-left: 0 !important;
        margin: 20px 0 !important;
    }
    .pillar-editorial ul li {
        position: relative;
        padding-left: 28px;
        margin-bottom: 12px;
        color: #334155;
    }
    .pillar-editorial ul li::before {
        content: '✓';
        position: absolute;
        left: 0;
        top: 3px;
        width: 18px;
        height: 18px;
        border-radius: 9999px;
        background-color: #FF5E14;
        color: #ffffff;
        font-size: 11px;
        font-weight: 900;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .pillar-toc-link.active {
        color: #FF5E14;
        font-weight: 700;
        border-left-color: #FF5E14;
        background-color: rgba(255, 94, 20, 0.06);
    }

    /* ================= PILLAR EDITORIAL TABLE STYLING ================= */
    .pillar-editorial figure,
    .pillar-editorial figure.wp-block-table,
    .pillar-editorial .table-responsive {
        width: 100% !important;
        margin: 1.75rem 0 !important;
        overflow-x: auto !important;
        -webkit-overflow-scrolling: touch !important;
        border-radius: 0.875rem !important;
        border: 1px solid #CBD5E1 !important;
        box-shadow: 0 4px 16px -2px rgba(15, 23, 42, 0.05) !important;
        background-color: #FFFFFF !important;
    }
    .pillar-editorial table {
        width: 100% !important;
        min-width: 600px !important;
        border-collapse: collapse !important;
        margin: 1.75rem 0 !important;
        text-align: left !important;
        font-size: 0.90625rem !important;
        line-height: 1.65 !important;
        background-color: #FFFFFF !important;
        border: 1.5px solid #CBD5E1 !important;
        border-radius: 0.75rem !important;
    }
    .pillar-editorial thead th,
    .pillar-editorial thead td,
    .pillar-editorial table tr:first-child th {
        background-color: #F8FAFC !important;
        color: #0F172A !important;
        font-weight: 700 !important;
        font-size: 0.875rem !important;
        padding: 0.875rem 1.125rem !important;
        border: 1px solid #CBD5E1 !important;
        border-bottom: 2px solid #94A3B8 !important;
        vertical-align: middle !important;
        letter-spacing: 0.01em !important;
    }
    .pillar-editorial tbody tr,
    .pillar-editorial table tr {
        transition: background-color 0.15s ease-in-out !important;
        background-color: #FFFFFF;
    }
    .pillar-editorial tbody tr:nth-child(even),
    .pillar-editorial table tr:nth-child(even) {
        background-color: #F8FAFC !important;
    }
    .pillar-editorial tbody tr:hover,
    .pillar-editorial table tr:hover {
        background-color: #FFF7ED !important;
    }
    .pillar-editorial tbody td,
    .pillar-editorial tbody th,
    .pillar-editorial table td {
        padding: 0.875rem 1.125rem !important;
        border: 1px solid #CBD5E1 !important;
        color: #334155 !important;
        font-size: 0.875rem !important;
        line-height: 1.65 !important;
        vertical-align: top !important;
    }
    .pillar-editorial tbody td:first-child,
    .pillar-editorial table td:first-child {
        font-weight: 600 !important;
        color: #0F172A !important;
        background-color: rgba(248, 250, 252, 0.6) !important;
        min-width: 130px;
    }
    .pillar-editorial tbody tr:hover td:first-child,
    .pillar-editorial table tr:hover td:first-child {
        background-color: #FFEDD5 !important;
    }
</style>

<!-- Reading Progress Bar -->
<div id="pillar-progress-bar" class="fixed top-0 left-0 h-1 bg-gradient-to-r from-[#FF5E14] via-[#FF8C1A] to-[#FFA033] z-[100] transition-all w-0"></div>

<!-- ==================== MAIN PILLAR PAGE WRAPPER ==================== -->
<div class="w-full bg-[#FAFAFA] min-h-screen pt-10 sm:pt-14 pb-24 relative">

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl relative z-10">

        @if(!empty($isPreview))
        <!-- ==================== BANNER PREVIEW MODE ==================== -->
        <div class="mb-6 p-4 sm:p-5 rounded-2xl bg-gradient-to-r from-slate-900 to-slate-800 text-white border border-amber-500/40 shadow-xl flex flex-wrap items-center justify-between gap-4">
            <div class="flex items-center gap-3.5">
                <div class="w-11 h-11 rounded-xl bg-amber-500/20 flex items-center justify-center text-amber-400 text-xl font-bold">
                    🏛️
                </div>
                <div>
                    <div class="text-[11px] font-extrabold uppercase tracking-wider text-amber-400">
                        Chế độ xem trước Pillar Page (Topic Hub Preview)
                    </div>
                    <div class="text-xs sm:text-sm text-slate-300">
                        Trạng thái: 
                        <strong class="{{ $post->status === 'published' ? 'text-emerald-400' : 'text-amber-400' }}">
                            {{ $post->status === 'published' ? 'Đã xuất bản (Published)' : 'Bản nháp (Draft - Chưa công khai)' }}
                        </strong>
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-2.5 flex-wrap">
                @if($post->status !== 'published')
                    <a href="{{ URL::signedRoute('post.preview.publish', ['post' => $post->id]) }}" 
                       class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-xs sm:text-sm font-bold text-white bg-gradient-to-r from-[#ff5e14] to-[#ff8c1a] shadow-md hover:brightness-110 transition-all">
                        Xuất bản trang này
                    </a>
                @endif
                <a href="/cuulongteam/posts/{{ $post->id }}/edit" 
                   class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-xs sm:text-sm font-medium text-slate-200 bg-slate-800 border border-slate-700 hover:bg-slate-700 transition-all">
                    Quay lại chỉnh sửa
                </a>
            </div>
        </div>
        @endif

        <!-- ==================== 1. BREADCRUMB ==================== -->
        <nav class="flex items-center gap-2 text-xs sm:text-[13px] font-medium mb-6 flex-wrap text-slate-500" aria-label="Breadcrumb">
            <span class="w-2 h-2 rounded-full bg-[#FF5E14] inline-block shrink-0"></span>
            <a href="{{ route('home') }}" class="hover:text-[#FF5E14] transition-colors">Trang chủ</a>
            <span class="text-slate-300">›</span>
            <span class="text-slate-700 font-semibold truncate max-w-xs sm:max-w-md" aria-current="page">{{ $post->title }}</span>
        </nav>

        <!-- ==================== 2. PILLAR HERO / HEADER ==================== -->
        <header class="bg-white rounded-3xl p-6 sm:p-10 lg:p-12 shadow-sm border border-slate-200/80 mb-10">
            <div class="max-w-4xl">
                <!-- Topic Pillar Badge -->
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-orange-50 border border-orange-200/70 text-[#FF5E14] text-xs font-extrabold uppercase tracking-wider mb-5">
                    <span class="w-2 h-2 rounded-full bg-[#FF5E14] animate-pulse"></span>
                    <span>Chủ Đề Trụ Cột (Pillar Page)</span>
                </div>

                <!-- H1 Title -->
                <h1 class="text-2xl sm:text-4xl lg:text-[44px] font-black text-[#0f172a] leading-[1.25] tracking-tight mb-5">
                    {{ $post->title }}
                </h1>

                <!-- Sapo / Summary -->
                @if(!empty($post->summary))
                <div class="p-4 sm:p-5 rounded-2xl bg-slate-50 border-l-4 border-[#FF5E14] text-slate-700 text-sm sm:text-base leading-relaxed mb-6 font-medium">
                    {{ $post->summary }}
                </div>
                @endif

                <!-- Metadata Row (Author & Date) -->
                @if($post->show_author_date)
                <div class="flex flex-wrap items-center gap-4 sm:gap-6 text-xs sm:text-sm text-slate-500 pt-2 border-t border-slate-100">
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-full bg-gradient-to-tr from-[#FF5E14] to-[#FF8C1A] text-white flex items-center justify-center font-bold text-xs shrink-0 shadow-sm">
                            {{ $post->author ? mb_substr($post->author->name, 0, 2) : 'CL' }}
                        </div>
                        <div>
                            <span class="text-[11px] text-slate-400 block leading-tight">Chuyên gia biên tập</span>
                            <span class="font-bold text-[#0f172a]">{{ $authorName }}</span>
                        </div>
                    </div>

                    @if($post->published_at)
                    <div class="flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-slate-400 text-[18px]">calendar_today</span>
                        <span>Xuất bản: <strong class="text-slate-700">{{ $post->published_at->format('d/m/Y') }}</strong></span>
                    </div>
                    @endif

                    @if($post->updated_at && $post->published_at && $post->updated_at->gt($post->published_at->addDay()))
                    <div class="flex items-center gap-1.5 text-emerald-600">
                        <span class="material-symbols-outlined text-[18px]">verified</span>
                        <span>Cập nhật mới nhất: <strong class="text-emerald-700">{{ $post->updated_at->format('d/m/Y') }}</strong></span>
                    </div>
                    @endif

                    <div class="flex items-center gap-1.5 text-slate-400">
                        <span class="material-symbols-outlined text-[18px]">schedule</span>
                        <span>Chuyên đề chuyên sâu (~8-12 phút đọc)</span>
                    </div>
                </div>
                @endif
            </div>

            <!-- Featured Image -->
            @if(!empty($post->thumbnail))
            <div class="mt-8 pt-6 border-t border-slate-100">
                <figure class="relative w-full aspect-video sm:aspect-[21/9] rounded-2xl overflow-hidden shadow-lg border border-slate-200 bg-slate-900 m-0">
                    <img src="{{ $postThumbnail }}" 
                         alt="{{ $post->title }}" 
                         fetchpriority="high"
                         loading="eager"
                         decoding="async"
                         class="w-full h-full object-cover">
                </figure>
            </div>
            @endif
        </header>

        <!-- ==================== 3. MOBILE COLLAPSIBLE TOC ==================== -->
        @if($post->show_toc && !empty($toc) && count($toc) > 0)
        <div class="lg:hidden mb-8">
            <details class="bg-white rounded-2xl border border-orange-200 p-4 shadow-sm group">
                <summary class="flex items-center justify-between cursor-pointer font-bold text-slate-900 text-sm">
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-[#FF5E14]">list_alt</span>
                        <span>Mục lục chuyên đề ({{ count($toc) }} mục)</span>
                    </div>
                    <span class="material-symbols-outlined text-slate-400 transition-transform group-open:rotate-180">expand_more</span>
                </summary>
                <div class="mt-3 pt-3 border-t border-slate-100 flex flex-col gap-2 max-h-72 overflow-y-auto">
                    @foreach($toc as $item)
                        <a href="#{{ $item['anchor'] }}" 
                           class="text-xs text-slate-600 hover:text-[#FF5E14] transition-colors py-1 pl-{{ ($item['level'] == 3) ? '5' : '1' }}">
                            {{ ($item['level'] == 3) ? '↳ ' : '• ' }}{{ $item['title'] }}
                        </a>
                    @endforeach
                </div>
            </details>
        </div>
        @endif

        <!-- ==================== 4. MAIN CONTENT & STICKY SIDEBAR GRID ==================== -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">

            <!-- MAIN CONTENT COLUMN (Col 8) -->
            <main class="lg:col-span-8 bg-white rounded-3xl p-6 sm:p-10 shadow-sm border border-slate-200/80">
                
                <!-- Editorial Formatted Content -->
                <div class="pillar-editorial">
                    {!! $post->content !!}
                </div>

                <!-- ==================== 5. COMPACT CONSULTATION BOX (1/2 SIZE) ==================== -->
                @if($post->show_cta_form)
                <section class="mt-10 p-6 sm:p-7 rounded-2xl bg-gradient-to-r from-orange-50/70 via-white to-amber-50/40 border border-orange-200/80 shadow-xs" id="tu-van-chuyen-de">
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-6 items-center">
                        
                        <!-- Cột Trái: Tiêu đề & Cam kết (5/12 Cột) -->
                        <div class="md:col-span-5 flex flex-col justify-center">
                            <div class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-orange-100 text-[#FF5E14] text-[11px] font-black uppercase tracking-wider mb-2.5 w-fit">
                                <span class="w-1.5 h-1.5 rounded-full bg-[#FF5E14] animate-ping"></span>
                                <span>Tư Vấn Miễn Phí</span>
                            </div>
                            <h3 class="text-lg sm:text-xl font-black text-slate-900 leading-snug mb-1.5">
                                Cần tư vấn triển khai giải pháp?
                            </h3>
                            <p class="text-xs text-slate-500 leading-relaxed mb-3">
                                Chuyên gia Cửu Long phản hồi trong 15 phút, tư vấn phương án và báo giá chi tiết.
                            </p>
                            <div class="flex items-center gap-4 text-xs font-semibold text-slate-600">
                                <span class="flex items-center gap-1.5 text-emerald-600">
                                    <svg class="w-4 h-4 text-emerald-500 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                    Bảo mật 100%
                                </span>
                                <span class="flex items-center gap-1.5 text-[#FF5E14]">
                                    <svg class="w-4 h-4 text-[#FF5E14] shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd"/></svg>
                                    Phản hồi 15p
                                </span>
                            </div>
                        </div>

                        <!-- Cột Phải: Form sạch sẽ, không đè icon, không vỡ (7/12 Cột) -->
                        <div class="md:col-span-7">
                            @if(session('success'))
                            <div class="p-3 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-semibold mb-3 flex items-center gap-2">
                                <svg class="w-4 h-4 text-emerald-600 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                <span>{{ session('success') }}</span>
                            </div>
                            @endif

                            <form action="{{ route('contact.submit') }}" method="POST" class="space-y-2.5">
                                @csrf
                                <input type="hidden" name="channel" value="pillar_page">
                                <input type="hidden" name="source_url" value="{{ url()->current() }}">
                                <input type="hidden" name="service_interested" value="{{ $post->title }}">

                                <!-- Hàng 1: Họ tên + Số điện thoại -->
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5">
                                    <div>
                                        <input type="text" name="fullname" value="{{ old('fullname') }}" 
                                               placeholder="Họ và tên của bạn *" required minlength="2"
                                               class="w-full px-3.5 py-2.5 rounded-xl bg-white border border-slate-300 text-xs sm:text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:border-[#FF5E14] focus:ring-2 focus:ring-orange-500/20 transition-all shadow-2xs">
                                        @error('fullname')
                                            <div class="text-[11px] text-rose-500 font-semibold mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div>
                                        <input type="tel" name="phone" value="{{ old('phone') }}" 
                                               placeholder="Số điện thoại liên hệ *" required
                                               class="w-full px-3.5 py-2.5 rounded-xl bg-white border border-slate-300 text-xs sm:text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:border-[#FF5E14] focus:ring-2 focus:ring-orange-500/20 transition-all shadow-2xs">
                                        @error('phone')
                                            <div class="text-[11px] text-rose-500 font-semibold mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Hàng 2: Nhu cầu dự án -->
                                <div>
                                    <input type="text" name="message" value="{{ old('message') }}" 
                                           placeholder="Mô tả nhanh nhu cầu hoặc câu hỏi của bạn..."
                                           class="w-full px-3.5 py-2.5 rounded-xl bg-white border border-slate-300 text-xs sm:text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:border-[#FF5E14] focus:ring-2 focus:ring-orange-500/20 transition-all shadow-2xs">
                                    @error('message')
                                        <div class="text-[11px] text-rose-500 font-semibold mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Hàng 3: Nút gửi -->
                                <div>
                                    <button type="submit" 
                                            class="w-full py-2.5 px-5 rounded-xl bg-gradient-to-r from-[#FF5E14] via-[#FF7A1A] to-[#FF8C1A] hover:brightness-105 active:scale-[0.99] text-white font-extrabold text-xs sm:text-sm shadow-md shadow-orange-500/20 hover:shadow-lg transition-all flex items-center justify-center gap-2 cursor-pointer">
                                        <span>GỬI YÊU CẦU TƯ VẤN NGAY</span>
                                        <svg class="w-4 h-4 text-white shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                    </button>
                                </div>
                            </form>
                        </div>

                    </div>
                </section>
                @endif

                <!-- ==================== 6. TOPIC CLUSTER ARTICLES ==================== -->
                <section class="mt-12 pt-8 border-t border-slate-200/80" id="topic-cluster">
                    <div class="flex items-center justify-between mb-5 flex-wrap gap-3">
                        <div>
                            <div class="text-[11px] font-black uppercase tracking-wider text-[#FF5E14] mb-0.5">
                                Topic Cluster — Cụm Bài Viết Vệ Tinh
                            </div>
                            <h2 class="text-lg sm:text-xl font-black text-slate-900 m-0">
                                Khám phá thêm chủ đề chuyên sâu
                            </h2>
                        </div>
                        @if($post->category)
                        <a href="{{ route('blog.resolve', $post->category->slug) }}" 
                           class="inline-flex items-center gap-1 text-xs font-bold text-[#FF5E14] hover:underline">
                            <span>Xem tất cả bài viết</span>
                            <span class="material-symbols-outlined text-[15px]">arrow_forward</span>
                        </a>
                        @endif
                    </div>

                    @if(!empty($clusterPosts) && $clusterPosts->isNotEmpty())
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @foreach($clusterPosts as $clusterPost)
                            <article class="p-3.5 rounded-2xl border border-slate-100 bg-slate-50/70 hover:bg-white hover:border-orange-200 hover:shadow-sm transition-all flex flex-col justify-between group">
                                <div>
                                    @if($clusterPost->thumbnail)
                                    <div class="aspect-video rounded-xl overflow-hidden mb-2.5 bg-slate-200">
                                        <img src="{{ $clusterPost->thumbnail_url }}" 
                                             alt="{{ $clusterPost->title }}" 
                                             loading="lazy"
                                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                    </div>
                                    @endif

                                    @if($clusterPost->category)
                                    <div class="mb-1">
                                        <span class="inline-block px-2 py-0.5 rounded-md bg-orange-50 text-[10px] font-bold text-[#FF5E14]">
                                            {{ $clusterPost->category->name }}
                                        </span>
                                    </div>
                                    @endif

                                    <h3 class="text-xs sm:text-sm font-bold text-slate-900 group-hover:text-[#FF5E14] transition-colors line-clamp-2 mb-1.5 leading-snug">
                                        <a href="{{ route('blog.resolve', $clusterPost->slug) }}">
                                            {{ $clusterPost->title }}
                                        </a>
                                    </h3>

                                    @if($clusterPost->summary)
                                    <p class="text-[11.5px] text-slate-500 line-clamp-2 mb-2 leading-relaxed">
                                        {{ $clusterPost->summary }}
                                    </p>
                                    @endif
                                </div>

                                <div class="flex items-center justify-between text-[11px] text-slate-400 pt-2 border-t border-slate-200/50">
                                    <span>{{ $clusterPost->published_at ? $clusterPost->published_at->format('d/m/Y') : '' }}</span>
                                    <span class="text-[#FF5E14] font-semibold flex items-center gap-0.5">
                                        Đọc tiếp <span class="material-symbols-outlined text-[13px]">arrow_forward</span>
                                    </span>
                                </div>
                            </article>
                        @endforeach
                    </div>
                    @else
                    <div class="p-5 rounded-2xl bg-slate-50 border border-slate-200 text-center text-xs text-slate-500">
                        Chuyên đề này hiện là bài viết trụ cột tiên phong. Các bài phân tích chuyên sâu vệ tinh đang tiếp tục được cập nhật.
                    </div>
                    @endif
                </section>

            </main>

            <!-- ==================== SIDEBAR COLUMN (Col 4) ==================== -->
            <aside class="lg:col-span-4 space-y-8 sticky top-20 self-start">
                
                <!-- Desktop Sticky Table of Contents -->
                @if($post->show_toc && !empty($toc) && count($toc) > 0)
                <div class="hidden lg:block bg-white rounded-3xl p-6 shadow-sm border border-slate-200/80">
                    <div class="flex items-center gap-2 pb-4 mb-4 border-b border-slate-100">
                        <span class="material-symbols-outlined text-[#FF5E14] text-[20px]">format_list_bulleted</span>
                        <h3 class="text-sm font-extrabold text-slate-900 uppercase tracking-wider">
                            Mục Lục Chuyên Đề
                        </h3>
                    </div>

                    <nav class="flex flex-col gap-1 max-h-[65vh] overflow-y-auto pr-2 custom-scrollbar">
                        @foreach($toc as $item)
                            <a href="#{{ $item['anchor'] }}" 
                               class="pillar-toc-link text-xs text-slate-600 hover:text-[#FF5E14] transition-all py-1.5 px-2.5 rounded-lg border-l-2 border-transparent {{ ($item['level'] == 3) ? 'pl-5 text-[11.5px]' : 'font-semibold' }}">
                                {{ ($item['level'] == 3) ? '↳ ' : '• ' }}{{ $item['title'] }}
                            </a>
                        @endforeach
                    </nav>
                </div>
                @endif



                <!-- Danh mục chuyên sâu -->
                @if(!empty($categories) && $categories->isNotEmpty())
                <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-200/80">
                    <div class="flex items-center gap-2 pb-4 mb-3 border-b border-slate-100">
                        <span class="material-symbols-outlined text-[#FF5E14] text-[20px]">category</span>
                        <h3 class="text-sm font-extrabold text-slate-900 uppercase tracking-wider">
                            Danh Mục Chủ Đề
                        </h3>
                    </div>
                    <ul class="flex flex-col gap-1.5 text-xs">
                        @foreach($categories->take(8) as $cat)
                            <li>
                                <a href="{{ route('blog.resolve', $cat->slug) }}" 
                                   class="flex items-center justify-between p-2 rounded-xl transition-all {{ ($post->category_id === $cat->id) ? 'bg-orange-50 font-bold text-[#FF5E14]' : 'text-slate-600 hover:bg-slate-50 hover:text-[#FF5E14]' }}">
                                    <span class="truncate">{{ $cat->name }}</span>
                                    <span class="text-[11px] px-2 py-0.5 rounded-full {{ ($post->category_id === $cat->id) ? 'bg-orange-200/70 text-[#FF5E14]' : 'bg-slate-100 text-slate-500' }}">
                                        {{ $cat->posts_count ?? $cat->posts()->where('status', 'published')->count() }}
                                    </span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <!-- Bài viết cùng cụm chủ đề (Topic Cluster) -->
                @php
                    $sidebarRelated = !empty($clusterPosts) && $clusterPosts->isNotEmpty() ? $clusterPosts->take(4) : (!empty($relatedPosts) ? $relatedPosts->take(4) : collect());
                @endphp
                @if($sidebarRelated->isNotEmpty())
                <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-200/80">
                    <div class="flex items-center gap-2 pb-4 mb-4 border-b border-slate-100">
                        <span class="material-symbols-outlined text-[#FF5E14] text-[20px]">hub</span>
                        <h3 class="text-sm font-extrabold text-slate-900 uppercase tracking-wider">
                            Bài Viết Cùng Cụm Page
                        </h3>
                    </div>
                    <div class="flex flex-col gap-3.5">
                        @foreach($sidebarRelated as $rel)
                            <article class="flex items-center gap-3 group">
                                @if($rel->thumbnail)
                                <a href="{{ route('blog.resolve', $rel->slug) }}" class="w-16 h-14 rounded-xl overflow-hidden shrink-0 bg-slate-100 border border-slate-200">
                                    <img src="{{ $rel->thumbnail_url }}" alt="{{ $rel->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                </a>
                                @endif
                                <div class="min-w-0 flex-1">
                                    <h4 class="text-xs font-bold text-slate-800 group-hover:text-[#FF5E14] transition-colors line-clamp-2 leading-snug">
                                        <a href="{{ route('blog.resolve', $rel->slug) }}">{{ $rel->title }}</a>
                                    </h4>
                                    <div class="flex items-center gap-2 mt-1 text-[11px] text-slate-400">
                                        <span>{{ $rel->published_at ? $rel->published_at->format('d/m/Y') : '' }}</span>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
                @endif

            </aside>

        </div>

    </div>
</div>

<!-- Scoped Reading Progress JS -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const progressBar = document.getElementById('pillar-progress-bar');
        if (progressBar) {
            window.addEventListener('scroll', function () {
                const winScroll = document.documentElement.scrollTop || document.body.scrollTop;
                const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
                const scrolled = (height > 0) ? (winScroll / height) * 100 : 0;
                progressBar.style.width = scrolled + '%';
            });
        }
    });
</script>
@endsection
