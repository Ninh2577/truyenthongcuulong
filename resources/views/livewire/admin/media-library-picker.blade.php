<div class="flex {{ $isPickerMode ? 'h-full max-h-full' : 'h-screen' }} w-full bg-gray-50 font-sans" 
     style="display: flex; width: 100%; {{ $isPickerMode ? 'height: 100%; max-height: 100%;' : 'height: 100vh;' }} overflow: hidden;"
     x-data="{
        insertImage() {
            if (typeof window.insertImageDirectly === 'function') {
                window.insertImageDirectly();
            }
            try {
                $wire.saveMetadata();
            } catch (e) {}
        }
     }">
    <!-- Main Content Area: Grid -->
    <div class="flex-1 flex flex-col h-full overflow-hidden" style="flex: 1; display: flex; flex-direction: column; height: 100%; overflow: hidden; min-width: 0;">
        
        <!-- Header / Toolbar -->
        <div class="flex-shrink-0 flex items-center justify-between px-6 py-4 bg-white border-b border-gray-200" style="display: flex; justify-content: space-between; align-items: center; width: 100%; flex-shrink: 0;">
            @if(!$isPickerMode)
                <h1 class="text-xl font-bold text-gray-800 mr-6 whitespace-nowrap">Thư viện Media</h1>
            @endif
            
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
                    <input type="file" wire:model="uploads" multiple accept=".jpg,.jpeg,.png,.webp,.gif,image/jpeg,image/png,image/webp,image/gif" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0; cursor: pointer;" />
                </div>
            </div>
        </div>

        <!-- Flash Message -->
        @if (session()->has('message'))
            <div class="px-6 py-3 bg-green-50 text-green-700 text-sm font-medium border-b border-green-200">
                {{ session('message') }}
            </div>
        @endif
        
        @error('uploads.*') <span class="px-6 py-2 text-sm text-red-600">{{ $message }}</span> @enderror

        <!-- Grid Area -->
        <div class="flex-1 overflow-y-auto p-6" id="media-grid" style="flex: 1; overflow-y: auto; padding: 1.5rem; min-height: 0;">
            
            @if(count($mediaFiles) === 0)
                <div class="flex flex-col items-center justify-center h-64 text-gray-400">
                    <svg class="w-16 h-16 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    <p class="text-lg font-medium text-gray-600">Không tìm thấy hình ảnh nào</p>
                </div>
            @else
                <div style="display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 1rem;">
                    @foreach($mediaFiles as $file)
                        @php
                            $imageUrl = $file['url'] ?? (str_starts_with($file['path'], 'images/') ? asset($file['path']) : asset('storage/' . $file['path']));
                        @endphp
                        <div wire:click="selectMedia({{ $file['id'] }})" 
                             @if($isPickerMode)
                             wire:dblclick="selectAndInsert({{ $file['id'] }})"
                             @else
                             wire:dblclick="selectMedia({{ $file['id'] }})"
                             x-on:dblclick="window.insertDirectImage('{{ addslashes($imageUrl) }}', '{{ addslashes($file['alt_text'] ?? '') }}', '{{ addslashes($file['title'] ?? '') }}', '{{ addslashes($file['caption'] ?? '') }}')"
                             @endif
                             title="Nhấp để chọn, nhấp đúp để chèn ngay"
                             class="group relative aspect-square bg-gray-100 rounded-xl overflow-hidden border-2 cursor-pointer transition-all duration-200 
                                    {{ $selectedMediaId === $file['id'] ? 'border-blue-500 shadow-md ring-2 ring-blue-500 ring-opacity-50' : 'border-transparent hover:border-gray-300 hover:shadow-sm' }}">
                            
                            <img src="{{ $imageUrl }}" alt="{{ $file['alt_text'] ?? '' }}" loading="lazy" class="w-full h-full object-cover">
                            
                            <!-- Selected Checkmark -->
                            @if($selectedMediaId === $file['id'])
                                <div class="absolute top-2 right-2 w-6 h-6 bg-blue-500 rounded-full flex items-center justify-center text-white shadow-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                </div>
                            @endif

                            <!-- Filename Overlay (Hover) -->
                            <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/70 to-transparent p-3 translate-y-full group-hover:translate-y-0 transition-transform duration-200">
                                <p class="text-white text-xs truncate">{{ $file['filename'] ?? 'Không tên' }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            <!-- Loading Spinner / Infinite Scroll Trigger -->
            @if($hasMore)
                <div class="mt-8 flex justify-center pb-8" x-intersect="$wire.loadMore()">
                    <svg class="animate-spin h-8 w-8 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </div>
            @endif
        </div>
    </div>

    <!-- Sidebar: Image Details & Form -->
    <div class="bg-white border-l border-gray-200 flex flex-col h-full flex-shrink-0 transition-all duration-300 {{ $selectedMediaId ? 'translate-x-0' : 'translate-x-full hidden' }}" 
         style="width: 380px; min-width: 380px; max-width: 380px; height: 100%; display: {{ $selectedMediaId ? 'flex' : 'none' }}; flex-direction: column; flex-shrink: 0;">
        
        @if($selectedMediaId)
            <div class="flex-shrink-0 p-4 border-b border-gray-200 bg-gray-50 flex justify-between items-center" style="flex-shrink: 0; display: flex; justify-content: space-between; align-items: center; padding: 1rem; border-bottom: 1px solid #e5e7eb; background-color: #f9fafb;">
                <h2 class="text-sm font-semibold text-gray-700 uppercase tracking-wider" style="font-size: 0.875rem; font-weight: 600; color: #374151; text-transform: uppercase;">Chi tiết đính kèm</h2>
                <button type="button" wire:click="$set('selectedMediaId', null)" class="text-gray-400 hover:text-gray-600" style="color: #9ca3af; cursor: pointer; border: none; background: transparent;">
                    <svg class="w-5 h-5" style="width: 1.25rem; height: 1.25rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <div class="flex-1 overflow-y-auto p-5 space-y-4" style="flex: 1; overflow-y: auto; padding: 1.25rem; min-height: 0;">
                <!-- Preview Image -->
                <div class="bg-gray-100 rounded-lg overflow-hidden border border-gray-200 flex items-center justify-center mb-4" style="aspect-ratio: 16/9; max-height: 180px;">
                    <img src="{{ $editUrl }}" class="max-w-full max-h-full object-contain" style="max-height: 180px;">
                </div>
                
                <!-- URL Field -->
                <div style="margin-bottom: 1rem;">
                    <label class="block text-xs font-medium text-gray-700 mb-1" style="display: block; font-size: 0.75rem; font-weight: 500; color: #374151; margin-bottom: 0.25rem;">URL tệp (Read-only)</label>
                    <div class="flex" style="display: flex;">
                        <input id="media-edit-url" type="text" readonly value="{{ $editUrl }}" class="flex-1 block w-full rounded-l-md border-gray-300 bg-gray-50 text-gray-500 sm:text-sm focus:border-blue-500 focus:ring-blue-500" style="flex: 1; padding: 0.375rem 0.5rem; font-size: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.375rem 0 0 0.375rem; background-color: #f9fafb; color: #6b7280;">
                        <button type="button" onclick="navigator.clipboard.writeText('{{ $editUrl }}'); window.showCuuLongAlert('Đã sao chép liên kết hình ảnh vào bộ nhớ tạm!', 'Đã Sao Chép');" class="inline-flex items-center px-3 rounded-r-md border border-l-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm hover:bg-gray-100" style="padding: 0.375rem 0.75rem; font-size: 0.75rem; border: 1px solid #d1d5db; border-left: none; border-radius: 0 0.375rem 0.375rem 0; background-color: #f3f4f6; cursor: pointer;">
                            Copy
                        </button>
                    </div>
                </div>

                <!-- Form Fields -->
                <form wire:submit.prevent="saveMetadata" style="display: flex; flex-direction: column; gap: 0.75rem;">
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1" style="display: block; font-size: 0.75rem; font-weight: 500; color: #374151; margin-bottom: 0.25rem;">Tiêu đề (Title)</label>
                        <input id="media-edit-title" type="text" wire:model="editTitle" class="block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" style="width: 100%; padding: 0.375rem 0.5rem; font-size: 0.8125rem; border: 1px solid #d1d5db; border-radius: 0.375rem;">
                    </div>
                    
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1" style="display: block; font-size: 0.75rem; font-weight: 500; color: #374151; margin-bottom: 0.25rem;">Văn bản thay thế (Alt Text) - Tối ưu SEO</label>
                        <input id="media-edit-alt" type="text" wire:model="editAltText" class="block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" style="width: 100%; padding: 0.375rem 0.5rem; font-size: 0.8125rem; border: 1px solid #d1d5db; border-radius: 0.375rem;">
                        <p class="mt-1 text-[11px] text-gray-500" style="font-size: 0.6875rem; color: #6b7280; margin-top: 0.25rem;">Mô tả hình ảnh cho các máy tìm kiếm (Google) và người khiếm thị.</p>
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1" style="display: block; font-size: 0.75rem; font-weight: 500; color: #374151; margin-bottom: 0.25rem;">Mô tả SEO (SEO Description)</label>
                        <textarea id="media-edit-desc" wire:model="editDescription" rows="2" class="block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" style="width: 100%; padding: 0.375rem 0.5rem; font-size: 0.8125rem; border: 1px solid #d1d5db; border-radius: 0.375rem; resize: vertical;"></textarea>
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1" style="display: block; font-size: 0.75rem; font-weight: 500; color: #374151; margin-bottom: 0.25rem;">Chú thích (Caption)</label>
                        <textarea id="media-edit-caption" wire:model="editCaption" rows="2" class="block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" style="width: 100%; padding: 0.375rem 0.5rem; font-size: 0.8125rem; border: 1px solid #d1d5db; border-radius: 0.375rem; resize: vertical;"></textarea>
                    </div>

                    <div style="padding-top: 0.25rem;">
                        <button type="submit" class="w-full flex justify-center py-1.5 px-3 border border-transparent rounded-md shadow-sm text-xs font-medium transition-colors" style="width: 100%; display: flex; justify-content: center; padding: 0.5rem 0.75rem; background-color: #eff6ff; color: #1d4ed8; border: 1px solid #bfdbfe; border-radius: 0.375rem; cursor: pointer; font-weight: 500;">
                            Lưu thông tin ảnh
                        </button>
                    </div>
                </form>
            </div>

            <!-- Action Footer (Permanently Pinned at Bottom) -->
            <div class="flex-shrink-0 p-4 bg-gray-50 border-t border-gray-200" style="flex-shrink: 0; padding: 1rem; background-color: #f9fafb; border-top: 1px solid #e5e7eb; display: flex; gap: 0.75rem; z-index: 10;">
                <button type="button" wire:click="$set('selectedMediaId', null)" class="py-2.5 px-4 border rounded-lg text-sm font-medium transition-colors hover:bg-gray-100" style="flex: 1; padding: 0.625rem 1rem; background-color: #ffffff; color: #374151; border: 1px solid #d1d5db; border-radius: 0.5rem; cursor: pointer; text-align: center; font-weight: 500;">
                    Hủy bỏ
                </button>
                @if($isPickerMode)
                    <button type="button" wire:click="selectForField" class="inline-flex items-center justify-center py-2.5 px-4 rounded-lg text-sm font-semibold transition-colors hover:bg-blue-700" style="flex: 1.5; padding: 0.625rem 1rem; background-color: #2563eb; color: #ffffff; border: none; border-radius: 0.5rem; cursor: pointer; text-align: center; display: inline-flex; align-items: center; justify-content: center; gap: 0.375rem; font-weight: 600; box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);">
                        <svg style="width: 1.125rem; height: 1.125rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                        <span>Chèn ảnh</span>
                    </button>
                @else
                    <button type="button" @click="insertImage()" class="inline-flex items-center justify-center py-2.5 px-4 rounded-lg text-sm font-semibold transition-colors hover:bg-blue-700" style="flex: 1.5; padding: 0.625rem 1rem; background-color: #2563eb; color: #ffffff; border: none; border-radius: 0.5rem; cursor: pointer; text-align: center; display: inline-flex; align-items: center; justify-content: center; gap: 0.375rem; font-weight: 600; box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);">
                        <svg style="width: 1.125rem; height: 1.125rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                        <span>Chèn ảnh</span>
                    </button>
                @endif
            </div>
        @endif
        
    </div>
</div>

<script>
    window.showCuuLongAlert = function (message, title = 'Thông Báo') {
        if (!message) return;
        if (window.ClElegantModal && typeof window.ClElegantModal.alert === 'function') {
            window.ClElegantModal.alert(message, title);
        } else if (window.parent && window.parent.ClElegantModal && typeof window.parent.ClElegantModal.alert === 'function') {
            window.parent.ClElegantModal.alert(message, title);
        } else if (window.top && window.top.ClElegantModal && typeof window.top.ClElegantModal.alert === 'function') {
            window.top.ClElegantModal.alert(message, title);
        } else {
            alert(message);
        }
    };

    window.insertDirectImage = function (url, alt, title, caption) {
        if (!url) {
            window.showCuuLongAlert('Vui lòng chọn một hình ảnh hợp lệ để chèn!', 'Chưa Chọn Ảnh');
            return;
        }

        var msg = {
            mceAction: 'insertImage',
            content: url,
            url: url,
            alt: alt || '',
            title: title || '',
            caption: caption || ''
        };

        // 1. Gửi tin nhắn đến cửa sổ cha (TinyMCE openUrl modal iframe)
        if (window.parent && window.parent !== window) {
            window.parent.postMessage(msg, '*');
        }

        // 2. Gửi tin nhắn đến cửa sổ mở (nếu mở dạng popup)
        if (window.opener && window.opener !== window) {
            window.opener.postMessage(msg, '*');
        }

        // 3. Gửi tin nhắn đến window.top
        if (window.top && window.top !== window && window.top !== window.parent) {
            window.top.postMessage(msg, '*');
        }
    };

    window.insertImageDirectly = function () {
        if (window._isInsertingMedia) return;
        window._isInsertingMedia = true;
        setTimeout(function () {
            window._isInsertingMedia = false;
        }, 1200);

        var urlEl = document.getElementById('media-edit-url');
        var altEl = document.getElementById('media-edit-alt');
        var titleEl = document.getElementById('media-edit-title');
        var captionEl = document.getElementById('media-edit-caption');

        var url = (urlEl ? urlEl.value : '').trim();
        if (!url) {
            window.showCuuLongAlert('Vui lòng chọn một hình ảnh trong danh sách trước khi chèn!', 'Chưa Chọn Hình Ảnh');
            return;
        }

        var alt = (altEl ? altEl.value : '').trim();
        var title = (titleEl ? titleEl.value : '').trim();
        var caption = (captionEl ? captionEl.value : '').trim();

        window.insertDirectImage(url, alt, title, caption);
    };
</script>
