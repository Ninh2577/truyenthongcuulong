@extends('layouts.app')

@section('title', $caseStudy->title . ' - Truyền Thông Cửu Long')
@section('meta_description', $caseStudy->summary)

@section('content')
<div class="pt-28 pb-20">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex items-center gap-2 text-xs text-slate-400 mb-6">
            <a href="{{ route('home') }}" class="hover:text-cyan-400">Trang chủ</a>
            <span>/</span>
            <a href="{{ route('projects.index') }}" class="hover:text-cyan-400">Dự án</a>
            <span>/</span>
            <span class="text-slate-300">{{ $caseStudy->title }}</span>
        </nav>

        <div class="mb-8">
            <div class="flex items-center gap-3 mb-4">
                <span class="px-3 py-1 rounded-full text-xs font-bold {{ $caseStudy->group === 'media' ? 'bg-cyan-500/20 text-cyan-300' : 'bg-amber-500/20 text-amber-300' }}">
                    {{ $caseStudy->group === 'media' ? 'Media & Truyền Thông' : 'Giải Pháp Công Nghệ' }}
                </span>
                <span class="text-xs text-slate-400">Năm {{ $caseStudy->year }}</span>
            </div>
            <h1 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight mb-4">
                {{ $caseStudy->title }}
            </h1>
            <div class="text-sm text-slate-400">Đơn vị triển khai: <span class="text-cyan-400 font-medium">{{ $caseStudy->client_name }}</span></div>
        </div>

        <div class="glass-panel p-8 rounded-3xl prose prose-invert prose-cyan max-w-none text-slate-300 mb-12">
            <p class="text-base text-slate-200 leading-relaxed font-light">{{ $caseStudy->summary }}</p>
            {!! $caseStudy->content !!}
        </div>
    </div>
</div>
@endsection