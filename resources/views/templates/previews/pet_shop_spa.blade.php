<!-- ==================== PET SHOP, SPA & HOTEL (PETPARADISE) ==================== -->
<div class="w-full bg-[#fffaf5] text-slate-800 font-sans" x-data="{
    petType: 'dog',
    spaWeight: 'under5',
    cartCount: 2,
    bookingSuccess: false
}">

    <!-- Top Announcement -->
    <div class="bg-amber-500 text-slate-950 text-xs font-bold py-2 px-4 sm:px-8 flex items-center justify-between">
        <div class="flex items-center gap-2">
            <span>🐾</span>
            <span>ƯU ĐÃI THÀNH VIÊN: Giảm 30% dịch vụ Spa & Tắm sấy cho Boss lần đầu tiên ghé PetParadise!</span>
        </div>
        <div class="hidden sm:flex items-center gap-6 text-[11px]">
            <span>Hotline Cấp Cứu 24/7: <strong>0939.363.262</strong></span>
            <span>Giao thức ăn nhanh 2H tại Cần Thơ</span>
        </div>
    </div>

    <!-- Header Navigation -->
    <header class="bg-white border-b border-amber-200/60 sticky top-0 z-30 shadow-2xs">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between gap-4">
            <!-- Brand Logo -->
            <div class="flex items-center gap-2.5 shrink-0">
                <div class="w-10 h-10 rounded-2xl bg-gradient-to-tr from-amber-400 to-orange-500 flex items-center justify-center text-white text-xl shadow-md">
                    🐾
                </div>
                <div class="flex flex-col">
                    <span class="text-xl font-extrabold tracking-tight text-slate-900">PetParadise</span>
                    <span class="text-[9px] font-bold text-amber-600 tracking-wider uppercase">CỬA HÀNG & SPA CHÓ MÈO</span>
                </div>
            </div>

            <!-- Search input bar -->
            <div class="hidden md:flex flex-1 max-w-sm mx-4">
                <div class="relative w-full">
                    <input type="text" placeholder="Tìm thức ăn hạt, pate, phụ kiện cho chó mèo..." class="w-full pl-4 pr-10 py-2.5 rounded-full bg-amber-50/50 border border-amber-200 text-xs focus:bg-white focus:outline-none focus:border-amber-500">
                    <span class="material-symbols-outlined absolute right-3 top-2.5 text-slate-400 text-[18px]">search</span>
                </div>
            </div>

            <!-- Nav Links & Cart -->
            <div class="flex items-center gap-4 shrink-0">
                <nav class="hidden lg:flex items-center gap-6 text-xs font-bold text-slate-700 uppercase">
                    <a href="#hero" class="text-amber-600">Trang chủ</a>
                    <a href="#spa" class="hover:text-amber-600 transition-colors">Dịch vụ Spa</a>
                    <a href="#hotel" class="hover:text-amber-600 transition-colors">Khách sạn thú cưng</a>
                    <a href="#products" class="hover:text-amber-600 transition-colors">Thực phẩm & Đồ chơi</a>
                </nav>

                <div class="flex items-center gap-2.5">
                    <a href="#products" class="relative p-2 rounded-full bg-amber-50 text-slate-700 hover:text-amber-600">
                        <span class="material-symbols-outlined text-[20px]">shopping_bag</span>
                        <span class="absolute -top-1 -right-1 w-4 h-4 rounded-full bg-rose-500 text-white text-[10px] font-bold flex items-center justify-center" x-text="cartCount"></span>
                    </a>
                    <a href="#booking" class="px-5 py-2.5 rounded-full bg-gradient-to-r from-amber-500 to-orange-500 text-white font-extrabold text-xs shadow-md shadow-amber-500/20 transition-all">
                        Đặt Lịch Spa Ngay
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Playful Hero Section -->
    <section id="hero" class="relative bg-gradient-to-b from-amber-50/80 via-white to-amber-50/40 py-12 lg:py-20 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                <div class="lg:col-span-6 space-y-6">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-amber-100 text-amber-800 text-xs font-bold">
                        <span>🐶🐱 HỆ THỐNG CHĂM SÓC THÚ CƯNG 5 SAO</span>
                    </div>

                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black text-slate-900 leading-tight">
                        Nuông Chiều Thú Cưng <br><span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-500 to-orange-500">Như Thành Viên Gia Đình</span>
                    </h1>

                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed max-w-lg">
                        Dịch vụ tắm sấy spa thư giãn, cắt tỉa lông tạo kiểu nghệ thuật và khách sạn lưu trú máy lạnh riêng biệt chuẩn y khoa thú y.
                    </p>

                    <div class="flex flex-wrap items-center gap-4 pt-2">
                        <a href="#booking" class="px-7 py-3 rounded-full bg-gradient-to-r from-amber-500 to-orange-500 text-white font-black text-xs uppercase tracking-wider shadow-lg shadow-orange-500/20 hover:scale-105 transition-all">
                            Đặt Lịch Tắm Spa & Tỉa Lông
                        </a>
                        <a href="#products" class="px-6 py-3 rounded-full bg-white border border-amber-200 text-slate-700 font-bold text-xs uppercase tracking-wider hover:bg-amber-50 transition-all">
                            Mua Hạt & Dinh Dưỡng
                        </a>
                    </div>

                    <div class="pt-6 border-t border-amber-200/60 grid grid-cols-3 gap-3 text-center">
                        <div class="bg-white p-3 rounded-2xl border border-amber-100 shadow-2xs">
                            <span class="block text-xl font-black text-amber-500 font-mono">15,000+</span>
                            <span class="text-[10px] text-slate-500">Boss Đã Spa Hài Lòng</span>
                        </div>
                        <div class="bg-white p-3 rounded-2xl border border-amber-100 shadow-2xs">
                            <span class="block text-xl font-black text-emerald-500 font-mono">100%</span>
                            <span class="text-[10px] text-slate-500">Sữa Tắm Hữu Cơ Dịu Nhẹ</span>
                        </div>
                        <div class="bg-white p-3 rounded-2xl border border-amber-100 shadow-2xs">
                            <span class="block text-xl font-black text-rose-500 font-mono">24/7</span>
                            <span class="text-[10px] text-slate-500">Camera Phòng Khách Sạn</span>
                        </div>
                    </div>
                </div>

                <!-- Right visual: Adorable Pets -->
                <div class="lg:col-span-6 relative">
                    <div class="relative rounded-3xl overflow-hidden shadow-2xl border-4 border-white bg-slate-900 aspect-4/3">
                        <img src="https://images.unsplash.com/photo-1543466835-00a7907e9de1?auto=format&fit=crop&w=1000&q=80" alt="Happy pets" class="w-full h-full object-cover">
                        <div class="absolute bottom-4 left-4 bg-white/95 backdrop-blur-md p-3.5 rounded-2xl border border-amber-200 shadow-lg flex items-center gap-3">
                            <span class="text-2xl">✂️</span>
                            <div>
                                <span class="block text-xs font-black text-slate-900">Grooming Master</span>
                                <span class="text-[10px] text-slate-500">Thợ cắt tỉa đạt chứng chỉ quốc tế</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Spa Packages Grid -->
    <section id="spa" class="py-16 bg-white border-b border-amber-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-xl mx-auto mb-10">
                <span class="text-xs font-bold text-amber-500 uppercase tracking-widest font-mono">SPA SERVICES</span>
                <h2 class="text-2xl sm:text-3xl font-black text-slate-900 mt-1">Dịch Vụ Spa Chăm Sóc Toàn Diện</h2>
                <p class="text-xs sm:text-sm text-slate-500 mt-1">Quy trình vệ sinh 7 bước khép kín với dầu tắm thảo dược dưỡng lông bóng mượt.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Package 1 -->
                <div class="bg-[#fffaf5] p-6 rounded-3xl border border-amber-200 space-y-4 hover:shadow-lg transition-all">
                    <div class="w-12 h-12 rounded-2xl bg-amber-100 text-amber-600 flex items-center justify-center text-2xl font-bold">
                        🛁
                    </div>
                    <h3 class="text-lg font-black text-slate-900">Gói Tắm Sấy Vệ Sinh 7 Bước</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">
                        Bao gồm cạo lông bàn chân, cạo lông bụng, cắt mài móng, nhổ lông tai, vệ sinh tuyến hôi, tắm thảo dược 2 lần và sấy khô chải tơi lông.
                    </p>
                    <div class="pt-2 border-t border-amber-200/60 flex items-center justify-between">
                        <span class="text-sm font-black font-mono text-amber-600">Từ 150.000 VNĐ</span>
                        <a href="#booking" class="px-4 py-2 rounded-xl bg-amber-400 text-slate-950 font-bold text-xs">Đặt Lịch</a>
                    </div>
                </div>

                <!-- Package 2: Featured -->
                <div class="bg-gradient-to-b from-amber-50 to-orange-50 p-6 rounded-3xl border-2 border-orange-400 space-y-4 shadow-md relative">
                    <span class="absolute top-4 right-4 px-2.5 py-0.5 rounded-full bg-orange-500 text-white text-[10px] font-bold">PHỔ BIẾN NHẤT</span>
                    <div class="w-12 h-12 rounded-2xl bg-orange-100 text-orange-600 flex items-center justify-center text-2xl font-bold">
                        ✂️
                    </div>
                    <h3 class="text-lg font-black text-slate-900">Cắt Tỉa Lông Tạo Kiểu Nghệ Thuật</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">
                        Tạo kiểu phong cách Hàn Quốc/Nhật Bản cho Poodle, Phốc Sóc, Bichon, mèo Anh lông dài. Tư vấn dáng tỉa che khuyết điểm khuôn mặt.
                    </p>
                    <div class="pt-2 border-t border-amber-200/60 flex items-center justify-between">
                        <span class="text-sm font-black font-mono text-orange-600">Từ 350.000 VNĐ</span>
                        <a href="#booking" class="px-4 py-2 rounded-xl bg-orange-500 text-white font-bold text-xs">Đặt Lịch</a>
                    </div>
                </div>

                <!-- Package 3 -->
                <div class="bg-[#fffaf5] p-6 rounded-3xl border border-amber-200 space-y-4 hover:shadow-lg transition-all">
                    <div class="w-12 h-12 rounded-2xl bg-amber-100 text-amber-600 flex items-center justify-center text-2xl font-bold">
                        🏨
                    </div>
                    <h3 class="text-lg font-black text-slate-900">Khách Sạn Lưu Trú Cho Thú Cưng</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">
                        Phòng riêng điều hòa 24/7, có đồ chơi vận động, chế độ ăn theo yêu cầu của ba mẹ. Cung cấp video camera xem bé trực tiếp qua điện thoại.
                    </p>
                    <div class="pt-2 border-t border-amber-200/60 flex items-center justify-between">
                        <span class="text-sm font-black font-mono text-amber-600">Từ 180.000 VNĐ/Ngày</span>
                        <a href="#booking" class="px-4 py-2 rounded-xl bg-amber-400 text-slate-950 font-bold text-xs">Đặt Lịch</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Booking Form Section -->
    <section id="booking" class="py-16 bg-slate-900 text-white">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 text-center space-y-6">
            <span class="text-xs font-bold text-amber-400 uppercase tracking-widest font-mono">ONLINE BOOKING</span>
            <h2 class="text-2xl sm:text-3xl font-black">Đặt Lịch Làm Đẹp Cho Bé Yêu</h2>
            <p class="text-xs sm:text-sm text-slate-400">
                Đặt lịch trước để PetParadise giữ chỗ và phục vụ chu đáo nhất mà bé không cần chờ đợi.
            </p>

            <form class="bg-slate-800 p-8 rounded-3xl border border-slate-700 text-left space-y-4">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-1">Tên Ba/Mẹ liên hệ *</label>
                        <input type="text" placeholder="Nguyễn Văn A" class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-xs text-white focus:border-amber-400 outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-1">Số điện thoại *</label>
                        <input type="tel" placeholder="0939.363.262" class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-xs text-white focus:border-amber-400 outline-none">
                    </div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-1">Bé là Chó hay Mèo?</label>
                        <select class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-xs text-white focus:border-amber-400 outline-none">
                            <option>Chó cưng</option>
                            <option>Mèo cưng</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-1">Dịch vụ mong muốn</label>
                        <select class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-xs text-white focus:border-amber-400 outline-none">
                            <option>Gói Tắm Sấy Vệ Sinh Toàn Diện</option>
                            <option>Gói Cắt Tỉa Lông Tạo Kiểu Đẹp</option>
                            <option>Gửi Khách Sạn Lưu Trú</option>
                        </select>
                    </div>
                </div>
                <button type="button" onclick="alert('Đã tiếp nhận lịch hẹn! PetParadise sẽ gọi xác nhận khung giờ trong 10 phút.')" class="w-full py-3.5 rounded-xl bg-amber-400 hover:bg-amber-500 text-slate-950 font-black text-xs uppercase tracking-wider transition-all">
                    Xác Nhận Giữ Chỗ Cho Bé
                </button>
            </form>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-black text-slate-500 py-6 text-center text-xs border-t border-slate-900">
        <p>© 2026 PetParadise Pet Care & Grooming. Developed by Truyền Thông Cửu Long.</p>
    </footer>

</div>
