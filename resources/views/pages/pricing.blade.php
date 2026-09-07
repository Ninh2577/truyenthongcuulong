@extends('layouts.app')

@section('title', 'Bảng Giá Dịch Vụ & Dự Toán Chi Phí - Truyền Thông Cửu Long')
@section('meta_description', 'Minh bạch chi phí sản xuất phim TVC, thiết kế website và chiến dịch quảng cáo. Trải nghiệm công cụ tính chi phí dự toán tự động trong 30 giây.')

@section('content')
<div class="w-full bg-surface bg-dot-grid-subtle pt-28 pb-20 border-b border-slate-200/60" x-data="{
    tab: 'tvc',
    // Cost Estimator state
    serviceType: 'tvc',
    duration: '60',
    drone: true,
    actor: 'pro',
    webPages: '10',
    aiFeature: false,
    calculateTotal() {
        let total = 0;
        if (this.serviceType === 'tvc') {
            total += parseInt(this.duration) * 350000;
            if (this.drone) total += 5000000;
            if (this.actor === 'pro') total += 12000000;
            if (this.actor === 'celeb') total += 35000000;
        } else {
            total += parseInt(this.webPages) * 1500000;
            if (this.aiFeature) total += 15000000;
            total += 10000000; // Base setup
        }
        return new Intl.NumberFormat('vi-VN').format(total) + ' VNĐ';
    }
}">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col gap-16">
        
        <!-- Pricing Header -->
        <div class="text-center max-w-3xl mx-auto flex flex-col gap-3">
            <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-orange-100 border border-orange-300 text-primary font-mono text-xs font-bold mx-auto">
                <span class="w-2 h-2 rounded-full bg-primary animate-pulse"></span>
                <span>TRANSPARENT PRICING &amp; ESTIMATOR</span>
            </div>
            <h1 class="font-headline text-3xl sm:text-5xl font-extrabold text-navy-base tracking-tight">
                Bảng Giá Minh Bạch &amp; <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary via-orange-500 to-accent-coral">Dự Toán Tức Thì</span>
            </h1>
            <p class="font-body text-slate-600 text-sm sm:text-base leading-relaxed">
                Cam kết rõ ràng theo hợp đồng SLA, không phát sinh chi phí ẩn. Tùy chỉnh linh hoạt theo quy mô và ngân sách của từng doanh nghiệp.
            </p>

            <!-- Toggle Switcher -->
            <div class="flex items-center justify-center gap-2 mt-4">
                <button @click="tab = 'tvc'" :class="tab === 'tvc' ? 'bg-primary text-white shadow-md' : 'bg-white text-slate-600 border border-slate-200'" class="px-6 py-2.5 rounded-full font-headline text-xs font-bold transition-all">
                    Gói Sản Xuất Video &amp; TVC
                </button>
                <button @click="tab = 'web'" :class="tab === 'web' ? 'bg-sky-600 text-white shadow-md' : 'bg-white text-slate-600 border border-slate-200'" class="px-6 py-2.5 rounded-full font-headline text-xs font-bold transition-all">
                    Gói Thiết Kế Web &amp; Nền Tảng Số
                </button>
            </div>
        </div>

        <!-- TVC Pricing Cards -->
        <div x-show="tab === 'tvc'" x-transition class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Tier 1 -->
            <div class="p-8 rounded-3xl bg-white border border-slate-200 shadow-sm flex flex-col justify-between hover:shadow-xl transition-all">
                <div class="flex flex-col gap-4">
                    <span class="font-mono text-xs font-bold text-slate-500 uppercase tracking-wider">GÓI CƠ BẢN</span>
                    <h3 class="font-headline text-2xl font-bold text-navy-base">Viral Short-form &amp; Reels</h3>
                    <div class="flex items-baseline gap-1 my-2">
                        <span class="font-headline text-3xl sm:text-4xl font-black text-navy-base">15.000.000</span>
                        <span class="text-xs font-mono text-slate-500">VNĐ / gói 5 video</span>
                    </div>
                    <p class="text-xs text-slate-500">Tối ưu cho TikTok, Facebook Reels, YouTube Shorts thu hút lượt tương tác tự nhiên.</p>
                    <ul class="space-y-3 pt-4 border-t border-slate-100 text-xs text-slate-600">
                        <li class="flex items-center gap-2">✓ 05 Video ngắn chuẩn 9:16 Full HD</li>
                        <li class="flex items-center gap-2">✓ Kịch bản bắt trend &amp; Hook 3 giây</li>
                        <li class="flex items-center gap-2">✓ Quay 01 buổi studio hoặc ngoại cảnh</li>
                        <li class="flex items-center gap-2">✓ Chèn phụ đề dynamic &amp; âm nhạc bản quyền</li>
                    </ul>
                </div>
                <a href="{{ route('contact', ['service' => 'Gói Short-form 15tr']) }}" class="mt-8 py-3 w-full rounded-xl bg-slate-100 hover:bg-slate-200 text-navy-base font-headline text-xs font-bold text-center transition-colors">
                    Đăng Ký Gói Này
                </a>
            </div>

            <!-- Tier 2 (Featured) -->
            <div class="p-8 rounded-3xl bg-gradient-to-b from-navy-base via-navy-surface to-navy-card text-white border-2 border-primary shadow-2xl flex flex-col justify-between relative transform lg:-translate-y-2">
                <div class="absolute -top-3.5 left-1/2 -translate-x-1/2 px-4 py-1 rounded-full bg-primary text-white font-mono text-[11px] font-bold shadow-md">
                    ★ ĐƯỢC DOANH NGHIỆP CHỌN NHIỀU NHẤT
                </div>
                <div class="flex flex-col gap-4 pt-2">
                    <span class="font-mono text-xs font-bold text-accent-amber uppercase tracking-wider">GÓI DOANH NGHIỆP PRO</span>
                    <h3 class="font-headline text-2xl font-bold text-white">Phim Doanh Nghiệp &amp; TVC</h3>
                    <div class="flex items-baseline gap-1 my-2">
                        <span class="font-headline text-3xl sm:text-4xl font-black text-transparent bg-clip-text bg-gradient-to-r from-primary to-accent-amber">45.000.000</span>
                        <span class="text-xs font-mono text-slate-300">VNĐ / video</span>
                    </div>
                    <p class="text-xs text-slate-300">Nâng tầm vị thế thương hiệu với quy trình quay dựng chuyên nghiệp chuẩn điện ảnh 4K.</p>
                    <ul class="space-y-3 pt-4 border-t border-white/10 text-xs text-slate-200">
                        <li class="flex items-center gap-2">✓ Phim doanh nghiệp 3-5 phút 4K ProRes</li>
                        <li class="flex items-center gap-2">✓ Dàn máy quay Sony FX / RED Cinema</li>
                        <li class="flex items-center gap-2">✓ Quay Drone FPV không giới hạn cảnh</li>
                        <li class="flex items-center gap-2">✓ Diễn viên/MC chuyên nghiệp &amp; Voiceover đài TH</li>
                        <li class="flex items-center gap-2">✓ Chỉnh màu DaVinci Resolve chuẩn HDR</li>
                    </ul>
                </div>
                <a href="{{ route('contact', ['service' => 'Gói TVC Doanh Nghiệp 45tr']) }}" class="mt-8 py-3.5 w-full rounded-xl bg-gradient-to-r from-primary to-accent-amber text-white font-headline text-xs font-bold text-center shadow-lg hover:brightness-110 transition-all">
                    Nhận Tư Vấn Kịch Bản Miễn Phí
                </a>
            </div>

            <!-- Tier 3 -->
            <div class="p-8 rounded-3xl bg-white border border-slate-200 shadow-sm flex flex-col justify-between hover:shadow-xl transition-all">
                <div class="flex flex-col gap-4">
                    <span class="font-mono text-xs font-bold text-slate-500 uppercase tracking-wider">GÓI ĐIỆN ẢNH MASTER</span>
                    <h3 class="font-headline text-2xl font-bold text-navy-base">3D VFX &amp; Mega Campaign</h3>
                    <div class="flex items-baseline gap-1 my-2">
                        <span class="font-headline text-3xl sm:text-4xl font-black text-navy-base">95.000.000+</span>
                        <span class="text-xs font-mono text-slate-500">VNĐ / dự án</span>
                    </div>
                    <p class="text-xs text-slate-500">Chiến dịch truyền hình quốc gia, kỹ xảo 3D CGI tinh xảo và đạo diễn danh tiếng chỉ đạo.</p>
                    <ul class="space-y-3 pt-4 border-t border-slate-100 text-xs text-slate-600">
                        <li class="flex items-center gap-2">✓ Ekip điện ảnh quy mô 20+ nhân sự</li>
                        <li class="flex items-center gap-2">✓ Kỹ xảo 3D CGI &amp; Visual FX chuẩn phòng vé</li>
                        <li class="flex items-center gap-2">✓ Hòa âm phối khí độc quyền 5.1 Surround</li>
                        <li class="flex items-center gap-2">✓ Cam kết lượt xem và hỗ trợ phân phối đa kênh</li>
                    </ul>
                </div>
                <a href="{{ route('contact', ['service' => 'Gói 3D VFX Mega 95tr']) }}" class="mt-8 py-3 w-full rounded-xl bg-slate-100 hover:bg-slate-200 text-navy-base font-headline text-xs font-bold text-center transition-colors">
                    Liên Hệ Báo Giá Riêng
                </a>
            </div>
        </div>

        <!-- Web/App Pricing Cards -->
        <div x-show="tab === 'web'" x-transition class="grid grid-cols-1 lg:grid-cols-3 gap-8" style="display: none;">
            <div class="p-8 rounded-3xl bg-white border border-slate-200 shadow-sm flex flex-col justify-between">
                <div class="flex flex-col gap-4">
                    <span class="font-mono text-xs font-bold text-slate-500 uppercase">GÓI LANDING PAGE</span>
                    <h3 class="font-headline text-2xl font-bold text-navy-base">Chuyển Đổi Cao</h3>
                    <div class="flex items-baseline gap-1 my-2">
                        <span class="font-headline text-3xl sm:text-4xl font-black text-navy-base">9.500.000</span>
                        <span class="text-xs font-mono text-slate-500">VNĐ</span>
                    </div>
                    <p class="text-xs text-slate-500">Thiết kế tối ưu chạy quảng cáo Google Ads, Meta Ads, TikTok Ads.</p>
                    <ul class="space-y-3 pt-4 border-t border-slate-100 text-xs text-slate-600">
                        <li class="flex items-center gap-2">✓ Giao diện độc quyền chuẩn UI/UX</li>
                        <li class="flex items-center gap-2">✓ Tốc độ tải trang &lt; 0.5 giây</li>
                        <li class="flex items-center gap-2">✓ Cài đặt tracking pixel đa kênh</li>
                    </ul>
                </div>
                <a href="{{ route('contact', ['service' => 'Gói Landing Page']) }}" class="mt-8 py-3 w-full rounded-xl bg-slate-100 hover:bg-slate-200 text-navy-base font-headline text-xs font-bold text-center">Chọn Gói</a>
            </div>

            <div class="p-8 rounded-3xl bg-gradient-to-b from-[#091730] to-navy-base text-white border-2 border-sky-400 shadow-xl flex flex-col justify-between">
                <div class="flex flex-col gap-4">
                    <span class="font-mono text-xs font-bold text-sky-400 uppercase">GÓI DOANH NGHIỆP PRO</span>
                    <h3 class="font-headline text-2xl font-bold text-white">Portal &amp; Web Doanh Nghiệp</h3>
                    <div class="flex items-baseline gap-1 my-2">
                        <span class="font-headline text-3xl sm:text-4xl font-black text-sky-400">28.000.000</span>
                        <span class="text-xs font-mono text-slate-300">VNĐ</span>
                    </div>
                    <p class="text-xs text-slate-300">Website giới thiệu công ty chuẩn SEO, CMS WordPress &amp; Laravel hiện đại, bảo mật 2 lớp.</p>
                    <ul class="space-y-3 pt-4 border-t border-white/10 text-xs text-slate-200">
                        <li class="flex items-center gap-2">✓ Kiến trúc WordPress &amp; Laravel chuyên nghiệp</li>
                        <li class="flex items-center gap-2">✓ Trang quản trị trực quan đa ngôn ngữ</li>
                        <li class="flex items-center gap-2">✓ Tối ưu SEO On-Page tự động</li>
                        <li class="flex items-center gap-2">✓ Tặng hosting &amp; SSL 1 năm đầu</li>
                    </ul>
                </div>
                <a href="{{ route('contact', ['service' => 'Gói Web Doanh Nghiệp 28tr']) }}" class="mt-8 py-3 w-full rounded-xl bg-sky-600 hover:bg-sky-500 text-white font-headline text-xs font-bold text-center shadow-md">Chọn Gói</a>
            </div>

            <div class="p-8 rounded-3xl bg-white border border-slate-200 shadow-sm flex flex-col justify-between">
                <div class="flex flex-col gap-4">
                    <span class="font-mono text-xs font-bold text-slate-500 uppercase">GÓI NỀN TẢNG SỐ &amp; AI</span>
                    <h3 class="font-headline text-2xl font-bold text-navy-base">App Mobile &amp; AI System</h3>
                    <div class="flex items-baseline gap-1 my-2">
                        <span class="font-headline text-3xl sm:text-4xl font-black text-navy-base">65.000.000+</span>
                        <span class="text-xs font-mono text-slate-500">VNĐ</span>
                    </div>
                    <p class="text-xs text-slate-500">Ứng dụng di động iOS/Android hoặc phần mềm quản lý ERP riêng biệt.</p>
                    <ul class="space-y-3 pt-4 border-t border-slate-100 text-xs text-slate-600">
                        <li class="flex items-center gap-2">✓ Ứng dụng Flutter đa nền tảng</li>
                        <li class="flex items-center gap-2">✓ Tích hợp chatbot AI OpenAI/Claude</li>
                        <li class="flex items-center gap-2">✓ SLA bảo trì 99.9% trọn đời</li>
                    </ul>
                </div>
                <a href="{{ route('contact', ['service' => 'Gói App & AI 65tr']) }}" class="mt-8 py-3 w-full rounded-xl bg-slate-100 hover:bg-slate-200 text-navy-base font-headline text-xs font-bold text-center">Liên Hệ Tư Vấn</a>
            </div>
        </div>

        <!-- Cost Estimator Interactive Tool -->
        <div class="p-8 sm:p-12 rounded-3xl bg-white border-2 border-orange-200/80 shadow-lg flex flex-col gap-8">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-slate-200 pb-6">
                <div class="flex flex-col gap-1">
                    <span class="font-mono text-xs text-primary font-bold uppercase">CÔNG CỤ TỰ ĐỘNG</span>
                    <h3 class="font-headline text-2xl font-bold text-navy-base">Ước Tính Dự Toán Chi Phí Nhanh (30 Giây)</h3>
                </div>
                <div class="flex items-center gap-2 bg-slate-100 p-1 rounded-full">
                    <button @click="serviceType = 'tvc'" :class="serviceType === 'tvc' ? 'bg-primary text-white shadow-xs' : 'text-slate-600'" class="px-4 py-1.5 rounded-full text-xs font-bold transition-all">Sản xuất TVC</button>
                    <button @click="serviceType = 'web'" :class="serviceType === 'web' ? 'bg-sky-600 text-white shadow-xs' : 'text-slate-600'" class="px-4 py-1.5 rounded-full text-xs font-bold transition-all">Lập trình Web</button>
                </div>
            </div>

            <!-- Controls -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                <div class="flex flex-col gap-5">
                    <template x-if="serviceType === 'tvc'">
                        <div class="flex flex-col gap-4">
                            <div>
                                <label class="block font-headline text-xs font-bold text-slate-700 mb-2">Thời lượng video dự kiến:</label>
                                <select x-model="duration" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs">
                                    <option value="30">30 Giây (TVC Quảng cáo nhanh)</option>
                                    <option value="60">60 Giây (Chuẩn truyền hình)</option>
                                    <option value="180">3 Phút (Phim giới thiệu công ty)</option>
                                    <option value="300">5 Phút (Phóng sự doanh nghiệp)</option>
                                </select>
                            </div>
                            <div class="flex items-center gap-3">
                                <input type="checkbox" id="droneCheck" x-model="drone" class="rounded text-primary focus:ring-primary">
                                <label for="droneCheck" class="text-xs font-semibold text-slate-700">Yêu cầu Drone / Flycam 4K trên không</label>
                            </div>
                            <div>
                                <label class="block font-headline text-xs font-bold text-slate-700 mb-2">Diễn viên &amp; MC:</label>
                                <select x-model="actor" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs">
                                    <option value="none">Tự chuẩn bị nhân sự nội bộ</option>
                                    <option value="pro">Diễn viên / MC chuyên nghiệp (+12tr)</option>
                                    <option value="celeb">KOL / Người nổi tiếng (+35tr)</option>
                                </select>
                            </div>
                        </div>
                    </template>

                    <template x-if="serviceType === 'web'">
                        <div class="flex flex-col gap-4">
                            <div>
                                <label class="block font-headline text-xs font-bold text-slate-700 mb-2">Số lượng trang &amp; module chức năng:</label>
                                <select x-model="webPages" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs">
                                    <option value="5">Cơ bản (5 Trang)</option>
                                    <option value="10">Doanh nghiệp đầy đủ (10 Trang)</option>
                                    <option value="20">Sàn thương mại / Portal (20+ Trang)</option>
                                </select>
                            </div>
                            <div class="flex items-center gap-3">
                                <input type="checkbox" id="aiCheck" x-model="aiFeature" class="rounded text-sky-600 focus:ring-sky-500">
                                <label for="aiCheck" class="text-xs font-semibold text-slate-700">Tích hợp AI Chatbot &amp; Tự động hóa CRM (+15tr)</label>
                            </div>
                        </div>
                    </template>
                </div>

                <!-- Result Box -->
                <div class="p-8 rounded-3xl bg-navy-base text-white border border-slate-700 flex flex-col items-center text-center gap-3">
                    <span class="font-mono text-xs text-accent-amber font-bold uppercase">CHI PHÍ DỰ TOÁN ƯỚC TÍNH</span>
                    <span class="font-headline text-3xl sm:text-4xl font-black text-transparent bg-clip-text bg-gradient-to-r from-primary to-accent-amber" x-text="calculateTotal()"></span>
                    <p class="text-xs text-slate-400">Đã bao gồm chi phí ekip, bản quyền âm nhạc và hỗ trợ chỉnh sửa theo SLA.</p>
                    <a :href="'{{ route('contact') }}?estimate=' + encodeURIComponent(calculateTotal())" class="mt-4 px-6 py-3 rounded-full bg-gradient-to-r from-primary to-accent-amber text-white font-headline text-xs font-bold shadow-md hover:scale-105 transition-all">
                        Nhận Bản Báo Giá Chi Tiết PDF
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
