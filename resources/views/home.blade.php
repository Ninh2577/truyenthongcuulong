@extends('layouts.app')

@section('title', 'Truyền Thông Cửu Long - Agency Truyền Thông & Giải Pháp Công Nghệ')
@section('meta_description', 'Agency truyền thông sáng tạo và cung cấp giải pháp công nghệ toàn diện tại Cần Thơ & ĐBSCL: Sản xuất Video, Quảng cáo đa kênh, Thiết kế Website & Tích hợp AI.')

@section('content')
<!-- Hero Section -->
<section class="relative pt-24 pb-20 md:pt-32 md:pb-32 overflow-hidden">
    <!-- Desktop Canvas Particles Background -->
    <canvas id="hero-particles" class="absolute inset-0 pointer-events-none z-0 hidden lg:block"></canvas>
    
    <!-- Decorative Glowing Orbs -->
    <div class="absolute top-1/4 left-1/2 -translate-x-1/2 w-96 h-96 bg-cyan-500/15 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute top-1/3 right-10 w-80 h-80 bg-blue-600/15 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
        <!-- Pill Badge -->
        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full glass-panel border border-cyan-500/30 text-cyan-400 text-xs font-semibold mb-8 shadow-glow">
            <span class="w-2 h-2 rounded-full bg-cyan-400 animate-ping"></span>
            Mô Hình Kép: Sáng Tạo Truyền Thông & Giải Pháp Công Nghệ
        </div>

        <!-- Main Heading -->
        <h1 class="text-4xl sm:text-6xl lg:text-7xl font-extrabold tracking-tight text-white mb-6 leading-tight max-w-5xl mx-auto">
            Đột Phá Doanh Thu Cùng <br class="hidden sm:inline">
            <span class="text-gradient">Media Sáng Tạo</span> & <span class="text-gradient-cyan">Nền Tảng Số</span>
        </h1>

        <p class="max-w-3xl mx-auto text-base sm:text-xl text-slate-300 mb-10 leading-relaxed font-light">
            Chúng tôi đồng hành cùng các doanh nghiệp kiến tạo nội dung truyền thông đỉnh cao, tối ưu chiến dịch quảng cáo và xây dựng hạ tầng website, phần mềm tích hợp AI vượt trội.
        </p>

        <!-- CTA Buttons -->
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="{{ route('contact') }}" class="w-full sm:w-auto px-8 py-4 rounded-xl bg-gradient-to-r from-cyan-500 via-blue-600 to-amber-400 text-white font-bold text-base shadow-glow hover:scale-105 transition-all text-center">
                Tư Vấn Giải Pháp Miễn Phí 🚀
            </a>
            <a href="{{ route('services.index') }}" class="w-full sm:w-auto px-8 py-4 rounded-xl glass-panel text-slate-200 font-semibold text-base border border-white/10 hover:bg-white/10 hover:text-white transition-all text-center">
                Khám Phá Dịch Vụ
            </a>
        </div>

        <!-- Highlighted Floating Feature Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-16 text-left">
            <div class="glass-card p-6 rounded-2xl">
                <div class="text-3xl mb-3">🎬</div>
                <h2 class="text-lg font-bold text-white mb-1">Sản Xuất Video 4K & TVC</h2>
                <p class="text-xs text-slate-400">Hình ảnh điện ảnh, kịch bản độc quyền, kỹ xảo hiện đại giúp thương hiệu bứt phá nhận diện.</p>
            </div>
            <div class="glass-card p-6 rounded-2xl">
                <div class="text-3xl mb-3">💻</div>
                <h2 class="text-lg font-bold text-white mb-1">Thiết Kế Web & Nền Tảng Số</h2>
                <p class="text-xs text-slate-400">Xây dựng trên nền tảng Laravel hiện đại, tốc độ tải siêu tốc, chuẩn SEO tuyệt đối.</p>
            </div>
            <div class="glass-card p-6 rounded-2xl">
                <div class="text-3xl mb-3">🤖</div>
                <h2 class="text-lg font-bold text-white mb-1">Giải Pháp Trí Tuệ Nhân Tạo</h2>
                <p class="text-xs text-slate-400">Tự động hóa chăm sóc khách hàng 24/7, cá nhân hóa trải nghiệm người dùng với AI.</p>
            </div>
        </div>
    </div>
</section>

<!-- Metrics & Numbers Counter Section -->
<section class="py-12 border-y border-white/10 bg-[#080D1D]/60 relative z-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
            <div>
                <div class="font-heading font-black text-3xl sm:text-5xl text-cyan-400 mb-2">10+</div>
                <div class="text-xs sm:text-sm text-slate-400 font-medium">Năm Kinh Nghiệm ĐBSCL</div>
            </div>
            <div>
                <div class="font-heading font-black text-3xl sm:text-5xl text-white mb-2">500+</div>
                <div class="text-xs sm:text-sm text-slate-400 font-medium">Dự Án Hoàn Thành</div>
            </div>
            <div>
                <div class="font-heading font-black text-3xl sm:text-5xl text-amber-400 mb-2">480+</div>
                <div class="text-xs sm:text-sm text-slate-400 font-medium">Bài Viết & Tài Nguyên Chia Sẻ</div>
            </div>
            <div>
                <div class="font-heading font-black text-3xl sm:text-5xl text-emerald-400 mb-2">98%</div>
                <div class="text-xs sm:text-sm text-slate-400 font-medium">Khách Hàng Hài Lòng</div>
            </div>
        </div>
    </div>
</section>

<!-- Two Core Pillars of Services -->
<section class="py-20 relative z-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <h2 class="text-xs font-bold text-cyan-400 uppercase tracking-widest mb-3">Hệ Sinh Thái Toàn Diện</h2>
            <h3 class="text-3xl sm:text-4xl font-extrabold text-white mb-4">Hai Trụ Cột Năng Lực Cốt Lõi</h3>
            <p class="text-slate-400 text-sm sm:text-base">Chúng tôi kết hợp sức mạnh sáng tạo nghệ thuật với công nghệ kỹ thuật số để mang lại giá trị bền vững cho doanh nghiệp.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
            <!-- Pillar 1: Media & Agency -->
            <div class="glass-card p-8 rounded-3xl border border-cyan-500/20 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-cyan-500/10 rounded-full blur-2xl"></div>
                <div class="flex items-center gap-3 mb-6">
                    <span class="w-12 h-12 rounded-2xl bg-cyan-500/20 text-cyan-400 flex items-center justify-center text-2xl font-bold">🎬</span>
                    <div>
                        <h4 class="font-heading font-bold text-2xl text-white">Agency Truyền Thông Sáng Tạo</h4>
                        <p class="text-xs text-cyan-400">Content, Video Production & Digital Ads</p>
                    </div>
                </div>
                <p class="text-slate-300 text-sm mb-6 leading-relaxed">
                    Đội ngũ đạo diễn, quay phim và chuyên viên marketing dày dạn kinh nghiệm giúp thương hiệu của bạn tỏa sáng qua từng thước phim chất lượng điện ảnh.
                </p>
                <div class="space-y-3 mb-8">
                    <div class="flex items-center gap-3 text-sm text-slate-300">
                        <span class="text-cyan-400">✓</span> Sản xuất TVC, Phim Doanh Nghiệp, Viral Clip, Travel Video
                    </div>
                    <div class="flex items-center gap-3 text-sm text-slate-300">
                        <span class="text-cyan-400">✓</span> Chiến dịch quảng cáo Facebook Ads, Google Ads, TikTok Ads
                    </div>
                    <div class="flex items-center gap-3 text-sm text-slate-300">
                        <span class="text-cyan-400">✓</span> Quản trị & xây dựng kênh mạng xã hội triệu view
                    </div>
                </div>
                <a href="{{ route('services.show', 'san-xuat-video-media') }}" class="inline-flex items-center gap-2 text-cyan-400 font-semibold text-sm hover:text-cyan-300 group">
                    Tìm hiểu dịch vụ Media <span class="group-hover:translate-x-1 transition-transform">&rarr;</span>
                </a>
            </div>

            <!-- Pillar 2: Tech Solutions -->
            <div class="glass-card p-8 rounded-3xl border border-amber-500/20 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-amber-500/10 rounded-full blur-2xl"></div>
                <div class="flex items-center gap-3 mb-6">
                    <span class="w-12 h-12 rounded-2xl bg-amber-500/20 text-amber-400 flex items-center justify-center text-2xl font-bold">💻</span>
                    <div>
                        <h4 class="font-heading font-bold text-2xl text-white">Giải Pháp Công Nghệ Số</h4>
                        <p class="text-xs text-amber-400">Web, App & Trí Tuệ Nhân Tạo</p>
                    </div>
                </div>
                <p class="text-slate-300 text-sm mb-6 leading-relaxed">
                    Ứng dụng các công nghệ tiên tiến nhất (Laravel, Vue/React, AI Engine) để xây dựng hệ thống phần mềm tốc độ cao, chuẩn bảo mật doanh nghiệp.
                </p>
                <div class="space-y-3 mb-8">
                    <div class="flex items-center gap-3 text-sm text-slate-300">
                        <span class="text-amber-400">✓</span> Thiết kế Website độc quyền, siêu tốc độ, chuẩn SEO 100%
                    </div>
                    <div class="flex items-center gap-3 text-sm text-slate-300">
                        <span class="text-amber-400">✓</span> Phát triển phần mềm quản lý, Web App & nền tảng ERP
                    </div>
                    <div class="flex items-center gap-3 text-sm text-slate-300">
                        <span class="text-amber-400">✓</span> Tích hợp Chatbot AI và tự động hóa quy trình kinh doanh
                    </div>
                </div>
                <a href="{{ route('services.show', 'thiet-ke-website-chuyen-nghiep') }}" class="inline-flex items-center gap-2 text-amber-400 font-semibold text-sm hover:text-amber-300 group">
                    Tìm hiểu giải pháp Công nghệ <span class="group-hover:translate-x-1 transition-transform">&rarr;</span>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Latest Insights & Articles -->
<section class="py-20 bg-[#080D1D]/40 relative z-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-12">
            <div>
                <span class="text-xs font-bold text-cyan-400 uppercase tracking-widest block mb-2">Thư Viện Tri Thức</span>
                <h2 class="text-3xl font-extrabold text-white">Bài Viết & Tin Tức Mới Nhất</h2>
            </div>
            <a href="{{ route('blog.index') }}" class="text-cyan-400 hover:text-cyan-300 text-sm font-semibold mt-4 sm:mt-0 flex items-center gap-1 group">
                Xem tất cả 480+ bài viết <span class="group-hover:translate-x-1 transition-transform">&rarr;</span>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($latestPosts as $post)
            <article class="glass-card rounded-2xl overflow-hidden flex flex-col group">
                <a href="{{ route('blog.show', $post->slug) }}" class="block aspect-video bg-slate-800 relative overflow-hidden">
                    @if($post->thumbnail)
                        <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy">
                    @else
                        <div class="w-full h-full flex items-center justify-center bg-gradient-to-tr from-slate-900 to-slate-800 text-slate-500">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                        </div>
                    @endif
                    @if($post->category)
                    <span class="absolute top-3 left-3 px-3 py-1 rounded-full text-[11px] font-bold bg-[#0B132B]/80 backdrop-blur-md text-cyan-300 border border-white/10">
                        {{ $post->category->name }}
                    </span>
                    @endif
                </a>
                <div class="p-6 flex flex-col flex-grow">
                    <div class="text-xs text-slate-400 mb-2">
                        {{ $post->published_at ? $post->published_at->format('d/m/Y') : '' }} • {{ $post->views }} lượt xem
                    </div>
                    <h3 class="font-heading font-bold text-lg text-white group-hover:text-cyan-400 transition-colors line-clamp-2 mb-3">
                        <a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
                    </h3>
                    <p class="text-xs text-slate-400 line-clamp-3 mb-4 leading-relaxed flex-grow">
                        {{ $post->summary }}
                    </p>
                    <a href="{{ route('blog.show', $post->slug) }}" class="text-xs font-semibold text-cyan-400 hover:text-cyan-300 flex items-center gap-1">
                        Đọc tiếp &rarr;
                    </a>
                </div>
            </article>
            @empty
            <p class="text-slate-400 text-center col-span-3 py-8">Đang cập nhật bài viết mới...</p>
            @endforelse
        </div>
    </div>
</section>

<!-- Direct Consultation Form CTA -->
<section class="py-20 relative z-10 overflow-hidden">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="glass-panel p-8 sm:p-12 rounded-3xl border border-white/10 shadow-glow relative">
            <div class="text-center max-w-2xl mx-auto mb-8">
                <span class="text-xs font-bold text-cyan-400 uppercase tracking-widest block mb-2">Đăng Ký Tư Vấn</span>
                <h2 class="text-3xl font-extrabold text-white mb-3">Sẵn Sàng Bứt Phá Doanh Thu?</h2>
                <p class="text-sm text-slate-400">Để lại thông tin, chuyên gia của chúng tôi sẽ liên hệ khảo sát và lên kế hoạch triển khai chi tiết cho bạn.</p>
            </div>

            <form action="{{ route('contact.submit') }}" method="POST" class="space-y-4">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-medium text-slate-300 mb-1.5">Họ và tên *</label>
                        <input type="text" name="fullname" required placeholder="Nguyễn Văn A" class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white placeholder-slate-500 focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400 text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-slate-300 mb-1.5">Số điện thoại *</label>
                        <input type="tel" name="phone" required placeholder="0907xxxxxx" class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white placeholder-slate-500 focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400 text-sm">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-medium text-slate-300 mb-1.5">Email liên hệ</label>
                        <input type="email" name="email" placeholder="email@company.com" class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white placeholder-slate-500 focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400 text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-slate-300 mb-1.5">Dịch vụ quan tâm</label>
                        <select name="service_interested" class="w-full px-4 py-3 rounded-xl bg-[#1C2541] border border-white/10 text-white focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400 text-sm">
                            <option value="Sản xuất Video & Media">Sản xuất Video & Media</option>
                            <option value="Quảng cáo Digital Ads">Quảng cáo Digital Ads & Tiếp thị số</option>
                            <option value="Thiết kế Website & Phần mềm">Thiết kế Website & Web App</option>
                            <option value="Tích hợp Trí tuệ nhân tạo (AI)">Tích hợp AI & Tự động hóa</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-medium text-slate-300 mb-1.5">Nhu cầu hoặc yêu cầu cụ thể *</label>
                    <textarea name="message" rows="3" required placeholder="Mô tả sơ lược về mục tiêu hoặc dự án bạn muốn triển khai..." class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white placeholder-slate-500 focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400 text-sm"></textarea>
                </div>

                <button type="submit" class="w-full py-4 rounded-xl bg-gradient-to-r from-cyan-500 via-blue-600 to-amber-400 text-white font-bold text-base shadow-glow hover:scale-[1.01] transition-transform">
                    Gửi Yêu Cầu Tư Vấn Ngay ⚡
                </button>
            </form>
        </div>
    </div>
</section>
@endsection