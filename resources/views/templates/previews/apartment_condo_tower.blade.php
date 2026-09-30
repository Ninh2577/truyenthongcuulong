<!-- ==================== APARTMENT & CONDO TOWER (GREENSKY TOWER) ==================== -->
<div class="w-full bg-slate-50 text-slate-800 font-sans" x-data="{
    activeTowerTab: '2pn',
    apartmentPrice: 3200000000,
    downPaymentPct: 30,
    loanYears: 20,
    monthlyPay: 0,
    calcMortgage() {
        const loanAmount = this.apartmentPrice * (1 - this.downPaymentPct / 100);
        const monthlyRate = 0.08 / 12; // 8% per year
        const totalMonths = this.loanYears * 12;
        this.monthlyPay = Math.round((loanAmount * monthlyRate * Math.pow(1 + monthlyRate, totalMonths)) / (Math.pow(1 + monthlyRate, totalMonths) - 1));
    }
}" x-init="calcMortgage()">

    <!-- Top Announcement Strip -->
    <div class="bg-emerald-950 text-emerald-200 text-xs py-2 px-4 sm:px-8 flex items-center justify-between border-b border-emerald-900">
        <div class="flex items-center gap-2">
            <span class="px-2 py-0.5 rounded bg-emerald-500 text-white font-bold text-[10px]">CHÍNH SÁCH MỚI NHẤT</span>
            <span class="text-xs">Thanh toán 1%/tháng đến khi nhận nhà • Ân hạn nợ gốc & Lãi suất 0% trong 24 tháng</span>
        </div>
        <div class="flex items-center gap-4 text-[11px] text-emerald-300">
            <span>Phòng kinh doanh CĐT: <strong class="text-white">0939.363.262</strong></span>
        </div>
    </div>

    <!-- Header Navigation -->
    <header class="bg-white border-b border-slate-200 sticky top-0 z-30 shadow-xs">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-emerald-600 text-white flex items-center justify-center font-black text-xl shadow-md">
                    <span class="material-symbols-outlined text-[24px]">corporate_fare</span>
                </div>
                <div class="flex flex-col">
                    <span class="text-lg font-black tracking-tight text-slate-900 uppercase">GreenSky Tower</span>
                    <span class="text-[9px] font-bold text-emerald-600 tracking-wider uppercase">Căn Hộ Xanh Chuẩn EDGE Quốc Tế</span>
                </div>
            </div>

            <nav class="hidden lg:flex items-center gap-8 text-xs font-bold text-slate-700 uppercase">
                <a href="#hero" class="text-emerald-600">Tổng quan</a>
                <a href="#plans" class="hover:text-emerald-600 transition-colors">Mặt bằng căn hộ</a>
                <a href="#calculator" class="hover:text-emerald-600 transition-colors">Bảng tính vay mua nhà</a>
                <a href="#amenities" class="hover:text-emerald-600 transition-colors">35+ Tiện ích</a>
                <a href="#booking" class="hover:text-emerald-600 transition-colors">Đăng ký xem nhà mẫu</a>
            </nav>

            <a href="#booking" class="px-5 py-2.5 rounded-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow-md shadow-emerald-600/20 transition-all">
                Tải Bảng Giá & Giỏ Hàng CĐT
            </a>
        </div>
    </header>

    <!-- Hero Section -->
    <section id="hero" class="relative bg-gradient-to-r from-emerald-950 via-slate-900 to-emerald-950 text-white py-16 lg:py-24 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
                <div class="lg:col-span-7 space-y-6">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-emerald-500/20 border border-emerald-500/40 text-emerald-300 text-xs font-bold">
                        <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                        <span>ĐÃ CẤT NÓC • DỰ KIẾN BÀN GIAO QUÝ IV/2026</span>
                    </div>

                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black text-white leading-tight">
                        Căn Hộ Sinh Thái Xanh <br><span class="text-emerald-400">Giữa Lòng Trung Tâm Đô Thị</span>
                    </h1>

                    <p class="text-xs sm:text-sm text-slate-300 leading-relaxed max-w-xl">
                        Tổ hợp căn hộ cao cấp 38 tầng với công viên trên không Sky Park tầng 20, hồ bơi vô cực nước ấm và hệ thống lọc không khí ion âm độc quyền cho từng căn hộ.
                    </p>

                    <div class="flex flex-wrap items-center gap-4 pt-2">
                        <a href="#calculator" class="px-7 py-3 rounded-full bg-emerald-500 hover:bg-emerald-600 text-white font-extrabold text-xs uppercase tracking-wider shadow-lg transition-all">
                            Tính Lãi Suất Vay Trả Góp
                        </a>
                        <a href="#plans" class="px-6 py-3 rounded-full bg-white/10 hover:bg-white/20 text-white border border-white/20 font-bold text-xs uppercase tracking-wider transition-all">
                            Xem Mặt Bằng Căn Hộ
                        </a>
                    </div>

                    <!-- Highlight Badges -->
                    <div class="pt-6 border-t border-emerald-800/80 grid grid-cols-3 gap-3">
                        <div class="bg-emerald-900/40 p-3 rounded-xl border border-emerald-700/30">
                            <span class="block text-xl font-black text-emerald-400 font-mono">1.8 Tỷ/Căn</span>
                            <span class="text-[10px] text-slate-300">Giá khởi điểm từ CĐT</span>
                        </div>
                        <div class="bg-emerald-900/40 p-3 rounded-xl border border-emerald-700/30">
                            <span class="block text-xl font-black text-white font-mono">70%</span>
                            <span class="text-[10px] text-slate-300">Ngân hàng bảo lãnh vay</span>
                        </div>
                        <div class="bg-emerald-900/40 p-3 rounded-xl border border-emerald-700/30">
                            <span class="block text-xl font-black text-amber-400 font-mono">Sổ Đỏ</span>
                            <span class="text-[10px] text-slate-300">Pháp lý minh bạch 100%</span>
                        </div>
                    </div>
                </div>

                <!-- 3D Tower Visual -->
                <div class="lg:col-span-5 relative">
                    <div class="rounded-3xl overflow-hidden shadow-2xl border-4 border-emerald-500/20 bg-slate-900">
                        <img src="https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?auto=format&fit=crop&w=800&q=80" alt="GreenSky Tower 3D" class="w-full aspect-[3/4] object-cover">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Interactive Mortgage Calculator -->
    <section id="calculator" class="py-16 bg-white border-b border-slate-200">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-xl mx-auto mb-10">
                <span class="text-xs font-bold text-emerald-600 uppercase tracking-widest font-mono">FINANCIAL ASSISTANT</span>
                <h2 class="text-2xl sm:text-3xl font-black text-slate-900 mt-1">Bảng Tính Tiền Trả Góp Mua Nhà</h2>
                <p class="text-xs sm:text-sm text-slate-500 mt-1">Dự toán số tiền thanh toán hàng tháng với gói vay ưu đãi lãi suất từ ngân hàng đối tác.</p>
            </div>

            <div class="bg-slate-50 p-6 sm:p-10 rounded-3xl border border-slate-200 grid grid-cols-1 md:grid-cols-12 gap-8 items-center">
                <!-- Controls Left -->
                <div class="md:col-span-7 space-y-6">
                    <div>
                        <div class="flex justify-between text-xs font-bold text-slate-700 mb-2">
                            <span>Giá trị căn hộ:</span>
                            <span class="text-emerald-700 font-mono text-sm" x-text="(apartmentPrice / 1000000000).toFixed(1) + ' Tỷ VNĐ'"></span>
                        </div>
                        <input type="range" min="1800000000" max="6000000000" step="100000000" x-model="apartmentPrice" @input="calcMortgage()" class="w-full accent-emerald-600">
                    </div>

                    <div>
                        <div class="flex justify-between text-xs font-bold text-slate-700 mb-2">
                            <span>Tỷ lệ vốn tự có (Trả trước):</span>
                            <span class="text-emerald-700 font-mono text-sm" x-text="downPaymentPct + '% (' + ((apartmentPrice * downPaymentPct / 100) / 1000000).toLocaleString() + ' VNĐ)'"></span>
                        </div>
                        <input type="range" min="20" max="70" step="5" x-model="downPaymentPct" @input="calcMortgage()" class="w-full accent-emerald-600">
                    </div>

                    <div>
                        <div class="flex justify-between text-xs font-bold text-slate-700 mb-2">
                            <span>Thời hạn vay vốn:</span>
                            <span class="text-emerald-700 font-mono text-sm" x-text="loanYears + ' Năm'"></span>
                        </div>
                        <input type="range" min="5" max="30" step="5" x-model="loanYears" @input="calcMortgage()" class="w-full accent-emerald-600">
                    </div>
                </div>

                <!-- Result Card Right -->
                <div class="md:col-span-5 bg-emerald-900 text-white p-6 rounded-2xl text-center space-y-4 shadow-xl">
                    <span class="text-xs uppercase tracking-wider text-emerald-300 font-bold">Số tiền trả hàng tháng (Ước tính)</span>
                    <div class="text-3xl sm:text-4xl font-black font-mono text-white" x-text="(monthlyPay / 1000000).toFixed(1) + ' Tr/Tháng'"></div>
                    <p class="text-[11px] text-emerald-200">Bao gồm gốc và lãi suất tính theo dư nợ giảm dần tại ngân hàng đối tác.</p>
                    <a href="#booking" class="block w-full py-3 rounded-xl bg-emerald-500 hover:bg-emerald-400 text-white font-bold text-xs transition-all uppercase tracking-wider">
                        Đăng Ký Tư Vấn Gói Vay 0% Lãi
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Booking Form -->
    <section id="booking" class="py-16 bg-slate-900 text-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 text-center space-y-6">
            <span class="text-xs font-bold text-emerald-400 uppercase tracking-widest font-mono">REGISTRATION</span>
            <h2 class="text-2xl sm:text-3xl font-black">Đăng Ký Xem Nhà Mẫu Thực Tế Cuối Tuần</h2>
            <p class="text-xs sm:text-sm text-slate-400">Xe đưa đón tận nơi miễn phí. Tặng ngay voucher chiết khấu 2% khi đặt cọc trong ngày mở bán.</p>

            <form class="grid grid-cols-1 sm:grid-cols-3 gap-3 max-w-2xl mx-auto pt-2">
                <input type="text" placeholder="Họ và tên..." class="px-4 py-3 rounded-xl bg-slate-800 border border-slate-700 text-xs text-white focus:outline-none focus:border-emerald-400">
                <input type="tel" placeholder="Số điện thoại..." class="px-4 py-3 rounded-xl bg-slate-800 border border-slate-700 text-xs text-white focus:outline-none focus:border-emerald-400">
                <button type="button" onclick="alert('Đã đăng ký tham quan nhà mẫu! Phòng kinh doanh GreenSky sẽ gửi thư mời qua tin nhắn.')" class="px-6 py-3 rounded-xl bg-emerald-500 hover:bg-emerald-600 text-white font-bold text-xs uppercase tracking-wider transition-all">
                    Giữ Chỗ Cuối Tuần
                </button>
            </form>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-black text-slate-500 py-6 text-center text-xs border-t border-slate-900">
        <p>© 2026 GreenSky Tower Apartments. Developed by Truyền Thông Cửu Long.</p>
    </footer>

</div>
