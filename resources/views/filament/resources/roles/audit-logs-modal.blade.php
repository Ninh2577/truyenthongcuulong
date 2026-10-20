@props([
    'logs' => collect(),
    'role' => null,
])

<div class="space-y-4" x-data="{
    search: '',
    selectedSensitivity: 'all',
    selectedAction: 'all',
    expandedLogId: null,
    toggleLog(id) {
        this.expandedLogId = this.expandedLogId === id ? null : id;
    }
}">
    {{-- Search & Filter Controls --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-2 pb-3 border-b border-gray-200 dark:border-gray-800">
        <div class="relative">
            <input
                type="text"
                x-model="search"
                placeholder="🔍 Tìm kiếm log (tên, email, đối tượng)..."
                class="w-full text-xs rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-200 shadow-sm focus:border-primary-500 focus:ring-primary-500 py-1.5 px-3"
            />
        </div>

        <div>
            <select
                x-model="selectedSensitivity"
                class="w-full text-xs rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-200 shadow-sm focus:border-primary-500 focus:ring-primary-500 py-1.5 px-3"
            >
                <option value="all">Tất cả mức độ nhạy cảm</option>
                <option value="critical">🔴 Cực kỳ nhạy cảm</option>
                <option value="sensitive">🟠 Nhạy cảm</option>
                <option value="normal">🟢 Thông thường</option>
            </select>
        </div>

        <div>
            <select
                x-model="selectedAction"
                class="w-full text-xs rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-200 shadow-sm focus:border-primary-500 focus:ring-primary-500 py-1.5 px-3"
            >
                <option value="all">Tất cả hành động</option>
                <option value="CREATE_ROLE">✨ Tạo vai trò</option>
                <option value="UPDATE_ROLE">✏️ Cập nhật vai trò</option>
                <option value="DELETE_ROLE">🗑️ Xóa vai trò</option>
                <option value="CLONE_ROLE">📋 Sao chép vai trò</option>
                <option value="BULK_PERMISSION_CHANGE">⚙️ Đổi quyền hàng loạt</option>
                <option value="SENSITIVE_PERMISSION_CHANGE">⚠️ Đổi quyền nhạy cảm</option>
                <option value="SUPER_ADMIN_CHANGE">👑 Can thiệp Super Admin</option>
                <option value="ASSIGN_ROLE_TO_USER">👤 Gán vai trò tài khoản</option>
                <option value="REMOVE_ROLE_FROM_USER">🚫 Gỡ vai trò tài khoản</option>
            </select>
        </div>
    </div>

    @if ($logs->isEmpty())
        <div class="flex flex-col items-center justify-center p-8 text-center bg-gray-50 dark:bg-gray-800/50 rounded-xl border border-dashed border-gray-300 dark:border-gray-700">
            <x-heroicon-o-clock class="w-12 h-12 text-gray-400 mb-2" />
            <p class="text-sm font-medium text-gray-900 dark:text-gray-100">Chưa có bản ghi Audit Log nào</p>
            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Mọi thao tác thay đổi vai trò và phân quyền sẽ được hệ thống tự động ghi nhật ký tại đây.</p>
        </div>
    @else
        <div class="overflow-x-auto max-h-[460px] rounded-lg border border-gray-200 dark:border-gray-800">
            <table class="w-full text-left text-xs divide-y divide-gray-200 dark:divide-gray-800">
                <thead class="bg-gray-50 dark:bg-gray-900 sticky top-0 z-10 shadow-sm">
                    <tr>
                        <th class="px-3 py-2.5 font-semibold text-gray-700 dark:text-gray-300">Thời gian</th>
                        <th class="px-3 py-2.5 font-semibold text-gray-700 dark:text-gray-300">Người thực hiện</th>
                        <th class="px-3 py-2.5 font-semibold text-gray-700 dark:text-gray-300">Hành động</th>
                        <th class="px-3 py-2.5 font-semibold text-gray-700 dark:text-gray-300">Đối tượng</th>
                        <th class="px-3 py-2.5 font-semibold text-gray-700 dark:text-gray-300">Mức độ</th>
                        <th class="px-3 py-2.5 text-right font-semibold text-gray-700 dark:text-gray-300">Chi tiết</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-800/60 bg-white dark:bg-gray-950 font-sans">
                    @foreach ($logs as $log)
                        @php
                            $badge = $log->getSensitivityBadge();
                            $searchHaystack = mb_strtolower("{$log->actor_name} {$log->actor_email} {$log->target_name} {$log->action} {$log->ip_address}");
                        @endphp
                        <tr
                            x-show="(
                                (search === '' || '{{ $searchHaystack }}'.includes(search.toLowerCase())) &&
                                (selectedSensitivity === 'all' || selectedSensitivity === '{{ $log->sensitivity_level }}') &&
                                (selectedAction === 'all' || selectedAction === '{{ $log->action }}')
                            )"
                            class="hover:bg-gray-50/80 dark:hover:bg-gray-900/50 transition-colors"
                        >
                            {{-- Thời gian & IP --}}
                            <td class="px-3 py-2.5 whitespace-nowrap text-gray-500 dark:text-gray-400">
                                <div class="font-medium text-gray-700 dark:text-gray-300">
                                    {{ $log->created_at ? $log->created_at->format('d/m/Y H:i') : 'N/A' }}
                                </div>
                                <div class="text-[10px] text-gray-400 font-mono">
                                    {{ $log->ip_address ?: '127.0.0.1' }}
                                </div>
                            </td>

                            {{-- Người thực hiện --}}
                            <td class="px-3 py-2.5 whitespace-nowrap">
                                <div class="font-semibold text-gray-900 dark:text-gray-100 flex items-center gap-1.5">
                                    <span class="inline-flex items-center justify-center w-5 h-5 rounded-full bg-primary-100 text-primary-700 text-[10px] font-bold">
                                        {{ strtoupper(substr($log->actor_name ?: 'A', 0, 1)) }}
                                    </span>
                                    <span>{{ $log->actor_name ?: 'System' }}</span>
                                </div>
                                <div class="text-[10px] text-gray-500 font-mono">
                                    {{ $log->actor_email ?: 'N/A' }}
                                </div>
                            </td>

                            {{-- Hành động --}}
                            <td class="px-3 py-2.5 whitespace-nowrap font-medium text-gray-800 dark:text-gray-200">
                                <span>{{ $log->getActionLabel() }}</span>
                            </td>

                            {{-- Đối tượng --}}
                            <td class="px-3 py-2.5 whitespace-nowrap">
                                <span class="px-2 py-0.5 rounded text-xs font-semibold bg-gray-100 dark:bg-gray-800 text-gray-800 dark:text-gray-200 border border-gray-200 dark:border-gray-700">
                                    {{ $log->target_name }}
                                </span>
                            </td>

                            {{-- Mức độ --}}
                            <td class="px-3 py-2.5 whitespace-nowrap">
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] {{ $badge['bg'] }}">
                                    {{ $badge['label'] }}
                                </span>
                            </td>

                            {{-- Chi tiết --}}
                            <td class="px-3 py-2.5 whitespace-nowrap text-right">
                                <button
                                    type="button"
                                    @click="toggleLog({{ $log->id }})"
                                    class="inline-flex items-center gap-1 text-[11px] font-semibold text-primary-600 hover:text-primary-700 hover:underline"
                                >
                                    <span x-text="expandedLogId === {{ $log->id }} ? 'Thu gọn' : 'Xem diff'"></span>
                                    <x-heroicon-m-chevron-down class="w-3 h-3 transition-transform" ::class="expandedLogId === {{ $log->id }} ? 'rotate-180' : ''" />
                                </button>
                            </td>
                        </tr>

                        {{-- Expanded Diff Row --}}
                        <tr
                            x-show="expandedLogId === {{ $log->id }} && (
                                (search === '' || '{{ $searchHaystack }}'.includes(search.toLowerCase())) &&
                                (selectedSensitivity === 'all' || selectedSensitivity === '{{ $log->sensitivity_level }}') &&
                                (selectedAction === 'all' || selectedAction === '{{ $log->action }}')
                            )"
                            class="bg-gray-50/70 dark:bg-gray-900/70"
                        >
                            <td colspan="6" class="px-4 py-3">
                                <div class="space-y-2 text-xs">
                                    @php
                                        $changed = $log->changed_fields ?? [];
                                        $added = $changed['permissions_added'] ?? $changed['roles_added'] ?? [];
                                        $removed = $changed['permissions_removed'] ?? $changed['roles_removed'] ?? [];
                                    @endphp

                                    @if (!empty($added) || !empty($removed))
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                            {{-- Thêm (+) --}}
                                            <div class="p-2.5 rounded-lg border border-emerald-200 bg-emerald-50/40 dark:border-emerald-900/50 dark:bg-emerald-950/20">
                                                <div class="font-bold text-emerald-700 dark:text-emerald-400 mb-1 flex items-center gap-1">
                                                    <span>➕ Đã cấp / Thêm vào ({{ count($added) }})</span>
                                                </div>
                                                @if (empty($added))
                                                    <span class="text-gray-400 italic text-[11px]">Không có</span>
                                                @else
                                                    <div class="flex flex-wrap gap-1 max-h-[140px] overflow-y-auto">
                                                        @foreach ($added as $item)
                                                            <span class="inline-flex items-center px-1.5 py-0.5 rounded text-[10.5px] font-mono bg-emerald-100 text-emerald-800 dark:bg-emerald-900/60 dark:text-emerald-300">
                                                                + {{ \App\Services\RolePermissionMatrixHelper::translatePermission($item) }}
                                                            </span>
                                                        @endforeach
                                                    </div>
                                                @endif
                                            </div>

                                            {{-- Xóa (-) --}}
                                            <div class="p-2.5 rounded-lg border border-red-200 bg-red-50/40 dark:border-red-900/50 dark:bg-red-950/20">
                                                <div class="font-bold text-red-700 dark:text-red-400 mb-1 flex items-center gap-1">
                                                    <span>➖ Đã thu hồi / Bỏ quyền ({{ count($removed) }})</span>
                                                </div>
                                                @if (empty($removed))
                                                    <span class="text-gray-400 italic text-[11px]">Không có</span>
                                                @else
                                                    <div class="flex flex-wrap gap-1 max-h-[140px] overflow-y-auto">
                                                        @foreach ($removed as $item)
                                                            <span class="inline-flex items-center px-1.5 py-0.5 rounded text-[10.5px] font-mono bg-red-100 text-red-800 dark:bg-red-900/60 dark:text-red-300">
                                                                - {{ \App\Services\RolePermissionMatrixHelper::translatePermission($item) }}
                                                            </span>
                                                        @endforeach
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @else
                                        {{-- Raw State Overview --}}
                                        <div class="p-2.5 rounded-lg border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900 text-[11px]">
                                            <span class="font-bold text-gray-700 dark:text-gray-300">Thông tin thay đổi:</span>
                                            <pre class="mt-1 p-2 rounded bg-gray-50 dark:bg-gray-950 text-gray-800 dark:text-gray-200 font-mono text-[10px] overflow-x-auto">{{ json_encode($log->changed_fields ?: $log->after_state, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                                        </div>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
