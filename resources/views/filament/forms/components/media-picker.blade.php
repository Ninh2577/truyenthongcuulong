<x-dynamic-component
    :component="$getFieldWrapperView()"
    :field="$field"
>
    <div x-data="{ state: $wire.$entangle('{{ $getStatePath() }}') }">
        
        <!-- Empty State -->
        <template x-if="!state">
            <div 
                x-on:click="$dispatch('open-modal', { id: 'media-picker-modal-{{ $getStatePath() }}' })"
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
                <div x-on:click="$dispatch('open-modal', { id: 'media-picker-modal-{{ $getStatePath() }}' })">
                    <img :src="state.startsWith('http') ? state : ('{{ asset('storage') }}' + '/' + state.replace(/^\/+/, ''))" class="w-full object-contain" style="max-height: 300px;" />
                    
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
        <x-filament::modal id="media-picker-modal-{{ $getStatePath() }}" width="7xl" class="p-0">
            <x-slot name="heading">
                Thư viện Media
            </x-slot>
            
            <div class="h-[80vh] overflow-hidden -mx-6 -mb-6" 
                 x-on:media-selected.window="if ($event.detail.target === '{{ $getStatePath() }}') { state = $event.detail.path; $dispatch('close-modal', { id: 'media-picker-modal-{{ $getStatePath() }}' }); }">
                @livewire('admin.media-library-picker', ['isPickerMode' => true, 'targetStatePath' => $getStatePath()], key('media-picker-'.$getStatePath()))
            </div>
        </x-filament::modal>
    </div>
</x-dynamic-component>
