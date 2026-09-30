<!-- ==================== INTERNATIONAL SCHOOL & ACADEMY (GLOBAL PATHWAY) ==================== -->
<div class="w-full bg-[#f8fafc] text-slate-800 font-sans" x-data="{
    programTab: 'tieuhoc',
    admitModal: false
}">

    <!-- Top Academic Announcement -->
    <div class="bg-[#1e3a8a] text-white text-xs py-2 px-4 sm:px-8 flex items-center justify-between border-b border-blue-900">
        <div class="flex items-center gap-2">
            <span class="px-2 py-0.5 rounded bg-rose-600 text-white font-extrabold text-[10px] tracking-wider uppercase">THÔNG BÁO TUYỂN SINH</span>
            <span class="text-xs text-blue-100">Khai mạc kỳ thi tuyển sinh niên khóa 2026 - 2027 • Học bổng Lãnh Đạo Tương Lai 50%</span>
        </div>
        <div class="flex items-center gap-6 text-[11px] text-blue-200">
            <span>Văn phòng tuyển sinh: <strong class="text-white">0939 523 557</strong></span>
            <a href="#admit-form" class="hover:text-white underline">Cổng thông tin phụ huynh</a>
        </div>
    </div>

    <!-- Header Navigation -->
    <header class="bg-white border-b border-slate-200 sticky top-0 z-30 shadow-xs">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 rounded-xl bg-[#1e3a8a] text-white flex items-center justify-center font-serif text-2xl font-black shadow-md border-2 border-amber-400">
                    <span class="material-symbols-outlined text-[28px]">school</span>
                </div>
                <div class="flex flex-col">
                    <span class="text-lg font-serif font-black tracking-tight text-slate-900 uppercase">Global Pathway</span>
                    <span class="text-[9px] font-bold text-rose-700 tracking-widest uppercase">TRƯỜNG SONG NGỮ QUỐC TẾ CAMBRIDGE & IB</span>
                </div>
            </div>

            <nav class="hidden lg:flex items-center gap-7 text-xs font-bold text-slate-700 uppercase tracking-wide">
                <a href="#hero" class="text-blue-800">Trang chủ</a>
                <a href="#programs" class="hover:text-blue-800 transition-colors">Các cấp học</a>
                <a href="#curriculum" class="hover:text-blue-800 transition-colors">Chứng chỉ quốc tế</a>
                <a href="#faculty" class="hover:text-blue-800 transition-colors">Đội ngũ giảng viên</a>
                <a href="#admit-form" class="hover:text-blue-800 transition-colors">Tuyển sinh</a>
            </nav>

            <a href="#admit-form" class="px-5 py-2.5 rounded-full bg-rose-600 hover:bg-rose-700 text-white font-bold text-xs uppercase tracking-wider shadow-sm transition-all">
                Đăng Ký Tham Quan Trường
            </a>
        </div>
    </header>

    <!-- Academic Hero Banner -->
    <section id="hero" class="relative bg-gradient-to-r from-slate-900 via-[#1e293b] to-slate-900 text-white py-16 lg:py-24 overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1523050854058-8df90110c9f1?auto=format&fit=crop&w=1800&q=80" alt="Global Pathway Campus" class="w-full h-full object-cover opacity-30">
            <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/60 to-transparent"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-2xl space-y-6">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-blue-500/20 border border-blue-400/40 text-blue-300 text-xs font-bold font-mono">
                    <span>KIẾN TẠO THẾ HỆ CÔNG DÂN TOÀN CẦU</span>
                </div>

                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-serif font-black text-white leading-tight">
                    Khởi Đầu Tương Lai Rực Rỡ <br><span class="text-amber-400">Với Nền Giáo Dục Chuẩn Quốc Tế</span>
                </h1>

                <p class="text-xs sm:text-sm text-slate-300 leading-relaxed font-normal">
                    Chương trình song ngữ tích hợp Cambridge International và Tú tài Quốc tế IB. Môi trường 100% tiếng Anh cùng giáo viên bản ngữ giàu nhiệt huyết và cơ sở vật chất chuẩn 5 sao.
                </p>

                <div class="flex flex-wrap items-center gap-4 pt-2">
                    <a href="#admit-form" class="px-7 py-3.5 rounded-full bg-rose-600 hover:bg-rose-700 text-white font-extrabold text-xs uppercase tracking-wider shadow-lg transition-all">
                        Đăng Ký Ngày Hội Open Day
                    </a>
                    <a href="#programs" class="px-6 py-3.5 rounded-full bg-white/10 hover:bg-white/20 text-white border border-white/20 font-bold text-xs uppercase tracking-wider transition-all">
                        Xem Biểu Phí & Lộ Trình
                    </a>
                </div>

                <!-- Academic Proof Counters -->
                <div class="pt-6 border-t border-slate-700 grid grid-cols-3 gap-3">
                    <div>
                        <div class="text-2xl font-black text-amber-400 font-mono">100%</div>
                        <div class="text-[11px] text-slate-300">Đậu Đại học Top thế giới</div>
                    </div>
                    <div>
                        <div class="text-2xl font-black text-white font-mono">8.0+</div>
                        <div class="text-[11px] text-slate-300">IELTS trung bình tốt nghiệp</div>
                    </div>
                    <div>
                        <div class="text-2xl font-black text-emerald-400 font-mono">1:8</div>
                        <div class="text-[11px] text-slate-300">Tỷ lệ Giáo viên / Học sinh</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Programs & Curriculum Tabs -->
    <section id="programs" class="py-16 bg-white border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-xl mx-auto mb-10">
                <span class="text-xs font-bold text-blue-800 uppercase tracking-widest font-mono">EDUCATIONAL PATHWAY</span>
                <h2 class="text-2xl sm:text-3xl font-serif font-black text-slate-900 mt-1">Lộ Trình Đào Tạo Liên Cấp</h2>
                <p class="text-xs sm:text-sm text-slate-500 mt-1">Hệ thống giáo dục từ Mầm non đến Trung học phổ thông, chuẩn bị hành trang vững vàng.</p>

                <div class="flex flex-wrap items-center justify-center gap-2 mt-6">
                    <button type="button" @click="programTab = 'mamnon'" :class="programTab === 'mamnon' ? 'bg-[#1e3a8a] text-white font-bold' : 'bg-slate-100 text-slate-700'" class="px-4 py-2 rounded-full text-xs transition-all">Mầm Non (18T - 5 Tuổi)</button>
                    <button type="button" @click="programTab = 'tieuhoc'" :class="programTab === 'tieuhoc' ? 'bg-[#1e3a8a] text-white font-bold' : 'bg-slate-100 text-slate-700'" class="px-4 py-2 rounded-full text-xs transition-all">Tiểu Học (Lớp 1 - 5)</button>
                    <button type="button" @click="programTab = 'trunghoc'" :class="programTab === 'trunghoc' ? 'bg-[#1e3a8a] text-white font-bold' : 'bg-slate-100 text-slate-700'" class="px-4 py-2 rounded-full text-xs transition-all">THCS & THPT (Lớp 6 - 12)</button>
                    <button type="button" @click="programTab = 'tutai'" :class="programTab === 'tutai' ? 'bg-[#1e3a8a] text-white font-bold' : 'bg-slate-100 text-slate-700'" class="px-4 py-2 rounded-full text-xs transition-all">Tú Tài Quốc Tế IB DP</button>
                </div>
            </div>

            <!-- Program Details Card -->
            <div class="bg-slate-50 rounded-3xl p-6 sm:p-10 border border-slate-200 grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                <div class="space-y-4">
                    <span class="inline-block px-3 py-1 rounded-full bg-blue-100 text-blue-800 text-xs font-bold font-mono">CAMBRIDGE PRIMARY CURRICULUM</span>
                    <h3 class="text-2xl font-serif font-black text-slate-900">Bậc Tiểu Học Song Ngữ Quốc Tế</h3>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                        Kết hợp hài hòa giữa Chương trình Giáo dục Quốc gia của Bộ GD&ĐT và Chương trình Quốc tế Cambridge Primary (Toán, Khoa học, Tiếng Anh). Giúp trẻ phát triển tư duy phản biện, kỹ năng tự lập và sự tự tin từ nhỏ.
                    </p>
                    <ul class="space-y-2 text-xs text-slate-700 pt-2">
                        <li class="flex items-center gap-2"><span class="text-emerald-600 font-bold">✓</span> 50% thời lượng học tập cùng giáo viên bản ngữ có bằng PGCE</li>
                        <li class="flex items-center gap-2"><span class="text-emerald-600 font-bold">✓</span> Lớp học tiêu chuẩn tối đa 20 học sinh với 2 giáo viên phụ trách</li>
                        <li class="flex items-center gap-2"><span class="text-emerald-600 font-bold">✓</span> Hệ thống câu lạc bộ Robotics, Bơi lội, Piano, Hội họa sau giờ học</li>
                    </ul>
                    <a href="#admit-form" class="inline-block mt-4 px-6 py-2.5 rounded-full bg-[#1e3a8a] hover:bg-blue-900 text-white font-bold text-xs uppercase tracking-wider transition-all">
                        Tải Sổ Tay Học Sinh & Biểu Phí
                    </a>
                </div>

                <div class="rounded-2xl overflow-hidden shadow-xl aspect-4/3 bg-slate-900">
                    <img src="https://images.unsplash.com/photo-1509062522246-3755977927d7?auto=format&fit=crop&w=800&q=80" alt="Students in classroom" class="w-full h-full object-cover">
                </div>
            </div>
        </div>
    </section>

    <!-- Admissions Form Section -->
    <section id="admit-form" class="py-16 bg-slate-900 text-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 text-center space-y-6">
            <span class="text-xs font-bold text-amber-400 uppercase tracking-widest font-mono">ADMISSIONS 2026-2027</span>
            <h2 class="text-2xl sm:text-3xl font-serif font-black">Đăng Ký Dự Thi Tuyển Sinh & Tham Quan Trường</h2>
            <p class="text-xs sm:text-sm text-slate-400 max-w-xl mx-auto">
                Hội đồng tuyển sinh Global Pathway sẽ gửi bài test đầu vào và thông tin chi tiết qua email cho phụ huynh trong vòng 24 giờ.
            </p>

            <form class="bg-slate-800/90 p-8 rounded-3xl border border-slate-700 text-left space-y-4 max-w-2xl mx-auto">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs text-slate-300 font-bold mb-1">Họ tên Phụ huynh *</label>
                        <input type="text" placeholder="Nguyễn Văn A" class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-xs text-white focus:border-amber-400 outline-none">
                    </div>
                    <div>
                        <label class="block text-xs text-slate-300 font-bold mb-1">Số điện thoại Phụ huynh *</label>
                        <input type="tel" placeholder="0939 523 557" class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-xs text-white focus:border-amber-400 outline-none">
                    </div>
                </div>
                <div>
                    <label class="block text-xs text-slate-300 font-bold mb-1">Cấp học đăng ký cho học sinh</label>
                    <select class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-xs text-white focus:border-amber-400 outline-none">
                        <option>Lớp Mầm non (18 tháng - 5 tuổi)</option>
                        <option selected>Lớp 1 - Khối Tiểu học Song Ngữ</option>
                        <option>Lớp 6 - Khối Trung Học Cơ Sở Cambridge</option>
                        <option>Lớp 10 - Tú Tài Quốc Tế IB Diploma</option>
                    </select>
                </div>
                <button type="button" onclick="alert('Đã tiếp nhận hồ sơ đăng ký! Ban tuyển sinh Global Pathway sẽ liên hệ với quý phụ huynh.')" class="w-full py-3.5 rounded-xl bg-rose-600 hover:bg-rose-700 text-white font-bold text-xs uppercase tracking-wider transition-all">
                    Nộp Hồ Sơ Đăng Ký Tư Vấn
                </button>
            </form>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-black text-slate-500 py-6 text-center text-xs border-t border-slate-900">
        <p>© 2026 Global Pathway International School. Built with Truyền Thông Cửu Long.</p>
    </footer>

</div>
