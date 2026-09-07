@extends('layouts.app')

@section('title', 'Chuyên mục: ' . $category->name . ' - Truyền Thông Cửu Long')
@section('meta_description', $category->description ?: 'Tất cả bài viết thuộc chuyên mục ' . $category->name . ' trên website Truyền Thông Cửu Long.')

@section('content')
<div class="pt-28 pb-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Category Header -->
        <div class="text-center max-w-3xl mx-auto mb-12">
            <span class="text-xs font-bold text-cyan-400 uppercase tracking-widest block mb-2">Chuyên Mục</span>
            <h1 class="text-3xl sm:text-5xl font-extrabold text-white mb-4">{{ $category->name }}</h1>
            @if($category->description)
            <p class="text-slate-400 text-sm sm:text-base">{{ $category->description }}</p>
            @endif
        </div>

        <!-- Posts Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
            @forelse($posts as $post)
            <article class="glass-card rounded-2xl overflow-hidden flex flex-col group">
                <a href="{{ route('blog.show', $post->slug) }}" class="block aspect-video bg-slate-800 relative overflow-hidden">
                    @if($post->thumbnail)
                        <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy">
                    @else
                        <div class="w-full h-full flex items-center justify-center bg-gradient-to-tr from-slate-900 to-slate-800 text-slate-500">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                        </div>
                    @endif
                </a>
                <div class="p-6 flex flex-col flex-grow">
                    <div class="text-xs text-slate-400 mb-2">
                        {{ $post->published_at ? $post->published_at->format('d/m/Y') : '' }} • {{ $post->views }} lượt xem
                    </div>
                    <h3 class="font-heading font-bold text-lg text-white group-hover:text-cyan-400 transition-colors line-clamp-2 mb-3">
                        <a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
                    </h3>
                    <p class="text-xs text-slate-400 line-clamp-3 mb-4 leading-relaxed flex-grow">
                        {{ $post->summary }}
                    </p>
                    <a href="{{ route('blog.show', $post->slug) }}" class="text-xs font-semibold text-cyan-400 hover:text-cyan-300 flex items-center gap-1">
                        Đọc tiếp &rarr;
                    </a>
                </div>
            </article>
            @empty
            <div class="col-span-3 text-center py-16 glass-panel rounded-3xl">
                <p class="text-slate-400 text-base">Chưa có bài viết trong chuyên mục này.</p>
            </div>
            @endforelse
        </div>

        <div class="mt-8">
            {{ $posts->links() }}
        </div>
    </div>
</div>
@endsection