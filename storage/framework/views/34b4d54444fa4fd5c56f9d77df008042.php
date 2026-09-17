<section class="w-full bg-white py-12 lg:py-16 border-b border-slate-200/80 gsap-reveal-section" id="insights-section">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-10 lg:mb-12">
            <div class="max-w-2xl">
                <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-orange-100/70 text-primary font-mono text-xs font-bold border border-orange-200 mb-3">
                    <span class="material-symbols-outlined text-[16px]">menu_book</span>
                    <span>PRACTICAL INSIGHTS &amp; EXPERTISE</span>
                </div>
                <h2 class="font-headline text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-navy-base">
                    Bài Viết &amp; Kinh Nghiệm Thực Tế
                </h2>
                <p class="font-body text-slate-600 text-sm sm:text-base mt-2 leading-relaxed">
                    Chia sẻ kiến thức chuyên sâu về sản xuất video, kỹ thuật SEO Google, kiến trúc công nghệ web và chiến lược truyền thông số.
                </p>
            </div>

            <a href="<?php echo e(route('blog.index')); ?>" class="inline-flex items-center gap-2 text-xs sm:text-sm font-headline font-bold text-primary hover:text-orange-600 transition-colors self-start md:self-auto">
                <span>Xem tất cả bài viết</span>
                <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
            </a>
        </div>

        <!-- Articles Grid (Dynamic from Database) -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $featuredArticles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <article class="group flex flex-col rounded-3xl bg-slate-50 border border-slate-200/80 overflow-hidden hover:shadow-xl hover:border-primary/40 transition-all duration-300">
                <div class="h-48 w-full relative overflow-hidden bg-slate-200">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($article->thumbnail_url): ?>
                        <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" 
                             alt="<?php echo e($article->title); ?>" 
                             src="<?php echo e($article->thumbnail_url); ?>"
                             onerror="this.src='https://images.unsplash.com/photo-1432888498266-38ffec3eaf0a?auto=format&fit=crop&w=800&q=80'"/>
                    <?php else: ?>
                        <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" 
                             alt="<?php echo e($article->title); ?>" 
                             src="https://images.unsplash.com/photo-1432888498266-38ffec3eaf0a?auto=format&fit=crop&w=800&q=80"/>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <div class="absolute top-3 left-3">
                        <span class="px-2.5 py-0.5 rounded-full bg-black/60 backdrop-blur-md text-amber-300 font-mono text-[10px] font-bold border border-white/20">
                            <?php echo e($article->category->name ?? 'Kiến Thức Chuyên Ngành'); ?>

                        </span>
                    </div>
                </div>

                <div class="p-6 flex flex-col justify-between flex-1 gap-4">
                    <div>
                        <div class="flex items-center gap-2 text-[11px] font-mono text-slate-400 mb-2">
                            <span><?php echo e($article->published_at ? \Carbon\Carbon::parse($article->published_at)->format('d/m/Y') : 'Mới cập nhật'); ?></span>
                            <span>&bull;</span>
                            <span>Truyền Thông Cửu Long Editorial</span>
                        </div>
                        <h3 class="font-headline text-base sm:text-lg font-bold text-navy-base group-hover:text-primary transition-colors line-clamp-2">
                            <a href="<?php echo e(route('blog.resolve', $article->slug)); ?>">
                                <?php echo e($article->title); ?>

                            </a>
                        </h3>
                        <p class="font-body text-xs text-slate-600 mt-2 line-clamp-3 leading-relaxed">
                            <?php echo e($article->summary ?? \Illuminate\Support\Str::limit(strip_tags($article->content), 120)); ?>

                        </p>
                    </div>

                    <div class="pt-3 border-t border-slate-200/60 flex items-center justify-between text-xs font-headline font-bold text-primary">
                        <span>Đọc tiếp</span>
                        <span class="material-symbols-outlined text-[16px] group-hover:translate-x-1 transition-transform">arrow_forward</span>
                    </div>
                </div>
            </article>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col-span-3 py-12 text-center text-slate-500 font-mono text-sm">
                Đang cập nhật các bài viết mới từ hệ thống...
            </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </div>
</section><?php /**PATH C:\xampp\htdocs\truyenthongcuulong-laravel\resources\views/components/home/insights.blade.php ENDPATH**/ ?>