<x-filament-panels::page>
    <div class="space-y-6">
        <!-- Header Info Banner -->
        <div class="bg-indigo-50/60 dark:bg-gray-800 border border-indigo-200 dark:border-gray-700 rounded-xl p-5 shadow-sm">
            <div class="flex items-start gap-4">
                <div class="p-2.5 bg-indigo-100 dark:bg-indigo-900/40 text-indigo-600 dark:text-indigo-400 rounded-lg">
                    <x-filament::icon icon="heroicon-o-cpu-chip" class="w-6 h-6" />
                </div>
                <div>
                    <h3 class="text-base font-semibold text-gray-900 dark:text-white">Quản Trị Vận Hành Trợ Lý AI Chat</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-300 mt-1 leading-relaxed">
                        Kiểm soát trạng thái hoạt động, nhà cung cấp AI, tần suất phản hồi và cơ chế bàn giao nhân viên tư vấn trực tiếp (Human Handoff).
                        Cấu hình được lưu trữ tại cơ sở dữ liệu và có hiệu lực tức thời cho toàn bộ hệ thống hội thoại.
                    </p>
                </div>
            </div>
        </div>

        <!-- Operational Status (Read-Only Health Check) -->
        <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl p-6 shadow-sm">
            <h4 class="text-sm font-bold text-gray-900 dark:text-white uppercase tracking-wider mb-4 flex items-center gap-2">
                <x-filament::icon icon="heroicon-m-heart" class="w-4 h-4 text-rose-500" />
                Trạng Thái Vận Hành Hệ Thống
            </h4>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-xs">
                <div class="p-3 bg-gray-50 dark:bg-gray-800/60 rounded-lg border border-gray-100 dark:border-gray-800">
                    <span class="text-gray-500 dark:text-gray-400 block mb-1">Môi trường:</span>
                    <span class="font-mono font-bold text-gray-800 dark:text-gray-200 uppercase">{{ app()->environment() }}</span>
                </div>
                <div class="p-3 bg-gray-50 dark:bg-gray-800/60 rounded-lg border border-gray-100 dark:border-gray-800">
                    <span class="text-gray-500 dark:text-gray-400 block mb-1">Trạng thái AI:</span>
                    @if($enabled)
                        <span class="font-bold text-emerald-600 dark:text-emerald-400 inline-flex items-center gap-1">
                            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span> Đang Bật
                        </span>
                    @else
                        <span class="font-bold text-gray-500 dark:text-gray-400 inline-flex items-center gap-1">
                            <span class="w-2 h-2 rounded-full bg-gray-400"></span> Đã Tắt
                        </span>
                    @endif
                </div>
                <div class="p-3 bg-gray-50 dark:bg-gray-800/60 rounded-lg border border-gray-100 dark:border-gray-800">
                    <span class="text-gray-500 dark:text-gray-400 block mb-1">OpenAI API Key:</span>
                    @if(!empty(config('chat_ai.openai.api_key')))
                        <span class="font-semibold text-emerald-600 dark:text-emerald-400 flex items-center gap-1">
                            <x-filament::icon icon="heroicon-m-check-circle" class="w-3.5 h-3.5" /> Đã cấu hình
                        </span>
                    @else
                        <span class="font-semibold text-amber-600 dark:text-amber-400 flex items-center gap-1">
                            <x-filament::icon icon="heroicon-m-exclamation-circle" class="w-3.5 h-3.5" /> Chưa có Key
                        </span>
                    @endif
                </div>
                <div class="p-3 bg-gray-50 dark:bg-gray-800/60 rounded-lg border border-gray-100 dark:border-gray-800">
                    <span class="text-gray-500 dark:text-gray-400 block mb-1">Gemini API Key:</span>
                    @if(!empty(config('chat_ai.gemini.api_key')))
                        <span class="font-semibold text-emerald-600 dark:text-emerald-400 flex items-center gap-1">
                            <x-filament::icon icon="heroicon-m-check-circle" class="w-3.5 h-3.5" /> Đã cấu hình
                        </span>
                    @else
                        <span class="font-semibold text-amber-600 dark:text-amber-400 flex items-center gap-1">
                            <x-filament::icon icon="heroicon-m-exclamation-circle" class="w-3.5 h-3.5" /> Chưa có Key
                        </span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Main Configuration Form -->
        <form wire:submit="save" class="space-y-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Group 1: AI Runtime Controls -->
                <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl p-6 shadow-sm space-y-5">
                    <h4 class="font-bold text-sm text-gray-900 dark:text-white border-b border-gray-100 dark:border-gray-800 pb-3 flex items-center gap-2">
                        <x-filament::icon icon="heroicon-m-adjustments-vertical" class="w-4 h-4 text-primary-500" />
                        Cấu Hình Vận Hành AI (Runtime)
                    </h4>

                    <!-- AI Enabled Toggle -->
                    <div class="flex items-center justify-between p-3.5 bg-gray-50 dark:bg-gray-800/50 rounded-lg border border-gray-100 dark:border-gray-800">
                        <div>
                            <label for="ai-enabled-toggle" class="font-semibold text-sm text-gray-900 dark:text-gray-100 block cursor-pointer">
                                Kích hoạt Trợ lý AI
                            </label>
                            <span class="text-xs text-gray-500 dark:text-gray-400 block mt-0.5">
                                Khi tắt, tin nhắn khách vẫn hoạt động và chuyển thẳng cho nhân viên tư vấn.
                            </span>
                        </div>
                        <input
                            type="checkbox"
                            id="ai-enabled-toggle"
                            wire:model="enabled"
                            class="w-5 h-5 rounded border-gray-300 text-primary-600 focus:ring-primary-500 cursor-pointer"
                        />
                    </div>
                    @error('enabled') <p class="text-xs text-red-500">{{ $message }}</p> @enderror

                    <!-- Provider Select -->
                    <div>
                        <label for="ai-provider" class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1.5">
                            Nhà Cung Cấp AI (Provider) <span class="text-red-500">*</span>
                        </label>
                        <select
                            id="ai-provider"
                            wire:model="provider"
                            class="w-full text-xs sm:text-sm rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-primary-500 focus:border-primary-500"
                        >
                            <option value="none">none — Tắt nhà cung cấp (Fail-Closed)</option>
                            <option value="openai">openai — OpenAI (GPT-4o / GPT-4o-mini)</option>
                            <option value="gemini">gemini — Google Gemini (Gemini 1.5 Flash)</option>
                            @if(!app()->environment('production'))
                                <option value="fake">fake — Giả lập thử nghiệm (Test/Dev Only)</option>
                            @endif
                        </select>
                        <p class="text-[11px] text-gray-400 mt-1">
                            Lưu ý: API Key của nhà cung cấp được cấu hình an toàn qua file môi trường .env và không hiển thị trên giao diện.
                        </p>
                        @error('provider') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Default Channel -->
                    <div>
                        <label for="ai-channel" class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1.5">
                            Kênh Mặc Định Cho Cuộc Trò Chuyện Mới <span class="text-red-500">*</span>
                        </label>
                        <select
                            id="ai-channel"
                            wire:model="default_channel"
                            class="w-full text-xs sm:text-sm rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-primary-500 focus:border-primary-500"
                        >
                            <option value="hybrid">hybrid — Hỗn hợp (AI trả lời trước, bàn giao khi cần)</option>
                            <option value="ai">ai — Trợ lý AI ưu tiên</option>
                            <option value="human">human — Nhân viên CSKH (Bỏ qua AI)</option>
                        </select>
                        @error('default_channel') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Rate Limit -->
                    <div>
                        <label for="ai-rate-limit" class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1.5">
                            Giới Hạn Tần Suất AI Phản Hồi (tin nhắn / phút) <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="number"
                            id="ai-rate-limit"
                            min="1"
                            max="60"
                            wire:model="max_ai_replies_per_minute"
                            class="w-full text-xs sm:text-sm rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-primary-500 focus:border-primary-500"
                        />
                        <p class="text-[11px] text-gray-400 mt-1">
                            Nếu khách gửi tin nhắn liên tục vượt quá ngưỡng này trong 1 phút, hệ thống tự động kích hoạt bàn giao cho nhân viên trực tiếp.
                        </p>
                        @error('max_ai_replies_per_minute') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <!-- Group 2: Human Handoff Controls -->
                <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl p-6 shadow-sm space-y-5">
                    <h4 class="font-bold text-sm text-gray-900 dark:text-white border-b border-gray-100 dark:border-gray-800 pb-3 flex items-center gap-2">
                        <x-filament::icon icon="heroicon-m-user-group" class="w-4 h-4 text-emerald-500" />
                        Cấu Hình Bàn Giao Nhân Viên (Human Handoff)
                    </h4>

                    <!-- Handoff Keywords -->
                    <div>
                        <label for="ai-keywords" class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1.5">
                            Từ Khóa Kích Hoạt Bàn Giao (Mỗi từ khóa 1 dòng)
                        </label>
                        <textarea
                            id="ai-keywords"
                            rows="4"
                            wire:model="handoff_keywords_text"
                            placeholder="gặp nhân viên&#10;tư vấn viên&#10;human&#10;agent"
                            class="w-full font-mono text-xs rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-primary-500 focus:border-primary-500"
                        ></textarea>
                        <p class="text-[11px] text-gray-400 mt-1">
                            Khi khách nhắn bất kỳ từ khóa nào trên đây, AI sẽ dừng lại và chuyển trạng thái sang "Chờ nhân viên".
                        </p>
                        @error('handoff_keywords') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Handoff Customer Notice -->
                    <div>
                        <label for="ai-handoff-notice" class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1.5">
                            Thông Báo Bàn Giao Gửi Khách Hàng <span class="text-red-500">*</span>
                        </label>
                        <textarea
                            id="ai-handoff-notice"
                            rows="2"
                            wire:model="handoff_notice"
                            class="w-full text-xs rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-primary-500 focus:border-primary-500"
                        ></textarea>
                        @error('handoff_notice') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Fallback Notice -->
                    <div>
                        <label for="ai-fallback-notice" class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1.5">
                            Thông Báo Khi AI Gặp Sự Cố Hoặc Timeout <span class="text-red-500">*</span>
                        </label>
                        <textarea
                            id="ai-fallback-notice"
                            rows="2"
                            wire:model="fallback_notice"
                            class="w-full text-xs rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-primary-500 focus:border-primary-500"
                        ></textarea>
                        @error('fallback_notice') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            <!-- Submit Button Toolbar -->
            <div class="flex items-center justify-end gap-3 pt-2">
                <button
                    type="submit"
                    wire:loading.attr="disabled"
                    class="inline-flex items-center gap-2 px-5 py-2.5 bg-primary-600 hover:bg-primary-700 text-white font-medium text-xs sm:text-sm rounded-lg shadow-sm transition focus:outline-none focus:ring-2 focus:ring-primary-500 disabled:opacity-50"
                >
                    <span wire:loading.remove>
                        <x-filament::icon icon="heroicon-m-check" class="w-4 h-4 inline" />
                        Lưu Cấu Hình AI
                    </span>
                    <span wire:loading>
                        Đang lưu cấu hình...
                    </span>
                </button>
            </div>
        </form>

        <!-- Audit Trail Card -->
        <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl overflow-hidden shadow-sm">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-800 bg-gray-50/50 dark:bg-gray-800/40 flex items-center justify-between">
                <h4 class="font-bold text-sm text-gray-900 dark:text-white flex items-center gap-2">
                    <x-filament::icon icon="heroicon-m-clipboard-document-list" class="w-4 h-4 text-gray-500" />
                    Lịch Sử Thay Đổi Cấu Hình (Audit Trail)
                </h4>
                <span class="text-xs text-gray-400">Tối đa 50 sự kiện gần nhất</span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs text-gray-600 dark:text-gray-300">
                    <thead class="bg-gray-100/60 dark:bg-gray-800/60 text-gray-700 dark:text-gray-300 font-semibold border-b border-gray-200 dark:border-gray-800">
                        <tr>
                            <th class="px-4 py-3">Thời điểm</th>
                            <th class="px-4 py-3">Người thực hiện</th>
                            <th class="px-4 py-3">Nội dung thay đổi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-800">
                        @forelse($auditLogs as $log)
                            <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-800/30 transition">
                                <td class="px-4 py-3 font-mono text-[11px] whitespace-nowrap text-gray-500">
                                    {{ \Carbon\Carbon::parse($log['timestamp'])->timezone(config('app.timezone', 'Asia/Ho_Chi_Minh'))->format('d/m/Y H:i:s') }}
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap">
                                    <span class="font-medium text-gray-900 dark:text-gray-100">{{ $log['actor_name'] ?? 'Hệ thống' }}</span>
                                    <span class="text-[11px] text-gray-400 block">{{ $log['actor_email'] ?? '' }}</span>
                                </td>
                                <td class="px-4 py-3 text-[11px]">
                                    @if(!empty($log['changes']))
                                        <div class="space-y-1">
                                            @foreach($log['changes'] as $field => $diff)
                                                <div class="flex items-center gap-1.5 flex-wrap">
                                                    <span class="font-mono font-semibold text-primary-600 dark:text-primary-400">{{ $field }}:</span>
                                                    <span class="bg-red-50 dark:bg-red-950/40 text-red-600 dark:text-red-400 px-1 py-0.2 rounded line-through">
                                                        {{ is_array($diff['old']) ? json_encode($diff['old']) : ($diff['old'] === false ? 'false' : ($diff['old'] === true ? 'true' : ($diff['old'] ?? 'null'))) }}
                                                    </span>
                                                    <span class="text-gray-400">→</span>
                                                    <span class="bg-emerald-50 dark:bg-emerald-950/40 text-emerald-700 dark:text-emerald-300 px-1 py-0.2 rounded font-medium">
                                                        {{ is_array($diff['new']) ? json_encode($diff['new']) : ($diff['new'] === false ? 'false' : ($diff['new'] === true ? 'true' : ($diff['new'] ?? 'null'))) }}
                                                    </span>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <span class="italic text-gray-400">Không có thay đổi</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-4 py-8 text-center text-gray-400 italic">
                                    Chưa có sự kiện thay đổi cấu hình nào được ghi nhận.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-filament-panels::page>
