@extends('layouts.app')

@section('title', 'Điều Khoản Dịch Vụ & Cam Kết SLA - Truyền Thông Cửu Long')
@section('meta_description', 'Điều khoản dịch vụ, cam kết chất lượng sản phẩm (SLA 99.9%) và quy định sở hữu trí tuệ tại Truyền Thông Cửu Long.')

@section('content')
<div class="w-full bg-surface bg-dot-grid-subtle pt-28 pb-20 border-b border-slate-200/60">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="mb-10 pb-6 border-b border-slate-200">
            <span class="font-mono text-xs text-primary font-bold uppercase tracking-wider">SERVICE LEVEL AGREEMENT &amp; TERMS</span>
            <h1 class="font-headline text-3xl sm:text-4xl font-extrabold text-navy-base mt-2">
                Điều Khoản Dịch Vụ &amp; Cam Kết Chất Lượng (SLA)
            </h1>
            <p class="font-mono text-xs text-slate-500 mt-2">Áp dụng cho toàn bộ hợp đồng sản xuất truyền thông và giải pháp số • Giấy phép ICP số 188/GP-BTTTT</p>
        </div>

        <div class="prose prose-slate max-w-none text-slate-700 leading-relaxed font-body text-sm
            prose-headings:font-headline prose-headings:font-bold prose-headings:text-navy-base
            prose-h2:text-xl prose-h2:mt-8 prose-h2:mb-3 prose-h3:text-base">
            
            <h2>1. Thỏa Thuận Dịch Vụ Khách Hàng (SLA)</h2>
            <p>Mọi dự án do Truyền Thông Cửu Long thực hiện đều được ràng buộc bởi các cam kết chất lượng chuẩn hóa:</p>
            <ul>
                <li><strong>Hạ tầng phần mềm &amp; Cloud:</strong> Cam kết thời gian hoạt động trực tuyến (Uptime SLA) đạt tối thiểu <strong>99.9%</strong>. Thời gian phản hồi sự cố khẩn cấp &lt; 30 phút (24/7).</li>
                <li><strong>Sản xuất hình ảnh &amp; TVC:</strong> Bàn giao bản dựng đúng hạn theo thỏa thuận tiến độ hợp đồng. Hỗ trợ chỉnh sửa miễn phí tối thiểu 02 vòng theo biên bản nghiệm thu kỹ thuật.</li>
                <li><strong>Bảo mật thông tin dự án:</strong> Ký kết thỏa thuận bảo mật NDA trước khi tiếp nhận tài liệu mật hoặc thông tin kinh doanh của khách hàng.</li>
            </ul>

            <h2>2. Quyền Sở Hữu Trí Tuệ &amp; Bản Quyền</h2>
            <p>
                Sau khi hoàn tất nghĩa vụ thanh toán theo hợp đồng, khách hàng có toàn quyền sở hữu bản quyền thành phẩm cuối cùng (Master Video 4K, mã nguồn source code website bàn giao). Truyền Thông Cửu Long giữ quyền sử dụng hình ảnh thành phẩm để phục vụ mục đích trưng bày năng lực (Portfolio &amp; Showreel) trừ khi có thỏa thuận bảo mật đặc biệt bằng văn bản.
            </p>

            <h2>3. Trách Nhiệm Thanh Toán &amp; Bàn Giao</h2>
            <p>
                Tiến độ thanh toán chuẩn được chia làm 3 đợt (Đặt cọc ký HĐ 40% - Duyệt tiền kỳ/giao diện nháp 30% - Nghiệm thu bàn giao 30%) hoặc theo điều khoản ghi nhận cụ thể trên hợp đồng kinh tế.
            </p>

            <h2>4. Hỗ Trợ Kỹ Thuật &amp; Giải Quyết Tranh Chấp</h2>
            <p>
                Bộ phận kỹ thuật và pháp chế Truyền Thông Cửu Long luôn sẵn sàng hỗ trợ giải quyết mọi thắc mắc của Quý khách hàng thông qua email chính thức: <strong>{{ get_setting('company_email', 'info@truyenthongcuulong.com') }}</strong> hoặc hotline <strong>{{ get_setting('company_phone', '0939 363 262') }}</strong>.
            </p>
        </div>

    </div>
</div>
@endsection

