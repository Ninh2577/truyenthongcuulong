{{--
    ELEGANT CONFIRM & ALERT MODAL (POPUP SANG TRỌNG THANH LỊCH)
    Replaces crude native browser "127.0.0.1:8000 says" dialogs across all Livewire wire:confirm and JS alerts.
    Truyền Thông Cửu Long — Cửu Long ID Command Center
--}}
<div
    x-data="clElegantModal()"
    x-init="initModal()"
    x-cloak
    style="position: relative; z-index: 9999999;"
>
    <style>
        .cl-modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.65);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            z-index: 9999999;
            animation: clOverlayFade 0.2s cubic-bezier(0.16, 1, 0.3, 1);
        }
        @keyframes clOverlayFade {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        .cl-modal-card {
            background: #ffffff;
            border-radius: 22px;
            width: 100%;
            max-width: 480px;
            box-shadow: 0 25px 50px -12px rgba(15, 23, 42, 0.28), 0 0 0 1px rgba(0, 0, 0, 0.05);
            border: 1px solid #f1f5f9;
            overflow: hidden;
            animation: clCardZoom 0.24s cubic-bezier(0.16, 1, 0.3, 1);
            font-family: inherit;
        }
        @keyframes clCardZoom {
            from { opacity: 0; transform: scale(0.94) translateY(10px); }
            to { opacity: 1; transform: scale(1) translateY(0); }
        }
        .cl-modal-top-bar {
            height: 4px;
            width: 100%;
        }
        .cl-modal-top-bar.is-danger {
            background: linear-gradient(90deg, #ef4444 0%, #f97316 100%);
        }
        .cl-modal-top-bar.is-info {
            background: linear-gradient(90deg, #2563eb 0%, #38bdf8 100%);
        }
        .cl-modal-body-wrap {
            padding: 24px 28px 20px 28px;
            text-align: center;
        }
        .cl-modal-icon-wrap {
            width: 56px;
            height: 56px;
            border-radius: 16px;
            margin: 0 auto 16px auto;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 26px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
        }
        .cl-modal-icon-wrap.is-danger {
            background: #fef2f2;
            color: #ef4444;
            border: 1px solid #fee2e2;
        }
        .cl-modal-icon-wrap.is-info {
            background: #eff6ff;
            color: #2563eb;
            border: 1px solid #dbeafe;
        }
        .cl-modal-brand-tag {
            font-size: 10.5px;
            font-weight: 800;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: #94a3b8;
            margin-bottom: 6px;
        }
        .cl-modal-title {
            font-size: 18px;
            font-weight: 800;
            color: #0f172a;
            margin: 0 0 10px 0;
            letter-spacing: -0.01em;
            line-height: 1.35;
        }
        .cl-modal-message {
            font-size: 13.5px;
            color: #475569;
            line-height: 1.6;
            margin: 0 0 8px 0;
            white-space: pre-wrap;
            word-break: break-word;
        }
        .cl-modal-footer-btns {
            padding: 16px 28px 22px 28px;
            background: #fafafa;
            border-top: 1px solid #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 12px;
        }
        .cl-modal-btn-cancel {
            padding: 9px 18px;
            border-radius: 12px;
            border: 1px solid #cbd5e1;
            background: #ffffff;
            color: #64748b;
            font-weight: 600;
            font-size: 13px;
            cursor: pointer;
            transition: all 0.15s ease;
        }
        .cl-modal-btn-cancel:hover {
            background: #f1f5f9;
            color: #334155;
            border-color: #94a3b8;
        }
        .cl-modal-btn-confirm {
            padding: 9px 22px;
            border-radius: 12px;
            border: none;
            color: #ffffff;
            font-weight: 700;
            font-size: 13px;
            cursor: pointer;
            transition: all 0.15s ease;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .cl-modal-btn-confirm.is-danger {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            box-shadow: 0 4px 14px rgba(239, 68, 68, 0.3);
        }
        .cl-modal-btn-confirm.is-danger:hover {
            background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
            box-shadow: 0 6px 18px rgba(239, 68, 68, 0.4);
            transform: translateY(-1px);
        }
        .cl-modal-btn-confirm.is-info {
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            box-shadow: 0 4px 14px rgba(37, 99, 235, 0.3);
        }
        .cl-modal-btn-confirm.is-info:hover {
            background: linear-gradient(135deg, #1d4ed8 0%, #1e40af 100%);
            box-shadow: 0 6px 18px rgba(37, 99, 235, 0.4);
            transform: translateY(-1px);
        }
    </style>

    <template x-if="isOpen">
        <div
            class="cl-modal-overlay"
            @click.self="cancel()"
            @keydown.window.escape="cancel()"
            @keydown.window.enter="confirm()"
        >
            <div class="cl-modal-card" @click.stop>
                {{-- Decorative top border bar --}}
                <div class="cl-modal-top-bar" :class="isDanger ? 'is-danger' : 'is-info'"></div>

                <div class="cl-modal-body-wrap">
                    {{-- Icon Badge --}}
                    <div class="cl-modal-icon-wrap" :class="isDanger ? 'is-danger' : 'is-info'">
                        <span x-text="isDanger ? '⚠️' : '💬'"></span>
                    </div>

                    {{-- Brand Subtitle --}}
                    <div class="cl-modal-brand-tag">
                        TRUYỀN THÔNG CỬU LONG &bull; CỬU LONG ID
                    </div>

                    {{-- Title --}}
                    <h3 class="cl-modal-title" x-text="title"></h3>

                    {{-- Message Content --}}
                    <div class="cl-modal-message" x-text="message"></div>
                </div>

                {{-- Action Buttons --}}
                <div class="cl-modal-footer-btns">
                    <template x-if="type === 'confirm'">
                        <button
                            type="button"
                            @click="cancel()"
                            class="cl-modal-btn-cancel"
                        >
                            Hủy Bỏ
                        </button>
                    </template>

                    <button
                        type="button"
                        @click="confirm()"
                        class="cl-modal-btn-confirm"
                        :class="isDanger ? 'is-danger' : 'is-info'"
                        x-text="confirmText"
                    ></button>
                </div>
            </div>
        </div>
    </template>
</div>

<script>
    function clElegantModal() {
        return {
            isOpen: false,
            type: 'confirm', // 'confirm' or 'alert'
            title: 'Xác Nhận Hành Động',
            message: '',
            confirmText: 'Xác Nhận',
            isDanger: false,
            onConfirmCallback: null,
            onCancelCallback: null,

            initModal() {
                // Register global helper on window
                window.ClElegantModal = {
                    confirm: (options) => {
                        this.openConfirm(options);
                    },
                    alert: (message, title = 'Thông Báo') => {
                        this.openAlert(message, title);
                    }
                };

                // Override native alert to prevent crude browser dialogs
                window.alert = (msg) => {
                    this.openAlert(msg);
                };

                // Hook into Livewire 3 directive system
                const setupLivewireConfirmHook = () => {
                    if (window.Livewire && window.Livewire.hook) {
                        try {
                            window.Livewire.hook('directive.init', ({ el, directive }) => {
                                if (directive.value === 'confirm') {
                                    const msg = directive.expression || 'Bạn có chắc chắn muốn thực hiện hành động này?';
                                    el.__livewire_confirm = (action, instead) => {
                                        this.openConfirm({
                                            message: msg,
                                            onConfirm: action,
                                            onCancel: instead
                                        });
                                    };
                                }
                            });
                        } catch (err) {
                            console.warn('Livewire confirm hook error:', err);
                        }
                    }
                };

                if (window.Livewire) {
                    setupLivewireConfirmHook();
                } else {
                    document.addEventListener('livewire:init', setupLivewireConfirmHook);
                }

                // Capture clicks on elements with wire:confirm as an additional safety net
                document.addEventListener('click', (e) => {
                    const target = e.target.closest('[wire\\:confirm]');
                    if (target && target.__livewire_confirm && !target.__cl_patched) {
                        target.__cl_patched = true;
                        const msg = target.getAttribute('wire:confirm');
                        target.__livewire_confirm = (action, instead) => {
                            this.openConfirm({
                                message: msg,
                                onConfirm: action,
                                onCancel: instead
                            });
                        };
                    }
                }, true);
            },

            openConfirm({ message, onConfirm, onCancel, title = null }) {
                this.type = 'confirm';
                this.message = message || 'Bạn có chắc chắn muốn thực hiện hành động này?';
                
                // Detect dangerous operations
                const lowerMsg = (this.message + '').toLowerCase();
                this.isDanger = lowerMsg.includes('xóa') || lowerMsg.includes('thu hồi') || lowerMsg.includes('hủy') || lowerMsg.includes('vĩnh viễn');
                
                if (title) {
                    this.title = title;
                } else if (this.isDanger) {
                    this.title = lowerMsg.includes('thu hồi') ? 'Xác Nhận Thu Hồi Tin Nhắn' : 'Xác Nhận Xóa Dữ Liệu';
                    this.confirmText = lowerMsg.includes('thu hồi') ? 'Xác Nhận Thu Hồi' : 'Xác Nhận Xóa';
                } else {
                    this.title = 'Xác Nhận Hành Động';
                    this.confirmText = 'Đồng Ý';
                }

                this.onConfirmCallback = onConfirm;
                this.onCancelCallback = onCancel;
                this.isOpen = true;
            },

            openAlert(message, title = 'Thông Báo') {
                this.type = 'alert';
                this.message = message || '';
                this.title = title;
                this.isDanger = false;
                this.confirmText = 'Đã Hiểu';
                this.onConfirmCallback = null;
                this.onCancelCallback = null;
                this.isOpen = true;
            },

            confirm() {
                this.isOpen = false;
                if (typeof this.onConfirmCallback === 'function') {
                    this.onConfirmCallback();
                }
            },

            cancel() {
                this.isOpen = false;
                if (typeof this.onCancelCallback === 'function') {
                    this.onCancelCallback();
                }
            }
        };
    }
</script>
