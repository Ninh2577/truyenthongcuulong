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
<section class="relative w-full overflow-hidden bg-surface bg-dot-grid-subtle pt-32 pb-12 lg:pt-36 lg:pb-16 border-b border-slate-200/80">
    <div class="absolute -top-24 right-0 w-[500px] h-[500px] rounded-full bg-gradient-to-br from-emerald-500/15 via-primary/10 to-transparent blur-3xl pointer-events-none"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <!-- Breadcrumb Navigation -->
        <nav class="flex items-center gap-2 text-xs font-headline text-slate-500 mb-6" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-primary transition-colors flex items-center gap-1">
                <span class="material-symbols-outlined text-[16px]">home</span>
                <span>Trang chủ</span>
            </a>
            <span class="text-slate-400">/</span>
            <a href="{{ route('services.index') }}" class="hover:text-primary transition-colors">Dịch vụ</a>
            <span class="text-slate-400">/</span>
            <span class="text-navy-base font-bold" aria-current="page">Quảng Cáo &amp; Truyền Thông Số</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
            <div class="lg:col-span-8 flex flex-col gap-5">
                <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-emerald-100/80 text-emerald-800 font-mono text-xs font-bold border border-emerald-200 w-fit">
                    <span class="w-2 h-2 rounded-full bg-emerald-600 animate-pulse"></span>
                    <span>GROWTH ENGINE &bull; DATA-DRIVEN MARKETING</span>
                </div>
                <h1 class="font-headline text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-navy-base leading-tight">
                    Chiến Lược Truyền Thông Số Toàn Diện, <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 via-primary to-accent-amber">Quảng Cáo Chuyển Đổi Cao</span> &amp; Tăng Trưởng Bền Vững
                </h1>
                <p class="font-body text-slate-600 text-base sm:text-lg leading-relaxed max-w-3xl">
                    Kết hợp tư duy thuật toán quảng cáo chính xác cùng năng lực sản xuất nội dung video điện ảnh độc quyền. Giúp doanh nghiệp tiếp cận đúng đối tượng mục tiêu và tối ưu hóa tối đa chi phí chuyển đổi.
                </p>

                <!-- Channels Badges -->
                <div class="flex flex-wrap items-center gap-2 pt-2">
                    <span class="px-3 py-1 rounded-lg bg-navy-base text-emerald-400 font-mono text-xs font-bold border border-emerald-500/30">TikTok Ads &amp; TikTok Shop</span>
                    <span class="px-3 py-1 rounded-lg bg-navy-base text-sky-400 font-mono text-xs font-bold border border-sky-500/30">Meta Ads (FB/Insta)</span>
                    <span class="px-3 py-1 rounded-lg bg-navy-base text-amber-400 font-mono text-xs font-bold border border-amber-500/30">Google Search &amp; P-Max</span>
                    <span class="px-3 py-1 rounded-lg bg-navy-base text-purple-400 font-mono text-xs font-bold border border-purple-500/30">SEO Google Tổng Thể</span>
                </div>

                <div class="flex flex-wrap items-center gap-4 pt-3">
                    <a href="{{ route('contact') }}?service=marketing" class="px-6 py-3 rounded-xl bg-gradient-to-r from-primary to-accent-coral text-white font-headline text-xs sm:text-sm font-bold shadow-lg shadow-primary/25 hover:brightness-110 transition-all flex items-center gap-2">
                        <span class="material-symbols-outlined text-[18px]">query_stats</span>
                        <span>Đăng Ký Nhận Kế Hoạch Tăng Trưởng</span>
                    </a>
                    <a href="#workflow" class="px-6 py-3 rounded-xl bg-white border border-slate-300 text-navy-base font-headline text-xs sm:text-sm font-semibold hover:bg-slate-50 transition-all flex items-center gap-2">
                        <span class="material-symbols-outlined text-[18px]">account_tree</span>
                        <span>Xem Quy Trình Triển Khai</span>
                    </a>
                </div>
            </div>

            <div class="lg:col-span-4">
                <div class="p-6 rounded-3xl bg-navy-base text-white border border-slate-700/80 shadow-xl flex flex-col gap-5">
                    <div class="flex items-center justify-between pb-3 border-b border-white/10">
                        <span class="font-mono text-xs text-emerald-400 font-bold uppercase tracking-wider">NGUYÊN TẮC THỰC THI</span>
                        <span class="material-symbols-outlined text-emerald-400">verified</span>
                    </div>
                    <ul class="flex flex-col gap-3 font-body text-xs text-slate-300">
                        <li class="flex items-center gap-2.5">
                            <span class="material-symbols-outlined text-emerald-400 text-[18px]">check_circle</span>
                            <span>Minh bạch 100% tài khoản quảng cáo của khách</span>
                        </li>
                        <li class="flex items-center gap-2.5">
                            <span class="material-symbols-outlined text-emerald-400 text-[18px]">check_circle</span>
                            <span>Tự sản xuất Video Creative, không mua stock</span>
                        </li>
                        <li class="flex items-center gap-2.5">
                            <span class="material-symbols-outlined text-emerald-400 text-[18px]">check_circle</span>
                            <span>Cài đặt Pixel &amp; Conversion API chuẩn xác</span>
                        </li>
                        <li class="flex items-center gap-2.5">
                            <span class="material-symbols-outlined text-emerald-400 text-[18px]">check_circle</span>
                            <span>Báo cáo Dashboard trực quan theo tuần/tháng</span>
                        </li>
                    </ul>
                    <div class="pt-2">
                        <a href="{{ route('pricing') }}" class="w-full py-2.5 rounded-xl bg-white/10 hover:bg-white/20 text-white font-headline text-xs font-bold transition-all text-center block">
                            Xem Bảng Phí Quản Lý Chiến Dịch
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Section 2: 3 Trụ Cột Tăng Trưởng Thực Chiến -->
<section class="w-full bg-white py-12 lg:py-16 border-b border-slate-200/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-10 lg:mb-12">
            <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-emerald-100 text-emerald-800 font-mono text-xs font-bold mb-3">
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
            <div class="p-8 rounded-3xl bg-surface border border-slate-200 hover:border-emerald-500/50 hover:shadow-xl transition-all flex flex-col justify-between group">
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
            <div class="p-8 rounded-3xl bg-surface border border-slate-200 hover:border-primary/50 hover:shadow-xl transition-all flex flex-col justify-between group">
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
            <div class="p-8 rounded-3xl bg-surface border border-slate-200 hover:border-sky-500/50 hover:shadow-xl transition-all flex flex-col justify-between group">
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
<section class="w-full bg-[#081023] text-white py-12 lg:py-16 border-b border-white/10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="p-8 sm:p-12 rounded-3xl bg-white/[0.03] border border-white/10 flex flex-col lg:flex-row items-center justify-between gap-10">
            <div class="flex flex-col gap-4 max-w-2xl">
                <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-amber-400/20 text-amber-400 font-mono text-xs font-bold w-fit border border-amber-400/30">
                    <span class="material-symbols-outlined text-[16px]">verified</span>
                    <span>LỢI THẾ CẠNH TRANH ĐỘC BẢN</span>
                </div>
                <h2 class="font-headline text-2xl sm:text-4xl font-extrabold text-white leading-tight">
                    Tối Ưu Ngân Sách Nhờ Tự Sản Xuất Tư Liệu Video Chất Lượng Cao
                </h2>
                <p class="font-body text-slate-300 text-sm sm:text-base leading-relaxed">
                    Khác biệt hoàn toàn so với các agency chỉ chạy hình ảnh tĩnh hoặc phụ thuộc vào việc mua video stock có sẵn, Truyền Thông Cửu Long sở hữu đội ngũ quay dựng phim nội bộ. Chúng tôi liên tục sản xuất các mẫu Video Creative mới lạ, chân thực và bắt mắt — giúp mẫu quảng cáo nổi bật trên bảng tin người dùng, nâng cao tỷ lệ nhấp chuột (CTR) và tối ưu hóa hiệu quả phân bổ ngân sách.
                </p>
            </div>
            <div class="grid grid-cols-2 gap-4 shrink-0 w-full lg:w-auto">
                <div class="p-5 rounded-2xl bg-white/5 border border-white/10 text-center flex flex-col items-center gap-1">
                    <span class="material-symbols-outlined text-amber-400 text-[28px]">movie_filter</span>
                    <span class="font-headline text-base font-bold text-white">Video Thật 100%</span>
                    <span class="text-[10px] text-slate-400">Không dùng stock rập khuôn</span>
                </div>
                <div class="p-5 rounded-2xl bg-white/5 border border-white/10 text-center flex flex-col items-center gap-1">
                    <span class="material-symbols-outlined text-emerald-400 text-[28px]">speed</span>
                    <span class="font-headline text-base font-bold text-white">Đổi Mẫu Nhanh</span>
                    <span class="text-[10px] text-slate-400">Tránh bão hòa quảng cáo</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Section 4: Quy Trình 5 Bước -->
<section id="workflow" class="w-full bg-white py-12 lg:py-16 border-b border-slate-200/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-10 lg:mb-12">
            <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-emerald-100 text-emerald-800 font-mono text-xs font-bold mb-3">
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
            <div class="p-5 rounded-2xl bg-surface border border-slate-200 flex flex-col gap-2">
                <span class="font-mono text-xl font-black text-emerald-600">01</span>
                <h3 class="font-headline text-sm font-bold text-navy-base">Nghiên Cứu &amp; Phân Tích</h3>
                <p class="font-body text-xs text-slate-600 leading-relaxed">Khảo sát chân dung khách hàng, phân tích đối thủ cùng ngành và xác định chỉ số mục tiêu.</p>
            </div>
            <div class="p-5 rounded-2xl bg-surface border border-slate-200 flex flex-col gap-2">
                <span class="font-mono text-xl font-black text-emerald-600">02</span>
                <h3 class="font-headline text-sm font-bold text-navy-base">Cài Đặt Tracking Đo Lường</h3>
                <p class="font-body text-xs text-slate-600 leading-relaxed">Thiết lập Pixel, CAPI, Google Tag Manager và sự kiện chuyển đổi để kiểm soát dữ liệu chính xác.</p>
            </div>
            <div class="p-5 rounded-2xl bg-surface border border-slate-200 flex flex-col gap-2">
                <span class="font-mono text-xl font-black text-emerald-600">03</span>
                <h3 class="font-headline text-sm font-bold text-navy-base">Sản Xuất Creative Đa Dạng</h3>
                <p class="font-body text-xs text-slate-600 leading-relaxed">Thiết kế banner, quay dựng video ngắn, viết bài quảng cáo theo nhiều góc tiếp cận khác nhau.</p>
            </div>
            <div class="p-5 rounded-2xl bg-surface border border-slate-200 flex flex-col gap-2">
                <span class="font-mono text-xl font-black text-emerald-600">04</span>
                <h3 class="font-headline text-sm font-bold text-navy-base">Thử Nghiệm &amp; Tối Ưu</h3>
                <p class="font-body text-xs text-slate-600 leading-relaxed">Chạy thử nghiệm A/B Testing, loại bỏ các mẫu kém hiệu quả và dồn ngân sách vào các tệp sinh lời.</p>
            </div>
            <div class="p-5 rounded-2xl bg-surface border border-slate-200 flex flex-col gap-2">
                <span class="font-mono text-xl font-black text-emerald-600">05</span>
                <h3 class="font-headline text-sm font-bold text-navy-base">Báo Cáo &amp; Mở Rộng Quy Mô</h3>
                <p class="font-body text-xs text-slate-600 leading-relaxed">Bàn giao số liệu minh bạch, họp đánh giá định kỳ và đề xuất kế hoạch mở rộng tăng trưởng.</p>
            </div>
        </div>
    </div>
</section>

@endsection
