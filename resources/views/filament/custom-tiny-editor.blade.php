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
            content_style: `{{ $contentStyle() }} body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif; font-size: 15px; line-height: 1.7; color: #334155; } table { width: 100% !important; border-collapse: collapse !important; margin: 18px 0 !important; border: 1.5px solid #CBD5E1 !important; background-color: #FFFFFF !important; } table th, table td { border: 1px solid #CBD5E1 !important; padding: 11px 15px !important; text-align: left !important; vertical-align: top !important; font-size: 14px !important; line-height: 1.6 !important; color: #334155 !important; } table thead th, table thead td, table tr:first-child th { background-color: #F8FAFC !important; font-weight: 700 !important; color: #0F172A !important; border: 1px solid #CBD5E1 !important; border-bottom: 2px solid #94A3B8 !important; } table tbody tr:nth-child(even) td, table tr:nth-child(even) td { background-color: #F8FAFC !important; } table tbody tr:hover td, table tr:hover td { background-color: #FFF7ED !important; } table td:first-child { font-weight: 600 !important; color: #0F172A !important; }`,
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

        var CLEAN_AI_ICON_SVG = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" width="20" height="20"><path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09ZM18.259 8.715 18 9.75l-.259-1.035a3.375 3.375 0 0 0-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 0 0 2.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 0 0 2.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 0 0-2.456 2.456ZM16.894 20.567 16.5 21.75l-.394-1.183a2.25 2.25 0 0 0-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 0 0 1.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 0 0 1.423 1.423l1.183.394-1.183.394a2.25 2.25 0 0 0-1.423 1.423Z" /></svg>';

        function cleanAiArtifacts(html) {
            if (!html || typeof html !== 'string') return html;
            var cleaned = html;

            // 1. Loại bỏ các nút bấm copy mã và thanh công cụ của AI
            cleaned = cleaned.replace(/<button[^>]*class="[^"]*(?:copy-code-button|copy-button|copy-to-clipboard)[^"]*"[^>]*>[\s\S]*?<\/button>/gi, '');
            cleaned = cleaned.replace(/<div[^>]*class="[^"]*(?:code-block-action-bar|code-block-decoration)[^"]*"[^>]*>[\s\S]*?<\/div>/gi, '');

            // 2. Xóa bỏ thẻ trích dẫn AI (giữ nguyên văn bản bên trong span)
            cleaned = cleaned.replace(/<span[^>]*class="[^"]*citation(?:-\d+|-[a-z0-9_-]+)?[^"]*"[^>]*>\s*<\/span>/gi, '');
            cleaned = cleaned.replace(/<span[^>]*class="[^"]*citation(?:-\d+|-[a-z0-9_-]+)?[^"]*"[^>]*>([\s\S]*?)<\/span>/gi, '$1');

            // 3. Xóa các thuộc tính nội bộ Angular và chatbot
            cleaned = cleaned.replace(/\s+(?:ng-[a-zA-Z0-9_\-]+|_ngcontent-[a-zA-Z0-9_\-]+|_nghost-[a-zA-Z0-9_\-]+|data-message-[a-zA-Z0-9_\-]+|data-testid)="[^"]*"/gi, '');
            cleaned = cleaned.replace(/\s+ng-[a-zA-Z0-9_\-]+\b/gi, '');

            // 4. Lọc sạch các class nhận diện AI
            var aiPatterns = [
                /^ng-tns-[a-zA-Z0-9_\-]+$/i,
                /^ng-animate-[a-zA-Z0-9_\-]+$/i,
                /^ng-trigger-[a-zA-Z0-9_\-]+$/i,
                /^ng-trigger$/i,
                /^ng-star-inserted$/i,
                /^markdown-main-panel$/i,
                /^md-content$/i,
                /^enable-luminous-fast-follows$/i,
                /^enable-updated-hr-color$/i,
                /^formatted-code-block-internal-container$/i,
                /^animated-opacity$/i,
                /^code-block$/i,
                /^code-block-internal-container$/i,
                /^text-token-[a-zA-Z0-9_\-]+$/i,
                /^bg-token-[a-zA-Z0-9_\-]+$/i,
                /^font-claude-[a-zA-Z0-9_\-]+$/i,
                /^claude-user-message$/i,
                /^dark:bg-[a-zA-Z0-9_\-]+$/i,
                /^contain-inline-size$/i,
                /^prose-invert$/i,
                /^conversation-turn$/i,
                /^attribution-item$/i
            ];

            cleaned = cleaned.replace(/\bclass="([^"]*)"/gi, function(match, clsStr) {
                var classes = clsStr.trim().split(/\s+/);
                var filtered = classes.filter(function(cls) {
                    if (!cls) return false;
                    for (var i = 0; i < aiPatterns.length; i++) {
                        if (aiPatterns[i].test(cls)) return false;
                    }
                    return true;
                });
                if (filtered.length === 0) return '';
                return 'class="' + filtered.join(' ') + '"';
            });

            cleaned = cleaned.replace(/\s+class=["']\s*["']/gi, '');

            // 5. Bóc tách (unwrap) các thẻ div bao bọc vô nghĩa
            try {
                var doc = new DOMParser().parseFromString('<div>' + cleaned + '</div>', 'text/html');
                var root = doc.body.firstElementChild;
                if (root) {
                    for (var step = 0; step < 4; step++) {
                        var divs = root.querySelectorAll('div');
                        var changed = false;
                        divs.forEach(function(div) {
                            var cls = (div.getAttribute('class') || '').trim();
                            var id = (div.getAttribute('id') || '').trim();
                            var style = (div.getAttribute('style') || '').trim();
                            if (!id && !style && (!cls || cls === 'container' || cls === 'markdown')) {
                                while (div.firstChild) {
                                    div.parentNode.insertBefore(div.firstChild, div);
                                }
                                div.parentNode.removeChild(div);
                                changed = true;
                            }
                        });
                        if (!changed) break;
                    }
                    cleaned = root.innerHTML;
                }
            } catch (err) {}

            return cleaned.trim();
        }

        function insertImageToTinyEditor(editor, data) {
            if (!editor || !data) return;
            var url = data.content || data.url;
            if (!url) return;

            if (!window._lastTinyMediaInsert) {
                window._lastTinyMediaInsert = { url: '', time: 0 };
            }
            var now = Date.now();
            if (window._lastTinyMediaInsert.url === url && (now - window._lastTinyMediaInsert.time) < 1200) {
                try {
                    if (editor.windowManager && typeof editor.windowManager.close === 'function') {
                        editor.windowManager.close();
                    }
                } catch (e) {}
                return;
            }
            window._lastTinyMediaInsert = { url: url, time: now };

            var alt = data.alt || '';
            var title = data.title || '';
            var caption = data.caption || '';

            if (typeof window._cuulongTinyMediaCallback === 'function') {
                window._cuulongTinyMediaCallback(url, { alt: alt, title: title });
                window._cuulongTinyMediaCallback = null;
            }

            var html = '';
            if (caption) {
                html = '<figure class="image">' +
                       '<img src="' + url + '" alt="' + alt + '" title="' + title + '" style="max-width: 100%; height: auto;" />' +
                       '<figcaption>' + caption + '</figcaption>' +
                       '</figure>';
            } else {
                html = '<img src="' + url + '" alt="' + alt + '" title="' + title + '" style="max-width: 100%; height: auto;" />';
            }

            try {
                editor.insertContent(html);
                editor.fire('change');
                editor.fire('input');
            } catch (e) {
                console.error('Lỗi khi chèn ảnh vào TinyMCE:', e);
            }

            try {
                if (editor.windowManager && typeof editor.windowManager.close === 'function') {
                    editor.windowManager.close();
                }
            } catch (e) {}
        }

        window._insertImageToTinyEditor = insertImageToTinyEditor;

        function openMediaPickerModal(editor, callback) {
            window._cuulongActiveTinyEditor = editor;
            window._cuulongTinyMediaCallback = callback || null;

            var w = Math.min(window.innerWidth * 0.92, 1150);
            var h = Math.min(window.innerHeight * 0.88, 760);

            editor.windowManager.openUrl({
                url: '/admin/media-picker',
                title: 'Thư viện Media Cửu Long',
                width: w,
                height: h,
                onMessage: function (dialogApi, details) {
                    if (details && details.mceAction === 'insertImage') {
                        insertImageToTinyEditor(editor, details);
                        try {
                            dialogApi.close();
                        } catch (e) {}
                    }
                }
            });
        }

        function configureEditor(editor) {
            if (!editor || editor._cuulongConfigured) return;
            editor._cuulongConfigured = true;

            // 1. Tự động đánh chặn & làm sạch mã AI khi dán từ clipboard (Paste)
            editor.on('PastePreProcess', function (e) {
                if (e.content) {
                    var original = e.content;
                    var processed = cleanAiArtifacts(original);
                    if (original !== processed) {
                        e.content = processed;
                        try {
                            if (editor.notificationManager) {
                                editor.notificationManager.open({
                                    text: '✨ Đã tự động loại bỏ mã rác AI (citation & Angular tags)!',
                                    type: 'info',
                                    timeout: 2500
                                });
                            }
                        } catch (nErr) {}
                    }
                }
            });

            try {
                editor.ui.registry.addIcon('medialibrary_icon', MEDIA_LIBRARY_ICON_SVG);
                editor.ui.registry.addIcon('image', MEDIA_LIBRARY_ICON_SVG);
                editor.ui.registry.addIcon('clean_ai_icon', CLEAN_AI_ICON_SVG);
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
                editor.ui.registry.addButton('clean_ai', {
                    icon: 'clean_ai_icon',
                    tooltip: 'Làm sạch mã AI (Xóa citation, Angular ng-*, wrapper rác)',
                    onAction: function () {
                        var content = editor.getContent();
                        var cleaned = cleanAiArtifacts(content);
                        editor.setContent(cleaned);
                        if (editor.notificationManager) {
                            editor.notificationManager.open({
                                text: '✨ Đã quét và làm sạch toàn bộ mã rác AI / Chatbot thành công!',
                                type: 'success',
                                timeout: 3000
                            });
                        }
                    }
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

        // Lắng nghe tin nhắn postMessage từ Media Picker iframe/modal
        if (!window._cuulongPostMessageBound) {
            window._cuulongPostMessageBound = true;
            window.addEventListener('message', function (event) {
                if (event.data && event.data.mceAction === 'insertImage') {
                    var editor = window._cuulongActiveTinyEditor || (typeof tinymce !== 'undefined' ? tinymce.activeEditor : null);
                    if (editor && typeof window._insertImageToTinyEditor === 'function') {
                        window._insertImageToTinyEditor(editor, event.data);
                    }
                }
            });
        }
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
