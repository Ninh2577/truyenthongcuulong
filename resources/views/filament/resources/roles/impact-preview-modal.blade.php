@props([
    'role' => null,
    'diff' => [],
    'userCount' => 0,
])

<div class="space-y-4">
    {{-- Role Impact Alert --}}
    @if ($userCount > 0)
        <div class="p-3.5 rounded-xl border border-amber-300 bg-amber-50 dark:border-amber-900/60 dark:bg-amber-950/30 flex items-start gap-3">
            <span class="text-xl">⚠️</span>
            <div>
                <h4 class="text-xs font-bold text-amber-900 dark:text-amber-200 uppercase tracking-wider">
                    Cảnh Báo Phạm Vi Ảnh Hưởng (Impact Warning)
                </h4>
                <p class="text-xs text-amber-800 dark:text-amber-300 mt-0.5 leading-relaxed">
                    Vai trò <strong class="font-bold underline">{{ $role?->name }}</strong> hiện đang được sử dụng bởi <span class="px-1.5 py-0.5 rounded bg-amber-200 dark:bg-amber-900 font-black text-amber-950 dark:text-amber-100">{{ $userCount }} tài khoản</span>. Việc cập nhật quyền hạn sẽ ngay lập tức thay đổi phạm vi truy cập của toàn bộ các tài khoản này.
                </p>
            </div>
        </div>
    @endif

    {{-- Critical Permission Alert if applicable --}}
    @if (!empty($diff['has_critical_added']))
        <div class="p-3.5 rounded-xl border border-red-300 bg-red-50 dark:border-red-900/60 dark:bg-red-950/30 flex items-start gap-3">
            <span class="text-xl">🚨</span>
            <div>
                <h4 class="text-xs font-bold text-red-900 dark:text-red-200 uppercase tracking-wider">
                    Cảnh Báo Cấp Quyền Cực Kỳ Nhạy Cảm (Critical Permission)
                </h4>
                <p class="text-xs text-red-800 dark:text-red-300 mt-0.5 leading-relaxed">
                    Bạn đang chuẩn bị cấp các quyền thuộc nhóm quản trị bảo mật cao (Tài khoản, Phân quyền, hoặc Cài đặt lõi). Hãy chắc chắn rằng vai trò này có thẩm quyền hợp pháp.
                </p>
            </div>
        </div>
    @endif

    {{-- Formula Summary Banner: CURRENT + ADDED - REMOVED = FINAL --}}
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-2 text-center">
        <div class="p-2.5 rounded-xl bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-800">
            <span class="text-[10px] text-gray-500 uppercase font-semibold">Quyền hiện tại</span>
            <div class="text-lg font-black text-gray-800 dark:text-gray-200">{{ $diff['before_count'] ?? 0 }}</div>
        </div>

        <div class="p-2.5 rounded-xl bg-emerald-50 dark:bg-emerald-950/40 border border-emerald-200 dark:border-emerald-800/60">
            <span class="text-[10px] text-emerald-600 uppercase font-bold">Thêm mới (+)</span>
            <div class="text-lg font-black text-emerald-600">+{{ $diff['added_count'] ?? 0 }}</div>
        </div>

        <div class="p-2.5 rounded-xl bg-red-50 dark:bg-red-950/40 border border-red-200 dark:border-red-800/60">
            <span class="text-[10px] text-red-600 uppercase font-bold">Thu hồi (-)</span>
            <div class="text-lg font-black text-red-600">-{{ $diff['removed_count'] ?? 0 }}</div>
        </div>

        <div class="p-2.5 rounded-xl bg-primary-50 dark:bg-primary-950/40 border border-primary-200 dark:border-primary-800/60">
            <span class="text-[10px] text-primary-600 uppercase font-bold">Sau khi lưu</span>
            <div class="text-lg font-black text-primary-600">{{ $diff['final_count'] ?? 0 }}</div>
        </div>
    </div>

    {{-- Detailed Lists of Added and Removed Permissions --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs">
        {{-- Added (+) --}}
        <div class="p-3 rounded-xl border border-emerald-200 bg-emerald-50/30 dark:border-emerald-900/40 dark:bg-emerald-950/20">
            <h5 class="font-bold text-emerald-800 dark:text-emerald-300 mb-2 flex items-center justify-between">
                <span>➕ Quyền hạn được cấp mới</span>
                <span class="px-2 py-0.5 rounded-full text-[10px] bg-emerald-100 text-emerald-800 font-mono">{{ $diff['added_count'] ?? 0 }}</span>
            </h5>
            @if (empty($diff['added']))
                <span class="text-gray-400 italic text-[11px]">Không thêm quyền nào</span>
            @else
                <div class="space-y-1 max-h-[220px] overflow-y-auto pr-1">
                    @foreach ($diff['added'] as $perm)
                        @php
                            $sens = \App\Services\RolePermissionMatrixHelper::getPermissionSensitivity($perm);
                        @endphp
                        <div class="flex items-center justify-between p-1.5 rounded bg-white dark:bg-gray-900 border border-emerald-100 dark:border-emerald-900/30 font-medium">
                            <span class="text-emerald-900 dark:text-emerald-200 flex items-center gap-1">
                                <span>+</span>
                                <span>{{ \App\Services\RolePermissionMatrixHelper::translatePermission($perm) }}</span>
                            </span>
                            @if ($sens === 'critical')
                                <span class="text-[9px] px-1 py-0.2 rounded bg-red-100 text-red-700 font-bold">🔴 Cực kỳ nhạy cảm</span>
                            @elseif ($sens === 'sensitive')
                                <span class="text-[9px] px-1 py-0.2 rounded bg-amber-100 text-amber-700 font-bold">🟠 Nhạy cảm</span>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- Removed (-) --}}
        <div class="p-3 rounded-xl border border-red-200 bg-red-50/30 dark:border-red-900/40 dark:bg-red-950/20">
            <h5 class="font-bold text-red-800 dark:text-red-300 mb-2 flex items-center justify-between">
                <span>➖ Quyền hạn bị thu hồi</span>
                <span class="px-2 py-0.5 rounded-full text-[10px] bg-red-100 text-red-800 font-mono">{{ $diff['removed_count'] ?? 0 }}</span>
            </h5>
            @if (empty($diff['removed']))
                <span class="text-gray-400 italic text-[11px]">Không thu hồi quyền nào</span>
            @else
                <div class="space-y-1 max-h-[220px] overflow-y-auto pr-1">
                    @foreach ($diff['removed'] as $perm)
                        <div class="flex items-center justify-between p-1.5 rounded bg-white dark:bg-gray-900 border border-red-100 dark:border-red-900/30 font-medium text-red-900 dark:text-red-200">
                            <span class="flex items-center gap-1">
                                <span>-</span>
                                <span>{{ \App\Services\RolePermissionMatrixHelper::translatePermission($perm) }}</span>
                            </span>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
