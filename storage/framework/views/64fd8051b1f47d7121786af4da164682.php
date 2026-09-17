<?php
    $columns = [
        'default' => 1,
    ];
?>
<?php if (isset($component)) { $__componentOriginalbe23554f7bded3778895289146189db7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalbe23554f7bded3778895289146189db7 = $attributes; } ?>
<?php $component = Filament\View\LegacyComponents\Page::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament::page'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Filament\View\LegacyComponents\Page::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'filament-tree-page']); ?>
    <?php if (isset($component)) { $__componentOriginal30dbd75eb120a380110a2b340cd88f46 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal30dbd75eb120a380110a2b340cd88f46 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.grid.index','data' => ['default' => $columns['default'],'class' => 'gap-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament::grid'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['default' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($columns['default']),'class' => 'gap-4']); ?>
        <?php if (isset($component)) { $__componentOriginal6f9d0ad23f77111c926012ad6ce09333 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6f9d0ad23f77111c926012ad6ce09333 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.grid.column','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament::grid.column'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
            <?php echo e($this->tree); ?>

         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6f9d0ad23f77111c926012ad6ce09333)): ?>
<?php $attributes = $__attributesOriginal6f9d0ad23f77111c926012ad6ce09333; ?>
<?php unset($__attributesOriginal6f9d0ad23f77111c926012ad6ce09333); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6f9d0ad23f77111c926012ad6ce09333)): ?>
<?php $component = $__componentOriginal6f9d0ad23f77111c926012ad6ce09333; ?>
<?php unset($__componentOriginal6f9d0ad23f77111c926012ad6ce09333); ?>
<?php endif; ?>

     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal30dbd75eb120a380110a2b340cd88f46)): ?>
<?php $attributes = $__attributesOriginal30dbd75eb120a380110a2b340cd88f46; ?>
<?php unset($__attributesOriginal30dbd75eb120a380110a2b340cd88f46); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal30dbd75eb120a380110a2b340cd88f46)): ?>
<?php $component = $__componentOriginal30dbd75eb120a380110a2b340cd88f46; ?>
<?php unset($__componentOriginal30dbd75eb120a380110a2b340cd88f46); ?>
<?php endif; ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalbe23554f7bded3778895289146189db7)): ?>
<?php $attributes = $__attributesOriginalbe23554f7bded3778895289146189db7; ?>
<?php unset($__attributesOriginalbe23554f7bded3778895289146189db7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalbe23554f7bded3778895289146189db7)): ?>
<?php $component = $__componentOriginalbe23554f7bded3778895289146189db7; ?>
<?php unset($__componentOriginalbe23554f7bded3778895289146189db7); ?>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\truyenthongcuulong-laravel\vendor\solution-forest\filament-tree\resources\views/pages/tree.blade.php ENDPATH**/ ?>