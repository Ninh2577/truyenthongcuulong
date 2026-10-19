@php
    $statePath = $getStatePath();
@endphp

<x-dynamic-component :component="$getFieldWrapperView()" :field="$field" class="relative z-0">
    @php
        $textareaID = 'tiny-editor-' . str_replace(['.', '#', '$'], '-', $getId()) . '-' . rand();
    @endphp

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
            language: '{{ $getInterfaceLanguage() }}',
            language_url: null,
            directionality: '{{ $getDirection() }}',
            @if ($getHeight())
            height: @js($getHeight()),
            @endif
            @if ($getMaxHeight())
            max_height: @js($getMaxHeight()),
            @endif
            @if ($getMinHeight())
            min_height: @js($getMinHeight()),
            @endif
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
            @if (!filament()->hasDarkModeForced() && $darkMode() == 'media') skin: (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'oxide-dark' : 'oxide'),
			content_css: (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'default'),
			@elseif(!filament()->hasDarkModeForced() && $darkMode() == 'class')
			skin: (document.querySelector('html').getAttribute('class').includes('dark') ? 'oxide-dark' : 'oxide'),
			content_css: (document.querySelector('html').getAttribute('class').includes('dark') ? 'dark' : 'default'),
			@elseif(filament()->hasDarkModeForced() || $darkMode() == 'force')
			skin: 'oxide-dark',
			content_css: 'dark',
			@elseif(!filament()->hasDarkModeForced() && $darkMode() == false)
			skin: 'oxide',
			content_css: 'default',
			@elseif(!filament()->hasDarkModeForced() && $darkMode() == 'custom')
			skin: '{{ $skinsUI() }}',
			content_css: '{{ $skinsContent() }}',
			@else
			skin: ((localStorage.getItem('theme') ?? 'system') == 'dark' || (localStorage.getItem('theme') === 'system' && window.matchMedia('(prefers-color-scheme: dark)').matches)) ? 'oxide-dark' : 'oxide',
			content_css: ((localStorage.getItem('theme') ?? 'system') == 'dark' || (localStorage.getItem('theme') === 'system' && window.matchMedia('(prefers-color-scheme: dark)').matches)) ? 'dark' : 'default',
            @endif
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
                link_rel_list: [
                    { text: 'Do Follow (Mặc định)', value: '' },
                    { text: 'No Follow (rel=nofollow)', value: 'nofollow' },
                    { text: 'No Follow & Mở tab mới', value: 'nofollow noopener noreferrer' }
                ],
                rel_list: [
                    { text: 'Do Follow (Mặc định)', value: '' },
                    { text: 'No Follow (rel=nofollow)', value: 'nofollow' },
                    { text: 'No Follow & Mở tab mới', value: 'nofollow noopener noreferrer' }
                ],
                link_default_target: '_blank',
                default_link_target: '_blank',
                link_title: true
            }, {{ $getCustomConfigs() }}),
        })">
        @if ($isDisabled())
            <div x-html="state" @style(['max-height: ' . $getPreviewMaxHeight() . 'px' => $getPreviewMaxHeight() > 0, 'min-height: ' . $getPreviewMinHeight() . 'px' => $getPreviewMinHeight() > 0])
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
                editor.options.set('file_picker_callback', function (callback, value, meta) {
                    openMediaPickerModal(editor, callback);
                });
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

@pushOnce('styles')
<style>
    /* Styling hộp thoại TinyMCE hiện đại, thoáng rộng & đẹp mắt */
    .tox.tox-tinymce-aux .tox-dialog {
        border-radius: 16px !important;
        overflow: hidden !important;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25) !important;
        border: 1px solid #e2e8f0 !important;
    }
    .tox.tox-tinymce-aux .tox-dialog--width-normal {
        width: 540px !important;
        max-width: 95vw !important;
    }
    .tox.tox-tinymce-aux .tox-dialog__header {
        padding: 16px 22px !important;
        background-color: #f8fafc !important;
        border-bottom: 1px solid #e2e8f0 !important;
    }
    .tox.tox-tinymce-aux .tox-dialog__title {
        font-size: 16px !important;
        font-weight: 700 !important;
        color: #0f172a !important;
    }
    .tox.tox-tinymce-aux .tox-dialog__body-content {
        padding: 20px 24px !important;
    }
    .tox.tox-tinymce-aux .tox-form__group {
        margin-bottom: 16px !important;
    }
    .tox.tox-tinymce-aux .tox-label {
        font-size: 13.5px !important;
        font-weight: 600 !important;
        color: #1e293b !important;
        margin-bottom: 7px !important;
        display: block !important;
    }
    .tox.tox-tinymce-aux .tox-textfield, 
    .tox.tox-tinymce-aux .tox-listboxfield .tox-listbox--select {
        border-radius: 8px !important;
        border: 1.5px solid #cbd5e1 !important;
        padding: 9px 14px !important;
        font-size: 13.5px !important;
        min-height: 42px !important;
        height: 42px !important;
        background-color: #ffffff !important;
        color: #0f172a !important;
        box-sizing: border-box !important;
        transition: all 0.2s ease !important;
    }
    .tox.tox-tinymce-aux .tox-textfield:focus, 
    .tox.tox-tinymce-aux .tox-listboxfield .tox-listbox--select:focus {
        border-color: #ff5e14 !important;
        box-shadow: 0 0 0 3px rgba(255, 94, 20, 0.15) !important;
        outline: none !important;
    }
    /* Menu dropdown cho Rel & Target */
    .tox.tox-tinymce-aux .tox-menu {
        border-radius: 12px !important;
        border: 1px solid #e2e8f0 !important;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.15), 0 8px 10px -6px rgba(0, 0, 0, 0.1) !important;
        padding: 6px !important;
        background-color: #ffffff !important;
    }
    .tox.tox-tinymce-aux .tox-collection__item {
        border-radius: 6px !important;
        padding: 8px 14px !important;
        font-size: 13.5px !important;
        font-weight: 500 !important;
        color: #334155 !important;
        cursor: pointer !important;
        transition: all 0.15s ease !important;
    }
    .tox.tox-tinymce-aux .tox-collection__item:hover,
    .tox.tox-tinymce-aux .tox-collection__item--active {
        background-color: #fff7ed !important;
        color: #ea580c !important;
        font-weight: 600 !important;
    }
    .tox.tox-tinymce-aux .tox-collection__item-checkmark {
        color: #ea580c !important;
    }
    /* Nút bấm Lưu / Hủy */
    .tox.tox-tinymce-aux .tox-dialog__footer {
        padding: 14px 24px !important;
        background-color: #f8fafc !important;
        border-top: 1px solid #e2e8f0 !important;
    }
    .tox.tox-tinymce-aux .tox-button--primary {
        background-color: #ff5e14 !important;
        border-color: #ff5e14 !important;
        border-radius: 8px !important;
        padding: 9px 20px !important;
        font-weight: 700 !important;
        font-size: 13.5px !important;
        box-shadow: 0 4px 6px -1px rgba(255, 94, 20, 0.25) !important;
        transition: all 0.2s ease !important;
    }
    .tox.tox-tinymce-aux .tox-button--primary:hover {
        background-color: #e04e0b !important;
        border-color: #e04e0b !important;
    }
    .tox.tox-tinymce-aux .tox-button--secondary {
        border-radius: 8px !important;
        padding: 9px 18px !important;
        border: 1px solid #cbd5e1 !important;
        background: #ffffff !important;
        color: #475569 !important;
        font-weight: 600 !important;
        font-size: 13.5px !important;
    }
</style>
@endPushOnce
