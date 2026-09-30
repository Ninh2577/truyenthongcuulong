<!-- ==================== LUXURY RESORT & HOTEL (PEARL ISLAND RESORT) ==================== -->
<div class="w-full bg-[#f8fafc] text-slate-800 font-sans" x-data="{
    checkIn: '2026-10-15',
    checkOut: '2026-10-18',
    guests: '2',
    roomType: 'villa'
}">

    <!-- Top strip -->
    <div class="bg-[#0e7490] text-cyan-100 text-xs py-2 px-4 sm:px-8 flex items-center justify-between font-sans">
        <div class="flex items-center gap-2">
            <span>🏝</span>
            <span>PEARL ISLAND RESORT & SPA • KHU NGHỈ DƯỠNG SINH THÁI 5 SAO BÃI TRƯỜNG PHÚ QUỐC</span>
        </div>
        <div class="flex items-center gap-6 text-[11px]">
            <span>Hotline Đặt Phòng VIP: <strong class="text-white">0939.363.262</strong></span>
        </div>
    </div>

    <!-- Header Navigation -->
    <header class="bg-white border-b border-cyan-100 sticky top-0 z-30 shadow-xs font-serif">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-cyan-700 text-amber-300 flex items-center justify-center font-bold text-xl shadow-md">
                    P
                </div>
                <div class="flex flex-col">
                    <span class="text-xl font-bold tracking-widest text-slate-900 uppercase">Pearl Island</span>
                    <span class="text-[9px] font-sans font-bold text-cyan-700 tracking-widest uppercase">LUXURY RESORT & SPA</span>
                </div>
            </div>

            <nav class="hidden lg:flex items-center gap-8 text-xs font-sans font-bold text-slate-700 uppercase tracking-widest">
                <a href="#hero" class="text-cyan-700">Trang chủ</a>
                <a href="#villas" class="hover:text-cyan-700 transition-colors">Biệt thự & Phòng nghỉ</a>
                <a href="#dining" class="hover:text-cyan-700 transition-colors">Ẩm thực ven biển</a>
                <a href="#spa" class="hover:text-cyan-700 transition-colors">Lotus Spa</a>
                <a href="#booking" class="hover:text-cyan-700 transition-colors">Liên hệ đặt phòng</a>
            </nav>

            <a href="#booking-box" class="px-5 py-2.5 rounded-full bg-cyan-700 hover:bg-cyan-800 text-white font-sans font-bold text-xs uppercase tracking-wider shadow-sm transition-all">
                Kiểm Tra Phòng Trống
            </a>
        </div>
    </header>

    <!-- Hero Banner with Room Booking Bar -->
    <section id="hero" class="relative py-20 lg:py-28 px-4 sm:px-8 text-white overflow-hidden bg-slate-900">
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1540541338287-41700207dee6?auto=format&fit=crop&w=1800&q=80" alt="Resort Villa" class="w-full h-full object-cover opacity-45">
            <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/40 to-transparent"></div>
        </div>

        <div class="relative z-10 max-w-4xl mx-auto text-center space-y-6">
            <span class="inline-block text-xs font-sans font-bold text-cyan-300 uppercase tracking-[0.25em]">
                KHÔNG GIAN NGHỈ DƯỠNG BIỂN THIÊN ĐƯỜNG
            </span>
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-serif font-bold text-white leading-tight">
                Chốn Bình Yên <br><span class="text-amber-300">Giữa Thiên Nhiên Đảo Ngọc</span>
            </h1>
            <p class="text-xs sm:text-sm font-sans text-slate-200 max-w-lg mx-auto leading-relaxed">
                Thức giấc giữa tiếng sóng biển rì rào, tận hưởng bữa sáng nổi trên hồ bơi riêng và ngắm hoàng hôn rực rỡ nhất Việt Nam.
            </p>
        </div>

        <!-- Room Booking Floating Widget -->
        <div id="booking-box" class="relative z-10 max-w-5xl mx-auto mt-12 bg-white text-slate-900 p-6 rounded-3xl shadow-2xl font-sans">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-500 mb-1">Ngày nhận phòng</label>
                    <input type="date" value="2026-10-15" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-xs font-semibold outline-none">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-500 mb-1">Ngày trả phòng</label>
                    <input type="date" value="2026-10-18" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-xs font-semibold outline-none">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-500 mb-1">Số khách</label>
                    <select class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-xs font-semibold outline-none">
                        <option>2 Người lớn, 1 Trẻ em</option>
                        <option>2 Người lớn (Cặp đôi)</option>
                        <option>Biệt thự gia đình (4 - 6 Khách)</option>
                    </select>
                </div>
                <div class="flex items-end">
                    <button type="button" onclick="alert('Đã tìm thấy 6 hạng Villa biển còn trống cho kỳ nghỉ của bạn!')" class="w-full py-3 rounded-xl bg-cyan-700 hover:bg-cyan-800 text-white font-bold text-xs uppercase tracking-wider transition-all">
                        Xem Phòng Còn Trống
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Villas Showcase Grid -->
    <section id="villas" class="py-16 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 font-sans">
        <div class="text-center max-w-xl mx-auto mb-12">
            <span class="text-xs font-bold text-cyan-700 uppercase tracking-widest font-mono">ACCOMMODATION</span>
            <h2 class="text-2xl sm:text-3xl font-serif font-black text-slate-900 mt-1">Các Hạng Biệt Thự Biển</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Villa 1 -->
            <div class="bg-white rounded-3xl overflow-hidden border border-slate-200 shadow-xs hover:shadow-lg transition-all flex flex-col group">
                <div class="relative aspect-video overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?auto=format&fit=crop&w=700&q=80" alt="Ocean Villa" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <span class="absolute top-3 right-3 bg-cyan-700 text-white text-xs font-mono font-bold px-3 py-1 rounded-full">4.200.000đ/Đêm</span>
                </div>
                <div class="p-6 flex flex-col flex-1 justify-between">
                    <div>
                        <h3 class="text-base font-serif font-bold text-slate-900 group-hover:text-cyan-700">Sunset Ocean View Villa</h3>
                        <p class="text-xs text-slate-500 mt-1">Hồ bơi vô cực riêng hướng biển, bồn tắm lộ thiên và bữa sáng nổi tại phòng.</p>
                        <div class="flex items-center gap-3 text-xs text-slate-400 mt-3 pt-3 border-t border-slate-100">
                            <span>📐 120 m²</span>
                            <span>👥 2 Khách</span>
                            <span>🏊 Hồ bơi riêng</span>
                        </div>
                    </div>
                    <button type="button" onclick="alert('Đã chọn Sunset Ocean View Villa!')" class="mt-4 w-full py-2.5 rounded-xl border border-cyan-700 text-cyan-700 hover:bg-cyan-700 hover:text-white font-bold text-xs transition-all">
                        Đặt Biệt Thự Này
                    </button>
                </div>
            </div>

            <!-- Villa 2 -->
            <div class="bg-white rounded-3xl overflow-hidden border border-slate-200 shadow-xs hover:shadow-lg transition-all flex flex-col group">
                <div class="relative aspect-video overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1540541338287-41700207dee6?auto=format&fit=crop&w=700&q=80" alt="Beachfront Villa" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <span class="absolute top-3 right-3 bg-cyan-700 text-white text-xs font-mono font-bold px-3 py-1 rounded-full">6.500.000đ/Đêm</span>
                </div>
                <div class="p-6 flex flex-col flex-1 justify-between">
                    <div>
                        <h3 class="text-base font-serif font-bold text-slate-900 group-hover:text-cyan-700">Beachfront Family Pool Villa</h3>
                        <p class="text-xs text-slate-500 mt-1">Bước chân trực tiếp ra bãi cát trắng mịn, 2 phòng ngủ lớn và phòng khách thoáng đãng.</p>
                        <div class="flex items-center gap-3 text-xs text-slate-400 mt-3 pt-3 border-t border-slate-100">
                            <span>📐 240 m²</span>
                            <span>👥 4-6 Khách</span>
                            <span>🏖 Sát bờ biển</span>
                        </div>
                    </div>
                    <button type="button" onclick="alert('Đã chọn Beachfront Family Pool Villa!')" class="mt-4 w-full py-2.5 rounded-xl border border-cyan-700 text-cyan-700 hover:bg-cyan-700 hover:text-white font-bold text-xs transition-all">
                        Đặt Biệt Thự Này
                    </button>
                </div>
            </div>

            <!-- Villa 3 -->
            <div class="bg-white rounded-3xl overflow-hidden border border-slate-200 shadow-xs hover:shadow-lg transition-all flex flex-col group">
                <div class="relative aspect-video overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1571896349842-33c89424de2d?auto=format&fit=crop&w=700&q=80" alt="Presidential Villa" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <span class="absolute top-3 right-3 bg-amber-500 text-slate-950 text-xs font-mono font-bold px-3 py-1 rounded-full">15.000.000đ/Đêm</span>
                </div>
                <div class="p-6 flex flex-col flex-1 justify-between">
                    <div>
                        <h3 class="text-base font-serif font-bold text-slate-900 group-hover:text-cyan-700">Presidential Island Residence</h3>
                        <p class="text-xs text-slate-500 mt-1">Dinh thự nguyên thủ độc bản mũi bán đảo, quản gia riêng 24/7 và đầu bếp phục vụ tại gia.</p>
                        <div class="flex items-center gap-3 text-xs text-slate-400 mt-3 pt-3 border-t border-slate-100">
                            <span>📐 480 m²</span>
                            <span>👥 Tối đa 10 Khách</span>
                            <span>👑 Quản gia riêng</span>
                        </div>
                    </div>
                    <button type="button" onclick="alert('Đã chọn Presidential Island Residence!')" class="mt-4 w-full py-2.5 rounded-xl border border-cyan-700 text-cyan-700 hover:bg-cyan-700 hover:text-white font-bold text-xs transition-all">
                        Đặt Biệt Thự Này
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-black text-slate-500 py-6 text-center text-xs border-t border-slate-900 font-sans">
        <p>© 2026 Pearl Island Resort & Spa Phu Quoc. Developed with Truyền Thông Cửu Long.</p>
    </footer>

</div>
