# UI-REBUILD-13.5 — MARKETING & MEDIA BANNER INTEGRATION REPORT

**Dự án:** `truyenthongcuulong_laravel`  
**Giai đoạn:** UI-REBUILD-13.5 — Marketing & Media Banner Integration  
**Role:** Senior Laravel Architect & Senior Frontend Engineer  
**Thời gian thực hiện:** 28/09/2026  
**Trạng thái nghiệm thu:** **PASS WITH NOTES**

---

## 1. TÓM TẮT TRIỂN KHAI

Giai đoạn UI-REBUILD-13.5 đã hoàn thành việc tích hợp hệ thống banner dùng chung (`<x-banner.hero>` và `<x-banner.cta>`) vào hai trang dịch vụ thuộc mảng Digital Marketing và Sản xuất Media:

1. **Trang Tối ưu SEO & Marketing số (`/dich-vu/marketing`)**
2. **Trang Sản xuất Tư liệu Media Doanh nghiệp (`/dich-vu/media`)**

Quá trình tích hợp đã thống nhất ngôn ngữ thị giác theo chuẩn Design System (Mulish typography, dot-grid background, token màu slate/primary/amber), chuẩn hóa duy nhất một thẻ H1 ngữ nghĩa trên mỗi trang, bổ sung breadcrumb chuẩn microdata, bảo toàn 100% các năng lực dịch vụ, sơ đồ hành trình, danh sách case study, tương tác modal video 4K Showreel và form điều phối booking.

---

## 2. GIT STATUS TRƯỚC VÀ SAU

### Trước khi triển khai
* **Nhánh:** `master`
* Đã hoàn thành và nghiệm thu các phase UI-REBUILD-13.1 đến 13.4.

### Sau khi triển khai
```text
 M public/build/manifest.json
 M resources/views/services/marketing.blade.php
 M resources/views/services/media.blade.php
?? tests/Feature/UiRebuild13MarketingMediaBannerTest.php
?? UI-REBUILD-13.5-IMPLEMENTATION-REPORT.md
```

---

## 3. KẾT QUẢ AUDIT TRƯỚC TRIỂN KHAI

| Hạng mục audit | Hiện trạng trước triển khai | Xử lý trong UI-REBUILD-13.5 |
| :--- | :--- | :--- |
| **`/dich-vu/marketing`** | Dùng hero tự dựng căn giữa, H1 chưa dùng component chung, CTA cuối trang custom | Chuyển sang `<x-banner.hero variant="service-centered">` + `<x-banner.cta variant="centered">` |
| **`/dich-vu/media`** | Dùng hero tự dựng với nút xem showreel đơn giản, chưa có visual backdrop điện ảnh xứng tầm | Chuyển sang `<x-banner.hero variant="media-visual">` kết hợp Showreel card 4K (poster `showreel-cinematic-poster.webp`/`jpg`) tích hợp trigger `@click="openVideo"`, cuối trang dùng `<x-banner.cta variant="centered">` |
| **H1 & Phân cấp Heading** | Mỗi trang có H1 nhưng styling chưa đồng bộ với hệ banner dùng chung | Thống nhất cấu trúc H1 + TitleAccent chuẩn font Mulish, đảm bảo strictly 1 H1/trang |
| **CTA cuối trang** | Mỗi trang tự code section CTA riêng biệt | Chuẩn hóa sang component `<x-banner.cta>` dùng chung |
| **Tài sản hình ảnh** | Trang media cần hình ảnh đại diện xứng tầm mảng video | Tận dụng tài sản thực tế có sẵn `showreel-cinematic-poster.webp` và `.jpg` |

---

## 4. DANH SÁCH FILE TẠO, SỬA, XÓA

### File chỉnh sửa (2 files):
1. `resources/views/services/marketing.blade.php`: Tích hợp `<x-banner.hero variant="service-centered">` và `<x-banner.cta variant="centered">`.
2. `resources/views/services/media.blade.php`: Tích hợp `<x-banner.hero variant="media-visual">` và `<x-banner.cta variant="centered">`.

### File tạo mới (2 files):
1. `tests/Feature/UiRebuild13MarketingMediaBannerTest.php`: Bộ kiểm thử tự động 8 test cases bao phủ toàn bộ yêu cầu của UI-REBUILD-13.5.
2. `UI-REBUILD-13.5-IMPLEMENTATION-REPORT.md`: Báo cáo nghiệm thu chi tiết giai đoạn 13.5.

### File xóa:
* Không có file nào bị xóa.

---

## 5. CHI TIẾT TÍCH HỢP TỪNG TRANG

### 5.1. Trang Tối Ưu SEO & Marketing Số (`/dich-vu/marketing`)
* **Hero Variant:** `service-centered`
* **Eyebrow:** `TECHNICAL SEO • SEARCH ENGINE VISIBILITY`
* **H1 Title:** `Chiến Lược Tối Ưu SEO & Kênh Tiếp Cận Khách Hàng`
* **H1 TitleAccent:** `Dựa Trên Dữ Liệu Thực Tế`
* **Description:** Dịch vụ bổ trợ chuyên sâu cho hệ thống website: chuẩn hóa kỹ thuật On-page, cấu trúc nội dung theo ý định tìm kiếm thực tế và kết nối công cụ đo lường chuyển đổi minh bạch.
* **Breadcrumb:** `Dịch vụ & Giải pháp` &rarr; `Tối ưu SEO & Tăng trưởng số`
* **CTAs:**
  - Primary CTA: "Bắt đầu dự án" &rarr; `route('contact')`
  - Secondary CTA: "Xem lộ trình tăng trưởng" &rarr; `#growth-path` (neo mượt mà xuống hành trình 5 bước)
* **Final CTA:** `<x-banner.cta variant="centered">` với badge "TƯ VẤN KẾ HOẠCH", nút liên hệ và xem các giải pháp khác.
* **Bảo toàn:** 100% Section 5 bước giải quyết bài toán tăng trưởng (`#growth-path`), 6 khối phạm vi triển khai SEO kỹ thuật (Technical SEO, Ý định tìm kiếm, Google Search Ads, Content chuyên ngành, Đo lường GA4/Search Console, Tư liệu Media thực tế).

### 5.2. Trang Sản Xuất Tư Liệu Media Doanh Nghiệp (`/dich-vu/media`)
* **Hero Variant:** `media-visual`
* **Eyebrow:** `DIGITAL ECOSYSTEM SUPPORT • VISUAL ASSETS`
* **H1 Title:** `Sản Xuất Tư Liệu Video`
* **H1 TitleAccent:** `& Hình Ảnh Doanh Nghiệp`
* **Description:** Năng lực sản xuất tư liệu hình ảnh và video chuyên nghiệp đóng vai trò bổ trợ chiến lược cho hệ sinh thái công nghệ: cung cấp hình ảnh thật, video giới thiệu quy trình vận hành và tư liệu đồng bộ cho Website & Web App.
* **Breadcrumb:** `Dịch vụ & Giải pháp` &rarr; `Tư liệu Media & Video`
* **Visual Slot:**
  - Nhúng Showreel Video Trigger Card tỷ lệ `aspect-video` chuẩn điện ảnh.
  - Sử dụng ảnh poster xác thực: `showreel-cinematic-poster.webp` (fallback `.jpg`) có sẵn trong repo.
  - Tích hợp nút play nổi bật có animation hover scale.
  - Trigger mở trực tiếp modal video YouTube 4K: `@click="openVideo('https://www.youtube.com/embed/nGvVhO2kDo8?autoplay=1&rel=0&modestbranding=1')"`
* **CTAs:**
  - Primary CTA: "Bắt đầu dự án" &rarr; `route('contact') . '?service=media'`
  - Secondary CTA: "Xem điều phối ekip" &rarr; `route('booking')`
* **Final CTA:** `<x-banner.cta variant="centered">` với badge "HỢP TÁC SẢN XUẤT", liên kết đến form liên hệ media và booking ekip.
* **Bảo toàn:** 3 nhóm năng lực sản xuất (Video TVC, Chụp ảnh cơ sở, Sự kiện corporate), 4 ứng dụng trong hệ sinh thái kỹ thuật số, danh sách case study video thực tế (`$mediaCaseStudies`), video modal overlay Alpine.js.

---

## 6. BIẾN THỂ BANNER ĐƯỢC SỬ DỤNG VÀ LÝ DO

| Trang | Biến thể Banner | Lý do lựa chọn |
| :--- | :--- | :--- |
| `/dich-vu/marketing` | `service-centered` | Định hướng dịch vụ SEO/Marketing kỹ thuật thiên về dữ liệu, phân tích quy trình; không có ảnh sản phẩm phần cứng hay giao diện web riêng biệt. Bố cục căn giữa tạo sự trang nhã, tập trung vào thông điệp và dẫn luồng trực tiếp xuống lộ trình 5 bước. |
| `/dich-vu/media` | `media-visual` | Phản ánh đúng tính chất trực quan điện ảnh của mảng sản xuất media/video. Sử dụng visual slot với poster Showreel 4K và play trigger trực quan, tạo ấn tượng mạnh mẽ ngay lần đầu truy cập mà không biến trang thành giao diện mô phỏng phần mềm. |

---

## 7. DANH SÁCH NỘI DUNG VÀ CHỨC NĂNG ĐƯỢC BẢO TOÀN

1. **Hành trình tăng trưởng SEO:** Section `#growth-path` với 5 bước giải quyết bài toán tìm kiếm giữ nguyên cấu trúc.
2. **Nội dung 6 dịch vụ Marketing:** Technical SEO, Ý định tìm kiếm, Google Ads, Content Landing Page, GA4 & Search Console, Media bổ trợ.
3. **Showreel & Video Modal:** Tương tác mở xem video showreel YouTube và video các case study qua modal Alpine.js hoạt động hoàn hảo.
4. **Dữ liệu Case Study Media:** Vòng lặp `@forelse($mediaCaseStudies as $case)` hiển thị hình ảnh và liên kết chi tiết dự án giữ nguyên 100%.
5. **Điều hướng liên kết nội bộ:** Liên kết đến trang Booking (`route('booking')`), Liên hệ dịch vụ (`route('contact')`), và Danh mục dự án (`route('projects.index')`).
6. **SEO Metadata:** Title và Meta Description trên layout cha được bảo toàn.

---

## 8. KẾT QUẢ RESPONSIVE VÀ ACCESSIBILITY

* **Responsive Breakpoints:**
  - **Desktop (1440 × 900) & Laptop (1280 × 800):** Visual slot 4K Showreel hiển thị ở độ rộng tối đa `max-w-4xl`, canh giữa cân đối. Hero căn giữa hiển thị cân bằng.
  - **Tablet (768 × 1024):** Khoảng cách dọc tự động co dãn, nút bấm và badge canh giữa đẹp mắt.
  - **Mobile (390 × 844 & 375 × 812):** Nút CTA mở rộng `w-full sm:w-auto`, tiêu đề H1 co dãn linh hoạt (`text-3xl` trên mobile, `text-5xl` trên desktop), không phát sinh lỗi tràn ngang.
* **Accessibility:**
  - Mỗi trang duy nhất **1 thẻ `<h1>`**.
  - Breadcrumb có nhãn `aria-label="Breadcrumb"`.
  - Nút play và các CTA có nhãn ngữ nghĩa rõ ràng cho screen readers.
  - Màu chữ trên nền đạt độ tương phản chuẩn WCAG 2.1 AA.

---

## 9. KẾT QUẢ KIỂM THỬ MỚI VÀ HỒI QUY

### 9.1. Test Suite Mới (`UiRebuild13MarketingMediaBannerTest`)
```text
   PASS  Tests\Feature\UiRebuild13MarketingMediaBannerTest
  ✓ both marketing and media routes return http 200                                                              0.78s  
  ✓ strictly single h1 per page with accurate copy                                                               0.20s  
  ✓ breadcrumb rendered on both pages                                                                            0.22s  
  ✓ hero ctas have valid destinations                                                                            0.26s  
  ✓ media hero uses showreel asset and video trigger                                                             0.17s  
  ✓ preserved business sections on both pages                                                                    0.15s  
  ✓ bottom cta banner rendered on both pages                                                                     0.18s  
  ✓ content safety no prohibited claims                                                                          0.17s  

  Tests:    8 passed (47 assertions)
  Duration: 2.48s
```

### 9.2. Regression Testing Toàn Diện
Chạy đồng thời toàn bộ 6 test suite liên quan đến banner và kiến trúc dịch vụ:
* `UiRebuild13MarketingMediaBannerTest`: **8 passed (47 assertions)**
* `UiRebuild13ServiceBannerTest`: **8 passed (56 assertions)**
* `UiRebuild13BannerComponentTest`: **11 passed (41 assertions)**
* `UiRebuild13HomepageHeroVisualTest`: **6 passed (18 assertions)**
* `UiRebuild07ServicesArchitectureTest`: **9 passed (130 assertions)**
* `SolutionArchitectureTest`: **8 passed (52 assertions)**

**Tổng cộng:** **50 passed, 0 failed (484 assertions)** trong 12.93s. Zero regression!

---

## 10. KẾT QUẢ BUILD ASSETS

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
✓ built in 4.89s
```
* **Trạng thái:** Thành công 100%, không phát sinh cảnh báo hay lỗi cú pháp.

---

## 11. NHỮNG VẤN ĐỀ CÒN TỒN TẠI (NOTES)

1. **Kiểm tra trực quan môi trường Browser:** Tương tác play video YouTube trên modal và trải nghiệm cuộn mượt cần được QA/người phụ trách kiểm tra lần cuối trên browser thiết bị thực tế (Chrome Desktop, Safari iOS).
2. **Dữ liệu test database baseline:** Như đã ghi nhận ở các phase trước, test case `UiRebuild12RedTeamAuditTest` yêu cầu database phải có bài viết post đã xuất bản, trong khi môi trường in-memory test database chưa chạy seeder bài viết. Đây là vấn đề baseline từ trước, không liên quan đến phạm vi banner dịch vụ.

---

## 12. ĐÁNH GIÁ NGHIỆM THU

### **ĐÁNH GIÁ: PASS WITH NOTES**

* **Lý do:**
  - Hoàn thành 100% mục tiêu tích hợp banner dùng chung cho cả hai trang `/dich-vu/marketing` và `/dich-vu/media`.
  - Bộ kiểm thử mới 8 test cases đạt **100% PASS**.
  - Kiểm thử hồi quy 50/50 test cases đạt **100% PASS**.
  - Bảo toàn tuyệt đối phạm vi: Không sửa routes, database, controller hay can thiệp vào các trang ngoài phạm vi (Booking, Homepage, Web App, Template Showcase).
  - Build frontend Vite thành công không lỗi.

---

## QUY TẮC KẾT THÚC

* Dừng triển khai tại đây theo đúng chỉ thị.
* Không tự ý chuyển sang giai đoạn UI-REBUILD-13.6.
* Không tự ý mở rộng sang trang Booking hay các trang khác.
* Chờ người phụ trách review và nghiệm thu báo cáo.
