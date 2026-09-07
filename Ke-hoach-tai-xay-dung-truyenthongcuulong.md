# KẾ HOẠCH TÁI XÂY DỰNG WEBSITE
## truyenthongcuulong.com — Chuyển đổi từ WordPress sang Laravel (PHP)
### Định hướng: Website Công nghệ & Truyền thông (Agency + Giải pháp công nghệ)

---

## 0. TÓM TẮT DỰ ÁN

| Hạng mục | Hiện trạng | Mục tiêu mới |
|---|---|---|
| Nền tảng | WordPress + Flatsome + UX Builder | Laravel (PHP framework) |
| SEO | Rank Math SEO / SEO PRO | Custom module SEO trong Laravel (spatie/laravel-sitemap, artesaos/seotools) |
| Bảo mật | Wordfence + Solid Security Pro | Bảo mật tầng framework (Laravel Fortify, Sanctum) + Cloudflare WAF |
| Cache | LiteSpeed Cache | Redis cache + OPcache + CDN |
| Mục lục bài viết | Easy Table of Contents | Component Blade/JS tự build |
| Form liên hệ | Contact Form 7 | Form Laravel (Validation + Mail) |
| Chat/CSKH | Buttonizer | Widget chat tùy biến (có thể tích hợp AI) |
| AI | AI Engine (WordPress) | Tích hợp trực tiếp API AI (OpenAI/Claude) vào backend Laravel |
| Nội dung | File .xml (WXR export) | Import & tái cấu trúc vào database Laravel mới |
| Định hướng nội dung | Chưa rõ | Agency truyền thông (nội dung, quảng cáo, PR) **kết hợp** giải pháp công nghệ truyền thông (app, nền tảng, AI) |

**Lưu ý quan trọng:** Đây không còn là một dự án "đổi giao diện" mà là **viết lại toàn bộ website** bằng framework khác. File .xml chỉ dùng được để lấy lại **nội dung văn bản** (bài viết, danh mục, tag) — toàn bộ chức năng của các plugin cũ phải được lập trình lại từ đầu trong Laravel. Đây là dự án ở quy mô phát triển phần mềm, không phải cấu hình CMS.

---

## 1. GIAI ĐOẠN CHUẨN BỊ

### 1.1 Backup & thu thập dữ liệu gốc
- [ ] Backup toàn bộ site WordPress hiện tại (DB + files) — giữ làm bản đối chiếu, KHÔNG xóa cho đến khi site mới go-live ổn định.
- [ ] Tải toàn bộ thư mục `/wp-content/uploads` (ảnh, media) — vì file .xml không chứa ảnh thật, chỉ chứa URL.
- [ ] Xuất danh sách redirect / cấu trúc URL hiện tại từ Rank Math (Redirections) để dựng lại 301 redirect trên Laravel, tránh mất SEO.
- [ ] Ghi lại toàn bộ schema/structured data hiện có (Organization, Article, Breadcrumb...) do Rank Math tạo ra để tái tạo trong Laravel.

### 1.2 Xác định yêu cầu kỹ thuật
- [ ] Chọn phiên bản Laravel (khuyến nghị: Laravel 11.x — bản mới nhất ổn định).
- [ ] Chọn công cụ quản trị nội dung (CMS) cho người không chuyên kỹ thuật — khuyến nghị **Filament PHP** (admin panel mã nguồn mở, xây dựng nhanh trên Laravel) để đội content có thể tự đăng bài như WordPress.
- [ ] Chọn hosting phù hợp Laravel (VPS/Cloud: DigitalOcean, Vultr, hoặc dịch vụ Laravel Forge/Vapor) — khác hoàn toàn hosting shared WordPress hiện tại.
- [ ] Xác định stack frontend: Blade + Alpine.js + Tailwind CSS (khuyến nghị cho tốc độ và khả năng tùy biến giao diện cao cấp), hoặc Laravel + Livewire nếu cần tương tác nhiều mà không muốn viết API riêng.

---

## 2. GIAI ĐOẠN ĐỊNH VỊ THƯƠNG HIỆU & NỘI DUNG

Định hướng đã chốt: **kết hợp Agency truyền thông (nội dung, quảng cáo, PR) + Giải pháp công nghệ truyền thông (app, nền tảng, AI)**.

### 2.1 Kiến trúc thông tin (Sitemap) đề xuất
1. **Trang chủ** — Hero giới thiệu song song 2 mảng (Truyền thông sáng tạo & Giải pháp công nghệ), số liệu ấn tượng, case study nổi bật, logo khách hàng, CTA.
2. **Về chúng tôi** — Câu chuyện thương hiệu, đội ngũ, giá trị cốt lõi, mốc phát triển.
3. **Dịch vụ**
   - Nhóm Truyền thông: sản xuất nội dung, quảng cáo, PR, quản lý kênh mạng xã hội.
   - Nhóm Công nghệ: phát triển app/nền tảng, tích hợp AI, giải pháp tự động hóa truyền thông.
4. **Case Studies / Dự án** — lọc theo loại dịch vụ (Truyền thông / Công nghệ).
5. **Blog / Tin tức** — nơi tái sử dụng nội dung từ file .xml, phân loại lại theo 2 nhóm chủ đề.
6. **Tuyển dụng** (tùy chọn, tăng uy tín agency công nghệ).
7. **Liên hệ** — form liên hệ + tích hợp chat AI.

### 2.2 Rà soát nội dung cũ (từ file .xml)
- [ ] Phân loại toàn bộ bài viết cũ: Giữ nguyên / Viết lại theo định hướng mới / Xóa (nội dung lỗi thời, trùng lặp, không liên quan).
- [ ] Với bài viết giữ lại: chuẩn hóa lại theo chuẩn SEO mới, gắn danh mục mới theo sitemap ở trên.

---

## 3. GIAI ĐOẠN THIẾT KẾ (DESIGN SYSTEM CHUẨN SENIOR)

### 3.1 Bộ nhận diện thị giác
- Bảng màu: 1 màu thương hiệu chủ đạo, 1 màu nhấn (CTA), thang neutral 5-7 cấp — tránh màu mặc định của bất kỳ framework CSS nào.
- Typography: tối đa 2 font (heading + body), thiết lập type scale theo tỷ lệ modular nhất quán.
- Grid & spacing: hệ thống spacing 8px base, container responsive rõ ràng theo Tailwind config tùy biến (không dùng theme mặc định).
- Thư viện component riêng: button, card, section (hero, feature grid, case study card, testimonial, CTA band) — thiết kế độc quyền, không rập khuôn template có sẵn.

### 3.2 Đề xuất quy trình
- [ ] Dựng wireframe cho 5-6 trang chính.
- [ ] Dựng 1 bộ UI kit mẫu (màu, font, component) để duyệt trước khi code toàn site.
- [ ] Thiết kế responsive cho 3 breakpoint chính: mobile, tablet, desktop.

---

## 4. GIAI ĐOẠN PHÁT TRIỂN KỸ THUẬT (LARAVEL)

### 4.1 Kiến trúc dữ liệu (Database)
- [ ] Thiết kế schema: `posts`, `categories`, `tags`, `pages`, `media`, `case_studies`, `services`, `users`, `redirects`, `seo_meta`.
- [ ] Viết script import từ file `.xml` (WXR) → parse XML → insert vào bảng `posts`/`categories`/`tags` tương ứng (dùng package `SimpleXML` hoặc thư viện parser WXR có sẵn trên Packagist).
- [ ] Tải lại toàn bộ ảnh từ URL cũ (lấy từ thư mục uploads đã backup) → upload vào storage mới (Laravel Filesystem / S3-compatible).

### 4.2 Tái lập chức năng plugin cũ bằng code
| Plugin cũ | Giải pháp Laravel tương ứng |
|---|---|
| Rank Math SEO | Package `artesaos/seotools` hoặc tự viết meta component; `spatie/laravel-sitemap` cho sitemap.xml |
| Wordfence / Solid Security | Laravel Fortify (2FA, auth), rate limiting middleware, Cloudflare/WAF ở tầng server |
| LiteSpeed Cache | Redis cache, route caching, view caching, CDN cho static assets |
| Easy Table of Contents | Component Blade tự động quét heading (H2-H4) trong nội dung bài viết |
| Contact Form 7 | Form Laravel chuẩn + Validation + Mailable + chống spam (Google reCAPTCHA v3) |
| Buttonizer | Widget chat nổi tùy biến (Alpine.js) + tích hợp Zalo/Messenger nếu cần |
| AI Engine | Tích hợp trực tiếp API AI (OpenAI/Anthropic) cho chatbot tư vấn, gợi ý nội dung |

### 4.3 CMS cho đội content
- [ ] Cài đặt Filament PHP làm trang quản trị (tương đương wp-admin) để đội biên tập tự đăng/sửa bài mà không cần biết code.
- [ ] Phân quyền user: Admin, Biên tập viên, Cộng tác viên.

### 4.4 SEO kỹ thuật
- [ ] Cấu hình meta title/description động theo từng trang/bài viết.
- [ ] Tạo schema Organization, Article, Breadcrumb bằng JSON-LD.
- [ ] Thiết lập 301 redirect từ URL cũ (WordPress) sang URL mới (Laravel) — dựa trên danh sách đã export ở bước 1.1.
- [ ] Submit lại sitemap.xml mới lên Google Search Console.

---

## 5. GIAI ĐOẠN KIỂM THỬ (QA)

- [ ] Test responsive trên mobile/tablet/desktop thực tế.
- [ ] Test form liên hệ, chatbot, upload ảnh trong CMS.
- [ ] Kiểm tra tốc độ tải (Google PageSpeed Insights, GTmetrix) — mục tiêu Core Web Vitals đạt "Good".
- [ ] Rà soát lỗi 404, kiểm tra toàn bộ redirect 301 hoạt động đúng.
- [ ] Kiểm thử bảo mật cơ bản (SQL injection, XSS, CSRF) — Laravel có sẵn nhiều lớp bảo vệ nhưng vẫn cần rà soát code tùy biến.

---

## 6. GIAI ĐOẠN GO-LIVE & THEO DÕI

- [ ] Trỏ domain truyenthongcuulong.com sang hosting Laravel mới, cấu hình SSL.
- [ ] Theo dõi Google Search Console 2-4 tuần đầu để phát hiện lỗi index/redirect.
- [ ] Theo dõi Analytics (traffic, tỷ lệ thoát) để đánh giá tác động của việc đổi nền tảng.
- [ ] Lên kế hoạch bảo trì định kỳ: cập nhật Laravel, vá bảo mật, backup tự động.

---

## 7. RỦI RO CẦN LƯU Ý

- **Mất SEO tạm thời** khi đổi nền tảng — giảm thiểu bằng cách giữ nguyên cấu trúc URL nếu có thể, và redirect 301 đầy đủ.
- **Downtime khi chuyển đổi** — nên làm trên staging, chuyển đổi DNS vào thời điểm traffic thấp.
- **Chi phí & thời gian phát triển lớn hơn nhiều so với sửa WordPress** — vì phải viết lại toàn bộ chức năng plugin bằng code, cần đội dev Laravel có kinh nghiệm, không chỉ là "cấu hình" như WordPress.
- **Không còn hệ sinh thái plugin có sẵn** — mọi tính năng mới về sau (form, SEO, cache...) đều cần dev viết tay hoặc tìm package Laravel tương ứng.

---

## 8. ƯỚC TÍNH GIAI ĐOẠN THỰC HIỆN (tham khảo)

| Giai đoạn | Nội dung | Ước tính thời gian |
|---|---|---|
| 1 | Chuẩn bị, backup, xác định yêu cầu | 3-5 ngày |
| 2 | Định vị nội dung, sitemap, rà soát bài viết cũ | 1 tuần |
| 3 | Thiết kế UI/UX (wireframe + UI kit + duyệt) | 2-3 tuần |
| 4 | Phát triển Laravel (DB, import XML, CMS, tính năng) | 4-8 tuần |
| 5 | QA & kiểm thử | 1-2 tuần |
| 6 | Go-live & theo dõi | 1 tuần + theo dõi liên tục |

*(Thời gian thực tế phụ thuộc vào quy mô nội dung cũ và số lượng tính năng tùy biến.)*
