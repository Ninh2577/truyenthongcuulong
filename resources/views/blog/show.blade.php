@extends('layouts.app')

@section('title', ($post->meta_title ?: $post->title) . ' - Truyền Thông Cửu Long')
@section('meta_description', $post->meta_description ?: $post->summary)
@section('og_image', $post->thumbnail ? asset('storage/' . $post->thumbnail) : 'https://lh3.googleusercontent.com/aida/AEtjO1XFwX4HiQFmIiEoAWVzpyEesCWg-s3cW3_OywD-F4P2K6Ihv0FahvOINcwcDs5UYQ_y59TDDy5L5oB6SJndgCTfG4ajjq19W5C55BJfgOAAsK0ncT6ENswBz7W0Cujm6FKLHyDupQNpHhHONPunFiGdBNNQBaPpLYn4RZLhthR_kyx8X3ASC5uoOW2e19gEc8TdFIzSv9FVSu_QbQ4A3DkxVIY3Ucoocwzt26ZMrG5mc7CiH24dQCMDS5o')

@section('schema')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Article",
  "headline": "{{ addslashes($post->title) }}",
  "image": [
    "{{ $post->thumbnail ? asset('storage/' . $post->thumbnail) : 'https://truyenthongcuulong.com/logo.png' }}"
  ],
  "datePublished": "{{ $post->published_at ? $post->published_at->toAtomString() : now()->toAtomString() }}",
  "dateModified": "{{ $post->updated_at ? $post->updated_at->toAtomString() : now()->toAtomString() }}",
  "author": {
    "@type": "Organization",
    "name": "Truyền Thông Cửu Long"
  },
  "publisher": {
    "@type": "Organization",
    "name": "Truyền Thông Cửu Long",
    "logo": {
      "@type": "ImageObject",
      "url": "https://truyenthongcuulong.com/logo.png"
    }
  },
  "description": "{{ addslashes($post->summary) }}"
}
</script>

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
    "name": "Tạp chí",
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
<!-- Scroll Reading Progress Bar -->
<div id="reading-progress-bar" class="fixed top-20 left-0 h-1 bg-gradient-to-r from-primary via-orange-500 to-accent-amber z-50 transition-all duration-75 w-0"></div>

<div class="w-full bg-surface bg-dot-grid-subtle pt-28 pb-20 border-b border-slate-200/60">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Breadcrumb -->
        <nav class="flex items-center gap-2 text-xs font-headline text-slate-500 mb-6 flex-wrap">
            <a href="{{ route('home') }}" class="hover:text-primary transition-colors">Trang chủ</a>
            <span>/</span>
            <a href="{{ route('blog.index') }}" class="hover:text-primary transition-colors">Tạp chí</a>
            @if($post->category)
            <span>/</span>
            <a href="{{ route('blog.category', $post->category->slug) }}" class="hover:text-primary transition-colors">{{ $post->category->name }}</a>
            @endif
            <span>/</span>
            <span class="text-navy-base font-bold truncate max-w-xs">{{ $post->title }}</span>
        </nav>

        <!-- Article Header -->
        <div class="flex flex-col gap-4 mb-8">
            @if($post->category)
            <div class="flex items-center gap-2">
                <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full text-xs font-mono font-bold bg-orange-100 text-primary border border-orange-300 w-fit">
                    <span class="w-1.5 h-1.5 rounded-full bg-primary"></span>
                    {{ $post->category->name }}
                </span>
                @if($post->category->pillar_group)
                <span class="text-[10px] font-mono uppercase tracking-widest text-slate-400 bg-slate-100 px-2 py-0.5 rounded-full">
                    PILLAR: {{ strtoupper($post->category->pillar_group) }}
                </span>
                @endif
            </div>
            @endif

            <h1 class="font-headline text-3xl sm:text-4xl lg:text-[44px] lg:leading-[52px] font-black text-navy-base tracking-tight">
                {{ $post->title }}
            </h1>

            <div class="flex flex-wrap items-center justify-between gap-4 py-4 border-y border-slate-200 text-xs font-mono text-slate-500">
                <div class="flex items-center gap-4 flex-wrap">
                    <span class="flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-[16px] text-primary">calendar_today</span>
                        {{ $post->published_at ? $post->published_at->format('d/m/Y H:i') : '' }}
                    </span>
                    <span class="flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-[16px] text-primary">visibility</span>
                        {{ $post->views }} lượt xem
                    </span>
                    <span class="flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-[16px] text-primary">verified_user</span>
                        Ban Biên Tập Truyền Thông Cửu Long
                    </span>
                </div>

                <!-- Social Share Icons Top -->
                <div class="flex items-center gap-2">
                    <span class="text-[11px] text-slate-400">Chia sẻ:</span>
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" rel="noopener noreferrer" 
                        class="w-7 h-7 rounded-full bg-slate-100 hover:bg-blue-600 hover:text-white flex items-center justify-center text-slate-600 transition-colors shadow-2xs" title="Chia sẻ Facebook">
                        <span class="text-[11px] font-bold">f</span>
                    </a>
                    <a href="https://zalo.me/share?url={{ urlencode(url()->current()) }}" target="_blank" rel="noopener noreferrer" 
                        class="w-7 h-7 rounded-full bg-slate-100 hover:bg-sky-500 hover:text-white flex items-center justify-center text-slate-600 transition-colors shadow-2xs" title="Chia sẻ Zalo">
                        <span class="text-[10px] font-bold">Z</span>
                    </a>
                    <button onclick="navigator.clipboard.writeText(window.location.href); alert('Đã sao chép liên kết vào clipboard!');" 
                        class="w-7 h-7 rounded-full bg-slate-100 hover:bg-orange-500 hover:text-white flex items-center justify-center text-slate-600 transition-colors shadow-2xs" title="Sao chép link">
                        <span class="material-symbols-outlined text-[14px]">link</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Featured Thumbnail -->
        @if($post->thumbnail)
        <div class="aspect-video w-full rounded-3xl overflow-hidden mb-10 shadow-lg border border-slate-200 bg-black">
            <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
        </div>
        @endif

        <!-- Summary Lead Paragraph -->
        @if($post->summary)
        <div class="p-6 rounded-2xl bg-orange-50/80 border-l-4 border-primary mb-10 text-navy-base font-body text-base leading-relaxed font-medium">
            {{ $post->summary }}
        </div>
        @endif

        <!-- Table of Contents (TOC) Component -->
        @if(!empty($toc) && count($toc) > 1)
        <div class="rounded-3xl p-6 sm:p-7 mb-12 bg-white border-2 border-orange-200/80 shadow-xs" x-data="{ expanded: true }">
            <div class="flex items-center justify-between cursor-pointer" @click="expanded = !expanded">
                <div class="flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-xl bg-orange-100 text-primary flex items-center justify-center">
                        <span class="material-symbols-outlined text-[18px]">format_list_bulleted</span>
                    </div>
                    <h2 class="font-headline font-bold text-navy-base text-base">Mục Lục Bài Viết</h2>
                </div>
                <button class="text-xs font-mono font-bold text-primary hover:text-primary-hover transition-colors" x-text="expanded ? '[ Thu gọn ]' : '[ Mở rộng ]'"></button>
            </div>
            <ul x-show="expanded" x-collapse class="mt-5 space-y-2.5 text-sm font-body border-t border-slate-100 pt-4">
                @foreach($toc as $item)
                <li class="{{ $item['level'] === 3 ? 'ml-6 text-xs text-slate-500' : 'font-semibold text-slate-800' }}">
                    <a href="#{{ $item['anchor'] }}" class="hover:text-primary transition-colors flex items-center gap-1.5">
                        <span class="text-primary text-[12px]">•</span>
                        <span>{{ $item['title'] }}</span>
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- Article Main Content Prose -->
        <article class="prose prose-slate max-w-none text-slate-700 leading-relaxed text-base font-body
            prose-headings:font-headline prose-headings:font-bold prose-headings:text-navy-base prose-headings:tracking-tight
            prose-h2:text-2xl prose-h2:mt-10 prose-h2:mb-4 prose-h2:pb-2 prose-h2:border-b prose-h2:border-slate-200
            prose-h3:text-xl prose-h3:mt-8 prose-h3:mb-3
            prose-a:text-primary hover:prose-a:text-primary-hover prose-a:font-semibold
            prose-img:rounded-2xl prose-img:shadow-md prose-img:border prose-img:border-slate-200 prose-img:mx-auto
            prose-blockquote:border-l-4 prose-blockquote:border-primary prose-blockquote:bg-orange-50/50 prose-blockquote:py-2 prose-blockquote:px-4 prose-blockquote:rounded-r-xl prose-blockquote:font-normal prose-blockquote:italic
            prose-code:font-mono prose-code:text-primary prose-code:bg-orange-50 prose-code:px-1.5 prose-code:py-0.5 prose-code:rounded prose-code:text-xs">
            {!! $post->content !!}
        </article>

        <!-- Social Share Bottom Bar -->
        <div class="mt-12 pt-6 border-t border-slate-200 flex flex-wrap items-center justify-between gap-4">
            <div class="flex items-center gap-2">
                <span class="font-headline text-xs font-bold text-navy-base">Chia sẻ bài viết này:</span>
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" rel="noopener noreferrer" 
                    class="px-3.5 py-1.5 rounded-full bg-[#1877f2] text-white text-xs font-bold flex items-center gap-1.5 hover:opacity-90 transition-opacity">
                    <span>Facebook</span>
                </a>
                <a href="https://zalo.me/share?url={{ urlencode(url()->current()) }}" target="_blank" rel="noopener noreferrer" 
                    class="px-3.5 py-1.5 rounded-full bg-[#0068ff] text-white text-xs font-bold flex items-center gap-1.5 hover:opacity-90 transition-opacity">
                    <span>Zalo</span>
                </a>
                <button onclick="navigator.clipboard.writeText(window.location.href); alert('Đã sao chép liên kết bài viết!');" 
                    class="px-3.5 py-1.5 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold flex items-center gap-1 transition-colors">
                    <span class="material-symbols-outlined text-[14px]">content_copy</span>
                    <span>Sao chép link</span>
                </button>
            </div>
            <a href="{{ route('blog.index') }}" class="text-xs font-headline font-bold text-primary hover:underline flex items-center gap-1">
                <span class="material-symbols-outlined text-[16px]">arrow_back</span>
                <span>Quay lại tạp chí</span>
            </a>
        </div>

        <!-- Author Editorial Box -->
        <div class="rounded-3xl p-7 sm:p-8 mt-12 bg-white border border-slate-200/90 shadow-sm flex flex-col sm:flex-row items-center gap-6">
            <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-primary via-orange-500 to-accent-amber p-1 shrink-0 shadow-md">
                <div class="w-full h-full bg-navy-base rounded-[12px] flex items-center justify-center font-headline font-black text-xl text-white">
                    CLM
                </div>
            </div>
            <div class="text-center sm:text-left flex flex-col gap-1.5">
                <div class="flex items-center justify-center sm:justify-start gap-2">
                    <h3 class="font-headline font-bold text-base text-navy-base">Ban Biên Tập Truyền Thông Cửu Long</h3>
                    <span class="material-symbols-outlined text-primary text-[18px]">verified</span>
                </div>
                <p class="font-body text-xs text-slate-500 leading-relaxed">
                    Hội đồng chuyên môn gồm các đạo diễn hình ảnh, kỹ sư phần mềm cao cấp và chuyên gia tư vấn chiến dịch truyền thông tại Tổ Hợp Truyền Thông Cửu Long.
                </p>
            </div>
        </div>

        <!-- Consultation Quick Form CTA Box -->
        <div class="mt-12 rounded-3xl p-8 bg-gradient-to-br from-navy-base via-navy-surface to-navy-card text-white border border-white/10 shadow-xl flex flex-col md:flex-row items-center justify-between gap-8 relative overflow-hidden">
            <div class="absolute -right-20 -bottom-20 w-64 h-64 rounded-full bg-primary/25 blur-3xl pointer-events-none"></div>
            <div class="flex flex-col gap-2.5 max-w-md relative z-10 text-center md:text-left">
                <span class="font-mono text-xs text-accent-amber font-bold uppercase tracking-widest">TƯ VẤN TRỰC TIẾP 1:1</span>
                <h3 class="font-headline text-2xl font-bold text-white leading-tight">
                    Ứng Dụng Giải Pháp Này Cho Doanh Nghiệp Của Bạn?
                </h3>
                <p class="font-body text-xs text-slate-300 leading-relaxed">
                    Liên hệ ngay với đội ngũ chuyên gia Truyền Thông Cửu Long để nhận bản phân tích hiện trạng và báo giá triển khai tối ưu.
                </p>
            </div>
            <form action="{{ route('contact.submit') }}" method="POST" class="w-full md:w-72 flex flex-col gap-2.5 relative z-10 shrink-0">
                @csrf
                <input type="text" name="name" placeholder="Họ và tên của bạn" required class="w-full px-3.5 py-2.5 rounded-xl bg-white/10 text-white placeholder:text-slate-400 text-xs border border-white/10 focus:outline-none focus:ring-2 focus:ring-primary">
                <input type="tel" name="phone" placeholder="Số điện thoại liên hệ" required class="w-full px-3.5 py-2.5 rounded-xl bg-white/10 text-white placeholder:text-slate-400 text-xs border border-white/10 focus:outline-none focus:ring-2 focus:ring-primary">
                <input type="hidden" name="message" value="Yêu cầu tư vấn từ bài viết: {{ $post->title }}">
                <button type="submit" class="w-full py-3 rounded-xl bg-gradient-to-r from-primary to-accent-amber text-white font-headline text-xs font-bold hover:brightness-110 shadow-md transition-all">
                    Gửi Yêu Cầu Tư Vấn Ngay
                </button>
            </form>
        </div>

        <!-- Related Articles Carousel/Grid -->
        @if($relatedPosts->count() > 0)
        <div class="mt-16 pt-12 border-t border-slate-200">
            <div class="flex items-center justify-between mb-8">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary text-[22px]">auto_stories</span>
                    <h3 class="font-headline font-extrabold text-2xl text-navy-base">Bài Viết Cùng Chủ Đề</h3>
                </div>
                <a href="{{ route('blog.index') }}" class="text-xs font-headline font-bold text-primary hover:underline flex items-center gap-1">
                    <span>Xem thêm</span>
                    <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($relatedPosts as $rPost)
                <a href="{{ route('blog.show', $rPost->slug) }}" class="group rounded-2xl overflow-hidden bg-white border border-slate-200 hover:shadow-lg hover:border-orange-300 transition-all flex flex-col">
                    <div class="aspect-video bg-slate-100 overflow-hidden relative shrink-0">
                        @if($rPost->thumbnail)
                        <img src="{{ asset('storage/' . $rPost->thumbnail) }}" alt="{{ $rPost->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy">
                        @else
                        <div class="w-full h-full flex items-center justify-center bg-slate-100 text-slate-400">
                            <span class="material-symbols-outlined text-2xl">article</span>
                        </div>
                        @endif
                    </div>
                    <div class="p-4 flex flex-col justify-between flex-1 gap-2">
                        <h4 class="font-headline font-bold text-xs text-navy-base group-hover:text-primary transition-colors line-clamp-2 leading-snug">
                            {{ $rPost->title }}
                        </h4>
                        <div class="flex items-center justify-between text-[10px] font-mono text-slate-400 pt-2 border-t border-slate-100 mt-auto">
                            <span>{{ $rPost->published_at ? $rPost->published_at->format('d/m/Y') : '' }}</span>
                            <span>{{ $rPost->views }} views</span>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif

    </div>
</div>

<script>
    // Pure JS Reading Progress Bar
    window.addEventListener('scroll', function() {
        const winScroll = document.body.scrollTop || document.documentElement.scrollTop;
        const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        const scrolled = (winScroll / height) * 100;
        const progressBar = document.getElementById('reading-progress-bar');
        if (progressBar) {
            progressBar.style.width = scrolled + '%';
        }
    });
</script>
@endsection
