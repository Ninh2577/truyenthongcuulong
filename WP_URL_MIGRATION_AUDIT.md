# WP_URL_MIGRATION_AUDIT

## 1. Executive Summary
- Total XML records: 3673
- Published posts: 488
- Published pages: 19
- Candidate MAPPED: 488
- NEEDS_REVIEW: 13
- NO_DESTINATION: 0
- URL_COLLISION: 2
- NO_REDIRECT_REQUIRED: 3166
- INVALID (Self-redirect): 4

## 2. Source XML Inventory
- attachment: 3077
- blocks: 5
- featured_item: 8
- custom_css: 1
- itsec-dash-card: 30
- nav_menu_item: 24
- itsec-dashboard: 4
- page: 21
- post: 495
- wpcf7_contact_form: 5
- wp_global_styles: 2
- wp_navigation: 1

## 3. Published Posts (Summary)
Total published posts: 488. Mapped successfully to existing DB routes where possible.

## 4. Published Pages
| Old URL | Title | Candidate Destination | Mapping Status | Reason |
|---------|-------|------------------------|----------------|--------|
| https://truyenthongcuulong.com/chinh-sach-bao-mat/ | Chính sách bảo mật | /chinh-sach-bao-mat | INVALID | Self redirect |
| https://truyenthongcuulong.com/blog/ | Blog |  | NEEDS_REVIEW | No known mapping for page slug |
| https://truyenthongcuulong.com/lien-he/ | LIÊN HỆ TRUYỀN THÔNG CỬU LONG | /lien-he | INVALID | Self redirect |
| https://truyenthongcuulong.com/doi-tac/ | ĐỐI TÁC | /doi-tac | INVALID | Self redirect |
| https://truyenthongcuulong.com/quang-cao/ | DỊCH VỤ QUẢNG CÁO TẠI TRUYỀN THÔNG CỬU LONG |  | NEEDS_REVIEW | No known mapping for page slug |
| https://truyenthongcuulong.com/dich-vu-quang-cao-ppc/ | DỊCH VỤ QUẢNG CÁO PPC TẠI TRUYỀN THÔNG CỬU LONG |  | NEEDS_REVIEW | No known mapping for page slug |
| https://truyenthongcuulong.com/dich-vu-quay-dung-video-tvc/ | DỊCH VỤ QUAY & DỰNG VIDEO TVC CÓ TẠI TRUYỀN THÔNG CỬU LONG |  | NEEDS_REVIEW | No known mapping for page slug |
| https://truyenthongcuulong.com/ | Truyền Thông Cửu Long |  | URL_COLLISION | Old URL conflicts with existing Laravel route: / |
| https://truyenthongcuulong.com/dich-vu-travel/ | Dịch Vụ Media Travel tại Truyền Thông Cửu Long |  | NEEDS_REVIEW | No known mapping for page slug |
| https://truyenthongcuulong.com/dich-vu-media/ | Dịch Vụ Media Truyền Thông Cửu Long |  | NEEDS_REVIEW | No known mapping for page slug |
| https://truyenthongcuulong.com/dich-vu-wedding/ | Dịch Vụ Wedding Tại Truyền Thông Cửu Long |  | NEEDS_REVIEW | No known mapping for page slug |
| https://truyenthongcuulong.com/san-pham/ | Các sản phẩm của Truyền Thông Cửu Long |  | NEEDS_REVIEW | No known mapping for page slug |
| https://truyenthongcuulong.com/marketing-tong-the/ | Marketing Tổng Thể tại Truyền Thông Cửu Long |  | NEEDS_REVIEW | No known mapping for page slug |
| https://truyenthongcuulong.com/gioi-thieu-ve-truyen-thong-cuu-long/ | Giới thiệu về Truyền Thông Cửu Long |  | NEEDS_REVIEW | No known mapping for page slug |
| https://truyenthongcuulong.com/booking/ | Booking dịch vụ TRAVEL VIDEO |  | URL_COLLISION | Old URL conflicts with existing Laravel route: /booking |
| https://truyenthongcuulong.com/chinh-sach-quyen-rieng-tu/ | Chính sách quyền riêng tư |  | NEEDS_REVIEW | No known mapping for page slug |
| https://truyenthongcuulong.com/download-center/ | Download Center |  | NEEDS_REVIEW | No known mapping for page slug |
| https://truyenthongcuulong.com/thiet-ke-web/ | DỊCH VỤ THIẾT KẾ WEB TẠI TRUYỀN THÔNG CỬU LONG |  | NEEDS_REVIEW | No known mapping for page slug |
| https://truyenthongcuulong.com/khach-hang/ | KHÁCH HÀNG | /khach-hang | INVALID | Self redirect |

## 5. Post Mapping Summary
Most posts were automatically assigned `MAPPED` status if their exact slug exists in Laravel `posts` table.

## 6. Page Mapping Summary
Explicit pages were mapped manually. Unknown pages were assigned `NEEDS_REVIEW`.

## 7. URL Collision Report
| Old URL | Collision Type | Existing Route/Destination |
|---------|----------------|----------------------------|
| https://truyenthongcuulong.com/ | TRUE_ROUTE_COLLISION |  |
| https://truyenthongcuulong.com/booking/ | TRUE_ROUTE_COLLISION |  |

## 8. Self Redirect / No Redirect Required
Total `INVALID` (Self Redirect): 4.
Total `NO_REDIRECT_REQUIRED` (Attachments, Drafts, System): 3166.

## 9. Duplicate Classification
- SEO Content Duplicates: 10
- Attachment Duplicates: 83
- System Duplicates: 9

## 10. No Destination
Total missing destination explicitly mapped: 0.

## 11. Redirect Chain Analysis
Detected chains based on existing Laravel DB: 0.

## 12. Redirect Loop Analysis
Detected loops based on existing Laravel DB: 0.

## 13. Query String Analysis
URLs containing query strings: 93.

## 14. Trailing Slash Analysis
Candidate mappings with trailing slash differences: 492.

## 15. Manual Review Queue
### Pages Needing Review
- https://truyenthongcuulong.com/blog/
- https://truyenthongcuulong.com/quang-cao/
- https://truyenthongcuulong.com/dich-vu-quang-cao-ppc/
- https://truyenthongcuulong.com/dich-vu-quay-dung-video-tvc/
- https://truyenthongcuulong.com/dich-vu-travel/
- https://truyenthongcuulong.com/dich-vu-media/
- https://truyenthongcuulong.com/dich-vu-wedding/
- https://truyenthongcuulong.com/san-pham/
- https://truyenthongcuulong.com/marketing-tong-the/
- https://truyenthongcuulong.com/gioi-thieu-ve-truyen-thong-cuu-long/
- https://truyenthongcuulong.com/chinh-sach-quyen-rieng-tu/
- https://truyenthongcuulong.com/download-center/
- https://truyenthongcuulong.com/thiet-ke-web/
### Slug Mismatch / Unknown Posts

## 16. Import Readiness
**NOT READY**. Requires manual review of the queue above before production import.
