<!-- ==================== HOSPITAL & CLINIC HEALTHCARE (CAREPLUS) ==================== -->
<div class="w-full bg-[#f8fafc] text-slate-800 font-sans" x-data="{
    selectedDept: 'noitongquat',
    bookingSuccess: false
}">

    <!-- Top Medical Bar -->
    <div class="bg-[#0369a1] text-white text-xs py-2 px-4 sm:px-8 flex items-center justify-between">
        <div class="flex items-center gap-2">
            <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
            <span>BỆNH VIỆN ĐA KHOA QUỐC TẾ CAREPLUS • ĐẠT TIÊU CHUẨN CHẤT LƯỢNG Y TẾ JCI</span>
        </div>
        <div class="flex items-center gap-6 text-[11px] text-sky-100">
            <span>Cấp cứu 24/7: <strong class="text-white font-mono">0939 523 557</strong></span>
            <span class="hidden sm:inline">Khám BHYT & Bảo hiểm bảo lãnh tư nhân</span>
        </div>
    </div>

    <!-- Header Navigation -->
    <header class="bg-white border-b border-slate-200 sticky top-0 z-30 shadow-xs">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-sky-600 text-white flex items-center justify-center font-black text-xl shadow-md">
                    ✚
                </div>
                <div class="flex flex-col">
                    <span class="text-xl font-black text-slate-900 tracking-tight">CarePlus</span>
                    <span class="text-[9px] font-bold text-sky-600 tracking-widest uppercase">INTERNATIONAL HOSPITAL</span>
                </div>
            </div>

            <nav class="hidden lg:flex items-center gap-7 text-xs font-bold text-slate-700 uppercase">
                <a href="#hero" class="text-sky-600">Trang chủ</a>
                <a href="#departments" class="hover:text-sky-600 transition-colors">Chuyên khoa</a>
                <a href="#packages" class="hover:text-sky-600 transition-colors">Gói khám sức khỏe</a>
                <a href="#doctors" class="hover:text-sky-600 transition-colors">Đội ngũ bác sĩ</a>
                <a href="#booking" class="hover:text-sky-600 transition-colors">Đặt lịch khám</a>
            </nav>

            <a href="#booking" class="px-5 py-2.5 rounded-full bg-sky-600 hover:bg-sky-700 text-white font-bold text-xs uppercase tracking-wider shadow-sm transition-all flex items-center gap-1.5">
                <span class="material-symbols-outlined text-[16px]">calendar_month</span>
                <span>Đặt Lịch Khám Online</span>
            </a>
        </div>
    </header>

    <!-- Medical Hero Banner -->
    <section id="hero" class="relative bg-gradient-to-r from-sky-950 via-slate-900 to-sky-950 text-white py-16 lg:py-24 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                <div class="lg:col-span-7 space-y-6">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-sky-500/20 border border-sky-400/40 text-sky-300 text-xs font-bold font-mono">
                        <span>Y ĐỨC TẬN TÂM • KỸ THUẬT TIÊN TIẾN</span>
                    </div>

                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black text-white leading-tight">
                        Chăm Sóc Sức Khỏe <br><span class="text-sky-400">Chuẩn Mực & Toàn Diện</span>
                    </h1>

                    <p class="text-xs sm:text-sm text-slate-300 leading-relaxed max-w-xl">
                        Hệ thống phòng mổ áp lực dương vô khuẩn, máy chụp cộng hưởng từ MRI 3.0 Tesla và đội ngũ giáo sư, tiến sĩ đầu ngành trực tiếp thăm khám và điều trị.
                    </p>

                    <div class="flex flex-wrap items-center gap-4 pt-2">
                        <a href="#booking" class="px-7 py-3 rounded-full bg-sky-500 hover:bg-sky-600 text-white font-extrabold text-xs uppercase tracking-wider shadow-lg shadow-sky-500/30 transition-all">
                            Đăng Ký Khám Bệnh Ngay
                        </a>
                        <a href="#packages" class="px-6 py-3 rounded-full bg-white/10 hover:bg-white/20 text-white border border-white/20 font-bold text-xs uppercase tracking-wider transition-all">
                            Xem Gói Khám Tổng Quát
                        </a>
                    </div>

                    <div class="pt-6 border-t border-sky-800/80 grid grid-cols-3 gap-3">
                        <div>
                            <div class="text-2xl font-black text-sky-400 font-mono">100+</div>
                            <div class="text-[11px] text-slate-300">Bác sĩ chuyên khoa II</div>
                        </div>
                        <div>
                            <div class="text-2xl font-black text-white font-mono">30 Phút</div>
                            <div class="text-[11px] text-slate-300">Trả kết quả xét nghiệm</div>
                        </div>
                        <div>
                            <div class="text-2xl font-black text-emerald-400 font-mono">99.6%</div>
                            <div class="text-[11px] text-slate-300">Bệnh nhân hài lòng</div>
                        </div>
                    </div>
                </div>

                <!-- Right visual -->
                <div class="lg:col-span-5 relative">
                    <img src="https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?auto=format&fit=crop&w=800&q=80" alt="Hospital Room" class="w-full rounded-3xl shadow-2xl border-4 border-white/10 aspect-4/3 object-cover">
                </div>
            </div>
        </div>
    </section>

    <!-- Medical Packages Grid -->
    <section id="packages" class="py-16 bg-white border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-xl mx-auto mb-10">
                <span class="text-xs font-bold text-sky-600 uppercase tracking-widest font-mono">HEALTH PACKAGES</span>
                <h2 class="text-2xl sm:text-3xl font-black text-slate-900 mt-1">Gói Khám Sức Khỏe Định Kỳ</h2>
                <p class="text-xs sm:text-sm text-slate-500 mt-1">Đầy đủ xét nghiệm máu, siêu âm màu, nội soi không đau và tư vấn dinh dưỡng 1:1.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Package 1 -->
                <div class="bg-slate-50 rounded-3xl p-6 border border-slate-200 space-y-4 hover:shadow-lg transition-all flex flex-col justify-between">
                    <div>
                        <span class="text-xs font-bold text-sky-600 bg-sky-100 px-3 py-1 rounded-full">TIÊU CHUẨN</span>
                        <h3 class="text-lg font-bold text-slate-900 mt-3">Gói Khám Tổng Quát Cơ Bản</h3>
                        <p class="text-xs text-slate-500 mt-1">Kiểm tra chức năng gan, thận, đường huyết, mỡ máu, tim mạch và chụp X-quang phổi.</p>
                        <div class="my-4 text-2xl font-black text-slate-900 font-mono">1.850.000 VNĐ</div>
                        <ul class="text-xs text-slate-600 space-y-1.5 pt-2 border-t border-slate-200">
                            <li>✓ 18 danh mục khám lâm sàng & cận lâm sàng</li>
                            <li>✓ Tư vấn phác đồ phòng bệnh cùng Bác sĩ CKI</li>
                            <li>✓ Hồ sơ bệnh án điện tử lưu trữ trọn đời</li>
                        </ul>
                    </div>
                    <a href="#booking" class="w-full py-2.5 rounded-xl bg-sky-600 hover:bg-sky-700 text-white font-bold text-xs text-center transition-all block">
                        Đăng Ký Gói Này
                    </a>
                </div>

                <!-- Package 2: VIP -->
                <div class="bg-gradient-to-b from-sky-50 to-white rounded-3xl p-6 border-2 border-sky-500 space-y-4 shadow-md flex flex-col justify-between relative">
                    <span class="absolute top-4 right-4 bg-sky-600 text-white text-[10px] font-bold px-3 py-1 rounded-full">ĐƯỢC CHỌN NHIỀU</span>
                    <div>
                        <span class="text-xs font-bold text-emerald-700 bg-emerald-100 px-3 py-1 rounded-full">NÂNG CAO VIP</span>
                        <h3 class="text-lg font-bold text-slate-900 mt-3">Tầm Soát Toàn Diện Chuyên Sâu</h3>
                        <p class="text-xs text-slate-500 mt-1">Bao gồm toàn bộ gói cơ bản + Tầm soát sớm dấu ấn ung thư, nội soi tiêu hóa và đo loãng xương.</p>
                        <div class="my-4 text-2xl font-black text-sky-600 font-mono">4.950.000 VNĐ</div>
                        <ul class="text-xs text-slate-600 space-y-1.5 pt-2 border-t border-slate-200">
                            <li>✓ 32 danh mục kiểm tra chuyên sâu</li>
                            <li>✓ Bác sĩ Trưởng khoa trực tiếp đọc kết quả</li>
                            <li>✓ Ăn nhẹ dinh dưỡng tại phòng chờ VIP</li>
                        </ul>
                    </div>
                    <a href="#booking" class="w-full py-2.5 rounded-xl bg-sky-600 hover:bg-sky-700 text-white font-bold text-xs text-center transition-all block">
                        Đăng Ký Gói Này
                    </a>
                </div>

                <!-- Package 3 -->
                <div class="bg-slate-50 rounded-3xl p-6 border border-slate-200 space-y-4 hover:shadow-lg transition-all flex flex-col justify-between">
                    <div>
                        <span class="text-xs font-bold text-rose-700 bg-rose-100 px-3 py-1 rounded-full">TIM MẠCH & ĐỘT QUỴ</span>
                        <h3 class="text-lg font-bold text-slate-900 mt-3">Tầm Soát Nguy Cơ Đột Quỵ</h3>
                        <p class="text-xs text-slate-500 mt-1">Chụp cộng hưởng từ MRI sọ não, mạch máu não và siêu âm doppler động mạch cảnh.</p>
                        <div class="my-4 text-2xl font-black text-slate-900 font-mono">6.800.000 VNĐ</div>
                        <ul class="text-xs text-slate-600 space-y-1.5 pt-2 border-t border-slate-200">
                            <li>✓ Phát hiện sớm phình mạch & hẹp động mạch</li>
                            <li>✓ Đánh giá nguy cơ tắc nghẽn nhồi máu não</li>
                            <li>✓ Đo điện tâm đồ gắng sức 24H</li>
                        </ul>
                    </div>
                    <a href="#booking" class="w-full py-2.5 rounded-xl bg-sky-600 hover:bg-sky-700 text-white font-bold text-xs text-center transition-all block">
                        Đăng Ký Gói Này
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Booking Form Section -->
    <section id="booking" class="py-16 bg-slate-900 text-white">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 text-center space-y-6">
            <span class="text-xs font-bold text-sky-400 uppercase tracking-widest font-mono">APPOINTMENT SCHEDULING</span>
            <h2 class="text-2xl sm:text-3xl font-black">Đặt Lịch Hẹn Khám Bệnh Ưu Tiên</h2>
            <p class="text-xs sm:text-sm text-slate-400">
                Đặt lịch trực tuyến để nhận mã số khám ưu tiên, không mất thời gian bốc số xếp hàng tại bệnh viện.
            </p>

            <form class="bg-slate-800 p-8 rounded-3xl border border-slate-700 text-left space-y-4">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-1">Họ tên Bệnh nhân *</label>
                        <input type="text" placeholder="Nguyễn Văn A" class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-xs text-white focus:border-sky-400 outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-1">Số điện thoại *</label>
                        <input type="tel" placeholder="0939 523 557" class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-xs text-white focus:border-sky-400 outline-none">
                    </div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-1">Chuyên khoa thăm khám</label>
                        <select class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-xs text-white focus:border-sky-400 outline-none">
                            <option>Nội Tổng Quát</option>
                            <option>Tim Mạch Can Thiệp</option>
                            <option>Sản Phụ Khoa</option>
                            <option>Nhi Khoa & Tiêm Chủng</option>
                            <option>Tai Mũi Họng</option>
                            <option>Da Liễu & Thẩm Mỹ Y Khoa</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-1">Ngày mong muốn khám</label>
                        <input type="date" value="2026-10-02" class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-xs text-white focus:border-sky-400 outline-none">
                    </div>
                </div>
                <button type="button" onclick="alert('Đã tiếp nhận lịch hẹn khám! Nhân viên điều dưỡng CarePlus sẽ gửi mã số khám qua tin nhắn SMS.')" class="w-full py-3.5 rounded-xl bg-sky-500 hover:bg-sky-600 text-white font-bold text-xs uppercase tracking-wider transition-all">
                    Xác Nhận Đặt Lịch Khám Ưu Tiên
                </button>
            </form>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-black text-slate-500 py-6 text-center text-xs border-t border-slate-900">
        <p>© 2026 CarePlus International Hospital. Developed by Truyền Thông Cửu Long.</p>
    </footer>

</div>
