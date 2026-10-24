@php
    $currentUser = auth()->user() ?? auth('web')->user() ?? (class_exists(\Filament\Facades\Filament::class) ? \Filament\Facades\Filament::auth()->user() : null);
    $canAccessChat = false;
    if ($currentUser) {
        $canAccessChat = \Illuminate\Support\Facades\Gate::forUser($currentUser)->allows('viewAny', \App\Models\ChatConversation::class)
            || $currentUser->hasAnyRole(['super_admin', 'Admin', 'Biên Tập Viên'])
            || $currentUser->can('view_any_chat_conversation')
            || $currentUser->email === 'admin@truyenthongcuulong.com';
    }
@endphp

@php
    $isChatInbox = request()->routeIs('filament.admin.pages.chat-inbox') || str_contains(request()->path(), 'chat-inbox');
@endphp

@if($canAccessChat && ! $isChatInbox)
<div id="cl-global-chat-notification-root" style="position: relative; z-index: 9999999;">
    <style>
        /* Floating Permission Banner */
        .cl-perm-banner {
            position: fixed;
            top: 18px;
            right: 20px;
            z-index: 9999998;
            background: #ffffff;
            border: 1.5px solid #fed7aa;
            border-left: 5px solid #ff5400;
            border-radius: 14px;
            box-shadow: 0 12px 30px -5px rgba(255, 84, 0, 0.2), 0 4px 10px -2px rgba(0, 0, 0, 0.08);
            padding: 12px 16px;
            display: flex;
            align-items: center;
            gap: 14px;
            max-width: 450px;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            animation: clFadeDown 0.35s cubic-bezier(0.16, 1, 0.3, 1);
        }
        @keyframes clFadeDown {
            from { opacity: 0; transform: translateY(-12px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Bottom-Right Floating In-Page Toast */
        .cl-global-toast {
            position: fixed;
            bottom: 24px;
            right: 24px;
            z-index: 9999999;
            width: 360px;
            background: #ffffff;
            border: 1.5px solid #ff5400;
            border-radius: 16px;
            box-shadow: 0 16px 36px -4px rgba(255, 84, 0, 0.3), 0 8px 16px -4px rgba(0, 0, 0, 0.12);
            padding: 14px 16px;
            box-sizing: border-box;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            display: none;
            opacity: 0;
            transform: translateY(20px) scale(0.96);
            transition: opacity 0.28s cubic-bezier(0.16, 1, 0.3, 1), transform 0.28s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .cl-global-toast.show {
            display: block;
            opacity: 1;
            transform: translateY(0) scale(1);
        }
        .cl-global-toast-dot {
            width: 9px;
            height: 9px;
            border-radius: 9999px;
            background: #ff5400;
            display: inline-block;
            box-shadow: 0 0 0 0 rgba(255, 84, 0, 0.7);
            animation: clPulseOrange 1.6s infinite;
        }
        @keyframes clPulseOrange {
            0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(255, 84, 0, 0.7); }
            70% { transform: scale(1); box-shadow: 0 0 0 8px rgba(255, 84, 0, 0); }
            100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(255, 84, 0, 0); }
        }
    </style>

    {{-- Permission Banner (shown if browser desktop notification is not yet granted) --}}
    <div id="cl-perm-banner-el" class="cl-perm-banner" style="display: none;">
        <div style="font-size: 22px; line-height: 1;">🔔</div>
        <div style="flex: 1; min-width: 0;">
            <div style="font-size: 13px; font-weight: 700; color: #0f172a; line-height: 1.3;">Bật thông báo ngoài màn hình</div>
            <div style="font-size: 11px; color: #64748b; line-height: 1.4; margin-top: 3px;">
                Nhận thông báo nổi góc màn hình ngay cả khi bạn đang mở Word, Excel, Zalo hay ẩn trình duyệt.
            </div>
        </div>
        <button
            type="button"
            id="cl-btn-enable-notif"
            style="padding: 7px 12px; font-size: 11px; font-weight: 700; border-radius: 8px; border: none; background: #ff5400; color: #ffffff; cursor: pointer; white-space: nowrap; box-shadow: 0 2px 6px rgba(255,84,0,0.3); transition: transform 0.15s;"
            onmouseover="this.style.transform='scale(1.03)'"
            onmouseout="this.style.transform='scale(1)'"
        >
            Bật ngay
        </button>
        <button
            type="button"
            id="cl-btn-close-perm"
            style="border: none; background: transparent; color: #94a3b8; cursor: pointer; padding: 2px 6px; font-size: 18px; line-height: 1;"
            title="Đóng"
        >×</button>
    </div>

    {{-- Bottom-Right Floating In-Page Toast --}}
    <div id="cl-global-toast-el" class="cl-global-toast">
        <div style="display: flex; align-items: flex-start; justify-content: space-between; gap: 8px;">
            <div style="display: flex; align-items: center; gap: 6px;">
                <span class="cl-global-toast-dot"></span>
                <span style="font-size: 11px; font-weight: 700; color: #ff5400; text-transform: uppercase; letter-spacing: 0.05em;">
                    Tin nhắn mới
                </span>
                <span id="cl-toast-badge-count" style="display: none; font-size: 10px; font-weight: 700; background: #ff5400; color: #fff; padding: 1px 6px; border-radius: 9999px;"></span>
            </div>
            <button
                type="button"
                id="cl-btn-dismiss-toast"
                style="border: none; background: transparent; color: #94a3b8; cursor: pointer; padding: 0; font-size: 18px; line-height: 1; transition: color 0.15s;"
                onmouseover="this.style.color='#475569'"
                onmouseout="this.style.color='#94a3b8'"
                title="Đóng thông báo"
            >×</button>
        </div>

        <div style="margin-top: 8px;">
            <h5 id="cl-toast-customer" style="font-size: 13px; font-weight: 700; color: #0f172a; margin: 0; display: flex; align-items: center; gap: 6px;">
                <span>Khách hàng</span>
                <span style="font-size: 10px; font-weight: 500; color: #64748b; background: #f1f5f9; padding: 1px 6px; border-radius: 4px;">Khách hàng</span>
            </h5>
            <p id="cl-toast-preview" style="font-size: 12px; color: #475569; margin: 4px 0 0 0; line-height: 1.4; max-height: 42px; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;"></p>
        </div>

        <div style="margin-top: 12px; display: flex; align-items: center; justify-content: space-between;">
            <span style="font-size: 11px; color: #94a3b8;">Vừa xong</span>
            <button
                type="button"
                id="cl-btn-view-chat"
                style="padding: 6px 14px; font-size: 12px; font-weight: 700; border-radius: 8px; border: none; background: linear-gradient(135deg, #ff5400 0%, #ff6b1a 100%); color: #ffffff; cursor: pointer; box-shadow: 0 2px 8px rgba(255, 84, 0, 0.35); display: flex; align-items: center; gap: 6px; transition: transform 0.15s;"
                onmouseover="this.style.transform='translateY(-1px)'"
                onmouseout="this.style.transform='translateY(0)'"
            >
                <span>Xem cuộc trò chuyện</span>
                <svg style="width: 13px; height: 13px;" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                </svg>
            </button>
        </div>
    </div>
</div>

<script>
(function () {
    // Avoid double execution on the same page
    if (window.__clGlobalNotifierActive) return;
    window.__clGlobalNotifierActive = true;

    var lastKnownId = 0;
    var popupTimer = null;
    var originalTitle = document.title;
    var bgWorker = null;
    var fallbackTimer = null;
    var currentConversationUuid = '';
    var swRegistration = null;

    // Register Service Worker for robust Desktop Notifications
    if ('serviceWorker' in navigator) {
        navigator.serviceWorker.register('/sw.js').then(function (reg) {
            swRegistration = reg;
        }).catch(function () {});
    }

    var permBanner = document.getElementById('cl-perm-banner-el');
    var toastEl = document.getElementById('cl-global-toast-el');
    var toastCustomer = document.getElementById('cl-toast-customer');
    var toastPreview = document.getElementById('cl-toast-preview');
    var toastBadge = document.getElementById('cl-toast-badge-count');
    var btnEnableNotif = document.getElementById('cl-btn-enable-notif');
    var btnClosePerm = document.getElementById('cl-btn-close-perm');
    var btnDismissToast = document.getElementById('cl-btn-dismiss-toast');
    var btnViewChat = document.getElementById('cl-btn-view-chat');

    // Check permission state & show banner if default
    function checkPermissionUI() {
        if ('Notification' in window) {
            if (Notification.permission === 'default') {
                var dismissed = sessionStorage.getItem('cl_perm_banner_dismissed');
                if (!dismissed && permBanner) {
                    permBanner.style.display = 'flex';
                }
            } else if (permBanner) {
                permBanner.style.display = 'none';
            }
        }
    }

    if (btnEnableNotif) {
        btnEnableNotif.addEventListener('click', function () {
            if ('Notification' in window) {
                Notification.requestPermission().then(function (perm) {
                    checkPermissionUI();
                    if (perm === 'granted') {
                        triggerDesktopNotification({
                            customer_name: 'Truyền Thông Cửu Long',
                            preview: 'Đã kích hoạt thông báo thành công! Tin nhắn mới sẽ hiển thị nổi trên màn hình cả khi bạn đang mở Word, Excel hay ứng dụng khác.',
                            conversation_uuid: ''
                        });
                    }
                });
            }
        });
    }

    if (btnClosePerm) {
        btnClosePerm.addEventListener('click', function () {
            if (permBanner) permBanner.style.display = 'none';
            sessionStorage.setItem('cl_perm_banner_dismissed', '1');
        });
    }

    if (btnDismissToast) {
        btnDismissToast.addEventListener('click', function () {
            hideToast();
        });
    }

    if (btnViewChat) {
        btnViewChat.addEventListener('click', function () {
            hideToast();
            document.title = originalTitle;
            if (currentConversationUuid) {
                window.location.href = '/cuulongteam/chat-inbox?conversation=' + encodeURIComponent(currentConversationUuid);
            } else {
                window.location.href = '/cuulongteam/chat-inbox';
            }
        });
    }

    if (toastEl) {
        toastEl.addEventListener('mouseenter', function () {
            if (popupTimer) clearTimeout(popupTimer);
        });
        toastEl.addEventListener('mouseleave', function () {
            popupTimer = setTimeout(hideToast, 5000);
        });
    }

    function showToast(data) {
        if (!toastEl) return;
        currentConversationUuid = data.conversation_uuid || '';

        if (toastCustomer) {
            toastCustomer.innerHTML = '<span>' + escapeHtml(data.customer_name || 'Khách hàng') + '</span> <span style="font-size: 10px; font-weight: 500; color: #64748b; background: #f1f5f9; padding: 1px 6px; border-radius: 4px;">Khách hàng</span>';
        }
        if (toastPreview) {
            toastPreview.textContent = data.preview || 'Khách hàng vừa gửi tin nhắn mới';
        }

        toastEl.classList.add('show');

        if (popupTimer) clearTimeout(popupTimer);
        popupTimer = setTimeout(hideToast, 8500);
    }

    function hideToast() {
        if (toastEl) {
            toastEl.classList.remove('show');
        }
        if (popupTimer) clearTimeout(popupTimer);
    }

    function escapeHtml(str) {
        var div = document.createElement('div');
        div.textContent = str;
        return div.innerHTML;
    }

    // Play pleasant crystal-clear sound chime (Web Audio API)
    function playChime() {
        try {
            var AudioCtx = window.AudioContext || window.webkitAudioContext;
            if (!AudioCtx) return;
            var ctx = new AudioCtx();
            var now = ctx.currentTime;

            // Tone 1: 587.33 Hz (D5)
            var osc1 = ctx.createOscillator();
            var gain1 = ctx.createGain();
            osc1.type = 'sine';
            osc1.frequency.setValueAtTime(587.33, now);
            gain1.gain.setValueAtTime(0.24, now);
            gain1.gain.exponentialRampToValueAtTime(0.001, now + 0.35);
            osc1.connect(gain1);
            gain1.connect(ctx.destination);
            osc1.start(now);
            osc1.stop(now + 0.35);

            // Tone 2: 880 Hz (A5)
            var osc2 = ctx.createOscillator();
            var gain2 = ctx.createGain();
            osc2.type = 'sine';
            osc2.frequency.setValueAtTime(880, now + 0.12);
            gain2.gain.setValueAtTime(0.30, now + 0.12);
            gain2.gain.exponentialRampToValueAtTime(0.001, now + 0.55);
            osc2.connect(gain2);
            gain2.connect(ctx.destination);
            osc2.start(now + 0.12);
            osc2.stop(now + 0.55);
        } catch (e) {}
    }

    // Trigger Native Windows / Desktop OS Notification (stays on top of Word, Excel, Zalo, etc.)
    function triggerDesktopNotification(data) {
        if (!('Notification' in window) || Notification.permission !== 'granted') return;

        var title = '💬 TIN NHẮN MỚI — ' + (data.customer_name || 'Khách hàng');
        var targetUrl = data.conversation_uuid 
            ? '/cuulongteam/chat-inbox?conversation=' + encodeURIComponent(data.conversation_uuid) 
            : '/cuulongteam/chat-inbox';

        var options = {
            body: data.preview || 'Khách hàng vừa gửi tin nhắn mới',
            icon: '/images/logo-ttcl.png',
            tag: 'cl_msg_' + (data.message_uuid || data.message_id || Date.now()),
            requireInteraction: true, // Pinned on screen over Word & Excel!
            renotify: true,
            silent: false,
            data: { url: targetUrl }
        };

        // Try Service Worker notification first (most persistent on Windows)
        if (swRegistration && typeof swRegistration.showNotification === 'function') {
            swRegistration.showNotification(title, options).catch(function () {
                fallbackDirectNotification(title, options, targetUrl);
            });
        } else {
            fallbackDirectNotification(title, options, targetUrl);
        }
    }

    function fallbackDirectNotification(title, options, targetUrl) {
        try {
            var notif = new Notification(title, options);
            notif.onclick = function () {
                window.focus();
                window.location.href = targetUrl;
                notif.close();
            };
        } catch (e) {}
    }

    function handleIncomingMessage(data) {
        // Multi-tab deduplication using localStorage
        var dedupeKey = 'cl_last_notified_msg_id';
        var lastNotified = localStorage.getItem(dedupeKey);
        var msgId = String(data.message_id || '');

        var shouldPlayAudioAndDesktop = true;
        if (msgId && lastNotified === msgId) {
            shouldPlayAudioAndDesktop = false;
        } else if (msgId) {
            localStorage.setItem(dedupeKey, msgId);
        }

        // 1. Play audio chime if not already played by another tab
        if (shouldPlayAudioAndDesktop) {
            playChime();
        }

        // 2. Trigger native OS desktop notification (stays on screen over Word, Excel, etc.)
        if (shouldPlayAudioAndDesktop) {
            triggerDesktopNotification(data);
        }

        // 3. Show in-page floating toast on current active tab
        showToast(data);

        // 4. Update tab title with indicator
        document.title = '(1) 💬 Tin nhắn mới | ' + originalTitle;
    }

    // Polling API check
    function fetchCheck(isBaseline) {
        var url = '/cuulongteam/api/chat/check-new-messages?last_id=' + (isBaseline ? 0 : lastKnownId);
        fetch(url, {
            headers: { 'Accept': 'application/json' },
            credentials: 'same-origin'
        })
        .then(function (res) {
            if (!res.ok) return null;
            return res.json();
        })
        .then(function (data) {
            if (!data) return;

            if (isBaseline) {
                lastKnownId = data.latest_id || 0;
                return;
            }

            if (data.has_new && data.message_id > lastKnownId) {
                lastKnownId = data.message_id;
                handleIncomingMessage(data);
            }
        })
        .catch(function () {});
    }

    // Start unthrottled Web Worker timer so background tabs don't throttle polling when user is in Word/Excel
    function startUnthrottledPolling() {
        try {
            var workerScript = `
                var timer = null;
                self.onmessage = function(e) {
                    if (e.data === 'start') {
                        if (timer) clearInterval(timer);
                        timer = setInterval(function() {
                            self.postMessage('tick');
                        }, 2500);
                    } else if (e.data === 'stop') {
                        if (timer) clearInterval(timer);
                        timer = null;
                    }
                };
            `;
            var blob = new Blob([workerScript], { type: 'application/javascript' });
            bgWorker = new Worker(URL.createObjectURL(blob));
            bgWorker.onmessage = function (e) {
                if (e.data === 'tick') {
                    fetchCheck(false);
                }
            };
            bgWorker.postMessage('start');
        } catch (err) {
            if (fallbackTimer) clearInterval(fallbackTimer);
            fallbackTimer = setInterval(function () {
                fetchCheck(false);
            }, 2500);
        }
    }

    // Initial check
    checkPermissionUI();
    fetchCheck(true);
    startUnthrottledPolling();
})();
</script>
@endif
