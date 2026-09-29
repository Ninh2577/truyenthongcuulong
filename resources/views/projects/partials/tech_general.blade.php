{{-- 
    TECHNOLOGY CASE STUDY — GENERAL TEMPLATE FOR SOFTWARE & WEBSITES
--}}
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
            <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-sky-100 text-sky-800 font-mono text-xs font-bold border border-sky-200/80 w-fit">
                <span class="w-2 h-2 rounded-full bg-primary animate-pulse"></span>
                <span>DIGITAL SOLUTION &bull; DỰ ÁN THỰC THI THỰC TẾ</span>
            </div>

            <h1 class="font-headline text-3xl sm:text-4xl lg:text-5xl font-extrabold text-navy-base tracking-tight leading-tight">
                {{ $caseStudy->title }}
            </h1>

            <p class="font-body text-slate-600 text-base sm:text-lg leading-relaxed">
                {{ $caseStudy->summary ?: 'Giải pháp công nghệ và số hóa được triển khai chuyên nghiệp bởi Truyền Thông Cửu Long.' }}
            </p>

            <!-- Project Meta Strip -->
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 pt-4 mt-2 border-t border-slate-200/80 font-mono text-xs">
                <div>
                    <span class="text-slate-400 block text-[11px] uppercase tracking-wider">Khách hàng</span>
                    <span class="font-bold text-navy-base mt-0.5 block font-headline">{{ $caseStudy->client_name }}</span>
                </div>
                <div>
                    <span class="text-slate-400 block text-[11px] uppercase tracking-wider">Loại sản phẩm</span>
                    <span class="font-bold text-sky-700 mt-0.5 block font-headline">{{ str_contains($caseStudy->tech_stack, 'WordPress') ? 'Website WordPress' : 'Web App / System' }}</span>
                </div>
                <div>
                    <span class="text-slate-400 block text-[11px] uppercase tracking-wider">Thời gian</span>
                    <span class="font-bold text-navy-base mt-0.5 block font-headline">{{ $caseStudy->year ?: '2024' }}</span>
                </div>
                <div>
                    <span class="text-slate-400 block text-[11px] uppercase tracking-wider">Trạng thái</span>
                    <span class="font-bold text-emerald-600 mt-0.5 flex items-center gap-1 font-headline">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                        Đã triển khai
                    </span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Main Content -->
<div class="w-full bg-[#f8f9ff] py-14 lg:py-20 border-b border-slate-200/80">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
        <!-- Highlights Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="p-6 sm:p-8 rounded-2xl bg-white border border-slate-200/90 shadow-sm space-y-4">
                <div class="flex items-center gap-2 text-rose-600 font-bold text-sm">
                    <span class="material-symbols-outlined text-[20px]">help_outline</span>
                    <span>BÀI TOÁN DOANH NGHIỆP (PROBLEM)</span>
                </div>
                <p class="text-sm text-slate-700 leading-relaxed">
                    {{ $caseStudy->problem ?: 'Cần nâng cấp nhận diện số và chuẩn hóa quy trình vận hành trực tuyến.' }}
                </p>
            </div>

            <div class="p-6 sm:p-8 rounded-2xl bg-white border border-slate-200/90 shadow-sm space-y-4">
                <div class="flex items-center gap-2 text-emerald-600 font-bold text-sm">
                    <span class="material-symbols-outlined text-[20px]">check_circle</span>
                    <span>GIẢI PHÁP TRIỂN KHAI (SOLUTION)</span>
                </div>
                <p class="text-sm text-slate-700 leading-relaxed">
                    {{ $caseStudy->solution ?: 'Xây dựng giải pháp kỹ thuật may đo phù hợp với đặc thù nghiệp vụ của đơn vị.' }}
                </p>
            </div>
        </div>

        <!-- Tech Stack & Deliverables -->
        <div class="p-6 sm:p-8 rounded-2xl bg-white border border-slate-200/90 shadow-sm space-y-6">
            <h2 class="text-xl sm:text-2xl font-bold text-[#070f1e]">Hồ Sơ Kỹ Thuật &amp; Bàn Giao</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-2">
                <div class="p-5 rounded-xl bg-slate-50 border border-slate-200/80 space-y-2">
                    <div class="text-xs font-bold text-primary uppercase tracking-wider font-mono">Công nghệ sử dụng</div>
                    <div class="text-sm font-bold text-navy-base font-mono">{{ $caseStudy->tech_stack ?: 'PHP, MySQL, Modern Architecture' }}</div>
                    <p class="text-xs text-slate-500">Mã nguồn tinh gọn, tối ưu hiệu năng và bảo mật chuẩn mực.</p>
                </div>

                <div class="p-5 rounded-xl bg-slate-50 border border-slate-200/80 space-y-2">
                    <div class="text-xs font-bold text-emerald-600 uppercase tracking-wider font-mono">Kết quả bàn giao</div>
                    <div class="text-sm font-bold text-navy-base">{{ $caseStudy->result ?: 'Nghiệm thu thành công và đưa vào vận hành thực tế.' }}</div>
                    <p class="text-xs text-slate-500">Bàn giao toàn bộ quyền quản trị, mã nguồn và tài liệu kỹ thuật.</p>
                </div>
            </div>
        </div>

        <!-- Back & CTA -->
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-6">
            <a href="{{ route('projects.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-slate-600 hover:text-primary transition-colors">
                <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                <span>Quay lại danh mục dự án</span>
            </a>
            <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-primary hover:bg-orange-600 text-white font-bold text-sm shadow-md transition-all">
                <span>Trao đổi bài toán tương tự</span>
                <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
            </a>
        </div>
    </div>
</div>
