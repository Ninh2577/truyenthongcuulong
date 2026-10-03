@extends('layouts.app')

@section('title', 'Dịch Vụ SEO Tổng Thể Chuyên Sâu • Đưa Thương Hiệu Lên Top Google - Truyền Thông Cửu Long')
@section('meta_description', 'Dịch vụ SEO tổng thể toàn diện từ kỹ thuật, nội dung đến trải nghiệm người dùng, giúp doanh nghiệp tăng trưởng bền vững, thu hút khách hàng tự nhiên và xây dựng vị thế vững chắc trên Google.')

@section('content')
<div class="w-full bg-[#fcfdff] text-slate-800 antialiased overflow-x-hidden" style="font-family: var(--font-primary, 'Mulish', sans-serif);">

    <!-- ==========================================
         1. HERO SECTION (BANNER ĐẦU TRANG - FULL-WIDTH NỀN SÁNG NHẸ NHÀNG)
         ========================================== -->
    <section class="relative pt-24 sm:pt-28 lg:pt-32 pb-14 sm:pb-20 overflow-hidden border-b border-orange-100/50"
             style="background: radial-gradient(circle at 75% 30%, rgba(255, 122, 41, 0.20) 0%, rgba(255, 245, 238, 0.8) 45%, #ffffff 85%);">
        
        <!-- Ambient Glows Nổi Bật & Đổ Bóng Nền -->
        <div class="absolute top-1/4 right-0 w-[620px] h-[620px] bg-gradient-to-br from-amber-400/45 via-orange-500/35 to-transparent rounded-full blur-[100px] pointer-events-none -mr-32"></div>
        <div class="absolute bottom-0 left-10 w-[500px] h-[500px] bg-gradient-to-tr from-emerald-400/35 via-sky-400/30 to-transparent rounded-full blur-[90px] pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10 items-center">
                
                <!-- Left Column: Content & Call To Actions -->
                <div class="lg:col-span-6 space-y-6 sm:space-y-7">
                    
                    <!-- Tag / Category -->
                    <div class="flex items-center gap-2 text-[#ff5400] text-xs font-bold font-mono tracking-wider uppercase">
                        <span class="w-4 h-0.5 bg-[#ff5400]"></span>
                        <span>DỊCH VỤ SEO TỔNG THỂ</span>
                    </div>

                    <!-- Main H1 -->
                    <div class="space-y-3">
                        <h1 class="text-3xl sm:text-4xl md:text-5xl font-black text-[#0c192e] tracking-tight leading-[1.18]">
                            Giải Pháp SEO Toàn Diện<br>
                            <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#ff5400] via-[#ff7a29] to-[#ea580c]">
                                Đưa Thương Hiệu Lên Top
                            </span>
                        </h1>
                        <p class="text-sm sm:text-base text-slate-600 font-normal leading-relaxed max-w-xl">
                            Tối ưu website toàn diện từ kỹ thuật, nội dung đến trải nghiệm người dùng, giúp doanh nghiệp tăng trưởng bền vững, thu hút khách hàng tự nhiên và xây dựng vị thế vững chắc trên Google.
                        </p>
                    </div>

                    <!-- 4 Feature Pills -->
                    <div class="grid grid-cols-2 gap-3 max-w-md pt-1">
                        <div class="flex items-center gap-2 text-xs sm:text-sm font-semibold text-slate-700">
                            <span class="w-5 h-5 rounded-full bg-orange-100 text-[#ff5400] flex items-center justify-center text-xs shrink-0 font-bold">✓</span>
                            <span>Tăng trưởng bền vững</span>
                        </div>
                        <div class="flex items-center gap-2 text-xs sm:text-sm font-semibold text-slate-700">
                            <span class="w-5 h-5 rounded-full bg-orange-100 text-[#ff5400] flex items-center justify-center text-xs shrink-0 font-bold">✓</span>
                            <span>Khách hàng tự nhiên</span>
                        </div>
                        <div class="flex items-center gap-2 text-xs sm:text-sm font-semibold text-slate-700">
                            <span class="w-5 h-5 rounded-full bg-orange-100 text-[#ff5400] flex items-center justify-center text-xs shrink-0 font-bold">✓</span>
                            <span>Hiệu quả dài hạn</span>
                        </div>
                        <div class="flex items-center gap-2 text-xs sm:text-sm font-semibold text-slate-700">
                            <span class="w-5 h-5 rounded-full bg-orange-100 text-[#ff5400] flex items-center justify-center text-xs shrink-0 font-bold">✓</span>
                            <span>Chi phí tối ưu</span>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-wrap items-center gap-4 pt-2">
                        <a href="{{ route('contact') }}" 
                           class="inline-flex items-center justify-center gap-2 px-7 py-3.5 rounded-full bg-gradient-to-r from-[#ff5400] via-[#ff7a29] to-[#ea580c] hover:from-[#e64a00] hover:to-[#ff5400] text-white font-extrabold text-sm sm:text-base shadow-lg shadow-orange-500/25 hover:shadow-orange-500/40 hover:scale-105 active:scale-100 transition-all duration-300">
                            <span>Nhận tư vấn miễn phí</span>
                            <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                        </a>

                        <a href="#case-study" 
                           class="inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-full bg-white hover:bg-slate-50 text-slate-800 font-bold text-sm sm:text-base border border-slate-200 shadow-xs hover:border-orange-300 transition-all duration-300">
                            <span>Xem case study</span>
                            <span class="material-symbols-outlined text-[18px] text-[#ff5400]">play_arrow</span>
                        </a>
                    </div>

                </div>

                <!-- Right Column: 3D High-End Hero Showcase (Ảnh hero-seo.png) -->
                <div class="lg:col-span-6 relative">
                    
                    <!-- Ambient Glow Behind Laptop -->
                    <div class="absolute top-[45%] left-[55%] -translate-x-1/2 -translate-y-1/2 w-[90%] h-[85%] rounded-full pointer-events-none z-0"
                         style="background: radial-gradient(ellipse at center, rgba(254, 215, 64, 0.65) 0%, rgba(251, 191, 36, 0.45) 30%, rgba(245, 158, 11, 0.22) 55%, transparent 75%); filter: blur(40px);">
                    </div>

                    <!-- Main Hero Image (hero-seo.png) -->
                    <div class="relative z-10 w-full select-none transform hover:scale-[1.02] transition-transform duration-500">
                        <img src="{{ asset('images/seo/hero-seo.png') }}?v={{ time() }}" 
                             alt="Dịch vụ SEO tổng thể - Giải pháp đưa thương hiệu lên Top Google" 
                             class="w-full h-auto object-contain block select-none pointer-events-none drop-shadow-[0_15px_30px_rgba(0,0,0,0.12)]">
                    </div>

                </div>

            </div>
        </div>
    </section>


    <!-- =========================================================================
         BỌC TOÀN BỘ NỘI DUNG (SECTIONS 2 ĐẾN 5) TRONG THẺ CONTAINER
         VỚI NỀN ĐỔ BÓNG / ÁNH SÁNG AMBIENT GLOW CHUẨN CAO CẤP
         ========================================================================= -->
    <div class="relative w-full overflow-hidden" 
         style="background: radial-gradient(circle at 12% 16%, rgba(255, 122, 41, 0.22) 0%, transparent 50%), 
                           radial-gradient(circle at 88% 36%, rgba(14, 165, 233, 0.20) 0%, transparent 55%), 
                           radial-gradient(circle at 18% 65%, rgba(245, 158, 11, 0.22) 0%, transparent 55%),
                           radial-gradient(circle at 85% 88%, rgba(16, 185, 129, 0.20) 0%, transparent 50%),
                           linear-gradient(180deg, #ffffff 0%, #f8faff 40%, #f3f7fd 100%);">
        
        <!-- Ambient Background Glows & Shadows Nổi Bật -->
        <div class="absolute top-[5%] -left-24 w-[640px] h-[640px] rounded-full bg-gradient-to-br from-orange-400/50 via-amber-300/35 to-transparent blur-[100px] pointer-events-none"></div>
        <div class="absolute top-[26%] -right-28 w-[720px] h-[720px] rounded-full bg-gradient-to-bl from-sky-400/45 via-indigo-300/30 to-transparent blur-[110px] pointer-events-none"></div>
        <div class="absolute top-[54%] -left-20 w-[680px] h-[680px] rounded-full bg-gradient-to-tr from-emerald-400/40 via-teal-300/30 to-transparent blur-[100px] pointer-events-none"></div>
        <div class="absolute bottom-[3%] right-[-5%] w-[640px] h-[640px] rounded-full bg-gradient-to-tl from-amber-400/50 via-orange-400/35 to-transparent blur-[100px] pointer-events-none"></div>

        <x-ui.container class="container py-12 sm:py-16 lg:py-20 relative z-10">

        <!-- ==========================================
             2. 5 LÝ DO BẠN NÊN CHỌN TRUYỀN THÔNG CỬU LONG
             ========================================== -->
        <section id="ly-do-chon" class="space-y-8 sm:space-y-10 scroll-mt-28">
            
            <!-- Section Header -->
            <div class="max-w-3xl mx-auto text-center space-y-3">
                <div class="text-xs font-bold text-[#ff5400] uppercase font-mono tracking-wider flex items-center justify-center gap-1.5">
                    <span class="font-extrabold text-orange-500">::</span>
                    <span>TẠI SAO CHỌN DỊCH VỤ SEO TỔNG THỂ CỦA CHÚNG TÔI</span>
                </div>
                <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-[#0c192e] tracking-tight">
                    5 Lý Do Bạn Nên Chọn Truyền Thông Cửu Long
                </h2>
                <p class="text-xs sm:text-sm md:text-base text-slate-600 leading-relaxed max-w-2xl mx-auto">
                    Chúng tôi không chỉ giúp bạn lên top, mà còn giúp bạn tăng trưởng doanh thu thực sự từ Google.
                </p>
            </div>

            <!-- 5 Cards in a row -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
                
                <!-- Card 1: Chiến lược cá nhân hóa -->
                <div class="p-6 rounded-2xl bg-white border border-slate-200/80 shadow-md hover:shadow-xl hover:-translate-y-1 hover:border-amber-300 transition-all duration-300 flex flex-col items-center text-center space-y-3.5 group">
                    <div class="w-12 h-12 rounded-full bg-amber-50 border border-amber-200/60 flex items-center justify-center text-amber-600 group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-[24px]">insights</span>
                    </div>
                    <h3 class="text-sm sm:text-base font-bold text-slate-900 group-hover:text-amber-600 transition-colors">
                        Chiến lược cá nhân hóa
                    </h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Tư vấn và triển khai theo từng ngành nghề, từng mục tiêu kinh doanh.
                    </p>
                </div>

                <!-- Card 2: Đội ngũ chuyên gia -->
                <div class="p-6 rounded-2xl bg-white border border-slate-200/80 shadow-md hover:shadow-xl hover:-translate-y-1 hover:border-emerald-300 transition-all duration-300 flex flex-col items-center text-center space-y-3.5 group">
                    <div class="w-12 h-12 rounded-full bg-emerald-50 border border-emerald-200/60 flex items-center justify-center text-emerald-600 group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-[24px]">verified_user</span>
                    </div>
                    <h3 class="text-sm sm:text-base font-bold text-slate-900 group-hover:text-emerald-600 transition-colors">
                        Đội ngũ chuyên gia
                    </h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Kinh nghiệm thực chiến nhiều năm, am hiểu thuật toán Google.
                    </p>
                </div>

                <!-- Card 3: Quy trình minh bạch -->
                <div class="p-6 rounded-2xl bg-white border border-slate-200/80 shadow-md hover:shadow-xl hover:-translate-y-1 hover:border-sky-300 transition-all duration-300 flex flex-col items-center text-center space-y-3.5 group">
                    <div class="w-12 h-12 rounded-full bg-sky-50 border border-sky-200/60 flex items-center justify-center text-sky-600 group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-[24px]">settings</span>
                    </div>
                    <h3 class="text-sm sm:text-base font-bold text-slate-900 group-hover:text-sky-600 transition-colors">
                        Quy trình minh bạch
                    </h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Báo cáo định kỳ, theo dõi thứ hạng và hiệu quả rõ ràng.
                    </p>
                </div>

                <!-- Card 4: Công nghệ hiện đại -->
                <div class="p-6 rounded-2xl bg-white border border-slate-200/80 shadow-md hover:shadow-xl hover:-translate-y-1 hover:border-purple-300 transition-all duration-300 flex flex-col items-center text-center space-y-3.5 group">
                    <div class="w-12 h-12 rounded-full bg-purple-50 border border-purple-200/60 flex items-center justify-center text-purple-600 group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-[24px]">smart_toy</span>
                    </div>
                    <h3 class="text-sm sm:text-base font-bold text-slate-900 group-hover:text-purple-600 transition-colors">
                        Công nghệ hiện đại
                    </h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Ứng dụng AI, dữ liệu lớn và công cụ SEO tiên tiến.
                    </p>
                </div>

                <!-- Card 5: Hỗ trợ tận tâm -->
                <div class="p-6 rounded-2xl bg-white border border-slate-200/80 shadow-md hover:shadow-xl hover:-translate-y-1 hover:border-rose-300 transition-all duration-300 flex flex-col items-center text-center space-y-3.5 group">
                    <div class="w-12 h-12 rounded-full bg-rose-50 border border-rose-200/60 flex items-center justify-center text-rose-600 group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-[24px]">support_agent</span>
                    </div>
                    <h3 class="text-sm sm:text-base font-bold text-slate-900 group-hover:text-rose-600 transition-colors">
                        Hỗ trợ tận tâm
                    </h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Luôn đồng hành cùng bạn trong suốt quá trình phát triển.
                    </p>
                </div>

            </div>

        </section>


        <!-- ==========================================
             3. 6 BƯỚC SEO TỔNG THỂ HIỆU QUẢ
             ========================================== -->
        <section id="quy-trinh" class="space-y-8 sm:space-y-10 scroll-mt-28" style="margin-top: clamp(45px, 5.5vw, 65px);">
            
            <!-- Section Header -->
            <div class="max-w-3xl mx-auto text-center space-y-3">
                <div class="text-xs font-bold text-[#ff5400] uppercase font-mono tracking-wider flex items-center justify-center gap-1.5">
                    <span class="font-extrabold text-orange-500">::</span>
                    <span>QUY TRÌNH TRIỂN KHAI</span>
                </div>
                <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-[#0c192e] tracking-tight">
                    6 Bước SEO Tổng Thể Hiệu Quả
                </h2>
                <p class="text-xs sm:text-sm md:text-base text-slate-600 leading-relaxed max-w-2xl mx-auto">
                    Từ phân tích đến tối ưu, chúng tôi đồng hành cùng bạn trên mọi chặng đường.
                </p>
            </div>

            <!-- 6 Steps Cards Grid -->
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-3 sm:gap-4">
                
                <!-- Step 01: Phân tích & Audit -->
                <div class="p-4 sm:p-5 rounded-2xl bg-white border border-slate-200/80 shadow-md hover:shadow-xl hover:-translate-y-1 hover:border-orange-300 transition-all flex flex-col justify-between space-y-3 relative group">
                    <div class="flex items-center justify-between">
                        <span class="w-6 h-6 rounded-full bg-orange-500 text-white font-mono text-[10px] font-black flex items-center justify-center">01</span>
                        <span class="w-8 h-8 rounded-full bg-orange-50 text-orange-500 flex items-center justify-center">
                            <span class="material-symbols-outlined text-[18px]">search</span>
                        </span>
                    </div>
                    <div>
                        <h4 class="text-xs sm:text-sm font-bold text-slate-900 group-hover:text-[#ff5400] transition-colors leading-snug">Phân tích &amp; Audit</h4>
                        <p class="text-[11px] text-slate-500 mt-1 leading-relaxed">Đánh giá tổng thể website, đối thủ và thị trường.</p>
                    </div>
                </div>

                <!-- Step 02: Nghiên cứu từ khóa -->
                <div class="p-4 sm:p-5 rounded-2xl bg-white border border-slate-200/80 shadow-md hover:shadow-xl hover:-translate-y-1 hover:border-emerald-300 transition-all flex flex-col justify-between space-y-3 relative group">
                    <div class="flex items-center justify-between">
                        <span class="w-6 h-6 rounded-full bg-emerald-500 text-white font-mono text-[10px] font-black flex items-center justify-center">02</span>
                        <span class="w-8 h-8 rounded-full bg-emerald-50 text-emerald-500 flex items-center justify-center">
                            <span class="material-symbols-outlined text-[18px]">description</span>
                        </span>
                    </div>
                    <div>
                        <h4 class="text-xs sm:text-sm font-bold text-slate-900 group-hover:text-emerald-600 transition-colors leading-snug">Nghiên cứu từ khóa</h4>
                        <p class="text-[11px] text-slate-500 mt-1 leading-relaxed">Chọn lọc từ khóa chất lượng, phù hợp mục tiêu kinh doanh.</p>
                    </div>
                </div>

                <!-- Step 03: Tối ưu kỹ thuật -->
                <div class="p-4 sm:p-5 rounded-2xl bg-white border border-slate-200/80 shadow-md hover:shadow-xl hover:-translate-y-1 hover:border-sky-300 transition-all flex flex-col justify-between space-y-3 relative group">
                    <div class="flex items-center justify-between">
                        <span class="w-6 h-6 rounded-full bg-sky-500 text-white font-mono text-[10px] font-black flex items-center justify-center">03</span>
                        <span class="w-8 h-8 rounded-full bg-sky-50 text-sky-500 flex items-center justify-center">
                            <span class="material-symbols-outlined text-[18px]">code</span>
                        </span>
                    </div>
                    <div>
                        <h4 class="text-xs sm:text-sm font-bold text-slate-900 group-hover:text-sky-600 transition-colors leading-snug">Tối ưu kỹ thuật</h4>
                        <p class="text-[11px] text-slate-500 mt-1 leading-relaxed">Cải thiện tốc độ, cấu trúc và trải nghiệm người dùng.</p>
                    </div>
                </div>

                <!-- Step 04: Sản xuất nội dung -->
                <div class="p-4 sm:p-5 rounded-2xl bg-white border border-slate-200/80 shadow-md hover:shadow-xl hover:-translate-y-1 hover:border-indigo-300 transition-all flex flex-col justify-between space-y-3 relative group">
                    <div class="flex items-center justify-between">
                        <span class="w-6 h-6 rounded-full bg-indigo-500 text-white font-mono text-[10px] font-black flex items-center justify-center">04</span>
                        <span class="w-8 h-8 rounded-full bg-indigo-50 text-indigo-500 flex items-center justify-center">
                            <span class="material-symbols-outlined text-[18px]">edit_square</span>
                        </span>
                    </div>
                    <div>
                        <h4 class="text-xs sm:text-sm font-bold text-slate-900 group-hover:text-indigo-600 transition-colors leading-snug">Sản xuất nội dung</h4>
                        <p class="text-[11px] text-slate-500 mt-1 leading-relaxed">Xây dựng nội dung chuẩn SEO, giá trị và hấp dẫn.</p>
                    </div>
                </div>

                <!-- Step 05: Xây dựng liên kết -->
                <div class="p-4 sm:p-5 rounded-2xl bg-white border border-slate-200/80 shadow-md hover:shadow-xl hover:-translate-y-1 hover:border-cyan-300 transition-all flex flex-col justify-between space-y-3 relative group">
                    <div class="flex items-center justify-between">
                        <span class="w-6 h-6 rounded-full bg-cyan-500 text-white font-mono text-[10px] font-black flex items-center justify-center">05</span>
                        <span class="w-8 h-8 rounded-full bg-cyan-50 text-cyan-500 flex items-center justify-center">
                            <span class="material-symbols-outlined text-[18px]">link</span>
                        </span>
                    </div>
                    <div>
                        <h4 class="text-xs sm:text-sm font-bold text-slate-900 group-hover:text-cyan-600 transition-colors leading-snug">Xây dựng liên kết</h4>
                        <p class="text-[11px] text-slate-500 mt-1 leading-relaxed">Tăng độ uy tín và thẩm quyền cho website.</p>
                    </div>
                </div>

                <!-- Step 06: Đo lường & Báo cáo -->
                <div class="p-4 sm:p-5 rounded-2xl bg-white border border-slate-200/80 shadow-md hover:shadow-xl hover:-translate-y-1 hover:border-blue-400 transition-all flex flex-col justify-between space-y-3 relative group">
                    <div class="flex items-center justify-between">
                        <span class="w-6 h-6 rounded-full bg-blue-600 text-white font-mono text-[10px] font-black flex items-center justify-center">06</span>
                        <span class="w-8 h-8 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center">
                            <span class="material-symbols-outlined text-[18px]">bar_chart</span>
                        </span>
                    </div>
                    <div>
                        <h4 class="text-xs sm:text-sm font-bold text-slate-900 group-hover:text-blue-600 transition-colors leading-snug">Đo lường &amp; Báo cáo</h4>
                        <p class="text-[11px] text-slate-500 mt-1 leading-relaxed">Theo dõi, tối ưu liên tục, đảm bảo hiệu quả.</p>
                    </div>
                </div>

            </div>

        </section>


        <!-- ==========================================
             4. CÁC HẠNG MỤC DỊCH VỤ (GIẢI PHÁP SEO TOÀN DIỆN CHO DOANH NGHIỆP)
             ========================================== -->
        <section id="hang-muc-dich-vu" class="space-y-8 sm:space-y-10 scroll-mt-28" style="margin-top: clamp(45px, 5.5vw, 65px);">
            
            <!-- Section Header -->
            <div class="max-w-3xl mx-auto text-center space-y-3">
                <div class="text-xs font-bold text-[#ff5400] uppercase font-mono tracking-wider flex items-center justify-center gap-1.5">
                    <span class="font-extrabold text-orange-500">::</span>
                    <span>CÁC HẠNG MỤC DỊCH VỤ</span>
                </div>
                <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-[#0c192e] tracking-tight">
                    Giải Pháp SEO Toàn Diện Cho Doanh Nghiệp
                </h2>
                <p class="text-xs sm:text-sm md:text-base text-slate-600 leading-relaxed max-w-2xl mx-auto">
                    Tùy theo nhu cầu và mục tiêu, chúng tôi cung cấp các gói dịch vụ linh hoạt, phù hợp với từng giai đoạn phát triển của doanh nghiệp.
                </p>
            </div>

            <!-- 2 Columns Grid: 3D Illustration Left + 6 Services Cards Right -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10 items-center">
                
                <!-- Left: 3D Illustration (seo-categories-3d.png) -->
                <div class="lg:col-span-5 relative flex items-center justify-center">
                    <div class="absolute -inset-4 bg-gradient-to-tr from-sky-300/20 via-orange-300/15 to-transparent rounded-3xl blur-2xl pointer-events-none"></div>
                    <img src="{{ asset('images/seo/seo-categories-3d.png') }}?v={{ time() }}" 
                         alt="Hạng mục dịch vụ SEO toàn diện" 
                         class="w-full max-w-md h-auto object-contain block relative z-10 drop-shadow-xl hover:scale-[1.02] transition-transform duration-300">
                </div>

                <!-- Right: 6 Service Cards (2 Columns x 3 Rows) -->
                <div class="lg:col-span-7 grid grid-cols-1 sm:grid-cols-2 gap-4">
                    
                    <!-- 1. SEO Tổng Thể -->
                    <div class="p-5 rounded-2xl bg-white border border-slate-200/80 shadow-md hover:shadow-xl hover:-translate-y-1 hover:border-orange-300 transition-all flex flex-col justify-between space-y-3 group">
                        <div class="space-y-2">
                            <span class="w-9 h-9 rounded-xl bg-orange-50 text-[#ff5400] flex items-center justify-center group-hover:scale-110 transition-transform">
                                <span class="material-symbols-outlined text-[20px]">settings_suggest</span>
                            </span>
                            <h3 class="text-sm sm:text-base font-bold text-slate-900 group-hover:text-[#ff5400] transition-colors">
                                SEO Tổng Thể
                            </h3>
                            <p class="text-xs text-slate-600 leading-relaxed">
                                Tối ưu toàn diện từ kỹ thuật, nội dung đến liên kết.
                            </p>
                        </div>
                        <a href="{{ route('contact') }}" class="text-xs font-bold text-[#ff5400] inline-flex items-center gap-1 hover:gap-2 transition-all">
                            <span>Tìm hiểu thêm</span> <span>➔</span>
                        </a>
                    </div>

                    <!-- 2. Local SEO -->
                    <div class="p-5 rounded-2xl bg-white border border-slate-200/80 shadow-md hover:shadow-xl hover:-translate-y-1 hover:border-emerald-300 transition-all flex flex-col justify-between space-y-3 group">
                        <div class="space-y-2">
                            <span class="w-9 h-9 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                                <span class="material-symbols-outlined text-[20px]">pin_drop</span>
                            </span>
                            <h3 class="text-sm sm:text-base font-bold text-slate-900 group-hover:text-emerald-600 transition-colors">
                                Local SEO
                            </h3>
                            <p class="text-xs text-slate-600 leading-relaxed">
                                Phủ sóng Google Maps, tăng khách hàng địa phương.
                            </p>
                        </div>
                        <a href="{{ route('contact') }}" class="text-xs font-bold text-emerald-600 inline-flex items-center gap-1 hover:gap-2 transition-all">
                            <span>Tìm hiểu thêm</span> <span>➔</span>
                        </a>
                    </div>

                    <!-- 3. SEO Content -->
                    <div class="p-5 rounded-2xl bg-white border border-slate-200/80 shadow-md hover:shadow-xl hover:-translate-y-1 hover:border-sky-300 transition-all flex flex-col justify-between space-y-3 group">
                        <div class="space-y-2">
                            <span class="w-9 h-9 rounded-xl bg-sky-50 text-sky-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                                <span class="material-symbols-outlined text-[20px]">article</span>
                            </span>
                            <h3 class="text-sm sm:text-base font-bold text-slate-900 group-hover:text-sky-600 transition-colors">
                                SEO Content
                            </h3>
                            <p class="text-xs text-slate-600 leading-relaxed">
                                Sản xuất nội dung chuẩn SEO, giàu giá trị, đúng ý định tìm kiếm.
                            </p>
                        </div>
                        <a href="{{ route('contact') }}" class="text-xs font-bold text-sky-600 inline-flex items-center gap-1 hover:gap-2 transition-all">
                            <span>Tìm hiểu thêm</span> <span>➔</span>
                        </a>
                    </div>

                    <!-- 4. Xây Dựng Backlink -->
                    <div class="p-5 rounded-2xl bg-white border border-slate-200/80 shadow-md hover:shadow-xl hover:-translate-y-1 hover:border-purple-300 transition-all flex flex-col justify-between space-y-3 group">
                        <div class="space-y-2">
                            <span class="w-9 h-9 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                                <span class="material-symbols-outlined text-[20px]">link</span>
                            </span>
                            <h3 class="text-sm sm:text-base font-bold text-slate-900 group-hover:text-purple-600 transition-colors">
                                Xây Dựng Backlink
                            </h3>
                            <p class="text-xs text-slate-600 leading-relaxed">
                                Tăng độ uy tín, cải thiện thứ hạng bền vững.
                            </p>
                        </div>
                        <a href="{{ route('contact') }}" class="text-xs font-bold text-purple-600 inline-flex items-center gap-1 hover:gap-2 transition-all">
                            <span>Tìm hiểu thêm</span> <span>➔</span>
                        </a>
                    </div>

                    <!-- 5. SEO Kỹ Thuật -->
                    <div class="p-5 rounded-2xl bg-white border border-slate-200/80 shadow-md hover:shadow-xl hover:-translate-y-1 hover:border-teal-300 transition-all flex flex-col justify-between space-y-3 group">
                        <div class="space-y-2">
                            <span class="w-9 h-9 rounded-xl bg-teal-50 text-teal-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                                <span class="material-symbols-outlined text-[20px]">code</span>
                            </span>
                            <h3 class="text-sm sm:text-base font-bold text-slate-900 group-hover:text-teal-600 transition-colors">
                                SEO Kỹ Thuật
                            </h3>
                            <p class="text-xs text-slate-600 leading-relaxed">
                                Khắc phục lỗi, tối ưu tốc độ, nâng cao trải nghiệm.
                            </p>
                        </div>
                        <a href="{{ route('contact') }}" class="text-xs font-bold text-teal-600 inline-flex items-center gap-1 hover:gap-2 transition-all">
                            <span>Tìm hiểu thêm</span> <span>➔</span>
                        </a>
                    </div>

                    <!-- 6. Đo Lường & Báo Cáo -->
                    <div class="p-5 rounded-2xl bg-white border border-slate-200/80 shadow-md hover:shadow-xl hover:-translate-y-1 hover:border-rose-300 transition-all flex flex-col justify-between space-y-3 group">
                        <div class="space-y-2">
                            <span class="w-9 h-9 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                                <span class="material-symbols-outlined text-[20px]">pie_chart</span>
                            </span>
                            <h3 class="text-sm sm:text-base font-bold text-slate-900 group-hover:text-rose-600 transition-colors">
                                Đo Lường &amp; Báo Cáo
                            </h3>
                            <p class="text-xs text-slate-600 leading-relaxed">
                                Theo dõi hiệu quả, tối ưu liên tục theo dữ liệu.
                            </p>
                        </div>
                        <a href="{{ route('contact') }}" class="text-xs font-bold text-rose-600 inline-flex items-center gap-1 hover:gap-2 transition-all">
                            <span>Tìm hiểu thêm</span> <span>➔</span>
                        </a>
                    </div>

                </div>

            </div>

        </section>


        <!-- ==========================================
             5. CASE STUDY THỰC TẾ (NHỮNG KẾT QUẢ ĐÁNG TỰ HÀO)
             ========================================== -->
        <section id="case-study" class="space-y-8 sm:space-y-10 scroll-mt-28" style="margin-top: clamp(45px, 5.5vw, 65px);">
            
            <!-- Section Header -->
            <div class="max-w-3xl mx-auto text-center space-y-3">
                <div class="text-xs font-bold text-[#ff5400] uppercase font-mono tracking-wider flex items-center justify-center gap-1.5">
                    <span class="font-extrabold text-orange-500">::</span>
                    <span>CASE STUDY THỰC TẾ</span>
                </div>
                <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-[#0c192e] tracking-tight">
                    Những Kết Quả Đáng Tự Hào
                </h2>
                <p class="text-xs sm:text-sm md:text-base text-slate-600 leading-relaxed max-w-2xl mx-auto">
                    Chúng tôi đã giúp nhiều doanh nghiệp tại Cần Thơ và khu vực ĐBSCL đạt được bước tiến vượt bậc trên Google.
                </p>
            </div>

            <!-- 2 Columns Grid: iPad Case Study Left + Metrics & Quote Right -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10 items-center">
                
                <!-- Left: Tablet with Keywords Ranking (seo-casestudy-proof.png) -->
                <div class="lg:col-span-7 relative group">
                    <div class="absolute -inset-4 bg-gradient-to-tr from-emerald-500/15 via-sky-400/15 to-transparent rounded-3xl blur-2xl pointer-events-none"></div>
                    <img src="{{ asset('images/seo/seo-casestudy-proof.png') }}?v={{ time() }}" 
                         alt="Case study thực tế tăng trưởng từ khóa lên Top Google" 
                         class="w-full h-auto object-contain block relative z-10 mx-auto drop-shadow-xl transform group-hover:scale-[1.01] transition-transform duration-300">
                </div>

                <!-- Right: Stats & Testimonial Quote -->
                <div class="lg:col-span-5 space-y-4">
                    
                    <!-- 3 Stats Cards in a Row / Column -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-1 gap-3.5">
                        
                        <!-- Metric 1: Top 1 Keywords -->
                        <div class="p-4 rounded-2xl bg-white border border-slate-200/80 shadow-md hover:shadow-xl hover:-translate-y-0.5 transition-all flex items-center gap-4">
                            <span class="w-12 h-12 rounded-xl bg-amber-50 text-amber-500 flex items-center justify-center shrink-0">
                                <span class="material-symbols-outlined text-[26px]">military_tech</span>
                            </span>
                            <div>
                                <div class="text-2xl font-black text-slate-900 font-mono">75+</div>
                                <div class="text-xs text-slate-500 font-medium">Từ khóa đạt Top 1</div>
                            </div>
                        </div>

                        <!-- Metric 2: Traffic Growth -->
                        <div class="p-4 rounded-2xl bg-white border border-slate-200/80 shadow-md hover:shadow-xl hover:-translate-y-0.5 transition-all flex items-center gap-4">
                            <span class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-500 flex items-center justify-center shrink-0">
                                <span class="material-symbols-outlined text-[26px]">trending_up</span>
                            </span>
                            <div>
                                <div class="text-2xl font-black text-emerald-600 font-mono">220%</div>
                                <div class="text-xs text-slate-500 font-medium">Tăng trưởng traffic</div>
                            </div>
                        </div>

                        <!-- Metric 3: Revenue Growth -->
                        <div class="p-4 rounded-2xl bg-white border border-slate-200/80 shadow-md hover:shadow-xl hover:-translate-y-0.5 transition-all flex items-center gap-4">
                            <span class="w-12 h-12 rounded-xl bg-sky-50 text-sky-500 flex items-center justify-center shrink-0">
                                <span class="material-symbols-outlined text-[26px]">attach_money</span>
                            </span>
                            <div>
                                <div class="text-2xl font-black text-sky-600 font-mono">180%</div>
                                <div class="text-xs text-slate-500 font-medium">Tăng doanh thu</div>
                            </div>
                        </div>

                    </div>

                    <!-- Testimonial Quote Box -->
                    <div class="p-6 rounded-2xl bg-[#fffbf5] border border-amber-200/70 shadow-md hover:shadow-lg transition-all space-y-3 relative overflow-hidden">
                        <span class="text-3xl text-amber-400 font-serif leading-none block">“</span>
                        <p class="text-xs sm:text-sm text-slate-700 leading-relaxed italic">
                            "Một chiến lược SEO bài bản, chỉ sau 6 tháng website đã lọt top 1-3 cho nhiều từ khóa quan trọng, lượng khách hàng tăng rõ rệt."
                        </p>
                        <div class="text-xs font-bold text-slate-900 pt-1 border-t border-amber-200/50">
                            — Khách hàng tiêu biểu
                        </div>
                    </div>

                </div>

            </div>

        </section>

    </x-ui.container>
    </div>


    <!-- ==========================================
         6. SẴN SÀNG BỨT PHÁ CÙNG SEO? (BANNER HOÀNG HÔN CẦU CẦN THƠ - FULL-WIDTH)
         ========================================== -->
    <section class="w-full relative overflow-hidden py-16 sm:py-20 lg:py-24 text-white bg-slate-950">
        
        <!-- Background Twilight Landscape Photo -->
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/seo/seo-cta-sunset.jpg') }}?v={{ time() }}" 
                 alt="Cầu Cần Thơ hoàng hôn - Truyền Thông Cửu Long" 
                 class="w-full h-full object-cover object-center opacity-65">
            <div class="absolute inset-0 bg-gradient-to-r from-slate-950/95 via-slate-950/88 to-slate-950/80"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 flex flex-col lg:flex-row items-start lg:items-center justify-between gap-8 sm:gap-10">
            
            <!-- Left Info -->
            <div class="space-y-3 max-w-2xl">
                <div class="text-xs font-bold text-[#ff7a29] uppercase font-mono tracking-wider flex items-center gap-1.5">
                    <span class="font-extrabold text-[#ff5400]">::</span>
                    <span>SẴN SÀNG BỨT PHÁ CÙNG SEO?</span>
                </div>
                <h2 class="text-2xl sm:text-3xl lg:text-4xl xl:text-5xl font-black text-white tracking-tight leading-tight">
                    Để Khách Hàng Tìm Thấy Bạn Trước<br class="hidden sm:inline"> Khi Họ Tìm Đối Thủ
                </h2>
                <p class="text-xs sm:text-sm md:text-base text-slate-300 font-normal leading-relaxed">
                    Liên hệ ngay với Truyền Thông Cửu Long để nhận tư vấn miễn phí và xây dựng chiến lược SEO phù hợp nhất với doanh nghiệp của bạn.
                </p>
            </div>

            <!-- Right Action Buttons & Phone -->
            <div class="flex flex-col sm:flex-row lg:flex-col items-start sm:items-center lg:items-start gap-4 shrink-0">
                <a href="{{ route('contact') }}" 
                   class="inline-flex items-center justify-center gap-2 px-8 py-3.5 rounded-full bg-gradient-to-r from-[#ff5400] to-[#ea580c] hover:from-[#ea580c] hover:to-[#ff5400] text-white font-extrabold text-sm shadow-xl shadow-orange-500/30 hover:scale-105 active:scale-100 transition-all duration-300">
                    <span>Nhận tư vấn miễn phí</span>
                    <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                </a>

                <!-- Phone Row: Màu nền đậm sang trọng, viền cam phát sáng, icon rung chuông & sóng xung kích -->
                <div class="relative flex items-center gap-3.5 p-2 sm:p-2.5 pr-6 rounded-full bg-slate-950/90 backdrop-blur-md border border-orange-500/40 shadow-2xl hover:border-orange-400 group transition-all duration-300"
                     style="box-shadow: 0 12px 35px -5px rgba(0, 0, 0, 0.85), 0 0 25px rgba(255, 84, 0, 0.35);">
                    
                    <!-- Ambient Rich Orange Shadow/Glow (Đổ bóng màu cam phát sáng quanh nền đậm) -->
                    <div class="absolute -inset-1 bg-gradient-to-r from-orange-600/40 via-amber-500/25 to-transparent rounded-full blur-md pointer-events-none"></div>

                    <!-- Animated Call Icon Container -->
                    <div class="relative flex items-center justify-center w-11 h-11 sm:w-12 sm:h-12 shrink-0">
                        <!-- Pulse wave radiating outward -->
                        <span class="absolute inline-flex h-full w-full rounded-full bg-orange-400/60 animate-ping"></span>
                        <span class="absolute inline-flex h-12 w-12 rounded-full bg-amber-400/40 animate-pulse-wave"></span>
                        
                        <!-- Call Icon with Phone Ringing Wobble & Rich Orange Shadow -->
                        <div class="relative w-full h-full rounded-full bg-gradient-to-tr from-[#ff5400] via-[#ff7a29] to-[#ea580c] text-white flex items-center justify-center shadow-lg shadow-orange-500/60 group-hover:scale-105 transition-transform">
                            <span class="material-symbols-outlined text-[22px] sm:text-[24px] animate-phone-ring">call</span>
                        </div>
                    </div>

                    <!-- Phone Number & Subtitle (Siêu sắc nét trên nền đậm) -->
                    <div class="flex flex-col relative z-10">
                        <a href="tel:0939363262" 
                           class="text-white text-xl sm:text-2xl font-black tracking-wide font-mono group-hover:text-amber-300 transition-colors drop-shadow-[0_2px_4px_rgba(0,0,0,0.8)]">
                            0939.363.262
                        </a>
                        <span class="text-[11px] sm:text-xs text-slate-300 group-hover:text-slate-100 font-medium tracking-wide">
                            Gọi ngay để được hỗ trợ nhanh nhất
                        </span>
                    </div>

                </div>
            </div>

        </div>
    </section>

    <!-- Custom Animation Styles for Ringing Phone & Wave Pulse -->
    <style>
        @keyframes phoneRing {
            0%, 100% { transform: rotate(0deg) scale(1); }
            10%, 30% { transform: rotate(-14deg) scale(1.08); }
            20%, 40% { transform: rotate(14deg) scale(1.08); }
            50% { transform: rotate(-8deg) scale(1.04); }
            60% { transform: rotate(8deg) scale(1.04); }
            70%, 90% { transform: rotate(0deg) scale(1); }
        }
        @keyframes pulseWave {
            0% { transform: scale(0.9); opacity: 0.9; }
            50% { transform: scale(1.45); opacity: 0; }
            100% { transform: scale(1.45); opacity: 0; }
        }
        .animate-phone-ring {
            display: inline-block;
            animation: phoneRing 2s infinite ease-in-out;
            transform-origin: center center;
        }
        .animate-pulse-wave {
            animation: pulseWave 2s cubic-bezier(0, 0, 0.2, 1) infinite;
        }
    </style>


    <!-- ==========================================
         7. CÂU HỎI THƯỜNG GẶP (FAQ - BỌC CONTAINER & NỀN ĐỔ BÓNG)
         ========================================== -->
    <div class="relative w-full overflow-hidden" 
         style="background: radial-gradient(circle at 85% 30%, rgba(255, 122, 41, 0.18) 0%, transparent 50%), 
                           radial-gradient(circle at 15% 70%, rgba(14, 165, 233, 0.16) 0%, transparent 50%), 
                           linear-gradient(180deg, #ffffff 0%, #fafdff 100%);">
        <div class="absolute -top-16 -right-16 w-[450px] h-[450px] rounded-full bg-gradient-to-br from-orange-400/35 via-amber-300/25 to-transparent blur-[90px] pointer-events-none"></div>
        <div class="absolute -bottom-16 -left-16 w-[450px] h-[450px] rounded-full bg-gradient-to-tr from-sky-400/30 via-indigo-300/20 to-transparent blur-[90px] pointer-events-none"></div>

        <x-ui.container class="container py-14 sm:py-20 lg:py-24 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-start" x-data="{ active: 1 }">
            
            <!-- Left Header -->
            <div class="lg:col-span-5 space-y-3">
                <div class="text-xs font-bold text-[#ff5400] uppercase font-mono tracking-wider flex items-center gap-1.5">
                    <span class="font-extrabold text-orange-500">::</span>
                    <span>CÂU HỎI THƯỜNG GẶP</span>
                </div>
                <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-[#0c192e] tracking-tight">
                    Giải Đáp Thắc Mắc Về Dịch Vụ SEO
                </h2>
                <p class="text-xs sm:text-sm md:text-base text-slate-600 leading-relaxed">
                    Chúng tôi luôn sẵn sàng giải đáp mọi câu hỏi của bạn.
                </p>
            </div>

            <!-- Right FAQ Accordion List -->
            <div class="lg:col-span-7 divide-y divide-slate-200 border-y border-slate-200">
                
                <!-- FAQ 1 -->
                <div class="py-4">
                    <button type="button" 
                            @click="active = (active === 1 ? null : 1)" 
                            class="w-full flex items-center justify-between text-left gap-4 font-bold text-sm sm:text-base text-slate-900 hover:text-[#ff5400] transition-colors focus:outline-none">
                        <span>Thời gian để lên top Google là bao lâu?</span>
                        <span class="material-symbols-outlined text-[20px] text-slate-400 shrink-0 transition-transform duration-200" 
                              :class="{ 'rotate-45 text-[#ff5400]': active === 1 }">
                            add
                        </span>
                    </button>
                    <div x-show="active === 1" x-collapse class="pt-3 text-xs sm:text-sm text-slate-600 leading-relaxed pr-6">
                        Thông thường từ 2 - 4 tháng để thấy sự cải thiện rõ rệt về thứ hạng và lượt hiển thị. Với các từ khóa cạnh tranh cao, điểm rơi tăng trưởng bùng nổ chuyển đổi và doanh số bền vững thường đạt từ tháng thứ 4 đến tháng thứ 6 sau khi tối ưu toàn diện kỹ thuật On-page và nội dung E-E-A-T.
                    </div>
                </div>

                <!-- FAQ 2 -->
                <div class="py-4">
                    <button type="button" 
                            @click="active = (active === 2 ? null : 2)" 
                            class="w-full flex items-center justify-between text-left gap-4 font-bold text-sm sm:text-base text-slate-900 hover:text-[#ff5400] transition-colors focus:outline-none">
                        <span>Chi phí dịch vụ SEO được tính như thế nào?</span>
                        <span class="material-symbols-outlined text-[20px] text-slate-400 shrink-0 transition-transform duration-200" 
                              :class="{ 'rotate-45 text-[#ff5400]': active === 2 }">
                            add
                        </span>
                    </button>
                    <div x-show="active === 2" x-collapse class="pt-3 text-xs sm:text-sm text-slate-600 leading-relaxed pr-6">
                        Chi phí được tính toán minh bạch dựa trên số lượng từ khóa mục tiêu, độ cạnh tranh của ngành nghề, tình trạng hiện tại của website và mục tiêu tăng trưởng doanh số cụ thể. Cửu Long luôn cung cấp báo giá chi tiết, không phát sinh chi phí ẩn.
                    </div>
                </div>

                <!-- FAQ 3 -->
                <div class="py-4">
                    <button type="button" 
                            @click="active = (active === 3 ? null : 3)" 
                            class="w-full flex items-center justify-between text-left gap-4 font-bold text-sm sm:text-base text-slate-900 hover:text-[#ff5400] transition-colors focus:outline-none">
                        <span>Có cam kết lên top không?</span>
                        <span class="material-symbols-outlined text-[20px] text-slate-400 shrink-0 transition-transform duration-200" 
                              :class="{ 'rotate-45 text-[#ff5400]': active === 3 }">
                            add
                        </span>
                    </button>
                    <div x-show="active === 3" x-collapse class="pt-3 text-xs sm:text-sm text-slate-600 leading-relaxed pr-6">
                        Chúng tôi có cam kết KPI thứ hạng từ khóa rõ ràng trong hợp đồng pháp lý minh bạch. Đồng thời 100% sử dụng kỹ thuật White-Hat (SEO mũ trắng) an toàn tuyệt đối, duy trì vị thế vững chắc ngay cả khi Google cập nhật thuật toán lõi.
                    </div>
                </div>

                <!-- FAQ 4 -->
                <div class="py-4">
                    <button type="button" 
                            @click="active = (active === 4 ? null : 4)" 
                            class="w-full flex items-center justify-between text-left gap-4 font-bold text-sm sm:text-base text-slate-900 hover:text-[#ff5400] transition-colors focus:outline-none">
                        <span>Tôi có thể tự làm SEO được không?</span>
                        <span class="material-symbols-outlined text-[20px] text-slate-400 shrink-0 transition-transform duration-200" 
                              :class="{ 'rotate-45 text-[#ff5400]': active === 4 }">
                            add
                        </span>
                    </button>
                    <div x-show="active === 4" x-collapse class="pt-3 text-xs sm:text-sm text-slate-600 leading-relaxed pr-6">
                        Bạn hoàn toàn có thể tự thực hiện các bước cơ bản như viết bài và chia sẻ mạng xã hội. Tuy nhiên, để cạnh tranh với các đối thủ mạnh trong ngành, việc sở hữu một đội ngũ chuyên nghiệp am hiểu sâu về Technical SEO, Schema JSON-LD, Core Web Vitals và Entity đa kênh sẽ giúp tiết kiệm tối đa thời gian và mang lại hiệu quả gấp nhiều lần.
                    </div>
                </div>

                <!-- FAQ 5 -->
                <div class="py-4">
                    <button type="button" 
                            @click="active = (active === 5 ? null : 5)" 
                            class="w-full flex items-center justify-between text-left gap-4 font-bold text-sm sm:text-base text-slate-900 hover:text-[#ff5400] transition-colors focus:outline-none">
                        <span>Sau khi hoàn thành, tôi có được hỗ trợ tiếp không?</span>
                        <span class="material-symbols-outlined text-[20px] text-slate-400 shrink-0 transition-transform duration-200" 
                              :class="{ 'rotate-45 text-[#ff5400]': active === 5 }">
                            add
                        </span>
                    </button>
                    <div x-show="active === 5" x-collapse class="pt-3 text-xs sm:text-sm text-slate-600 leading-relaxed pr-6">
                        Có. Sau khi dự án nghiệm thu, Cửu Long có chính sách bảo hành thứ hạng, bàn giao toàn bộ tài khoản Google Search Console & GA4 chính chủ cho bạn, đồng thời đào tạo và hướng dẫn đội ngũ nội bộ của bạn cách duy trì và phát triển nội dung lâu dài.
                    </div>
                </div>

            </div>

        </div>
    </x-ui.container>
    </div>

</div>
@endsection
