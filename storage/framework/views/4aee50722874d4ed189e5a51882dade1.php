<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'action',
    'dynamicComponent',
    'icon' => null,
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
    'action',
    'dynamicComponent',
    'icon' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<?php
    $isDisabled = $action->isDisabled();
    $url = $action->getUrl();
?>

<?php if (isset($component)) { $__componentOriginal511d4862ff04963c3c16115c05a86a9d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal511d4862ff04963c3c16115c05a86a9d = $attributes; } ?>
<?php $component = Illuminate\View\DynamicComponent::resolve(['component' => $dynamicComponent] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dynamic-component'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\DynamicComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['badge' => $action->getBadge(),'badge-color' => $action->getBadgeColor(),'form' => $action->getFormToSubmit(),'tag' => $url ? 'a' : 'button','x-on:click' => $action->getAlpineClickHandler(),'wire:click' => $action->getLivewireClickHandler(),'wire:target' => $action->getLivewireTarget(),'href' => $isDisabled ? null : $url,'target' => ($url && $action->shouldOpenUrlInNewTab()) ? '_blank' : null,'type' => $action->canSubmitForm() ? 'submit' : 'button','color' => $action->getColor(),'key-bindings' => $action->getKeyBindings(),'tooltip' => $action->getTooltip(),'disabled' => $isDisabled,'icon' => $icon ?? $action->getIcon(),'icon-size' => $action->getIconSize(),'size' => $action->getSize(),'label-sr-only' => $action->isLabelHidden(),'attributes' => \Filament\Support\prepare_inherited_attributes($attributes)->merge($action->getExtraAttributes(), escape: false)]); ?>
    <?php echo e($slot); ?>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal511d4862ff04963c3c16115c05a86a9d)): ?>
<?php $attributes = $__attributesOriginal511d4862ff04963c3c16115c05a86a9d; ?>
<?php unset($__attributesOriginal511d4862ff04963c3c16115c05a86a9d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal511d4862ff04963c3c16115c05a86a9d)): ?>
<?php $component = $__componentOriginal511d4862ff04963c3c16115c05a86a9d; ?>
<?php unset($__componentOriginal511d4862ff04963c3c16115c05a86a9d); ?>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\truyenthongcuulong-laravel\vendor\solution-forest\filament-tree\resources\views/components/actions/action.blade.php ENDPATH**/ ?>