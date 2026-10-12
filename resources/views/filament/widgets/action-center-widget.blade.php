<x-filament-widgets::widget>
    @if ($totalActionItems > 0)
        <div class="cl-custom-card p-5 shadow-sm space-y-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <span class="flex h-2.5 w-2.5 relative">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-rose-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-rose-500"></span>
                    </span>
                    <h3 class="cl-title text-sm font-bold uppercase tracking-wider">
                        Cần Bạn Xử Lý Ngay ({{ $totalActionItems }} Tác Vụ Đang Chờ)
                    </h3>
                </div>
                <span class="cl-subtext text-xs font-medium">Ưu tiên xử lý</span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                @if ($newContacts > 0)
                    <div class="cl-action-box flex items-start justify-between gap-3 p-3.5 rounded-xl">
                        <div class="space-y-1">
                            <div class="flex items-center gap-1.5">
                                <span style="background-color: #e11d48; color: #ffffff;" class="px-1.5 py-0.5 rounded text-[10px] font-bold tracking-wide uppercase">Khẩn cấp</span>
                                <span class="text-xs font-semibold text-rose-950 dark:text-rose-200">{{ $newContacts }} Khách gửi liên hệ mới</span>
                            </div>
                            <p class="text-xs text-rose-800/80 dark:text-rose-300/80">Khách hàng đang chờ tư vấn viên phản hồi</p>
                        </div>
                        @if ($contactUrl)
                            <a href="{{ $contactUrl }}" style="background-color: #e11d48; color: #ffffff;" class="shrink-0 px-2.5 py-1.5 rounded-lg text-xs font-semibold hover:opacity-90 shadow-xs transition-colors">
                                Xử lý →
                            </a>
                        @endif
                    </div>
                @endif

                @if ($newJobApps > 0)
                    <div class="flex items-start justify-between gap-3 p-3.5 rounded-xl border border-amber-200/80 bg-amber-50/50 dark:border-amber-900/40 dark:bg-amber-950/20">
                        <div class="space-y-1">
                            <div class="flex items-center gap-1.5">
                                <span style="background-color: #d97706; color: #ffffff;" class="px-1.5 py-0.5 rounded text-[10px] font-bold tracking-wide uppercase">Tuyển dụng</span>
                                <span class="text-xs font-semibold text-amber-950 dark:text-amber-200">{{ $newJobApps }} Hồ sơ ứng tuyển mới</span>
                            </div>
                            <p class="text-xs text-amber-800/80 dark:text-amber-300/80">Ứng viên nộp CV đang chờ xét duyệt</p>
                        </div>
                        <a href="#new-job-applications-section" style="background-color: #d97706; color: #ffffff;" class="shrink-0 px-2.5 py-1.5 rounded-lg text-xs font-semibold hover:opacity-90 shadow-xs transition-colors">
                            Xem CV →
                        </a>
                    </div>
                @endif

                @if ($duplicateUrlsCount > 0)
                    <div class="flex items-start justify-between gap-3 p-3.5 rounded-xl border border-sky-200/80 bg-sky-50/50 dark:border-sky-900/40 dark:bg-sky-950/20">
                        <div class="space-y-1">
                            <div class="flex items-center gap-1.5">
                                <span style="background-color: #0284c7; color: #ffffff;" class="px-1.5 py-0.5 rounded text-[10px] font-bold tracking-wide uppercase">SEO Tech</span>
                                <span class="text-xs font-semibold text-sky-950 dark:text-sky-200">{{ $duplicateUrlsCount }} Redirects trùng lặp</span>
                            </div>
                            <p class="text-xs text-sky-800/80 dark:text-sky-300/80">Cần rà soát URL để tránh vòng lặp chuyển hướng</p>
                        </div>
                        @if ($redirectUrl)
                            <a href="{{ $redirectUrl }}" style="background-color: #0284c7; color: #ffffff;" class="shrink-0 px-2.5 py-1.5 rounded-lg text-xs font-semibold hover:opacity-90 shadow-xs transition-colors">
                                Rà soát →
                            </a>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    @else
        <div class="cl-custom-card p-4 shadow-sm flex items-center justify-between">
            <div class="flex items-center gap-3">
                <span class="p-2 rounded-xl bg-emerald-50 dark:bg-emerald-950/40 text-emerald-600 dark:text-emerald-400">
                    <x-heroicon-o-check-circle class="w-5 h-5" />
                </span>
                <div>
                    <h4 class="cl-title text-sm font-semibold">Không có công việc nào đang chờ xử lý</h4>
                    <p class="cl-subtext text-xs">Tất cả liên hệ và hồ sơ ứng tuyển đã được xử lý hoàn tất.</p>
                </div>
            </div>
            <span class="text-xs font-medium text-emerald-600 dark:text-emerald-400 bg-emerald-50 dark:bg-emerald-950/50 px-2.5 py-1 rounded-full border border-emerald-200/60 dark:border-emerald-800/40">
                Tất cả hoàn tất
            </span>
        </div>
    @endif
</x-filament-widgets::widget>
