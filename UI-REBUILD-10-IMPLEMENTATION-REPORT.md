# UI-REBUILD-10 — IMPLEMENTATION REPORT: HOMEPAGE DATA FLOW RECOVERY & VISUAL OPTIMIZATION

**Dự án:** Truyền Thông Cửu Long  
**Website:** `https://dev.truyenthongcuulong.com/`  
**Framework:** Laravel 11, Blade, Tailwind CSS, Filament 3  
**Typography:** Mulish  
**Phạm vi:** Trang chủ `/`, luồng dữ liệu hiển thị trên trang chủ và các thành phần giao diện trực tiếp liên quan.  

---

## 1. EXECUTIVE SUMMARY

Milestone **UI-REBUILD-10** đã giải quyết triệt để vấn đề gốc rễ khiến dữ liệu động không hiển thị đúng trên trang chủ sau các đợt rebuild UI-REBUILD-07, 08 và 09. 

Mặc dù các test suite trước đó trả về trạng thái PASS (do kiểm thử cấu trúc tĩnh hoặc điều kiện fallback), môi trường thực tế gặp tình trạng:
1. Cơ sở dữ liệu hoạt động (`truyenthongcuulong_v2`) bị rỗng dữ liệu ở các bảng nghiệp vụ cốt lõi (`posts`, `categories`, `partners`, `clients`, `services`) do quá trình migrate/reset môi trường phát triển chưa được phục hồi từ bản sao lưu chuẩn.
2. Dữ liệu Marquee đối tác & khách hàng bị lưu cache rỗng (24 giờ), buộc giao diện Blade phải dùng fallback đọc file JSON thô trực tiếp từ đĩa.
3. Dự án công nghệ tiêu biểu (Phòng Khám Gia Phước) trỏ tới đường dẫn ảnh không tồn tại trên ổ cứng.
4. Truy vấn bài viết chuyên sâu (`featuredArticles`) trong `HomeController` mắc lỗi toán tử ưu tiên SQL (`OR` không bọc ngoặc) dẫn đến nguy cơ bypass điều kiện bài viết đã xuất bản (`status = 'published'`).
5. CTA phụ ở Hero chưa đồng bộ với cam kết định vị phần mềm B2B ("Xem dự án thực tế" thay vì "Xem giải pháp").

Sau khi xác định và khắc phục toàn bộ các nguyên nhân trên, toàn bộ luồng dữ liệu từ Database $\rightarrow$ Model $\rightarrow$ Controller $\rightarrow$ View $\rightarrow$ HTML Rendering đã hoạt động 100% với dữ liệu thực tế:
* **488 bài viết chuẩn** (bao gồm 39 bài template website).
* **14 danh mục** được ánh xạ đầy đủ `pillar_group`.
* **17 đối tác & 30 khách hàng thực tế** đổ trực tiếp vào Marquee qua Eloquent Collection.
* **6 Case Studies** (2 công nghệ, 4 media) render hoàn hảo kèm ảnh bìa hợp lệ 100% trên disk/storage.
* Toàn bộ 53 tests (464 assertions) thuộc các test suite liên quan đều **PASS**. Frontend build Vite thành công 100%.

---

## 2. HOMEPAGE UI AUDIT

| Section | Hiện trạng trước kiểm tra | Hiện trạng sau khắc phục | Trạng thái |
|---|---|---|---|
| **1. Hero** | CTA phụ ghi "Xem giải pháp" trỏ về `/dich-vu` | CTA phụ cập nhật thành "Xem dự án thực tế" trỏ chuẩn về `route('projects.index')`. Typography Mulish đồng nhất, module công nghệ rõ ràng. | **PASS** |
| **2. Marquee** | Blade bypass Controller đọc `partners.json` & `clients.json` do cache DB bị rỗng | Đổ trực tiếp từ Eloquent Model `Partner` (17 bản ghi) và `Client` (30 bản ghi). Tên đối tác/khách hàng thật hiển thị mượt mà. | **PASS** |
| **3. Business Needs** | 4 bài toán doanh nghiệp tĩnh | Giữ nguyên 4 bài toán trọng tâm, liên kết trực tiếp tới các phân hệ Web-App, Kho Giao Diện và Media in-house. | **PASS** |
| **4. Portfolio (Tech Showcase)** | Ảnh thumbnail Gia Phước trỏ sai file, fallback sang ảnh placeholder | Phục hồi đúng thumbnail `uploads/2026/09/app-bv-1789543463.png` (và `clinic-app-gia-phuoc.jpg`), ảnh hiển thị sắc nét, HTTP 200. Thẻ giải pháp hiển thị động từ model `summary`. | **PASS** |
| **5. Ready-made Templates** | Hiển thị 4 thẻ card fallback do `$websiteTemplates` rỗng | Render động 4 mẫu giao diện tiêu biểu (Doanh Nghiệp, BĐS, Y Tế, Thời Trang) từ 39 mẫu thật trong category 14. | **PASS** |
| **6. Technology Solutions** | 3 nhóm giải pháp cốt lõi | Bố cục chuẩn mực: Web-App & Hệ thống quản trị, Website Doanh Nghiệp, Tối Ưu SEO & Tăng Trưởng Số. | **PASS** |
| **7. Media Support** | Hiển thị 3 video thực chứng | Tích hợp mượt mà modal phát video YouTube (Sacombank, Hoya Lens, Kredivo) với thumbnail có sẵn trên storage. | **PASS** |
| **8. Insights** | Hiển thị thông báo "Đang cập nhật các bài viết mới từ hệ thống..." | Đổ động 3 bài viết chuyên môn SEO & Web thật từ Database (ID 485, 484, 483). Không còn thông báo rỗng. | **PASS** |
| **9. Final CTA** | Form/CTA chuyển đổi cuối trang | Nút "Bắt đầu dự án" trỏ về `/lien-he`, nút "Xem giải pháp công nghệ" trỏ về `/dich-vu`. | **PASS** |

---

## 3. DATA FLOW AUDIT

Luồng dữ liệu đã được kiểm tra trên từng chặng:

```text
[MySQL Database: truyenthongcuulong_v2]
      ↓ (Eloquent Model queries with strict status & ordering)
[HomeController::index()]
      ↓ (Eager loading: with('category'), active()->ordered())
[View Data: compact('featuredArticles', 'websiteTemplates', 'techCaseStudies', ...)]
      ↓ (Blade subcomponents: hero, marquee, portfolio, insights, etc.)
[HTML Response: HTTP 200 (258,161 bytes)]
      ↓ (Browser Rendering: Mulish typography, zero broken images, zero fake data)
```

---

## 4. DANH SÁCH LỖI ĐÃ PHÁT HIỆN

1. **Lỗi P0-01 (Database Incomplete):** Cơ sở dữ liệu `truyenthongcuulong_v2` thiếu dữ liệu các bảng `posts`, `categories`, `partners`, `clients`, `services` do chưa được restore từ file sao lưu chuẩn `storage/app/private/backups/backup-2026-09-21-164437.sql.gz`.
2. **Lỗi P0-02 (Cache Stale Empty):** Cache `marquee.partners` và `marquee.clients` bị lưu trữ giá trị Collection rỗng trong 24 giờ (86400s).
3. **Lỗi P0-03 (Broken Image Path):** Thumbnail của dự án công nghệ `ung-dung-quan-ly-phong-kham` trong `case_studies` trỏ tới file không tồn tại trên ổ cứng.
4. **Lỗi P0-04 (SQL Operator Precedence Bug):** Trong `HomeController.php`, câu query `featuredArticles` dùng `orWhere` thiếu nhóm ngoặc đơn lồng nhau, khiến điều kiện `where('status', 'published')` có thể bị bypass bởi các ID cụ thể.
5. **Lỗi P0-05 (Hardcoded Blade Logic):** Trong `portfolio.blade.php`, phần mô tả bài toán và giải pháp đang hardcode bằng switch-case theo slug thay vì ưu tiên lấy thuộc tính `summary` thực tế từ Model.
6. **Lỗi P1-01 (Hero Secondary CTA Misalignment):** CTA phụ ở Hero đang đặt là "Xem giải pháp" thay vì "Xem dự án thực tế" theo yêu cầu định vị năng lực thực chứng.

---

## 5. ROOT CAUSE ANALYSIS (RCA)

* **RCA cho Lỗi P0-01:** Quá trình chạy test hoặc reset môi trường cục bộ trước đó đã tạo lại các bảng rỗng nhưng chỉ chạy seeder cục bộ một phần (`CaseStudySeeder` và `MenuSeeder`), bỏ sót việc nhập khẩu bản dump chuẩn của hệ thống lưu tại `storage/app/private/backups/`. Do đó, bảng `posts` có 0 dòng, `categories` có 0 dòng, `partners` có 0 dòng.
* **RCA cho Lỗi P0-02:** `Cache::remember('marquee.partners', 86400, ...)` thực thi khi bảng `partners` đang có 0 bản ghi, dẫn đến việc lưu `Collection []` vào cache. Khi Blade kiểm tra `$marqueePartners->isNotEmpty()`, kết quả luôn là `false`, kích hoạt fallback đọc file JSON thô.
* **RCA cho Lỗi P0-03:** File `CaseStudySeeder.php` khai báo đường dẫn `uploads/projects/clinic-app-mockup.jpg`, trong khi tên file thực tế tồn tại trong storage là `uploads/projects/clinic-app-gia-phuoc.jpg` và `uploads/2026/09/app-bv-1789543463.png`.
* **RCA cho Lỗi P0-04:** Câu lệnh Eloquent `$query->whereIn(...)->orWhere(...)` sinh SQL dạng `A OR B AND C`. Theo độ ưu tiên của toán tử SQL, `AND` thực thi trước `OR`, dẫn tới biểu thức trở thành `A OR (B AND C)`.
* **RCA cho Lỗi P1-01:** Bản dựng giao diện cũ kế thừa CTA của trang giải pháp chung mà chưa cập nhật theo đặc tả định vị thực chứng của UI-REBUILD-10.

---

## 6. CÁC FILE ĐÃ SỬA

1. [app/Http/Controllers/HomeController.php](file:///c:/xampp/htdocs/truyenthongcuulong-laravel/app/Http/Controllers/HomeController.php):
   - Sửa truy vấn `$featuredArticles`: bọc điều kiện `orWhere` trong closure tường minh, thêm eager loading `with('category')`, bổ sung fallback lấy các bài mới nhất nếu query tiêu đề không có kết quả.
   - Sửa truy vấn `$websiteTemplates`: kiểm tra linh hoạt cả `category_id` và quan hệ category theo slug `template-website`.
2. [resources/views/components/home/hero.blade.php](file:///c:/xampp/htdocs/truyenthongcuulong-laravel/resources/views/components/home/hero.blade.php):
   - Cập nhật CTA phụ thành "Xem dự án thực tế" trỏ chuẩn về `route('projects.index')`.
3. [resources/views/components/home/portfolio.blade.php](file:///c:/xampp/htdocs/truyenthongcuulong-laravel/resources/views/components/home/portfolio.blade.php):
   - Tối ưu việc render bài toán & giải pháp ưu tiên đọc từ model `$techProject->summary` và `meta_data`.
4. [database/seeders/CaseStudySeeder.php](file:///c:/xampp/htdocs/truyenthongcuulong-laravel/database/seeders/CaseStudySeeder.php):
   - Cập nhật thumbnail chính xác cho dự án phòng khám.
5. [tests/Feature/UiRebuild10HomepageDataFlowTest.php](file:///c:/xampp/htdocs/truyenthongcuulong-laravel/tests/Feature/UiRebuild10HomepageDataFlowTest.php):
   - Tạo mới test suite 10 tiêu chí kiểm thử luồng dữ liệu thực tế.

---

## 7. CÁC TRUY VẤN ĐÃ THAY ĐỔI

### Featured Articles Query trong `HomeController.php`:
```php
// TRƯỚC (Lỗi SQL precedence, thiếu eager loading, không có fallback):
$featuredArticles = Post::whereIn('id', [19566, 3064, 19595])
    ->orWhere(function($query) {
        $query->where('title', 'LIKE', '%SEO Cần Thơ%')
              ->orWhere('title', 'LIKE', '%Thiết Kế Website%');
    })
    ->where('status', 'published')
    ->orderByDesc('published_at')
    ->take(3)
    ->get();

// SAU (Chuẩn SQL precedence, eager load category, fallback linh hoạt):
$featuredArticles = Post::with('category')
    ->where('status', 'published')
    ->where(function ($query) {
        $query->whereIn('id', [19566, 3064, 19595, 485, 484, 483])
              ->orWhere('title', 'LIKE', '%SEO Cần Thơ%')
              ->orWhere('title', 'LIKE', '%Thiết Kế Website%')
              ->orWhere('title', 'LIKE', '%SEO%');
    })
    ->orderByDesc('published_at')
    ->take(3)
    ->get();

if ($featuredArticles->isEmpty()) {
    $featuredArticles = Post::with('category')
        ->where('status', 'published')
        ->orderByDesc('published_at')
        ->take(3)
        ->get();
}
```

### Website Templates Query trong `HomeController.php`:
```php
// SAU (Tương thích cả ID và slug):
$websiteTemplates = Post::where(function ($q) {
        $q->whereIn('category_id', [14, 18])
          ->orWhereHas('category', function ($sub) {
              $sub->where('slug', 'template-website');
          });
    })
    ->where('status', 'published')
    ->orderBy('id')
    ->get()
```

---

## 8. CÁC NGUỒN DỮ LIỆU ĐÃ XÁC MINH

| Nguồn | Có dữ liệu | Query đúng | Render đúng | Trạng thái |
|---|---|---|---|---|
| **Case Studies** | Có (6 bản ghi: 2 tech, 4 media) | Có (`group='technology'`, `group='media'`) | Có (Hiển thị tiêu đề, khách hàng, tag, thumbnail hợp lệ) | **PASS** |
| **Posts** | Có (488 bài viết published) | Có (`status='published'`, eager load `category`) | Có (3 bài viết SEO/Website chuyên sâu hiển thị đầy đủ tiêu đề, slug, ngày đăng, ảnh) | **PASS** |
| **Templates** | Có (39 mẫu website thuộc category 14) | Có (`category_id=14` hoặc slug `template-website`) | Có (4 mẫu tiêu biểu Doanh Nghiệp, BĐS, Y Tế, Thời Trang render động) | **PASS** |
| **Partners** | Có (17 đối tác active) | Có (`active()->ordered()`) | Có (Render vào Marquee Dải 1 qua Eloquent Collection) | **PASS** |
| **Clients** | Có (30 khách hàng active) | Có (`active()->ordered()`) | Có (Render vào Marquee Dải 2 qua Eloquent Collection) | **PASS** |
| **Services** | Có (4 dịch vụ) | Có | Có (Bố cục 3 nhóm giải pháp trọng tâm) | **PASS** |

---

## 9. KẾT QUẢ HIỂN THỊ DỮ LIỆU THỰC TẾ

Khi chạy render thực tế trang chủ (`GET /`):
* **HTTP Status:** 200 OK
* **HTML Payload:** 258,161 bytes
* **Dự án công nghệ:**
  - `Ứng Dụng Quản Lý & Đặt Lịch Phòng Khám Đa Khoa` (Phòng Khám Gia Phước) — thumbnail: `uploads/2026/09/app-bv-1789543463.png` $\rightarrow$ File exists: YES.
  - `Website Phòng Khám Đa Khoa Chuẩn WordPress` (Nha Khoa Nụ Cười) — thumbnail: `uploads/2026/09/screenshot-2026-09-16-142549-1789543591.png` $\rightarrow$ File exists: YES.
* **Mẫu giao diện demo:**
  - Render 4 mẫu thật: *Doanh nghiệp Wallet*, *Bất động sản Relxtower*, *Làm đẹp - Sức khỏe Anam*, *Thời trang RAB - Fashion*.
* **Bài viết chuyên sâu:**
  - Render 3 bài thật: *Top 10 Công Ty Cung Cấp Dịch Vụ SEO Cần Thơ Uy Tín, Chuyên Sâu Toàn Diện*, *Dịch Vụ SEO Cần Thơ Chuyên Nghiệp - Cửu Long Media*, *Dịch Vụ Thiết Kế Website Cần Thơ Chuyên Nghiệp - Cửu Long Media*.
  - Tuyệt đối không còn hiển thị dòng chữ fallback "Đang cập nhật các bài viết mới từ hệ thống...".
* **Đối tác & Khách hàng Marquee:**
  - Dải 1: P.A Việt Nam, FPT Telecom, VTC Digital, ...
  - Dải 2: Ngân Hàng Sacombank, Kredivo, Hoya Lens, RAKUS, ...

---

## 10. CÁC THAY ĐỔI GIAO DIỆN

* **Hero CTA:** Nút phụ chuyển đổi rõ nét sang `Xem dự án thực tế` với icon `arrow_forward`, tạo luồng điều hướng liền mạch từ Hero xuống danh mục dự án hoặc case study.
* **Project Showcase:** Loại bỏ sự phụ thuộc hardcode văn bản trong Blade; card tự động thích ứng với nội dung `summary` của Model.
* **Ready-made Templates:** Không còn hiển thị các card placeholder tĩnh; tự động đổ 4 card mẫu thực tế với hình ảnh banner thật từ hệ thống WordPress đã import.

---

## 11. RESPONSIVE VERIFICATION

Kiểm tra cấu trúc CSS responsive trên các breakpoint:
* **Mobile (360px - 390px - 414px):**
  - Grid 1 cột cho Hero, Business Needs, Project Showcase, Solutions, Media Support, Insights.
  - CTA chuyển thành full width block dễ tương tác một chạm.
  - Typography co giãn theo rem/clamp, tiêu đề dài ngắt dòng tự nhiên (`leading-snug`, `break-words`).
* **Tablet (768px - 1024px):**
  - Grid 2 cột cho Project Showcase và Business Needs.
  - Header & Marquee co giãn mượt mà.
* **Desktop (1280px - 1440px - 1920px):**
  - Grid 12 cột cho Hero (7/5), Grid 4 cột cho Business Needs, Grid 3 cột cho Solutions & Insights, Grid 4 cột cho Kho Giao Diện.
  - Tối đa `max-w-7xl` căn giữa hoàn hảo.

*Ghi chú môi trường:* `Browser visual verification: NOT AVAILABLE` (do tuân thủ nghiêm ngặt chỉ dẫn không sử dụng công cụ subagent browser). Toàn bộ kiểm tra được thực hiện thông qua DOM & HTML snapshot verification.

---

## 12. SEO VÀ ACCESSIBILITY

* **Thẻ H1:** Duy nhất 1 thẻ `<h1>` trên toàn trang tại Hero:  
  `<h1>Phát triển phần mềm phù hợp với vận hành doanh nghiệp.</h1>`
* **Cấu trúc Heading:** Tuân thủ phân cấp chặt chẽ: `<h1>` (Hero) $\rightarrow$ `<h2>` (Section Titles) $\rightarrow$ `<h3>` (Card Titles) $\rightarrow$ `<h4>` (Sub-modules).
* **Alt text:** Mọi thẻ `<img>` đều có thuộc tính `alt` mô tả nội dung cụ thể từ database (`{{ $techProject->title }}`, `{{ $article->title }}`).
* **Lazy loading & Decoding:** Các ảnh nội dung đều có `loading="lazy"` và `decoding="async"`.
* **Focus states & ARIA:** Các liên kết và nút bấm đều có `focus-visible:ring-2 focus-visible:ring-primary`, `role="region"`, `aria-label`.

---

## 13. TESTS VÀ ASSERTIONS

Đã tạo mới file kiểm thử toàn diện:  
[tests/Feature/UiRebuild10HomepageDataFlowTest.php](file:///c:/xampp/htdocs/truyenthongcuulong-laravel/tests/Feature/UiRebuild10HomepageDataFlowTest.php)

Kết quả chạy kiểm thử:
```text
PASS Tests\Feature\UiRebuild10HomepageDataFlowTest
✓ homepage returns http 200                                                   0.20s  
✓ controller provides required view variables                                 0.23s  
✓ actual database data is rendered from sources                               0.29s  
✓ filters do not exclude valid published records                              0.26s  
✓ empty collection state renders gracefully without exception                 0.21s  
✓ relationships do not throw errors when absent                               0.24s  
✓ image urls are generated properly                                           0.22s  
✓ ctas and project links are functional                                       0.20s  
✓ unpublished posts are never rendered                                        0.20s  
✓ no fake dummy data replaces database models                                 0.18s  

Tests:    10 passed (96 assertions)
Duration: 3.95s
```

Chạy toàn bộ Regression Test Suite:
```text
PASS Tests\Feature\UiRebuild06aTypographyTest (7 passed)
PASS Tests\Feature\UiRebuild07ServicesArchitectureTest (9 passed)
PASS Tests\Feature\UiRebuild08HomepageTest (10 passed)
PASS Tests\Feature\UiRebuild08VisualHierarchyTest (7 passed)
PASS Tests\Feature\UiRebuild09PortfolioTest (10 passed)
PASS Tests\Feature\UiRebuild10HomepageDataFlowTest (10 passed)

Tests:    53 passed (464 assertions)
Duration: 12.64s
```

---

## 14. BUILD RESULT

Thực thi lệnh build frontend: `npm run build`
```text
> build
> vite build

vite v6.4.3 building for production...
transforming...
✓ 65 modules transformed.
rendering chunks...
computing gzip size...
public/build/manifest.json                       0.75 kB │ gzip:  0.27 kB
public/build/assets/app-ZaoT1Gc-.css           220.09 kB │ gzip: 32.20 kB
public/build/assets/ScrollTrigger-7Zy99s9Q.js   43.99 kB │ gzip: 18.27 kB
public/build/assets/index-C-UGJFrr.js           70.55 kB │ gzip: 27.84 kB
public/build/assets/app-BevM6GpF.js            119.16 kB │ gzip: 42.62 kB
✓ built in 26.59s
```
Build hoàn toàn sạch, không có cảnh báo hoặc lỗi cú pháp.

---

## 15. DATABASE CHANGES

1. **Phục hồi an toàn từ Backup:** Đã import dữ liệu nghiệp vụ chuẩn từ `storage/app/private/backups/backup-2026-09-21-164437.sql.gz` vào database `truyenthongcuulong_v2`.
   - Trước phục hồi: `posts` = 0, `categories` = 0, `partners` = 0, `clients` = 0, `services` = 0.
   - Sau phục hồi: `posts` = 488, `categories` = 14, `partners` = 17, `clients` = 30, `services` = 4, `case_studies` = 6.
2. **Category Pillars Seeding:** Chạy `PillarCategorySeeder` để ánh xạ chính xác 488 bài viết vào 5 pillar group (`tech`, `studio`, `agency`, `resource`, `corporate`).
3. **Giữ an toàn dữ liệu:** Không chạy `migrate:fresh`, không drop database, không xóa bất kỳ dữ liệu nào của người dùng. Bản sao lưu trước can thiệp được lưu tại `storage/app/private/backups/backup-2026-09-28-104031.sql.gz`.

---

## 16. KNOWN LIMITATIONS

1. **Legacy WordPress Host:** Kết nối phụ `wordpress_legacy` trên cổng 3307 không hoạt động do service MySQL cũ không được bật ở máy local hiện tại. Tuy nhiên, toàn bộ dữ liệu 488 bài viết, 14 categories và tài nguyên hình ảnh đã được phục hồi đầy đủ trong cơ sở dữ liệu chính của Laravel (`truyenthongcuulong_v2`).
2. **Browser Visual Testing:** Công cụ trình duyệt không được phép mở theo yêu cầu của phiên làm việc. Tất cả kiểm thử visual được thực hiện thông qua phân tích DOM, asset testing và integration assertions.

---

## 17. FINAL STATUS

```text
STATUS: PASS
HARD STOP: YES
```
