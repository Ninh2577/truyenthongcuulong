@extends('layouts.app')

@php
    $cleanTitle = $post->meta_title ?: $post->title;
    $cleanDesc = $post->meta_description ?: ($post->summary ?: \Illuminate\Support\Str::limit(strip_tags($post->content), 160));
    $postThumbnail = $post->thumbnail ? $post->thumbnail_url : asset('images/logo-ttcl.png');
    if (str_starts_with((string)$postThumbnail, 'http://') && (app()->isProduction() || str_contains((string)$postThumbnail, 'truyenthongcuulong.com'))) {
        $postThumbnail = preg_replace('#^http://#', 'https://', $postThumbnail);
    }
    $authorName = $post->author ? $post->author->name : 'Truyền Thông Cửu Long';
    $canonicalUrl = app(\App\Services\Seo\SchemaService::class)->getBaseUrl() . '/' . ltrim($post->slug, '/');

    // Share model và canonical URL cho SchemaService & Layout để hợp nhất MỘT @graph duy nhất (Lỗi 1 & Lỗi 3 Fix)
    \Illuminate\Support\Facades\View::share('currentPost', $post);
    \Illuminate\Support\Facades\View::share('canonicalUrl', $canonicalUrl);
@endphp

@section('title', $cleanTitle . ' - Truyền Thông Cửu Long')
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
<!-- Dedicated Scoped Styles ensuring exact match with the reference layout -->
<style>
    .article-editorial {
        color: #334155;
        font-size: 16px;
        line-height: 1.8;
    }
    .article-editorial h2 {
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 22px;
        font-weight: 800;
        color: #0f172a;
        margin-top: 36px;
        margin-bottom: 16px;
        line-height: 1.35;
    }
    .article-editorial h3 {
        font-size: 19px;
        font-weight: 700;
        color: #0f172a;
        margin-top: 28px;
        margin-bottom: 14px;
    }
    .article-editorial p {
        margin-bottom: 18px;
        color: #334155;
    }
    .article-editorial img {
        border-radius: 20px;
        box-shadow: 0 6px 24px rgba(0, 0, 0, 0.06);
        max-width: 100%;
        height: auto;
        margin: 24px auto;
        display: block;
    }
    .article-editorial blockquote,
    .article-editorial .info-card {
        background-color: #FFFDF9 !important;
        border: 1.5px solid #FFD8C2 !important;
        border-radius: 18px !important;
        padding: 22px 26px !important;
        margin: 24px 0 !important;
        box-shadow: 0 4px 16px rgba(255, 94, 20, 0.04) !important;
        font-style: normal;
        color: #334155;
    }
    .article-editorial ul {
        list-style: none !important;
        padding-left: 0 !important;
        margin: 18px 0 !important;
    }
    .article-editorial ul li {
        position: relative;
        padding-left: 28px;
        margin-bottom: 10px;
        color: #334155;
    }
    .article-editorial ul li::before {
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

    /* ================= DEDICATED LINK STYLING (INTERNAL & EXTERNAL) ================= */
    /* 1. Base Link Styling for all links inside article content (In đậm / Bôi đen) */
    .article-editorial a {
        font-weight: 700 !important;
        text-decoration: underline !important;
        text-underline-offset: 3.5px !important;
        text-decoration-thickness: 1.5px !important;
        transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1) !important;
        padding: 1px 4px !important;
        border-radius: 4px !important;
        word-break: break-word !important;
        display: inline !important;
    }

    /* 2. Internal Links (Màu cam thương hiệu Cửu Long Media rực rỡ, sắc nét) */
    .article-editorial a,
    .article-editorial a.internal-link,
    .article-editorial a[href^="/"],
    .article-editorial a[href^="#"],
    .article-editorial a[href*="truyenthongcuulong.com"],
    .article-editorial a[href*="127.0.0.1"],
    .article-editorial a[href*="localhost"] {
        color: #EA580C !important;
        text-decoration-color: rgba(234, 88, 12, 0.4) !important;
    }

    .article-editorial a:hover,
    .article-editorial a.internal-link:hover,
    .article-editorial a[href^="/"]:hover,
    .article-editorial a[href^="#"]:hover,
    .article-editorial a[href*="truyenthongcuulong.com"]:hover,
    .article-editorial a[href*="127.0.0.1"]:hover,
    .article-editorial a[href*="localhost"]:hover {
        color: #C2410C !important;
        text-decoration-color: #C2410C !important;
        text-decoration-thickness: 2px !important;
        background-color: #FFF7ED !important;
    }

    /* 3. External Links (Màu xanh Tech Sky hiện đại cho các nguồn tham khảo bên ngoài) */
    .article-editorial a.external-link,
    .article-editorial a[href^="http://"]:not([href*="truyenthongcuulong.com"]):not([href*="127.0.0.1"]):not([href*="localhost"]),
    .article-editorial a[href^="https://"]:not([href*="truyenthongcuulong.com"]):not([href*="127.0.0.1"]):not([href*="localhost"]) {
        color: #0284C7 !important;
        text-decoration-color: rgba(2, 132, 199, 0.4) !important;
    }

    .article-editorial a.external-link:hover,
    .article-editorial a[href^="http://"]:not([href*="truyenthongcuulong.com"]):not([href*="127.0.0.1"]):not([href*="localhost"]):hover,
    .article-editorial a[href^="https://"]:not([href*="truyenthongcuulong.com"]):not([href*="127.0.0.1"]):not([href*="localhost"]):hover {
        color: #0369A1 !important;
        text-decoration-color: #0369A1 !important;
        text-decoration-thickness: 2px !important;
        background-color: #F0F9FF !important;
    }

    /* Biểu tượng mũi tên liên kết ngoài ↗ */
    .article-editorial a.external-link::after,
    .article-editorial a[href^="http://"]:not([href*="truyenthongcuulong.com"]):not([href*="127.0.0.1"]):not([href*="localhost"])::after,
    .article-editorial a[href^="https://"]:not([href*="truyenthongcuulong.com"]):not([href*="127.0.0.1"]):not([href*="localhost"])::after {
        content: " ↗";
        display: inline-block !important;
        font-size: 0.8em !important;
        font-weight: 800 !important;
        line-height: 1 !important;
        margin-left: 2px !important;
        vertical-align: super !important;
        opacity: 0.85 !important;
        transition: transform 0.2s ease !important;
    }

    .article-editorial a.external-link:hover::after,
    .article-editorial a[href^="http://"]:not([href*="truyenthongcuulong.com"]):not([href*="127.0.0.1"]):not([href*="localhost"]):hover::after,
    .article-editorial a[href^="https://"]:not([href*="truyenthongcuulong.com"]):not([href*="127.0.0.1"]):not([href*="localhost"]):hover::after {
        transform: translate(2px, -2px) !important;
        opacity: 1 !important;
    }

    /* 4. Hotline & Email Links (Màu xanh ngọc lục bảo) */
    .article-editorial a[href^="tel:"],
    .article-editorial a[href^="mailto:"] {
        color: #059669 !important;
        text-decoration-color: rgba(5, 150, 105, 0.4) !important;
    }

    .article-editorial a[href^="tel:"]:hover,
    .article-editorial a[href^="mailto:"]:hover {
        color: #047857 !important;
        text-decoration-color: #047857 !important;
        background-color: #ECFDF5 !important;
    }

    /* ================= DEDICATED TABLE STYLING FOR ARTICLE ================= */
    .article-editorial figure,

    .article-editorial figure.wp-block-table,
    .article-editorial .table-responsive {
        width: 100% !important;
        margin: 28px 0 !important;
        overflow-x: auto !important;
        -webkit-overflow-scrolling: touch !important;
        border-radius: 14px !important;
        border: 1px solid #E2E8F0 !important;
        box-shadow: 0 4px 16px -2px rgba(15, 23, 42, 0.05) !important;
        background-color: #FFFFFF !important;
    }
    .article-editorial table {
        width: 100% !important;
        min-width: 600px !important;
        border-collapse: separate !important;
        border-spacing: 0 !important;
        margin: 0 !important;
        text-align: left !important;
        font-size: 14.5px !important;
        line-height: 1.65 !important;
        background-color: #FFFFFF !important;
        table-layout: auto !important;
    }
    .article-editorial table.has-fixed-layout {
        table-layout: auto !important;
    }
    /* THEAD / HEADER ROW */
    .article-editorial thead {
        background-color: #F8FAFC !important;
    }
    .article-editorial thead tr {
        background-color: #F8FAFC !important;
    }
    .article-editorial thead th,
    .article-editorial thead td,
    .article-editorial table tr:first-child th {
        background-color: #F8FAFC !important;
        color: #0F172A !important;
        font-weight: 700 !important;
        font-size: 13.5px !important;
        padding: 14px 18px !important;
        border-bottom: 2px solid #CBD5E1 !important;
        border-right: 1px solid #E2E8F0 !important;
        vertical-align: middle !important;
        letter-spacing: 0.01em !important;
    }
    .article-editorial thead th:last-child,
    .article-editorial thead td:last-child {
        border-right: none !important;
    }
    /* Corner rounding for top headers */
    .article-editorial thead tr:first-child th:first-child,
    .article-editorial thead tr:first-child td:first-child {
        border-top-left-radius: 13px !important;
    }
    .article-editorial thead tr:first-child th:last-child,
    .article-editorial thead tr:first-child td:last-child {
        border-top-right-radius: 13px !important;
    }
    /* TBODY CELLS */
    .article-editorial tbody tr {
        transition: background-color 0.15s ease-in-out !important;
        background-color: #FFFFFF;
    }
    .article-editorial tbody tr:nth-child(even) td {
        background-color: #F8FAFC !important;
    }
    .article-editorial tbody tr:hover td {
        background-color: #FFF7ED !important; /* Subtle warm brand tint on hover */
    }
    .article-editorial tbody td,
    .article-editorial tbody th {
        padding: 14px 18px !important;
        border-bottom: 1px solid #E2E8F0 !important;
        border-right: 1px solid #F1F5F9 !important;
        color: #334155 !important;
        font-size: 14px !important;
        line-height: 1.65 !important;
        vertical-align: top !important;
    }
    .article-editorial tbody td:last-child,
    .article-editorial tbody th:last-child {
        border-right: none !important;
    }
    .article-editorial tbody tr:last-child td,
    .article-editorial tbody tr:last-child th {
        border-bottom: none !important;
    }
    /* Corner rounding for bottom */
    .article-editorial tbody tr:last-child td:first-child {
        border-bottom-left-radius: 13px !important;
    }
    .article-editorial tbody tr:last-child td:last-child {
        border-bottom-right-radius: 13px !important;
    }
    /* First column in tbody (Key criteria/labels) */
    .article-editorial tbody td:first-child {
        font-weight: 600 !important;
        color: #0F172A !important;
        background-color: rgba(248, 250, 252, 0.6) !important;
        min-width: 130px;
    }
    .article-editorial tbody tr:hover td:first-child {
        background-color: #FFEDD5 !important;
    }
    /* Strong text inside table */
    .article-editorial table strong {
        color: #0F172A !important;
        font-weight: 700 !important;
    }
    /* Standalone table fallback if no wrapper element */
    .article-editorial > table {
        display: block !important;
        overflow-x: auto !important;
        -webkit-overflow-scrolling: touch !important;
        border-radius: 14px !important;
        border: 1px solid #E2E8F0 !important;
        box-shadow: 0 4px 16px -2px rgba(15, 23, 42, 0.05) !important;
        margin: 28px 0 !important;
    }
    /* Caption or figcaption */
    .article-editorial figcaption {
        font-size: 13px !important;
        color: #64748B !important;
        text-align: center !important;
        padding: 10px 16px !important;
        font-style: italic !important;
        background-color: #F8FAFC !important;
        border-top: 1px solid #E2E8F0 !important;
    }
    /* ================= RESPONSIVE VIDEO EMBED (YOUTUBE / VIMEO) ================= */
    .article-editorial .video-responsive-wrapper {
        margin: 32px 0 !important;
        width: 100% !important;
        clear: both !important;
    }
    .article-editorial .video-responsive {
        position: relative !important;
        padding-bottom: 56.25% !important; /* Chuẩn 16:9 Aspect Ratio */
        height: 0 !important;
        overflow: hidden !important;
        border-radius: 18px !important;
        background-color: #0F172A !important;
        box-shadow: 0 10px 25px -5px rgba(15, 23, 42, 0.15), 0 8px 10px -6px rgba(15, 23, 42, 0.1) !important;
        border: 1px solid rgba(226, 232, 240, 0.8) !important;
    }
    .article-editorial .video-responsive iframe,
    .article-editorial .video-responsive object,
    .article-editorial .video-responsive embed {
        position: absolute !important;
        top: 0 !important;
        left: 0 !important;
        width: 100% !important;
        height: 100% !important;
        border: 0 !important;
    }
    .article-editorial iframe[src*="youtube.com"],
    .article-editorial iframe[src*="youtu.be"],
    .article-editorial iframe[src*="vimeo.com"] {
        max-width: 100% !important;
        border-radius: 14px !important;
    }
    .dot-pattern-orange {
        background-image: radial-gradient(#FF5E14 1.5px, transparent 1.5px);
        background-size: 12px 12px;
    }
    .container {
        width: 100% !important;
        margin-left: auto !important;
        margin-right: auto !important;
        padding-left: 1rem !important;
        padding-right: 1rem !important;
    }
    @media (min-width: 640px) {
        .container {
            padding-left: 1.5rem !important;
            padding-right: 1.5rem !important;
        }
    }
    @media (min-width: 1024px) {
        .container {
            padding-left: 2rem !important;
            padding-right: 2rem !important;
            max-width: 1240px !important;
        }
    }
    @media (min-width: 1280px) {
        .container {
            max-width: 1280px !important;
        }
    }
    /* ================= FOOLPROOF STICKY SIDEBAR ================= */
    html, body {
        overflow-x: visible !important;
    }
    .detail-article-layout {
        position: relative;
        display: flex;
        flex-direction: column;
        gap: 2.5rem;
    }
    .detail-article-main {
        width: 100%;
        min-width: 0;
    }
    .detail-article-sidebar {
        width: 100%;
    }
    @media (max-width: 1023px) {
        .detail-article-sidebar {
            position: static !important;
        }
    }
    @media (min-width: 1024px) {
        .detail-article-layout {
            display: grid !important;
            grid-template-columns: repeat(12, minmax(0, 1fr)) !important;
            gap: 2.5rem !important;
            align-items: start !important;
        }
        .detail-article-main {
            grid-column: span 8 / span 8 !important;
        }
        .detail-article-sidebar {
            grid-column: span 4 / span 4 !important;
            position: -webkit-sticky !important;
            position: sticky !important;
            top: 96px !important;
            align-self: start !important;
            z-index: 30 !important;
            overflow: visible !important;
        }
    }
    /* ================= CATEGORY RELATED POSTS HORIZONTAL SLIDER (COL-3 / 4 CARDS) ================= */
    .category-slider-track {
        display: flex !important;
        gap: 20px !important;
        overflow-x: auto !important;
        scroll-behavior: smooth !important;
        scrollbar-width: none !important;
        -ms-overflow-style: none !important;
        scroll-snap-type: x mandatory !important;
        -webkit-overflow-scrolling: touch !important;
        padding-top: 4px !important;
        padding-bottom: 16px !important;
    }
    .category-slider-track::-webkit-scrollbar {
        display: none !important;
    }
    .category-slider-item {
        flex: 0 0 calc((100% - 60px) / 4) !important;
        width: calc((100% - 60px) / 4) !important;
        min-width: calc((100% - 60px) / 4) !important;
        max-width: calc((100% - 60px) / 4) !important;
        scroll-snap-align: start !important;
    }
    @media (max-width: 1199px) {
        .category-slider-item {
            flex: 0 0 calc((100% - 40px) / 3) !important;
            width: calc((100% - 40px) / 3) !important;
            min-width: calc((100% - 40px) / 3) !important;
            max-width: calc((100% - 40px) / 3) !important;
        }
    }
    @media (max-width: 860px) {
        .category-slider-item {
            flex: 0 0 calc((100% - 20px) / 2) !important;
            width: calc((100% - 20px) / 2) !important;
            min-width: calc((100% - 20px) / 2) !important;
            max-width: calc((100% - 20px) / 2) !important;
        }
    }
    @media (max-width: 580px) {
        .category-slider-item {
            flex: 0 0 85% !important;
            width: 85% !important;
            min-width: 85% !important;
            max-width: 85% !important;
        }
    }
</style>

<!-- Reading Progress Bar -->
<div id="reading-progress-bar" class="fixed top-0 left-0 h-1 bg-gradient-to-r from-[#FF5E14] to-[#FFA033] z-[100] transition-all w-0"></div>

<!-- ==================== MAIN DETAIL ARTICLE WRAPPER ==================== -->
<div class="w-full bg-[#FFFFFF] min-h-screen pt-12 sm:pt-16 pb-20 relative">

    <!-- Decorative Top-Left Subtle Dot Grid Pattern -->
    <div class="absolute top-20 left-4 w-32 h-44 dot-pattern-orange opacity-25 pointer-events-none hidden sm:block"></div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl relative z-10">

        @if(!empty($isPreview))
        <!-- ==================== BANNER THÔNG BÁO XEM TRƯỚC BÀI VIẾT ==================== -->
        <div style="margin-bottom: 24px; padding: 18px 24px; border-radius: 16px; background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); color: #ffffff; border: 1.5px solid rgba(245, 158, 11, 0.4); box-shadow: 0 10px 25px -5px rgba(0,0,0,0.2); display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 16px;">
            <div style="display: flex; align-items: center; gap: 14px;">
                <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(245, 158, 11, 0.2); display: flex; align-items: center; justify-content: center; color: #fbbf24; font-size: 22px;">
                    👁️
                </div>
                <div>
                    <div style="font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.05em; color: #fbbf24; margin-bottom: 2px;">
                        Chế độ xem trước bài viết (Preview Mode)
                    </div>
                    <div style="font-size: 13.5px; color: #cbd5e1;">
                        Trạng thái bài viết: 
                        <strong style="color: {{ $post->status === 'published' ? '#34d399' : '#fbbf24' }};">
                            {{ $post->status === 'published' ? 'Đã xuất bản (Published)' : 'Bản nháp (Draft - Chưa công khai)' }}
                        </strong>
                    </div>
                </div>
            </div>

            <div style="display: flex; align-items: center; gap: 10px; flex-wrap: wrap;">
                @if($post->status !== 'published')
                    <a href="{{ URL::signedRoute('post.preview.publish', ['post' => $post->id]) }}" 
                       style="display: inline-flex; align-items: center; gap: 8px; padding: 10px 20px; border-radius: 10px; font-size: 13.5px; font-weight: 700; color: #ffffff; background: linear-gradient(135deg, #ff5e14, #ff8c1a); text-decoration: none; box-shadow: 0 4px 12px rgba(255, 94, 20, 0.35);">
                        <svg style="width: 16px; height: 16px; fill: currentColor;" viewBox="0 0 20 20"><path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"/></svg>
                        Xuất bản bài viết
                    </a>
                @endif

                <a href="{{ route('blog.resolve', $post->slug) }}" target="_blank"
                   style="display: inline-flex; align-items: center; gap: 8px; padding: 10px 18px; border-radius: 10px; font-size: 13.5px; font-weight: 700; color: #a7f3d0; background: rgba(6, 78, 59, 0.85); border: 1.5px solid rgba(16, 185, 129, 0.5); text-decoration: none;">
                    <svg style="width: 16px; height: 16px; stroke: currentColor; fill: none;" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    Xem trang đã xuất bản
                </a>

                <a href="/cuulongteam/posts/{{ $post->id }}/edit" 
                   style="display: inline-flex; align-items: center; gap: 8px; padding: 10px 16px; border-radius: 10px; font-size: 13.5px; font-weight: 600; color: #e2e8f0; background: #1e293b; border: 1.5px solid #334155; text-decoration: none;">
                    <svg style="width: 16px; height: 16px; stroke: currentColor; fill: none;" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    Quay lại sửa
                </a>
            </div>
        </div>
        @endif

        <!-- 1. BREADCRUMB -->
        <nav class="flex items-center gap-2 text-[13px] font-medium mb-6 flex-wrap" aria-label="Breadcrumb">
            <span class="w-2 h-2 rounded-full bg-[#FF5E14] inline-block shrink-0"></span>
            <a href="{{ route('home') }}" class="hover:text-[#FF5E14] transition-colors text-slate-500">Trang chủ</a>
            <span class="text-slate-300">›</span>
            <a href="{{ route('blog.index') }}" class="hover:text-[#FF5E14] transition-colors text-slate-500">Tin tức</a>
            @if($post->category)
            <span class="text-slate-300">›</span>
            <a href="{{ route('blog.resolve', $post->category->slug) }}" class="hover:text-[#FF5E14] transition-colors text-slate-700 font-semibold">
                {{ $post->category->name }}
            </a>
            @endif
            <span class="text-slate-300">›</span>
            <span class="text-slate-500 truncate max-w-xs sm:max-w-md font-medium" aria-current="page">{{ $post->title }}</span>
        </nav>

        <!-- Entire Post Article Scope -->
        <article class="w-full" itemscope itemtype="https://schema.org/Article">

            <!-- 2. ARTICLE HERO / HEADER: 2-COLUMN SPLIT -->
            <header class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center mb-10 pb-8 border-b border-slate-100 article-header">
                
                <!-- Left Info Column (7 cols) -->
                <div class="lg:col-span-7 flex flex-col justify-center">
                    <!-- H1 Title (Duy nhất trên toàn trang) -->
                    <h1 class="font-headline text-[26px] sm:text-[34px] lg:text-[40px] font-black text-[#0f172a] leading-[1.24] tracking-tight mb-4" itemprop="headline">
                        {{ $post->title }}
                    </h1>

                    <!-- Meta Row: Author, Date, Reading Time -->
                    <div class="flex flex-wrap items-center gap-4 text-xs sm:text-sm text-slate-500 mb-5">
                        <div class="flex items-center gap-2" rel="author">
                            <div class="w-7 h-7 rounded-full bg-[#FF5E14] text-white flex items-center justify-center font-bold text-xs shrink-0 shadow-sm" aria-hidden="true">
                                {{ $post->author ? mb_substr($post->author->name, 0, 2) : 'CL' }}
                            </div>
                            <span class="font-bold text-[#0f172a]" itemprop="author">{{ $authorName }}</span>
                        </div>
                        @if($post->published_at)
                        <span class="text-slate-300 hidden sm:inline" aria-hidden="true">•</span>
                        <time datetime="{{ $post->published_at->toIso8601String() }}" itemprop="datePublished" class="flex items-center gap-1.5 font-mono text-slate-500">
                            <span class="material-symbols-outlined text-[16px] text-slate-400" aria-hidden="true">calendar_today</span>
                            <span>{{ $post->published_at->format('d \T\h\á\n\g m, Y') }}</span>
                        </time>
                        @endif
                        @if($post->updated_at && $post->published_at && $post->updated_at->gt($post->published_at->addDay()))
                        <span class="text-slate-300 hidden sm:inline" aria-hidden="true">•</span>
                        <span class="text-xs text-slate-400" title="Cập nhật lúc {{ $post->updated_at->format('d/m/Y H:i') }}">
                            (Cập nhật: <time datetime="{{ $post->updated_at->toIso8601String() }}" itemprop="dateModified">{{ $post->updated_at->format('d/m/Y') }}</time>)
                        </span>
                        @endif
                        <span class="text-slate-300 hidden sm:inline" aria-hidden="true">•</span>
                        <div class="flex items-center gap-1.5 font-mono text-slate-500">
                            <span class="material-symbols-outlined text-[16px] text-slate-400" aria-hidden="true">schedule</span>
                            <span>5 phút đọc</span>
                        </div>
                    </div>

                </div>

                <!-- Right Featured Image Column (5 cols) -->
                <div class="lg:col-span-5">
                    <figure class="relative w-full aspect-video rounded-[24px] overflow-hidden shadow-xl border border-slate-200/80 group bg-slate-950 flex items-center justify-center m-0">
                        <!-- Ambient blurred background matching the thumbnail colors -->
                        <img src="{{ $postThumbnail }}" 
                             alt="" 
                             aria-hidden="true"
                             width="1200" height="675"
                             class="absolute inset-0 w-full h-full object-cover blur-2xl opacity-50 scale-110 pointer-events-none">
                        
                        <!-- Main Full Thumbnail (Hero LCP Image: fetchpriority high, no lazy loading, explicit aspect ratio) -->
                        <img src="{{ $postThumbnail }}" 
                             alt="{{ $post->title }}" 
                             itemprop="image"
                             width="1200" height="675"
                             fetchpriority="high"
                             loading="eager"
                             decoding="async"
                             class="relative z-10 w-full h-full object-contain group-hover:scale-[1.02] transition-transform duration-500">
                        
                        <!-- Category Badge -->
                        @if($post->category)
                        <div class="absolute top-3.5 right-3.5 z-20 inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-slate-900/80 backdrop-blur-md text-white text-[11px] font-semibold border border-white/20 shadow-md">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#FF5E14]"></span>
                            <span>{{ $post->category->name }}</span>
                        </div>
                        @endif
                    </figure>
                </div>

            </header>

            <!-- 3. MAIN ARTICLE BODY + SIDEBAR LAYOUT -->
            <div class="relative flex flex-col lg:grid lg:grid-cols-12 gap-10 lg:gap-12 items-start detail-article-layout">

                <!-- LEFT CONTENT COLUMN (8 Cols) -->
                <div class="w-full lg:col-span-8 min-w-0 detail-article-main">
                    


                    {{-- AdSense: Vị trí Đầu bài viết (Post Top) --}}
                    {!! render_ad_position('post_top') !!}

                    <!-- Main Content Article Container -->
                    <div class="article-editorial max-w-none w-full" itemprop="articleBody">
                        {!! inject_ad_into_content($post->content) !!}
                    </div>

                    {{-- AdSense: Vị trí Cuối bài viết (Post Bottom) --}}
                    {!! render_ad_position('post_bottom') !!}

                    <!-- 4. CONSULTATION CALL-TO-ACTION CARD -->
                    <div class="mt-14 p-6 sm:p-8 rounded-[22px] text-white shadow-xl flex flex-col sm:flex-row items-center justify-between gap-6 relative overflow-hidden"
                         style="background: linear-gradient(135deg, #FF5E14 0%, #FFA033 100%) !important;">
                        <div class="flex items-center gap-4 text-left relative z-10">
                            <div class="w-12 h-12 rounded-2xl bg-white/20 backdrop-blur-sm flex items-center justify-center text-white shrink-0 shadow-xs">
                                <span class="material-symbols-outlined text-[26px]">support_agent</span>
                            </div>
                            <div>
                                <h3 class="font-headline font-bold text-lg sm:text-xl text-white">
                                    Bạn đã sẵn sàng trải nghiệm cùng Cửu Long?
                                </h3>
                                <p class="text-white/90 text-xs sm:text-sm mt-0.5 leading-relaxed">
                                    Hãy kết nối với chúng tôi để nhận tư vấn giải pháp truyền thông &amp; công nghệ tối ưu nhất!
                                </p>
                            </div>
                        </div>
                        <a href="{{ route('contact') }}" 
                           class="px-6 py-3 rounded-full hover:bg-orange-50 font-headline font-bold text-xs sm:text-sm shadow-md hover:scale-105 transition-all shrink-0 flex items-center gap-2 relative z-10"
                           style="background-color: #ffffff !important; color: #FF5E14 !important;">
                            <span class="material-symbols-outlined text-[18px]" style="color: #FF5E14 !important;">call</span>
                            <span style="color: #FF5E14 !important; font-weight: 800;">Liên hệ tư vấn</span>
                        </a>
                    </div>

                    <!-- 5. ARTICLE FOOTER: TAGS -->
                    <footer class="mt-10 pt-6 border-t border-slate-100 flex items-center justify-between gap-6 article-footer">
                        <!-- Post Tags -->
                        <div class="flex items-center gap-2 flex-wrap">
                            <span class="font-headline font-bold text-xs sm:text-sm text-[#0f172a]">Thẻ bài viết:</span>
                            @if($post->category)
                            <a href="{{ route('blog.resolve', $post->category->slug) }}" 
                               class="px-3 py-1 rounded-full bg-slate-100 hover:bg-[#FFF0EB] hover:text-[#FF5E14] text-slate-600 text-xs font-medium transition-colors">
                                {{ $post->category->name }}
                            </a>
                            @endif
                            <span class="px-3 py-1 rounded-full bg-slate-100 hover:bg-[#FFF0EB] hover:text-[#FF5E14] text-slate-600 text-xs font-medium transition-colors">
                                Truyền Thông Cửu Long
                            </span>
                            <span class="px-3 py-1 rounded-full bg-slate-100 hover:bg-[#FFF0EB] hover:text-[#FF5E14] text-slate-600 text-xs font-medium transition-colors">
                                Sáng tạo nội dung
                            </span>
                        </div>
                    </footer>

                </div>

                <!-- RIGHT SIDEBAR (4 Cols) - STICKY ON DESKTOP SCROLL -->
                <aside id="blogDetailSidebar" 
                       class="w-full lg:col-span-4 detail-article-sidebar" 
                       style="position: -webkit-sticky; position: sticky; top: 96px; align-self: flex-start;">
                    <div class="space-y-4">

                    <!-- SIDEBAR WIDGET 1: BÀI VIẾT LIÊN QUAN -->
                    @if($relatedPosts->count() > 0)
                    <div class="bg-white rounded-[22px] p-5 border border-slate-100 shadow-[0_4px_20px_rgba(0,0,0,0.04)]">
                        <h3 class="font-headline font-bold text-[15px] text-[#0f172a] mb-3 flex items-center justify-between">
                            <span>Bài viết liên quan</span>
                            <span class="w-2 h-2 rounded-full bg-[#FF5E14]"></span>
                        </h3>
                        <div class="flex flex-col divide-y divide-slate-100">
                            @foreach($relatedPosts->take(3) as $rPost)
                            <a href="{{ route('blog.resolve', $rPost->slug) }}" class="py-2.5 first:pt-0 last:pb-0 flex items-center gap-3 group">
                                <div class="w-16 h-13 sm:w-18 sm:h-14 rounded-xl overflow-hidden shrink-0 bg-slate-100">
                                    <img src="{{ $rPost->thumbnail_url ?: asset('images/blog/desk_artwork.png') }}" 
                                         alt="{{ $rPost->title }}" 
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                </div>
                                <div class="flex flex-col min-w-0 text-left">
                                    <h4 class="font-headline font-bold text-[12.5px] text-[#0f172a] group-hover:text-[#FF5E14] transition-colors line-clamp-2 leading-snug">
                                        {{ $rPost->title }}
                                    </h4>
                                    <span class="text-[11px] font-mono text-slate-400 mt-1">
                                        {{ $rPost->published_at ? $rPost->published_at->format('d/m/Y') : now()->format('d/m/Y') }}
                                    </span>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- SIDEBAR WIDGET 2: DANH MỤC TIN TỨC -->
                    @if(isset($categories) && $categories->count() > 0)
                    <div class="bg-white rounded-[22px] p-5 border border-slate-100 shadow-[0_4px_20px_rgba(0,0,0,0.04)]">
                        <h3 class="font-headline font-bold text-[15px] text-[#0f172a] mb-3 flex items-center justify-between">
                            <span>Danh mục tin tức</span>
                            <span class="w-2 h-2 rounded-full bg-[#FF5E14]"></span>
                        </h3>
                        <div class="flex flex-col space-y-1.5">
                            @foreach($categories->take(5) as $cat)
                                @php
                                    $isCatActive = $post->category_id === $cat->id;
                                @endphp
                                <a href="{{ route('blog.resolve', $cat->slug) }}" 
                                   class="flex items-center justify-between px-2.5 py-1.5 rounded-xl transition-all {{ $isCatActive ? 'bg-[#FFF0EB] text-[#FF5E14]' : 'hover:bg-slate-50 text-slate-700' }}">
                                    <div class="flex items-center gap-2.5 min-w-0">
                                        <div class="w-7 h-7 rounded-full flex items-center justify-center shrink-0 {{ $isCatActive ? 'bg-[#FF5E14] text-white' : 'bg-slate-100 text-slate-500' }}">
                                            <span class="material-symbols-outlined text-[15px]">
                                                @if(str_contains(mb_strtolower($cat->name), 'du lịch'))
                                                    tour
                                                @elseif(str_contains(mb_strtolower($cat->name), 'văn hóa'))
                                                    theater_comedy
                                                @elseif(str_contains(mb_strtolower($cat->name), 'ẩm thực'))
                                                    restaurant
                                                @elseif(str_contains(mb_strtolower($cat->name), 'địa điểm'))
                                                    pin_drop
                                                @elseif(str_contains(mb_strtolower($cat->name), 'media') || str_contains(mb_strtolower($cat->name), 'video'))
                                                    movie
                                                @elseif(str_contains(mb_strtolower($cat->name), 'công nghệ'))
                                                    devices
                                                @else
                                                    article
                                                @endif
                                            </span>
                                        </div>
                                        <span class="font-headline font-bold text-[13px] truncate {{ $isCatActive ? 'text-[#FF5E14]' : 'text-slate-800' }}">
                                            {{ $cat->name }}
                                        </span>
                                    </div>
                                    <span class="font-mono text-[11px] font-semibold px-2 py-0.5 rounded-full {{ $isCatActive ? 'bg-[#FF5E14]/15 text-[#FF5E14]' : 'bg-slate-100 text-slate-500' }}">
                                        {{ $cat->posts_count }}
                                    </span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    {{-- AdSense: Vị trí Cột bên (Sidebar) --}}
                    {!! render_ad_position('sidebar') !!}

                    </div>
                </aside>

            </div>
        </article>

        <!-- ==================== 6. BÀI VIẾT CÙNG CHUYÊN MỤC (SLIDER 4 BÀI VIẾT NGANG CÓ NEXT / PRE) ==================== -->
        @if(isset($categoryPosts) && $categoryPosts->count() > 0)
        <section class="mt-14 sm:mt-18 pt-10 sm:pt-12 border-t border-slate-200/90 relative">
            
            <!-- Section Header -->
            <div class="flex items-center justify-between mb-6 sm:mb-8 flex-wrap gap-4">
                <div class="flex items-center gap-3">
                    <span class="w-2.5 h-6 rounded-full" style="background: linear-gradient(135deg, #FF7A29 0%, #FF5E14 100%);"></span>
                    <h3 class="font-headline font-black text-lg sm:text-2xl text-[#0f172a] uppercase tracking-wide flex items-center gap-2 flex-wrap">
                        <span>Bài viết cùng chuyên mục</span>
                        @if($post->category)
                            <span class="text-primary font-bold">"{{ $post->category->name }}"</span>
                        @endif
                    </h3>
                </div>

                <div class="flex items-center gap-2 sm:gap-3">
                    @if($post->category)
                    <a href="{{ route('blog.resolve', $post->category->slug) }}" 
                       class="hidden sm:inline-flex items-center gap-1 text-xs font-headline font-bold text-primary hover:text-primary-hover hover:underline transition-all group mr-2">
                        <span>Xem tất cả</span>
                        <span class="material-symbols-outlined text-[15px] group-hover:translate-x-0.5 transition-transform">arrow_forward</span>
                    </a>
                    @endif

                    <!-- Pre Button -->
                    <button type="button" 
                            id="catSliderPrevBtn"
                            onclick="scrollCategorySlider('prev')"
                            aria-label="Xem bài viết trước"
                            class="w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-white border border-slate-200 shadow-xs hover:shadow-md text-slate-700 hover:text-[#FF5E14] hover:border-[#FF5E14]/50 transition-all flex items-center justify-center cursor-pointer active:scale-90"
                            title="Bài trước">
                        <span class="material-symbols-outlined text-[20px]">chevron_left</span>
                    </button>

                    <!-- Next Button -->
                    <button type="button" 
                            id="catSliderNextBtn"
                            onclick="scrollCategorySlider('next')"
                            aria-label="Xem bài viết tiếp theo"
                            class="w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-white border border-slate-200 shadow-xs hover:shadow-md text-slate-700 hover:text-[#FF5E14] hover:border-[#FF5E14]/50 transition-all flex items-center justify-center cursor-pointer active:scale-90"
                            title="Bài tiếp theo">
                        <span class="material-symbols-outlined text-[20px]">chevron_right</span>
                    </button>
                </div>
            </div>

            <!-- Carousel Container Relative Wrapper -->
            <div class="relative group/carousel">
                
                <!-- Floating Left Arrow for Desktop -->
                <button type="button" 
                        onclick="scrollCategorySlider('prev')"
                        aria-label="Bài trước"
                        class="hidden xl:flex absolute -left-5 top-1/2 -translate-y-1/2 z-20 w-11 h-11 rounded-full bg-white border border-slate-200/90 shadow-md hover:shadow-xl text-slate-700 hover:text-[#FF5E14] hover:border-[#FF5E14]/40 transition-all items-center justify-center cursor-pointer active:scale-90 opacity-90 hover:opacity-100">
                    <span class="material-symbols-outlined text-[24px]">chevron_left</span>
                </button>

                <!-- Floating Right Arrow for Desktop -->
                <button type="button" 
                        onclick="scrollCategorySlider('next')"
                        aria-label="Bài tiếp theo"
                        class="hidden xl:flex absolute -right-5 top-1/2 -translate-y-1/2 z-20 w-11 h-11 rounded-full bg-white border border-slate-200/90 shadow-md hover:shadow-xl text-slate-700 hover:text-[#FF5E14] hover:border-[#FF5E14]/40 transition-all items-center justify-center cursor-pointer active:scale-90 opacity-90 hover:opacity-100">
                    <span class="material-symbols-outlined text-[24px]">chevron_right</span>
                </button>

                <!-- Horizontal Cards Slider (4 cards visible on desktop lg:) -->
                <div id="category-posts-slider" class="category-slider-track">
                    @foreach($categoryPosts as $catPost)
                    <article class="category-slider-item group rounded-2xl overflow-hidden bg-white border border-slate-200/80 hover:border-orange-300 shadow-xs hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between">
                        <div class="flex flex-col">
                            <a href="{{ route('blog.resolve', $catPost->slug) }}" class="block aspect-[16/10] bg-slate-100 relative overflow-hidden shrink-0">
                                @if($catPost->thumbnail)
                                    <img src="{{ $catPost->thumbnail_url }}" 
                                         alt="{{ $catPost->title }}" 
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" 
                                         loading="lazy" 
                                         onerror="this.onerror=null; this.src='/images/fallback-banner.svg';">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-slate-100 to-slate-200 text-slate-400">
                                        <span class="material-symbols-outlined text-3xl">feed</span>
                                    </div>
                                @endif
                                @if($catPost->category)
                                <span class="absolute top-2.5 left-2.5 px-2.5 py-0.5 rounded-full text-[10px] font-mono font-bold bg-[#0f172a]/85 backdrop-blur-md text-white border border-white/10">
                                    {{ $catPost->category->name }}
                                </span>
                                @endif
                            </a>

                            <div class="p-4 sm:p-5 flex flex-col gap-2">
                                <div class="flex items-center gap-2 text-[10.5px] font-mono text-slate-400">
                                    <span>{{ $catPost->published_at ? $catPost->published_at->format('d/m/Y') : '' }}</span>
                                    <span>•</span>
                                    <span class="flex items-center gap-0.5">
                                        <span class="material-symbols-outlined text-[12px]">visibility</span>
                                        {{ $catPost->views }}
                                    </span>
                                </div>
                                <h4 class="font-headline font-bold text-sm text-[#0f172a] group-hover:text-primary transition-colors line-clamp-2 leading-snug">
                                    <a href="{{ route('blog.resolve', $catPost->slug) }}">{{ $catPost->title }}</a>
                                </h4>
                                <p class="font-body text-xs text-slate-500 line-clamp-2 leading-relaxed">
                                    {{ $catPost->summary }}
                                </p>
                            </div>
                        </div>

                        <div class="p-4 sm:p-5 pt-0 mt-auto">
                            <div class="pt-3 border-t border-slate-100 flex items-center justify-between">
                                <a href="{{ route('blog.resolve', $catPost->slug) }}" 
                                   class="text-xs font-headline font-bold text-primary group-hover:text-primary-hover flex items-center gap-1">
                                    <span>Đọc tiếp</span>
                                    <span class="material-symbols-outlined text-[14px] group-hover:translate-x-0.5 transition-transform">arrow_forward</span>
                                </a>
                                <span class="text-[10px] font-mono text-slate-400">~3 phút đọc</span>
                            </div>
                        </div>
                    </article>
                    @endforeach
                </div>
            </div>

            <!-- Mobile View All link -->
            @if($post->category)
            <div class="mt-4 sm:hidden text-center">
                <a href="{{ route('blog.resolve', $post->category->slug) }}" 
                   class="inline-flex items-center gap-1 text-xs font-headline font-bold text-primary hover:text-primary-hover">
                    <span>Xem tất cả bài viết trong chuyên mục</span>
                    <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
                </a>
            </div>
            @endif

        </section>
        @endif

    </div>

</div>

<!-- Back to top button -->
<button id="backToTop" 
        class="fixed bottom-8 right-8 w-11 h-11 rounded-full bg-[#0f172a] text-white shadow-xl flex items-center justify-center hover:bg-[#FF5E14] hover:scale-110 transition-all duration-300 translate-y-20 opacity-0 z-[90] cursor-pointer" 
        aria-label="Lên đầu trang">
    <span class="material-symbols-outlined text-[20px]">arrow_upward</span>
</button>

<script>
    // Category Slider Scroll Controller (Next / Pre)
    window.scrollCategorySlider = function(direction) {
        const slider = document.getElementById('category-posts-slider');
        if (!slider) return;
        // Scroll exactly by container width (4 cards at once on desktop, 1-2 on mobile)
        const scrollDistance = slider.clientWidth > 768 ? (slider.clientWidth + 20) : (slider.clientWidth * 0.85);
        slider.scrollBy({
            left: direction === 'next' ? scrollDistance : -scrollDistance,
            behavior: 'smooth'
        });
    };

    document.addEventListener('DOMContentLoaded', function() {
        // Slider button state observer
        const slider = document.getElementById('category-posts-slider');
        const prevBtn = document.getElementById('catSliderPrevBtn');
        const nextBtn = document.getElementById('catSliderNextBtn');

        if (slider && prevBtn && nextBtn) {
            const updateSliderButtons = () => {
                const maxScrollLeft = slider.scrollWidth - slider.clientWidth - 5;
                prevBtn.style.opacity = slider.scrollLeft <= 5 ? '0.45' : '1';
                prevBtn.style.cursor = slider.scrollLeft <= 5 ? 'default' : 'pointer';
                nextBtn.style.opacity = slider.scrollLeft >= maxScrollLeft ? '0.45' : '1';
                nextBtn.style.cursor = slider.scrollLeft >= maxScrollLeft ? 'default' : 'pointer';
            };
            slider.addEventListener('scroll', updateSliderButtons, { passive: true });
            updateSliderButtons();
        }

        // 1. Reading Progress Bar
        const progressBar = document.getElementById('reading-progress-bar');
        const updateProgress = () => {
            const winScroll = window.pageYOffset || document.documentElement.scrollTop;
            const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
            if (height > 0) {
                const scrolled = (winScroll / height) * 100;
                if (progressBar) progressBar.style.width = scrolled + '%';
            }
        };
        window.addEventListener('scroll', updateProgress, {passive: true});
        updateProgress();

        // 2. Back to Top Button
        const bttBtn = document.getElementById('backToTop');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 400) {
                bttBtn.classList.remove('translate-y-20', 'opacity-0');
            } else {
                bttBtn.classList.add('translate-y-20', 'opacity-0');
            }
        }, {passive: true});

        bttBtn.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // 3. Ensure all article tables are cleanly wrapped in responsive overflow container
        document.querySelectorAll('.article-editorial table').forEach(function(table) {
            const parent = table.parentElement;
            if (parent && !parent.classList.contains('wp-block-table') && !parent.classList.contains('table-responsive') && parent.tagName !== 'FIGURE') {
                const wrapper = document.createElement('div');
                wrapper.className = 'table-responsive';
                parent.insertBefore(wrapper, table);
                wrapper.appendChild(table);
            }
        });

        // 4. Auto-detect Internal & External Links in Article Content
        const currentHost = window.location.hostname;
        document.querySelectorAll('.article-editorial a').forEach(function(link) {
            const href = link.getAttribute('href');
            if (!href) return;

            // Check if external link
            if (href.startsWith('http://') || href.startsWith('https://')) {
                try {
                    const linkUrl = new URL(href, window.location.origin);
                    if (linkUrl.hostname !== currentHost && !linkUrl.hostname.includes('truyenthongcuulong.com')) {
                        link.classList.add('external-link');
                        if (!link.hasAttribute('target')) {
                            link.setAttribute('target', '_blank');
                        }
                        if (!link.hasAttribute('rel')) {
                            link.setAttribute('rel', 'noopener noreferrer nofollow');
                        }
                    } else {
                        link.classList.add('internal-link');
                    }
                } catch (e) {
                    // Fallback
                }
            } else if (href.startsWith('/') || href.startsWith('#')) {
                link.classList.add('internal-link');
            }
        });

        // 5. Client-Side Video Auto-Embedder (Bảo chứng 100% hiển thị iframe kể cả khi hosting còn cache cũ hoặc định dạng block lạ)
        function getYouTubeIdFromUrl(url) {
            if (!url) return null;
            // Clean HTML entity quotes and spaces
            url = url.replace(/&amp;/g, '&').trim();
            const regExp = /(?:youtube(?:-nocookie)?\.com\/(?:[^/]+\/.+\/|(?:v|e(?:mbed)?|shorts)\/|.*[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/i;
            const match = url.match(regExp);
            return (match && match[1]) ? match[1] : null;
        }

        function createResponsiveVideoNode(youtubeId) {
            const wrapper = document.createElement('div');
            wrapper.className = 'video-responsive-wrapper my-8 w-full clear-both';
            wrapper.innerHTML = `
                <div class="video-responsive relative w-full overflow-hidden rounded-2xl shadow-xl bg-slate-950 border border-slate-200/80" style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden;">
                    <iframe class="absolute top-0 left-0 w-full h-full border-0" 
                            style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: 0;"
                            src="https://www.youtube.com/embed/${youtubeId}?rel=0" 
                            width="100%" height="100%" frameborder="0" 
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                            title="YouTube video player" allowfullscreen></iframe>
                </div>`;
            return wrapper;
        }

        const articleContent = document.querySelector('.article-editorial');
        if (articleContent) {
            // A. Check Gutenberg embed wrappers (.wp-block-embed, .wp-block-embed__wrapper)
            articleContent.querySelectorAll('.wp-block-embed, .wp-block-embed__wrapper').forEach(function(el) {
                if (el.querySelector('iframe')) return;
                const link = el.querySelector('a')?.href || el.textContent.trim();
                const ytId = getYouTubeIdFromUrl(link);
                if (ytId) {
                    const topTarget = el.closest('.wp-block-embed') || el;
                    topTarget.parentNode.replaceChild(createResponsiveVideoNode(ytId), topTarget);
                }
            });

            // B. Check standalone links or paragraphs containing unrendered YouTube links
            articleContent.querySelectorAll('p, div, a').forEach(function(el) {
                if (el.closest('.video-responsive-wrapper') || el.querySelector('iframe')) return;
                const raw = el.tagName === 'A' ? (el.getAttribute('href') || el.textContent.trim()) : el.textContent.trim();
                const ytId = getYouTubeIdFromUrl(raw);
                if (ytId && (raw.includes('youtube.com') || raw.includes('youtu.be'))) {
                    // Check if element is mostly the URL
                    const cleanText = el.textContent.trim();
                    if (cleanText.includes('youtube.com') || cleanText.includes('youtu.be') || el.tagName === 'A') {
                        const target = (el.tagName === 'A' && el.parentElement && el.parentElement.tagName === 'P') ? el.parentElement : el;
                        if (!target.closest('.video-responsive-wrapper')) {
                            target.parentNode.replaceChild(createResponsiveVideoNode(ytId), target);
                        }
                    }
                }
            });
        }
    });

</script>
@endsection
