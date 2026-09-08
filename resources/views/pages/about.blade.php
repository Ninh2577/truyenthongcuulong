@extends('layouts.app')

@section('title', 'Về Chúng Tôi - Truyền Thông Cửu Long')
@section('meta_description', 'Tìm hiểu về Truyền Thông Cửu Long: Tổ hợp sản xuất điện ảnh chuẩn 4K, phòng nghiên cứu công nghệ phần mềm và hệ thống giải pháp truyền thông số hàng đầu.')

@section('content')
<div class="w-full bg-surface bg-dot-grid-subtle pt-28 pb-20 border-b border-slate-200/60">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col gap-20">
        
        <!-- About Hero -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            <div class="lg:col-span-7 flex flex-col gap-6">
                <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-orange-100 border border-orange-300 text-primary font-mono text-xs font-bold w-fit">
                    <span class="w-2 h-2 rounded-full bg-primary animate-pulse"></span>
                    <span>ABOUT TRUYỀN THÔNG CỬU LONG</span>
                </div>
                <h1 class="font-headline text-4xl sm:text-5xl font-extrabold text-navy-base tracking-tight leading-tight">
                    Tổ Hợp Sáng Tạo <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary via-orange-500 to-accent-amber">Điện Ảnh</span> &amp; Kỹ Thuật Số <span class="underline decoration-primary decoration-4">Tiên Phong</span>
                </h1>
                <p class="font-body text-slate-600 text-base sm:text-lg leading-relaxed">
                    Được thành lập từ niềm đam mê nghệ thuật kể chuyện bằng hình ảnh và sức mạnh của công nghệ phần mềm hiện đại, Truyền Thông Cửu Long tự hào là đối tác chiến lược đồng hành cùng hơn 500+ doanh nghiệp, thương hiệu và tập đoàn lớn trên toàn quốc.
                </p>
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 pt-2">
                    <div class="p-4 rounded-2xl bg-white border border-slate-200 shadow-2xs">
                        <span class="font-headline text-3xl font-black text-primary">10+</span>
                        <p class="text-xs text-slate-500 font-medium mt-1">Năm hình thành &amp; phát triển</p>
                    </div>
                    <div class="p-4 rounded-2xl bg-white border border-slate-200 shadow-2xs">
                        <span class="font-headline text-3xl font-black text-accent-amber">850+</span>
                        <p class="text-xs text-slate-500 font-medium mt-1">Chiến dịch &amp; TVC sản xuất</p>
                    </div>
                    <div class="p-4 rounded-2xl bg-white border border-slate-200 shadow-2xs col-span-2 sm:col-span-1">
                        <span class="font-headline text-3xl font-black text-emerald-600">99.2%</span>
                        <p class="text-xs text-slate-500 font-medium mt-1">Tỷ lệ khách hàng gắn bó</p>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-5 relative">
                <div class="relative rounded-3xl overflow-hidden bg-navy-base border border-slate-700/80 shadow-2xl p-2 group">
                    <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuDhvlu1138YzJVrOShzutAvKGkz3j5nSQ6FSRRCOi-qYlq3I4Auibp8apXefm76bwHf-2zrBkZUHfaoXZoXnsMQ793B5GdY66hawqN0_YynY0pHC26dWpNngI9JSXG1yDBHN3WvepMEVpRCDQuLKVPCWllEmUCljDTfvmU_OHs9pqJgLfDmDXFO6gZ4aDGs6861rp3bLHuyOiamlRpq_9zpLsfmH2jfMGse10trwqZt17ok_MAJabJq" 
                        alt="Truyền Thông Cửu Long Studio Space" class="w-full h-80 object-cover rounded-2xl group-hover:scale-105 transition-transform duration-700 opacity-90">
                    <div class="p-5 flex items-center justify-between text-white">
                        <div class="flex flex-col">
                            <span class="font-headline text-xs font-bold">Trụ sở Production &amp; TechLab</span>
                            <span class="text-[10px] font-mono text-slate-400">TP. Hồ Chí Minh &amp; ĐBSCL</span>
                        </div>
                        <span class="text-xs font-mono font-bold text-amber-400 bg-amber-400/20 px-3 py-1 rounded-full border border-amber-400/30">
                            Studio 4K Ready
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Vision & Mission -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="p-8 sm:p-10 rounded-3xl bg-white border border-slate-200/90 shadow-sm flex flex-col gap-4">
                <div class="w-14 h-14 rounded-2xl bg-orange-100 text-primary flex items-center justify-center">
                    <span class="material-symbols-outlined text-[30px]">visibility</span>
                </div>
                <h3 class="font-headline text-2xl font-bold text-navy-base">Tầm Nhìn 2030</h3>
                <p class="font-body text-sm text-slate-600 leading-relaxed">
                    Trở thành hệ sinh thái truyền thông sáng tạo và công nghệ số hàng đầu khu vực, nơi giao thoa giữa chuẩn mực thẩm mỹ điện ảnh và năng lực kiến trúc phần mềm đẳng cấp thế giới, nâng tầm thương hiệu Việt vươn ra toàn cầu.
                </p>
            </div>

            <div class="p-8 sm:p-10 rounded-3xl bg-white border border-slate-200/90 shadow-sm flex flex-col gap-4">
                <div class="w-14 h-14 rounded-2xl bg-sky-100 text-sky-600 flex items-center justify-center">
                    <span class="material-symbols-outlined text-[30px]">rocket_launch</span>
                </div>
                <h3 class="font-headline text-2xl font-bold text-navy-base">Sứ Mệnh Cốt Lõi</h3>
                <p class="font-body text-sm text-slate-600 leading-relaxed">
                    Xóa bỏ khoảng cách giữa nội dung video nghệ thuật và hạ tầng kỹ thuật số; trao cho các doanh nghiệp giải pháp tích hợp trọn vẹn (Code + Film + Ads) giúp tiết kiệm 40% chi phí vận hành và tối đa hóa chỉ số chuyển đổi doanh thu.
                </p>
            </div>
        </div>

        <!-- Leadership Team (Anchor: #doi-ngu) -->
        <div id="doi-ngu" class="flex flex-col gap-10 scroll-mt-28">
            <div class="text-center max-w-2xl mx-auto flex flex-col gap-2">
                <span class="font-mono text-xs text-primary font-bold uppercase tracking-widest">LEADERSHIP &amp; EXPERTS</span>
                <h2 class="font-headline text-3xl sm:text-4xl font-extrabold text-navy-base">
                    Đội Ngũ Senior Cấp Cao Trực Tiếp Thực Hiện
                </h2>
                <p class="font-body text-xs sm:text-sm text-slate-500">
                    Những chuyên gia giàu kinh nghiệm thực chiến trong từng lĩnh vực chuyên môn.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($teamMembers as $member)
                <div class="group rounded-3xl overflow-hidden bg-white border border-slate-200 hover:border-orange-300 hover:shadow-xl transition-all duration-300 p-6 flex flex-col gap-4">
                    <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-navy-base via-navy-surface to-primary p-1 text-white flex items-center justify-center font-headline text-2xl font-bold shadow-md shrink-0">
                        {{ mb_substr($member->name, 0, 1) }}
                    </div>
                    <div class="flex flex-col gap-1">
                        <h4 class="font-headline text-base font-bold text-navy-base group-hover:text-primary transition-colors">{{ $member->name }}</h4>
                        <span class="font-mono text-xs font-bold text-primary">{{ $member->role }}</span>
                        <p class="font-body text-xs text-slate-500 leading-relaxed mt-2">{{ $member->bio }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Ecosystem Section (Cập nhật 4 website thành viên thật) -->
        <div class="p-10 rounded-3xl bg-navy-base text-white border border-slate-700 flex flex-col gap-8">
            <div class="text-center max-w-xl mx-auto flex flex-col gap-2">
                <span class="font-mono text-xs text-accent-amber font-bold uppercase tracking-widest">ECOSYSTEM MATRIX</span>
                <h3 class="font-headline text-2xl sm:text-3xl font-bold">Hệ Sinh Thái Thành Viên Truyền Thông Cửu Long</h3>
                <p class="text-xs text-slate-300">Các nền tảng số và thương hiệu thành viên thuộc hệ sinh thái Truyền Thông Cửu Long.</p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <a href="https://cuulongcamping.vn" target="_blank" rel="noopener noreferrer" class="p-5 rounded-2xl bg-white/5 border border-white/10 hover:border-emerald-400/50 hover:bg-white/10 transition-all flex flex-col gap-2 group">
                    <div class="w-9 h-9 rounded-xl bg-emerald-500/20 text-emerald-400 flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-[20px]">camping</span>
                    </div>
                    <span class="font-headline text-base font-bold text-white group-hover:text-amber-400 transition-colors">Cuu Long Camping</span>
                    <p class="text-xs text-slate-300 leading-relaxed">Trải nghiệm Camping, cắm trại dã ngoại &amp; Travel Video khám phá miền Tây.</p>
                </a>

                <a href="https://tuilanguoimientay.vn" target="_blank" rel="noopener noreferrer" class="p-5 rounded-2xl bg-white/5 border border-white/10 hover:border-amber-400/50 hover:bg-white/10 transition-all flex flex-col gap-2 group">
                    <div class="w-9 h-9 rounded-xl bg-amber-500/20 text-amber-400 flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-[20px]">map</span>
                    </div>
                    <span class="font-headline text-base font-bold text-white group-hover:text-amber-400 transition-colors">Tui Là Người Miền Tây</span>
                    <p class="text-xs text-slate-300 leading-relaxed">Kênh thông tin văn hóa, ẩm thực, du lịch và nét đẹp đời sống đồng bằng sông Cửu Long.</p>
                </a>

                <a href="https://tieudaotu.com" target="_blank" rel="noopener noreferrer" class="p-5 rounded-2xl bg-white/5 border border-white/10 hover:border-sky-400/50 hover:bg-white/10 transition-all flex flex-col gap-2 group">
                    <div class="w-9 h-9 rounded-xl bg-sky-500/20 text-sky-400 flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-[20px]">explore</span>
                    </div>
                    <span class="font-headline text-base font-bold text-white group-hover:text-amber-400 transition-colors">Tiêu Dao Tử</span>
                    <p class="text-xs text-slate-300 leading-relaxed">Blog trải nghiệm, hành trình phượt, phong cách sống tự do và tư liệu thực tế.</p>
                </a>

                <a href="https://cungchoi.com" target="_blank" rel="noopener noreferrer" class="p-5 rounded-2xl bg-white/5 border border-white/10 hover:border-purple-400/50 hover:bg-white/10 transition-all flex flex-col gap-2 group">
                    <div class="w-9 h-9 rounded-xl bg-purple-500/20 text-purple-400 flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-[20px]">sports_esports</span>
                    </div>
                    <span class="font-headline text-base font-bold text-white group-hover:text-amber-400 transition-colors">Cùng Chơi</span>
                    <p class="text-xs text-slate-300 leading-relaxed">Nền tảng kết nối cộng đồng, chia sẻ trò chơi, hoạt động giải trí và tương tác số.</p>
                </a>
            </div>
        </div>

        <!-- Partners Section (Anchor: #doi-tac) -->
        <div id="doi-tac" class="flex flex-col gap-8 scroll-mt-28">
            <div class="text-center max-w-2xl mx-auto flex flex-col gap-2">
                <span class="font-mono text-xs text-primary font-bold uppercase tracking-widest">STRATEGIC PARTNERS</span>
                <h2 class="font-headline text-3xl sm:text-4xl font-extrabold text-navy-base">
                    Đối Tác Công Nghệ &amp; Thiết Bị Điện Ảnh
                </h2>
                <p class="font-body text-xs sm:text-sm text-slate-500">
                    Hợp tác cùng những tập đoàn công nghệ và nhà sản xuất thiết bị nghe nhìn hàng đầu thế giới.
                </p>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4">
                <div class="p-6 rounded-2xl bg-white border border-slate-200/80 shadow-2xs flex flex-col items-center justify-center text-center gap-2 hover:border-primary/50 transition-colors">
                    <span class="font-headline text-lg font-black text-slate-700">Sony Pro</span>
                    <span class="text-[10px] font-mono text-slate-400">Cinema Line FX</span>
                </div>
                <div class="p-6 rounded-2xl bg-white border border-slate-200/80 shadow-2xs flex flex-col items-center justify-center text-center gap-2 hover:border-primary/50 transition-colors">
                    <span class="font-headline text-lg font-black text-slate-700">RED Digital</span>
                    <span class="text-[10px] font-mono text-slate-400">Cinema Cameras</span>
                </div>
                <div class="p-6 rounded-2xl bg-white border border-slate-200/80 shadow-2xs flex flex-col items-center justify-center text-center gap-2 hover:border-primary/50 transition-colors">
                    <span class="font-headline text-lg font-black text-slate-700">Blackmagic</span>
                    <span class="text-[10px] font-mono text-slate-400">DaVinci Resolve</span>
                </div>
                <div class="p-6 rounded-2xl bg-white border border-slate-200/80 shadow-2xs flex flex-col items-center justify-center text-center gap-2 hover:border-primary/50 transition-colors">
                    <span class="font-headline text-lg font-black text-slate-700">Google Cloud</span>
                    <span class="text-[10px] font-mono text-slate-400">Cloud Infrastructure</span>
                </div>
                <div class="p-6 rounded-2xl bg-white border border-slate-200/80 shadow-2xs flex flex-col items-center justify-center text-center gap-2 hover:border-primary/50 transition-colors">
                    <span class="font-headline text-lg font-black text-slate-700">Meta Partner</span>
                    <span class="text-[10px] font-mono text-slate-400">Ads Marketing</span>
                </div>
                <div class="p-6 rounded-2xl bg-white border border-slate-200/80 shadow-2xs flex flex-col items-center justify-center text-center gap-2 hover:border-primary/50 transition-colors">
                    <span class="font-headline text-lg font-black text-slate-700">DJI Pro</span>
                    <span class="text-[10px] font-mono text-slate-400">Aerial Gimbal</span>
                </div>
            </div>
        </div>

        <!-- Featured Clients Section (Anchor: #khach-hang) -->
        <div id="khach-hang" class="flex flex-col gap-8 scroll-mt-28">
            <div class="text-center max-w-2xl mx-auto flex flex-col gap-2">
                <span class="font-mono text-xs text-accent-amber font-bold uppercase tracking-widest">CLIENTS &amp; BRANDS</span>
                <h2 class="font-headline text-3xl sm:text-4xl font-extrabold text-navy-base">
                    500+ Khách Hàng &amp; Doanh Nghiệp Tiêu Biểu
                </h2>
                <p class="font-body text-xs sm:text-sm text-slate-500">
                    Sự tin cậy và gắn bó của khách hàng là minh chứng lớn nhất cho năng lực thực chiến của Truyền Thông Cửu Long.
                </p>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-2xs flex flex-col items-center text-center gap-1.5 hover:shadow-md transition-all">
                    <span class="material-symbols-outlined text-primary text-[28px]">account_balance</span>
                    <span class="font-headline text-sm font-bold text-navy-base">Vietcombank</span>
                    <span class="text-[11px] text-slate-400">TVC &amp; Sự kiện tài chính</span>
                </div>
                <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-2xs flex flex-col items-center text-center gap-1.5 hover:shadow-md transition-all">
                    <span class="material-symbols-outlined text-accent-amber text-[28px]">cell_tower</span>
                    <span class="font-headline text-sm font-bold text-navy-base">Viettel / Mobifone</span>
                    <span class="text-[11px] text-slate-400">Chiến dịch truyền thông số</span>
                </div>
                <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-2xs flex flex-col items-center text-center gap-1.5 hover:shadow-md transition-all">
                    <span class="material-symbols-outlined text-emerald-600 text-[28px]">agriculture</span>
                    <span class="font-headline text-sm font-bold text-navy-base">Tập đoàn Lộc Trời</span>
                    <span class="text-[11px] text-slate-400">Phim tài liệu doanh nghiệp</span>
                </div>
                <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-2xs flex flex-col items-center text-center gap-1.5 hover:shadow-md transition-all">
                    <span class="material-symbols-outlined text-sky-600 text-[28px]">travel_explore</span>
                    <span class="font-headline text-sm font-bold text-navy-base">Du Lịch TP. Cần Thơ</span>
                    <span class="text-[11px] text-slate-400">Video quảng bá du lịch ĐBSCL</span>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
