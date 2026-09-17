<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'records',
    'containerKey',
    'tree',
    'collapsed' => null,
]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter(([
    'records',
    'containerKey',
    'tree',
    'collapsed' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>
<ol class="<?php echo \Illuminate\Support\Arr::toCssClasses([
    'filament-tree-list',
    'dd-list',
    'hidden' => $collapsed,
]); ?>">
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $records ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
            $title = $this->getTreeRecordTitle($record);
            $icon = $this->getTreeRecordIcon($record);
        ?>
        <?php if (isset($component)) { $__componentOriginal7122cd859c6fea886eb904ece4377fcf = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7122cd859c6fea886eb904ece4377fcf = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-tree::components.tree.item','data' => ['record' => $record,'containerKey' => $containerKey,'tree' => $tree,'title' => $title,'description' => $this->getTreeRecordDescription($record),'icon' => $icon]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament-tree::tree.item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['record' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($record),'containerKey' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($containerKey),'tree' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tree),'title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($title),'description' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($this->getTreeRecordDescription($record)),'icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($icon)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7122cd859c6fea886eb904ece4377fcf)): ?>
<?php $attributes = $__attributesOriginal7122cd859c6fea886eb904ece4377fcf; ?>
<?php unset($__attributesOriginal7122cd859c6fea886eb904ece4377fcf); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7122cd859c6fea886eb904ece4377fcf)): ?>
<?php $component = $__componentOriginal7122cd859c6fea886eb904ece4377fcf; ?>
<?php unset($__componentOriginal7122cd859c6fea886eb904ece4377fcf); ?>
<?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</ol>
<?php /**PATH C:\xampp\htdocs\truyenthongcuulong-laravel\vendor\solution-forest\filament-tree\resources\views/components/tree/list.blade.php ENDPATH**/ ?>