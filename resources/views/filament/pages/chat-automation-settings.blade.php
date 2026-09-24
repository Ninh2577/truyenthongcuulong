<x-filament-panels::page>
    <div class="space-y-6">
        <!-- Header Info Banner -->
        <div class="bg-blue-50/50 dark:bg-gray-800 border border-blue-200 dark:border-gray-700 rounded-xl p-5 shadow-sm">
            <div class="flex items-start gap-4">
                <div class="p-2.5 bg-blue-100 dark:bg-blue-900/40 text-blue-600 dark:text-blue-400 rounded-lg">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-base font-semibold text-gray-900 dark:text-white">Quy Tắc Tự Động Hóa (Rule Engine)</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-300 mt-1 leading-relaxed">
                        Hệ thống tự động phản hồi tin nhắn của khách truy cập dựa trên sự kiện và từ khóa định trước mà không cần AI.
                        Được bảo vệ bởi cơ chế chống lặp vô hạn (Loop Protection) và đảm bảo tính bất biến (Idempotency).
                    </p>
                </div>
            </div>
        </div>

        <!-- Rules List Table -->
        <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl overflow-hidden shadow-sm">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-800 flex justify-between items-center bg-gray-50/50 dark:bg-gray-800/40">
                <h4 class="font-semibold text-gray-900 dark:text-white text-sm">Danh Sách Quy Tắc Hoạt Động</h4>
                <button
                    wire:click="save"
                    type="button"
                    class="inline-flex items-center gap-2 px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white font-medium text-xs rounded-lg shadow transition focus:outline-none focus:ring-2 focus:ring-primary-500">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/>
                    </svg>
                    Lưu Thay Đổi
                </button>
            </div>

            <div class="divide-y divide-gray-200 dark:divide-gray-800">
                @forelse($rules as $index => $rule)
                    <div class="p-6 transition hover:bg-gray-50/60 dark:hover:bg-gray-800/20">
                        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                            <!-- Left: Info -->
                            <div class="flex-1 space-y-2">
                                <div class="flex items-center gap-3 flex-wrap">
                                    <span class="text-xs font-semibold px-2.5 py-0.5 rounded-full {{ ($rule['enabled'] ?? false) ? 'bg-emerald-100 text-emerald-800 dark:bg-emerald-900/40 dark:text-emerald-300' : 'bg-gray-100 text-gray-600 dark:bg-gray-800 dark:text-gray-400' }}">
                                        {{ ($rule['enabled'] ?? false) ? 'Đang kích hoạt' : 'Đã tắt' }}
                                    </span>
                                    <h5 class="text-sm font-bold text-gray-900 dark:text-white">
                                        {{ $rule['name'] ?? 'Quy tắc' }}
                                    </h5>
                                    <span class="text-xs text-gray-400">
                                        (Ưu tiên: {{ $rule['priority'] ?? 10 }})
                                    </span>
                                </div>

                                <div class="flex items-center gap-2 text-xs text-gray-500 dark:text-gray-400">
                                    <span class="font-medium">Sự kiện kích hoạt:</span>
                                    <span class="font-mono bg-gray-100 dark:bg-gray-800 px-2 py-0.5 rounded text-gray-700 dark:text-gray-300">
                                        {{ $rule['trigger'] ?? 'n/a' }}
                                    </span>
                                </div>

                                <!-- Conditions summary -->
                                @if(!empty($rule['conditions']))
                                    <div class="text-xs text-gray-600 dark:text-gray-400 flex items-center gap-2 flex-wrap">
                                        <span class="font-medium">Điều kiện:</span>
                                        @foreach($rule['conditions'] as $c)
                                            <span class="bg-blue-50 dark:bg-blue-950/60 text-blue-700 dark:text-blue-300 border border-blue-200 dark:border-blue-900 px-2 py-0.5 rounded">
                                                {{ $c['field'] ?? '' }} {{ $c['operator'] ?? '=' }} "{{ $c['value'] ?? '' }}"
                                            </span>
                                        @endforeach
                                    </div>
                                @endif

                                <!-- Action payload edit -->
                                @foreach($rule['actions'] ?? [] as $aIndex => $act)
                                    @if(($act['type'] ?? '') === 'send_message')
                                        <div class="mt-3">
                                            <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">
                                                Nội dung phản hồi tự động:
                                            </label>
                                            <textarea
                                                wire:model="rules.{{ $index }}.actions.{{ $aIndex }}.payload.message"
                                                rows="2"
                                                class="w-full text-xs rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-800 text-gray-900 dark:text-white shadow-sm focus:border-primary-500 focus:ring-primary-500"></textarea>
                                        </div>
                                    @endif
                                @endforeach
                            </div>

                            <!-- Right: Toggle button -->
                            <div class="flex items-center gap-3">
                                <button
                                    wire:click="toggleRule('{{ $rule['id'] ?? '' }}')"
                                    type="button"
                                    class="px-3 py-1.5 text-xs font-semibold rounded-lg border transition {{ ($rule['enabled'] ?? false) ? 'border-amber-300 bg-amber-50 text-amber-700 hover:bg-amber-100 dark:bg-amber-950/40 dark:border-amber-800 dark:text-amber-300' : 'border-emerald-300 bg-emerald-50 text-emerald-700 hover:bg-emerald-100 dark:bg-emerald-950/40 dark:border-emerald-800 dark:text-emerald-300' }}">
                                    {{ ($rule['enabled'] ?? false) ? 'Tạm ngắt' : 'Kích hoạt' }}
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-8 text-center text-gray-500 text-sm">
                        Chưa có quy tắc tự động hóa nào được cấu hình.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-filament-panels::page>
