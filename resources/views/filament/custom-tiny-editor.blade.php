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
            setup: function (editor) {
                if (typeof window._initCuuLongTinyEditor === 'function') {
                    window._initCuuLongTinyEditor(editor);
                }
            },
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
            custom_configs: Object.assign({
                rel_list: [
                    { title: 'Do Follow (Mặc định)', value: '' },
                    { title: 'No Follow (rel=nofollow)', value: 'nofollow' },
                    { title: 'No Follow & Mở tab mới', value: 'nofollow noopener noreferrer' }
                ],
                default_link_target: '_blank',
                link_title: true
            }, {{ $getCustomConfigs() }}),
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

@pushOnce('scripts')
<script>
    (function () {
        var MEDIA_LIBRARY_ICON_SVG = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="22" height="22"><path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" /></svg>';

        function openMediaPickerModal(editor, callback) {
            window._cuulongActiveTinyEditor = editor;
            window._cuulongTinyMediaCallback = callback || null;

            var w = Math.min(window.innerWidth * 0.92, 1150);
            var h = Math.min(window.innerHeight * 0.88, 760);

            editor.windowManager.openUrl({
                url: '/admin/media-picker',
                title: 'Thư viện Media Cửu Long',
                width: w,
                height: h
            });
        }

        function configureEditor(editor) {
            if (!editor || editor._cuulongConfigured) return;
            editor._cuulongConfigured = true;

            try {
                editor.ui.registry.addIcon('medialibrary_icon', MEDIA_LIBRARY_ICON_SVG);
                editor.ui.registry.addIcon('image', MEDIA_LIBRARY_ICON_SVG);
            } catch (e) {}

            var buttonAction = function () {
                openMediaPickerModal(editor);
            };

            try {
                editor.ui.registry.addButton('medialibrary', {
                    icon: 'medialibrary_icon',
                    tooltip: 'Thư viện Media (Chọn & tải ảnh mới)',
                    onAction: buttonAction
                });
            } catch (e) {}

            try {
                editor.ui.registry.addButton('image', {
                    icon: 'medialibrary_icon',
                    tooltip: 'Thư viện Media (Chọn & tải ảnh mới)',
                    onAction: buttonAction
                });
            } catch (e) {}

            try {
                editor.ui.registry.addMenuItem('image', {
                    icon: 'medialibrary_icon',
                    text: 'Thư viện Media...',
                    onAction: buttonAction
                });
            } catch (e) {}

            if (editor.options && typeof editor.options.set === 'function') {
                try {
                    editor.options.set('file_picker_callback', function (callback, value, meta) {
                        openMediaPickerModal(editor, callback);
                    });
                } catch (e) {}
            }
        }

        window._initCuuLongTinyEditor = configureEditor;

        function registerPlugin() {
            if (typeof tinymce === 'undefined') {
                setTimeout(registerPlugin, 50);
                return;
            }

            try {
                if (!tinymce.PluginManager.get('medialibrary')) {
                    tinymce.PluginManager.add('medialibrary', function (editor) {
                        configureEditor(editor);
                    });
                }
            } catch (e) {}

            tinymce.on('SetupEditor', function (e) {
                configureEditor(e.editor);
            });
        }

        registerPlugin();
    })();
</script>
@endPushOnce
