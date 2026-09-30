<!-- ==================== CORPORATE HOLDING & B2B ENTERPRISE ==================== -->
<div class="w-full bg-[#f8fafc] text-slate-800 font-sans">

    <!-- Top corporate strip -->
    <div class="bg-[#0f172a] text-slate-300 text-xs py-2 px-4 sm:px-8 flex items-center justify-between border-b border-slate-800">
        <div class="flex items-center gap-2">
            <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
            <span class="font-bold text-white uppercase">{{ $template->title }}</span>
            <span class="hidden sm:inline">• Báo cáo tài chính & Quan hệ cổ đông 2026</span>
        </div>
        <div class="flex items-center gap-6 text-[11px] text-slate-400">
            <span>Trụ sở chính: <strong>Cần Thơ & TP. Hồ Chí Minh</strong></span>
            <span>Hotline: 0939.363.262</span>
        </div>
    </div>

    <!-- Header Navigation -->
    <header class="bg-white border-b border-slate-200 sticky top-0 z-30 shadow-xs">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-slate-900 text-white flex items-center justify-center font-bold text-xl shadow-md">
                    🏛
                </div>
                <div class="flex flex-col">
                    <span class="text-xl font-black text-slate-900 tracking-tight uppercase">{{ preg_replace('/Mẫu website /i', '', $template->title) }}</span>
                    <span class="text-[9px] font-bold text-slate-400 tracking-widest uppercase">TẬP ĐOÀN ĐA NGÀNH</span>
                </div>
            </div>

            <nav class="hidden lg:flex items-center gap-7 text-xs font-bold text-slate-700 uppercase tracking-wide">
                <a href="#hero" class="text-slate-900">Trang chủ</a>
                <a href="#sectors" class="hover:text-slate-900 transition-colors">Lĩnh vực hoạt động</a>
                <a href="#about" class="hover:text-slate-900 transition-colors">Hồ sơ năng lực</a>
                <a href="#governance" class="hover:text-slate-900 transition-colors">Quản trị & Phát triển bền vững</a>
                <a href="#contact" class="hover:text-slate-900 transition-colors">Liên hệ hợp tác</a>
            </nav>

            <a href="#contact" class="px-5 py-2.5 rounded-full bg-slate-900 hover:bg-black text-white font-bold text-xs uppercase tracking-wider shadow-sm transition-all">
                Kết Nối Đầu Tư
            </a>
        </div>
    </header>

    <!-- Hero Section -->
    <section id="hero" class="py-16 lg:py-24 bg-gradient-to-r from-slate-950 via-slate-900 to-slate-950 text-white px-4 sm:px-8">
        <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            <div class="lg:col-span-7 space-y-6">
                <span class="inline-block px-3 py-1 rounded-full bg-white/10 text-amber-300 text-xs font-mono font-bold tracking-wider">
                    CHIẾN LƯỢC PHÁT TRIỂN DÀI HẠN 2026 - 2035
                </span>

                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black text-white leading-tight">
                    Kiến Tạo Giá Trị Bền Vững <br><span class="text-amber-400">Nâng Tầm Vị Thế Doanh Nghiệp</span>
                </h1>

                <p class="text-xs sm:text-sm text-slate-300 leading-relaxed max-w-xl">
                    {{ $template->summary ?: 'Hệ sinh thái dịch vụ chuyên nghiệp, chuẩn mực quản trị quốc tế và cam kết đồng hành lâu dài cùng đối tác chiến lược.' }}
                </p>

                <div class="flex flex-wrap items-center gap-4 pt-2">
                    <a href="#contact" class="px-7 py-3 rounded-full bg-amber-400 hover:bg-amber-500 text-slate-950 font-black text-xs uppercase tracking-wider shadow-lg transition-all">
                        Tải Hồ Sơ Doanh Nghiệp (Profile PDF)
                    </a>
                    <a href="#sectors" class="px-6 py-3 rounded-full bg-white/10 hover:bg-white/20 text-white font-bold text-xs uppercase tracking-wider border border-white/20 transition-all">
                        Xem Các Lĩnh Vực
                    </a>
                </div>

                <div class="pt-6 border-t border-slate-800 grid grid-cols-3 gap-3">
                    <div>
                        <div class="text-2xl font-black text-white font-mono">15+</div>
                        <div class="text-[10px] text-slate-400">Năm Kinh Nghiệm Vận Hành</div>
                    </div>
                    <div>
                        <div class="text-2xl font-black text-amber-400 font-mono">500+</div>
                        <div class="text-[10px] text-slate-400">Đối Tác Khách Hàng B2B</div>
                    </div>
                    <div>
                        <div class="text-2xl font-black text-emerald-400 font-mono">ISO 9001</div>
                        <div class="text-[10px] text-slate-400">Tiêu Chuẩn Quản Lý Chất Lượng</div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-5">
                <img src="{{ $template->thumbnail_url ?: 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&w=800&q=80' }}" alt="Corporate HQ" class="w-full rounded-3xl shadow-2xl border-4 border-slate-800 aspect-4/3 object-cover">
            </div>
        </div>
    </section>

    <!-- Sectors -->
    <section id="sectors" class="py-16 bg-white border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-xl mx-auto mb-12">
                <span class="text-xs font-bold text-slate-400 uppercase tracking-widest font-mono">BUSINESS ECOSYSTEM</span>
                <h2 class="text-2xl sm:text-3xl font-black text-slate-900 mt-1">Trụ Cột Kinh Doanh Cốt Lõi</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="p-6 rounded-3xl bg-slate-50 border border-slate-200 space-y-3">
                    <span class="text-3xl">💼</span>
                    <h3 class="text-lg font-bold text-slate-900">Dịch Vụ Tư Vấn Chiến Lược</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">Tái cấu trúc tổ chức, chuyển đổi số quy trình quản trị và thẩm định đầu tư dự án.</p>
                </div>
                <div class="p-6 rounded-3xl bg-slate-50 border border-slate-200 space-y-3">
                    <span class="text-3xl">🌐</span>
                    <h3 class="text-lg font-bold text-slate-900">Giải Pháp Công Nghệ Số</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">Xây dựng hạ tầng phần mềm bảo mật cao, tự động hóa quy trình nghiệp vụ nội bộ.</p>
                </div>
                <div class="p-6 rounded-3xl bg-slate-50 border border-slate-200 space-y-3">
                    <span class="text-3xl">🤝</span>
                    <h3 class="text-lg font-bold text-slate-900">Hợp Tác Quốc Tế & Đầu Tư</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">Mở rộng chuỗi cung ứng toàn cầu, thu hút nguồn vốn và liên doanh đa phương.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact section -->
    <section id="contact" class="py-16 bg-slate-900 text-white">
        <div class="max-w-3xl mx-auto px-4 text-center space-y-6">
            <span class="text-xs font-bold text-amber-400 uppercase tracking-widest font-mono">PARTNERSHIP</span>
            <h2 class="text-2xl sm:text-3xl font-black">Kết Nối Với Hội Đồng Quản Trị</h2>
            <p class="text-xs sm:text-sm text-slate-400">Vui lòng để lại lời nhắn để bộ phận quan hệ đối tác liên hệ sắp xếp buổi làm việc trực tiếp.</p>
            <form class="grid grid-cols-1 sm:grid-cols-3 gap-3 max-w-2xl mx-auto text-left">
                <input type="text" placeholder="Họ và tên..." class="px-4 py-3 rounded-xl bg-slate-800 border border-slate-700 text-xs text-white focus:outline-none focus:border-amber-400">
                <input type="tel" placeholder="Số điện thoại..." class="px-4 py-3 rounded-xl bg-slate-800 border border-slate-700 text-xs text-white focus:outline-none focus:border-amber-400">
                <button type="button" onclick="alert('Đã gửi thông tin kết nối!')" class="px-6 py-3 rounded-xl bg-amber-400 hover:bg-amber-500 text-slate-950 font-bold text-xs uppercase tracking-wider transition-all">
                    Gửi Đề Xuất
                </button>
            </form>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-black text-slate-500 py-6 text-center text-xs border-t border-slate-900">
        <p>© 2026 {{ $template->title }}. Powered by Truyền Thông Cửu Long.</p>
    </footer>

</div>
