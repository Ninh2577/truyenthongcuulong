@extends('layouts.app')

@section('title', 'Trung Tâm Tài Nguyên & Download Center - Cửu Long Media & Tech')
@section('meta_description', 'Tải miễn phí hơn 50+ tài nguyên giá trị: Preset màu DaVinci Resolve, Ebook chiến lược truyền thông, mẫu brief sản xuất TVC, tài liệu biểu mẫu quản trị.')

@section('content')
<div class="w-full bg-surface bg-dot-grid-subtle pt-28 pb-20 border-b border-slate-200/60" x-data="{
    modalOpen: false,
    selectedSlug: '',
    selectedTitle: '',
    name: '',
    phone: '',
    email: '',
    submitting: false,
    successMsg: '',
    openDownload(slug, title) {
        this.selectedSlug = slug;
        this.selectedTitle = title;
        this.successMsg = '';
        this.modalOpen = true;
    },
    submitLead() {
        if (!this.name || !this.phone) {
            alert('Vui lòng điền họ tên và số điện thoại để nhận tài liệu!');
            return;
        }
        this.submitting = true;
        fetch('{{ route('resources.download') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                name: this.name,
                phone: this.phone,
                email: this.email,
                slug: this.selectedSlug
            })
        })
        .then(res => res.json())
        .then(data => {
            this.submitting = false;
            if (data.success) {
                this.successMsg = data.message;
                setTimeout(() => {
                    window.location.href = data.download_url;
                }, 1500);
            } else {
                alert('Có lỗi xảy ra, vui lòng thử lại!');
            }
        })
        .catch(() => {
            this.submitting = false;
            alert('Lỗi kết nối máy chủ!');
        });
    }
}">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-10 pb-8 border-b border-slate-200">
            <div class="max-w-2xl flex flex-col gap-3">
                <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-emerald-100 border border-emerald-300 text-emerald-800 font-mono text-xs font-bold w-fit">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span>RESOURCE &amp; DOWNLOAD CENTER</span>
                </div>
                <h1 class="font-headline text-3xl sm:text-4xl lg:text-5xl font-extrabold text-navy-base tracking-tight">
                    Thư Viện Tài Nguyên <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 via-teal-600 to-cyan-600">Độc Quyền</span>
                </h1>
                <p class="font-body text-slate-600 text-sm sm:text-base leading-relaxed">
                    Tải về trọn bộ tài liệu nghiệp vụ, preset màu điện ảnh, biểu mẫu hợp đồng và công cụ hỗ trợ truyền thông được đúc kết từ 10+ năm kinh nghiệm thực chiến.
                </p>
            </div>

            <!-- Search Resource -->
            <form action="{{ route('resources.index') }}" method="GET" class="w-full md:w-72">
                <div class="relative flex items-center">
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Tìm kiếm tài nguyên..." 
                        class="w-full pl-10 pr-4 py-3 rounded-2xl bg-white border border-slate-300 text-navy-base placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 text-xs shadow-xs">
                    <span class="material-symbols-outlined absolute left-3 text-slate-400 text-[18px]">search</span>
                </div>
            </form>
        </div>

        <!-- Trust Mini Banner -->
        <div class="p-6 rounded-3xl bg-navy-base text-white border border-slate-700/80 shadow-md mb-10 flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-emerald-500/20 text-emerald-400 flex items-center justify-center border border-emerald-400/30 shrink-0">
                    <span class="material-symbols-outlined text-[26px]">verified</span>
                </div>
                <div class="flex flex-col">
                    <span class="font-headline text-sm font-bold text-white">Toàn Bộ Tài Liệu Đã Được Kiểm Duyệt An Toàn</span>
                    <span class="text-xs text-slate-400">Không virus • Không quảng cáo rác • Bản quyền Cửu Long Media &amp; Tech</span>
                </div>
            </div>
            <span class="font-mono text-xs font-bold text-emerald-400 bg-emerald-950/80 px-4 py-1.5 rounded-full border border-emerald-400/30">
                52+ File Download Sẵn Sàng
            </span>
        </div>

        <!-- Resources Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
            @forelse($resources as $item)
            <div class="group rounded-3xl overflow-hidden bg-white border border-slate-200/90 shadow-[0_8px_24px_rgba(7,15,30,0.04)] hover:shadow-xl hover:border-emerald-400 transition-all duration-300 flex flex-col justify-between p-6">
                
                <div class="flex flex-col gap-4">
                    <!-- Icon and Type Badge -->
                    <div class="flex items-center justify-between">
                        <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-emerald-500 to-teal-700 flex items-center justify-center text-white shadow-md shadow-emerald-500/20">
                            <span class="material-symbols-outlined text-[24px]">folder_zip</span>
                        </div>
                        <span class="font-mono text-[10px] font-bold text-emerald-700 bg-emerald-50 border border-emerald-200 px-3 py-1 rounded-full uppercase">
                            FREE DOWNLOAD
                        </span>
                    </div>

                    <!-- Title & Summary -->
                    <div class="flex flex-col gap-2">
                        <h3 class="font-headline text-base font-bold text-navy-base group-hover:text-emerald-700 transition-colors line-clamp-2 leading-snug">
                            {{ $item->title }}
                        </h3>
                        <p class="font-body text-xs text-slate-500 line-clamp-2 leading-relaxed">
                            {{ $item->summary ?: 'Tài liệu hướng dẫn và bộ công cụ chuyên biệt giúp tối ưu hiệu suất công việc và nâng cao năng lực sản xuất số.' }}
                        </p>
                    </div>

                    <!-- Meta Tags -->
                    <div class="flex items-center gap-2 pt-2 text-[11px] font-mono text-slate-400 border-t border-slate-100">
                        <span class="flex items-center gap-1">
                            <span class="material-symbols-outlined text-[14px]">file_download</span>
                            {{ $item->views + 120 }} lượt tải
                        </span>
                        <span>•</span>
                        <span>Định dạng: Full Package</span>
                    </div>
                </div>

                <!-- CTA Action Button (Triggers Lead Gate Modal) -->
                <div class="pt-5 mt-4 border-t border-slate-100">
                    <button type="button" @click="openDownload('{{ $item->slug }}', '{{ addslashes($item->title) }}')" 
                        class="w-full py-3 rounded-2xl bg-slate-100 hover:bg-gradient-to-r hover:from-emerald-600 hover:to-teal-700 text-slate-800 hover:text-white font-headline text-xs font-bold flex items-center justify-center gap-2 shadow-2xs hover:shadow-md transition-all group/btn">
                        <span class="material-symbols-outlined text-[18px] text-emerald-600 group-hover/btn:text-white transition-colors">download</span>
                        <span>Tải Về Miễn Phí</span>
                    </button>
                </div>

            </div>
            @empty
            <div class="col-span-3 text-center py-20 bg-white rounded-3xl border border-slate-200">
                <span class="material-symbols-outlined text-6xl text-slate-300 mb-3">cloud_off</span>
                <h3 class="font-headline text-lg font-bold text-navy-base">Không tìm thấy tài nguyên phù hợp</h3>
                <p class="font-body text-xs text-slate-500 mt-1">Vui lòng thử tìm kiếm với từ khóa khác.</p>
                <a href="{{ route('resources.index') }}" class="mt-4 inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-emerald-600 text-white font-headline text-xs font-bold">Xem tất cả tài nguyên</a>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $resources->links() }}
        </div>

    </div>

    <!-- Lead-Gate Download Modal (Tailwind + Alpine.js) -->
    <div x-show="modalOpen" x-transition.opacity class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/70 backdrop-blur-xs" style="display: none;">
        <div @click.outside="modalOpen = false" class="w-full max-w-md bg-white rounded-3xl shadow-2xl border border-slate-200 overflow-hidden relative p-7 flex flex-col gap-5">
            
            <!-- Close Button -->
            <button @click="modalOpen = false" class="absolute top-4 right-4 w-8 h-8 rounded-full bg-slate-100 hover:bg-slate-200 flex items-center justify-center text-slate-500 transition-colors">
                <span class="material-symbols-outlined text-[18px]">close</span>
            </button>

            <!-- Modal Header -->
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 rounded-2xl bg-emerald-100 text-emerald-600 flex items-center justify-center shrink-0">
                    <span class="material-symbols-outlined text-[26px]">downloading</span>
                </div>
                <div class="flex flex-col">
                    <span class="font-mono text-[10px] font-bold text-emerald-600 uppercase tracking-wider">XÁC THỰC TẢI XUỐNG</span>
                    <h3 class="font-headline text-base font-bold text-navy-base leading-tight" x-text="selectedTitle"></h3>
                </div>
            </div>

            <!-- Notice -->
            <p class="font-body text-xs text-slate-500 leading-relaxed">
                Vui lòng cung cấp số điện thoại để Cửu Long gửi mã xác nhận và liên kết tải file tốc độ cao trực tiếp.
            </p>

            <!-- Success Alert -->
            <div x-show="successMsg" class="p-3.5 rounded-xl bg-emerald-50 border border-emerald-300 text-emerald-800 text-xs font-semibold" x-text="successMsg"></div>

            <!-- Form -->
            <form @submit.prevent="submitLead()" class="flex flex-col gap-3">
                <div>
                    <label class="block font-headline text-xs font-bold text-slate-700 mb-1">Họ và tên của bạn <span class="text-rose-500">*</span></label>
                    <input type="text" x-model="name" placeholder="Nguyễn Văn A" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs text-navy-base focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                </div>
                <div>
                    <label class="block font-headline text-xs font-bold text-slate-700 mb-1">Số điện thoại liên hệ <span class="text-rose-500">*</span></label>
                    <input type="tel" x-model="phone" placeholder="0908 xxx xxx" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs text-navy-base focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                </div>
                <div>
                    <label class="block font-headline text-xs font-bold text-slate-700 mb-1">Email nhận file (tùy chọn)</label>
                    <input type="email" x-model="email" placeholder="example@gmail.com" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs text-navy-base focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                </div>

                <button type="submit" :disabled="submitting" 
                    class="mt-2 w-full py-3 rounded-xl bg-gradient-to-r from-emerald-600 to-teal-700 text-white font-headline text-xs font-bold shadow-md hover:brightness-110 flex items-center justify-center gap-2 transition-all">
                    <span x-show="submitting" class="w-4 h-4 border-2 border-white border-t-transparent rounded-full animate-spin"></span>
                    <span x-text="submitting ? 'Đang xác thực...' : 'Nhận Link Tải Ngay (Miễn Phí)'"></span>
                </button>
            </form>

            <div class="flex items-center justify-center gap-1 text-[11px] font-mono text-slate-400">
                <span class="material-symbols-outlined text-[13px] text-emerald-600">lock</span>
                <span>Thông tin được bảo mật 100% theo chuẩn CLM</span>
            </div>

        </div>
    </div>

</div>
@endsection
