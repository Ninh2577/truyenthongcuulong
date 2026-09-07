@extends('layouts.app')

@section('title', 'Dự Án & Case Studies - Truyền Thông Cửu Long')
@section('meta_description', 'Tổng hợp các dự án Media, Video TVC và Giải pháp phần mềm, Website tiêu biểu do Truyền Thông Cửu Long thực hiện.')

@section('content')
<div class="pt-28 pb-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="text-xs font-bold text-cyan-400 uppercase tracking-widest block mb-2">Hồ Sơ Năng Lực Thực Chiến</span>
            <h1 class="text-3xl sm:text-5xl font-extrabold text-white mb-4">Dự Án Tiêu Biểu</h1>
            <p class="text-slate-400 text-sm sm:text-base">Mỗi dự án là một câu chuyện thành công được kiến tạo bởi tâm huyết, nghệ thuật và công nghệ hiện đại.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
            @forelse($caseStudies as $cs)
            <div class="glass-card rounded-3xl overflow-hidden flex flex-col group p-6">
                <div class="flex items-center justify-between mb-4">
                    <span class="px-3 py-1 rounded-full text-xs font-bold {{ $cs->group === 'media' ? 'bg-cyan-500/20 text-cyan-300' : 'bg-amber-500/20 text-amber-300' }}">
                        {{ $cs->group === 'media' ? 'Media & Truyền Thông' : 'Giải Pháp Công Nghệ' }}
                    </span>
                    <span class="text-xs text-slate-400 font-medium">Năm {{ $cs->year }}</span>
                </div>
                <h3 class="font-heading font-bold text-xl text-white group-hover:text-cyan-400 transition-colors mb-2">
                    <a href="{{ route('projects.show', $cs->slug) }}">{{ $cs->title }}</a>
                </h3>
                <div class="text-xs text-slate-400 mb-4">Khách hàng: <span class="text-slate-300">{{ $cs->client_name }}</span></div>
                <p class="text-xs text-slate-400 mb-6 leading-relaxed flex-grow">{{ $cs->summary }}</p>
                <a href="{{ route('projects.show', $cs->slug) }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-cyan-400 hover:text-cyan-300">
                    Xem chi tiết dự án &rarr;
                </a>
            </div>
            @empty
            <p class="text-slate-400 text-center col-span-2 py-12">Đang cập nhật các dự án mới...</p>
            @endforelse
        </div>
    </div>
</div>
@endsection