<div class="flex h-screen bg-gray-50 font-sans" x-data="{
    insertImage() {
        if (!$wire.selectedMediaId) return;
        
        let url = $wire.editUrl;
        let alt = $wire.editAltText || '';
        let title = $wire.editTitle || '';
        let caption = $wire.editCaption || '';
        
        window.parent.postMessage({
            mceAction: 'insertImage',
            content: url,
            alt: alt,
            title: title,
            caption: caption
        }, '*');
    }
}">
    <!-- Main Content Area: Grid -->
    <div class="flex-1 flex flex-col h-full overflow-hidden">
        
        <!-- Header / Toolbar -->
        <div class="flex items-center justify-between px-6 py-4 bg-white border-b border-gray-200" style="display: flex; justify-content: space-between; width: 100%;">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!$isPickerMode): ?>
                <h1 class="text-xl font-bold text-gray-800 mr-6 whitespace-nowrap">Thư viện Media</h1>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            
            <div style="display: flex; justify-content: space-between; align-items: center; width: 100%; gap: 1rem;">
                <!-- Search Input -->
                <div style="position: relative; flex: 1; max-width: 400px;">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3" style="position: absolute; left: 0.75rem; top: 0; bottom: 0; display: flex; align-items: center;">
                        <svg class="w-5 h-5 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </span>
                    <input wire:model.live.debounce.500ms="search" type="text" style="width: 100%; padding-left: 2.5rem; padding-right: 1rem; padding-top: 0.5rem; padding-bottom: 0.5rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 0.875rem; color: #374151; outline: none; box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);" onfocus="this.style.borderColor='#3b82f6'; this.style.boxShadow='0 0 0 2px rgba(59, 130, 246, 0.5)'" onblur="this.style.borderColor='#d1d5db'; this.style.boxShadow='0 1px 2px 0 rgba(0, 0, 0, 0.05)'" placeholder="Tìm kiếm hình ảnh...">
                </div>

                <!-- Upload Button -->
                <div style="position: relative; overflow: hidden; display: inline-block; flex-shrink: 0;">
                    <button class="flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-1 transition-colors" style="display: flex; align-items: center; padding: 0.5rem 1rem; background-color: #2563eb; color: white; border-radius: 0.5rem;">
                        <svg class="w-4 h-4 mr-2" style="width: 1rem; height: 1rem; margin-right: 0.5rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                        Tải ảnh lên
                    </button>
                    <input type="file" wire:model="uploads" multiple accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0; cursor: pointer;" />
                </div>
            </div>
        </div>

        <!-- Flash Message -->
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session()->has('message')): ?>
            <div class="px-6 py-3 bg-green-50 text-green-700 text-sm font-medium border-b border-green-200">
                <?php echo e(session('message')); ?>

            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['uploads.*'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="px-6 py-2 text-sm text-red-600"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <!-- Grid Area -->
        <div class="flex-1 overflow-y-auto p-6" id="media-grid">
            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($mediaFiles) === 0): ?>
                <div class="flex flex-col items-center justify-center h-64 text-gray-400">
                    <svg class="w-16 h-16 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    <p class="text-lg font-medium text-gray-600">Không tìm thấy hình ảnh nào</p>
                </div>
            <?php else: ?>
                <div style="display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 1rem;">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $mediaFiles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $imageUrl = \Illuminate\Support\Facades\Storage::disk($file['disk'])->url($file['path']);
                        ?>
                        <div wire:click="selectMedia(<?php echo e($file['id']); ?>)" 
                             class="group relative aspect-square bg-gray-100 rounded-xl overflow-hidden border-2 cursor-pointer transition-all duration-200 
                                    <?php echo e($selectedMediaId === $file['id'] ? 'border-blue-500 shadow-md ring-2 ring-blue-500 ring-opacity-50' : 'border-transparent hover:border-gray-300 hover:shadow-sm'); ?>">
                            
                            <img src="<?php echo e($imageUrl); ?>" alt="<?php echo e($file['alt_text'] ?? ''); ?>" loading="lazy" class="w-full h-full object-cover">
                            
                            <!-- Selected Checkmark -->
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($selectedMediaId === $file['id']): ?>
                                <div class="absolute top-2 right-2 w-6 h-6 bg-blue-500 rounded-full flex items-center justify-center text-white shadow-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                            <!-- Filename Overlay (Hover) -->
                            <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/70 to-transparent p-3 translate-y-full group-hover:translate-y-0 transition-transform duration-200">
                                <p class="text-white text-xs truncate"><?php echo e($file['filename'] ?? 'Không tên'); ?></p>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <!-- Loading Spinner / Infinite Scroll Trigger -->
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($hasMore): ?>
                <div class="mt-8 flex justify-center pb-8" x-intersect="$wire.loadMore()">
                    <svg class="animate-spin h-8 w-8 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </div>

    <!-- Sidebar: Image Details & Form -->
    <div class="bg-white border-l border-gray-200 flex flex-col h-full flex-shrink-0 transition-all duration-300 <?php echo e($selectedMediaId ? 'translate-x-0' : 'translate-x-full hidden'); ?>" style="width: 400px; min-width: 400px; max-width: 400px;">
        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($selectedMediaId): ?>
            <div class="p-4 border-b border-gray-200 bg-gray-50 flex justify-between items-center">
                <h2 class="text-sm font-semibold text-gray-700 uppercase tracking-wider">Chi tiết đính kèm</h2>
                <button type="button" wire:click="$set('selectedMediaId', null)" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <div class="flex-1 overflow-y-auto p-6 space-y-6">
                <!-- Preview Image -->
                <div class="bg-gray-100 rounded-lg overflow-hidden border border-gray-200 flex items-center justify-center" style="aspect-ratio: 16/9;">
                    <img src="<?php echo e($editUrl); ?>" class="max-w-full max-h-full object-contain">
                </div>
                
                <!-- URL Field -->
                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1">URL tệp (Read-only)</label>
                    <div class="flex">
                        <input type="text" readonly value="<?php echo e($editUrl); ?>" class="flex-1 block w-full rounded-l-md border-gray-300 bg-gray-50 text-gray-500 sm:text-sm focus:border-blue-500 focus:ring-blue-500">
                        <button type="button" onclick="navigator.clipboard.writeText('<?php echo e($editUrl); ?>'); alert('Đã copy!');" class="inline-flex items-center px-3 rounded-r-md border border-l-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm hover:bg-gray-100">
                            Copy
                        </button>
                    </div>
                </div>

                <!-- Form Fields -->
                <form wire:submit.prevent="saveMetadata" class="space-y-4">
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Tiêu đề (Title)</label>
                        <input type="text" wire:model="editTitle" class="block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                    </div>
                    
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Văn bản thay thế (Alt Text) - Tối ưu SEO</label>
                        <input type="text" wire:model="editAltText" class="block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                        <p class="mt-1 text-[11px] text-gray-500">Mô tả hình ảnh cho các máy tìm kiếm (Google) và người khiếm thị.</p>
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Mô tả SEO (SEO Description)</label>
                        <textarea wire:model="editDescription" rows="2" class="block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"></textarea>
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Chú thích (Caption)</label>
                        <textarea wire:model="editCaption" rows="2" class="block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"></textarea>
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium transition-colors" style="background-color: #dbeafe; color: #1d4ed8; border: none; cursor: pointer;">
                            Lưu thông tin ảnh
                        </button>
                    </div>
                </form>
            </div>

            <!-- Action Footer -->
            <div class="p-4 bg-gray-50 border-t border-gray-200 flex space-x-3" style="display: flex; gap: 0.75rem;">
                <button type="button" wire:click="$set('selectedMediaId', null)" class="flex-1 py-2 px-4 border rounded-md shadow-sm text-sm font-medium transition-colors" style="flex: 1; background-color: #ffffff; color: #374151; border: 1px solid #d1d5db; cursor: pointer;">
                    Hủy bỏ
                </button>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isPickerMode): ?>
                    <button type="button" wire:click="selectForField" class="flex-1 py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium transition-colors" style="flex: 1; background-color: #2563eb; color: #ffffff; border: none; cursor: pointer;">
                        Chọn ảnh này
                    </button>
                <?php else: ?>
                    <button type="button" @click="insertImage()" class="flex-1 py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium transition-colors" style="flex: 1; background-color: #2563eb; color: #ffffff; border: none; cursor: pointer;">
                        Chèn ảnh
                    </button>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\truyenthongcuulong-laravel\resources\views/livewire/admin/media-library-picker.blade.php ENDPATH**/ ?>