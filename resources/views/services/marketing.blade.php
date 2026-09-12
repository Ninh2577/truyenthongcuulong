@extends('layouts.app')

@section('title', 'Dịch Vụ Quảng Cáo Số & Truyền Thông Đa Kênh - Truyền Thông Cửu Long')
@section('meta_description', 'Giải pháp chạy quảng cáo Google, Facebook, TikTok và SEO tổng thể kết hợp tư liệu hình ảnh chất lượng cao tối ưu chuyển đổi doanh thu.')

@push('styles')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Service",
  "name": "Quảng Cáo & Truyền Thông Số Đa Kênh",
  "serviceType": "Digital Marketing & Performance Ads",
  "provider": {
    "@type": "Organization",
    "name": "Truyền Thông Cửu Long",
    "url": "https://truyenthongcuulong.com",
    "logo": "https://truyenthongcuulong.com/images/logo.png"
  },
  "areaServed": "VN",
  "description": "Giải pháp chạy quảng cáo Google, Facebook, TikTok và SEO tổng thể kết hợp tư liệu hình ảnh chất lượng cao tối ưu chuyển đổi doanh thu.",
  "offers": {
    "@type": "Offer",
    "priceCurrency": "VND",
    "availability": "https://schema.org/InStock",
    "url": "{{ route('pricing') }}"
  }
}
</script>
@endpush

@section('content')
<!-- Small Hero Section -->
<section class="relative w-full overflow-hidden pt-32 pb-14 lg:pt-36 lg:pb-20 border-b border-slate-200/80 bg-white bg-dot-grid-subtle">
    <div class="absolute -top-24 right-0 w-[500px] h-[500px] rounded-full bg-gradient-to-br from-emerald-500/5 via-primary/5 to-transparent blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-0 left-10 w-[400px] h-[300px] rounded-full bg-gradient-to-tr from-amber-500/5 via-primary/5 to-transparent blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <!-- Breadcrumb Navigation -->
        <nav class="flex items-center gap-2 text-xs font-headline text-slate-400 mb-6" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-primary transition-colors flex items-center gap-1">
                <span class="material-symbols-outlined text-[16px]">home</span>
                <span>Trang chủ</span>
            </a>
            <span class="text-slate-600">/</span>
            <a href="{{ route('services.index') }}" class="hover:text-primary transition-colors">Dịch vụ</a>
            <span class="text-slate-600">/</span>
            <span class="text-navy-base font-bold" aria-current="page">Quảng Cáo &amp; Truyền Thông Số</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
            <div class="lg:col-span-8 flex flex-col gap-5">
                <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-emerald-50 text-emerald-600 font-mono text-xs font-bold border border-emerald-200 w-fit shadow-sm">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span>GROWTH ENGINE &bull; DATA-DRIVEN MARKETING</span>
                </div>
                <h1 class="font-headline text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-navy-base leading-tight">
                    Chiến Lược Truyền Thông Số Toàn Diện, <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 via-primary to-amber-500">Quảng Cáo Chuyển Đổi Cao</span> &amp; Tăng Trưởng Bền Vững
                </h1>
                <p class="font-body text-slate-600 text-base sm:text-lg leading-relaxed max-w-3xl">
                    Kết hợp tư duy thuật toán quảng cáo chính xác cùng năng lực sản xuất nội dung video điện ảnh độc quyền. Giúp doanh nghiệp tiếp cận đúng đối tượng mục tiêu và tối ưu hóa tối đa chi phí chuyển đổi.
                </p>

                <!-- Channels Badges -->
                <div class="flex flex-wrap items-center gap-2 pt-2">
                    <span class="px-3 py-1 rounded-lg bg-white border border-emerald-200 text-emerald-700 font-mono text-xs font-bold">TikTok Ads &amp; TikTok Shop</span>
                    <span class="px-3 py-1 rounded-lg bg-white border border-sky-200 text-sky-700 font-mono text-xs font-bold">Meta Ads (FB/Insta)</span>
                    <span class="px-3 py-1 rounded-lg bg-white border border-amber-200 text-amber-700 font-mono text-xs font-bold">Google Search &amp; P-Max</span>
                    <span class="px-3 py-1 rounded-lg bg-white border border-purple-200 text-purple-700 font-mono text-xs font-bold">SEO Google Tổng Thể</span>
                </div>

                <div class="flex flex-wrap items-center gap-4 pt-3">
                    <a href="{{ route('contact') }}?service=marketing" class="px-6 py-3 rounded-xl bg-gradient-to-r from-primary to-accent-coral text-white font-headline text-xs sm:text-sm font-bold shadow-lg shadow-primary/25 hover:brightness-110 transition-all flex items-center gap-2">
                        <span class="material-symbols-outlined text-[18px]">query_stats</span>
                        <span>Đăng Ký Nhận Kế Hoạch Tăng Trưởng</span>
                    </a>
                    <a href="#workflow" class="px-6 py-3 rounded-xl bg-navy-base border border-slate-700 text-white font-headline text-xs sm:text-sm font-semibold hover:bg-slate-800 transition-all flex items-center gap-2 cursor-pointer">
                        <span class="material-symbols-outlined text-[18px] text-emerald-400">account_tree</span>
                        <span>Xem Quy Trình Triển Khai</span>
                    </a>
                </div>
            </div>

            <div class="lg:col-span-4">
                <div class="p-6 rounded-3xl bg-white border border-slate-200 shadow-xl flex flex-col gap-5">
                    <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                        <span class="font-mono text-xs text-emerald-700 font-bold uppercase tracking-wider">NGUYÊN TẮc THỰC THI</span>
                        <span class="material-symbols-outlined text-emerald-600">verified</span>
                    </div>
                    
                    <!-- Visual Dashboard Element -->
                    <div class="rounded-xl bg-slate-900/80 border border-white/10 p-4 mt-2 mb-1 overflow-hidden relative">
                        <div class="absolute inset-0 bg-gradient-to-br from-emerald-500/10 to-transparent"></div>
                        <div class="flex items-center justify-between mb-3 relative z-10">
                            <span class="text-[10px] text-slate-400 font-mono">LIVE PERFORMANCE</span>
                            <span class="text-[10px] text-emerald-400 font-bold bg-emerald-500/20 px-1.5 py-0.5 rounded flex items-center gap-1"><span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>ACTIVE</span>
                        </div>
                        <div class="flex items-end gap-2 mb-3 h-12 relative z-10 border-b border-white/5 pb-1">
                            <!-- CSS Bar Chart -->
                            <div class="w-1/6 bg-emerald-500/40 rounded-t h-[30%] hover:bg-emerald-400 transition-colors cursor-crosshair relative group"></div>
                            <div class="w-1/6 bg-emerald-500/50 rounded-t h-[45%] hover:bg-emerald-400 transition-colors cursor-crosshair relative group"></div>
                            <div class="w-1/6 bg-emerald-500/60 rounded-t h-[60%] hover:bg-emerald-400 transition-colors cursor-crosshair relative group"></div>
                            <div class="w-1/6 bg-emerald-500/70 rounded-t h-[50%] hover:bg-emerald-400 transition-colors cursor-crosshair relative group"></div>
                            <div class="w-1/6 bg-emerald-500/80 rounded-t h-[75%] hover:bg-emerald-400 transition-colors cursor-crosshair relative group"></div>
                            <div class="w-1/6 bg-emerald-400 rounded-t h-full shadow-[0_0_12px_rgba(52,211,153,0.6)] cursor-crosshair relative group">
                                <div class="absolute -top-6 left-1/2 -translate-x-1/2 bg-white text-navy-base text-[9px] font-bold px-1.5 py-0.5 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap z-20">MAX</div>
                            </div>
                        </div>
                        <div class="flex justify-between items-center relative z-10">
                            <div>
                                <div class="text-[9px] text-slate-400">Target ROAS</div>
                                <div class="text-xs font-bold text-white">> 4.5x</div>
                            </div>
                            <div class="text-right">
                                <div class="text-[9px] text-slate-400">CPA (Cost per Action)</div>
                                <div class="text-xs font-bold text-emerald-400 flex items-center gap-0.5 justify-end"><span class="material-symbols-outlined text-[12px]">trending_down</span> Tối ưu liên tục</div>
                            </div>
                        </div>
                    </div>

                    <ul class="flex flex-col gap-3 font-body text-xs text-slate-700">
                        <li class="flex items-center gap-2.5">
                            <span class="material-symbols-outlined text-emerald-600 text-[18px]">check_circle</span>
                            <span>Minh bạch 100% tài khoản quảng cáo của khách</span>
                        </li>
                        <li class="flex items-center gap-2.5">
                            <span class="material-symbols-outlined text-emerald-600 text-[18px]">check_circle</span>
                            <span>Tự sản xuất Video Creative, không mua stock</span>
                        </li>
                        <li class="flex items-center gap-2.5">
                            <span class="material-symbols-outlined text-emerald-600 text-[18px]">check_circle</span>
                            <span>Cài đặt Pixel &amp; Conversion API chuẩn xác</span>
                        </li>
                        <li class="flex items-center gap-2.5">
                            <span class="material-symbols-outlined text-emerald-600 text-[18px]">check_circle</span>
                            <span>Báo cáo Dashboard trực quan theo tuần/tháng</span>
                        </li>
                    </ul>
                    <div class="pt-2">
                        <a href="{{ route('pricing') }}" class="w-full py-2.5 rounded-xl bg-surface-low hover:bg-slate-100 text-navy-base font-headline text-xs font-bold transition-all text-center block border border-slate-200">
                            Xem Bảng Phí Quản Lý Chiến Dịch
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Section 2: 3 Trụ Cột Tăng Trưởng Thực Chiến -->
<section class="w-full bg-surface bg-dot-grid-subtle py-16 lg:py-20 border-b border-slate-200/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-12 lg:mb-16">
            <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-emerald-100 text-emerald-800 font-mono text-xs font-bold mb-3 border border-emerald-200">
                <span class="material-symbols-outlined text-[16px]">campaign</span>
                <span>CORE MARKETING PILLARS</span>
            </div>
            <h2 class="font-headline text-3xl sm:text-4xl font-extrabold tracking-tight text-navy-base">
                3 Trọng Tâm Truyền Thông Số Hiệu Quả
            </h2>
            <p class="font-body text-slate-600 text-sm sm:text-base mt-3 leading-relaxed">
                Tổ chức chiến dịch đa kênh đồng bộ, tạo ra phễu chuyển đổi liền mạch từ nhận diện đến chốt đơn hàng.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Pillar 1 -->
            <div class="opacity-0 translate-y-8 scroll-reveal p-8 rounded-3xl bg-white border border-slate-200/90 shadow-sm hover:border-emerald-500/50 hover:shadow-xl hover:-translate-y-1 transition-all duration-500 flex flex-col justify-between group" style="transition-delay: 100ms;">
                <div class="flex flex-col gap-4">
                    <div class="w-14 h-14 rounded-2xl bg-emerald-100 text-emerald-700 flex items-center justify-center font-headline text-2xl font-bold group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-[30px]">ads_click</span>
                    </div>
                    <h3 class="font-headline text-xl font-bold text-navy-base group-hover:text-primary transition-colors">
                        Quảng Cáo Trả Phí (Paid Ads)
                    </h3>
                    <p class="font-body text-xs sm:text-sm text-slate-600 leading-relaxed">
                        Triển khai chiến dịch đa kênh: TikTok Ads tối ưu cho ngành tiêu dùng/F&B, Meta Ads tiếp cận đúng tệp khách hàng tiềm năng, và Google Search đánh trúng nhu cầu mua sắm có chủ đích.
                    </p>
                </div>
                <div class="pt-6 mt-6 border-t border-slate-200 text-xs font-mono font-bold text-emerald-600">
                    Tối ưu CPA &amp; Chi phí chuyển đổi
                </div>
            </div>

            <!-- Pillar 2 -->
            <div class="opacity-0 translate-y-8 scroll-reveal p-8 rounded-3xl bg-white border border-slate-200/90 shadow-sm hover:border-primary/50 hover:shadow-xl hover:-translate-y-1 transition-all duration-500 flex flex-col justify-between group" style="transition-delay: 200ms;">
                <div class="flex flex-col gap-4">
                    <div class="w-14 h-14 rounded-2xl bg-orange-100 text-primary flex items-center justify-center font-headline text-2xl font-bold group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-[30px]">search_insights</span>
                    </div>
                    <h3 class="font-headline text-xl font-bold text-navy-base group-hover:text-primary transition-colors">
                        SEO Google &amp; Content Hub
                    </h3>
                    <p class="font-body text-xs sm:text-sm text-slate-600 leading-relaxed">
                        Nghiên cứu bộ từ khóa có chuyển đổi cao, tối ưu Technical SEO và cấu trúc silo nội dung chuyên sâu. Giúp website doanh nghiệp lên Top Google tự nhiên, đem về dòng khách hàng tiềm năng miễn phí và bền vững.
                    </p>
                </div>
                <div class="pt-6 mt-6 border-t border-slate-200 text-xs font-mono font-bold text-primary">
                    Tăng trưởng lưu lượng bền vững
                </div>
            </div>

            <!-- Pillar 3 -->
            <div class="opacity-0 translate-y-8 scroll-reveal p-8 rounded-3xl bg-white border border-slate-200/90 shadow-sm hover:border-sky-500/50 hover:shadow-xl hover:-translate-y-1 transition-all duration-500 flex flex-col justify-between group" style="transition-delay: 300ms;">
                <div class="flex flex-col gap-4">
                    <div class="w-14 h-14 rounded-2xl bg-sky-100 text-sky-700 flex items-center justify-center font-headline text-2xl font-bold group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-[30px]">share_reviews</span>
                    </div>
                    <h3 class="font-headline text-xl font-bold text-navy-base group-hover:text-primary transition-colors">
                        Xây Kênh Mạng Xã Hội Viral
                    </h3>
                    <p class="font-body text-xs sm:text-sm text-slate-600 leading-relaxed">
                        Xây dựng kênh TikTok, Fanpage và YouTube từ con số 0: Lên kịch bản nội dung định kỳ, sản xuất video ngắn bắt trend và xây dựng tệp người hâm mộ trung thành cho thương hiệu.
                    </p>
                </div>
                <div class="pt-6 mt-6 border-t border-slate-200 text-xs font-mono font-bold text-sky-600">
                    Gia tăng nhận diện &amp; Tương tác
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Section 3: Lợi Thế Tự Sản Xuất Creative -->
<section class="relative w-full py-16 lg:py-20 border-b border-slate-200/80 bg-surface-low bg-dot-grid-subtle overflow-hidden">
    <div class="absolute top-1/2 right-0 w-96 h-96 bg-emerald-500/10 rounded-full blur-3xl pointer-events-none -translate-y-1/2"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="p-8 sm:p-12 rounded-3xl bg-white border border-slate-200/90 flex flex-col lg:flex-row items-center justify-between gap-10 shadow-sm">
            <div class="flex flex-col gap-4 max-w-2xl">
                <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-amber-50 text-amber-600 font-mono text-xs font-bold w-fit border border-amber-200">
                    <span class="material-symbols-outlined text-[16px]">verified</span>
                    <span>LỢI THẾ CẠNH TRANH ĐỘC BẢN</span>
                </div>
                <h2 class="font-headline text-2xl sm:text-4xl font-extrabold text-navy-base leading-tight">
                    Tối Ưu Ngân Sách Nhờ Tự Sản Xuất Tư Liệu Video Chất Lượng Cao
                </h2>
                <p class="font-body text-slate-600 text-sm sm:text-base leading-relaxed">
                    Khác biệt hoàn toàn so với các agency chỉ chạy hình ảnh tĩnh hoặc phụ thuộc vào việc mua video stock có sẵn, Truyền Thông Cửu Long sở hữu đội ngũ quay dựng phim nội bộ. Chúng tôi liên tục sản xuất các mẫu Video Creative mới lạ, chân thực và bắt mắt — giúp mẫu quảng cáo nổi bật trên bảng tin người dùng, nâng cao tỷ lệ nhấp chuột (CTR) và tối ưu hóa hiệu quả phân bổ ngân sách.
                </p>
            </div>
            <div class="grid grid-cols-2 gap-4 shrink-0 w-full lg:w-auto">
                <div class="p-5 rounded-2xl bg-surface border border-slate-200 text-center flex flex-col items-center gap-1 shadow-sm">
                    <span class="material-symbols-outlined text-amber-500 text-[28px]">movie_filter</span>
                    <span class="font-headline text-base font-bold text-navy-base">Video Thật 100%</span>
                    <span class="text-[10px] text-slate-500">Không dùng stock rập khuôn</span>
                </div>
                <div class="p-5 rounded-2xl bg-surface border border-slate-200 text-center flex flex-col items-center gap-1 shadow-sm">
                    <span class="material-symbols-outlined text-emerald-500 text-[28px]">speed</span>
                    <span class="font-headline text-base font-bold text-navy-base">Đổi Mẫu Nhanh</span>
                    <span class="text-[10px] text-slate-500">Tránh bão hòa quảng cáo</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Section 4: Quy Trình 5 Bước -->
<section id="workflow" class="w-full bg-white bg-dot-grid-subtle py-16 lg:py-20 border-b border-slate-200/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-12 lg:mb-16">
            <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-emerald-100 text-emerald-800 font-mono text-xs font-bold mb-3 border border-emerald-200">
                <span class="material-symbols-outlined text-[16px]">flowsheet</span>
                <span>CAMPAIGN MANAGEMENT PROCESS</span>
            </div>
            <h2 class="font-headline text-3xl sm:text-4xl font-extrabold tracking-tight text-navy-base">
                Quy Trình Quản Trị Chiến Dịch 5 Bước
            </h2>
            <p class="font-body text-slate-600 text-sm sm:text-base mt-3 leading-relaxed">
                Được chuẩn hóa nghiêm ngặt, bám sát số liệu thực tế để đưa ra quyết định tối ưu chính xác từng ngày.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
            <div class="opacity-0 translate-y-8 scroll-reveal p-5 rounded-2xl bg-surface border border-slate-200/90 shadow-sm flex flex-col gap-2 hover:border-emerald-500/40 hover:shadow-lg hover:-translate-y-1 transition-all duration-500" style="transition-delay: 100ms;">
                <span class="font-mono text-xl font-black text-emerald-600">01</span>
                <h3 class="font-headline text-sm font-bold text-navy-base">Nghiên Cứu &amp; Phân Tích</h3>
                <p class="font-body text-xs text-slate-600 leading-relaxed">Khảo sát chân dung khách hàng, phân tích đối thủ cùng ngành và xác định chỉ số mục tiêu.</p>
            </div>
            <div class="opacity-0 translate-y-8 scroll-reveal p-5 rounded-2xl bg-surface border border-slate-200/90 shadow-sm flex flex-col gap-2 hover:border-emerald-500/40 hover:shadow-lg hover:-translate-y-1 transition-all duration-500" style="transition-delay: 200ms;">
                <span class="font-mono text-xl font-black text-emerald-600">02</span>
                <h3 class="font-headline text-sm font-bold text-navy-base">Cài Đặt Tracking Đo Lường</h3>
                <p class="font-body text-xs text-slate-600 leading-relaxed">Thiết lập Pixel, CAPI, Google Tag Manager và sự kiện chuyển đổi để kiểm soát dữ liệu chính xác.</p>
            </div>
            <div class="opacity-0 translate-y-8 scroll-reveal p-5 rounded-2xl bg-surface border border-slate-200/90 shadow-sm flex flex-col gap-2 hover:border-emerald-500/40 hover:shadow-lg hover:-translate-y-1 transition-all duration-500" style="transition-delay: 300ms;">
                <span class="font-mono text-xl font-black text-emerald-600">03</span>
                <h3 class="font-headline text-sm font-bold text-navy-base">Sản Xuất Creative Đa Dạng</h3>
                <p class="font-body text-xs text-slate-600 leading-relaxed">Thiết kế banner, quay dựng video ngắn, viết bài quảng cáo theo nhiều góc tiếp cận khác nhau.</p>
            </div>
            <div class="opacity-0 translate-y-8 scroll-reveal p-5 rounded-2xl bg-surface border border-slate-200/90 shadow-sm flex flex-col gap-2 hover:border-emerald-500/40 hover:shadow-lg hover:-translate-y-1 transition-all duration-500" style="transition-delay: 400ms;">
                <span class="font-mono text-xl font-black text-emerald-600">04</span>
                <h3 class="font-headline text-sm font-bold text-navy-base">Thử Nghiệm &amp; Tối Ưu</h3>
                <p class="font-body text-xs text-slate-600 leading-relaxed">Chạy thử nghiệm A/B Testing, loại bỏ các mẫu kém hiệu quả và dồn ngân sách vào các tệp sinh lời.</p>
            </div>
            <div class="opacity-0 translate-y-8 scroll-reveal p-5 rounded-2xl bg-surface border border-slate-200/90 shadow-sm flex flex-col gap-2 hover:border-emerald-500/40 hover:shadow-lg hover:-translate-y-1 transition-all duration-500" style="transition-delay: 500ms;">
                <span class="font-mono text-xl font-black text-emerald-600">05</span>
                <h3 class="font-headline text-sm font-bold text-navy-base">Báo Cáo &amp; Mở Rộng Quy Mô</h3>
                <p class="font-body text-xs text-slate-600 leading-relaxed">Bàn giao số liệu minh bạch, họp đánh giá định kỳ và đề xuất kế hoạch mở rộng tăng trưởng.</p>
            </div>
        </div>
    </div>
</section>

<!-- Section 5: Cam Kết Minh Bạch Số Liệu (Case Study Placeholder) -->
<!-- TODO: Thay thế section này bằng các Case Study kết quả thực tế khi có số liệu (Traffic, ROAS, CPA) của từng dự án cụ thể. -->
<section id="results" class="w-full bg-surface-low py-16 lg:py-20 border-b border-slate-200/80 bg-dot-grid-subtle relative overflow-hidden">
    <!-- Ambient Glow -->
    <div class="absolute top-0 right-1/4 w-[500px] h-[500px] bg-emerald-500/10 rounded-full blur-[100px] pointer-events-none"></div>
    <div class="absolute bottom-0 left-1/4 w-[400px] h-[400px] bg-sky-500/10 rounded-full blur-[100px] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="flex flex-col lg:flex-row items-end justify-between gap-8 mb-12 lg:mb-16">
            <div class="max-w-2xl">
                <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-emerald-50 text-emerald-600 font-mono text-xs font-bold mb-3 border border-emerald-200 shadow-sm">
                    <span class="material-symbols-outlined text-[16px]">monitoring</span>
                    <span>MINH BẠCH SỐ LIỆU ĐO LƯỜNG</span>
                </div>
                <h2 class="font-headline text-3xl sm:text-4xl font-extrabold tracking-tight text-navy-base">
                    Chúng tôi không nói bằng cảm tính.<br/>Chúng tôi chứng minh bằng con số.
                </h2>
                <p class="font-body text-slate-600 text-sm sm:text-base mt-4 leading-relaxed">
                    Mỗi chiến dịch được Truyền Thông Cửu Long triển khai đều gắn liền với một Dashboard báo cáo theo thời gian thực. Khách hàng nắm rõ từng đồng ngân sách được chi tiêu như thế nào và đem lại giá trị chuyển đổi ra sao.
                </p>
            </div>
            <div class="shrink-0">
                <a href="{{ route('pricing') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-white text-navy-base font-headline text-sm font-bold border border-slate-200 hover:bg-slate-50 shadow-sm transition-all cursor-pointer">
                    <span>Xem Bảng Phí Quản Lý Chiến Dịch</span>
                    <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                </a>
            </div>
        </div>

        <!-- Metric Cards Layout (Placeholder for real case studies) -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            
            <!-- Metric Card 1 -->
            <div class="opacity-0 translate-y-8 scroll-reveal p-6 rounded-3xl bg-white border border-slate-200/90 shadow-sm flex flex-col gap-5 hover:border-emerald-500/40 hover:-translate-y-1 transition-all duration-500 group" style="transition-delay: 100ms;">
                <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-emerald-50 flex items-center justify-center">
                            <span class="material-symbols-outlined text-emerald-600 text-[20px]">public</span>
                        </div>
                        <div>
                            <div class="font-headline font-bold text-navy-base text-base">Traffic &amp; Reach</div>
                            <div class="text-[11px] font-mono text-emerald-600">Tối ưu độ phủ</div>
                        </div>
                    </div>
                </div>
                <div class="flex-1">
                    <p class="font-body text-xs text-slate-600 leading-relaxed mb-4">
                        Tăng trưởng lượng truy cập tự nhiên (Organic Traffic) và số lượt tiếp cận (Reach) trên các nền tảng mạng xã hội, đảm bảo thông điệp tiếp cận đúng tệp khách hàng tiềm năng.
                    </p>
                </div>
                <!-- TODO: Insert real metric here e.g. "+350% Traffic" -->
                <div class="p-4 rounded-xl bg-slate-50 border border-slate-100 flex items-center justify-between">
                    <span class="text-xs font-mono text-slate-500">Chỉ số đo lường chính</span>
                    <span class="material-symbols-outlined text-slate-400">bar_chart</span>
                </div>
            </div>

            <!-- Metric Card 2 -->
            <div class="opacity-0 translate-y-8 scroll-reveal p-6 rounded-3xl bg-white border border-slate-200/90 shadow-sm flex flex-col gap-5 hover:border-emerald-500/40 hover:-translate-y-1 transition-all duration-500 group" style="transition-delay: 200ms;">
                <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-emerald-50 flex items-center justify-center">
                            <span class="material-symbols-outlined text-emerald-600 text-[20px]">shopping_cart_checkout</span>
                        </div>
                        <div>
                            <div class="font-headline font-bold text-navy-base text-base">CPA (Cost per Action)</div>
                            <div class="text-[11px] font-mono text-emerald-600">Tối ưu chi phí</div>
                        </div>
                    </div>
                </div>
                <div class="flex-1">
                    <p class="font-body text-xs text-slate-600 leading-relaxed mb-4">
                        Giảm thiểu chi phí cho mỗi lượt chuyển đổi (tin nhắn, điền form, chốt đơn) nhờ các mẫu Video Creative sắc nét và tệp đối tượng Lookalike được AI máy học phân tích.
                    </p>
                </div>
                <!-- TODO: Insert real metric here e.g. "-45% CPA" -->
                <div class="p-4 rounded-xl bg-slate-50 border border-slate-100 flex items-center justify-between">
                    <span class="text-xs font-mono text-slate-500">Chỉ số đo lường chính</span>
                    <span class="material-symbols-outlined text-slate-400">trending_down</span>
                </div>
            </div>

            <!-- Metric Card 3 -->
            <div class="opacity-0 translate-y-8 scroll-reveal p-6 rounded-3xl bg-white border border-slate-200/90 shadow-sm flex flex-col gap-5 hover:border-emerald-500/40 hover:-translate-y-1 transition-all duration-500 group" style="transition-delay: 300ms;">
                <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-emerald-50 flex items-center justify-center">
                            <span class="material-symbols-outlined text-emerald-600 text-[20px]">payments</span>
                        </div>
                        <div>
                            <div class="font-headline font-bold text-navy-base text-base">ROAS (Return on Ad Spend)</div>
                            <div class="text-[11px] font-mono text-emerald-600">Tối ưu lợi nhuận</div>
                        </div>
                    </div>
                </div>
                <div class="flex-1">
                    <p class="font-body text-xs text-slate-600 leading-relaxed mb-4">
                        Đảm bảo doanh thu mang về vượt trội so với chi phí quảng cáo bỏ ra. Setup phễu remarketing bám đuổi thông minh để tối đa hóa giá trị vòng đời khách hàng.
                    </p>
                </div>
                <!-- TODO: Insert real metric here e.g. "8.5x ROAS" -->
                <div class="p-4 rounded-xl bg-slate-50 border border-slate-100 flex items-center justify-between">
                    <span class="text-xs font-mono text-slate-500">Chỉ số đo lường chính</span>
                    <span class="material-symbols-outlined text-slate-400">pie_chart</span>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Section 6: Final CTA & Pricing Intro -->
<section class="w-full bg-[#080C16] py-16 lg:py-24 relative overflow-hidden text-white border-t border-white/10">
    <div class="absolute inset-0 bg-dot-grid-dark opacity-50"></div>
    <!-- Interactive Glow Effect -->
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-emerald-500/20 rounded-full blur-[120px] pointer-events-none mix-blend-screen"></div>
    
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
        <h2 class="font-headline text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight mb-6">
            Bắt đầu chiến dịch tăng trưởng ngay hôm nay.
        </h2>
        <p class="font-body text-slate-300 text-base sm:text-lg mb-10 leading-relaxed max-w-2xl mx-auto">
            Chúng tôi cung cấp các gói dịch vụ linh hoạt: từ quản lý ngân sách quảng cáo cố định đến mô hình hợp tác chia sẻ rủi ro cam kết KPI doanh số.
        </p>

        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="{{ route('pricing') }}" class="w-full sm:w-auto px-8 py-3.5 rounded-xl bg-white text-navy-base font-headline text-sm font-bold shadow-xl hover:scale-105 transition-all flex items-center justify-center gap-2">
                <span>Xem Bảng Giá Chi Tiết</span>
                <span class="material-symbols-outlined text-[18px]">receipt_long</span>
            </a>
            <a href="{{ route('contact') }}?service=marketing" class="w-full sm:w-auto px-8 py-3.5 rounded-xl bg-emerald-500 text-white font-headline text-sm font-bold shadow-xl hover:scale-105 hover:bg-emerald-400 transition-all flex items-center justify-center gap-2">
                <span>Đăng Ký Tư Vấn</span>
                <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
            </a>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    if (entry.target.classList.contains('scroll-reveal')) {
                        entry.target.classList.remove('opacity-0', 'translate-y-8');
                        entry.target.classList.add('opacity-100', 'translate-y-0');
                    }
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });

        document.querySelectorAll('.scroll-reveal').forEach((el) => {
            observer.observe(el);
        });
    });
</script>
@endpush
