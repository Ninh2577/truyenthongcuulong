@php
    $hideCtaBand = true;
    $hideFooter = true;
    $hideFloatingContact = true;
    $hideChatWidget = true;
    $hideCustomHeaderScripts = true;
@endphp

@extends('layouts.app')

@section('title', '404 - Không tìm thấy trang | Truyền Thông Cửu Long')
@section('meta_description', 'Rất tiếc, trang bạn đang tìm kiếm không tồn tại hoặc đã bị xóa. Vui lòng quay lại trang chủ hoặc sử dụng ô tìm kiếm.')

@section('content')
<div class="relative w-full min-h-[calc(100vh-80px)] flex flex-col justify-between overflow-hidden bg-white text-slate-800" style="min-height: calc(100vh - 80px);">

    <!-- Background Subtle Atmospheric Ambient & Clouds -->
    <div class="absolute inset-0 pointer-events-none overflow-hidden -z-10">
        <!-- Soft ambient glow -->
        <div class="absolute top-[12%] left-1/2 -translate-x-1/2 w-[720px] h-[360px] bg-gradient-to-b from-sky-50/70 via-slate-50/40 to-transparent rounded-full blur-3xl"></div>
        <div class="absolute top-[22%] left-[15%] w-[320px] h-[160px] bg-sky-50/50 rounded-full blur-2xl"></div>
        <div class="absolute top-[18%] right-[15%] w-[340px] h-[170px] bg-orange-50/40 rounded-full blur-2xl"></div>
    </div>

    <!-- MAIN CENTER CONTENT -->
    <div class="w-full max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 pt-4 sm:pt-8 pb-10 flex-1 flex flex-col items-center justify-center text-center relative z-10">
        
        <!-- 1. 3D ROBOT 404 ARTWORK -->
        <div class="relative w-full max-w-[480px] sm:max-w-[560px] md:max-w-[620px] mx-auto mb-4 sm:mb-6 select-none">
            <img src="{{ asset('images/404-robot.png') }}" 
                 alt="404 - Không tìm thấy trang này - Truyền Thông Cửu Long"
                 class="w-full h-auto object-contain mx-auto transition-transform duration-500 hover:scale-[1.02]"
                 style="max-height: 380px;" />
        </div>

        <!-- 2. HEADLINE -->
        <h1 class="text-2xl sm:text-3xl lg:text-[36px] font-black text-[#0F172A] tracking-tight leading-tight mb-3 sm:mb-3.5">
            Oops! Trang bạn đang tìm không tồn tại
        </h1>

        <!-- 3. DESCRIPTION (2 LINES) -->
        <p class="text-slate-500 text-sm sm:text-[15.5px] font-normal leading-relaxed max-w-lg mx-auto mb-7 sm:mb-8">
            Có thể trang đã bị xóa, đổi tên hoặc không còn tồn tại.<br class="hidden sm:inline">
            Hãy quay lại trang chủ hoặc tìm kiếm nội dung bạn cần nhé!
        </p>

        <!-- 4. ACTION BUTTONS -->
        <div class="flex flex-col sm:flex-row items-center justify-center gap-3.5 sm:gap-4 w-full sm:w-auto">
            <!-- Nút Về trang chủ (Cam gradient) -->
            <a href="{{ url('/') }}" 
               class="group inline-flex items-center justify-center gap-2.5 px-8 py-3.5 rounded-full text-white font-bold text-[14.5px] bg-gradient-to-r from-[#FF5E14] via-[#FF6A1A] to-[#FF7A30] hover:from-[#e54e08] hover:to-[#ff6819] shadow-[0_8px_24px_rgba(255,94,20,0.35)] hover:shadow-[0_10px_28px_rgba(255,94,20,0.48)] transition-all duration-200 transform hover:-translate-y-0.5 active:translate-y-0 w-full sm:w-auto"
               style="background: linear-gradient(135deg, #FF5E14 0%, #FF7A30 100%);">
                <svg class="w-4 h-4 text-white fill-none stroke-current" stroke-width="2.3" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                <span>Về trang chủ</span>
                <svg class="w-4 h-4 text-white fill-none stroke-current transition-transform duration-200 group-hover:translate-x-1" stroke-width="2.3" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                </svg>
            </a>

            <!-- Nút Tìm kiếm (Trắng viền xám mảnh) -->
            <button type="button" 
                    onclick="focusHeaderSearch()"
                    class="group inline-flex items-center justify-center gap-2.5 px-8 py-3.5 rounded-full text-[#0F172A] font-bold text-[14.5px] bg-white border border-slate-200 hover:border-slate-300 hover:bg-slate-50 transition-all duration-200 shadow-sm hover:shadow transform hover:-translate-y-0.5 active:translate-y-0 w-full sm:w-auto cursor-pointer">
                <svg class="w-4 h-4 text-slate-700 fill-none stroke-current" stroke-width="2.3" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <span>Tìm kiếm</span>
                <svg class="w-4 h-4 text-slate-400 fill-none stroke-current transition-transform duration-200 group-hover:translate-x-1" stroke-width="2.3" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                </svg>
            </button>
        </div>
    </div>

    <!-- 5. BOTTOM BAR / DOODLE & SCROLL TO TOP -->
    <div class="w-full max-w-7xl mx-auto px-6 sm:px-10 pb-6 sm:pb-8 flex items-end justify-between relative z-10 pointer-events-none">
        
        <!-- Left: Doodle "Kết nối để phát triển" -->
        <div class="pointer-events-auto flex flex-col items-start select-none">
            <div class="relative inline-block rotate-[-5deg] transition-transform hover:rotate-[-2deg] duration-200 cursor-default">
                <!-- 2 Orange Tick Marks -->
                <div class="flex gap-1 mb-1 ml-1">
                    <span class="w-3.5 h-[2.5px] bg-[#FF5E14] rounded-full rotate-[35deg] inline-block"></span>
                    <span class="w-3.5 h-[2.5px] bg-[#FF5E14] rounded-full rotate-[35deg] inline-block"></span>
                </div>
                <!-- Calligraphic Style Text -->
                <span class="text-base sm:text-lg font-bold text-[#0F172A] tracking-tight block italic" style="font-family: 'Playfair Display', Georgia, serif;">
                    Kết nối để phát triển
                </span>
                <!-- Orange Curved Underline SVG -->
                <svg class="w-28 sm:w-32 h-3.5 text-[#FF5E14] mt-0.5" viewBox="0 0 120 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M3 10C35 3 85 3 117 10" stroke="#FF5E14" stroke-width="3.5" stroke-linecap="round"/>
                </svg>
            </div>
        </div>

        <!-- Right: Scroll To Top Button (matching mockup) -->
        <div class="pointer-events-auto">
            <button type="button" 
                    onclick="window.scrollTo({top: 0, behavior: 'smooth'})"
                    class="w-11 h-11 sm:w-12 sm:h-12 rounded-full bg-[#0F172A] text-white flex items-center justify-center shadow-lg hover:bg-[#1E293B] hover:scale-105 active:scale-95 transition-all duration-200 cursor-pointer"
                    title="Lên đầu trang">
                <svg class="w-5 h-5 stroke-current fill-none" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
                </svg>
            </button>
        </div>
    </div>
</div>

<script>
function focusHeaderSearch() {
    // Tìm ô input search trên Header của website
    const searchInputs = document.querySelectorAll('header input[type="text"], header input[type="search"], input[name="q"], input[placeholder*="Tìm"]');
    if (searchInputs.length > 0) {
        window.scrollTo({ top: 0, behavior: 'smooth' });
        setTimeout(() => {
            searchInputs[0].focus();
            searchInputs[0].select();
        }, 300);
    } else {
        window.location.href = "{{ route('blog.index') }}";
    }
}
</script>
@endsection
