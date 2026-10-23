@php
    $setupKey = '';
    try {
        $u = $this->getUser();
        $setupKey = ($u && $u->two_factor_secret) ? decrypt($u->two_factor_secret) : '';
    } catch (\Throwable $e) {
        $setupKey = '';
    }
@endphp

<div class="text-center space-y-5" x-data="{ copiedKey: false, showSuccessModal: false }" @setup-confirmed.window="showSuccessModal = true">
    <!-- Header bước quét QR -->
    <div>
        <div class="mx-auto mb-3 flex h-12 w-12 items-center justify-center rounded-2xl bg-orange-100 text-orange-600 dark:bg-orange-950/60 dark:text-orange-400">
            <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 013.75 9.375v-4.5zM3.75 14.625c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5a1.125 1.125 0 01-1.125-1.125v-4.5zM13.5 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0113.5 9.375v-4.5z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 6.75h.75v.75h-.75v-.75zM6.75 16.5h.75v.75h-.75v-.75zM16.5 6.75h.75v.75h-.75v-.75zM13.5 13.5h.75v.75h-.75v-.75zM13.5 19.5h.75v.75h-.75v-.75zM19.5 13.5h.75v.75h-.75v-.75zM16.5 16.5h.75v.75h-.75v-.75z" />
            </svg>
        </div>
        <h2 class="text-xl font-black text-slate-900 dark:text-white">Quét mã QR để kích hoạt 2FA</h2>
        <p class="mt-1 text-xs text-slate-600 dark:text-slate-300 leading-relaxed max-w-sm mx-auto">
            Mở ứng dụng <strong>Google Authenticator</strong> trên điện thoại, chọn <strong>Quét mã QR</strong> hoặc nhập khóa thiết lập thủ công bên dưới.
        </p>
    </div>

    <!-- Khung QR Code bo tròn đẹp -->
    <div class="p-4 bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 shadow-xs max-w-xs mx-auto">
        <div class="p-3 bg-white rounded-xl shadow-inner border border-slate-100 flex items-center justify-center">
            {!! ($this->getUser() && method_exists($this->getUser(), 'twoFactorQrCodeSvg')) ? $this->getUser()->twoFactorQrCodeSvg() : '' !!}
        </div>

        <!-- Khóa thiết lập thủ công -->
        <div class="mt-3 pt-3 border-t border-slate-100 dark:border-slate-700 text-left">
            <span class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1 text-center">
                Khóa thiết lập thủ công (Setup Key)
            </span>
            <div class="flex items-center justify-between gap-1.5 p-2 bg-slate-50 dark:bg-slate-900 rounded-lg border border-slate-200 dark:border-slate-700">
                <code class="font-mono text-xs font-bold text-orange-600 dark:text-orange-400 select-all truncate">
                    {{ $setupKey }}
                </code>
                <button 
                    type="button" 
                    @click="navigator.clipboard.writeText('{{ $setupKey }}'); copiedKey = true; setTimeout(() => copiedKey = false, 2000)"
                    class="shrink-0 p-1 text-slate-400 hover:text-orange-600 transition"
                    title="Sao chép"
                >
                    <svg class="h-4 w-4 text-emerald-600" x-show="copiedKey" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                    </svg>
                    <svg class="h-4 w-4" x-show="!copiedKey" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 01-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 011.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 00-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 01-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 00-3.375-3.375h-1.5a1.125 1.125 0 01-1.125-1.125v-1.5a3.375 3.375 0 00-3.375-3.375H9.75" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Form xác nhận OTP -->
    <div style="background: rgba(248, 250, 252, 0.95); border: 1px solid #e2e8f0; border-radius: 18px; padding: 18px 20px 22px 20px; text-align: left; margin-top: 16px; margin-bottom: 6px;">
        <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 8px;">
            Nhập mã OTP 6 số từ Google Authenticator để hoàn tất kích hoạt:
        </label>
        
        <form wire:submit="confirmSetup" @submit="showSuccessModal = true">
            <div style="margin-bottom: 16px;">
                {{ $this->form }}
            </div>

            <style>
                .ttcl-confirm-btn {
                    background: linear-gradient(135deg, #f97316 0%, #ea580c 50%, #f59e0b 100%) !important;
                    color: #ffffff !important;
                    padding: 8px 18px !important;
                    height: 38px !important;
                    border-radius: 10px !important;
                    font-weight: 700 !important;
                    font-size: 13.5px !important;
                    border: none !important;
                    box-shadow: 0 2px 8px rgba(234, 88, 12, 0.28) !important;
                    display: inline-flex !important;
                    align-items: center !important;
                    justify-content: center !important;
                    gap: 6px !important;
                    cursor: pointer !important;
                    text-decoration: none !important;
                    transition: all 0.2s ease !important;
                    box-sizing: border-box !important;
                }
                .ttcl-confirm-btn:hover {
                    background: linear-gradient(135deg, #ea580c 0%, #c2410c 50%, #f97316 100%) !important;
                    box-shadow: 0 4px 12px rgba(234, 88, 12, 0.38) !important;
                    transform: translateY(-1px) !important;
                }
                .ttcl-confirm-btn:active {
                    transform: translateY(0) !important;
                }
                .ttcl-cancel-btn {
                    background: #ffffff !important;
                    color: #475569 !important;
                    padding: 8px 16px !important;
                    height: 38px !important;
                    border-radius: 10px !important;
                    font-weight: 600 !important;
                    font-size: 13.5px !important;
                    border: 1px solid #cbd5e1 !important;
                    display: inline-flex !important;
                    align-items: center !important;
                    justify-content: center !important;
                    cursor: pointer !important;
                    text-decoration: none !important;
                    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05) !important;
                    transition: all 0.2s ease !important;
                    box-sizing: border-box !important;
                }
                .ttcl-cancel-btn:hover {
                    background: #f1f5f9 !important;
                    border-color: #94a3b8 !important;
                    color: #0f172a !important;
                }
                /* Tắt nút spin trên input number */
                input::-webkit-outer-spin-button,
                input::-webkit-inner-spin-button {
                    -webkit-appearance: none !important;
                    margin: 0 !important;
                }
                input[type=number] {
                    -moz-appearance: textfield !important;
                }
            </style>

            <div style="margin-top: 14px; margin-bottom: 2px; display: flex; align-items: center; justify-content: center; gap: 10px;">
                <button 
                    type="submit"
                    class="ttcl-confirm-btn"
                >
                    <svg style="width: 16px; height: 16px; stroke: #ffffff !important; stroke-width: 2.5; flex-shrink: 0;" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                    </svg>
                    <span style="color: #ffffff !important; font-weight: 700 !important; font-size: 13.5px !important;">Xác nhận kích hoạt</span>
                </button>

                <button 
                    type="button"
                    wire:click="cancelSetupAction"
                    class="ttcl-cancel-btn"
                >
                    Hủy bỏ
                </button>
            </div>
        </form>
    </div>

    <!-- Popup Modal Thông Báo Kích Hoạt 2FA Thành Công -->
    <template x-teleport="body">
        <div 
            x-show="showSuccessModal" 
            x-cloak 
            style="position: fixed !important; top: 0 !important; left: 0 !important; right: 0 !important; bottom: 0 !important; width: 100vw !important; height: 100vh !important; z-index: 999999 !important; display: flex !important; align-items: center !important; justify-content: center !important; background: rgba(15, 23, 42, 0.65) !important; backdrop-filter: blur(8px) !important; padding: 16px !important; margin: 0 !important;"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
        >
            <div style="background: white !important; border-radius: 24px !important; padding: 32px 28px !important; max-width: 420px !important; width: 100% !important; text-align: center !important; box-shadow: 0 25px 60px -15px rgba(0, 0, 0, 0.35) !important; border: 1.5px solid #fed7aa !important; margin: auto !important; position: relative !important;">
                <!-- Icon checkmark cam tròn hiệu ứng sang trọng -->
                <div style="width: 72px; height: 72px; margin: 0 auto 16px auto; border-radius: 9999px; background: linear-gradient(135deg, #fff7ed 0%, #ffedd5 100%); border: 2.5px solid #fdba74; display: flex; align-items: center; justify-content: center; box-shadow: 0 0 0 8px rgba(249, 115, 22, 0.12);">
                    <svg style="width: 38px; height: 38px; color: #ea580c;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                    </svg>
                </div>
                
                <h3 style="font-size: 20px; font-weight: 800; color: #0f172a; margin-bottom: 8px;">
                    Kích hoạt 2FA thành công!
                </h3>
                
                <p style="font-size: 13.5px; color: #64748b; line-height: 1.55; margin-bottom: 22px;">
                    Tài khoản của bạn đã được bảo vệ bằng xác thực 2 lớp. Hệ thống đang chuyển hướng về trang đăng nhập để bạn đăng nhập lại...
                </p>

                <!-- Loading Spinner & Trạng thái chuyển hướng -->
                <div style="display: flex; align-items: center; justify-content: center; gap: 8px; font-size: 13px; font-weight: 700; color: #ea580c; background: #fff7ed; padding: 10px 16px; border-radius: 12px; border: 1px solid #fed7aa;">
                    <svg style="animation: spin 1s linear infinite; width: 18px; height: 18px;" viewBox="0 0 24 24" fill="none">
                        <circle style="opacity: 0.25;" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path style="opacity: 0.75;" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span>Đang chuyển hướng về đăng nhập...</span>
                </div>
            </div>
        </div>
    </template>
</div>
