@if(auth()->check() || (class_exists(\Filament\Facades\Filament::class) && \Filament\Facades\Filament::auth()->check()))
@php
    $isChatInbox = request()->routeIs('filament.admin.pages.chat-inbox');
@endphp

@if(! $isChatInbox)
<div
    x-data="clGlobalChatNotifier()"
    x-init="initNotifier()"
    x-cloak
    style="position: relative; z-index: 999999;"
>
    <style>
        /* Floating Permission Bar */
        .cl-perm-banner {
            position: fixed;
            top: 14px;
            right: 20px;
            z-index: 999998;
            background: #ffffff;
            border: 1px solid #fed7aa;
            border-left: 4px solid #ff5400;
            border-radius: 12px;
            box-shadow: 0 10px 25px -5px rgba(255, 84, 0, 0.15), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            padding: 10px 14px;
            display: flex;
            align-items: center;
            gap: 12px;
            max-width: 440px;
            font-family: inherit;
            animation: clFadeDown 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }
        @keyframes clFadeDown {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Bottom-Right Floating Toast */
        .cl-global-toast {
            position: fixed;
            bottom: 24px;
            right: 24px;
            z-index: 999999;
            width: 350px;
            background: #ffffff;
            border: 1.5px solid #ff5400;
            border-radius: 16px;
            box-shadow: 0 16px 36px -4px rgba(255, 84, 0, 0.28), 0 8px 16px -4px rgba(0, 0, 0, 0.12);
            padding: 14px 16px;
            box-sizing: border-box;
            animation: clGlobalSlideUp 0.35s cubic-bezier(0.16, 1, 0.3, 1);
            font-family: inherit;
        }
        @keyframes clGlobalSlideUp {
            from { opacity: 0; transform: translateY(20px) scale(0.95); }
            to { opacity: 1; transform: translateY(0) scale(1); }
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
            70% { transform: scale(1); box-shadow: 0 0 0 7px rgba(255, 84, 0, 0); }
            100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(255, 84, 0, 0); }
        }
    </style>

    {{-- Permission Banner (shown if browser notification is not yet granted) --}}
    <div
        x-show="showPermBanner && notifPermission === 'default'"
        x-transition
        class="cl-perm-banner"
    >
        <div style="font-size: 18px;">🔔</div>
        <div style="flex: 1; min-width: 0;">
            <div style="font-size: 12px; font-weight: 700; color: #0f172a;">Bật thông báo ngoài màn hình</div>
            <div style="font-size: 11px; color: #64748b; line-height: 1.35; margin-top: 2px;">
                Nhận thông báo nổi ngay cả khi bạn đang mở Word, Excel hoặc ẩn trình duyệt.
            </div>
        </div>
        <button
            type="button"
            @click="requestPermission()"
            style="padding: 5px 10px; font-size: 11px; font-weight: 700; border-radius: 6px; border: none; background: #ff5400; color: #fff; cursor: pointer; white-space: nowrap; box-shadow: 0 2px 4px rgba(255,84,0,0.25);"
        >
            Bật ngay
        </button>
        <button
            type="button"
            @click="showPermBanner = false"
            style="border: none; background: transparent; color: #94a3b8; cursor: pointer; padding: 2px 4px; font-size: 16px; line-height: 1;"
        >×</button>
    </div>

    {{-- Bottom-Right Floating Toast --}}
    <div
        x-show="popupVisible"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4 scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0 scale-100"
        x-transition:leave-end="opacity-0 translate-y-4 scale-95"
        class="cl-global-toast"
        @mouseenter="pauseTimer()"
        @mouseleave="resumeTimer()"
    >
        <div style="display: flex; align-items: flex-start; justify-content: space-between; gap: 8px;">
            <div style="display: flex; align-items: center; gap: 6px;">
                <span class="cl-global-toast-dot"></span>
                <span style="font-size: 11px; font-weight: 700; color: #ff5400; text-transform: uppercase; letter-spacing: 0.05em;">
                    Tin nhắn mới
                </span>
                <template x-if="popupData.count > 1">
                    <span style="font-size: 10px; font-weight: 700; background: #ff5400; color: #fff; padding: 1px 6px; border-radius: 9999px;" x-text="'+' + popupData.count"></span>
                </template>
            </div>
            <button
                type="button"
                @click="dismissPopup()"
                style="border: none; background: transparent; color: #94a3b8; cursor: pointer; padding: 0; font-size: 16px; line-height: 1; transition: color 0.15s;"
                onmouseover="this.style.color='#475569'"
                onmouseout="this.style.color='#94a3b8'"
                title="Đóng thông báo"
            >×</button>
        </div>

        <div style="margin-top: 8px;">
            <h5 style="font-size: 13px; font-weight: 700; color: #0f172a; margin: 0; display: flex; align-items: center; gap: 5px;">
                <span x-text="popupData.customer_name"></span>
                <span style="font-size: 10px; font-weight: 500; color: #64748b; background: #f1f5f9; padding: 1px 6px; border-radius: 4px;">Khách hàng</span>
            </h5>
            <p style="font-size: 12px; color: #475569; margin: 4px 0 0 0; line-height: 1.4; max-height: 42px; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;" x-text="popupData.preview"></p>
        </div>

        <div style="margin-top: 12px; display: flex; align-items: center; justify-content: space-between;">
            <span style="font-size: 11px; color: #94a3b8;">Vừa xong</span>
            <button
                type="button"
                @click="goToConversation()"
                style="padding: 6px 14px; font-size: 12px; font-weight: 700; border-radius: 8px; border: none; background: linear-gradient(135deg, #ff5400 0%, #ff6b1a 100%); color: #ffffff; cursor: pointer; box-shadow: 0 2px 8px rgba(255, 84, 0, 0.35); display: flex; align-items: center; gap: 5px; transition: transform 0.15s;"
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
document.addEventListener('alpine:init', () => {
    Alpine.data('clGlobalChatNotifier', () => ({
        lastKnownId: 0,
        popupVisible: false,
        popupTimer: null,
        showPermBanner: true,
        notifPermission: ('Notification' in window) ? Notification.permission : 'denied',
        originalTitle: document.title,
        bgWorker: null,
        pollFallbackTimer: null,
        popupData: {
            customer_name: 'Khách hàng',
            preview: '',
            conversation_uuid: '',
            count: 1
        },

        initNotifier() {
            // Check permission state
            if ('Notification' in window) {
                this.notifPermission = Notification.permission;
            }

            // Initial baseline check (fetches current latest message id without alerting)
            this.fetchCheck(true);

            // Start unthrottled Web Worker background polling
            this.startUnthrottledPolling();
        },

        requestPermission() {
            if ('Notification' in window) {
                Notification.requestPermission().then((perm) => {
                    this.notifPermission = perm;
                    this.showPermBanner = false;
                    if (perm === 'granted') {
                        try {
                            new Notification('Truyền Thông Cửu Long', {
                                body: 'Đã kích hoạt thông báo thành công! Tin nhắn mới sẽ hiển thị nổi trên màn hình cả khi bạn đang làm việc trên Word hay Excel.',
                                icon: '/images/logo-ttcl.png'
                            });
                        } catch (e) {}
                    }
                });
            }
        },

        /**
         * Web Worker Timer:
         * Standard setInterval is throttled to 60s by browsers in background tabs (when user is in Word/Excel).
         * Web Workers are NOT throttled, guaranteeing a strict 2.5s cadence even when Chrome is minimized!
         */
        startUnthrottledPolling() {
            try {
                const workerScript = `
                    let timer = null;
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
                const blob = new Blob([workerScript], { type: 'application/javascript' });
                this.bgWorker = new Worker(URL.createObjectURL(blob));
                this.bgWorker.onmessage = (e) => {
                    if (e.data === 'tick') {
                        this.fetchCheck(false);
                    }
                };
                this.bgWorker.postMessage('start');
            } catch (err) {
                // Fallback to standard setInterval if Web Workers are restricted
                if (this.pollFallbackTimer) clearInterval(this.pollFallbackTimer);
                this.pollFallbackTimer = setInterval(() => {
                    this.fetchCheck(false);
                }, 2500);
            }
        },

        async fetchCheck(isBaseline = false) {
            try {
                const res = await fetch(`/cuulongteam/api/chat/check-new-messages?last_id=${isBaseline ? 0 : this.lastKnownId}`, {
                    headers: { 'Accept': 'application/json' },
                    credentials: 'same-origin'
                });

                if (!res.ok) return;

                const data = await res.json();
                if (!data) return;

                if (isBaseline) {
                    this.lastKnownId = data.latest_id || 0;
                    return;
                }

                if (data.has_new && data.message_id > this.lastKnownId) {
                    this.lastKnownId = data.message_id;
                    this.handleNewMessage(data);
                }
            } catch (err) {
                // Silently ignore transient network fetch errors
            }
        },

        handleNewMessage(data) {
            // 1. Play crystal-clear audio chime
            this.playChime();

            // 2. Show bottom-right popup toast (if browser tab is open)
            this.showToast(data);

            // 3. Trigger OS native desktop push notification (pinned on top of Word, Excel, Photoshop, etc.)
            this.triggerDesktopNotif(data);

            // 4. Update tab title with unread indicator
            document.title = '(1) 💬 Tin nhắn mới | ' + this.originalTitle;
        },

        playChime() {
            try {
                const AudioCtx = window.AudioContext || window.webkitAudioContext;
                if (!AudioCtx) return;
                const ctx = new AudioCtx();
                const now = ctx.currentTime;

                // Tone 1: 587.33 Hz (D5)
                const osc1 = ctx.createOscillator();
                const gain1 = ctx.createGain();
                osc1.type = 'sine';
                osc1.frequency.setValueAtTime(587.33, now);
                gain1.gain.setValueAtTime(0.22, now);
                gain1.gain.exponentialRampToValueAtTime(0.001, now + 0.35);
                osc1.connect(gain1);
                gain1.connect(ctx.destination);
                osc1.start(now);
                osc1.stop(now + 0.35);

                // Tone 2: 880 Hz (A5)
                const osc2 = ctx.createOscillator();
                const gain2 = ctx.createGain();
                osc2.type = 'sine';
                osc2.frequency.setValueAtTime(880, now + 0.12);
                gain2.gain.setValueAtTime(0.28, now + 0.12);
                gain2.gain.exponentialRampToValueAtTime(0.001, now + 0.55);
                osc2.connect(gain2);
                gain2.connect(ctx.destination);
                osc2.start(now + 0.12);
                osc2.stop(now + 0.55);
            } catch (e) {}
        },

        /**
         * Desktop OS Notification:
         * Uses requireInteraction: true so Windows 10/11 pins the toast on screen on top of Word, Excel, etc.
         */
        triggerDesktopNotif(data) {
            if ('Notification' in window && Notification.permission === 'granted') {
                try {
                    const notif = new Notification('💬 TIN NHẮN MỚI — ' + (data.customer_name || 'Khách hàng'), {
                        body: data.preview || 'Khách hàng vừa gửi tin nhắn mới',
                        icon: '/images/logo-ttcl.png',
                        tag: 'cl_global_msg_' + (data.message_uuid || Date.now()),
                        requireInteraction: true, // IMPORTANT: Keeps notification on screen over Word & Excel!
                        renotify: true,
                        silent: false
                    });
                    notif.onclick = () => {
                        window.focus();
                        this.goToConversation(data.conversation_uuid);
                        notif.close();
                    };
                } catch (e) {}
            }
        },

        showToast(data) {
            if (this.popupTimer) clearTimeout(this.popupTimer);

            if (this.popupVisible && this.popupData.conversation_uuid === data.conversation_uuid) {
                this.popupData.count = (this.popupData.count || 1) + 1;
                this.popupData.preview = data.preview;
            } else {
                this.popupData = {
                    customer_name: data.customer_name || 'Khách hàng',
                    preview: data.preview || '',
                    conversation_uuid: data.conversation_uuid || '',
                    count: 1
                };
            }

            this.popupVisible = true;
            this.popupTimer = setTimeout(() => {
                this.popupVisible = false;
            }, 8000);
        },

        pauseTimer() {
            if (this.popupTimer) clearTimeout(this.popupTimer);
        },

        resumeTimer() {
            this.popupTimer = setTimeout(() => {
                this.popupVisible = false;
            }, 5000);
        },

        dismissPopup() {
            this.popupVisible = false;
            if (this.popupTimer) clearTimeout(this.popupTimer);
        },

        goToConversation(uuid = null) {
            const targetUuid = uuid || this.popupData.conversation_uuid;
            this.dismissPopup();
            document.title = this.originalTitle;
            if (targetUuid) {
                window.location.href = `/cuulongteam/chat-inbox?conversation=${targetUuid}`;
            } else {
                window.location.href = '/cuulongteam/chat-inbox';
            }
        }
    }));
});
</script>
@endif
@endif
