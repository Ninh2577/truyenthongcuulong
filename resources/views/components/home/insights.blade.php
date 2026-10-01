<section class="w-full bg-[#fcfdfe] py-14 lg:py-20 border-b border-slate-200/80 gsap-reveal-section relative overflow-hidden" id="insights-section">
    <!-- Subtle warm glow background accent -->
    <div class="absolute -top-32 -right-32 w-80 h-80 bg-orange-100/40 rounded-full blur-3xl pointer-events-none -z-10"></div>

    <style>
        .insight-hero-card {
            background-color: #060B14 !important;
        }
        @media (min-width: 640px) {
            .insight-thumb-box {
                width: 160px !important;
                min-width: 160px !important;
                max-width: 160px !important;
                height: 125px !important;
                flex-shrink: 0 !important;
            }
        }
        @media (max-width: 639px) {
            .insight-thumb-box {
                width: 100% !important;
                height: 160px !important;
                flex-shrink: 0 !important;
            }
        }
    </style>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-10 lg:mb-12">
            <div class="max-w-2xl">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-[#FFF5EE] text-[#ff5500] font-bold text-xs sm:text-[13px] tracking-wider uppercase mb-3 border border-orange-200/50">
                    <span class="material-symbols-outlined text-[17px] text-[#ff5500]" aria-hidden="true">menu_book</span>
                    <span>BÀI VIẾT &amp; KINH NGHIỆM THỰC TẾ</span>
                </div>
                <h2 class="font-headline text-3xl sm:text-4xl lg:text-[42px] font-black tracking-tight text-[#0B132A] leading-tight">
                    Bài Viết &amp; Kinh Nghiệm <span class="text-[#ff5500]">Thực Tế</span>
                </h2>
                <p class="font-body text-slate-500 text-sm sm:text-base mt-2.5 sm:mt-3 leading-relaxed">
                    Chia sẻ kiến thức chuyên sâu về sản xuất video, kỹ thuật SEO Google, công nghệ web<br class="hidden sm:inline"> và chiến lược truyền thông số từ đội ngũ Truyền Thông Cửu Long.
                </p>
            </div>

            <a href="{{ route('blog.index') }}" class="group inline-flex items-center gap-2 text-sm sm:text-base font-bold text-[#ff5500] hover:text-[#e04b00] transition-colors self-start md:self-end mb-1 focus-visible:ring-2 focus-visible:ring-[#ff5500] focus-visible:outline-none rounded-lg p-1">
                <span>Xem tất cả bài viết</span>
                <span class="w-8 h-8 rounded-full border border-[#ff5500] text-[#ff5500] inline-flex items-center justify-center font-bold text-sm group-hover:bg-[#ff5500] group-hover:text-white transition-all duration-300">
                    &rarr;
                </span>
            </a>
        </div>

        @php
            $firstArticle = $featuredArticles->first();
            $secondaryArticles = $featuredArticles->slice(1, 2);
        @endphp

        <!-- Articles Grid -->
        @if($firstArticle)
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-stretch">
            
            <!-- ==================== LEFT: FEATURED HERO ARTICLE (Col 7) ==================== -->
            <article class="lg:col-span-7 group relative rounded-2xl sm:rounded-3xl overflow-hidden border border-slate-800 shadow-[0_4px_24px_rgba(0,0,0,0.15)] hover:shadow-[0_16px_40px_rgba(0,0,0,0.25)] transition-all duration-500 insight-hero-card">
                
                <div class="grid grid-cols-1 md:grid-cols-12 h-full">
                    <!-- Left text area (7 cols on desktop) -->
                    <div class="p-6 sm:p-7 lg:p-8 flex flex-col justify-between z-10 md:col-span-7">
                        <div>
                            <!-- Category Badge -->
                            <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-[#ff5500] text-white text-xs font-bold uppercase tracking-wider mb-4 shadow-sm self-start">
                                <span class="material-symbols-outlined text-[15px] leading-none">local_fire_department</span>
                                <span>{{ $firstArticle->category->name ?? 'KIẾN THỨC' }}</span>
                            </div>

                            <!-- Meta: Date & Author -->
                            <div class="flex items-center gap-2 text-xs text-slate-400 font-medium mb-3">
                                <span class="material-symbols-outlined text-[15px] text-slate-400" aria-hidden="true">calendar_today</span>
                                <span>{{ $firstArticle->published_at ? \Carbon\Carbon::parse($firstArticle->published_at)->format('d/m/Y') : now()->format('d/m/Y') }}</span>
                                <span class="text-slate-600">•</span>
                                <span class="material-symbols-outlined text-[16px] text-slate-400" aria-hidden="true">person</span>
                                <span class="truncate">{{ $firstArticle->author->name ?? 'Truyền Thông Cửu Long' }}</span>
                            </div>

                            <!-- Title -->
                            <h3 class="text-xl sm:text-2xl font-black text-white leading-tight tracking-tight mb-3 group-hover:text-orange-200 transition-colors">
                                <a href="{{ route('blog.resolve', $firstArticle->slug) }}">
                                    {{ html_entity_decode($firstArticle->title, ENT_QUOTES | ENT_HTML5, 'UTF-8') }}
                                </a>
                            </h3>

                            <!-- Excerpt -->
                            @php
                                $firstRawDesc = !empty(trim($firstArticle->summary ?? ''))
                                    ? trim($firstArticle->summary)
                                    : (!empty(trim($firstArticle->meta_description ?? ''))
                                        ? trim($firstArticle->meta_description)
                                        : \Illuminate\Support\Str::limit(trim(preg_replace('/\s+/', ' ', strip_tags($firstArticle->content ?? ''))), 150));
                                $firstDesc = html_entity_decode($firstRawDesc, ENT_QUOTES | ENT_HTML5, 'UTF-8');
                                if (empty($firstDesc)) {
                                    $firstDesc = 'Chia sẻ kiến thức chuyên sâu và kinh nghiệm thực chiến từ chuyên gia Cửu Long.';
                                }
                            @endphp
                            <p class="text-xs sm:text-[13px] text-slate-300/80 leading-relaxed line-clamp-3 mb-6 font-normal">
                                {{ $firstDesc }}
                            </p>
                        </div>

                        <!-- Button -->
                        <div class="pt-2">
                            <a href="{{ route('blog.resolve', $firstArticle->slug) }}" 
                               class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-[#ff5500] hover:bg-[#e04b00] text-white font-bold text-xs sm:text-sm shadow-md shadow-orange-500/30 transition-all duration-300 hover:scale-[1.02] self-start group/btn">
                                <span>Đọc toàn bộ bài viết</span>
                                <span class="font-bold select-none group-hover/btn:translate-x-1 transition-transform">&rarr;</span>
                            </a>
                        </div>
                    </div>

                    <!-- Right visual area (5 cols on desktop) -->
                    <div class="relative md:col-span-5 min-h-[220px] md:min-h-full overflow-hidden flex items-center justify-center insight-hero-card">
                        <img class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-700 ease-out" 
                             alt="{{ html_entity_decode($firstArticle->title, ENT_QUOTES | ENT_HTML5, 'UTF-8') }}" 
                             loading="lazy"
                             src="{{ $firstArticle->thumbnail_url ?: 'https://images.unsplash.com/photo-1432888498266-38ffec3eaf0a?auto=format&fit=crop&w=1000&q=80' }}"
                             onerror="this.src='https://images.unsplash.com/photo-1432888498266-38ffec3eaf0a?auto=format&fit=crop&w=1000&q=80'">
                        <!-- Gradient mask to blend left into card background seamlessly -->
                        <div class="absolute inset-0 bg-gradient-to-t md:bg-gradient-to-r from-[#060B14] via-[#060B14]/40 to-transparent pointer-events-none"></div>
                    </div>
                </div>
            </article>

            <!-- ==================== RIGHT: 2 SECONDARY CARDS (Col 5) ==================== -->
            @if($secondaryArticles->isNotEmpty())
            <div class="lg:col-span-5 flex flex-col gap-5 justify-between h-full">
                @foreach($secondaryArticles as $index => $article)
                @php
                    $secondRawDesc = !empty(trim($article->summary ?? ''))
                        ? trim($article->summary)
                        : (!empty(trim($article->meta_description ?? ''))
                            ? trim($article->meta_description)
                            : \Illuminate\Support\Str::limit(trim(preg_replace('/\s+/', ' ', strip_tags($article->content ?? ''))), 120));
                    $articleDesc = html_entity_decode($secondRawDesc, ENT_QUOTES | ENT_HTML5, 'UTF-8');
                    if (empty($articleDesc)) {
                        $articleDesc = 'Chia sẻ kiến thức chuyên sâu và kinh nghiệm thực chiến từ chuyên gia Cửu Long.';
                    }
                @endphp
                <article class="group bg-white rounded-2xl border border-slate-200/90 shadow-[0_2px_12px_rgba(0,0,0,0.03)] hover:shadow-xl hover:border-orange-500/30 transition-all duration-300 p-4 sm:p-5 flex flex-col sm:flex-row gap-4 sm:gap-5 items-stretch">
                    
                    <!-- Thumbnail with bulletproof responsive sizing -->
                    <a href="{{ route('blog.resolve', $article->slug) }}" 
                       class="block insight-thumb-box rounded-xl overflow-hidden relative shadow-2xs border border-slate-100 bg-slate-900">
                        <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" 
                             alt="{{ html_entity_decode($article->title, ENT_QUOTES | ENT_HTML5, 'UTF-8') }}" 
                             loading="lazy"
                             src="{{ $article->thumbnail_url ?: 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=600&q=80' }}"
                             onerror="this.src='https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=600&q=80'"/>
                        
                        <div class="absolute top-2 left-2 px-2.5 py-0.5 rounded-full bg-[#ff5500] text-white text-[10px] font-bold uppercase tracking-wider shadow-sm">
                            {{ $article->category->name ?? 'BÀI VIẾT' }}
                        </div>
                    </a>

                    <!-- Content -->
                    <div class="flex-1 min-w-0 flex flex-col justify-between py-0.5">
                        <div>
                            <!-- Meta: Date & Read Time -->
                            <div class="flex items-center gap-1.5 text-xs text-slate-400 font-medium mb-1.5">
                                <span class="material-symbols-outlined text-[14px] text-slate-400" aria-hidden="true">calendar_today</span>
                                <span>{{ $article->published_at ? \Carbon\Carbon::parse($article->published_at)->format('d/m/Y') : now()->format('d/m/Y') }}</span>
                                <span>•</span>
                                <span>{{ $loop->first ? '4' : '5' }} phút đọc</span>
                            </div>

                            <!-- Title -->
                            <h4 class="font-headline text-[14.5px] sm:text-[15.5px] font-bold text-[#0B132A] group-hover:text-[#ff5500] transition-colors leading-snug line-clamp-2 mb-1.5">
                                <a href="{{ route('blog.resolve', $article->slug) }}">
                                    {{ html_entity_decode($article->title, ENT_QUOTES | ENT_HTML5, 'UTF-8') }}
                                </a>
                            </h4>

                            <!-- Excerpt -->
                            <p class="font-body text-xs text-slate-500 leading-relaxed line-clamp-2 mb-2 font-normal">
                                {{ $articleDesc }}
                            </p>
                        </div>

                        <!-- Action Link -->
                        <div class="pt-1">
                            <a href="{{ route('blog.resolve', $article->slug) }}" class="inline-flex items-center gap-1 text-xs font-bold text-[#ff5500] hover:text-[#e04b00] group/link">
                                <span>Đọc bài viết</span>
                                <span class="font-bold select-none group-hover/link:translate-x-1 transition-transform">&rarr;</span>
                            </a>
                        </div>
                    </div>
                </article>
                @endforeach
            </div>
            @endif

        </div>
        @else
        <!-- Empty State -->
        <div class="py-16 text-center text-slate-500 font-mono text-sm bg-white rounded-2xl border border-slate-200">
            Đang cập nhật các bài viết mới từ hệ thống...
        </div>
        @endif
    </div>
</section>