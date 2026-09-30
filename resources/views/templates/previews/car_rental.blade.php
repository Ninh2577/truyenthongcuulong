<!-- ==================== CAR RENTAL BOOKING (CA2 RENTALY) ==================== -->
<div class="w-full bg-[#0a0f1d] text-slate-100 font-sans" x-data="{
    carCategory: 'all',
    pickupLoc: 'cantho-airport',
    pickupDate: '2026-10-01',
    returnDate: '2026-10-03'
}">

    <!-- Top strip -->
    <div class="bg-black text-xs text-slate-400 py-2 px-4 sm:px-8 flex items-center justify-between border-b border-slate-800">
        <div class="flex items-center gap-2">
            <span class="w-2 h-2 rounded-full bg-red-500 animate-pulse"></span>
            <span class="text-white font-bold">RENTALY AUTO FLEET</span>
            <span class="hidden sm:inline">• Dịch vụ cho thuê xe tự lái & có tài xế đời mới 2024-2026</span>
        </div>
        <div class="flex items-center gap-6 text-[11px]">
            <span>Hotline cứu hộ & Đặt xe 24/7: <strong class="text-red-500 font-mono">0939 523 557</strong></span>
        </div>
    </div>

    <!-- Header Navigation -->
    <header class="bg-[#0e1626]/90 backdrop-blur-md border-b border-slate-800 sticky top-0 z-30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <div class="flex items-center gap-2.5">
                <div class="w-10 h-10 rounded-xl bg-red-600 flex items-center justify-center text-white font-black text-xl shadow-md">
                    <span class="material-symbols-outlined text-[24px]">directions_car</span>
                </div>
                <div class="flex flex-col">
                    <span class="text-xl font-black tracking-tight text-white uppercase">Rentaly</span>
                    <span class="text-[9px] font-bold text-red-500 tracking-widest uppercase">PREMIUM CAR RENTAL</span>
                </div>
            </div>

            <nav class="hidden lg:flex items-center gap-8 text-xs font-bold text-slate-300 uppercase tracking-wider">
                <a href="#hero" class="text-red-500">Trang chủ</a>
                <a href="#fleet" class="hover:text-red-500 transition-colors">Đội xe cho thuê</a>
                <a href="#services" class="hover:text-red-500 transition-colors">Dịch vụ xe cưới</a>
                <a href="#terms" class="hover:text-red-500 transition-colors">Thủ tục thuê xe</a>
                <a href="#contact" class="hover:text-red-500 transition-colors">Liên hệ</a>
            </nav>

            <a href="#booking-widget" class="px-5 py-2.5 rounded-full bg-red-600 hover:bg-red-700 text-white font-bold text-xs uppercase tracking-wider shadow-lg shadow-red-600/30 transition-all">
                Tìm Xe Trống Ngay
            </a>
        </div>
    </header>

    <!-- Hero with Floating Car Booking Widget -->
    <section id="hero" class="relative py-16 lg:py-24 px-4 sm:px-8 overflow-hidden bg-gradient-to-b from-[#0a0f1d] via-[#10192e] to-[#0a0f1d]">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                <!-- Left text -->
                <div class="lg:col-span-6 space-y-6">
                    <span class="inline-block px-3 py-1 rounded-full bg-red-500/20 border border-red-500/40 text-red-400 text-xs font-mono font-bold uppercase tracking-wider">
                        THUÊ XE TỰ LÁI THỦ TỤC NHANH 15 PHÚT
                    </span>
                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black text-white leading-tight">
                        Trải Nghiệm Hành Trình <br><span class="text-red-500">Cùng Đội Xe Đẳng Cấp</span>
                    </h1>
                    <p class="text-xs sm:text-sm text-slate-300 leading-relaxed max-w-lg">
                        Giao xe tận nơi miễn phí tại sân bay Cần Thơ và khách sạn nội ô. 100% xe đời mới được bảo dưỡng kỹ thuật và khử khuẩn sạch sẽ trước khi bàn giao.
                    </p>
                </div>

                <!-- Right car visual -->
                <div class="lg:col-span-6 relative">
                    <img src="https://images.unsplash.com/photo-1549399542-7e3f8b79c341?auto=format&fit=crop&w=1000&q=80" alt="Mercedes Car" class="w-full rounded-3xl shadow-2xl border border-slate-800">
                </div>
            </div>

            <!-- Floating Rental Booking Form Widget -->
            <div id="booking-widget" class="mt-12 bg-[#121c32] p-6 sm:p-8 rounded-3xl border border-slate-700 shadow-2xl">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-400 mb-1">Điểm nhận & Trả xe</label>
                        <select class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 text-xs text-white focus:border-red-500 outline-none">
                            <option>Sân bay Cần Thơ (VCA)</option>
                            <option>Nội ô TP. Cần Thơ (Giao tận nhà)</option>
                            <option>Bến xe Miền Tây Cần Thơ</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-400 mb-1">Ngày nhận xe</label>
                        <input type="date" value="2026-10-01" class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 text-xs text-white focus:border-red-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-400 mb-1">Ngày trả xe</label>
                        <input type="date" value="2026-10-03" class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 text-xs text-white focus:border-red-500 outline-none">
                    </div>
                    <div class="flex items-end">
                        <button type="button" onclick="alert('Đang tìm kiếm đội xe trống phù hợp cho bạn!')" class="w-full py-3.5 rounded-xl bg-red-600 hover:bg-red-700 text-white font-extrabold text-xs uppercase tracking-wider shadow-lg transition-all flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined text-[18px]">search</span>
                            <span>Tìm Xe Có Sẵn</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Fleet Showcase Grid -->
    <section id="fleet" class="py-16 bg-[#0a0f1d] border-t border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-10">
                <div>
                    <span class="text-xs font-mono font-bold text-red-500 uppercase tracking-widest">FEATURED FLEET</span>
                    <h2 class="text-2xl sm:text-3xl font-black text-white mt-1">Các Dòng Xe Đang Sẵn Sàng</h2>
                </div>
                <div class="flex items-center gap-2">
                    <button type="button" @click="carCategory = 'all'" :class="carCategory === 'all' ? 'bg-red-600 text-white' : 'bg-slate-800 text-slate-400'" class="px-4 py-2 rounded-xl text-xs font-bold transition-all">Tất cả</button>
                    <button type="button" @click="carCategory = 'sedan'" :class="carCategory === 'sedan' ? 'bg-red-600 text-white' : 'bg-slate-800 text-slate-400'" class="px-4 py-2 rounded-xl text-xs font-bold transition-all">Sedan 4-5 Chỗ</button>
                    <button type="button" @click="carCategory = 'suv'" :class="carCategory === 'suv' ? 'bg-red-600 text-white' : 'bg-slate-800 text-slate-400'" class="px-4 py-2 rounded-xl text-xs font-bold transition-all">SUV 7 Chỗ</button>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Car 1 -->
                <div class="bg-[#121c32] rounded-3xl overflow-hidden border border-slate-800 p-5 space-y-4 hover:border-red-500 transition-all flex flex-col group">
                    <div class="relative aspect-video rounded-2xl overflow-hidden bg-slate-900">
                        <img src="https://images.unsplash.com/photo-1549399542-7e3f8b79c341?auto=format&fit=crop&w=700&q=80" alt="Mercedes C300" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <span class="absolute top-3 right-3 bg-red-600 text-white px-3 py-1 rounded-full text-[11px] font-bold">XE SANG</span>
                    </div>
                    <div class="flex-1 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between mb-1">
                                <h3 class="text-base font-black text-white group-hover:text-red-400 transition-colors">Mercedes C300 AMG 2024</h3>
                                <span class="text-red-500 font-mono font-black text-sm">1.800.000đ/Ngày</span>
                            </div>
                            <p class="text-xs text-slate-400 mb-4">Gói bảo hiểm thân vỏ toàn diện, giao xe rửa sạch đổ đầy bình xăng.</p>
                            <div class="grid grid-cols-3 gap-2 p-2.5 rounded-xl bg-slate-900/80 text-[11px] text-slate-300 text-center mb-4">
                                <div>Số tự động</div>
                                <div>5 Chỗ ngồi</div>
                                <div>Xăng 2.0 Turbo</div>
                            </div>
                        </div>
                        <button type="button" onclick="alert('Đã chọn Mercedes C300! Rentaly sẽ chuẩn bị hợp đồng điện tử.')" class="w-full py-2.5 rounded-xl bg-red-600 hover:bg-red-700 text-white font-bold text-xs uppercase tracking-wider transition-all">
                            Đặt Thuê Ngay
                        </button>
                    </div>
                </div>

                <!-- Car 2 -->
                <div class="bg-[#121c32] rounded-3xl overflow-hidden border border-slate-800 p-5 space-y-4 hover:border-red-500 transition-all flex flex-col group">
                    <div class="relative aspect-video rounded-2xl overflow-hidden bg-slate-900">
                        <img src="https://images.unsplash.com/photo-1533473359331-0135ef1b58bf?auto=format&fit=crop&w=700&q=80" alt="Ford Everest" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <span class="absolute top-3 right-3 bg-emerald-600 text-white px-3 py-1 rounded-full text-[11px] font-bold">GIA ĐÌNH</span>
                    </div>
                    <div class="flex-1 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between mb-1">
                                <h3 class="text-base font-black text-white group-hover:text-red-400 transition-colors">Ford Everest Titanium 4x4</h3>
                                <span class="text-red-500 font-mono font-black text-sm">1.500.000đ/Ngày</span>
                            </div>
                            <p class="text-xs text-slate-400 mb-4">Gầm cao 7 chỗ rộng rãi, cửa sổ trời Panorama, thích hợp du lịch miền Tây.</p>
                            <div class="grid grid-cols-3 gap-2 p-2.5 rounded-xl bg-slate-900/80 text-[11px] text-slate-300 text-center mb-4">
                                <div>Số tự động 10 cấp</div>
                                <div>7 Chỗ rộng</div>
                                <div>Dầu Bi-Turbo</div>
                            </div>
                        </div>
                        <button type="button" onclick="alert('Đã chọn Ford Everest! Rentaly sẽ chuẩn bị hợp đồng điện tử.')" class="w-full py-2.5 rounded-xl bg-red-600 hover:bg-red-700 text-white font-bold text-xs uppercase tracking-wider transition-all">
                            Đặt Thuê Ngay
                        </button>
                    </div>
                </div>

                <!-- Car 3 -->
                <div class="bg-[#121c32] rounded-3xl overflow-hidden border border-slate-800 p-5 space-y-4 hover:border-red-500 transition-all flex flex-col group">
                    <div class="relative aspect-video rounded-2xl overflow-hidden bg-slate-900">
                        <img src="https://images.unsplash.com/photo-1541899481282-d53bffe3c35d?auto=format&fit=crop&w=700&q=80" alt="Kia Carnival" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <span class="absolute top-3 right-3 bg-amber-500 text-slate-950 px-3 py-1 rounded-full text-[11px] font-bold">CHỦ TỊCH VIP</span>
                    </div>
                    <div class="flex-1 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between mb-1">
                                <h3 class="text-base font-black text-white group-hover:text-red-400 transition-colors">Kia Carnival Signature 2024</h3>
                                <span class="text-red-500 font-mono font-black text-sm">2.200.000đ/Ngày</span>
                            </div>
                            <p class="text-xs text-slate-400 mb-4">Ghế thương gia ngả lưng có sưởi và massage, màn hình giải trí đa phương tiện.</p>
                            <div class="grid grid-cols-3 gap-2 p-2.5 rounded-xl bg-slate-900/80 text-[11px] text-slate-300 text-center mb-4">
                                <div>Số tự động</div>
                                <div>7 Chỗ VIP</div>
                                <div>Xăng 3.5 V6</div>
                            </div>
                        </div>
                        <button type="button" onclick="alert('Đã chọn Kia Carnival! Rentaly sẽ chuẩn bị hợp đồng điện tử.')" class="w-full py-2.5 rounded-xl bg-red-600 hover:bg-red-700 text-white font-bold text-xs uppercase tracking-wider transition-all">
                            Đặt Thuê Ngay
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-black text-slate-500 py-6 text-center text-xs border-t border-slate-900">
        <p>© 2026 Ca2 Rentaly Car Rental System. Developed with Truyền Thông Cửu Long.</p>
    </footer>

</div>
