@extends('layouts.app')

@section('title', 'Mạng Lưới Đối Tác Chiến Lược - Truyền Thông Cửu Long')
@section('meta_description', 'Danh sách các đối tác hạ tầng công nghệ và du lịch lữ hành đồng hành bền vững cùng Truyền Thông Cửu Long.')

@push('styles')
<style>
.partner-card-stagger {
    opacity: 0;
    transform: translateY(20px);
    transition: opacity 0.45s cubic-bezier(0.16, 1, 0.3, 1), transform 0.45s cubic-bezier(0.16, 1, 0.3, 1);
}
.partner-card-stagger.revealed {
    opacity: 1;
    transform: translateY(0);
}

/* Base card transition */
.partner-card-base {
    transition: transform 0.28s cubic-bezier(0.34, 1.56, 0.64, 1), box-shadow 0.28s ease, border-color 0.28s ease;
}

/* 1. TOP PARTNER CARDS (Row 1 - Most Prominent) */
.partner-card-top {
    background: linear-gradient(135deg, #111a33 0%, #172445 50%, #0F172A 100%);
    border: 1px solid rgba(251, 191, 36, 0.38);
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.45), 0 0 20px rgba(251, 191, 36, 0.08);
}
.partner-card-top:hover {
    transform: translateY(-8px);
    border-color: rgba(251, 191, 36, 0.85) !important;
    box-shadow: 0 0 0 1px rgba(251, 191, 36, 0.5), 0 20px 48px rgba(0, 0, 0, 0.6), 0 0 36px rgba(251, 191, 36, 0.25) !important;
}

/* 2. GOLD PARTNER CARDS (Row 2 - Elevated Tier) */
.partner-card-gold {
    background: linear-gradient(135deg, #0F172A 0%, #151f36 50%, #0F172A 100%);
    border: 1px solid rgba(251, 191, 36, 0.24);
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.35);
}
.partner-card-gold:hover {
    transform: translateY(-6px);
    border-color: rgba(251, 191, 36, 0.65) !important;
    box-shadow: 0 0 0 1px rgba(251, 191, 36, 0.35), 0 16px 40px rgba(0, 0, 0, 0.5), 0 0 24px rgba(251, 191, 36, 0.15) !important;
}

/* 3. STRATEGIC PARTNER CARDS (Rows 3-5 - Dynamic Accent Glow) */
.partner-card-strategic {
    background: #0F172A;
    border: 1px solid rgba(51, 65, 85, 0.7);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
}
.partner-card-strategic:hover {
    transform: translateY(-5px);
    border-color: var(--card-border-hover, #38bdf8) !important;
    box-shadow: 0 16px 36px rgba(0, 0, 0, 0.5), 0 0 20px var(--card-glow-hover, rgba(56, 189, 248, 0.15)) !important;
}
</style>
@endpush

@section('content')
<div class="w-full">

    {{-- 1. Hero (NỀN TỐI) — overflow-hidden ngăn gradient/nội dung rò sang section sáng --}}
    <section class="relative pt-32 pb-12 lg:pt-36 lg:pb-16 overflow-hidden border-b border-slate-800/80 bg-[#080C16] text-white bg-dot-grid-dark">
        <div class="absolute inset-0 bg-gradient-to-b from-transparent via-transparent to-[#080C16] pointer-events-none"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[320px] rounded-full bg-amber-500/8 blur-[80px] pointer-events-none"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <nav class="flex items-center gap-2 text-xs font-mono text-slate-400 mb-6" aria-label="Breadcrumb">
                <a href="{{ route('home') }}" class="hover:text-amber-400 transition-colors">Trang chủ</a>
                <span class="text-slate-600">/</span>
                <a href="{{ route('about') }}" class="hover:text-amber-400 transition-colors">Về chúng tôi</a>
                <span class="text-slate-600">/</span>
                <span class="text-amber-400 font-bold">Đối tác chiến lược</span>
            </nav>
            <div class="text-center max-w-3xl mx-auto flex flex-col items-center gap-4">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-amber-400/10 border border-amber-400/30 text-amber-400 font-mono text-xs font-bold w-fit">
                    <span class="w-2 h-2 rounded-full bg-amber-400 animate-pulse"></span>
                    <span>OFFICIAL PARTNERS</span>
                </div>
                <h1 class="font-headline text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight leading-tight">
                    Mạng Lưới Đối Tác <br class="hidden sm:inline" />
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-400 via-orange-400 to-amber-200">Đồng Hành Bền Vững</span> Cùng CLM
                </h1>
                <p class="font-body text-slate-300 text-sm sm:text-base leading-relaxed">
                    Hơn 10 năm hoạt động, Truyền Thông Cửu Long tự hào xây dựng mối liên minh bền vững cùng các nhà cung cấp hạ tầng số uy tín và các đối tác lữ hành, khu bảo tồn sinh thái và đơn vị sự kiện thực chiến.
                </p>
                <div class="grid grid-cols-3 gap-4 pt-4 w-full max-w-lg">
                    <div class="p-3.5 rounded-2xl bg-[#0F172A] border border-slate-800 text-center shadow-sm">
                        <span class="font-headline text-2xl font-black text-amber-400">17+</span>
                        <p class="text-[11px] font-mono text-slate-400 mt-0.5">Đối tác chiến lược</p>
                    </div>
                    <div class="p-3.5 rounded-2xl bg-[#0F172A] border border-slate-800 text-center shadow-sm">
                        <span class="font-headline text-2xl font-black text-white">10+</span>
                        <p class="text-[11px] font-mono text-slate-400 mt-0.5">Năm gắn kết</p>
                    </div>
                    <div class="p-3.5 rounded-2xl bg-[#0F172A] border border-slate-800 text-center shadow-sm">
                        <span class="font-headline text-2xl font-black text-emerald-400">100%</span>
                        <p class="text-[11px] font-mono text-slate-400 mt-0.5">Chuẩn SLA</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- 2. Hạ Tầng Công Nghệ (NỀN SÁNG) --}}
    <section class="py-12 lg:py-16 bg-surface bg-dot-grid-subtle border-b border-slate-200/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-8">
                <div>
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-sky-100 border border-sky-300 text-sky-800 font-mono text-xs font-bold mb-2">
                        <span class="material-symbols-outlined text-[15px] text-sky-600">dns</span>
                        <span>CLOUD &amp; HOSTING INFRASTRUCTURE</span>
                    </div>
                    <h2 class="font-headline text-2xl sm:text-3xl font-extrabold text-navy-base tracking-tight">Đối Tác Hạ Tầng Máy Chủ &amp; Tên Miền</h2>
                </div>
                <p class="font-body text-xs text-slate-600 max-w-md">Nền tảng máy chủ đám mây vững chắc bảo đảm 99.9% uptime cho mọi website và ứng dụng của khách hàng.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="p-8 rounded-3xl bg-white border border-slate-200/90 shadow-sm hover:border-primary/40 hover:shadow-md transition-all duration-300 flex flex-col justify-between group">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <span class="px-3 py-1 rounded-full bg-sky-50 text-sky-700 font-mono text-xs font-bold border border-sky-200">DOMAIN &amp; CLOUD HOSTING</span>
                            <span class="text-xs font-mono text-slate-500">Đối tác lâu năm</span>
                        </div>
                        <h3 class="font-headline text-2xl font-bold text-navy-base group-hover:text-primary transition-colors">P.A Việt Nam</h3>
                        <p class="font-body text-xs sm:text-sm text-slate-600 mt-3 leading-relaxed">Nhà đăng ký tên miền và cung cấp dịch vụ máy chủ lớn nhất Việt Nam. Đối tác chiến lược đồng hành cung cấp giải pháp trung tâm dữ liệu chuẩn Tier 3, Cloud VPS và chứng chỉ bảo mật SSL cho các hệ thống doanh nghiệp do CLM xây dựng.</p>
                    </div>
                    <div class="pt-6 mt-6 border-t border-slate-100 flex items-center justify-between text-xs font-mono text-slate-500">
                        <span class="text-emerald-600 font-semibold flex items-center gap-1"><span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>Hạ tầng Tier 3</span>
                        <span>Đăng ký Domain .VN / Quốc tế</span>
                    </div>
                </div>
                <div class="p-8 rounded-3xl bg-white border border-slate-200/90 shadow-sm hover:border-amber-400/40 hover:shadow-md transition-all duration-300 flex flex-col justify-between group">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <span class="px-3 py-1 rounded-full bg-amber-50 text-amber-800 font-mono text-xs font-bold border border-amber-200">INTERNATIONAL CLOUD HOSTING</span>
                            <span class="text-xs font-mono text-slate-500">Đối tác quốc tế</span>
                        </div>
                        <h3 class="font-headline text-2xl font-bold text-navy-base group-hover:text-amber-600 transition-colors">Hawk Host</h3>
                        <p class="font-body text-xs sm:text-sm text-slate-600 mt-3 leading-relaxed">Nhà cung cấp điện toán đám mây và Hosting hiệu năng cao hàng đầu Bắc Mỹ với máy chủ đặt tại Hong Kong và Singapore. Cung cấp hạ tầng tốc độ tải trang cực nhanh và khả năng chống DDoS ổn định cho các cổng thông tin quốc tế.</p>
                    </div>
                    <div class="pt-6 mt-6 border-t border-slate-100 flex items-center justify-between text-xs font-mono text-slate-500">
                        <span class="text-emerald-600 font-semibold flex items-center gap-1"><span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>LiteSpeed Web Server</span>
                        <span>Multi-Datacenter Routing</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- 3. Mạng Lưới Đối Tác Lữ Hành, Du Lịch & Sự Kiện (NỀN TỐI) — 15 Card Đúng 100% Dữ Liệu Thật Với Phân Tầng Thị Giác Rõ Ràng --}}
    <section class="py-16 lg:py-24 bg-[#080C16] text-white border-b border-slate-800/80 relative overflow-hidden" style="background-image: radial-gradient(rgba(251, 191, 36, 0.12) 1.5px, transparent 1.5px), radial-gradient(rgba(255, 255, 255, 0.08) 1px, transparent 1px); background-size: 28px 28px;">
        {{-- Visible Ambient Glow Textures behind Cards --}}
        <div class="absolute top-10 left-1/2 -translate-x-1/2 w-[850px] h-[360px] rounded-full bg-amber-500/10 blur-[110px] pointer-events-none"></div>
        <div class="absolute bottom-12 left-10 w-[550px] h-[320px] rounded-full bg-sky-500/8 blur-[100px] pointer-events-none"></div>
        <div class="absolute bottom-20 right-10 w-[500px] h-[300px] rounded-full bg-emerald-500/8 blur-[100px] pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-12">
                <div>
                    <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-amber-400/10 border border-amber-400/30 text-amber-400 font-mono text-xs font-bold mb-3">
                        <span class="material-symbols-outlined text-[15px]">travel_explore</span>
                        <span>TOURISM, TRAVEL &amp; EVENTS NETWORK</span>
                    </div>
                    <h2 class="font-headline text-2xl sm:text-3xl lg:text-4xl font-extrabold tracking-tight">Đối Tác Du Lịch, Lữ Hành &amp; Tổ Chức Sự Kiện</h2>
                    <p class="font-body text-slate-400 text-xs sm:text-sm mt-2 max-w-xl">Mạng lưới 15 đơn vị lữ hành, nghỉ dưỡng sinh thái và tổ chức sự kiện chuyên nghiệp đồng hành chặt chẽ trong các chiến dịch truyền thông quảng bá du lịch và tác nghiệp thực địa.</p>
                </div>
                <div class="flex items-center gap-2.5 text-xs font-mono flex-wrap">
                    <span class="flex items-center gap-1.5 text-amber-300 font-bold px-3 py-1 rounded-full bg-amber-400/15 border border-amber-400/40">
                        <span class="w-2 h-2 rounded-full bg-amber-400"></span> 3 Top Partners
                    </span>
                    <span class="flex items-center gap-1.5 text-amber-400 font-medium px-3 py-1 rounded-full bg-amber-400/10 border border-amber-400/25">
                        <span class="w-2 h-2 rounded-full bg-amber-400/70"></span> 3 Gold Partners
                    </span>
                    <span class="flex items-center gap-1.5 text-slate-400 px-3 py-1 rounded-full bg-slate-800/80 border border-slate-700">
                        <span class="w-2 h-2 rounded-full bg-slate-500"></span> 9 Strategic
                    </span>
                </div>
            </div>

            @php
            $travelPartners = [
                // === HÀNG 1: NHÓM TOP PARTNER (3 ĐỐI TÁC TIÊU BIỂU - HÀNG 1 NỔI BẬT NHẤT) ===
                [
                    'name' => 'Long Trekking',
                    'cat' => 'Trekking & Du Lịch Mạo Hiểm',
                    'desc' => 'Đơn vị tiên phong tổ chức các tuyến tour trekking khám phá rừng nguyên sinh, sinh tồn dã ngoại và gắn kết văn hóa bản địa bền vững.',
                    'tier' => 'top',
                    'badge' => 'TOP PARTNER',
                    'icon' => 'terrain',
                    'icon_color' => 'text-amber-400',
                    'icon_bg' => 'bg-amber-400/15 border-amber-400/35',
                    'tag' => 'Đối tác trekking số 1',
                    'tag_badge' => 'Top Partner',
                    'tag_color' => 'text-amber-300 font-bold'
                ],
                [
                    'name' => 'Láng Sen',
                    'cat' => 'Khu Bảo Tồn Sinh Thái Ramsar',
                    'desc' => 'Khu bảo tồn đất ngập nước Ramsar quốc tế vùng Đồng Tháp Mười, bảo tồn đa dạng sinh học và phát triển du lịch sinh thái trải nghiệm bền vững.',
                    'tier' => 'top',
                    'badge' => 'TOP PARTNER',
                    'icon' => 'forest',
                    'icon_color' => 'text-emerald-400',
                    'icon_bg' => 'bg-emerald-400/15 border-emerald-400/35',
                    'tag' => 'Khu bảo tồn Ramsar',
                    'tag_badge' => 'Top Partner',
                    'tag_color' => 'text-amber-300 font-bold'
                ],
                [
                    'name' => 'Nam Tây Nguyên',
                    'cat' => 'Khám Phá Cao Nguyên & Dã Ngoại',
                    'desc' => 'Chuyên gia dã ngoại sinh thái, cắm trại glamping và các tuyến tour khám phá đại ngàn cao nguyên Lâm Đồng — Đắk Nông hùng vĩ.',
                    'tier' => 'top',
                    'badge' => 'TOP PARTNER',
                    'icon' => 'hiking',
                    'icon_color' => 'text-orange-400',
                    'icon_bg' => 'bg-orange-400/15 border-orange-400/35',
                    'tag' => 'Sinh thái đại ngàn',
                    'tag_badge' => 'Top Partner',
                    'tag_color' => 'text-amber-300 font-bold'
                ],

                // === HÀNG 2: NHÓM GOLD PARTNER (3 ĐỐI TÁC LỮ HÀNH & SỰ KIỆN - VIỀN NHỈNH HƠN STRATEGIC) ===
                [
                    'name' => 'MTC Travel',
                    'cat' => 'Lữ Hành & Sự Kiện Trọn Gói',
                    'desc' => 'Tổ chức tour du lịch trọn gói, điều hành gala tri ân và hội nghị khách hàng doanh nghiệp quy mô lớn trên toàn quốc.',
                    'tier' => 'gold',
                    'badge' => 'GOLD PARTNER',
                    'icon' => 'travel_explore',
                    'icon_color' => 'text-amber-300',
                    'icon_bg' => 'bg-amber-300/10 border-amber-300/25',
                    'tag' => 'Lữ hành trọn gói',
                    'tag_badge' => 'Gold Partner',
                    'tag_color' => 'text-amber-400 font-bold'
                ],
                [
                    'name' => 'Gonatour',
                    'cat' => 'Du Lịch Trong & Ngoài Nước',
                    'desc' => 'Công ty cổ phần thương mại dịch vụ du lịch Gonatour với mạng lưới tuyến điểm toàn quốc và hệ thống đặt vé tự động.',
                    'tier' => 'gold',
                    'badge' => 'GOLD PARTNER',
                    'icon' => 'flight_takeoff',
                    'icon_color' => 'text-sky-400',
                    'icon_bg' => 'bg-sky-400/10 border-sky-400/25',
                    'tag' => 'Mạng lưới tour đa tuyến',
                    'tag_badge' => 'Gold Partner',
                    'tag_color' => 'text-amber-400 font-bold'
                ],
                [
                    'name' => 'Apollo Travel & Events',
                    'cat' => 'Tổ Chức Sự Kiện & Gala Dinner',
                    'desc' => 'Trung tâm tổ chức sự kiện chuyên nghiệp, cung ứng kịch bản gala dinner, lễ kỷ niệm và hội thảo quy mô 500+ khách.',
                    'tier' => 'gold',
                    'badge' => 'GOLD PARTNER',
                    'icon' => 'campaign',
                    'icon_color' => 'text-rose-400',
                    'icon_bg' => 'bg-rose-400/10 border-rose-400/25',
                    'tag' => 'Sự kiện chuyên nghiệp',
                    'tag_badge' => 'Gold Partner',
                    'tag_color' => 'text-amber-400 font-bold'
                ],

                // === HÀNG 3, 4, 5: NHÓM STRATEGIC (9 ĐỐI TÁC - ĐỒNG NHẤT, HOVER GLOW THEO MÀU ICON RIÊNG) ===
                [
                    'name' => 'VNTravel',
                    'cat' => 'Mạng Lưới Du Lịch Trực Tuyến',
                    'desc' => 'Hệ sinh thái truyền thông và nền tảng dịch vụ du lịch trải nghiệm lữ hành trực tuyến hàng đầu.',
                    'tier' => 'strategic',
                    'badge' => 'STRATEGIC',
                    'icon' => 'language',
                    'icon_color' => 'text-blue-400',
                    'icon_bg' => 'bg-blue-400/10 border-blue-400/20',
                    'border_hover' => 'rgba(59, 130, 246, 0.7)',
                    'glow_hover' => 'rgba(59, 130, 246, 0.18)',
                    'tag' => 'Mạng lưới số',
                    'tag_badge' => 'Chiến lược',
                    'tag_color' => 'text-emerald-400'
                ],
                [
                    'name' => 'Hoàng Anh Event',
                    'cat' => 'Âm Thanh & Sân Khấu Sự Kiện',
                    'desc' => 'Giải pháp âm thanh ánh sáng sân khấu, màn hình LED cong và kỹ thuật sự kiện ngoài trời chuyên nghiệp.',
                    'tier' => 'strategic',
                    'badge' => 'STRATEGIC',
                    'icon' => 'spatial_audio_off',
                    'icon_color' => 'text-purple-400',
                    'icon_bg' => 'bg-purple-400/10 border-purple-400/20',
                    'border_hover' => 'rgba(168, 85, 247, 0.7)',
                    'glow_hover' => 'rgba(168, 85, 247, 0.18)',
                    'tag' => 'Kỹ thuật sự kiện',
                    'tag_badge' => 'Chiến lược',
                    'tag_color' => 'text-emerald-400'
                ],
                [
                    'name' => 'InterTravel',
                    'cat' => 'Lữ Hành Quốc Tế & Visa',
                    'desc' => 'Dịch vụ du lịch lữ hành quốc tế, visa xuất nhập cảnh và điều phối hướng dẫn viên đa ngôn ngữ.',
                    'tier' => 'strategic',
                    'badge' => 'STRATEGIC',
                    'icon' => 'luggage',
                    'icon_color' => 'text-indigo-400',
                    'icon_bg' => 'bg-indigo-400/10 border-indigo-400/20',
                    'border_hover' => 'rgba(99, 102, 241, 0.7)',
                    'glow_hover' => 'rgba(99, 102, 241, 0.18)',
                    'tag' => 'Tour quốc tế',
                    'tag_badge' => 'Chiến lược',
                    'tag_color' => 'text-emerald-400'
                ],
                [
                    'name' => 'Hoangmai Travel',
                    'cat' => 'Vận Chuyển & Lữ Hành',
                    'desc' => 'Dịch vụ xe du lịch đời mới 16-45 chỗ, vận tải hành khách và điều phối tuyến điểm tham quan an toàn.',
                    'tier' => 'strategic',
                    'badge' => 'STRATEGIC',
                    'icon' => 'directions_bus',
                    'icon_color' => 'text-emerald-400',
                    'icon_bg' => 'bg-emerald-400/10 border-emerald-400/20',
                    'border_hover' => 'rgba(16, 185, 129, 0.7)',
                    'glow_hover' => 'rgba(16, 185, 129, 0.18)',
                    'tag' => 'Vận tải hành khách',
                    'tag_badge' => 'Chiến lược',
                    'tag_color' => 'text-emerald-400'
                ],
                [
                    'name' => 'SGStar (Sao Sài Gòn)',
                    'cat' => 'Team Building & Tour Đoàn',
                    'desc' => 'Tổ chức tour du lịch khách đoàn, huấn luyện sinh tồn và hoạt động team building ngoài trời gắn kết nội bộ.',
                    'tier' => 'strategic',
                    'badge' => 'STRATEGIC',
                    'icon' => 'groups',
                    'icon_color' => 'text-lime-400',
                    'icon_bg' => 'bg-lime-400/10 border-lime-400/20',
                    'border_hover' => 'rgba(132, 204, 22, 0.7)',
                    'glow_hover' => 'rgba(132, 204, 22, 0.18)',
                    'tag' => 'Team building',
                    'tag_badge' => 'Chiến lược',
                    'tag_color' => 'text-emerald-400'
                ],
                [
                    'name' => 'Travelife',
                    'cat' => 'Du Lịch Sinh Thái Bền Vững',
                    'desc' => 'Chuẩn mực du lịch bền vững quốc tế, trải nghiệm văn hóa sông nước bản địa và giảm thiểu phát thải.',
                    'tier' => 'strategic',
                    'badge' => 'STRATEGIC',
                    'icon' => 'eco',
                    'icon_color' => 'text-teal-400',
                    'icon_bg' => 'bg-teal-400/10 border-teal-400/20',
                    'border_hover' => 'rgba(20, 184, 166, 0.7)',
                    'glow_hover' => 'rgba(20, 184, 166, 0.18)',
                    'tag' => 'Sinh thái xanh',
                    'tag_badge' => 'Chiến lược',
                    'tag_color' => 'text-emerald-400'
                ],
                [
                    'name' => 'Phú Thọ (Phuthotourist)',
                    'cat' => 'Khu Vui Chơi & Khách Sạn',
                    'desc' => 'Công ty CP Dịch vụ Du lịch Phú Thọ với chuỗi dịch vụ giải trí lâu đời, CV Đầm Sen và cụm khách sạn.',
                    'tier' => 'strategic',
                    'badge' => 'STRATEGIC',
                    'icon' => 'hub',
                    'icon_color' => 'text-rose-400',
                    'icon_bg' => 'bg-rose-400/10 border-rose-400/20',
                    'border_hover' => 'rgba(244, 63, 94, 0.7)',
                    'glow_hover' => 'rgba(244, 63, 94, 0.18)',
                    'tag' => 'Giải trí lâu đời',
                    'tag_badge' => 'Chiến lược',
                    'tag_color' => 'text-emerald-400'
                ],
                [
                    'name' => 'Khu Nghỉ Dưỡng Sinh Thái Cửu Long',
                    'cat' => 'Nghỉ Dưỡng & Camping Ven Sông',
                    'desc' => 'Hệ thống điểm đến cắm trại dã ngoại, bungalow sinh thái ven sông Tiền và trải nghiệm ẩm thực miệt vườn.',
                    'tier' => 'strategic',
                    'badge' => 'STRATEGIC',
                    'icon' => 'water',
                    'icon_color' => 'text-cyan-400',
                    'icon_bg' => 'bg-cyan-400/10 border-cyan-400/20',
                    'border_hover' => 'rgba(6, 182, 212, 0.7)',
                    'glow_hover' => 'rgba(6, 182, 212, 0.18)',
                    'tag' => 'Nghỉ dưỡng sinh thái',
                    'tag_badge' => 'Chiến lược',
                    'tag_color' => 'text-emerald-400'
                ],
                [
                    'name' => 'Liên Minh Du Lịch ĐBSCL',
                    'cat' => 'Xúc Tiến Du Lịch Vùng',
                    'desc' => 'Mạng lưới liên kết phát triển và quảng bá văn hóa du lịch sông nước 13 tỉnh thành Tây Nam Bộ.',
                    'tier' => 'strategic',
                    'badge' => 'STRATEGIC',
                    'icon' => 'diversity_3',
                    'icon_color' => 'text-green-400',
                    'icon_bg' => 'bg-green-400/10 border-green-400/20',
                    'border_hover' => 'rgba(34, 197, 94, 0.7)',
                    'glow_hover' => 'rgba(34, 197, 94, 0.18)',
                    'tag' => 'Liên kết vùng',
                    'tag_badge' => 'Chiến lược',
                    'tag_color' => 'text-emerald-400'
                ],
            ];
            @endphp

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6" id="partnerGrid">
                @foreach($travelPartners as $index => $partner)
                <div class="partner-card-stagger partner-card-base {{ $partner['tier'] === 'top' ? 'partner-card-top p-7 rounded-3xl' : ($partner['tier'] === 'gold' ? 'partner-card-gold p-6 rounded-3xl' : 'partner-card-strategic p-6 rounded-3xl') }} flex flex-col justify-between group relative overflow-hidden" 
                     data-index="{{ $index }}"
                     @if(isset($partner['border_hover']))
                     style="--card-border-hover: {{ $partner['border_hover'] }}; --card-glow-hover: {{ $partner['glow_hover'] }};"
                     @endif>

                    {{-- Ambient Corner Light for Top & Gold Cards --}}
                    @if($partner['tier'] === 'top')
                    <div class="absolute -top-12 -right-12 w-32 h-32 bg-amber-400/15 rounded-full blur-2xl pointer-events-none group-hover:bg-amber-400/25 transition-all duration-300"></div>
                    @elseif($partner['tier'] === 'gold')
                    <div class="absolute -top-10 -right-10 w-24 h-24 bg-amber-400/10 rounded-full blur-2xl pointer-events-none group-hover:bg-amber-400/20 transition-all duration-300"></div>
                    @endif

                    <div>
                        {{-- Top Header: Badge and Unique Icon --}}
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center gap-2">
                                @if($partner['tier'] === 'top')
                                <span class="px-3 py-1 rounded-full bg-amber-400/20 border border-amber-400/50 font-mono text-[11px] text-amber-300 font-extrabold flex items-center gap-1 shadow-xs">
                                    <span class="material-symbols-outlined text-[13px] text-amber-400">star</span>
                                    {{ $partner['badge'] }}
                                </span>
                                @elseif($partner['tier'] === 'gold')
                                <span class="px-2.5 py-0.5 rounded-full bg-amber-400/15 border border-amber-400/35 font-mono text-[10px] text-amber-300 font-bold flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[12px] text-amber-400">verified</span>
                                    {{ $partner['badge'] }}
                                </span>
                                @else
                                <span class="px-2.5 py-0.5 rounded-full bg-slate-800/90 border border-slate-700/90 font-mono text-[10px] text-slate-400">
                                    {{ $partner['badge'] }}
                                </span>
                                @endif
                            </div>
                            <div class="w-10 h-10 rounded-xl {{ $partner['icon_bg'] }} border flex items-center justify-center transition-transform duration-300 group-hover:scale-110 shadow-xs">
                                <span class="material-symbols-outlined text-[20px] {{ $partner['icon_color'] }}">{{ $partner['icon'] }}</span>
                            </div>
                        </div>

                        {{-- Partner Name --}}
                        <h3 class="font-headline {{ $partner['tier'] === 'top' ? 'text-xl font-extrabold text-amber-100 group-hover:text-amber-300' : ($partner['tier'] === 'gold' ? 'text-lg font-bold text-white group-hover:text-amber-300' : 'text-lg font-bold text-white group-hover:text-white') }} transition-colors">
                            {{ $partner['name'] }}
                        </h3>
                        <p class="font-mono text-[11px] text-amber-400/80 mt-1 mb-1 font-semibold">
                            {{ $partner['cat'] }}
                        </p>

                        {{-- Description --}}
                        <p class="font-body text-xs text-slate-300/90 mt-2.5 leading-relaxed">
                            {{ $partner['desc'] }}
                        </p>
                    </div>

                    {{-- Footer Tag --}}
                    <div class="pt-4 mt-5 border-t {{ $partner['tier'] === 'top' ? 'border-amber-400/30' : ($partner['tier'] === 'gold' ? 'border-amber-400/20' : 'border-slate-800/80') }} flex items-center justify-between text-[11px] font-mono text-slate-400">
                        <span>{{ $partner['tag'] }}</span>
                        <span class="{{ $partner['tag_color'] }} flex items-center gap-1">
                            <span class="w-1.5 h-1.5 rounded-full {{ $partner['tier'] === 'top' ? 'bg-amber-400' : ($partner['tier'] === 'gold' ? 'bg-amber-400' : 'bg-emerald-400') }}"></span>
                            {{ $partner['tag_badge'] }}
                        </span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- 4. Collaboration Principles (NỀN SÁNG: bg-surface) --}}
    <section class="py-12 lg:py-16 bg-surface bg-dot-grid-subtle border-b border-slate-200/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-10 lg:mb-12">
                <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-amber-100 border border-amber-300 text-amber-800 font-mono text-xs font-bold mb-3">
                    <span class="material-symbols-outlined text-[15px] text-amber-600">handshake</span>
                    <span>PARTNERSHIP VALUES</span>
                </div>
                <h2 class="font-headline text-2xl sm:text-3xl lg:text-4xl font-extrabold text-navy-base tracking-tight">
                    3 Tiêu Chuẩn Hợp Tác Bền Vững
                </h2>
                <p class="font-body text-slate-600 text-xs sm:text-sm mt-3">
                    Xây dựng nền tảng liên kết uy tín, minh bạch và tạo ra giá trị cộng hưởng lâu dài.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="p-6 rounded-3xl bg-white border border-slate-200/90 shadow-sm flex flex-col gap-3 hover:-translate-y-1 hover:border-amber-400/50 hover:shadow-md transition-all duration-300">
                    <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 border border-amber-200 flex items-center justify-center font-headline font-bold text-base">
                        01
                    </div>
                    <h3 class="font-headline text-lg font-bold text-navy-base">Tôn Trọng Cam Kết SLA</h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">
                        Mọi thỏa thuận hợp tác về chất lượng dịch vụ, thời gian vận hành và bảo mật dữ liệu đều được cam kết chặt chẽ bằng văn bản pháp lý.
                    </p>
                </div>
                <div class="p-6 rounded-3xl bg-white border border-slate-200/90 shadow-sm flex flex-col gap-3 hover:-translate-y-1 hover:border-amber-400/50 hover:shadow-md transition-all duration-300">
                    <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 border border-amber-200 flex items-center justify-center font-headline font-bold text-base">
                        02
                    </div>
                    <h3 class="font-headline text-lg font-bold text-navy-base">Đôi Bên Cùng Phát Triển (Win-Win)</h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">
                        Chia sẻ nguồn lực, tệp khách hàng và kinh nghiệm chuyên môn để cùng tạo ra sản phẩm dịch vụ hoàn hảo nhất tới tay người tiêu dùng.
                    </p>
                </div>
                <div class="p-6 rounded-3xl bg-white border border-slate-200/90 shadow-sm flex flex-col gap-3 hover:-translate-y-1 hover:border-amber-400/50 hover:shadow-md transition-all duration-300">
                    <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 border border-amber-200 flex items-center justify-center font-headline font-bold text-base">
                        03
                    </div>
                    <h3 class="font-headline text-lg font-bold text-navy-base">Đồng Hành Dài Hạn</h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">
                        Chúng tôi hướng đến mối quan hệ hợp tác chiến lược tính bằng nhiều năm, không chạy theo lợi nhuận ngắn hạn hay hợp đồng nhất thời.
                    </p>
                </div>
            </div>
        </div>
    </section>

</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.partner-card-stagger');
    if ('IntersectionObserver' in window && cards.length > 0) {
        const observer = new IntersectionObserver(function(entries, obs) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    const idx = parseInt(entry.target.getAttribute('data-index') || '0', 10);
                    setTimeout(function() {
                        entry.target.classList.add('revealed');
                    }, (idx % 3) * 90);
                    obs.unobserve(entry.target);
                }
            });
        }, { threshold: 0.08, rootMargin: '0px 0px -40px 0px' });

        cards.forEach(function(card) {
            observer.observe(card);
        });
    } else {
        cards.forEach(function(card) { card.classList.add('revealed'); });
    }
});
</script>
@endpush

<!-- Schema JSON-LD -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "AboutPage",
    "name": "Mạng Lưới Đối Tác Chiến Lược - Truyền Thông Cửu Long",
    "description": "Danh sách các đối tác hạ tầng công nghệ và du lịch lữ hành đồng hành bền vững cùng Truyền Thông Cửu Long.",
    "url": "{{ route('partners') }}"
}
</script>
@endsection
