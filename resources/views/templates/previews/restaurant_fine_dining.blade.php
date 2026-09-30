<!-- ==================== RESTAURANT & FINE DINING (SAKURA SUSHI / PRIME STEAK) ==================== -->
<div class="w-full bg-[#0d090a] text-slate-100 font-serif selection:bg-rose-600 selection:text-white" x-data="{
    tableParty: '2',
    tableDate: '2026-10-02',
    tableTime: '19:00',
    reserveSuccess: false
}">

    <!-- Top strip -->
    <div class="bg-[#1a0f12] text-rose-300 text-xs py-2 px-4 sm:px-8 flex items-center justify-between border-b border-rose-950/60 font-sans">
        <div class="flex items-center gap-2">
            <span>🍣</span>
            <span>SAKURA OMAKASE & FINE DINING • NGUYÊN LIỆU NHẬP KHẨU TRỰC TIẾP TỪ CHỢ TOYOSU TOKYO</span>
        </div>
        <div class="flex items-center gap-6 text-[11px] text-slate-400">
            <span>Hotline đặt bàn riêng: <strong class="text-rose-400">0939.363.262</strong></span>
        </div>
    </div>

    <!-- Header Navigation -->
    <header class="bg-[#0d090a]/90 backdrop-blur-md border-b border-rose-950 sticky top-0 z-30 font-sans">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full border border-rose-500/60 flex items-center justify-center text-rose-400 font-serif text-xl font-bold">
                    桜
                </div>
                <div class="flex flex-col">
                    <span class="text-xl font-serif font-black tracking-widest text-rose-100 uppercase">Sakura</span>
                    <span class="text-[9px] font-bold text-rose-500 tracking-[0.2em] uppercase">JAPANESE CUISINE & OMAKASE</span>
                </div>
            </div>

            <nav class="hidden lg:flex items-center gap-8 text-xs font-bold text-slate-300 uppercase tracking-widest">
                <a href="#hero" class="text-rose-400">Trang chủ</a>
                <a href="#menu" class="hover:text-rose-400 transition-colors">Thực đơn Omakase</a>
                <a href="#rooms" class="hover:text-rose-400 transition-colors">Không gian phòng VIP</a>
                <a href="#chef" class="hover:text-rose-400 transition-colors">Bếp trưởng</a>
                <a href="#reservation" class="hover:text-rose-400 transition-colors">Đặt bàn</a>
            </nav>

            <a href="#reservation" class="px-6 py-2.5 rounded-full border border-rose-500/60 bg-rose-600/20 hover:bg-rose-600 text-rose-200 hover:text-white font-bold text-xs uppercase tracking-wider transition-all">
                Đặt Bàn Ngay
            </a>
        </div>
    </header>

    <!-- Hero Banner -->
    <section id="hero" class="relative py-20 lg:py-28 px-4 sm:px-8 text-center overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1579871494447-9811cf80d66c?auto=format&fit=crop&w=1800&q=80" alt="Sushi Feast" class="w-full h-full object-cover opacity-25">
            <div class="absolute inset-0 bg-gradient-to-t from-[#0d090a] via-[#0d090a]/70 to-transparent"></div>
        </div>

        <div class="relative z-10 max-w-4xl mx-auto space-y-6">
            <span class="inline-block text-xs font-sans font-bold text-rose-400 uppercase tracking-[0.3em]">
                TRẢI NGHIỆM ẨM THỰC THƯỢNG HẠNG
            </span>
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black text-rose-50 leading-tight">
                Nghệ Thuật Omakase <br><span class="text-transparent bg-clip-text bg-gradient-to-r from-rose-300 via-rose-400 to-amber-200">Tinh Hoa Ẩm Thực Xứ Phù Tang</span>
            </h1>
            <p class="text-sm sm:text-base font-sans text-slate-300 max-w-xl mx-auto leading-relaxed">
                Thưởng thức từng miếng sushi hảo hạng được chế tác ngay trước mặt bạn bởi Bếp Trưởng người Nhật với hơn 25 năm kinh nghiệm.
            </p>

            <div class="flex flex-wrap items-center justify-center gap-4 pt-4 font-sans">
                <a href="#reservation" class="px-8 py-3.5 rounded-full bg-rose-600 hover:bg-rose-500 text-white font-bold text-xs uppercase tracking-widest shadow-xl shadow-rose-600/20 transition-all">
                    Đặt Bàn Trước (Chỉ 16 Chỗ/Tối)
                </a>
                <a href="#menu" class="px-7 py-3.5 rounded-full border border-slate-700 bg-white/5 hover:bg-white/10 text-slate-300 font-bold text-xs uppercase tracking-widest transition-all">
                    Xem Menu Omakase
                </a>
            </div>
        </div>
    </section>

    <!-- Signature Menu -->
    <section id="menu" class="py-16 bg-[#120d0f] border-t border-rose-950/60 font-sans">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-xl mx-auto mb-12">
                <span class="text-xs font-bold text-rose-400 uppercase tracking-widest font-mono">SIGNATURE DISHES</span>
                <h2 class="text-3xl font-serif font-black text-white mt-1">Món Ăn Tiêu Biểu</h2>
            </div>

            <div class="space-y-6">
                <div class="flex items-center justify-between border-b border-rose-950/80 pb-4">
                    <div>
                        <h3 class="text-base font-bold text-rose-100">Otoro Sashimi Caviar Gold</h3>
                        <p class="text-xs text-slate-400 mt-0.5">Bụng cá ngừ vây xanh Nhật Bản, trứng cá tầm đen và vàng lá 24K.</p>
                    </div>
                    <span class="text-lg font-mono font-bold text-rose-400">850.000đ</span>
                </div>
                <div class="flex items-center justify-between border-b border-rose-950/80 pb-4">
                    <div>
                        <h3 class="text-base font-bold text-rose-100">A5 Miyazaki Wagyu Ishiyaki</h3>
                        <p class="text-xs text-slate-400 mt-0.5">Bò Wagyu A5 tỉnh Miyazaki nướng trên phiến đá nham thạch núi Phú Sĩ.</p>
                    </div>
                    <span class="text-lg font-mono font-bold text-rose-400">1.450.000đ</span>
                </div>
                <div class="flex items-center justify-between border-b border-rose-950/80 pb-4">
                    <div>
                        <h3 class="text-base font-bold text-rose-100">Uni Hokkaido Nigiri</h3>
                        <p class="text-xs text-slate-400 mt-0.5">Nhum biển tươi sống vùng biển lạnh Hokkaido béo ngậy tan chảy.</p>
                    </div>
                    <span class="text-lg font-mono font-bold text-rose-400">420.000đ</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Table Reservation Form -->
    <section id="reservation" class="py-16 bg-[#0d090a] border-t border-rose-950/60 font-sans">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 text-center space-y-6">
            <span class="text-xs font-bold text-rose-400 uppercase tracking-widest font-mono">TABLE RESERVATION</span>
            <h2 class="text-3xl font-serif font-black text-white">Đặt Chỗ Trải Nghiệm Omakase</h2>
            <p class="text-xs sm:text-sm text-slate-400">
                Quý khách vui lòng đặt bàn trước ít nhất 4 tiếng để nhà hàng chuẩn bị nguyên liệu tươi ngon nhất trong ngày.
            </p>

            <form class="bg-[#140e10] p-8 rounded-3xl border border-rose-950 text-left space-y-4">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs text-slate-300 font-bold mb-1">Họ tên quý khách *</label>
                        <input type="text" placeholder="Nguyễn Văn A" class="w-full px-4 py-2.5 rounded-xl bg-[#0d090a] border border-rose-950 text-xs text-white focus:border-rose-400 outline-none">
                    </div>
                    <div>
                        <label class="block text-xs text-slate-300 font-bold mb-1">Số điện thoại *</label>
                        <input type="tel" placeholder="0939.363.262" class="w-full px-4 py-2.5 rounded-xl bg-[#0d090a] border border-rose-950 text-xs text-white focus:border-rose-400 outline-none">
                    </div>
                </div>
                <div class="grid grid-cols-3 gap-3">
                    <div>
                        <label class="block text-xs text-slate-300 font-bold mb-1">Số khách</label>
                        <select class="w-full px-3 py-2.5 rounded-xl bg-[#0d090a] border border-rose-950 text-xs text-white focus:border-rose-400 outline-none">
                            <option>2 Khách</option>
                            <option>4 Khách</option>
                            <option>Phòng VIP riêng (6-12 Khách)</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs text-slate-300 font-bold mb-1">Ngày dùng</label>
                        <input type="date" value="2026-10-02" class="w-full px-3 py-2.5 rounded-xl bg-[#0d090a] border border-rose-950 text-xs text-white focus:border-rose-400 outline-none">
                    </div>
                    <div>
                        <label class="block text-xs text-slate-300 font-bold mb-1">Giờ dùng</label>
                        <select class="w-full px-3 py-2.5 rounded-xl bg-[#0d090a] border border-rose-950 text-xs text-white focus:border-rose-400 outline-none">
                            <option>18:00 (Suất 1)</option>
                            <option selected>19:30 (Suất 2)</option>
                            <option>21:00 (Suất 3)</option>
                        </select>
                    </div>
                </div>
                <button type="button" onclick="alert('Đã tiếp nhận đặt bàn! Quản lý Sakura sẽ gọi xác nhận với quý khách.')" class="w-full py-3.5 rounded-xl bg-rose-600 hover:bg-rose-500 text-white font-bold text-xs uppercase tracking-widest transition-all">
                    Xác Nhận Giữ Chỗ
                </button>
            </form>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-black text-slate-500 py-6 text-center text-xs border-t border-rose-950 font-sans">
        <p>© 2026 Sakura Omakase Japanese Cuisine. Developed with Truyền Thông Cửu Long.</p>
    </footer>

</div>
