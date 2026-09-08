@extends('layouts.app')

@section('title', 'Booking Ekip Quay Phim, Chụp Ảnh & Livestream Hỏa Tốc - Truyền Thông Cửu Long')
@section('meta_description', 'Dịch vụ cho thuê ekip quay phim điện ảnh 4K, chụp ảnh sự kiện, bay flycam và livestream chuyên nghiệp tác nghiệp theo buổi, trọn gói ngày tại Cần Thơ, TP.HCM và Miền Tây.')

@section('content')
<div class="w-full bg-[#080C16] text-white selection:bg-amber-500 selection:text-slate-900" x-data="{
    selectedPackage: 'full_day',
    basePrice: 8500000,
    addons: {
        dop: false,
        flycam: false,
        photo: true,
        mc: false,
        lighting: false
    },
    eventDate: '',
    eventLocation: 'Cần Thơ',
    fullName: '',
    phone: '',
    email: '',
    notes: '',

    selectPackage(pkg, price) {
        this.selectedPackage = pkg;
        this.basePrice = price;
    },

    calculateTotal() {
        let total = this.basePrice;
        if (this.addons.dop) total += 3000000;
        if (this.addons.flycam) total += 2500000;
        if (this.addons.photo) total += 2000000;
        if (this.addons.mc) total += 3500000;
        if (this.addons.lighting) total += 1500000;
        return new Intl.NumberFormat('vi-VN').format(total) + ' VNĐ';
    },

    generateMessage() {
        let pkgName = this.selectedPackage === 'half_day' ? 'Gói Nửa Ngày (4h)' : (this.selectedPackage === 'full_day' ? 'Gói Trọn Ngày (8h)' : 'Gói Livestream Sự Kiện');
        let selectedAddons = [];
        if (this.addons.dop) selectedAddons.push('DOP/Đạo diễn');
        if (this.addons.flycam) selectedAddons.push('Flycam 4K FPV');
        if (this.addons.photo) selectedAddons.push('Chụp ảnh lấy liền');
        if (this.addons.mc) selectedAddons.push('MC Song ngữ');
        if (this.addons.lighting) selectedAddons.push('Ánh sáng sân khấu');

        return `[BOOKING EKIP] Gói: ${pkgName} | Ngày tác nghiệp: ${this.eventDate || 'Chưa định ngày'} | Địa điểm: ${this.eventLocation} | Dự toán sơ bộ: ${this.calculateTotal()} | Tùy chọn thêm: ${selectedAddons.join(', ') || 'Không'} | Ghi chú: ${this.notes || 'Không có'}`;
    }
}">

    <!-- SECTION 1: SMALL HERO -->
    <section class="relative pt-32 pb-12 lg:pt-36 lg:pb-16 bg-[#0B132B]/60 border-b border-slate-800/80 overflow-hidden">
        <div class="absolute inset-0 bg-dot-grid-subtle opacity-20 pointer-events-none"></div>
        <div class="absolute -top-24 right-1/3 w-96 h-96 bg-amber-500/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- Breadcrumb -->
            <nav class="flex items-center gap-2 text-xs font-mono text-slate-400 mb-6" aria-label="Breadcrumb">
                <a href="{{ route('home') }}" class="hover:text-amber-400 transition-colors flex items-center gap-1">
                    <span class="material-symbols-outlined text-[14px]">home</span>
                    <span>Trang chủ</span>
                </a>
                <span class="text-slate-600">/</span>
                <a href="{{ route('services.index') }}" class="hover:text-amber-400 transition-colors">Dịch vụ</a>
                <span class="text-slate-600">/</span>
                <span class="text-amber-400 font-semibold">Booking Team Media</span>
            </nav>

            <div class="max-w-3xl">
                <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-amber-400/10 border border-amber-400/30 text-amber-400 font-mono text-xs font-bold mb-4">
                    <span class="w-2 h-2 rounded-full bg-amber-400 animate-pulse"></span>
                    <span>ON-DEMAND PRODUCTION CREW</span>
                </div>
                <h1 class="font-headline text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight leading-tight text-white mb-4">
                    Đặt Lịch Ekip Quay Phim, Chụp Ảnh &amp; <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-400 via-orange-400 to-amber-200">Livestream Tác Nghiệp Hỏa Tốc</span>
                </h1>
                <p class="font-body text-slate-300 text-sm sm:text-base leading-relaxed mb-6">
                    Giải pháp điều động nhân sự và thiết bị điện ảnh linh hoạt cho hội nghị, hội thảo, lễ khởi công, gala doanh nghiệp. Cam kết có mặt đúng giờ, bàn giao file RAW gốc ngay trong ngày.
                </p>

                <!-- Fast Perks -->
                <div class="flex flex-wrap items-center gap-4 text-xs font-mono text-slate-300">
                    <div class="flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-slate-900 border border-slate-800">
                        <span class="material-symbols-outlined text-amber-400 text-[16px]">schedule</span>
                        <span>Có mặt trước giờ G 45 phút</span>
                    </div>
                    <div class="flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-slate-900 border border-slate-800">
                        <span class="material-symbols-outlined text-amber-400 text-[16px]">photo_camera</span>
                        <span>Máy quay Sony FX Cinema 4K</span>
                    </div>
                    <div class="flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-slate-900 border border-slate-800">
                        <span class="material-symbols-outlined text-amber-400 text-[16px]">flash_on</span>
                        <span>Nhận file RAW trong 24 giờ</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SUCCESS ALERT IF REDIRECTED WITH FLASH MESSAGE -->
    @if(session('success'))
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8">
        <div class="p-4 rounded-2xl bg-amber-400/20 border border-amber-400/60 text-amber-200 text-sm font-semibold flex items-center gap-3">
            <span class="material-symbols-outlined text-amber-400 text-[24px]">task_alt</span>
            <div>{{ session('success') }}</div>
        </div>
    </div>
    @endif

    <!-- SECTION 2: 3 STANDARD CREW PACKAGES -->
    <section class="py-12 lg:py-16 bg-[#080C16] border-b border-slate-800 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-10 lg:mb-12">
                <div class="max-w-2xl">
                    <span class="font-mono text-xs font-bold text-amber-400 uppercase">TIÊU CHUẨN ĐIỀU ĐỘNG</span>
                    <h2 class="font-headline text-2xl sm:text-3xl font-extrabold text-white mt-1">3 Gói Thuê Ekip Tác Nghiệp Tiêu Chuẩn</h2>
                </div>
                <p class="text-xs text-slate-400 font-mono">Báo giá minh bạch • Kèm hợp đồng pháp nhân đầy đủ</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-stretch">
                <!-- Package 1: Half-Day -->
                <div @click="selectPackage('half_day', 4500000)" 
                    :class="selectedPackage === 'half_day' ? 'border-amber-400 bg-[#131D38] shadow-xl shadow-amber-500/10' : 'border-slate-800 bg-[#0F172A] hover:border-slate-700'"
                    class="p-8 rounded-3xl border-2 flex flex-col justify-between cursor-pointer transition-all">
                    <div class="flex flex-col gap-4">
                        <div class="flex items-center justify-between">
                            <span class="font-mono text-xs font-bold text-slate-400 uppercase tracking-wider">BUỔI SÁNG / CHIỀU</span>
                            <span x-show="selectedPackage === 'half_day'" class="px-2.5 py-0.5 rounded-full bg-amber-400 text-slate-950 font-mono text-[10px] font-extrabold">ĐÃ CHỌN</span>
                        </div>
                        <h3 class="font-headline text-2xl font-bold text-white">Gói Nửa Ngày (4 Giờ)</h3>
                        <div class="flex items-baseline gap-1.5 my-2">
                            <span class="font-headline text-3xl sm:text-4xl font-black text-white">4.500.000</span>
                            <span class="text-xs font-mono text-slate-400">VNĐ / 4 tiếng</span>
                        </div>
                        <p class="text-xs text-slate-400 leading-relaxed">Phù hợp cho lễ khai trương nhỏ, hội thảo chuyên đề, phỏng vấn nhân vật hoặc quay tư liệu ngắn hạn.</p>
                        
                        <ul class="space-y-3 pt-6 border-t border-slate-800 text-xs text-slate-300">
                            <li class="flex items-center gap-2.5"><span class="text-amber-400 font-bold">✓</span> 01 Quay phim chính kinh nghiệm 5+ năm</li>
                            <li class="flex items-center gap-2.5"><span class="text-amber-400 font-bold">✓</span> 01 Máy quay Sony FX Cinema 4K 10-bit</li>
                            <li class="flex items-center gap-2.5"><span class="text-amber-400 font-bold">✓</span> Bộ ống kính Prime &amp; Zoom chuyên dụng</li>
                            <li class="flex items-center gap-2.5"><span class="text-amber-400 font-bold">✓</span> Hệ thống Micro không dây Rode Wireless PRO</li>
                            <li class="flex items-center gap-2.5"><span class="text-amber-400 font-bold">✓</span> Bàn giao toàn bộ file RAW 4K qua Cloud trong 24h</li>
                        </ul>
                    </div>
                    <button type="button" class="mt-8 py-3 w-full rounded-2xl font-headline text-xs font-bold text-center transition-all"
                        :class="selectedPackage === 'half_day' ? 'bg-amber-400 text-slate-950' : 'bg-slate-800 text-slate-300'">
                        <span x-text="selectedPackage === 'half_day' ? 'Đang Chọn Gói Này' : 'Chọn Gói Nửa Ngày'"></span>
                    </button>
                </div>

                <!-- Package 2: Full-Day (PRO) -->
                <div @click="selectPackage('full_day', 8500000)" 
                    :class="selectedPackage === 'full_day' ? 'border-amber-400 bg-[#131D38] shadow-2xl shadow-amber-500/20' : 'border-slate-800 bg-[#0F172A] hover:border-slate-700'"
                    class="p-8 rounded-3xl border-2 flex flex-col justify-between cursor-pointer transition-all relative transform lg:-translate-y-2">
                    <div class="absolute -top-3.5 left-1/2 -translate-x-1/2 px-4 py-1 rounded-full bg-amber-400 text-slate-950 font-mono text-[11px] font-extrabold shadow-md uppercase tracking-wider">
                        ★ ĐƯỢC DOANH NGHIỆP CHỌN NHIỀU NHẤT
                    </div>
                    <div class="flex flex-col gap-4 pt-2">
                        <div class="flex items-center justify-between">
                            <span class="font-mono text-xs font-bold text-amber-400 uppercase tracking-wider">SỰ KIỆN TRỌN NGÀY</span>
                            <span x-show="selectedPackage === 'full_day'" class="px-2.5 py-0.5 rounded-full bg-amber-400 text-slate-950 font-mono text-[10px] font-extrabold">ĐÃ CHỌN</span>
                        </div>
                        <h3 class="font-headline text-2xl font-bold text-white">Gói Trọn Ngày (8 Giờ)</h3>
                        <div class="flex items-baseline gap-1.5 my-2">
                            <span class="font-headline text-3xl sm:text-4xl font-black text-transparent bg-clip-text bg-gradient-to-r from-amber-400 via-orange-400 to-amber-200">8.500.000</span>
                            <span class="text-xs font-mono text-slate-400">VNĐ / ngày</span>
                        </div>
                        <p class="text-xs text-slate-300 leading-relaxed">Chuẩn mực cho hội nghị cấp cao, lễ kỷ niệm công ty, giải chạy marathon, lễ khởi công công trình lớn.</p>
                        
                        <ul class="space-y-3 pt-6 border-t border-slate-700 text-xs text-slate-200">
                            <li class="flex items-center gap-2.5"><span class="text-amber-400 font-bold">✓</span> 02 Quay phim chuyên nghiệp đa góc máy</li>
                            <li class="flex items-center gap-2.5"><span class="text-amber-400 font-bold">✓</span> 02 Máy Sony FX Cinema + Gimbal chống rung DJI</li>
                            <li class="flex items-center gap-2.5"><span class="text-amber-400 font-bold">✓</span> Flycam 4K ghi hình toàn cảnh trên không</li>
                            <li class="flex items-center gap-2.5"><span class="text-amber-400 font-bold">✓</span> Hệ thống đèn LED Aputure/Nanlite trợ sáng</li>
                            <li class="flex items-center gap-2.5"><span class="text-amber-400 font-bold">✓</span> Máy thu âm chuyên dụng Zoom 32-bit float</li>
                            <li class="flex items-center gap-2.5"><span class="text-amber-400 font-bold">✓</span> Tặng kèm clip Highlight ngắn 60s dựng nhanh</li>
                        </ul>
                    </div>
                    <button type="button" class="mt-8 py-3.5 w-full rounded-2xl font-headline text-xs font-extrabold text-center transition-all shadow-md"
                        :class="selectedPackage === 'full_day' ? 'bg-amber-400 text-slate-950 shadow-amber-400/20' : 'bg-slate-800 text-slate-300'">
                        <span x-text="selectedPackage === 'full_day' ? 'Đang Chọn Gói Trọn Ngày' : 'Chọn Gói Trọn Ngày'"></span>
                    </button>
                </div>

                <!-- Package 3: Livestream / Multi-Cam -->
                <div @click="selectPackage('livestream', 15000000)" 
                    :class="selectedPackage === 'livestream' ? 'border-amber-400 bg-[#131D38] shadow-xl shadow-amber-500/10' : 'border-slate-800 bg-[#0F172A] hover:border-slate-700'"
                    class="p-8 rounded-3xl border-2 flex flex-col justify-between cursor-pointer transition-all">
                    <div class="flex flex-col gap-4">
                        <div class="flex items-center justify-between">
                            <span class="font-mono text-xs font-bold text-slate-400 uppercase tracking-wider">PHÁT SÓNG TRỰC TIẾP</span>
                            <span x-show="selectedPackage === 'livestream'" class="px-2.5 py-0.5 rounded-full bg-amber-400 text-slate-950 font-mono text-[10px] font-extrabold">ĐÃ CHỌN</span>
                        </div>
                        <h3 class="font-headline text-2xl font-bold text-white">Gói Livestream Đa Máy</h3>
                        <div class="flex items-baseline gap-1.5 my-2">
                            <span class="font-headline text-3xl sm:text-4xl font-black text-white">15.000.000</span>
                            <span class="text-xs font-mono text-slate-400">VNĐ / buổi</span>
                        </div>
                        <p class="text-xs text-slate-400 leading-relaxed">Truyền hình trực tiếp chất lượng cao lên Facebook, YouTube, Zoom với đồ họa tỷ số, lower-third và âm thanh chuẩn.</p>
                        
                        <ul class="space-y-3 pt-6 border-t border-slate-800 text-xs text-slate-300">
                            <li class="flex items-center gap-2.5"><span class="text-amber-400 font-bold">✓</span> Ekip 4-5 nhân sự (Đạo diễn hình + Quay phim + Kỹ thuật stream)</li>
                            <li class="flex items-center gap-2.5"><span class="text-amber-400 font-bold">✓</span> Bàn trộn hình Blackmagic ATEM Cinema Switcher</li>
                            <li class="flex items-center gap-2.5"><span class="text-amber-400 font-bold">✓</span> 3 - 4 Góc máy quay 4K bắt trọn mọi khoảnh khắc</li>
                            <li class="flex items-center gap-2.5"><span class="text-amber-400 font-bold">✓</span> Chèn logo, banner, intro/outro, phụ đề trực tiếp</li>
                            <li class="flex items-center gap-2.5"><span class="text-amber-400 font-bold">✓</span> Bộ phát 4G Bonded đa mạng chống rớt đường truyền</li>
                        </ul>
                    </div>
                    <button type="button" class="mt-8 py-3 w-full rounded-2xl font-headline text-xs font-bold text-center transition-all"
                        :class="selectedPackage === 'livestream' ? 'bg-amber-400 text-slate-950' : 'bg-slate-800 text-slate-300'">
                        <span x-text="selectedPackage === 'livestream' ? 'Đang Chọn Gói Livestream' : 'Chọn Gói Livestream'"></span>
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 3: ADD-ONS & INTERACTIVE BOOKING FORM -->
    <section class="py-12 lg:py-16 bg-[#0B132B]/50 border-b border-slate-800 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="p-8 sm:p-12 rounded-3xl bg-[#0F172A] border border-amber-400/30 shadow-2xl relative overflow-hidden">
                <div class="max-w-3xl mb-10">
                    <span class="font-mono text-xs font-bold text-amber-400 uppercase">TIẾP NHẬN YÊU CẦU TRỰC TUYẾN</span>
                    <h2 class="font-headline text-2xl sm:text-3xl font-extrabold text-white mt-1">Form Đặt Lịch Ekip Thông Minh</h2>
                    <p class="text-xs sm:text-sm text-slate-400 mt-1">Chọn thêm tùy chọn bổ sung và gửi thông tin sự kiện để chuyên viên liên hệ xác nhận trong 15 phút.</p>
                </div>

                <form action="{{ route('contact.submit') }}" method="POST" class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                    @csrf
                    <!-- Hidden field to tell backend about service and compiled message -->
                    <input type="hidden" name="service_interested" value="booking-media">
                    <input type="hidden" name="message" :value="generateMessage()">

                    <!-- Left: Addons & Date/Location (7 cols) -->
                    <div class="lg:col-span-7 space-y-6">
                        <!-- Date & Location -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block font-headline text-xs font-bold text-slate-300 mb-2">Ngày dự kiến tác nghiệp <span class="text-amber-400">*</span></label>
                                <input type="date" x-model="eventDate" required 
                                    class="w-full px-4 py-3 rounded-2xl bg-slate-900 border border-slate-700 text-white text-xs focus:ring-2 focus:ring-amber-400 focus:outline-none">
                            </div>
                            <div>
                                <label class="block font-headline text-xs font-bold text-slate-300 mb-2">Khu vực địa điểm <span class="text-amber-400">*</span></label>
                                <select x-model="eventLocation" class="w-full px-4 py-3 rounded-2xl bg-slate-900 border border-slate-700 text-white text-xs focus:ring-2 focus:ring-amber-400 focus:outline-none">
                                    <option value="Cần Thơ">TP. Cần Thơ (Miễn phí di chuyển)</option>
                                    <option value="TP. Hồ Chí Minh">TP. Hồ Chí Minh</option>
                                    <option value="An Giang - Kiên Giang">An Giang / Kiên Giang</option>
                                    <option value="Hậu Giang - Vĩnh Long">Hậu Giang / Vĩnh Long</option>
                                    <option value="Đồng Tháp - Tiền Giang">Đồng Tháp / Tiền Giang</option>
                                    <option value="Các tỉnh Miền Tây khác">Các tỉnh Miền Tây khác</option>
                                    <option value="Toàn quốc">Toàn quốc (Theo thỏa thuận)</option>
                                </select>
                            </div>
                        </div>

                        <!-- Add-ons Selection -->
                        <div>
                            <label class="block font-headline text-xs font-bold text-slate-300 mb-3">Tùy chọn nhân sự &amp; thiết bị bổ sung (Add-ons):</label>
                            <div class="space-y-3">
                                <label class="flex items-center justify-between p-4 rounded-2xl bg-slate-900/80 border border-slate-800 cursor-pointer hover:border-slate-700 transition-colors">
                                    <div class="flex items-center gap-3">
                                        <input type="checkbox" x-model="addons.dop" class="w-4 h-4 rounded text-amber-400 focus:ring-amber-400 border-slate-700 bg-slate-800">
                                        <div>
                                            <p class="font-headline text-xs font-bold text-white">Giám đốc hình ảnh (DOP / Đạo diễn nghệ thuật)</p>
                                            <p class="text-[11px] text-slate-400">Chỉ đạo góc máy, bối cảnh và ánh sáng nâng tầm thẩm mỹ</p>
                                        </div>
                                    </div>
                                    <span class="text-xs font-mono font-bold text-amber-400">+3.000.000 đ</span>
                                </label>

                                <label class="flex items-center justify-between p-4 rounded-2xl bg-slate-900/80 border border-slate-800 cursor-pointer hover:border-slate-700 transition-colors">
                                    <div class="flex items-center gap-3">
                                        <input type="checkbox" x-model="addons.flycam" class="w-4 h-4 rounded text-amber-400 focus:ring-amber-400 border-slate-700 bg-slate-800">
                                        <div>
                                            <p class="font-headline text-xs font-bold text-white">Pilot Flycam 4K / FPV Thể Thao Tốc Độ Cao</p>
                                            <p class="text-[11px] text-slate-400">Góc quay flycam trên không và luồn lách kiến trúc</p>
                                        </div>
                                    </div>
                                    <span class="text-xs font-mono font-bold text-amber-400">+2.500.000 đ</span>
                                </label>

                                <label class="flex items-center justify-between p-4 rounded-2xl bg-slate-900/80 border border-slate-800 cursor-pointer hover:border-slate-700 transition-colors">
                                    <div class="flex items-center gap-3">
                                        <input type="checkbox" x-model="addons.photo" class="w-4 h-4 rounded text-amber-400 focus:ring-amber-400 border-slate-700 bg-slate-800">
                                        <div>
                                            <p class="font-headline text-xs font-bold text-white">Thợ chụp ảnh sự kiện + Bàn giao ảnh tại chỗ</p>
                                            <p class="text-[11px] text-slate-400">Chụp khoảnh khắc, chỉnh màu nhanh trả ảnh ngay trong sự kiện</p>
                                        </div>
                                    </div>
                                    <span class="text-xs font-mono font-bold text-amber-400">+2.000.000 đ</span>
                                </label>

                                <label class="flex items-center justify-between p-4 rounded-2xl bg-slate-900/80 border border-slate-800 cursor-pointer hover:border-slate-700 transition-colors">
                                    <div class="flex items-center gap-3">
                                        <input type="checkbox" x-model="addons.mc" class="w-4 h-4 rounded text-amber-400 focus:ring-amber-400 border-slate-700 bg-slate-800">
                                        <div>
                                            <p class="font-headline text-xs font-bold text-white">MC Dẫn Chương Trình Song Ngữ (Anh - Việt)</p>
                                            <p class="text-[11px] text-slate-400">MC ngoại hình sáng, chuẩn phong cách hội nghị doanh nghiệp</p>
                                        </div>
                                    </div>
                                    <span class="text-xs font-mono font-bold text-amber-400">+3.500.000 đ</span>
                                </label>

                                <label class="flex items-center justify-between p-4 rounded-2xl bg-slate-900/80 border border-slate-800 cursor-pointer hover:border-slate-700 transition-colors">
                                    <div class="flex items-center gap-3">
                                        <input type="checkbox" x-model="addons.lighting" class="w-4 h-4 rounded text-amber-400 focus:ring-amber-400 border-slate-700 bg-slate-800">
                                        <div>
                                            <p class="font-headline text-xs font-bold text-white">Hệ thống Ánh Sáng Sân Khấu &amp; Trợ Lý Quay</p>
                                            <p class="text-[11px] text-slate-400">Setup hệ thống đèn trường quay chuyên sâu cho bối cảnh tối</p>
                                        </div>
                                    </div>
                                    <span class="text-xs font-mono font-bold text-amber-400">+1.500.000 đ</span>
                                </label>
                            </div>
                        </div>

                        <!-- Notes -->
                        <div>
                            <label class="block font-headline text-xs font-bold text-slate-300 mb-2">Ghi chú yêu cầu đặc thù (nếu có)</label>
                            <textarea x-model="notes" rows="3" placeholder="Ví dụ: Cần quay phỏng vấn 3 khách VIP, sự kiện diễn ra ngoài trời lúc 16h..."
                                class="w-full px-4 py-3 rounded-2xl bg-slate-900 border border-slate-700 text-white text-xs focus:ring-2 focus:ring-amber-400 focus:outline-none"></textarea>
                        </div>
                    </div>

                    <!-- Right: Contact Info & Calculation Summary (5 cols) -->
                    <div class="lg:col-span-5 p-8 rounded-3xl bg-[#080C16] border border-amber-400/40 shadow-xl flex flex-col gap-5">
                        <span class="font-mono text-xs text-amber-400 font-bold uppercase tracking-wider">TÓM TẮT DỰ TOÁN LỊCH TRÌNH</span>
                        
                        <div class="space-y-2.5 pb-4 border-b border-slate-800 text-xs">
                            <div class="flex justify-between text-slate-300">
                                <span>Gói đã chọn:</span>
                                <span class="font-bold text-white" x-text="selectedPackage === 'half_day' ? 'Nửa Ngày (4h)' : (selectedPackage === 'full_day' ? 'Trọn Ngày (8h)' : 'Livestream Sự Kiện')"></span>
                            </div>
                            <div class="flex justify-between text-slate-300">
                                <span>Địa điểm:</span>
                                <span class="font-bold text-white" x-text="eventLocation"></span>
                            </div>
                            <div class="flex justify-between text-slate-300">
                                <span>Ngày tác nghiệp:</span>
                                <span class="font-bold text-amber-400" x-text="eventDate || 'Chưa chọn'"></span>
                            </div>
                        </div>

                        <div class="text-center py-2">
                            <span class="text-[11px] font-mono text-slate-400 uppercase">DỰ TOÁN CHI PHÍ SƠ BỘ</span>
                            <div class="font-headline text-3xl font-black text-transparent bg-clip-text bg-gradient-to-r from-amber-400 via-orange-400 to-amber-200 mt-1" x-text="calculateTotal()"></div>
                            <p class="text-[11px] text-slate-400 mt-1">Đã bao gồm chi phí di chuyển nội thành và thiết bị phụ trợ.</p>
                        </div>

                        <!-- Customer Info -->
                        <div class="space-y-3 pt-4 border-t border-slate-800">
                            <div>
                                <label class="block font-headline text-xs font-bold text-slate-300 mb-1">Họ tên người liên hệ <span class="text-amber-400">*</span></label>
                                <input type="text" name="fullname" x-model="fullName" required placeholder="Nguyễn Văn A" 
                                    class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-white text-xs focus:ring-2 focus:ring-amber-400 focus:outline-none">
                            </div>
                            <div>
                                <label class="block font-headline text-xs font-bold text-slate-300 mb-1">Số điện thoại / Zalo <span class="text-amber-400">*</span></label>
                                <input type="tel" name="phone" x-model="phone" required placeholder="0908 xxx xxx" 
                                    class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-white text-xs focus:ring-2 focus:ring-amber-400 focus:outline-none">
                            </div>
                            <div>
                                <label class="block font-headline text-xs font-bold text-slate-300 mb-1">Email nhận xác nhận (tùy chọn)</label>
                                <input type="email" name="email" x-model="email" placeholder="congty@gmail.com" 
                                    class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-white text-xs focus:ring-2 focus:ring-amber-400 focus:outline-none">
                            </div>
                        </div>

                        <button type="submit" 
                            class="mt-2 w-full py-3.5 rounded-xl bg-amber-400 hover:bg-amber-300 text-slate-950 font-headline text-xs font-extrabold shadow-lg shadow-amber-400/20 transition-all flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined text-[18px]">lock_clock</span>
                            <span>Giữ Lịch Tác Nghiệp &amp; Khóa Ekip</span>
                        </button>

                        <div class="flex items-center justify-center gap-1.5 text-[11px] font-mono text-slate-400">
                            <span class="material-symbols-outlined text-amber-400 text-[14px]">verified</span>
                            <span>Không yêu cầu đặt cọc trước khi trao đổi trực tiếp</span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- SECTION 4: 4 COMMITMENTS -->
    <section class="py-12 lg:py-16 bg-[#080C16] border-b border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-2xl mx-auto text-center mb-10 lg:mb-12">
                <span class="font-mono text-xs font-bold text-amber-400 uppercase">CAM KẾT TÁC NGHIỆP</span>
                <h2 class="font-headline text-2xl sm:text-3xl font-extrabold text-white mt-1">4 Trụ Cột Đảm Bảo An Toàn Cho Sự Kiện</h2>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="p-6 rounded-3xl bg-[#0F172A] border border-slate-800 flex flex-col gap-3">
                    <div class="w-12 h-12 rounded-2xl bg-amber-400/10 text-amber-400 flex items-center justify-center border border-amber-400/20">
                        <span class="material-symbols-outlined text-[24px]">alarm_on</span>
                    </div>
                    <h3 class="font-headline text-base font-bold text-white">Đúng Giờ Tuyệt Đối 100%</h3>
                    <p class="text-xs text-slate-400 leading-relaxed">Ekip luôn có mặt tại địa điểm trước 30-45 phút để test âm thanh, ánh sáng, góc máy và trao đổi kịch bản.</p>
                </div>

                <div class="p-6 rounded-3xl bg-[#0F172A] border border-slate-800 flex flex-col gap-3">
                    <div class="w-12 h-12 rounded-2xl bg-amber-400/10 text-amber-400 flex items-center justify-center border border-amber-400/20">
                        <span class="material-symbols-outlined text-[24px]">videocam</span>
                    </div>
                    <h3 class="font-headline text-base font-bold text-white">Thiết Bị Dự Phòng Sẵn Sàng</h3>
                    <p class="text-xs text-slate-400 leading-relaxed">Luôn mang theo thân máy backup, thẻ nhớ tốc độ cao V90, pin dự phòng không giới hạn và mic phụ trợ.</p>
                </div>

                <div class="p-6 rounded-3xl bg-[#0F172A] border border-slate-800 flex flex-col gap-3">
                    <div class="w-12 h-12 rounded-2xl bg-amber-400/10 text-amber-400 flex items-center justify-center border border-amber-400/20">
                        <span class="material-symbols-outlined text-[24px]">cloud_sync</span>
                    </div>
                    <h3 class="font-headline text-base font-bold text-white">Bảo Hiểm Dữ Liệu 2 Bản Cứng</h3>
                    <p class="text-xs text-slate-400 leading-relaxed">Ngay sau buổi tác nghiệp, dữ liệu footage được sao chép lập tức vào 2 ổ cứng SSD riêng biệt chống mất mát.</p>
                </div>

                <div class="p-6 rounded-3xl bg-[#0F172A] border border-slate-800 flex flex-col gap-3">
                    <div class="w-12 h-12 rounded-2xl bg-amber-400/10 text-amber-400 flex items-center justify-center border border-amber-400/20">
                        <span class="material-symbols-outlined text-[24px]">speed</span>
                    </div>
                    <h3 class="font-headline text-base font-bold text-white">Dựng Nhanh Highlight 24H</h3>
                    <p class="text-xs text-slate-400 leading-relaxed">Đáp ứng nhu cầu truyền thông báo chí hoặc đăng mạng xã hội ngay sáng hôm sau theo yêu cầu khẩn cấp.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 5: CTA BAND -->
    <section class="py-12 lg:py-16 bg-gradient-to-br from-[#0B132B] via-[#0F172A] to-[#080C16] relative overflow-hidden">
        <div class="absolute inset-0 bg-dot-grid-subtle opacity-15 pointer-events-none"></div>
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-amber-400/10 text-amber-400 font-mono text-xs font-bold mb-4">
                <span>HOTLINE KHẨN CẤP ĐIỀU ĐỘNG EKIP</span>
            </div>
            <h2 class="font-headline text-3xl sm:text-4xl font-extrabold text-white mb-4">
                Cần Điều Động Ekip Gấp Trong Vòng 4 - 12 Giờ Tới?
            </h2>
            <p class="font-body text-slate-300 text-sm sm:text-base max-w-2xl mx-auto leading-relaxed mb-8">
                Đừng ngần ngại gọi trực tiếp số điện thoại trực ban sản xuất. Ekip phản ứng nhanh của chúng tôi luôn trong tư thế sẵn sàng lên đường tác nghiệp.
            </p>
            <div class="flex flex-wrap items-center justify-center gap-4">
                <a href="tel:0947888365" 
                    class="px-8 py-4 rounded-2xl bg-amber-400 hover:bg-amber-300 text-slate-950 font-headline text-sm font-extrabold shadow-xl shadow-amber-400/20 transition-all flex items-center gap-2">
                    <span class="material-symbols-outlined text-[22px]">phone_in_talk</span>
                    <span>Gọi Ngay Hotline 24/7: 0947.888.365</span>
                </a>
                <a href="https://zalo.me/0947888365" target="_blank" rel="noopener noreferrer" 
                    class="px-8 py-4 rounded-2xl bg-slate-900/90 hover:bg-slate-800 text-white font-headline text-sm font-bold border border-slate-700 transition-all flex items-center gap-2">
                    <span class="material-symbols-outlined text-[22px] text-sky-400">chat</span>
                    <span>Nhắn Zalo Nhận Báo Giá Hỏa Tốc</span>
                </a>
            </div>
        </div>
    </section>

</div>

<!-- SCHEMA JSON-LD -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "Service",
    "name": "Booking Ekip Quay Phim & Livestream Sự Kiện - Truyền Thông Cửu Long",
    "description": "Dịch vụ cho thuê ekip quay phim điện ảnh 4K, livestream sự kiện đa máy, bay flycam tác nghiệp hỏa tốc.",
    "provider": {
        "@type": "Organization",
        "name": "Truyền Thông Cửu Long",
        "url": "{{ url('/') }}",
        "telephone": "0947888365"
    },
    "offers": [
        {
            "@type": "Offer",
            "name": "Gói Nửa Ngày (Half-Day)",
            "price": "4500000",
            "priceCurrency": "VND"
        },
        {
            "@type": "Offer",
            "name": "Gói Trọn Ngày (Full-Day)",
            "price": "8500000",
            "priceCurrency": "VND"
        },
        {
            "@type": "Offer",
            "name": "Gói Livestream Sự Kiện",
            "price": "15000000",
            "priceCurrency": "VND"
        }
    ]
}
</script>
@endsection
