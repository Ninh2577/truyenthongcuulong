@extends('layouts.app')

@section('title', ($post->meta_title ?: $post->title) . ' - Truyền Thông Cửu Long')
@section('meta_description', $post->meta_description ?: $post->summary)
@section('og_image', $post->thumbnail ? asset('storage/' . $post->thumbnail) : asset('storage/uploads/logo.png'))

@section('schema')
<!-- Schema JSON-LD Article -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Article",
  "headline": "{{ addslashes($post->title) }}",
  "image": [
    "{{ $post->thumbnail ? asset('storage/' . $post->thumbnail) : asset('storage/uploads/logo.png') }}"
  ],
  "datePublished": "{{ $post->published_at ? $post->published_at->toAtomString() : now()->toAtomString() }}",
  "dateModified": "{{ $post->updated_at ? $post->updated_at->toAtomString() : now()->toAtomString() }}",
  "author": {
    "@type": "Person",
    "name": "Truyền Thông Cửu Long"
  },
  "publisher": {
    "@type": "Organization",
    "name": "Truyền Thông Cửu Long",
    "logo": {
      "@type": "ImageObject",
      "url": "{{ asset('storage/uploads/logo.png') }}"
    }
  },
  "description": "{{ addslashes($post->summary) }}"
}
</script>

<!-- Schema BreadcrumbList -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [{
    "@type": "ListItem",
    "position": 1,
    "name": "Trang chủ",
    "item": "{{ route('home') }}"
  },{
    "@type": "ListItem",
    "position": 2,
    "name": "Kiến thức",
    "item": "{{ route('blog.index') }}"
  },{
    "@type": "ListItem",
    "position": 3,
    "name": "{{ addslashes($post->title) }}"
  }]
}
</script>
@endsection

@section('content')
<div class="pt-28 pb-20">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumbs -->
        <nav class="flex items-center gap-2 text-xs text-slate-400 mb-6 flex-wrap">
            <a href="{{ route('home') }}" class="hover:text-cyan-400">Trang chủ</a>
            <span>/</span>
            <a href="{{ route('blog.index') }}" class="hover:text-cyan-400">Kiến thức</a>
            @if($post->category)
            <span>/</span>
            <a href="{{ route('blog.category', $post->category->slug) }}" class="hover:text-cyan-400">{{ $post->category->name }}</a>
            @endif
            <span>/</span>
            <span class="text-slate-300 truncate max-w-xs">{{ $post->title }}</span>
        </nav>

        <!-- Article Header -->
        <div class="mb-8">
            @if($post->category)
            <span class="inline-block px-3.5 py-1.5 rounded-full text-xs font-bold bg-cyan-500/20 text-cyan-300 border border-cyan-500/30 mb-4">
                {{ $post->category->name }}
            </span>
            @endif
            <h1 class="text-2xl sm:text-4xl lg:text-5xl font-extrabold text-white tracking-tight leading-tight mb-4">
                {{ $post->title }}
            </h1>
            <div class="flex items-center gap-4 text-xs text-slate-400 pb-6 border-b border-white/10">
                <span>📅 {{ $post->published_at ? $post->published_at->format('d/m/Y H:i') : '' }}</span>
                <span>👁️ {{ $post->views }} lượt xem</span>
                <span>✍️ Tác giả: Truyền Thông Cửu Long</span>
            </div>
        </div>

        <!-- Featured Thumbnail -->
        @if($post->thumbnail)
        <div class="aspect-video w-full rounded-3xl overflow-hidden mb-10 shadow-glow border border-white/10">
            <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
        </div>
        @endif

        <!-- Table of Contents (TOC) Component -->
        @if(!empty($toc) && count($toc) > 1)
        <div class="glass-panel rounded-2xl p-6 mb-10 border border-cyan-500/20" x-data="{ expanded: true }">
            <div class="flex items-center justify-between cursor-pointer" @click="expanded = !expanded">
                <div class="flex items-center gap-2">
                    <span class="text-cyan-400 font-bold">📑</span>
                    <h2 class="font-heading font-bold text-white text-base">Mục Lục Bài Viết</h2>
                </div>
                <button class="text-xs text-cyan-400 hover:text-cyan-300 font-medium" x-text="expanded ? '[Thu gọn]' : '[Mở rộng]'"></button>
            </div>
            <ul x-show="expanded" x-collapse class="mt-4 space-y-2 text-sm text-slate-300">
                @foreach($toc as $item)
                <li class="{{ $item['level'] === 3 ? 'ml-5 text-xs text-slate-400' : 'font-medium' }}">
                    <a href="#{{ $item['anchor'] }}" class="hover:text-cyan-400 transition-colors">
                        {{ $item['title'] }}
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- Post Content (Prose Tailwind) -->
        <div class="prose prose-invert prose-cyan max-w-none text-slate-300 leading-relaxed text-base prose-headings:font-heading prose-headings:text-white prose-a:text-cyan-400 hover:prose-a:text-cyan-300 prose-img:rounded-2xl prose-img:border prose-img:border-white/10">
            {!! $post->content !!}
        </div>

        <!-- Author Box -->
        <div class="glass-card rounded-2xl p-6 sm:p-8 mt-12 flex flex-col sm:flex-row items-center gap-6 border border-white/10">
            <div class="w-20 h-20 rounded-2xl bg-gradient-to-tr from-cyan-500 to-blue-600 p-0.5 shrink-0">
                <div class="w-full h-full bg-[#0B132B] rounded-[14px] flex items-center justify-center font-heading font-black text-2xl text-cyan-400">
                    CL
                </div>
            </div>
            <div class="text-center sm:text-left">
                <div class="font-heading font-bold text-lg text-white mb-1">Ban Biên Tập Cửu Long Media</div>
                <p class="text-xs text-slate-400 leading-relaxed">
                    Chuyên gia sáng tạo nội dung truyền thông, giải pháp số và chiến lược phát triển thương hiệu thuộc Công Ty Truyền Thông Cửu Long.
                </p>
            </div>
        </div>

        <!-- Related Articles -->
        @if($relatedPosts->count() > 0)
        <div class="mt-16 pt-12 border-t border-white/10">
            <h3 class="font-heading font-bold text-2xl text-white mb-8">Bài Viết Liên Quan</h3>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                @foreach($relatedPosts as $rPost)
                <a href="{{ route('blog.show', $rPost->slug) }}" class="glass-card rounded-2xl p-4 group flex flex-col">
                    <div class="aspect-video rounded-xl bg-slate-800 overflow-hidden mb-3">
                        @if($rPost->thumbnail)
                        <img src="{{ asset('storage/' . $rPost->thumbnail) }}" alt="{{ $rPost->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform" loading="lazy">
                        @endif
                    </div>
                    <h4 class="font-heading font-semibold text-sm text-white group-hover:text-cyan-400 line-clamp-2 mb-2">
                        {{ $rPost->title }}
                    </h4>
                    <span class="text-[11px] text-slate-400 mt-auto">{{ $rPost->published_at ? $rPost->published_at->format('d/m/Y') : '' }}</span>
                </a>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>
@endsection