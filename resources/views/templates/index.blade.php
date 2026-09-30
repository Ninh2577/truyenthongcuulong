@extends('layouts.app')

@section('title', 'Kho Giao Diện Website Mẫu Chuẩn SEO - Truyền Thông Cửu Long')
@section('meta_description', 'Kho giao diện website mẫu chuyên nghiệp, chuẩn SEO Google, tối ưu UX/UI cho mọi ngành nghề: Bất động sản, E-commerce, Du lịch, Thời trang, Xe ô tô, Doanh nghiệp.')

@section('content')
<div class="w-full bg-[#f8f9fc] min-h-screen pb-16" style="font-family: var(--font-primary);" x-data="{
    consultModal: false,
    selectedTemplateTitle: '',
    selectedTemplateSlug: '',
    customerName: '',
    customerPhone: '',
    customerEmail: '',
    customerNote: '',
    isSubmitting: false,
    submitSuccess: false,

    openConsult(title, slug) {
        this.selectedTemplateTitle = title;
        this.selectedTemplateSlug = slug;
        this.customerNote = 'Tôi muốn nhận tư vấn & báo giá chi tiết cho mẫu giao diện: ' + title;
        this.submitSuccess = false;
        this.consultModal = true;
    },

    submitConsultForm() {
        if (!this.customerName || !this.customerPhone) {
            alert('Vui lòng nhập Họ tên và Số điện thoại để Cửu Long có thể liên hệ tư vấn!');
            return;
        }
        this.isSubmitting = true;
        const formData = new FormData();
        formData.append('_token', '{{ csrf_token() }}');
        formData.append('name', this.customerName);
        formData.append('phone', this.customerPhone);
        formData.append('email', this.customerEmail || 'demo-request@cuulong.vn');
        formData.append('service', 'Tư vấn Template: ' + this.selectedTemplateTitle);
        formData.append('message', this.customerNote + ' (Mã mẫu: ' + this.selectedTemplateSlug + ')');

        fetch('{{ route('contact.submit') }}', {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            },
            body: formData
        })
        .then(response => {
            this.isSubmitting = false;
            this.submitSuccess = true;
            setTimeout(() => {
                this.consultModal = false;
                this.customerName = '';
                this.customerPhone = '';
                this.customerEmail = '';
                this.customerNote = '';
            }, 3000);
        })
        .catch(error => {
            this.isSubmitting = false;
            // Fallback success feedback
            this.submitSuccess = true;
            setTimeout(() => {
                this.consultModal = false;
            }, 3000);
        });
    }
}">

    <!-- ==================== HEADER SECTION (SATEK STYLE) ==================== -->
    <section class="pt-28 pb-8 sm:pt-32 sm:pb-10 bg-white border-b border-slate-200/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <!-- Eyebrow -->
            <span class="inline-block text-xs sm:text-sm font-bold tracking-[0.2em] text-primary uppercase font-mono mb-2">
                OUR TEMPLATES
            </span>
            <!-- Main Title -->
            <h1 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-[#0f172a] uppercase tracking-tight mb-4">
                CÁC TEMPLATES CỦA CỬU LONG
            </h1>
            <p class="max-w-2xl mx-auto text-xs sm:text-sm text-slate-500 leading-relaxed">
                Kho giao diện thiết kế hiện đại, đạt tiêu chuẩn Core Web Vitals, tối ưu tỷ lệ chuyển đổi cho đa dạng ngành nghề kinh doanh.
            </p>

            <!-- Search Bar -->
            <div class="mt-6 max-w-xl mx-auto">
                <form action="{{ route('templates.index') }}" method="GET" class="relative flex items-center shadow-sm rounded-full bg-slate-50 border border-slate-200 focus-within:border-primary focus-within:bg-white focus-within:ring-2 focus-within:ring-primary/20 transition-all">
                    @if(request('industry'))
                        <input type="hidden" name="industry" value="{{ request('industry') }}">
                    @endif
                    <span class="material-symbols-outlined absolute left-4 text-slate-400 text-[20px]">search</span>
                    <input 
                        type="text" 
                        name="q" 
                        value="{{ request('q') }}" 
                        placeholder="Tìm kiếm mẫu theo tên (Re2, Ca2, Real Estate, Ô tô...)" 
                        class="w-full pl-12 pr-28 py-3 rounded-full bg-transparent text-slate-900 placeholder:text-slate-400 focus:outline-none text-xs sm:text-sm font-medium"
                    >
                    <button type="submit" class="absolute right-1.5 px-5 py-2 rounded-full bg-primary hover:bg-orange-600 text-white text-xs font-bold transition-all shadow-xs">
                        Tìm kiếm
                    </button>
                </form>
            </div>

            <!-- ==================== SATEK STYLE CATEGORY PILLS ==================== -->
            <div class="mt-8 flex items-center justify-start md:justify-center gap-2.5 overflow-x-auto pb-2 pt-1 [&::-webkit-scrollbar]:hidden" style="scrollbar-width: none; -ms-overflow-style: none;">
                <!-- Tất cả -->
                <a href="{{ route('templates.index') }}" 
                   class="inline-flex items-center gap-1.5 px-6 py-2.5 rounded-full text-xs sm:text-sm font-bold whitespace-nowrap transition-all duration-200 {{ empty($selectedIndustry) ? 'bg-primary text-white shadow-md shadow-primary/20' : 'bg-slate-100 text-slate-700 hover:bg-slate-200 hover:text-slate-900' }}">
                    <span>Tất cả</span>
                    <span class="text-[11px] opacity-80">({{ $totalCount ?? $templates->total() }})</span>
                </a>

                @foreach($industries as $ind)
                @php
                    $isActive = $selectedIndustry === $ind->slug;
                    $count = $industryCounts[$ind->slug] ?? 0;
                    $label = $cleanPillNames[$ind->slug] ?? $ind->name;
                @endphp
                <a href="{{ route('templates.index', ['industry' => $ind->slug]) }}" 
                   class="inline-flex items-center gap-1.5 px-6 py-2.5 rounded-full text-xs sm:text-sm font-bold whitespace-nowrap transition-all duration-200 {{ $isActive ? 'bg-primary text-white shadow-md shadow-primary/20' : 'bg-slate-100 text-slate-700 hover:bg-slate-200 hover:text-slate-900' }}">
                    <span>{{ $label }}</span>
                    @if($count > 0)
                        <span class="text-[11px] opacity-80">({{ $count }})</span>
                    @endif
                </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- ==================== TEMPLATES GRID (SATEK STYLE) ==================== -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-10">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($templates as $item)
            @php
                $thumb = $item->thumbnail_url ?: 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=800&q=80';
                $demoUrl = route('templates.show', ['slug' => $item->slug, 'view' => 'demo']);
                $detailUrl = route('templates.show', ['slug' => $item->slug]);
            @endphp
            <article class="group bg-white rounded-3xl border border-slate-200/90 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col overflow-hidden">
                <!-- Thumbnail Image Area -->
                <div class="m-3.5 mb-0 rounded-2xl overflow-hidden bg-slate-100 relative aspect-[16/10]">
                    <a href="{{ $demoUrl }}" class="block w-full h-full">
                        <img 
                            src="{{ $thumb }}" 
                            alt="{{ $item->title }}" 
                            onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=800&q=80';"
                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                            loading="lazy"
                        >
                    </a>

                    <!-- Hover Quick Overlay -->
                    <div class="absolute inset-0 bg-slate-900/30 backdrop-blur-[2px] opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center pointer-events-none">
                        <span class="px-4 py-2 rounded-full bg-white text-slate-900 font-bold text-xs shadow-lg flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-[16px] text-primary">visibility</span>
                            <span>Trải nghiệm Demo</span>
                        </span>
                    </div>
                </div>

                <!-- Card Body -->
                <div class="p-6 pt-4 flex flex-col flex-1">
                    <!-- Title -->
                    <h2 class="text-base sm:text-lg font-bold text-[#1A1A1B] mb-2 leading-snug group-hover:text-primary transition-colors line-clamp-1">
                        <a href="{{ $demoUrl }}">
                            {{ $item->title }}
                        </a>
                    </h2>

                    <!-- Excerpt / Summary -->
                    <p class="text-xs sm:text-sm text-slate-500 line-clamp-2 leading-relaxed mb-6 flex-1">
                        {{ $item->summary ?: 'Giao diện chuyên nghiệp, tương thích 100% mọi thiết bị, tối ưu chuẩn SEO và chuyển đổi đơn hàng.' }}
                    </p>

                    <!-- Two Action Buttons (Satek Style) -->
                    <div class="flex items-center gap-3 pt-2">
                        <!-- 1. View Demo Button -->
                        <a href="{{ $demoUrl }}" 
                           class="flex-1 py-2.5 px-4 rounded-full border border-primary text-primary hover:bg-primary hover:text-white transition-all duration-200 text-xs font-bold text-center flex items-center justify-center gap-1.5 shadow-2xs">
                            <span class="material-symbols-outlined text-[15px]">laptop_mac</span>
                            <span>View Demo</span>
                        </a>

                        <!-- 2. Yêu Cầu Tư Vấn Button -->
                        <button type="button" 
                                @click="openConsult('{{ addslashes($item->title) }}', '{{ $item->slug }}')"
                                class="flex-1 py-2.5 px-4 rounded-full bg-primary hover:bg-orange-600 text-white transition-all duration-200 text-xs font-bold text-center flex items-center justify-center gap-1.5 shadow-sm hover:shadow-md cursor-pointer">
                            <span class="material-symbols-outlined text-[15px]">headset_mic</span>
                            <span>Yêu Cầu Tư Vấn</span>
                        </button>
                    </div>
                </div>
            </article>
            @empty
            <div class="col-span-1 md:col-span-3 text-center py-16 bg-white rounded-3xl border border-slate-200">
                <span class="material-symbols-outlined text-4xl text-slate-400 mb-2">dashboard</span>
                <h3 class="text-base font-bold text-[#1A1A1B]">Không tìm thấy mẫu phù hợp</h3>
                <p class="text-xs text-slate-500 mt-1">Vui lòng chọn danh mục khác hoặc liên hệ để chúng tôi thiết kế riêng cho bạn.</p>
                <a href="{{ route('templates.index') }}" class="mt-4 inline-flex items-center gap-1 text-xs font-bold text-primary hover:underline">
                    <span>Xem tất cả mẫu</span>
                </a>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-10 flex justify-center">
            {{ $templates->links() }}
        </div>
    </div>

    <!-- ==================== VALUE HIGHLIGHTS / 4 STEP PROCESS ==================== -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-16 sm:mt-24 space-y-12">
        <!-- 4 Bước Quy Trình -->
        <section class="p-6 sm:p-10 rounded-3xl bg-white border border-slate-200/90 shadow-sm flex flex-col gap-8">
            <div class="border-b border-slate-100 pb-4 flex flex-col sm:flex-row sm:items-end justify-between gap-2">
                <div>
                    <span class="text-xs font-bold text-primary uppercase font-mono tracking-wider">TRIỂN KHAI NHANH CHÓNG</span>
                    <h3 class="text-xl sm:text-2xl font-bold text-[#070f1e] tracking-tight mt-1">
                        Quy Trình Triển Khai Template 4 Bước
                    </h3>
                </div>
                <span class="text-xs text-slate-500 font-medium">Hoàn thiện và bàn giao trong 3–5 ngày</span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="p-5 rounded-2xl bg-slate-50/80 border border-slate-200/80 space-y-2 hover:bg-slate-50 transition-colors">
                    <div class="flex items-center justify-between">
                        <span class="text-lg font-bold text-primary font-mono">01</span>
                        <div class="w-8 h-8 rounded-lg bg-orange-100 text-primary flex items-center justify-center">
                            <span class="material-symbols-outlined text-[18px]">dashboard_customize</span>
                        </div>
                    </div>
                    <h4 class="text-sm font-bold text-[#070f1e]">Chọn mẫu nền tảng</h4>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Lựa chọn giao diện demo ưng ý theo ngành nghề và tính năng mong muốn cho thương hiệu của bạn.
                    </p>
                </div>
                <div class="p-5 rounded-2xl bg-slate-50/80 border border-slate-200/80 space-y-2 hover:bg-slate-50 transition-colors">
                    <div class="flex items-center justify-between">
                        <span class="text-lg font-bold text-teal-600 font-mono">02</span>
                        <div class="w-8 h-8 rounded-lg bg-teal-100 text-teal-700 flex items-center justify-center">
                            <span class="material-symbols-outlined text-[18px]">palette</span>
                        </div>
                    </div>
                    <h4 class="text-sm font-bold text-[#070f1e]">Đồng bộ nhận diện</h4>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Cửu Long tiếp nhận logo, bộ màu thương hiệu, thông tin hotline và tích hợp kênh Zalo, Fanpage.
                    </p>
                </div>
                <div class="p-5 rounded-2xl bg-slate-50/80 border border-slate-200/80 space-y-2 hover:bg-slate-50 transition-colors">
                    <div class="flex items-center justify-between">
                        <span class="text-lg font-bold text-indigo-600 font-mono">03</span>
                        <div class="w-8 h-8 rounded-lg bg-indigo-100 text-indigo-700 flex items-center justify-center">
                            <span class="material-symbols-outlined text-[18px]">upload_file</span>
                        </div>
                    </div>
                    <h4 class="text-sm font-bold text-[#070f1e]">Cập nhật nội dung</h4>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Nạp bài viết giới thiệu, hình ảnh sản phẩm/dịch vụ thực tế và tối ưu cấu trúc thẻ chuẩn SEO on-page.
                    </p>
                </div>
                <div class="p-5 rounded-2xl bg-slate-50/80 border border-slate-200/80 space-y-2 hover:bg-slate-50 transition-colors">
                    <div class="flex items-center justify-between">
                        <span class="text-lg font-bold text-emerald-600 font-mono">04</span>
                        <div class="w-8 h-8 rounded-lg bg-emerald-100 text-emerald-700 flex items-center justify-center">
                            <span class="material-symbols-outlined text-[18px]">verified</span>
                        </div>
                    </div>
                    <h4 class="text-sm font-bold text-[#070f1e]">Bàn giao & Vận hành</h4>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Kích hoạt chứng chỉ SSL, kết nối tên miền chính thức và hướng dẫn quản trị nội dung dễ dàng.
                    </p>
                </div>
            </div>
        </section>

        <!-- Banner May Đo Chuyên Sâu -->
        <section class="p-8 sm:p-10 rounded-3xl bg-[#070f1e] border border-slate-800 text-white shadow-xl flex flex-col md:flex-row items-start md:items-center justify-between gap-6 relative overflow-hidden">
            <div class="absolute -right-20 -bottom-20 w-80 h-80 rounded-full bg-primary/10 blur-3xl pointer-events-none"></div>

            <div class="space-y-3 max-w-2xl relative z-10">
                <span class="text-xs font-bold text-primary uppercase font-mono tracking-wider">CUSTOM WEB DEVELOPMENT</span>
                <h3 class="text-xl sm:text-2xl lg:text-3xl font-bold text-white tracking-tight">
                    Cần Website May Đo Thiết Kế Độc Quyền?
                </h3>
                <p class="text-xs sm:text-sm text-slate-300 leading-relaxed">
                    Nếu bạn cần hệ thống website độc bản với nghiệp vụ riêng, tích hợp phần mềm CRM, ERP hoặc luồng đặt chỗ chuyên sâu, Cửu Long luôn sẵn sàng đồng hành từ khâu thiết kế UI/UX đến lập trình toàn diện.
                </p>
            </div>
            <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 shrink-0 relative z-10 w-full md:w-auto">
                <a href="{{ route('services.web-app') }}" class="px-6 py-3 rounded-full bg-primary hover:bg-orange-600 text-white text-xs font-bold text-center transition-all shadow-md">
                    <span>Xem giải pháp Web App</span>
                </a>
                <a href="{{ route('contact') }}" class="px-6 py-3 rounded-full bg-white/10 hover:bg-white/20 text-white border border-white/20 text-xs font-bold text-center transition-all">
                    <span>Liên hệ trực tiếp</span>
                </a>
            </div>
        </section>
    </div>

    <!-- ==================== QUICK CONSULTATION MODAL ==================== -->
    <div x-show="consultModal" 
         x-transition.opacity 
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/75 backdrop-blur-xs" 
         style="display: none;">
        <div @click.outside="consultModal = false" 
             class="w-full max-w-lg bg-white rounded-3xl border border-slate-200 shadow-2xl overflow-hidden flex flex-col">
            
            <!-- Modal Header -->
            <div class="px-6 py-4 bg-slate-900 text-white flex items-center justify-between">
                <div class="flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-lg bg-primary flex items-center justify-center text-white">
                        <span class="material-symbols-outlined text-[18px]">support_agent</span>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold">Yêu Cầu Tư Vấn Giao Diện</h3>
                        <p class="text-[11px] text-slate-400 truncate max-w-xs" x-text="selectedTemplateTitle"></p>
                    </div>
                </div>
                <button type="button" @click="consultModal = false" class="text-slate-400 hover:text-white transition-colors cursor-pointer">
                    <span class="material-symbols-outlined text-[22px]">close</span>
                </button>
            </div>

            <!-- Modal Content / Form -->
            <div class="p-6">
                <!-- Success message -->
                <div x-show="submitSuccess" class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-center space-y-2 mb-4">
                    <span class="material-symbols-outlined text-3xl text-emerald-600">check_circle</span>
                    <h4 class="font-bold text-sm">Gửi yêu cầu thành công!</h4>
                    <p class="text-xs text-slate-600">Đội ngũ Cửu Long sẽ liên hệ lại với bạn trong vòng 15 phút qua số điện thoại đã cung cấp.</p>
                </div>

                <form x-show="!submitSuccess" @submit.prevent="submitConsultForm" class="space-y-4">
                    <!-- Template badge indicator -->
                    <div class="p-3 rounded-xl bg-orange-50 border border-orange-200/80 flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary text-[18px]">verified</span>
                        <span class="text-xs text-slate-700 font-semibold truncate">
                            Mẫu đang chọn: <strong class="text-primary font-bold" x-text="selectedTemplateTitle"></strong>
                        </span>
                    </div>

                    <!-- Input Name -->
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Họ và tên của bạn <span class="text-rose-500">*</span></label>
                        <input type="text" x-model="customerName" required placeholder="Ví dụ: Nguyễn Văn A" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 focus:border-primary focus:ring-2 focus:ring-primary/20 text-xs sm:text-sm text-slate-900 outline-none transition-all">
                    </div>

                    <!-- Input Phone -->
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Số điện thoại / Zalo <span class="text-rose-500">*</span></label>
                        <input type="tel" x-model="customerPhone" required placeholder="Ví dụ: 0939 523 557" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 focus:border-primary focus:ring-2 focus:ring-primary/20 text-xs sm:text-sm text-slate-900 outline-none transition-all">
                    </div>

                    <!-- Input Email -->
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Email (nếu có)</label>
                        <input type="email" x-model="customerEmail" placeholder="email@doanhnghiep.vn" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 focus:border-primary focus:ring-2 focus:ring-primary/20 text-xs sm:text-sm text-slate-900 outline-none transition-all">
                    </div>

                    <!-- Input Note -->
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Nội dung mong muốn tư vấn</label>
                        <textarea x-model="customerNote" rows="3" class="w-full px-3.5 py-2 rounded-xl border border-slate-300 focus:border-primary focus:ring-2 focus:ring-primary/20 text-xs text-slate-900 outline-none transition-all resize-none"></textarea>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" 
                            :disabled="isSubmitting"
                            class="w-full py-3 rounded-xl bg-primary hover:bg-orange-600 text-white font-bold text-sm shadow-md transition-all flex items-center justify-center gap-2 cursor-pointer disabled:opacity-70">
                        <span x-show="!isSubmitting">Gửi Yêu Cầu Tư Vấn Ngay</span>
                        <span x-show="isSubmitting">Đang gửi yêu cầu...</span>
                        <span class="material-symbols-outlined text-[18px]">send</span>
                    </button>
                </form>

                <!-- Direct Contact Strip -->
                <div class="mt-4 pt-4 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
                    <span>Hoặc gọi trực tiếp:</span>
                    <a href="tel:0939523557" class="font-bold text-primary hover:underline flex items-center gap-1">
                        <span class="material-symbols-outlined text-[15px]">call</span>
                        <span>0939 523 557</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
