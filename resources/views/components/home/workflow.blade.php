<section class="w-full bg-surface bg-dot-grid-subtle py-12 lg:py-16 relative border-b border-slate-200/80 gsap-reveal-section" id="workflow-section" x-data="{ activeTab: 'media' }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-10 lg:mb-12">
            <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-orange-100/70 text-primary font-mono text-xs font-bold border border-orange-200 mb-3">
                <span class="material-symbols-outlined text-[15px]">account_tree</span>
                <span>STANDARDIZED DELIVERY PIPELINE</span>
            </div>
            <h2 class="font-headline text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-navy-base">
                Hai Ngành Riêng Biệt &bull; Một Chuẩn Mực Thực Thi
            </h2>
            <p class="font-body text-slate-600 text-base sm:text-lg mt-4 leading-relaxed">
                Mọi dự án tại Truyền Thông Cửu Long đều tuân thủ quy trình kiểm soát chất lượng 6 bước nghiêm ngặt, minh bạch từng mốc nghiệm thu.
            </p>

            <!-- 2-Tab Switcher -->
            <div class="inline-flex p-1.5 rounded-full bg-slate-200/80 border border-slate-300 mt-8 shadow-inner">
                <button @click="activeTab = 'media'" 
                        :class="activeTab === 'media' ? 'bg-primary text-white shadow-md' : 'text-slate-600 hover:text-navy-base'"
                        class="px-6 py-2.5 rounded-full font-headline text-xs sm:text-sm font-bold transition-all duration-200 flex items-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">videocam</span>
                    <span>Quy Trình Sản Xuất Phim / Video</span>
                </button>
                <button @click="activeTab = 'tech'" 
                        :class="activeTab === 'tech' ? 'bg-navy-base text-white shadow-md' : 'text-slate-600 hover:text-navy-base'"
                        class="px-6 py-2.5 rounded-full font-headline text-xs sm:text-sm font-bold transition-all duration-200 flex items-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">terminal</span>
                    <span>Quy Trình Phát Triển Web / App</span>
                </button>
            </div>
        </div>

        <!-- Tab 1: Film / Video Production Pipeline -->
        <div x-show="activeTab === 'media'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="flex flex-col gap-12">
            <!-- 6-Step Visual Timeline Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Step 1 -->
                <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-xs hover:border-primary/50 transition-all flex flex-col gap-3">
                    <div class="flex items-center justify-between">
                        <span class="px-2.5 py-0.5 rounded bg-orange-100 text-primary font-mono text-xs font-bold">BƯỚC 01</span>
                        <span class="material-symbols-outlined text-slate-400">lightbulb</span>
                    </div>
                    <h3 class="font-headline text-lg font-bold text-navy-base">Khảo Sát &amp; Định Hướng Kịch Bản</h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">
                        Phân tích đề bài, chân dung khách hàng mục tiêu, thông điệp cốt lõi và xây dựng concept kịch bản đạo diễn chi tiết.
                    </p>
                </div>

                <!-- Step 2 -->
                <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-xs hover:border-primary/50 transition-all flex flex-col gap-3">
                    <div class="flex items-center justify-between">
                        <span class="px-2.5 py-0.5 rounded bg-orange-100 text-primary font-mono text-xs font-bold">BƯỚC 02</span>
                        <span class="material-symbols-outlined text-slate-400">draw</span>
                    </div>
                    <h3 class="font-headline text-lg font-bold text-navy-base">Storyboard &amp; Tiền Kỳ Chi Tiết</h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">
                        Vẽ phân cảnh storyboard, chọn bối cảnh, tuyển diễn viên, chuẩn bị thiết bị điện ảnh và lập kế hoạch quay shooting schedule.
                    </p>
                </div>

                <!-- Step 3 -->
                <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-xs hover:border-primary/50 transition-all flex flex-col gap-3">
                    <div class="flex items-center justify-between">
                        <span class="px-2.5 py-0.5 rounded bg-orange-100 text-primary font-mono text-xs font-bold">BƯỚC 03</span>
                        <span class="material-symbols-outlined text-slate-400">movie</span>
                    </div>
                    <h3 class="font-headline text-lg font-bold text-navy-base">Tác Nghiệp Bấm Máy Hiện Trường</h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">
                        Ghi hình với chuẩn 4K/8K RAW, hệ thống ánh sáng cinema, âm thanh thu trực tiếp chuyên nghiệp và flycam khảo sát góc cao.
                    </p>
                </div>

                <!-- Step 4 -->
                <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-xs hover:border-primary/50 transition-all flex flex-col gap-3">
                    <div class="flex items-center justify-between">
                        <span class="px-2.5 py-0.5 rounded bg-orange-100 text-primary font-mono text-xs font-bold">BƯỚC 04</span>
                        <span class="material-symbols-outlined text-slate-400">cut</span>
                    </div>
                    <h3 class="font-headline text-lg font-bold text-navy-base">Dựng Phim Thô &amp; Tinh Chỉnh Nhịp</h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">
                        Lắp ráp các cảnh quay theo kịch bản đạo diễn, căn chỉnh nhịp độ cảm xúc, biên tập âm nhạc nền và hiệu ứng âm thanh SFX.
                    </p>
                </div>

                <!-- Step 5 -->
                <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-xs hover:border-primary/50 transition-all flex flex-col gap-3">
                    <div class="flex items-center justify-between">
                        <span class="px-2.5 py-0.5 rounded bg-orange-100 text-primary font-mono text-xs font-bold">BƯỚC 05</span>
                        <span class="material-symbols-outlined text-slate-400">palette</span>
                    </div>
                    <h3 class="font-headline text-lg font-bold text-navy-base">Color Grading Chuẩn ACES / DaVinci</h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">
                        Chỉnh màu điện ảnh trên màn hình chuyên dụng chuẩn REC.709/DCI-P3, tạo sắc thái điện ảnh độc quyền cho thương hiệu.
                    </p>
                </div>

                <!-- Step 6 -->
                <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-xs hover:border-primary/50 transition-all flex flex-col gap-3">
                    <div class="flex items-center justify-between">
                        <span class="px-2.5 py-0.5 rounded bg-orange-100 text-primary font-mono text-xs font-bold">BƯỚC 06</span>
                        <span class="material-symbols-outlined text-slate-400">verified</span>
                    </div>
                    <h3 class="font-headline text-lg font-bold text-navy-base">Xuất Bản Master &amp; Bàn Giao Bản Quyền</h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">
                        Xuất file ProRes 422HQ và các định dạng tối ưu đa nền tảng (TikTok, YouTube, Facebook, TV Broadcast) kèm toàn quyền thương mại.
                    </p>
                </div>
            </div>
        </div>

        <!-- Tab 2: Tech & Platform Engineering Pipeline -->
        <div x-show="activeTab === 'tech'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="flex flex-col gap-12">
            <!-- 6-Step Visual Timeline Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Step 1 -->
                <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-xs hover:border-sky-500/50 transition-all flex flex-col gap-3">
                    <div class="flex items-center justify-between">
                        <span class="px-2.5 py-0.5 rounded bg-sky-100 text-sky-700 font-mono text-xs font-bold">PHA 01</span>
                        <span class="material-symbols-outlined text-slate-400">terminal</span>
                    </div>
                    <h3 class="font-headline text-lg font-bold text-navy-base">Khảo Sát &amp; Kiến Trúc Hệ Thống</h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">
                        Phân tích yêu cầu nghiệp vụ, thiết kế cơ sở dữ liệu quan hệ, lựa chọn tech stack và bảo mật hệ thống theo tiêu chuẩn OWASP.
                    </p>
                </div>

                <!-- Step 2 -->
                <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-xs hover:border-sky-500/50 transition-all flex flex-col gap-3">
                    <div class="flex items-center justify-between">
                        <span class="px-2.5 py-0.5 rounded bg-sky-100 text-sky-700 font-mono text-xs font-bold">PHA 02</span>
                        <span class="material-symbols-outlined text-slate-400">devices</span>
                    </div>
                    <h3 class="font-headline text-lg font-bold text-navy-base">Thiết Kế UI/UX &amp; Design System</h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">
                        Xây dựng wireframe tương tác, thiết kế giao diện Figma chuẩn thương hiệu, tối ưu trải nghiệm người dùng trên Mobile First.
                    </p>
                </div>

                <!-- Step 3 -->
                <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-xs hover:border-sky-500/50 transition-all flex flex-col gap-3">
                    <div class="flex items-center justify-between">
                        <span class="px-2.5 py-0.5 rounded bg-sky-100 text-sky-700 font-mono text-xs font-bold">PHA 03</span>
                        <span class="material-symbols-outlined text-slate-400">code</span>
                    </div>
                    <h3 class="font-headline text-lg font-bold text-navy-base">Lập Trình Frontend &amp; Backend API</h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">
                        Phát triển code sạch trên Laravel / Node.js / React / Vue, tích hợp cổng thanh toán, CRM và các dịch vụ bên thứ ba an toàn.
                    </p>
                </div>

                <!-- Step 4 -->
                <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-xs hover:border-sky-500/50 transition-all flex flex-col gap-3">
                    <div class="flex items-center justify-between">
                        <span class="px-2.5 py-0.5 rounded bg-sky-100 text-sky-700 font-mono text-xs font-bold">PHA 04</span>
                        <span class="material-symbols-outlined text-slate-400">speed</span>
                    </div>
                    <h3 class="font-headline text-lg font-bold text-navy-base">Tối Ưu Hiệu Năng &amp; SEO Technical</h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">
                        Tối ưu Core Web Vitals (Lighthouse 90+), cấu trúc schema JSON-LD, nén ảnh thế hệ mới WebP/AVIF và cấu hình CDN Cloudflare.
                    </p>
                </div>

                <!-- Step 5 -->
                <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-xs hover:border-sky-500/50 transition-all flex flex-col gap-3">
                    <div class="flex items-center justify-between">
                        <span class="px-2.5 py-0.5 rounded bg-sky-100 text-sky-700 font-mono text-xs font-bold">PHA 05</span>
                        <span class="material-symbols-outlined text-slate-400">verified_user</span>
                    </div>
                    <h3 class="font-headline text-lg font-bold text-navy-base">Kiểm Thử Tải &amp; Bảo Mật Toàn Diện</h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">
                        Stress-testing chịu tải hàng nghìn kết nối đồng thời, rà soát lỗ hổng SQLi/XSS/CSRF trước khi đưa vào môi trường staging.
                    </p>
                </div>

                <!-- Step 6 -->
                <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-xs hover:border-sky-500/50 transition-all flex flex-col gap-3">
                    <div class="flex items-center justify-between">
                        <span class="px-2.5 py-0.5 rounded bg-sky-100 text-sky-700 font-mono text-xs font-bold">PHA 06</span>
                        <span class="material-symbols-outlined text-slate-400">cloud_done</span>
                    </div>
                    <h3 class="font-headline text-lg font-bold text-navy-base">Triển Khai Cloud &amp; Bảo Trì 24/7</h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">
                        Đóng gói Docker, cấu hình CI/CD tự động lên AWS / Cloud Server, sao lưu dữ liệu định kỳ mỗi ngày và hỗ trợ kỹ thuật liên tục.
                    </p>
                </div>
            </div>

            <!-- Interactive Code Typewriter Terminal Mockup -->
            <div class="p-6 sm:p-8 rounded-3xl bg-[#081023] text-white border border-white/15 shadow-xl">
                <div class="flex items-center justify-between pb-4 border-b border-white/10 text-xs font-mono text-slate-400 mb-4">
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 rounded-full bg-red-500"></span>
                        <span class="w-3 h-3 rounded-full bg-amber-500"></span>
                        <span class="w-3 h-3 rounded-full bg-emerald-500"></span>
                        <span class="ml-2 text-slate-300 font-bold">routes/api.php &bull; TruyenThongCuuLong Tech Engine</span>
                    </div>
                    <span class="px-2.5 py-0.5 rounded bg-white/10 text-emerald-400 text-[11px] font-bold">Production Ready</span>
                </div>
                <div class="bg-black/60 p-5 rounded-2xl border border-white/10 font-mono text-xs sm:text-sm text-emerald-400 overflow-x-auto min-h-[140px] flex items-center">
                    <div class="flex items-center">
                        <span class="text-slate-500 mr-3 select-none">$</span>
                        <code id="code-typewriter-target" class="text-slate-200"></code>
                        <span class="typewriter-cursor inline-block w-2 h-4 bg-primary ml-1"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>