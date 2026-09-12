@extends('layouts.app')

@section('title', 'Khách Hàng Tiêu Biểu & Đối Tác Doanh Nghiệp - Truyền Thông Cửu Long')
@section('meta_description', 'Khám phá danh sách các ngân hàng, tập đoàn sản xuất, trường đại học và doanh nghiệp đã tin tưởng đồng hành cùng Truyền Thông Cửu Long.')

@section('content')
<div class="w-full" x-data="{ activeCategory: 'all' }">

    <!-- 1. Small Hero Section (NỀN SÁNG: Surface Low) -->
    <section class="relative pt-32 pb-12 lg:pt-36 lg:pb-16 overflow-hidden border-b border-slate-200/80 bg-surface-low text-slate-900 bg-dot-grid-subtle">
        <div class="absolute inset-0 bg-gradient-to-b from-transparent via-surface-low/60 to-surface-low pointer-events-none"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- Breadcrumb -->
            <nav class="flex items-center gap-2 text-xs font-mono text-slate-400 mb-6" aria-label="Breadcrumb">
                <a href="{{ route('home') }}" class="hover:text-amber-400 transition-colors">Trang chủ</a>
                <span class="text-slate-600">/</span>
                <a href="{{ route('about') }}" class="hover:text-amber-400 transition-colors">Về chúng tôi</a>
                <span class="text-slate-600">/</span>
                <span class="text-amber-400 font-bold">Khách hàng tiêu biểu</span>
            </nav>

            <div class="text-center max-w-3xl mx-auto flex flex-col items-center gap-4">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-amber-400/10 border border-amber-400/30 text-amber-400 font-mono text-xs font-bold w-fit">
                    <span class="w-2 h-2 rounded-full bg-amber-400 animate-pulse"></span>
                    <span>AUTHENTIC CLIENT PORTFOLIO</span>
                </div>
                <h1 class="font-headline text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight leading-tight text-navy-base">
                    Những Thương Hiệu &amp; Tổ Chức <br class="hidden sm:inline" />
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary to-accent-amber">Đã Tin Chọn</span> Truyền Thông Cửu Long
                </h1>
                <p class="font-body text-slate-600 text-sm sm:text-base leading-relaxed">
                    Sự hài lòng và gắn kết bền bỉ của khách hàng doanh nghiệp chính là bằng chứng xác thực nhất cho năng lực sáng tạo điện ảnh và kỹ thuật số chuẩn mực của chúng tôi.
                </p>

                <div class="grid grid-cols-3 gap-4 pt-4 w-full max-w-lg">
                    <div class="p-3.5 rounded-2xl bg-white border border-slate-200 text-center shadow-sm">
                        <span class="font-headline text-2xl font-black text-primary">500+</span>
                        <p class="text-[11px] font-mono text-slate-500 mt-0.5">Dự án hoàn thành</p>
                    </div>
                    <div class="p-3.5 rounded-2xl bg-white border border-slate-200 text-center shadow-sm">
                        <span class="font-headline text-2xl font-black text-navy-base">30+</span>
                        <p class="text-[11px] font-mono text-slate-500 mt-0.5">Thương hiệu tiêu biểu</p>
                    </div>
                    <div class="p-3.5 rounded-2xl bg-white border border-slate-200 text-center shadow-sm">
                        <span class="font-headline text-2xl font-black text-emerald-600">99.2%</span>
                        <p class="text-[11px] font-mono text-slate-500 mt-0.5">Đánh giá xuất sắc</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 2. Interactive Client Showcase with Alpine.js (NỀN SÁNG: bg-surface) -->
    <section class="py-12 lg:py-16 bg-surface bg-dot-grid-subtle border-b border-slate-200/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Category Filter Tabs -->
            <div class="flex items-center justify-center flex-wrap gap-2 mb-10">
                <button @click="activeCategory = 'all'" 
                        class="px-4 py-2 rounded-xl text-xs font-headline font-bold transition-all"
                        :class="activeCategory === 'all' ? 'bg-navy-base text-white shadow-md' : 'bg-white border border-slate-200 text-slate-600 hover:text-navy-base hover:bg-slate-50'">
                    Tất cả (30 khách hàng)
                </button>
                <button @click="activeCategory = 'finance'" 
                        class="px-4 py-2 rounded-xl text-xs font-headline font-bold transition-all"
                        :class="activeCategory === 'finance' ? 'bg-navy-base text-white shadow-md' : 'bg-white border border-slate-200 text-slate-600 hover:text-navy-base hover:bg-slate-50'">
                    Tài chính &amp; Ngân hàng
                </button>
                <button @click="activeCategory = 'tech'" 
                        class="px-4 py-2 rounded-xl text-xs font-headline font-bold transition-all"
                        :class="activeCategory === 'tech' ? 'bg-navy-base text-white shadow-md' : 'bg-white border border-slate-200 text-slate-600 hover:text-navy-base hover:bg-slate-50'">
                    Công nghệ &amp; Giải pháp số
                </button>
                <button @click="activeCategory = 'industry'" 
                        class="px-4 py-2 rounded-xl text-xs font-headline font-bold transition-all"
                        :class="activeCategory === 'industry' ? 'bg-navy-base text-white shadow-md' : 'bg-white border border-slate-200 text-slate-600 hover:text-navy-base hover:bg-slate-50'">
                    Nông nghiệp &amp; Sản xuất
                </button>
                <button @click="activeCategory = 'tourism'" 
                        class="px-4 py-2 rounded-xl text-xs font-headline font-bold transition-all"
                        :class="activeCategory === 'tourism' ? 'bg-navy-base text-white shadow-md' : 'bg-white border border-slate-200 text-slate-600 hover:text-navy-base hover:bg-slate-50'">
                    Du lịch &amp; Bán lẻ
                </button>
                <button @click="activeCategory = 'healthcare'" 
                        class="px-4 py-2 rounded-xl text-xs font-headline font-bold transition-all"
                        :class="activeCategory === 'healthcare' ? 'bg-navy-base text-white shadow-md' : 'bg-white border border-slate-200 text-slate-600 hover:text-navy-base hover:bg-slate-50'">
                    Y tế, Giáo dục &amp; Xã hội
                </button>
            </div>

            @php
            $clientIcons = [
                'finance' => 'account_balance',
                'tech' => 'devices',
                'industry' => 'domain',
                'tourism' => 'flight_takeoff',
                'healthcare' => 'local_hospital'
            ];
            $clientLabels = [
                'finance' => 'Tài chính & Ngân hàng',
                'tech' => 'Công nghệ & Giải pháp số',
                'industry' => 'Nông nghiệp & Sản xuất',
                'tourism' => 'Du lịch & Bán lẻ',
                'healthcare' => 'Y tế, Giáo dục & Xã hội'
            ];
            @endphp

            <!-- Client Cards Grid (Nền Trắng, Viền Mỏng, Shadow Nhẹ) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
                @foreach($clients as $c)
                <div x-show="activeCategory === 'all' || activeCategory === '{{ $c->industry_category }}'"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"
                     class="p-6 rounded-3xl bg-white border border-slate-200/90 shadow-sm hover:border-amber-400/50 hover:shadow-md hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between group">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-10 h-10 rounded-xl bg-orange-50 text-primary border border-orange-200 flex items-center justify-center group-hover:bg-primary group-hover:text-white transition-colors">
                                <span class="material-symbols-outlined text-[22px]">{{ $clientIcons[$c->industry_category] ?? 'business' }}</span>
                            </div>
                            <span class="px-2 py-0.5 rounded-full bg-slate-100 border border-slate-200 font-mono text-[9px] text-slate-500 font-medium">
                                {{ $clientLabels[$c->industry_category] ?? 'Doanh nghiệp' }}
                            </span>
                        </div>
                        <h3 class="font-headline text-base font-bold text-navy-base group-hover:text-primary transition-colors line-clamp-1">
                            {{ $c->name }}
                        </h3>
                        <p class="font-body text-xs text-slate-500 mt-2 line-clamp-2">
                            Giải pháp: <span class="text-slate-700 font-medium">{{ $c->service_used }}</span>
                        </p>
                    </div>

                    <div class="pt-4 mt-4 border-t border-slate-100 flex items-center justify-between text-[11px] font-mono text-slate-400">
                        <span class="inline-flex items-center gap-1 text-emerald-600 font-medium">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                            Đã bàn giao
                        </span>
                        <span class="text-amber-600 font-bold">Verified Client</span>
                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </section>

    <!-- 3. Enterprise Commitments (NỀN SÁNG: Surface Low) -->
    <section class="relative py-12 lg:py-16 bg-surface-low bg-dot-grid-subtle border-b border-slate-200/80 text-slate-900 overflow-hidden">
        <!-- Ambient Glow -->
        <div class="absolute -top-28 right-10 w-96 h-96 rounded-full bg-emerald-500/10 blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-28 left-10 w-96 h-96 rounded-full bg-amber-500/10 blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center max-w-2xl mx-auto mb-10 lg:mb-12">
                <span class="font-mono text-xs text-primary font-bold uppercase tracking-widest">ENTERPRISE ASSURANCE</span>
                <h2 class="font-headline text-2xl sm:text-3xl lg:text-4xl font-extrabold mt-2 text-navy-base">
                    4 Cam Kết Khi Phục Vụ Khách Hàng Doanh Nghiệp
                </h2>
                <p class="font-body text-slate-600 text-xs sm:text-sm mt-3">
                    Tiêu chuẩn làm việc khắt khe bảo đảm sự an toàn và uy tín tối đa cho thương hiệu đối tác.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="p-6 rounded-3xl bg-white border border-slate-200 shadow-sm hover:border-primary/40 hover:shadow-md transition-all flex flex-col gap-3">
                    <div class="w-10 h-10 rounded-xl bg-orange-50 border border-orange-200 text-primary flex items-center justify-center font-headline font-bold text-sm">
                        01
                    </div>
                    <h3 class="font-headline text-base font-bold text-navy-base">Bảo Mật Thương Hiệu (NDA)</h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">
                        Ký kết thỏa thuận bảo mật dữ liệu sản phẩm, chiến lược marketing và thông số kỹ thuật trước khi nhận yêu cầu.
                    </p>
                </div>
                <div class="p-6 rounded-3xl bg-white border border-slate-200 shadow-sm hover:border-sky-500/40 hover:shadow-md transition-all flex flex-col gap-3">
                    <div class="w-10 h-10 rounded-xl bg-sky-50 border border-sky-200 text-sky-600 flex items-center justify-center font-headline font-bold text-sm">
                        02
                    </div>
                    <h3 class="font-headline text-base font-bold text-navy-base">Đo Lường Hiệu Quả Rõ Ràng</h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">
                        Nghiệm thu dựa trên chỉ số kỹ thuật và độ phủ truyền thông cụ thể, không dùng số liệu mơ hồ hay báo cáo ảo.
                    </p>
                </div>
                <div class="p-6 rounded-3xl bg-white border border-slate-200 shadow-sm hover:border-amber-500/40 hover:shadow-md transition-all flex flex-col gap-3">
                    <div class="w-10 h-10 rounded-xl bg-amber-50 border border-amber-200 text-amber-600 flex items-center justify-center font-headline font-bold text-sm">
                        03
                    </div>
                    <h3 class="font-headline text-base font-bold text-navy-base">Bàn Giao Đúng Tiến Độ</h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">
                        Quy trình kiểm soát chất lượng 2 lớp bảo đảm mốc phát sóng TVC hay ngày ra mắt web/app chính xác từng ngày.
                    </p>
                </div>
                <div class="p-6 rounded-3xl bg-white border border-slate-200 shadow-sm hover:border-emerald-500/40 hover:shadow-md transition-all flex flex-col gap-3">
                    <div class="w-10 h-10 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-600 flex items-center justify-center font-headline font-bold text-sm">
                        04
                    </div>
                    <h3 class="font-headline text-base font-bold text-navy-base">Bảo Hành Kỹ Thuật 24/7</h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">
                        Đội ngũ kỹ sư và kỹ thuật viên sẵn sàng can thiệp, vá lỗi và duy trì hạ tầng vận hành trơn tru suốt vòng đời sản phẩm.
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
    "@type": "CollectionPage",
    "name": "Khách Hàng Tiêu Biểu & Đối Tác Doanh Nghiệp - Truyền Thông Cửu Long",
    "description": "Danh sách các ngân hàng, tập đoàn sản xuất, trường đại học và doanh nghiệp đã tin tưởng đồng hành cùng Truyền Thông Cửu Long.",
    "url": "{{ route('clients') }}"
}
</script>
@endsection
