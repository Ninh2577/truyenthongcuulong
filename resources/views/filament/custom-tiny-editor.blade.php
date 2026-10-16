@php
    $statePath = $getStatePath();
    $textareaID = 'tiny-editor-' . str_replace(['.', '#', '$'], '-', $getId()) . '-' . rand();
@endphp

<x-dynamic-component :component="$getFieldWrapperView()" :field="$field" class="relative z-0">
    <div wire:ignore x-ignore x-load
        x-load-src="{{ \Filament\Support\Facades\FilamentAsset::getAlpineComponentSrc('tinyeditor', 'amidesfahani/filament-tinyeditor') }}"
        x-load-css="[@js(\Filament\Support\Facades\FilamentAsset::getStyleHref('tiny-css', package: 'amidesfahani/filament-tinyeditor'))]"
        x-load-js="[]"
        x-data="tinyeditor({
            state: $wire.{{ $applyStateBindingModifiers("entangle('{$statePath}')", isOptimisticallyLive: false) }},
            statePath: '{{ $statePath }}',
            selector: '#{{ $textareaID }}',
            plugins: '{{ $getPlugins() }}',
            external_plugins: {{ $getExternalPlugins() }},
            toolbar: '{{ $getToolbar() }}',
            content_style: '{{ $contentStyle() }}',
            @if(!$getTextPattern())
                text_patterns: @js($getTextPattern()),
            @endif
            language: 'vi',
            language_url: null,
            directionality: '{{ $getDirection() }}',
            @if ($getHeight())
            height: @js($getHeight()),
            @endif
            @if ($getMaxHeight())
            max_height: @js($getMaxHeight()),
            @endif
            min_height: {{ $getMinHeight() ?: 500 }},
            @if ($getWidth())
            width: @js($getWidth()),
            @endif
            @if ($getTinyMaxWidth())
            max_width: @js($getTinyMaxWidth()),
            @endif
            @if ($getMinWidth())
            min_width: @js($getMinWidth()),
            @endif
            resize: @js($getResize()),
            base_url: '{{ asset('vendor/tinymce') }}',
            skin: (document.querySelector('html')?.classList.contains('dark')) ? 'oxide-dark' : 'oxide',
            skin_url: (document.querySelector('html')?.classList.contains('dark')) ? '{{ asset('vendor/tinymce/skins/ui/oxide-dark') }}' : '{{ asset('vendor/tinymce/skins/ui/oxide') }}',
            content_css: (document.querySelector('html')?.classList.contains('dark')) ? '{{ asset('vendor/tinymce/skins/content/dark/content.min.css') }}' : '{{ asset('vendor/tinymce/skins/content/default/content.min.css') }}',
            toolbar_sticky: {{ $getToolbarSticky() ? 'true' : 'false' }},
            toolbar_sticky_offset: {{ $getToolbarStickyOffset() }},
            toolbar_mode: '{{ $getToolbarMode() }}',
            toolbar_location: '{{ $getToolbarLocation() }}',
            inline: {{ $getInlineOption() ? 'true' : 'false' }},
            toolbar_persist: {{ $getToolbarPersist() ? 'true' : 'false' }},
            menubar: {{ $getShowMenuBar() ? 'true' : 'false' }},
            relative_urls: {{ $getRelativeUrls() ? 'true' : 'false' }},
            remove_script_host: {{ $getRemoveScriptHost() ? 'true' : 'false' }},
            convert_urls: {{ $getConvertUrls() ? 'true' : 'false' }},
            font_size_formats: '{{ $getFontSizes() }}',
            fontfamily: '{{ $getFontFamilies() }}',
            setup: null,
            disabled: @js($isDisabled),
            locale: '{{ app()->getLocale() }}',
            placeholder: @js($getPlaceholder()),
            image_list: {!! $getImageList() !!},
            @if ($getImagesUploadUrl !== false)
            images_upload_url: @js($getImagesUploadUrl()),
            @endif
            image_advtab: @js($imageAdvtab()),
            image_description: @js($getImageDescription()),
            image_class_list: @js($getImageClassList()),
            license_key: 'gpl',
            custom_configs: {{ $getCustomConfigs() }},
        })">
        @if ($isDisabled())
            <div x-html="state" @style(['max-height: ' . $getPreviewMaxHeight() . 'px' => $getPreviewMaxHeight() > 0, 'min-height: ' . ($getMinHeight() ?: 500) . 'px'])
                class="block w-full p-3 overflow-y-auto prose transition duration-75 bg-white border border-gray-300 rounded-lg shadow-sm max-w-none opacity-70 dark:prose-invert dark:border-gray-600 dark:bg-gray-700 dark:text-white">
            </div>
        @else
            <input id="{{ $textareaID }}" type="hidden" x-ref="tinymce" placeholder="{{ $getPlaceholder() }}">
        @endif
    </div>
</x-dynamic-component>
