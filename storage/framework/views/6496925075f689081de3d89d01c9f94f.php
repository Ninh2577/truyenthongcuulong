<?php if (isset($component)) { $__componentOriginal6c29f7de7db759fc79566801037354f6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6c29f7de7db759fc79566801037354f6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-tree::components.actions.action','data' => ['action' => $action,'label' => $getLabel(),'dynamicComponent' => 'filament::icon-button','class' => 'filament-tree-icon-button-action']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament-tree::actions.action'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['action' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($action),'label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($getLabel()),'dynamic-component' => 'filament::icon-button','class' => 'filament-tree-icon-button-action']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6c29f7de7db759fc79566801037354f6)): ?>
<?php $attributes = $__attributesOriginal6c29f7de7db759fc79566801037354f6; ?>
<?php unset($__attributesOriginal6c29f7de7db759fc79566801037354f6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6c29f7de7db759fc79566801037354f6)): ?>
<?php $component = $__componentOriginal6c29f7de7db759fc79566801037354f6; ?>
<?php unset($__componentOriginal6c29f7de7db759fc79566801037354f6); ?>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\truyenthongcuulong-laravel\vendor\solution-forest\filament-tree\resources\views/actions/icon-button-action.blade.php ENDPATH**/ ?>