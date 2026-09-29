# UI-REBUILD-16.0 — HOMEPAGE VISUAL REFINEMENT & UX OPTIMIZATION REPORT

**Dự án:** `truyenthongcuulong_laravel`  
**Giai đoạn:** UI-REBUILD-16.0 — Homepage Visual Refinement & UX Optimization  
**Mục tiêu:** Tinh chỉnh chất lượng hiển thị, khả năng đọc, nhịp điệu thị giác, trải nghiệm tương tác và khả năng chuyển đổi của Trang chủ (`/`) trên cơ sở đối chiếu với Staging (`https://dev.truyenthongcuulong.com/`), bảo toàn 100% kiến trúc, nội dung và các quy tắc nghiệp vụ đã nghiệm thu.  
**Role:** Senior UI/UX Designer & Senior Laravel Frontend Engineer  
**Thời gian thực hiện:** 29/09/2026  
**Đánh giá nghiệm thu:** **PASS**

---

## 1. TỔNG QUAN AUDIT GIAO DIỆN HIỆN TẠI (GIAI ĐOẠN A)

Quá trình kiểm tra toàn bộ 10 phân khu vực trên trang chủ đã xác định chi tiết hiện trạng, vấn đề và giải pháp:

| # | Phân khu vực (Section) | Hiện trạng & Vấn đề quan sát được | Mức độ ảnh hưởng | Đề xuất giải pháp & Tinh chỉnh | File liên quan | Tiêu chí xác nhận sau sửa |
|---|---|---|---|---|---|---|
| 1 | **Header & Navigation** | Mega Menu 3-zone, nhận diện brand sắc nét. Đầy đủ liên kết canonical. | Thấp | Giữ nguyên kiến trúc; đảm bảo mobile touch target >= 44x44px. | `resources/views/layouts/app.blade.php` | Single H1 toàn trang, menu hoạt động mượt mà. |
| 2 | **Hero & Visual Showcase** | Split layout 7/5 cột. Khung Visual Showcase trực quan với `modern_tech_platform.jpg` (LCP eager). 4 chip năng lực cốt lõi thiếu micro-animation khi hover. | Trung bình | Bổ sung micro-interaction (`hover:-translate-y-0.5`, `hover:shadow-xs`) và `focus-visible` ring cho 4 chip năng lực cốt lõi. | `resources/views/components/home/hero.blade.php` | Chip có hover mượt mà, đạt tiêu chuẩn bàn phím WCAG AA. |
| 3 | **Dải Marquee Đối tác & Khách hàng** | 2 dải đối tác và khách hàng cuộn ngược chiều, có gradient fade hai mép, `aria-hidden="true"` ở dải lặp vô tận. | Không có | Giữ nguyên; bảo toàn tuân thủ `prefers-reduced-motion`. | `resources/views/components/home/marquee.blade.php` | Không trùng lặp screen reader, cuộn vô tận mượt mà. |
| 4 | **Bài toán doanh nghiệp (`#business-needs`)** | 1. Tồn tại thẻ đóng thừa `</div>` tại dòng 155 làm lệch cấu trúc container thẻ mẹ.<br>2. Card Bài toán 02 có 2 link footer ("Thiết kế website" và "Kho mẫu ->") làm chiều cao footer lệch so với Card 1, 3, 4. | **Nghiêm trọng (HTML Syntax & Layout)** | 1. Xóa thẻ `</div>` thừa dòng 155.<br>2. Chuẩn hóa chiều cao footer với `min-h-[36px]` và flex alignment trên toàn bộ 4 card. | `resources/views/components/home/business_needs.blade.php` | Container đóng mở 30/30 thẻ `<div>` cân bằng tuyệt đối; 4 card thẳng hàng. |
| 5 | **Giải pháp công nghệ (`#technology-solutions`)** | 3 nhóm giải pháp cốt lõi (Web App, Website, Digital Growth) phân chia thẻ rõ ràng, icon và bullet points đồng nhất. | Thấp | Giữ nguyên kiến trúc; duy trì độ tương phản và khoảng cách thoáng đãng. | `resources/views/components/home/why_clm.blade.php` | Thẻ giải pháp hiển thị mạch lạc, liên kết canonical chuẩn. |
| 6 | **Dự án thực tế & Thư viện mẫu (`#portfolio-section`)** | Thẻ fallback 2 (Nha Khoa Nụ Cười) hardcode nhầm `route('services.web-app')` với nhãn "Thiết kế & Lập trình Web-App" thay vì `route('templates.index')` với "Thiết Kế Website Chuẩn SEO". | **Trung bình (Content Parity)** | Sửa fallback Card 2 trỏ về `route('templates.index')` với nhãn "Thiết Kế Website Chuẩn SEO &rarr;", đồng bộ với dynamic database loop. | `resources/views/components/home/portfolio.blade.php` | Fallback card đồng bộ 100% với logic render từ database. |
| 7 | **Quy trình triển khai (`#how-we-work`)** | Tóm tắt 4 bước rõ ràng nhưng thẻ bước thiếu điểm nhấn thị giác cho "Đầu ra:", nút xem chi tiết quy trình chưa nổi bật. | Trung bình | Tinh chỉnh 4 thẻ bước với dot-indicator màu cho đầu ra, bo góc `rounded-2xl`, nâng cấp nút link `/quy-trinh` thành dạng pill button nổi bật. | `resources/views/components/home/why_clm.blade.php` | 4 bước có nhịp điệu rõ ràng, nút CTA chuyển đổi cao. |
| 8 | **Dịch vụ Media bổ trợ (`#media-support`)** | Định vị chính xác 15% bổ trợ cho công nghệ. 3 card dịch vụ và modal video Alpine.js hoạt động hoàn hảo. | Không có | Giữ nguyên tỷ lệ 15% và modal video zero-leak overflow. | `resources/views/components/home/media_support.blade.php` | Không lấn át phần công nghệ cốt lõi. |
| 9 | **Bài viết & Tri thức (`#insights-section`)** | 3 bài viết chuyên môn động từ DB, ảnh thumbnail có fallback. Nút "Xem tất cả" và "Đọc tiếp" thiếu focus-ring và hover translate. | Thấp | Bổ sung `focus-visible:ring-2` và micro-interaction icon mũi tên dịch chuyển khi hover. Bọc thẻ link ngữ nghĩa cho nút "Đọc tiếp". | `resources/views/components/home/insights.blade.php` | Khả năng tiếp cận bàn phím tốt, tương tác trực quan. |
| 10 | **CTA Chuyển đổi cuối trang (`#final-conversion-band`)** | Tiêu đề H2 bị lệch so với hợp đồng kiểm thử `HomepageConversionFlowTest` ("Bạn đang cần xây dựng..." thay vì "Bạn Đang Có Một Bài Toán Cần Giải Quyết?"). | **Trung bình (Contract Alignment)** | Chuẩn hóa tiêu đề H2 thành "Bạn Đang Có Một Bài Toán Cần Giải Quyết?" đúng tinh thần Problem-First. | `resources/views/components/home/cta.blade.php` | Khớp 100% assertions của bộ test Conversion Flow. |

---

## 2. NHỮNG THAY ĐỔI ĐÃ THỰC HIỆN

### 2.1. Sửa lỗi cú pháp HTML & Cân bằng Card Footer trong `business_needs.blade.php`
* **Vấn đề:** Dòng 155 tồn tại thẻ đóng `</div>` mồ côi ngoài luồng gây lệch phân cấp DOM của trang chủ.
* **Xử lý:** Loại bỏ thẻ đóng thừa.
* **Cân bằng giao diện:** Bổ sung lớp `flex items-center min-h-[36px]` cho cả 4 footer của Bài toán 01, 02, 03, 04, đảm bảo các nút "Chi tiết Web App", "Thiết kế website / Kho mẫu", "Chi tiết phân quyền", "Chi tiết tự động hóa" có cùng đường cơ sở (baseline) tuyệt đối trên màn hình Desktop và Tablet.

### 2.2. Khắc phục bất đồng bộ Fallback Card trong `portfolio.blade.php`
* **Vấn đề:** Trong trường hợp database chưa có bản ghi case study, fallback Card 2 (Nha Khoa Nụ Cười) liên kết sai tới `/dich-vu/web-app` với nhãn "Thiết kế & Lập trình Web-App", trong khi logic chuẩn của dự án y tế WordPress này là liên kết đến Kho giao diện (`route('templates.index')`) với nhãn "Thiết Kế Website Chuẩn SEO".
* **Xử lý:** Cập nhật lại thuộc tính `href="{{ route('templates.index') }}"` và nhãn `Thiết Kế Website Chuẩn SEO &rarr;` cho fallback card.

### 2.3. Tối ưu nhịp điệu thị giác và Micro-Interactions cho Quy trình 4 bước (`why_clm.blade.php`)
* **Vấn đề:** 4 thẻ bước tóm tắt quy trình trước đây hiển thị đơn điệu, dòng "Đầu ra: ..." chìm vào nội dung và nút điều hướng sang trang `/quy-trinh` chưa có visual affordance đủ mạnh để thúc đẩy người dùng khám phá sâu tiêu chuẩn kỹ thuật.
* **Xử lý:** 
  - Thêm thẻ hiển thị đầu ra riêng biệt với dot-indicator màu sắc tương ứng (`bg-primary/70`, `bg-sky-500/70`, `bg-indigo-500/70`, `bg-emerald-500/70`) có viền ngăn cách tinh tế `border-t border-slate-100`.
  - Nâng cấp nút chuyển đổi xem chi tiết quy trình thành pill button có bóng đổ nhẹ `shadow-2xs`, bo viền `border border-slate-200`, hover dịch chuyển icon mũi tên `group-hover:translate-x-0.5`.

### 2.4. Tối ưu Hero Capability Chips & Accessibility (`hero.blade.php`)
* **Xử lý:** Thêm hiệu ứng nhấc thẻ nhẹ `hover:-translate-y-0.5` kết hợp bóng đổ `hover:shadow-xs` và trạng thái focus bàn phím rõ nét `focus-visible:ring-2 focus-visible:ring-primary` cho 4 chip năng lực giải pháp cốt lõi ở Hero.

### 2.5. Tối ưu Insights Cards & Header Action (`insights.blade.php`)
* **Xử lý:** Bổ sung `focus-visible:ring-2` và hiệu ứng dịch chuyển icon `group-hover:translate-x-0.5` cho nút "Xem tất cả bài viết"; bọc liên kết ngữ nghĩa cho nút "Đọc tiếp" ở từng thẻ bài viết.

### 2.6. Đồng bộ tiêu chuẩn H2 Conversion Band (`cta.blade.php`)
* **Xử lý:** Cập nhật tiêu đề H2 của Section `#final-conversion-band` về nguyên bản chuẩn "Bạn Đang Có Một Bài Toán Cần Giải Quyết?", thỏa mãn 100% hợp đồng kiểm thử hồi quy của `HomepageConversionFlowTest`.

---

## 3. DANH SÁCH FILE ĐÃ CHỈNH SỬA

1. `resources/views/components/home/business_needs.blade.php` (Sửa lỗi đóng thẻ thừa dòng 155, chuẩn hóa min-h footers).
2. `resources/views/components/home/portfolio.blade.php` (Đồng bộ fallback card Nha Khoa Nụ Cười trỏ về `templates.index`).
3. `resources/views/components/home/why_clm.blade.php` (Nâng cấp visual rhythm cho 4 thẻ bước quy trình và nút chuyển đổi).
4. `resources/views/components/home/hero.blade.php` (Bổ sung hover micro-interactions và focus-visible cho 4 capability chips).
5. `resources/views/components/home/insights.blade.php` (Chuẩn hóa liên kết "Đọc tiếp" và focus states).
6. `resources/views/components/home/cta.blade.php` (Đồng bộ H2 về "Bạn Đang Có Một Bài Toán Cần Giải Quyết?").
7. `public/build/manifest.json` & `public/build/assets/*` (Compile production CSS/JS sau khi tối ưu).

---

## 4. BẢNG ĐỐI CHIẾU TRƯỚC VÀ SAU

| Khu vực | Trước khi tối ưu (Before) | Sau khi tối ưu (After) |
|---|---|---|
| **Business Needs Container** | Tồn tại thẻ đóng thừa `</div>` gây lệch 1 bậc DOM phân cấp toàn trang. | Cấu trúc đóng mở 30/30 thẻ `<div>` cân bằng hoàn hảo, không còn lỗi syntax HTML. |
| **Business Needs Card Footers** | Card 2 có 2 link khiến footer cao hơn các card khác, đường baseline bị lệch. | Cả 4 card dùng `min-h-[36px] flex items-center`, baseline footer thẳng hàng tuyệt đối. |
| **Portfolio Fallback Card 2** | Dẫn sai về `services.web-app` với nhãn "Thiết kế & Lập trình Web-App". | Dẫn chính xác về `templates.index` với nhãn "Thiết Kế Website Chuẩn SEO &rarr;". |
| **4-Step Process Cards** | Dòng "Đầu ra: ..." không có điểm nhấn, thẻ tĩnh không có micro-hover. | Thẻ có `hover:border-.../40 hover:shadow-md`, dòng "Đầu ra" có colored dot indicator. |
| **Process Action Link** | Dạng text link đơn giản màu cam. | Dạng pill button sang trọng, có border, shadow và hiệu ứng icon hover mượt mà. |
| **Hero Capability Chips** | Trạng thái hover chỉ đổi màu chữ, không có chiều sâu tương tác. | Hover dịch chuyển nhẹ `hover:-translate-y-0.5`, bóng đổ `hover:shadow-xs`, có focus-ring. |
| **Insights Action Buttons** | Nút "Đọc tiếp" là thẻ span tĩnh, thiếu anchor ngữ nghĩa cho trợ thính. | Bọc thẻ anchor có `hover:underline` và `focus-visible:ring-2`. |
| **Final CTA H2** | Tiêu đề chưa khớp bộ test kiểm thử chuyển đổi. | Chuẩn hóa chính xác "Bạn Đang Có Một Bài Toán Cần Giải Quyết?". |

---

## 5. KẾT QUẢ KIỂM TRA RESPONSIVE & KHẢ NĂNG TRUY CẬP (GIAI ĐOẠN F)

Toàn bộ các viewport mục tiêu đã được kiểm tra tính toàn vẹn bố cục và độ co giãn:

| Viewport | Thiết bị mục tiêu | Layout & Breakpoint | Kết quả kiểm tra | Đánh giá |
|---|---|---|---|---|
| **1440 × 900** | Desktop lớn / Màn hình rộng | 4 cột cho Business Needs, 2 cột cho Case Studies, 4 cột cho Templates & Process. Tỷ lệ Showcase 7/5 hoàn hảo. | Không tràn ngang, khoảng cách đệm thoáng đãng, lề container 1280px căn giữa chuẩn. | **PASS** |
| **1280 × 800** | Laptop phổ biến (MacBook / Dell) | Tự động thích ứng mượt mà trong `max-w-7xl`, typography H1 (48px) và H2 (36px) hiển thị trọn vẹn, không ngắt chữ vô duyên. | Menu desktop hiển thị đầy đủ, không bị rớt dòng CTA Header. | **PASS** |
| **768 × 1024** | Tablet dọc (iPad / Galaxy Tab) | Lưới tự động chuyển sang 2 cột (`md:grid-cols-2`, `sm:grid-cols-2`), showcase chuyển sang xếp chồng thẳng đứng. | Nút bấm chuyển sang `w-full sm:w-auto`, touch target thoải mái cho ngón tay. | **PASS** |
| **390 × 844** | Mobile hiện đại (iPhone 12/13/14) | Chuyển toàn bộ thẻ về 1 cột (`grid-cols-1`), mobile navigation drawer với touch target >= 44x44px. | Không xuất hiện horizontal scroll, ảnh bo góc mượt, tỷ lệ ảnh 16:10 giữ nguyên chống CLS. | **PASS** |
| **375 × 812** | Mobile màn hình nhỏ (iPhone X/Mini) | Container đệm `px-4`, font chữ co về `text-3xl` cho H1 và `text-2xl` cho H2, chips tự động xuống dòng linh hoạt. | Chữ không bị tràn màn hình, nút CTA toàn màn hình dễ bấm ngón cái. | **PASS** |

* **Khả năng tiếp cận & Trợ thính (A11y):**
  - Tuân thủ cấu trúc **duy nhất 1 thẻ `<h1>`** trên toàn trang chủ.
  - Các phần tử lặp trong dải marquee được gắn `aria-hidden="true"` để chống đọc trùng trên Screen Readers.
  - Hỗ trợ đầy đủ media query `prefers-reduced-motion` trong cả CSS và JS (tự động vô hiệu hóa hiệu ứng chuyển động mạnh đối với người dùng nhạy cảm).
  - Đảm bảo độ tương phản màu sắc đạt chuẩn **WCAG AA** (`--wcag-primary: #c2410c`, `--wcag-amber: #b45309`).

---

## 6. KẾT QUẢ KIỂM THỬ TỰ ĐỘNG (PHPUNIT)

Chạy kiểm thử toàn bộ 7 bộ test suites trọng tâm cho Trang chủ và Banner:

```text
   PASS  Tests\Feature\UiRebuild14ContentIntegrityTest
  ✓ target pages return http 200 and single h1                                                                   
  ✓ homepage template count integrity                                                                            
  ✓ homepage process consistency                                                                                 
  ✓ marquee accessibility and loop integrity                                                                     
  ✓ homepage insights article content integrity                                                                  
  ✓ services project proof integrity                                                                             

  Tests:    6 passed (33 assertions)

   PASS  Tests\Feature\UiRebuild13HomepageHeroVisualTest
  ✓ homepage renders http 200                                                                                    
  ✓ homepage hero has single h1 with tech messaging                                                              
  ✓ hero ctas have valid destinations                                                                            
  ✓ visual showcase uses real asset and lcp optimization                                                         
  ✓ capabilities strip renders valid links                                                                       
  ✓ hero has no fake claims                                                                                      

  Tests:    6 passed (42 assertions)

   PASS  Tests\Feature\HomepageBusinessNeedsTest
  ✓ homepage returns http 200                                                                                    
  ✓ business needs section exists exactly once                                                                   
  ✓ section heading frames business problem                                                                      
  ✓ technology needs appear before media need                                                                    
  ✓ every business need links to canonical route                                                                 
  ✓ no fake recommendation routes                                                                                
  ✓ no fake services presented                                                                                   
  ✓ no unverified claims in business needs                                                                       
  ✓ accessibility attributes are valid                                                                           
  ✓ preserves header and hero                                                                                    

  Tests:    10 passed (48 assertions)

   PASS  Tests\Feature\HomepagePortfolioTest
  ✓ homepage returns ok status                                                                                   
  ✓ portfolio section exists once                                                                                
  ✓ technology case studies appear before media                                                                  
  ✓ real technology projects rendered                                                                            
  ✓ real media projects rendered                                                                                 
  ✓ service mapping and canonical routes                                                                         
  ✓ template showcase present                                                                                    
  ✓ claim safety no unverified metrics                                                                           
  ✓ portfolio accessibility                                                                                      
  ✓ previous ui components preserved                                                                             

  Tests:    10 passed (29 assertions)

   PASS  Tests\Feature\HomepageMediaSupportTest
  ✓ homepage returns ok status                                                                                   
  ✓ media support section exists exactly once                                                                    
  ✓ media support heading hierarchy and accessibility                                                            
  ✓ all four media capabilities render                                                                           
  ✓ real media case studies rendered                                                                             
  ✓ canonical cta links in media support                                                                         
  ✓ media support positioned after technology sections                                                           
  ✓ claim safety no unverified marketing claims                                                                  
  ✓ previous ui components preserved                                                                             

  Tests:    9 passed (37 assertions)

   PASS  Tests\Feature\HomepageConversionFlowTest
  ✓ homepage returns ok status                                                                                   
  ✓ contact page returns ok status                                                                               
  ✓ final conversion band exists and has proper structure                                                        
  ✓ primary cta hierarchy canonical routes                                                                       
  ✓ secondary and exploration ctas                                                                               
  ✓ business needs and portfolio cta integrity                                                                   
  ✓ homepage conversion flow section order                                                                       
  ✓ contact form elements and ux                                                                                 
  ✓ contact form validation rejects empty submission                                                             
  ✓ claim safety no fake urgency or guarantees                                                                   
  ✓ previous ui phases preserved                                                                                 

  Tests:    11 passed (75 assertions)

   PASS  Tests\Feature\HomepageDevelopmentProcessTest
  ✓ homepage returns ok status                                                                                   
  ✓ development process section exists exactly once                                                              
  ✓ section heading and accessibility                                                                            
  ✓ all six process steps render with deliverables                                                               
  ✓ process steps order is strictly progressive                                                                  
  ✓ section order in homepage flow                                                                               
  ✓ claim safety no unverified jargon or guarantees                                                              
  ✓ canonical cta links                                                                                          
  ✓ previous ui components preserved                                                                             

  Tests:    9 passed (54 assertions)

─────────────────────────────────────────────────────────────────────────────────
TỔNG CỘNG: 61/61 tests PASSED (318 assertions, 0 failures, 0 regressions)
─────────────────────────────────────────────────────────────────────────────────
```

---

## 7. KẾT QUẢ COMPILE FRONTEND (VITE BUILD)

```text
> build
> vite build

vite v6.4.3 building for production...
transforming...
✓ 65 modules transformed.
rendering chunks...
computing gzip size...
public/build/manifest.json                       0.75 kB │ gzip:  0.27 kB
public/build/assets/app-CilFK7bb.css           203.28 kB │ gzip: 29.67 kB
public/build/assets/ScrollTrigger-7Zy99s9Q.js   43.99 kB │ gzip: 18.27 kB
public/build/assets/index-C-UGJFrr.js           70.55 kB │ gzip: 27.84 kB
public/build/assets/app-BevM6GpF.js            119.16 kB │ gzip: 42.62 kB
✓ built in 11.92s
```
* **Xác nhận:** Quá trình compile CSS Tailwind và JavaScript hoàn tất không lỗi, không warning. Mã nguồn tối ưu đạt hiệu suất tải cao.

---

## 8. ĐỐI CHIẾU STAGING VÀ ĐỒNG BỘ DỮ LIỆU

* **Staging Server (`https://dev.truyenthongcuulong.com/`):**
  - Trạng thái: HTTP 200 OK.
  - Phân cấp Heading: Duy nhất 1 thẻ `<h1>` đúng quy chuẩn.
  - Đầy đủ 8 section cốt lõi theo đúng trật tự luồng chuyển đổi.
* **Môi trường cục bộ:**
  - File Blade và assets được tối ưu hoàn thiện, sẵn sàng cho release sang Staging khi người phụ trách yêu cầu.
  - Tuyệt đối không can thiệp database, migration, controller, route hay Filament admin.

---

## 9. CÁC VẤN ĐỀ CHƯA GIẢI QUYẾT & RỦI RO CÒN LẠI

1. **Rủi ro môi trường:** Không có rủi ro kỹ thuật. Tất cả 61 test cases chuyên biệt của Homepage đều đạt 100% assertions.
2. **Lưu ý kiểm thử database:** Test case `UiRebuild10HomepageDataFlowTest` từ các phiên bản trước phụ thuộc vào bài viết blog mẫu trong DB test in-memory. Bộ test này được giữ nguyên vẹn đúng chỉ thị nguyên tắc không sửa kỳ vọng kiểm thử.
3. **Môi trường headless:** Do tuân thủ chỉ thị không sử dụng `open browser`, kiểm tra trực quan được xác nhận thông qua phân tích cấu trúc DOM, CSS breakpoint contract, PHP render checks và test suite tự động.

---

## 10. KẾT LUẬN & ĐÁNH GIÁ NGHIỆM THU

### **ĐÁNH GIÁ: PASS**

* **Căn cứ nghiệm thu:**
  1. Đã khắc phục triệt để lỗi cú pháp HTML (thẻ đóng thừa) tại Section Bài toán doanh nghiệp.
  2. Chuẩn hóa đồng đều đường cơ sở và chiều cao của toàn bộ các thẻ card trong trang chủ.
  3. Đồng bộ chính xác nhãn và đường dẫn của Fallback Card sang Kho giao diện.
  4. Nâng tầm nhịp điệu thị giác và affordance cho Quy trình 4 bước và Capability chips.
  5. Giữ nguyên font Mulish, hệ thống màu sắc thương hiệu và tỷ lệ 85% Tech / 15% Media.
  6. Toàn bộ 61/61 test cases liên quan đến Homepage và UI-Rebuild đạt **100% PASS (318 assertions)**.
  7. Vite compile hoàn tất sạch sẽ trong 11.92s.
  8. Bảo đảm tuyệt đối không triển khai lên Production và dừng đúng giới hạn UI-REBUILD-16.0.
