@extends('layouts.app')

@section('title', 'Truyền Thông Cửu Long - Đối Tác Công Nghệ Số, Web/App & Sáng Tạo Toàn Diện')
@section('meta_description', 'Đơn vị phát triển Website chuyên nghiệp, Web App & giải pháp số doanh nghiệp hiệu năng cao tại Cần Thơ & ĐBSCL, tích hợp năng lực Media & sản xuất nội dung in-house chuẩn mực.')
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

<!-- ==================== 5. SECTION 04: VÌ SAO CHỌN CỬU LONG (WHY CỬU LONG) ==================== -->
@include('components.home.why_clm')

<!-- ==================== 6. SECTION 05: NĂNG LỰC SÁNG TẠO BỔ TRỢ (MEDIA CREATIVE SUPPORT ~15%) ==================== -->
@include('components.home.media_support')

<!-- ==================== 7. SECTION 06: TRI THỨC & BÀI VIẾT CHUYÊN MÔN (INSIGHTS) ==================== -->
@include('components.home.insights')

<!-- ==================== 8. SECTION 07: CTA CHUYỂN ĐỔI CUỐI TRANG (FINAL CONVERSION) ==================== -->
@include('components.home.cta')
@endsection



