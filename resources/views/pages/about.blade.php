@extends('layouts.app')

@section('title', 'Về Chúng Tôi - Cửu Long Media & Technology Hub')
@section('meta_description', 'Tìm hiểu về Cửu Long Media & Tech: Tổ hợp sản xuất điện ảnh chuẩn 4K, phòng nghiên cứu công nghệ phần mềm và hệ thống giải pháp truyền thông số hàng đầu.')

@section('content')
<div class="w-full bg-surface bg-dot-grid-subtle pt-28 pb-20 border-b border-slate-200/60">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col gap-20">
        
        <!-- About Hero -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            <div class="lg:col-span-7 flex flex-col gap-6">
                <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-orange-100 border border-orange-300 text-primary font-mono text-xs font-bold w-fit">
                    <span class="w-2 h-2 rounded-full bg-primary animate-pulse"></span>
                    <span>ABOUT CỬU LONG MEDIA &amp; TECH</span>
                </div>
                <h1 class="font-headline text-4xl sm:text-5xl font-extrabold text-navy-base tracking-tight leading-tight">
                    Tổ Hợp Sáng Tạo <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary via-orange-500 to-accent-amber">Điện Ảnh</span> &amp; Kỹ Thuật Số <span class="underline decoration-primary decoration-4">Tiên Phong</span>
                </h1>
                <p class="font-body text-slate-600 text-base sm:text-lg leading-relaxed">
                    Được thành lập từ niềm đam mê nghệ thuật kể chuyện bằng hình ảnh và sức mạnh của công nghệ phần mềm hiện đại, Cửu Long Media &amp; Technology tự hào là đối tác chiến lược đồng hành cùng hơn 500+ doanh nghiệp, thương hiệu và tập đoàn lớn trên toàn quốc.
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
                        alt="Cuu Long Media Studio Space" class="w-full h-80 object-cover rounded-2xl group-hover:scale-105 transition-transform duration-700 opacity-90">
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

        <!-- Leadership Team -->
        <div class="flex flex-col gap-10">
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

        <!-- Ecosystem Section -->
        <div class="p-10 rounded-3xl bg-navy-base text-white border border-slate-700 flex flex-col gap-8">
            <div class="text-center max-w-xl mx-auto flex flex-col gap-2">
                <span class="font-mono text-xs text-accent-amber font-bold uppercase tracking-widest">ECOSYSTEM MATRIX</span>
                <h3 class="font-headline text-2xl sm:text-3xl font-bold">4 Đơn Vị Thành Viên Tổ Hợp</h3>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="p-5 rounded-2xl bg-white/5 border border-white/10 flex flex-col gap-2">
                    <span class="font-headline text-base font-bold text-orange-400">CLM Studio</span>
                    <p class="text-xs text-slate-300">Sản xuất TVC 4K, video viral triệu view, phóng sự doanh nghiệp và podcast.</p>
                </div>
                <div class="p-5 rounded-2xl bg-white/5 border border-white/10 flex flex-col gap-2">
                    <span class="font-headline text-base font-bold text-sky-400">CLM TechLab</span>
                    <p class="text-xs text-slate-300">Thiết kế Web/App chịu tải cao, Microservices, tích hợp AI &amp; cổng dữ liệu CDP.</p>
                </div>
                <div class="p-5 rounded-2xl bg-white/5 border border-white/10 flex flex-col gap-2">
                    <span class="font-headline text-base font-bold text-rose-400">CLM Motion &amp; VFX</span>
                    <p class="text-xs text-slate-300">3D CGI, kỹ xảo điện ảnh, hậu kỳ âm thanh vòm và đồ họa chuyển động quốc tế.</p>
                </div>
                <div class="p-5 rounded-2xl bg-white/5 border border-white/10 flex flex-col gap-2">
                    <span class="font-headline text-base font-bold text-emerald-400">CLM Ventures</span>
                    <p class="text-xs text-slate-300">Vườn ươm dự án số, phát triển template bản quyền và phân phối giải pháp số.</p>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
