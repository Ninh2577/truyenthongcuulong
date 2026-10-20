@props([
    'roleA' => null,
    'roleB' => null,
    'comparison' => [],
])

<div class="space-y-4" x-data="{
    search: '',
    filterMode: 'all', // 'all', 'diff_only', 'same_only', 'a_only', 'b_only'
}">
    @if (! $roleA || ! $roleB)
        <div class="p-4 bg-amber-50 dark:bg-amber-950/30 border border-amber-200 dark:border-amber-800 text-amber-800 dark:text-amber-300 rounded-lg text-xs">
            Vui lòng chọn đủ 2 vai trò để bắt đầu tiến hành so sánh quyền hạn.
        </div>
    @else
        {{-- Header Comparison Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
            {{-- Role A Card --}}
            <div class="p-3.5 rounded-xl border-2 border-blue-200 dark:border-blue-900/60 bg-blue-50/40 dark:bg-blue-950/20">
                <div class="flex items-center justify-between">
                    <div>
                        <span class="text-[10.5px] uppercase font-bold tracking-wider text-blue-600 dark:text-blue-400">Vai trò A</span>
                        <h4 class="text-base font-black text-gray-900 dark:text-gray-100">{{ $roleA->name }}</h4>
                    </div>
                    <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-blue-600 text-white shadow-sm">
                        {{ $roleA->permissions->count() }} / 105 quyền
                    </span>
                </div>
                <div class="mt-2 text-xs text-gray-500 flex items-center gap-3">
                    <span>👥 {{ $roleA->users()->count() }} thành viên</span>
                    <span>🛡️ Guard: {{ $roleA->guard_name }}</span>
                </div>
            </div>

            {{-- Role B Card --}}
            <div class="p-3.5 rounded-xl border-2 border-purple-200 dark:border-purple-900/60 bg-purple-50/40 dark:bg-purple-950/20">
                <div class="flex items-center justify-between">
                    <div>
                        <span class="text-[10.5px] uppercase font-bold tracking-wider text-purple-600 dark:text-purple-400">Vai trò B</span>
                        <h4 class="text-base font-black text-gray-900 dark:text-gray-100">{{ $roleB->name }}</h4>
                    </div>
                    <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-purple-600 text-white shadow-sm">
                        {{ $roleB->permissions->count() }} / 105 quyền
                    </span>
                </div>
                <div class="mt-2 text-xs text-gray-500 flex items-center gap-3">
                    <span>👥 {{ $roleB->users()->count() }} thành viên</span>
                    <span>🛡️ Guard: {{ $roleB->guard_name }}</span>
                </div>
            </div>
        </div>

        {{-- Summary Pills & Filter Bar --}}
        @php
            $bothCount = count($comparison['both'] ?? []);
            $aOnlyCount = count($comparison['a_only'] ?? []);
            $bOnlyCount = count($comparison['b_only'] ?? []);
            $neitherCount = count($comparison['neither'] ?? []);
        @endphp

        <div class="flex flex-wrap items-center justify-between gap-2 p-2.5 rounded-xl bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-800 text-xs">
            <div class="flex flex-wrap items-center gap-1.5">
                <button
                    type="button"
                    @click="filterMode = 'all'"
                    class="px-2.5 py-1 rounded-lg font-semibold transition-colors"
                    :class="filterMode === 'all' ? 'bg-gray-800 text-white dark:bg-gray-200 dark:text-gray-900' : 'bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 hover:bg-gray-100'"
                >
                    Tất cả (105)
                </button>

                <button
                    type="button"
                    @click="filterMode = 'same_only'"
                    class="px-2.5 py-1 rounded-lg font-semibold transition-colors"
                    :class="filterMode === 'same_only' ? 'bg-emerald-600 text-white' : 'bg-emerald-50 dark:bg-emerald-950/40 text-emerald-700 dark:text-emerald-300 hover:bg-emerald-100'"
                >
                    ✓ Giống nhau ({{ $bothCount }})
                </button>

                <button
                    type="button"
                    @click="filterMode = 'a_only'"
                    class="px-2.5 py-1 rounded-lg font-semibold transition-colors"
                    :class="filterMode === 'a_only' ? 'bg-blue-600 text-white' : 'bg-blue-50 dark:bg-blue-950/40 text-blue-700 dark:text-blue-300 hover:bg-blue-100'"
                >
                    + Chỉ {{ $roleA->name }} có ({{ $aOnlyCount }})
                </button>

                <button
                    type="button"
                    @click="filterMode = 'b_only'"
                    class="px-2.5 py-1 rounded-lg font-semibold transition-colors"
                    :class="filterMode === 'b_only' ? 'bg-purple-600 text-white' : 'bg-purple-50 dark:bg-purple-950/40 text-purple-700 dark:text-purple-300 hover:bg-purple-100'"
                >
                    + Chỉ {{ $roleB->name }} có ({{ $bOnlyCount }})
                </button>

                <button
                    type="button"
                    @click="filterMode = 'diff_only'"
                    class="px-2.5 py-1 rounded-lg font-semibold transition-colors"
                    :class="filterMode === 'diff_only' ? 'bg-amber-600 text-white' : 'bg-amber-50 dark:bg-amber-950/40 text-amber-700 dark:text-amber-300 hover:bg-amber-100'"
                >
                    ⚡ Điểm khác biệt ({{ $aOnlyCount + $bOnlyCount }})
                </button>
            </div>

            <div class="w-full sm:w-auto">
                <input
                    type="text"
                    x-model="search"
                    placeholder="🔍 Tìm quyền..."
                    class="w-full sm:w-48 text-xs rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-950 dark:text-gray-200 py-1 px-2.5"
                />
            </div>
        </div>

        {{-- Comparison Details by Groups --}}
        <div class="overflow-x-auto max-h-[460px] rounded-lg border border-gray-200 dark:border-gray-800">
            <table class="w-full text-left text-xs divide-y divide-gray-200 dark:divide-gray-800">
                <thead class="bg-gray-50 dark:bg-gray-900 sticky top-0 z-10">
                    <tr>
                        <th class="px-3.5 py-2.5 font-bold text-gray-700 dark:text-gray-300">Quyền hạn / Module</th>
                        <th class="px-3 py-2.5 text-center font-bold text-blue-700 dark:text-blue-300 w-36">{{ $roleA->name }}</th>
                        <th class="px-3 py-2.5 text-center font-bold text-purple-700 dark:text-purple-300 w-36">{{ $roleB->name }}</th>
                        <th class="px-3 py-2.5 text-center font-bold text-gray-600 dark:text-gray-400 w-28">Trạng thái</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-800/60 bg-white dark:bg-gray-950">
                    @foreach ($comparison['items'] ?? [] as $item)
                        @php
                            $hasA = in_array($item['key'], $comparison['role_a_perms'] ?? [], true);
                            $hasB = in_array($item['key'], $comparison['role_b_perms'] ?? [], true);
                            $state = ($hasA && $hasB) ? 'same' : (($hasA && !$hasB) ? 'a_only' : ((!$hasA && $hasB) ? 'b_only' : 'neither'));
                            $haystack = mb_strtolower("{$item['key']} {$item['title']} {$item['module']} {$item['action_label']}");
                        @endphp
                        <tr
                            x-show="(
                                (search === '' || '{{ $haystack }}'.includes(search.toLowerCase())) &&
                                (
                                    filterMode === 'all' ||
                                    (filterMode === 'same_only' && '{{ $state }}' === 'same') ||
                                    (filterMode === 'a_only' && '{{ $state }}' === 'a_only') ||
                                    (filterMode === 'b_only' && '{{ $state }}' === 'b_only') ||
                                    (filterMode === 'diff_only' && ('{{ $state }}' === 'a_only' || '{{ $state }}' === 'b_only'))
                                )
                            )"
                            class="hover:bg-gray-50/70 dark:hover:bg-gray-900/40 transition-colors {{ $state === 'a_only' ? 'bg-blue-50/20' : ($state === 'b_only' ? 'bg-purple-50/20' : '') }}"
                        >
                            {{-- Quyền hạn & Module --}}
                            <td class="px-3.5 py-2">
                                <div class="font-semibold text-gray-900 dark:text-gray-100 flex items-center gap-1.5">
                                    @if ($item['sensitivity'] === 'critical')
                                        <span title="Cực kỳ nhạy cảm">🔴</span>
                                    @elseif ($item['sensitivity'] === 'sensitive')
                                        <span title="Nhạy cảm">🟠</span>
                                    @else
                                        <span title="Thông thường">🟢</span>
                                    @endif
                                    <span>{{ $item['title'] }}</span>
                                </div>
                                <div class="text-[10px] text-gray-400 font-mono">
                                    {{ $item['key'] }}
                                </div>
                            </td>

                            {{-- Role A Status --}}
                            <td class="px-3 py-2 text-center">
                                @if ($hasA)
                                    <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-blue-100 text-blue-700 font-black">✓</span>
                                @else
                                    <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-gray-100 text-gray-300 font-bold">✕</span>
                                @endif
                            </td>

                            {{-- Role B Status --}}
                            <td class="px-3 py-2 text-center">
                                @if ($hasB)
                                    <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-purple-100 text-purple-700 font-black">✓</span>
                                @else
                                    <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-gray-100 text-gray-300 font-bold">✕</span>
                                @endif
                            </td>

                            {{-- Diff State Tag --}}
                            <td class="px-3 py-2 text-center whitespace-nowrap">
                                @if ($state === 'same')
                                    <span class="px-2 py-0.5 rounded text-[10px] font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                        ✓ Cả hai
                                    </span>
                                @elseif ($state === 'a_only')
                                    <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-blue-100 text-blue-800 border border-blue-200">
                                        + Chỉ A
                                    </span>
                                @elseif ($state === 'b_only')
                                    <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-purple-100 text-purple-800 border border-purple-200">
                                        + Chỉ B
                                    </span>
                                @else
                                    <span class="px-2 py-0.5 rounded text-[10px] font-normal bg-gray-100 text-gray-500">
                                        - Không có
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
