<x-filament-panels::page>
    <div class="space-y-6" x-data="{
        activeTab: 'overview',
        permSearch: '',
        userSearch: '',
        selectedGroup: 'all'
    }">
        {{-- Hero Header Card --}}
        <div class="p-6 rounded-2xl bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 shadow-sm">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div class="flex items-start gap-4">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-[#FF5400] to-orange-600 flex items-center justify-center text-white shadow-md shadow-orange-500/20 shrink-0">
                        <x-heroicon-o-shield-check class="w-8 h-8" />
                    </div>
                    <div>
                        <div class="flex flex-wrap items-center gap-2">
                            <span class="text-xs uppercase tracking-wider text-gray-500 font-mono">Vai trò</span>
                            <span class="px-2 py-0.5 rounded text-[11px] font-mono bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300">
                                Guard: {{ $role->guard_name }}
                            </span>
                            @if ($isProtected)
                                <span class="px-2 py-0.5 rounded text-[11px] font-bold bg-red-100 dark:bg-red-950/60 text-red-700 dark:text-red-400 border border-red-200 dark:border-red-800">
                                    🛡️ Hệ thống bảo vệ
                                </span>
                            @endif
                        </div>
                        <h1 class="text-2xl font-black text-gray-900 dark:text-white mt-1">
                            {{ $role->name }}
                        </h1>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                            {{ $description }}
                        </p>
                    </div>
                </div>

                {{-- Metric Badges --}}
                <div class="flex flex-wrap items-center gap-3">
                    <div class="px-4 py-2.5 rounded-xl border border-gray-200 dark:border-gray-800 bg-gray-50/80 dark:bg-gray-950/60 flex items-center gap-2.5">
                        <span class="text-lg">{{ $badgeInfo['icon'] }}</span>
                        <div>
                            <div class="text-[10px] uppercase text-gray-400 font-bold">Phân loại</div>
                            <div class="text-xs font-bold text-gray-900 dark:text-gray-100">{{ $badgeInfo['label'] }}</div>
                        </div>
                    </div>

                    <div class="px-4 py-2.5 rounded-xl border border-gray-200 dark:border-gray-800 bg-gray-50/80 dark:bg-gray-950/60 flex items-center gap-2.5">
                        <span class="text-lg">👥</span>
                        <div>
                            <div class="text-[10px] uppercase text-gray-400 font-bold">Thành viên</div>
                            <div class="text-xs font-bold text-primary-600 dark:text-primary-400">{{ $usersCount }} tài khoản</div>
                        </div>
                    </div>

                    <div class="px-4 py-2.5 rounded-xl border border-gray-200 dark:border-gray-800 bg-gray-50/80 dark:bg-gray-950/60 flex items-center gap-2.5">
                        <span class="text-lg">🔐</span>
                        <div>
                            <div class="text-[10px] uppercase text-gray-400 font-bold">Quyền hạn</div>
                            <div class="text-xs font-bold text-emerald-600 dark:text-emerald-400">{{ count($rolePermissions) }} / 105 quyền</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Action Buttons --}}
            <div class="mt-5 pt-4 border-t border-gray-100 dark:border-gray-800/80 flex flex-wrap items-center justify-between gap-3">
                <a href="{{ \App\Filament\Resources\RoleResource::getUrl('index') }}" 
                   class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold text-gray-600 dark:text-gray-300 bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 transition">
                    <x-heroicon-m-arrow-left class="w-4 h-4" />
                    <span>Quay lại danh sách</span>
                </a>

                <div class="flex items-center gap-2">
                    <a href="{{ \App\Filament\Resources\RoleResource::getUrl('edit', ['record' => $role->id]) }}" 
                       class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-lg text-xs font-bold text-white bg-[#FF5400] hover:bg-orange-600 transition shadow-sm">
                        <x-heroicon-m-pencil-square class="w-4 h-4" />
                        <span>Chỉnh sửa quyền</span>
                    </a>
                </div>
            </div>
        </div>

        {{-- 4 Tabs Navigation --}}
        <div class="flex items-center gap-1 p-1 bg-gray-100 dark:bg-gray-800 rounded-xl max-w-2xl text-xs font-bold">
            <button
                type="button"
                @click="activeTab = 'overview'"
                class="flex-1 py-2 px-3 rounded-lg transition-all flex items-center justify-center gap-1.5"
                :class="activeTab === 'overview' ? 'bg-white dark:bg-gray-900 text-[#FF5400] shadow-sm' : 'text-gray-600 dark:text-gray-400 hover:text-gray-900'"
            >
                <x-heroicon-m-information-circle class="w-4 h-4" />
                <span>Tổng quan</span>
            </button>

            <button
                type="button"
                @click="activeTab = 'permissions'"
                class="flex-1 py-2 px-3 rounded-lg transition-all flex items-center justify-center gap-1.5"
                :class="activeTab === 'permissions' ? 'bg-white dark:bg-gray-900 text-[#FF5400] shadow-sm' : 'text-gray-600 dark:text-gray-400 hover:text-gray-900'"
            >
                <x-heroicon-m-shield-check class="w-4 h-4" />
                <span>Quyền hạn ({{ count($rolePermissions) }})</span>
            </button>

            <button
                type="button"
                @click="activeTab = 'members'"
                class="flex-1 py-2 px-3 rounded-lg transition-all flex items-center justify-center gap-1.5"
                :class="activeTab === 'members' ? 'bg-white dark:bg-gray-900 text-[#FF5400] shadow-sm' : 'text-gray-600 dark:text-gray-400 hover:text-gray-900'"
            >
                <x-heroicon-m-users class="w-4 h-4" />
                <span>Thành viên ({{ $usersCount }})</span>
            </button>

            <button
                type="button"
                @click="activeTab = 'history'"
                class="flex-1 py-2 px-3 rounded-lg transition-all flex items-center justify-center gap-1.5"
                :class="activeTab === 'history' ? 'bg-white dark:bg-gray-900 text-[#FF5400] shadow-sm' : 'text-gray-600 dark:text-gray-400 hover:text-gray-900'"
            >
                <x-heroicon-m-clock class="w-4 h-4" />
                <span>Lịch sử ({{ $auditLogs->count() }})</span>
            </button>
        </div>

        {{-- TAB 1: TỔNG QUAN --}}
        <div x-show="activeTab === 'overview'" class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="p-5 rounded-xl bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 space-y-4">
                    <h3 class="text-sm font-bold text-gray-900 dark:text-gray-100 flex items-center gap-2">
                        <x-heroicon-o-identification class="w-4 h-4 text-[#FF5400]" />
                        <span>Thông Tin Định Danh</span>
                    </h3>
                    <div class="space-y-3 text-xs">
                        <div class="flex justify-between py-1.5 border-b border-gray-100 dark:border-gray-800">
                            <span class="text-gray-500">Mã vai trò (Key):</span>
                            <span class="font-mono font-bold text-gray-900 dark:text-gray-100">{{ $role->name }}</span>
                        </div>
                        <div class="flex justify-between py-1.5 border-b border-gray-100 dark:border-gray-800">
                            <span class="text-gray-500">Guard bảo vệ:</span>
                            <span class="font-mono text-gray-900 dark:text-gray-100">{{ $role->guard_name }}</span>
                        </div>
                        <div class="flex justify-between py-1.5 border-b border-gray-100 dark:border-gray-800">
                            <span class="text-gray-500">Phân loại vai trò:</span>
                            <span class="font-semibold text-gray-900 dark:text-gray-100">{{ $badgeInfo['label'] }}</span>
                        </div>
                        <div class="flex justify-between py-1.5">
                            <span class="text-gray-500">Trạng thái bảo vệ:</span>
                            <span class="font-semibold {{ $isProtected ? 'text-red-600 dark:text-red-400' : 'text-emerald-600 dark:text-emerald-400' }}">
                                {{ $isProtected ? '🛡️ Bảo vệ nghiêm ngặt (Không được xóa/đổi tên)' : '⚙️ Tùy biến (Có thể chỉnh sửa/xóa khi trống)' }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="p-5 rounded-xl bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 space-y-4">
                    <h3 class="text-sm font-bold text-gray-900 dark:text-gray-100 flex items-center gap-2">
                        <x-heroicon-o-chart-pie class="w-4 h-4 text-[#FF5400]" />
                        <span>Tổng Kết Phân Quyền</span>
                    </h3>
                    <div class="space-y-3 text-xs">
                        <div class="flex justify-between py-1.5 border-b border-gray-100 dark:border-gray-800">
                            <span class="text-gray-500">Số quyền sở hữu:</span>
                            <span class="font-bold text-emerald-600 dark:text-emerald-400">{{ count($rolePermissions) }} / 105 quyền ({{ round((count($rolePermissions)/105)*100, 1) }}%)</span>
                        </div>
                        <div class="flex justify-between py-1.5 border-b border-gray-100 dark:border-gray-800">
                            <span class="text-gray-500">Số tài khoản đang gán:</span>
                            <span class="font-bold text-primary-600 dark:text-primary-400">{{ $usersCount }} người dùng</span>
                        </div>
                        <div class="flex justify-between py-1.5 border-b border-gray-100 dark:border-gray-800">
                            <span class="text-gray-500">Ngày tạo vai trò:</span>
                            <span class="text-gray-900 dark:text-gray-100">{{ $role->created_at ? $role->created_at->format('d/m/Y H:i') : 'Mặc định' }}</span>
                        </div>
                        <div class="flex justify-between py-1.5">
                            <span class="text-gray-500">Cập nhật lần cuối:</span>
                            <span class="text-gray-900 dark:text-gray-100">{{ $role->updated_at ? $role->updated_at->format('d/m/Y H:i') : 'N/A' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- TAB 2: QUYỀN HẠN (PERMISSION MATRIX) --}}
        <div x-show="activeTab === 'permissions'" class="space-y-4">
            {{-- Toolbar Search & Filter --}}
            <div class="flex flex-col sm:flex-row items-center justify-between gap-3 p-3 bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800">
                <div class="w-full sm:w-80 relative">
                    <input
                        type="text"
                        x-model="permSearch"
                        placeholder="🔍 Tìm nhanh quyền hạn..."
                        class="w-full text-xs rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-950 py-1.5 px-3"
                    />
                </div>
                <div class="flex items-center gap-2 text-xs">
                    <span class="text-gray-500">Chú giải:</span>
                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded bg-emerald-50 text-emerald-700 dark:bg-emerald-950 dark:text-emerald-400 font-medium">🟢 Thông thường</span>
                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded bg-amber-50 text-amber-700 dark:bg-amber-950 dark:text-amber-400 font-medium">🟠 Nhạy cảm</span>
                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded bg-red-50 text-red-700 dark:bg-red-950 dark:text-red-400 font-medium">🔴 Cực kỳ nhạy cảm</span>
                </div>
            </div>

            {{-- Permissions Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                @foreach ($allPermissions as $perm)
                    @php
                        $hasPerm = in_array($perm['key'], $rolePermissions, true);
                        $haystack = mb_strtolower("{$perm['key']} {$perm['title']} {$perm['module']} {$perm['action_label']}");
                    @endphp
                    <div
                        x-show="permSearch === '' || '{{ $haystack }}'.includes(permSearch.toLowerCase())"
                        class="p-3 rounded-xl border transition-all {{ $hasPerm ? 'bg-white dark:bg-gray-900 border-gray-200 dark:border-gray-800 shadow-sm' : 'bg-gray-50/50 dark:bg-gray-950/40 border-dashed border-gray-200 dark:border-gray-800/80 opacity-60' }}"
                    >
                        <div class="flex items-start justify-between gap-2">
                            <div class="min-w-0">
                                <div class="flex items-center gap-1.5">
                                    @if ($perm['sensitivity'] === 'critical')
                                        <span title="Cực kỳ nhạy cảm">🔴</span>
                                    @elseif ($perm['sensitivity'] === 'sensitive')
                                        <span title="Nhạy cảm">🟠</span>
                                    @else
                                        <span title="Thông thường">🟢</span>
                                    @endif
                                    <span class="text-xs font-bold text-gray-900 dark:text-gray-100 truncate">
                                        {{ $perm['title'] }}
                                    </span>
                                </div>
                                <div class="text-[11px] text-gray-500 font-mono mt-0.5">
                                    {{ $perm['key'] }}
                                </div>
                            </div>

                            <div>
                                @if ($hasPerm)
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10.5px] font-bold bg-emerald-100 text-emerald-800 dark:bg-emerald-950/80 dark:text-emerald-300">
                                        ✓ Có quyền
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-1.5 py-0.5 rounded text-[10px] text-gray-400 bg-gray-100 dark:bg-gray-800">
                                        Chưa cấp
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- TAB 3: THÀNH VIÊN (ROLE USAGE) --}}
        <div x-show="activeTab === 'members'" class="space-y-4">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-3 p-3 bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800">
                <div class="w-full sm:w-80 relative">
                    <input
                        type="text"
                        x-model="userSearch"
                        placeholder="🔍 Tìm người dùng theo tên, email..."
                        class="w-full text-xs rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-950 py-1.5 px-3"
                    />
                </div>
                <div class="text-xs font-semibold text-gray-600 dark:text-gray-400">
                    Người dùng đang sử dụng: <span class="text-[#FF5400] font-black">{{ $usersCount }}</span>
                </div>
            </div>

            @if ($users->isEmpty())
                <div class="p-8 text-center bg-white dark:bg-gray-900 rounded-xl border border-dashed border-gray-200 dark:border-gray-800">
                    <x-heroicon-o-users class="w-12 h-12 text-gray-300 mx-auto mb-2" />
                    <p class="text-sm font-bold text-gray-900 dark:text-gray-100">Chưa có người dùng</p>
                    <p class="text-xs text-gray-500 mt-1">Vai trò này hiện chưa được gán cho tài khoản nào.</p>
                </div>
            @else
                <div class="overflow-x-auto rounded-xl border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900">
                    <table class="w-full text-left text-xs divide-y divide-gray-200 dark:divide-gray-800">
                        <thead class="bg-gray-50 dark:bg-gray-950">
                            <tr>
                                <th class="px-4 py-3 font-bold text-gray-700 dark:text-gray-300">Tài khoản</th>
                                <th class="px-4 py-3 font-bold text-gray-700 dark:text-gray-300">Email</th>
                                <th class="px-4 py-3 font-bold text-gray-700 dark:text-gray-300">Ngày tham gia</th>
                                <th class="px-4 py-3 font-bold text-gray-700 dark:text-gray-300">Cập nhật</th>
                                <th class="px-4 py-3 text-right font-bold text-gray-700 dark:text-gray-300">Hành động</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-800/60">
                            @foreach ($users as $user)
                                @php
                                    $userHaystack = mb_strtolower("{$user->name} {$user->email}");
                                @endphp
                                <tr
                                    x-show="userSearch === '' || '{{ $userHaystack }}'.includes(userSearch.toLowerCase())"
                                    class="hover:bg-gray-50/80 dark:hover:bg-gray-800/40 transition"
                                >
                                    <td class="px-4 py-2.5">
                                        <div class="flex items-center gap-2.5">
                                            <div class="w-7 h-7 rounded-full bg-orange-100 dark:bg-orange-950/60 text-[#FF5400] font-bold flex items-center justify-center text-xs shrink-0">
                                                {{ strtoupper(substr($user->name, 0, 1)) }}
                                            </div>
                                            <span class="font-bold text-gray-900 dark:text-gray-100">{{ $user->name }}</span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-2.5 font-mono text-gray-600 dark:text-gray-400">
                                        {{ $user->email }}
                                    </td>
                                    <td class="px-4 py-2.5 text-gray-500">
                                        {{ $user->created_at ? $user->created_at->format('d/m/Y H:i') : 'N/A' }}
                                    </td>
                                    <td class="px-4 py-2.5 text-gray-500">
                                        {{ $user->updated_at ? $user->updated_at->format('d/m/Y H:i') : 'N/A' }}
                                    </td>
                                    <td class="px-4 py-2.5 text-right">
                                        <a href="{{ \App\Filament\Resources\UserResource::getUrl('edit', ['record' => $user->id]) }}" 
                                           target="_blank"
                                           class="inline-flex items-center gap-1 font-semibold text-[#FF5400] hover:underline">
                                            <span>Xem User</span>
                                            <x-heroicon-m-arrow-top-right-on-square class="w-3.5 h-3.5" />
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

        {{-- TAB 4: LỊCH SỬ (AUDIT LOGS) --}}
        <div x-show="activeTab === 'history'" class="space-y-4">
            @if ($auditLogs->isEmpty())
                <div class="p-8 text-center bg-white dark:bg-gray-900 rounded-xl border border-dashed border-gray-200 dark:border-gray-800">
                    <x-heroicon-o-clock class="w-12 h-12 text-gray-300 mx-auto mb-2" />
                    <p class="text-sm font-bold text-gray-900 dark:text-gray-100">Chưa có bản ghi nhật ký</p>
                    <p class="text-xs text-gray-500 mt-1">Các thao tác thay đổi phân quyền sắp tới sẽ được lưu vết tự động tại đây.</p>
                </div>
            @else
                <div class="space-y-3">
                    @foreach ($auditLogs as $log)
                        @php
                            $actionBadge = $log->getActionBadge();
                            $sensBadge = $log->getSensitivityBadge();
                        @endphp
                        <div class="p-4 rounded-xl bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 space-y-2">
                            <div class="flex flex-wrap items-center justify-between gap-2 text-xs">
                                <div class="flex items-center gap-2">
                                    <span class="px-2 py-0.5 rounded text-[11px] font-bold {{ $actionBadge['bg'] }} {{ $actionBadge['text'] }}">
                                        {{ $actionBadge['label'] }}
                                    </span>
                                    <span class="px-2 py-0.5 rounded text-[11px] font-semibold {{ $sensBadge['bg'] }} {{ $sensBadge['text'] }}">
                                        {{ $sensBadge['icon'] }} {{ $sensBadge['label'] }}
                                    </span>
                                    <span class="text-gray-500">bởi</span>
                                    <span class="font-bold text-gray-900 dark:text-gray-100">
                                        {{ $log->actor ? $log->actor->name : 'Hệ thống' }}
                                    </span>
                                </div>
                                <div class="text-gray-400 font-mono text-[11px]">
                                    {{ $log->created_at->format('d/m/Y H:i:s') }}
                                </div>
                            </div>

                            @if (!empty($log->changed_fields))
                                <div class="p-2.5 rounded-lg bg-gray-50 dark:bg-gray-950 font-mono text-[11px] space-y-1">
                                    @if (!empty($log->changed_fields['permissions_added']))
                                        <div class="text-emerald-600 dark:text-emerald-400">
                                            + Cấp mới: {{ implode(', ', $log->changed_fields['permissions_added']) }}
                                        </div>
                                    @endif
                                    @if (!empty($log->changed_fields['permissions_removed']))
                                        <div class="text-red-600 dark:text-red-400">
                                            - Gỡ bỏ: {{ implode(', ', $log->changed_fields['permissions_removed']) }}
                                        </div>
                                    @endif
                                    @if (!empty($log->changed_fields['name']))
                                        <div class="text-blue-600 dark:text-blue-400">
                                            Đổi tên: {{ $log->changed_fields['name']['old'] ?? '' }} &rarr; {{ $log->changed_fields['name']['new'] ?? '' }}
                                        </div>
                                    @endif
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-filament-panels::page>
