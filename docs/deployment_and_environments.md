# QUY HOẠCH 3 MÔI TRƯỜNG & VẬN HÀNH DỰ ÁN TRUYENTHONGCUULONG

## 1. MÔ TẢ 3 MÔI TRƯỜNG PHÁT TRIỂN
- **Local (Hiện tại)**:
  - Máy chủ XAMPP (Windows), PHP 8.2, MySQL Port 3307.
  - Database mới: 	ruyenthongcuulong_v2.
  - Database nguồn đối chiếu: 	ruyenthongcuulong (Port 3307).
  - \APP_ENV=local\, \APP_DEBUG=true\.
- **Staging**:
  - Máy chủ VPS Linux / Subdomain (ví dụ \dev.truyenthongcuulong.com\).
  - PHP 8.2+ OPcache, MySQL 8.0, Redis.
  - \APP_ENV=staging\, \APP_DEBUG=false\.
  - Mục đích: Đội ngũ biên tập viên duyệt bài, kiểm thử phân quyền Filament Shield, đo kiểm tốc độ LCP và chuyển hướng 301.
- **Production**:
  - Tên miền chính: \https://truyenthongcuulong.com\.
  - Cấu hình Cloudflare WAF, Bắt buộc HTTPS (HSTS).
  - \APP_ENV=production\, \APP_DEBUG=false\.
  - Redis cache / session / queue.

## 2. CHECKLIST CHUYỂN ĐỔI MÔI TRƯỜNG (STAGING -> PRODUCTION)
1. Cấu hình \.env\ riêng biệt cho production, thiết lập khóa bí mật \APP_KEY\.
2. Chạy tối ưu hóa Laravel:
   - \php artisan config:cache\
   - \php artisan route:cache\
   - \php artisan view:cache\
   - \php artisan event:cache\
3. Tạo Symbolic link \php artisan storage:link\.
4. Build assets production: \
pm run build\.
5. Thiết lập Cronjob sao lưu tự động hàng ngày: \php artisan backup:run\.
