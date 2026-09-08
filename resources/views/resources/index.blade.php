@extends('layouts.app')

@section('title', 'Trung Tâm Tài Nguyên Số & Tải Miễn Phí - Truyền Thông Cửu Long')
@section('meta_description', 'Tải miễn phí hơn 50+ tài nguyên giá trị: Preset màu DaVinci Resolve, Ebook chiến lược truyền thông, mẫu brief sản xuất TVC, tài liệu biểu mẫu quản trị.')

@section('content')
<div class="w-full bg-[#080C16] text-white selection:bg-amber-500 selection:text-slate-900" x-data="{
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

    <!-- SECTION 1: SMALL HERO -->
    <section class="relative pt-32 pb-12 lg:pt-36 lg:pb-16 bg-[#0B132B]/60 border-b border-slate-800/80 overflow-hidden">
        <div class="absolute inset-0 bg-dot-grid-subtle opacity-20 pointer-events-none"></div>
        <div class="absolute -top-24 right-1/4 w-96 h-96 bg-amber-500/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- Breadcrumb -->
            <nav class="flex items-center gap-2 text-xs font-mono text-slate-400 mb-6" aria-label="Breadcrumb">
                <a href="{{ route('home') }}" class="hover:text-amber-400 transition-colors flex items-center gap-1">
                    <span class="material-symbols-outlined text-[14px]">home</span>
                    <span>Trang chủ</span>
                </a>
                <span class="text-slate-600">/</span>
                <span class="text-amber-400 font-semibold">Tài nguyên số</span>
            </nav>

            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
                <div class="max-w-3xl">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-amber-400/10 border border-amber-400/30 text-amber-400 font-mono text-xs font-bold mb-4">
                        <span class="w-2 h-2 rounded-full bg-amber-400 animate-pulse"></span>
                        <span>FREE DIGITAL ASSETS &amp; KNOWLEDGE HUB</span>
                    </div>
                    <h1 class="font-headline text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight leading-tight text-white mb-4">
                        Trung Tâm Tài Nguyên Số <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-400 via-orange-400 to-amber-200">Miễn Phí Cho Doanh Nghiệp</span>
                    </h1>
                    <p class="font-body text-slate-300 text-sm sm:text-base leading-relaxed">
                        Tải về trọn bộ tài liệu nghiệp vụ, LUTs màu điện ảnh DaVinci Resolve, biểu mẫu brief kịch bản TVC và tài liệu quản trị số được đúc kết từ hơn 10 năm kinh nghiệm thực chiến của Truyền Thông Cửu Long.
                    </p>
                </div>

                <!-- Search Input -->
                <form action="{{ route('resources.index') }}" method="GET" class="w-full md:w-80 shrink-0">
                    <div class="relative flex items-center">
                        <input type="text" name="q" value="{{ request('q') }}" placeholder="Tìm tên tài liệu, ebook, LUTs..." 
                            class="w-full pl-10 pr-4 py-3 rounded-2xl bg-slate-900 border border-slate-700 text-white placeholder:text-slate-500 focus:outline-none focus:ring-2 focus:ring-amber-400 text-xs shadow-inner">
                        <span class="material-symbols-outlined absolute left-3 text-slate-400 text-[18px]">search</span>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- SECTION 2: 4 CATEGORIES SHOWCASE STRIP -->
    <section class="py-12 lg:py-16 bg-[#080C16] border-b border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-2xl mx-auto text-center mb-10 lg:mb-12">
                <span class="font-mono text-xs font-bold text-amber-400 uppercase">PHÂN LOẠI TÀI NGUYÊN</span>
                <h2 class="font-headline text-2xl sm:text-3xl font-extrabold text-white mt-1">4 Nhóm Công Cụ Giá Trị Cao Sẵn Sàng Tải Về</h2>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Group 1 -->
                <div class="p-6 rounded-3xl bg-[#0F172A] border border-slate-800 hover:border-amber-400/40 transition-all flex flex-col gap-3 group">
                    <div class="w-12 h-12 rounded-2xl bg-amber-400/10 text-amber-400 flex items-center justify-center border border-amber-400/20 group-hover:scale-105 transition-transform">
                        <span class="material-symbols-outlined text-[24px]">palette</span>
                    </div>
                    <h3 class="font-headline text-base font-bold text-white group-hover:text-amber-400 transition-colors">Color Presets &amp; LUTs</h3>
                    <p class="text-xs text-slate-400 leading-relaxed">Preset chỉnh màu DaVinci Resolve &amp; Premiere Pro chuẩn Rec.709 cho thước phim điện ảnh.</p>
                    <span class="text-[11px] font-mono text-slate-500 mt-auto">Định dạng: .CUBE / .XMP</span>
                </div>

                <!-- Group 2 -->
                <div class="p-6 rounded-3xl bg-[#0F172A] border border-slate-800 hover:border-amber-400/40 transition-all flex flex-col gap-3 group">
                    <div class="w-12 h-12 rounded-2xl bg-amber-400/10 text-amber-400 flex items-center justify-center border border-amber-400/20 group-hover:scale-105 transition-transform">
                        <span class="material-symbols-outlined text-[24px]">menu_book</span>
                    </div>
                    <h3 class="font-headline text-base font-bold text-white group-hover:text-amber-400 transition-colors">Ebook &amp; Cẩm Nang</h3>
                    <p class="text-xs text-slate-400 leading-relaxed">Cẩm nang sản xuất video ngắn TikTok triệu view và tài liệu xây dựng chiến lược truyền thông đa kênh.</p>
                    <span class="text-[11px] font-mono text-slate-500 mt-auto">Định dạng: PDF E-book</span>
                </div>

                <!-- Group 3 -->
                <div class="p-6 rounded-3xl bg-[#0F172A] border border-slate-800 hover:border-amber-400/40 transition-all flex flex-col gap-3 group">
                    <div class="w-12 h-12 rounded-2xl bg-amber-400/10 text-amber-400 flex items-center justify-center border border-amber-400/20 group-hover:scale-105 transition-transform">
                        <span class="material-symbols-outlined text-[24px]">description</span>
                    </div>
                    <h3 class="font-headline text-base font-bold text-white group-hover:text-amber-400 transition-colors">Mẫu Brief &amp; Storyboard</h3>
                    <p class="text-xs text-slate-400 leading-relaxed">Mẫu kịch bản phân cảnh video chuẩn đạo diễn và form brief yêu cầu sản xuất TVC cho doanh nghiệp.</p>
                    <span class="text-[11px] font-mono text-slate-500 mt-auto">Định dạng: DOCX / Excel</span>
                </div>

                <!-- Group 4 -->
                <div class="p-6 rounded-3xl bg-[#0F172A] border border-slate-800 hover:border-amber-400/40 transition-all flex flex-col gap-3 group">
                    <div class="w-12 h-12 rounded-2xl bg-amber-400/10 text-amber-400 flex items-center justify-center border border-amber-400/20 group-hover:scale-105 transition-transform">
                        <span class="material-symbols-outlined text-[24px]">verified_user</span>
                    </div>
                    <h3 class="font-headline text-base font-bold text-white group-hover:text-amber-400 transition-colors">Hợp Đồng Mẫu &amp; NDA</h3>
                    <p class="text-xs text-slate-400 leading-relaxed">Mẫu hợp đồng dịch vụ công nghệ, hợp đồng bản quyền hình ảnh và biên bản thỏa thuận bảo mật NDA.</p>
                    <span class="text-[11px] font-mono text-slate-500 mt-auto">Định dạng: PDF / Word</span>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 3: RESOURCES GRID -->
    <section class="py-12 lg:py-16 bg-[#0B132B]/40 border-b border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between gap-4 mb-8">
                <div>
                    <span class="font-mono text-xs font-bold text-amber-400 uppercase">DANH SÁCH TÀI LIỆU</span>
                    <h2 class="font-headline text-2xl font-bold text-white">Tài Nguyên Có Thể Tải Về Trực Tuyến</h2>
                </div>
                <span class="text-xs font-mono text-slate-400 hidden sm:inline">Tổng cộng: {{ $resources->total() }} tài liệu</span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                @forelse($resources as $item)
                <div class="group rounded-3xl overflow-hidden bg-[#0F172A] border border-slate-800 hover:border-amber-400/50 shadow-xl hover:shadow-2xl hover:shadow-amber-500/10 transition-all duration-300 flex flex-col justify-between p-6">
                    
                    <div class="flex flex-col gap-4">
                        <!-- Icon and Type Badge -->
                        <div class="flex items-center justify-between">
                            <div class="w-12 h-12 rounded-2xl bg-amber-400/10 border border-amber-400/20 text-amber-400 flex items-center justify-center shadow-md">
                                <span class="material-symbols-outlined text-[24px]">folder_zip</span>
                            </div>
                            <span class="font-mono text-[10px] font-bold text-amber-400 bg-amber-400/10 border border-amber-400/20 px-3 py-1 rounded-full uppercase">
                                FREE DOWNLOAD
                            </span>
                        </div>

                        <!-- Title & Summary -->
                        <div class="flex flex-col gap-2">
                            <h3 class="font-headline text-base font-bold text-white group-hover:text-amber-400 transition-colors line-clamp-2 leading-snug">
                                {{ $item->title }}
                            </h3>
                            <p class="font-body text-xs text-slate-400 line-clamp-2 leading-relaxed">
                                {{ $item->summary ?: 'Tài liệu hướng dẫn và bộ công cụ chuyên biệt giúp tối ưu hiệu suất công việc và nâng cao năng lực sản xuất số.' }}
                            </p>
                        </div>

                        <!-- Meta Info -->
                        <div class="flex items-center gap-3 pt-3 text-[11px] font-mono text-slate-400 border-t border-slate-800/80">
                            <span class="flex items-center gap-1">
                                <span class="material-symbols-outlined text-[14px] text-amber-400">download</span>
                                {{ $item->views + 120 }} lượt tải
                            </span>
                            <span>•</span>
                            <span>Định dạng: Full Package</span>
                        </div>
                    </div>

                    <!-- CTA Action Button (Triggers Lead Gate Modal) -->
                    <div class="pt-5 mt-4 border-t border-slate-800/80">
                        <button type="button" @click="openDownload('{{ $item->slug }}', '{{ addslashes($item->title) }}')" 
                            class="w-full py-3.5 rounded-2xl bg-amber-400 hover:bg-amber-300 text-slate-950 font-headline text-xs font-bold flex items-center justify-center gap-2 shadow-md shadow-amber-400/10 transition-all">
                            <span class="material-symbols-outlined text-[18px]">download</span>
                            <span>Tải Về Miễn Phí</span>
                        </button>
                    </div>

                </div>
                @empty
                <div class="col-span-3 text-center py-20 bg-[#0F172A] rounded-3xl border border-slate-800">
                    <span class="material-symbols-outlined text-6xl text-slate-500 mb-3">cloud_off</span>
                    <h3 class="font-headline text-lg font-bold text-white">Không tìm thấy tài nguyên phù hợp</h3>
                    <p class="font-body text-xs text-slate-400 mt-1">Vui lòng thử tìm kiếm với từ khóa khác.</p>
                    <a href="{{ route('resources.index') }}" class="mt-4 inline-flex items-center gap-2 px-6 py-2.5 rounded-full bg-amber-400 text-slate-950 font-headline text-xs font-bold hover:bg-amber-300 transition-all">
                        Xem tất cả tài nguyên
                    </a>
                </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-8 flex justify-center">
                {{ $resources->links() }}
            </div>
        </div>
    </section>

    <!-- SECTION 4: CTA SERVICES CONVERSION -->
    <section class="py-12 lg:py-16 bg-[#080C16] border-b border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="p-8 sm:p-12 rounded-3xl bg-gradient-to-r from-[#0F172A] via-[#131D38] to-[#0F172A] border border-amber-400/30 flex flex-col md:flex-row items-center justify-between gap-8">
                <div class="max-w-2xl">
                    <span class="font-mono text-xs font-bold text-amber-400 uppercase">TRIỂN KHAI THỰC CHIẾN</span>
                    <h2 class="font-headline text-2xl sm:text-3xl font-extrabold text-white mt-1 mb-3">
                        Bạn Thích Những Tài Liệu Này? Hãy Để CLM Đồng Hành Trực Tiếp
                    </h2>
                    <p class="text-xs sm:text-sm text-slate-300 leading-relaxed">
                        Từ việc lên kịch bản TVC, quay dựng 4K, lập trình website đến chạy quảng cáo chuyển đổi — đội ngũ chuyên gia của chúng tôi sẵn sàng hiện thực hóa mục tiêu tăng trưởng của bạn.
                    </p>
                </div>
                <div class="flex flex-wrap items-center gap-3 shrink-0">
                    <a href="{{ route('contact') }}" 
                        class="px-6 py-3.5 rounded-2xl bg-amber-400 hover:bg-amber-300 text-slate-950 font-headline text-xs font-extrabold shadow-lg shadow-amber-400/20 transition-all">
                        Đăng Ký Tư Vấn Dự Án
                    </a>
                    <a href="{{ route('pricing') }}" 
                        class="px-6 py-3.5 rounded-2xl bg-slate-900 hover:bg-slate-800 text-white font-headline text-xs font-bold border border-slate-700 transition-all">
                        Xem Bảng Giá
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- LEAD-GATE DOWNLOAD MODAL (ALPINE.JS) -->
    <div x-show="modalOpen" x-transition.opacity class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-md" style="display: none;">
        <div @click.outside="modalOpen = false" class="w-full max-w-md bg-[#0F172A] rounded-3xl shadow-2xl border border-slate-700 overflow-hidden relative p-7 flex flex-col gap-5 text-white">
            
            <!-- Close Button -->
            <button @click="modalOpen = false" class="absolute top-4 right-4 w-8 h-8 rounded-full bg-slate-800 hover:bg-slate-700 flex items-center justify-center text-slate-400 hover:text-white transition-colors">
                <span class="material-symbols-outlined text-[18px]">close</span>
            </button>

            <!-- Modal Header -->
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 rounded-2xl bg-amber-400/10 border border-amber-400/20 text-amber-400 flex items-center justify-center shrink-0">
                    <span class="material-symbols-outlined text-[26px]">downloading</span>
                </div>
                <div class="flex flex-col">
                    <span class="font-mono text-[10px] font-bold text-amber-400 uppercase tracking-wider">XÁC THỰC TẢI XUỐNG</span>
                    <h3 class="font-headline text-base font-bold text-white leading-tight" x-text="selectedTitle"></h3>
                </div>
            </div>

            <!-- Notice -->
            <p class="font-body text-xs text-slate-400 leading-relaxed">
                Vui lòng cung cấp số điện thoại để Truyền Thông Cửu Long gửi mã xác thực và đường dẫn tải file tốc độ cao trực tiếp.
            </p>

            <!-- Success Alert -->
            <div x-show="successMsg" class="p-3.5 rounded-xl bg-amber-400/20 border border-amber-400/40 text-amber-300 text-xs font-semibold" x-text="successMsg"></div>

            <!-- Form -->
            <form @submit.prevent="submitLead()" class="flex flex-col gap-3">
                <div>
                    <label class="block font-headline text-xs font-bold text-slate-300 mb-1">Họ và tên của bạn <span class="text-amber-400">*</span></label>
                    <input type="text" x-model="name" placeholder="Nguyễn Văn A" required class="w-full px-3.5 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-xs text-white placeholder:text-slate-500 focus:ring-2 focus:ring-amber-400 focus:outline-none">
                </div>
                <div>
                    <label class="block font-headline text-xs font-bold text-slate-300 mb-1">Số điện thoại / Zalo <span class="text-amber-400">*</span></label>
                    <input type="tel" x-model="phone" placeholder="0908 xxx xxx" required class="w-full px-3.5 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-xs text-white placeholder:text-slate-500 focus:ring-2 focus:ring-amber-400 focus:outline-none">
                </div>
                <div>
                    <label class="block font-headline text-xs font-bold text-slate-300 mb-1">Email nhận file (tùy chọn)</label>
                    <input type="email" x-model="email" placeholder="example@gmail.com" class="w-full px-3.5 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-xs text-white placeholder:text-slate-500 focus:ring-2 focus:ring-amber-400 focus:outline-none">
                </div>

                <button type="submit" :disabled="submitting" 
                    class="mt-2 w-full py-3.5 rounded-xl bg-amber-400 hover:bg-amber-300 text-slate-950 font-headline text-xs font-extrabold shadow-md shadow-amber-400/20 flex items-center justify-center gap-2 transition-all">
                    <span x-show="submitting" class="w-4 h-4 border-2 border-slate-950 border-t-transparent rounded-full animate-spin"></span>
                    <span x-text="submitting ? 'Đang xác thực...' : 'Nhận Link Tải Ngay (Miễn Phí)'"></span>
                </button>
            </form>

            <div class="flex items-center justify-center gap-1 text-[11px] font-mono text-slate-500">
                <span class="material-symbols-outlined text-[13px] text-amber-400">lock</span>
                <span>Thông tin được bảo mật 100% theo quy định CLM</span>
            </div>

        </div>
    </div>

</div>

<!-- SCHEMA JSON-LD -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "CollectionPage",
    "name": "Trung Tâm Tài Nguyên Số & Tải Miễn Phí - Truyền Thông Cửu Long",
    "description": "Tải miễn phí LUTs màu DaVinci Resolve, ebook chiến lược truyền thông, mẫu brief sản xuất TVC và tài liệu quản trị số.",
    "url": "{{ route('resources.index') }}",
    "provider": {
        "@type": "Organization",
        "name": "Truyền Thông Cửu Long",
        "url": "{{ url('/') }}"
    }
}
</script>
@endsection
