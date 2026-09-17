<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($paginator->hasPages()): ?>
<nav role="navigation" aria-label="<?php echo e(__('Pagination Navigation')); ?>" class="w-full py-6">

    
    <div class="flex justify-between items-center sm:hidden gap-3">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($paginator->onFirstPage()): ?>
            <span class="inline-flex items-center gap-1.5 px-4 py-2 rounded-full text-xs font-headline font-semibold text-slate-400 bg-slate-100 border border-slate-200 cursor-not-allowed select-none">
                <span class="material-symbols-outlined text-[15px]">arrow_back</span>
                Trước
            </span>
        <?php else: ?>
            <a href="<?php echo e($paginator->previousPageUrl()); ?>" rel="prev" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-full text-xs font-headline font-semibold text-navy-base bg-white border border-slate-200 shadow-sm hover:border-primary hover:text-primary hover:shadow-md transition-all duration-200">
                <span class="material-symbols-outlined text-[15px]">arrow_back</span>
                Trước
            </a>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <span class="text-xs font-mono text-slate-500">
            Trang <span class="font-bold text-navy-base"><?php echo e($paginator->currentPage()); ?></span> / <?php echo e($paginator->lastPage()); ?>

        </span>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($paginator->hasMorePages()): ?>
            <a href="<?php echo e($paginator->nextPageUrl()); ?>" rel="next" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-full text-xs font-headline font-semibold text-navy-base bg-white border border-slate-200 shadow-sm hover:border-primary hover:text-primary hover:shadow-md transition-all duration-200">
                Tiếp
                <span class="material-symbols-outlined text-[15px]">arrow_forward</span>
            </a>
        <?php else: ?>
            <span class="inline-flex items-center gap-1.5 px-4 py-2 rounded-full text-xs font-headline font-semibold text-slate-400 bg-slate-100 border border-slate-200 cursor-not-allowed select-none">
                Tiếp
                <span class="material-symbols-outlined text-[15px]">arrow_forward</span>
            </span>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>

    
    <div class="hidden sm:flex sm:flex-col sm:items-center gap-4">

        
        <p class="text-xs font-mono text-slate-500 tracking-wide">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($paginator->firstItem()): ?>
                Hiển thị <span class="font-bold text-navy-base"><?php echo e($paginator->firstItem()); ?></span>–<span class="font-bold text-navy-base"><?php echo e($paginator->lastItem()); ?></span>
                trong tổng số <span class="font-bold text-primary"><?php echo e($paginator->total()); ?></span> kết quả
            <?php else: ?>
                <?php echo e($paginator->count()); ?> kết quả
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </p>

        
        <div class="flex items-center gap-1.5">

            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($paginator->onFirstPage()): ?>
                <span aria-disabled="true" class="w-9 h-9 inline-flex items-center justify-center rounded-full text-slate-300 bg-slate-100 border border-slate-200 cursor-not-allowed select-none" aria-label="<?php echo e(__('pagination.previous')); ?>">
                    <span class="material-symbols-outlined text-[18px]">chevron_left</span>
                </span>
            <?php else: ?>
                <a href="<?php echo e($paginator->previousPageUrl()); ?>" rel="prev"
                   class="w-9 h-9 inline-flex items-center justify-center rounded-full text-slate-500 bg-white border border-slate-200 shadow-sm hover:border-primary hover:text-primary hover:shadow-md hover:-translate-x-0.5 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-primary/30"
                   aria-label="<?php echo e(__('pagination.previous')); ?>">
                    <span class="material-symbols-outlined text-[18px]">chevron_left</span>
                </a>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $elements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(is_string($element)): ?>
                    <span aria-disabled="true" class="w-9 h-9 inline-flex items-center justify-center rounded-full text-slate-400 font-mono text-sm select-none">
                        ···
                    </span>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(is_array($element)): ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $element; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($page == $paginator->currentPage()): ?>
                            <span aria-current="page"
                                  class="w-9 h-9 inline-flex items-center justify-center rounded-full text-sm font-headline font-extrabold text-white bg-primary shadow-md shadow-primary/30 border border-primary/20 select-none cursor-default ring-2 ring-primary/20 ring-offset-1">
                                <?php echo e($page); ?>

                            </span>
                        <?php else: ?>
                            <a href="<?php echo e($url); ?>"
                               class="w-9 h-9 inline-flex items-center justify-center rounded-full text-sm font-headline font-semibold text-slate-600 bg-white border border-slate-200 shadow-sm hover:border-primary/60 hover:text-primary hover:bg-orange-50/60 hover:shadow-md transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-primary/30"
                               aria-label="<?php echo e(__('Go to page :page', ['page' => $page])); ?>">
                                <?php echo e($page); ?>

                            </a>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($paginator->hasMorePages()): ?>
                <a href="<?php echo e($paginator->nextPageUrl()); ?>" rel="next"
                   class="w-9 h-9 inline-flex items-center justify-center rounded-full text-slate-500 bg-white border border-slate-200 shadow-sm hover:border-primary hover:text-primary hover:shadow-md hover:translate-x-0.5 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-primary/30"
                   aria-label="<?php echo e(__('pagination.next')); ?>">
                    <span class="material-symbols-outlined text-[18px]">chevron_right</span>
                </a>
            <?php else: ?>
                <span aria-disabled="true" class="w-9 h-9 inline-flex items-center justify-center rounded-full text-slate-300 bg-slate-100 border border-slate-200 cursor-not-allowed select-none" aria-label="<?php echo e(__('pagination.next')); ?>">
                    <span class="material-symbols-outlined text-[18px]">chevron_right</span>
                </span>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        </div>
    </div>

</nav>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php /**PATH C:\xampp\htdocs\truyenthongcuulong-laravel\resources\views/vendor/pagination/tailwind.blade.php ENDPATH**/ ?>