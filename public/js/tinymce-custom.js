/**
 * Custom TinyMCE Integrations for Cuu Long Media
 * Replaces default image button with the Media Library (DAM) Picker
 * Uses the exact Heroicon Photo matching the Admin Sidebar Menu
 */
(function () {
    // Exact heroicon-o-photo SVG matching Admin Menu "Thư Viện Media"
    var MEDIA_LIBRARY_ICON_SVG = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="22" height="22">' +
        '<path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />' +
        '</svg>';

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

    window._initCuuLongTinyEditor = function (editor) {
        if (!editor || editor._cuulongInitialized) return;
        editor._cuulongInitialized = true;

        // 1. Đăng ký custom icon: 'medialibrary_icon' (heroicon-o-photo)
        try {
            editor.ui.registry.addIcon('medialibrary_icon', MEDIA_LIBRARY_ICON_SVG);
        } catch (e) {}

        // 2. Đăng ký nút 'medialibrary' trên thanh công cụ
        try {
            editor.ui.registry.addButton('medialibrary', {
                icon: 'medialibrary_icon',
                tooltip: 'Thư viện Media (Chọn hoặc tải ảnh mới)',
                onAction: function () {
                    openMediaPickerModal(editor);
                }
            });
        } catch (e) {}

        // 3. Ghi đè cả nút 'image' để nếu thanh công cụ gọi 'image' cũng mở Thư viện Media
        try {
            editor.ui.registry.addButton('image', {
                icon: 'medialibrary_icon',
                tooltip: 'Thư viện Media (Chọn hoặc tải ảnh mới)',
                onAction: function () {
                    openMediaPickerModal(editor);
                }
            });
        } catch (e) {}

        // 4. Thiết lập file_picker_callback để bất kỳ hộp thoại nào cần ảnh đều dùng Thư viện Media
        if (editor.options && typeof editor.options.set === 'function') {
            editor.options.set('file_picker_callback', function (callback, value, meta) {
                openMediaPickerModal(editor, callback);
            });
        }
    };

    function initCuuLongTinyMce() {
        if (typeof tinymce !== 'undefined') {
            tinymce.on('SetupEditor', function (e) {
                window._initCuuLongTinyEditor(e.editor);
            });
        }
    }

    // 5. Lắng nghe tin nhắn postMessage từ Media Picker iframe/modal
    if (!window._cuulongPostMessageBound) {
        window._cuulongPostMessageBound = true;
        window.addEventListener('message', function (event) {
            if (event.data && event.data.mceAction === 'insertImage') {
                var url = event.data.content;
                var alt = event.data.alt || '';
                var title = event.data.title || '';
                var caption = event.data.caption || '';

                if (typeof window._cuulongTinyMediaCallback === 'function') {
                    window._cuulongTinyMediaCallback(url, { alt: alt, title: title });
                    window._cuulongTinyMediaCallback = null;
                }

                var editor = window._cuulongActiveTinyEditor || (typeof tinymce !== 'undefined' ? tinymce.activeEditor : null);
                if (editor) {
                    var html = '<img src="' + url + '" alt="' + alt + '" title="' + title + '" style="max-width: 100%; height: auto;" />';
                    if (caption) {
                        html = '<figure class="image">' + html + '<figcaption>' + caption + '</figcaption></figure>';
                    }
                    editor.insertContent(html);

                    try {
                        if (editor.windowManager && typeof editor.windowManager.close === 'function') {
                            editor.windowManager.close();
                        }
                    } catch (e) {
                        console.error('Lỗi khi đóng windowManager:', e);
                    }
                }
            }
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initCuuLongTinyMce);
    } else {
        initCuuLongTinyMce();
    }
})();
