<!-- ==================== DENTAL CARE & SMILE AESTHETICS (DENTALCARE) ==================== -->
<div class="w-full bg-[#f0fdfa] text-slate-800 font-sans" x-data="{
    sliderPos: 50,
    examService: 'niengrang'
}">

    <!-- Top strip -->
    <div class="bg-[#0f766e] text-teal-100 text-xs py-2 px-4 sm:px-8 flex items-center justify-between">
        <div class="flex items-center gap-2">
            <span>✨</span>
            <span>NHA KHOA THẨM MỸ QUỐC TẾ DENTALCARE • MIỄN PHÍ CHỤP PHIM CT CONEBEAM 3D TRỊ GIÁ 500.000Đ</span>
        </div>
        <div class="flex items-center gap-6 text-[11px]">
            <span>Hotline Bác sĩ tư vấn: <strong class="text-white">0939.363.262</strong></span>
        </div>
    </div>

    <!-- Header Navigation -->
    <header class="bg-white border-b border-teal-100 sticky top-0 z-30 shadow-xs">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <div class="flex items-center gap-2.5">
                <div class="w-10 h-10 rounded-2xl bg-teal-600 flex items-center justify-center text-white font-bold text-xl shadow-md">
                    🦷
                </div>
                <div class="flex flex-col">
                    <span class="text-xl font-black text-slate-900 tracking-tight">DentalCare</span>
                    <span class="text-[9px] font-bold text-teal-600 tracking-widest uppercase">VIỆN THẨM MỸ NỤ CƯỜI</span>
                </div>
            </div>

            <nav class="hidden lg:flex items-center gap-7 text-xs font-bold text-slate-700 uppercase">
                <a href="#hero" class="text-teal-700">Trang chủ</a>
                <a href="#before-after" class="hover:text-teal-700 transition-colors">Kết quả khách hàng</a>
                <a href="#services" class="hover:text-teal-700 transition-colors">Dịch vụ nha khoa</a>
                <a href="#pricing" class="hover:text-teal-700 transition-colors">Bảng giá trọn gói</a>
                <a href="#booking" class="hover:text-teal-700 transition-colors">Đặt lịch khám</a>
            </nav>

            <a href="#booking" class="px-5 py-2.5 rounded-full bg-teal-600 hover:bg-teal-700 text-white font-bold text-xs uppercase tracking-wider shadow-sm transition-all">
                Đăng Ký Khám Miễn Phí
            </a>
        </div>
    </header>

    <!-- Hero Section -->
    <section id="hero" class="py-16 lg:py-24 bg-gradient-to-b from-teal-50 via-white to-teal-50/40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                <div class="lg:col-span-6 space-y-6">
                    <span class="inline-block px-3 py-1 rounded-full bg-teal-100 text-teal-800 text-xs font-bold font-mono">
                        CÔNG NGHỆ THIẾT KẾ NỤ CƯỜI DSD 3D
                    </span>

                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black text-slate-900 leading-tight">
                        Kiến Tạo Nụ Cười <br><span class="text-teal-600">Tự Nhiên & Rạng Rỡ</span>
                    </h1>

                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed max-w-lg">
                        Chuyên sâu Niềng răng trong suốt Invisalign, Dán sứ Veneer không mài nhỏ răng và Trồng răng Implant bảo hành trọn đời bằng văn bản.
                    </p>

                    <div class="flex flex-wrap items-center gap-4 pt-2">
                        <a href="#booking" class="px-7 py-3 rounded-full bg-teal-600 hover:bg-teal-700 text-white font-extrabold text-xs uppercase tracking-wider shadow-md transition-all">
                            Đặt Lịch Thăm Khám 1:1
                        </a>
                        <a href="#before-after" class="px-6 py-3 rounded-full bg-white border border-teal-200 text-slate-700 font-bold text-xs uppercase tracking-wider hover:bg-teal-50 transition-all">
                            Xem Hình Ảnh Trước/Sau
                        </a>
                    </div>
                </div>

                <!-- Right visual -->
                <div class="lg:col-span-6 relative">
                    <div class="relative rounded-3xl overflow-hidden shadow-2xl border-4 border-white aspect-4/3">
                        <img src="https://images.unsplash.com/photo-1606811841689-23dfddce3e95?auto=format&fit=crop&w=1000&q=80" alt="Beautiful Smile" class="w-full h-full object-cover">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Before / After Slider Section -->
    <section id="before-after" class="py-16 bg-white border-t border-teal-100">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <span class="text-xs font-bold text-teal-600 uppercase tracking-widest font-mono">CASE STUDIES</span>
            <h2 class="text-2xl sm:text-3xl font-black text-slate-900 mt-1">Kết Quả Thay Đổi Sau Niềng Răng</h2>
            <p class="text-xs sm:text-sm text-slate-500 max-w-lg mx-auto mt-1 mb-8">Kéo thanh trượt để so sánh tình trạng hàm răng Trước và Sau 18 tháng niềng tại DentalCare.</p>

            <!-- Interactive Slider Simulation -->
            <div class="max-w-2xl mx-auto relative rounded-3xl overflow-hidden shadow-2xl border-4 border-teal-100 bg-slate-900 aspect-video select-none">
                <img src="https://images.unsplash.com/photo-1588776814546-1ffcf47267a5?auto=format&fit=crop&w=1000&q=80" alt="After" class="w-full h-full object-cover">
                <div class="absolute top-4 left-4 bg-teal-600 text-white text-xs font-bold px-3 py-1 rounded-full shadow-md">
                    KẾT QUẢ HOÀN THIỆN
                </div>
                <div class="absolute bottom-4 right-4 bg-black/70 backdrop-blur-md text-white text-xs p-3 rounded-2xl border border-white/20">
                    <span class="font-bold block">Khách hàng: Minh Thư (24 tuổi)</span>
                    <span class="text-[10px] text-slate-300">Khớp cắn ngược & Răng khấp khểnh độ 3</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Booking Form Section -->
    <section id="booking" class="py-16 bg-[#042f2e] text-white">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 text-center space-y-6">
            <span class="text-xs font-bold text-teal-400 uppercase tracking-widest font-mono">DENTAL CONSULTATION</span>
            <h2 class="text-2xl sm:text-3xl font-black">Nhận Kế Hoạch Điều Trị 3D Miễn Phí</h2>
            <p class="text-xs sm:text-sm text-teal-200">
                Thấy trước nụ cười tương lai chỉ sau 1 buổi quét mẫu hàm kỹ thuật số iTero 5D.
            </p>

            <form class="bg-teal-950/80 p-8 rounded-3xl border border-teal-800 text-left space-y-4">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-1">Họ tên của bạn *</label>
                        <input type="text" placeholder="Nguyễn Văn A" class="w-full px-4 py-2.5 rounded-xl bg-teal-900 border border-teal-700 text-xs text-white focus:border-teal-400 outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-1">Số điện thoại *</label>
                        <input type="tel" placeholder="0939.363.262" class="w-full px-4 py-2.5 rounded-xl bg-teal-900 border border-teal-700 text-xs text-white focus:border-teal-400 outline-none">
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-300 mb-1">Dịch vụ quan tâm</label>
                    <select class="w-full px-4 py-2.5 rounded-xl bg-teal-900 border border-teal-700 text-xs text-white focus:border-teal-400 outline-none">
                        <option>Niềng răng trong suốt Invisalign / Mắc cài</option>
                        <option>Dán sứ Veneer thẩm mỹ</option>
                        <option>Trồng răng Implant kỹ thuật số</option>
                        <option>Tẩy trắng răng công nghệ Laser Whitening</option>
                    </select>
                </div>
                <button type="button" onclick="alert('Đã tiếp nhận lịch hẹn khám! Bác sĩ DentalCare sẽ liên hệ xác nhận.')" class="w-full py-3.5 rounded-xl bg-teal-500 hover:bg-teal-400 text-slate-950 font-black text-xs uppercase tracking-wider transition-all">
                    Giữ Suất Quét iTero 5D Miễn Phí
                </button>
            </form>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-black text-slate-500 py-6 text-center text-xs border-t border-slate-900">
        <p>© 2026 DentalCare International Aesthetics. Developed with Truyền Thông Cửu Long.</p>
    </footer>

</div>
