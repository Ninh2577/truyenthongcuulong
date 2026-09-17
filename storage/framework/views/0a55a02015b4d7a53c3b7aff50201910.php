<?php $__env->startSection('title', 'Chuyên mục: ' . $category->name . ' - Truyền Thông Cửu Long'); ?>
<?php $__env->startSection('meta_description', $category->description ?: 'Tất cả bài viết và tài liệu chuyên sâu thuộc chuyên mục ' . $category->name . ' trên Truyền Thông Cửu Long.'); ?>

<?php $__env->startSection('content'); ?>
<div class="w-full bg-surface bg-dot-grid-subtle pt-28 pb-20 border-b border-slate-200/60">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Breadcrumb -->
        <nav class="flex items-center gap-2 text-xs font-headline text-slate-500 mb-6">
            <a href="<?php echo e(route('home')); ?>" class="hover:text-primary transition-colors">Trang chủ</a>
            <span>/</span>
            <a href="<?php echo e(route('blog.index')); ?>" class="hover:text-primary transition-colors">Tạp chí</a>
            <span>/</span>
            <span class="text-navy-base font-bold"><?php echo e($category->name); ?></span>
        </nav>

        <!-- Category Hero Header -->
        <div class="p-8 sm:p-10 rounded-3xl bg-navy-base text-white border border-slate-700/80 shadow-lg mb-12 flex flex-col md:flex-row md:items-center justify-between gap-6 relative overflow-hidden">
            <div class="absolute -right-16 -top-16 w-60 h-60 rounded-full bg-primary/20 blur-3xl pointer-events-none"></div>
            <div class="flex flex-col gap-3 max-w-2xl relative z-10">
                <div class="flex items-center gap-2">
                    <span class="font-mono text-xs text-accent-amber font-bold uppercase tracking-wider">CHUYÊN MỤC CHỦ ĐỀ</span>
                    <span class="text-[10px] font-mono bg-white/10 px-2.5 py-0.5 rounded-full text-slate-300"><?php echo e($posts->total()); ?> bài viết</span>
                </div>
                <h1 class="font-headline text-3xl sm:text-4xl font-extrabold text-white tracking-tight">
                    <?php echo e($category->name); ?>

                </h1>
                <p class="font-body text-sm text-slate-300 leading-relaxed">
                    <?php echo e($category->description ?: 'Tổng hợp các bài viết phân tích, cẩm nang nghiệp vụ và giải pháp thực tiễn được biên tập bởi đội ngũ chuyên gia Truyền Thông Cửu Long.'); ?>

                </p>
            </div>
            <a href="<?php echo e(route('blog.index')); ?>" class="shrink-0 inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-white/10 hover:bg-white/20 text-white font-headline text-xs font-bold transition-all relative z-10">
                <span class="material-symbols-outlined text-[16px]">arrow_back</span>
                <span>Tất cả bài viết</span>
            </a>
        </div>

        <!-- Main Content Area: Left Posts Grid (8 cols) + Right Sidebar (4 cols) -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
            
            <!-- Posts Grid -->
            <div class="lg:col-span-8 flex flex-col">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-7 mb-10">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <article class="group rounded-3xl overflow-hidden bg-white border border-slate-200/90 shadow-[0_8px_24px_rgba(7,15,30,0.04)] hover:shadow-xl hover:border-orange-300 transition-all duration-300 flex flex-col">
                        <a href="<?php echo e(route('blog.resolve', $post->slug)); ?>" class="block aspect-video bg-slate-100 relative overflow-hidden shrink-0">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($post->thumbnail): ?>
                                <img src="<?php echo e($post->thumbnail_url); ?>" alt="<?php echo e($post->title); ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy">
                            <?php else: ?>
                                <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-slate-100 to-slate-200 text-slate-400">
                                    <span class="material-symbols-outlined text-4xl">article</span>
                                </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </a>
                        <div class="p-6 flex flex-col flex-1 justify-between gap-3">
                            <div class="flex flex-col gap-2">
                                <div class="flex items-center gap-2 text-[11px] font-mono text-slate-400">
                                    <span><?php echo e($post->published_at ? $post->published_at->format('d/m/Y') : ''); ?></span>
                                    <span>•</span>
                                    <span class="flex items-center gap-0.5">
                                        <span class="material-symbols-outlined text-[13px]">visibility</span>
                                        <?php echo e($post->views); ?>

                                    </span>
                                </div>
                                <h3 class="font-headline font-bold text-base text-navy-base group-hover:text-primary transition-colors line-clamp-2 leading-snug">
                                    <a href="<?php echo e(route('blog.resolve', $post->slug)); ?>"><?php echo e($post->title); ?></a>
                                </h3>
                                <p class="font-body text-xs text-slate-500 line-clamp-2 leading-relaxed">
                                    <?php echo e($post->summary); ?>

                                </p>
                            </div>
                            <div class="pt-3 border-t border-slate-100 flex items-center justify-between">
                                <a href="<?php echo e(route('blog.resolve', $post->slug)); ?>" class="text-xs font-headline font-bold text-primary hover:text-primary-hover flex items-center gap-1">
                                    <span>Đọc chi tiết</span>
                                    <span class="material-symbols-outlined text-[14px] group-hover:translate-x-1 transition-transform">arrow_forward</span>
                                </a>
                                <span class="text-[10px] font-mono text-slate-400">~3 phút đọc</span>
                            </div>
                        </div>
                    </article>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="sm:col-span-2 text-center py-16 bg-white rounded-3xl border border-slate-200">
                        <span class="material-symbols-outlined text-5xl text-slate-300 mb-2">folder_off</span>
                        <p class="font-headline text-base font-bold text-navy-base">Chưa có bài viết trong chuyên mục này.</p>
                        <a href="<?php echo e(route('blog.index')); ?>" class="mt-4 inline-flex items-center gap-1 px-4 py-2 rounded-full bg-primary text-white font-headline text-xs font-bold">Xem các chuyên mục khác</a>
                    </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                <!-- Custom Pagination -->
                <div class="mt-10 flex justify-center">
                    <?php echo e($posts->links()); ?>

                </div>
            </div>

            <!-- Sidebar (4 cols) -->
            <div class="lg:col-span-4 flex flex-col gap-8">
                
                <!-- Popular Posts -->
                <div class="p-6 rounded-3xl bg-white border border-slate-200/90 shadow-xs flex flex-col gap-5">
                    <div class="flex items-center gap-2 border-b border-slate-100 pb-3">
                        <span class="material-symbols-outlined text-primary text-[20px]">local_fire_department</span>
                        <h3 class="font-headline text-base font-extrabold text-navy-base uppercase tracking-wider">Bài Đọc Nhiều Nhất</h3>
                    </div>
                    <div class="flex flex-col divide-y divide-slate-100">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $popularPosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $pop): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e(route('blog.resolve', $pop->slug)); ?>" class="py-3 flex items-start gap-3.5 group">
                            <span class="font-headline text-xl font-black <?php echo e($index === 0 ? 'text-primary' : ($index === 1 ? 'text-accent-amber' : 'text-slate-300')); ?> leading-none w-6 shrink-0">
                                0<?php echo e($index + 1); ?>

                            </span>
                            <div class="flex flex-col min-w-0">
                                <h4 class="font-headline text-xs font-bold text-navy-base group-hover:text-primary transition-colors line-clamp-2 leading-snug">
                                    <?php echo e($pop->title); ?>

                                </h4>
                                <span class="text-[10px] font-mono text-slate-400 mt-1"><?php echo e($pop->views); ?> lượt xem</span>
                            </div>
                        </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </div>

                <!-- Categories List -->
                <div class="p-6 rounded-3xl bg-white border border-slate-200/90 shadow-xs flex flex-col gap-4">
                    <div class="flex items-center gap-2 border-b border-slate-100 pb-3">
                        <span class="material-symbols-outlined text-primary text-[20px]">category</span>
                        <h3 class="font-headline text-base font-extrabold text-navy-base uppercase tracking-wider">Chuyên Mục Khác</h3>
                    </div>
                    <div class="flex flex-col gap-1.5">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e(route('blog.resolve', $cat->slug)); ?>" class="flex items-center justify-between p-2.5 rounded-xl hover:bg-orange-50/60 transition-colors group <?php echo e($cat->id === $category->id ? 'bg-orange-100 font-bold' : ''); ?>">
                            <span class="font-headline text-xs font-semibold text-slate-700 group-hover:text-primary transition-colors"><?php echo e($cat->name); ?></span>
                            <span class="text-[11px] font-mono font-bold px-2 py-0.5 rounded-full bg-slate-100 text-slate-600 group-hover:bg-primary group-hover:text-white transition-colors"><?php echo e($cat->posts_count); ?></span>
                        </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\truyenthongcuulong-laravel\resources\views/blog/category.blade.php ENDPATH**/ ?>