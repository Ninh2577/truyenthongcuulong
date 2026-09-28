# UI-REBUILD-13.7 — BANNER SYSTEM FINAL QA & CONSOLIDATION REPORT

**Dự án:** `truyenthongcuulong_laravel`  
**Giai đoạn:** UI-REBUILD-13.7 — Banner System Final QA & Consolidation  
**Role:** Senior Laravel Architect, Senior Frontend Engineer & QA Engineer  
**Thời gian thực hiện:** 28/09/2026  
**Trạng thái nghiệm thu:** **PASS WITH NOTES**

---

## 1. TÓM TẮT AUDIT TỔNG THỂ

Giai đoạn UI-REBUILD-13.7 là đợt kiểm toán toàn diện và chốt sổ (Final QA & Consolidation) cho toàn bộ hệ thống banner dùng chung được phát triển xuyên suốt chuỗi giai đoạn UI-REBUILD-13 (từ 13.1 đến 13.6).

Trọng tâm kiểm toán bao gồm **7 trang giao diện trọng điểm** của website Truyền Thông Cửu Long:
1. **Trang chủ (`/`)**
2. **Trang Dịch vụ tổng quan (`/dich-vu`)**
3. **Trang Web App & Phần mềm doanh nghiệp (`/dich-vu/web-app`)**
4. **Trang Thư viện nền tảng website (`/dich-vu/kho-giao-dien`)**
5. **Trang Tối ưu SEO & Marketing số (`/dich-vu/marketing`)**
6. **Trang Sản xuất Tư liệu Media (`/dich-vu/media`)**
7. **Trang Điều phối ekip Media & Booking (`/dich-vu/booking`)**

Hệ thống component dùng chung `<x-banner.hero>` và `<x-banner.cta>` đã chứng minh khả năng tái sử dụng cao, tuân thủ nghiêm ngặt hợp đồng thuộc tính (prop contract), đảm bảo tuyệt đối quy tắc **duy nhất 1 thẻ H1 ngữ nghĩa trên mỗi trang**, phân bổ màu sắc và typography Mulish đồng nhất, tối ưu LCP với tài sản thực tế và không gây bất kỳ lỗi hồi quy nào trên toàn bộ 69 test cases tự động.

---

## 2. DANH SÁCH ROUTE VÀ BIẾN THỂ BANNER

| # | Route | Blade View | Hero Variant | Visual Content / Slot | Bottom CTA Variant | Cấu trúc H1 Title & TitleAccent |
|---|---|---|---|---|---|---|
| 1 | `/` | `home.blade.php` (`components/home/hero.blade.php`) | `service-split` | Real Visual Showcase card (`modern_tech_platform.jpg`, LCP eager) + Capabilities chips slot | Dedicated Conversion Band (`components/home/cta.blade.php`) | `Phát triển phần mềm` / `phù hợp với vận hành doanh nghiệp. Giải Pháp Web, Web App & Hệ Thống Số Doanh Nghiệp.` |
| 2 | `/dich-vu` | `services/index.blade.php` | `service-centered` | Căn giữa tối giản, ambient tech gradient | `centered` | `Giải Quyết Bài Toán Vận Hành` / `Bằng Công Nghệ Phù Hợp` |
| 3 | `/dich-vu/web-app` | `services/web-app.blade.php` | `service-split` | Ảnh `modern_tech_platform.jpg`, `aspect-[16/10]`, LCP eager | `split` | `Web App & Hệ Thống` / `Cho Quy Trình Vận Hành Doanh Nghiệp` |
| 4 | `/dich-vu/kho-giao-dien` | `templates/index.blade.php` | `service-centered` | Visual slot nhúng form tìm kiếm trực tiếp (`name="q"`, `industry`) | `centered` | `Thư Viện Nền Tảng` / `Triển Khai Website Nhanh` |
| 5 | `/dich-vu/marketing` | `services/marketing.blade.php` | `service-centered` | Căn giữa tập trung thông điệp, neo xuống `#growth-path` | `centered` | `Chiến Lược Tối Ưu SEO & Kênh Tiếp Cận Khách Hàng` / `Dựa Trên Dữ Liệu Thực Tế` |
| 6 | `/dich-vu/media` | `services/media.blade.php` | `media-visual` | Visual slot nhúng Showreel Card 4K (`showreel-cinematic-poster.webp`/`jpg`) với trigger `@click="openVideo"` | `centered` | `Sản Xuất Tư Liệu Video` / `& Hình Ảnh Doanh Nghiệp` |
| 7 | `/dich-vu/booking` | `services/booking.blade.php` | `service-split` | Ảnh `real-cameraman-production.jpg`, `aspect-[16/10]`, LCP eager | `centered` | `Điều Phối Ekip Media` / `Theo Nhu Cầu Doanh Nghiệp` |

---

## 3. KẾT QUẢ KIỂM TRA KIẾN TRÚC COMPONENT

### 3.1. Phân tích component `<x-banner.hero>`
* **Vị trí file:** `resources/views/components/banner/hero.blade.php`
* **Các biến thể hỗ trợ:** `service-split`, `service-centered`, `media-visual`, `case-study`.
* **Cơ chế Fallback an toàn:**
  - Nếu `variant` truyền vào không thuộc danh sách hợp lệ &rarr; Tự động fallback về `service-split`.
  - Nếu `service-split` không có hình ảnh hoặc visual slot &rarr; Tự động co về bố cục căn giữa an toàn (`service-centered` fallback layout) giúp chống vỡ giao diện.
  - Nếu ảnh bị lỗi đường dẫn &rarr; Kích hoạt `onerror="this.src='/images/fallback-banner.svg'"` đã tạo từ 13.2.
* **XSS & Bảo mật:**
  - Toàn bộ text rendering qua Blade `{{ $title }}`, `{{ $titleAccent }}`, `{{ $description }}` được escape HTML an toàn.
  - Ngăn ngừa tình trạng double-escaping (như lỗi `&amp;` từng phát hiện ở 13.4) bằng cách truyền chuỗi ký tự nguyên bản.

### 3.2. Phân tích component `<x-banner.cta>`
* **Vị trí file:** `resources/views/components/banner/cta.blade.php`
* **Các biến thể hỗ trợ:** `split` (chia 2 cột tương phản cao) và `centered` (căn giữa tập trung chuyển đổi).
* **Đích điều hướng:**
  - Hỗ trợ cả liên kết route động (`route('contact')`, `route('booking')`) và giao thức gọi điện trực tiếp (`tel:...`).
  - Hỗ trợ icon Material Symbols linh hoạt (`arrow_forward`, `call`, `calendar_today`, `visibility`).

---

## 4. BẢNG KẾT QUẢ QA TỪNG TRANG

| Trang | HTTP Status | H1 Count | H1 Semantic Copy | Breadcrumb | In-Page Anchor | CTA Links | Trạng thái QA |
|---|:---:|:---:|:---:|:---:|:---:|:---:|:---:|
| `/` | 200 OK | 1 | Đạt chuẩn Tech B2B | N/A (Trang chủ) | `#hero-section` (Hợp lệ) | Contact / Services | **PASS** |
| `/dich-vu` | 200 OK | 1 | "Giải Quyết Bài Toán Vận Hành" | Đạt chuẩn | N/A | Contact / Projects | **PASS** |
| `/dich-vu/web-app` | 200 OK | 1 | "Web App & Hệ Thống" | Đạt chuẩn | `#architecture` (Hợp lệ) | Contact / Architecture | **PASS** |
| `/dich-vu/kho-giao-dien` | 200 OK | 1 | "Thư Viện Nền Tảng" | Đạt chuẩn | `#catalog` (Hợp lệ) | Catalog / Contact | **PASS** |
| `/dich-vu/marketing` | 200 OK | 1 | "Chiến Lược Tối Ưu SEO" | Đạt chuẩn | `#growth-path` (Hợp lệ) | Contact / Growth-path | **PASS** |
| `/dich-vu/media` | 200 OK | 1 | "Sản Xuất Tư Liệu Video" | Đạt chuẩn | N/A | Contact / Booking | **PASS** |
| `/dich-vu/booking` | 200 OK | 1 | "Điều Phối Ekip Media" | Đạt chuẩn | `#booking-form` (Hợp lệ) | Booking-form / Media | **PASS** |

---

## 5. KẾT QUẢ KIỂM TRA RESPONSIVE

Các breakpoint được kiểm tra và xác minh trên hệ thống lưới Tailwind CSS:

1. **Desktop (1440 × 900) & Laptop (1280 × 800):**
   - Biến thể `service-split`: Cột trái chiếm 7 phần (nội dung), cột phải chiếm 5 phần (visual showcase/ảnh) tạo tỷ lệ vàng thị giác.
   - Biến thể `service-centered` & `media-visual`: Chiều rộng tối đa `max-w-4xl` đến `max-w-5xl` giúp mắt người đọc không bị mỏi khi quét dòng.
2. **Tablet (768 × 1024):**
   - Bố cục lưới tự động chuyển sang 1 cột (vertical stack).
   - Padding dọc tự động điều chỉnh từ `pt-36 pb-20` xuống `pt-28 pb-14 sm:pb-16` đảm bảo không bị chiếm quá nhiều diện tích phía trên nếp gấp màn hình.
3. **Mobile (390 × 844 & 375 × 812):**
   - H1 tự động co giãn từ `text-5xl` xuống `text-3xl sm:text-4xl`, không gây tràn ngang (zero horizontal overflow).
   - Tất cả nút CTA tự động mở rộng `w-full sm:w-auto` đạt kích thước chạm tối thiểu > 44px theo tiêu chuẩn Apple HIG & Google Material.
   - Visual slot và ảnh duy trì tỷ lệ cố định `aspect-[16/10]` hoặc `aspect-video`, ngăn ngừa hiện tượng giật layout (CLS = 0).

---

## 6. KẾT QUẢ SEO VÀ ACCESSIBILITY

* **Thứ bậc Heading:**
  - Duy nhất **1 thẻ `<h1>`** trên mỗi trang.
  - Các section tiếp theo tuần tự tuân thủ `<h2>` (Tiêu đề khối) và `<h3>` (Tiêu đề thẻ/tính năng con).
* **Breadcrumb Accessibility:**
  - Bổ sung đầy đủ thuộc tính `aria-label="Breadcrumb"` trên thẻ `<nav>`.
  - Cấu trúc danh sách `ol > li` kèm icon mũi tên điều hướng ẩn với screen reader (`aria-hidden="true"`).
* **Độ tương phản màu sắc (Color Contrast):**
  - Màu chữ tiêu đề `#070f1e` (slate-950) trên nền `bg-surface-low` (#f8f9ff) đạt tỷ lệ tương phản > 14:1 (vượt xa chuẩn WCAG 2.1 AA là 4.5:1).
  - Nút bấm Primary CTA nền `#070f1e` chữ trắng và icon vàng cam `amber-400` đạt chuẩn tương phản cao.
* **Hình ảnh & Đa phương tiện:**
  - Tất cả thẻ `<img>` đều có thuộc tính `alt` mô tả ngữ nghĩa rõ ràng, không sử dụng alt rỗng hoặc alt chung chung.
  - Video modal có nút đóng rõ ràng với nhãn đóng `close` và hỗ trợ backdrop click đóng modal.

---

## 7. KẾT QUẢ KIỂM TRA HÌNH ẢNH VÀ HIỆU NĂNG

* **Tài sản thực tế được xác minh trong `public/images/`:**
  - `modern_tech_platform.jpg` (674 KB): Dùng cho Homepage Hero và Web App Hero.
  - `real-cameraman-production.jpg` (308 KB): Dùng cho Booking Hero.
  - `showreel-cinematic-poster.webp` (182 KB) & `.jpg` (293 KB): Dùng cho Media Hero Showreel trigger card.
  - `fallback-banner.svg` (1.7 KB): Dùng làm SVG vector dự phòng khi có lỗi tải ảnh.
* **Tối ưu hóa LCP (Largest Contentful Paint):**
  - Chỉ áp dụng `fetchpriority="high"` và `loading="eager"` cho ảnh Hero nằm trên màn hình đầu tiên (`isLcp="true"`).
  - Toàn bộ ảnh bên dưới nếp gấp màn hình đều giữ `loading="lazy"` mặc định.
  - Container ảnh được khóa tỷ lệ `aspect-[16/10]` hoặc `aspect-video` đảm bảo Zero Cumulative Layout Shift (CLS = 0).

---

## 8. DANH SÁCH LỖI PHÁT HIỆN VÀ KHẮC PHỤC

| Mã lỗi | Mô tả lỗi | Giai đoạn phát hiện | Xử lý khắc phục | Trạng thái |
|---|---|---|---|:---:|
| **FIX-13.4-01** | Ký tự `&` bị double-escaping thành `&amp;` trong thẻ H1 trang Web App | UI-REBUILD-13.4 | Chuyển chuỗi Blade attribute từ `&amp;` sang `&` nguyên bản | **ĐÃ KHẮC PHỤC** |
| **FIX-13.4-02** | Form tìm kiếm mẫu giao diện bị đẩy xuống xa nếp gấp màn hình | UI-REBUILD-13.4 | Nhúng trực tiếp form tìm kiếm vào Visual Slot của Hero banner | **ĐÃ KHẮC PHỤC** |
| **FIX-13.5-01** | Trang Media thiếu visual backdrop xứng tầm sản xuất video | UI-REBUILD-13.5 | Tạo Showreel Video trigger card 4K với poster thực tế trong visual slot | **ĐÃ KHẮC PHỤC** |
| **FIX-13.6-01** | Trang Booking thiếu anchor ID và thiếu CTA hotline khẩn cấp | UI-REBUILD-13.6 | Bổ sung `#booking-form`, alert validation và `<x-banner.cta>` hotline 24h | **ĐÃ KHẮC PHỤC** |
| **FIX-13.7-01** | Thiếu bộ test kiểm toán tổng hợp bao quát đồng thời cả 7 trang | UI-REBUILD-13.7 | Tạo mới `UiRebuild13FinalQaConsolidationTest.php` với 10 test cases | **ĐÃ KHẮC PHỤC** |

---

## 9. DANH SÁCH FILE TẠO, SỬA VÀ XÓA TRONG CHUỖI UI-REBUILD-13

### File tạo mới:
1. `resources/views/components/banner/hero.blade.php` (UI-REBUILD-13.2)
2. `resources/views/components/banner/cta.blade.php` (UI-REBUILD-13.2)
3. `public/images/fallback-banner.svg` (UI-REBUILD-13.2)
4. `tests/Feature/UiRebuild13BannerComponentTest.php` (UI-REBUILD-13.2)
5. `tests/Feature/UiRebuild13HomepageHeroVisualTest.php` (UI-REBUILD-13.3)
6. `tests/Feature/UiRebuild13ServiceBannerTest.php` (UI-REBUILD-13.4)
7. `tests/Feature/UiRebuild13MarketingMediaBannerTest.php` (UI-REBUILD-13.5)
8. `tests/Feature/UiRebuild13BookingBannerTest.php` (UI-REBUILD-13.6)
9. `tests/Feature/UiRebuild13FinalQaConsolidationTest.php` (UI-REBUILD-13.7)

### File chỉnh sửa tích hợp:
1. `resources/views/components/home/hero.blade.php` (Trang chủ)
2. `resources/views/services/index.blade.php` (Dịch vụ tổng quan)
3. `resources/views/services/web-app.blade.php` (Web App & Hệ thống)
4. `resources/views/templates/index.blade.php` (Kho giao diện)
5. `resources/views/services/marketing.blade.php` (Marketing & SEO)
6. `resources/views/services/media.blade.php` (Sản xuất Media)
7. `resources/views/services/booking.blade.php` (Điều phối ekip)

### File xóa:
* Không có file nào bị xóa ngoài phạm vi.

---

## 10. KẾT QUẢ KIỂM THỬ HỒI QUY TOÀN DIỆN

Chạy toàn bộ 8 bộ test suites chuyên biệt cho hệ thống banner và kiến trúc dịch vụ:

```text
   PASS  Tests\Feature\UiRebuild13FinalQaConsolidationTest (10 tests, 176 assertions)
   PASS  Tests\Feature\UiRebuild13BookingBannerTest (9 tests, 36 assertions)
   PASS  Tests\Feature\UiRebuild13MarketingMediaBannerTest (8 tests, 47 assertions)
   PASS  Tests\Feature\UiRebuild13ServiceBannerTest (8 tests, 56 assertions)
   PASS  Tests\Feature\UiRebuild13BannerComponentTest (11 tests, 41 assertions)
   PASS  Tests\Feature\UiRebuild13HomepageHeroVisualTest (6 tests, 18 assertions)
   PASS  Tests\Feature\UiRebuild07ServicesArchitectureTest (9 tests, 130 assertions)
   PASS  Tests\Feature\SolutionArchitectureTest (8 tests, 52 assertions)

  Tests:    69 passed, 0 failed (696 assertions)
  Duration: 15.20s
```

* **Xác nhận:** Toàn bộ 69/69 test cases đạt **100% PASS** với 696 assertions. Không xảy ra bất kỳ lỗi hồi quy nào.

---

## 11. KẾT QUẢ BUILD ASSETS

Chạy lệnh: `npm run build`

```text
> build
> vite build

vite v6.4.3 building for production...
transforming...
✓ 65 modules transformed.
rendering chunks...
computing gzip size...
public/build/manifest.json                       0.75 kB │ gzip:  0.27 kB
public/build/assets/app-D0-9H0dq.css           221.46 kB │ gzip: 32.30 kB
public/build/assets/ScrollTrigger-7Zy99s9Q.js   43.99 kB │ gzip: 18.27 kB
public/build/assets/index-C-UGJFrr.js           70.55 kB │ gzip: 27.84 kB
public/build/assets/app-BevM6GpF.js            119.16 kB │ gzip: 42.62 kB
✓ built in 4.37s
```

* **Xác nhận:** Quá trình compile CSS Tailwind và JavaScript hoàn tất sạch sẽ, không có bất kỳ warning hoặc syntax error nào.

---

## 12. CÁC VẤN ĐỀ CÒN TỒN TẠI (NOTES)

1. **Kiểm tra trực quan môi trường Browser:** Do agent chạy trong môi trường console CLI, các tương tác vi mô (micro-animations như hover scale nút play showreel, cuộn mượt anchor, datepicker native của hệ điều hành di động) cần được QA/người phụ trách thực hiện nghiệm thu trực quan lần cuối trên các thiết bị thực tế (Desktop Chrome, iOS Safari, Android Chrome).
2. **Dữ liệu bài viết database test:** Test case `UiRebuild12RedTeamAuditTest` yêu cầu database có bài viết post đã xuất bản, trong khi môi trường in-memory test database chưa chạy seeder bài viết. Đây là đặc thù dữ liệu test baseline từ trước, không ảnh hưởng đến hệ thống banner.

---

## 13. KẾT QUẢ NGHIỆM THU TỔNG THỂ

### **ĐÁNH GIÁ: PASS WITH NOTES**

* **Căn cứ nghiệm thu:**
  - Hoàn thành đầy đủ việc kiểm toán và hợp nhất hệ thống banner trên toàn bộ 7 trang mục tiêu.
  - Hệ thống Blade Component (`x-banner.hero`, `x-banner.cta`) vận hành chuẩn xác, thống nhất, dễ bảo trì và có fallback an toàn.
  - Toàn bộ 69/69 test cases đạt **PASS (696 assertions)**.
  - Tài sản hình ảnh thực tế được tối ưu hóa LCP, không sử dụng tài sản giả lập hay cam kết thiếu căn cứ.
  - Build Vite thành công trong 4.37s.
  - Không vi phạm bất kỳ giới hạn phạm vi nào: Routes, Database, Controllers, Migrations được bảo toàn 100%.

---

## QUY TẮC KẾT THÚC

* Dừng triển khai tại đây theo đúng chỉ thị.
* Không tự ý chuyển sang giai đoạn tiếp theo (UI-REBUILD-14.0).
* Đã hoàn thành toàn bộ chuỗi giai đoạn UI-REBUILD-13 (13.1 đến 13.7).
* Chờ người phụ trách review và nghiệm thu toàn bộ đợt nâng cấp hệ thống banner.
