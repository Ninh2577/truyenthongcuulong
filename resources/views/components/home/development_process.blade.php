{{-- 
    UI-08: TECHNOLOGY DEVELOPMENT PROCESS / HOW WE BUILD
    Section giải thích quy trình phát triển giải pháp công nghệ từ bài toán đến hệ thống vận hành thực tế.
    Định vị: Technology First, Ngôn ngữ Business-First, Cấu trúc Problem -> Architecture -> Design -> Dev -> QA -> Delivery.
--}}
<section class="w-full bg-surface bg-dot-grid-subtle py-14 lg:py-20 relative border-b border-slate-200/80 gsap-reveal-section overflow-hidden" 
         id="development-process" 
         aria-labelledby="development-process-title">
    
    <!-- Ambient Tech Glow Accents -->
    <div class="absolute -top-32 left-1/2 -translate-x-1/2 w-[600px] h-[300px] bg-gradient-to-b from-sky-400/8 via-primary/5 to-transparent blur-3xl pointer-events-none" aria-hidden="true"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        <!-- ==================== SECTION HEADER ==================== -->
        <div class="text-center max-w-3xl mx-auto mb-12 lg:mb-16">
            <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-sky-100 text-sky-800 font-mono text-xs font-bold border border-sky-200 mb-3.5 shadow-2xs">
                <span class="material-symbols-outlined text-[16px] text-primary" aria-hidden="true">account_tree</span>
                <span>QUY TRÌNH TRIỂN KHAI &bull; HOW WE BUILD</span>
            </div>
            
            <h2 id="development-process-title" class="font-headline text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-navy-base">
                Từ Bài Toán Doanh Nghiệp Đến Hệ Thống Vận Hành
            </h2>
            
            <p class="font-body text-slate-600 text-base sm:text-lg mt-3.5 leading-relaxed">
                Chúng tôi chuyển hóa yêu cầu vận hành của bạn thành giải pháp phần mềm bài bản thông qua quy trình 6 bước rõ ràng, minh bạch từng cột mốc bàn giao.
            </p>
        </div>

        <!-- ==================== 6-STEP PROGRESSIVE WORKFLOW GRID ==================== -->
        <div class="relative">
            <!-- Decorative Connecting Line for Desktop (Hidden on Mobile/Tablet) -->
            <div class="hidden lg:block absolute top-1/2 left-8 right-8 h-0.5 bg-gradient-to-r from-sky-200 via-slate-200 to-amber-200 -translate-y-8 pointer-events-none" aria-hidden="true"></div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                
                <!-- BƯỚC 01: Khảo Sát & Tiếp Nhận Bài Toán -->
                <div class="group relative rounded-2xl bg-white border border-slate-200/90 hover:border-primary/50 shadow-xs hover:shadow-md transition-all duration-300 p-6 sm:p-7 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <span class="font-mono text-xs font-black tracking-wider text-primary bg-orange-50 border border-orange-200/70 px-2.5 py-1 rounded-md">
                                BƯỚC 01
                            </span>
                            <div class="w-10 h-10 rounded-xl bg-slate-50 border border-slate-100 flex items-center justify-center text-slate-500 group-hover:text-primary group-hover:bg-orange-50 transition-colors" aria-hidden="true">
                                <span class="material-symbols-outlined text-[20px]">manage_search</span>
                            </div>
                        </div>

                        <h3 class="font-headline text-lg sm:text-xl font-bold text-navy-base group-hover:text-primary transition-colors">
                            Khảo Sát &amp; Tiếp Nhận Bài Toán
                        </h3>

                        <p class="font-body text-slate-600 text-sm mt-2.5 leading-relaxed">
                            Lắng nghe bài toán vận hành thực tế, làm rõ mục tiêu tăng trưởng và xác định phạm vi giải pháp cần triển khai cho doanh nghiệp.
                        </p>
                    </div>

                    <div class="mt-6 pt-4 border-t border-slate-100 flex items-start gap-2">
                        <span class="material-symbols-outlined text-[16px] text-emerald-600 shrink-0 mt-0.5" aria-hidden="true">task_alt</span>
                        <div class="text-xs">
                            <span class="font-bold text-slate-800">Kết quả đầu ra:</span>
                            <span class="text-slate-600 ml-1">Tài liệu phạm vi dự án &amp; định hướng giải pháp sơ bộ</span>
                        </div>
                    </div>
                </div>

                <!-- BƯỚC 02: Phân Tích Nghiệp Vụ & Kiến Trúc -->
                <div class="group relative rounded-2xl bg-white border border-slate-200/90 hover:border-primary/50 shadow-xs hover:shadow-md transition-all duration-300 p-6 sm:p-7 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <span class="font-mono text-xs font-black tracking-wider text-primary bg-orange-50 border border-orange-200/70 px-2.5 py-1 rounded-md">
                                BƯỚC 02
                            </span>
                            <div class="w-10 h-10 rounded-xl bg-slate-50 border border-slate-100 flex items-center justify-center text-slate-500 group-hover:text-primary group-hover:bg-orange-50 transition-colors" aria-hidden="true">
                                <span class="material-symbols-outlined text-[20px]">schema</span>
                            </div>
                        </div>

                        <h3 class="font-headline text-lg sm:text-xl font-bold text-navy-base group-hover:text-primary transition-colors">
                            Phân Tích Nghiệp Vụ &amp; Kiến Trúc
                        </h3>

                        <p class="font-body text-slate-600 text-sm mt-2.5 leading-relaxed">
                            Mô hình hóa luồng xử lý dữ liệu, thiết kế sơ đồ quan hệ và lựa chọn công nghệ phù hợp với quy mô sử dụng lâu dài.
                        </p>
                    </div>

                    <div class="mt-6 pt-4 border-t border-slate-100 flex items-start gap-2">
                        <span class="material-symbols-outlined text-[16px] text-emerald-600 shrink-0 mt-0.5" aria-hidden="true">task_alt</span>
                        <div class="text-xs">
                            <span class="font-bold text-slate-800">Kết quả đầu ra:</span>
                            <span class="text-slate-600 ml-1">Đặc tả yêu cầu chức năng &amp; sơ đồ kiến trúc hệ thống</span>
                        </div>
                    </div>
                </div>

                <!-- BƯỚC 03: Thiết Kế Trải Nghiệm (UI/UX) -->
                <div class="group relative rounded-2xl bg-white border border-slate-200/90 hover:border-primary/50 shadow-xs hover:shadow-md transition-all duration-300 p-6 sm:p-7 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <span class="font-mono text-xs font-black tracking-wider text-primary bg-orange-50 border border-orange-200/70 px-2.5 py-1 rounded-md">
                                BƯỚC 03
                            </span>
                            <div class="w-10 h-10 rounded-xl bg-slate-50 border border-slate-100 flex items-center justify-center text-slate-500 group-hover:text-primary group-hover:bg-orange-50 transition-colors" aria-hidden="true">
                                <span class="material-symbols-outlined text-[20px]">devices</span>
                            </div>
                        </div>

                        <h3 class="font-headline text-lg sm:text-xl font-bold text-navy-base group-hover:text-primary transition-colors">
                            Thiết Kế Trải Nghiệm (UI/UX)
                        </h3>

                        <p class="font-body text-slate-600 text-sm mt-2.5 leading-relaxed">
                            Xây dựng khung giao diện tương tác trên Figma, tối ưu luồng thao tác trên thiết bị di động và máy tính trước khi bắt đầu lập trình.
                        </p>
                    </div>

                    <div class="mt-6 pt-4 border-t border-slate-100 flex items-start gap-2">
                        <span class="material-symbols-outlined text-[16px] text-emerald-600 shrink-0 mt-0.5" aria-hidden="true">task_alt</span>
                        <div class="text-xs">
                            <span class="font-bold text-slate-800">Kết quả đầu ra:</span>
                            <span class="text-slate-600 ml-1">Bản mẫu giao diện trực quan hoàn chỉnh được doanh nghiệp duyệt</span>
                        </div>
                    </div>
                </div>

                <!-- BƯỚC 04: Lập Trình & Tích Hợp Hệ Thống -->
                <div class="group relative rounded-2xl bg-white border border-slate-200/90 hover:border-primary/50 shadow-xs hover:shadow-md transition-all duration-300 p-6 sm:p-7 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <span class="font-mono text-xs font-black tracking-wider text-primary bg-orange-50 border border-orange-200/70 px-2.5 py-1 rounded-md">
                                BƯỚC 04
                            </span>
                            <div class="w-10 h-10 rounded-xl bg-slate-50 border border-slate-100 flex items-center justify-center text-slate-500 group-hover:text-primary group-hover:bg-orange-50 transition-colors" aria-hidden="true">
                                <span class="material-symbols-outlined text-[20px]">code</span>
                            </div>
                        </div>

                        <h3 class="font-headline text-lg sm:text-xl font-bold text-navy-base group-hover:text-primary transition-colors">
                            Lập Trình &amp; Tích Hợp Hệ Thống
                        </h3>

                        <p class="font-body text-slate-600 text-sm mt-2.5 leading-relaxed">
                            Phát triển chức năng theo tài liệu kiến trúc, kết nối cơ sở dữ liệu nội bộ và các cổng dịch vụ bên ngoài an toàn, ổn định.
                        </p>
                    </div>

                    <div class="mt-6 pt-4 border-t border-slate-100 flex items-start gap-2">
                        <span class="material-symbols-outlined text-[16px] text-emerald-600 shrink-0 mt-0.5" aria-hidden="true">task_alt</span>
                        <div class="text-xs">
                            <span class="font-bold text-slate-800">Kết quả đầu ra:</span>
                            <span class="text-slate-600 ml-1">Phiên bản thử nghiệm (Staging) để doanh nghiệp trực tiếp dùng thử</span>
                        </div>
                    </div>
                </div>

                <!-- BƯỚC 05: Kiểm Thử & Tối Ưu Vận Hành -->
                <div class="group relative rounded-2xl bg-white border border-slate-200/90 hover:border-primary/50 shadow-xs hover:shadow-md transition-all duration-300 p-6 sm:p-7 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <span class="font-mono text-xs font-black tracking-wider text-primary bg-orange-50 border border-orange-200/70 px-2.5 py-1 rounded-md">
                                BƯỚC 05
                            </span>
                            <div class="w-10 h-10 rounded-xl bg-slate-50 border border-slate-100 flex items-center justify-center text-slate-500 group-hover:text-primary group-hover:bg-orange-50 transition-colors" aria-hidden="true">
                                <span class="material-symbols-outlined text-[20px]">fact_check</span>
                            </div>
                        </div>

                        <h3 class="font-headline text-lg sm:text-xl font-bold text-navy-base group-hover:text-primary transition-colors">
                            Kiểm Thử &amp; Tối Ưu Vận Hành
                        </h3>

                        <p class="font-body text-slate-600 text-sm mt-2.5 leading-relaxed">
                            Rà soát toàn diện các trường hợp xử lý lỗi, kiểm tra khả năng hiển thị đa màn hình và tối ưu hóa thời gian phản hồi của trang.
                        </p>
                    </div>

                    <div class="mt-6 pt-4 border-t border-slate-100 flex items-start gap-2">
                        <span class="material-symbols-outlined text-[16px] text-emerald-600 shrink-0 mt-0.5" aria-hidden="true">task_alt</span>
                        <div class="text-xs">
                            <span class="font-bold text-slate-800">Kết quả đầu ra:</span>
                            <span class="text-slate-600 ml-1">Biên bản kiểm thử nghiệm thu chức năng nội bộ</span>
                        </div>
                    </div>
                </div>

                <!-- BƯỚC 06: Bàn Giao & Hỗ Trợ Khởi Chạy -->
                <div class="group relative rounded-2xl bg-white border border-slate-200/90 hover:border-primary/50 shadow-xs hover:shadow-md transition-all duration-300 p-6 sm:p-7 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <span class="font-mono text-xs font-black tracking-wider text-primary bg-orange-50 border border-orange-200/70 px-2.5 py-1 rounded-md">
                                BƯỚC 06
                            </span>
                            <div class="w-10 h-10 rounded-xl bg-slate-50 border border-slate-100 flex items-center justify-center text-slate-500 group-hover:text-primary group-hover:bg-orange-50 transition-colors" aria-hidden="true">
                                <span class="material-symbols-outlined text-[20px]">rocket_launch</span>
                            </div>
                        </div>

                        <h3 class="font-headline text-lg sm:text-xl font-bold text-navy-base group-hover:text-primary transition-colors">
                            Bàn Giao &amp; Hỗ Trợ Khởi Chạy
                        </h3>

                        <p class="font-body text-slate-600 text-sm mt-2.5 leading-relaxed">
                            Cấu hình đưa hệ thống lên môi trường chính thức, hướng dẫn chi tiết người quản trị vận hành và duy trì chế độ hỗ trợ bảo hành kỹ thuật.
                        </p>
                    </div>

                    <div class="mt-6 pt-4 border-t border-slate-100 flex items-start gap-2">
                        <span class="material-symbols-outlined text-[16px] text-emerald-600 shrink-0 mt-0.5" aria-hidden="true">task_alt</span>
                        <div class="text-xs">
                            <span class="font-bold text-slate-800">Kết quả đầu ra:</span>
                            <span class="text-slate-600 ml-1">Hệ thống số chính thức đi vào hoạt động &amp; tài liệu bàn giao</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- ==================== ACTION CTA BAND ==================== -->
        <div class="mt-12 lg:mt-16 text-center">
            <div class="inline-flex flex-col sm:flex-row items-center justify-center gap-4 bg-slate-50/90 border border-slate-200/90 rounded-3xl p-6 sm:px-10 sm:py-7 shadow-xs max-w-3xl mx-auto">
                <div class="text-left sm:text-left">
                    <span class="font-headline font-bold text-base sm:text-lg text-navy-base block">
                        Bạn đã sẵn sàng khởi động dự án công nghệ?
                    </span>
                    <span class="font-body text-xs sm:text-sm text-slate-600 block mt-0.5">
                        Chúng tôi hỗ trợ tư vấn giải pháp và lộ trình kỹ thuật phù hợp với ngân sách của bạn.
                    </span>
                </div>

                <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2.5 sm:gap-3 w-full sm:w-auto mt-4 sm:mt-0 shrink-0">
                    <a href="{{ route('contact') }}" 
                       class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-full bg-navy-base hover:bg-slate-800 text-white font-headline text-sm font-bold shadow-md shadow-navy-base/20 hover:scale-[1.02] active:scale-[0.98] transition-all group focus-visible:ring-2 focus-visible:ring-primary focus-visible:outline-none w-full sm:w-auto">
                        <span>Bắt đầu dự án</span>
                        <span class="material-symbols-outlined text-[18px] text-amber-400 group-hover:translate-x-0.5 transition-transform" aria-hidden="true">arrow_forward</span>
                    </a>
                    
                    <a href="{{ route('services.web-app') }}" 
                       class="inline-flex items-center justify-center gap-1.5 px-4 py-3 rounded-full bg-white hover:bg-slate-100 text-slate-700 hover:text-primary font-headline text-xs sm:text-sm font-semibold border border-slate-200 transition-all focus-visible:ring-2 focus-visible:ring-primary focus-visible:outline-none w-full sm:w-auto">
                        <span>Xem dịch vụ Web-App</span>
                    </a>
                </div>
            </div>
        </div>

    </div>
</section>
