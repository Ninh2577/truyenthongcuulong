<?php
    $score = $result['score'] ?? 0;
    $breakdowns = $result['breakdown'] ?? [];
    
    $level = match(true) {
        $score >= 80 => ['color' => 'text-success-600 dark:text-success-400', 'bg' => 'bg-success-50 dark:bg-success-900/30', 'border' => 'border-success-200 dark:border-success-800', 'text' => 'Rất Tốt (Tuyệt vời)'],
        $score >= 50 => ['color' => 'text-warning-600 dark:text-warning-400', 'bg' => 'bg-warning-50 dark:bg-warning-900/30', 'border' => 'border-warning-200 dark:border-warning-800', 'text' => 'Trung Bình (Cần cải thiện)'],
        default => ['color' => 'text-danger-600 dark:text-danger-400', 'bg' => 'bg-danger-50 dark:bg-danger-900/30', 'border' => 'border-danger-200 dark:border-danger-800', 'text' => 'Kém (Cần tối ưu ngay)'],
    };
?>

<div class="space-y-4">
    <!-- Main Score Card -->
    <div class="flex items-center p-4 rounded-xl border <?php echo e($level['border']); ?> <?php echo e($level['bg']); ?>">
        <div class="relative w-16 h-16 flex-none mr-4">
            <svg class="w-full h-full" viewBox="0 0 36 36">
                <!-- Background Circle -->
                <path
                    class="text-white dark:text-gray-700"
                    d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="3"
                />
                <!-- Progress Circle -->
                <path
                    class="<?php echo e($level['color']); ?>"
                    stroke-dasharray="<?php echo e($score); ?>, 100"
                    d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="3"
                />
            </svg>
            <div class="absolute inset-0 flex items-center justify-center">
                <span class="text-lg font-bold <?php echo e($level['color']); ?>"><?php echo e($score); ?>/100</span>
            </div>
        </div>
        <div>
            <h4 class="text-base font-bold mb-1 <?php echo e($level['color']); ?>">Mức độ: <?php echo e($level['text']); ?></h4>
            <p class="text-xs text-gray-600 dark:text-gray-400">Hoàn thiện các tiêu chí bên dưới để tối đa hóa điểm SEO.</p>
        </div>
    </div>

    <ul class="space-y-2 text-sm mt-4">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $breakdowns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li class="flex items-start space-x-2">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($item['status']): ?>
                    <?php if (isset($component)) { $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c = $attributes; } ?>
<?php $component = BladeUI\Icons\Components\Svg::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('heroicon-o-check-circle'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\BladeUI\Icons\Components\Svg::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-5 h-5 flex-none','style' => 'color: #16a34a;']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c)): ?>
<?php $attributes = $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c; ?>
<?php unset($__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal643fe1b47aec0b76658e1a0200b34b2c)): ?>
<?php $component = $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c; ?>
<?php unset($__componentOriginal643fe1b47aec0b76658e1a0200b34b2c); ?>
<?php endif; ?>
                    <span class="font-medium" style="color: #15803d;"><?php echo e($item['label']); ?></span>
                <?php else: ?>
                    <?php if (isset($component)) { $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c = $attributes; } ?>
<?php $component = BladeUI\Icons\Components\Svg::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('heroicon-o-x-circle'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\BladeUI\Icons\Components\Svg::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-5 h-5 flex-none','style' => 'color: #dc2626;']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c)): ?>
<?php $attributes = $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c; ?>
<?php unset($__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal643fe1b47aec0b76658e1a0200b34b2c)): ?>
<?php $component = $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c; ?>
<?php unset($__componentOriginal643fe1b47aec0b76658e1a0200b34b2c); ?>
<?php endif; ?>
                    <span style="color: #b91c1c;"><?php echo e($item['label']); ?></span>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </ul>
</div>
<?php /**PATH C:\xampp\htdocs\truyenthongcuulong-laravel\resources\views/filament/forms/components/seo-checklist.blade.php ENDPATH**/ ?>