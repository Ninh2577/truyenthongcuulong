@extends('layouts.app')

@section('title', $service->title . ' - Truyền Thông Cửu Long')
@section('meta_description', $service->summary)

@section('content')
<div class="pt-28 pb-20">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex items-center gap-2 text-xs text-slate-400 mb-6">
            <a href="{{ route('home') }}" class="hover:text-cyan-400">Trang chủ</a>
            <span>/</span>
            <a href="{{ route('services.index') }}" class="hover:text-cyan-400">Dịch vụ</a>
            <span>/</span>
            <span class="text-slate-300">{{ $service->title }}</span>
        </nav>

        <div class="mb-8">
            <span class="inline-block px-3.5 py-1.5 rounded-full text-xs font-bold {{ $service->group === 'media' ? 'bg-cyan-500/20 text-cyan-300' : 'bg-amber-500/20 text-amber-300' }} mb-4">
                {{ $service->group === 'media' ? 'Agency Truyền Thông' : 'Giải Pháp Công Nghệ' }}
            </span>
            <h1 class="text-3xl sm:text-5xl font-extrabold text-white tracking-tight leading-tight mb-4">
                {{ $service->title }}
            </h1>
            <p class="text-base text-slate-300 leading-relaxed font-light mb-8">
                {{ $service->summary }}
            </p>
        </div>

        <div class="glass-panel p-8 rounded-3xl prose prose-invert prose-cyan max-w-none text-slate-300 mb-12">
            {!! $service->content !!}
        </div>

        <!-- CTA Box -->
        <div class="glass-card p-8 rounded-3xl text-center border border-cyan-500/30">
            <h3 class="font-heading font-bold text-2xl text-white mb-2">Cần Tư Vấn Về {{ $service->title }}?</h3>
            <p class="text-sm text-slate-400 mb-6 max-w-xl mx-auto">Đội ngũ chuyên gia của Truyền Thông Cửu Long sẵn sàng hỗ trợ giải đáp và xây dựng bảng dự toán chi tiết.</p>
            <a href="{{ route('contact') }}" class="inline-block px-8 py-3.5 rounded-xl bg-gradient-to-r from-cyan-500 to-blue-600 text-white font-bold text-sm shadow-glow">
                Nhận Báo Giá Gói Dịch Vụ ⚡
            </a>
        </div>
    </div>
</div>
@endsection