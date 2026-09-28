{{-- 
    UI-REBUILD-09: MEDIA CASE STUDY — IN-HOUSE CREATIVE & PRODUCTION
    Dành cho các tác phẩm TVC, Phim Doanh Nghiệp, Sự kiện (Sacombank, Hoya Lens, Kredivo, RAKUS)
    Tuân thủ nghiêm ngặt: Minh bạch bối cảnh sản xuất, thiết bị in-house thực tế, không số liệu views/reach bịa đặt.
--}}

@php
    $youtubeId = '';
    if ($caseStudy->video_url && preg_match('/(?:youtube\.com\/(?:embed\/|watch\?v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/i', $caseStudy->video_url, $matches)) {
        $youtubeId = $matches[1];
    }
@endphp

<!-- Section 01: Project Hero -->
<section class="relative w-full pt-28 pb-14 lg:pt-36 lg:pb-16 bg-surface-low bg-dot-grid-subtle border-b border-slate-200/80">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <!-- Breadcrumb -->
        <nav class="flex items-center gap-2 text-xs font-headline text-slate-500 mb-6" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-primary transition-colors flex items-center gap-1">
                <span class="material-symbols-outlined text-[15px]">home</span>
                <span>Trang chủ</span>
            </a>
            <span class="text-slate-400">/</span>
            <a href="{{ route('projects.index') }}" class="hover:text-primary transition-colors">Dự án &amp; Case Studies</a>
            <span class="text-slate-400">/</span>
            <span class="text-navy-base font-bold truncate max-w-sm" aria-current="page">{{ $caseStudy->title }}</span>
        </nav>

        <div class="flex flex-col gap-5 max-w-4xl">
            <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-orange-100 text-primary font-mono text-xs font-bold border border-orange-200/80 w-fit">
                <span class="material-symbols-outlined text-[15px]">videocam</span>
                <span>MEDIA PRODUCTION CASE STUDY &bull; IN-HOUSE CREATIVE</span>
            </div>

            <h1 class="font-headline text-3xl sm:text-4xl lg:text-5xl font-extrabold text-navy-base tracking-tight leading-tight">
                {{ $caseStudy->title }}
            </h1>

            <p class="font-body text-slate-600 text-base sm:text-lg leading-relaxed">
                {{ $caseStudy->summary ?: 'Dự án sản xuất tư liệu hình ảnh và video chuyên nghiệp được thực hiện bởi đội ngũ Media in-house Truyền Thông Cửu Long.' }}
            </p>

            <!-- Project Meta Strip -->
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 pt-4 mt-2 border-t border-slate-200/80 font-mono text-xs">
                <div>
                    <span class="text-slate-400 block text-[11px] uppercase tracking-wider">Khách hàng</span>
                    <span class="font-bold text-navy-base mt-0.5 block font-headline">{{ $caseStudy->client_name }}</span>
                </div>
                <div>
                    <span class="text-slate-400 block text-[11px] uppercase tracking-wider">Định dạng</span>
                    <span class="font-bold text-primary mt-0.5 block font-headline">Video 4K / TVC</span>
                </div>
                <div>
                    <span class="text-slate-400 block text-[11px] uppercase tracking-wider">Năm sản xuất</span>
                    <span class="font-bold text-navy-base mt-0.5 block font-headline">{{ $caseStudy->year ?: '2024' }}</span>
                </div>
                <div>
                    <span class="text-slate-400 block text-[11px] uppercase tracking-wider">Trạng thái</span>
                    <span class="font-bold text-emerald-600 mt-0.5 flex items-center gap-1 font-headline">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                        Đã phát sóng / Hoàn tất
                    </span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Main Case Study Content Container -->
<div class="w-full bg-surface py-14 lg:py-20 border-b border-slate-200/80">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16 lg:space-y-20">

        <!-- Featured Video / Visual Container -->
        <div class="rounded-3xl overflow-hidden bg-black border border-slate-200 shadow-xl relative aspect-video">
            @if($youtubeId)
                <iframe src="https://www.youtube.com/embed/{{ $youtubeId }}?autoplay=0&rel=0&modestbranding=1" 
                        class="w-full h-full object-cover" 
                        title="{{ $caseStudy->title }}"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                        allowfullscreen></iframe>
            @elseif($caseStudy->video_url)
                <iframe src="{{ $caseStudy->video_url }}" 
                        class="w-full h-full object-cover" 
                        title="{{ $caseStudy->title }}"
                        allowfullscreen></iframe>
            @elseif($caseStudy->thumbnail)
                <img src="{{ asset('storage/' . $caseStudy->thumbnail) }}" 
                     alt="{{ $caseStudy->title }}" 
                     class="w-full h-full object-cover"
                     onerror="this.src='{{ asset('images/real-cameraman-production.jpg') }}'">
            @else
                <img src="{{ asset('images/real-cameraman-production.jpg') }}" 
                     alt="{{ $caseStudy->title }}" 
                     class="w-full h-full object-cover">
            @endif
        </div>

        <!-- Section 02: Bối cảnh & Yêu cầu sản xuất -->
        <section class="space-y-6">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-orange-50 text-primary font-mono text-xs font-bold border border-orange-200">
                <span>01. BỐI CẢNH &amp; YÊU CẦU DỰ ÁN</span>
            </div>
            <h2 class="font-headline text-2xl sm:text-3xl font-extrabold text-navy-base">
                Yêu Cầu Truyền Tải Thông Điệp &amp; Hình Ảnh Thương Hiệu
            </h2>
            <div class="prose prose-slate max-w-none text-slate-700 font-body text-sm sm:text-base leading-relaxed space-y-4">
                <p>
                    Đối tác <strong>{{ $caseStudy->client_name }}</strong> đặt yêu cầu sản xuất nội dung hình ảnh và video chuẩn mực nhằm phục vụ chiến dịch truyền thông nhận diện thương hiệu. Đội ngũ Cửu Long trực tiếp phụ trách các khâu từ kịch bản phân cảnh, tổ chức ghi hình thực địa đến hậu kỳ hoàn thiện.
                </p>
                @if($caseStudy->content)
                    <div class="mt-4 pt-4 border-t border-slate-200">
                        {!! $caseStudy->content !!}
                    </div>
                @endif
            </div>
        </section>

        <!-- Section 03: Quy trình tác nghiệp & Thiết bị in-house -->
        <section class="space-y-6">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-slate-100 text-slate-800 font-mono text-xs font-bold border border-slate-200">
                <span class="material-symbols-outlined text-[15px] text-primary">movie</span>
                <span>02. QUY TRÌNH TÁC NGHIỆP &amp; THIẾT BỊ IN-HOUSE</span>
            </div>
            <h2 class="font-headline text-2xl sm:text-3xl font-extrabold text-navy-base">
                Năng Lực Sản Xuất Tư Liệu In-House Đồng Bộ
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 pt-2">
                <div class="p-5 rounded-2xl bg-white border border-slate-200 shadow-2xs space-y-2">
                    <span class="material-symbols-outlined text-[24px] text-primary">edit_note</span>
                    <h3 class="font-headline text-base font-bold text-navy-base">Tiền Kỳ &amp; Kịch Bản</h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">
                        Lên ý tưởng thông điệp, xây dựng kịch bản chi tiết và storyboard phân cảnh trước ngày tác nghiệp.
                    </p>
                </div>

                <div class="p-5 rounded-2xl bg-white border border-slate-200 shadow-2xs space-y-2">
                    <span class="material-symbols-outlined text-[24px] text-amber-600">videocam</span>
                    <h3 class="font-headline text-base font-bold text-navy-base">Thiết Bị Ghi Hình</h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">
                        Hệ máy quay Sony FX Cinema, ống kính chuyên dụng, flycam 4K và hệ thống ánh sáng studio hiện đại.
                    </p>
                </div>

                <div class="p-5 rounded-2xl bg-white border border-slate-200 shadow-2xs space-y-2">
                    <span class="material-symbols-outlined text-[24px] text-sky-600">palette</span>
                    <h3 class="font-headline text-base font-bold text-navy-base">Hậu Kỳ &amp; Chỉnh Màu</h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">
                        Dựng phim nhịp độ cao, cân chỉnh màu điện ảnh (Color Grading), hòa âm và lồng tiếng chuẩn xác.
                    </p>
                </div>

                <div class="p-5 rounded-2xl bg-white border border-slate-200 shadow-2xs space-y-2">
                    <span class="material-symbols-outlined text-[24px] text-emerald-600">verified</span>
                    <h3 class="font-headline text-base font-bold text-navy-base">Bàn Giao Đa Định Dạng</h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">
                        Xuất file video master 4K/FullHD và các bản cắt ngắn (Shorts / Reels) tối ưu cho đa nền tảng số.
                    </p>
                </div>
            </div>
        </section>

        <!-- Section 04: Sản phẩm bàn giao -->
        <section class="space-y-6">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-slate-100 text-slate-800 font-mono text-xs font-bold border border-slate-200">
                <span class="material-symbols-outlined text-[15px] text-primary">inventory_2</span>
                <span>03. SẢN PHẨM BÀN GIAO &bull; DELIVERABLES</span>
            </div>
            <h2 class="font-headline text-2xl sm:text-3xl font-extrabold text-navy-base">
                Phạm Vi Sản Phẩm Nghiệm Thu
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 pt-2">
                <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-2xs space-y-2">
                    <h3 class="font-headline text-base font-bold text-navy-base">Video Master 4K / FullHD</h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">
                        Bản dựng chuẩn phát sóng hoặc trình chiếu hội nghị với độ phân giải cao và âm thanh stereo tối ưu.
                    </p>
                </div>

                <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-2xs space-y-2">
                    <h3 class="font-headline text-base font-bold text-navy-base">Định Dạng Rút Gọn (Social Cuts)</h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">
                        Các đoạn video ngắn 15s - 30s tỉ lệ 9:16 và 1:1 phục vụ truyền thông mạng xã hội và quảng cáo digital.
                    </p>
                </div>

                <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-2xs space-y-2">
                    <h3 class="font-headline text-base font-bold text-navy-base">Bộ Ảnh Tư Liệu Thương Hiệu</h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">
                        Tập hợp hình ảnh chất lượng cao chụp trong quá trình tác nghiệp phục vụ thiết kế website và ấn phẩm số.
                    </p>
                </div>
            </div>
        </section>

        <!-- Section 05: Related Case Studies -->
        <section class="space-y-6 pt-6 border-t border-slate-200/80">
            <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4">
                <div>
                    <span class="font-mono text-xs font-bold text-slate-400 uppercase tracking-wider block mb-1">
                        DỰ ÁN LIÊN QUAN
                    </span>
                    <h2 class="font-headline text-2xl font-bold text-navy-base">
                        Khám Phá Thêm Dự Án Khác
                    </h2>
                </div>
                <a href="{{ route('projects.index') }}" class="text-xs font-headline font-bold text-primary hover:underline inline-flex items-center gap-1">
                    <span>Xem toàn bộ dự án</span>
                    <span class="material-symbols-outlined text-[15px]">arrow_forward</span>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-2">
                @foreach($relatedCases as $relCase)
                    <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-2xs flex items-center justify-between gap-4 group hover:border-primary/40 transition-colors">
                        <div>
                            <span class="text-[10px] font-mono font-bold text-slate-400 uppercase">{{ $relCase->client_name ?: 'Khách hàng' }} &bull; {{ $relCase->year ?: '2024' }}</span>
                            <h3 class="font-headline text-base font-bold text-navy-base group-hover:text-primary transition-colors mt-1">
                                {{ $relCase->title }}
                            </h3>
                            <p class="font-body text-xs text-slate-500 line-clamp-1 mt-1">
                                {{ $relCase->summary }}
                            </p>
                        </div>
                        <a href="{{ route('projects.show', $relCase->slug) }}" 
                           class="w-10 h-10 rounded-xl bg-slate-50 text-slate-700 group-hover:bg-primary group-hover:text-white flex items-center justify-center shrink-0 transition-colors">
                            <span class="material-symbols-outlined text-[20px]">arrow_forward</span>
                        </a>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- Section 06: Final CTA -->
        <div class="p-8 sm:p-12 rounded-3xl bg-gradient-to-br from-[#070F1E] to-[#0C1A30] text-white shadow-xl flex flex-col md:flex-row items-center justify-between gap-8">
            <div class="space-y-2 text-center md:text-left max-w-xl">
                <span class="text-amber-400 font-mono text-xs font-bold uppercase tracking-wider block">
                    ĐỒNG HÀNH TRUYỀN THÔNG SỐ
                </span>
                <h3 class="font-headline text-2xl sm:text-3xl font-extrabold text-white">
                    Sản Xuất Tư Liệu Media &amp; Hình Ảnh Nhận Diện Cho Doanh Nghiệp?
                </h3>
                <p class="font-body text-slate-300 text-xs sm:text-sm leading-relaxed">
                    Liên hệ với Cửu Long để được tư vấn kịch bản video, booking ekip quay chụp hoặc sản xuất tài nguyên thị giác cho website.
                </p>
            </div>
            <div class="flex flex-col sm:flex-row items-center gap-3 shrink-0">
                <a href="{{ route('booking') }}" 
                   class="btn-primary-cta px-8 py-3.5 rounded-full bg-primary hover:bg-orange-600 text-white font-headline text-xs font-bold shadow-md transition-all">
                    <span>Booking Ekip Tác Nghiệp</span>
                </a>
                <a href="{{ route('services.media') }}" 
                   class="px-6 py-3.5 rounded-full bg-white/10 hover:bg-white/20 text-white font-headline text-xs font-bold transition-all border border-white/20">
                    <span>Dịch Vụ Media</span>
                </a>
            </div>
        </div>

    </div>
</div>
