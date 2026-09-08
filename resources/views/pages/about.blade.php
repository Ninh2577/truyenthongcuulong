@extends('layouts.app')

@section('title', 'Câu Chuyện Thương Hiệu & Triết Lý Hoạt Động - Truyền Thông Cửu Long')
@section('meta_description', 'Tìm hiểu về Truyền Thông Cửu Long: Hơn 10 năm kinh nghiệm hợp nhất nghệ thuật kể chuyện điện ảnh và năng lực kỹ thuật số chuẩn mực.')

@section('content')
<div class="w-full bg-[#080C16] text-white min-h-screen">
    
    <!-- 1. Small Hero Section -->
    <section class="relative pt-32 pb-12 lg:pt-36 lg:pb-16 overflow-hidden border-b border-slate-800/80 bg-dot-grid-subtle">
        <div class="absolute inset-0 bg-gradient-to-b from-transparent via-[#080C16]/60 to-[#080C16] pointer-events-none"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- Breadcrumb -->
            <nav class="flex items-center gap-2 text-xs font-mono text-slate-400 mb-6" aria-label="Breadcrumb">
                <a href="{{ route('home') }}" class="hover:text-amber-400 transition-colors">Trang chủ</a>
                <span class="text-slate-600">/</span>
                <span class="text-slate-400">Về chúng tôi</span>
                <span class="text-slate-600">/</span>
                <span class="text-amber-400 font-bold">Câu chuyện thương hiệu</span>
            </nav>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
                <div class="lg:col-span-7 flex flex-col gap-5">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-amber-400/10 border border-amber-400/30 text-amber-400 font-mono text-xs font-bold w-fit">
                        <span class="w-2 h-2 rounded-full bg-amber-400 animate-pulse"></span>
                        <span>ABOUT TRUYỀN THÔNG CỬU LONG</span>
                    </div>
                    <h1 class="font-headline text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight leading-tight">
                        Hành Trình Giao Thoa Giữa <br class="hidden sm:inline" />
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-400 via-orange-400 to-amber-200">Nghệ Thuật Điện Ảnh</span> &amp; <br class="hidden sm:inline" />
                        <span class="text-white">Sức Mạnh Công Nghệ Số</span>
                    </h1>
                    <p class="font-body text-slate-300 text-sm sm:text-base leading-relaxed max-w-2xl">
                        Hơn 10 năm kinh nghiệm đồng hành cùng các thương hiệu và doanh nghiệp kiến tạo những tác phẩm truyền hình, phim tài liệu doanh nghiệp và nền tảng số chuẩn mực. Chúng tôi kết hợp tư duy thị giác điện ảnh cùng nền tảng kỹ thuật phần mềm vững chắc để mang lại giá trị chuyển đổi bền vững.
                    </p>

                    <!-- Key Metrics -->
                    <div class="grid grid-cols-3 gap-3 sm:gap-4 pt-2">
                        <div class="p-4 rounded-2xl bg-[#0F172A] border border-slate-800 text-center sm:text-left">
                            <span class="font-headline text-2xl sm:text-3xl font-black text-amber-400">10+</span>
                            <p class="text-[11px] sm:text-xs text-slate-400 font-medium mt-1">Năm kinh nghiệm thực chiến</p>
                        </div>
                        <div class="p-4 rounded-2xl bg-[#0F172A] border border-slate-800 text-center sm:text-left">
                            <span class="font-headline text-2xl sm:text-3xl font-black text-white">850+</span>
                            <p class="text-[11px] sm:text-xs text-slate-400 font-medium mt-1">Dự án Media &amp; Tech bàn giao</p>
                        </div>
                        <div class="p-4 rounded-2xl bg-[#0F172A] border border-slate-800 text-center sm:text-left">
                            <span class="font-headline text-2xl sm:text-3xl font-black text-emerald-400">99.2%</span>
                            <p class="text-[11px] sm:text-xs text-slate-400 font-medium mt-1">Khách hàng tiếp tục đồng hành</p>
                        </div>
                    </div>
                </div>

                <!-- Hero Visual Box -->
                <div class="lg:col-span-5 relative">
                    <div class="relative rounded-3xl overflow-hidden bg-[#0F172A] border border-slate-800 p-3 shadow-2xl group">
                        <div class="relative rounded-2xl overflow-hidden aspect-[4/3] bg-slate-900">
                            <img src="https://images.unsplash.com/photo-1574717024653-61fd2cf4d44d?auto=format&fit=crop&w=900&q=80" 
                                 alt="Phim trường & Không gian sáng tạo Truyền Thông Cửu Long" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 opacity-80"
                                 loading="lazy">
                            <div class="absolute inset-0 bg-gradient-to-t from-[#0F172A] via-transparent to-transparent"></div>
                            <div class="absolute bottom-3 left-3 right-3 flex items-center justify-between">
                                <span class="px-2.5 py-1 rounded-full bg-black/70 backdrop-blur-md text-amber-400 font-mono text-[10px] font-bold border border-amber-400/30">
                                    Cinema 4K &bull; TechLab
                                </span>
                                <span class="px-2.5 py-1 rounded-full bg-emerald-500/20 text-emerald-400 font-mono text-[10px] font-bold border border-emerald-500/30">
                                    Enterprise SLA
                                </span>
                            </div>
                        </div>
                        <div class="p-4 flex items-center justify-between text-white">
                            <div>
                                <h3 class="font-headline text-sm font-bold">Trụ Sở Sáng Tạo &amp; Tech Hub</h3>
                                <p class="text-[11px] font-mono text-slate-400">TP. Hồ Chí Minh &amp; ĐBSCL</p>
                            </div>
                            <a href="{{ route('contact') }}" class="text-xs font-headline font-bold text-amber-400 hover:underline flex items-center gap-1">
                                Kết nối ngay <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 2. Dual DNA Section (Triết lý hợp nhất) -->
    <section class="py-12 lg:py-16 bg-[#0F172A] border-b border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-10 lg:mb-12">
                <span class="font-mono text-xs text-amber-400 font-bold uppercase tracking-widest">THE DUAL DNA PHILOSOPHY</span>
                <h2 class="font-headline text-2xl sm:text-3xl lg:text-4xl font-extrabold mt-2">
                    Sự Kết Hợp Độc Bản: <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-400 to-orange-500">Điện Ảnh × Công Nghệ</span>
                </h2>
                <p class="font-body text-slate-400 text-xs sm:text-sm mt-3 leading-relaxed">
                    Hầu hết doanh nghiệp phải thuê riêng lẻ một production house quay video và một công ty phần mềm làm web/app. Tại Truyền Thông Cửu Long, chúng tôi hợp nhất cả hai năng lực vào một luồng thực thi đồng bộ duy nhất.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-stretch">
                <!-- Bán Cầu Trái: Tech & Logic -->
                <div class="p-8 rounded-3xl bg-[#131D38] border border-slate-700/80 flex flex-col justify-between hover:border-amber-400/40 transition-all duration-300 group">
                    <div class="flex flex-col gap-4">
                        <div class="w-12 h-12 rounded-2xl bg-sky-500/20 text-sky-400 flex items-center justify-center">
                            <span class="material-symbols-outlined text-[28px]">terminal</span>
                        </div>
                        <div>
                            <span class="font-mono text-[10px] text-sky-400 uppercase tracking-wider font-bold">KỸ THUẬT &amp; LOGIC HỆ THỐNG</span>
                            <h3 class="font-headline text-xl sm:text-2xl font-bold mt-1 group-hover:text-amber-400 transition-colors">Tư Duy Kiến Trúc Sư Phần Mềm</h3>
                        </div>
                        <p class="font-body text-slate-300 text-xs sm:text-sm leading-relaxed">
                            Mỗi nền tảng số được xây dựng với tư duy kỹ thuật vững chắc: Kiến trúc Clean Code, bảo mật đa tầng, tối ưu tốc độ tải trang Core Web Vitals &ge; 95 và cấu trúc dữ liệu phục vụ mục tiêu chuyển đổi doanh thu.
                        </p>
                        <ul class="space-y-2 pt-2 text-xs text-slate-300 font-body">
                            <li class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-amber-400 text-[16px]">check_circle</span>
                                <span>Kiến trúc phân tầng Microservices / Modular Laravel</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-amber-400 text-[16px]">check_circle</span>
                                <span>Bảo mật chống SQLi, XSS, CSRF &amp; sao lưu tự động</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-amber-400 text-[16px]">check_circle</span>
                                <span>Bàn giao toàn bộ 100% mã nguồn không phụ thuộc nhà cung cấp</span>
                            </li>
                        </ul>
                    </div>
                    <div class="pt-6 mt-6 border-t border-slate-700/60 flex items-center justify-between">
                        <span class="font-mono text-xs text-slate-400">Nền tảng công nghệ mũi nhọn</span>
                        <a href="{{ route('services.web-app') }}" class="text-xs font-headline font-bold text-sky-400 hover:text-amber-400 flex items-center gap-1 transition-colors">
                            Khám phá Web/App <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
                        </a>
                    </div>
                </div>

                <!-- Bán Cầu Phải: Cinema & Emotion -->
                <div class="p-8 rounded-3xl bg-[#131D38] border border-slate-700/80 flex flex-col justify-between hover:border-amber-400/40 transition-all duration-300 group">
                    <div class="flex flex-col gap-4">
                        <div class="w-12 h-12 rounded-2xl bg-amber-500/20 text-amber-400 flex items-center justify-center">
                            <span class="material-symbols-outlined text-[28px]">movie</span>
                        </div>
                        <div>
                            <span class="font-mono text-[10px] text-amber-400 uppercase tracking-wider font-bold">THẨM MỸ &amp; TRỰC GIÁC NGHỆ THUẬT</span>
                            <h3 class="font-headline text-xl sm:text-2xl font-bold mt-1 group-hover:text-amber-400 transition-colors">Ngôn Ngữ Kể Chuyện Điện Ảnh</h3>
                        </div>
                        <p class="font-body text-slate-300 text-xs sm:text-sm leading-relaxed">
                            Hình ảnh không chỉ cần đẹp mà phải truyền cảm hứng và khơi gợi cảm xúc. Từ kịch bản sâu sắc, góc máy điện ảnh chuẩn 4K/DCI cho đến quy trình chỉnh màu DaVinci Resolve giúp thương hiệu khắc sâu trong tâm trí khách hàng.
                        </p>
                        <ul class="space-y-2 pt-2 text-xs text-slate-300 font-body">
                            <li class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-amber-400 text-[16px]">check_circle</span>
                                <span>Trang thiết bị chuẩn Cinema Line 4K/6K HDR</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-amber-400 text-[16px]">check_circle</span>
                                <span>Phòng dựng chuẩn DaVinci Resolve với Colorist chuyên sâu</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-amber-400 text-[16px]">check_circle</span>
                                <span>Kịch bản phân cảnh độc quyền bám sát USP của doanh nghiệp</span>
                            </li>
                        </ul>
                    </div>
                    <div class="pt-6 mt-6 border-t border-slate-700/60 flex items-center justify-between">
                        <span class="font-mono text-xs text-slate-400">Xưởng sản xuất nghe nhìn</span>
                        <a href="{{ route('services.media') }}" class="text-xs font-headline font-bold text-amber-400 hover:underline flex items-center gap-1">
                            Khám phá Media <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. Vision & Mission -->
    <section class="py-12 lg:py-16 bg-[#080C16] border-b border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Vision -->
                <div class="p-8 sm:p-10 rounded-3xl bg-[#0F172A] border border-slate-800 flex flex-col gap-4 relative overflow-hidden">
                    <div class="absolute -right-8 -bottom-8 w-40 h-40 bg-amber-500/5 rounded-full blur-2xl"></div>
                    <div class="w-12 h-12 rounded-2xl bg-amber-400/10 text-amber-400 flex items-center justify-center border border-amber-400/20">
                        <span class="material-symbols-outlined text-[26px]">visibility</span>
                    </div>
                    <h3 class="font-headline text-2xl font-bold text-white">Tầm Nhìn Chiến Lược 2030</h3>
                    <p class="font-body text-sm text-slate-300 leading-relaxed">
                        Trở thành tổ hợp truyền thông sáng tạo và công nghệ số hàng đầu khu vực Đồng bằng sông Cửu Long và vươn tầm cả nước; là biểu tượng của sự hợp nhất hoàn hảo giữa tính duy mỹ điện ảnh và chuẩn mực kỹ thuật công nghệ thông tin.
                    </p>
                    <div class="pt-2 flex items-center gap-3 text-xs font-mono text-slate-400">
                        <span class="px-2.5 py-1 rounded bg-white/5 border border-white/10">Bền vững</span>
                        <span class="px-2.5 py-1 rounded bg-white/5 border border-white/10">Đẳng cấp</span>
                        <span class="px-2.5 py-1 rounded bg-white/5 border border-white/10">Tiên phong</span>
                    </div>
                </div>

                <!-- Mission -->
                <div class="p-8 sm:p-10 rounded-3xl bg-[#0F172A] border border-slate-800 flex flex-col gap-4 relative overflow-hidden">
                    <div class="absolute -right-8 -bottom-8 w-40 h-40 bg-orange-500/5 rounded-full blur-2xl"></div>
                    <div class="w-12 h-12 rounded-2xl bg-orange-500/10 text-orange-400 flex items-center justify-center border border-orange-500/20">
                        <span class="material-symbols-outlined text-[26px]">rocket_launch</span>
                    </div>
                    <h3 class="font-headline text-2xl font-bold text-white">Sứ Mệnh Cốt Lõi</h3>
                    <p class="font-body text-sm text-slate-300 leading-relaxed">
                        Xóa bỏ rào cản phân mảnh giữa ý tưởng nội dung và năng lực triển khai kỹ thuật; trang bị cho doanh nghiệp giải pháp tổng thể (Video Cinematic + Hệ thống Web/App + Chiến dịch Digital) giúp tối ưu hóa ngân sách vận hành và tạo đà bứt phá doanh thu.
                    </p>
                    <div class="pt-2 flex items-center gap-3 text-xs font-mono text-slate-400">
                        <span class="px-2.5 py-1 rounded bg-white/5 border border-white/10">Tối ưu chi phí</span>
                        <span class="px-2.5 py-1 rounded bg-white/5 border border-white/10">Tăng chuyển đổi</span>
                        <span class="px-2.5 py-1 rounded bg-white/5 border border-white/10">Đồng hành dài hạn</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. Core Values 4T (Tâm - Tầm - Tốc - Thật) -->
    <section class="py-12 lg:py-16 bg-[#0F172A] border-b border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-10 lg:mb-12">
                <span class="font-mono text-xs text-amber-400 font-bold uppercase tracking-widest">ORGANIZATIONAL PRINCIPLES</span>
                <h2 class="font-headline text-2xl sm:text-3xl lg:text-4xl font-extrabold mt-2">
                    Giá Trị Cốt Lõi: <span class="text-amber-400">Hệ Giá Trị 4T</span>
                </h2>
                <p class="font-body text-slate-400 text-xs sm:text-sm mt-3">
                    Bốn kim chỉ nam dẫn đường cho mọi quyết định sáng tạo, kỹ thuật và đối thoại cùng khách hàng.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- TÂM -->
                <div class="p-6 rounded-3xl bg-[#131D38] border border-slate-800 flex flex-col gap-3 hover:-translate-y-1 hover:border-amber-400/40 transition-all duration-300">
                    <div class="w-12 h-12 rounded-2xl bg-rose-500/20 text-rose-400 flex items-center justify-center font-headline text-xl font-bold">
                        T
                    </div>
                    <h3 class="font-headline text-xl font-bold text-white">TÂM &bull; Tận Tụy</h3>
                    <p class="font-body text-xs text-slate-300 leading-relaxed">
                        Đặt danh dự nghề nghiệp và lợi ích của khách hàng làm trọng tâm. Mỗi dự án đều được chăm chút tỉ mỉ như đứa con tinh thần của chính chúng tôi.
                    </p>
                </div>

                <!-- TẦM -->
                <div class="p-6 rounded-3xl bg-[#131D38] border border-slate-800 flex flex-col gap-3 hover:-translate-y-1 hover:border-amber-400/40 transition-all duration-300">
                    <div class="w-12 h-12 rounded-2xl bg-amber-500/20 text-amber-400 flex items-center justify-center font-headline text-xl font-bold">
                        T
                    </div>
                    <h3 class="font-headline text-xl font-bold text-white">TẦM &bull; Chuẩn Mực</h3>
                    <p class="font-body text-xs text-slate-300 leading-relaxed">
                        Không thỏa hiệp với những sản phẩm chắp vá. Luôn hướng đến chuẩn mực quốc tế trong cả thẩm mỹ nghe nhìn lẫn kiến trúc hạ tầng công nghệ số.
                    </p>
                </div>

                <!-- TỐC -->
                <div class="p-6 rounded-3xl bg-[#131D38] border border-slate-800 flex flex-col gap-3 hover:-translate-y-1 hover:border-amber-400/40 transition-all duration-300">
                    <div class="w-12 h-12 rounded-2xl bg-sky-500/20 text-sky-400 flex items-center justify-center font-headline text-xl font-bold">
                        T
                    </div>
                    <h3 class="font-headline text-xl font-bold text-white">TỐC &bull; Kỷ Luật</h3>
                    <p class="font-body text-xs text-slate-300 leading-relaxed">
                        Phản hồi yêu cầu trong 15 phút, triển khai dự án quyết liệt và cam kết tiến độ bàn giao chính xác theo từng mốc hợp đồng đã ký kết.
                    </p>
                </div>

                <!-- THẬT -->
                <div class="p-6 rounded-3xl bg-[#131D38] border border-slate-800 flex flex-col gap-3 hover:-translate-y-1 hover:border-amber-400/40 transition-all duration-300">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-500/20 text-emerald-400 flex items-center justify-center font-headline text-xl font-bold">
                        T
                    </div>
                    <h3 class="font-headline text-xl font-bold text-white">THẬT &bull; Minh Bạch</h3>
                    <p class="font-body text-xs text-slate-300 leading-relaxed">
                        Nói thật, làm thật, nghiệm thu bằng số liệu thật. Mọi chi phí, thời gian và chỉ số hiệu quả KPI đều được đo lường minh bạch tuyệt đối.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- 5. Ecosystem Section (4 Website Thành Viên Thật) -->
    <section class="py-12 lg:py-16 bg-[#080C16] border-b border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-10 lg:mb-12">
                <span class="font-mono text-xs text-amber-400 font-bold uppercase tracking-widest">ECOSYSTEM MATRIX</span>
                <h2 class="font-headline text-2xl sm:text-3xl lg:text-4xl font-extrabold mt-2">
                    Hệ Sinh Thái Số Trực Thuộc CLM
                </h2>
                <p class="font-body text-slate-400 text-xs sm:text-sm mt-3">
                    Các thương hiệu và nền tảng trực tuyến thuộc mạng lưới phát triển của Truyền Thông Cửu Long.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Ecosystem 1: Cuu Long Camping -->
                <a href="https://cuulongcamping.vn" target="_blank" rel="noopener noreferrer" 
                   class="p-6 rounded-3xl bg-[#0F172A] border border-slate-800 hover:border-emerald-400/50 hover:bg-[#131D38] transition-all duration-300 flex flex-col justify-between group">
                    <div>
                        <div class="w-10 h-10 rounded-xl bg-emerald-500/20 text-emerald-400 flex items-center justify-center mb-4">
                            <span class="material-symbols-outlined text-[22px]">camping</span>
                        </div>
                        <h3 class="font-headline text-lg font-bold text-white group-hover:text-amber-400 transition-colors">Cuu Long Camping</h3>
                        <span class="font-mono text-[10px] text-emerald-400 block mb-2">cuulongcamping.vn</span>
                        <p class="text-xs text-slate-400 leading-relaxed">
                            Mô hình cắm trại sinh thái dã ngoại, trải nghiệm thiên nhiên và sản xuất Travel Video quảng bá miền Tây.
                        </p>
                    </div>
                    <div class="pt-4 mt-4 border-t border-slate-800 flex items-center justify-between text-xs font-mono text-slate-400 group-hover:text-emerald-400">
                        <span>Truy cập website</span>
                        <span class="material-symbols-outlined text-[14px]">open_in_new</span>
                    </div>
                </a>

                <!-- Ecosystem 2: Tui Là Người Miền Tây -->
                <a href="https://tuilanguoimientay.vn" target="_blank" rel="noopener noreferrer" 
                   class="p-6 rounded-3xl bg-[#0F172A] border border-slate-800 hover:border-amber-400/50 hover:bg-[#131D38] transition-all duration-300 flex flex-col justify-between group">
                    <div>
                        <div class="w-10 h-10 rounded-xl bg-amber-500/20 text-amber-400 flex items-center justify-center mb-4">
                            <span class="material-symbols-outlined text-[22px]">map</span>
                        </div>
                        <h3 class="font-headline text-lg font-bold text-white group-hover:text-amber-400 transition-colors">Tui Là Người Miền Tây</h3>
                        <span class="font-mono text-[10px] text-amber-400 block mb-2">tuilanguoimientay.vn</span>
                        <p class="text-xs text-slate-400 leading-relaxed">
                            Kênh truyền thông văn hóa, ẩm thực, phong tục đời sống và phong cảnh ĐBSCL với hàng trăm nghìn độc giả.
                        </p>
                    </div>
                    <div class="pt-4 mt-4 border-t border-slate-800 flex items-center justify-between text-xs font-mono text-slate-400 group-hover:text-amber-400">
                        <span>Truy cập website</span>
                        <span class="material-symbols-outlined text-[14px]">open_in_new</span>
                    </div>
                </a>

                <!-- Ecosystem 3: Tiêu Dao Tử -->
                <a href="https://tieudaotu.com" target="_blank" rel="noopener noreferrer" 
                   class="p-6 rounded-3xl bg-[#0F172A] border border-slate-800 hover:border-sky-400/50 hover:bg-[#131D38] transition-all duration-300 flex flex-col justify-between group">
                    <div>
                        <div class="w-10 h-10 rounded-xl bg-sky-500/20 text-sky-400 flex items-center justify-center mb-4">
                            <span class="material-symbols-outlined text-[22px]">explore</span>
                        </div>
                        <h3 class="font-headline text-lg font-bold text-white group-hover:text-amber-400 transition-colors">Tiêu Dao Tử</h3>
                        <span class="font-mono text-[10px] text-sky-400 block mb-2">tieudaotu.com</span>
                        <p class="text-xs text-slate-400 leading-relaxed">
                            Blog hành trình phiêu lưu, kinh nghiệm phượt và nguồn tư liệu nhiếp ảnh thực địa đa dạng.
                        </p>
                    </div>
                    <div class="pt-4 mt-4 border-t border-slate-800 flex items-center justify-between text-xs font-mono text-slate-400 group-hover:text-sky-400">
                        <span>Truy cập website</span>
                        <span class="material-symbols-outlined text-[14px]">open_in_new</span>
                    </div>
                </a>

                <!-- Ecosystem 4: Cùng Chơi -->
                <a href="https://cungchoi.com" target="_blank" rel="noopener noreferrer" 
                   class="p-6 rounded-3xl bg-[#0F172A] border border-slate-800 hover:border-purple-400/50 hover:bg-[#131D38] transition-all duration-300 flex flex-col justify-between group">
                    <div>
                        <div class="w-10 h-10 rounded-xl bg-purple-500/20 text-purple-400 flex items-center justify-center mb-4">
                            <span class="material-symbols-outlined text-[22px]">sports_esports</span>
                        </div>
                        <h3 class="font-headline text-lg font-bold text-white group-hover:text-amber-400 transition-colors">Cùng Chơi</h3>
                        <span class="font-mono text-[10px] text-purple-400 block mb-2">cungchoi.com</span>
                        <p class="text-xs text-slate-400 leading-relaxed">
                            Nền tảng cộng đồng giải trí, minigames và các hoạt động tương tác trực tuyến cho giới trẻ.
                        </p>
                    </div>
                    <div class="pt-4 mt-4 border-t border-slate-800 flex items-center justify-between text-xs font-mono text-slate-400 group-hover:text-purple-400">
                        <span>Truy cập website</span>
                        <span class="material-symbols-outlined text-[14px]">open_in_new</span>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <!-- 6. Bottom CTA Band -->
    <section class="py-12 lg:py-16 bg-gradient-to-r from-[#0F172A] via-[#131D38] to-[#0F172A] border-t border-slate-800 relative overflow-hidden">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10 flex flex-col items-center gap-6">
            <span class="px-3.5 py-1 rounded-full bg-amber-400/10 border border-amber-400/30 text-amber-400 font-mono text-xs font-bold">
                PARTNER WITH US
            </span>
            <h2 class="font-headline text-2xl sm:text-4xl font-extrabold text-white">
                Sẵn Sàng Kiến Tạo Bước Chuyển Mình Cho Thương Hiệu?
            </h2>
            <p class="font-body text-slate-300 text-xs sm:text-base max-w-2xl leading-relaxed">
                Hãy chia sẻ mục tiêu truyền thông hoặc bài toán công nghệ của doanh nghiệp bạn. Đội ngũ chuyên gia của chúng tôi sẽ phản hồi trong vòng 24 giờ với giải pháp tối ưu nhất.
            </p>
            <div class="flex flex-wrap items-center justify-center gap-4 pt-2">
                <a href="{{ route('contact') }}" class="px-6 py-3.5 rounded-xl bg-gradient-to-r from-amber-400 to-orange-500 text-navy-base font-headline text-sm font-bold shadow-lg shadow-amber-500/20 hover:brightness-110 hover:scale-[1.02] active:scale-[0.98] transition-all">
                    Gửi Yêu Cầu Tư Vấn Ngay
                </a>
                <a href="tel:0908898804" class="px-6 py-3.5 rounded-xl bg-white/5 border border-white/10 text-white font-headline text-sm font-bold hover:bg-white/10 transition-all flex items-center gap-2">
                    <span class="material-symbols-outlined text-[18px] text-amber-400">phone_in_talk</span>
                    <span>Hotline: 0908.898.804</span>
                </a>
            </div>
        </div>
    </section>

</div>

<!-- Schema JSON-LD -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "AboutPage",
    "name": "Câu Chuyện Thương Hiệu & Triết Lý Hoạt Động - Truyền Thông Cửu Long",
    "description": "Hơn 10 năm kinh nghiệm hợp nhất nghệ thuật kể chuyện điện ảnh và năng lực kỹ thuật số chuẩn mực.",
    "url": "{{ route('about') }}",
    "mainEntity": {
        "@type": "Organization",
        "name": "Truyền Thông Cửu Long",
        "url": "{{ url('/') }}",
        "logo": "{{ asset('images/logo.png') }}",
        "foundingDate": "2014",
        "sameAs": [
            "https://www.facebook.com/truyenthongcuulong/",
            "https://www.youtube.com/watch?v=nGvVhO2kDo8"
        ]
    }
}
</script>
@endsection
