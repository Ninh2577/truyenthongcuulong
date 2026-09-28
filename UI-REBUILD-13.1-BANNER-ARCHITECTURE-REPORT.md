# BÁO CÁO ĐẶC TẢ KIẾN TRÚC BANNER & HỆ THỐNG THỊ GIÁC (UI-REBUILD-13.1)
**Dự án:** Website Doanh Nghiệp Truyền Thông Cửu Long  
**Vai trò:** Senior UI/UX Designer & Senior Laravel Frontend Architect  
**Môi trường:** Laravel 11, Blade, Tailwind CSS, Typography Mulish  
**Định vị thương hiệu:** Professional Software Engineering Company / B2B Technology Partner (Tỷ trọng: 85% Technology, 15% Media)  
**Ngày thực hiện:** 28/09/2026  
**Trạng thái:** HOÀN THÀNH KHẢO SÁT & ĐẶC TẢ (PASS WITH NOTES)

---

## MỤC LỤC
1. [PHẦN A — HIỆN TRẠNG TOÀN BỘ CÁC ROUTE CÔNG KHAI](#phần-a--hiện-trạng-toàn-bộ-các-route-công-khai)
2. [PHẦN B — BANNER MATRIX (MA TRẬN BANNER TOÀN HỆ THỐNG)](#phần-b--banner-matrix-ma-trận-banner-toàn-hệ-thống)
3. [PHẦN C — QUY CHUẨN THIẾT KẾ BANNER (DESIGN SPECIFICATION)](#phần-c--quy-chuẩn-thiết-kế-banner-design-specification)
4. [PHẦN D — ĐẶC TẢ KỸ THUẬT BLADE COMPONENT (TECHNICAL SPECIFICATION)](#phần-d--đặc-tả-kỹ-thuật-blade-component-technical-specification)
5. [PHẦN E — LỘ TRÌNH TRIỂN KHAI (IMPLEMENTATION ROADMAP)](#phần-e--lộ-trình-triển-khai-implementation-roadmap)
6. [PHẦN F — NGHIỆM THU & GIỚI HẠN KHẢO SÁT (ACCEPTANCE STATEMENT)](#phần-f--nghiệm-thu--giới-hạn-khảo-sát-acceptance-statement)

---

## PHẦN A — HIỆN TRẠNG TOÀN BỘ CÁC ROUTE CÔNG KHAI

Khảo sát được thực hiện trên toàn bộ các route công khai đã đăng ký trong `routes/web.php`, phân tích cấu trúc DOM đầu trang, khối Hero, ảnh nền, và các khối chuyển đổi CTA cuối trang.

| Route | Loại trang | Cấu trúc đầu trang hiện tại | Banner có hay chưa | Vấn đề quan sát được | Mức độ ưu tiên | Bằng chứng từ Source Code |
| :--- | :--- | :--- | :--- | :--- | :---: | :--- |
| `/` (`home`) | Trang chủ | Hero chia 2 cột: Cột trái (H1, Eyebrow, 2 CTA, 3 USP tags); Cột phải (Interactive Terminal Console Mockup) | **ĐÃ CÓ** (Homepage Hero) | Console bên phải tạo cảm giác công nghệ nhưng chưa có ảnh chụp đội ngũ/hệ thống thực tế; trên mobile chiếm diện tích dọc lớn (khoảng cách cuộn dài). | **P2** | `resources/views/components/home/hero.blade.php`: L1-L188 (`min-h-[580px] lg:min-h-[640px]`, mockup console interactive) |
| `/dich-vu` (`services.index`) | Service Hub | Căn giữa 1 cột text-only (`max-w-4xl mx-auto text-center`), breadcrumb, badge, H1, subtext, 2 nút CTA | **CHƯA CÓ** (Text-only header) | Không có yếu tố trực quan (visual anchor). Trang trông đơn điệu và nặng tính văn bản, thiếu sơ đồ tổng quan về hệ sinh thái giải pháp. | **P1** | `resources/views/services/index.blade.php`: L18-L44 (`section class="max-w-4xl mx-auto text-center..."`) |
| `/dich-vu/web-app` (`services.web-app`) | Dịch vụ chính (85% Tech) | Căn giữa 1 cột text-only, breadcrumb, badge, H1, 2 nút CTA | **CHƯA CÓ** (Text-only header) | Là dịch vụ trọng tâm nhưng đầu trang thiếu visual minh chứng (kiến trúc microservice, sơ đồ luồng dữ liệu hoặc mockup giao diện web app thực tế). | **P1** | `resources/views/services/web-app.blade.php`: L19-L42 (`section class="max-w-4xl mx-auto text-center..."`) |
| `/dich-vu/kho-giao-dien` (`templates.index`) | Thư viện sản phẩm | Căn giữa 1 cột text-only kèm thanh tìm kiếm input (`max-w-md`) | **CHƯA CÓ** (Text-only + Search) | Thiếu preview visual sống động thể hiện sự đa dạng của kho 106+ template theo ngành nghề trước khi người dùng cuộn xuống bộ lọc. | **P2** | `resources/views/templates/index.blade.php`: L33-L58 (`section class="max-w-4xl mx-auto text-center..."`) |
| `/dich-vu/bang-gia` (`pricing`) | Trang bảng giá | Căn giữa 1 cột text-only, badge, H1, subtext, tag ghi chú | **CHƯA CÓ** (Text-only header) | Không cần banner ảnh lớn vì người dùng vào trang này để so sánh số liệu, nhưng phần đầu trang đang hơi rời rạc, thiếu visual hierarchy cho 3 khung giá. | **P3** | `resources/views/pages/pricing.blade.php`: L18-L35 (`section class="max-w-4xl mx-auto text-center..."`) |
| `/dich-vu/marketing` (`services.marketing`) | Dịch vụ bổ trợ (SEO/Digital) | Căn giữa 1 cột text-only, badge, H1, 2 nút CTA | **CHƯA CÓ** (Text-only header) | Thiếu sơ đồ trực quan minh họa luồng tăng trưởng dữ liệu On-page/Search Visibility. | **P2** | `resources/views/services/marketing.blade.php`: L19-L45 (`section class="max-w-4xl mx-auto text-center..."`) |
| `/dich-vu/media` (`services.media`) | Dịch vụ Media (15% Media) | Căn giữa 1 cột text-only, nút xem Showreel (mở YouTube Modal) | **CHƯA ĐỦ** (Thiếu media visual backdrop) | Là trang dịch vụ Media & Video nhưng đầu trang không có video cover hoặc ảnh trường quay/thiết bị thực tế, phải bấm modal mới thấy video. | **P1** | `resources/views/services/media.blade.php`: L32-L58 (Chỉ có nút trigger modal `openVideo()`) |
| `/dich-vu/booking` (`booking`) | Trang tác nghiệp ekip | Căn giữa 1 cột text-only, badge, H1, subtext | **CHƯA CÓ** (Text-only header) | Người dùng cần hình dung được quy mô ekip (camera, drone, đạo diễn) thông qua hình ảnh tác nghiệp thực tế tại ĐBSCL. | **P2** | `resources/views/services/booking.blade.php`: L37-L52 (`section class="max-w-4xl mx-auto text-center..."`) |
| `/du-an` (`projects.index`) | Danh mục Portfolio | Small Hero nền sáng `bg-surface-low`, breadcrumb, badge nhấp nháy, H1, subtext | **CHƯA CÓ** (Text header nền grid) | Danh mục dự án chưa có Featured Case Study Banner nổi bật ở vị trí trên nếp gấp (above the fold). | **P2** | `resources/views/projects/index.blade.php`: L39-L65 (`section class="relative w-full overflow-hidden pt-28 pb-14..."`) |
| `/du-an/{slug}` (`projects.show`) | Chi tiết Case Study | Section Hero nền sáng `bg-surface-low`, breadcrumb, H1, Project Meta Strip (Khách hàng, năm, trạng thái) | **ĐÃ CÓ METADATA STRIP** (Chưa có Hero Visual Cover) | Trang chi tiết dự án công nghệ (`tech_gia_phuoc`, `tech_nu_cuoi`) có metadata rất tốt nhưng thiếu banner cover mockup/screenshot giao diện thực tế trước khi đọc phân tích kỹ thuật. | **P1** | `resources/views/projects/partials/tech_gia_phuoc.blade.php`: L8-L58; `media_show.blade.php`: L7-L65 |
| `/bai-viet` (`blog.index`) | Tạp chí kiến thức | Header 2 cột: Cột trái (H1, badge, mô tả); Cột phải (Live search input) | **KHÔNG CẦN BANNER ẢNH** | Cấu trúc hiện tại rất chuẩn mực cho trang tin tức/tạp chí chuyên ngành, ưu tiên không gian cho tìm kiếm và danh sách bài viết. | **P3** | `resources/views/blog/index.blade.php`: L11-L60 |
| `/{slug}` (`blog.show`) | Chi tiết bài viết | Breadcrumb, chuyên mục badge, H1, tác giả & ngày đăng, Featured Image lớn trong bài | **ĐÃ CÓ TIÊU CHUẨN** | Khối tiêu đề bài viết gọn gàng, ảnh đại diện bài viết đóng vai trò visual chính. Không nên chèn banner lớn làm đẩy nội dung bài viết xuống sâu. | **HỢP LÝ** | `resources/views/blog/show.blade.php`: L20-L80 |
| `/ve-chung-toi` (`about`) | Trang giới thiệu | Small Hero nền sáng kết hợp film-grain và ambient blur, H1, lead text, nút CTA | **ĐÃ CÓ** (Brand Narrative Banner) | Đã có bố cục chuẩn câu chuyện thương hiệu kết hợp phim & công nghệ, tuy nhiên khoảng cách dọc trên mobile hơi lớn. | **P3** | `resources/views/pages/about.blade.php`: L19-L65 |
| `/doi-tac` (`partners`) | Đối tác chiến lược | 2 cột: Cột trái (H1, 3 Stat Cards); Cột phải (Hệ sinh thái đối tác) | **ĐÃ CÓ** (Data & Partner Hero) | Đã hoàn thiện ở UI-REBUILD-11 & 12 với hiệu ứng kim loại tiết chế, tương phản đạt chuẩn WCAG. | **HỢP LÝ** | `resources/views/pages/partners.blade.php`: L152-L210 |
| `/khach-hang` (`clients`) | Khách hàng tiêu biểu | Header nền sáng, breadcrumb, H1, filter tabs phân loại | **KHÔNG CẦN BANNER ẢNH** | Header tinh gọn, tập trung hiển thị lưới logo khách hàng và nhận xét thực tế. | **HỢP LÝ** | `resources/views/pages/clients.blade.php`: L15-L65 |
| `/quy-trinh` (`process`) | Quy trình 6 bước | Căn giữa 1 cột text-only, badge "HOW WE BUILD", H1, subtext, 2 nút CTA | **CHƯA CÓ** (Text-only header) | Đầu trang thiếu sơ đồ trực quan thu nhỏ (mini-timeline/milestone bar) trước khi vào chi tiết 6 bước. | **P2** | `resources/views/pages/process.blade.php`: L18-L43 |
| `/ho-so-nang-luc` (`profile`) | E-Profile trực tuyến | Full Cover Hero nền tối rạp chiếu (`min-h-[92vh]`), ảnh hậu trường thực tế, Dragon Crest, H1 lớn | **ĐÃ CÓ** (Cover Hero Đầy Đủ) | Trang Scrollytelling đã có Hero Cover chuyên biệt rất ấn tượng, hình ảnh `real-cameraman-production.jpg` thực tế. | **HỢP LÝ** | `resources/views/profile.blade.php`: L21-L70 |
| `/lien-he` (`contact`) | Trang liên hệ | Small Hero nền sáng, breadcrumb, badge, H1 gradient, subtext | **KHÔNG CẦN BANNER ẢNH** | Header tinh gọn giúp form gửi yêu cầu và thông tin văn phòng hiển thị ngay lập tức trong màn hình đầu tiên. | **HỢP LÝ** | `resources/views/contact.blade.php`: L8-L36 |
| Toàn bộ trang con (Chuyển đổi cuối trang) | CTA Banner cuối trang | Không đồng nhất: Một số trang dùng card nền tối, một số trang dùng nền sáng, một số trang chỉ có nút | **KHÔNG ĐỒNG BỘ** | Thiếu một chuẩn component CTA Banner thống nhất cho toàn bộ các trang con để định hướng chuyển đổi về `/lien-he`. | **P1** | `resources/views/components/home/cta.blade.php` (chuẩn trên Home), các trang con dùng inline markup không đồng bộ |

---

## PHẦN B — BANNER MATRIX (MA TRẬN BANNER TOÀN HỆ THỐNG)

| Trang | Cần Banner? | Nhóm Banner | Mục tiêu chuyển đổi & Trải nghiệm | Nội dung chính | Visual Asset đề xuất | CTA chính & phụ | Tỷ lệ & Responsive |
| :--- | :---: | :---: | :--- | :--- | :--- | :--- | :--- |
| **Trang chủ (`/`)** | **CÓ** | **Nhóm A: Homepage Hero** | Định vị Cửu Long là Công ty Kỹ thuật Phần mềm B2B (85% Tech, 15% Media bổ trợ) | **H1:** Xây Dựng Phần Mềm & Nền Tảng Số Cho Doanh Nghiệp<br>**Sub:** Thiết kế, phát triển và vận hành Web App, Website, Hệ thống quản trị | Tech Architecture Slot: Giao diện console tương tác / Mockup kiến trúc hệ thống thực tế | **CTA 1:** Bắt đầu dự án (`/lien-he`)<br>**CTA 2:** Xem giải pháp (`/dich-vu`) | Desktop: 16:9 / Min 580px<br>Tablet: Min 480px<br>Mobile: Tự co giãn theo nội dung, max 420px |
| **Dịch vụ Hub (`/dich-vu`)** | **CÓ** | **Nhóm B: Service Hero (Split)** | Cung cấp cái nhìn toàn cảnh về 4 trụ cột kỹ thuật số của Cửu Long | **H1:** Giải Pháp Công Nghệ & Nền Tảng Số Vận Hành<br>**Sub:** Web App, Website, SEO kỹ thuật và Media tư liệu | Sơ đồ khối kiến trúc hệ thống tích hợp (System Architecture Map) | **CTA 1:** Trao đổi bài toán<br>**CTA 2:** Xem dự án thực tế | Desktop: 21:9 hoặc Split 7:5<br>Mobile: 1 cột xếp chồng |
| **Web App (`/dich-vu/web-app`)** | **CÓ** | **Nhóm B: Service Hero (Split)** | Khẳng định năng lực kỹ thuật phần mềm phức tạp, xóa bỏ định kiến "chỉ làm web đơn giản" | **H1:** Web App & Hệ Thống Quản Trị Nghiệp Vụ Chuyên Sâu<br>**Sub:** Số hóa luồng công việc, chuẩn hóa CSDL, chịu tải cao | Sơ đồ luồng dữ liệu 4 tầng (Client - API - Logic - Database) thực tế | **CTA 1:** Tư vấn kỹ thuật<br>**CTA 2:** Xem kiến trúc mẫu | Desktop: Split 7:5, cao 480px<br>Mobile: Thu gọn sơ đồ trực quan |
| **Kho giao diện (`/dich-vu/kho-giao-dien`)** | **CÓ** | **Nhóm C: Product Visual** | Tăng độ tin cậy vào chất lượng và tốc độ triển khai 106+ template | **H1:** Nền Tảng Khởi Tạo Website Doanh Nghiệp Tốc Độ Cao<br>**Sub:** Cấu trúc chuẩn SEO, thiết kế theo ngành, sẵn sàng vận hành | Khung hiển thị mockup 3 thiết bị (Desktop - Tablet - Mobile) của template tiêu biểu | **CTA 1:** Tìm theo ngành<br>**CTA 2:** Yêu cầu demo | Desktop: Banner ngang 16:7<br>Mobile: Carousel preview nhỏ gọn |
| **Bảng giá (`/dich-vu/bang-gia`)** | **KHÔNG** | **Text-Header tinh gọn** | Minh bạch chi phí, giúp khách hàng đi thẳng vào bảng so sánh 3 khung giá | **H1:** Khung Chi Phí Phát Triển Minh Bạch Theo Phạm Vi<br>**Sub:** Không chi phí ẩn, nghiệm thu theo mốc tính năng | Không dùng ảnh lớn. Chỉ dùng Icon badge và nhãn phân biệt chuẩn | **CTA:** Tải bảng đặc tả chi phí | Không chiếm quá 280px chiều dọc màn hình đầu tiên |
| **Marketing / SEO (`/dich-vu/marketing`)** | **CÓ** | **Nhóm B: Service Hero (Compact)** | Nhấn mạnh năng lực SEO kỹ thuật (Technical SEO) và dữ liệu tìm kiếm thực tế | **H1:** Tối Ưu SEO Kỹ Thuật & Cấu Trúc Hiện Diện Tìm Kiếm<br>**Sub:** Tăng trưởng bền vững dựa trên dữ liệu thật | Diagram thể hiện phễu chuyển đổi từ Google Search -> On-page -> Lead | **CTA 1:** Kiểm tra website<br>**CTA 2:** Xem lộ trình SEO | Desktop: 16:8<br>Mobile: Sơ đồ 1 cột dọc |
| **Media (`/dich-vu/media`)** | **CÓ** | **Nhóm D: Media Visual** | Thể hiện năng lực 15% Media bổ trợ: thiết bị hiện đại, tác nghiệp điện ảnh chuyên nghiệp | **H1:** Sản Xuất Tư Liệu Video & Hình Ảnh Doanh Nghiệp<br>**Sub:** Nền tảng tư liệu chân thực cho hệ sinh thái số | Video loop ngầm (hoặc ảnh chụp trường quay thực tế tỷ lệ 16:9 với lớp phủ scrim chuẩn) | **CTA 1:** Đặt lịch sản xuất<br>**CTA 2:** Xem Showreel (Modal) | Desktop: 16:9 hoặc 21:9<br>Tablet/Mobile: 16:9 responsive |
| **Booking Ekip (`/dich-vu/booking`)** | **CÓ** | **Nhóm D: Media Visual** | Thúc đẩy đặt lịch ekip quay chụp nhanh tại ĐBSCL | **H1:** Điều Phối Ekip Tác Nghiệp Media Chuyên Nghiệp<br>**Sub:** Nhân sự in-house, thiết bị 4K, phục vụ Cần Thơ & Tây Nam Bộ | Ảnh chụp ekip thật tại hiện trường sự kiện (Không dùng stock nước ngoài) | **CTA 1:** Chọn ngày tác nghiệp<br>**CTA 2:** Xem danh mục thiết bị | Desktop: 16:8<br>Mobile: Ảnh banner phía trên form |
| **Dự án Hub (`/du-an`)** | **CÓ** | **Nhóm C: Product & Case Study Visual** | Tạo sự tin tưởng ngay lập tức bằng dự án thực tế nổi bật nhất | **H1:** Dự Án Thực Tế & Bằng Chứng Năng Lực Triển Khai<br>**Sub:** Các bài toán vận hành đã được giải quyết thành công | Featured Case Study Card lớn: Ảnh mockup sản phẩm thật + số liệu kiến trúc | **CTA 1:** Xem Case Study tiêu biểu<br>**CTA 2:** Lọc theo ngành | Desktop: Khung 16:9 bo tròn nổi bật<br>Mobile: Card đơn full-width |
| **Chi tiết Case Study (`/du-an/{slug}`)** | **CÓ** | **Nhóm C: Product Visual Cover** | Cung cấp bối cảnh trực quan của sản phẩm trước khi đọc báo cáo kỹ thuật | **H1:** Tên dự án thực tế<br>**Sub:** Bối cảnh khách hàng, thời gian triển khai, nhóm giải pháp | Ảnh chụp màn hình giao diện hệ thống thật trên khung thiết bị phẳng (Flat Device Frame) | **CTA 1:** Xem luồng kiến trúc<br>**CTA 2:** Tư vấn bài toán tương tự | Tỷ lệ 16:9 hoặc 16:10 sắc nét, không dùng ảnh mờ |
| **Quy trình (`/quy-trinh`)** | **CÓ** | **Nhóm B: Service Hero (Timeline)** | Minh bạch phương pháp làm việc kỹ thuật cao của Cửu Long | **H1:** Quy Trình 6 Bước Triển Khai Phần Mềm Chuẩn Mực<br>**Sub:** Rõ ràng từng mốc nghiệm thu kỹ thuật và bàn giao source code | Mini Step-Indicator trực quan (Khảo sát -> Kiến trúc -> UI/UX -> Dev -> QA -> Bàn giao) | **CTA 1:** Bắt đầu dự án<br>**CTA 2:** Xem cam kết SLA | Desktop: Chiều cao tối đa 380px<br>Mobile: Step badges co giãn |
| **Cuối trang các trang con (Footer CTA)** | **CÓ** | **Nhóm E: Standardized CTA Banner** | Định hướng mọi hành vi tìm hiểu dịch vụ về trang Liên hệ để tạo Lead | **H2:** Sẵn sàng số hóa quy trình và xây dựng nền tảng số chuẩn mực?<br>**Sub:** Nhận tư vấn kiến trúc kỹ thuật và giải pháp phù hợp | Nền xanh đậm thương hiệu (`#070F1E` / `#0C1A30`), họa tiết lưới kỹ thuật tinh tế | **CTA 1:** Gửi yêu cầu tư vấn<br>**CTA 2:** Gọi hotline kỹ thuật | Desktop: Chiều cao 240px - 280px<br>Mobile: Padding dọc 48px, nút full-width |

---

## PHẦN C — QUY CHUẨN THIẾT KẾ BANNER (DESIGN SPECIFICATION)

Để đảm bảo tính nhất quán trên toàn hệ thống và loại bỏ sự chắp vá, hệ thống banner được quy chuẩn theo các thông số thiết kế nghiêm ngặt sau:

### 1. Kích Thước & Chiều Cao Banner (Dimension Standards)
* **Nhóm A (Homepage Hero):**
  * Desktop (>= 1024px): `min-height: 580px; max-height: 680px;` (đảm bảo hiển thị trọn vẹn thông điệp và console mockup trên màn hình 1080p).
  * Tablet (768px – 1023px): `min-height: 480px;`
  * Mobile (< 768px): Tự động co giãn theo nội dung (`height: auto`), padding dọc `pt-28 pb-16`, tránh cố định chiều cao gây tràn chữ.
* **Nhóm B & C (Service & Case Study Hero):**
  * Desktop (>= 1024px): `height: 420px – 500px` (nếu có visual bên phải) hoặc padding dọc `pt-32 pb-16` (nếu dạng căn giữa).
  * Tablet: `height: 360px – 420px`.
  * Mobile: Padding dọc `pt-28 pb-12`, visual chuyển xuống dưới nội dung văn bản.
* **Nhóm D (Media Visual Hero):**
  * Desktop: Tỷ lệ khung hình chuẩn điện ảnh `16:9` hoặc `21:9` với `max-height: 520px`.
  * Mobile: Tỷ lệ cố định `16:9` để tránh crop mất góc máy quay phim.
* **Nhóm E (CTA Banner cuối trang):**
  * Desktop: Padding dọc `py-16 lg:py-20` (chiều cao tự nhiên khoảng 260px – 320px).
  * Mobile: Padding dọc `py-12`, căn giữa toàn bộ.

### 2. Tỷ Lệ Ảnh Khuyến Nghị (Aspect Ratio Tokens)
* `aspect-video` (`16:9`): Dùng cho Media Cover, Showreel Video, Video Backdrop.
* `aspect-[16/10]`: Dùng cho Mockup Web App, Dashboard và Ảnh chụp Case Study Kỹ thuật.
* `aspect-[4/3]`: Dùng cho ảnh chụp Ekip tác nghiệp trên thiết bị di động.
* `aspect-[21/9]`: Dùng cho Panoramic Banner trên màn hình Ultra-wide.

### 3. Quy Chuẩn Typography & Độ Dài Nội Dung (Mulish Font)
* Giữ nguyên font chữ **Mulish** (`var(--font-primary)`) làm nền tảng duy nhất, kết hợp font bổ trợ JetBrains Mono (`font-mono`) cho các nhãn kỹ thuật (eyebrow, code tags).
* **Tiêu đề Banner (H1):**
  * Desktop: `text-3xl sm:text-4xl lg:text-5xl` (36px - 48px), `font-extrabold`, `tracking-tight`, line-height `1.15 – 1.2`.
  * Mobile: `text-2xl sm:text-3xl` (24px - 30px), ngắt dòng tự nhiên.
  * Độ dài tiêu chuẩn: **Dưới 65 ký tự** (khoảng 8 – 14 từ tiếng Việt). Tuyệt đối không dùng H1 dài quá 3 dòng trên desktop.
* **Mô tả phụ (Subtitle / Lead):**
  * Desktop: `text-sm sm:text-base lg:text-lg` (15px - 18px), `font-normal`, màu `text-slate-600` (nền sáng) hoặc `text-slate-300` (nền tối).
  * Độ dài tiêu chuẩn: **2 – 3 dòng** (khoảng 140 – 200 ký tự). Tránh viết đoạn văn dài trên banner.
* **Eyebrow / Category Badge:**
  * Kích thước: `text-xs font-bold font-mono uppercase tracking-wider`.
  * Padding: `px-3.5 py-1 rounded-full`.
  * Không sử dụng chữ in hoa cho toàn bộ tiêu đề H1; chỉ dùng in hoa cho nhãn Eyebrow kỹ thuật.

### 4. Bảng Màu & Độ Tương Phản (Color & Contrast Rules)
Tuân thủ nghiêm ngặt chuẩn WCAG 2.1 AA (Tỷ lệ tương phản tối thiểu 4.5:1 đối với văn bản thông thường, 3:1 đối với tiêu đề lớn):
* **Nền Sáng (Áp dụng cho 90% trang con):**
  * Màu nền chính: `bg-[#f8f9ff]` hoặc `bg-surface-low` (`#f1f5f9` / `#f8fafc`).
  * Màu chữ tiêu đề: `#070F1E` (Dark Navy - Contrast ratio > 12:1 trên nền trắng).
  * Màu chữ mô tả: `#475569` (Slate-600 - Contrast ratio > 5.5:1).
  * Viền phân tách: `border-slate-200/80`.
* **Nền Tối (Áp dụng cho CTA cuối trang, Homepage Hero Dark và Media Reel):**
  * Màu nền chính: `#070F1E` kết hợp `#0C1A30` (Deep Tech Navy).
  * Màu chữ tiêu đề: `#FFFFFF` (Pure White).
  * Màu chữ mô tả: `#CBD5E1` (Slate-300).
* **Màu Nhấn (Accent & Brand Colors):**
  * Primary Orange: `#E05305` / `#C2410C` (nút hành động chính).
  * Amber Tech: `#F59E0B` / `#FBBF24` (chi tiết viền, icon điểm nhấn).
  * Tech Blue: `#0284C7` / `#38BDF8` (nhãn dữ liệu công nghệ).

### 5. Quy Chuẩn Nút Hành Động (CTA Rules)
* **CTA Chính (Primary):**
  * Giao diện: Nền tối đậm `#070F1E` với icon mũi tên màu hổ phách `text-amber-400` (hoặc nền cam `bg-primary` trên nền tối).
  * Bo góc: `rounded-xl` (12px), đệm `px-6 py-3.5`.
  * Font chữ: `text-xs sm:text-sm font-bold`.
  * Hiệu ứng: `hover:bg-slate-800 transition-all shadow-sm`. Không dùng animation giật lắc hoặc bounce gây khó chịu.
* **CTA Phụ (Secondary):**
  * Giao diện: Nền trắng `bg-white`, viền mảnh `border border-slate-200`, chữ `text-slate-700`.
  * Bo góc: Đồng bộ `rounded-xl`.
  * Hiệu ứng: `hover:border-slate-300 hover:text-primary transition-all`.
* **Quy tắc phân bổ:** Mỗi banner tối đa **1 CTA chính + 1 CTA phụ**. Không xếp quá 2 nút trên cùng một hàng trên màn hình di động hẹp (tự động xếp chồng dọc `flex-col sm:flex-row`).

### 6. Quy Tắc Bo Góc, Đổ Bóng & Hiệu Ứng (Surface Treatments)
* Bo góc: Khung hình minh họa và thẻ visual dùng `rounded-2xl` (16px) hoặc `rounded-3xl` (24px). Tuyệt đối không dùng bo góc không đồng bộ (`rounded-sm` lẫn lộn `rounded-3xl`).
* Đổ bóng: Tối giản, thanh lịch với `shadow-sm` hoặc `shadow-md` của Tailwind (`0 4px 6px -1px rgb(0 0 0 / 0.07)`). Không dùng đổ bóng đen đậm thô ráp.
* Hiệu ứng nền: Họa tiết lưới chấm mờ kỹ thuật (`bg-dot-grid-subtle`) với độ mờ nhẹ (opacity dưới 6%). Không dùng gradient màu mè chói mắt hoặc hiệu ứng kính mờ (glassmorphism) quá dày gây khó đọc chữ.

### 7. Quy Tắc Xử Lý Ảnh, Focal Point & Responsive
* **Focal Point:** Luôn thiết lập `object-cover object-center` (hoặc `object-top` đối với ảnh chụp giao diện phần mềm để không bị cắt mất thanh điều hướng).
* **Responsive Art Direction:**
  * Desktop: Ảnh hiển thị đầy đủ chi tiết với tỷ lệ `16:9` hoặc `16:10`.
  * Mobile: Tuyệt đối không để ảnh bị co méo; dùng thẻ `<picture>` hoặc thuộc tính `srcset` với kích thước ảnh đã tối ưu dung lượng WebP/AVIF.
* **Ảnh minh chứng thật:**
  * Trang Web App / Kho giao diện: Chỉ dùng ảnh chụp màn hình UI thật của hệ thống.
  * Trang Media / Booking: Chỉ dùng ảnh chụp đội ngũ làm việc, máy quay, flycam thực tế in-house. Không dùng stock doanh nhân bắt tay Tây phương xa lạ.

---

## PHẦN D — ĐẶC TẢ KỸ THUẬT BLADE COMPONENT (TECHNICAL SPECIFICATION)

Để đảm bảo khả năng tái sử dụng, code sạch và bảo trì dễ dàng, hệ thống banner sẽ được chuẩn hóa thành 2 Blade Component chính đặt trong thư mục `resources/views/components/banner/`:
1. `<x-banner.hero>` — Dùng cho tất cả các loại Hero đầu trang (A, B, C, D).
2. `<x-banner.cta>` — Dùng cho khối chuyển đổi cuối trang (E).

### 1. Cấu Trúc Thành Phần & Biến Thể (Component Variants)
Component `<x-banner.hero>` hỗ trợ các biến thể (`variant`):
* `service-split`: Bố cục 2 cột (Cột trái: Nội dung text + CTA; Cột phải: Visual Slot/Ảnh kiến trúc/Mockup).
* `service-centered`: Bố cục căn giữa truyền thống (Dành cho trang bảng giá, tra cứu hoặc trang nội dung đơn giản).
* `media-visual`: Bố cục tối ưu hiển thị khung hình điện ảnh hoặc video backdrop kèm nút Play modal.
* `case-study`: Bố cục chuyên biệt có dải Project Meta Strip (Khách hàng, năm, dịch vụ, trạng thái bàn giao).

### 2. Hợp Đồng Dữ Liệu (Props Contract)

#### A. Component `<x-banner.hero>`
```php
@props([
    'variant' => 'service-split', // 'service-split' | 'service-centered' | 'media-visual' | 'case-study'
    'eyebrow' => null,           // Nhãn kỹ thuật (VD: 'SOFTWARE ENGINEERING • WEB APPLICATIONS')
    'title' => '',               // Tiêu đề H1 chính
    'titleAccent' => null,       // Phần tiêu đề có màu nhấn/ngắt dòng
    'description' => '',         // Đoạn mô tả ngắn (2-3 dòng)
    'breadcrumb' => [],          // Mảng breadcrumb [['label' => '...', 'url' => '...']]
    'primaryCta' => null,        // ['label' => 'Bắt đầu', 'url' => route('contact'), 'icon' => 'arrow_forward']
    'secondaryCta' => null,      // ['label' => 'Xem dự án', 'url' => '#', 'icon' => 'schema']
    'image' => null,             // Đường dẫn ảnh chính (WebP)
    'imageMobile' => null,       // Đường dẫn ảnh tối ưu cho mobile (tùy chọn)
    'imageAlt' => '',            // Thuộc tính alt mô tả ngữ nghĩa ảnh (Bắt buộc cho SEO)
    'aspectRatio' => 'aspect-[16/10]', // 'aspect-video', 'aspect-[16/10]', 'aspect-[4/3]'
    'metaStrip' => null,         // Dành cho case study: [['label' => 'Khách hàng', 'value' => '...']]
    'isLcp' => false,            // Đánh dấu ảnh LCP quan trọng đầu trang
])
```

#### B. Component `<x-banner.cta>`
```php
@props([
    'title' => 'Bạn đang cần xây dựng một hệ thống phù hợp với doanh nghiệp?',
    'description' => 'Trao đổi với Cửu Long để làm rõ bài toán, phạm vi và hướng triển khai kỹ thuật.',
    'eyebrow' => 'BẮT ĐẦU DỰ ÁN • TƯ VẤN GIẢI PHÁP CÔNG NGHỆ',
    'primaryUrl' => route('contact'),
    'primaryLabel' => 'Gửi yêu cầu tư vấn',
    'secondaryUrl' => route('services.index'),
    'secondaryLabel' => 'Xem giải pháp công nghệ',
    'trustPoints' => [
        'Tư vấn kỹ thuật theo bài toán thực tế',
        'Đặc tả kiến trúc & lộ trình rõ ràng',
        'Bảo mật dữ liệu & cam kết chất lượng'
    ]
])
```

### 3. Tối Ưu Hiệu Năng: LCP, CLS & Tải Ảnh (Performance Engineering)
* **Chống Giật Layout (Zero CLS):**
  * Mọi khung chứa ảnh trong banner đều được ép tỷ lệ khung hình cố định thông qua các class Tailwind: `aspect-video`, `aspect-[16/10]` hoặc `aspect-[4/3]`.
  * Thẻ `<img>` luôn chứa thuộc tính `width`, `height` và `loading` tương ứng.
* **Tối Ưu Điểm LCP (Largest Contentful Paint):**
  * Với ảnh banner nằm trên nếp gấp màn hình đầu tiên (Above the fold), prop `:isLcp="true"` sẽ tự động render:
    * `loading="eager"` (không dùng `loading="lazy"` cho ảnh LCP).
    * `fetchpriority="high"`.
    * `decoding="async"`.
* **Cơ Chế Ảnh Dự Phòng (Fallback Handling):**
  * Sử dụng thuộc tính `onerror="this.onerror=null; this.src='{{ asset('images/placeholder-tech-fallback.svg') }}';"` để giao diện không bị vỡ hoặc hiện icon ảnh lỗi khi mạng chập chờn.
* **Ngữ Nghĩa SEO & Trợ Năng (Accessibility & Semantic HTML):**
  * Chỉ tồn tại duy nhất 1 thẻ `<h1>` trên toàn bộ vùng Hero.
  * Thẻ `<nav aria-label="Breadcrumb">` có đầy đủ thẻ `ol`, `li` và microdata Schema.org khi cần thiết.
  * Nút bấm có đầy đủ `focus-visible:ring-2` phục vụ điều hướng bằng bàn phím.

---

## PHẦN E — LỘ TRÌNH TRIỂN KHAI (IMPLEMENTATION ROADMAP)

Quá trình triển khai kỹ thuật ở giai đoạn tiếp theo (UI-REBUILD-13.2) cần được chia thành 4 chặng độc lập, có thứ tự phụ thuộc chặt chẽ nhằm bảo đảm không gây lỗi hồi quy (regression) và không làm gián đoạn website đang vận hành:

```
┌─────────────────────────────────────────────────────────────┐
│ Giai Đoạn 1: Xây Dựng Blade Components Thống Nhất           │
│ - Tạo resources/views/components/banner/hero.blade.php      │
│ - Tạo resources/views/components/banner/cta.blade.php       │
│ - Tạo asset SVG fallback dự phòng chuẩn thương hiệu         │
└──────────────────────────────┬──────────────────────────────┘
                               │
                               ▼
┌─────────────────────────────────────────────────────────────┐
│ Giai Đoạn 2: Chuẩn Hóa Service Hero & Product Visual        │
│ - Triển khai cho /dich-vu, /dich-vu/web-app                 │
│ - Triển khai cho /dich-vu/kho-giao-dien, /dich-vu/marketing │
│ - Đưa sơ đồ kiến trúc và mockup thực tế vào Visual Slot    │
└──────────────────────────────┬──────────────────────────────┘
                               │
                               ▼
┌─────────────────────────────────────────────────────────────┐
│ Giai Đoạn 3: Triển Khai Media Visual & Case Study Cover     │
│ - Nâng cấp /dich-vu/media & /dich-vu/booking với tư liệu thật│
│ - Thêm Visual Cover cho các trang /du-an/{slug}             │
│ - Tích hợp Video Backdrop tối ưu nén WebM/MP4               │
└──────────────────────────────┬──────────────────────────────┘
                               │
                               ▼
┌─────────────────────────────────────────────────────────────┐
│ Giai Đoạn 4: Đồng Bộ CTA Chuyển Đổi Cuối Toàn Bộ Trang Con │
│ - Thay thế các khối CTA rải rác bằng <x-banner.cta>         │
│ - Kiểm thử tự động (Feature Tests: Status 200, SEO H1, LCP)  │
│ - Kiểm tra hiển thị responsive đa thiết bị                  │
└─────────────────────────────────────────────────────────────┘
```

### Chi Tiết Từng Giai Đoạn:
1. **Milestone 1 — Nền tảng Component (Component Foundation):**
   * Xây dựng 2 file Blade component độc lập, viết sẵn unit test kiểm tra việc render đúng biến thể và props mà không ảnh hưởng tới bất kỳ trang hiện có nào.
2. **Milestone 2 — Nhóm Dịch Vụ Công Nghệ (85% Tech Pages):**
   * Áp dụng component mới cho `/dich-vu` và `/dich-vu/web-app`. Bổ sung visual diagram chuẩn SVG/WebP về kiến trúc phần mềm thực tế của Cửu Long.
3. **Milestone 3 — Nhóm Media & Dự Án (15% Media + Portfolio):**
   * Nâng cấp banner cho trang Media và Booking bằng tư liệu hình ảnh thực tế đã thu thập từ các dự án; thêm mockup thiết bị vào đầu trang chi tiết dự án.
4. **Milestone 4 — Đồng Bộ Hóa Toàn Diện & Kiểm Thử QA/QC:**
   * Đồng bộ CTA banner cuối tất cả các trang con về chuẩn chung; chạy lại toàn bộ test suite (73 feature tests) để xác nhận 0 regression.

---

## PHẦN F — NGHIỆM THU & GIỚI HẠN KHẢO SÁT (ACCEPTANCE STATEMENT)

### 1. Kết Luận Đánh Giá: **PASS WITH NOTES**

### 2. Các Mục Đã Đạt Chuẩn Nghiệm Thu (PASS Criteria):
* [x] **Khảo sát toàn diện:** Đã rà soát chi tiết toàn bộ 22 route công khai trong `routes/web.php` và kiểm tra trực tiếp mã nguồn Blade của từng trang tương ứng.
* [x] **Banner Matrix hoàn chỉnh:** Đã lập ma trận phân loại rõ ràng 5 nhóm banner (A, B, C, D, E) kèm mục tiêu, thông điệp, yêu cầu hình ảnh và tỷ lệ khung hình.
* [x] **Quy chuẩn thiết kế chi tiết:** Đã xác lập đầy đủ thông số kích thước, tỷ lệ, typography Mulish, bảng màu tương phản WCAG AA, bo góc và hiệu ứng.
* [x] **Đặc tả kỹ thuật sẵn sàng triển khai:** Đã thiết kế hợp đồng dữ liệu props, cơ chế chống CLS và tối ưu LCP cho Blade component.
* [x] **Tuân thủ giới hạn an toàn:** Không chỉnh sửa mã nguồn sản xuất, không đổi database, không tạo route giả, không cài đặt package ngoài phạm vi khảo sát.

### 3. Ghi Chú & Giới Hạn Của Đợt Khảo Sát (Notes & Constraints):
* **Phương pháp khảo sát:** Quá trình kiểm tra hiện trạng được thực hiện thông qua kiểm tra tĩnh mã nguồn Blade, AST cấu trúc giao diện, và phân tích các bài kiểm thử tự động hiện có của hệ thống.
* **Yêu cầu về tư liệu hình ảnh thực tế:** 
  * Hiện tại một số vị trí visual đề xuất (như sơ đồ kiến trúc chi tiết cho `/dich-vu/web-app` hoặc ảnh trường quay độ nét cao cho `/dich-vu/media`) cần được đội ngũ nội bộ cung cấp file gốc (SVG hoặc WebP chất lượng cao).
  * Nghiêm cấm việc sử dụng ảnh stock người mẫu nước ngoài hoặc terminal giả để lấp khoảng trống trong quá trình triển khai UI-REBUILD-13.2.

---
*Báo cáo được lập bởi Senior UI/UX Designer & Senior Laravel Frontend Architect. Đã sẵn sàng trình duyệt để chuyển sang bước triển khai UI-REBUILD-13.2 khi có phê duyệt.*
