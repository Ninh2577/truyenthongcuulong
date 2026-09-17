<?php $__env->startSection('title', 'Truyền Thông Cửu Long - Creative Production Studio & Tech Agency'); ?>
<?php $__env->startSection('meta_description', 'Creative Production Studio & Enterprise Tech Agency hàng đầu Cần Thơ & ĐBSCL. Sản xuất Video TVC 4K chuẩn điện ảnh, giải pháp Web/App hiệu năng cao và chiến dịch truyền thông số đột phá.'); ?>
<?php $__env->startSection('body-class', 'page-home'); ?>

<?php $__env->startSection('content'); ?>
<!-- Custom Cursor for Portfolio Section (Desktop Only) -->
<div id="case-study-cursor" class="fixed pointer-events-none z-50 w-16 h-16 rounded-full bg-primary text-white flex items-center justify-center font-headline text-xs font-bold shadow-2xl opacity-0 ring-4 ring-orange-400/35">
    <div class="flex items-center gap-0.5">
        <span>Xem</span>
        <span class="material-symbols-outlined text-[14px]">arrow_outward</span>
    </div>
</div>

<!-- ==================== 1. HERO SECTION (CINEMATIC TIMELINE & GSAP REVEAL) ==================== -->
<?php echo $__env->make('components.home.hero', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<!-- ==================== 2. DẢI LOGO ĐỐI TÁC & KHÁCH HÀNG (SEAMLESS INFINITE MARQUEE) ==================== -->
<!-- TODO: Cần thu thập file logo chính thức (PNG/SVG nền trong suốt) của từng đối tác/khách hàng liệt kê ở trên, từ chính các đối tác/khách hàng hoặc từ bộ nhận diện thương hiệu đã lưu trữ nội bộ của Cửu Long Media, để thay thế wordmark text bằng logo thật -->
<!-- LƯU Ý QUẢN TRỊ: "MTC" và "Phú Thọ" xuất hiện 2 lần trong dữ liệu gốc website cũ. Cần quản trị viên xác nhận 2 đối tác khác nhau hay lặp bản ghi trước khi chốt logo chính thức. Xem chi tiết tại logo-checklist.md -->



<?php echo $__env->make('components.home.marquee', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<!-- ==================== 3. QUY TRÌNH LÀM VIỆC — 2 NGÀNH, 1 CHUẨN MỰC ==================== -->
<!-- TODO: Cung cấp 2 ảnh RAW và Color Graded cùng góc máy chất lượng cao (1920x1080) -->
<?php echo $__env->make('components.home.workflow', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<!-- ==================== 4. CÔNG NGHỆ & THIẾT BỊ THỰC CHIẾN ==================== -->
<?php echo $__env->make('components.home.tech_gear', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<!-- ==================== 5. BA TRỤ CỘT NĂNG LỰC CỐT LÕI (PILLARS) ==================== -->
<?php echo $__env->make('components.home.services', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<!-- ==================== 6. SỐ LIỆU THỐNG KÊ (GSAP SCROLLTRIGGER COUNTER) ==================== -->
<?php echo $__env->make('components.home.stats', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<!-- ==================== 7. SỰ KẾT HỢP ĐỘC BẢN (SPOTLIGHT MOUSE OVERLAY) ==================== -->
<?php echo $__env->make('components.home.why_clm', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<!-- ==================== 8. DỰ ÁN TIÊU BIỂU & MẪU GIAO DIỆN DEMO (TAB-TRONG-TAB) ==================== -->
<?php echo $__env->make('components.home.portfolio', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<!-- ==================== 10. BÀI VIẾT & KINH NGHIỆM THỰC TẾ (INSIGHTS) ==================== -->
<?php echo $__env->make('components.home.insights', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<!-- ==================== 11. CTA BAND CUỐI TRANG (FLOWING GRADIENT & LIGHT STREAKS) ==================== -->
<?php echo $__env->make('components.home.cta', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\truyenthongcuulong-laravel\resources\views/home.blade.php ENDPATH**/ ?>