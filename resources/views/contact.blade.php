@extends('layouts.app')

@section('title', 'Liên Hệ & Đặt Lịch - Truyền Thông Cửu Long')
@section('meta_description', 'Liên hệ với Truyền Thông Cửu Long để nhận tư vấn, báo giá chi tiết hoặc đặt lịch ekip quay phim, lập trình web/app và digital marketing.')

@section('content')
<!-- Khối 1: Hero Header -->
<section class="relative w-full overflow-hidden pt-32 pb-14 lg:pt-36 lg:pb-20 border-b border-slate-200/80 bg-surface-low bg-dot-grid-subtle">
    <div class="absolute -top-24 right-0 w-[500px] h-[500px] rounded-full bg-gradient-to-br from-amber-500/5 via-primary/5 to-transparent blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-0 left-10 w-[400px] h-[300px] rounded-full bg-gradient-to-tr from-sky-500/5 via-primary/5 to-transparent blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <!-- Breadcrumb Navigation -->
        <nav class="flex items-center gap-2 text-xs font-headline text-slate-400 mb-6" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-primary transition-colors flex items-center gap-1">
                <span class="material-symbols-outlined text-[16px]">home</span>
                <span>Trang chủ</span>
            </a>
            <span class="text-slate-600">/</span>
            <span class="text-navy-base font-bold" aria-current="page">Liên Hệ &amp; Đặt Lịch</span>
        </nav>

        <div class="max-w-3xl flex flex-col gap-4">
            <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-orange-50 text-orange-600 font-mono text-xs font-bold border border-orange-200 w-fit shadow-sm">
                <span class="w-2 h-2 rounded-full bg-primary animate-pulse"></span>
                <span>KẾT NỐI VỚI CHÚNG TÔI &bull; TƯ VẤN GIẢI PHÁP KỸ THUẬT</span>
            </div>
            <h1 class="font-headline text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-navy-base leading-tight">
                Liên Hệ &amp; <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary via-orange-500 to-amber-500">Đặt Lịch Hợp Tác</span>
            </h1>
            <p class="font-body text-slate-600 text-sm sm:text-base leading-relaxed">
                Chúng tôi luôn sẵn sàng lắng nghe mọi ý tưởng, giải đáp thắc mắc và cung cấp giải pháp sản xuất truyền thông - công nghệ tối ưu cho doanh nghiệp của bạn.
            </p>
        </div>
    </div>
</section>

<!-- Khối 2: Khối Form Tiếp Nhận & Bản Đồ Nền Sáng Trang Nhã -->
<section class="w-full bg-surface bg-dot-grid-subtle py-16 lg:py-20 border-b border-slate-200/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 max-w-6xl mx-auto items-start">
            <!-- Contact Info Sidebar -->
            <div class="lg:col-span-5 space-y-5">
                <div class="p-6 rounded-3xl bg-white border border-slate-200/80 shadow-sm hover:border-primary/40 transition-colors">
                    <div class="flex items-center gap-4 mb-3">
                        <div class="w-12 h-12 rounded-2xl bg-orange-100 text-primary flex items-center justify-center font-bold">
                            <span class="material-symbols-outlined text-[24px]">location_on</span>
                        </div>
                        <div>
                            <div class="font-headline font-bold text-navy-base text-base">Địa Chỉ Trụ Sở</div>
                            <div class="text-xs text-slate-500">{{ get_setting('company_address', 'Lầu 5, 57 Hùng Vương, P. Thới Bình, Q. Ninh Kiều, TP. Cần Thơ') }}</div>
                        </div>
                    </div>
                    <p class="text-xs text-slate-500 leading-relaxed">Sẵn sàng phục vụ khách hàng tại các tỉnh miền Tây và điều động ekip trên toàn quốc.</p>
                </div>

                @php
                    $rawMap = get_setting('company_map', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d125715.77259461124!2d105.6983416!3d10.0341851!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31a0629f6de3dedb%3A0x329435b60e7f7229!2zQ-G6p24gVGjGoSwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1700000000000!5m2!1svi!2s');
                    $mapUrl = $rawMap;
                    if (preg_match('/src="([^"]+)"/', $rawMap, $match)) {
                        $mapUrl = $match[1];
                    }
                @endphp
                @if($mapUrl)
                <div class="p-2 rounded-3xl bg-white border border-slate-200/90 shadow-sm overflow-hidden">
                    <div class="relative w-full h-52 rounded-2xl overflow-hidden">
                        <iframe src="{{ $mapUrl }}" 
                            width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="Bản đồ trụ sở Cần Thơ Truyền Thông Cửu Long"></iframe>
                    </div>
                </div>
                @endif

                <div class="p-6 rounded-3xl bg-white border border-slate-200/80 shadow-sm hover:border-primary/40 transition-colors">
                    <div class="flex items-center gap-4 mb-3">
                        <div class="w-12 h-12 rounded-2xl bg-emerald-100 text-emerald-600 flex items-center justify-center font-bold">
                            <span class="material-symbols-outlined text-[24px]">call</span>
                        </div>
                        <div>
                            <div class="font-headline font-bold text-navy-base text-base">Hotline &amp; Zalo Trực Tuyến</div>
                            <div class="text-xs text-slate-500">Hỗ trợ trong giờ làm việc &amp; Đặt lịch tư vấn</div>
                        </div>
                    </div>
                    @php $phone = get_setting('company_phone', '0939.363.262'); @endphp
                    @if($phone)
                        <a href="tel:{{ preg_replace('/[^0-9]/', '', $phone) }}" class="text-base font-headline font-bold text-emerald-600 hover:text-emerald-700 transition-colors">{{ $phone }}</a>
                    @endif
                </div>

                <div class="p-6 rounded-3xl bg-white border border-slate-200/80 shadow-sm hover:border-primary/40 transition-colors">
                    <div class="flex items-center gap-4 mb-3">
                        <div class="w-12 h-12 rounded-2xl bg-amber-100 text-amber-600 flex items-center justify-center font-bold">
                            <span class="material-symbols-outlined text-[24px]">mail</span>
                        </div>
                        <div>
                            <div class="font-headline font-bold text-navy-base text-base">Email Doanh Nghiệp</div>
                            <div class="text-xs text-slate-500">Tiếp nhận báo giá, brief &amp; đấu thầu</div>
                        </div>
                    </div>
                    @php $email = get_setting('company_email', 'info@truyenthongcuulong.com'); @endphp
                    @if($email)
                        <a href="mailto:{{ $email }}" class="text-base font-headline font-bold text-sky-600 hover:text-sky-700 transition-colors">{{ $email }}</a>
                    @endif
                </div>

                @php $facebookUrl = get_setting('social_facebook', 'https://www.facebook.com/truyenthongcuulong/'); @endphp
                @if($facebookUrl)
                <a href="{{ $facebookUrl }}" target="_blank" rel="noopener noreferrer" class="p-6 rounded-3xl bg-white border border-slate-200/80 shadow-sm hover:border-blue-500 hover:shadow-md transition-all flex items-center gap-4 block group">
                    <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center font-bold group-hover:bg-blue-600 group-hover:text-white transition-colors">
                        <span class="material-symbols-outlined text-[24px]">thumb_up</span>
                    </div>
                    <div>
                        <div class="font-headline font-bold text-navy-base text-base group-hover:text-blue-600 transition-colors">Fanpage Truyền Thông Cửu Long</div>
                        <div class="text-xs text-slate-500 font-mono">{{ str_replace(['https://www.', 'http://www.', 'https://', 'http://'], '', $facebookUrl) }}</div>
                    </div>
                </a>
                @endif

                <div class="p-6 rounded-3xl bg-slate-50 text-navy-base border border-slate-200/90 shadow-sm">
                    <div class="flex items-center gap-3 mb-2">
                        <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse"></span>
                        <span class="font-mono text-xs font-bold text-emerald-600 uppercase tracking-widest">Tiếp Nhận &amp; Phản Hồi Nhanh</span>
                    </div>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Mọi yêu cầu tư vấn dự án công nghệ hoặc booking media gửi qua website đều được đội ngũ chuyên viên kỹ thuật tiếp nhận và phản hồi nhanh chóng trong ngày làm việc.
                    </p>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="lg:col-span-7">
                <div class="p-6 sm:p-8 lg:p-10 rounded-3xl bg-white border border-slate-200/90 shadow-xl">
                    <h2 class="font-headline font-bold text-xl sm:text-2xl text-navy-base mb-2">Gửi Yêu Cầu Cho Đội Ngũ Truyền Thông Cửu Long</h2>
                    <p class="font-body text-xs sm:text-sm text-slate-500 mb-6">Điền thông tin bên dưới để nhận báo giá hoặc tư vấn chuyên sâu.</p>

                    @if(session('success'))
                        <div class="mb-5 p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 flex items-center gap-3">
                            <span class="material-symbols-outlined text-[20px] text-emerald-600">check_circle</span>
                            <span class="text-xs font-medium">{{ session('success') }}</span>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="mb-5 p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800 text-xs">
                            <div class="font-bold mb-1">Vui lòng kiểm tra lại thông tin:</div>
                            <ul class="list-disc list-inside space-y-0.5">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('contact.submit') }}" method="POST" class="space-y-4">
                        @csrf
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="fullname" class="block text-xs font-semibold text-slate-700 mb-1.5">Họ và tên *</label>
                                <input type="text" id="fullname" name="fullname" autocomplete="name" required aria-required="true" aria-invalid="{{ $errors->has('fullname') ? 'true' : 'false' }}" oninvalid="this.setCustomValidity('Vui lòng điền họ và tên của bạn')" oninput="this.setCustomValidity('')" class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 text-navy-base placeholder-slate-400 focus:bg-white focus:border-primary focus:outline-none text-base sm:text-sm transition-all" placeholder="Nguyễn Văn A">
                            </div>
                            <div>
                                <label for="phone" class="block text-xs font-semibold text-slate-700 mb-1.5">Số điện thoại *</label>
                                <input type="tel" id="phone" name="phone" autocomplete="tel" inputmode="tel" required aria-required="true" aria-invalid="{{ $errors->has('phone') ? 'true' : 'false' }}" oninvalid="this.setCustomValidity('Vui lòng điền số điện thoại để chúng tôi liên hệ')" oninput="this.setCustomValidity('')" class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 text-navy-base placeholder-slate-400 focus:bg-white focus:border-primary focus:outline-none text-base sm:text-sm transition-all" placeholder="0939xxxxxx">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="email" class="block text-xs font-semibold text-slate-700 mb-1.5">Email</label>
                                <input type="email" id="email" name="email" autocomplete="email" inputmode="email" aria-invalid="{{ $errors->has('email') ? 'true' : 'false' }}" class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 text-navy-base placeholder-slate-400 focus:bg-white focus:border-primary focus:outline-none text-base sm:text-sm transition-all" placeholder="email@domain.com">
                            </div>
                            <div>
                                <label for="service_interested" class="block text-xs font-semibold text-slate-700 mb-1.5">Dịch vụ quan tâm</label>
                                <select id="service_interested" name="service_interested" class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 text-navy-base focus:bg-white focus:border-primary focus:outline-none text-base sm:text-sm transition-all">
                                    <option value="Thiết kế & Lập trình Web/App" {{ request('service') == 'web-app' ? 'selected' : '' }}>💻 Thiết kế &amp; Lập trình Web/App</option>
                                    <option value="Quay Phim Sự Kiện & Team Building" {{ request('service') == 'media' ? 'selected' : '' }}>🎬 Quay Phim Sự Kiện &amp; Team Building</option>
                                    <option value="Quảng Cáo Google Ads & Facebook" {{ request('service') == 'marketing' ? 'selected' : '' }}>📈 Quảng Cáo Google Ads &amp; Facebook</option>
                                    <option value="3D Motion Design & AI Studio" {{ request('service') == 'ai-solutions' ? 'selected' : '' }}>🤖 3D Motion Design &amp; AI Studio</option>
                                    <option value="Booking Team Media" {{ request('service') == 'booking-media' ? 'selected' : '' }}>📸 Booking Team Media (Đặt lịch quay phim/chụp ảnh)</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label for="message" class="block text-xs font-semibold text-slate-700 mb-1.5">Nội dung tin nhắn / Yêu cầu cụ thể *</label>
                            <textarea id="message" name="message" rows="4" required aria-required="true" aria-invalid="{{ $errors->has('message') ? 'true' : 'false' }}" oninvalid="this.setCustomValidity('Vui lòng điền nội dung yêu cầu của bạn')" oninput="this.setCustomValidity('')" class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 text-navy-base placeholder-slate-400 focus:bg-white focus:border-primary focus:outline-none text-base sm:text-sm transition-all" placeholder="Mô tả cụ thể yêu cầu của bạn, thời gian dự kiến hoặc ngân sách dự trù..."></textarea>
                        </div>

                        <button type="submit" class="w-full min-h-[48px] py-3.5 px-6 rounded-full bg-gradient-to-r from-primary via-orange-500 to-accent-amber text-white font-headline font-bold text-sm shadow-md shadow-primary/30 hover:shadow-lg hover:shadow-primary/40 hover:scale-[1.01] active:scale-[0.99] transition-all cursor-pointer flex items-center justify-center gap-2">
                            <span>Gửi Yêu Cầu Tư Vấn</span>
                            <span class="material-symbols-outlined text-[18px]">send</span>
                        </button>

                        <p class="text-center text-[11px] text-slate-500 mt-3 font-body">
                            <span class="material-symbols-outlined text-[13px] align-middle text-emerald-600 mr-0.5">lock</span>
                            Thông tin của quý khách được bảo mật và chỉ sử dụng để tư vấn giải pháp kỹ thuật theo yêu cầu.
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

