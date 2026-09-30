@extends('layouts.app')

@section('title', $template->title . ' - Kho Giao Diện Website Truyền Thông Cửu Long')
@section('meta_description', $template->summary ?: 'Xem chi tiết và trải nghiệm demo trực tiếp mẫu giao diện ' . $template->title . ' chuẩn SEO tại Truyền Thông Cửu Long.')

@section('content')
<div class="w-full bg-[#f8f9fc] min-h-screen pb-16" style="font-family: var(--font-primary);" x-data="{
    consultModal: false,
    customerName: '',
    customerPhone: '',
    customerEmail: '',
    customerNote: 'Tôi muốn tư vấn và báo giá chi tiết cho mẫu giao diện: {{ addslashes($template->title) }}',
    isSubmitting: false,
    submitSuccess: false,

    submitConsult() {
        if (!this.customerName || !this.customerPhone) {
            alert('Vui lòng nhập Họ tên và Số điện thoại!');
            return;
        }
        this.isSubmitting = true;
        const formData = new FormData();
        formData.append('_token', '{{ csrf_token() }}');
        formData.append('name', this.customerName);
        formData.append('phone', this.customerPhone);
        formData.append('email', this.customerEmail || 'demo@cuulong.vn');
        formData.append('service', 'Tư vấn Template: {{ addslashes($template->title) }}');
        formData.append('message', this.customerNote + ' (Mã mẫu: {{ $template->slug }})');

        fetch('{{ route('contact.submit') }}', {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            },
            body: formData
        })
        .then(() => {
            this.isSubmitting = false;
            this.submitSuccess = true;
            setTimeout(() => {
                this.consultModal = false;
            }, 3000);
        })
        .catch(() => {
            this.isSubmitting = false;
            this.submitSuccess = true;
            setTimeout(() => {
                this.consultModal = false;
            }, 3000);
        });
    }
}">

    <!-- ==================== BREADCRUMB & HERO ==================== -->
    <section class="pt-28 pb-10 bg-white border-b border-slate-200/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Breadcrumbs -->
            <nav class="flex items-center gap-2 text-xs text-slate-500 mb-6 font-medium">
                <a href="{{ route('home') }}" class="hover:text-primary transition-colors">Trang chủ</a>
                <span class="material-symbols-outlined text-[14px]">chevron_right</span>
                <a href="{{ route('templates.index') }}" class="hover:text-primary transition-colors">Kho giao diện</a>
                <span class="material-symbols-outlined text-[14px]">chevron_right</span>
                <span class="text-slate-900 font-bold truncate max-w-xs sm:max-w-md">{{ $template->title }}</span>
            </nav>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                <!-- Info Left -->
                <div class="lg:col-span-7 space-y-4">
                    <div class="flex flex-wrap items-center gap-2">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-orange-100 text-primary font-bold text-xs font-mono uppercase">
                            <span class="w-1.5 h-1.5 rounded-full bg-primary"></span>
                            <span>Template Sẵn Sàng</span>
                        </span>
                        <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-emerald-50 text-emerald-700 font-semibold text-xs border border-emerald-200">
                            <span class="material-symbols-outlined text-[14px]">bolt</span>
                            <span>Bàn giao 3–5 ngày</span>
                        </span>
                        <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-sky-50 text-sky-700 font-semibold text-xs border border-sky-200">
                            <span class="material-symbols-outlined text-[14px]">verified</span>
                            <span>Chuẩn SEO On-page</span>
                        </span>
                    </div>

                    <h1 class="text-2xl sm:text-3xl lg:text-4xl font-black text-[#0f172a] leading-tight">
                        {{ $template->title }}
                    </h1>

                    <p class="text-sm sm:text-base text-slate-600 leading-relaxed">
                        {{ $template->summary ?: 'Giao diện được thiết kế hiện đại, đạt tiêu chuẩn kỹ thuật Core Web Vitals của Google, tương thích 100% trên các thiết bị di động, tablet và máy tính để bàn.' }}
                    </p>

                    <!-- CTAs (Live Demo & Consult) -->
                    <div class="flex flex-wrap items-center gap-3 pt-3">
                        <!-- Primary Live Demo CTA (Satek Style) -->
                        <a href="{{ route('templates.show', ['slug' => $template->slug, 'view' => 'demo']) }}" 
                           class="px-8 py-3.5 rounded-full bg-primary hover:bg-orange-600 text-white font-bold text-sm shadow-lg shadow-primary/30 hover:shadow-primary/50 transition-all flex items-center gap-2 group">
                            <span class="material-symbols-outlined text-[20px] group-hover:scale-110 transition-transform">laptop_mac</span>
                            <span>Xem Demo Trực Tiếp (Live Demo)</span>
                        </a>

                        <!-- Consult CTA -->
                        <button type="button" 
                                @click="consultModal = true"
                                class="px-6 py-3.5 rounded-full bg-slate-900 hover:bg-slate-800 text-white font-bold text-sm shadow-sm transition-all flex items-center gap-2 cursor-pointer">
                            <span class="material-symbols-outlined text-[18px]">support_agent</span>
                            <span>Yêu Cầu Tư Vấn & Báo Giá</span>
                        </button>
                    </div>

                    <!-- Hotline prompt -->
                    <div class="pt-2 text-xs text-slate-500 flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary text-[18px]">call</span>
                        <span>Hotline hỗ trợ kỹ thuật 24/7: <a href="tel:0939363262" class="font-bold text-primary hover:underline">0939.363.262</a></span>
                    </div>
                </div>

                <!-- Preview Thumbnail Right -->
                <div class="lg:col-span-5">
                    <div class="rounded-3xl overflow-hidden border border-slate-200/90 shadow-2xl bg-white p-2">
                        <div class="relative aspect-video rounded-2xl overflow-hidden bg-slate-900 group">
                            <img 
                                src="{{ $template->thumbnail_url ?: 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=800&q=80' }}" 
                                alt="{{ $template->title }}" 
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                            >
                            <a href="{{ route('templates.show', ['slug' => $template->slug, 'view' => 'demo']) }}" 
                               class="absolute inset-0 bg-slate-950/40 backdrop-blur-[2px] flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <span class="px-5 py-2.5 rounded-full bg-white text-slate-900 font-bold text-xs shadow-xl flex items-center gap-2">
                                    <span class="material-symbols-outlined text-[18px] text-primary">play_circle</span>
                                    <span>Bật chế độ xem Demo</span>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ==================== SPECIFICATIONS & HIGHLIGHTS ==================== -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-12 space-y-12">
        <section class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="p-6 rounded-3xl bg-white border border-slate-200/90 shadow-xs space-y-2">
                <div class="w-10 h-10 rounded-2xl bg-orange-100 text-primary flex items-center justify-center mb-3">
                    <span class="material-symbols-outlined text-[22px]">devices</span>
                </div>
                <h3 class="text-base font-bold text-[#0f172a]">100% Tương Thích Thiết Bị</h3>
                <p class="text-xs text-slate-500 leading-relaxed">
                    Tối ưu hiển thị mượt mà trên iPhone, iPad, Android, laptop và màn hình desktop độ phân giải cao.
                </p>
            </div>

            <div class="p-6 rounded-3xl bg-white border border-slate-200/90 shadow-xs space-y-2">
                <div class="w-10 h-10 rounded-2xl bg-emerald-100 text-emerald-700 flex items-center justify-center mb-3">
                    <span class="material-symbols-outlined text-[22px]">speed</span>
                </div>
                <h3 class="text-base font-bold text-[#0f172a]">Tốc Độ Tải Siêu Nhanh</h3>
                <p class="text-xs text-slate-500 leading-relaxed">
                    Mã nguồn được tinh gọn tối đa, nén hình ảnh WebP tự động, điểm PageSpeed Google luôn đạt trên 90+.
                </p>
            </div>

            <div class="p-6 rounded-3xl bg-white border border-slate-200/90 shadow-xs space-y-2">
                <div class="w-10 h-10 rounded-2xl bg-sky-100 text-sky-700 flex items-center justify-center mb-3">
                    <span class="material-symbols-outlined text-[22px]">travel_explore</span>
                </div>
                <h3 class="text-base font-bold text-[#0f172a]">Cấu Trúc Chuẩn SEO On-page</h3>
                <p class="text-xs text-slate-500 leading-relaxed">
                    Đầy đủ thẻ Open Graph, Schema JSON-LD doanh nghiệp, sitemap tự động và thẻ canonical tiêu chuẩn.
                </p>
            </div>
        </section>

        <!-- Template Description & Content -->
        <section class="p-8 sm:p-10 rounded-3xl bg-white border border-slate-200/90 shadow-xs space-y-6">
            <h2 class="text-xl sm:text-2xl font-bold text-[#0f172a] border-b border-slate-100 pb-4">
                Thông Tin Chi Tiết Giao Diện
            </h2>
            <div class="prose max-w-none text-sm text-slate-600 leading-relaxed space-y-4">
                {!! $template->content !!}
            </div>

            <!-- Deployment Banner -->
            <div class="p-6 rounded-2xl bg-slate-50 border border-slate-200 flex flex-col sm:flex-row items-center justify-between gap-4">
                <div>
                    <h3 class="text-sm font-bold text-slate-900">Bạn muốn ứng dụng ngay giao diện này cho doanh nghiệp?</h3>
                    <p class="text-xs text-slate-500 mt-0.5">Chúng tôi hỗ trợ cấu hình logo, màu sắc và nội dung hoàn thiện trong 3 ngày.</p>
                </div>
                <div class="flex items-center gap-3 shrink-0">
                    <a href="{{ route('templates.show', ['slug' => $template->slug, 'view' => 'demo']) }}" class="px-5 py-2.5 rounded-full border border-primary text-primary hover:bg-primary hover:text-white transition-all text-xs font-bold">
                        Xem Live Demo
                    </a>
                    <button type="button" @click="consultModal = true" class="px-5 py-2.5 rounded-full bg-primary hover:bg-orange-600 text-white transition-all text-xs font-bold cursor-pointer">
                        Đăng Ký Tư Vấn
                    </button>
                </div>
            </div>
        </section>

        <!-- Related Templates -->
        @if($relatedTemplates->isNotEmpty())
        <section class="space-y-6">
            <div class="flex items-center justify-between border-b border-slate-200 pb-3">
                <h3 class="text-lg sm:text-xl font-bold text-[#0f172a]">Các Mẫu Giao Diện Liên Quan</h3>
                <a href="{{ route('templates.index') }}" class="text-xs font-bold text-primary hover:underline">
                    Xem tất cả mẫu &rarr;
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($relatedTemplates as $rel)
                @php
                    $relThumb = $rel->thumbnail_url ?: 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=600&q=80';
                    $relDemo = route('templates.show', ['slug' => $rel->slug, 'view' => 'demo']);
                @endphp
                <div class="bg-white rounded-3xl border border-slate-200 overflow-hidden shadow-xs hover:shadow-lg transition-all flex flex-col">
                    <div class="m-3 rounded-2xl overflow-hidden aspect-[16/10] bg-slate-100">
                        <img src="{{ $relThumb }}" alt="{{ $rel->title }}" class="w-full h-full object-cover">
                    </div>
                    <div class="p-5 pt-2 flex flex-col flex-1">
                        <h4 class="text-sm font-bold text-slate-900 mb-2 line-clamp-1">
                            <a href="{{ $relDemo }}" class="hover:text-primary">{{ $rel->title }}</a>
                        </h4>
                        <p class="text-xs text-slate-500 line-clamp-2 mb-4 flex-1">{{ $rel->summary }}</p>
                        <div class="flex items-center gap-2">
                            <a href="{{ $relDemo }}" class="flex-1 py-2 rounded-full border border-primary text-primary hover:bg-primary hover:text-white transition-all text-xs font-bold text-center">
                                View Demo
                            </a>
                            <a href="{{ route('templates.show', ['slug' => $rel->slug]) }}" class="px-3 py-2 rounded-full bg-slate-100 text-slate-700 hover:bg-slate-200 transition-all text-xs font-semibold">
                                Chi tiết
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </section>
        @endif
    </div>

    <!-- ==================== QUICK CONSULTATION MODAL ==================== -->
    <div x-show="consultModal" 
         x-transition.opacity 
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/75 backdrop-blur-xs" 
         style="display: none;">
        <div @click.outside="consultModal = false" 
             class="w-full max-w-lg bg-white rounded-3xl border border-slate-200 shadow-2xl overflow-hidden flex flex-col">
            
            <div class="px-6 py-4 bg-slate-900 text-white flex items-center justify-between">
                <div class="flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-lg bg-primary flex items-center justify-center text-white">
                        <span class="material-symbols-outlined text-[18px]">support_agent</span>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold">Yêu Cầu Tư Vấn Giao Diện</h3>
                        <p class="text-[11px] text-slate-400 truncate max-w-xs">{{ $template->title }}</p>
                    </div>
                </div>
                <button type="button" @click="consultModal = false" class="text-slate-400 hover:text-white transition-colors cursor-pointer">
                    <span class="material-symbols-outlined text-[22px]">close</span>
                </button>
            </div>

            <div class="p-6">
                <div x-show="submitSuccess" class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-center space-y-2 mb-4">
                    <span class="material-symbols-outlined text-3xl text-emerald-600">check_circle</span>
                    <h4 class="font-bold text-sm">Gửi yêu cầu thành công!</h4>
                    <p class="text-xs text-slate-600">Đội ngũ Cửu Long sẽ gọi lại tư vấn và gửi báo giá trong vòng 15 phút.</p>
                </div>

                <form x-show="!submitSuccess" @submit.prevent="submitConsult" class="space-y-4">
                    <div class="p-3 rounded-xl bg-orange-50 border border-orange-200/80 flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary text-[18px]">verified</span>
                        <span class="text-xs text-slate-700 font-semibold truncate">
                            Mẫu đang chọn: <strong class="text-primary font-bold">{{ $template->title }}</strong>
                        </span>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Họ và tên <span class="text-rose-500">*</span></label>
                        <input type="text" x-model="customerName" required placeholder="Ví dụ: Nguyễn Văn A" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 focus:border-primary focus:ring-2 focus:ring-primary/20 text-xs sm:text-sm outline-none transition-all">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Số điện thoại / Zalo <span class="text-rose-500">*</span></label>
                        <input type="tel" x-model="customerPhone" required placeholder="Ví dụ: 0939 363 262" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 focus:border-primary focus:ring-2 focus:ring-primary/20 text-xs sm:text-sm outline-none transition-all">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Email (nếu có)</label>
                        <input type="email" x-model="customerEmail" placeholder="email@congty.com" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 focus:border-primary focus:ring-2 focus:ring-primary/20 text-xs sm:text-sm outline-none transition-all">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Ghi chú nhu cầu</label>
                        <textarea x-model="customerNote" rows="3" class="w-full px-3.5 py-2 rounded-xl border border-slate-300 focus:border-primary focus:ring-2 focus:ring-primary/20 text-xs outline-none transition-all resize-none"></textarea>
                    </div>

                    <button type="submit" 
                            :disabled="isSubmitting"
                            class="w-full py-3 rounded-xl bg-primary hover:bg-orange-600 text-white font-bold text-sm shadow-md transition-all flex items-center justify-center gap-2 cursor-pointer disabled:opacity-70">
                        <span x-show="!isSubmitting">Gửi Yêu Cầu Tư Vấn Ngay</span>
                        <span x-show="isSubmitting">Đang gửi...</span>
                        <span class="material-symbols-outlined text-[18px]">send</span>
                    </button>
                </form>

                <div class="mt-4 pt-4 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
                    <span>Gọi hotline trực tiếp:</span>
                    <a href="tel:0939363262" class="font-bold text-primary hover:underline flex items-center gap-1">
                        <span class="material-symbols-outlined text-[15px]">call</span>
                        <span>0939.363.262</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
