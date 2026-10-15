/**
 * Custom TinyMCE Integrations for Cuu Long Media
 * Registers Media Library button and file picker handler
 */
(function () {
    function initCuuLongTinyMce() {
        if (typeof tinymce === 'undefined') {
            setTimeout(initCuuLongTinyMce, 100);
            return;
        }

        tinymce.on('SetupEditor', function (e) {
            var editor = e.editor;

            // 1. Thêm nút Thư viện Media vào thanh toolbar
            editor.ui.registry.addButton('medialibrary', {
                icon: 'gallery',
                tooltip: 'Thư viện Media',
                onAction: function () {
                    var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                    var y = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight;

                    editor.windowManager.openUrl({
                        url: '/admin/media-picker',
                        title: 'Thư viện Media',
                        width: x * 0.9,
                        height: y * 0.9,
                    });
                }
            });

            // 2. Thiết lập file_picker_callback nếu được hỗ trợ
            if (editor.options && typeof editor.options.set === 'function') {
                editor.options.set('file_picker_callback', function (callback, value, meta) {
                    var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                    var y = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight;

                    editor.windowManager.openUrl({
                        url: '/admin/media-picker',
                        title: 'Thư viện Media',
                        width: x * 0.9,
                        height: y * 0.9,
                    });
                });
            }
        });

        // 3. Lắng nghe tin nhắn postMessage từ Media Picker iframe/modal
        window.addEventListener('message', function (event) {
            if (event.data && event.data.mceAction === 'insertImage') {
                var url = event.data.content;
                var alt = event.data.alt || '';
                var title = event.data.title || '';
                var caption = event.data.caption || '';

                var html = '<img src="' + url + '" alt="' + alt + '" title="' + title + '" style="max-width: 100%; height: auto;" />';
                if (caption) {
                    html = '<figure class="image">' + html + '<figcaption>' + caption + '</figcaption></figure>';
                }

                if (tinymce.activeEditor) {
                    tinymce.activeEditor.insertContent(html);
                    if (tinymce.activeEditor.windowManager && typeof tinymce.activeEditor.windowManager.close === 'function') {
                        tinymce.activeEditor.windowManager.close();
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
