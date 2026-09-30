<!-- ==================== BROKERAGE & MLS PORTAL (METROLAND) ==================== -->
<div class="w-full bg-[#f1f5f9] text-slate-800 font-sans" x-data="{
    searchType: 'buy',
    priceFilter: 'all',
    district: 'all'
}">

    <!-- Top strip -->
    <div class="bg-[#1e293b] text-slate-300 text-xs py-2 px-4 sm:px-8 flex items-center justify-between border-b border-slate-700">
        <div class="flex items-center gap-2">
            <span class="w-2 h-2 rounded-full bg-blue-400"></span>
            <span>SÀN GIAO DỊCH NHÀ ĐẤT METROLAND • HƠN 3,500+ TIN ĐĂNG CHÍNH CHỦ ĐÃ KIỂM DUYỆT SỔ ĐỎ</span>
        </div>
        <div class="flex items-center gap-4 text-[11px]">
            <span>Tổng đài ký gửi: <strong class="text-white">0939 523 557</strong></span>
        </div>
    </div>

    <!-- Header Navigation -->
    <header class="bg-white border-b border-slate-200 sticky top-0 z-30 shadow-xs">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <div class="flex items-center gap-2.5">
                <div class="w-10 h-10 rounded-xl bg-blue-600 text-white flex items-center justify-center font-black text-xl shadow-md">
                    <span class="material-symbols-outlined text-[24px]">map</span>
                </div>
                <div class="flex flex-col">
                    <span class="text-xl font-black text-slate-900 tracking-tight">MetroLand</span>
                    <span class="text-[9px] font-bold text-blue-600 tracking-widest uppercase">MẠNG LƯỚI NHÀ ĐẤT ĐÔ THỊ</span>
                </div>
            </div>

            <nav class="hidden lg:flex items-center gap-7 text-xs font-bold text-slate-700 uppercase">
                <a href="#hero" class="text-blue-600">Trang chủ</a>
                <a href="#listings" class="hover:text-blue-600 transition-colors">Mua bán nhà đất</a>
                <a href="#listings" class="hover:text-blue-600 transition-colors">Cho thuê căn hộ</a>
                <a href="#deposit" class="hover:text-blue-600 transition-colors">Ký gửi nhà đất</a>
                <a href="#contact" class="hover:text-blue-600 transition-colors">Môi giới uy tín</a>
            </nav>

            <a href="#deposit" class="px-5 py-2.5 rounded-full bg-rose-600 hover:bg-rose-700 text-white font-bold text-xs uppercase tracking-wider shadow-sm transition-all flex items-center gap-1.5">
                <span class="material-symbols-outlined text-[16px]">upload_file</span>
                <span>Đăng Tin Ký Gửi</span>
            </a>
        </div>
    </header>

    <!-- Search Portal Hero -->
    <section id="hero" class="py-12 lg:py-16 bg-gradient-to-r from-blue-900 via-slate-900 to-blue-950 text-white px-4 sm:px-8">
        <div class="max-w-5xl mx-auto text-center space-y-6">
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black leading-tight">
                Tìm Kiếm Tổ Ấm & Cơ Hội Đầu Tư <br><span class="text-blue-400">Pháp Lý Rõ Ràng, Giá Trị Gia Tăng</span>
            </h1>

            <!-- Multi-field Search Filter Box -->
            <div class="bg-white rounded-3xl p-4 sm:p-6 text-slate-900 shadow-2xl text-left">
                <div class="flex items-center gap-4 border-b border-slate-200 pb-3 mb-4">
                    <button type="button" @click="searchType = 'buy'" :class="searchType === 'buy' ? 'text-blue-600 border-b-2 border-blue-600 font-black' : 'text-slate-500 font-bold'" class="pb-2 text-xs uppercase tracking-wider">Cần Mua Nhà Đất</button>
                    <button type="button" @click="searchType = 'rent'" :class="searchType === 'rent' ? 'text-blue-600 border-b-2 border-blue-600 font-black' : 'text-slate-500 font-bold'" class="pb-2 text-xs uppercase tracking-wider">Cần Thuê Căn Hộ/Mặt Bằng</button>
                    <button type="button" @click="searchType = 'project'" :class="searchType === 'project' ? 'text-blue-600 border-b-2 border-blue-600 font-black' : 'text-slate-500 font-bold'" class="pb-2 text-xs uppercase tracking-wider">Dự Án Đang Mở Bán</button>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3">
                    <div>
                        <label class="block text-[11px] font-bold text-slate-500 mb-1">Địa điểm / Quận huyện</label>
                        <select class="w-full px-3.5 py-2.5 rounded-xl bg-slate-50 border border-slate-300 text-xs text-slate-900 font-semibold outline-none">
                            <option>Tất cả khu vực</option>
                            <option>Ninh Kiều, Cần Thơ</option>
                            <option>Cái Răng, Cần Thơ</option>
                            <option>Bình Thủy, Cần Thơ</option>
                            <option>Quận 1, TP. Hồ Chí Minh</option>
                            <option>Thủ Đức, TP. Hồ Chí Minh</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-slate-500 mb-1">Loại hình BĐS</label>
                        <select class="w-full px-3.5 py-2.5 rounded-xl bg-slate-50 border border-slate-300 text-xs text-slate-900 font-semibold outline-none">
                            <option>Nhà phố liền kề</option>
                            <option>Đất nền thổ cư sổ đỏ</option>
                            <option>Căn hộ chung cư</option>
                            <option>Mặt bằng kinh doanh</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-slate-500 mb-1">Khoảng giá</label>
                        <select class="w-full px-3.5 py-2.5 rounded-xl bg-slate-50 border border-slate-300 text-xs text-slate-900 font-semibold outline-none">
                            <option>Dưới 2 Tỷ</option>
                            <option>2 - 4 Tỷ</option>
                            <option>4 - 8 Tỷ</option>
                            <option>Trên 8 Tỷ</option>
                        </select>
                    </div>
                    <div class="flex items-end">
                        <button type="button" onclick="alert('Đã lọc được 128 bất động sản phù hợp tiêu chí của bạn!')" class="w-full py-3 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-black text-xs uppercase tracking-wider shadow-md transition-all flex items-center justify-center gap-1.5">
                            <span class="material-symbols-outlined text-[18px]">search</span>
                            <span>Tìm Kiếm Tin Đăng</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Property Listings Grid -->
    <section id="listings" class="py-12 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-8 border-b border-slate-200 pb-3">
            <div>
                <h2 class="text-2xl font-black text-slate-900">Bất Động Sản Mới Ký Gửi</h2>
                <p class="text-xs text-slate-500">Cập nhật lúc 09:00 sáng nay</p>
            </div>
            <span class="text-xs font-bold text-blue-600">Hiển thị 3 / 3,500 tin</span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Item 1 -->
            <div class="bg-white rounded-3xl overflow-hidden border border-slate-200 shadow-xs hover:shadow-lg transition-all group">
                <div class="relative aspect-video overflow-hidden bg-slate-900">
                    <img src="https://images.unsplash.com/photo-1560518883-ce09059eeffa?auto=format&fit=crop&w=700&q=80" alt="Nhà phố" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <span class="absolute top-3 left-3 bg-blue-600 text-white text-[10px] font-bold px-2.5 py-1 rounded-md">SỔ HỒNG RIÊNG</span>
                    <span class="absolute top-3 right-3 bg-black/70 backdrop-blur-md text-amber-400 font-mono font-bold text-xs px-3 py-1 rounded-full">3.85 TỶ</span>
                </div>
                <div class="p-5">
                    <span class="text-[10px] font-bold text-slate-400 font-mono uppercase">MÃ TIN: MT-8291 • PHƯỜNG AN KHÁNH</span>
                    <h3 class="text-sm font-bold text-slate-900 line-clamp-2 mt-1 mb-3 group-hover:text-blue-600">
                        Bán Nhà 1 Trệt 2 Lầu Mặt Tiền Đường Số 4, KDC Thới Nhựt 2
                    </h3>
                    <div class="flex items-center justify-between text-xs text-slate-500 border-t border-slate-100 pt-3">
                        <span>📐 90 m² (4.5 x 20)</span>
                        <span>🛏 4 Phòng ngủ</span>
                        <span>🚗 Ô tô đậu cửa</span>
                    </div>
                </div>
            </div>

            <!-- Item 2 -->
            <div class="bg-white rounded-3xl overflow-hidden border border-slate-200 shadow-xs hover:shadow-lg transition-all group">
                <div class="relative aspect-video overflow-hidden bg-slate-900">
                    <img src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?auto=format&fit=crop&w=700&q=80" alt="Đất nền" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <span class="absolute top-3 left-3 bg-emerald-600 text-white text-[10px] font-bold px-2.5 py-1 rounded-md">THỔ CƯ 100%</span>
                    <span class="absolute top-3 right-3 bg-black/70 backdrop-blur-md text-amber-400 font-mono font-bold text-xs px-3 py-1 rounded-full">2.1 TỶ</span>
                </div>
                <div class="p-5">
                    <span class="text-[10px] font-bold text-slate-400 font-mono uppercase">MÃ TIN: MT-7410 • KDC NAM LONG</span>
                    <h3 class="text-sm font-bold text-slate-900 line-clamp-2 mt-1 mb-3 group-hover:text-blue-600">
                        Đất Nền Biệt Thự Góc 2 Mặt Tiền Sông Thoáng Mát
                    </h3>
                    <div class="flex items-center justify-between text-xs text-slate-500 border-t border-slate-100 pt-3">
                        <span>📐 140 m² (7 x 20)</span>
                        <span>🧭 Hướng Đông Nam</span>
                        <span>🛣 Lộ giới 19m</span>
                    </div>
                </div>
            </div>

            <!-- Item 3 -->
            <div class="bg-white rounded-3xl overflow-hidden border border-slate-200 shadow-xs hover:shadow-lg transition-all group">
                <div class="relative aspect-video overflow-hidden bg-slate-900">
                    <img src="https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?auto=format&fit=crop&w=700&q=80" alt="Căn hộ" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <span class="absolute top-3 left-3 bg-purple-600 text-white text-[10px] font-bold px-2.5 py-1 rounded-md">CHO THUÊ</span>
                    <span class="absolute top-3 right-3 bg-black/70 backdrop-blur-md text-amber-400 font-mono font-bold text-xs px-3 py-1 rounded-full">12 TR/THÁNG</span>
                </div>
                <div class="p-5">
                    <span class="text-[10px] font-bold text-slate-400 font-mono uppercase">MÃ TIN: MT-9102 • CHUNG CƯ CADIF</span>
                    <h3 class="text-sm font-bold text-slate-900 line-clamp-2 mt-1 mb-3 group-hover:text-blue-600">
                        Căn Hộ Đầy Đủ Nội Thất Cao Cấp 2PN Hướng Công Viên
                    </h3>
                    <div class="flex items-center justify-between text-xs text-slate-500 border-t border-slate-100 pt-3">
                        <span>📐 68 m²</span>
                        <span>🛏 2 Phòng ngủ</span>
                        <span>🛋 Full nội thất</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Consignment Section (Ký Gửi) -->
    <section id="deposit" class="py-12 bg-white border-t border-slate-200">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 text-center space-y-4">
            <span class="text-xs font-bold text-blue-600 uppercase tracking-widest font-mono">ONLINE BROKERAGE</span>
            <h2 class="text-2xl font-black text-slate-900">Ký Gửi Bất Động Sản Bán Hoặc Cho Thuê</h2>
            <p class="text-xs text-slate-500">Tiếp cận hơn 50,000 khách mua tiềm năng tại Cần Thơ & ĐBSCL. Không mất phí đăng tin.</p>
            <button type="button" onclick="alert('Đã mở form ký gửi nhà đất!')" class="px-8 py-3 rounded-full bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs uppercase tracking-wider shadow-md transition-all">
                Gửi Thông Tin Bất Động Sản Của Bạn
            </button>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-black text-slate-500 py-6 text-center text-xs border-t border-slate-900">
        <p>© 2026 MetroLand Brokerage & MLS Network. Powered by Truyền Thông Cửu Long.</p>
    </footer>

</div>
