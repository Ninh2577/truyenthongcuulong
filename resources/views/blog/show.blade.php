@extends('layouts.app')

@section('title', ($post->meta_title ?: $post->title) . ' - Truyền Thông Cửu Long')
@section('meta_description', $post->meta_description ?: $post->summary)
@section('og_image', $post->thumbnail ? $post->thumbnail_url : asset('images/logo-ttcl.png'))

@section('schema')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@graph": [
    {
      "@type": "{{ get_setting('schema_default_post_type', 'Article') }}",
      "@id": "{{ url()->current() }}#article",
      "isPartOf": {
        "@id": "{{ rtrim(get_setting('schema_org_url', 'https://truyenthongcuulong.com'), '/') }}/#website"
      },
      "mainEntityOfPage": {
        "@id": "{{ url()->current() }}#webpage"
      },
      "headline": "{{ addslashes($post->title) }}",
      "name": "{{ addslashes($post->title) }}",
      "description": "{{ addslashes(strip_tags($post->excerpt ?: ($post->meta_description ?: $post->summary))) }}",
      "image": {
        "@type": "ImageObject",
        "@id": "{{ url()->current() }}#primaryimage",
        "url": "{{ $post->thumbnail ? $post->thumbnail_url : asset('images/logo-ttcl.png') }}",
        "caption": "{{ addslashes($post->title) }}"
      },
      "datePublished": "{{ ($post->published_at ?? $post->created_at)->toIso8601String() }}",
      "dateModified": "{{ ($post->updated_at ?? $post->published_at ?? $post->created_at)->toIso8601String() }}",
      "author": {
        "@type": "Organization",
        "@id": "{{ rtrim(get_setting('schema_org_url', 'https://truyenthongcuulong.com'), '/') }}/#organization",
        "name": "{{ get_setting('schema_org_name', 'Truyền Thông Cửu Long') }}",
        "url": "{{ rtrim(get_setting('schema_org_url', 'https://truyenthongcuulong.com'), '/') }}"
      },
      "publisher": {
        "@type": "Organization",
        "@id": "{{ rtrim(get_setting('schema_org_url', 'https://truyenthongcuulong.com'), '/') }}/#organization",
        "name": "{{ get_setting('schema_org_name', 'Truyền Thông Cửu Long') }}",
        "url": "{{ rtrim(get_setting('schema_org_url', 'https://truyenthongcuulong.com'), '/') }}",
        "logo": {
          "@type": "ImageObject",
          "@id": "https://truyenthongcuulong.com/#logo",
          "url": "{{ asset('images/logo-ttcl.png') }}"
        }
      },
      "inLanguage": "vi-VN",
      "articleSection": "{{ addslashes($post->category->name ?? 'Tin tức & Dự án') }}",
      "keywords": "{{ addslashes($post->category ? $post->category->name . ', Thiết kế Website, Lập trình Web App, UI/UX, SEO Tổng Thể, Media Sự Kiện, Truyền Thông Cửu Long' : 'Thiết kế Website, Lập trình Web App, Media Sự Kiện, SEO Tổng Thể, Truyền Thông Cửu Long') }}",
      "about": [
        {
          "@type": "Thing",
          "name": "Thiết kế Website Chuẩn SEO & Lập trình Web App"
        },
        {
          "@type": "Thing",
          "name": "Dịch vụ Media, Quay Phim & Chụp Ảnh Sự Kiện Chuyên Nghiệp"
        }
      ]
    }
  ]
}
</script>
@endsection

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
<div class="w-full bg-[#FFFFFF] min-h-screen pt-24 sm:pt-28 pb-20 relative">

    <!-- Decorative Top-Left Subtle Dot Grid Pattern -->
    <div class="absolute top-20 left-4 w-32 h-44 dot-pattern-orange opacity-25 pointer-events-none hidden sm:block"></div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl relative z-10">

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
        </nav>

        <!-- 2. ARTICLE HERO SECTION: 2-COLUMN SPLIT -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center mb-10 pb-8 border-b border-slate-100">
            
            <!-- Left Info Column (7 cols) -->
            <div class="lg:col-span-7 flex flex-col justify-center">
                <!-- Title -->
                <h1 class="font-headline text-[26px] sm:text-[34px] lg:text-[40px] font-black text-[#0f172a] leading-[1.24] tracking-tight mb-4">
                    {{ $post->title }}
                </h1>

                <!-- Meta Row: Author, Date, Reading Time -->
                <div class="flex flex-wrap items-center gap-4 text-xs sm:text-sm text-slate-500 mb-5">
                    <div class="flex items-center gap-2">
                        <div class="w-7 h-7 rounded-full bg-[#FF5E14] text-white flex items-center justify-center font-bold text-xs shrink-0 shadow-sm">
                            CL
                        </div>
                        <span class="font-bold text-[#0f172a]">Truyền Thông Cửu Long</span>
                    </div>
                    <span class="text-slate-300 hidden sm:inline">•</span>
                    <div class="flex items-center gap-1.5 font-mono text-slate-500">
                        <span class="material-symbols-outlined text-[16px] text-slate-400">calendar_today</span>
                        <span>{{ $post->published_at ? $post->published_at->format('d \T\h\á\n\g m, Y') : now()->format('d \T\h\á\n\g m, Y') }}</span>
                    </div>
                    <span class="text-slate-300 hidden sm:inline">•</span>
                    <div class="flex items-center gap-1.5 font-mono text-slate-500">
                        <span class="material-symbols-outlined text-[16px] text-slate-400">schedule</span>
                        <span>5 phút đọc</span>
                    </div>
                </div>

            </div>

            <!-- Right Featured Image Column (5 cols) -->
            <div class="lg:col-span-5">
                <div class="relative w-full aspect-video rounded-[24px] overflow-hidden shadow-xl border border-slate-200/80 group bg-slate-950 flex items-center justify-center">
                    <!-- Ambient blurred background matching the thumbnail colors -->
                    <img src="{{ $post->thumbnail_url ?: asset('images/blog/desk_artwork.png') }}" 
                         alt="" 
                         aria-hidden="true"
                         class="absolute inset-0 w-full h-full object-cover blur-2xl opacity-50 scale-110 pointer-events-none">
                    
                    <!-- Main Full Thumbnail (No Cropping - Displays 100% of the image) -->
                    <img src="{{ $post->thumbnail_url ?: asset('images/blog/desk_artwork.png') }}" 
                         alt="{{ $post->title }}" 
                         class="relative z-10 w-full h-full object-contain group-hover:scale-[1.02] transition-transform duration-500">
                    
                    <!-- Category Badge -->
                    @if($post->category)
                    <div class="absolute top-3.5 right-3.5 z-20 inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-slate-900/80 backdrop-blur-md text-white text-[11px] font-semibold border border-white/20 shadow-md">
                        <span class="w-1.5 h-1.5 rounded-full bg-[#FF5E14]"></span>
                        <span>{{ $post->category->name }}</span>
                    </div>
                    @endif
                </div>
            </div>

        </div>

        <!-- 3. MAIN ARTICLE BODY + SIDEBAR LAYOUT -->
        <div class="relative flex flex-col lg:grid lg:grid-cols-12 gap-10 lg:gap-12 items-start detail-article-layout">

            <!-- Floating Social Share Column (Visible on XL screens) -->
            <div class="hidden xl:flex flex-col gap-3 fixed left-[calc(50%-670px)] top-64 z-30">
                <!-- Facebook -->
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" 
                   target="_blank" rel="noopener noreferrer" 
                   class="w-10 h-10 rounded-full bg-[#1877F2] text-white flex items-center justify-center hover:scale-110 transition-transform shadow-md" 
                   title="Chia sẻ lên Facebook">
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.469h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.469h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                </a>
                <!-- Zalo -->
                <a href="https://zalo.me/share?url={{ urlencode(url()->current()) }}" 
                   target="_blank" rel="noopener noreferrer" 
                   class="w-10 h-10 rounded-full bg-[#0068FF] text-white flex items-center justify-center font-bold text-xs hover:scale-110 transition-transform shadow-md" 
                   title="Chia sẻ qua Zalo">
                    Z
                </a>
                <!-- Copy Link -->
                <button onclick="navigator.clipboard.writeText(window.location.href); alert('Đã sao chép liên kết bài viết!');" 
                        class="w-10 h-10 rounded-full bg-[#FF5E14] text-white flex items-center justify-center hover:scale-110 transition-transform shadow-md cursor-pointer" 
                        title="Sao chép liên kết">
                    <span class="material-symbols-outlined text-[18px]">link</span>
                </button>
            </div>

            <!-- LEFT CONTENT COLUMN (8 Cols) -->
            <div class="w-full lg:col-span-8 min-w-0 detail-article-main">
                
                <!-- Main Content Article Container -->
                <article class="article-editorial max-w-none w-full">
                    {!! clean($post->content) !!}
                </article>

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

                <!-- 5. ARTICLE FOOTER: SHARE & TAGS -->
                <div class="mt-10 pt-6 border-t border-slate-100 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-6">
                    <!-- Share buttons -->
                    <div class="flex items-center gap-3">
                        <span class="font-headline font-bold text-xs sm:text-sm text-[#0f172a]">Chia sẻ bài viết</span>
                        <div class="flex items-center gap-2">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" rel="noopener noreferrer" 
                               class="w-8 h-8 rounded-full text-white flex items-center justify-center hover:scale-110 transition-transform shadow-xs" 
                               style="background-color: #1877F2 !important; color: #ffffff !important;" 
                               title="Facebook">
                                <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.469h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.469h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                            </a>
                            <a href="https://zalo.me/share?url={{ urlencode(url()->current()) }}" target="_blank" rel="noopener noreferrer" 
                               class="w-8 h-8 rounded-full text-white flex items-center justify-center font-bold text-[11px] hover:scale-110 transition-transform shadow-xs" 
                               style="background-color: #0068FF !important; color: #ffffff !important;" 
                               title="Zalo">
                                Zalo
                            </a>
                            <button onclick="navigator.clipboard.writeText(window.location.href); alert('Đã sao chép liên kết bài viết!');" 
                                    class="w-8 h-8 rounded-full text-white flex items-center justify-center hover:scale-110 transition-transform shadow-xs cursor-pointer" 
                                    style="background-color: #FF5E14 !important; color: #ffffff !important;" 
                                    title="Sao chép link">
                                <span class="material-symbols-outlined text-[16px]">link</span>
                            </button>
                        </div>
                    </div>

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
                </div>

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

                </div>
            </aside>

        </div>

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
    });
</script>
@endsection
