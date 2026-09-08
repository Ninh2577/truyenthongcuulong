@extends('layouts.app')

@section('title', 'Mạng Lưới Đối Tác Chiến Lược - Truyền Thông Cửu Long')
@section('meta_description', 'Danh sách các đối tác hạ tầng công nghệ và du lịch lữ hành đồng hành bền vững cùng Truyền Thông Cửu Long.')

@section('content')
<div class="w-full">

    <!-- 1. Small Hero Section (NỀN TỐI: Deep Navy) -->
    <section class="relative pt-32 pb-12 lg:pt-36 lg:pb-16 overflow-hidden border-b border-slate-800/80 bg-[#080C16] text-white bg-dot-grid-subtle">
        <div class="absolute inset-0 bg-gradient-to-b from-transparent via-[#080C16]/60 to-[#080C16] pointer-events-none"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- Breadcrumb -->
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
                    Hơn 10 năm hoạt động trong ngành truyền thông và công nghệ, Truyền Thông Cửu Long tự hào xây dựng mối liên minh bền vững cùng các nhà cung cấp hạ tầng số uy tín và các tập đoàn lữ hành, sự kiện hàng đầu.
                </p>

                <div class="grid grid-cols-3 gap-4 pt-4 w-full max-w-lg">
                    <div class="p-3.5 rounded-2xl bg-[#0F172A] border border-slate-800 text-center">
                        <span class="font-headline text-2xl font-black text-amber-400">17+</span>
                        <p class="text-[11px] font-mono text-slate-400 mt-0.5">Đối tác chiến lược</p>
                    </div>
                    <div class="p-3.5 rounded-2xl bg-[#0F172A] border border-slate-800 text-center">
                        <span class="font-headline text-2xl font-black text-white">10+</span>
                        <p class="text-[11px] font-mono text-slate-400 mt-0.5">Năm gắn kết bền chặt</p>
                    </div>
                    <div class="p-3.5 rounded-2xl bg-[#0F172A] border border-slate-800 text-center">
                        <span class="font-headline text-2xl font-black text-emerald-400">100%</span>
                        <p class="text-[11px] font-mono text-slate-400 mt-0.5">Chuẩn mực SLA cam kết</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 2. Nhóm Đối Tác Hạ Tầng Công Nghệ & Tên Miền (NỀN SÁNG: bg-surface) -->
    <section class="py-12 lg:py-16 bg-surface bg-dot-grid-subtle border-b border-slate-200/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-8">
                <div>
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-sky-100 border border-sky-300 text-sky-800 font-mono text-xs font-bold mb-2">
                        <span class="material-symbols-outlined text-[15px] text-sky-600">dns</span>
                        <span>CLOUD &amp; HOSTING INFRASTRUCTURE</span>
                    </div>
                    <h2 class="font-headline text-2xl sm:text-3xl font-extrabold text-navy-base tracking-tight">
                        Đối Tác Hạ Tầng Máy Chủ &amp; Tên Miền
                    </h2>
                </div>
                <p class="font-body text-xs text-slate-600 max-w-md">
                    Nền tảng máy chủ đám mây vững chắc bảo đảm 99.9% uptime cho mọi website và ứng dụng của khách hàng.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- PA Vietnam -->
                <div class="p-8 rounded-3xl bg-white border border-slate-200/90 shadow-sm hover:border-primary/40 hover:shadow-md transition-all duration-300 flex flex-col justify-between group">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <span class="px-3 py-1 rounded-full bg-sky-50 text-sky-700 font-mono text-xs font-bold border border-sky-200">
                                DOMAIN &amp; CLOUD HOSTING
                            </span>
                            <span class="text-xs font-mono text-slate-500">Đối tác lâu năm</span>
                        </div>
                        <h3 class="font-headline text-2xl font-bold text-navy-base group-hover:text-primary transition-colors">
                            P.A Việt Nam
                        </h3>
                        <p class="font-body text-xs sm:text-sm text-slate-600 mt-3 leading-relaxed">
                            Nhà đăng ký tên miền và cung cấp dịch vụ máy chủ lớn nhất Việt Nam. Đối tác chiến lược đồng hành cung cấp giải pháp trung tâm dữ liệu chuẩn Tier 3, máy chủ ảo Cloud VPS và chứng chỉ bảo mật SSL cho các hệ thống doanh nghiệp do CLM xây dựng.
                        </p>
                    </div>
                    <div class="pt-6 mt-6 border-t border-slate-100 flex items-center justify-between text-xs font-mono text-slate-500">
                        <span class="text-emerald-600 font-semibold flex items-center gap-1">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                            Hạ tầng máy chủ Tier 3
                        </span>
                        <span>Đăng ký Domain .VN / Quốc tế</span>
                    </div>
                </div>

                <!-- Hawk Host -->
                <div class="p-8 rounded-3xl bg-white border border-slate-200/90 shadow-sm hover:border-amber-400/40 hover:shadow-md transition-all duration-300 flex flex-col justify-between group">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <span class="px-3 py-1 rounded-full bg-amber-50 text-amber-800 font-mono text-xs font-bold border border-amber-200">
                                INTERNATIONAL CLOUD HOSTING
                            </span>
                            <span class="text-xs font-mono text-slate-500">Đối tác hạ tầng quốc tế</span>
                        </div>
                        <h3 class="font-headline text-2xl font-bold text-navy-base group-hover:text-amber-600 transition-colors">
                            Hawk Host
                        </h3>
                        <p class="font-body text-xs sm:text-sm text-slate-600 mt-3 leading-relaxed">
                            Nhà cung cấp điện toán đám mây và Hosting hiệu năng cao hàng đầu Bắc Mỹ với hệ thống máy chủ đặt tại Hong Kong và Singapore. Cung cấp hạ tầng tốc độ tải trang cực nhanh và khả năng chống DDoS ổn định cho các cổng thông tin quốc tế.
                        </p>
                    </div>
                    <div class="pt-6 mt-6 border-t border-slate-100 flex items-center justify-between text-xs font-mono text-slate-500">
                        <span class="text-emerald-600 font-semibold flex items-center gap-1">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                            LiteSpeed Web Server
                        </span>
                        <span>Multi-Datacenter Routing</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. Nhóm Đối Tác Du Lịch, Lữ Hành, Nghỉ Dưỡng & Tổ Chức Sự Kiện (NỀN TỐI: Deep Navy) -->
    <section class="py-12 lg:py-16 bg-[#080C16] border-b border-slate-800 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-10 lg:mb-12">
                <span class="font-mono text-xs text-amber-400 font-bold uppercase tracking-widest">TOURISM, TRAVEL &amp; EVENTS NETWORK</span>
                <h2 class="font-headline text-2xl sm:text-3xl lg:text-4xl font-extrabold mt-2">
                    Đối Tác Du Lịch, Lữ Hành &amp; Tổ Chức Sự Kiện
                </h2>
                <p class="font-body text-slate-400 text-xs sm:text-sm mt-3">
                    Mạng lưới 15 đơn vị lữ hành, nghỉ dưỡng sinh thái và tổ chức sự kiện chuyên nghiệp đồng hành chặt chẽ trong các chiến dịch truyền thông quảng bá du lịch và tác nghiệp thực địa.
                </p>
            </div>

            @php
            $travelPartners = [
                ['name' => 'Long Trekking', 'cat' => 'Trekking & Du Lịch Mạo Hiểm', 'desc' => 'Tổ chức tour trekking khám phá thiên nhiên và trải nghiệm sinh tồn.'],
                ['name' => 'Láng Sen', 'cat' => 'Khu Bảo Tồn Sinh Thái', 'desc' => 'Bảo tồn đất ngập nước Ramsar, du lịch sinh thái và nghiên cứu thiên nhiên.'],
                ['name' => 'Nam Tây Nguyên', 'cat' => 'Khám Phá Cao Nguyên', 'desc' => 'Dã ngoại, cắm trại và tour khám phá đại ngàn Tây Nguyên.'],
                ['name' => 'MTC Travel', 'cat' => 'Lữ Hành & Sự Kiện', 'desc' => 'Tổ chức tour du lịch trọn gói và sự kiện hội nghị khách hàng.'],
                ['name' => 'Gonatour', 'cat' => 'Du Lịch Trong & Ngoài Nước', 'desc' => 'Công ty cổ phần thương mại dịch vụ du lịch Gonatour uy tín.'],
                ['name' => 'Apollo Travel & Events', 'cat' => 'Tổ Chức Sự Kiện & Gala', 'desc' => 'Trung tâm tổ chức sự kiện, hội nghị và gala du lịch.'],
                ['name' => 'VNTravel', 'cat' => 'Mạng Lưới Du Lịch Việt', 'desc' => 'Hệ sinh thái truyền thông và dịch vụ du lịch trải nghiệm lữ hành.'],
                ['name' => 'Hoàng Anh Event', 'cat' => 'Âm Thanh & Sân Khấu Sự Kiện', 'desc' => 'Giải pháp tổ chức sự kiện, âm thanh ánh sáng sân khấu chuyên nghiệp.'],
                ['name' => 'InterTravel', 'cat' => 'Lữ Hành Quốc Tế', 'desc' => 'Dịch vụ du lịch lữ hành quốc tế và visa xuất nhập cảnh.'],
                ['name' => 'Hoangmai Travel', 'cat' => 'Vận Chuyển & Lữ Hành', 'desc' => 'Dịch vụ xe du lịch đời mới và điều phối tuyến điểm tham quan.'],
                ['name' => 'SGStar (Sao Sài Gòn)', 'cat' => 'Team Building & Tour Đoàn', 'desc' => 'Tổ chức tour du lịch khách đoàn và hoạt động team building ngoài trời.'],
                ['name' => 'Travelife', 'cat' => 'Du Lịch Sinh Thái Bền Vững', 'desc' => 'Chuẩn mực du lịch bền vững và trải nghiệm văn hóa bản địa.'],
                ['name' => 'Phú Thọ (Phuthotourist)', 'cat' => 'Khu Vui Chơi & Khách Sạn', 'desc' => 'Công ty Cổ phần Dịch vụ Du lịch Phú Thọ với chuỗi dịch vụ giải trí lâu đời.'],
                ['name' => 'Khu Nghỉ Dưỡng Sinh Thái Cửu Long', 'cat' => 'Nghỉ Dưỡng & Camping', 'desc' => 'Hệ thống điểm đến cắm trại dã ngoại sinh thái ven sông miền Tây.'],
                ['name' => 'Liên Minh Du Lịch ĐBSCL', 'cat' => 'Xúc Tiến Du Lịch Vùng', 'desc' => 'Mạng lưới liên kết phát triển và quảng bá văn hóa du lịch sông nước.'],
            ];
            @endphp

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($travelPartners as $partner)
                <div class="p-6 rounded-3xl bg-[#0F172A] border border-slate-800 hover:border-amber-400/40 hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between group">
                    <div>
                        <div class="flex items-center justify-between mb-3">
                            <span class="px-2.5 py-0.5 rounded-full bg-white/5 border border-white/10 font-mono text-[10px] text-amber-400">
                                {{ $partner['cat'] }}
                            </span>
                            <span class="material-symbols-outlined text-[18px] text-slate-500 group-hover:text-amber-400 transition-colors">handshake</span>
                        </div>
                        <h3 class="font-headline text-lg font-bold text-white group-hover:text-amber-400 transition-colors">
                            {{ $partner['name'] }}
                        </h3>
                        <p class="font-body text-xs text-slate-400 mt-2 leading-relaxed">
                            {{ $partner['desc'] }}
                        </p>
                    </div>
                    <div class="pt-4 mt-4 border-t border-slate-800/80 flex items-center justify-between text-[11px] font-mono text-slate-500">
                        <span>Đối tác đồng hành</span>
                        <span class="text-emerald-400">Hợp tác chiến lược</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- 4. Collaboration Principles (NỀN SÁNG: bg-surface) -->
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
