@extends('layouts.app')

@section('title', 'Truyền Thông Cửu Long - Đối Tác Công Nghệ Số, Web/App & Sáng Tạo Toàn Diện')
@section('meta_description', 'Đơn vị phát triển Website chuyên nghiệp, Web App & giải pháp số doanh nghiệp hiệu năng cao tại Cần Thơ & ĐBSCL, tích hợp năng lực Media & sản xuất nội dung in-house chuẩn mực.')
@section('body-class', 'page-home')

@section('content')
<!-- Custom Cursor for Portfolio Section (Desktop Only) -->
<div id="case-study-cursor" class="fixed pointer-events-none z-50 w-16 h-16 rounded-full bg-primary text-white flex items-center justify-center font-headline text-xs font-bold shadow-2xl opacity-0 ring-4 ring-orange-400/35">
    <div class="flex items-center gap-0.5">
        <span>Xem</span>
        <span class="material-symbols-outlined text-[14px]">arrow_outward</span>
    </div>
</div>

<!-- ==================== 1. HERO SECTION (TECHNOLOGY FIRST & SOFTWARE CONSOLE) ==================== -->
@include('components.home.hero')

<!-- ==================== 2. DẢI LOGO ĐỐI TÁC & KHÁCH HÀNG (SEAMLESS INFINITE MARQUEE) ==================== -->
@include('components.home.marquee')

<!-- ==================== 3. GIẢI PHÁP THEO NHU CẦU DOANH NGHIỆP (BUSINESS NEEDS / SOLUTION FINDER) ==================== -->
@include('components.home.business_needs')

<!-- ==================== 4. GIẢI PHÁP CÔNG NGHỆ CỐT LÕI (VALUE PROPOSITION & PILLARS) ==================== -->
@include('components.home.services')

<!-- ==================== 5. DỰ ÁN CÔNG NGHỆ TIÊU BIỂU & KHO GIAO DIỆN DEMO (CASE STUDIES & DEMOS) ==================== -->
@include('components.home.portfolio')

<!-- ==================== 6. QUY TRÌNH PHÁT TRIỂN DỰ ÁN CÔNG NGHỆ (HOW WE BUILD) ==================== -->
@include('components.home.development_process')

<!-- ==================== 7. VÌ SAO CHỌN CỬU LONG (TECH LEADERSHIP & CREATIVE SYNERGY) ==================== -->
@include('components.home.why_clm')

<!-- ==================== 8. SỐ LIỆU THỐNG KÊ MINH CHỨNG (VERIFIED PERFORMANCE METRICS) ==================== -->
@include('components.home.stats')

<!-- ==================== 9. NĂNG LỰC MEDIA & SÁNG TẠO HỖ TRỢ (~15% CREATIVE SUPPORT) ==================== -->
@include('components.home.media_support')

<!-- ==================== 10. KIẾN THỨC & BÀI VIẾT CHUYÊN MÔN (TECH EXPERTISE & INSIGHTS) ==================== -->
@include('components.home.insights')

<!-- ==================== 11. CTA CONVERSION BAND (START DIGITAL PROJECT) ==================== -->
@include('components.home.cta')
@endsection



