<section class="w-full bg-[#f8fafc] py-14 lg:py-20 border-b border-slate-200/80 gsap-reveal-section" id="insights-section">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-10 lg:mb-12">
            <div class="max-w-2xl">
                <div class="flex items-center gap-2 text-xs sm:text-sm font-bold text-orange-600 tracking-wider uppercase mb-2.5 sm:mb-3">
                    <span class="material-symbols-outlined text-[18px] sm:text-[20px]" aria-hidden="true">menu_book</span>
                    <span>PRACTICAL INSIGHTS &amp; EXPERTISE</span>
                </div>
                <h2 class="font-headline text-3xl sm:text-4xl lg:text-[42px] font-black tracking-tight text-slate-900 leading-tight">
                    Bài Viết &amp; Kinh Nghiệm Thực Tế
                </h2>
                <p class="font-body text-slate-500 text-sm sm:text-base mt-2.5 sm:mt-3 leading-relaxed">
                    Chia sẻ kiến thức chuyên sâu về sản xuất video, kỹ thuật SEO Google, công nghệ web<br class="hidden sm:inline"> và chiến lược truyền thông số từ đội ngũ Truyền Thông Cửu Long.
                </p>
            </div>

            <a href="{{ route('blog.index') }}" class="inline-flex items-center gap-1.5 text-sm sm:text-base font-bold text-orange-600 hover:text-orange-700 transition-colors self-start md:self-end group mb-1 focus-visible:ring-2 focus-visible:ring-orange-500 focus-visible:outline-none rounded-lg p-1">
                <span>Xem tất cả bài viết</span>
                <span class="material-symbols-outlined text-[18px] group-hover:translate-x-1 transition-transform" aria-hidden="true">arrow_forward</span>
            </a>
        </div>

        @php
            $firstArticle = $featuredArticles->first();
            $secondaryArticles = $featuredArticles->slice(1, 2);
        @endphp

        <!-- Articles Grid (1 Featured Left Card + 2 Stacked Horizontal Right Cards) -->
        @if($firstArticle)
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-8 items-stretch">
            <!-- Left Column: Featured Article -->
            <article class="group bg-white rounded-2xl border border-slate-200/90 shadow-[0_2px_12px_rgba(0,0,0,0.03)] hover:shadow-lg hover:border-orange-500/30 transition-all duration-300 overflow-hidden flex flex-col justify-between h-full">
                <!-- Cover Image -->
                <a href="{{ route('blog.resolve', $firstArticle->slug) }}" class="block relative w-full aspect-[16/10] sm:aspect-[16/9] lg:aspect-[16/10] overflow-hidden bg-slate-100">
                    <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" 
                         alt="{{ html_entity_decode($firstArticle->title, ENT_QUOTES | ENT_HTML5, 'UTF-8') }}" 
                         loading="lazy"
                         decoding="async"
                         src="{{ $firstArticle->thumbnail_url ?: 'https://images.unsplash.com/photo-1432888498266-38ffec3eaf0a?auto=format&fit=crop&w=800&q=80' }}"
                         onerror="this.src='https://images.unsplash.com/photo-1432888498266-38ffec3eaf0a?auto=format&fit=crop&w=800&q=80'"/>
                </a>

                <!-- Card Content -->
                <div class="p-6 sm:p-7 flex flex-col justify-between flex-1 bg-white">
                    <div>
                        <!-- Meta: Date & Author -->
                        <div class="flex items-center gap-1.5 text-xs text-slate-500 font-medium">
                            <span class="material-symbols-outlined text-[15px] text-slate-400 shrink-0" aria-hidden="true">calendar_today</span>
                            <span class="shrink-0">{{ $firstArticle->published_at ? \Carbon\Carbon::parse($firstArticle->published_at)->format('d/m/Y') : now()->format('d/m/Y') }}</span>
                            <span class="text-slate-300">•</span>
                            <span class="material-symbols-outlined text-[16px] text-slate-400 shrink-0" aria-hidden="true">person</span>
                            <span class="truncate">Truyền Thông Cửu Long Editorial</span>
                        </div>

                        <!-- Title -->
                        <h3 class="text-xl sm:text-2xl font-bold text-slate-900 group-hover:text-orange-600 transition-colors mt-3 leading-snug line-clamp-2">
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
                                    : \Illuminate\Support\Str::limit(trim(preg_replace('/\s+/', ' ', strip_tags($firstArticle->content ?? ''))), 160));
                            $firstDesc = html_entity_decode($firstRawDesc, ENT_QUOTES | ENT_HTML5, 'UTF-8');
                            if (empty($firstDesc)) {
                                $firstDesc = 'Chia sẻ kiến thức chuyên sâu về sản xuất video, kỹ thuật SEO và giải pháp số từ đội ngũ Truyền Thông Cửu Long.';
                            }
                        @endphp
                        <p class="text-sm text-slate-500 line-clamp-3 leading-relaxed mt-2.5">
                            {{ $firstDesc }}
                        </p>
                    </div>

                    <!-- Action Link -->
                    <div class="mt-5 pt-2">
                        <a href="{{ route('blog.resolve', $firstArticle->slug) }}" class="inline-flex items-center gap-1.5 text-sm font-bold text-orange-600 hover:text-orange-700 group/link">
                            <span>Đọc bài viết</span>
                            <span class="material-symbols-outlined text-[16px] group-hover/link:translate-x-1 transition-transform" aria-hidden="true">arrow_forward</span>
                        </a>
                    </div>
                </div>
            </article>

            <!-- Right Column: 2 Stacked Horizontal Articles -->
            @if($secondaryArticles->isNotEmpty())
            <div class="flex flex-col gap-6 justify-between h-full">
                @foreach($secondaryArticles as $article)
                <article class="group bg-white rounded-2xl border border-slate-200/90 shadow-[0_2px_12px_rgba(0,0,0,0.03)] hover:shadow-lg hover:border-orange-500/30 transition-all duration-300 overflow-hidden flex flex-col sm:flex-row flex-1">
                    <!-- Thumbnail Image (Flush tràn viền, không khoảng trắng) -->
                    <a href="{{ route('blog.resolve', $article->slug) }}" class="block w-full sm:w-[46%] md:w-[45%] shrink-0 h-48 sm:h-auto min-h-[160px] relative overflow-hidden bg-slate-900/5">
                        <img class="w-full h-full object-cover object-left group-hover:scale-105 transition-transform duration-500" 
                             alt="{{ html_entity_decode($article->title, ENT_QUOTES | ENT_HTML5, 'UTF-8') }}" 
                             loading="lazy"
                             decoding="async"
                             src="{{ $article->thumbnail_url ?: 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=600&q=80' }}"
                             onerror="this.src='https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=600&q=80'"/>
                    </a>

                    <!-- Card Content -->
                    <div class="p-5 sm:p-6 flex flex-col justify-between flex-1 bg-white min-w-0">
                        <div>
                            <!-- Meta: Date & Author -->
                            <div class="flex items-center gap-1.5 text-xs text-slate-500 font-medium">
                                <span class="material-symbols-outlined text-[14px] text-slate-400 shrink-0" aria-hidden="true">calendar_today</span>
                                <span class="shrink-0">{{ $article->published_at ? \Carbon\Carbon::parse($article->published_at)->format('d/m/Y') : now()->format('d/m/Y') }}</span>
                                <span class="text-slate-300">•</span>
                                <span class="material-symbols-outlined text-[15px] text-slate-400 shrink-0" aria-hidden="true">person</span>
                                <span class="truncate">Truyền Thông Cửu Long Editorial</span>
                            </div>

                            <!-- Title -->
                            <h3 class="text-base sm:text-lg font-bold text-slate-900 group-hover:text-orange-600 transition-colors mt-2.5 leading-snug line-clamp-2">
                                <a href="{{ route('blog.resolve', $article->slug) }}">
                                    {{ html_entity_decode($article->title, ENT_QUOTES | ENT_HTML5, 'UTF-8') }}
                                </a>
                            </h3>

                            <!-- Excerpt -->
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
                            <p class="text-xs sm:text-sm text-slate-500 line-clamp-2 leading-relaxed mt-2">
                                {{ $articleDesc }}
                            </p>
                        </div>

                        <!-- Action Link -->
                        <div class="mt-4 pt-1">
                            <a href="{{ route('blog.resolve', $article->slug) }}" class="inline-flex items-center gap-1.5 text-xs sm:text-sm font-bold text-orange-600 hover:text-orange-700 group/link">
                                <span>Đọc bài viết</span>
                                <span class="material-symbols-outlined text-[16px] group-hover/link:translate-x-1 transition-transform" aria-hidden="true">arrow_forward</span>
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