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

@if($canAccessChat)
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
            box-shadow: 0 14px 34px -5px rgba(255, 84, 0, 0.22), 0 4px 12px -2px rgba(0, 0, 0, 0.08);
            padding: 12px 16px;
            display: flex;
            align-items: center;
            gap: 14px;
            max-width: 460px;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
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
            width: 370px;
            background: #ffffff;
            border: 1.5px solid #ff5400;
            border-radius: 18px;
            box-shadow: 0 20px 48px -8px rgba(255, 84, 0, 0.28), 0 10px 24px -4px rgba(15, 23, 42, 0.12);
            padding: 16px;
            box-sizing: border-box;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            display: none;
            opacity: 0;
            transform: translateY(24px) scale(0.96);
            transition: opacity 0.28s cubic-bezier(0.16, 1, 0.3, 1), transform 0.28s cubic-bezier(0.16, 1, 0.3, 1);
            overflow: hidden;
        }
        .cl-global-toast.show {
            display: block;
            opacity: 1;
            transform: translateY(0) scale(1);
        }
        .cl-toast-dot {
            width: 8px;
            height: 8px;
            border-radius: 9999px;
            background: #10b981;
            display: inline-block;
            box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7);
            animation: clPulseGreen 1.6s infinite;
        }
        @keyframes clPulseGreen {
            0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7); }
            70% { transform: scale(1); box-shadow: 0 0 0 6px rgba(16, 185, 129, 0); }
            100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); }
        }
        .cl-toast-progress-bar {
            position: absolute;
            bottom: 0;
            left: 0;
            height: 3px;
            background: linear-gradient(90deg, #ff5400 0%, #f59e0b 100%);
            width: 100%;
            transform-origin: left;
        }
        @keyframes clShrink {
            from { width: 100%; }
            to { width: 0%; }
        }
    </style>

    {{-- Permission Banner (shown if browser desktop notification is not yet granted) --}}
    <div id="cl-perm-banner-el" class="cl-perm-banner" style="display: none;">
        <div style="width: 38px; height: 38px; border-radius: 50%; background: #fff7ed; border: 1.5px solid #ffedd5; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
            <img src="{{ asset('images/logo-notification.png') }}" alt="Cửu Long" style="width: 26px; height: 26px; object-contain;" />
        </div>
        <div style="flex: 1; min-width: 0;">
            <div style="font-size: 13px; font-weight: 700; color: #0f172a; line-height: 1.3;">Bật thông báo màn hình Truyền Thông Cửu Long</div>
            <div style="font-size: 11px; color: #64748b; line-height: 1.4; margin-top: 2px;">
                Nhận thông báo nổi góc màn hình ngay cả khi bạn đang mở Word, Excel, Zalo hay ẩn trình duyệt.
            </div>
        </div>
        <button
            type="button"
            id="cl-btn-enable-notif"
            style="padding: 7px 13px; font-size: 11px; font-weight: 700; border-radius: 8px; border: none; background: linear-gradient(135deg, #ff5400 0%, #ff6b1a 100%); color: #ffffff; cursor: pointer; white-space: nowrap; box-shadow: 0 2px 8px rgba(255,84,0,0.35); transition: transform 0.15s;"
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

    {{-- Bottom-Right Floating In-Page Toast (Branded to match Truyền Thông Cửu Long) --}}
    <div id="cl-global-toast-el" class="cl-global-toast">
        {{-- Header with Brand Logo & Online Status --}}
        <div style="display: flex; align-items: center; justify-content: space-between; border-bottom: 1px solid #f1f5f9; padding-bottom: 10px; margin-bottom: 10px;">
            <div style="display: flex; align-items: center; gap: 8px;">
                <div style="width: 30px; height: 30px; border-radius: 50%; background: #070f1e; border: 1.5px solid #ff5400; padding: 2px; display: flex; align-items: center; justify-content: center; box-shadow: 0 2px 6px rgba(255,84,0,0.25);">
                    <img src="{{ asset('images/logo-notification.png') }}" alt="Logo" style="width: 100%; height: 100%; object-fit: contain; border-radius: 50%;" />
                </div>
                <div>
                    <div style="font-size: 11px; font-weight: 800; color: #0f172a; letter-spacing: 0.04em; text-transform: uppercase; line-height: 1.2;">
                        Truyền Thông Cửu Long
                    </div>
                    <div style="font-size: 10px; color: #64748b; display: flex; align-items: center; gap: 4px; margin-top: 1px;">
                        <span class="cl-toast-dot"></span>
                        <span>Tin nhắn mới • Hộp thư trực tuyến</span>
                    </div>
                </div>
            </div>
            <button
                type="button"
                id="cl-btn-dismiss-toast"
                style="border: none; background: #f8fafc; color: #94a3b8; cursor: pointer; width: 24px; height: 24px; border-radius: 6px; display: flex; align-items: center; justify-content: center; font-size: 16px; line-height: 1; transition: all 0.15s;"
                onmouseover="this.style.color='#0f172a'; this.style.background='#e2e8f0';"
                onmouseout="this.style.color='#94a3b8'; this.style.background='#f8fafc';"
                title="Đóng thông báo"
            >×</button>
        </div>

        {{-- Customer & Message Body --}}
        <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 10px 12px; margin-bottom: 12px;">
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 4px;">
                <div id="cl-toast-customer" style="font-size: 12.5px; font-weight: 700; color: #0f172a; display: flex; align-items: center; gap: 6px;">
                    <span>Khách hàng</span>
                </div>
                <span id="cl-toast-badge-status" style="font-size: 9.5px; font-weight: 600; color: #ff5400; background: #fff7ed; border: 1px solid #fed7aa; padding: 1px 6px; border-radius: 4px;">
                    Mới gửi
                </span>
            </div>
            <p id="cl-toast-preview" style="font-size: 12px; color: #334155; margin: 0; line-height: 1.45; max-height: 40px; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; font-style: normal;"></p>
        </div>

        {{-- Footer Actions --}}
        <div style="display: flex; align-items: center; justify-content: space-between; gap: 8px;">
            <span style="font-size: 11px; color: #94a3b8;">Vừa xong</span>
            <button
                type="button"
                id="cl-btn-view-chat"
                style="padding: 7px 16px; font-size: 12px; font-weight: 700; border-radius: 9px; border: none; background: linear-gradient(135deg, #ff5400 0%, #ff7a00 100%); color: #ffffff; cursor: pointer; box-shadow: 0 3px 10px rgba(255, 84, 0, 0.35); display: flex; align-items: center; gap: 6px; transition: transform 0.15s, box-shadow 0.15s;"
                onmouseover="this.style.transform='translateY(-1px)'; this.style.boxShadow='0 5px 14px rgba(255, 84, 0, 0.45)';"
                onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 3px 10px rgba(255, 84, 0, 0.35)';"
            >
                <span>💬 Trả lời ngay</span>
                <svg style="width: 13px; height: 13px;" fill="none" stroke="currentColor" stroke-width="2.4" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                </svg>
            </button>
        </div>

        {{-- Progress countdown bar --}}
        <div id="cl-toast-progress" class="cl-toast-progress-bar"></div>
    </div>
</div>

<script>
(function () {
    // Avoid double execution on the same page
    if (window.__clGlobalNotifierActive) return;
    window.__clGlobalNotifierActive = true;

    var lastKnownId = 0;
    var popupTimer = null;
    var originalBaseTitle = document.title.replace(/^[🔴\(\)\d\s\w]+—\s*|^[🔴\(\)\d\s]+/, '').trim() || document.title;
    var originalFaviconHref = null;
    var cachedBadgeFaviconUrl = {};
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
    var progressBar = document.getElementById('cl-toast-progress');
    var btnEnableNotif = document.getElementById('cl-btn-enable-notif');
    var btnClosePerm = document.getElementById('cl-btn-close-perm');
    var btnDismissToast = document.getElementById('cl-btn-dismiss-toast');
    var btnViewChat = document.getElementById('cl-btn-view-chat');

    function getFaviconEl() {
        var link = document.querySelector("link[rel*='icon']") || document.querySelector("link[rel='shortcut icon']");
        if (!link) {
            link = document.createElement('link');
            link.type = 'image/png';
            link.rel = 'shortcut icon';
            link.href = '/images/logo-ttcl.png';
            document.getElementsByTagName('head')[0].appendChild(link);
        }
        return link;
    }

    var initFav = getFaviconEl();
    if (initFav) {
        originalFaviconHref = initFav.href;
    }

    // Dynamic red dot badge on Favicon (Browser Tab Logo)
    function drawFaviconBadge(count) {
        var link = getFaviconEl();
        if (!link) return;

        if (!originalFaviconHref) {
            originalFaviconHref = link.href;
        }

        if (count <= 0) {
            if (link.href !== originalFaviconHref) {
                link.href = originalFaviconHref;
            }
            return;
        }

        if (cachedBadgeFaviconUrl[count]) {
            link.href = cachedBadgeFaviconUrl[count];
            return;
        }

        var img = new Image();
        img.crossOrigin = 'anonymous';
        img.onload = function () {
            try {
                var canvas = document.createElement('canvas');
                canvas.width = 32;
                canvas.height = 32;
                var ctx = canvas.getContext('2d');

                // Draw base website logo
                ctx.drawImage(img, 0, 0, 32, 32);

                // Badge position: Top-Right
                var bx = 22;
                var by = 9;
                var radius = 7.5;

                // White border ring
                ctx.beginPath();
                ctx.arc(bx, by, radius, 0, 2 * Math.PI, false);
                ctx.fillStyle = '#ffffff';
                ctx.fill();

                // Bright red notification circle #ef4444
                ctx.beginPath();
                ctx.arc(bx, by, radius - 1.5, 0, 2 * Math.PI, false);
                ctx.fillStyle = '#ef4444';
                ctx.fill();

                // Count text inside red dot
                ctx.fillStyle = '#ffffff';
                if (count < 10) {
                    ctx.font = 'bold 8.5px -apple-system, BlinkMacSystemFont, Arial, sans-serif';
                    ctx.textAlign = 'center';
                    ctx.textBaseline = 'middle';
                    ctx.fillText(String(count), bx, by + 0.5);
                } else {
                    ctx.font = 'bold 7px -apple-system, BlinkMacSystemFont, Arial, sans-serif';
                    ctx.textAlign = 'center';
                    ctx.textBaseline = 'middle';
                    ctx.fillText('9+', bx, by + 0.5);
                }

                var dataUrl = canvas.toDataURL('image/png');
                cachedBadgeFaviconUrl[count] = dataUrl;
                link.href = dataUrl;
            } catch (e) {}
        };
        img.src = originalFaviconHref;
    }

    function updateTabIndicator(unreadCount) {
        var count = parseInt(unreadCount) || 0;

        // 1. Draw red dot on browser tab Favicon
        drawFaviconBadge(count);

        // 2. Update Browser Tab Title with Red Dot & Counter
        if (count > 0) {
            document.title = '🔴 (' + count + ') ' + originalBaseTitle;
        } else {
            document.title = originalBaseTitle;
        }
    }

    window.__clUpdateTabIndicator = updateTabIndicator;

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
                            preview: 'Đã kích hoạt thông báo thành công! Tin nhắn mới từ khách hàng sẽ hiển thị nổi trên màn hình cả khi bạn đang mở Word, Excel hay ẩn trình duyệt.',
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
            updateTabIndicator(0);
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
            if (progressBar) progressBar.style.animationPlayState = 'paused';
        });
        toastEl.addEventListener('mouseleave', function () {
            if (progressBar) progressBar.style.animationPlayState = 'running';
            popupTimer = setTimeout(hideToast, 5000);
        });
    }

    function showToast(data) {
        if (!toastEl) return;
        currentConversationUuid = data.conversation_uuid || '';

        if (toastCustomer) {
            toastCustomer.innerHTML = '<span>' + escapeHtml(data.customer_name || 'Khách hàng') + '</span>';
        }
        if (toastPreview) {
            toastPreview.textContent = data.preview || 'Khách hàng vừa gửi tin nhắn mới';
        }

        var toastBadge = document.getElementById('cl-toast-badge-status');
        if (toastBadge) {
            if (data.unread_count && data.unread_count > 1) {
                toastBadge.textContent = '+' + data.unread_count + ' chưa đọc';
            } else {
                toastBadge.textContent = 'Mới gửi';
            }
        }

        // Restart progress bar animation
        if (progressBar) {
            progressBar.style.animation = 'none';
            void progressBar.offsetWidth; // Force reflow
            progressBar.style.animation = 'clShrink 8.5s linear forwards';
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

    // Trigger Native Windows / Desktop OS Notification with high-res brand badge
    function triggerDesktopNotification(data) {
        if (!('Notification' in window) || Notification.permission !== 'granted') return;

        var senderName = data.customer_name || 'Khách hàng';
        var title = '💬 [Truyền Thông Cửu Long] ' + senderName;
        var targetUrl = data.conversation_uuid 
            ? '/cuulongteam/chat-inbox?conversation=' + encodeURIComponent(data.conversation_uuid) 
            : '/cuulongteam/chat-inbox';

        var options = {
            body: senderName + ': ' + (data.preview || 'Tin nhắn mới') + '\n👉 Bấm để xem và trả lời ngay',
            icon: '/images/logo-notification.png',
            badge: '/images/logo-notification.png',
            tag: 'cl_msg_' + (data.message_uuid || data.message_id || Date.now()),
            requireInteraction: true, // Pinned on screen over Word, Excel, Zalo
            renotify: true,
            silent: false,
            data: { url: targetUrl },
            actions: [
                { action: 'open_chat', title: '💬 Trả lời ngay' }
            ]
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

        // 4. Update tab title & favicon with red dot indicator
        if (data.unread_count !== undefined) {
            updateTabIndicator(data.unread_count);
        } else {
            updateTabIndicator(1);
        }

        // 5. If on Chat Inbox page, trigger Livewire poll immediately
        try {
            if (window.Livewire) {
                var comp = document.querySelector('[wire\\:id]');
                if (comp && window.Livewire.find) {
                    var lw = window.Livewire.find(comp.getAttribute('wire:id'));
                    if (lw && typeof lw.poll === 'function') {
                        lw.poll();
                    }
                }
            }
        } catch (e) {}
    }

    // Polling API check
    function fetchCheck(isBaseline) {
        var url = '/cuulongteam/api/chat/check-new-messages?last_id=' + (isBaseline ? 0 : lastKnownId);
        fetch(url, {
            headers: { 'Accept': 'application/json' },
            credentials: 'same-origin',
            cache: 'no-store'
        })
        .then(function (res) {
            if (!res.ok) return null;
            return res.json();
        })
        .then(function (data) {
            if (!data) return;

            if (data.unread_count !== undefined) {
                updateTabIndicator(data.unread_count);
            }

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

    // Start unthrottled Web Worker timer with sub-second polling (650ms)
    function startUnthrottledPolling() {
        try {
            var workerScript = `
                var timer = null;
                self.onmessage = function(e) {
                    if (e.data === 'start') {
                        if (timer) clearInterval(timer);
                        timer = setInterval(function() {
                            self.postMessage('tick');
                        }, 650);
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
            }, 850);
        }
    }

    // Initial check
    checkPermissionUI();
    fetchCheck(true);
    startUnthrottledPolling();
})();
</script>
@endif
