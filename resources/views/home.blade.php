@extends('layouts.app')

@section('title', 'Truyền Thông Cửu Long - Web, UX/UI, SEO & Media Sự Kiện')
@section('meta_description', 'Công ty thiết kế Web, WebApp, UX/UI, SEO tổng thể & dịch vụ quay chụp sự kiện, team building, flycam chuyên nghiệp tại Cần Thơ & ĐBSCL.')
@section('body-class', 'page-home')

@section('content')
<!-- ==================== 1. HERO SECTION (TECHNOLOGY FIRST B2B FOUNDATION) ==================== -->
@include('components.home.hero')

<!-- ==================== 2. VERIFIED CLIENT & PARTNER STRIP ==================== -->
@include('components.home.marquee')

<!-- ==================== 3. SECTION 02: BÀI TOÁN & GIẢI PHÁP DOANH NGHIỆP ==================== -->
@include('components.home.business_needs')

<!-- ==================== 4. SECTION 03: DỰ ÁN THỰC CHỨNG (TECHNOLOGY PROOF & CASE STUDIES) ==================== -->
@include('components.home.portfolio')

<!-- ==================== 5. SECTION 04: VÌ SAO CHỌN CỬU LONG (QUY TRÌNH & NĂNG LỰC) ==================== -->
@include('components.home.why_clm')

<!-- ==================== 6. SECTION 05: TRI THỨC & BÀI VIẾT CHUYÊN MÔN (INSIGHTS) ==================== -->
@include('components.home.insights')

<!-- ==================== 7. SECTION 06: CTA CHUYỂN ĐỔI CUỐI TRANG (FINAL CONVERSION) ==================== -->
@include('components.home.cta')
@endsection
