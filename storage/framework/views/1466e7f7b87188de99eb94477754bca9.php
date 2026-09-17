<?php
    $containerKey = 'filament_tree_container_' . $this->getId();
    $maxDepth = $getMaxDepth() ?? 1;
    $records = collect($this->getRootLayerRecords() ?? []);

?>

<div wire:disabled="updateTree"
    x-ignore
    ax-load
    ax-load-src="<?php echo e(\Filament\Support\Facades\FilamentAsset::getAlpineComponentSrc('filament-tree-component', 'solution-forest/filament-tree')); ?>"
    x-data="treeNestableComponent({
        containerKey: <?php echo e($containerKey); ?>,
        maxDepth: <?php echo e($maxDepth); ?>

    })">
    <?php if (isset($component)) { $__componentOriginalee08b1367eba38734199cf7829b1d1e9 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalee08b1367eba38734199cf7829b1d1e9 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.section.index','data' => ['heading' => ($this->displayTreeTitle() ?? false) ? $this->getTreeTitle() : null]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament::section'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['heading' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(($this->displayTreeTitle() ?? false) ? $this->getTreeTitle() : null)]); ?>
        <menu class="flex gap-2 mb-4" id="nestable-menu">
            <div class="btn-group">
                <?php if (isset($component)) { $__componentOriginal6330f08526bbb3ce2a0da37da512a11f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6330f08526bbb3ce2a0da37da512a11f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.button.index','data' => ['color' => 'gray','tag' => 'button','dataAction' => 'expand-all','xOn:click' => 'expandAll()','wire:loading.attr' => 'disabled','wire:loading.class' => 'cursor-wait opacity-70']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament::button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['color' => 'gray','tag' => 'button','data-action' => 'expand-all','x-on:click' => 'expandAll()','wire:loading.attr' => 'disabled','wire:loading.class' => 'cursor-wait opacity-70']); ?>
                    <?php echo e(__('filament-tree::filament-tree.button.expand_all')); ?>

                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6330f08526bbb3ce2a0da37da512a11f)): ?>
<?php $attributes = $__attributesOriginal6330f08526bbb3ce2a0da37da512a11f; ?>
<?php unset($__attributesOriginal6330f08526bbb3ce2a0da37da512a11f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6330f08526bbb3ce2a0da37da512a11f)): ?>
<?php $component = $__componentOriginal6330f08526bbb3ce2a0da37da512a11f; ?>
<?php unset($__componentOriginal6330f08526bbb3ce2a0da37da512a11f); ?>
<?php endif; ?>
                <?php if (isset($component)) { $__componentOriginal6330f08526bbb3ce2a0da37da512a11f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6330f08526bbb3ce2a0da37da512a11f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.button.index','data' => ['color' => 'gray','tag' => 'button','dataAction' => 'collapse-all','xOn:click' => 'collapseAll()','wire:loading.attr' => 'disabled','wire:loading.class' => 'cursor-wait opacity-70']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament::button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['color' => 'gray','tag' => 'button','data-action' => 'collapse-all','x-on:click' => 'collapseAll()','wire:loading.attr' => 'disabled','wire:loading.class' => 'cursor-wait opacity-70']); ?>
                    <?php echo e(__('filament-tree::filament-tree.button.collapse_all')); ?>

                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6330f08526bbb3ce2a0da37da512a11f)): ?>
<?php $attributes = $__attributesOriginal6330f08526bbb3ce2a0da37da512a11f; ?>
<?php unset($__attributesOriginal6330f08526bbb3ce2a0da37da512a11f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6330f08526bbb3ce2a0da37da512a11f)): ?>
<?php $component = $__componentOriginal6330f08526bbb3ce2a0da37da512a11f; ?>
<?php unset($__componentOriginal6330f08526bbb3ce2a0da37da512a11f); ?>
<?php endif; ?>
            </div>
            <div class="btn-group">
                <?php if (isset($component)) { $__componentOriginal6330f08526bbb3ce2a0da37da512a11f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6330f08526bbb3ce2a0da37da512a11f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.button.index','data' => ['tag' => 'button','dataAction' => 'save','xOn:click' => 'save()','wire:loading.attr' => 'disabled','wire:loading.class' => 'cursor-wait opacity-70']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament::button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['tag' => 'button','data-action' => 'save','x-on:click' => 'save()','wire:loading.attr' => 'disabled','wire:loading.class' => 'cursor-wait opacity-70']); ?>
                    <?php if (isset($component)) { $__componentOriginalbef7c2371a870b1887ec3741fe311a10 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalbef7c2371a870b1887ec3741fe311a10 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.loading-indicator','data' => ['class' => 'h-4 w-4','wire:loading' => true,'wire:target' => 'updateTree']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament::loading-indicator'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'h-4 w-4','wire:loading' => true,'wire:target' => 'updateTree']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalbef7c2371a870b1887ec3741fe311a10)): ?>
<?php $attributes = $__attributesOriginalbef7c2371a870b1887ec3741fe311a10; ?>
<?php unset($__attributesOriginalbef7c2371a870b1887ec3741fe311a10); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalbef7c2371a870b1887ec3741fe311a10)): ?>
<?php $component = $__componentOriginalbef7c2371a870b1887ec3741fe311a10; ?>
<?php unset($__componentOriginalbef7c2371a870b1887ec3741fe311a10); ?>
<?php endif; ?>
                    <span wire:loading.remove wire:target="updateTree">
                        <?php echo e(__('filament-tree::filament-tree.button.save')); ?>

                    </span>

                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6330f08526bbb3ce2a0da37da512a11f)): ?>
<?php $attributes = $__attributesOriginal6330f08526bbb3ce2a0da37da512a11f; ?>
<?php unset($__attributesOriginal6330f08526bbb3ce2a0da37da512a11f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6330f08526bbb3ce2a0da37da512a11f)): ?>
<?php $component = $__componentOriginal6330f08526bbb3ce2a0da37da512a11f; ?>
<?php unset($__componentOriginal6330f08526bbb3ce2a0da37da512a11f); ?>
<?php endif; ?>
            </div>
        </menu>
        <div class="filament-tree dd" id="<?php echo e($containerKey); ?>" x-ref="treeContainer">
            <?php if (isset($component)) { $__componentOriginala0e8d93fdc9fdfb968fec29494e741c2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala0e8d93fdc9fdfb968fec29494e741c2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-tree::components.tree.list','data' => ['records' => $records,'containerKey' => $containerKey,'tree' => $tree]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament-tree::tree.list'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['records' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($records),'containerKey' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($containerKey),'tree' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tree)]); ?>
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
        </div>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalee08b1367eba38734199cf7829b1d1e9)): ?>
<?php $attributes = $__attributesOriginalee08b1367eba38734199cf7829b1d1e9; ?>
<?php unset($__attributesOriginalee08b1367eba38734199cf7829b1d1e9); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalee08b1367eba38734199cf7829b1d1e9)): ?>
<?php $component = $__componentOriginalee08b1367eba38734199cf7829b1d1e9; ?>
<?php unset($__componentOriginalee08b1367eba38734199cf7829b1d1e9); ?>
<?php endif; ?>
</div>

<form wire:submit.prevent="callMountedTreeAction">
    <?php
        $action = $this->getMountedTreeAction();
    ?>

    <?php if (isset($component)) { $__componentOriginal0942a211c37469064369f887ae8d1cef = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0942a211c37469064369f887ae8d1cef = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.modal.index','data' => ['alignment' => $action?->getModalAlignment(),'closeButton' => $action?->hasModalCloseButton(),'closeByClickingAway' => $action?->isModalClosedByClickingAway(),'description' => $action?->getModalDescription(),'displayClasses' => 'block','footerActions' => $action?->getVisibleModalFooterActions(),'footerActionsAlignment' => $action?->getModalFooterActionsAlignment(),'heading' => $action?->getModalHeading(),'icon' => $action?->getModalIcon(),'iconColor' => $action?->getModalIconColor(),'id' => $this->getId() . '-tree-action','slideOver' => $action?->isModalSlideOver(),'stickyFooter' => $action?->isModalFooterSticky(),'stickyHeader' => $action?->isModalHeaderSticky(),'visible' => filled($action),'width' => $action?->getModalWidth(),'wire:key' => $action ? $this->getId() . '.tree.actions.' . $action->getName() . '.modal' : null,'xOn:closedFormComponentActionModal.window' => 'if (($event.detail.id === \''.e($this->getId()).'\') && $wire.mountedTreeActions.length) open()','xOn:modalClosed.stop' => '
            const mountedTreeActionShouldOpenModal = '.e(\Illuminate\Support\Js::from($action && $this->mountedTreeActionShouldOpenModal())).'


            if (! mountedTreeActionShouldOpenModal) {
                return
            }

            if ($wire.mountedFormComponentActions.length) {
                return
            }

            $wire.unmountTreeAction(false)
        ','xOn:openedFormComponentActionModal.window' => 'if ($event.detail.id === \''.e($this->getId()).'\') close()']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament::modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['alignment' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($action?->getModalAlignment()),'close-button' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($action?->hasModalCloseButton()),'close-by-clicking-away' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($action?->isModalClosedByClickingAway()),'description' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($action?->getModalDescription()),'display-classes' => 'block','footer-actions' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($action?->getVisibleModalFooterActions()),'footer-actions-alignment' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($action?->getModalFooterActionsAlignment()),'heading' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($action?->getModalHeading()),'icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($action?->getModalIcon()),'icon-color' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($action?->getModalIconColor()),'id' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($this->getId() . '-tree-action'),'slide-over' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($action?->isModalSlideOver()),'sticky-footer' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($action?->isModalFooterSticky()),'sticky-header' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($action?->isModalHeaderSticky()),'visible' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(filled($action)),'width' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($action?->getModalWidth()),'wire:key' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($action ? $this->getId() . '.tree.actions.' . $action->getName() . '.modal' : null),'x-on:closed-form-component-action-modal.window' => 'if (($event.detail.id === \''.e($this->getId()).'\') && $wire.mountedTreeActions.length) open()','x-on:modal-closed.stop' => '
            const mountedTreeActionShouldOpenModal = '.e(\Illuminate\Support\Js::from($action && $this->mountedTreeActionShouldOpenModal())).'


            if (! mountedTreeActionShouldOpenModal) {
                return
            }

            if ($wire.mountedFormComponentActions.length) {
                return
            }

            $wire.unmountTreeAction(false)
        ','x-on:opened-form-component-action-modal.window' => 'if ($event.detail.id === \''.e($this->getId()).'\') close()']); ?>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($action): ?>
            <?php echo e($action->getModalContent()); ?>


            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count(($infolist = $action->getInfolist())?->getComponents() ?? [])): ?>
                <?php echo e($infolist); ?>

            <?php elseif($this->mountedTreeActionHasForm()): ?>
                <?php echo e($this->getMountedTreeActionForm()); ?>

            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <?php echo e($action->getModalContentFooter()); ?>

        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal0942a211c37469064369f887ae8d1cef)): ?>
<?php $attributes = $__attributesOriginal0942a211c37469064369f887ae8d1cef; ?>
<?php unset($__attributesOriginal0942a211c37469064369f887ae8d1cef); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0942a211c37469064369f887ae8d1cef)): ?>
<?php $component = $__componentOriginal0942a211c37469064369f887ae8d1cef; ?>
<?php unset($__componentOriginal0942a211c37469064369f887ae8d1cef); ?>
<?php endif; ?>
</form>
<?php /**PATH C:\xampp\htdocs\truyenthongcuulong-laravel\vendor\solution-forest\filament-tree\resources\views/components/tree/index.blade.php ENDPATH**/ ?>