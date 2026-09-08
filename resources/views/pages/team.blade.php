@extends('layouts.app')

@section('title', 'Đội Ngũ Chuyên Gia Senior - Truyền Thông Cửu Long')
@section('meta_description', 'Gặp gỡ đội ngũ đạo diễn, chuyên gia chỉnh màu và kỹ sư công nghệ phần mềm giàu kinh nghiệm trực tiếp đảm trách từng dự án tại Truyền Thông Cửu Long.')

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
                <span class="text-amber-400 font-bold">Đội ngũ Senior</span>
            </nav>

            <div class="text-center max-w-3xl mx-auto flex flex-col items-center gap-4">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-amber-400/10 border border-amber-400/30 text-amber-400 font-mono text-xs font-bold w-fit">
                    <span class="w-2 h-2 rounded-full bg-amber-400 animate-pulse"></span>
                    <span>SENIOR EXPERTS &amp; LEADERSHIP</span>
                </div>
                <h1 class="font-headline text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight leading-tight">
                    Những Bộ Óc Chiến Lược &amp; <br class="hidden sm:inline" />
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-400 via-orange-400 to-amber-200">Bàn Tay Thực Chiến</span> Cầm Trịch Dự Án
                </h1>
                <p class="font-body text-slate-300 text-sm sm:text-base leading-relaxed">
                    Xóa bỏ hoàn toàn nỗi e ngại "agency thuê ngoài giao việc cho thực tập sinh". Tại Truyền Thông Cửu Long, mọi dự án từ kịch bản phân cảnh, set-up ánh sáng trường quay cho đến kiến trúc mã nguồn đều do các chuyên gia Senior trực tiếp đảm trách.
                </p>
            </div>
        </div>
    </section>

    <!-- 2. Leadership & Directors (Từ Database TeamMember) -->
    <section class="py-12 lg:py-16 bg-[#0F172A] border-b border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-10 lg:mb-12">
                <span class="font-mono text-xs text-amber-400 font-bold uppercase tracking-widest">BOARD OF DIRECTORS</span>
                <h2 class="font-headline text-2xl sm:text-3xl lg:text-4xl font-extrabold mt-2">
                    Ban Giám Đốc Chuyên Môn
                </h2>
                <p class="font-body text-slate-400 text-xs sm:text-sm mt-3">
                    Người chịu trách nhiệm pháp lý, cam kết chất lượng sản phẩm và chuẩn mực kỹ thuật cao nhất.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($teamMembers as $member)
                <div class="p-6 rounded-3xl bg-[#131D38] border border-slate-700/80 hover:border-amber-400/50 hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between group">
                    <div class="flex flex-col gap-4">
                        <div class="flex items-center justify-between">
                            <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-amber-400/20 via-orange-500/20 to-slate-800 border border-amber-400/30 flex items-center justify-center font-headline text-2xl font-bold text-amber-400 shadow-inner">
                                {{ mb_substr($member->name, 0, 1) }}
                            </div>
                            <span class="px-2.5 py-1 rounded-full bg-white/5 border border-white/10 font-mono text-[10px] text-slate-400">
                                10+ Yrs Exp
                            </span>
                        </div>
                        <div>
                            <h3 class="font-headline text-lg font-bold text-white group-hover:text-amber-400 transition-colors">
                                {{ $member->name }}
                            </h3>
                            <span class="font-mono text-xs font-semibold text-amber-400 block mt-1 leading-snug">
                                {{ $member->role }}
                            </span>
                        </div>
                        <p class="font-body text-xs text-slate-300 leading-relaxed">
                            {{ $member->bio }}
                        </p>
                    </div>

                    <div class="pt-4 mt-4 border-t border-slate-700/60 flex items-center justify-between text-[11px] font-mono text-slate-400">
                        <span class="inline-flex items-center gap-1.5 text-emerald-400">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-ping"></span>
                            Trực tiếp phụ trách
                        </span>
                        <span class="text-slate-500">Key Person</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- 3. Key Capability Pillars (3 Khối chuyên môn mũi nhọn) -->
    <section class="py-12 lg:py-16 bg-[#080C16] border-b border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-10 lg:mb-12">
                <span class="font-mono text-xs text-amber-400 font-bold uppercase tracking-widest">FUNCTIONAL TEAMS</span>
                <h2 class="font-headline text-2xl sm:text-3xl lg:text-4xl font-extrabold mt-2">
                    3 Khối Nhân Sự Chuyên Môn Thực Chiến
                </h2>
                <p class="font-body text-slate-400 text-xs sm:text-sm mt-3">
                    Được tổ chức bài bản theo từng giai đoạn sản xuất và vận hành dự án.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Pillar 1: Khối Sản Xuất Nghe Nhìn -->
                <div class="p-8 rounded-3xl bg-[#0F172A] border border-slate-800 flex flex-col gap-5 hover:border-amber-400/40 transition-all">
                    <div class="w-12 h-12 rounded-2xl bg-amber-500/10 text-amber-400 flex items-center justify-center border border-amber-500/20">
                        <span class="material-symbols-outlined text-[26px]">videocam</span>
                    </div>
                    <div>
                        <span class="font-mono text-[10px] text-amber-400 uppercase tracking-wider font-bold">CINEMA &amp; POST-PRODUCTION</span>
                        <h3 class="font-headline text-xl font-bold text-white mt-1">Khối Điện Ảnh &amp; Hậu Kỳ</h3>
                    </div>
                    <p class="font-body text-xs sm:text-sm text-slate-300 leading-relaxed">
                        Tập hợp Đạo diễn hình ảnh (DOP), Cameraman chuẩn quốc tế, Drone Pilot đạt chứng chỉ an toàn bay và các Master Colorist giàu kinh nghiệm trên nền tảng DaVinci Resolve.
                    </p>
                    <div class="flex flex-wrap gap-2 pt-2">
                        <span class="px-2.5 py-1 rounded-lg bg-white/5 border border-white/10 text-slate-300 font-mono text-[10px]">Cinema Line 4K</span>
                        <span class="px-2.5 py-1 rounded-lg bg-white/5 border border-white/10 text-slate-300 font-mono text-[10px]">Colorist HDR</span>
                        <span class="px-2.5 py-1 rounded-lg bg-white/5 border border-white/10 text-slate-300 font-mono text-[10px]">3D Motion</span>
                        <span class="px-2.5 py-1 rounded-lg bg-white/5 border border-white/10 text-slate-300 font-mono text-[10px]">Sound FX 5.1</span>
                    </div>
                </div>

                <!-- Pillar 2: Khối Công Nghệ & Phần Mềm -->
                <div class="p-8 rounded-3xl bg-[#0F172A] border border-slate-800 flex flex-col gap-5 hover:border-sky-400/40 transition-all">
                    <div class="w-12 h-12 rounded-2xl bg-sky-500/10 text-sky-400 flex items-center justify-center border border-sky-500/20">
                        <span class="material-symbols-outlined text-[26px]">developer_mode</span>
                    </div>
                    <div>
                        <span class="font-mono text-[10px] text-sky-400 uppercase tracking-wider font-bold">SOFTWARE &amp; ARCHITECTURE</span>
                        <h3 class="font-headline text-xl font-bold text-white mt-1">Khối Kỹ Thuật Số &amp; Dev</h3>
                    </div>
                    <p class="font-body text-xs sm:text-sm text-slate-300 leading-relaxed">
                        Kỹ sư phần mềm Fullstack Senior, chuyên gia kiến trúc cơ sở dữ liệu phân tán, UI/UX Designer và chuyên viên kiểm thử QA/QC đảm bảo hệ thống chịu tải cao và bảo mật tuyệt đối.
                    </p>
                    <div class="flex flex-wrap gap-2 pt-2">
                        <span class="px-2.5 py-1 rounded-lg bg-white/5 border border-white/10 text-slate-300 font-mono text-[10px]">Laravel Expert</span>
                        <span class="px-2.5 py-1 rounded-lg bg-white/5 border border-white/10 text-slate-300 font-mono text-[10px]">Vue / React</span>
                        <span class="px-2.5 py-1 rounded-lg bg-white/5 border border-white/10 text-slate-300 font-mono text-[10px]">Redis Cache</span>
                        <span class="px-2.5 py-1 rounded-lg bg-white/5 border border-white/10 text-slate-300 font-mono text-[10px]">AWS / Cloud VPS</span>
                    </div>
                </div>

                <!-- Pillar 3: Khối Tăng Trưởng & Phân Phối -->
                <div class="p-8 rounded-3xl bg-[#0F172A] border border-slate-800 flex flex-col gap-5 hover:border-emerald-400/40 transition-all">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-500/10 text-emerald-400 flex items-center justify-center border border-emerald-500/20">
                        <span class="material-symbols-outlined text-[26px]">monitoring</span>
                    </div>
                    <div>
                        <span class="font-mono text-[10px] text-emerald-400 uppercase tracking-wider font-bold">PERFORMANCE &amp; GROWTH</span>
                        <h3 class="font-headline text-xl font-bold text-white mt-1">Khối Tăng Trưởng &amp; Ads</h3>
                    </div>
                    <p class="font-body text-xs sm:text-sm text-slate-300 leading-relaxed">
                        Chuyên gia hoạch định ngân sách quảng cáo TikTok &amp; Meta Ads, Data Tracking Analyst thiết lập GA4/Pixel chuẩn xác và đội ngũ Copywriter tạo phễu chuyển đổi bài bản.
                    </p>
                    <div class="flex flex-wrap gap-2 pt-2">
                        <span class="px-2.5 py-1 rounded-lg bg-white/5 border border-white/10 text-slate-300 font-mono text-[10px]">Performance Ads</span>
                        <span class="px-2.5 py-1 rounded-lg bg-white/5 border border-white/10 text-slate-300 font-mono text-[10px]">GA4 &amp; CAPI</span>
                        <span class="px-2.5 py-1 rounded-lg bg-white/5 border border-white/10 text-slate-300 font-mono text-[10px]">A/B Testing</span>
                        <span class="px-2.5 py-1 rounded-lg bg-white/5 border border-white/10 text-slate-300 font-mono text-[10px]">CRO Strategy</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. Senior Working Principles (3 Chuẩn mực làm việc) -->
    <section class="py-12 lg:py-16 bg-[#0F172A] border-b border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-10 lg:mb-12">
                <span class="font-mono text-xs text-amber-400 font-bold uppercase tracking-widest">SLA COMMITMENTS</span>
                <h2 class="font-headline text-2xl sm:text-3xl lg:text-4xl font-extrabold mt-2">
                    3 Nguyên Tắc Làm Việc Của Đội Ngũ Senior
                </h2>
                <p class="font-body text-slate-400 text-xs sm:text-sm mt-3">
                    Đảm bảo sự an tâm tuyệt đối của doanh nghiệp khi giao phó dự án quan trọng.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="p-6 rounded-3xl bg-[#131D38] border border-slate-800 flex flex-col gap-3">
                    <span class="font-mono text-2xl font-black text-amber-400">01</span>
                    <h3 class="font-headline text-lg font-bold text-white">Trực Tiếp Phản Hồi Trong 15 Phút</h3>
                    <p class="font-body text-xs text-slate-300 leading-relaxed">
                        Khách hàng làm việc trực tiếp với Đạo diễn hoặc Tech Lead phụ trách, không qua bộ phận trung gian hay nhân sự thiếu thẩm quyền ra quyết định.
                    </p>
                </div>
                <div class="p-6 rounded-3xl bg-[#131D38] border border-slate-800 flex flex-col gap-3">
                    <span class="font-mono text-2xl font-black text-amber-400">02</span>
                    <h3 class="font-headline text-lg font-bold text-white">Minh Bạch Rủi Ro Từ Đầu</h3>
                    <p class="font-body text-xs text-slate-300 leading-relaxed">
                        Cảnh báo trước mọi rủi ro về mặt kỹ thuật, thời tiết khi quay hoặc chi phí phát sinh trước khi ký kết, bảo vệ tuyệt đối lợi ích khách hàng.
                    </p>
                </div>
                <div class="p-6 rounded-3xl bg-[#131D38] border border-slate-800 flex flex-col gap-3">
                    <span class="font-mono text-2xl font-black text-amber-400">03</span>
                    <h3 class="font-headline text-lg font-bold text-white">Đồng Hành Tới Cùng Hiệu Quả</h3>
                    <p class="font-body text-xs text-slate-300 leading-relaxed">
                        Không dừng lại ở việc bàn giao file video hay mã nguồn; chúng tôi theo dõi, tư vấn đo lường chỉ số chuyển đổi thực tế cùng bộ phận marketing của doanh nghiệp.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- 5. Bottom CTA Band -->
    <section class="py-12 lg:py-16 bg-gradient-to-r from-[#0F172A] via-[#131D38] to-[#0F172A] border-t border-slate-800">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center flex flex-col items-center gap-6">
            <span class="px-3.5 py-1 rounded-full bg-amber-400/10 border border-amber-400/30 text-amber-400 font-mono text-xs font-bold">
                1-ON-1 CONSULTATION
            </span>
            <h2 class="font-headline text-2xl sm:text-4xl font-extrabold text-white">
                Trao Đổi Trực Tiếp Cùng Chuyên Gia Phụ Trách Lĩnh Vực Của Bạn
            </h2>
            <p class="font-body text-slate-300 text-xs sm:text-base leading-relaxed">
                Đặt lịch hẹn 30 phút cùng CCO hoặc CTO của chúng tôi để bóc tách nhu cầu và nhận lộ trình triển khai chi tiết cho doanh nghiệp.
            </p>
            <div class="flex flex-wrap items-center justify-center gap-4 pt-2">
                <a href="{{ route('contact') }}" class="px-6 py-3.5 rounded-xl bg-gradient-to-r from-amber-400 to-orange-500 text-navy-base font-headline text-sm font-bold shadow-lg shadow-amber-500/20 hover:brightness-110 hover:scale-[1.02] active:scale-[0.98] transition-all">
                    Đặt Lịch Trao Đổi 1-on-1
                </a>
                <a href="tel:0908898804" class="px-6 py-3.5 rounded-xl bg-white/5 border border-white/10 text-white font-headline text-sm font-bold hover:bg-white/10 transition-all flex items-center gap-2">
                    <span class="material-symbols-outlined text-[18px] text-amber-400">phone_in_talk</span>
                    <span>0908.898.804</span>
                </a>
            </div>
        </div>
    </section>

</div>

<!-- Schema JSON-LD -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "ProfilePage",
    "name": "Đội Ngũ Chuyên Gia Senior - Truyền Thông Cửu Long",
    "description": "Gặp gỡ đội ngũ đạo diễn, chuyên gia chỉnh màu và kỹ sư công nghệ phần mềm giàu kinh nghiệm trực tiếp đảm trách từng dự án tại Truyền Thông Cửu Long.",
    "url": "{{ route('team') }}",
    "mainEntity": {
        "@type": "ItemList",
        "itemListElement": [
            @foreach($teamMembers as $index => $member)
            {
                "@type": "ListItem",
                "position": {{ $index + 1 }},
                "item": {
                    "@type": "Person",
                    "name": "{{ $member->name }}",
                    "jobTitle": "{{ $member->role }}",
                    "description": "{{ $member->bio }}"
                }
            }@if(!$loop->last),@endif
            @endforeach
        ]
    }
}
</script>
@endsection
