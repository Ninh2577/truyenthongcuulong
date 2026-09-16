<?php if (isset($component)) { $__componentOriginal511d4862ff04963c3c16115c05a86a9d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal511d4862ff04963c3c16115c05a86a9d = $attributes; } ?>
<?php $component = Illuminate\View\DynamicComponent::resolve(['component' => $getFieldWrapperView()] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dynamic-component'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\DynamicComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['field' => $field]); ?>
    <div x-data="{ state: $wire.$entangle('<?php echo e($getStatePath()); ?>') }">
        
        <!-- Empty State -->
        <template x-if="!state">
            <div 
                x-on:click="$dispatch('open-modal', { id: 'media-picker-modal-<?php echo e($getStatePath()); ?>' })"
                class="flex items-center justify-center w-full px-6 py-4 border border-gray-300 border-dashed rounded-lg cursor-pointer hover:border-blue-500 hover:bg-blue-50 transition-colors"
                style="min-height: 100px;">
                <div class="space-y-1 text-center">
                    <svg class="mx-auto h-8 w-8 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <div class="flex text-sm text-gray-500 justify-center">
                        <span class="relative cursor-pointer rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none">
                            Bấm vào đây để Chọn ảnh từ Thư viện Media
                        </span>
                    </div>
                </div>
            </div>
        </template>
        
        <!-- Selected State -->
        <template x-if="state">
            <div class="relative w-full rounded-lg overflow-hidden border border-gray-300 group cursor-pointer" style="background-color: #f9fafb;">
                <div x-on:click="$dispatch('open-modal', { id: 'media-picker-modal-<?php echo e($getStatePath()); ?>' })">
                    <img :src="state.startsWith('http') ? state : ('<?php echo e(asset('storage')); ?>' + '/' + state.replace(/^\/+/, ''))" class="w-full object-contain" style="max-height: 300px;" />
                    
                    <!-- Overlay Actions -->
                    <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                        <span class="px-4 py-2 bg-white text-gray-700 rounded-md text-sm font-medium shadow-sm">
                            Bấm vào để thay đổi
                        </span>
                    </div>
                </div>

                <!-- Delete Button (International Premium UI Style) -->
                <button type="button" @click.stop="state = null" style="position: absolute; top: 12px; right: 12px; z-index: 10; width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; background-color: rgba(15, 23, 42, 0.5); color: white; border: 1px solid rgba(255,255,255,0.1); border-radius: 50%; cursor: pointer; box-shadow: 0 4px 12px rgba(0,0,0,0.15); backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px); transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);" onmouseover="this.style.backgroundColor='#ef4444'; this.style.borderColor='#ef4444'; this.style.transform='scale(1.1)'" onmouseout="this.style.backgroundColor='rgba(15, 23, 42, 0.5)'; this.style.borderColor='rgba(255,255,255,0.1)'; this.style.transform='scale(1)'" title="Xóa ảnh">
                    <svg style="height: 16px; width: 16px;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                </button>
            </div>
        </template>

        <!-- Filament Modal -->
        <?php if (isset($component)) { $__componentOriginal0942a211c37469064369f887ae8d1cef = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0942a211c37469064369f887ae8d1cef = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.modal.index','data' => ['id' => 'media-picker-modal-'.e($getStatePath()).'','width' => '7xl','class' => 'p-0']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament::modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'media-picker-modal-'.e($getStatePath()).'','width' => '7xl','class' => 'p-0']); ?>
             <?php $__env->slot('heading', null, []); ?> 
                Thư viện Media
             <?php $__env->endSlot(); ?>
            
            <div class="h-[80vh] overflow-hidden -mx-6 -mb-6" 
                 x-on:media-selected.window="if ($event.detail.target === '<?php echo e($getStatePath()); ?>') { state = $event.detail.path; $dispatch('close-modal', { id: 'media-picker-modal-<?php echo e($getStatePath()); ?>' }); }">
                <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('admin.media-library-picker', ['isPickerMode' => true, 'targetStatePath' => $getStatePath()]);

$__key = 'media-picker-'.$getStatePath();

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-2240491323-0', $__key);

$__html = app('livewire')->mount($__name, $__params, $__key);

echo $__html;

unset($__html);
unset($__key);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
            </div>
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
    </div>
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
<?php /**PATH C:\xampp\htdocs\truyenthongcuulong-laravel\resources\views/filament/forms/components/media-picker.blade.php ENDPATH**/ ?>