@extends('layouts.app')

@section('title', 'Cơ Hội Nghề Nghiệp & Tuyển Dụng - Truyền Thông Cửu Long')
@section('meta_description', 'Gia nhập đội ngũ sáng tạo tại Truyền Thông Cửu Long. Khám phá các cơ hội nghề nghiệp hấp dẫn cho Đạo diễn, Video Editor, Kỹ sư phần mềm và Marketer.')

@section('content')
<div class="w-full bg-surface bg-dot-grid-subtle pt-28 pb-20 border-b border-slate-200/60">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col gap-16">
        
        <!-- Header -->
        <div class="text-center max-w-3xl mx-auto flex flex-col gap-3">
            <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-purple-100 border border-purple-300 text-purple-800 font-mono text-xs font-bold mx-auto">
                <span class="w-2 h-2 rounded-full bg-purple-600 animate-pulse"></span>
                <span>JOIN OUR CREATIVE &amp; TECH TEAM</span>
            </div>
            <h1 class="font-headline text-3xl sm:text-5xl font-extrabold text-navy-base tracking-tight">
                Cùng Kiến Tạo <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-600 via-primary to-accent-coral">Tác Phẩm Triệu View</span> &amp; Công Nghệ Vượt Trội
            </h1>
            <p class="font-body text-slate-600 text-sm sm:text-base leading-relaxed">
                Tại Truyền Thông Cửu Long, chúng tôi trân trọng tài năng, đam mê bứt phá và tư duy khác biệt. Môi trường trẻ trung, sáng tạo không giới hạn với những dự án tầm cỡ quốc gia.
            </p>
        </div>

        <!-- Culture Highlights -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="p-6 rounded-3xl bg-white border border-slate-200 shadow-2xs flex flex-col gap-3">
                <div class="w-12 h-12 rounded-2xl bg-orange-100 text-primary flex items-center justify-center">
                    <span class="material-symbols-outlined text-[24px]">workspace_premium</span>
                </div>
                <h3 class="font-headline text-lg font-bold text-navy-base">Thu Nhập Hấp Dẫn &amp; Thưởng Nóng</h3>
                <p class="text-xs text-slate-500 leading-relaxed">Lương thưởng cạnh tranh theo năng lực, thưởng nóng ngay khi đóng máy dự án và hoàn thành cột mốc phần mềm.</p>
            </div>
            <div class="p-6 rounded-3xl bg-white border border-slate-200 shadow-2xs flex flex-col gap-3">
                <div class="w-12 h-12 rounded-2xl bg-sky-100 text-sky-600 flex items-center justify-center">
                    <span class="material-symbols-outlined text-[24px]">videocam</span>
                </div>
                <h3 class="font-headline text-lg font-bold text-navy-base">Trang Thiết Bị Hàng Đầu</h3>
                <p class="text-xs text-slate-500 leading-relaxed">Được cấp máy trạm M3 Max/RTX 4090, dàn máy quay điện ảnh Sony FX/RED và phòng dựng chuẩn DaVinci HDR.</p>
            </div>
            <div class="p-6 rounded-3xl bg-white border border-slate-200 shadow-2xs flex flex-col gap-3">
                <div class="w-12 h-12 rounded-2xl bg-emerald-100 text-emerald-600 flex items-center justify-center">
                    <span class="material-symbols-outlined text-[24px]">trending_up</span>
                </div>
                <h3 class="font-headline text-lg font-bold text-navy-base">Lộ Trình Thăng Tiến Rõ Ràng</h3>
                <p class="text-xs text-slate-500 leading-relaxed">Được kèm cặp trực tiếp bởi các Đạo diễn và Tech Lead 10+ năm kinh nghiệm, cơ hội trở thành Partner dự án.</p>
            </div>
        </div>

        <!-- Success Alert -->
        @if(session('success'))
        <div class="p-5 rounded-2xl bg-emerald-50 border border-emerald-300 text-emerald-800 text-sm font-semibold flex items-center gap-3">
            <span class="material-symbols-outlined text-[24px] text-emerald-600">check_circle</span>
            <span>{{ session('success') }}</span>
        </div>
        @endif

        <!-- Main Careers Layout: Left Job Listings + Right Fast Apply Form -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
            
            <!-- Left: Current Open Positions -->
            <div class="lg:col-span-7 flex flex-col gap-6">
                <div class="flex items-center justify-between">
                    <h3 class="font-headline text-2xl font-bold text-navy-base">Vị Trí Đang Tuyển Dụng ({{ $jobs->count() }})</h3>
                    <span class="font-mono text-xs text-primary font-bold">Làm việc tại HCM &amp; Cần Thơ</span>
                </div>

                <div class="flex flex-col gap-4">
                    @forelse($jobs as $job)
                    <div class="p-6 rounded-3xl bg-white border border-slate-200 shadow-xs hover:border-purple-300 hover:shadow-md transition-all flex flex-col justify-between gap-4">
                        <div class="flex flex-col gap-2">
                            <div class="flex items-center gap-2">
                                <span class="px-3 py-0.5 rounded-full bg-purple-100 text-purple-700 font-mono text-[10px] font-bold">FULL-TIME</span>
                                <span class="text-xs font-mono text-slate-400">{{ $job->published_at ? $job->published_at->format('d/m/Y') : '' }}</span>
                            </div>
                            <h4 class="font-headline text-lg font-bold text-navy-base">{{ $job->title }}</h4>
                            <p class="font-body text-xs text-slate-500 line-clamp-2 leading-relaxed">{{ $job->summary ?: 'Tham gia phát triển dự án truyền thông và công nghệ số cho khách hàng doanh nghiệp.' }}</p>
                        </div>
                        <div class="pt-3 border-t border-slate-100 flex items-center justify-between">
                            <a href="{{ route('blog.show', $job->slug) }}" class="text-xs font-headline font-bold text-primary hover:underline flex items-center gap-1">
                                <span>Xem mô tả công việc (JD)</span>
                                <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
                            </a>
                            <span class="font-mono text-xs font-bold text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-full">Thu nhập thương lượng</span>
                        </div>
                    </div>
                    @empty
                    <div class="p-10 rounded-3xl bg-white border border-slate-200 text-center text-slate-500">
                        Hiện chưa có vị trí đăng tuyển công khai. Bạn có thể gửi hồ sơ ứng tuyển tự do ở biểu mẫu bên cạnh!
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- Right: CV Application Form -->
            <div class="lg:col-span-5 p-8 rounded-3xl bg-white border-2 border-purple-200 shadow-xl flex flex-col gap-5 sticky top-28">
                <div class="flex items-center gap-3 border-b border-slate-100 pb-4">
                    <div class="w-10 h-10 rounded-xl bg-purple-100 text-purple-600 flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-[22px]">send</span>
                    </div>
                    <div>
                        <h3 class="font-headline text-lg font-bold text-navy-base">Nộp Hồ Sơ Nhanh</h3>
                        <p class="text-[11px] text-slate-400">Gửi CV ứng tuyển trực tiếp đến Ban Nhân Sự</p>
                    </div>
                </div>

                <form action="{{ route('careers.apply') }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-3.5">
                    @csrf
                    <div>
                        <label class="block font-headline text-xs font-bold text-slate-700 mb-1">Họ và tên của bạn <span class="text-rose-500">*</span></label>
                        <input type="text" name="fullname" placeholder="Nguyễn Văn A" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs text-navy-base focus:ring-2 focus:ring-purple-500 focus:outline-none">
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block font-headline text-xs font-bold text-slate-700 mb-1">Số điện thoại <span class="text-rose-500">*</span></label>
                            <input type="tel" name="phone" placeholder="0908 xxx xxx" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs text-navy-base focus:ring-2 focus:ring-purple-500 focus:outline-none">
                        </div>
                        <div>
                            <label class="block font-headline text-xs font-bold text-slate-700 mb-1">Email <span class="text-rose-500">*</span></label>
                            <input type="email" name="email" placeholder="you@email.com" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs text-navy-base focus:ring-2 focus:ring-purple-500 focus:outline-none">
                        </div>
                    </div>
                    <div>
                        <label class="block font-headline text-xs font-bold text-slate-700 mb-1">Vị trí bạn muốn ứng tuyển <span class="text-rose-500">*</span></label>
                        <select name="position" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs text-navy-base focus:ring-2 focus:ring-purple-500 focus:outline-none">
                            <option value="Video Editor / Motion Graphics">Video Editor / Motion Graphics</option>
                            <option value="Đạo Diễn / Biên Kịch TVC">Đạo Diễn / Biên Kịch TVC</option>
                            <option value="Lập Trình Viên Fullstack Laravel / React">Lập Trình Viên Fullstack Laravel / React</option>
                            <option value="Chuyên Viên Chạy Ads TikTok & Meta">Chuyên Viên Chạy Ads TikTok &amp; Meta</option>
                            <option value="Thực Tập Sinh Media / Tech">Thực Tập Sinh Media / Tech</option>
                            <option value="Ứng Tuyển Tự Do Khác">Vị trí khác (Ghi rõ trong thư)</option>
                        </select>
                    </div>
                    <div>
                        <label class="block font-headline text-xs font-bold text-slate-700 mb-1">Tải lên File CV (PDF / DOCX tối đa 10MB) <span class="text-rose-500">*</span></label>
                        <input type="file" name="cv_file" accept=".pdf,.doc,.docx" required class="w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100 border border-slate-300 rounded-xl">
                    </div>
                    <div>
                        <label class="block font-headline text-xs font-bold text-slate-700 mb-1">Lời nhắn / Giới thiệu bản thân</label>
                        <textarea name="cover_letter" rows="3" placeholder="Chia sẻ kinh nghiệm hoặc đường dẫn portfolio/showreel của bạn..." class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs text-navy-base focus:ring-2 focus:ring-purple-500 focus:outline-none"></textarea>
                    </div>

                    <button type="submit" class="mt-2 w-full py-3 rounded-xl bg-gradient-to-r from-purple-600 via-primary to-orange-500 text-white font-headline text-xs font-bold shadow-md hover:brightness-110 transition-all">
                        Nộp Hồ Sơ Ứng Tuyển Ngay
                    </button>
                </form>
            </div>

        </div>

    </div>
</div>
@endsection
