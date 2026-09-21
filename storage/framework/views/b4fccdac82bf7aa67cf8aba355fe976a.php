<div>
    <?php if (isset($component)) { $__componentOriginalee08b1367eba38734199cf7829b1d1e9 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalee08b1367eba38734199cf7829b1d1e9 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.section.index','data' => ['aside' => $aside]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament::section'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['aside' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($aside)]); ?>
         <?php $__env->slot('heading', null, []); ?> 
            <?php echo e(__('filament-two-factor-authentication::section.header')); ?>

         <?php $__env->endSlot(); ?>

         <?php $__env->slot('description', null, []); ?> 
            <?php echo e(__('filament-two-factor-authentication::section.description')); ?>

         <?php $__env->endSlot(); ?>

        <div class="">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($this->isConfirmingSetup): ?>
                <?php if (isset($component)) { $__componentOriginal38ed7a87da166fff6288a561916514e7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal38ed7a87da166fff6288a561916514e7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-two-factor-authentication::components.setup-confirmation','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament-two-factor-authentication::setup-confirmation'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal38ed7a87da166fff6288a561916514e7)): ?>
<?php $attributes = $__attributesOriginal38ed7a87da166fff6288a561916514e7; ?>
<?php unset($__attributesOriginal38ed7a87da166fff6288a561916514e7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal38ed7a87da166fff6288a561916514e7)): ?>
<?php $component = $__componentOriginal38ed7a87da166fff6288a561916514e7; ?>
<?php unset($__componentOriginal38ed7a87da166fff6288a561916514e7); ?>
<?php endif; ?>
            <?php elseif($this->enableTwoFactorAuthentication->isVisible()): ?>
                <?php if (isset($component)) { $__componentOriginal56923a72b6b5109365f07652ca18f266 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal56923a72b6b5109365f07652ca18f266 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-two-factor-authentication::components.enable','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament-two-factor-authentication::enable'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal56923a72b6b5109365f07652ca18f266)): ?>
<?php $attributes = $__attributesOriginal56923a72b6b5109365f07652ca18f266; ?>
<?php unset($__attributesOriginal56923a72b6b5109365f07652ca18f266); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal56923a72b6b5109365f07652ca18f266)): ?>
<?php $component = $__componentOriginal56923a72b6b5109365f07652ca18f266; ?>
<?php unset($__componentOriginal56923a72b6b5109365f07652ca18f266); ?>
<?php endif; ?>
            <?php elseif($this->disableTwoFactorAuthentication->isVisible()): ?>
                <?php if (isset($component)) { $__componentOriginal43e6c3552dc84d188641a502102d0484 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal43e6c3552dc84d188641a502102d0484 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-two-factor-authentication::components.enabled','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament-two-factor-authentication::enabled'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal43e6c3552dc84d188641a502102d0484)): ?>
<?php $attributes = $__attributesOriginal43e6c3552dc84d188641a502102d0484; ?>
<?php unset($__attributesOriginal43e6c3552dc84d188641a502102d0484); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal43e6c3552dc84d188641a502102d0484)): ?>
<?php $component = $__componentOriginal43e6c3552dc84d188641a502102d0484; ?>
<?php unset($__componentOriginal43e6c3552dc84d188641a502102d0484); ?>
<?php endif; ?>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($this->showRecoveryCodes): ?>
                    <?php if (isset($component)) { $__componentOriginal8aac8a7842567c6029bcc222e0d4b09f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8aac8a7842567c6029bcc222e0d4b09f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-two-factor-authentication::components.recovery-codes','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament-two-factor-authentication::recovery-codes'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8aac8a7842567c6029bcc222e0d4b09f)): ?>
<?php $attributes = $__attributesOriginal8aac8a7842567c6029bcc222e0d4b09f; ?>
<?php unset($__attributesOriginal8aac8a7842567c6029bcc222e0d4b09f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8aac8a7842567c6029bcc222e0d4b09f)): ?>
<?php $component = $__componentOriginal8aac8a7842567c6029bcc222e0d4b09f; ?>
<?php unset($__componentOriginal8aac8a7842567c6029bcc222e0d4b09f); ?>
<?php endif; ?>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <?php echo e($this->generateNewRecoveryCodes); ?>


                <?php echo e($this->disableTwoFactorAuthentication); ?>

            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
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

    <?php if (isset($component)) { $__componentOriginal028e05680f6c5b1e293abd7fbe5f9758 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal028e05680f6c5b1e293abd7fbe5f9758 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-actions::components.modals','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament-actions::modals'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal028e05680f6c5b1e293abd7fbe5f9758)): ?>
<?php $attributes = $__attributesOriginal028e05680f6c5b1e293abd7fbe5f9758; ?>
<?php unset($__attributesOriginal028e05680f6c5b1e293abd7fbe5f9758); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal028e05680f6c5b1e293abd7fbe5f9758)): ?>
<?php $component = $__componentOriginal028e05680f6c5b1e293abd7fbe5f9758; ?>
<?php unset($__componentOriginal028e05680f6c5b1e293abd7fbe5f9758); ?>
<?php endif; ?>
</div>
<?php /**PATH C:\xampp\htdocs\truyenthongcuulong-laravel\vendor\stephenjude\filament-two-factor-authentication\resources\views/livewire/two-factor-authentication.blade.php ENDPATH**/ ?>