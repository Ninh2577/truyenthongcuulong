<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'actions',
    'alignment' => null,
    'record' => null,
    'wrap' => false,
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
    'actions',
    'alignment' => null,
    'record' => null,
    'wrap' => false,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<?php
    use Filament\Support\Enums\Alignment;

    $actions = array_filter(
        $actions,
        function ($action) use ($record): bool {

            if (! $action instanceof \SolutionForest\FilamentTree\Actions\Modal\Action) {
                $action->record($record);
            }
            
            return $action->isVisible();
        },
    );
?>

<div
    <?php echo e($attributes->class([
            'fi-tree-actions flex shrink-0 items-center gap-3',
            'flex-wrap' => $wrap,
            'sm:flex-nowrap' => $wrap === '-sm',
            match ($alignment) {
                Alignment::Center, 'center' => 'justify-center',
                Alignment::Start, Alignment::Left, 'start', 'left' => 'justify-start',
                'start md:end' => 'justify-start md:justify-end',
                default => 'justify-end',
            },
        ])); ?>

>
    <?php if (isset($component)) { $__componentOriginalb2f112d7b18f6837dfc4fbc7ec4524d2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb2f112d7b18f6837dfc4fbc7ec4524d2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-actions::components.actions','data' => ['actions' => $actions]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament-actions::actions'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['actions' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($actions)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb2f112d7b18f6837dfc4fbc7ec4524d2)): ?>
<?php $attributes = $__attributesOriginalb2f112d7b18f6837dfc4fbc7ec4524d2; ?>
<?php unset($__attributesOriginalb2f112d7b18f6837dfc4fbc7ec4524d2); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb2f112d7b18f6837dfc4fbc7ec4524d2)): ?>
<?php $component = $__componentOriginalb2f112d7b18f6837dfc4fbc7ec4524d2; ?>
<?php unset($__componentOriginalb2f112d7b18f6837dfc4fbc7ec4524d2); ?>
<?php endif; ?>
</div><?php /**PATH C:\xampp\htdocs\truyenthongcuulong-laravel\vendor\solution-forest\filament-tree\resources\views/components/actions/index.blade.php ENDPATH**/ ?>