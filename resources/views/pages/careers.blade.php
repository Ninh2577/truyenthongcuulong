@extends('layouts.app')

@section('title', 'Tuyển Dụng & Cơ Hội Nghề Nghiệp - Truyền Thông Cửu Long')
@section('meta_description', 'Gia nhập đội ngũ sáng tạo tại Truyền Thông Cửu Long. Khám phá cơ hội nghề nghiệp dành cho Video Editor, Đạo diễn, Kỹ sư phần mềm và Marketer.')

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
                <a href="{{ route('about') }}" class="hover:text-amber-400 transition-colors">Về chúng tôi</a>
                <span class="text-slate-600">/</span>
                <span class="text-amber-400 font-bold">Tuyển dụng</span>
            </nav>

            <div class="text-center max-w-3xl mx-auto flex flex-col items-center gap-4">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-amber-400/10 border border-amber-400/30 text-amber-400 font-mono text-xs font-bold w-fit">
                    <span class="w-2 h-2 rounded-full bg-amber-400 animate-pulse"></span>
                    <span>CAREERS &amp; TALENTS</span>
                </div>
                <h1 class="font-headline text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight leading-tight">
                    Cùng Kiến Tạo Những Tác Phẩm Triệu View &amp; <br class="hidden sm:inline" />
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-400 via-orange-400 to-amber-200">Nền Tảng Công Nghệ Đột Phá</span>
                </h1>
                <p class="font-body text-slate-300 text-sm sm:text-base leading-relaxed">
                    Tại Truyền Thông Cửu Long, chúng tôi trân trọng tài năng, đam mê bứt phá và tư duy khác biệt. Môi trường làm việc năng động, trang thiết bị điện ảnh và máy trạm tân tiến nhất, cùng cơ hội dẫn dắt các dự án quy mô quốc gia.
                </p>
            </div>
        </div>
    </section>

    <!-- 2. Culture & Perks (3 Khối Đãi Ngộ Vượt Trội) -->
    <section class="py-12 lg:py-16 bg-[#0F172A] border-b border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-10 lg:mb-12">
                <span class="font-mono text-xs text-amber-400 font-bold uppercase tracking-widest">WHY JOIN US</span>
                <h2 class="font-headline text-2xl sm:text-3xl lg:text-4xl font-extrabold mt-2">
                    Môi Trường &amp; Quyền Lợi Toàn Diện
                </h2>
                <p class="font-body text-slate-400 text-xs sm:text-sm mt-3">
                    Được thiết kế để bạn thỏa sức sáng tạo và phát triển vượt bậc trong sự nghiệp.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="p-6 sm:p-8 rounded-3xl bg-[#131D38] border border-slate-700/80 hover:border-amber-400/40 transition-all flex flex-col gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-amber-400/10 text-amber-400 flex items-center justify-center border border-amber-400/20">
                        <span class="material-symbols-outlined text-[26px]">workspace_premium</span>
                    </div>
                    <h3 class="font-headline text-lg font-bold text-white">Thu Nhập &amp; Thưởng Dự Án Minh Bạch</h3>
                    <p class="font-body text-xs sm:text-sm text-slate-300 leading-relaxed">
                        Lương cạnh tranh theo năng lực thực tế. Thưởng nóng ngay khi đóng máy dự án và hoàn thành các cột mốc phần mềm quan trọng. Đánh giá tăng lương định kỳ 6 tháng.
                    </p>
                </div>

                <div class="p-6 sm:p-8 rounded-3xl bg-[#131D38] border border-slate-700/80 hover:border-sky-400/40 transition-all flex flex-col gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-sky-500/10 text-sky-400 flex items-center justify-center border border-sky-500/20">
                        <span class="material-symbols-outlined text-[26px]">videocam</span>
                    </div>
                    <h3 class="font-headline text-lg font-bold text-white">Vũ Khí Làm Việc Chuẩn Cinema &amp; Workstation</h3>
                    <p class="font-body text-xs sm:text-sm text-slate-300 leading-relaxed">
                        Được trang bị máy trạm Apple M3 Max / RTX 4090, máy quay Sony Cinema Line FX3/FX6, dàn gimbal DJI Pro và hệ thống phòng dựng chuẩn màu DaVinci Resolve Studio.
                    </p>
                </div>

                <div class="p-6 sm:p-8 rounded-3xl bg-[#131D38] border border-slate-700/80 hover:border-emerald-400/40 transition-all flex flex-col gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-500/10 text-emerald-400 flex items-center justify-center border border-emerald-500/20">
                        <span class="material-symbols-outlined text-[26px]">trending_up</span>
                    </div>
                    <h3 class="font-headline text-lg font-bold text-white">Kèm Cặp 1-on-1 Từ Các Senior</h3>
                    <p class="font-body text-xs sm:text-sm text-slate-300 leading-relaxed">
                        Làm việc sát cánh cùng Tổng Đạo Diễn và Tech Lead hơn 10 năm kinh nghiệm; mở rộng cơ hội thăng tiến lên vị trí Project Lead hoặc đối tác chiến lược của công ty.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. Hiring Process (Quy Trình Tuyển Dụng 4 Bước) -->
    <section class="py-12 lg:py-16 bg-[#080C16] border-b border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-10 lg:mb-12">
                <span class="font-mono text-xs text-amber-400 font-bold uppercase tracking-widest">TRANSPARENT RECRUITMENT</span>
                <h2 class="font-headline text-2xl sm:text-3xl lg:text-4xl font-extrabold mt-2">
                    Quy Trình Tuyển Dụng 4 Bước Gọn Gàng
                </h2>
                <p class="font-body text-slate-400 text-xs sm:text-sm mt-3">
                    Tối giản thủ tục rườm rà, phản hồi nhanh chóng và tôn trọng thời gian của ứng viên.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="p-6 rounded-3xl bg-[#0F172A] border border-slate-800 flex flex-col gap-3">
                    <span class="font-mono text-2xl font-black text-amber-400">01</span>
                    <h3 class="font-headline text-base font-bold text-white">Nộp Hồ Sơ &amp; CV</h3>
                    <p class="font-body text-xs text-slate-400 leading-relaxed">
                        Gửi CV hoặc Portfolio / Showreel trực tuyến qua biểu mẫu nộp nhanh bên dưới.
                    </p>
                </div>
                <div class="p-6 rounded-3xl bg-[#0F172A] border border-slate-800 flex flex-col gap-3">
                    <span class="font-mono text-2xl font-black text-amber-400">02</span>
                    <h3 class="font-headline text-base font-bold text-white">Sàng Lọc 48 Giờ</h3>
                    <p class="font-body text-xs text-slate-400 leading-relaxed">
                        Ban nhân sự đánh giá hồ sơ và phản hồi thư mời phỏng vấn trong vòng 2 ngày làm việc.
                    </p>
                </div>
                <div class="p-6 rounded-3xl bg-[#0F172A] border border-slate-800 flex flex-col gap-3">
                    <span class="font-mono text-2xl font-black text-amber-400">03</span>
                    <h3 class="font-headline text-base font-bold text-white">Phỏng Vấn 1 Vòng Trực Tiếp</h3>
                    <p class="font-body text-xs text-slate-400 leading-relaxed">
                        Trao đổi chuyên môn trực tiếp cùng Lead bộ phận, chia sẻ định hướng và lắng nghe kỳ vọng của bạn.
                    </p>
                </div>
                <div class="p-6 rounded-3xl bg-[#0F172A] border border-slate-800 flex flex-col gap-3">
                    <span class="font-mono text-2xl font-black text-amber-400">04</span>
                    <h3 class="font-headline text-base font-bold text-white">Gia Nhập &amp; Thử Việc</h3>
                    <p class="font-body text-xs text-slate-400 leading-relaxed">
                        Nhận thư mời làm việc (Offer letter) và bắt đầu thử việc với 100% mức lương thỏa thuận.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. Main Section: Left Open Positions + Right Fast Apply Form -->
    <section class="py-12 lg:py-16 bg-[#0F172A] border-b border-slate-800" id="apply-now">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Success Alert -->
            @if(session('success'))
            <div class="mb-8 p-5 rounded-2xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-300 text-sm font-semibold flex items-center gap-3">
                <span class="material-symbols-outlined text-[24px] text-emerald-400">check_circle</span>
                <span>{{ session('success') }}</span>
            </div>
            @endif

            <!-- Errors Alert -->
            @if($errors->any())
            <div class="mb-8 p-5 rounded-2xl bg-rose-500/10 border border-rose-500/30 text-rose-300 text-sm flex flex-col gap-1">
                <div class="flex items-center gap-2 font-bold text-rose-400">
                    <span class="material-symbols-outlined text-[20px]">error</span>
                    <span>Vui lòng kiểm tra lại thông tin:</span>
                </div>
                <ul class="list-disc list-inside text-xs pl-6">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
                
                <!-- Left: Open Positions (Col-span 7) -->
                <div class="lg:col-span-7 flex flex-col gap-6">
                    <div class="flex items-center justify-between pb-2 border-b border-slate-800">
                        <div>
                            <span class="font-mono text-xs text-amber-400 font-bold uppercase tracking-wider">OPEN ROLES</span>
                            <h3 class="font-headline text-2xl font-bold text-white mt-1">Vị Trí Đang Tuyển Dụng</h3>
                        </div>
                        <span class="font-mono text-xs text-slate-400 bg-white/5 px-3 py-1 rounded-full border border-white/10">
                            TP.HCM &amp; ĐBSCL
                        </span>
                    </div>

                    @if($jobs->count() > 0)
                        <div class="flex flex-col gap-4">
                            @foreach($jobs as $job)
                            <div class="p-6 rounded-3xl bg-[#131D38] border border-slate-700/80 hover:border-amber-400/40 transition-all flex flex-col gap-3">
                                <div class="flex items-center justify-between">
                                    <span class="px-2.5 py-1 rounded-full bg-amber-400/10 text-amber-400 font-mono text-[10px] font-bold border border-amber-400/20">
                                        FULL-TIME
                                    </span>
                                    <span class="text-xs font-mono text-slate-400">
                                        {{ $job->published_at ? $job->published_at->format('d/m/Y') : '' }}
                                    </span>
                                </div>
                                <h4 class="font-headline text-lg font-bold text-white">{{ $job->title }}</h4>
                                <p class="font-body text-xs text-slate-300 line-clamp-2 leading-relaxed">
                                    {{ $job->summary ?: 'Tham gia phát triển dự án truyền thông và công nghệ số cho khách hàng doanh nghiệp.' }}
                                </p>
                                <div class="pt-3 border-t border-slate-700/60 flex items-center justify-between">
                                    <a href="{{ route('blog.show', $job->slug) }}" class="text-xs font-headline font-bold text-amber-400 hover:underline flex items-center gap-1">
                                        Xem chi tiết JD <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
                                    </a>
                                    <span class="font-mono text-xs font-bold text-emerald-400">Thu nhập thương lượng</span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <!-- Default Featured Positions if DB jobs are empty -->
                        @php
                        $defaultRoles = [
                            [
                                'title' => 'Video Editor & 3D Motion Graphics (Cinema 4K)',
                                'type' => 'Full-time',
                                'exp' => '2+ năm kinh nghiệm',
                                'desc' => 'Dựng phim tài liệu doanh nghiệp, TVC quảng cáo và motion graphics trên nền tảng DaVinci Resolve Studio / After Effects. Thẩm mỹ nhịp điệu và tư duy hình ảnh tốt.',
                                'badge' => 'Media Hub'
                            ],
                            [
                                'title' => 'Đạo Diễn Hình Ảnh (DOP) & Cameraman',
                                'type' => 'Full-time / Dự án',
                                'exp' => '3+ năm kinh nghiệm',
                                'desc' => 'Cầm máy chính các set quay TVC, viral video và sự kiện lớn. Thành thạo dòng máy Sony Cinema Line FX3/FX6, lens cine và set-up ánh sáng trường quay chuyên nghiệp.',
                                'badge' => 'Production'
                            ],
                            [
                                'title' => 'Kỹ Sư Phần Mềm Fullstack (Laravel + Vue/React)',
                                'type' => 'Full-time',
                                'exp' => '2+ năm kinh nghiệm',
                                'desc' => 'Phát triển các cổng thông tin, web app quản trị và API chịu tải cao. Nắm vững Clean Architecture, tối ưu cơ sở dữ liệu MySQL/Redis và bảo mật hệ thống.',
                                'badge' => 'TechLab'
                            ],
                            [
                                'title' => 'Chuyên Viên Quảng Cáo Performance (TikTok & Meta Ads)',
                                'type' => 'Full-time',
                                'exp' => '1.5+ năm kinh nghiệm',
                                'desc' => 'Hoạch định ngân sách, thiết lập phễu chuyển đổi và tối ưu chỉ số ROAS/CPA cho khách hàng doanh nghiệp. Tư duy số liệu nhạy bén và phối hợp chặt cùng team Media.',
                                'badge' => 'Growth & Marketing'
                            ]
                        ];
                        @endphp

                        <div class="flex flex-col gap-4">
                            @foreach($defaultRoles as $role)
                            <div class="p-6 rounded-3xl bg-[#131D38] border border-slate-700/80 hover:border-amber-400/40 transition-all flex flex-col justify-between gap-4 group">
                                <div class="flex flex-col gap-2">
                                    <div class="flex items-center justify-between">
                                        <span class="px-2.5 py-0.5 rounded-full bg-amber-400/10 text-amber-400 font-mono text-[10px] font-bold border border-amber-400/20">
                                            {{ $role['badge'] }}
                                        </span>
                                        <span class="text-xs font-mono text-slate-400">{{ $role['type'] }} &bull; {{ $role['exp'] }}</span>
                                    </div>
                                    <h4 class="font-headline text-lg font-bold text-white group-hover:text-amber-400 transition-colors">
                                        {{ $role['title'] }}
                                    </h4>
                                    <p class="font-body text-xs text-slate-300 leading-relaxed">
                                        {{ $role['desc'] }}
                                    </p>
                                </div>
                                <div class="pt-3 border-t border-slate-700/60 flex items-center justify-between">
                                    <a href="#cv-form" class="text-xs font-headline font-bold text-amber-400 hover:underline flex items-center gap-1">
                                        Ứng tuyển ngay <span class="material-symbols-outlined text-[14px]">arrow_downward</span>
                                    </a>
                                    <span class="font-mono text-xs font-bold text-emerald-400">Thu nhập thương lượng theo năng lực</span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Right: Fast Apply Form (Col-span 5) -->
                <div class="lg:col-span-5 p-6 sm:p-8 rounded-3xl bg-[#131D38] border border-amber-400/30 shadow-2xl flex flex-col gap-5 sticky top-28" id="cv-form">
                    <div class="flex items-center gap-3 border-b border-slate-700/80 pb-4">
                        <div class="w-10 h-10 rounded-xl bg-amber-400/10 text-amber-400 flex items-center justify-center shrink-0 border border-amber-400/20">
                            <span class="material-symbols-outlined text-[22px]">send</span>
                        </div>
                        <div>
                            <h3 class="font-headline text-lg font-bold text-white">Nộp Hồ Sơ Nhanh</h3>
                            <p class="text-xs text-slate-400">Gửi CV ứng tuyển trực tiếp đến Ban Nhân Sự</p>
                        </div>
                    </div>

                    <form action="{{ route('careers.apply') }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-3.5">
                        @csrf
                        <div>
                            <label class="block font-headline text-xs font-bold text-slate-300 mb-1">
                                Họ và tên của bạn <span class="text-amber-400">*</span>
                            </label>
                            <input type="text" name="fullname" value="{{ old('fullname') }}" placeholder="Ví dụ: Nguyễn Văn A" required 
                                   class="w-full px-3.5 py-2.5 rounded-xl bg-[#0F172A] border border-slate-700 text-xs text-white placeholder:text-slate-500 focus:ring-2 focus:ring-amber-400 focus:border-transparent focus:outline-none transition-all">
                        </div>

                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block font-headline text-xs font-bold text-slate-300 mb-1">
                                    Số điện thoại <span class="text-amber-400">*</span>
                                </label>
                                <input type="tel" name="phone" value="{{ old('phone') }}" placeholder="0908 xxx xxx" required 
                                       class="w-full px-3.5 py-2.5 rounded-xl bg-[#0F172A] border border-slate-700 text-xs text-white placeholder:text-slate-500 focus:ring-2 focus:ring-amber-400 focus:border-transparent focus:outline-none transition-all">
                            </div>
                            <div>
                                <label class="block font-headline text-xs font-bold text-slate-300 mb-1">
                                    Email <span class="text-amber-400">*</span>
                                </label>
                                <input type="email" name="email" value="{{ old('email') }}" placeholder="you@email.com" required 
                                       class="w-full px-3.5 py-2.5 rounded-xl bg-[#0F172A] border border-slate-700 text-xs text-white placeholder:text-slate-500 focus:ring-2 focus:ring-amber-400 focus:border-transparent focus:outline-none transition-all">
                            </div>
                        </div>

                        <div>
                            <label class="block font-headline text-xs font-bold text-slate-300 mb-1">
                                Vị trí bạn muốn ứng tuyển <span class="text-amber-400">*</span>
                            </label>
                            <select name="position" required 
                                    class="w-full px-3.5 py-2.5 rounded-xl bg-[#0F172A] border border-slate-700 text-xs text-white focus:ring-2 focus:ring-amber-400 focus:border-transparent focus:outline-none transition-all">
                                <option value="Video Editor & 3D Motion Graphics">Video Editor &amp; 3D Motion Graphics</option>
                                <option value="Đạo Diễn Hình Ảnh (DOP) & Cameraman">Đạo Diễn Hình Ảnh (DOP) &amp; Cameraman</option>
                                <option value="Kỹ Sư Phần Mềm Fullstack (Laravel / React)">Kỹ Sư Phần Mềm Fullstack (Laravel / React)</option>
                                <option value="Chuyên Viên Quảng Cáo TikTok & Meta Ads">Chuyên Viên Quảng Cáo TikTok &amp; Meta Ads</option>
                                <option value="Biên Kịch Kịch Bản TVC & Content Creative">Biên Kịch Kịch Bản TVC &amp; Content Creative</option>
                                <option value="Thực Tập Sinh Media / Tech">Thực Tập Sinh Tiềm Năng (Media / Tech)</option>
                                <option value="Ứng Tuyển Tự Do Khác">Vị trí khác (Ghi rõ trong thư giới thiệu)</option>
                            </select>
                        </div>

                        <div>
                            <label class="block font-headline text-xs font-bold text-slate-300 mb-1">
                                Tải lên File CV (PDF/DOCX tối đa 10MB) <span class="text-amber-400">*</span>
                            </label>
                            <input type="file" name="cv_file" accept=".pdf,.doc,.docx" required 
                                   class="w-full text-xs text-slate-400 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-amber-400 file:text-navy-base hover:file:brightness-110 border border-slate-700 rounded-xl bg-[#0F172A] cursor-pointer">
                        </div>

                        <div>
                            <label class="block font-headline text-xs font-bold text-slate-300 mb-1">
                                Lời nhắn / Link Portfolio, Showreel
                            </label>
                            <textarea name="cover_letter" rows="3" placeholder="Chia sẻ kinh nghiệm hoặc đường dẫn Behance, Drive, Showreel của bạn..." 
                                      class="w-full px-3.5 py-2.5 rounded-xl bg-[#0F172A] border border-slate-700 text-xs text-white placeholder:text-slate-500 focus:ring-2 focus:ring-amber-400 focus:border-transparent focus:outline-none transition-all">{{ old('cover_letter') }}</textarea>
                        </div>

                        <button type="submit" 
                                class="mt-2 w-full py-3.5 rounded-xl bg-gradient-to-r from-amber-400 to-orange-500 text-navy-base font-headline text-xs font-bold shadow-lg shadow-amber-500/20 hover:brightness-110 hover:scale-[1.01] active:scale-[0.99] transition-all">
                            Nộp Hồ Sơ Ứng Tuyển Ngay
                        </button>
                    </form>
                </div>

            </div>

        </div>
    </section>

    <!-- 5. Bottom CTA Band: Talent Pool -->
    <section class="py-12 lg:py-16 bg-gradient-to-r from-[#0F172A] via-[#131D38] to-[#0F172A] border-t border-slate-800">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center flex flex-col items-center gap-6">
            <span class="px-3.5 py-1 rounded-full bg-amber-400/10 border border-amber-400/30 text-amber-400 font-mono text-xs font-bold">
                TALENT POOL
            </span>
            <h2 class="font-headline text-2xl sm:text-4xl font-extrabold text-white">
                Chưa Thấy Vị Trí Phù Hợp Nhưng Tin Mình Có Năng Lực?
            </h2>
            <p class="font-body text-slate-300 text-xs sm:text-base leading-relaxed">
                Chúng tôi luôn chào đón các tài năng đột phá gia nhập mạng lưới đối tác sáng tạo tự do hoặc dự án đặc biệt. Hãy gửi CV vào Talent Pool để nhận lời mời ngay khi có vị trí tương thích.
            </p>
            <div class="flex flex-wrap items-center justify-center gap-4 pt-2">
                <a href="#cv-form" class="px-6 py-3.5 rounded-xl bg-gradient-to-r from-amber-400 to-orange-500 text-navy-base font-headline text-sm font-bold shadow-lg shadow-amber-500/20 hover:brightness-110 hover:scale-[1.02] active:scale-[0.98] transition-all">
                    Gửi Hồ Sơ Vào Talent Pool
                </a>
                <a href="mailto:tuyendung@truyenthongcuulong.com" class="px-6 py-3.5 rounded-xl bg-white/5 border border-white/10 text-white font-headline text-sm font-bold hover:bg-white/10 transition-all flex items-center gap-2">
                    <span class="material-symbols-outlined text-[18px] text-amber-400">mail</span>
                    <span>tuyendung@truyenthongcuulong.com</span>
                </a>
            </div>
        </div>
    </section>

</div>

<!-- Schema JSON-LD -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "CollectionPage",
    "name": "Tuyển Dụng & Cơ Hội Nghề Nghiệp - Truyền Thông Cửu Long",
    "description": "Khám phá cơ hội nghề nghiệp dành cho Video Editor, Đạo diễn, Kỹ sư phần mềm và Marketer tại Truyền Thông Cửu Long.",
    "url": "{{ route('careers') }}"
}
</script>
@endsection
