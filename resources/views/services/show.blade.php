@extends('layouts.app')

@section('title', $service->title . ' - Truyá»n ThÃ´ng Cá»­u Long')
@section('meta_description', $service->summary ?: 'Dá»‹ch vá»¥ ' . $service->title . ' chuyÃªn nghiá»‡p táº¡i Truyá»n ThÃ´ng Cá»­u Long.')

@section('content')
<div class="w-full bg-surface bg-dot-grid-subtle pt-28 pb-20 border-b border-slate-200/60">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col gap-16">
        
        <!-- Breadcrumb -->
        <nav class="flex items-center gap-2 text-xs font-headline text-slate-500">
            <a href="{{ route('home') }}" class="hover:text-primary">Trang chá»§</a>
            <span>/</span>
            <a href="{{ route('services.index') }}" class="hover:text-primary">Dá»‹ch vá»¥</a>
            <span>/</span>
            <span class="text-navy-base font-bold">{{ $service->title }}</span>
        </nav>

        <!-- Service Hero -->
        <div class="p-8 sm:p-12 rounded-3xl bg-navy-base text-white border border-slate-700 shadow-2xl flex flex-col lg:flex-row items-center justify-between gap-10 relative overflow-hidden">
            <div class="absolute -right-20 -top-20 w-96 h-96 rounded-full bg-primary/20 blur-3xl pointer-events-none"></div>
            <div class="flex flex-col gap-4 max-w-2xl relative z-10">
                <span class="font-mono text-xs text-accent-amber font-bold uppercase tracking-wider">ENTERPRISE SERVICE</span>
                <h1 class="font-headline text-3xl sm:text-5xl font-extrabold text-white tracking-tight leading-tight">
                    {{ $service->title }}
                </h1>
                <p class="font-body text-slate-300 text-sm sm:text-base leading-relaxed">
                    {{ $service->summary ?: 'Giáº£i phÃ¡p chuyÃªn sÃ¢u Ä‘Æ°á»£c thiáº¿t káº¿ riÃªng biá»‡t nháº±m tá»‘i Æ°u hÃ³a hiá»‡u quáº£ nháº­n diá»‡n thÆ°Æ¡ng hiá»‡u vÃ  chuyá»ƒn Ä‘á»•i doanh thu cho doanh nghiá»‡p.' }}
                </p>
                <div class="flex flex-wrap items-center gap-4 pt-2">
                    <a href="#booking-form" class="px-7 py-3.5 rounded-full bg-gradient-to-r from-primary to-accent-amber text-white font-headline text-xs font-bold shadow-lg hover:scale-105 transition-all">
                        ÄÄƒng KÃ½ TÆ° Váº¥n Ngay
                    </a>
                    <a href="{{ route('projects.index') }}" class="px-6 py-3.5 rounded-full bg-white/10 hover:bg-white/20 text-white font-headline text-xs font-bold transition-all">
                        Xem CÃ¡c Dá»± Ãn ÄÃ£ LÃ m
                    </a>
                </div>
            </div>
            <div class="w-full lg:w-96 rounded-2xl overflow-hidden bg-slate-800 border border-white/10 shadow-lg shrink-0">
                @if($service->thumbnail)
                <img src="{{ asset('storage/' . $service->thumbnail) }}" alt="{{ $service->title }}" class="w-full h-64 object-cover">
                @else
                <div class="w-full h-64 flex flex-col items-center justify-center bg-gradient-to-br from-navy-surface to-navy-card p-6 text-center text-slate-400">
                    <span class="material-symbols-outlined text-6xl text-primary mb-2">design_services</span>
                    <span class="font-headline text-sm font-bold text-white">{{ $service->title }}</span>
                </div>
                @endif
            </div>
        </div>

        <!-- Service Detailed Content -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
            
            <!-- Left: Description and 5-step Workflow -->
            <div class="lg:col-span-7 flex flex-col gap-10">
                <div class="prose prose-slate max-w-none text-slate-700 leading-relaxed font-body text-base">
                    {!! clean($service->content ?: '<p>Quy trình triển khai dịch vụ được kiểm soát nghiêm ngặt theo các tiêu chuẩn kỹ thuật hàng đầu, đảm bảo tiến độ bàn giao chính xác và bảo hành dài hạn.</p>') !!}
                </div>

                <!-- 5-step Workflow Section -->
                <div class="p-8 rounded-3xl bg-white border border-slate-200 shadow-xs flex flex-col gap-6">
                    <h3 class="font-headline text-xl font-bold text-navy-base flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">route</span>
                        <span>Quy TrÃ¬nh Triá»ƒn Khai Dá»‹ch Vá»¥</span>
                    </h3>
                    <div class="space-y-4">
                        <div class="flex items-start gap-4">
                            <span class="w-7 h-7 rounded-full bg-orange-100 text-primary font-bold text-xs flex items-center justify-center shrink-0 mt-0.5">1</span>
                            <div>
                                <h4 class="font-headline text-sm font-bold text-navy-base">Tiáº¿p nháº­n yÃªu cáº§u &amp; Kháº£o sÃ¡t hiá»‡n tráº¡ng</h4>
                                <p class="text-xs text-slate-500 mt-0.5">ChuyÃªn gia Truyá»n ThÃ´ng Cá»­u Long láº¯ng nghe bÃ i toÃ¡n vÃ  phÃ¢n tÃ­ch má»¥c tiÃªu kinh doanh cá»¥ thá»ƒ.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <span class="w-7 h-7 rounded-full bg-orange-100 text-primary font-bold text-xs flex items-center justify-center shrink-0 mt-0.5">2</span>
                            <div>
                                <h4 class="font-headline text-sm font-bold text-navy-base">LÃªn phÆ°Æ¡ng Ã¡n ká»‹ch báº£n / Thiáº¿t káº¿ ká»¹ thuáº­t</h4>
                                <p class="text-xs text-slate-500 mt-0.5">BÃ n giao proposal chi tiáº¿t, bÃ¡o giÃ¡ minh báº¡ch vÃ  kÃ½ há»£p Ä‘á»“ng cam káº¿t SLA.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <span class="w-7 h-7 rounded-full bg-orange-100 text-primary font-bold text-xs flex items-center justify-center shrink-0 mt-0.5">3</span>
                            <div>
                                <h4 class="font-headline text-sm font-bold text-navy-base">Thá»±c thi sáº£n xuáº¥t / Láº­p trÃ¬nh tÃ­nh nÄƒng</h4>
                                <p class="text-xs text-slate-500 mt-0.5">Ekip Senior trá»±c tiáº¿p báº¥m mÃ¡y hoáº·c Ä‘á»™i ngÅ© ká»¹ sÆ° tiáº¿n hÃ nh code há»‡ thá»‘ng.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <span class="w-7 h-7 rounded-full bg-orange-100 text-primary font-bold text-xs flex items-center justify-center shrink-0 mt-0.5">4</span>
                            <div>
                                <h4 class="font-headline text-sm font-bold text-navy-base">Háº­u ká»³ kiá»ƒm thá»­ &amp; Tinh chá»‰nh theo pháº£n há»“i</h4>
                                <p class="text-xs text-slate-500 mt-0.5">Chá»‰nh sá»­a tá»‘i thiá»ƒu 02 vÃ²ng cho Ä‘áº¿n khi Ä‘áº¡t cháº¥t lÆ°á»£ng nghiá»‡m thu hoÃ n háº£o.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <span class="w-7 h-7 rounded-full bg-orange-100 text-primary font-bold text-xs flex items-center justify-center shrink-0 mt-0.5">5</span>
                            <div>
                                <h4 class="font-headline text-sm font-bold text-navy-base">BÃ n giao báº£n quyá»n &amp; Báº£o hÃ nh dÃ i háº¡n</h4>
                                <p class="text-xs text-slate-500 mt-0.5">Chuyá»ƒn giao toÃ n bá»™ file gá»‘c Master/Source code vÃ  há»— trá»£ váº­n hÃ nh 24/7.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right: Dedicated Booking Form -->
            <div id="booking-form" class="lg:col-span-5 p-8 rounded-3xl bg-white border-2 border-orange-200 shadow-xl flex flex-col gap-5 sticky top-28">
                <div class="flex items-center gap-3 border-b border-slate-100 pb-4">
                    <div class="w-10 h-10 rounded-xl bg-orange-100 text-primary flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-[22px]">edit_calendar</span>
                    </div>
                    <div>
                        <h3 class="font-headline text-lg font-bold text-navy-base">ÄÄƒng KÃ½ TÆ° Váº¥n Dá»‹ch Vá»¥</h3>
                        <p class="text-[11px] text-slate-400">Nháº­n Ä‘á» xuáº¥t chiáº¿n lÆ°á»£c &amp; báº£ng dá»± toÃ¡n trong 24h</p>
                    </div>
                </div>

                @if(session('success'))
                <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-300 text-emerald-800 text-xs font-semibold">
                    {{ session('success') }}
                </div>
                @endif

                <form action="{{ route('contact.submit') }}" method="POST" class="flex flex-col gap-3.5">
                    @csrf
                    <input type="hidden" name="service_interested" value="{{ $service->title }}">
                    <div>
                        <label class="block font-headline text-xs font-bold text-slate-700 mb-1">Há» vÃ  tÃªn <span class="text-rose-500">*</span></label>
                        <input type="text" name="fullname" placeholder="Nguyá»…n VÄƒn A" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs text-navy-base focus:ring-2 focus:ring-primary focus:outline-none">
                    </div>
                    <div>
                        <label class="block font-headline text-xs font-bold text-slate-700 mb-1">Sá»‘ Ä‘iá»‡n thoáº¡i liÃªn há»‡ <span class="text-rose-500">*</span></label>
                        <input type="tel" name="phone" placeholder="0939 xxx xxx" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs text-navy-base focus:ring-2 focus:ring-primary focus:outline-none">
                    </div>
                    <div>
                        <label class="block font-headline text-xs font-bold text-slate-700 mb-1">Email cá»§a báº¡n</label>
                        <input type="email" name="email" placeholder="you@company.com" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs text-navy-base focus:ring-2 focus:ring-primary focus:outline-none">
                    </div>
                    <div>
                        <label class="block font-headline text-xs font-bold text-slate-700 mb-1">MÃ´ táº£ sÆ¡ bá»™ nhu cáº§u / NgÃ¢n sÃ¡ch dá»± kiáº¿n <span class="text-rose-500">*</span></label>
                        <textarea name="message" rows="3" required placeholder="VÃ­ dá»¥: Cáº§n quay TVC 60s cho sáº£n pháº©m má»›i..." class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs text-navy-base focus:ring-2 focus:ring-primary focus:outline-none"></textarea>
                    </div>

                    <button type="submit" class="mt-2 w-full py-3 rounded-xl bg-gradient-to-r from-primary to-accent-amber text-white font-headline text-xs font-bold shadow-md hover:brightness-110 transition-all">
                        Gá»­i YÃªu Cáº§u Cho Dá»‹ch Vá»¥ NÃ y
                    </button>
                </form>
            </div>

        </div>

    </div>
</div>
@endsection



