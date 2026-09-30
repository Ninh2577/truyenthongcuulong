<!-- ==================== ARCHITECTURE, CONSTRUCTION & INTERIOR (NORDICHOME / AN PHÁT) ==================== -->
<div class="w-full bg-[#f8fafc] text-slate-800 font-sans" x-data="{
    areaM2: 120,
    buildType: 'townhouse',
    packageTier: 6500000,
    calcCost() {
        return (this.areaM2 * this.packageTier).toLocaleString('vi-VN');
    }
}">

    <!-- Top strip -->
    <div class="bg-[#0f172a] text-slate-400 text-xs py-2 px-4 sm:px-8 flex items-center justify-between border-b border-slate-800">
        <div class="flex items-center gap-2">
            <span class="w-2 h-2 rounded-full bg-amber-400"></span>
            <span>NORDICHOME DESIGN & BUILD • MIỄN 100% PHÍ THIẾT KẾ KHI KÝ HỢP ĐỒNG THI CÔNG TRỌN GÓI</span>
        </div>
        <div class="flex items-center gap-4 text-[11px]">
            <span>Hotline KTS Trưởng: <strong class="text-white">0939.363.262</strong></span>
        </div>
    </div>

    <!-- Header Navigation -->
    <header class="bg-white border-b border-slate-200 sticky top-0 z-30 shadow-xs">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-slate-900 text-white flex items-center justify-center font-serif text-xl font-bold border-2 border-amber-400">
                    N
                </div>
                <div class="flex flex-col">
                    <span class="text-xl font-serif font-black tracking-tight text-slate-900">NordicHome</span>
                    <span class="text-[9px] font-bold text-amber-600 tracking-widest uppercase">KIẾN TRÚC & NỘI THẤT BẮC ÂU</span>
                </div>
            </div>

            <nav class="hidden lg:flex items-center gap-8 text-xs font-bold text-slate-700 uppercase tracking-wider">
                <a href="#hero" class="text-amber-600">Trang chủ</a>
                <a href="#projects" class="hover:text-amber-600 transition-colors">Công trình tiêu biểu</a>
                <a href="#estimator" class="hover:text-amber-600 transition-colors">Dự toán theo M²</a>
                <a href="#process" class="hover:text-amber-600 transition-colors">Quy trình thi công</a>
                <a href="#contact" class="hover:text-amber-600 transition-colors">Liên hệ KTS</a>
            </nav>

            <a href="#estimator" class="px-5 py-2.5 rounded-full bg-slate-900 hover:bg-black text-white font-bold text-xs uppercase tracking-wider shadow-sm transition-all">
                Dự Toán Chi Phí Xây Dựng
            </a>
        </div>
    </header>

    <!-- Hero Section -->
    <section id="hero" class="py-16 lg:py-24 bg-white border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                <div class="lg:col-span-6 space-y-6">
                    <span class="inline-block px-3 py-1 rounded-full bg-slate-100 text-slate-800 text-xs font-mono font-bold">
                        MINIMALIST & SCANDINAVIAN INTERIOR
                    </span>

                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-serif font-black text-slate-900 leading-tight">
                        Kiến Tạo Không Gian <br><span class="text-amber-600">Sống Sang Trọng & Tối Giản</span>
                    </h1>

                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed max-w-lg">
                        Biến ngôi nhà thành tổ ấm thư giãn hoàn hảo với vật liệu gỗ sồi tự nhiên, ánh sáng chan hòa và đường nét tinh tế chuẩn phong cách kiến trúc Bắc Âu.
                    </p>

                    <div class="flex flex-wrap items-center gap-4 pt-2">
                        <a href="#estimator" class="px-7 py-3 rounded-full bg-amber-500 hover:bg-amber-600 text-slate-950 font-bold text-xs uppercase tracking-wider shadow-md transition-all">
                            Tính Giá Dự Toán Xây Dựng
                        </a>
                        <a href="#projects" class="px-6 py-3 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-800 font-bold text-xs uppercase tracking-wider transition-all">
                            Xem Bộ Sưu Tập Dự Án
                        </a>
                    </div>
                </div>

                <div class="lg:col-span-6">
                    <img src="https://images.unsplash.com/photo-1618221195710-dd6b41faaea6?auto=format&fit=crop&w=1000&q=80" alt="Nordic Interior" class="w-full rounded-3xl shadow-2xl aspect-4/3 object-cover">
                </div>
            </div>
        </div>
    </section>

    <!-- Interactive Cost Estimator Section -->
    <section id="estimator" class="py-16 bg-slate-50 border-b border-slate-200">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <span class="text-xs font-mono font-bold text-amber-600 uppercase tracking-widest">COST CALCULATOR</span>
            <h2 class="text-2xl sm:text-3xl font-serif font-black text-slate-900 mt-1">Dự Toán Chi Phí Hoàn Thiện Nội Thất</h2>
            <p class="text-xs sm:text-sm text-slate-500 max-w-lg mx-auto mt-1 mb-8">Ước tính ngân sách hoàn thiện chìa khóa trao tay theo diện tích sàn.</p>

            <div class="bg-white p-8 rounded-3xl border border-slate-200 shadow-sm text-left grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                <div class="space-y-4">
                    <div>
                        <div class="flex justify-between text-xs font-bold text-slate-700 mb-1">
                            <span>Diện tích sàn thi công:</span>
                            <span class="text-amber-600 font-mono text-sm" x-text="areaM2 + ' m²'"></span>
                        </div>
                        <input type="range" min="40" max="400" step="5" x-model="areaM2" class="w-full accent-amber-500">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Gói tiêu chuẩn vật tư</label>
                        <select x-model="packageTier" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-xs font-semibold outline-none">
                            <option value="5000000">Gói Tiêu Chuẩn (5.000.000đ/m² - Gỗ An Cường)</option>
                            <option value="6500000" selected>Gói Nâng Cao (6.500.000đ/m² - Gỗ Sồi Tự Nhiên)</option>
                            <option value="9000000">Gói Luxury (9.000.000đ/m² - Đá Marble & Phụ Kiện Hafele)</option>
                        </select>
                    </div>
                </div>

                <div class="bg-slate-900 text-white p-6 rounded-2xl text-center space-y-3">
                    <span class="text-xs text-amber-400 uppercase font-bold tracking-wider">Tổng Chi Phí Dự Toán Ước Tính</span>
                    <div class="text-3xl font-black font-mono text-white" x-text="calcCost() + ' VNĐ'"></div>
                    <p class="text-[10px] text-slate-400">Bao gồm bản vẽ 3D, thi công nội thất, rèm cửa, hệ đèn và dọn dẹp vệ sinh công nghiệp.</p>
                    <button type="button" onclick="alert('Đã gửi yêu cầu tư vấn! KTS NordicHome sẽ liên hệ gửi bản vẽ mẫu.')" class="w-full py-3 rounded-xl bg-amber-500 hover:bg-amber-400 text-slate-950 font-bold text-xs uppercase tracking-wider transition-all">
                        Nhận Bảng Báo Giá Chi Tiết
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-black text-slate-500 py-6 text-center text-xs border-t border-slate-900">
        <p>© 2026 NordicHome Architecture & Interiors. Powered by Truyền Thông Cửu Long.</p>
    </footer>

</div>
