# Hướng dẫn Quản trị Hệ thống (Admin Guide)
## Dành cho Ban Biên Tập & Quản trị viên Truyền Thông Cửu Long

Tài liệu này cung cấp hướng dẫn chi tiết cách quản lý các luồng dữ liệu cốt lõi thông qua Admin Panel (Filament) nhằm đảm bảo tính toàn vẹn của giao diện trên website.

---

## 1. Truy cập Admin Panel

- **Đường dẫn (URL):** `/admin` (ví dụ: `http://localhost:8000/admin` hoặc `https://truyenthongcuulong.com/admin`)
- **Tài khoản:** Sử dụng tài khoản có quyền Quản trị viên (Admin) hoặc Biên tập viên (Editor).

---

## 2. Quản lý Mạng Lưới Đối Tác (Partners)

Hệ thống quản lý đối tác nằm ở menu **Quản lý Website > Đối tác**.

### Phân cấp (Tier)
Giao diện người dùng (UI) có sự phân chia đối tác làm 3 tầng thị giác. Khi thêm mới, hãy chọn đúng **Tier**:
1. **Top Partner (Tiêu biểu):** Hiển thị khối to nhất, có màu nền tối và text gradient vàng. *Yêu cầu bắt buộc phải có Hình ảnh nền (Image).*
2. **Gold Partner:** Hiển thị khối trung bình, màu đồng. *Yêu cầu bắt buộc phải có Hình ảnh nền (Image).*
3. **Strategic Partner (Chiến lược):** Hiển thị danh sách ngang gọn gàng. *Chỉ cần Logo / Icon.*

### Hình ảnh
- Tải hình ảnh lên ở định dạng JPG/PNG.
- Đối với Top và Gold Partner, ưu tiên hình ảnh chất lượng cao 16:9 để giao diện hiển thị đẹp nhất.

---

## 3. Quản lý Khách Hàng Tiêu Biểu (Clients)

Menu **Quản lý Website > Khách hàng**.

### Lĩnh vực (Industry Category)
Sử dụng bộ lọc (Filter) bên trên trang hiển thị của người dùng (Tài chính, Công nghệ, Nông nghiệp, Du lịch, Y tế...).
Hãy luôn phân loại khách hàng vào một trong 5 nhóm ngành nghề này để bộ lọc hoạt động chính xác:
- Tài chính & Ngân hàng
- Công nghệ & Giải pháp số
- Nông nghiệp & Sản xuất
- Du lịch & Bán lẻ
- Y tế, Giáo dục & Xã hội

### Icon & Logo
- Hiện tại, danh sách khách hàng sử dụng hệ thống Material Icons hoặc Logo (tùy thuộc vào bản thiết kế). Bạn có thể upload Logo trực tiếp từ Admin.

---

## 4. Quản lý Bảng Giá Dịch Vụ (Pricing Plans)

Menu **Quản lý Website > Bảng giá**.

Bảng giá được chia làm 3 nhóm dịch vụ:
1. Sản Xuất Video & TVC (tvc)
2. Thiết Kế Web & App (web)
3. Quảng Cáo & Marketing Số (marketing)

### Tính năng đặc biệt
- **Nổi bật (is_featured):** Bật công tắc này nếu đây là gói "Khuyên dùng" / "Doanh nghiệp lựa chọn nhiều nhất". Hệ thống sẽ tự động thêm khung viền vàng, đổ bóng nổi và nhãn "Featured" vào gói dịch vụ trên website.
- **Danh sách quyền lợi (Features):** Bạn có thể gõ nội dung quyền lợi và nhấn Enter để lưu thành một gạch đầu dòng (bullet point) mới trong gói dịch vụ.

---

## 5. Quản lý Nội Dung Chung (Team & Testimonial)

Menu **Nội dung chung**.

- **Đội ngũ nhân sự (Team Members):** Thêm mới và quản lý danh sách đội ngũ chuyên gia. Chú ý thứ tự (Order) để sắp xếp vị trí hiển thị, số nhỏ hơn hiển thị trước.
- **Đánh giá (Testimonials):** Cập nhật lời nhận xét từ khách hàng thực tế. Thông tin bao gồm: Tên khách hàng, chức danh, ảnh đại diện và nội dung trích dẫn.

---

## 6. Lưu ý an toàn (Content Gate)

- Không thay đổi tên "Slug" của những đối tác / khách hàng đã tồn tại lâu năm vì có thể ảnh hưởng tới SEO hoặc đường dẫn liên kết tĩnh.
- Nếu không muốn hiển thị một mục, hãy tắt nút **Kích hoạt hiển thị (is_active)** thay vì Xóa (Delete). Thao tác Xóa là vĩnh viễn và không thể khôi phục.
