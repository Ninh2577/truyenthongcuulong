@extends('layouts.app')

@section('title', 'Tuyển Dụng & Cơ Hội Nghề Nghiệp - Truyền Thông Cửu Long')
@section('meta_description', 'Gia nhập đội ngũ sáng tạo tại Truyền Thông Cửu Long. Khám phá cơ hội nghề nghiệp dành cho Video Editor, Đạo diễn, Kỹ sư phần mềm và Marketer.')

@section('content')
<div class="w-full">

    <!-- 1. Small Hero Section (NỀN TỐI: Deep Navy) -->
    <section class="relative pt-32 pb-12 lg:pt-36 lg:pb-16 overflow-hidden border-b border-slate-800/80 bg-[#080C16] text-white bg-dot-grid-dark">
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
                    Tại Truyền Thông Cửu Long, chúng tôi trân trọng tài năng, đam mê bứt phá và tư duy khác biệt. Môi trường làm việc năng động, trang thiết bị điện ảnh và máy trạm tân tiến nhất, cùng cơ hội dẫn dắt các dự án quy mô lớn.
                </p>
            </div>
        </div>
    </section>

    <!-- 2. Culture & Perks (NỀN SÁNG: bg-surface) -->
    <section class="py-12 lg:py-16 bg-surface bg-dot-grid-subtle border-b border-slate-200/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-10 lg:mb-12">
                <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-amber-100 border border-amber-300 text-amber-800 font-mono text-xs font-bold mb-3">
                    <span class="material-symbols-outlined text-[15px] text-amber-600">workspace_premium</span>
                    <span>WHY JOIN US</span>
                </div>
                <h2 class="font-headline text-2xl sm:text-3xl lg:text-4xl font-extrabold text-navy-base tracking-tight">
                    Môi Trường &amp; Quyền Lợi Toàn Diện
                </h2>
                <p class="font-body text-slate-600 text-xs sm:text-sm mt-3">
                    Được thiết kế để bạn thỏa sức sáng tạo và phát triển vượt bậc trong sự nghiệp.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="p-6 sm:p-8 rounded-3xl bg-white border border-slate-200/90 shadow-sm hover:border-amber-400/50 hover:shadow-md transition-all flex flex-col gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600 border border-amber-200 flex items-center justify-center">
                        <span class="material-symbols-outlined text-[26px]">workspace_premium</span>
                    </div>
                    <h3 class="font-headline text-lg font-bold text-navy-base">Thu Nhập &amp; Thưởng Dự Án Minh Bạch</h3>
                    <p class="font-body text-xs sm:text-sm text-slate-600 leading-relaxed">
                        Lương cạnh tranh theo năng lực thực tế. Thưởng nóng ngay khi đóng máy dự án và hoàn thành các cột mốc phần mềm quan trọng. Đánh giá tăng lương định kỳ 6 tháng.
                    </p>
                </div>

                <div class="p-6 sm:p-8 rounded-3xl bg-white border border-slate-200/90 shadow-sm hover:border-sky-400/50 hover:shadow-md transition-all flex flex-col gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-sky-50 text-sky-600 border border-sky-200 flex items-center justify-center">
                        <span class="material-symbols-outlined text-[26px]">videocam</span>
                    </div>
                    <h3 class="font-headline text-lg font-bold text-navy-base">Vũ Khí Làm Việc Chuẩn Cinema &amp; Workstation</h3>
                    <p class="font-body text-xs sm:text-sm text-slate-600 leading-relaxed">
                        Được trang bị máy trạm Apple M3 Max / RTX 4090, máy quay Sony Cinema Line FX3/FX6, dàn gimbal DJI Pro và hệ thống phòng dựng chuẩn màu DaVinci Resolve Studio.
                    </p>
                </div>

                <div class="p-6 sm:p-8 rounded-3xl bg-white border border-slate-200/90 shadow-sm hover:border-emerald-400/50 hover:shadow-md transition-all flex flex-col gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 border border-emerald-200 flex items-center justify-center">
                        <span class="material-symbols-outlined text-[26px]">trending_up</span>
                    </div>
                    <h3 class="font-headline text-lg font-bold text-navy-base">Kèm Cặp 1-on-1 Từ Các Senior</h3>
                    <p class="font-body text-xs sm:text-sm text-slate-600 leading-relaxed">
                        Làm việc sát cánh cùng Tổng Đạo Diễn và Tech Lead hơn 10 năm kinh nghiệm; mở rộng cơ hội thăng tiến lên vị trí Project Lead hoặc đối tác chiến lược của công ty.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. Hiring Process (NỀN TỐI: Deep Navy) -->
    <section class="relative py-12 lg:py-16 bg-[#080C16] bg-dot-grid-dark border-b border-slate-800 text-white overflow-hidden" style="background-color: #080C16 !important;">
        <!-- Ambient Glow -->
        <div class="absolute -top-24 right-10 w-96 h-96 rounded-full bg-amber-500/10 blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-24 left-10 w-96 h-96 rounded-full bg-sky-500/10 blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
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

    <!-- 4. Main Section: Left Open Positions + Right Fast Apply Form (NỀN SÁNG: bg-surface) -->
    <section class="py-12 lg:py-16 bg-surface bg-dot-grid-subtle border-b border-slate-200/80" id="apply-now">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Success Alert -->
            @if(session('success'))
            <div class="mb-8 p-5 rounded-2xl bg-emerald-50 border border-emerald-300 text-emerald-800 text-sm font-semibold flex items-center gap-3 shadow-xs">
                <span class="material-symbols-outlined text-[24px] text-emerald-600">check_circle</span>
                <span>{{ session('success') }}</span>
            </div>
            @endif

            <!-- Errors Alert -->
            @if($errors->any())
            <div class="mb-8 p-5 rounded-2xl bg-rose-50 border border-rose-300 text-rose-800 text-sm flex flex-col gap-1 shadow-xs">
                <div class="flex items-center gap-2 font-bold text-rose-700">
                    <span class="material-symbols-outlined text-[20px]">error</span>
                    <span>Vui lòng kiểm tra lại thông tin:</span>
                </div>
                <ul class="list-disc list-inside text-xs pl-6 text-rose-700">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
                
                <!-- Left: Open Positions (Col-span 7) -->
                <div class="lg:col-span-7 flex flex-col gap-6">
                    <div class="flex items-center justify-between pb-2 border-b border-slate-200">
                        <div>
                            <span class="font-mono text-xs text-primary font-bold uppercase tracking-wider">OPEN ROLES</span>
                            <h3 class="font-headline text-2xl font-bold text-navy-base mt-1">Vị Trí Đang Tuyển Dụng</h3>
                        </div>
                        <span class="font-mono text-xs text-slate-500 bg-white px-3 py-1 rounded-full border border-slate-200 shadow-2xs">
                            TP.HCM &amp; ĐBSCL
                        </span>
                    </div>

                    @if($jobs->count() > 0)
                        <div class="flex flex-col gap-4">
                            @foreach($jobs as $job)
                            <div class="p-6 rounded-3xl bg-white border border-slate-200/90 shadow-sm hover:border-primary/40 hover:shadow-md transition-all flex flex-col gap-3">
                                <div class="flex items-center justify-between">
                                    <span class="px-2.5 py-1 rounded-full bg-orange-50 text-primary font-mono text-[10px] font-bold border border-orange-200">
                                        FULL-TIME
                                    </span>
                                    <span class="text-xs font-mono text-slate-400">
                                        {{ $job->published_at ? $job->published_at->format('d/m/Y') : '' }}
                                    </span>
                                </div>
                                <h4 class="font-headline text-lg font-bold text-navy-base">{{ $job->title }}</h4>
                                <p class="font-body text-xs text-slate-600 line-clamp-2 leading-relaxed">
                                    {{ $job->summary ?: 'Tham gia phát triển dự án truyền thông và công nghệ số cho khách hàng doanh nghiệp.' }}
                                </p>
                                <div class="pt-3 border-t border-slate-100 flex items-center justify-between">
                                    <a href="{{ route('blog.show', $job->slug) }}" class="text-xs font-headline font-bold text-primary hover:underline flex items-center gap-1">
                                        Xem chi tiết JD <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
                                    </a>
                                    <span class="font-mono text-xs font-bold text-emerald-600">Thu nhập thương lượng</span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
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
                            <div class="p-6 rounded-3xl bg-white border border-slate-200/90 shadow-sm hover:border-primary/40 hover:shadow-md transition-all flex flex-col justify-between gap-4 group">
                                <div class="flex flex-col gap-2">
                                    <div class="flex items-center justify-between">
                                        <span class="px-2.5 py-0.5 rounded-full bg-orange-50 text-primary font-mono text-[10px] font-bold border border-orange-200">
                                            {{ $role['badge'] }}
                                        </span>
                                        <span class="text-xs font-mono text-slate-400">{{ $role['type'] }} &bull; {{ $role['exp'] }}</span>
                                    </div>
                                    <h4 class="font-headline text-lg font-bold text-navy-base group-hover:text-primary transition-colors">
                                        {{ $role['title'] }}
                                    </h4>
                                    <p class="font-body text-xs text-slate-600 leading-relaxed">
                                        {{ $role['desc'] }}
                                    </p>
                                </div>
                                <div class="pt-3 border-t border-slate-100 flex items-center justify-between">
                                    <a href="#cv-form" class="text-xs font-headline font-bold text-primary hover:underline flex items-center gap-1">
                                        Ứng tuyển ngay <span class="material-symbols-outlined text-[14px]">arrow_downward</span>
                                    </a>
                                    <span class="font-mono text-xs font-bold text-emerald-600">Thu nhập thương lượng theo năng lực</span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @endif

                    <!-- Talent pool note -->
                    <div class="p-5 rounded-2xl bg-amber-50/70 border border-amber-200/80 text-xs text-slate-700 flex items-start gap-3">
                        <span class="material-symbols-outlined text-amber-600 shrink-0 text-[20px]">lightbulb</span>
                        <div>
                            <span class="font-bold text-navy-base">Talent Pool:</span> Chưa thấy vị trí phù hợp nhưng tin mình có năng lực? Bạn có thể gửi hồ sơ tự do qua form bên cạnh hoặc email <a href="mailto:tuyendung@truyenthongcuulong.com" class="text-primary font-bold hover:underline">tuyendung@truyenthongcuulong.com</a>.
                        </div>
                    </div>
                </div>

                <!-- Right: Fast Apply Form (Col-span 5) (NỀN TRẮNG, VIỀN ĐẸP) -->
                <div class="lg:col-span-5 p-6 sm:p-8 rounded-3xl bg-white border border-slate-200 shadow-xl flex flex-col gap-5 sticky top-28" id="cv-form">
                    <div class="flex items-center gap-3 border-b border-slate-100 pb-4">
                        <div class="w-10 h-10 rounded-xl bg-orange-100 text-primary flex items-center justify-center shrink-0 border border-orange-200">
                            <span class="material-symbols-outlined text-[22px]">send</span>
                        </div>
                        <div>
                            <h3 class="font-headline text-lg font-bold text-navy-base">Nộp Hồ Sơ Nhanh</h3>
                            <p class="text-xs text-slate-500">Gửi CV ứng tuyển trực tiếp đến Ban Nhân Sự</p>
                        </div>
                    </div>

                    <form action="{{ route('careers.apply') }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-3.5">
                        @csrf
                        <div>
                            <label class="block font-headline text-xs font-bold text-slate-700 mb-1">
                                Họ và tên của bạn <span class="text-primary">*</span>
                            </label>
                            <input type="text" name="fullname" value="{{ old('fullname') }}" placeholder="Ví dụ: Nguyễn Văn A" required 
                                   class="w-full px-3.5 py-2.5 rounded-xl bg-slate-50 border border-slate-200 text-xs text-navy-base placeholder:text-slate-400 focus:ring-2 focus:ring-primary focus:border-transparent focus:outline-none transition-all">
                        </div>

                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block font-headline text-xs font-bold text-slate-700 mb-1">
                                    Số điện thoại <span class="text-primary">*</span>
                                </label>
                                <input type="tel" name="phone" value="{{ old('phone') }}" placeholder="0908 xxx xxx" required 
                                       class="w-full px-3.5 py-2.5 rounded-xl bg-slate-50 border border-slate-200 text-xs text-navy-base placeholder:text-slate-400 focus:ring-2 focus:ring-primary focus:border-transparent focus:outline-none transition-all">
                            </div>
                            <div>
                                <label class="block font-headline text-xs font-bold text-slate-700 mb-1">
                                    Email <span class="text-primary">*</span>
                                </label>
                                <input type="email" name="email" value="{{ old('email') }}" placeholder="you@email.com" required 
                                       class="w-full px-3.5 py-2.5 rounded-xl bg-slate-50 border border-slate-200 text-xs text-navy-base placeholder:text-slate-400 focus:ring-2 focus:ring-primary focus:border-transparent focus:outline-none transition-all">
                            </div>
                        </div>

                        <div>
                            <label class="block font-headline text-xs font-bold text-slate-700 mb-1">
                                Vị trí bạn muốn ứng tuyển <span class="text-primary">*</span>
                            </label>
                            <select name="position" required 
                                    class="w-full px-3.5 py-2.5 rounded-xl bg-slate-50 border border-slate-200 text-xs text-navy-base focus:ring-2 focus:ring-primary focus:border-transparent focus:outline-none transition-all">
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
                            <label class="block font-headline text-xs font-bold text-slate-700 mb-1">
                                Tải lên File CV (PDF/DOCX tối đa 10MB) <span class="text-primary">*</span>
                            </label>
                            <input type="file" name="cv_file" accept=".pdf,.doc,.docx" required 
                                   class="w-full text-xs text-slate-600 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-orange-100 file:text-primary hover:file:bg-orange-200 border border-slate-200 rounded-xl bg-slate-50 cursor-pointer">
                        </div>

                        <div>
                            <label class="block font-headline text-xs font-bold text-slate-700 mb-1">
                                Lời nhắn / Link Portfolio, Showreel
                            </label>
                            <textarea name="cover_letter" rows="3" placeholder="Chia sẻ kinh nghiệm hoặc đường dẫn Behance, Drive, Showreel của bạn..." 
                                      class="w-full px-3.5 py-2.5 rounded-xl bg-slate-50 border border-slate-200 text-xs text-navy-base placeholder:text-slate-400 focus:ring-2 focus:ring-primary focus:border-transparent focus:outline-none transition-all">{{ old('cover_letter') }}</textarea>
                        </div>

                        <button type="submit" 
                                class="mt-2 w-full py-3.5 rounded-xl bg-gradient-to-r from-primary via-orange-500 to-accent-amber text-white font-headline text-xs font-bold shadow-md shadow-primary/25 hover:brightness-110 hover:scale-[1.01] active:scale-[0.99] transition-all">
                            Nộp Hồ Sơ Ứng Tuyển Ngay
                        </button>
                    </form>
                </div>

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
