# KẾ HOẠCH THIẾT KẾ & XÂY DỰNG TOÀN BỘ TRANG CON (SUBPAGES BLUEPRINT) — BẢN DUYỆT LẦN 2
## Website: truyenthongcuulong.com (Nền tảng Laravel Framework)
### Định hướng: Tổ hợp Truyền thông Điện ảnh & Công nghệ Phần mềm (Media & Tech Hub)

> 📌 **NHẬT KÝ ĐIỀU CHỈNH THEO GÓP Ý CỦA NGƯỜI QUẢN TRỊ (BẢN DUYỆT LẦN 2):**
> 1. **Sửa dứt điểm danh sách khách hàng (Trang 5):** Loại bỏ toàn bộ các tên chưa xác thực (Mobifone, Casper, Vietcombank, v.v.). Thay thế 100% bằng **danh sách 26+ khách hàng thật từ website cũ** và phân bổ lại bộ lọc ngành.
> 2. **Sửa dứt điểm danh sách đối tác (Trang 4):** Xóa toàn bộ danh sách "đối tác thiết bị/hạ tầng toàn cầu" chưa có xác nhận hợp tác chính thức (Sony, RED, Google, AWS, Meta). Chỉ giữ lại đúng **17 đối tác thật đã xác nhận** từ website cũ.
> 3. **Loại bỏ timeline lịch sử chưa xác thực (Trang 1):** Bỏ các năm cụ thể (2014, 2018, 2022) và sự kiện suy diễn; chỉ giữ tuyên bố chung "hơn 10 năm kinh nghiệm" và đặt câu hỏi chờ người quản trị xác nhận.
> 4. **Bỏ số liệu định lượng thiếu căn cứ (Trang 8):** Xóa tuyên bố "giảm 40-60% CPM/CPA", thay bằng mô tả định tính tối ưu chi phí nhờ tự sản xuất tư liệu hình ảnh.
> 5. **Cảnh báo dữ liệu seeder mẫu (Trang 2):** Đã gắn comment cảnh báo trong `TeamMemberSeeder.php` và quy định rõ việc thay thế bằng thông tin nhân sự thật là **điều kiện tiên quyết** để hoàn thành Đợt 3.
> 6. **Bổ sung các yêu cầu kỹ thuật toàn diện:** Thêm checklist SEO Meta & Schema JSON-LD cho từng trang, quy trình phân nhánh Git (`feature/subpages-batch-x`), làm rõ năng lực Flutter ở Trang 6, và bổ sung mục "Verification Plan Tổng Thể Sau Mỗi Đợt" ở cuối tài liệu.

---

## 1. BẢNG TỔNG QUAN HỆ THỐNG 13 TRANG CON

| STT | Tên Trang | URL / Route chính thức | Trạng thái kiểm tra thực tế trong Codebase | Độ ưu tiên |
| :---: | :--- | :--- | :--- | :---: |
| **1** | **Câu chuyện thương hiệu** | `/ve-chung-toi`<br>`route('about')` | Đã có code (`pages/about.blade.php`), đã hiện đại hóa chuẩn Deep Navy/Amber. | **Hoàn thành** |
| **2** | ~~**Đội ngũ Senior**~~ | ~~/ve-chung-toi/doi-ngu~~ | **ĐÃ LƯỢC BỎ THEO YÊU CẦU CỦA NGƯỜI QUẢN TRỊ** (Bỏ view, route & menu liên kết). | **Đã bỏ** |
| **3** | **Tuyển dụng** | `/tuyen-dung`<br>`route('careers')` | Đã hiện đại hóa giao diện Deep Navy/Amber, tích hợp form nộp CV và Talent Pool. | **Hoàn thành** |
| **4** | **Đối tác chiến lược** | `/doi-tac`<br>`route('partners')` | Chưa có route & view riêng; hiện là anchor `#doi-tac` 6 card placeholder trong `about.blade.php`. Cần lập trang riêng với đúng 17 đối tác thật. | **Trung bình** |
| **5** | **Khách hàng tiêu biểu** | `/khach-hang`<br>`route('clients')` | Chưa có route & view riêng; hiện là anchor `#khach-hang` trong `about.blade.php`. Cần lập trang riêng với đúng 26+ khách hàng thật từ site cũ. | **Trung bình** |
| **6** | **Thiết kế & Lập trình Web/App** | `/dich-vu/web-app`<br>`route('services.web-app')` | Đang dùng tạm view chung `services/show.blade.php`, chưa có cấu trúc Landing Page chuyên sâu cho dịch vụ Tech. | ⭐ **Rất cao** |
| **7** | **Quay Phim & Sản Xuất Media** | `/dich-vu/media`<br>`route('services.media')` | Đang dùng tạm view chung `services/show.blade.php`, chưa có Landing Page chuyên biệt cho xưởng phim / production cinema 4K. | ⭐ **Rất cao** |
| **8** | **Quảng Cáo & Truyền Thông Số** | `/dich-vu/marketing`<br>`route('services.marketing')` | Đang dùng tạm view chung `services/show.blade.php`, chưa có Landing Page chuyên sâu cho Performance & Growth. | ⭐ **Rất cao** |
| **9** | **Booking Team Media** | `/booking`<br>`route('booking')` | Chưa có route & view riêng; menu header đang trỏ tạm vào form liên hệ chung (`/lien-he?service=booking-media`). | **Cao** |
| **10** | **Kho Giao Diện Mẫu** | `/kho-giao-dien`<br>`route('templates.index')` | Đã có code lọc (`templates/index.blade.php`), nhưng UI tone sky cũ, thiếu breadcrumb, cần đồng bộ Deep Navy/Amber. | **Cao** |
| **11** | **Tài Nguyên Số / Download Center** | `/tai-nguyen`<br>`route('resources.index')` | Đã có code lead magnet (`resources/index.blade.php`), nhưng padding cũ `pt-28`, thiếu breadcrumb, UI cần nâng cấp chuẩn Navy/Amber. | **Trung bình** |
| **12** | **Bảng Giá Dịch Vụ** | `/bang-gia`<br>`route('pricing')` | Đã có code và công cụ tính chi phí (`pages/pricing.blade.php`), cần chuẩn hóa breadcrumb, padding và đồng bộ gói giá với 3 dịch vụ con. | ⭐ **Rất cao** |
| **13** | **Dự Án & Case Studies** | `/du-an`<br>`route('projects.index')` | Đã có code (`projects/index.blade.php`), nhưng UI đơn giản, thiếu bộ lọc chi tiết, thiếu breadcrumb và các chỉ số KPI thực tế. | ⭐ **Rất cao** |

> **Xác nhận trạng thái các trang pháp lý & tiện ích đã có sẵn từ trước:**
> - `/chinh-sach-bao-mat` (`privacy.blade.php`): Đã code hoàn chỉnh theo Nghị định 13/2023/NĐ-CP.
> - `/dieu-khoan-dich-vu` (`terms.blade.php`): Đã code hoàn chỉnh quy chế vận hành và quyền sở hữu trí tuệ.
> - `/lien-he` (`contact.blade.php`): Đã code hoàn chỉnh form liên hệ, bản đồ và thông tin trụ sở.
> - `/ho-so-nang-luc` (`profile.blade.php`): Đã code hoàn chỉnh trang xem & tải Profile năng lực e-brochure.

---

## 2. QUY CHUẨN THIẾT KẾ & KỸ THUẬT BẮT BUỘC (DESIGN SYSTEM & TECH GUIDELINES)

Tất cả 13 trang con khi triển khai **bắt buộc** phải tuân thủ 100% các nguyên tắc sau:
1. **Master Layout duy nhất:** Sử dụng `@extends('layouts.app')` (đã tích hợp Header Navigation dropdown 2 cấp và Master Footer Dark Navy).
2. **Bảng màu thương hiệu (Brand Palette):**
   - Nền chủ đạo: `bg-surface` (`#0F172A` - Slate Dark/Navy) kết hợp các khối phụ `bg-navy-base` (`#080C16`) và các bề mặt thẻ `bg-[#131D38]` hoặc `bg-white/5`.
   - Màu nhấn hành động (Accent/CTA): Vàng ánh kim Amber (`#F59E0B`, `text-amber-400`, `bg-amber-400`) phối cùng Cam lửa Primary (`#EA580C`).
   - Tuyệt đối không dùng gradient tím hoặc các màu sắc lệch bảng màu chuẩn.
3. **Typography & Font:** Font tiêu đề `font-headline` (Space Grotesk), font nội dung `font-body` (Plus Jakarta Sans), font kỹ thuật/chỉ số `font-mono`.
4. **Hệ thống Spacing & Padding đã chuẩn hóa:**
   - Khoảng đệm section: `py-12 lg:py-16` (Desktop 64px, Mobile 48px).
   - Khoảng đệm tiêu đề: `mb-10 lg:mb-12`.
   - Hero nhỏ đầu trang: Đệm trên `pt-32 pb-12 lg:pt-36 lg:pb-16` để tránh bị che bởi Fixed Header 80px nhưng không tạo khoảng trắng thừa thãi.
5. **Cấu trúc Small Hero thống nhất:**
   - Breadcrumb định vị: `Trang chủ > [Tên Nhóm] > [Tên Trang]`.
   - Eyebrow Badge (Caps font mono, viền tinh tế, chấm pulse amber).
   - Tiêu đề chính H1 (Font Space Grotesk, chữ trắng điểm xuyết chữ gradient Amber).
   - Mô tả ngắn (2-3 câu, súc tích).
6. **Texture & Hiệu ứng:**
   - Lớp nền chấm bi mờ: `bg-dot-grid-subtle`.
   - Hoạt ảnh xuất hiện: `gsap-reveal-section` hoặc Alpine transition nhẹ nhàng.
   - Hover state: Nâng nhẹ thẻ (`hover:-translate-y-1`), viền sáng nhẹ (`hover:border-amber-400/40`), bóng đổ mềm.
7. **Checklist SEO & Schema JSON-LD:** Mỗi trang đều có `@section('title')`, `@section('meta_description')`, và khối `<script type="application/ld+json">` chứa cấu trúc dữ liệu tương ứng.
8. **CTA Band cuối trang:** Mỗi trang kết thúc bằng 1 dải kêu gọi hành động dẫn về form liên hệ hoặc hotline.

---

## 3. CHI TIẾT KẾ HOẠCH TỪNG TRANG TRONG 13 TRANG CON

---

### NHÓM 1: VỀ CHÚNG TÔI (DROPDOWN HEADER)

#### Trang 1: Câu Chuyện Thương Hiệu
1. **URL & Route:** `/ve-chung-toi` | `Route::get('/ve-chung-toi', [CompanyController::class, 'about'])->name('about');`
   - **View:** `resources/views/pages/about.blade.php`
2. **Trạng thái hiện tại:** Đã có file code (228 dòng). Hiện trạng đang gộp chung Đội ngũ (`#doi-ngu`), Đối tác (`#doi-tac`), Khách hàng (`#khach-hang`) vào một trang dài. Cần tái cấu trúc để trang này tập trung sâu sắc vào Bản sắc, Triết lý và Giá trị cốt lõi.
3. **Mục đích:** Khắc họa chiều sâu thương hiệu, khẳng định vị thế "Tổ hợp Điện ảnh × Công nghệ" tiên phong và truyền cảm hứng tin tưởng cho đối tác doanh nghiệp.
4. **Nguồn dữ liệu:** Nội dung tĩnh biên tập chuẩn SEO + Hệ sinh thái 4 website thành viên thật.
5. **Cấu trúc Section đề xuất:**
   - **Section 1 (Small Hero):** Breadcrumb (`Trang chủ > Về chúng tôi > Câu chuyện thương hiệu`) + Badge `ABOUT TRUYỀN THÔNG CỬU LONG` + H1 "Hành Trình Giao Thoa Giữa Nghệ Thuật Kể Chuyện Điện Ảnh & Sức Mạnh Công Nghệ Số" + Mô tả ngắn + Tuyên ngôn kinh nghiệm: "Hơn 10 năm kinh nghiệm đồng hành cùng các thương hiệu và doanh nghiệp".
   - **Section 2 (Triết lý Dual DNA):** Sự kết hợp độc bản giữa 2 nửa bán cầu não: Trực giác thẩm mỹ điện ảnh của Đạo diễn & Tư duy logic kiến trúc phần mềm của Kỹ sư.
   - **Section 3 (Tầm Nhìn & Sứ Mệnh):** 
     *(Thay đổi so với bản cũ: Tạm thời BỎ HẲN phần timeline chi tiết theo năm 2014-2026 vì chưa được xác minh. Thay bằng khối Tầm nhìn - Sứ mệnh và cam kết chuẩn mực chất lượng bền vững hơn 10 năm).*
     > ⚠️ **TODO CẦN XÁC NHẬN VỚI QUẢN TRỊ VIÊN:** Cần cung cấp năm thành lập chính thức và các cột mốc lịch sử thực tế của công ty (nếu muốn bổ sung lại timeline chi tiết trong tương lai).
   - **Section 4 (Giá Trị Cốt Lõi 4T):** Tâm (Tận tụy) - Tầm (Chuẩn mực điện ảnh & công nghệ cao) - Tốc (Bàn giao đúng tiến độ) - Thật (Hiệu quả đo lường thực tế).
   - **Section 5 (Hệ Sinh Thái 4 Thành Viên Thật):** Giới thiệu 4 website thành viên thực tế của hệ sinh thái CLM: Cuu Long Camping (`cuulongcamping.vn`), Tui Là Người Miền Tây (`tuilanguoimientay.vn`), Tiêu Dao Tử (`tieudaotu.com`), Cùng Chơi (`cungchoi.com`).
   - **Section 6 (CTA Band):** "Cùng kiến tạo bước chuyển mình mạnh mẽ cho thương hiệu bạn" $\rightarrow$ Dẫn về form liên hệ tư vấn.
6. **UI Tái sử dụng:** Dot-grid subtle, Dual DNA spotlight layout, Ecosystem card grid, Gradient CTA band.
7. **SEO & Schema JSON-LD:**
   - Meta Title: `Câu Chuyện Thương Hiệu & Triết Lý Hoạt Động - Truyền Thông Cửu Long`
   - Meta Description: `Tìm hiểu về Truyền Thông Cửu Long: Hơn 10 năm kinh nghiệm hợp nhất nghệ thuật kể chuyện điện ảnh và năng lực kỹ thuật số chuẩn mực.`
   - Schema: `AboutPage` kết hợp `Organization`.
8. **Độ ưu tiên:** **Trung bình**.

---

#### Trang 2: Đội Ngũ Senior
1. **URL & Route:** `/ve-chung-toi/doi-ngu` | `Route::get('/ve-chung-toi/doi-ngu', [CompanyController::class, 'team'])->name('team');`
   - **View:** `resources/views/pages/team.blade.php`
2. **Trạng thái hiện tại:** Chưa có route và view độc lập. Header hiện đang link tới anchor `/ve-chung-toi#doi-ngu`. Cần tách thành view riêng để trình bày hồ sơ chuyên môn của từng nhân sự cấp cao.
3. **Mục đích:** Xóa bỏ tâm lý e ngại "agency thuê ngoài giao cho nhân sự chưa có kinh nghiệm", chứng minh dự án được chỉ đạo và kiểm soát chất lượng trực tiếp bởi đội ngũ Senior.
4. **Nguồn dữ liệu:** Bảng database `team_members` (`name`, `role`, `bio`, `photo`, `order`, `skills`).
   > 🚨 **CẢNH BÁO QUAN TRỌNG VỀ DỮ LIỆU SEEDER:**  
   > 4 thành viên hiện có trong `TeamMemberSeeder.php` là **DỮ LIỆU MẪU (placeholder/mock data)** phục vụ dựng layout giao diện.  
   > **ĐIỀU KIỆN TIÊN QUYẾT:** Người quản trị bắt buộc phải cung cấp danh sách nhân sự thật (Họ tên, chức danh, tiểu sử, ảnh chụp chân dung studio thật) để cập nhật vào database trước khi coi Đợt 3 là hoàn tất.
5. **Cấu trúc Section đề xuất:**
   - **Section 1 (Small Hero):** Breadcrumb (`Trang chủ > Về chúng tôi > Đội ngũ Senior`) + Badge `SENIOR EXPERTS & LEADERSHIP` + H1 "Những Bộ Óc Chiến Lược & Bàn Tay Thực Chiến Cầm Trịch Dự Án" + Mô tả cam kết chất lượng thực thi.
   - **Section 2 (Ban Điều Hành & Giám Đốc Chuyên Môn):** Profile CCO, CTO, CMO, Production Head.
   - **Section 3 (Khối Kỹ Thuật Số & Điện Ảnh):** Trưng bày các vị trí chủ chốt: Đạo diễn hình ảnh (DOP), Chuyên gia chỉnh màu (Colorist), Kỹ sư phần mềm Lead, Chuyên viên tối ưu chuyển đổi.
   - **Section 4 (Nguyên Tắc Làm Việc Của Đội Ngũ):** 3 Chuẩn mực: Trực tiếp phản hồi trong 15 phút, Minh bạch mọi rủi ro kỹ thuật, Đồng hành tới cùng hiệu quả chuyển đổi.
   - **Section 5 (CTA Band):** "Muốn trao đổi trực tiếp với chuyên gia phụ trách lĩnh vực của bạn?" $\rightarrow$ Nút Đặt lịch hẹn 1-on-1.
6. **UI Tái sử dụng:** Profile card nâng cao (avatar, badge chức danh, danh sách skills tags), Dot-grid subtle, CTA band.
7. **SEO & Schema JSON-LD:**
   - Meta Title: `Đội Ngũ Chuyên Gia Senior - Truyền Thông Cửu Long`
   - Meta Description: `Gặp gỡ đội ngũ đạo diễn, chuyên gia chỉnh màu và kỹ sư phần mềm giàu kinh nghiệm trực tiếp đảm trách từng dự án tại Truyền Thông Cửu Long.`
   - Schema: `ProfilePage` kết hợp danh sách thực thể `Person`.
8. **Độ ưu tiên:** **Trung bình**.

---

#### Trang 3: Tuyển Dụng & Cơ Hội Nghề Nghiệp
1. **URL & Route:** `/tuyen-dung` | `Route::get('/tuyen-dung', [CompanyController::class, 'careers'])->name('careers');`
   - **Route xử lý nộp CV:** `Route::post('/tuyen-dung/apply', [CompanyController::class, 'applyJob'])->name('careers.apply');`
   - **View:** `resources/views/pages/careers.blade.php`
2. **Trạng thái hiện tại:** Đã có code chức năng lưu hồ sơ ứng tuyển vào bảng `job_applications` và lưu file CV vào storage. Tuy nhiên UI đang dùng màu tím (`purple-600`), thiếu breadcrumb, khoảng cách chưa đồng bộ với trang chủ.
3. **Mục đích:** Thu hút nhân tài sáng tạo và kỹ sư công nghệ; định vị môi trường làm việc chuyên nghiệp, trang thiết bị tân tiến và chế độ đãi ngộ rõ ràng.
4. **Nguồn dữ liệu:** Bảng `posts` (lọc theo category `tuyen-dung` hoặc `pillar_group = 'corporate'`) + Form nộp CV xử lý bởi `JobApplication`.
5. **Cấu trúc Section đề xuất:**
   - **Section 1 (Small Hero):** Breadcrumb (`Trang chủ > Về chúng tôi > Tuyển dụng`) + Badge `CAREERS & TALENTS` + H1 "Cùng Kiến Tạo Những Tác Phẩm Điện Ảnh Triệu View & Nền Tảng Công Nghệ Đột Phá" + Đổi sang màu Deep Navy/Amber.
   - **Section 2 (Môi Trường & Đãi Ngộ):** 3 Khối quyền lợi: Thu nhập cạnh tranh & thưởng dự án minh bạch, Trang thiết bị làm việc máy trạm/máy quay Sony FX hiện đại, Cơ hội nâng cao tay nghề cùng các Senior.
   - **Section 3 (Vị Trí Đang Mở Tuyển):** Hiển thị thẻ tuyển dụng phân loại theo Media, Tech, Marketing (Tên vị trí, Hình thức, Địa điểm, Hạn nộp).
   - **Section 4 (Quy Trình Tuyển Dụng 4 Bước):** 1. Nộp CV/Portfolio $\rightarrow$ 2. Sàng lọc hồ sơ $\rightarrow$ 3. Phỏng vấn chuyên môn 1 vòng trực tiếp với Lead $\rightarrow$ 4. Thử việc hưởng 100% lương.
   - **Section 5 (Form Ứng Tuyển Nhanh - Fast Apply):** Form upload CV trực tiếp (PDF/Docx), lưu trữ bảo mật và thông báo cho ban nhân sự.
   - **Section 6 (CTA Band):** "Chưa thấy vị trí phù hợp nhưng tin mình có năng lực?" $\rightarrow$ Gửi CV vào Talent Pool dự phòng.
6. **UI Tái sử dụng:** Job card, File upload dropzone, 4-step process pills, Success alert, Form input styles.
7. **SEO & Schema JSON-LD:**
   - Meta Title: `Tuyển Dụng & Cơ Hội Nghề Nghiệp - Truyền Thông Cửu Long`
   - Meta Description: `Gia nhập Truyền Thông Cửu Long. Khám phá các vị trí tuyển dụng hấp dẫn dành cho Video Editor, Cameraman, Kỹ sư phần mềm và Marketer.`
   - Schema: `JobPosting` (nếu có job đang mở) hoặc `CollectionPage`.
8. **Độ ưu tiên:** **Thấp**.

---

#### Trang 4: Đối Tác Chiến Lược
1. **URL & Route:** `/doi-tac` | `Route::get('/doi-tac', [CompanyController::class, 'partners'])->name('partners');`
   - **View:** `resources/views/pages/partners.blade.php`
2. **Trạng thái hiện tại:** Chưa có route và view riêng; hiện tại chỉ là anchor `#doi-tac` gồm 6 thẻ placeholder trong `about.blade.php`. Cần lập trang riêng biệt.
3. **Mục đích:** Minh chứng mạng lưới đối tác hợp tác lâu năm của CLM, khẳng định năng lực kết nối và uy tín trong ngành.
4. **Nguồn dữ liệu:** **ĐÚNG 17 ĐỐI TÁC THẬT ĐÃ XÁC NHẬN TỪ WEBSITE CŨ:**
   > 🛑 **ĐIỀU CHỈNH QUAN TRỌNG:** Xóa bỏ toàn bộ các tên "đối tác hạ tầng/thiết bị quốc tế" (Sony, RED, DaVinci, AWS, Google Cloud, Meta) khỏi danh mục đối tác chiến lược. Chỉ giữ lại đúng danh sách 17 đơn vị thật sau:
   - *Nhóm Đối tác Hạ tầng Máy chủ & Tên miền (2 đơn vị):* **PA Vietnam**, **Hawk Host**.
   - *Nhóm Đối tác Du lịch, Lữ hành, Nghỉ dưỡng & Sự kiện (15 đơn vị):* **Long Trekking**, **Láng Sen**, **Nam Tây Nguyên**, **MTC**, **Gonatour**, **Apollo**, **VNTravel**, **Hoàng Anh Event**, **InterTravel**, **Hoangmai**, **SGStar**, **Travelife**, **Phú Thọ** (kèm các chi nhánh/đơn vị trực thuộc).
   > *(Lưu ý: Nếu công ty thực sự có chứng nhận đối tác chính thức từ các hãng thiết bị hoặc công nghệ lớn, cần người quản trị xác nhận cụ thể văn bản hợp tác trước khi bổ sung).*
5. **Cấu trúc Section đề xuất:**
   - **Section 1 (Small Hero):** Breadcrumb (`Trang chủ > Về chúng tôi > Đối tác chiến lược`) + Badge `OFFICIAL PARTNERS` + H1 "Mạng Lưới Đối Tác Đồng Hành Bền Vững Cùng Truyền Thông Cửu Long" + Tuyên ngôn hợp tác bền chặt.
   - **Section 2 (Nhóm Đối Tác Hạ Tầng Công Nghệ & Tên Miền):** Giới thiệu mối quan hệ hợp tác với PA Vietnam, Hawk Host trong việc cung cấp hạ tầng hosting/domain ổn định cho khách hàng.
   - **Section 3 (Nhóm Đối Tác Lữ Hành, Du Lịch & Tổ Chức Sự Kiện):** Lưới logo/card chi tiết cho 15 đối tác thật từ website cũ: Long Trekking, Gonatour, VNTravel, Hoàng Anh Event, InterTravel, SGStar, Travelife, v.v.
   - **Section 4 (Nguyên Tắc Hợp Tác Bền Vững):** 3 Tiêu chí: Tôn trọng cam kết, Đồng hành dài hạn, Đôi bên cùng có lợi (Win-Win).
   - **Section 5 (CTA Band):** "Quan tâm đến việc hợp tác truyền thông hoặc liên minh giải pháp cùng CLM?" $\rightarrow$ Nút Đăng ký kết nối đối tác.
6. **UI Tái sử dụng:** Logo grid card hover glow, Spec badges, Quote callout, CTA band.
7. **SEO & Schema JSON-LD:**
   - Meta Title: `Mạng Lưới Đối Tác Chiến Lược - Truyền Thông Cửu Long`
   - Meta Description: `Danh sách các đối tác hạ tầng công nghệ và du lịch lữ hành đồng hành bền vững cùng Truyền Thông Cửu Long.`
   - Schema: `AboutPage` hoặc `Organization` với thuộc tính `memberOf` / `sponsor`.
8. **Độ ưu tiên:** **Trung bình**.

---

#### Trang 5: Khách Hàng Tiêu Biểu
1. **URL & Route:** `/khach-hang` | `Route::get('/khach-hang', [CompanyController::class, 'clients'])->name('clients');`
   - **View:** `resources/views/pages/clients.blade.php`
2. **Trạng thái hiện tại:** Chưa có route và view riêng; hiện tại chỉ là anchor `#khach-hang` với 4 card tượng trưng trong `about.blade.php`. Cần lập trang riêng biệt.
3. **Mục đích:** Bằng chứng thuyết phục nhất (Social Proof) cho thấy năng lực thực tế của CLM qua việc đã cung cấp dịch vụ cho các thương hiệu và tổ chức thực tế.
4. **Nguồn dữ liệu:** **ĐÚNG DANH SÁCH 26+ KHÁCH HÀNG THẬT TỪ WEBSITE CŨ:**
   > 🛑 **ĐIỀU CHỈNH BẮT BUỘC:** Thay thế toàn bộ các tên placeholder trước đó (Mobifone, Casper, Vietcombank, Bệnh viện Phương Châu, ĐH Cần Thơ, Lotte Mart, Novaland, Lộc Trời, Bến Ninh Kiều) bằng **đúng danh sách 26+ khách hàng thật đã xác nhận**:
   - CP Vietnam, Alo 360, Hoya Lens Việt Nam, CLB Báo Anh, Việt Trung, ACBH-ACBD, Ngân hàng VBI, Milan, Rakus, TBR, Swarovski, YSG, OHS Team, VietABank, Phòng Khám Đa Khoa Gia Phước, Ngân Hàng ACB, BTM Global, Ngân Hàng Sacombank, Vina Agri, Citranco, Tata International, Cholontourist, Giặt Ủi Công Nghiệp 365, Khăn Lạnh Sen Vàng, Mekong, Trường Đại Học Văn Hiến, HDEU, CSG, Kinh Đô, Hiệp Hội Phụ Nữ.
5. **Cấu trúc Section đề xuất:**
   - **Section 1 (Small Hero):** Breadcrumb (`Trang chủ > Về chúng tôi > Khách hàng tiêu biểu`) + Badge `AUTHENTIC CLIENT PORTFOLIO` + H1 "Những Thương Hiệu & Tổ Chức Đã Lựa Chọn Truyền Thông Cửu Long" + Tuyên ngôn phục vụ tận tâm.
   - **Section 2 (Bộ Lọc Danh Mục Ngành Khách Hàng Thật):** Tab lọc dựa trên đúng các khách hàng thật:
     - *Tất cả (26+ thương hiệu)*
     - *Tài chính & Ngân hàng:* Ngân Hàng ACB, Ngân Hàng Sacombank, VietABank, Ngân Hàng VBI.
     - *Công nghệ & Dịch vụ giải pháp:* Rakus, BTM Global, TBR, Alo 360, ACBH-ACBD.
     - *Nông nghiệp, Sản xuất & Công nghiệp:* CP Vietnam, Vina Agri, Tata International, Hoya Lens Việt Nam, Khăn Lạnh Sen Vàng, Giặt Ủi Công Nghiệp 365, Kinh Đô.
     - *Du lịch, Thương mại & Bán lẻ:* Cholontourist, Swarovski, Citranco, Milan, YSG.
     - *Y tế, Giáo dục & Đoàn thể xã hội:* Trường Đại Học Văn Hiến, Phòng Khám Đa Khoa Gia Phước, Hiệp Hội Phụ Nữ, CLB Báo Anh, Mekong, HDEU, CSG, Việt Trung, OHS Team.
   - **Section 3 (Lưới Thẻ Khách Hàng Chi Tiết):** Mỗi card gồm: Tên doanh nghiệp/tổ chức thật, Lĩnh vực hoạt động, Biểu tượng danh mục, Tóm tắt giải pháp CLM cung cấp (Sản xuất hình ảnh / Thiết kế web / Tư vấn truyền thông).
   - **Section 4 (Lời Chứng Thực Khách Hàng - Testimonials):** Trích dẫn các đánh giá từ bảng `testimonials` (lọc các nhận xét tích cực về thái độ làm việc và chất lượng sản phẩm).
   - **Section 5 (CTA Band):** "Bạn muốn thương hiệu của mình tiếp nối danh sách những dự án thành công?" $\rightarrow$ Nút Gửi yêu cầu tư vấn.
6. **UI Tái sử dụng:** Filter pills, Client card với badge phân loại, Testimonial cards có dấu trích dẫn lớn, Counter badges, CTA band.
7. **SEO & Schema JSON-LD:**
   - Meta Title: `Khách Hàng Tiêu Biểu & Đánh Giá Thực Tế - Truyền Thông Cửu Long`
   - Meta Description: `Khám phá danh sách các thương hiệu, ngân hàng và doanh nghiệp đã tin tưởng sử dụng dịch vụ của Truyền Thông Cửu Long.`
   - Schema: `CollectionPage` kết hợp `Review` / `Rating`.
8. **Độ ưu tiên:** **Trung bình**.

---

### NHÓM 2: DỊCH VỤ (DROPDOWN HEADER)

#### Trang 6: Thiết Kế & Lập Trình Web/App
1. **URL & Route:** `/dich-vu/web-app` | `Route::get('/dich-vu/web-app', [ServiceController::class, 'webApp'])->name('services.web-app');`
   - **View:** `resources/views/services/web-app.blade.php`
2. **Trạng thái hiện tại:** Đang trỏ tạm vào `services.show` với slug `thiet-ke-website-chuyen-nghiep`. View này hiện chỉ là bài viết tĩnh, chưa đạt chuẩn Landing Page chuyển đổi cao của dịch vụ công nghệ mũi nhọn.
3. **Mục đích:** Landing Page bán hàng cho mảng phát triển phần mềm; khẳng định sự khác biệt giữa "hệ thống công nghệ chuẩn doanh nghiệp, tải cao, bảo mật" với các website giá rẻ dùng theme rác trên thị trường.
4. **Nguồn dữ liệu:** Bảng `services` (slug `thiet-ke-website-chuyen-nghiep`), bảng `case_studies` (lọc `group = 'technology'`), bảng `posts` (category `template-website`).
5. **Cấu trúc Section đề xuất:**
   - **Section 1 (Small Hero):** Breadcrumb (`Trang chủ > Dịch vụ > Thiết kế & Lập trình Web/App`) + Badge `TECHLAB ENTERPRISE SOLUTIONS` + H1 "Thiết Kế & Phát Triển Nền Tảng Web/App Chịu Tải Cao, Chuẩn SEO & Clean-Code" + Tech stack badges (Laravel, Vue.js, MySQL, Redis, AWS, Docker) + Nút Dự toán chi phí & Nút Xem dự án.
   - **Section 2 (4 Gói Giải Pháp Công Nghệ Trọng Tâm):**
     1. *Website Doanh Nghiệp Cao Cấp*: Thiết kế độc quyền, chuẩn Core Web Vitals (Lighthouse $\ge 95$), tải nhanh < 1.2 giây.
     2. *Cổng Thông Tin & Sàn E-Commerce*: Hệ thống quản trị nội dung CMS phân quyền mạnh mẽ, tích hợp thanh toán tự động, chịu tải hàng nghìn truy cập đồng thời.
     3. *Ứng Dụng Di Động Đa Nền Tảng (Năng Lực Sẵn Sàng Triển Khai)*:
        > ℹ️ **LÀM RÕ NĂNG LỰC:** Diễn đạt chính xác: Đây là **năng lực kỹ thuật sẵn sàng triển khai theo yêu cầu** (Ready-to-deploy capability trên nền Flutter/React Native), không ngụ ý đã có bề dày dự án app lớn nếu chưa có case study đối chứng.
     4. *Hệ Thống Web App Quản Trị & Tích Hợp API*: Số hóa quy trình nội bộ, tự động hóa dữ liệu và tích hợp API bên thứ ba.
   - **Section 3 (Tiêu Chuẩn Kiến Trúc Kỹ Thuật Chuẩn Doanh Nghiệp):** Clean Architecture, Bảo mật đa tầng chống SQLi/XSS/CSRF, Caching dữ liệu tối ưu, Bàn giao 100% mã nguồn không khóa tính năng.
   - **Section 4 (Quy Trình Phát Triển 6 Bước Kỹ Thuật Chuẩn):** Phân tích yêu cầu $\rightarrow$ Thiết kế Wireframe & UI/UX $\rightarrow$ Lập trình Clean Code $\rightarrow$ Kiểm thử QA/QC $\rightarrow$ Triển khai hạ tầng máy chủ $\rightarrow$ Bàn giao & Bảo hành kỹ thuật.
   - **Section 5 (Bảng Giá Tham Khảo & Tính Năng):** Bảng so sánh 3 gói (Starter, Growth, Enterprise) kèm liên kết sang `/bang-gia`.
   - **Section 6 (Dự Án Web/App Tiêu Biểu):** Trưng bày các dự án website/hệ thống đã bàn giao thực tế.
   - **Section 7 (Kho Mẫu Giao Diện Có Sẵn):** Dải 4 template demo hot nhất kèm nút chuyển hướng sang `/kho-giao-dien`.
   - **Section 8 (CTA Band):** "Cần tư vấn kiến trúc công nghệ hoặc dự toán kỹ thuật cho dự án của bạn?" $\rightarrow$ Form đăng ký tư vấn.
6. **UI Tái sử dụng:** Tech stack badges, Architecture diagram cards, 6-step workflow pills, Feature comparison table, Template preview cards, CTA band.
7. **SEO & Schema JSON-LD:**
   - Meta Title: `Thiết Kế & Lập Trình Web/App Chuyên Nghiệp - Truyền Thông Cửu Long`
   - Meta Description: `Dịch vụ thiết kế website và phát triển web app doanh nghiệp chuẩn SEO, kiến trúc clean-code chịu tải cao, bàn giao trọn gói mã nguồn.`
   - Schema: `Service` với `provider = Truyền Thông Cửu Long`.
8. **Độ ưu tiên:** ⭐ **Rất cao (Cao)**.

---

#### Trang 7: Quay Phim & Sản Xuất Media
1. **URL & Route:** `/dich-vu/media` | `Route::get('/dich-vu/media', [ServiceController::class, 'media'])->name('services.media');`
   - **View:** `resources/views/services/media.blade.php`
2. **Trạng thái hiện tại:** Đang trỏ vào `services.show` (slug `san-xuat-video-media`). Chưa có Landing Page chuyên sâu cho mảng thế mạnh hàng đầu của CLM.
3. **Mục đích:** Phô diễn năng lực sản xuất hình ảnh điện ảnh, thuyết phục các nhãn hàng lựa chọn CLM làm Production House cho các chiến dịch TVC, phim tài liệu doanh nghiệp và video truyền thông.
4. **Nguồn dữ liệu:** Bảng `services` (slug `san-xuat-video-media`), bảng `case_studies` (lọc `group = 'media'`), video showreels từ YouTube/Vimeo.
5. **Cấu trúc Section đề xuất:**
   - **Section 1 (Small Hero):** Breadcrumb (`Trang chủ > Dịch vụ > Quay Phim & Sản Xuất Media`) + Badge `CINEMATIC PRODUCTION HOUSE` + H1 "Sản Xuất Video Quảng Cáo TVC 4K, Phim Doanh Nghiệp & Chiến Dịch Hình Ảnh Điện Ảnh" + Nút Xem Showreel (mở video modal).
   - **Section 2 (4 Định Dạng Sản Phẩm Media Cốt Lõi):**
     1. *TVC Quảng Cáo & Phim Thương Hiệu 4K*: Kịch bản sáng tạo, góc máy điện ảnh chuẩn màu REC.709/DCI-P3.
     2. *Phim Tài Liệu & Kỷ Niệm Thành Lập*: Nghệ thuật kể chuyện truyền cảm hứng, phỏng vấn lãnh đạo, tôn vinh chặng đường phát triển.
     3. *Video Ngắn Đa Nền Tảng (TikTok / Reels / Shorts)*: Kịch bản bắt trúng thị hiếu giới trẻ, nhịp dựng nhanh, tối ưu tương tác.
     4. *Ghi Hình Sự Kiện Lớn & Livestream Đa Điểm*: Bàn switcher chuyên nghiệp, hệ thống mic thu âm trường quay 32-bit float, flycam 4K.
   - **Section 3 (Vũ Khí Thiết Bị Thực Chiến):** Showcase trực quan dàn máy quay Sony FX Cinema, ống kính cine prime, hệ thống gimbal chống rung, phòng dựng DaVinci Studio.
   - **Section 4 (Before/After Color Grading Slider):** Thanh trượt tương tác so sánh khung hình LOG/RAW mộc và khung hình sau khi được cân chỉnh màu sắc điện ảnh tại phòng DaVinci.
   - **Section 5 (Quy Trình Sản Xuất Chuẩn 6 Bước):** Tiền kỳ (Kịch bản, Storyboard) $\rightarrow$ Khảo sát hiện trường $\rightarrow$ Bấm máy tác nghiệp $\rightarrow$ Dựng thô $\rightarrow$ Chỉnh màu & Sound Design $\rightarrow$ Bàn giao Master 4K & Lưu trữ vĩnh viễn.
   - **Section 6 (Dự Án Video Tiêu Biểu):** Lưới 6 tác phẩm có video modal player phát trực tiếp.
   - **Section 7 (Bảng Giá & Gói Dịch Vụ):** 3 Gói sản xuất tham khảo kèm link sang `/bang-gia`.
   - **Section 8 (CTA Band):** "Lên lịch khảo sát hiện trường & nhận đề xuất kịch bản sơ bộ miễn phí" $\rightarrow$ Nút Đặt lịch ngay.
6. **UI Tái sử dụng:** Video modal player, Before/After slider, Gear console, Bento bts grid, Process timeline, CTA band.
7. **SEO & Schema JSON-LD:**
   - Meta Title: `Sản Xuất Phim TVC Doanh Nghiệp & Quay Phim 4K - Truyền Thông Cửu Long`
   - Meta Description: `Xưởng phim sản xuất TVC quảng cáo 4K, phim tài liệu doanh nghiệp và video viral chuyên nghiệp với trang thiết bị điện ảnh hiện đại.`
   - Schema: `Service` với `provider = Truyền Thông Cửu Long`.
8. **Độ ưu tiên:** ⭐ **Rất cao (Cao)**.

---

#### Trang 8: Quảng Cáo & Truyền Thông Số
1. **URL & Route:** `/dich-vu/marketing` | `Route::get('/dich-vu/marketing', [ServiceController::class, 'marketing'])->name('services.marketing');`
   - **View:** `resources/views/services/marketing.blade.php`
2. **Trạng thái hiện tại:** Đang trỏ vào `services.show` (slug `digital-marketing-quang-cao`). Chưa có landing page chuyên sâu thể hiện năng lực chạy quảng cáo hiệu quả (Performance Marketing).
3. **Mục đích:** Cung cấp giải pháp kéo khách hàng tiềm năng, tối ưu chi phí và phủ sóng thương hiệu trên các nền tảng số (Google, Meta, TikTok, YouTube).
4. **Nguồn dữ liệu:** Bảng `services` (slug `digital-marketing-quang-cao`), case studies số liệu tăng trưởng.
5. **Cấu trúc Section đề xuất:**
   - **Section 1 (Small Hero):** Breadcrumb (`Trang chủ > Dịch vụ > Quảng Cáo & Truyền Thông Số`) + Badge `PERFORMANCE MARKETING & GROWTH` + H1 "Chiến Lược Truyền Thông Số Toàn Diện, Quảng Cáo Chuyển Đổi Cao & Tăng Trưởng Doanh Thu Bền Vững".
   - **Section 2 (3 Trụ Cột Tăng Trưởng Số Thực Chiến):**
     1. *Quảng Cáo Trả Phí Đa Nền Tảng (Paid Ads)*: TikTok Ads, Meta Ads (Facebook/Instagram), Google Ads (Search & Performance Max).
     2. *SEO Tổng Thể & Tiếp Thị Nội Dung (SEO & Content)*: Nghiên cứu từ khóa ngành, viết bài chuẩn SEO, tối ưu thứ hạng Google bền vững.
     3. *Xây Kênh Mạng Xã Hội & Sáng Tạo Nội Dung Viral*: Xây dựng kênh TikTok/Fanpage, duy trì lịch đăng nội dung, quản trị tương tác cộng đồng.
   - **Section 3 (Lợi Thế Độc Quyền: Tự Sản Xuất Nội Dung):**
     > 🛑 **ĐIỀU CHỈNH QUAN TRỌNG:** Xóa bỏ tuyên bố "giảm 40-60% giá thầu CPM/CPA" chưa có dữ liệu kiểm chứng.  
     > *Thay bằng mô tả định tính:* **Tối ưu ngân sách quảng cáo nhờ tận dụng chính tư liệu video chất lượng cao do ekip nội bộ tự sản xuất, giảm phụ thuộc vào việc mua stock content hoặc thuê bên thứ ba, đồng thời nâng cao tính xác thực và tỷ lệ tương tác của mẫu quảng cáo.**
   - **Section 4 (Quy Trình Quản Trị Chiến Dịch 5 Bước):** Nghiên cứu thị trường & Insight khách hàng $\rightarrow$ Cài đặt mã đo lường chuyển đổi $\rightarrow$ Sản xuất mẫu quảng cáo đa định dạng $\rightarrow$ Thử nghiệm A/B Testing & Phân bổ ngân sách $\rightarrow$ Báo cáo số liệu định kỳ.
   - **Section 5 (Cam Kết Dịch Vụ):** Minh bạch 100% tài khoản quảng cáo, báo cáo dashboard trực quan, không dùng thủ thuật vi phạm chính sách nền tảng.
   - **Section 6 (Chính Sách Phí Quản Trị Tham Khảo):** Các hình thức tính phí quản lý chiến dịch linh hoạt kèm liên kết tới `/bang-gia`.
   - **Section 7 (CTA Band):** "Đăng ký nhận phân tích tài khoản quảng cáo & Đề xuất kế hoạch phân bổ ngân sách miễn phí" $\rightarrow$ Form đăng ký.
6. **UI Tái sử dụng:** Metric cards, Process steps, Comparative cards, Dashboard preview mockup, CTA band.
7. **SEO & Schema JSON-LD:**
   - Meta Title: `Dịch Vụ Quảng Cáo Số & Truyền Thông Đa Kênh - Truyền Thông Cửu Long`
   - Meta Description: `Giải pháp chạy quảng cáo Google, Facebook, TikTok và SEO tổng thể kết hợp tư liệu hình ảnh chất lượng cao tối ưu chuyển đổi doanh thu.`
   - Schema: `Service` với `provider = Truyền Thông Cửu Long`.
8. **Độ ưu tiên:** ⭐ **Rất cao (Cao)**.

---

#### Trang 9: Booking Team Media
1. **URL & Route:** `/booking` | `Route::get('/booking', [ServiceController::class, 'booking'])->name('booking');`
   - **View:** `resources/views/services/booking.blade.php`
2. **Trạng thái hiện tại:** Chưa có route và view riêng; header hiện tại đang trỏ vào link liên hệ kèm param (`/lien-he?service=booking-media`). Cần tạo trang chuyên biệt phục vụ nhu cầu thuê ekip nhanh.
3. **Mục đích:** Kênh chuyển đổi hỏa tốc cho các doanh nghiệp, đơn vị tổ chức sự kiện cần thuê ekip quay phim, chụp ảnh, bay flycam tác nghiệp ngắn ngày theo giờ/buổi/ngày với báo giá rõ ràng tức thì.
4. **Nguồn dữ liệu:** Tĩnh (gói nhân sự, danh mục thiết bị) + Form gửi yêu cầu lưu vào bảng `contacts` (`service_interested = 'booking-media'`).
5. **Cấu trúc Section đề xuất:**
   - **Section 1 (Small Hero):** Breadcrumb (`Trang chủ > Dịch vụ > Booking Team Media`) + Badge `ON-DEMAND PRODUCTION CREW` + H1 "Đặt Lịch Ekip Quay Phim, Chụp Ảnh & Livestream Tác Nghiệp Hỏa Tốc" + Cam kết có mặt đúng hẹn.
   - **Section 2 (3 Gói Thuê Ekip Tiêu Chuẩn):**
     1. *Gói Nửa Ngày (Half-day / 4 Giờ)*: 1 Quay phim chính + 1 Máy Sony FX + Ống kính chuyên dụng + Mic thu âm $\rightarrow$ Bàn giao file RAW trong ngày.
     2. *Gói Trọn Ngày (Full-day / 8 Giờ)*: 2 Quay phim + Đèn trường quay + Flycam 4K + Sound recorder $\rightarrow$ Phù hợp hội nghị, gala, sự kiện.
     3. *Gói Livestream Sự Kiện Đa Máy*: Bàn switcher trực tiếp, 3-4 góc máy 4K, đường truyền chuyên dụng.
   - **Section 3 (Tùy Chọn Bổ Sung - Add-ons):** Tùy chọn thêm: Giám đốc hình ảnh (DOP), Thợ bay Flycam chuyên nghiệp, Chụp ảnh sự kiện giao ngay, MC song ngữ.
   - **Section 4 (Form Đặt Lịch Thông Minh):** Chọn ngày tác nghiệp, địa điểm, chọn gói ekip, chọn thiết bị bổ sung $\rightarrow$ Hiển thị dự toán sơ bộ $\rightarrow$ Nút Giữ lịch tác nghiệp.
   - **Section 5 (Cam Kết Dịch Vụ):** Đúng giờ tuyệt đối, trang thiết bị kiểm định kỹ lưỡng trước khi bấm máy, bảo hiểm file dữ liệu an toàn 100%.
   - **Section 6 (CTA Band):** "Cần điều động ekip khẩn cấp trong vòng 4-12 giờ tới?" $\rightarrow$ Hotline trực chiến 24/7.
6. **UI Tái sử dụng:** Interactive booking form, Package pricing cards, Add-on selection chips, CTA band.
7. **SEO & Schema JSON-LD:**
   - Meta Title: `Booking Ekip Quay Phim & Chụp Ảnh Sự Kiện - Truyền Thông Cửu Long`
   - Meta Description: `Dịch vụ cho thuê ekip quay phim, livestream sự kiện, bay flycam 4K chuyên nghiệp tác nghiệp theo giờ, buổi và trọn gói ngày.`
   - Schema: `Service` kết hợp `Offer`.
8. **Độ ưu tiên:** **Cao**.

---

### NHÓM 3: LIÊN KẾT FOOTER & DỊCH VỤ CỐT LÕI

#### Trang 10: Kho Giao Diện Mẫu (Templates Showcase)
1. **URL & Route:** `/kho-giao-dien` | `Route::get('/kho-giao-dien', [TemplateShowcaseController::class, 'index'])->name('templates.index');`
   - **View:** `resources/views/templates/index.blade.php`
2. **Trạng thái hiện tại:** Đã có code chức năng lọc theo ngành và tìm kiếm bài viết category `template-website`. Tuy nhiên giao diện hiện tại dùng màu xanh trời (`sky-600`), padding cũ `pt-28`, thiếu breadcrumb, chưa có modal xem demo trực quan.
3. **Mục đích:** Thư viện giới thiệu 39+ mẫu giao diện website đa ngành nghề được tối ưu sẵn của TechLab; giúp khách hàng doanh nghiệp dễ dàng hình dung sản phẩm và rút ngắn thời gian triển khai xuống chỉ còn 48 giờ.
4. **Nguồn dữ liệu:** Bảng `posts` (lọc category `template-website`), bảng `categories` (danh mục 13 nhóm ngành nghề thực tế).
5. **Cấu trúc Section đề xuất:**
   - **Section 1 (Small Hero):** Breadcrumb (`Trang chủ > Kho giao diện mẫu`) + Badge `TECHLAB TEMPLATE HUB` + H1 "Kho Giao Diện Website Đa Ngành Chuẩn SEO & Tối Ưu Tốc Độ" + Khung tìm kiếm từ khóa giao diện.
   - **Section 2 (Thanh Lọc 13 Nhóm Ngành):** Dải chip danh mục dạng viên thuốc (Pill tabs) theo bảng màu Deep Navy/Amber: Bất động sản, Xây dựng, Du lịch - Khách sạn, Nhà hàng - F&B, Giáo dục, Y tế, Thời trang, v.v.
   - **Section 3 (Lưới Thẻ Giao Diện Mẫu):** Thẻ template gồm: Ảnh chụp giao diện cuộn (Scrollable Mockup), Tag ngành, Tên mẫu, Điểm số hiệu năng Google PageSpeed 98/100, Nút "Xem Demo Trực Tiếp" (mở iframe/modal preview), Nút "Chọn Giao Diện Này" (dẫn sang form tư vấn kèm mã mẫu web).
   - **Section 4 (Phân Trang Chuẩn):** Laravel Pagination đồng bộ phong cách tối Deep Navy.
   - **Section 5 (Quy Trình Triển Khai 48 Giờ):** 1. Chọn mẫu giao diện $\rightarrow$ 2. Cung cấp logo & thông tin $\rightarrow$ 3. CLM tùy biến & nạp dữ liệu $\rightarrow$ 4. Trỏ tên miền & Bàn giao vận hành.
   - **Section 6 (CTA Band):** "Không tìm thấy giao diện phù hợp với ngành đặc thù của bạn? Chúng tôi thiết kế bản vẽ độc quyền theo yêu cầu" $\rightarrow$ Nút Yêu cầu thiết kế riêng.
6. **UI Tái sử dụng:** Template cards từ tab 2 trang chủ (`#panel-templates`), Category chip filter, Live preview modal, 3-step timeline, CTA band.
7. **SEO & Schema JSON-LD:**
   - Meta Title: `Kho Giao Diện Mẫu Website Đa Ngành Chuẩn SEO - Truyền Thông Cửu Long`
   - Meta Description: `Khám phá 39+ mẫu giao diện website chuẩn SEO, tương thích mọi thiết bị di động, tốc độ tải nhanh, sẵn sàng triển khai trong 48 giờ.`
   - Schema: `CollectionPage` kết hợp danh sách `Product` / `SoftwareApplication`.
8. **Độ ưu tiên:** **Cao**.

---

#### Trang 11: Tài Nguyên Số / Download Center
1. **URL & Route:** `/tai-nguyen` | `Route::get('/tai-nguyen', [ResourceCenterController::class, 'index'])->name('resources.index');`
   - **Route tải:** `Route::post('/tai-nguyen/download', [ResourceCenterController::class, 'downloadLead'])->name('resources.download');`
   - **View:** `resources/views/resources/index.blade.php`
2. **Trạng thái hiện tại:** Đã có code logic thu thập số điện thoại/email để tải tài nguyên (227 dòng). Tuy nhiên UI padding cũ `pt-28`, thiếu breadcrumb, phong cách card tải cần nâng cấp đồng bộ Deep Navy/Amber.
3. **Mục đích:** Trung tâm Lead Magnet thu hút khách hàng tiềm năng thông qua việc chia sẻ miễn phí tài liệu giá trị cao (LUTs màu, Ebook, Mẫu Brief).
4. **Nguồn dữ liệu:** Bảng `posts` (lọc theo `pillar_group = 'resource'`), bảng `contacts` (ghi nhận thông tin người tải).
5. **Cấu trúc Section đề xuất:**
   - **Section 1 (Small Hero):** Breadcrumb (`Trang chủ > Tài nguyên số`) + Badge `FREE DIGITAL ASSETS` + H1 "Trung Tâm Tài Nguyên Số Miễn Phí Dành Cho Doanh Nghiệp & Nhà Sáng Tạo" + Ô tìm kiếm tài liệu.
   - **Section 2 (Phân Loại Tài Nguyên 4 Nhóm):**
     1. *Color Presets / LUTs*: Bộ preset chỉnh màu DaVinci Resolve & Premiere Pro độc quyền của ekip CLM.
     2. *Ebook & Cẩm Nang*: Cẩm nang sản xuất video ngắn triệu view, tài liệu SEO tổng thể.
     3. *Biểu Mẫu & Kịch Bản*: Mẫu Brief sản xuất TVC, mẫu kịch bản phân cảnh video.
     4. *Hợp Đồng Mẫu*: Mẫu hợp đồng dịch vụ công nghệ, mẫu thỏa thuận bảo mật thông tin NDA.
   - **Section 3 (Lưới Thẻ Tài Nguyên):** Thẻ tải gồm: Thumbnail tài liệu dạng 3D book mockup, Định dạng file (PDF, .CUBE, DOCX), Dung lượng, Nút "Tải Miễn Phí".
   - **Section 4 (Modal Thu Thập Thông Tin - Lead Capture):** Popup nhập Họ tên + Số điện thoại/Zalo để hệ thống gửi đường link tải trực tiếp.
   - **Section 5 (CTA Chuyển Đổi Dịch Vụ):** "Bạn thích các tài nguyên này? Hãy để đội ngũ CLM trực tiếp triển khai chiến dịch cho thương hiệu của bạn."
   - **Section 6 (CTA Band):** Đăng ký nhận tài nguyên mới định kỳ hàng tháng.
6. **UI Tái sử dụng:** Lead capture modal, Download card mockup, Category tabs, Form validation, CTA band.
7. **SEO & Schema JSON-LD:**
   - Meta Title: `Trung Tâm Tài Nguyên Số & Tải Miễn Phí - Truyền Thông Cửu Long`
   - Meta Description: `Tải miễn phí bộ LUTs màu DaVinci Resolve, ebook chiến lược truyền thông, mẫu brief sản xuất TVC và tài liệu quản trị số.`
   - Schema: `CollectionPage` kết hợp `DigitalDocument`.
8. **Độ ưu tiên:** **Trung bình**.

---

#### Trang 12: Bảng Giá Dịch Vụ
1. **URL & Route:** `/bang-gia` | `Route::get('/bang-gia', [CompanyController::class, 'pricing'])->name('pricing');`
   - **View:** `resources/views/pages/pricing.blade.php`
2. **Trạng thái hiện tại:** Đã có code trang (263 dòng) kèm công cụ tính chi phí tự động (Cost Estimator) bằng Alpine.js. Tuy nhiên padding cũ `pt-28`, thiếu breadcrumb chuẩn, cần cập nhật đầy đủ bảng giá của cả 3 mảng (Video, Web, Marketing) và đồng bộ tone Deep Navy/Amber.
3. **Mục đích:** Cung cấp thông tin chi phí rõ ràng, tạo cảm giác minh bạch, chuyên nghiệp, hỗ trợ khách hàng tự dự toán ngân sách trước khi liên hệ, giúp tỷ lệ chuyển đổi form tư vấn đạt mức cao nhất.
4. **Nguồn dữ liệu:** Dữ liệu gói giá tĩnh biên tập chuẩn + Logic tính toán tức thời bằng Alpine.js.
5. **Cấu trúc Section đề xuất:**
   - **Section 1 (Small Hero):** Breadcrumb (`Trang chủ > Bảng giá dịch vụ`) + Badge `TRANSPARENT PRICING & ESTIMATOR` + H1 "Bảng Giá Dịch Vụ Minh Bạch & Dự Toán Chi Phí Tức Thời" + Cam kết hợp đồng SLA không chi phí ẩn.
   - **Section 2 (Bộ Chuyển Đổi Danh Mục Giá):** Tab chuyển đổi: Gói Sản Xuất Video/TVC | Gói Thiết Kế Web/App | Gói Quản Trị Quảng Cáo Số.
   - **Section 3 (Các Bảng Giá 3 Cấp Độ - Tier Cards):**
     - *Gói Khởi Nghiệp (Starter)*: Phù hợp doanh nghiệp vừa và nhỏ, ngân sách tối ưu.
     - *Gói Tăng Trưởng (Growth - Khuyên dùng)*: Nổi bật với viền ánh vàng Amber, đầy đủ tính năng mạnh mẽ nhất.
     - *Gói May Đo Doanh Nghiệp (Enterprise)*: Tùy biến toàn diện theo yêu cầu khắt khe.
   - **Section 4 (Công Cụ Dự Toán Tự Động Thông Minh - Cost Estimator):** Cho phép người dùng trượt chọn thời lượng video, tick chọn flycam/diễn viên, chọn số trang web $\rightarrow$ Hệ thống tự động tính tổng tiền VNĐ ngay lập tức $\rightarrow$ Nút "Nhận Báo Giá File PDF Qua Zalo".
   - **Section 5 (Bảng So Sánh Chi Tiết Quyền Lợi):** So sánh chi tiết từng hạng mục công việc giữa các gói.
   - **Section 6 (Chính Sách Cam Kết & Điều Khoản Thanh Toán):** Chia đợt thanh toán linh hoạt 40% - 40% - 20%, chính sách bảo hành mã nguồn dài hạn, bàn giao toàn bộ bản quyền video gốc.
   - **Section 7 (Câu Hỏi Thường Gặp Về Chi Phí - Pricing FAQ):** Accordion giải đáp các thắc mắc về phát sinh chi phí, hóa đơn VAT, thời gian bảo trì.
   - **Section 8 (CTA Band):** "Cần bảng báo giá chi tiết có dấu mộc đỏ công ty để trình ban giám đốc?" $\rightarrow$ Nút Nhận báo giá chính thức trong 2 giờ.
6. **UI Tái sử dụng:** Alpine Cost Estimator, Pricing tier cards, Comparison table, FAQ accordion, CTA band.
7. **SEO & Schema JSON-LD:**
   - Meta Title: `Bảng Giá Dịch Vụ & Dự Toán Chi Phí - Truyền Thông Cửu Long`
   - Meta Description: `Bảng giá chi phí sản xuất phim TVC quảng cáo, thiết kế web/app và quản trị truyền thông số. Công cụ tự tính dự toán chi phí trực tuyến tức thì.`
   - Schema: `WebPage` kết hợp `PriceSpecification`.
8. **Độ ưu tiên:** ⭐ **Rất cao (Cao)**.

---

#### Trang 13: Dự Án & Case Studies
1. **URL & Route:** `/du-an` | `Route::get('/du-an', [CaseStudyController::class, 'index'])->name('projects.index');`
   - **View danh sách:** `resources/views/projects/index.blade.php`
   - **View chi tiết:** `resources/views/projects/show.blade.php`
2. **Trạng thái hiện tại:** Đã có code kết nối bảng `case_studies` (161 dòng) và chức năng mở video lightbox. Tuy nhiên UI còn đơn giản, padding cũ `pt-28`, thiếu breadcrumb, chưa có bộ lọc 2 cấp và chưa hiển thị các chỉ số đo lường hiệu quả (KPI metrics).
3. **Mục đích:** Thư viện chứng minh năng lực thực tế toàn diện nhất của CLM; đóng vai trò quyết định trong việc thuyết phục các đối tác lớn ký hợp đồng bằng việc phô diễn các tác phẩm đã làm kèm số liệu thành công thực tế.
4. **Nguồn dữ liệu:** Bảng database `case_studies` (`title`, `slug`, `client_name`, `group`, `thumbnail`, `gallery`, `content`, `year`, `featured`, `kpi_metrics`, `video_url`).
5. **Cấu trúc Section đề xuất:**
   - **Section 1 (Small Hero):** Breadcrumb (`Trang chủ > Dự án & Case Studies`) + Badge `PROVEN TRACK RECORD` + H1 "Những Dự Án Điện Ảnh & Công Nghệ Tiêu Biểu Kiến Tạo Tăng Trưởng" + Chỉ số tổng kết (Hàng trăm chiến dịch và sản phẩm đã bàn giao).
   - **Section 2 (Bộ Lọc Dự Án 2 Cấp Độ):**
     - Cấp 1 (Lĩnh vực): Tất cả | Sản Xuất Điện Ảnh Media | Nền Tảng Công Nghệ TechLab.
     - Cấp 2 (Nhóm ngành): Du lịch - Lữ hành | Tài chính - Doanh nghiệp | Nông nghiệp - Sản xuất | Y tế - Giáo dục.
   - **Section 3 (Lưới Dự Án Nổi Bật):** Card dự án gồm: Ảnh thumbnail sắc nét, Nút Play xem video showreel trực tiếp qua Lightbox, Badge tên khách hàng & Năm thực hiện, 2 Chỉ số kết quả đạt được (nếu có).
   - **Section 4 (Phân Trang Chuẩn):** Laravel Pagination đồng bộ Deep Navy.
   - **Section 5 (Case Study Trọng Điểm - Deep-Dive Showcase):** Khối Bento phân tích sâu 1 dự án điển hình (Bối cảnh $\rightarrow$ Thách thức $\rightarrow$ Giải pháp của CLM $\rightarrow$ Kết quả đạt được).
   - **Section 6 (CTA Band):** "Bạn có bài toán thương hiệu tương tự? Hãy để ekip CLM đồng hành giải quyết" $\rightarrow$ Nút Đặt lịch tư vấn chiến lược.
6. **UI Tái sử dụng:** Video modal player, Project card layout, 2-tier filter pills, Deep-dive bento layout, Pagination, CTA band.
7. **SEO & Schema JSON-LD:**
   - Meta Title: `Dự Án & Case Studies Tiêu Biểu - Truyền Thông Cửu Long`
   - Meta Description: `Khám phá các dự án sản xuất phim TVC 4K, phim tài liệu doanh nghiệp và hệ thống website đã triển khai thành công tại Truyền Thông Cửu Long.`
   - Schema: `CollectionPage` kết hợp danh sách `CreativeWork`.
8. **Độ ưu tiên:** ⭐ **Rất cao (Cao)**.

---

## 4. KẾ HOẠCH PHÂN KỲ & QUY TRÌNH QUẢN TRỊ GIT (GIT WORKFLOW)

Toàn bộ 13 trang con được phân thành **3 đợt triển khai** theo đúng thứ tự ưu tiên kinh doanh. Nhằm đảm bảo an toàn tuyệt đối cho mã nguồn và khả năng rollback tức thì, mỗi đợt sẽ tuân thủ nghiêm ngặt quy trình Git sau:

```
[main] ─────────────────────────────────────────────────────────► [Production]
  │
  ├──► [branch: feature/subpages-batch-1] ──► (Test & QA) ──► Merge vào main
  │
  ├──► [branch: feature/subpages-batch-2] ──► (Test & QA) ──► Merge vào main
  │
  └──► [branch: feature/subpages-batch-3] ──► (Test & QA) ──► Merge vào main
```

### ĐỢT 1: TRANG DỊCH VỤ CỐT LÕI & MINH CHỨNG NĂNG LỰC (4 TRANG - ƯU TIÊN CAO NHẤT)
*Mục tiêu: Hoàn thiện ngay các trang trực tiếp đem lại khách hàng và chốt hợp đồng lớn.*
- **Git Branch:** `feature/subpages-batch-1`
- **Danh sách 4 trang:**
  1. **Trang 6:** `/dich-vu/web-app` (Landing page Thiết kế & Lập trình Web/App)
  2. **Trang 7:** `/dich-vu/media` (Landing page Quay Phim & Sản Xuất Media)
  3. **Trang 8:** `/dich-vu/marketing` (Landing page Quảng Cáo & Truyền Thông Số)
  4. **Trang 13:** `/du-an` (Trang Thư viện Dự Án & Case Studies có bộ lọc và video modal)

### ĐỢT 2: TRANG BÁN HÀNG, CÔNG CỤ TÍNH PHÍ & TẠO KHÁCH TIỀM NĂNG (4 TRANG)
*Mục tiêu: Tối ưu hóa phễu chuyển đổi qua công cụ tính giá tự động, booking hỏa tốc và kho tài nguyên.*
- **Git Branch:** `feature/subpages-batch-2`
- **Danh sách 4 trang:**
  5. **Trang 12:** `/bang-gia` (Bảng giá chi tiết & Bộ công cụ Cost Estimator tự động)
  6. **Trang 9:** `/booking` (Booking Ekip Media hỏa tốc 24/7)
  7. **Trang 10:** `/kho-giao-dien` (Kho 39+ Template website chuẩn hóa Deep Navy/Amber)
  8. **Trang 11:** `/tai-nguyen` (Trung tâm Download Lead Magnet chuẩn hóa)

### ĐỢT 3: TRANG UY TÍN THƯƠNG HIỆU, ĐỘI NGŨ & HỆ SINH THÁI (5 TRANG)
*Mục tiêu: Củng cố niềm tin tổ chức, phô diễn chiều sâu nhân sự Senior và mạng lưới đối tác/khách hàng thật.*
- **Git Branch:** `feature/subpages-batch-3`
- **Danh sách 5 trang:**
  9. **Trang 1:** `/ve-chung-toi` (Câu chuyện thương hiệu & Triết lý Dual DNA)
  10. **Trang 2:** `/ve-chung-toi/doi-ngu` (Hồ sơ năng lực chuyên gia Senior — *Bắt buộc cập nhật thông tin nhân sự thật*)
  11. **Trang 4:** `/doi-tac` (17 Đối tác chiến lược thật từ website cũ)
  12. **Trang 5:** `/khach-hang` (26 Khách hàng tiêu biểu thật & Đánh giá Testimonials)
  13. **Trang 3:** `/tuyen-dung` (Cơ hội nghề nghiệp & Văn hóa doanh nghiệp)

---

## 5. KẾ HOẠCH KIỂM THỬ TỔNG THỂ SAU MỖI ĐỢT (VERIFICATION PLAN)

Sau khi hoàn tất code cho mỗi đợt, AI Agent và đội ngũ phát triển **bắt buộc phải thực hiện đủ 5 bước kiểm thử** sau trước khi được phép chuyển sang đợt tiếp theo:

1. **Kiểm tra Breadcrumb & Điều hướng (Zero 404 Check):**
   - Click kiểm tra từng mắt xích breadcrumb trên mọi trang con (`Trang chủ > [Nhóm] > [Trang]`), đảm bảo trỏ về đúng route và có đánh dấu trang hiện tại (active state).
   - Rà soát toàn bộ liên kết nội bộ trong trang (link xem demo, link báo giá, link sang trang liên hệ), đảm bảo 100% không còn link chết hoặc link `#` rỗng.
2. **Kiểm thử Form & Logic Backend (Functional Testing):**
   - Kiểm tra mọi form gửi dữ liệu: Form nộp CV (`/tuyen-dung/apply`), Form tải tài nguyên (`/tai-nguyen/download`), Form tư vấn/booking (`/lien-he`, `/booking`).
   - Xác nhận: Có token `@csrf`, có validate lỗi tiếng Việt rõ ràng, dữ liệu được ghi nhận chính xác vào bảng database tương ứng (`job_applications`, `contacts`), có flash message thông báo thành công.
3. **Đo lường Hiệu năng & Tối ưu Google PageSpeed / Lighthouse (Mobile & Desktop):**
   - Chạy kiểm thử Lighthouse trên trình duyệt cho toàn bộ các trang trong đợt đó:
     - **Performance Mobile:** Đạt tối thiểu $\ge 80$.
     - **Performance Desktop:** Đạt tối thiểu $\ge 90$.
     - **Accessibility:** Đạt tối thiểu $\ge 90$.
     - **Best Practices:** Đạt tối thiểu $\ge 90$.
     - **SEO:** Đạt tối thiểu $\ge 95$.
4. **Kiểm thử Responsive & Đệm Spacing chuẩn hóa:**
   - Kiểm tra hiển thị trên 3 breakpoint: Mobile (< 768px), Tablet (768px - 1023px), Desktop ($\ge$ 1024px).
   - Đảm bảo tuân thủ đúng mức padding đã chuẩn hóa: `py-12 lg:py-16`, tiêu đề `mb-10 lg:mb-12`, không bị vỡ giao diện hoặc tràn ngang màn hình (`overflow-x`).
5. **Xác thực Cấu trúc Dữ liệu SEO (Rich Snippets Validation):**
   - Kiểm tra mã nguồn HTML của trang đảm bảo có đầy đủ thẻ OpenGraph (og:title, og:image, og:description) và đoạn mã Schema JSON-LD hợp lệ không có lỗi cú pháp.

---

## 6. KẾT LUẬN & DỪNG BƯỚC CHỜ PHÊ DUYỆT LẦN 2

> 🛑 **THÔNG BÁO TỪ AI AGENT:**  
> Toàn bộ 6 điểm chỉ đạo nghiêm ngặt của Người Quản Trị đã được tiếp thu, chỉnh sửa dứt điểm và cập nhật trực tiếp vào file [`subpages-plan.md`](file:///c:/xampp/htdocs/truyenthongcuulong-laravel/subpages-plan.md).  
> Đồng thời, file [`TeamMemberSeeder.php`](file:///c:/xampp/htdocs/truyenthongcuulong-laravel/database/seeders/TeamMemberSeeder.php) đã được gắn comment cảnh báo dữ liệu mẫu rõ ràng.  
> 
> **THEO ĐÚNG CHỈ THỊ:** AI Agent **KHÔNG tự ý viết code Blade / Route của bất kỳ trang nào** tại thời điểm này và **DỪNG LẠI TẠI ĐÂY** để Người Quản Trị kiểm tra, phê duyệt Bản Duyệt Lần 2 trước khi bắt đầu khởi tạo branch và code Đợt 1!
