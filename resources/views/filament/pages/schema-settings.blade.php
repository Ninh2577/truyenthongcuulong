<x-filament-panels::page>
    <div class="space-y-6">
        <!-- Top Informational Banner (Rank Math SEO Style) -->
        <div class="bg-gradient-to-r from-blue-900/10 via-indigo-900/10 to-orange-500/10 border border-indigo-200/40 dark:border-indigo-900/40 rounded-2xl p-5 shadow-xs flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
            <div class="flex items-center gap-3.5">
                <div class="w-12 h-12 rounded-xl bg-primary/20 text-primary flex items-center justify-center shrink-0 shadow-inner">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                    </svg>
                </div>
                <div>
                    <h3 class="font-bold text-base text-gray-900 dark:text-white flex items-center gap-2">
                        Rank Math SEO Schema Generator & Knowledge Graph
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300">
                            Chuẩn Google Rich Snippets
                        </span>
                    </h3>
                    <p class="text-xs text-gray-600 dark:text-gray-400 mt-0.5">
                        Quản lý và tùy biến toàn diện dữ liệu có cấu trúc Schema JSON-LD theo đúng tiêu chuẩn Rank Math SEO Pro cho toàn bộ Website.
                    </p>
                </div>
            </div>

            <div class="flex items-center gap-2 shrink-0">
                <a href="https://search.google.com/test/rich-results?url={{ urlencode(config('app.url', 'https://truyenthongcuulong.com')) }}" 
                   target="_blank" 
                   rel="noopener noreferrer" 
                   class="inline-flex items-center gap-1.5 px-3.5 py-2 text-xs font-bold text-indigo-700 bg-indigo-50 hover:bg-indigo-100 dark:bg-indigo-950/60 dark:text-indigo-300 dark:hover:bg-indigo-900/80 rounded-xl transition shadow-xs">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    Google Rich Results Test
                </a>
            </div>
        </div>

        <!-- Form settings -->
        <form wire:submit="save">
            {{ $this->form }}

            <div class="mt-8 flex items-center justify-between gap-4 pt-4 border-t border-gray-200 dark:border-gray-800">
                <div class="text-xs text-gray-500">
                    Mọi thay đổi sẽ tự động xóa bộ nhớ đệm (Cache) và cập nhật Schema ngoài website ngay lập tức.
                </div>

                <x-filament::button type="submit" color="primary" size="lg" icon="heroicon-o-check-circle">
                    Lưu Cấu Hình Schema
                </x-filament::button>
            </div>
        </form>

        <!-- Live JSON-LD Schema Graph Preview Collapsible -->
        <div x-data="{ open: false }" class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 overflow-hidden shadow-xs">
            <button type="button" @click="open = !open" class="w-full px-5 py-4 flex items-center justify-between text-left hover:bg-gray-50 dark:hover:bg-gray-800/50 transition">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-gray-100 dark:bg-gray-800 flex items-center justify-center text-gray-600 dark:text-gray-300">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-sm text-gray-900 dark:text-white">Xem trước mã Schema JSON-LD Graph đang xuất ra Google</h4>
                        <p class="text-xs text-gray-500">Mã JSON-LD thực tế sinh tự động từ các thiết lập hiện tại.</p>
                    </div>
                </div>

                <svg class="w-5 h-5 text-gray-400 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <div x-show="open" x-cloak style="background-color: #0b132b !important; border-top: 1px solid #1e293b !important; padding: 1.25rem !important; border-bottom-left-radius: 1rem !important; border-bottom-right-radius: 1rem !important; overflow-x: auto !important;">
                <div class="flex items-center justify-between pb-3 mb-3 border-b border-slate-800 text-xs text-slate-400">
                    <span class="flex items-center gap-2 text-emerald-400 font-bold font-mono">
                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                        LIVE SCHEMA JSON-LD GRAPH OUTPUT
                    </span>
                    <button type="button" 
                            x-data="{ copied: false }" 
                            @click="navigator.clipboard.writeText($refs.schemaCode.innerText); copied = true; setTimeout(() => copied = false, 2000)" 
                            class="px-2.5 py-1 rounded bg-slate-800 hover:bg-slate-700 text-slate-200 text-xs font-mono transition">
                        <span x-show="!copied">Sao chép JSON</span>
                        <span x-show="copied" class="text-emerald-400">✓ Đã sao chép!</span>
                    </button>
                </div>
                <pre x-ref="schemaCode" style="margin: 0 !important; padding: 0 !important; background: transparent !important; color: #38bdf8 !important; font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace !important; font-size: 13px !important; line-height: 1.65 !important; white-space: pre-wrap !important; word-break: break-word !important;"><code>{{ json_encode(app(\App\Services\Seo\SchemaService::class)->getGraphArray(), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) }}</code></pre>
            </div>
        </div>
    </div>
</x-filament-panels::page>
