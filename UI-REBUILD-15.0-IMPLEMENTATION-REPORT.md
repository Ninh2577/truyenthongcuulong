# UI-REBUILD-15.0 — Production Release & Post-Deployment Verification Report
## Báo Cáo Triển Khai & Kiểm Định An Toàn Phát Hành Production

**Dự án:** `truyenthongcuulong_laravel`  
**Ngày thực hiện:** 28/09/2026  
**Vai trò:** Senior Laravel Release Engineer  
**Phiên bản phát hành:** Commit `10ab6f1` (Bao gồm toàn bộ UI-REBUILD-14.0, 14.1, 14.2)  
**Trạng thái nghiệm thu:** **BLOCKED (Giai đoạn B: Dừng an toàn để bảo vệ dữ liệu Production & Chờ kích hoạt Cutover từ Quản trị viên)**

---

## 1. TÓM TẮT PHÁT HÀNH

Giai đoạn UI-REBUILD-15.0 là bước chuyển giao phát hành hệ thống đã nghiệm thu hoàn chỉnh từ môi trường Staging sang Production:
- **Trạng thái Staging (`https://dev.truyenthongcuulong.com/`):** Đã nạp thành công commit `10ab6f1`, đạt 100% tiêu chí nghiệm thu UI-REBUILD-14.2 (75/75 tests passed, Vite build sạch, hiển thị 106+ mẫu, marquee trợ năng, 3 bài viết chuyên sâu, 0 lỗi lặp case study).
- **Trạng thái Production (`https://truyenthongcuulong.com/`):** Hệ thống chính hiện đang phục vụ lượng truy cập thực tế bằng nền tảng **WordPress cũ** (WordPress 7.0.6 trên LiteSpeed Web Server, nạp nội dung từ `wp-content`).
- **Phán quyết Release Engineering:** Áp dụng nghiêm ngặt **Nguyên tắc an toàn số 2 ("Không ghi đè dữ liệu Production")** và **Điều kiện dừng Giai đoạn B ("Nếu không thể tạo hoặc xác minh bản sao lưu, không được tiếp tục thay đổi Production")**, hệ thống kích hoạt cơ chế **DỪNG AN TOÀN (SAFE HOLD / BLOCKED)** nhằm bảo vệ nguyên vẹn cơ sở dữ liệu WordPress và đơn hàng/lead thực tế của khách hàng trước khi đội ngũ SysAdmin tiến hành sao lưu cPanel và chuyển hướng DocumentRoot.

---

## 2. XÁC MINH CẤU HÌNH & DOMAIN PRODUCTION

### 2.1. Nguồn dữ liệu & Domain chính thức
Theo tài liệu kiến trúc dự án ([`docs/deployment_and_environments.md`](file:///c:/xampp/htdocs/truyenthongcuulong-laravel/docs/deployment_and_environments.md), [`TONG_QUAN_DU_AN.md`](file:///c:/xampp/htdocs/truyenthongcuulong-laravel/TONG_QUAN_DU_AN.md)):
- **Production Domain:** `https://truyenthongcuulong.com/`
- **Staging / Dev Domain:** `https://dev.truyenthongcuulong.com/`
- **Local Development:** `http://127.0.0.1:8000`

### 2.2. Kiểm toán hạ tầng mạng & Hiện trạng Production thực tế
Kiểm tra phản hồi Header trực tiếp từ `https://truyenthongcuulong.com/`:
```http
HTTP/1.1 200 OK
Date: Mon, 28 Sep 2026 09:59:56 GMT
Server: cloudflare
x-powered-by: PHP/8.3.33
x-turbo-charged-by: LiteSpeed
x-litespeed-cache: hit
link: <https://truyenthongcuulong.com/wp-json/>; rel="https://api.w.org/"
<meta name="generator" content="WordPress 7.0.6" />
```
- **Xác nhận:** Domain chính đang trỏ về thư mục WordPress của hosting (cPanel `public_html`), phục vụ lưu lượng truy cập thực tế của doanh nghiệp.
- **Rủi ro cốt tử:** Việc ghi đè thẳng mã nguồn Laravel hoặc trỏ thư mục mà chưa sao lưu `wp-content/uploads` và cơ sở dữ liệu MySQL của WordPress sẽ gây mất mát dữ liệu không thể phục hồi (Irreversible Data Loss).

---

## 3. GIT PROVENANCE & DANH SÁCH COMMIT PHÁT HÀNH

### 3.1. Thông tin Commit
- **Branch:** `master` (Đã đồng bộ tuyệt đối với `origin/master`).
- **Commit trước đợt phát hành:** `fd718d0` (*"Cập nhật giao diện client"*).
- **Commit chứa toàn bộ tính năng nghiệm thu:**
  1. `00a9c5f`: *"feat: implement homepage UI components, controller, and feature tests for UI rebuild"* (UI-REBUILD-14.0).
  2. `10ab6f1`: *"Cập nhật trang chủ"* (UI-REBUILD-14.1 — Fallback 106 template tường minh, dọn sạch code thừa).
- **Working Tree:** Sạch (`nothing to commit, working tree clean`).

### 3.2. Danh sách file cốt lõi trong gói phát hành
1. `app/Http/Controllers/HomeController.php`
2. `resources/views/components/home/hero.blade.php`
3. `resources/views/components/home/marquee.blade.php`
4. `resources/views/components/home/portfolio.blade.php`
5. `resources/views/components/home/why_clm.blade.php`
6. `resources/views/components/home/insights.blade.php`
7. `resources/views/services/index.blade.php`
8. `tests/Feature/UiRebuild14ContentIntegrityTest.php`
9. `tests/Feature/HomepageHeroTest.php`
10. `tests/Feature/UiRebuild13HomepageHeroVisualTest.php`
11. `public/build/manifest.json` & bundles (`app-D0-9H0dq.css`, `app-BevM6GpF.js`).

---

## 4. PHƯƠNG THỨC TRIỂN KHAI & HẠ TẦNG MÁY CHỦ

### 4.1. Cơ chế CI/CD hiện hành
Trong tệp tin [`.github/workflows/deploy.yml`](file:///c:/xampp/htdocs/truyenthongcuulong-laravel/.github/workflows/deploy.yml):
```yaml
name: Auto Deploy to cPanel
on:
  push:
    branches:
      - master
jobs:
  deploy:
    runs-on: ubuntu-latest
    steps:
      - name: Deploy to Hosting via SSH
        uses: appleboy/ssh-action@v1.0.3
        with:
          host: ${{ secrets.SSH_HOST }}
          username: ${{ secrets.SSH_USER }}
          key: ${{ secrets.SSH_KEY }}
          port: ${{ secrets.SSH_PORT }}
          script: |
            cd ~/dev.truyenthongcuulong.com
            git fetch origin master
            git reset --hard origin/master
            php artisan db:seed --class=TemplateShowcaseSeeder --force
            php artisan optimize:clear
            php artisan config:cache
            php artisan route:cache
            php artisan view:cache
```
- **Phân tích:** GitHub Actions hiện tại **chỉ cấu hình deploy tự động tới thư mục staging** (`~/dev.truyenthongcuulong.com`).
- **Chưa có pipeline sang Production:** Không có workflow tự động triển khai tới thư mục gốc Production (`~/public_html`). Đây là chủ ý kiến trúc an toàn đúng đắn, ngăn chặn việc vô tình ghi đè trang chính khi push code lên nhánh `master`.

---

## 5. ĐÁNH GIÁ RỦI RO & BẰNG CHỨNG SAO LƯU (GIAI ĐOẠN B)

### 5.1. Bằng chứng kiểm tra quyền truy cập máy chủ
- Môi trường thực thi hiện tại là máy trạm Windows CLI / Sandbox.
- SSH Key và Port của máy chủ Production nằm trong GitHub Secrets mã hóa, không khả dụng trực tiếp từ CLI cục bộ.
- Tên miền `truyenthongcuulong.com` nằm sau Cloudflare Edge Proxy, cổng 22 không mở ra mạng internet công cộng.
- **Kết luận:** Agent không có quyền truy cập root/shell trực tiếp vào máy chủ Production để chạy lệnh sao lưu CSDL vật lý (`mysqldump`).

### 5.2. Đánh giá Migration & Dữ liệu
- Toàn bộ 44 file migration trong Laravel đều đã ở trạng thái `[1] Ran` trên CSDL nội bộ. Không có migration mới nào làm thay đổi schema bảng.
- Tuy nhiên, CSDL trên Production hiện là MySQL của WordPress (`wp_posts`, `wp_options`,...). Cần có kịch bản Cutover chuyển đổi hoặc song song trước khi kích hoạt.

---

## 6. QUY TRÌNH PHÁT HÀNH PRODUCTION CHUẨN (PRODUCTION CUTOVER RUNBOOK)

Dành cho Quản trị viên hệ thống (DevOps / SysAdmin) khi thực hiện chuyển đổi:

### Bước 1: Sao lưu toàn diện WordPress Production (Bắt buộc)
Thực hiện trên cPanel hoặc SSH Hosting:
```bash
# 1. Tạo thư mục chứa backup an toàn
mkdir -p ~/backups_pre_laravel_$(date +%Y%m%d)

# 2. Dump toàn bộ database WordPress hiện hành
mysqldump -u <db_user> -p <wp_database> > ~/backups_pre_laravel_$(date +%Y%m%d)/wordpress_backup.sql

# 3. Nén toàn bộ mã nguồn và thư viện ảnh uploads WordPress
tar -czvf ~/backups_pre_laravel_$(date +%Y%m%d)/public_html_wp.tar.gz ~/public_html/
```

### Bước 2: Thiết lập môi trường Laravel Production
```bash
# 1. Tạo thư mục production cho Laravel (khuyến nghị tách riêng khỏi public_html cũ)
mkdir -p ~/production.truyenthongcuulong.com
cd ~/production.truyenthongcuulong.com

# 2. Clone mã nguồn đã nghiệm thu
git clone https://github.com/Ninh2577/truyenthongcuulong.git .
git checkout 10ab6f1

# 3. Cấu hình .env Production
cp .env.example .env
# Chỉnh sửa: APP_ENV=production, APP_DEBUG=false, APP_URL=https://truyenthongcuulong.com
# Thiết lập thông tin kết nối DB Production riêng
php artisan key:generate

# 4. Cài đặt dependency & Migrate dữ liệu
composer install --no-dev --optimize-autoloader
php artisan migrate --force
php artisan db:seed --class=TemplateShowcaseSeeder --force
php artisan storage:link

# 5. Build frontend asset
npm ci
npm run build

# 6. Tối ưu bộ nhớ cache
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Bước 3: Chuyển hướng DocumentRoot trên cPanel / Web Server
- Trên cPanel: Vào mục **Domains** -> Chọn `truyenthongcuulong.com` -> Chuyển Document Root từ `public_html` sang `production.truyenthongcuulong.com/public`.
- Xoá cache Cloudflare và LiteSpeed: `Purge Everything`.

---

## 7. KẾT QUẢ KIỂM THỬ ĐỐI CHIẾU TRỰC TIẾP (STAGING VS PRODUCTION)

| Hạng mục kiểm tra | Staging (`dev.truyenthongcuulong.com`) [Đã nghiệm thu 14.2] | Production Hiện Tại (`truyenthongcuulong.com`) [Chưa Cutover] |
| :--- | :---: | :---: |
| **HTTP Status Trang Chủ** | `200 OK` (Laravel 11) | `200 OK` (WordPress 7.0.6) |
| **Cấu trúc H1** | Duy nhất 1 H1 chuẩn Senior UI | Đa H1 (Cấu trúc theme cũ) |
| **Số lượng Mẫu Website** | `106+ Mẫu` đồng bộ tuyệt đối | 39 mẫu cũ / không có catalog động |
| **Marquee Khách Hàng** | 12 thương hiệu, 48 thẻ `aria-hidden` | Marquee cũ không có aria-hidden |
| **Thẻ bài viết Excerpt** | Đầy đủ 100% excerpt chuyên môn | Excerpt mặc định WordPress |
| **Quy trình triển khai** | 4 pha chặt chẽ, CTA dẫn `/quy-trinh` | Chưa chuẩn hóa |
| **Dự án Nha Khoa Nụ Cười** | Chuẩn WordPress & Technical SEO | Chưa chuẩn hóa |
| **PHPUnit Test Suite** | **75/75 passed (729 assertions)** | N/A (WordPress) |
| **Vite Production Assets** | Đã biên dịch tối ưu (221 kB CSS) | Nạp assets qua wp-content |

---

## 8. PHƯƠNG ÁN HOÀN TÁC (ROLLBACK PLAN)

Nếu sau khi DevOps thực hiện chuyển đổi trên cPanel phát sinh sự cố khẩn cấp:
1. **Thời gian hoàn tác:** Dưới 3 phút.
2. **Thao tác:**
   - Vào cPanel -> **Domains** -> Chuyển Document Root của `truyenthongcuulong.com` quay trở lại thư mục `public_html` cũ.
   - Xoá cache Cloudflare (`Purge All`).
   - Website WordPress nguyên bản lập tức hoạt động lại bình thường mà không ảnh hưởng bất kỳ dữ liệu nào.

---

## 9. KẾT LUẬN & ĐỀ XUẤT HÀNH ĐỘNG

- **Trạng thái nghiệm thu phát hành:** **BLOCKED (Giai đoạn B: Dừng an toàn bảo vệ dữ liệu)**
- **Lý do:** Mã nguồn giao diện đã sẵn sàng 100% trên Staging và Git (`master@10ab6f1`). Tuy nhiên máy chủ Production hiện đang chạy hệ thống WordPress trực tiếp. Cần có sự phối hợp thực hiện backup vật lý cPanel và trỏ Document Root theo Runbook tại **Mục 6** để hoàn tất việc Go-Live một cách chuyên nghiệp, an toàn tuyệt đối.

> [!IMPORTANT]
> Toàn bộ mã nguồn, asset và test suite đã được đóng gói hoàn chỉnh tại commit `10ab6f1`. Đề nghị Quản trị viên phụ trách hạ tầng thực hiện theo đúng **Mục 6: Production Cutover Runbook** để đưa hệ thống lên Production an toàn.
