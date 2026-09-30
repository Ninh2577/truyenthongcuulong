<!-- ==================== LUXURY VILLA & COMPOUND (VINLAND LUXURY) ==================== -->
<div class="w-full bg-[#070b14] text-slate-100 font-sans selection:bg-amber-400 selection:text-black" x-data="{
    villaTab: 'grand',
    vrModal: false
}">

    <!-- Top Champagne Gold Strip -->
    <div class="bg-[#0b101d] text-amber-300 text-[11px] font-mono py-2 px-6 border-b border-amber-500/20 flex items-center justify-between">
        <div class="flex items-center gap-2">
            <span class="w-2 h-2 rounded-full bg-amber-400 animate-ping"></span>
            <span class="tracking-widest uppercase">VINLAND PRIVATE ESTATES • ONLY 36 SIGNATURE MANSIONS</span>
        </div>
        <div class="flex items-center gap-6 text-slate-400">
            <span>Privilege Hotline: <strong class="text-amber-400 font-mono">0939.363.262</strong></span>
            <span class="hidden md:inline">Private Yacht Reception Available</span>
        </div>
    </div>

    <!-- Header Navigation -->
    <header class="bg-[#070b14]/90 backdrop-blur-md border-b border-amber-500/10 sticky top-0 z-30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full border-2 border-amber-400/80 flex items-center justify-center text-amber-400 font-serif text-xl font-bold">
                    V
                </div>
                <div class="flex flex-col">
                    <span class="text-lg font-serif font-bold tracking-[0.2em] text-amber-200 uppercase">VINLAND</span>
                    <span class="text-[9px] font-mono text-slate-400 tracking-widest uppercase">LUXURY RESIDENCES</span>
                </div>
            </div>

            <nav class="hidden lg:flex items-center gap-8 text-xs font-bold tracking-widest text-slate-300 uppercase">
                <a href="#hero" class="text-amber-400 hover:text-amber-300">Tổng quan</a>
                <a href="#masterplan" class="hover:text-amber-400 transition-colors">Mặt bằng tổng thể</a>
                <a href="#floorplans" class="hover:text-amber-400 transition-colors">Layout Dinh Thự</a>
                <a href="#amenities" class="hover:text-amber-400 transition-colors">Đặc quyền thượng lưu</a>
                <a href="#vip-contact" class="hover:text-amber-400 transition-colors">Đặt hẹn VIP</a>
            </nav>

            <a href="#vip-contact" class="px-6 py-2.5 rounded-full border border-amber-400/80 bg-amber-400/10 hover:bg-amber-400 text-amber-300 hover:text-slate-950 font-bold text-xs tracking-wider uppercase transition-all shadow-lg shadow-amber-400/10">
                Đăng Ký Tham Quan
            </a>
        </div>
    </header>

    <!-- Hero Section: Cinematic Ultra-Luxury -->
    <section id="hero" class="relative min-h-[600px] flex items-center py-20 px-4 sm:px-8 overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1613490493576-7fde63acd811?auto=format&fit=crop&w=1800&q=80" alt="Vinland Luxury" class="w-full h-full object-cover opacity-35 scale-105">
            <div class="absolute inset-0 bg-gradient-to-t from-[#070b14] via-[#070b14]/60 to-transparent"></div>
        </div>

        <div class="relative z-10 max-w-5xl mx-auto text-center space-y-6">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-amber-400/10 border border-amber-400/30 text-amber-400 text-xs font-mono uppercase tracking-widest">
                <span>DINH THỰ ĐẢO BIỆT LẬP • PHÁP LÝ SỞ HỮU LÂU DÀI</span>
            </div>

            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-serif font-bold text-amber-100 tracking-tight leading-tight">
                Tuyệt Tác Dinh Thự <br><span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-200 via-amber-400 to-yellow-500">Bên Sông Đẳng Cấp Thượng Lưu</span>
            </h1>

            <p class="text-sm sm:text-base text-slate-300 max-w-2xl mx-auto leading-relaxed">
                Tọa lạc tại bán đảo sinh thái duy nhất được bao bọc bởi 3 mặt sông tự nhiên. Mỗi dinh thự sở hữu bến du thuyền riêng, bể bơi vô cực và công viên cảnh quan chuẩn phong cách Địa Trung Hải.
            </p>

            <div class="flex flex-wrap items-center justify-center gap-4 pt-4">
                <a href="#vip-contact" class="px-8 py-3.5 rounded-full bg-gradient-to-r from-amber-400 to-amber-500 hover:from-amber-300 hover:to-amber-400 text-slate-950 font-black text-xs uppercase tracking-wider shadow-xl shadow-amber-400/20 transition-all">
                    Nhận Hồ Sơ Mật & Bảng Giá VIP
                </a>
                <button type="button" @click="vrModal = true" class="px-7 py-3.5 rounded-full border border-amber-400/40 hover:border-amber-400 bg-white/5 hover:bg-white/10 text-amber-300 text-xs font-bold tracking-wider uppercase flex items-center gap-2 transition-all">
                    <span class="material-symbols-outlined text-[18px]">view_in_ar</span>
                    <span>Trải Nghiệm VR 360°</span>
                </button>
            </div>

            <!-- Master Project Metrics -->
            <div class="pt-12 grid grid-cols-2 md:grid-cols-4 gap-4 max-w-4xl mx-auto border-t border-amber-500/20">
                <div class="p-4 bg-slate-900/60 rounded-2xl border border-amber-500/10">
                    <span class="block text-2xl sm:text-3xl font-serif font-bold text-amber-300">25.8 Ha</span>
                    <span class="text-[11px] text-slate-400 uppercase tracking-widest">Quy mô compound</span>
                </div>
                <div class="p-4 bg-slate-900/60 rounded-2xl border border-amber-500/10">
                    <span class="block text-2xl sm:text-3xl font-serif font-bold text-amber-300">36 Căn</span>
                    <span class="text-[11px] text-slate-400 uppercase tracking-widest">Dinh thự phiên bản giới hạn</span>
                </div>
                <div class="p-4 bg-slate-900/60 rounded-2xl border border-amber-500/10">
                    <span class="block text-2xl sm:text-3xl font-serif font-bold text-amber-300">100%</span>
                    <span class="text-[11px] text-slate-400 uppercase tracking-widest">Bến du thuyền riêng</span>
                </div>
                <div class="p-4 bg-slate-900/60 rounded-2xl border border-amber-500/10">
                    <span class="block text-2xl sm:text-3xl font-serif font-bold text-amber-300">Sổ Hồng</span>
                    <span class="text-[11px] text-slate-400 uppercase tracking-widest">Sở hữu vĩnh viễn</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Interactive Layout Explorer -->
    <section id="floorplans" class="py-20 bg-[#0a0f1d] border-t border-amber-500/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-12">
                <span class="text-xs font-mono font-bold text-amber-400 uppercase tracking-widest">SIGNATURE ARCHITECTURE</span>
                <h2 class="text-3xl font-serif font-bold text-amber-100 mt-2">Mặt Bằng Bố Trí Dinh Thự</h2>
                <p class="text-xs sm:text-sm text-slate-400 mt-2">Kiến trúc mở tối đa tầm nhìn Panorama, chiều cao trần phòng khách 7.5m tráng lệ.</p>

                <div class="flex items-center justify-center gap-3 mt-6">
                    <button type="button" @click="villaTab = 'grand'" :class="villaTab === 'grand' ? 'bg-amber-400 text-slate-950 font-bold' : 'bg-slate-800 text-slate-300'" class="px-5 py-2 rounded-full text-xs transition-all">Grand Villa (580m²)</button>
                    <button type="button" @click="villaTab = 'island'" :class="villaTab === 'island' ? 'bg-amber-400 text-slate-950 font-bold' : 'bg-slate-800 text-slate-300'" class="px-5 py-2 rounded-full text-xs transition-all">Island Mansion (850m²)</button>
                    <button type="button" @click="villaTab = 'palace'" :class="villaTab === 'palace' ? 'bg-amber-400 text-slate-950 font-bold' : 'bg-slate-800 text-slate-300'" class="px-5 py-2 rounded-full text-xs transition-all">Royal Palace (1,250m²)</button>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center bg-[#0d1424] p-6 sm:p-10 rounded-3xl border border-amber-500/20">
                <div class="lg:col-span-7">
                    <img x-show="villaTab === 'grand'" src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=1000&q=80" alt="Grand Villa" class="w-full rounded-2xl shadow-2xl">
                    <img x-show="villaTab === 'island'" src="https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?auto=format&fit=crop&w=1000&q=80" alt="Island Mansion" class="w-full rounded-2xl shadow-2xl" style="display:none;">
                    <img x-show="villaTab === 'palace'" src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?auto=format&fit=crop&w=1000&q=80" alt="Royal Palace" class="w-full rounded-2xl shadow-2xl" style="display:none;">
                </div>

                <div class="lg:col-span-5 space-y-4">
                    <span class="text-xs font-mono font-bold text-amber-400 uppercase">TIÊU CHUẨN BÀN GIAO HOÀN THIỆN</span>
                    <h3 class="text-2xl font-serif font-bold text-white">Dinh Thự Đơn Lập Compound</h3>
                    <p class="text-xs text-slate-400 leading-relaxed">
                        Toàn bộ ốp đá cẩm thạch Calacatta nhập khẩu từ Ý, hệ thống kính Low-E cản nhiệt 3 lớp, thiết bị vệ sinh mạ vàng Gessi và hệ thống điều khiển Smart Villa thông minh.
                    </p>
                    <ul class="space-y-2 text-xs text-slate-300 pt-2">
                        <li class="flex items-center gap-2"><span class="text-amber-400">✓</span> 05 Phòng ngủ Master En-suite có bồn tắm kính ngắm sông</li>
                        <li class="flex items-center gap-2"><span class="text-amber-400">✓</span> Hầm rượu vang Cigar Lounge & Phòng chiếu phim 4K tư gia</li>
                        <li class="flex items-center gap-2"><span class="text-amber-400">✓</span> Hồ bơi tràn bờ nước mặn dài 22m có hệ sục Jacuzzi</li>
                        <li class="flex items-center gap-2"><span class="text-amber-400">✓</span> Bến đỗ riêng cho du thuyền 50 feet trước dinh thự</li>
                    </ul>
                    <a href="#vip-contact" class="inline-block mt-4 px-6 py-3 rounded-xl bg-amber-400 text-slate-950 font-bold text-xs uppercase tracking-wider">
                        Tải Bảng Vẽ Kỹ Thuật CAD
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- VIP Private Booking Form -->
    <section id="vip-contact" class="py-20 bg-[#070b14] border-t border-amber-500/10">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 text-center space-y-6">
            <span class="text-xs font-mono font-bold text-amber-400 uppercase tracking-widest">PRIVATE INVITATION ONLY</span>
            <h2 class="text-3xl font-serif font-bold text-amber-100">Đăng Ký Đón Tiếp Bằng Du Thuyền Riêng</h2>
            <p class="text-xs sm:text-sm text-slate-400">
                Để đảm bảo tính riêng tư tối mật, ban quản lý dự án chỉ đón tiếp tối đa 3 đoàn khách VIP mỗi ngày. Vui lòng để lại thông tin để thư ký dự án sắp xếp lịch trình.
            </p>

            <form class="bg-[#0b101d] p-8 rounded-3xl border border-amber-500/20 text-left space-y-4">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs text-amber-300 font-mono mb-1">Quý danh Khách VIP *</label>
                        <input type="text" placeholder="Ông / Bà..." class="w-full px-4 py-3 rounded-xl bg-[#070b14] border border-amber-500/30 text-white text-xs focus:border-amber-400 outline-none">
                    </div>
                    <div>
                        <label class="block text-xs text-amber-300 font-mono mb-1">Số điện thoại liên hệ *</label>
                        <input type="tel" placeholder="0939.363.262" class="w-full px-4 py-3 rounded-xl bg-[#070b14] border border-amber-500/30 text-white text-xs focus:border-amber-400 outline-none">
                    </div>
                </div>
                <div>
                    <label class="block text-xs text-amber-300 font-mono mb-1">Dòng Dinh Thự Quan Tâm</label>
                    <select class="w-full px-4 py-3 rounded-xl bg-[#070b14] border border-amber-500/30 text-white text-xs focus:border-amber-400 outline-none">
                        <option>Grand Villa (580m²) - Tầm giá 65 - 85 Tỷ</option>
                        <option>Island Mansion (850m²) - Tầm giá 95 - 130 Tỷ</option>
                        <option>Royal Palace (1,250m²) - Phiên bản độc bản</option>
                    </select>
                </div>
                <button type="button" onclick="alert('Đã tiếp nhận yêu cầu VIP! Giám đốc dự án Vinland sẽ gọi điện xác nhận lịch đón.')" class="w-full py-4 rounded-xl bg-gradient-to-r from-amber-400 to-amber-500 text-slate-950 font-bold text-xs uppercase tracking-widest shadow-xl">
                    Xác Nhận Lịch Trình Khảo Sát Riêng Tư
                </button>
            </form>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-black text-slate-500 py-8 text-center text-xs border-t border-slate-900 font-mono">
        <p>© 2026 Vinland Luxury Compound Residences. Powered by Truyền Thông Cửu Long.</p>
    </footer>

</div>
