@php
    $codes = $this->getUser()->recoveryCodes();
    $codesText = implode("\n", $codes);
@endphp

<div class="my-5 rounded-2xl border border-amber-200 bg-amber-50/50 p-5 dark:border-amber-900/40 dark:bg-amber-950/20" x-data="{ copied: false }">
    <div class="flex items-center justify-between mb-3">
        <div class="flex items-center gap-2 text-sm font-bold text-gray-900 dark:text-white">
            <x-heroicon-m-key class="h-5 w-5 text-amber-600" />
            <span>Mã khôi phục dự phòng của bạn</span>
        </div>
        <button 
            type="button" 
            @click="navigator.clipboard.writeText('{{ $codesText }}'); copied = true; setTimeout(() => copied = false, 2500)"
            class="inline-flex items-center gap-1.5 rounded-lg bg-white px-3 py-1.5 text-xs font-semibold text-gray-700 shadow-xs border border-gray-300 hover:bg-gray-50 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-200 transition"
        >
            <x-heroicon-m-clipboard-document-check class="h-4 w-4 text-emerald-600" x-show="copied" />
            <x-heroicon-m-clipboard-document class="h-4 w-4 text-gray-500" x-show="!copied" />
            <span x-text="copied ? 'Đã sao chép!' : 'Sao chép tất cả mã'"></span>
        </button>
    </div>

    <p class="text-xs text-gray-600 dark:text-gray-400 mb-4 leading-relaxed">
        Lưu ý: Mỗi mã khôi phục chỉ sử dụng được <strong>duy nhất 1 lần</strong>. Hãy sao chép và lưu trữ các mã này vào nơi an toàn.
    </p>

    <div class="font-mono text-xs sm:text-sm grid grid-cols-1 sm:grid-cols-2 gap-2.5">
        @foreach($codes as $code)
            <div class="flex items-center justify-between rounded-lg bg-white/90 px-3.5 py-2 border border-amber-100 shadow-2xs font-semibold tracking-wider text-gray-800 dark:bg-gray-900 dark:border-gray-800 dark:text-amber-300">
                <span>{{ $code }}</span>
                <span class="text-[10px] uppercase font-sans text-gray-400 font-normal">Dự phòng</span>
            </div>
        @endforeach
    </div>
</div>
