@extends('layouts.app')

@section('title', 'Liên Hệ & Đặt Lịch - Truyền Thông Cửu Long')
@section('meta_description', 'Liên hệ với Truyền Thông Cửu Long để nhận tư vấn, báo giá chi tiết hoặc đặt lịch ekip quay phim, lập trình web/app và digital marketing.')

@section('content')
<!-- Khối 1: Hero Header Tối Deep Navy -->
<section class="relative w-full overflow-hidden text-white pt-32 pb-14 lg:pt-36 lg:pb-20 border-b border-white/10 bg-dot-grid-dark" style="background-color: #080C16 !important;">
    <div class="absolute -top-24 right-0 w-[500px] h-[500px] rounded-full bg-gradient-to-br from-amber-500/15 via-primary/15 to-transparent blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-0 left-10 w-[400px] h-[300px] rounded-full bg-gradient-to-tr from-sky-500/10 via-primary/10 to-transparent blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <!-- Breadcrumb Navigation -->
        <nav class="flex items-center gap-2 text-xs font-headline text-slate-400 mb-6" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-primary transition-colors flex items-center gap-1">
                <span class="material-symbols-outlined text-[16px]">home</span>
                <span>Trang chủ</span>
            </a>
            <span class="text-slate-600">/</span>
            <span class="text-white font-bold" aria-current="page">Liên Hệ &amp; Đặt Lịch</span>
        </nav>

        <div class="max-w-3xl flex flex-col gap-4">
            <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-orange-500/10 text-orange-400 font-mono text-xs font-bold border border-orange-500/30 w-fit backdrop-blur-sm">
                <span class="w-2 h-2 rounded-full bg-primary animate-pulse"></span>
                <span>KẾT NỐI VỚI CHÚNG TÔI &bull; PHẢN HỒI NHANH 15 PHÚT</span>
            </div>
            <h1 class="font-headline text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-white leading-tight">
                Liên Hệ &amp; <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary via-orange-400 to-amber-300">Đặt Lịch Hợp Tác</span>
            </h1>
            <p class="font-body text-slate-300 text-sm sm:text-base leading-relaxed">
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
                            <div class="text-xs text-slate-500">TP. Cần Thơ &amp; Khu vực ĐBSCL</div>
                        </div>
                    </div>
                    <p class="text-xs text-slate-500 leading-relaxed">Sẵn sàng phục vụ khách hàng tại các tỉnh miền Tây và điều động ekip trên toàn quốc.</p>
                </div>

                <!-- Google Maps Frame Bo Tròn Trung Tính -->
                <div class="p-2 rounded-3xl bg-white border border-slate-200/90 shadow-sm overflow-hidden">
                    <div class="relative w-full h-52 rounded-2xl overflow-hidden">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d125715.77259461124!2d105.6983416!3d10.0341851!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31a0629f6de3dedb%3A0x329435b60e7f7229!2zQ-G6p24gVGjGoSwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1700000000000!5m2!1svi!2s" 
                            width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="Bản đồ trụ sở Cần Thơ Truyền Thông Cửu Long"></iframe>
                    </div>
                </div>

                <div class="p-6 rounded-3xl bg-white border border-slate-200/80 shadow-sm hover:border-primary/40 transition-colors">
                    <div class="flex items-center gap-4 mb-3">
                        <div class="w-12 h-12 rounded-2xl bg-emerald-100 text-emerald-600 flex items-center justify-center font-bold">
                            <span class="material-symbols-outlined text-[24px]">call</span>
                        </div>
                        <div>
                            <div class="font-headline font-bold text-navy-base text-base">Hotline &amp; Zalo Trực Tuyến</div>
                            <div class="text-xs text-slate-500">Hỗ trợ 24/7 &amp; Đặt lịch khẩn cấp</div>
                        </div>
                    </div>
                    <div class="text-base font-headline font-bold text-emerald-600">(+84) 908 888 CLM (0908 888 256)</div>
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
                    <div class="text-sm font-semibold text-amber-600">lienhe@truyenthongcuulong.com</div>
                </div>

                <a href="https://www.facebook.com/truyenthongcuulong/" target="_blank" rel="noopener noreferrer" class="p-6 rounded-3xl bg-white border border-slate-200/80 shadow-sm hover:border-blue-500 hover:shadow-md transition-all flex items-center gap-4 block group">
                    <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center font-bold group-hover:bg-blue-600 group-hover:text-white transition-colors">
                        <span class="material-symbols-outlined text-[24px]">thumb_up</span>
                    </div>
                    <div>
                        <div class="font-headline font-bold text-navy-base text-base group-hover:text-blue-600 transition-colors">Fanpage Truyền Thông Cửu Long</div>
                        <div class="text-xs text-slate-500 font-mono">facebook.com/truyenthongcuulong</div>
                    </div>
                </a>

                <div class="p-6 rounded-3xl bg-navy-base text-white border border-slate-700/80 shadow-xl" style="background-color: #080C16 !important;">
                    <div class="flex items-center gap-3 mb-2">
                        <span class="w-2.5 h-2.5 rounded-full bg-emerald-400 animate-pulse"></span>
                        <span class="font-mono text-xs font-bold text-amber-400 uppercase tracking-widest">SLA Phản Hồi 15 Phút</span>
                    </div>
                    <p class="text-xs text-slate-300 leading-relaxed">
                        Mọi yêu cầu booking lịch quay hoặc tư vấn dự án gửi qua website đều được nhân viên điều phối xử lý và phản hồi trong tối đa 15 phút làm việc.
                    </p>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="lg:col-span-7">
                <div class="p-8 sm:p-10 rounded-3xl bg-white border border-slate-200/90 shadow-xl">
                    <h2 class="font-headline font-bold text-2xl text-navy-base mb-2">Gửi Yêu Cầu Cho Đội Ngũ Truyền Thông Cửu Long</h2>
                    <p class="font-body text-xs sm:text-sm text-slate-500 mb-6">Điền thông tin bên dưới để nhận báo giá hoặc tư vấn chuyên sâu.</p>

                    <form action="{{ route('contact.submit') }}" method="POST" class="space-y-4">
                        @csrf
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1.5">Họ và tên *</label>
                                <input type="text" name="fullname" required class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 text-navy-base placeholder-slate-400 focus:bg-white focus:border-primary focus:outline-none text-sm transition-all" placeholder="Nguyễn Văn A">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1.5">Số điện thoại *</label>
                                <input type="tel" name="phone" required class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 text-navy-base placeholder-slate-400 focus:bg-white focus:border-primary focus:outline-none text-sm transition-all" placeholder="0908xxxxxx">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1.5">Email</label>
                                <input type="email" name="email" class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 text-navy-base placeholder-slate-400 focus:bg-white focus:border-primary focus:outline-none text-sm transition-all" placeholder="email@domain.com">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1.5">Dịch vụ quan tâm</label>
                                <select name="service_interested" class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 text-navy-base focus:bg-white focus:border-primary focus:outline-none text-sm transition-all">
                                    <option value="Booking Team Media" {{ request('service') == 'booking-media' ? 'selected' : '' }}>🎬 Booking Team Media (Đặt lịch quay phim/livestream trực tiếp)</option>
                                    <option value="Sản xuất Media & Video" {{ (request('service') == 'media' || !request('service')) ? 'selected' : '' }}>Quay Dựng Phim &amp; Sản Xuất Media (TVC 4K)</option>
                                    <option value="Thiết kế Website & Web App" {{ request('service') == 'web' ? 'selected' : '' }}>Thiết Kế &amp; Lập Trình Web/App</option>
                                    <option value="Quảng cáo Digital Ads" {{ request('service') == 'ads' ? 'selected' : '' }}>Quảng Cáo &amp; Truyền Thông Số (Performance Ads)</option>
                                    <option value="Trí tuệ nhân tạo (AI)">Tích Hợp AI Solutions</option>
                                    <option value="Tư vấn tổng thể">Tư Vấn Chiến Lược Tổng Thể</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Nội dung tin nhắn / Yêu cầu cụ thể *</label>
                            <textarea name="message" rows="4" required class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 text-navy-base placeholder-slate-400 focus:bg-white focus:border-primary focus:outline-none text-sm transition-all" placeholder="Mô tả cụ thể yêu cầu của bạn, thời gian dự kiến hoặc ngân sách dự trù..."></textarea>
                        </div>

                        <button type="submit" class="w-full py-3.5 rounded-full bg-gradient-to-r from-primary via-orange-500 to-accent-amber text-white font-headline font-bold text-sm shadow-md shadow-primary/30 hover:shadow-lg hover:shadow-primary/40 hover:scale-[1.01] active:scale-[0.99] transition-all cursor-pointer">
                            Gửi Yêu Cầu Ngay 🚀
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
