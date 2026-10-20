<div class="p-2 space-y-4">
    @if ($users->isEmpty())
        <div class="flex flex-col items-center justify-center p-8 text-center bg-gray-50 dark:bg-gray-800/50 rounded-xl border border-dashed border-gray-300 dark:border-gray-700">
            <x-heroicon-o-users class="w-12 h-12 text-gray-400 mb-2" />
            <p class="text-sm font-medium text-gray-900 dark:text-gray-100">Chưa có tài khoản nào</p>
            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Vai trò này hiện chưa được gán cho bất kỳ người dùng nào trong hệ thống.</p>
        </div>
    @else
        <div class="flex items-center justify-between pb-2 border-b border-gray-200 dark:border-gray-800">
            <span class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                Tổng số thành viên: <span class="text-primary-600 dark:text-primary-400 font-bold">{{ $users->count() }}</span>
            </span>
            <span class="text-xs text-gray-400">Hiển thị tối đa 50 người dùng gần nhất</span>
        </div>

        <div class="overflow-x-auto max-h-[420px] rounded-lg border border-gray-200 dark:border-gray-800">
            <table class="w-full text-left text-sm divide-y divide-gray-200 dark:divide-gray-800">
                <thead class="bg-gray-50 dark:bg-gray-900 sticky top-0">
                    <tr>
                        <th class="px-4 py-3 font-semibold text-gray-700 dark:text-gray-300">Họ và Tên</th>
                        <th class="px-4 py-3 font-semibold text-gray-700 dark:text-gray-300">Email</th>
                        <th class="px-4 py-3 font-semibold text-gray-700 dark:text-gray-300">Ngày tạo</th>
                        <th class="px-4 py-3 text-right font-semibold text-gray-700 dark:text-gray-300">Thao tác</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-800/60 bg-white dark:bg-gray-950">
                    @foreach ($users as $user)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-900/50 transition-colors">
                            <td class="px-4 py-2.5 font-medium text-gray-900 dark:text-gray-100 flex items-center gap-2">
                                <span class="inline-flex items-center justify-center w-7 h-7 rounded-full bg-primary-100 dark:bg-primary-900/40 text-primary-600 dark:text-primary-400 text-xs font-bold">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </span>
                                <span>{{ $user->name }}</span>
                            </td>
                            <td class="px-4 py-2.5 text-gray-600 dark:text-gray-400 text-xs font-mono">
                                {{ $user->email }}
                            </td>
                            <td class="px-4 py-2.5 text-gray-500 dark:text-gray-400 text-xs">
                                {{ $user->created_at ? $user->created_at->format('d/m/Y H:i') : 'N/A' }}
                            </td>
                            <td class="px-4 py-2.5 text-right">
                                <a href="{{ \App\Filament\Resources\UserResource::getUrl('edit', ['record' => $user->id]) }}" 
                                   target="_blank" 
                                   class="inline-flex items-center gap-1 text-xs font-semibold text-primary-600 hover:text-primary-700 dark:text-primary-400 dark:hover:text-primary-300 hover:underline">
                                    <span>Hồ sơ</span>
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
