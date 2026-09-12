@extends('layouts.app')

@section('title', 'Truyền Thông Cửu Long - Creative Production Studio & Tech Agency')
@section('meta_description', 'Creative Production Studio & Enterprise Tech Agency hàng đầu Cần Thơ & ĐBSCL. Sản xuất Video TVC 4K chuẩn điện ảnh, giải pháp Web/App hiệu năng cao và chiến dịch truyền thông số đột phá.')
@section('body-class', 'page-home')

@section('content')
<!-- Custom Cursor for Portfolio Section (Desktop Only) -->
<div id="case-study-cursor" class="fixed pointer-events-none z-50 w-16 h-16 rounded-full bg-primary text-white flex items-center justify-center font-headline text-xs font-bold shadow-2xl opacity-0 ring-4 ring-orange-400/35">
    <div class="flex items-center gap-0.5">
        <span>Xem</span>
        <span class="material-symbols-outlined text-[14px]">arrow_outward</span>
    </div>
</div>

<!-- ==================== 1. HERO SECTION (CINEMATIC TIMELINE & GSAP REVEAL) ==================== -->
@include('components.home.hero')

<!-- ==================== 2. DẢI LOGO ĐỐI TÁC & KHÁCH HÀNG (SEAMLESS INFINITE MARQUEE) ==================== -->
<!-- TODO: Cần thu thập file logo chính thức (PNG/SVG nền trong suốt) của từng đối tác/khách hàng liệt kê ở trên, từ chính các đối tác/khách hàng hoặc từ bộ nhận diện thương hiệu đã lưu trữ nội bộ của Cửu Long Media, để thay thế wordmark text bằng logo thật -->
<!-- LƯU Ý QUẢN TRỊ: "MTC" và "Phú Thọ" xuất hiện 2 lần trong dữ liệu gốc website cũ. Cần quản trị viên xác nhận 2 đối tác khác nhau hay lặp bản ghi trước khi chốt logo chính thức. Xem chi tiết tại logo-checklist.md -->



@include('components.home.marquee')

<!-- ==================== 3. QUY TRÌNH LÀM VIỆC — 2 NGÀNH, 1 CHUẨN MỰC ==================== -->
<!-- TODO: Cung cấp 2 ảnh RAW và Color Graded cùng góc máy chất lượng cao (1920x1080) -->
@include('components.home.workflow')

<!-- ==================== 4. CÔNG NGHỆ & THIẾT BỊ THỰC CHIẾN ==================== -->
@include('components.home.tech_gear')
<!-- ==================== 5. BA TRỤ CỘT NĂNG LỰC CỐT LÕI (PILLARS) ==================== -->
@include('components.home.services')

<!-- ==================== 6. SỐ LIỆU THỐNG KÊ (GSAP SCROLLTRIGGER COUNTER) ==================== -->
@include('components.home.stats')

<!-- ==================== 7. SỰ KẾT HỢP ĐỘC BẢN (SPOTLIGHT MOUSE OVERLAY) ==================== -->
@include('components.home.why_clm')

<!-- ==================== 8. DỰ ÁN TIÊU BIỂU & MẪU GIAO DIỆN DEMO (TAB-TRONG-TAB) ==================== -->
@include('components.home.portfolio')
<!-- ==================== 10. BÀI VIẾT & KINH NGHIỆM THỰC TẾ (INSIGHTS) ==================== -->
@include('components.home.insights')

<!-- ==================== 11. CTA BAND CUỐI TRANG (FLOWING GRADIENT & LIGHT STREAKS) ==================== -->
@include('components.home.cta')
@endsection


