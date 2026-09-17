<?php use Illuminate\Database\Eloquent\Model; ?>
<?php use Filament\Facades\Filament; ?>
<?php use SolutionForest\FilamentTree\Components\Tree; ?>
<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['record', 'containerKey', 'tree', 'title' => null, 'icon' => null, 'description' => null]));

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

foreach (array_filter((['record', 'containerKey', 'tree', 'title' => null, 'icon' => null, 'description' => null]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>
<?php
    /** @var $record Model */
    /** @var $containerKey string */
    /** @var $tree Tree */

    $recordKey = $tree->getRecordKey($record);
    $parentKey = $tree->getParentKey($record);

    $children = $record->children;
    $collapsed = $this->getNodeCollapsedState($record);

    $actions = $tree->getActions();
?>

<li class="filament-tree-row dd-item" data-id="<?php echo e($recordKey); ?>">
    <div wire:loading.remove.delay
        wire:target="<?php echo e(implode(',', Tree::LOADING_TARGETS)); ?>"
        class="<?php echo \Illuminate\Support\Arr::toCssClasses([
            'rounded-lg border dd-handle h-10',
            'mb-2',
            'flex w-full items-center',
            'border-gray-300 bg-white dark:border-white/10 dark:bg-gray-900',
        ]); ?>">

        <button type="button" class="<?php echo \Illuminate\Support\Arr::toCssClasses([
            'h-full flex items-center',
            'rounded-l-lg border-r rtl:rounded-l rtl:border-r-0 rtl:border-l px-px',
            'bg-gray-50 border-gray-300 dark:bg-white/5 dark:border-white/10',
        ]); ?>">
            <?php if (isset($component)) { $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c = $attributes; } ?>
<?php $component = BladeUI\Icons\Components\Svg::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('heroicon-m-ellipsis-vertical'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\BladeUI\Icons\Components\Svg::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'text-gray-400 dark:text-gray-500 w-4 h-4 -mr-2 rtl:mr-0 rtl:-ml-2']); ?>
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
            <?php if (isset($component)) { $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c = $attributes; } ?>
<?php $component = BladeUI\Icons\Components\Svg::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('heroicon-m-ellipsis-vertical'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\BladeUI\Icons\Components\Svg::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'text-gray-400 dark:text-gray-500 w-4 h-4']); ?>
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
        </button>

        <div class="dd-content dd-nodrag flex gap-1">

            <?php if (isset($component)) { $__componentOriginalc83ea2e2a55c064deb386669618053ef = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc83ea2e2a55c064deb386669618053ef = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-tree::components.tree.item-display','data' => ['class' => 'ml-1 rtl:mr-1','record' => $record,'title' => $title,'icon' => $icon,'description' => $description]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament-tree::tree.item-display'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'ml-1 rtl:mr-1','record' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($record),'title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($title),'icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($icon),'description' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($description)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc83ea2e2a55c064deb386669618053ef)): ?>
<?php $attributes = $__attributesOriginalc83ea2e2a55c064deb386669618053ef; ?>
<?php unset($__attributesOriginalc83ea2e2a55c064deb386669618053ef); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc83ea2e2a55c064deb386669618053ef)): ?>
<?php $component = $__componentOriginalc83ea2e2a55c064deb386669618053ef; ?>
<?php unset($__componentOriginalc83ea2e2a55c064deb386669618053ef); ?>
<?php endif; ?>

            <div class="<?php echo \Illuminate\Support\Arr::toCssClasses(['dd-item-btns', 'hidden' => !count($children), 'flex items-center justify-center pl-3']); ?>">
                <button data-action="expand" class="<?php echo \Illuminate\Support\Arr::toCssClasses(['hidden' => !$collapsed]); ?>">
                    <?php if (isset($component)) { $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c = $attributes; } ?>
<?php $component = BladeUI\Icons\Components\Svg::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('heroicon-o-chevron-down'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\BladeUI\Icons\Components\Svg::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'text-gray-400 w-4 h-4']); ?>
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
                </button>
                <button data-action="collapse" class="<?php echo \Illuminate\Support\Arr::toCssClasses(['hidden' => $collapsed]); ?>">
                    <?php if (isset($component)) { $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c = $attributes; } ?>
<?php $component = BladeUI\Icons\Components\Svg::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('heroicon-o-chevron-up'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\BladeUI\Icons\Components\Svg::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'text-gray-400 w-4 h-4']); ?>
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
                </button>
            </div>
        </div>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($actions)): ?>
            <div class="dd-nodrag ml-auto mr-4 rtl:ml-4 rtl:mr-auto">
                <?php if (isset($component)) { $__componentOriginalb1ba3a4d4641dbb63ce987ec75a713b6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb1ba3a4d4641dbb63ce987ec75a713b6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-tree::components.actions.index','data' => ['actions' => $actions,'record' => $record]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament-tree::actions'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['actions' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($actions),'record' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($record)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb1ba3a4d4641dbb63ce987ec75a713b6)): ?>
<?php $attributes = $__attributesOriginalb1ba3a4d4641dbb63ce987ec75a713b6; ?>
<?php unset($__attributesOriginalb1ba3a4d4641dbb63ce987ec75a713b6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb1ba3a4d4641dbb63ce987ec75a713b6)): ?>
<?php $component = $__componentOriginalb1ba3a4d4641dbb63ce987ec75a713b6; ?>
<?php unset($__componentOriginalb1ba3a4d4641dbb63ce987ec75a713b6); ?>
<?php endif; ?>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($children)): ?>
        <?php if (isset($component)) { $__componentOriginala0e8d93fdc9fdfb968fec29494e741c2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala0e8d93fdc9fdfb968fec29494e741c2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-tree::components.tree.list','data' => ['records' => $children,'containerKey' => $containerKey,'tree' => $tree,'collapsed' => $collapsed]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament-tree::tree.list'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['records' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($children),'containerKey' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($containerKey),'tree' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tree),'collapsed' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($collapsed)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala0e8d93fdc9fdfb968fec29494e741c2)): ?>
<?php $attributes = $__attributesOriginala0e8d93fdc9fdfb968fec29494e741c2; ?>
<?php unset($__attributesOriginala0e8d93fdc9fdfb968fec29494e741c2); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala0e8d93fdc9fdfb968fec29494e741c2)): ?>
<?php $component = $__componentOriginala0e8d93fdc9fdfb968fec29494e741c2; ?>
<?php unset($__componentOriginala0e8d93fdc9fdfb968fec29494e741c2); ?>
<?php endif; ?>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <div class="rounded-lg border border-gray-300 mb-2 w-full px-4 py-4 animate-pulse hidden"
         wire:loading.class.remove.delay="hidden"
         wire:target="<?php echo e(implode(',', Tree::LOADING_TARGETS)); ?>">
        <div class="h-4 bg-gray-300 rounded-md"></div>
    </div>
</li>
<?php /**PATH C:\xampp\htdocs\truyenthongcuulong-laravel\vendor\solution-forest\filament-tree\resources\views/components/tree/item.blade.php ENDPATH**/ ?>