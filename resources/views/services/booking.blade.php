@extends('layouts.app')

@section('title', 'Điều Phối Ekip Media & Tác Nghiệp Sự Kiện - Truyền Thông Cửu Long')
@section('meta_description', 'Dịch vụ điều phối ekip quay phim, chụp ảnh sự kiện doanh nghiệp chuyên nghiệp theo buổi hoặc trọn gói ngày tại Cần Thơ và ĐBSCL.')

@section('content')
<div class="w-full bg-[#f8f9ff] min-h-screen pt-28 pb-20" style="font-family: var(--font-primary);" x-data="{
    crewType: 'video',
    eventDate: '',
    eventLocation: 'Cần Thơ',
    fullName: '',
    phone: '',
    email: '',
    notes: '',

    getCrewLabel() {
        if (this.crewType === 'video') return 'Ekip Quay Phim';
        if (this.crewType === 'photo') return 'Ekip Chụp Ảnh';
        return 'Ekip Sự Kiện Trọn Gói';
    },

    generateMessage() {
        return `[ĐIỀU PHỐI EKIP] Nhu cầu: ${this.getCrewLabel()} | Ngày tác nghiệp: ${this.eventDate || 'Chưa định ngày'} | Địa điểm: ${this.eventLocation} | Ghi chú: ${this.notes || 'Không có'}`;
    }
}">
    <x-ui.container class="flex flex-col gap-14 lg:gap-18">
        
        <!-- Breadcrumb Navigation -->
        <div class="pt-2">
            <x-ui.breadcrumb :items="[
                ['label' => 'Dịch vụ & Giải pháp', 'url' => '/dich-vu'],
                ['label' => 'Điều phối ekip Media']
            ]" />
        </div>

        <!-- ==================== HERO ==================== -->
        <section class="max-w-4xl mx-auto text-center flex flex-col items-center gap-5">
            <span class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-slate-100 text-slate-700 text-xs font-semibold">
                ON-DEMAND PRODUCTION CREW &bull; CẦN THƠ &amp; ĐBSCL
            </span>

            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-[#070f1e] tracking-tight leading-tight">
                Điều Phối Ekip Media
                <span class="block text-slate-600 font-bold mt-1 text-2xl sm:text-3xl lg:text-4xl">
                    Theo Nhu Cầu Doanh Nghiệp
                </span>
            </h1>

            <p class="text-slate-600 text-sm sm:text-base leading-relaxed max-w-2xl">
                Cung cấp nhân sự quay phim, chụp ảnh và kỹ thuật viên thiết bị tác nghiệp chuyên nghiệp theo buổi hoặc trọn gói ngày tại Cần Thơ và các tỉnh Đồng bằng Sông Cửu Long.
            </p>
        </section>

        <!-- ==================== BẠN CẦN EKIP CHO VIỆC GÌ? ==================== -->
        <section class="flex flex-col gap-6">
            <div class="border-b border-slate-200 pb-3 flex flex-col sm:flex-row sm:items-end justify-between gap-2">
                <div>
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Mục đích tác nghiệp</span>
                    <h2 class="text-xl sm:text-2xl font-bold text-[#070f1e] tracking-tight mt-1">
                        Bạn Cần Ekip Cho Việc Gì?
                    </h2>
                </div>
                <span class="text-xs text-slate-500">3 nhóm nhu cầu phổ biến nhất</span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Quay phim -->
                <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-sm space-y-3">
                    <span class="text-xs font-bold text-primary">01</span>
                    <h3 class="text-base font-bold text-[#070f1e]">Quay Phim Doanh Nghiệp</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Ghi hình phỏng vấn chuyên gia, quay tư liệu cơ sở sản xuất, phóng sự doanh nghiệp và clip ngắn truyền thông nội bộ chuẩn 4K.
                    </p>
                    <div class="text-xs text-slate-500 pt-2 border-t border-slate-100">
                        Thiết bị: Máy quay Sony FX series, Gimbal chống rung, Microphone 32-bit.
                    </div>
                </div>

                <!-- Chụp ảnh -->
                <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-sm space-y-3">
                    <span class="text-xs font-bold text-primary">02</span>
                    <h3 class="text-base font-bold text-[#070f1e]">Chụp Ảnh Profile &amp; Sản Phẩm</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Chụp ảnh chân dung lãnh đạo, đội ngũ nhân sự chủ chốt, không gian văn phòng và chi tiết sản phẩm phục vụ catalog/website.
                    </p>
                    <div class="text-xs text-slate-500 pt-2 border-t border-slate-100">
                        Xử lý hậu kỳ màu sắc chuẩn nhận diện, bàn giao file gốc và file tối ưu web.
                    </div>
                </div>

                <!-- Sự kiện -->
                <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-sm space-y-3">
                    <span class="text-xs font-bold text-primary">03</span>
                    <h3 class="text-base font-bold text-[#070f1e]">Tác Nghiệp Sự Kiện &amp; Hội Nghị</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Ghi hình hội thảo chuyên đề, lễ khởi công, khánh thành, lễ ký kết đối tác và tiệc kỷ niệm doanh nghiệp theo buổi hoặc trọn gói ngày.
                    </p>
                    <div class="text-xs text-slate-500 pt-2 border-t border-slate-100">
                        Có mặt trước giờ G tối thiểu 45 phút để thiết lập âm thanh và góc máy.
                    </div>
                </div>
            </div>
        </section>

        <!-- ==================== QUY TRÌNH BOOKING ==================== -->
        <section class="p-8 rounded-2xl bg-white border border-slate-200/90 shadow-sm flex flex-col gap-6">
            <div class="border-b border-slate-100 pb-3">
                <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Quy chuẩn điều phối</span>
                <h2 class="text-xl sm:text-2xl font-bold text-[#070f1e] tracking-tight mt-1">
                    Quy Trình Booking 4 Bước
                </h2>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="space-y-1.5">
                    <span class="text-base font-bold text-primary">01</span>
                    <h3 class="text-sm font-bold text-[#070f1e]">Tiếp nhận yêu cầu</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Ghi nhận thời gian, địa điểm, thời lượng sự kiện và số lượng nhân sự/máy quay cần thiết.
                    </p>
                </div>
                <div class="space-y-1.5">
                    <span class="text-base font-bold text-primary">02</span>
                    <h3 class="text-sm font-bold text-[#070f1e]">Lên phương án &amp; Báo giá</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Tư vấn cấu hình thiết bị phù hợp không gian sự kiện và gửi bảng dự toán rõ ràng trong 2 giờ.
                    </p>
                </div>
                <div class="space-y-1.5">
                    <span class="text-base font-bold text-primary">03</span>
                    <h3 class="text-sm font-bold text-[#070f1e]">Tác nghiệp hiện trường</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Ekip có mặt đúng giờ, trang phục lịch sự, thực hiện bấm máy theo timeline đã thống nhất.
                    </p>
                </div>
                <div class="space-y-1.5">
                    <span class="text-base font-bold text-primary">04</span>
                    <h3 class="text-sm font-bold text-[#070f1e]">Hậu kỳ &amp; Bàn giao</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Sao lưu dữ liệu an toàn, tiến hành chọn lọc, chỉnh sửa màu sắc và bàn giao qua đám mây.
                    </p>
                </div>
            </div>
        </section>

        <!-- ==================== FORM ĐẶT LỊCH EKIP ==================== -->
        <section class="p-8 rounded-2xl bg-white border border-slate-200/90 shadow-sm flex flex-col gap-6">
            <div class="border-b border-slate-100 pb-3">
                <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Gửi thông tin</span>
                <h2 class="text-xl sm:text-2xl font-bold text-[#070f1e] tracking-tight mt-1">
                    Đăng Ký Điều Động Ekip
                </h2>
                <p class="text-xs text-slate-500 mt-1">Điền thông tin sự kiện để chuyên viên điều phối liên hệ xác nhận lịch khả dụng.</p>
            </div>

            <form action="{{ route('contact.submit') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-5">
                @csrf
                <input type="hidden" name="service_interested" value="booking-media">
                <input type="hidden" name="message" :value="generateMessage()">

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">Họ và tên người liên hệ <span class="text-rose-500">*</span></label>
                    <input type="text" name="fullname" x-model="fullName" required placeholder="Ví dụ: Nguyễn Văn A"
                        class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">Số điện thoại liên hệ <span class="text-rose-500">*</span></label>
                    <input type="tel" name="phone" x-model="phone" required placeholder="Ví dụ: 0939 123 456"
                        class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">Ngày dự kiến tác nghiệp <span class="text-rose-500">*</span></label>
                    <input type="date" x-model="eventDate" required
                        class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">Địa điểm tổ chức <span class="text-rose-500">*</span></label>
                    <select x-model="eventLocation" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none">
                        <option value="Cần Thơ">TP. Cần Thơ</option>
                        <option value="Hậu Giang">Tỉnh Hậu Giang</option>
                        <option value="Vĩnh Long">Tỉnh Vĩnh Long</option>
                        <option value="An Giang">Tỉnh An Giang</option>
                        <option value="Đồng Tháp">Tỉnh Đồng Tháp</option>
                        <option value="Tỉnh khác">Tỉnh thành khác</option>
                    </select>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">Nhu cầu cụ thể</label>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                        <label class="flex items-center gap-2 p-3 rounded-xl border border-slate-200 cursor-pointer hover:bg-slate-50">
                            <input type="radio" name="crew_choice" value="video" x-model="crewType" class="text-primary focus:ring-primary">
                            <span class="text-xs font-semibold text-slate-700">Quay phim</span>
                        </label>
                        <label class="flex items-center gap-2 p-3 rounded-xl border border-slate-200 cursor-pointer hover:bg-slate-50">
                            <input type="radio" name="crew_choice" value="photo" x-model="crewType" class="text-primary focus:ring-primary">
                            <span class="text-xs font-semibold text-slate-700">Chụp ảnh</span>
                        </label>
                        <label class="flex items-center gap-2 p-3 rounded-xl border border-slate-200 cursor-pointer hover:bg-slate-50">
                            <input type="radio" name="crew_choice" value="both" x-model="crewType" class="text-primary focus:ring-primary">
                            <span class="text-xs font-semibold text-slate-700">Cả quay &amp; chụp</span>
                        </label>
                    </div>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">Ghi chú thêm (khung giờ, thời lượng sự kiện)</label>
                    <textarea x-model="notes" rows="3" placeholder="Ví dụ: Sự kiện khai trương từ 8h - 11h sáng..."
                        class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none"></textarea>
                </div>

                <div class="md:col-span-2 pt-2">
                    <button type="submit" class="w-full py-3 rounded-xl bg-[#070f1e] hover:bg-slate-800 text-white text-xs font-semibold shadow-sm transition-all flex items-center justify-center gap-2 cursor-pointer">
                        <span>Gửi yêu cầu điều phối ekip</span>
                        <span class="material-symbols-outlined text-[16px] text-amber-400">arrow_forward</span>
                    </button>
                </div>
            </form>
        </section>

    </x-ui.container>
</div>
@endsection
