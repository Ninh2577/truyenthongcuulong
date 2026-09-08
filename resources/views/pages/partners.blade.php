@extends('layouts.app')

@section('title', 'Mạng Lưới Đối Tác Chiến Lược - Truyền Thông Cửu Long')
@section('meta_description', 'Danh sách các đối tác hạ tầng công nghệ và du lịch lữ hành đồng hành bền vững cùng Truyền Thông Cửu Long.')

@push('styles')
<style>
.partner-card-stagger {
    opacity: 0;
    transform: translateY(24px);
    transition: opacity 0.5s cubic-bezier(0.16, 1, 0.3, 1), transform 0.5s cubic-bezier(0.16, 1, 0.3, 1);
}
.partner-card-stagger.revealed {
    opacity: 1;
    transform: translateY(0);
}
.travel-partner-card {
    transition: transform 0.28s cubic-bezier(0.34, 1.56, 0.64, 1), box-shadow 0.28s ease, border-color 0.28s ease;
}
.travel-partner-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 0 0 1px rgba(251, 191, 36, 0.3), 0 16px 40px rgba(0, 0, 0, 0.45), 0 0 24px rgba(251, 191, 36, 0.12);
    border-color: rgba(251, 191, 36, 0.45) !important;
}
.travel-partner-card.featured-gold {
    background: linear-gradient(135deg, #0F172A 0%, #172033 50%, #0F172A 100%);
    border-color: rgba(251, 191, 36, 0.28) !important;
}
.travel-partner-card.featured-gold:hover {
    border-color: rgba(251, 191, 36, 0.65) !important;
    box-shadow: 0 0 0 1px rgba(251, 191, 36, 0.45), 0 20px 48px rgba(0, 0, 0, 0.5), 0 0 32px rgba(251, 191, 36, 0.2);
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
                    Hơn 10 năm hoạt động, Truyền Thông Cửu Long tự hào xây dựng mối liên minh bền vững cùng các nhà cung cấp hạ tầng số uy tín và các tập đoàn lữ hành, sự kiện hàng đầu.
                </p>
                <div class="grid grid-cols-3 gap-4 pt-4 w-full max-w-lg">
                    <div class="p-3.5 rounded-2xl bg-[#0F172A] border border-slate-800 text-center">
                        <span class="font-headline text-2xl font-black text-amber-400">17+</span>
                        <p class="text-[11px] font-mono text-slate-400 mt-0.5">Đối tác chiến lược</p>
                    </div>
                    <div class="p-3.5 rounded-2xl bg-[#0F172A] border border-slate-800 text-center">
                        <span class="font-headline text-2xl font-black text-white">10+</span>
                        <p class="text-[11px] font-mono text-slate-400 mt-0.5">Năm gắn kết</p>
                    </div>
                    <div class="p-3.5 rounded-2xl bg-[#0F172A] border border-slate-800 text-center">
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
                        <p class="font-body text-xs sm:text-sm text-slate-600 mt-3 leading-relaxed">Nhà đăng ký tên miền và cung cấp dịch vụ máy chủ lớn nhất Việt Nam. Đối tác chiến lược đồng hành cung cấp giải pháp trung tâm dữ liệu chuẩn Tier 3, Cloud VPS và SSL cho các hệ thống doanh nghiệp do CLM xây dựng.</p>
                    </div>
                    <div class="pt-6 mt-6 border-t border-slate-100 flex items-center justify-between text-xs font-mono text-slate-500">
                        <span class="text-emerald-600 font-semibold flex items-center gap-1"><span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>Hạ tầng Tier 3</span>
                        <span>Domain .VN / Quốc tế</span>
                    </div>
                </div>
                <div class="p-8 rounded-3xl bg-white border border-slate-200/90 shadow-sm hover:border-amber-400/40 hover:shadow-md transition-all duration-300 flex flex-col justify-between group">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <span class="px-3 py-1 rounded-full bg-amber-50 text-amber-800 font-mono text-xs font-bold border border-amber-200">INTERNATIONAL CLOUD HOSTING</span>
                            <span class="text-xs font-mono text-slate-500">Đối tác quốc tế</span>
                        </div>
                        <h3 class="font-headline text-2xl font-bold text-navy-base group-hover:text-amber-600 transition-colors">Hawk Host</h3>
                        <p class="font-body text-xs sm:text-sm text-slate-600 mt-3 leading-relaxed">Nhà cung cấp điện toán đám mây và Hosting hiệu năng cao hàng đầu Bắc Mỹ với máy chủ tại Hong Kong và Singapore. Hạ tầng tốc độ cực nhanh và chống DDoS ổn định cho các cổng thông tin quốc tế.</p>
                    </div>
                    <div class="pt-6 mt-6 border-t border-slate-100 flex items-center justify-between text-xs font-mono text-slate-500">
                        <span class="text-emerald-600 font-semibold flex items-center gap-1"><span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>LiteSpeed Web Server</span>
                        <span>Global Anycast DNS</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- 3. Mạng Lưới Đối Tác Lữ Hành (NỀN TỐI) — 15 Card được nâng cấp phân cấp thị giác --}}
    <section class="py-14 lg:py-20 bg-[#080C16] text-white border-b border-slate-800/80 relative overflow-hidden" style="background-image: radial-gradient(rgba(255, 255, 255, 0.07) 1px, transparent 1px); background-size: 24px 24px;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-10 lg:mb-12">
                <div>
                    <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-amber-400/10 border border-amber-400/30 text-amber-400 font-mono text-xs font-bold mb-3">
                        <span class="material-symbols-outlined text-[15px]">travel_explore</span>
                        <span>TRAVEL &amp; HOSPITALITY NETWORK</span>
                    </div>
                    <h2 class="font-headline text-2xl sm:text-3xl lg:text-4xl font-extrabold tracking-tight">Đối Tác Du Lịch &amp; Sự Kiện Chiến Lược</h2>
                </div>
                <div class="flex items-center gap-3 text-xs font-mono">
                    <span class="flex items-center gap-1.5 text-amber-400 font-bold px-3 py-1 rounded-full bg-amber-400/10 border border-amber-400/30">
                        <span class="w-2 h-2 rounded-full bg-amber-400"></span> 4 Gold Partners
                    </span>
                    <span class="flex items-center gap-1.5 text-slate-400 px-3 py-1 rounded-full bg-slate-800/60 border border-slate-700">
                        <span class="w-2 h-2 rounded-full bg-slate-500"></span> 11 Strategic Partners
                    </span>
                </div>
            </div>

            @php
            $travelPartners = [
                // === TOP 4 GOLD FEATURED PARTNERS ===
                [
                    'name' => 'Saigontourist',
                    'cat' => 'Hệ Thống Lữ Hành Quốc Gia',
                    'desc' => 'Tập đoàn lữ hành hàng đầu Việt Nam với chuỗi khách sạn, khu nghỉ dưỡng và dịch vụ lữ hành chuẩn quốc tế 5 sao.',
                    'icon' => 'hotel',
                    'icon_color' => 'text-amber-400',
                    'icon_bg' => 'bg-amber-400/10 border-amber-400/30',
                    'is_gold' => true,
                    'tag' => 'Liên kết chiến lược 10+ năm',
                    'badge' => 'TOP 1 PARTNER'
                ],
                [
                    'name' => 'Vietravel',
                    'cat' => 'Lữ Hành Hàng Đầu Châu Á',
                    'desc' => 'Nhà tổ chức du lịch chuyên nghiệp hàng đầu châu Á, tiên phong chuyển đổi số trong trải nghiệm tour đoàn và vé máy bay.',
                    'icon' => 'flight_takeoff',
                    'icon_color' => 'text-amber-400',
                    'icon_bg' => 'bg-amber-400/10 border-amber-400/30',
                    'is_gold' => true,
                    'tag' => 'Đối tác công nghệ số',
                    'badge' => 'TOP 2 PARTNER'
                ],
                [
                    'name' => 'BenThanh Tourist',
                    'cat' => 'Lữ Hành Cao Cấp & MICE',
                    'desc' => 'Đơn vị uy tín lâu đời chuyên tổ chức sự kiện MICE, hội nghị quốc tế và các tour chuyên đề văn hóa cao cấp.',
                    'icon' => 'groups',
                    'icon_color' => 'text-amber-400',
                    'icon_bg' => 'bg-amber-400/10 border-amber-400/30',
                    'is_gold' => true,
                    'tag' => 'Đối tác MICE chiến lược',
                    'badge' => 'TOP 3 PARTNER'
                ],
                [
                    'name' => 'Chiêu Tour',
                    'cat' => 'Du Lịch Khám Phá & Trải Nghiệm',
                    'desc' => 'Thương hiệu lữ hành năng động chuyên tuyến miền Tây, tour caravan khám phá và team building doanh nghiệp quy mô lớn.',
                    'icon' => 'terrain',
                    'icon_color' => 'text-amber-400',
                    'icon_bg' => 'bg-amber-400/10 border-amber-400/30',
                    'is_gold' => true,
                    'tag' => 'Đối tác vận hành tour',
                    'badge' => 'GOLD PARTNER'
                ],

                // === 11 STRATEGIC PARTNERS WITH DIVERSE ICONS ===
                [
                    'name' => 'Gonatour',
                    'cat' => 'Du Lịch Trong & Ngoài Nước',
                    'desc' => 'Công ty cổ phần thương mại dịch vụ du lịch Gonatour với mạng lưới tuyến điểm toàn quốc và đặt vé tự động.',
                    'icon' => 'travel_explore',
                    'icon_color' => 'text-sky-400',
                    'icon_bg' => 'bg-sky-400/10 border-sky-400/20',
                    'is_gold' => false,
                    'tag' => 'Hợp tác trực tuyến',
                    'badge' => 'STRATEGIC'
                ],
                [
                    'name' => 'Apollo Travel & Events',
                    'cat' => 'Tổ Chức Sự Kiện & Gala',
                    'desc' => 'Trung tâm tổ chức sự kiện, hội nghị khách hàng, lễ kỷ niệm và gala du lịch quy mô 500+ khách.',
                    'icon' => 'campaign',
                    'icon_color' => 'text-orange-400',
                    'icon_bg' => 'bg-orange-400/10 border-orange-400/20',
                    'is_gold' => false,
                    'tag' => 'Đối tác sự kiện',
                    'badge' => 'STRATEGIC'
                ],
                [
                    'name' => 'VNTravel',
                    'cat' => 'Mạng Lưới Du Lịch Việt',
                    'desc' => 'Hệ sinh thái truyền thông và nền tảng dịch vụ du lịch trải nghiệm lữ hành trực tuyến hàng đầu.',
                    'icon' => 'language',
                    'icon_color' => 'text-blue-400',
                    'icon_bg' => 'bg-blue-400/10 border-blue-400/20',
                    'is_gold' => false,
                    'tag' => 'Mạng lưới số',
                    'badge' => 'STRATEGIC'
                ],
                [
                    'name' => 'Hoàng Anh Event',
                    'cat' => 'Âm Thanh & Sân Khấu Sự Kiện',
                    'desc' => 'Giải pháp âm thanh ánh sáng sân khấu, màn hình LED cong và kỹ thuật sự kiện ngoài trời chuyên nghiệp.',
                    'icon' => 'spatial_audio_off',
                    'icon_color' => 'text-purple-400',
                    'icon_bg' => 'bg-purple-400/10 border-purple-400/20',
                    'is_gold' => false,
                    'tag' => 'Kỹ thuật sự kiện',
                    'badge' => 'STRATEGIC'
                ],
                [
                    'name' => 'InterTravel',
                    'cat' => 'Lữ Hành Quốc Tế & Visa',
                    'desc' => 'Dịch vụ du lịch lữ hành quốc tế, visa xuất nhập cảnh và điều phối hướng dẫn viên đa ngôn ngữ.',
                    'icon' => 'luggage',
                    'icon_color' => 'text-indigo-400',
                    'icon_bg' => 'bg-indigo-400/10 border-indigo-400/20',
                    'is_gold' => false,
                    'tag' => 'Tour quốc tế',
                    'badge' => 'STRATEGIC'
                ],
                [
                    'name' => 'Hoangmai Travel',
                    'cat' => 'Vận Chuyển & Lữ Hành',
                    'desc' => 'Dịch vụ xe du lịch đời mới 16-45 chỗ, vận tải hành khách và điều phối tuyến điểm tham quan an toàn.',
                    'icon' => 'directions_bus',
                    'icon_color' => 'text-emerald-400',
                    'icon_bg' => 'bg-emerald-400/10 border-emerald-400/20',
                    'is_gold' => false,
                    'tag' => 'Vận tải hành khách',
                    'badge' => 'STRATEGIC'
                ],
                [
                    'name' => 'SGStar (Sao Sài Gòn)',
                    'cat' => 'Team Building & Tour Đoàn',
                    'desc' => 'Tổ chức tour du lịch khách đoàn, huấn luyện sinh tồn và hoạt động team building ngoài trời gắn kết nội bộ.',
                    'icon' => 'hiking',
                    'icon_color' => 'text-lime-400',
                    'icon_bg' => 'bg-lime-400/10 border-lime-400/20',
                    'is_gold' => false,
                    'tag' => 'Team building',
                    'badge' => 'STRATEGIC'
                ],
                [
                    'name' => 'Travelife',
                    'cat' => 'Du Lịch Sinh Thái Bền Vững',
                    'desc' => 'Chuẩn mực du lịch bền vững quốc tế, trải nghiệm văn hóa sông nước bản địa và giảm thiểu phát thải.',
                    'icon' => 'forest',
                    'icon_color' => 'text-teal-400',
                    'icon_bg' => 'bg-teal-400/10 border-teal-400/20',
                    'is_gold' => false,
                    'tag' => 'Sinh thái xanh',
                    'badge' => 'STRATEGIC'
                ],
                [
                    'name' => 'Phú Thọ (Phuthotourist)',
                    'cat' => 'Khu Vui Chơi & Khách Sạn',
                    'desc' => 'Công ty CP Dịch vụ Du lịch Phú Thọ với chuỗi dịch vụ giải trí lâu đời, CV Đầm Sen và cụm khách sạn.',
                    'icon' => 'hub',
                    'icon_color' => 'text-rose-400',
                    'icon_bg' => 'bg-rose-400/10 border-rose-400/20',
                    'is_gold' => false,
                    'tag' => 'Giải trí lâu đời',
                    'badge' => 'STRATEGIC'
                ],
                [
                    'name' => 'Khu Nghỉ Dưỡng Sinh Thái Cửu Long',
                    'cat' => 'Nghỉ Dưỡng & Camping Ven Sông',
                    'desc' => 'Hệ thống điểm đến cắm trại dã ngoại, bungalow sinh thái ven sông Tiền và trải nghiệm ẩm thực miệt vườn.',
                    'icon' => 'water',
                    'icon_color' => 'text-cyan-400',
                    'icon_bg' => 'bg-cyan-400/10 border-cyan-400/20',
                    'is_gold' => false,
                    'tag' => 'Nghỉ dưỡng sinh thái',
                    'badge' => 'STRATEGIC'
                ],
                [
                    'name' => 'Liên Minh Du Lịch ĐBSCL',
                    'cat' => 'Xúc Tiến Du Lịch Vùng',
                    'desc' => 'Mạng lưới liên kết phát triển và quảng bá văn hóa du lịch sông nước 13 tỉnh thành Tây Nam Bộ.',
                    'icon' => 'eco',
                    'icon_color' => 'text-green-400',
                    'icon_bg' => 'bg-green-400/10 border-green-400/20',
                    'is_gold' => false,
                    'tag' => 'Liên kết vùng',
                    'badge' => 'STRATEGIC'
                ],
            ];
            @endphp

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6" id="partnerGrid">
                @foreach($travelPartners as $index => $partner)
                <div class="partner-card-stagger travel-partner-card p-6 rounded-3xl {{ $partner['is_gold'] ? 'featured-gold sm:col-span-1 lg:col-span-1 border border-amber-400/30' : 'bg-[#0F172A] border border-slate-800/90' }} flex flex-col justify-between group relative overflow-hidden" data-index="{{ $index }}">
                    {{-- Ambient Corner Light for Gold Cards --}}
                    @if($partner['is_gold'])
                    <div class="absolute -top-10 -right-10 w-28 h-28 bg-amber-400/10 rounded-full blur-2xl pointer-events-none group-hover:bg-amber-400/20 transition-all duration-300"></div>
                    @endif

                    <div>
                        {{-- Top Header: Badge and Unique Icon --}}
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center gap-2">
                                @if($partner['is_gold'])
                                <span class="px-2.5 py-0.5 rounded-full bg-amber-400/15 border border-amber-400/40 font-mono text-[10px] text-amber-300 font-bold flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[12px] text-amber-400">star</span>
                                    {{ $partner['badge'] }}
                                </span>
                                @else
                                <span class="px-2.5 py-0.5 rounded-full bg-slate-800/80 border border-slate-700/80 font-mono text-[10px] text-slate-400">
                                    {{ $partner['badge'] }}
                                </span>
                                @endif
                                <span class="font-mono text-[10px] text-slate-400 hidden xl:inline">
                                    {{ $partner['cat'] }}
                                </span>
                            </div>
                            <div class="w-9 h-9 rounded-xl {{ $partner['icon_bg'] }} border flex items-center justify-center transition-transform duration-300 group-hover:scale-110">
                                <span class="material-symbols-outlined text-[19px] {{ $partner['icon_color'] }}">{{ $partner['icon'] }}</span>
                            </div>
                        </div>

                        {{-- Partner Name --}}
                        <h3 class="font-headline text-lg font-bold {{ $partner['is_gold'] ? 'text-amber-100 group-hover:text-amber-300' : 'text-white group-hover:text-amber-400' }} transition-colors flex items-center gap-2">
                            <span>{{ $partner['name'] }}</span>
                        </h3>
                        <p class="font-mono text-[11px] text-slate-400 xl:hidden mt-0.5 mb-1">
                            {{ $partner['cat'] }}
                        </p>

                        {{-- Description --}}
                        <p class="font-body text-xs text-slate-400 mt-2.5 leading-relaxed">
                            {{ $partner['desc'] }}
                        </p>
                    </div>

                    {{-- Footer Tag --}}
                    <div class="pt-4 mt-5 border-t {{ $partner['is_gold'] ? 'border-amber-400/20' : 'border-slate-800/80' }} flex items-center justify-between text-[11px] font-mono text-slate-400">
                        <span>{{ $partner['tag'] }}</span>
                        <span class="{{ $partner['is_gold'] ? 'text-amber-400 font-bold' : 'text-emerald-400' }} flex items-center gap-1">
                            <span class="w-1.5 h-1.5 rounded-full {{ $partner['is_gold'] ? 'bg-amber-400' : 'bg-emerald-400' }}"></span>
                            {{ $partner['is_gold'] ? 'Gold Tier' : 'Chiến lược' }}
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
                    }, (idx % 3) * 80);
                    obs.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });

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
