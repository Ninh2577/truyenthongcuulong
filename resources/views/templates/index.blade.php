@extends('layouts.app')

@section('title', 'Thư Viện Nền Tảng Triển Khai Website Nhanh - Truyền Thông Cửu Long')
@section('meta_description', 'Thư viện nền tảng giao diện website chuẩn SEO theo ngành nghề, giúp doanh nghiệp rút ngắn thời gian chuẩn bị và triển khai nhanh chóng.')

@section('content')
<div class="w-full bg-[#f8f9ff] min-h-screen pt-28 pb-20" style="font-family: var(--font-primary);" x-data="{
    previewModal: false,
    previewTitle: '',
    previewSlug: '',
    previewImg: '',
    previewDevice: 'desktop',

    openPreview(title, slug, img) {
        this.previewTitle = title;
        this.previewSlug = slug;
        this.previewImg = img;
        this.previewDevice = 'desktop';
        this.previewModal = true;
    }
}">

    <x-ui.container class="flex flex-col gap-14 lg:gap-18">
        <!-- Breadcrumb Navigation -->
        <div class="pt-2">
            <x-ui.breadcrumb :items="[
                ['label' => 'Dịch vụ & Giải pháp', 'url' => '/dich-vu'],
                ['label' => 'Thư viện nền tảng website']
            ]" />
        </div>

        <!-- ==================== HERO ==================== -->
        <section class="max-w-4xl mx-auto text-center flex flex-col items-center gap-5">
            <span class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-slate-100 text-slate-700 text-xs font-semibold">
                RAPID DEPLOYMENT PLATFORM &bull; TIẾT KIỆM THỜI GIAN
            </span>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-[#070f1e] tracking-tight leading-tight">
                Thư Viện Nền Tảng
                <span class="block text-slate-600 font-bold mt-1 text-2xl sm:text-3xl lg:text-4xl">
                    Triển Khai Website Nhanh
                </span>
            </h1>
            <p class="text-slate-600 text-sm sm:text-base leading-relaxed max-w-2xl">
                Tập hợp các cấu trúc website được dựng sẵn theo từng ngành nghề kinh doanh thực tế, giúp doanh nghiệp rút ngắn thời gian khởi tạo, tối ưu chi phí ban đầu mà vẫn bảo đảm tiêu chuẩn kỹ thuật chuẩn SEO.
            </p>

            <!-- Search Form -->
            <form action="{{ route('templates.index') }}" method="GET" class="w-full max-w-md pt-2">
                @if(request('industry'))
                    <input type="hidden" name="industry" value="{{ request('industry') }}">
                @endif
                <div class="relative flex items-center">
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Tìm theo tên ngành hoặc use-case..." 
                        class="w-full pl-10 pr-4 py-3 rounded-xl bg-white border border-slate-200 text-slate-900 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary text-xs shadow-xs transition-all">
                    <span class="material-symbols-outlined absolute left-3 text-slate-400 text-[18px]">search</span>
                </div>
            </form>
        </section>

        <!-- ==================== KHI NÀO NÊN DÙNG WEBSITE MẪU? ==================== -->
        <section class="flex flex-col gap-6">
            <div class="border-b border-slate-200 pb-3 flex flex-col sm:flex-row sm:items-end justify-between gap-2">
                <div>
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Phù hợp nhu cầu</span>
                    <h2 class="text-xl sm:text-2xl font-bold text-[#070f1e] tracking-tight mt-1">
                        Website Mẫu Dùng Cho Trường Hợp Nào?
                    </h2>
                </div>
                <span class="text-xs text-slate-500">3 kịch bản ứng dụng tối ưu nhất</span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-sm space-y-2">
                    <span class="text-xs font-bold text-primary">01</span>
                    <h3 class="text-base font-bold text-[#070f1e]">Khởi nghiệp cần ra mắt gấp</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Doanh nghiệp mới thành lập cần có website chỉn chu trong vòng 3–5 ngày để gửi hồ sơ đối tác, in namecard và chạy chiến dịch tiếp thị đầu tiên.
                    </p>
                </div>

                <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-sm space-y-2">
                    <span class="text-xs font-bold text-primary">02</span>
                    <h3 class="text-base font-bold text-[#070f1e]">Tối ưu ngân sách ban đầu</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Chưa cần đầu tư may đo phức tạp, muốn dành nguồn vốn cho hoạt động kinh doanh cốt lõi nhưng vẫn muốn sở hữu website ổn định và chuẩn SEO.
                    </p>
                </div>

                <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-sm space-y-2">
                    <span class="text-xs font-bold text-primary">03</span>
                    <h3 class="text-base font-bold text-[#070f1e]">Đã có mô hình chuẩn ngành</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Các ngành nghề như nhà hàng, nội thất, thời trang, phòng khám nha khoa có luồng bố cục tiêu chuẩn rõ ràng, chỉ cần thay thế dữ liệu và màu sắc nhận diện.
                    </p>
                </div>
            </div>
        </section>

        <!-- ==================== INDUSTRY FILTER PILLS ==================== -->
        <section class="flex flex-col gap-3">
            <div class="flex items-center justify-between gap-4">
                <span class="text-xs font-bold text-slate-600 uppercase tracking-wider">
                    LỌC THEO NGÀNH NGHỀ ({{ $industries->count() }} NHÓM NGÀNH):
                </span>
                @if($selectedIndustry || request('q'))
                <a href="{{ route('templates.index') }}" class="text-xs font-semibold text-primary hover:underline flex items-center gap-1">
                    <span class="material-symbols-outlined text-[14px]">refresh</span>
                    <span>Xóa bộ lọc</span>
                </a>
                @endif
            </div>

            <div class="flex items-center gap-2 overflow-x-auto pb-2 no-scrollbar">
                <a href="{{ route('templates.index') }}" 
                    class="px-3.5 py-1.5 rounded-full text-xs font-semibold whitespace-nowrap transition-all {{ empty($selectedIndustry) ? 'bg-[#070f1e] text-white shadow-xs' : 'bg-white text-slate-600 hover:text-[#070f1e] border border-slate-200' }}">
                    Tất cả ngành nghề ({{ $templates->total() }})
                </a>
                @foreach($industries as $ind)
                <a href="{{ route('templates.index', ['industry' => $ind->slug]) }}" 
                    class="px-3.5 py-1.5 rounded-full text-xs font-semibold whitespace-nowrap transition-all {{ $selectedIndustry === $ind->slug ? 'bg-[#070f1e] text-white shadow-xs' : 'bg-white text-slate-600 hover:text-[#070f1e] border border-slate-200' }}">
                    {{ $ind->name }}
                </a>
                @endforeach
            </div>
        </section>

        <!-- ==================== TEMPLATE GALLERY ==================== -->
        <section class="flex flex-col gap-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($templates as $item)
                @php
                    $thumb = $item->featured_image ? asset('storage/' . $item->featured_image) : 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=800&q=80';
                @endphp
                <div class="p-4 rounded-2xl bg-white border border-slate-200/90 shadow-sm flex flex-col justify-between group hover:border-slate-300 hover:shadow-md transition-all">
                    <div>
                        <!-- Thumbnail Container with subtle overlay -->
                        <div class="relative aspect-[16/10] rounded-xl overflow-hidden bg-slate-100 border border-slate-100">
                            <img src="{{ $thumb }}" alt="{{ $item->title }}" class="w-full h-full object-cover object-top group-hover:scale-102 transition-transform duration-300" loading="lazy">
                            <div class="absolute inset-0 bg-slate-900/10 group-hover:bg-slate-900/30 transition-colors flex items-center justify-center opacity-0 group-hover:opacity-100">
                                <button type="button" @click="openPreview('{{ addslashes($item->title) }}', '{{ $item->slug }}', '{{ $thumb }}')" class="px-3.5 py-2 rounded-lg bg-white text-slate-900 text-xs font-semibold shadow-md flex items-center gap-1.5 cursor-pointer">
                                    <span class="material-symbols-outlined text-[16px]">visibility</span>
                                    <span>Xem bản mẫu</span>
                                </button>
                            </div>
                        </div>

                        <!-- Content info -->
                        <div class="pt-3.5 space-y-1.5">
                            <div class="flex items-center justify-between text-[11px]">
                                <span class="font-semibold text-primary uppercase">{{ $item->category ? $item->category->name : 'Nền tảng' }}</span>
                                <span class="text-slate-400">Chuẩn SEO On-page</span>
                            </div>
                            <h3 class="text-sm font-bold text-[#070f1e] leading-snug line-clamp-1">
                                {{ $item->title }}
                            </h3>
                            <p class="text-xs text-slate-500 line-clamp-2 leading-relaxed">
                                {{ $item->summary ?: 'Bố cục hiện đại, tích hợp biểu mẫu liên hệ, tương thích trên mọi màn hình di động.' }}
                            </p>
                        </div>
                    </div>

                    <!-- Card Actions -->
                    <div class="pt-3 mt-3 border-t border-slate-100 flex items-center justify-between">
                        <button type="button" @click="openPreview('{{ addslashes($item->title) }}', '{{ $item->slug }}', '{{ $thumb }}')" class="text-xs font-semibold text-slate-600 hover:text-primary inline-flex items-center gap-1 cursor-pointer">
                            <span>Xem trước</span>
                            <span class="material-symbols-outlined text-[14px]">open_in_new</span>
                        </button>
                        <a href="{{ route('contact') }}?service={{ urlencode('Nền tảng: ' . $item->title) }}" class="text-xs font-bold text-primary hover:underline inline-flex items-center gap-1">
                            <span>Áp dụng mẫu này</span>
                            <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
                        </a>
                    </div>
                </div>
                @empty
                <div class="col-span-3 text-center py-16 bg-white rounded-2xl border border-slate-200">
                    <span class="material-symbols-outlined text-4xl text-slate-400 mb-2">dashboard</span>
                    <h3 class="text-base font-bold text-[#070f1e]">Không tìm thấy mẫu phù hợp</h3>
                    <p class="text-xs text-slate-500 mt-1">Vui lòng chọn danh mục khác hoặc gửi yêu cầu tùy biến riêng.</p>
                    <a href="{{ route('templates.index') }}" class="mt-4 inline-flex items-center gap-1 text-xs font-bold text-primary hover:underline">
                        <span>Xem tất cả mẫu</span>
                    </a>
                </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-6 flex justify-center">
                {{ $templates->links() }}
            </div>
        </section>

        <!-- ==================== QUY TRÌNH TÙY BIẾN ==================== -->
        <section class="p-8 rounded-2xl bg-white border border-slate-200/90 shadow-sm flex flex-col gap-6">
            <div class="border-b border-slate-100 pb-3">
                <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Cách thức làm việc</span>
                <h2 class="text-xl sm:text-2xl font-bold text-[#070f1e] tracking-tight mt-1">
                    Quy Trình Tùy Biến 4 Bước
                </h2>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="space-y-1.5">
                    <span class="text-base font-bold text-primary">01</span>
                    <h3 class="text-sm font-bold text-[#070f1e]">Chọn mẫu nền tảng</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Doanh nghiệp chọn cấu trúc giao diện phù hợp với ngành nghề và mô tả các chức năng muốn giữ lại.
                    </p>
                </div>
                <div class="space-y-1.5">
                    <span class="text-base font-bold text-primary">02</span>
                    <h3 class="text-sm font-bold text-[#070f1e]">Cập nhật nhận diện</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Cửu Long tiếp nhận logo, mã màu chủ đạo, số hotline và các kênh liên hệ để tinh chỉnh visual đồng bộ.
                    </p>
                </div>
                <div class="space-y-1.5">
                    <span class="text-base font-bold text-primary">03</span>
                    <h3 class="text-sm font-bold text-[#070f1e]">Nạp dữ liệu thực tế</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Đưa bài viết, hình ảnh sản phẩm/dịch vụ thực tế của quý khách vào các trang nội dung tương ứng.
                    </p>
                </div>
                <div class="space-y-1.5">
                    <span class="text-base font-bold text-primary">04</span>
                    <h3 class="text-sm font-bold text-[#070f1e]">Trỏ tên miền &amp; Bàn giao</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Kích hoạt chứng chỉ SSL, liên kết tên miền chính thức và bàn giao toàn bộ quyền quản trị CMS.
                    </p>
                </div>
            </div>
        </section>

        <!-- ==================== MAY ĐO HOẶC TÙY BIẾN CHUYÊN SÂU ==================== -->
        <section class="p-8 rounded-2xl bg-white border border-slate-200/90 shadow-sm flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
            <div class="space-y-2 max-w-2xl">
                <span class="text-xs font-bold text-primary uppercase">NĂNG LỰC MAY ĐO RIÊNG BIỆT</span>
                <h2 class="text-xl sm:text-2xl font-bold text-[#070f1e] tracking-tight">
                    Cần Giao Diện May Đo Hoặc Tùy Biến Chuyên Sâu?
                </h2>
                <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                    Nếu quý khách có yêu cầu nhận diện độc bản, thiết kế riêng từng màn hình hoặc tích hợp nghiệp vụ phức tạp không nằm trong mẫu có sẵn, đội ngũ kỹ sư của Cửu Long sẽ thiết kế kiến trúc may đo toàn diện.
                </p>
            </div>
            <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 shrink-0">
                <a href="{{ route('services.web-app') }}" class="px-5 py-2.5 rounded-xl bg-[#070f1e] hover:bg-slate-800 text-white text-xs font-semibold text-center transition-all">
                    <span>Xem giải pháp Web App may đo</span>
                </a>
                <a href="{{ route('contact') }}" class="px-5 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-800 text-xs font-semibold text-center transition-all">
                    <span>Liên hệ tư vấn</span>
                </a>
            </div>
        </section>

        <!-- ==================== FINAL CTA ==================== -->
        <section class="rounded-2xl bg-[#070f1e] text-white p-8 sm:p-12 text-center flex flex-col items-center gap-5 shadow-xl">
            <span class="text-xs text-amber-400 font-bold uppercase tracking-wider">KHỞI ĐỘNG NHANH CHÓNG</span>
            <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-white">
                Sẵn Sàng Triển Khai Website Cho Doanh Nghiệp?
            </h2>
            <p class="text-slate-300 text-xs sm:text-sm max-w-xl leading-relaxed">
                Chọn mẫu nền tảng ưng ý hoặc trao đổi trực tiếp với chúng tôi để hoàn thiện website chuẩn mực trong thời gian ngắn nhất.
            </p>
            <div class="flex flex-wrap items-center justify-center gap-3 pt-2">
                <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 px-6 py-3.5 rounded-xl bg-amber-400 hover:bg-amber-300 text-slate-950 text-xs sm:text-sm font-bold shadow-sm transition-all">
                    <span>Bắt đầu dự án</span>
                    <span class="material-symbols-outlined text-[16px]" aria-hidden="true">arrow_forward</span>
                </a>
                <a href="tel:{{ preg_replace('/[^0-9+]/', '', get_setting('company_phone', '0939.363.262')) }}" class="inline-flex items-center gap-2 px-6 py-3.5 rounded-xl bg-white/10 hover:bg-white/15 text-white text-xs sm:text-sm font-semibold border border-white/15 transition-all">
                    <span class="material-symbols-outlined text-[16px] text-amber-400" aria-hidden="true">call</span>
                    <span>{{ get_setting('company_phone', '0939.363.262') }}</span>
                </a>
            </div>
        </section>
    </x-ui.container>

    <!-- LIVE PREVIEW MODAL -->
    <div x-show="previewModal" x-transition.opacity class="fixed inset-0 z-50 flex items-center justify-center p-2 sm:p-4 bg-black/80 backdrop-blur-sm" style="display: none;">
        <div @click.outside="previewModal = false" class="w-full max-w-5xl h-[85vh] bg-[#070f1e] rounded-2xl border border-slate-700 shadow-2xl overflow-hidden flex flex-col">
            <div class="h-14 px-6 bg-[#0b1b33] border-b border-slate-700 flex items-center justify-between shrink-0">
                <div class="flex items-center gap-3">
                    <span class="text-xs font-semibold text-white truncate max-w-xs sm:max-w-md" x-text="previewTitle"></span>
                </div>
                <div class="flex items-center gap-3">
                    <div class="hidden sm:flex items-center gap-1 bg-[#070f1e] p-1 rounded-lg border border-slate-700 text-xs">
                        <button type="button" @click="previewDevice = 'desktop'" :class="previewDevice === 'desktop' ? 'bg-amber-400 text-slate-950 font-bold' : 'text-slate-400 hover:text-white'" class="px-2.5 py-1 rounded">Desktop</button>
                        <button type="button" @click="previewDevice = 'tablet'" :class="previewDevice === 'tablet' ? 'bg-amber-400 text-slate-950 font-bold' : 'text-slate-400 hover:text-white'" class="px-2.5 py-1 rounded">Tablet</button>
                        <button type="button" @click="previewDevice = 'mobile'" :class="previewDevice === 'mobile' ? 'bg-amber-400 text-slate-950 font-bold' : 'text-slate-400 hover:text-white'" class="px-2.5 py-1 rounded">Mobile</button>
                    </div>
                    <a :href="'{{ route('contact') }}?service=' + encodeURIComponent('Nền tảng: ' + previewTitle)" class="px-3 py-1.5 rounded-lg bg-amber-400 hover:bg-amber-300 text-slate-950 text-xs font-bold transition-all">
                        Áp dụng mẫu này
                    </a>
                    <button type="button" @click="previewModal = false" class="text-slate-400 hover:text-white">
                        <span class="material-symbols-outlined text-[20px]">close</span>
                    </button>
                </div>
            </div>
            <div class="flex-1 bg-slate-900 overflow-y-auto p-4 flex justify-center items-start">
                <div :class="{
                    'w-full max-w-full': previewDevice === 'desktop',
                    'w-[768px] shadow-2xl': previewDevice === 'tablet',
                    'w-[390px] shadow-2xl rounded-xl overflow-hidden': previewDevice === 'mobile'
                }" class="transition-all duration-300 bg-white">
                    <img :src="previewImg" :alt="previewTitle" class="w-full h-auto object-top">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
