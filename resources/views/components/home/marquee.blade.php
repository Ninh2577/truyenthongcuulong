@php
    // Toàn bộ 48 logo khách hàng trong 1 dải cuộn duy nhất
    $clientLogos = range(1, 48);
    $logoVersion = file_exists(public_path('images/logoKhachHang/1.png')) 
        ? filemtime(public_path('images/logoKhachHang/1.png')) 
        : time();

    // Danh sách hệ sinh thái công nghệ doanh nghiệp làm chủ
    $techStack = [
        ['name' => 'MongoDB', 'dot' => 'bg-emerald-500', 'tag' => 'Database'],
        ['name' => 'Docker', 'dot' => 'bg-sky-500', 'tag' => 'DevOps'],
        ['name' => 'AWS', 'dot' => 'bg-amber-500', 'tag' => 'Cloud'],
        ['name' => 'Google Cloud', 'dot' => 'bg-blue-500', 'tag' => 'Cloud'],
        ['name' => 'Figma', 'dot' => 'bg-purple-500', 'tag' => 'UI/UX'],
        ['name' => 'GraphQL', 'dot' => 'bg-pink-500', 'tag' => 'API'],
        ['name' => 'Python', 'dot' => 'bg-amber-400', 'tag' => 'Backend/AI'],
        ['name' => 'Flutter', 'dot' => 'bg-cyan-500', 'tag' => 'Mobile App'],
        ['name' => 'Django', 'dot' => 'bg-emerald-600', 'tag' => 'Framework'],
        ['name' => 'Kubernetes', 'dot' => 'bg-indigo-500', 'tag' => 'Cloud Native'],
        ['name' => 'Redis', 'dot' => 'bg-rose-500', 'tag' => 'Cache'],
        ['name' => 'PHP', 'dot' => 'bg-indigo-600', 'tag' => 'Core'],
        ['name' => 'Laravel', 'dot' => 'bg-red-500', 'tag' => 'Framework'],
        ['name' => 'MySQL', 'dot' => 'bg-blue-600', 'tag' => 'Database'],
        ['name' => 'WordPress', 'dot' => 'bg-sky-600', 'tag' => 'CMS'],
        ['name' => 'React', 'dot' => 'bg-cyan-400', 'tag' => 'Frontend'],
        ['name' => 'TypeScript', 'dot' => 'bg-blue-500', 'tag' => 'Language'],
        ['name' => 'Next.js', 'dot' => 'bg-slate-900', 'tag' => 'Fullstack'],
        ['name' => 'Node.js', 'dot' => 'bg-green-500', 'tag' => 'Runtime'],
        ['name' => 'TailwindCSS', 'dot' => 'bg-teal-400', 'tag' => 'UI Styling'],
        ['name' => 'PostgreSQL', 'dot' => 'bg-indigo-600', 'tag' => 'Database'],
    ];
@endphp

<section class="w-full bg-slate-50 border-b border-slate-200/80 py-6 lg:py-8 overflow-hidden" id="marquee-section">
    <!-- Header 1: Khách hàng & Đối tác tiêu biểu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-4">
        <div class="flex items-center justify-center gap-3 text-center">
            <span class="h-px w-8 bg-slate-300"></span>
            <p class="font-mono text-xs font-bold uppercase tracking-widest text-slate-500">
                Khách Hàng Chiến Lược &bull; Khách Hàng Đồng Hành Cùng Truyền Thông Cửu Long
            </p>
            <span class="h-px w-8 bg-slate-300"></span>
        </div>
    </div>

    <!-- Dải duy nhất: KHÁCH HÀNG & ĐỐI TÁC TIÊU BIỂU (Toàn bộ 48 Logo cuộn sang trái) -->
    <div class="marquee-container relative w-full overflow-hidden flex items-center py-2.5 [mask-image:linear-gradient(to_right,transparent,black_48px,black_calc(100%-48px),transparent)] [-webkit-mask-image:linear-gradient(to_right,transparent,black_48px,black_calc(100%-48px),transparent)]">
        <div class="marquee-track flex items-center gap-3.5 sm:gap-5 shrink-0" style="animation-duration: 80s;" aria-label="Danh sách logo khách hàng đồng hành">
            {{-- Dải phần tử gốc cho người dùng và thiết bị trợ thính (Screen Reader) --}}
            @foreach($clientLogos as $logo)
                <div class="inline-flex items-center justify-center p-2.5 sm:p-3 rounded-2xl bg-white border border-slate-200/90 shadow-2xs hover:border-primary/50 hover:shadow-xs hover:-translate-y-0.5 transition-all duration-200 group shrink-0 h-24 sm:h-[116px] w-36 sm:w-[180px]">
                    <img src="{{ asset('images/logoKhachHang/' . $logo . '.png') }}?v={{ $logoVersion }}"
                         alt="Logo khách hàng Cửu Long Media {{ $logo }}"
                         class="h-16 sm:h-[88px] w-auto max-w-[115px] sm:max-w-[155px] object-contain group-hover:scale-105 transition-transform duration-200"
                         loading="lazy">
                </div>
            @endforeach
            {{-- Dải nhân đôi phục vụ hiệu ứng lặp CSS vô tận, ẩn với Screen Reader để tránh đọc trùng --}}
            @foreach($clientLogos as $logo)
                <div class="inline-flex items-center justify-center p-2.5 sm:p-3 rounded-2xl bg-white border border-slate-200/90 shadow-2xs hover:border-primary/50 hover:shadow-xs hover:-translate-y-0.5 transition-all duration-200 group shrink-0 h-24 sm:h-[116px] w-36 sm:w-[180px]" aria-hidden="true">
                    <img src="{{ asset('images/logoKhachHang/' . $logo . '.png') }}?v={{ $logoVersion }}"
                         alt=""
                         class="h-16 sm:h-[88px] w-auto max-w-[115px] sm:max-w-[155px] object-contain group-hover:scale-105 transition-transform duration-200"
                         loading="lazy">
                </div>
            @endforeach
        </div>
    </div>

    <!-- ==================== CUỐI MỤC: NỀN TẢNG & HỆ SINH THÁI CÔNG NGHỆ (TECH STACK MARQUEE) ==================== -->
    <div class="mt-6 pt-5 border-t border-slate-200/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-3.5">
            <div class="flex items-center justify-center gap-3 text-center">
                <span class="h-px w-6 sm:w-10 bg-slate-300"></span>
                <p class="font-mono text-[11px] sm:text-xs font-bold uppercase tracking-widest text-slate-500 flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse" aria-hidden="true"></span>
                    <span>Nền Tảng &amp; Hệ Sinh Thái Công Nghệ Tiêu Chuẩn</span>
                </p>
                <span class="h-px w-6 sm:w-10 bg-slate-300"></span>
            </div>
        </div>

        <div class="marquee-container relative w-full overflow-hidden flex items-center py-1">
            <div class="absolute left-0 top-0 bottom-0 w-16 sm:w-28 z-10 pointer-events-none bg-gradient-to-r from-slate-50 to-transparent"></div>
            <div class="absolute right-0 top-0 bottom-0 w-16 sm:w-28 z-10 pointer-events-none bg-gradient-to-l from-slate-50 to-transparent"></div>

            <div class="marquee-track flex items-center gap-2.5 sm:gap-3 shrink-0" aria-label="Hệ sinh thái công nghệ">
                {{-- Dải phần tử gốc --}}
                @foreach($techStack as $tech)
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg bg-white border border-slate-200/90 shadow-2xs hover:border-slate-400 hover:shadow-xs hover:-translate-y-0.5 transition-all duration-200 group shrink-0">
                        <span class="w-2 h-2 rounded-full {{ $tech['dot'] }} group-hover:scale-125 transition-transform" aria-hidden="true"></span>
                        <span class="font-headline font-bold text-slate-800 text-xs sm:text-sm tracking-wide whitespace-nowrap">{{ $tech['name'] }}</span>
                        <span class="text-[9px] font-mono font-medium text-slate-400 bg-slate-100 px-1.5 py-0.5 rounded uppercase hidden xs:inline-block">{{ $tech['tag'] }}</span>
                    </div>
                @endforeach
                {{-- Dải nhân đôi phục vụ hiệu ứng lặp CSS vô tận --}}
                @foreach($techStack as $tech)
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg bg-white border border-slate-200/90 shadow-2xs hover:border-slate-400 hover:shadow-xs hover:-translate-y-0.5 transition-all duration-200 group shrink-0" aria-hidden="true">
                        <span class="w-2 h-2 rounded-full {{ $tech['dot'] }} group-hover:scale-125 transition-transform"></span>
                        <span class="font-headline font-bold text-slate-800 text-xs sm:text-sm tracking-wide whitespace-nowrap">{{ $tech['name'] }}</span>
                        <span class="text-[9px] font-mono font-medium text-slate-400 bg-slate-100 px-1.5 py-0.5 rounded uppercase hidden xs:inline-block">{{ $tech['tag'] }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>