@extends('layouts.app')

@section('title', 'Liên Hệ - Truyền Thông Cửu Long')
@section('meta_description', 'Liên hệ với Công ty Truyền Thông Cửu Long để nhận tư vấn và báo giá chi tiết về dịch vụ Media, Marketing và Công nghệ số.')

@section('content')
<div class="pt-28 pb-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="text-xs font-bold text-cyan-400 uppercase tracking-widest block mb-2">Kết Nối Với Chúng Tôi</span>
            <h1 class="text-3xl sm:text-5xl font-extrabold text-white mb-4">Liên Hệ Hợp Tác</h1>
            <p class="text-slate-400 text-sm sm:text-base">Chúng tôi luôn sẵn sàng lắng nghe mọi ý tưởng và giải đáp mọi thắc mắc của bạn.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 max-w-6xl mx-auto">
            <!-- Contact Info Sidebar -->
            <div class="lg:col-span-5 space-y-6">
                <div class="glass-card p-6 rounded-3xl">
                    <div class="flex items-center gap-4 mb-4">
                        <span class="w-12 h-12 rounded-2xl bg-cyan-500/20 text-cyan-400 flex items-center justify-center text-xl font-bold">📍</span>
                        <div>
                            <div class="font-heading font-bold text-white text-base">Địa Chỉ Trụ Sở</div>
                            <div class="text-xs text-slate-400">Thành phố Cần Thơ, Việt Nam</div>
                        </div>
                    </div>
                    <p class="text-xs text-slate-400">Sẵn sàng phục vụ khách hàng tại các tỉnh thành ĐBSCL và trên toàn quốc.</p>
                </div>

                <div class="glass-card p-6 rounded-3xl">
                    <div class="flex items-center gap-4 mb-4">
                        <span class="w-12 h-12 rounded-2xl bg-emerald-500/20 text-emerald-400 flex items-center justify-center text-xl font-bold">📞</span>
                        <div>
                            <div class="font-heading font-bold text-white text-base">Hotline & Zalo</div>
                            <div class="text-xs text-slate-400">Hỗ trợ 24/7</div>
                        </div>
                    </div>
                    <div class="text-sm font-semibold text-emerald-400">0907.xxx.xxx</div>
                </div>

                <div class="glass-card p-6 rounded-3xl">
                    <div class="flex items-center gap-4 mb-4">
                        <span class="w-12 h-12 rounded-2xl bg-amber-500/20 text-amber-400 flex items-center justify-center text-xl font-bold">✉️</span>
                        <div>
                            <div class="font-heading font-bold text-white text-base">Email Doanh Nghiệp</div>
                            <div class="text-xs text-slate-400">Tiếp nhận báo giá & dự thầu</div>
                        </div>
                    </div>
                    <div class="text-sm font-semibold text-amber-400">lienhe@truyenthongcuulong.com</div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="lg:col-span-7">
                <div class="glass-panel p-8 sm:p-10 rounded-3xl border border-white/10 shadow-glow">
                    <h2 class="font-heading font-bold text-2xl text-white mb-6">Gửi Yêu Cầu Cho Đội Ngũ Cửu Long</h2>

                    <form action="{{ route('contact.submit') }}" method="POST" class="space-y-4">
                        @csrf
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-medium text-slate-300 mb-1.5">Họ và tên *</label>
                                <input type="text" name="fullname" required class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white placeholder-slate-500 focus:border-cyan-400 text-sm" placeholder="Nguyễn Văn A">
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-slate-300 mb-1.5">Số điện thoại *</label>
                                <input type="tel" name="phone" required class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white placeholder-slate-500 focus:border-cyan-400 text-sm" placeholder="0907xxxxxx">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-medium text-slate-300 mb-1.5">Email</label>
                                <input type="email" name="email" class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white placeholder-slate-500 focus:border-cyan-400 text-sm" placeholder="email@gmail.com">
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-slate-300 mb-1.5">Dịch vụ quan tâm</label>
                                <select name="service_interested" class="w-full px-4 py-3 rounded-xl bg-[#1C2541] border border-white/10 text-white focus:border-cyan-400 text-sm">
                                    <option value="Sản xuất Media & Video">Sản xuất Media & Video</option>
                                    <option value="Quảng cáo Digital Ads">Quảng cáo Digital Ads</option>
                                    <option value="Thiết kế Website & Web App">Thiết kế Website & Web App</option>
                                    <option value="Trí tuệ nhân tạo (AI)">Tích hợp AI & CSKH</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-medium text-slate-300 mb-1.5">Nội dung tin nhắn *</label>
                            <textarea name="message" rows="4" required class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white placeholder-slate-500 focus:border-cyan-400 text-sm" placeholder="Mô tả cụ thể yêu cầu của bạn..."></textarea>
                        </div>

                        <button type="submit" class="w-full py-4 rounded-xl bg-gradient-to-r from-cyan-500 via-blue-600 to-amber-400 text-white font-bold text-sm shadow-glow hover:scale-[1.01] transition-transform">
                            Gửi Tin Nhắn Ngay 🚀
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection