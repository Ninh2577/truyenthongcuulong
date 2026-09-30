<!DOCTYPE html>
<html lang="vi" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $template->title }} - Demo Trực Tiếp</title>
    <meta name="robots" content="noindex, nofollow">

    <!-- Google Fonts & Material Symbols -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0..1,0&display=block" rel="stylesheet">

    <!-- Tailwind / App CSS -->
    @vite(['resources/css/app.css'])

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-white text-slate-800 antialiased selection:bg-orange-500 selection:text-white" x-data="{
    mobileMenu: false,
    activeTab: 'all',
    formSubmitted: false,
    formName: '',
    formPhone: '',
    submitLead() {
        if(!this.formName || !this.formPhone) {
            alert('Vui lòng nhập Họ tên và Số điện thoại!');
            return;
        }
        this.formSubmitted = true;
    }
}">

    @php
        $t = mb_strtolower($template->title . ' ' . $template->slug);
        $isRealEstate = str_contains($t, 'neckle') || str_contains($t, 'bất động sản') || str_contains($t, 'nhà đất') || str_contains($t, 'căn hộ') || str_contains($t, 'real estate');
        $isCar = str_contains($t, 'rentaly') || str_contains($t, 'car') || str_contains($t, 'xe') || str_contains($t, 'ô tô');
        $isFood = str_contains($t, 'bacola') || str_contains($t, 'food') || str_contains($t, 'thực phẩm') || str_contains($t, 'nông sản') || str_contains($t, 'siêu thị');
        $isTech = str_contains($t, 'công nghệ') || str_contains($t, 'saas') || str_contains($t, 'ai') || str_contains($t, 'phần mềm') || str_contains($t, 'it');
        $isMedical = str_contains($t, 'y tế') || str_contains($t, 'phòng khám') || str_contains($t, 'nha khoa') || str_contains($t, 'bệnh viện');

        $brandColor = '#f97316';
        if ($isRealEstate) {
            $brandColor = '#0284c7';
            $themeTag = 'Bất Động Sản Cao Cấp';
            $heroSub = 'Khám phá hàng trăm dự án biệt thự, căn hộ và mặt bằng kinh doanh vị trí kim cương với pháp lý minh bạch.';
        } elseif ($isCar) {
            $brandColor = '#dc2626';
            $themeTag = 'Showroom & Dịch Vụ Xe';
            $heroSub = 'Dịch vụ phân phối xe hơi nhập khẩu, thuê xe tự lái và xe cưới hỏi hạng sang uy tín hàng đầu.';
        } elseif ($isFood) {
            $brandColor = '#16a34a';
            $themeTag = 'Thực Phẩm & Siêu Thị';
            $heroSub = 'Cung cấp thực phẩm hữu cơ, nông sản tươi sạch từ trang trại đạt tiêu chuẩn VietGAP đến bàn ăn mỗi gia đình.';
        } elseif ($isTech) {
            $brandColor = '#6366f1';
            $themeTag = 'Giải Pháp Công Nghệ';
            $heroSub = 'Nền tảng số hóa quản trị doanh nghiệp, tối ưu quy trình vận hành và nâng cao năng suất đột phá.';
        } elseif ($isMedical) {
            $brandColor = '#059669';
            $themeTag = 'Y Tế & Phòng Khám';
            $heroSub = 'Hệ thống y khoa chuyên nghiệp, đội ngũ bác sĩ chuyên khoa giàu kinh nghiệm và trang thiết bị hiện đại.';
        } else {
            $themeTag = 'Doanh Nghiệp Tiêu Biểu';
            $heroSub = 'Giải pháp website chuẩn mực, nâng tầm nhận diện thương hiệu và tăng trưởng doanh thu bền vững.';
        }
    @endphp

    <!-- 1. TOP ANNOUNCEMENT BAR -->
    <div class="bg-slate-900 text-white text-xs py-2 px-4 border-b border-slate-800">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            <div class="flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                <span class="text-[11px] sm:text-xs text-slate-300">
                    Bản Demo Giao Diện: <strong class="text-white">{{ $template->title }}</strong>
                </span>
            </div>
            <div class="hidden md:flex items-center gap-6 text-[11px] text-slate-400">
                <span class="flex items-center gap-1">
                    <span class="material-symbols-outlined text-[14px] text-primary">schedule</span>
                    <span>T2 - CN: 08:00 - 21:00</span>
                </span>
                <span class="flex items-center gap-1">
                    <span class="material-symbols-outlined text-[14px] text-primary">call</span>
                    <span>Hotline: <strong class="text-white">0939 523 557</strong></span>
                </span>
            </div>
        </div>
    </div>

    <!-- 2. WEBSITE HEADER -->
    <header class="sticky top-0 z-30 bg-white/95 backdrop-blur-md border-b border-slate-100 shadow-2xs">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <!-- Brand Logo -->
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-primary flex items-center justify-center text-white shadow-sm font-bold text-lg">
                    <span class="material-symbols-outlined text-[24px]">apartment</span>
                </div>
                <div class="flex flex-col">
                    <span class="text-base sm:text-lg font-extrabold text-[#0f172a] uppercase tracking-tight">
                        {{ preg_replace('/Mẫu website /i', '', $template->title) }}
                    </span>
                    <span class="text-[10px] text-slate-400 font-mono tracking-wider uppercase">{{ $themeTag }}</span>
                </div>
            </div>

            <!-- Nav Links (Desktop) -->
            <nav class="hidden lg:flex items-center gap-8 text-sm font-bold text-slate-700">
                <a href="#hero" class="text-primary hover:text-orange-600 transition-colors">Trang chủ</a>
                <a href="#featured" class="hover:text-primary transition-colors">Dự án & Sản phẩm</a>
                <a href="#about" class="hover:text-primary transition-colors">Về chúng tôi</a>
                <a href="#process" class="hover:text-primary transition-colors">Quy trình</a>
                <a href="#contact" class="hover:text-primary transition-colors">Liên hệ</a>
            </nav>

            <!-- Actions -->
            <div class="hidden sm:flex items-center gap-4">
                <a href="tel:0939523557" class="flex items-center gap-2 text-xs font-bold text-slate-700 hover:text-primary transition-colors">
                    <div class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-primary">
                        <span class="material-symbols-outlined text-[18px]">call</span>
                    </div>
                    <span>0939 523 557</span>
                </a>
                <a href="#contact" class="px-5 py-2.5 rounded-full bg-primary hover:bg-orange-600 text-white font-bold text-xs shadow-sm transition-all">
                    Nhận Báo Giá
                </a>
            </div>

            <!-- Hamburger Button -->
            <button type="button" @click="mobileMenu = !mobileMenu" class="lg:hidden p-2 text-slate-700">
                <span class="material-symbols-outlined text-[26px]">menu</span>
            </button>
        </div>

        <!-- Mobile Menu Drawer -->
        <div x-show="mobileMenu" @click.outside="mobileMenu = false" class="lg:hidden bg-white border-b border-slate-200 px-6 py-4 space-y-3 font-semibold text-sm">
            <a href="#hero" @click="mobileMenu = false" class="block py-1 text-primary">Trang chủ</a>
            <a href="#featured" @click="mobileMenu = false" class="block py-1 text-slate-700">Dự án & Sản phẩm</a>
            <a href="#about" @click="mobileMenu = false" class="block py-1 text-slate-700">Về chúng tôi</a>
            <a href="#contact" @click="mobileMenu = false" class="block py-1 text-slate-700">Liên hệ tư vấn</a>
        </div>
    </header>

    <!-- 3. HERO BANNER SECTION -->
    <section id="hero" class="relative bg-slate-900 text-white py-16 sm:py-24 overflow-hidden">
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0 z-0">
            <img 
                src="{{ $template->thumbnail_url ?: 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=1800&q=80' }}" 
                alt="{{ $template->title }}" 
                class="w-full h-full object-cover opacity-25 scale-105 transition-transform duration-1000"
            >
            <div class="absolute inset-0 bg-gradient-to-r from-slate-950 via-slate-950/80 to-transparent"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-2xl space-y-6">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-xs font-bold text-amber-300">
                    <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                    <span>TIÊU CHUẨN GIAO DIỆN CHUẨN QUỐC TẾ</span>
                </div>

                <h1 class="text-3xl sm:text-4xl md:text-5xl font-black text-white leading-tight uppercase tracking-tight">
                    {{ $template->title }}
                </h1>

                <p class="text-sm sm:text-base text-slate-300 leading-relaxed font-normal">
                    {{ $template->summary ?: $heroSub }}
                </p>

                <!-- Action CTAs -->
                <div class="flex flex-wrap items-center gap-4 pt-2">
                    <a href="#contact" class="px-7 py-3 rounded-full bg-primary hover:bg-orange-600 text-white font-bold text-sm shadow-lg shadow-primary/30 transition-all flex items-center gap-2">
                        <span>Đăng Ký Tư Vấn Ngay</span>
                        <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                    </a>
                    <a href="#featured" class="px-7 py-3 rounded-full bg-white/10 hover:bg-white/20 text-white font-bold text-sm border border-white/20 transition-all">
                        Khám Phá Danh Mục
                    </a>
                </div>

                <!-- Proof Badges -->
                <div class="pt-6 border-t border-white/10 grid grid-cols-3 gap-4 text-center sm:text-left">
                    <div>
                        <div class="text-xl sm:text-2xl font-black text-white font-mono">100%</div>
                        <div class="text-[11px] text-slate-400">Chuẩn Responsive</div>
                    </div>
                    <div>
                        <div class="text-xl sm:text-2xl font-black text-emerald-400 font-mono">&lt; 1.5s</div>
                        <div class="text-[11px] text-slate-400">Tốc Độ Tải Siêu Nhanh</div>
                    </div>
                    <div>
                        <div class="text-xl sm:text-2xl font-black text-amber-400 font-mono">Top #1</div>
                        <div class="text-[11px] text-slate-400">Tối Ưu SEO Google</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. FEATURED CATALOG GRID -->
    <section id="featured" class="py-16 sm:py-20 bg-slate-50 border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-xl mx-auto mb-12">
                <span class="text-xs font-bold text-primary uppercase font-mono tracking-widest">DANH MỤC TIÊU BIỂU</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-[#0f172a] mt-1">
                    Trưng Bày Dịch Vụ & Sản Phẩm
                </h2>
                <p class="text-xs sm:text-sm text-slate-500 mt-2">
                    Các gói sản phẩm được bố trí khoa học, giúp khách hàng tìm kiếm và đặt lịch trong vài giây.
                </p>
            </div>

            <!-- Card Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @php
                    $samples = [
                        [
                            'name' => $isRealEstate ? 'Biệt Thự Vườn Ven Sông River Park' : ($isCar ? 'Mercedes-Benz S450 Luxury 2024' : ($isFood ? 'Giỏ Nông Sản Hữu Cơ Đà Lạt' : 'Gói Quản Trị Hệ Thống Toàn Diện')),
                            'price' => $isRealEstate ? '12.5 Tỷ VNĐ' : ($isCar ? '5.2 Tỷ VNĐ' : ($isFood ? '450.000 VNĐ' : '15.000.000 VNĐ/Tháng')),
                            'tag' => 'Nổi bật nhất',
                            'img' => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=700&q=80',
                            'desc' => 'Thiết kế sang trọng, đầy đủ tiện ích nội khu, cam kết tiêu chuẩn chất lượng cao nhất.'
                        ],
                        [
                            'name' => $isRealEstate ? 'Căn Hộ Panorama Sky View 3PN' : ($isCar ? 'Porsche Panamera 4S Executive' : ($isFood ? 'Thịt Bò Wagyu A5 Nhập Khẩu' : 'Giải Pháp Chuyển Đổi Số Doanh Nghiệp')),
                            'price' => $isRealEstate ? '4.8 Tỷ VNĐ' : ($isCar ? '6.8 Tỷ VNĐ' : ($isFood ? '1.850.000 VNĐ' : '28.000.000 VNĐ/Dự án')),
                            'tag' => 'Bán chạy',
                            'img' => 'https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?auto=format&fit=crop&w=700&q=80',
                            'desc' => 'Tối ưu không gian sống và hiệu năng làm việc, trang bị công nghệ tự động hóa thông minh.'
                        ],
                        [
                            'name' => $isRealEstate ? 'Nhà Phố Thương Mại Shophouse Central' : ($isCar ? 'BMW 730Li M Sport Siêu Lướt' : ($isFood ? 'Combo Hải Sản Hoàng Gia Tươi Sống' : 'Phát Triển Ứng Dụng Đa Nền Tảng')),
                            'price' => $isRealEstate ? '8.9 Tỷ VNĐ' : ($isCar ? '4.1 Tỷ VNĐ' : ($isFood ? '920.000 VNĐ' : 'Liên hệ báo giá')),
                            'tag' => 'Mới ra mắt',
                            'img' => 'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?auto=format&fit=crop&w=700&q=80',
                            'desc' => 'Vị trí đắc địa, lưu lượng khách hàng sầm uất, khả năng sinh lời và thanh khoản vượt trội.'
                        ],
                    ];
                @endphp

                @foreach($samples as $sample)
                <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-xs hover:shadow-lg transition-all duration-300 flex flex-col group">
                    <div class="relative aspect-video overflow-hidden bg-slate-100">
                        <img src="{{ $sample['img'] }}" alt="{{ $sample['name'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute top-3 right-3 px-3 py-1 rounded-full bg-primary text-white text-[11px] font-bold shadow-md">
                            {{ $sample['tag'] }}
                        </div>
                    </div>
                    <div class="p-5 flex flex-col flex-1">
                        <div class="flex items-center justify-between gap-2 mb-2">
                            <span class="text-xs font-mono font-bold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded">MÃ: CL-{{ rand(100, 999) }}</span>
                            <span class="text-xs font-black text-primary font-mono">{{ $sample['price'] }}</span>
                        </div>
                        <h3 class="text-base font-bold text-slate-900 group-hover:text-primary transition-colors mb-2">
                            {{ $sample['name'] }}
                        </h3>
                        <p class="text-xs text-slate-500 leading-relaxed mb-4 flex-1">
                            {{ $sample['desc'] }}
                        </p>
                        <a href="#contact" class="w-full py-2.5 rounded-xl border border-slate-200 group-hover:border-primary group-hover:bg-primary group-hover:text-white text-slate-700 text-xs font-bold transition-all text-center">
                            Xem Chi Tiết & Báo Giá
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- 5. ABOUT US / VALUE PROPOSITION -->
    <section id="about" class="py-16 sm:py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="space-y-6">
                    <span class="text-xs font-bold text-primary uppercase font-mono tracking-widest">UY TÍN & KINH NGHIỆM</span>
                    <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-[#0f172a] leading-tight">
                        Đồng Hành Cùng Sự Thịnh Vượng Của Quý Khách
                    </h2>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                        Với hơn 10 năm hoạt động chuyên sâu, chúng tôi cam kết mang lại giải pháp toàn diện, dịch vụ tận tâm và hiệu quả thực tế cho từng dự án của đối tác.
                    </p>

                    <div class="grid grid-cols-2 gap-4 pt-2">
                        <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200">
                            <span class="material-symbols-outlined text-primary text-2xl mb-1">verified_user</span>
                            <h4 class="text-sm font-bold text-slate-900">Pháp Lý Minh Bạch</h4>
                            <p class="text-[11px] text-slate-500 mt-0.5">Hợp đồng rõ ràng, đảm bảo quyền lợi tuyệt đối cho khách hàng.</p>
                        </div>
                        <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200">
                            <span class="material-symbols-outlined text-emerald-600 text-2xl mb-1">speed</span>
                            <h4 class="text-sm font-bold text-slate-900">Bàn Giao Thần Tốc</h4>
                            <p class="text-[11px] text-slate-500 mt-0.5">Tiến độ chuẩn xác, hỗ trợ 24/7 trước và sau bàn giao.</p>
                        </div>
                    </div>
                </div>

                <div class="relative">
                    <div class="aspect-4/3 rounded-3xl overflow-hidden shadow-2xl border-4 border-white">
                        <img src="https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&w=900&q=80" alt="About us" class="w-full h-full object-cover">
                    </div>
                    <div class="absolute -bottom-6 -left-6 bg-slate-900 text-white p-5 rounded-2xl shadow-xl border border-slate-800 hidden sm:block">
                        <div class="text-2xl font-black text-primary font-mono">1,250+</div>
                        <div class="text-xs text-slate-300">Khách Hàng Đồng Hành</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 6. CONTACT FORM SECTION -->
    <section id="contact" class="py-16 sm:py-20 bg-slate-900 text-white relative">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10">
                <span class="text-xs font-bold text-primary uppercase font-mono tracking-widest">LIÊN HỆ TRỰC TIẾP</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-white mt-1">
                    Đăng Ký Nhận Tư Vấn Miễn Phí
                </h2>
                <p class="text-xs sm:text-sm text-slate-400 mt-2">
                    Để lại thông tin, chuyên viên tư vấn sẽ liên hệ lại với bạn trong vòng 15 phút.
                </p>
            </div>

            <!-- Form Card -->
            <div class="bg-white rounded-3xl p-6 sm:p-10 text-slate-900 shadow-2xl border border-slate-100">
                <div x-show="formSubmitted" class="p-6 rounded-2xl bg-emerald-50 border border-emerald-200 text-center space-y-2">
                    <span class="material-symbols-outlined text-4xl text-emerald-600">task_alt</span>
                    <h3 class="text-lg font-bold text-emerald-900">Yêu Cầu Đã Được Tiếp Nhận!</h3>
                    <p class="text-xs text-slate-600">Cảm ơn bạn đã quan tâm. Chúng tôi sẽ liên hệ trong ít phút.</p>
                </div>

                <form x-show="!formSubmitted" @submit.prevent="submitLead" class="space-y-4">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Họ và tên *</label>
                            <input type="text" x-model="formName" required placeholder="Nguyễn Văn A" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:border-primary focus:ring-2 focus:ring-primary/20 text-xs sm:text-sm outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Số điện thoại *</label>
                            <input type="tel" x-model="formPhone" required placeholder="0939 523 557" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:border-primary focus:ring-2 focus:ring-primary/20 text-xs sm:text-sm outline-none">
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Nhu cầu cụ thể</label>
                        <textarea rows="3" placeholder="Mô tả sơ lược về nhu cầu của bạn..." class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:border-primary focus:ring-2 focus:ring-primary/20 text-xs sm:text-sm outline-none resize-none"></textarea>
                    </div>
                    <button type="submit" class="w-full py-3.5 rounded-xl bg-primary hover:bg-orange-600 text-white font-bold text-sm shadow-md transition-all">
                        Gửi Đăng Ký Tư Vấn
                    </button>
                </form>
            </div>
        </div>
    </section>

    <!-- 7. FOOTER -->
    <footer class="bg-slate-950 text-slate-400 py-10 border-t border-slate-900 text-xs">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="flex items-center gap-2">
                <span class="font-bold text-white uppercase">{{ $template->title }}</span>
                <span>• Bản quyền demo thuộc về Truyền Thông Cửu Long</span>
            </div>
            <div class="flex items-center gap-6">
                <span>Hotline: <strong class="text-white">0939 523 557</strong></span>
                <span>Email: <strong class="text-white">contact@truyenthongcuulong.com</strong></span>
            </div>
        </div>
    </footer>

    <!-- Floating Action Buttons -->
    <div class="fixed bottom-6 right-6 z-40 flex flex-col gap-3">
        <a href="tel:0939523557" class="w-12 h-12 rounded-full bg-primary hover:bg-orange-600 text-white shadow-xl flex items-center justify-center transition-transform hover:scale-110" title="Gọi ngay">
            <span class="material-symbols-outlined text-[24px]">call</span>
        </a>
    </div>

</body>
</html>
