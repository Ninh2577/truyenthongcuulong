<!DOCTYPE html>
<html lang="vi" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Demo Trực Quan: {{ $template->title }} - Truyền Thông Cửu Long</title>
    <meta name="robots" content="noindex, nofollow">

    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/logo-ttcl.png') }}">

    <!-- Google Fonts & Material Symbols -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0..1,0&display=block" rel="stylesheet">

    <!-- Vite Styles & Scripts / Tailwind -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --primary: #ea580c;
        }
        body {
            font-family: 'Mulish', sans-serif;
        }
    </style>
</head>
<body class="h-full overflow-hidden bg-slate-900 text-slate-800 flex flex-col" x-data="{
    device: 'desktop',
    consultModal: false,
    customerName: '',
    customerPhone: '',
    customerEmail: '',
    customerNote: 'Tôi muốn tư vấn và triển khai mẫu giao diện: {{ addslashes($template->title) }}',
    isSubmitting: false,
    submitSuccess: false,

    submitConsult() {
        if (!this.customerName || !this.customerPhone) {
            alert('Vui lòng nhập Họ tên và Số điện thoại!');
            return;
        }
        this.isSubmitting = true;
        const formData = new FormData();
        formData.append('_token', '{{ csrf_token() }}');
        formData.append('name', this.customerName);
        formData.append('phone', this.customerPhone);
        formData.append('email', this.customerEmail || 'demo@cuulong.vn');
        formData.append('service', 'Tư vấn Template: {{ addslashes($template->title) }}');
        formData.append('message', this.customerNote + ' (Mã mẫu: {{ $template->slug }})');

        fetch('{{ route('contact.submit') }}', {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            },
            body: formData
        })
        .then(() => {
            this.isSubmitting = false;
            this.submitSuccess = true;
            setTimeout(() => {
                this.consultModal = false;
            }, 3000);
        })
        .catch(() => {
            this.isSubmitting = false;
            this.submitSuccess = true;
            setTimeout(() => {
                this.consultModal = false;
            }, 3000);
        });
    }
}">

    <!-- ==================== FIXED TOP BAR (SATEK STYLE) ==================== -->
    <header class="h-16 bg-white border-b border-slate-200 px-3 sm:px-6 flex items-center justify-between shrink-0 z-40 shadow-xs">
        
        <!-- Left: Back button + Brand logo + Title -->
        <div class="flex items-center gap-3 sm:gap-4 min-w-0">
            <!-- Back arrow button -->
            <a href="{{ route('templates.index') }}" 
               class="w-9 h-9 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-700 flex items-center justify-center transition-colors shrink-0" 
               title="Quay lại kho giao diện">
                <span class="material-symbols-outlined text-[20px]">arrow_back</span>
            </a>

            <!-- Logo -->
            <a href="{{ route('home') }}" class="shrink-0 flex items-center gap-2">
                <img src="{{ asset('images/logo-ttcl.png') }}" alt="Cửu Long" class="h-8 w-auto">
            </a>

            <div class="h-6 w-px bg-slate-200 hidden md:block"></div>

            <!-- Template Title -->
            <div class="hidden sm:flex flex-col min-w-0">
                <span class="text-xs sm:text-sm font-extrabold text-[#0f172a] truncate max-w-xs md:max-w-md">
                    {{ $template->title }}
                </span>
                <span class="text-[10px] text-slate-400 font-medium">Bản xem trước trực tiếp (Live Demo)</span>
            </div>
        </div>

        <!-- Center: Device Switcher (Desktop, Tablet, Mobile) -->
        <div class="flex items-center bg-slate-100 p-1 rounded-full border border-slate-200/80 text-xs">
            <!-- Desktop -->
            <button type="button" 
                    @click="device = 'desktop'" 
                    :class="device === 'desktop' ? 'bg-primary text-white font-bold shadow-xs' : 'text-slate-600 hover:text-slate-900'"
                    class="flex items-center gap-1.5 px-3 py-1.5 rounded-full transition-all cursor-pointer">
                <span class="material-symbols-outlined text-[16px]">desktop_windows</span>
                <span class="hidden md:inline">Desktop</span>
            </button>

            <!-- Tablet -->
            <button type="button" 
                    @click="device = 'tablet'" 
                    :class="device === 'tablet' ? 'bg-primary text-white font-bold shadow-xs' : 'text-slate-600 hover:text-slate-900'"
                    class="flex items-center gap-1.5 px-3 py-1.5 rounded-full transition-all cursor-pointer">
                <span class="material-symbols-outlined text-[16px]">tablet_mac</span>
                <span class="hidden md:inline">Tablet</span>
            </button>

            <!-- Mobile -->
            <button type="button" 
                    @click="device = 'mobile'" 
                    :class="device === 'mobile' ? 'bg-primary text-white font-bold shadow-xs' : 'text-slate-600 hover:text-slate-900'"
                    class="flex items-center gap-1.5 px-3 py-1.5 rounded-full transition-all cursor-pointer">
                <span class="material-symbols-outlined text-[16px]">smartphone</span>
                <span class="hidden md:inline">Mobile</span>
            </button>
        </div>

        <!-- Right: Open in new tab + Yêu Cầu Tư Vấn + Hotline -->
        <div class="flex items-center gap-2 sm:gap-4 shrink-0">
            <!-- Open raw preview in new tab -->
            <a href="{{ route('templates.preview', ['slug' => $template->slug]) }}" 
               target="_blank" 
               class="w-9 h-9 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-600 hover:text-slate-900 flex items-center justify-center transition-colors" 
               title="Mở toàn màn hình trong tab mới">
                <span class="material-symbols-outlined text-[18px]">open_in_new</span>
            </a>

            <!-- Yêu Cầu Tư Vấn Button (Satek Style) -->
            <button type="button" 
                    @click="consultModal = true"
                    class="px-4 sm:px-6 py-2 rounded-full bg-primary hover:bg-orange-600 text-white font-bold text-xs sm:text-sm shadow-sm hover:shadow-md transition-all cursor-pointer flex items-center gap-1.5">
                <span class="material-symbols-outlined text-[16px]">headset_mic</span>
                <span>Yêu Cầu Tư Vấn</span>
            </button>

            <!-- Hotline -->
            <div class="hidden xl:flex items-center gap-2 pl-2 border-l border-slate-200">
                <div class="w-8 h-8 rounded-full bg-orange-50 text-primary flex items-center justify-center">
                    <span class="material-symbols-outlined text-[18px]">call</span>
                </div>
                <div class="flex flex-col text-right">
                    <span class="text-[10px] text-slate-400 font-semibold uppercase">Liên hệ hỗ trợ</span>
                    <a href="tel:0939523557" class="text-xs font-extrabold text-[#0f172a] hover:text-primary transition-colors">
                        0939 523 557
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- ==================== DEMO VIEWPORT CONTAINER ==================== -->
    <main class="flex-1 bg-[#0b1324] overflow-hidden flex justify-center items-center relative p-0 sm:p-3">
        <!-- Resizable Screen Wrapper -->
        <div :class="{
            'w-full h-full rounded-none': device === 'desktop',
            'w-[768px] h-[calc(100vh-5rem)] rounded-2xl shadow-2xl border-4 border-slate-700/80 my-auto overflow-hidden': device === 'tablet',
            'w-[385px] h-[calc(100vh-5rem)] rounded-[36px] shadow-2xl border-8 border-slate-800 my-auto overflow-hidden': device === 'mobile'
        }" class="transition-all duration-300 bg-white flex flex-col relative">

            <!-- Mobile speaker & notch simulation -->
            <div x-show="device === 'mobile'" class="h-6 bg-slate-900 shrink-0 flex items-center justify-between px-6 text-white text-[10px] font-mono select-none">
                <span>9:41</span>
                <div class="w-16 h-3.5 bg-black rounded-full mx-auto"></div>
                <div class="flex items-center gap-1">
                    <span class="material-symbols-outlined text-[10px]">wifi</span>
                    <span class="material-symbols-outlined text-[10px]">battery_full</span>
                </div>
            </div>

            <!-- Iframe loading the live website preview -->
            <iframe 
                src="{{ route('templates.preview', ['slug' => $template->slug]) }}" 
                class="w-full flex-1 border-0 bg-white" 
                title="{{ $template->title }} - Live Demo"
                loading="eager"
            ></iframe>
        </div>
    </main>

    <!-- ==================== QUICK CONSULTATION MODAL ==================== -->
    <div x-show="consultModal" 
         x-transition.opacity 
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/75 backdrop-blur-xs" 
         style="display: none;">
        <div @click.outside="consultModal = false" 
             class="w-full max-w-lg bg-white rounded-3xl border border-slate-200 shadow-2xl overflow-hidden flex flex-col">
            
            <!-- Header -->
            <div class="px-6 py-4 bg-slate-900 text-white flex items-center justify-between">
                <div class="flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-lg bg-primary flex items-center justify-center text-white">
                        <span class="material-symbols-outlined text-[18px]">support_agent</span>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold">Yêu Cầu Tư Vấn Mẫu Giao Diện</h3>
                        <p class="text-[11px] text-slate-400 truncate max-w-xs">{{ $template->title }}</p>
                    </div>
                </div>
                <button type="button" @click="consultModal = false" class="text-slate-400 hover:text-white transition-colors cursor-pointer">
                    <span class="material-symbols-outlined text-[22px]">close</span>
                </button>
            </div>

            <!-- Form -->
            <div class="p-6">
                <!-- Success State -->
                <div x-show="submitSuccess" class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-center space-y-2 mb-4">
                    <span class="material-symbols-outlined text-3xl text-emerald-600">check_circle</span>
                    <h4 class="font-bold text-sm">Gửi yêu cầu thành công!</h4>
                    <p class="text-xs text-slate-600">Đội ngũ kỹ thuật Cửu Long sẽ gọi lại cho bạn trong vòng 15 phút để tư vấn và gửi báo giá.</p>
                </div>

                <form x-show="!submitSuccess" @submit.prevent="submitConsult" class="space-y-4">
                    <div class="p-3 rounded-xl bg-orange-50 border border-orange-200/80 flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary text-[18px]">verified</span>
                        <span class="text-xs text-slate-700 font-semibold truncate">
                            Mẫu đang chọn: <strong class="text-primary font-bold">{{ $template->title }}</strong>
                        </span>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Họ và tên <span class="text-rose-500">*</span></label>
                        <input type="text" x-model="customerName" required placeholder="Ví dụ: Nguyễn Văn A" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 focus:border-primary focus:ring-2 focus:ring-primary/20 text-xs sm:text-sm text-slate-900 outline-none transition-all">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Số điện thoại / Zalo <span class="text-rose-500">*</span></label>
                        <input type="tel" x-model="customerPhone" required placeholder="Ví dụ: 0939 523 557" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 focus:border-primary focus:ring-2 focus:ring-primary/20 text-xs sm:text-sm text-slate-900 outline-none transition-all">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Email liên hệ (nếu có)</label>
                        <input type="email" x-model="customerEmail" placeholder="email@congty.com" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 focus:border-primary focus:ring-2 focus:ring-primary/20 text-xs sm:text-sm text-slate-900 outline-none transition-all">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Ghi chú yêu cầu</label>
                        <textarea x-model="customerNote" rows="3" class="w-full px-3.5 py-2 rounded-xl border border-slate-300 focus:border-primary focus:ring-2 focus:ring-primary/20 text-xs text-slate-900 outline-none transition-all resize-none"></textarea>
                    </div>

                    <button type="submit" 
                            :disabled="isSubmitting"
                            class="w-full py-3 rounded-xl bg-primary hover:bg-orange-600 text-white font-bold text-sm shadow-md transition-all flex items-center justify-center gap-2 cursor-pointer disabled:opacity-70">
                        <span x-show="!isSubmitting">Gửi Yêu Cầu Tư Vấn Ngay</span>
                        <span x-show="isSubmitting">Đang xử lý...</span>
                        <span class="material-symbols-outlined text-[18px]">send</span>
                    </button>
                </form>

                <div class="mt-4 pt-4 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
                    <span>Cần hỗ trợ gấp? Gọi ngay:</span>
                    <a href="tel:0939523557" class="font-bold text-primary hover:underline flex items-center gap-1">
                        <span class="material-symbols-outlined text-[15px]">call</span>
                        <span>0939 523 557</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
