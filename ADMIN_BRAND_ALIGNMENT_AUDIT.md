# ADMIN BRAND ALIGNMENT AUDIT
**Cửu Long Media & Tech - Design System Mapping**

Dựa trên việc inspect source code thực tế của Client (bao gồm `tailwind.config.js` và `resources/css/app.css`), dưới đây là hệ thống Design System chuẩn sẽ được áp dụng cho Admin Panel.

## 1. Brand Colors & Palette
Client đang sử dụng các custom tokens sau:
- **Navy Base (Dark)**: `#070f1e`
- **Navy Surface**: `#0b1b33`
- **Primary (Adjusted WCAG)**: `#c2410c` (Tuy nhiên class `.btn-primary-cta` dùng `#ea580c` làm background chính, và `#c2410c` cho hover).
- **Accent Amber (Adjusted WCAG)**: `#b45309`
- **Surface Light**: `#f8f9ff`
- **Text Body**: `#475569` (`on-surface-variant`) / `#070f1e` (`on-surface`)

*Áp dụng vào Filament Admin*:
- **Primary**: Cần set thành `#ea580c` (Cam) để các nút bấm chính của Admin (Save, Submit) tương đồng với `.btn-primary-cta` của Client.
- **Warning/Accent**: `#b45309` (Amber WCAG).
- **Gray**: Sử dụng hệ màu `Slate` của Tailwind vì nó rất khớp với `#475569` (Slate 600) và phù hợp với Light Mode surface.
- **Dark Mode**: Nếu Admin không bị force Dark Mode, Main Workspace sẽ dùng nền Light (`#f8f9ff` hoặc tương đương).

## 2. Typography
- **Headline/Heading**: `Space Grotesk` (Weight 800, tracking -0.03em).
- **Body**: `Plus Jakarta Sans` (Line-height 1.65).
- **Eyebrow**: `JetBrains Mono`.

*Áp dụng vào Filament Admin*:
Vì Filament sử dụng font cho toàn bộ UI (phần lớn là data table, form labels - tính chất Body text), font `Plus Jakarta Sans` sẽ mang lại khả năng đọc (readability) tốt nhất. Việc dùng `Space Grotesk` cho toàn bộ UI nhỏ sẽ gây mỏi mắt. Ta sẽ cấu hình `->font('Plus Jakarta Sans')` làm base font.

## 3. Button System
- **Primary Button**: 
  - Radius: `9999px` (Rounded Full)
  - Box-shadow: Glow màu cam (`0 4px 14px rgba(234, 88, 12, 0.35)`).
- **Secondary Button**: Background trắng 95%, viền xám nhạt `#cbd5e1`, hover chữ cam, `9999px` radius.

*Áp dụng vào Filament Admin*: Mặc định Filament dùng `rounded-lg`. Cần tinh chỉnh (qua CSS injection nhỏ gọn) hoặc giữ nguyên `rounded-lg` để đảm bảo không vỡ layout form phức tạp, nhưng màu sắc phải tuân thủ chuẩn Cam/Trắng.

## 4. Card & Surface System
- **Corporate Card**: 
  - Nền: Trắng `#ffffff`.
  - Border: `1px solid rgba(226, 232, 240, 0.9)` (Màu Slate 200).
  - Radius: `1.5rem` (`rounded-3xl`).
  - Shadow: Cực kỳ subtle hoặc không có shadow mặc định, chỉ có shadow khi hover.

*Áp dụng vào Filament Admin*: Admin sẽ dùng nền Workspace sáng (Light Mode), các Panel và Section sẽ có màu nền trắng, viền mỏng, mang hơi hướng sạch sẽ (Editorial Clean). KHÔNG force toàn bộ thành màu đen/Navy.

## 5. Logo & Spacing
- **Logo**: `public/images/logo-ttcl.png`
- **Spacing**: Rộng rãi, thoáng.

## Kết luận & Quyết định Kiến trúc
Để không hack quá sâu vào lõi của Filament bằng file CSS khổng lồ, tôi sẽ:
1. Map **Primary Color** thành `#ea580c`.
2. Map **Base Font** thành `Plus Jakarta Sans`.
3. Chèn một **Render Hook** / **Custom CSS siêu nhỏ** chỉ để override Border Radius của Button (`rounded-full`) và Card (`rounded-xl` hoặc `3xl`) nếu có thể thực hiện an toàn qua Tailwind classes có sẵn.
4. Đảm bảo UI mặc định ở Light Mode với nền sáng sủa, sạch sẽ, chuẩn Editorial.
