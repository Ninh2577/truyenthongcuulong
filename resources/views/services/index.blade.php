@extends('layouts.app')

@section('title', 'Dịch Vụ Cốt Lõi - Cửu Long Media & Technology Hub')
@section('meta_description', 'Khám phá hệ sinh thái dịch vụ toàn diện: Sản xuất phim TVC 4K, Thiết kế Web/App chịu tải cao, Chiến dịch truyền thông số và Tích hợp Trí tuệ nhân tạo AI.')

@section('content')
<div class="w-full bg-surface bg-dot-grid-subtle pt-28 pb-20 border-b border-slate-200/60">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col gap-20">
        
        <!-- Header -->
        <div class="text-center max-w-3xl mx-auto flex flex-col gap-3">
            <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-orange-100 border border-orange-300 text-primary font-mono text-xs font-bold mx-auto">
                <span class="w-2 h-2 rounded-full bg-primary animate-pulse"></span>
                <span>COMPREHENSIVE DIGITAL CAPABILITIES</span>
            </div>
            <h1 class="font-headline text-3xl sm:text-5xl font-extrabold text-navy-base tracking-tight">
                Hệ Sinh Thái Dịch Vụ <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary via-orange-500 to-accent-coral">Tích Hợp 3-in-1</span>
            </h1>
            <p class="font-body text-slate-600 text-sm sm:text-base leading-relaxed">
                Hợp nhất năng lực Điện ảnh, Kỹ thuật Phần mềm và Chiến lược Quảng cáo tạo nên vòng tròn tăng trưởng khép kín cho doanh nghiệp.
            </p>
        </div>

        <!-- 3 Pillars Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Pillar 1: Web & App (Tech) -->
            <div class="group rounded-3xl p-8 bg-gradient-to-b from-navy-surface via-[#0a1830] to-navy-base text-white border border-sky-500/30 shadow-xl hover:border-sky-400 hover:shadow-2xl transition-all duration-300 flex flex-col justify-between relative overflow-hidden">
                <div class="absolute -top-4 -right-4 font-mono text-6xl font-black text-sky-500/10 pointer-events-none">&lt;/&gt;</div>
                <div class="flex flex-col gap-6 relative z-10">
                    <div class="flex items-center justify-between">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-sky-500 to-blue-700 flex items-center justify-center text-white shadow-lg shadow-sky-500/30">
                            <span class="material-symbols-outlined text-[28px]">terminal</span>
                        </div>
                        <span class="font-mono text-[11px] text-sky-300 bg-sky-950/80 border border-sky-400/30 px-3 py-1 rounded-full font-bold">PILLAR 01</span>
                    </div>
                    <div class="flex flex-col gap-2">
                        <h3 class="font-headline text-2xl font-bold text-white group-hover:text-sky-300 transition-colors">
                            Thiết Kế &amp; Lập Trình Web/App
                        </h3>
                        <p class="font-body text-sm text-slate-300 leading-relaxed">
                            Xây dựng hệ thống phần mềm chịu tải cao, kiến trúc Microservices, portal tin tức, sàn thương mại điện tử và ứng dụng di động Flutter iOS/Android.
                        </p>
                    </div>
                    <div class="flex flex-wrap gap-2 pt-2">
                        <span class="px-3 py-1 rounded-full bg-white/10 text-sky-300 text-xs font-mono border border-sky-400/20">Laravel 11 &amp; Next.js</span>
                        <span class="px-3 py-1 rounded-full bg-white/10 text-sky-300 text-xs font-mono border border-sky-400/20">Flutter Mobile Apps</span>
                        <span class="px-3 py-1 rounded-full bg-white/10 text-sky-300 text-xs font-mono border border-sky-400/20">Microservices Architecture</span>
                    </div>
                </div>
                <div class="pt-6 mt-6 border-t border-white/10 relative z-10">
                    <a href="{{ route('services.show', 'thiet-ke-website-chuyen-nghiep') }}" class="inline-flex items-center gap-2 font-headline text-sm font-bold text-sky-400 hover:text-sky-300 transition-colors group/link">
                        <span>Chi tiết giải pháp Web/App</span>
                        <span class="material-symbols-outlined text-[18px] group-hover/link:translate-x-1 transition-transform">arrow_forward</span>
                    </a>
                </div>
            </div>

            <!-- Pillar 2: Video & TVC (Studio) -->
            <div class="group rounded-3xl p-8 bg-gradient-to-b from-white via-orange-50/50 to-amber-50/70 border-2 border-orange-300 shadow-xl hover:border-primary hover:shadow-2xl transition-all duration-300 flex flex-col justify-between relative overflow-hidden">
                <div class="absolute top-0 left-0 right-0 h-3 bg-navy-base flex items-center justify-around px-2">
                    <div class="w-1.5 h-1.5 rounded-xs bg-white/80"></div>
                    <div class="w-1.5 h-1.5 rounded-xs bg-white/80"></div>
                    <div class="w-1.5 h-1.5 rounded-xs bg-white/80"></div>
                    <div class="w-1.5 h-1.5 rounded-xs bg-white/80"></div>
                    <div class="w-1.5 h-1.5 rounded-xs bg-white/80"></div>
                    <div class="w-1.5 h-1.5 rounded-xs bg-white/80"></div>
                </div>
                <div class="flex flex-col gap-6 pt-3 relative z-10">
                    <div class="flex items-center justify-between">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-primary via-orange-500 to-accent-amber flex items-center justify-center text-white shadow-lg shadow-orange-500/30">
                            <span class="material-symbols-outlined text-[28px]">movie_edit</span>
                        </div>
                        <span class="font-mono text-[11px] text-primary bg-orange-100 border border-orange-300 px-3 py-1 rounded-full font-bold">PILLAR 02</span>
                    </div>
                    <div class="flex flex-col gap-2">
                        <h3 class="font-headline text-2xl font-bold text-navy-base group-hover:text-primary transition-colors">
                            Quay Dựng Phim &amp; Sản Xuất Media
                        </h3>
                        <p class="font-body text-sm text-slate-600 leading-relaxed">
                            Sản xuất TVC doanh nghiệp 4K, video viral triệu view, kỹ xảo 3D CGI/VFX, flycam FPV và chuỗi nội dung ngắn Shorts/Reels/TikTok tối ưu hóa chuyển đổi.
                        </p>
                    </div>
                    <div class="flex flex-wrap gap-2 pt-2">
                        <span class="px-3 py-1 rounded-full bg-orange-100 text-primary text-xs font-semibold border border-orange-200">TVC Doanh Nghiệp 4K</span>
                        <span class="px-3 py-1 rounded-full bg-orange-100 text-primary text-xs font-semibold border border-orange-200">3D Motion &amp; VFX</span>
                        <span class="px-3 py-1 rounded-full bg-orange-100 text-primary text-xs font-semibold border border-orange-200">DaVinci HDR Grading</span>
                    </div>
                </div>
                <div class="pt-6 mt-6 border-t border-orange-200 relative z-10">
                    <a href="{{ route('services.show', 'san-xuat-video-media') }}" class="inline-flex items-center gap-2 font-headline text-sm font-bold text-primary hover:text-primary-hover transition-colors group/link">
                        <span>Chi tiết gói sản xuất Media</span>
                        <span class="material-symbols-outlined text-[18px] group-hover/link:translate-x-1 transition-transform">arrow_forward</span>
                    </a>
                </div>
            </div>

            <!-- Pillar 3: Marketing & Ads (Agency) -->
            <div class="group rounded-3xl p-8 bg-gradient-to-br from-amber-500/10 via-rose-50/50 to-orange-100/40 border-2 border-rose-300 shadow-xl hover:border-accent-coral hover:shadow-2xl transition-all duration-300 flex flex-col justify-between relative overflow-hidden">
                <div class="flex flex-col gap-6 relative z-10">
                    <div class="flex items-center justify-between">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-accent-coral via-rose-500 to-amber-500 flex items-center justify-center text-white shadow-lg shadow-rose-500/30">
                            <span class="material-symbols-outlined text-[28px]">campaign</span>
                        </div>
                        <span class="font-mono text-[11px] text-accent-coral bg-rose-100 border border-rose-300 px-3 py-1 rounded-full font-bold">PILLAR 03</span>
                    </div>
                    <div class="flex flex-col gap-2">
                        <h3 class="font-headline text-2xl font-bold text-navy-base group-hover:text-accent-coral transition-colors">
                            Quảng Cáo &amp; Truyền Thông Số
                        </h3>
                        <p class="font-body text-sm text-slate-600 leading-relaxed">
                            Booking PR báo chí chính thống (VnExpress, Forbes, CafeF), tối ưu quảng cáo đa kênh Google/Meta/TikTok Shop với cam kết ROAS thực tế và nền tảng CDP.
                        </p>
                    </div>
                    <div class="flex flex-wrap gap-2 pt-2">
                        <span class="px-3 py-1 rounded-full bg-rose-100 text-rose-700 text-xs font-semibold border border-rose-200">Booking PR Báo Chí</span>
                        <span class="px-3 py-1 rounded-full bg-rose-100 text-rose-700 text-xs font-semibold border border-rose-200">Performance Ads Omnichannel</span>
                        <span class="px-3 py-1 rounded-full bg-rose-100 text-rose-700 text-xs font-semibold border border-rose-200">MarTech Automation</span>
                    </div>
                </div>
                <div class="pt-6 mt-6 border-t border-rose-200 relative z-10">
                    <a href="{{ route('services.show', 'digital-marketing-quang-cao') }}" class="inline-flex items-center gap-2 font-headline text-sm font-bold text-accent-coral hover:text-rose-600 transition-colors group/link">
                        <span>Chi tiết gói Growth Marketing</span>
                        <span class="material-symbols-outlined text-[18px] group-hover/link:translate-x-1 transition-transform">arrow_forward</span>
                    </a>
                </div>
            </div>

        </div>

        <!-- Dedicated AI Solutions Banner -->
        <div class="p-8 sm:p-12 rounded-3xl bg-gradient-to-r from-navy-base via-indigo-950 to-navy-card text-white border border-indigo-500/40 shadow-2xl flex flex-col lg:flex-row items-center justify-between gap-8 relative overflow-hidden">
            <div class="absolute -right-20 -top-20 w-80 h-80 rounded-full bg-indigo-500/20 blur-3xl pointer-events-none"></div>
            <div class="flex flex-col gap-3 max-w-2xl relative z-10">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-indigo-500/20 border border-indigo-400/30 text-indigo-300 font-mono text-xs font-bold w-fit">
                    <span class="material-symbols-outlined text-[16px]">smart_toy</span>
                    <span>AI ENTERPRISE SOLUTIONS</span>
                </div>
                <h3 class="font-headline text-2xl sm:text-3xl font-extrabold text-white">
                    Tích Hợp Trí Tuệ Nhân Tạo (AI Solutions &amp; Automation)
                </h3>
                <p class="font-body text-sm text-slate-300 leading-relaxed">
                    Xây dựng trợ lý ảo AI RAG được huấn luyện riêng theo dữ liệu doanh nghiệp, hệ thống tự động tổng hợp tin tức và tối ưu hóa quy trình chăm sóc khách hàng 24/7.
                </p>
            </div>
            <a href="{{ route('services.show', 'tich-hop-ai-solutions') }}" class="shrink-0 px-8 py-4 rounded-full bg-gradient-to-r from-indigo-500 to-sky-500 text-white font-headline text-xs sm:text-sm font-bold shadow-lg hover:scale-105 transition-all relative z-10">
                Khám Phá Giải Pháp AI
            </a>
        </div>

        <!-- 5-Step Unified Process -->
        <div class="flex flex-col gap-10">
            <div class="text-center max-w-2xl mx-auto flex flex-col gap-2">
                <span class="font-mono text-xs text-primary font-bold uppercase tracking-widest">WORKFLOW EXCELLENCE</span>
                <h2 class="font-headline text-3xl sm:text-4xl font-extrabold text-navy-base">
                    Quy Trình Triển Khai Chuẩn 5 Bước
                </h2>
                <p class="font-body text-xs sm:text-sm text-slate-500">
                    Minh bạch từng giai đoạn, cam kết tiến độ và chất lượng sản phẩm theo hợp đồng kinh tế.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
                <div class="p-6 rounded-3xl bg-white border border-slate-200 shadow-2xs flex flex-col gap-3">
                    <span class="font-mono text-2xl font-black text-primary">01</span>
                    <h4 class="font-headline text-base font-bold text-navy-base">Khảo Sát &amp; Lập Brief</h4>
                    <p class="text-xs text-slate-500 leading-relaxed">Phân tích thị trường, xác định mục tiêu kinh doanh và phác thảo giải pháp khả thi.</p>
                </div>
                <div class="p-6 rounded-3xl bg-white border border-slate-200 shadow-2xs flex flex-col gap-3">
                    <span class="font-mono text-2xl font-black text-accent-amber">02</span>
                    <h4 class="font-headline text-base font-bold text-navy-base">Kịch Bản &amp; Wireframe</h4>
                    <p class="text-xs text-slate-500 leading-relaxed">Viết kịch bản chi tiết / phân cảnh TVC và thiết kế bản vẽ kiến trúc giao diện phần mềm.</p>
                </div>
                <div class="p-6 rounded-3xl bg-white border border-slate-200 shadow-2xs flex flex-col gap-3">
                    <span class="font-mono text-2xl font-black text-sky-600">03</span>
                    <h4 class="font-headline text-base font-bold text-navy-base">Sản Xuất &amp; Code</h4>
                    <p class="text-xs text-slate-500 leading-relaxed">Bấm máy quay hiện trường chuẩn 4K Cine và lập trình mã nguồn hệ thống phần mềm.</p>
                </div>
                <div class="p-6 rounded-3xl bg-white border border-slate-200 shadow-2xs flex flex-col gap-3">
                    <span class="font-mono text-2xl font-black text-emerald-600">04</span>
                    <h4 class="font-headline text-base font-bold text-navy-base">Hậu Kỳ &amp; Testing</h4>
                    <p class="text-xs text-slate-500 leading-relaxed">Dựng phim DaVinci HDR, hòa âm 5.1 và kiểm thử hiệu năng chịu tải phần mềm.</p>
                </div>
                <div class="p-6 rounded-3xl bg-white border border-slate-200 shadow-2xs flex flex-col gap-3">
                    <span class="font-mono text-2xl font-black text-purple-600">05</span>
                    <h4 class="font-headline text-base font-bold text-navy-base">Bàn Giao &amp; Chạy Ads</h4>
                    <p class="text-xs text-slate-500 leading-relaxed">Nghiệm thu toàn diện, bàn giao bản quyền và kích hoạt chiến dịch quảng cáo đa kênh.</p>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
