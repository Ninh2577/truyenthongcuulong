@extends('layouts.app')

@section('title', 'Kho Giao Diện & Mẫu Website Chuyên Nghiệp - Cửu Long TechLab')
@section('meta_description', 'Bộ sưu tập 39+ mẫu giao diện website đa ngành nghề chuẩn SEO, tối ưu tốc độ tải trang, tương thích di động hoàn hảo cho doanh nghiệp.')

@section('content')
<div class="w-full bg-surface bg-dot-grid-subtle pt-28 pb-20 border-b border-slate-200/60">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-10 pb-8 border-b border-slate-200">
            <div class="max-w-2xl flex flex-col gap-3">
                <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-sky-100 border border-sky-300 text-sky-800 font-mono text-xs font-bold w-fit">
                    <span class="w-2 h-2 rounded-full bg-sky-500 animate-pulse"></span>
                    <span>TECHLAB • TEMPLATE SHOWCASE</span>
                </div>
                <h1 class="font-headline text-3xl sm:text-4xl lg:text-5xl font-extrabold text-navy-base tracking-tight">
                    Kho Mẫu Giao Diện <span class="text-transparent bg-clip-text bg-gradient-to-r from-sky-600 via-blue-600 to-indigo-600">Đa Ngành Nghề</span>
                </h1>
                <p class="font-body text-slate-600 text-sm sm:text-base leading-relaxed">
                    Khám phá bộ sưu tập mẫu giao diện website bản quyền hiện đại, kiến trúc clean-code, tối ưu Core Web Vitals và sẵn sàng triển khai trong 48 giờ.
                </p>
            </div>

            <!-- Search Template -->
            <form action="{{ route('templates.index') }}" method="GET" class="w-full md:w-72">
                @if(request('industry'))
                    <input type="hidden" name="industry" value="{{ request('industry') }}">
                @endif
                <div class="relative flex items-center">
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Tìm tên giao diện..." 
                        class="w-full pl-10 pr-4 py-3 rounded-2xl bg-white border border-slate-300 text-navy-base placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-sky-500 text-xs shadow-xs">
                    <span class="material-symbols-outlined absolute left-3 text-slate-400 text-[18px]">search</span>
                </div>
            </form>
        </div>

        <!-- 13 Industry Chips Filter -->
        <div class="flex flex-col gap-2.5 mb-10">
            <div class="flex items-center justify-between">
                <span class="font-mono text-xs font-bold text-slate-500 uppercase tracking-wider">Lọc theo ngành nghề ({{ $industries->count() }} nhóm ngành):</span>
                @if($selectedIndustry || request('q'))
                <a href="{{ route('templates.index') }}" class="text-xs font-mono font-bold text-primary hover:underline flex items-center gap-1">
                    <span class="material-symbols-outlined text-[14px]">refresh</span>
                    <span>Xóa bộ lọc</span>
                </a>
                @endif
            </div>

            <div class="flex items-center gap-2 overflow-x-auto pb-3 no-scrollbar">
                <a href="{{ route('templates.index') }}" 
                    class="px-4 py-2 rounded-full text-xs font-headline font-bold whitespace-nowrap transition-all {{ empty($selectedIndustry) ? 'bg-sky-600 text-white shadow-md shadow-sky-500/30' : 'bg-white text-slate-600 hover:text-navy-base border border-slate-200' }}">
                    Tất cả ngành nghề ({{ $templates->total() }})
                </a>
                @foreach($industries as $ind)
                <a href="{{ route('templates.index', ['industry' => $ind->slug]) }}" 
                    class="px-4 py-2 rounded-full text-xs font-headline font-bold whitespace-nowrap transition-all {{ $selectedIndustry === $ind->slug ? 'bg-sky-600 text-white shadow-md shadow-sky-500/30' : 'bg-white text-slate-600 hover:text-sky-600 border border-slate-200 hover:border-sky-300' }}">
                    {{ $ind->name }}
                </a>
                @endforeach
            </div>
        </div>

        <!-- Templates Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
            @forelse($templates as $item)
            <div class="group rounded-3xl overflow-hidden bg-white border border-slate-200/90 shadow-[0_10px_30px_rgba(7,15,30,0.05)] hover:shadow-2xl hover:border-sky-400 transition-all duration-300 flex flex-col">
                
                <!-- Browser Bezel Frame -->
                <div class="w-full bg-[#0d1c38] text-slate-400 px-4 py-2.5 flex items-center justify-between border-b border-white/10">
                    <div class="flex items-center gap-1.5">
                        <div class="w-2.5 h-2.5 rounded-full bg-rose-500"></div>
                        <div class="w-2.5 h-2.5 rounded-full bg-amber-400"></div>
                        <div class="w-2.5 h-2.5 rounded-full bg-emerald-500"></div>
                        <span class="ml-2 text-[10px] font-mono text-slate-400 truncate max-w-[140px]">{{ $item->slug }}.live</span>
                    </div>
                    <span class="text-[9px] font-mono font-bold text-sky-400 bg-sky-950/80 px-2 py-0.5 rounded border border-sky-500/30">
                        Responsive 4K
                    </span>
                </div>

                <!-- Preview Image -->
                <div class="h-56 w-full relative overflow-hidden bg-slate-100 group/img">
                    @if($item->thumbnail)
                        <img src="{{ asset('storage/' . $item->thumbnail) }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover/img:scale-105 transition-transform duration-700">
                    @else
                        <div class="w-full h-full flex flex-col items-center justify-center bg-gradient-to-br from-slate-100 via-sky-50 to-slate-200 text-sky-800 p-6 text-center">
                            <span class="material-symbols-outlined text-5xl mb-2 text-sky-500">web</span>
                            <span class="font-headline text-xs font-bold">{{ $item->title }}</span>
                        </div>
                    @endif
                    <div class="absolute inset-0 bg-navy-base/60 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center gap-3 backdrop-blur-xs">
                        <a href="{{ route('blog.show', $item->slug) }}" class="px-4 py-2 rounded-full bg-white text-navy-base font-headline text-xs font-bold hover:bg-sky-50 shadow-md flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-[16px] text-sky-600">visibility</span>
                            <span>Xem chi tiết</span>
                        </a>
                    </div>
                </div>

                <!-- Card Details -->
                <div class="p-6 flex flex-col justify-between flex-1 gap-4">
                    <div class="flex flex-col gap-2">
                        <div class="flex items-center justify-between gap-2">
                            <span class="text-[11px] font-mono font-bold text-sky-600 bg-sky-50 border border-sky-200 px-2.5 py-0.5 rounded-full">
                                Web Architecture
                            </span>
                            <span class="text-[10px] font-mono text-emerald-600 font-bold bg-emerald-50 px-2 py-0.5 rounded">
                                ⚡ Score 98+
                            </span>
                        </div>
                        <h3 class="font-headline text-base font-bold text-navy-base group-hover:text-sky-600 transition-colors line-clamp-2">
                            <a href="{{ route('blog.show', $item->slug) }}">{{ $item->title }}</a>
                        </h3>
                        <p class="font-body text-xs text-slate-500 line-clamp-2 leading-relaxed">
                            {{ $item->summary ?: 'Giao diện thiết kế độc quyền, tích hợp tính năng quản trị thông minh, tối ưu chuẩn UI/UX quốc tế.' }}
                        </p>
                    </div>

                    <!-- CTA Buttons -->
                    <div class="pt-4 border-t border-slate-100 flex items-center justify-between gap-2">
                        <a href="{{ route('blog.show', $item->slug) }}" class="inline-flex items-center gap-1 text-xs font-headline font-bold text-slate-600 hover:text-navy-base transition-colors">
                            <span class="material-symbols-outlined text-[16px]">open_in_new</span>
                            <span>Xem Demo Live</span>
                        </a>
                        <a href="{{ route('contact', ['service' => 'Template: ' . $item->title]) }}" 
                            class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-gradient-to-r from-sky-600 to-blue-700 text-white font-headline text-xs font-bold shadow-xs hover:brightness-110 transition-all">
                            <span>Đặt mẫu này</span>
                            <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
                        </a>
                    </div>
                </div>

            </div>
            @empty
            <div class="col-span-3 text-center py-20 bg-white rounded-3xl border border-slate-200">
                <span class="material-symbols-outlined text-6xl text-slate-300 mb-3">developer_board_off</span>
                <h3 class="font-headline text-lg font-bold text-navy-base">Không tìm thấy mẫu giao diện phù hợp</h3>
                <p class="font-body text-xs text-slate-500 mt-1">Vui lòng chọn ngành nghề khác hoặc liên hệ đội ngũ Cửu Long để thiết kế riêng theo yêu cầu.</p>
                <a href="{{ route('templates.index') }}" class="mt-4 inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-sky-600 text-white font-headline text-xs font-bold">Xem tất cả 39 mẫu</a>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $templates->links() }}
        </div>

    </div>
</div>
@endsection
