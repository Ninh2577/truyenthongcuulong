@extends('layouts.app')

@section('title', 'Dịch Vụ - Truyền Thông Cửu Long')
@section('meta_description', 'Khám phá hệ sinh thái dịch vụ toàn diện của Truyền Thông Cửu Long: Media & Video Production, Digital Marketing, Thiết kế Website và Tích hợp AI.')

@section('content')
<div class="pt-28 pb-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="text-xs font-bold text-cyan-400 uppercase tracking-widest block mb-2">Giải Pháp Toàn Diện</span>
            <h1 class="text-3xl sm:text-5xl font-extrabold text-white mb-4">Dịch Vụ Cung Cấp</h1>
            <p class="text-slate-400 text-sm sm:text-base">Mô hình tích hợp Agency Truyền Thông và Giải Pháp Công Nghệ Số giúp thương hiệu bứt phá mạnh mẽ.</p>
        </div>

        <!-- Pillar 1: Media -->
        <div class="mb-20">
            <div class="flex items-center gap-3 mb-8">
                <span class="w-10 h-10 rounded-xl bg-cyan-500/20 text-cyan-400 flex items-center justify-center text-xl font-bold">🎬</span>
                <h2 class="text-2xl font-bold text-white">Agency Truyền Thông & Tiếp Thị Số</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @foreach($mediaServices as $service)
                <div class="glass-card p-8 rounded-3xl flex flex-col justify-between">
                    <div>
                        <h3 class="font-heading font-bold text-xl text-white mb-3">{{ $service->title }}</h3>
                        <p class="text-slate-300 text-sm mb-6 leading-relaxed">{{ $service->summary }}</p>
                    </div>
                    <a href="{{ route('services.show', $service->slug) }}" class="inline-flex items-center gap-2 text-cyan-400 font-semibold text-sm hover:text-cyan-300 group">
                        Chi tiết dịch vụ <span class="group-hover:translate-x-1 transition-transform">&rarr;</span>
                    </a>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Pillar 2: Technology -->
        <div>
            <div class="flex items-center gap-3 mb-8">
                <span class="w-10 h-10 rounded-xl bg-amber-500/20 text-amber-400 flex items-center justify-center text-xl font-bold">💻</span>
                <h2 class="text-2xl font-bold text-white">Giải Pháp Công Nghệ & Nền Tảng Số</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @foreach($techServices as $service)
                <div class="glass-card p-8 rounded-3xl flex flex-col justify-between">
                    <div>
                        <h3 class="font-heading font-bold text-xl text-white mb-3">{{ $service->title }}</h3>
                        <p class="text-slate-300 text-sm mb-6 leading-relaxed">{{ $service->summary }}</p>
                    </div>
                    <a href="{{ route('services.show', $service->slug) }}" class="inline-flex items-center gap-2 text-amber-400 font-semibold text-sm hover:text-amber-300 group">
                        Chi tiết dịch vụ <span class="group-hover:translate-x-1 transition-transform">&rarr;</span>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection