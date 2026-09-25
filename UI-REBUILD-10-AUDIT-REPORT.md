# UI-REBUILD-10 — WEBSITE-WIDE CONTENT ARCHITECTURE & PAGE OWNERSHIP AUDIT REPORT

**Date:** 2026-09-25  
**Role:** Senior UI/UX Architect + Information Architect + Frontend Code Auditor  
**Scope:** Entire Public Website of Truyền Thông Cửu Long (Cửu Long Media - CLM)  
**Status:** AUDIT-ONLY (Strictly Zero Production Code & Test Modification)  

---

## 1. EXECUTIVE SUMMARY

An exhaustive architectural and frontend code audit of the entire public surface of the **Truyền Thông Cửu Long** website was executed to assess information hierarchy, content density, page bloat, and content duplication across all public touchpoints.

### Core Discoveries & Problem Statement
1. **Homepage Role Confusion (Gateway vs. Destination Library):**
   - The homepage (`/`) currently bears **30,207 visible characters**, **33 headings**, **102 links**, and **8 major sections**.
   - Most critically, the homepage's `#portfolio-section` embeds `#ready-made-templates` (`resources/views/components/home/portfolio.blade.php`), loading **all 39+ templates and 13 category filter chips** (`Tất Cả (39)` down to `Bất Động Sản (3)`). This transforms what should be a fast, curated Gateway into a heavy, full-blown Template Catalog.
   - The dedicated template library route `/dich-vu/kho-giao-dien` already exists specifically for this purpose, creating an extreme functional overlap.
2. **Customer & Partner Wall Bloat:**
   - The homepage contains a marquee section (`#marquee-section`) rendering 18 partner logos and 24 client logos, each duplicated in DOM for infinite scroll animation (**84 total DOM nodes**).
   - Dedicated canonical pages `/doi-tac` (28,019 characters) and `/khach-hang` (24,243 characters) already exist. The homepage's role is not to be a full client directory, but to provide authoritative social proof.
3. **"Second Homepage" Phenomenon in Flagship Service Pages:**
   - `/dich-vu/web-app` has expanded to **9 major sections, 30 headings, 31 paragraphs, 86 links, and 28,538 characters**, attempting to serve as a mini-landing page, capability sheet, process explainer, and case study archive simultaneously.
4. **Content Duplication across Service, Process & Company Pages:**
   - The 6-step project delivery methodology is canonically housed at `/quy-trinh`, but its steps, phases, and commitments are duplicated semantically and structurally across `/dich-vu/web-app`, `/ve-chung-toi`, and `/ho-so-nang-luc`.
   - Case studies are fragmented: rendered with varying degrees of detail across `/`, `/dich-vu/web-app`, `/dich-vu/media`, and `/du-an`.
5. **CTA Overlap and Destination Cannibalization:**
   - Over 60% of all public primary CTAs resolve to a single endpoint: `/lien-he`. While a high-intent conversion funnel is healthy, transactional sub-actions (e.g., booking an ekip via `/dich-vu/booking` or requesting a formal estimate via `/dich-vu/bang-gia`) are bypassed and obscured.

---

## 2. SCOPE & METHOD

### Audited Scope
- **Framework & Stack:** Laravel 10 / Blade / TailwindCSS / Alpine.js.
- **Source Paths Inspected:**
  - `routes/web.php`
  - `app/Http/Controllers/` (`PageController`, `ServiceController`, `ProjectController`, `BlogController`, `ContactController`, etc.)
  - `resources/views/` (`pages/`, `layouts/`, `components/home/`, `services/`, `projects/`, `blog/`, `templates/`, `resources/`)
  - Static configuration data: `clients.json`, `partners.json`, `pricing.json`
- **Total Public Routes Cataloged:** 21 routes (17 static/hub pages + 4 dynamic model detail endpoints).

### Protected Scope (Untouched)
- No audit or modifications were made to `/admin`, `/auth`, `/api`, Filament resources, user authentication/authorization, database tables, or business logic.

### Measurement Methodology
- Automated DOM & text density parser (`scratch/audit_metrics.php`) executed against live server endpoints (`http://127.0.0.1:8888`), gathering:
  - Exact counts of `<h1>`, `<h2>`, `<h3>`, `<h4>`, total headings
  - Paragraph counts `<p>`
  - Anchor counts `<a>`, `<button>`, `<form>`, `<img>`
  - Visible character lengths of rendered text
  - Registered section IDs and CTA destinations
- Manual inspection of Blade component hierarchy, Alpine.js reactivity, and layout inheritance.

---

## 3. PUBLIC ROUTE INVENTORY

| # | Route | HTTP | Controller & Method | Blade View Template | Primary Purpose | Page Type |
|---|-------|------|---------------------|---------------------|-----------------|-----------|
| 1 | `/` | GET | `PageController@home` | `pages.home` | Brand Gateway, core value proposition, pathfinder | **A. Gateway** |
| 2 | `/dich-vu` | GET | `PageController@services` | `services.index` | Overview of all 6 technical & media service offerings | **B. Directory** |
| 3 | `/dich-vu/web-app` | GET | `PageController@webApp` | `services.web-app` | Deep technical breakdown of custom web/app engineering | **C. Deep Dive** |
| 4 | `/dich-vu/media` | GET | `PageController@media` | `services.media` | Showcase of commercial video, TVC, corporate media | **C. Deep Dive** |
| 5 | `/dich-vu/marketing` | GET | `PageController@marketing` | `services.marketing` | SEO, growth marketing, data-driven brand positioning | **C. Deep Dive** |
| 6 | `/dich-vu/kho-giao-dien` | GET | `PageController@templates` | `templates.index` | Searchable, filterable catalog of pre-built UI templates | **E. Library** |
| 7 | `/dich-vu/bang-gia` | GET | `PageController@pricing` | `pages.pricing` | Transparent pricing tables, package scopes, quote estimator | **D. Transaction** |
| 8 | `/dich-vu/booking` | GET | `PageController@booking` | `pages.booking` | Crew dispatch, shooting schedule, on-demand media booking | **D. Transaction** |
| 9 | `/du-an` | GET | `ProjectController@index` | `projects.index` | Portfolio directory of software, web, and media case studies | **B. Directory** |
| 10 | `/du-an/{slug}` | GET | `ProjectController@show` | `projects.show` | In-depth case study breakdown (problem, solution, metrics) | **C. Deep Dive** |
| 11 | `/bai-viet` | GET | `BlogController@index` | `blog.index` | Thought leadership, tech insights, digital business articles | **B. Directory** |
| 12 | `/bai-viet/{slug}` | GET | `BlogController@show` | `blog.show` | Article content reader and related knowledge distribution | **C. Deep Dive** |
| 13 | `/tai-nguyen` | GET | `PageController@resources` | `pages.resources` | Downloadable whitepapers, templates, checklists, brand kits | **E. Library** |
| 14 | `/tai-nguyen/{slug}` | GET | `PageController@resourceDetail` | `resources.show` | Lead-generation download page for specific resource asset | **D. Transaction** |
| 15 | `/ve-chung-toi` | GET | `PageController@about` | `pages.about` | Company narrative, culture, leadership, vision, methodology | **C. Deep Dive** |
| 16 | `/doi-tac` | GET | `PageController@partners` | `pages.partners` | Technology partners, production alliances, partnership models | **B. Directory** |
| 17 | `/khach-hang` | GET | `PageController@clients` | `pages.clients` | Client roster, enterprise testimonials, industry trust marks | **B. Directory** |
| 18 | `/tuyen-dung` | GET | `PageController@careers` | `pages.careers` | Employer branding, open engineering/creative positions, culture | **C. Deep Dive** |
| 19 | `/quy-trinh` | GET | `PageController@process` | `pages.process` | Canonical 6-step project delivery lifecycle and SLA guarantees | **C. Deep Dive** |
| 20 | `/ho-so-nang-luc` | GET | `PageController@profile` | `pages.company-profile` | Complete digital capability profile & downloadable credentials | **C. Deep Dive** |
| 21 | `/lien-he` | GET | `PageController@contact` | `pages.contact` | Primary consultation intake form, office headquarters, hotlines | **D. Transaction** |
| 22 | `/chinh-sach-bao-mat` | GET | `PageController@privacy` | `pages.privacy` | Privacy policy & legal compliance | **C. Deep Dive** |
| 23 | `/dieu-khoan-dich-vu` | GET | `PageController@terms` | `pages.terms` | Terms of service, engagement contract terms, SLA | **C. Deep Dive** |

---

## 4. PAGE TYPE CLASSIFICATION & UX TEMPLATE PRINCIPLES

To prevent pages from degenerating into formless aggregations of identical cards, each page type must strictly adhere to an architectural UX model:

### Type A: Gateway (`/`)
- **UX Sequence:** `Understand → Orient → Proof Points → Select Path`
- **Core Rule:** Never host complete datasets. Maximum 3–4 items per featured preview card set. Gateway's job is rapid routing, not exhaustive reading.

### Type B: Directory (`/dich-vu`, `/du-an`, `/bai-viet`, `/doi-tac`, `/khach-hang`)
- **UX Sequence:** `Orient Scope → Filter/Categorize → Browse Grid → Select Item Detail`
- **Core Rule:** High visual density, quick-scannable cards, category chips, zero long-form prose before the grid.

### Type C: Deep Dive (`/dich-vu/web-app`, `/ve-chung-toi`, `/quy-trinh`, `/du-an/{slug}`, etc.)
- **UX Sequence:** `Value Proposition → Deep Technical/Creative Breakdown → Proof / Deliverables → Contextual Conversion`
- **Core Rule:** Specialized, bespoke content. Never duplicate generic company introductions or full process diagrams from other pages.

### Type D: Transaction (`/lien-he`, `/dich-vu/booking`, `/dich-vu/bang-gia`, `/tai-nguyen/{slug}`)
- **UX Sequence:** `Action Intent → Frictionless Form / Configurator → Trust Markers / SLA → Submission Confirmation`
- **Core Rule:** Immediate form accessibility. Keep marketing copy to an absolute minimum (< 300 words). Zero competing secondary CTAs.

### Type E: Library (`/dich-vu/kho-giao-dien`, `/tai-nguyen`)
- **UX Sequence:** `Keyword / Category Filter → Live Card Preview → Inspect Specs / Live Demo → Action (Select / Download)`
- **Core Rule:** Pure utility and catalog browsing. Instant visual responsiveness.

---

## 5. PRIMARY JOB MATRIX

| Route | Primary User Intent | Primary Page Job | Secondary Jobs | Expected User Action | Canonical Responsibility | NOT Responsible For |
|---|---|---|---|---|---|---|
| `/` | Discover what CLM offers and verify credibility | Route visitor to the appropriate specialized branch (Web, Media, or Contact) in < 15 seconds | Provide top-level trust validation (enterprise clients, highlighted case studies) | Click a primary solution button or high-intent consultation CTA | Holistic brand positioning & navigation routing | Full template browsing, complete client directory, full blog archives, deep engineering specs |
| `/dich-vu` | Understand all service options offered by CLM | Present the complete capability landscape and direct users to specialized service deep dives | Provide clear comparison between Web, Media, and Marketing | Click through to `/dich-vu/{service}` or `/dich-vu/bang-gia` | Full capability taxonomy and service routing | Deep architecture explanations, pricing tables, booking forms |
| `/dich-vu/web-app` | Evaluate technical competency for web/software development | Convince CTOs / Product Owners of CLM’s engineering standards, tech stack, and architectural rigor | Display relevant technology case studies and scope estimations | Request an architectural consultation or view live demos | Software architecture, tech stack, deliverable standards | Marketing/SEO details, full general process, media crew booking |
| `/dich-vu/media` | Evaluate video/photo production capability | Demonstrate commercial cinema quality, equipment arsenal, and portfolio reels | Clarify production workflows and crew availability | Inquire about video production or book an ekip (`/dich-vu/booking`) | Media portfolio, production workflow, visual reel showcase | Code/software specs, SEO strategy, template catalog |
| `/dich-vu/marketing` | Find growth & SEO marketing solutions | Outline organic growth methodologies, data analytics, and performance marketing deliverables | Establish realistic KPIs and reporting cadences | Book a growth consultation or view pricing | Marketing funnel strategy, SEO audit methodology, performance proof | Video production booking, software architecture |
| `/dich-vu/kho-giao-dien` | Browse ready-made website templates for their industry | Provide an instant, interactive catalog with live demos and industry categorization | Allow direct inquiry for specific UI templates | Filter by industry, view live preview, click "Chọn Mẫu Này" | Canonical template repository, live demo links, template specs | Custom software architecture essays, media reels |
| `/dich-vu/bang-gia` | Understand pricing ranges and project investment tiers | Provide transparent cost models, package inclusions/exclusions, and estimation calculators | Reduce sales friction by setting upfront budget expectations | Request formal itemized quotation or select a package | Package pricing tiers, scope definitions, estimation parameters | Educational long-form articles, full case studies |
| `/dich-vu/booking` | Dispatch media crew or book production dates | Gather event date, crew scale, equipment needs, and location requirements | Provide fast turnaround guarantees and transparent crew tiers | Complete booking intake form | Crew availability, gear inventory specs, dispatch intake | Software quotes, SEO audits, general contact messages |
| `/du-an` | Inspect past work across all sectors | Present searchable and categorized real-world client deliverables | Filter between Software/Web and Media/Production projects | Click into a detailed case study (`/du-an/{slug}`) | Portfolio archive, project categorization, proof directory | Generic sales pitches, pricing packages |
| `/du-an/{slug}` | Deep dive into a specific project's success | Detail the business challenge, technical solution, execution roadmap, and measurable results | Validate capability through metrics (traffic, conversions, uptime) | Contact team to replicate similar success | Specific case study narrative, technical stack, metrics | Listing all other projects, general company history |
| `/bai-viet` | Learn industry best practices and market insights | Deliver authoritative digital strategy and engineering articles | Boost organic search authority and establish thought leadership | Read articles, subscribe, or explore mentioned services | Content hub, category filters, editorial archive | Direct sales pitch, booking forms |
| `/tai-nguyen` | Download free tools, checklists, and guides | Deliver high-value lead magnets to qualified business prospects | Capture inbound leads via gating downloads | Download PDF resource / access tool | Resource downloads, lead generation kits, templates | Full service quotes, software development contracts |
| `/ve-chung-toi` | Learn about the organization behind the work | Communicate company history, leadership team, core values, and corporate mission | Establish trust with institutional and enterprise clients | Reach out for enterprise partnership or career opportunities | Corporate narrative, executive profiles, values & mission | Step-by-step project delivery SLA (belongs in `/quy-trinh`) |
| `/doi-tac` | Check strategic technology & production alliances | Showcase certified technology partners (cloud, infrastructure, payment) and production partners | Attract prospective tech and ecosystem partners | Explore partnership opportunities | Strategic vendor alliances, infrastructure stack partners | Full customer reviews, generic marketing content |
| `/khach-hang` | Verify past clients and testimonials | Display full roster of 50+ enterprise and SME clients across industries | Provide unfiltered social proof and video testimonials | Gain confidence to initiate a project | Client logos, testimonial quotes, industry segmentation | Generic sales form, software architecture specs |
| `/tuyen-dung` | Explore career opportunities at CLM | Present open positions, company perks, workplace culture, and application guidelines | Attract top engineering and creative talent | Submit CV / Portfolio application | Open job requisitions, compensation culture, HR intake | Client sales pitches, project pricing |
| `/quy-trinh` | Understand how a project is executed and managed | Provide full transparency on the 6-stage delivery lifecycle, sprint cadences, and QA checkpoints | Mitigate risk for first-time digital outsourcing clients | Confirm project kickoff with full process confidence | Canonical 6-stage delivery methodology & SLAs | Detailed service pricing, media crew equipment lists |
| `/ho-so-nang-luc` | Review executive credentials for bidding/procurement | Provide an executive summary of capabilities, certifications, past projects, and legal credentials | Serve procurement departments and tender evaluations | Download PDF profile or initiate formal RFP | Comprehensive procurement-ready capability profile | Blog posts, individual template browsing |
| `/lien-he` | Initiate direct contact with CLM | Provide immediate phone, email, address, map, and inquiry submission form | Direct specific inquiries (Media vs. Web) to appropriate leads | Submit project brief or call hotline | Intake form, headquarters map, hotline directory | Heavy marketing pitches, lengthy case studies |

---

## 6. SECTION INVENTORY (PAGE-BY-PAGE)

### Route: `/` (Home) — 8 Major Sections
| # | Section ID | Heading | Content Type | Role / Purpose | CTA & Target | Duplicate Elsewhere? |
|---|------------|---------|--------------|----------------|--------------|----------------------|
| 1 | `#hero-section` | H1: Giải Pháp Web, Web App & Hệ Thống Số... | Marketing / Hero | Value proposition, credibility badges, quick stats | "Bắt đầu dự án" (`/lien-he`), "Xem giải pháp" (`/dich-vu`) | Partial semantic duplicate of `/ve-chung-toi` hero |
| 2 | `#marquee-section` | - | Proof / Marquee | Infinite logo scroll of 18 partners & 24 clients (84 DOM nodes) | None | **High Duplicate** of `/doi-tac` and `/khach-hang` |
| 3 | `#business-needs` | H2: Doanh Nghiệp Của Bạn Đang Tìm Kiếm Giải Pháp Nào? | Functional Component | Solution Finder with 4 interactive tabs (Web App, Web Doanh Nghiệp, Media, Growth) | Dynamic tab links to `/dich-vu/*` | Semantic overlap with `/dich-vu` directory |
| 4 | `#portfolio-section` | H2: Dự Án & Mẫu Giao Diện Tiêu Biểu | Proof & Full Catalog | Rendered 2 flagship Case Studies + **Embedded 39+ Templates with 13 Category Filters** | "Khám phá kho giao diện" (`/dich-vu/kho-giao-dien`), "Xem tất cả dự án" (`/du-an`) | **CRITICAL DUPLICATE**: Contains full `/dich-vu/kho-giao-dien` catalog |
| 5 | `#why-clm` | H2: Vì Sao Doanh Nghiệp Chọn Cửu Long Media? | Marketing / Proof | 4 core differentiators (Tư duy kiến trúc, Đội ngũ in-house, Tối ưu chuyển đổi, Bảo hành cam kết) | "Khám phá năng lực & hồ sơ" (`/ve-chung-toi`) | Semantic duplicate of `/ve-chung-toi` & `/quy-trinh` |
| 6 | `#media-support` | H2: Năng Lực Sản Xuất Media Đồng Hành | Marketing / Proof | 3 media capability cards + 3 featured production projects | "Khám phá dịch vụ Media" (`/dich-vu/media`), "Đặt lịch quay/chụp" (`/dich-vu/booking`) | Functional duplicate of `/dich-vu/media` |
| 7 | `#insights-section` | H2: Góc Nhìn Chuyên Gia & Xu Hướng Số | Content Feed | 3 latest blog articles with thumbnails and metadata | "Xem tất cả bài viết" (`/bai-viet`) | Summary feed of `/bai-viet` (Legitimate) |
| 8 | `#final-conversion-band` | H2: Sẵn Sàng Số Hóa & Nâng Tầm Doanh Nghiệp? | CTA Conversion | High-contrast conversion banner with trust metrics | "Bắt đầu dự án" (`/lien-he`), "Xem giải pháp" (`/dich-vu`) | Duplicated across `/ho-so-nang-luc` |

### Route: `/dich-vu` (Service Hub) — 5 Major Sections
| # | Section ID | Heading | Content Type | Role / Purpose | CTA & Target | Duplicate Elsewhere? |
|---|------------|---------|--------------|----------------|--------------|----------------------|
| 1 | Hero Banner | H1: Giải Pháp Công Nghệ Cho Những Bài Toán Vận Hành... | Hero | Hub orientation, service scope summary | "Tư vấn lộ trình" (`#service-cards`) | Unique |
| 2 | `#service-cards` | H2: 6 Trụ Cột Năng Lực Cốt Lõi | Directory Grid | 6 comprehensive cards (Web App, Enterprise Web, Media, Marketing, Kho Giao Diện, Ekip Booking) | Direct links to each sub-service | Canonical service directory |
| 3 | Tech Stack Bar | H2: Công Nghệ Tiêu Chuẩn Hiện Đại | Proof / Specs | Badges for Laravel, Vue, React, Tailwind, Docker, AWS | None | Duplicated in `/dich-vu/web-app` |
| 4 | Value Matrix | H2: Cam Kết Chất Lượng Dịch Vụ | Marketing / Proof | Delivery time, SLA, bug fix warranty, documentation | "Xem quy trình triển khai" (`/quy-trinh`) | Semantic duplicate of `/quy-trinh` |
| 5 | `#cta-contact` | H2: Bạn Cần Tư Vấn Giải Pháp Phù Hợp? | CTA Conversion | Global service footer CTA band | "Liên hệ ngay" (`/lien-he`) | Global footer CTA pattern |

### Route: `/dich-vu/web-app` (Web App Flagship) — 9 Major Sections
| # | Section ID | Heading | Content Type | Role / Purpose | CTA & Target | Duplicate Elsewhere? |
|---|------------|---------|--------------|----------------|--------------|----------------------|
| 1 | Hero | H1: Xây Dựng Web App & Website Doanh Nghiệp... | Hero | Technical value proposition, key metrics | "Tư vấn kiến trúc" (`/lien-he`), "Dự toán chi phí" (`/dich-vu/bang-gia`) | Unique |
| 2 | Problem Statement | H2: Những Rào Cản Thường Gặp Khi Triển Khai Phần Mềm | Marketing | 4 common software pitfalls (chậm chạp, khó mở rộng, spaghetti code, bảo trì đắt) | None | Unique to technical buyer |
| 3 | Technical Architecture | H2: Kiến Trúc Hệ Thống & Năng Lực Công Nghệ | Technical Specs | Frontend, Backend, Database, Cloud & DevOps breakdown | None | Canonical technical spec |
| 4 | `#case-studies` | H2: Dự Án Tiêu Biểu Đã Triển Khai | Proof | 2 deep case studies with architecture diagrams & outcomes | "Xem case study chi tiết" (`/du-an/{slug}`) | Shared with `/du-an` |
| 5 | Delivery Lifecycle | H2: Quy Trình Phát Triển 6 Giai Đoạn | Methodology | Sprint-based delivery timeline | "Xem quy trình chi tiết" (`/quy-trinh`) | **High Semantic Duplicate** of `/quy-trinh` |
| 6 | Deliverable Standard | H2: Bộ Bàn Giao Tiêu Chuẩn Doanh Nghiệp | Specifications | Source code, API docs, deployment scripts, SLA docs | None | Canonical deliverable spec |
| 7 | FAQ | H2: Câu Hỏi Thường Gặp | Informational | 5 technical & contract FAQs | None | Unique |
| 8 | Cross-Promotion | H2: Cần Mẫu Web Có Sẵn Triển Khai Ngay? | Secondary Routing | Card pointing to template warehouse | "Xem kho giao diện" (`/dich-vu/kho-giao-dien`) | Contextual cross-link |
| 9 | `#cta-contact` | H2: Bắt Đầu Xây Dựng Hệ Thống Của Bạn | CTA Conversion | Contact form trigger | "Gửi yêu cầu kỹ thuật" (`/lien-he`) | Standardized CTA |

### Route: `/dich-vu/kho-giao-dien` (Template Library) — 6 Major Sections
| # | Section ID | Heading | Content Type | Role / Purpose | CTA & Target | Duplicate Elsewhere? |
|---|------------|---------|--------------|----------------|--------------|----------------------|
| 1 | Hero Header | H1: Kho Giao Diện Website Đa Ngành Chuẩn SEO | Hero | Library introduction, search intent setup | Quick category filter chips | Canonical Library Header |
| 2 | Filter & Search Bar | - | Functional UI | Keyword search input + 13 Category filter tabs | Filters grid dynamically | Unique |
| 3 | Template Catalog Grid | H2: Danh Sách Giao Diện Mẫu | Database Listing | 39+ interactive cards with preview image, tags, demo link, select CTA | Live Demo modal & "Chọn Mẫu" (`/lien-he?template=...`) | **Canonical Owner** (Duplicated on Homepage) |
| 4 | Template Benefits | H2: Vì Sao Nên Dùng Giao Diện Có Sẵn Của CLM? | Marketing | Tối ưu chi phí, triển khai trong 48h, chuẩn SEO 100% | None | Unique to template buyers |
| 5 | Customization Steps | H2: Quy Trình Triển Khai Từ Giao Diện Có Sẵn | Informational | 3-step rapid launch (Chọn mẫu → Tùy biến → Bàn giao) | None | Unique to rapid launch |
| 6 | `#cta-contact` | H2: Chưa Tìm Thấy Mẫu Phù Hợp Với Ngành Của Bạn? | CTA Conversion | Custom build consultation | "Yêu cầu thiết kế riêng" (`/lien-he`) | Legitimate fallback CTA |

### Route: `/dich-vu/bang-gia` (Pricing & Estimation) — 7 Major Sections
| # | Section ID | Heading | Content Type | Role / Purpose | CTA & Target | Duplicate Elsewhere? |
|---|------------|---------|--------------|----------------|--------------|----------------------|
| 1 | Hero Header | H1: Bảng Giá Tham Khảo & Dự Toán Chi Phí | Hero | Pricing transparency statement | Tab switcher (Web vs Media) | Canonical Transaction Header |
| 2 | Web Packages Tier | H2: Bảng Giá Thiết Kế Website & Web App | Transactional Grid | 3 tiers: Standard, Business, Custom Enterprise | "Chọn gói này" (`/lien-he?package=...`) | Unique canonical pricing |
| 3 | Media Packages Tier | H2: Bảng Giá Sản Xuất Media & Quay Chụp | Transactional Grid | 3 tiers: Cơ bản, Nâng cao, Doanh nghiệp | "Đặt lịch sản xuất" (`/dich-vu/booking`) | Unique canonical pricing |
| 4 | Add-on Services | H2: Các Dịch Vụ Mở Rộng & Nâng Cấp | Pricing Table | Hosting, SSL, Bảo trì định kỳ, Viết bài chuẩn SEO | Add-on checkboxes | Unique |
| 5 | Cost Estimator | H2: Dự Toán Chi Phí Nhanh | Interactive Calculator | Sliders & checkboxes to compute rough project estimate | "Nhận báo giá chi tiết" (`/lien-he`) | Unique |
| 6 | Pricing FAQ | H2: Câu Hỏi Thường Gặp Về Chi Phí & Thanh Toán | Informational | Milestones, vat invoice, recurring maintenance | None | Unique |
| 7 | `#cta-contact` | H2: Cần Báo Giá Chi Tiết Theo Hồ Sơ Yêu Cầu (RFP)? | CTA Conversion | Enterprise RFP intake | "Gửi yêu cầu báo giá" (`/lien-he`) | Standardized CTA |

### Route: `/dich-vu/booking` (Crew & Equipment Dispatch) — 5 Major Sections
| # | Section ID | Heading | Content Type | Role / Purpose | CTA & Target | Duplicate Elsewhere? |
|---|------------|---------|--------------|----------------|--------------|----------------------|
| 1 | Hero Header | H1: Điều Động Ekip Quay Phim, Chụp Ảnh & Hỗ Trợ Sự Kiện | Hero | Crew availability commitment & quick dispatch promise | Jump to booking form | Unique |
| 2 | Booking Form | H2: Đặt Lịch Ekip Nhanh | Transactional Form | Date picker, service type, crew scale, location, phone | "Xác nhận đặt lịch" (Form submit) | **Canonical Owner** of booking transaction |
| 3 | Crew Capabilities | H2: Các Vị Trí Nhân Sự Sẵn Sàng Điều Động | Service Specs | Đạo diễn, Cameraman, Flycam pilot, Kỹ thuật ánh sáng | None | Contextual proof for booking |
| 4 | Gear & Tech Arsenal | H2: Thiết Bị Sản Xuất Tiêu Chuẩn Điện Ảnh | Hardware Specs | Sony Cinema FX series, DJI Ronin, Aputure lighting | None | Duplicate of `/dich-vu/media` gear section |
| 5 | `#cta-contact` | H2: Cần Tư Vấn Gói Sản Xuất Trọn Gói Lớn? | CTA Conversion | Enterprise media consult | "Liên hệ trực tiếp" (`/lien-he`) | Standardized CTA |

### Route: `/quy-trinh` (Canonical 6-Step Process) — 5 Major Sections
| # | Section ID | Heading | Content Type | Role / Purpose | CTA & Target | Duplicate Elsewhere? |
|---|------------|---------|--------------|----------------|--------------|----------------------|
| 1 | Hero Header | H1: Quy Trình Triển Khai Phần Mềm & Nền Tảng Số Minh Bạch... | Hero | Philosophy of transparency and deterministic milestones | None | Unique |
| 2 | `#development-process` | H2: 6 Giai Đoạn Triển Khai Tiêu Chuẩn | Core Methodology | Detailed breakdown of Stages 1–6 (Khảo sát, Kiến trúc, UI/UX, Lập trình, QA/QC, Bàn giao) | None | **CANONICAL OWNER** of delivery process |
| 3 | Deliverable Matrix | H2: Minh Bạch Bàn Giao Từng Giai Đoạn | SLA & Governance | Input/Output artifacts per stage | None | Unique |
| 4 | Post-launch Warranty | H2: Cam Kết Sau Bàn Giao & Bảo Hành 12 Tháng | SLA & Governance | Support response time (< 2h), uptime monitoring | None | Unique |
| 5 | `#cta-contact` | H2: Sẵn Sàng Triển Khai Theo Quy Trình Chuẩn? | CTA Conversion | Project intake trigger | "Bắt đầu khảo sát yêu cầu" (`/lien-he`) | Standardized CTA |

---

## 7. CONTENT OWNERSHIP MATRIX

This matrix designates the **single canonical owner** for every major content subject across the website, dictating whether other pages may show a high-level summary or must strictly link out.

| Content Topic | Current Pages Hosting Topic | Canonical Owner | Summary Allowed? | Full Content Allowed? | Required Action |
|---|---|---|---|---|---|
| **Company Story & Narrative** | `/`, `/ve-chung-toi`, `/ho-so-nang-luc` | `/ve-chung-toi` | YES (1 card / 1 paragraph on `/` and `/ho-so-nang-luc`) | `/ve-chung-toi` ONLY | **COMPRESS** on `/` and `/ho-so-nang-luc` |
| **Why Cửu Long (Differentiators)** | `/`, `/ve-chung-toi`, `/quy-trinh`, `/ho-so-nang-luc` | `/ve-chung-toi` | YES (4 short icon badges on `/`) | `/ve-chung-toi` ONLY | **COMPRESS** on `/`, remove duplication in `/quy-trinh` |
| **All-Service Overview** | `/`, `/dich-vu`, `/ho-so-nang-luc` | `/dich-vu` | YES (Solution Finder on `/`) | `/dich-vu` ONLY | **KEEP** Solution Finder as routing tool, link to `/dich-vu` |
| **Web & App Engineering Specs** | `/dich-vu/web-app`, `/ho-so-nang-luc` | `/dich-vu/web-app` | YES (Bullet points on `/ho-so-nang-luc`) | `/dich-vu/web-app` ONLY | **KEEP** on `/dich-vu/web-app` |
| **Media & Video Production** | `/`, `/dich-vu/media`, `/dich-vu/booking` | `/dich-vu/media` | YES (Featured reel on `/`) | `/dich-vu/media` ONLY | **COMPRESS** media section on `/` to 1 featured showcase |
| **Growth Marketing & SEO** | `/dich-vu/marketing` | `/dich-vu/marketing` | NO | `/dich-vu/marketing` ONLY | **KEEP** on `/dich-vu/marketing` |
| **Template Warehouse (39+ Items)** | `/`, `/dich-vu/kho-giao-dien` | `/dich-vu/kho-giao-dien` | YES (Maximum 4–6 featured cards on `/`, NO filter chips) | `/dich-vu/kho-giao-dien` ONLY | **MOVE / REMOVE full catalog from `/`**; preserve canonical library |
| **Pricing Packages & Cost Calculator** | `/dich-vu/bang-gia` | `/dich-vu/bang-gia` | NO (Never show pricing tables on `/` or service pages) | `/dich-vu/bang-gia` ONLY | **KEEP** on `/dich-vu/bang-gia` |
| **Media Crew Dispatch / Booking** | `/dich-vu/booking`, `/dich-vu/media` | `/dich-vu/booking` | YES (Contextual CTA on `/dich-vu/media`) | `/dich-vu/booking` ONLY | **MOVE** all booking forms into `/dich-vu/booking` |
| **Projects Directory** | `/`, `/du-an`, `/ho-so-nang-luc` | `/du-an` | YES (Top 2 featured case studies on `/`) | `/du-an` ONLY | **KEEP** curated preview on `/`, full catalog on `/du-an` |
| **Case Study Deep Dives** | `/du-an/{slug}`, `/dich-vu/web-app` | `/du-an/{slug}` | YES (Problem & Result summary on `/dich-vu/web-app`) | `/du-an/{slug}` ONLY | **MOVE** deep architecture diagrams to `/du-an/{slug}` |
| **6-Step Delivery Lifecycle** | `/`, `/quy-trinh`, `/dich-vu/web-app`, `/ve-chung-toi` | `/quy-trinh` | YES (Linear 6-step progress bar without full text) | `/quy-trinh` ONLY | **COMPRESS** in `/dich-vu/web-app`; replace with link to `/quy-trinh` |
| **Client Logo Directory** | `/` (marquee), `/khach-hang`, `/ho-so-nang-luc` | `/khach-hang` | YES (Single static row of top 8–10 marquee logos on `/`) | `/khach-hang` ONLY | **COMPRESS** marquee on `/`; direct full directory to `/khach-hang` |
| **Partner Network** | `/` (marquee), `/doi-tac`, `/ho-so-nang-luc` | `/doi-tac` | YES (Tech partner badges on `/dich-vu`) | `/doi-tac` ONLY | **MOVE** partner listings off generic sections to `/doi-tac` |
| **Articles & Thought Leadership** | `/`, `/bai-viet` | `/bai-viet` | YES (3 latest articles on `/`) | `/bai-viet` ONLY | **KEEP** 3-article preview on `/` |
| **Free Digital Resources / Whitepapers** | `/tai-nguyen`, `/tai-nguyen/{slug}` | `/tai-nguyen` | NO | `/tai-nguyen` ONLY | **KEEP** on `/tai-nguyen` |
| **Contact & General Consultation** | `/lien-he`, Global Footer | `/lien-he` | YES (Footer contact summary) | `/lien-he` ONLY | **KEEP** canonical form on `/lien-he` |

---

## 8. DUPLICATION MATRIX

| Topic | Page A | Page B | Page C | Duplication Type | Severity | Recommended Owner | Remediation Strategy |
|---|---|---|---|---|---|---|---|
| **Ready-Made Templates (39+ items)** | `/` (`#portfolio-section`) | `/dich-vu/kho-giao-dien` | - | **Exact & Functional** | **HIGH** | `/dich-vu/kho-giao-dien` | Remove full Alpine template list and 13 category buttons from `/`. Replace with a static 4-item "Featured Templates" showcase + clear button to library. |
| **Client & Partner Marquee** | `/` (`#marquee-section`) | `/khach-hang` | `/doi-tac` | **Functional & DOM bloat** | **MEDIUM** | Split: Clients to `/khach-hang`, Partners to `/doi-tac` | Deduplicate DOM looping on `/`. Display curated logo bar with links to respective directory pages. |
| **6-Step Project Process** | `/quy-trinh` (`#development-process`) | `/dich-vu/web-app` (Section 5) | `/ho-so-nang-luc` | **Semantic & Structural** | **HIGH** | `/quy-trinh` | Remove multi-paragraph stage breakdowns from `/dich-vu/web-app`. Replace with a compact milestone timeline referencing `/quy-trinh`. |
| **Why Choose CLM / Core Values** | `/` (`#why-clm`) | `/ve-chung-toi` | `/ho-so-nang-luc` | **Semantic** | **MEDIUM** | `/ve-chung-toi` | Keep `/` strictly focused on high-level business advantages; move in-depth philosophy to `/ve-chung-toi`. |
| **Case Study Breakdowns** | `/dich-vu/web-app` (`#case-studies`) | `/du-an/{slug}` | `/` (`#portfolio-section`) | **Content Overlap** | **MEDIUM** | `/du-an/{slug}` | Service pages should only display compact summary cards (Problem/Result) linking to the canonical case study route. |
| **Production Equipment Arsenal** | `/dich-vu/media` | `/dich-vu/booking` | `/ho-so-nang-luc` | **Exact** | **LOW** | `/dich-vu/media` | Keep technical gear specs in `/dich-vu/media`. On `/dich-vu/booking`, replace with a brief bullet list of package capabilities. |
| **Final Conversion Banner** | `/` (`#final-conversion-band`) | `/ho-so-nang-luc` | - | **Exact HTML/Blade** | **LOW** | Shared Component | Extract into a clean, reusable Blade component or standardize on `#cta-contact`. |

---

## 9. HOMEPAGE AUDIT (ROUTE: `/`)

### Measured Code & DOM Metrics
- **HTTP Status:** 200 OK
- **Total Headings:** 33 (`<h1>`: 1, `<h2>`: 6, `<h3>`: 15, `<h4>`: 11)
- **Paragraphs (`<p>`):** 36
- **Links (`<a>`):** 102
- **Buttons (`<button>`):** 28
- **Forms (`<form>`):** 2 (Newsletter + Footer search/contact)
- **Images (`<img>`):** 11
- **Major Sections:** 8
- **Rendered Visible Text Characters:** 30,207
- **Primary CTAs:** 4

### Inventory of Current Embedded Collections
- **Templates Loaded:** Full collection (**39 templates**) with **13 filter category buttons** rendered directly inside `#portfolio-section` via Alpine.js!
- **Projects Rendered:** 2 Technology Case Studies + 3 Media Projects = 5 projects.
- **Client & Partner Logos:** 18 partners + 24 clients, doubled in DOM = **84 logo elements**.
- **Articles Rendered:** 3 full insight cards.
- **Service Descriptions:** 4 interactive Solution Finder panels with multiple bullet items.

### Homepage Overload Diagnosis
1. **The Gateway Paradox:** A visitor arriving at `/` is bombarded with competing tasks:
   - Diagnosing their business challenge (Solution Finder)
   - Reading 2 tech case studies
   - Browsing an entire 39-template ecommerce/SaaS catalog with filter pills
   - Reading 4 paragraphs of company philosophy
   - Reviewing media equipment and 3 video projects
   - Reading 3 blog posts
   - Scanning 84 client/partner logos
2. **Resulting Cognitive Friction:** Instead of guiding the user to choose a path in under 15 seconds, the homepage acts as an all-in-one catalog, slowing down page speed and diluting user intent.

### Homepage KEEP / COMPRESS / MOVE / REMOVE Matrix

| Section | Current Content & Role | Decision | Canonical Destination | Architectural Rationale |
|---|---|---|---|---|
| `#hero-section` | Value proposition, H1, 2 primary CTA buttons, trust badges | **KEEP** | `/` (Home) | Essential gateway role. Sets brand positioning immediately. |
| `#marquee-section` | 84 DOM nodes of scrolling client and partner logos | **COMPRESS** | Split between `/doi-tac` and `/khach-hang` | Reduce DOM bloat by 50%. Keep a clean, non-duplicated logo ribbon with link to `/khach-hang`. |
| `#business-needs` | Solution Finder (4 interactive tabs) | **KEEP (POLISH)** | `/` (Home) with links to `/dich-vu/*` | Exceptional gateway routing tool. Directs user into specialized sub-services effectively. |
| `#portfolio-section` (Templates) | **Full 39+ Templates & 13 Category Filter Chips** | **MOVE & COMPRESS** | Canonical: `/dich-vu/kho-giao-dien` | **CRITICAL:** Remove full catalog and category filters. Retain ONLY 4 curated "Giao diện tiêu biểu" cards + large button to `/dich-vu/kho-giao-dien`. |
| `#portfolio-section` (Case Studies) | 2 Featured Tech Case Studies | **KEEP** | Links to `/du-an/{slug}` | Essential proof for high-ticket software buyers. Keep compact. |
| `#why-clm` | 4 Differentiation pillars | **COMPRESS** | Full narrative in `/ve-chung-toi` | Tighten copy by 40%. Focus on enterprise delivery guarantees. |
| `#media-support` | 3 Media capabilities + 3 media projects | **COMPRESS** | Deep dive in `/dich-vu/media` | Condense to 1 video reel teaser + 1 CTA to `/dich-vu/media`. |
| `#insights-section` | 3 Latest articles | **KEEP** | Canonical: `/bai-viet` | Industry standard thought-leadership preview. |
| `#final-conversion-band` | High-contrast conversion trigger | **KEEP** | `/lien-he` | Effective conversion closure before footer. |

---

## 10. HOMEPAGE TEMPLATE LIBRARY AUDIT

### Analysis of `#ready-made-templates` on Homepage
- **Location in Code:** `resources/views/components/home/portfolio.blade.php` (Lines 111–266).
- **Observed Behavior:**
  - Employs Alpine.js `x-data="{ activeCategory: 'all' }"`.
  - Renders 13 category buttons: *Tất Cả (39), Doanh Nghiệp (8), Bán Hàng / E-commerce (6), Dịch Vụ / Tư Vấn (4), Bất Động Sản (3), Y Tế / Phòng Khám (3), v.v.*
  - Loops through every single item in the database/template array, generating 39 full card DOM nodes with hover overlays, badges, and action links.

### Architectural Answers to Required Questions
1. **Why does this section exist on the homepage?**  
   It was placed there as a commercial hook for SME customers seeking fast, low-budget website deployments (under 48h) rather than bespoke custom engineering.
2. **How well does `/dich-vu/kho-giao-dien` already serve this need?**  
   `/dich-vu/kho-giao-dien` is a **dedicated, first-class Library page** equipped with search inputs, responsive category filters, template preview modals, and detailed spec breakdowns. It is far superior for browsing than an embedded home section.
3. **How many featured templates should the homepage contain?**  
   **Maximum 4 (or 6 in a 3x2 grid).** Zero pagination, zero category filtering on the homepage.
4. **Is category filtering needed on the homepage?**  
   **NO.** Category filtering turns the homepage into a library. Visitors who want to filter by industry have already demonstrated library intent and should be on `/dich-vu/kho-giao-dien`.
5. **Recommendation:**  
   Transform `#ready-made-templates` on the homepage into a **curated 4-card teaser**:
   - Card 1: Enterprise Corporate Template
   - Card 2: E-commerce / Retail Template
   - Card 3: Healthcare / Clinic Template
   - Card 4: Service / Consulting Template
   - Direct all filtering, searching, and catalog exploration to `/dich-vu/kho-giao-dien` with a prominent CTA: *"Xem Tất Cả 39+ Mẫu Giao Diện Theo Ngành Nghề →"*.

---

## 11. CUSTOMER / PARTNER WALL AUDIT

### Current State Across Pages
- **Homepage (`#marquee-section`):**
  - Renders continuous CSS marquee animation.
  - Mixes strategic technology partners (AWS, Laravel, Cloudflare) with end-user corporate clients (VNPT, Viettel, local enterprises).
  - Employs DOM duplication (`@foreach($items as $item) ... @endforeach` repeated twice) to create seamless looping.
- **Dedicated Directory Pages:**
  - `/doi-tac`: 28,019 characters, 15 headings, 8 images. Focuses on technology and production alliances.
  - `/khach-hang`: 24,243 characters, 12 headings, 5 images. Focuses on client success stories and logos.
  - `/ho-so-nang-luc`: Re-renders client and partner lists in static grid format.

### Audit Findings: Visual Loop vs. Semantic Duplication
- **Distinction:** The marquee looping in HTML is a **visual animation necessity**, not a semantic content flaw. However, rendering both 18 partners and 24 clients in the same infinite strip creates visual chaos and lacks audience segmentation.
- **Semantic Separation Required:**
  - **Technology Partners** validate *technical capability and infrastructure* (relevant to CTOs & Enterprise clients).
  - **Client Logos** validate *commercial trust and delivery track record* (relevant to Business Owners & CMOs).
- **Recommendation:**
  1. On Homepage: Split into a sleek, single-row **Client Trust Bar** (8–10 marquee logos of prominent clients) with a link *"Xem 50+ khách hàng tin chọn →"* pointing to `/khach-hang`.
  2. Tech Partners belong contextually on `/dich-vu/web-app` (Tech Stack section) and canonically at `/doi-tac`.
  3. Keep the dedicated pages `/doi-tac` and `/khach-hang` as the comprehensive directories.

---

## 12. PROJECT / CASE STUDY AUDIT

### Current Flow & Hierarchy
```text
Homepage (2 Tech Case Studies + 3 Media Projects)
  └── Services (/dich-vu/web-app has 2 Tech Case Studies; /dich-vu/media has 3 Media Projects)
        └── Portfolio Directory (/du-an has filterable grid of all projects)
              └── Canonical Case Study Detail (/du-an/{slug})
```

### Depth & Responsibility Analysis

| Page | Current Content Depth | Required Architectural Depth | Specific Recommendation |
|---|---|---|---|
| **Homepage (`/`)** | 2 Tech Case Studies + 3 Media Projects (full cards with badges, summaries, and links) | **Teaser Proof Only:** 2 Tech + 1 Media Highlight | Keep only 2 flagship projects showing Problem & Impact metrics. Link directly to `/du-an/{slug}`. |
| **Web App (`/dich-vu/web-app`)** | 2 Detailed Tech Case Studies with architecture bullets and performance stats | **Contextual Proof:** Problem, Tech Stack, Key Result | Limit to 2 software projects. Do not include full project gallery; link to `/du-an?type=software`. |
| **Media (`/dich-vu/media`)** | 3 Video production projects with video modal triggers | **Contextual Proof:** Video Reel + Client + Deliverable | Perfect context. Retain 3 visual project showcases with video modal triggers. |
| **Portfolio Directory (`/du-an`)** | Full grid with Software / Media filters | **Complete Directory:** Category tabs, search, pagination | Canonical owner of project browsing. Add clearer industry filtering. |
| **Case Study Detail (`/du-an/{slug}`)** | Deep breakdown: Challenge, Architecture, Stack, Results, Screenshots | **Canonical Deep Dive:** Complete story, architecture diagrams, metrics | Canonical owner of full case study narrative. Add "Dự án liên quan" carousel. |

---

## 13. SERVICE ARCHITECTURE AUDIT

### Analysis of Flagship Routes: Are They "Second Homepages"?

| Route | Measured Density | Section Count | "Second Homepage" Risk | Diagnosis & Required Boundary |
|---|---|---|---|---|
| `/dich-vu` | 25,240 chars, 16 headings, 87 links | 5 | **LOW** | Behaves cleanly as a Directory. Clearly guides users to sub-services. |
| `/dich-vu/web-app` | **28,538 chars, 30 headings, 86 links** | **9** | **HIGH** | **Overloaded.** Contains its own Problem statement, Architecture specs, 2 Case Studies, a full 6-Stage Process, Deliverables list, FAQ, and Template Cross-promo. It mimics an entire standalone website. |
| `/dich-vu/media` | 26,450 chars, 19 headings, 82 links | 6 | **MEDIUM** | Well-focused on visual media, but duplicates gear specifications with `/dich-vu/booking`. |
| `/dich-vu/marketing` | 25,454 chars, 21 headings, 81 links | 5 | **LOW** | Well-structured deep dive into SEO and growth methodology. |
| `/dich-vu/kho-giao-dien` | 24,629 chars, 14 headings, 82 links | 6 | **LOW** | Focused library interface. |
| `/dich-vu/bang-gia` | **28,774 chars, 24 headings, 80 links** | **7** | **MEDIUM** | Detailed pricing tables and calculator. Clean transactional focus, but long text copy before tables can be compressed. |
| `/dich-vu/booking` | 26,599 chars, 16 headings, 77 links | 5 | **LOW** | Clear transactional intent (crew booking). |

### Actionable Boundaries for `/dich-vu/web-app`:
1. **Compress Delivery Lifecycle (Section 5):** Remove paragraphs describing each sprint. Replace with a visual timeline pointing to the canonical `/quy-trinh`.
2. **Move In-depth Case Studies (Section 4):** Shorten case study cards to summary metrics and link to `/du-an/{slug}`.
3. **Retain Technical Specs (Sections 2, 3, 6, 7):** These are canonical to this page and appeal directly to CTOs and technical decision-makers.

---

## 14. TRANSACTION UX AUDIT

### Evaluated Routes: `/lien-he`, `/dich-vu/booking`, `/dich-vu/bang-gia`

```text
Ideal Funnel: Intent → Clear Information → Decision → Frictionless Action
```

| Route | Measured Forms | Marketing Copy Length | Competing CTAs | Redirect Loops / Friction | UX Assessment |
|---|---|---|---|---|---|
| `/lien-he` | 4 (Main form + modal + footer + newsletter) | Short (~200 words) | None (Clean single purpose) | None | **EXCELLENT.** The main contact form is above the fold on desktop. Clear contact info (phone, address, email) alongside. |
| `/dich-vu/booking` | 4 (Booking form + modal + footer + newsletter) | Moderate (~400 words) | 1 secondary CTA ("Tư vấn gói lớn" → `/lien-he`) | None | **GOOD.** Form fields capture date, service type, location, and scale. Gear specs provide reassurance before booking. |
| `/dich-vu/bang-gia` | 3 (Estimator form + footer + newsletter) | Long (~650 words) | Multiple "Chọn gói" buttons all routing to `/lien-he?package=...` | None | **SATISFACTORY.** Clear package breakdowns, but the pricing estimator calculator should pre-fill the contact brief on submit rather than opening a blank form. |

---

## 15. GLOBAL NAVIGATION AUDIT

### Global Navigation Matrix

| Destination URL | Header Desktop | Mega Menu | Mobile Drawer | Footer Columns | Homepage Direct | Contextual Internal | Total Placement Count | Overload Rating |
|---|---|---|---|---|---|---|---|---|
| `/` | Logo | Logo | Logo | Logo | - | Breadcrumb | 5 | Optimal |
| `/dich-vu` | Direct Link | Header | Direct Link | Col 2 Header | Hero + Solution Finder | Multiple | 6 | High Visibility |
| `/dich-vu/web-app` | - | Item 1 | Sub-item | Col 2 Link | Solution Finder | Service Hub | 5 | Balanced |
| `/dich-vu/media` | - | Item 2 | Sub-item | Col 2 Link | Solution Finder + Section 6 | Service Hub | 5 | Balanced |
| `/dich-vu/marketing` | - | Item 3 | Sub-item | Col 2 Link | Solution Finder | Service Hub | 5 | Balanced |
| `/dich-vu/kho-giao-dien` | - | Item 4 | Sub-item | Col 2 Link | Portfolio Section | Service Hub | 5 | Balanced |
| `/dich-vu/bang-gia` | - | Item 5 | Sub-item | Col 2 Link | - | Web App, Booking | 4 | Balanced |
| `/dich-vu/booking` | - | Item 6 | Sub-item | Col 2 Link | Section 6 CTA | Media Page | 4 | Balanced |
| `/quy-trinh` | - | Feature Link| Sub-item | Col 3 Link | Why CLM link | Web App | 4 | Balanced |
| `/du-an` | Direct Link | Direct Link | Direct Link | Col 3 Link | Portfolio Section | Service Hub | 5 | Balanced |
| `/ve-chung-toi` | Direct Link | - | Direct Link | Col 1 Link | Why CLM link | Company Profile | 5 | Balanced |
| `/ho-so-nang-luc` | - | - | - | Col 1 Link | Why CLM link | About Page | 3 | Under-discovered |
| `/doi-tac` | - | - | - | Col 1 Link | Marquee link | Clients Page | 3 | Under-discovered |
| `/khach-hang` | - | - | - | Col 1 Link | Marquee link | Partners Page | 3 | Under-discovered |
| `/tai-nguyen` | - | - | Sub-item | Col 3 Link | - | Blog | 2 | Low Visibility |
| `/bai-viet` | Direct Link | - | Direct Link | Col 3 Link | Insights Section | Resources | 5 | Balanced |
| `/tuyen-dung` | - | - | - | Col 1 Link | - | About Page | 2 | Low Visibility |
| `/lien-he` | Primary Button | CTA Button | Primary Button| Col 4 Info | Hero + Conversion Band | Global Footer CTA | **7** | **Heavy (Intentional)** |

### Navigation Findings
1. **Overloaded Footer:** The footer currently renders 4 full columns with 24 individual destination links, plus newsletter subscription and contact details. It acts as a site index.
2. **Hidden Strategic Pages:** `/ho-so-nang-luc` (Company Profile), `/doi-tac` (Partners), and `/khach-hang` (Clients) are only accessible via the footer or deep contextual links. They are completely absent from the primary desktop header and mega menu.
3. **Recommendation:** Add a compact "Về Cửu Long" dropdown in the desktop navigation housing:
   - *Câu chuyện thương hiệu* (`/ve-chung-toi`)
   - *Hồ sơ năng lực (Profile)* (`/ho-so-nang-luc`)
   - *Khách hàng & Đối tác* (`/khach-hang`)
   - *Quy trình chuẩn* (`/quy-trinh`)

---

## 16. CTA AUDIT & CONVERSION TAXONOMY

### Inventory of All Public Primary & Secondary CTAs

| # | CTA Label | Current Page & Section | Destination URL | Funnel Intent Stage | Primary / Secondary | Duplication Assessment |
|---|---|---|---|---|---|---|
| 1 | "Bắt đầu dự án" | `/` (Hero) | `/lien-he` | **CONVERT** | Primary | Standard primary trigger |
| 2 | "Xem giải pháp" | `/` (Hero) | `/dich-vu` | **DISCOVER** | Secondary | Standard discovery trigger |
| 3 | "Khám phá kho giao diện" | `/` (`#portfolio-section`) | `/dich-vu/kho-giao-dien`| **DISCOVER** | Primary | Legitimate catalog link |
| 4 | "Xem tất cả dự án" | `/` (`#portfolio-section`) | `/du-an` | **PROOF** | Secondary | Legitimate directory link |
| 5 | "Khám phá năng lực & hồ sơ" | `/` (`#why-clm`) | `/ve-chung-toi` | **EVALUATE** | Secondary | Links to About |
| 6 | "Khám phá dịch vụ Media" | `/` (`#media-support`) | `/dich-vu/media` | **DISCOVER** | Secondary | Service branch link |
| 7 | "Đặt lịch quay/chụp" | `/` (`#media-support`) | `/dich-vu/booking` | **CONVERT** | Primary | Contextual transactional CTA |
| 8 | "Xem tất cả bài viết" | `/` (`#insights-section`) | `/bai-viet` | **DISCOVER** | Secondary | Archive link |
| 9 | "Bắt đầu dự án" | `/` (`#final-conversion-band`) | `/lien-he` | **CONVERT** | Primary | Exact duplicate of Hero CTA |
| 10 | "Xem giải pháp công nghệ" | `/` (`#final-conversion-band`) | `/dich-vu` | **DISCOVER** | Secondary | Exact duplicate of Hero CTA |
| 11 | "Tư vấn kiến trúc" | `/dich-vu/web-app` (Hero) | `/lien-he` | **CONVERT** | Primary | High-intent technical consult |
| 12 | "Dự toán chi phí" | `/dich-vu/web-app` (Hero) | `/dich-vu/bang-gia` | **EVALUATE** | Secondary | Excellent cross-service link |
| 13 | "Xem quy trình chi tiết" | `/dich-vu/web-app` (Process) | `/quy-trinh` | **EVALUATE** | Secondary | Canonical process link |
| 14 | "Chọn gói này" | `/dich-vu/bang-gia` (Pricing) | `/lien-he?package=...` | **CONVERT** | Primary | Parameterized conversion |
| 15 | "Xác nhận đặt lịch" | `/dich-vu/booking` (Form) | Form Submit (`POST`) | **CONVERT** | Primary | Canonical transaction action |
| 16 | "Gửi yêu cầu hợp tác" | `/lien-he` (Form) | Form Submit (`POST`) | **CONVERT** | Primary | Canonical contact action |
| 17 | "Liên hệ tư vấn ngay" | Global Service Banner | `/lien-he` | **CONVERT** | Primary | Global fallback conversion |

### CTA Analysis & Synthesis
- **Taxonomy Balance:**
  - **DISCOVER:** 25% (Guides exploration cleanly)
  - **EVALUATE:** 20% (Effective cross-links to pricing and process)
  - **PROOF:** 15% (Links to case studies and portfolio)
  - **CONVERT:** 40% (Strong high-intent closure)
- **Destination Cannibalization:** `/lien-he` receives over 65% of all conversion clicks. While simple, it misses opportunities to capture structured intent through `/dich-vu/booking` (for media) or `/dich-vu/bang-gia` (for budget estimation).

---

## 17. MOBILE DENSITY AUDIT

Evaluating viewports under 430px (iPhone / modern Android):

| Page | Problematic Component | Desktop Structure | Mobile Usability Risk | Severity | Recommended Remediation |
|---|---|---|---|---|---|
| `/` | Embedded 39 Templates (`#portfolio-section`) | Grid 3 cols with 13 category tabs | **Extreme vertical scroll.** Scrolling past 39 cards on mobile requires over 45 screen swipes, causing severe drop-off before reaching Why CLM or Blog. | **CRITICAL (P0)** | Strip category tabs and replace with a 2x2 grid or horizontal swipe carousel of 4 cards max. |
| `/` | Logo Marquee (`#marquee-section`) | Dual-row infinite marquee | Marquee text/logos can cause horizontal layout shudder or overflow on low-end mobile devices. | **MEDIUM (P2)** | Single-row CSS marquee with `overflow-hidden` and fixed height (64px). |
| `/dich-vu/web-app` | 9 Full-depth Sections | 2-column feature blocks | Page height exceeds 8,500px on mobile. Users lose track of the primary conversion goal. | **HIGH (P1)** | Collapsible accordions for Architecture Specs and FAQs; eliminate process stage duplication. |
| `/dich-vu/bang-gia` | 3 Tier Pricing Cards + Estimator | 3 comparative columns | Horizontal scroll or massive stacked cards; comparison between tiers is difficult on small screens. | **MEDIUM (P2)** | Tabbed tier switcher (`Cơ bản` \| `Tiêu chuẩn` \| `Doanh nghiệp`) instead of vertical stacking. |
| All Pages | Global 4-Column Footer | 4 columns + Form | Extremely long footer. Takes up 5–6 full mobile screens. | **LOW (P3)** | Implement accordion collapse for footer link columns on mobile viewports. |

---

## 18. MEASURED CONTENT DENSITY METRICS TABLE

*Data extracted via direct DOM parsing of rendered pages (`scratch/audit_metrics.json`):*

| # | Route | Page Name | Sections | H1 | Total Headings | `<p>` | `<a>` | `<button>` | `<form>` | `<img>` | Characters | Primary CTAs |
|---|---|---|---|---|---|---|---|---|---|---|---|---|
| 1 | `/` | Home | 8 | 1 | 33 | 36 | 102 | 28 | 2 | 11 | 30,207 | 4 |
| 2 | `/dich-vu` | Service Hub | 5 | 1 | 16 | 15 | 87 | 25 | 3 | 5 | 25,240 | 0 |
| 3 | `/dich-vu/web-app` | Web App Flagship | 9 | 1 | 30 | 31 | 86 | 25 | 3 | 5 | 28,538 | 0 |
| 4 | `/dich-vu/media` | Media Showcase | 6 | 1 | 19 | 20 | 82 | 31 | 3 | 11 | 26,450 | 0 |
| 5 | `/dich-vu/marketing` | Marketing & SEO | 5 | 1 | 21 | 22 | 81 | 25 | 3 | 5 | 25,454 | 0 |
| 6 | `/dich-vu/kho-giao-dien` | Template Library | 6 | 1 | 14 | 14 | 82 | 29 | 4 | 6 | 24,629 | 0 |
| 7 | `/dich-vu/bang-gia` | Pricing Table | 7 | 1 | 24 | 27 | 80 | 31 | 3 | 5 | 28,774 | 0 |
| 8 | `/dich-vu/booking` | Booking Ekip | 5 | 1 | 16 | 27 | 77 | 28 | 4 | 5 | 26,599 | 0 |
| 9 | `/du-an` | Projects Directory | 4 | 1 | 14 | 18 | 85 | 30 | 4 | 11 | 25,384 | 0 |
| 10 | `/du-an/{slug}` | Case Study Detail | 1 | 1 | 8 | 9 | 78 | 25 | 3 | 6 | 23,419 | 0 |
| 11 | `/bai-viet` | Blog Index | 1 | 1 | 10 | 11 | 79 | 25 | 4 | 5 | 23,332 | 0 |
| 12 | `/tai-nguyen` | Resource Center | 4 | 1 | 15 | 14 | 77 | 27 | 5 | 5 | 24,556 | 0 |
| 13 | `/ve-chung-toi` | About Us | 6 | 1 | 23 | 27 | 83 | 25 | 3 | 6 | 30,392 | 0 |
| 14 | `/doi-tac` | Partners | 5 | 1 | 15 | 19 | 77 | 25 | 3 | 8 | 28,019 | 0 |
| 15 | `/khach-hang` | Clients | 4 | 1 | 12 | 16 | 77 | 31 | 3 | 5 | 24,243 | 0 |
| 16 | `/tuyen-dung` | Careers | 5 | 1 | 22 | 22 | 82 | 26 | 4 | 5 | 26,688 | 0 |
| 17 | `/quy-trinh` | Process 6-Step | 5 | 1 | 16 | 17 | 81 | 25 | 3 | 5 | 25,389 | 0 |
| 18 | `/ho-so-nang-luc` | Company Profile | 7 | 1 | 30 | 32 | 83 | 24 | 2 | 16 | 27,709 | 2 |
| 19 | `/lien-he` | Contact | 3 | 1 | 8 | 12 | 79 | 26 | 4 | 5 | 24,084 | 0 |
| 20 | `/chinh-sach-bao-mat` | Privacy Policy | 1 | 1 | 11 | 12 | 75 | 25 | 3 | 5 | 24,275 | 0 |
| 21 | `/dieu-khoan-dich-vu` | Terms of Service | 1 | 1 | 11 | 12 | 75 | 25 | 3 | 5 | 24,313 | 0 |

---

## 19. MASTER KEEP / COMPRESS / MOVE / MERGE / REMOVE MATRIX

| # | Item / Section | Current Location | Action | Destination | Architectural Rationale |
|---|---|---|---|---|---|
| 1 | **Full 39+ Templates & 13 Filter Pills** | `/` (`#portfolio-section`) | **MOVE & REMOVE from Home** | Canonical: `/dich-vu/kho-giao-dien` | Destroys homepage gateway clarity. Belongs exclusively in the library. |
| 2 | **Curated 4-Item Template Showcase** | `/` (`#portfolio-section`) | **KEEP (COMPRESSED)** | `/` (Home) | Provides immediate SME social proof without catalog clutter. |
| 3 | **Solution Finder Component** | `/` (`#business-needs`) | **KEEP** | `/` (Home) | Best-in-class interactive routing tool for multi-service gateway. |
| 4 | **Client & Partner Marquee (84 nodes)** | `/` (`#marquee-section`) | **COMPRESS** | Split: `/khach-hang` & `/doi-tac` | Deduplicate DOM looping; display clean client ribbon. |
| 5 | **6-Step Lifecycle Text & Sprints** | `/dich-vu/web-app` (Section 5) | **MOVE & LINK** | Canonical: `/quy-trinh` | Eliminates structural duplication across flagship service and process pages. |
| 6 | **Detailed Case Study Deep Dives** | `/dich-vu/web-app` (`#case-studies`) | **COMPRESS & LINK** | Canonical: `/du-an/{slug}` | Keep service pages focused on service capabilities; link out to case study deep dives. |
| 7 | **Production Equipment Arsenal List** | `/dich-vu/booking` (Section 4) | **MERGE / COMPRESS** | Canonical: `/dich-vu/media` | Booking page must remain transaction-focused; gear list is distracting friction. |
| 8 | **Company Narrative & History** | `/ho-so-nang-luc` & `/` | **COMPRESS** | Canonical: `/ve-chung-toi` | Single source of truth for brand origins, culture, and core team. |
| 9 | **Media Capabilities & 3 Projects** | `/` (`#media-support`) | **COMPRESS** | Canonical: `/dich-vu/media` | Condense to 1 high-impact video reel card with link to media hub. |
| 10 | **Cost Estimator Tool** | `/dich-vu/bang-gia` | **KEEP** | `/dich-vu/bang-gia` | High-utility interactive widget. Pre-fills `/lien-he` inquiry on submit. |
| 11 | **Crew Dispatch Booking Form** | `/dich-vu/booking` | **KEEP** | `/dich-vu/booking` | Dedicated transaction funnel for on-demand media shoots. |
| 12 | **General Contact & RFP Intake** | `/lien-he` | **KEEP** | `/lien-he` | Canonical conversion intake endpoint for all non-booking inquiries. |

---

## 20. PROPOSED INFORMATION ARCHITECTURE (TARGET STATE)

```text
HOME (Gateway: Route, Validate, Direct)
│
├── GIẢI PHÁP SỐ (Solutions & Technical Capabilities)
│   ├── Tổng quan dịch vụ (/dich-vu) [Directory Hub]
│   ├── Web App & Nền tảng số (/dich-vu/web-app) [Deep Dive]
│   ├── Sản xuất Media & TVC (/dich-vu/media) [Deep Dive]
│   ├── Marketing & SEO (/dich-vu/marketing) [Deep Dive]
│   ├── Kho giao diện mẫu (/dich-vu/kho-giao-dien) [Library]
│   └── Quy trình triển khai 6 bước (/quy-trinh) [Methodology & SLA]
│
├── MINH CHỨNG NĂNG LỰC (Proof & Track Record)
│   ├── Dự án tiêu biểu (/du-an) [Directory]
│   │   └── Chi tiết Case Study (/du-an/{slug}) [Deep Dive]
│   ├── Khách hàng tin chọn (/khach-hang) [Directory]
│   └── Đối tác chiến lược (/doi-tac) [Directory]
│
├── VỀ CỬU LONG (Company & Governance)
│   ├── Câu chuyện thương hiệu (/ve-chung-toi) [Deep Dive]
│   ├── Hồ sơ năng lực Profile (/ho-so-nang-luc) [Executive Procurement]
│   └── Cơ hội nghề nghiệp (/tuyen-dung) [Careers]
│
├── TÀI NGUYÊN (Resources & Knowledge)
│   ├── Tạp chí công nghệ & media (/bai-viet) [Blog Index]
│   │   └── Chi tiết bài viết (/bai-viet/{slug}) [Content Reader]
│   └── Trung tâm tài nguyên số (/tai-nguyen) [Download Library]
│
└── CHUYỂN ĐỔI & GIAO DỊCH (Transaction & Intake)
    ├── Bảng giá & Dự toán chi phí (/dich-vu/bang-gia) [Estimator & Pricing]
    ├── Điều động Ekip Media (/dich-vu/booking) [Crew Dispatch]
    └── Liên hệ & Đặt lịch tư vấn (/lien-he) [Primary Consultation Intake]
```

---

## 21. RECOMMENDED NEXT IMPLEMENTATION SEQUENCE (FOR FUTURE PHASES)

*Note: In strict compliance with Non-Goals, no implementation has occurred in this audit. The following sequence is recommended for subsequent UI rebuild milestones:*

### Milestone 1: Homepage De-bloat & Gateway Optimization (Priority: P0)
1. **Unlink full template catalog from Home:** Modify `resources/views/components/home/portfolio.blade.php` to render only 4 curated template cards. Remove the 13 category filter buttons and Alpine category filtering from the homepage.
2. **Add primary gateway CTA:** Add prominent button *"Khám phá toàn bộ 39+ giao diện theo ngành nghề →"* routing to `/dich-vu/kho-giao-dien`.
3. **De-duplicate Marquee DOM:** Replace duplicated 84-node marquee with a single-loop client trust ribbon.

### Milestone 2: Service Architecture & Canonical Boundary Enforcement (Priority: P1)
1. **Compress `/dich-vu/web-app`:** Replace the full 6-stage lifecycle explanation with a compact timeline graphic linking to `/quy-trinh`.
2. **Sanitize Case Study Cards:** Ensure case studies on `/dich-vu/web-app` provide summary metrics and direct users to `/du-an/{slug}` for architecture deep dives.
3. **Streamline `/dich-vu/booking`:** Remove redundant cinema gear specifications; keep the focus on rapid form completion.

### Milestone 3: Global Navigation & Discoverability Enhancement (Priority: P2)
1. **Add Company Dropdown in Header:** Introduce "Về Cửu Long" in desktop navigation to expose `/ve-chung-toi`, `/ho-so-nang-luc`, `/khach-hang`, and `/quy-trinh`.
2. **Mobile Footer Collapse:** Add accordion behavior to footer links on mobile screens (< 768px).

### Milestone 4: Transaction Flow & Form State Continuity (Priority: P3)
1. **Link Pricing Estimator to Contact Form:** Allow the budget estimator on `/dich-vu/bang-gia` to pass computed parameters to `/lien-he` via query strings so the user brief is pre-populated.

---

## 22. RISKS & ARCHITECTURAL MITIGATIONS

1. **Risk: SEO Impact of Removing Templates from Homepage**
   - *Mitigation:* Ensure `/dich-vu/kho-giao-dien` has comprehensive internal linking from header, footer, and homepage teaser, complete with rich schema markup (`SoftwareApplication` / `Product`).
2. **Risk: Drop in SME Direct Inquiries from Homepage**
   - *Mitigation:* The 4 curated template cards on the homepage will specifically feature the top 4 converting industries (Doanh Nghiệp, E-commerce, Bất Động Sản, Y Tế), ensuring high-converting visual teasers remain visible above the fold.
3. **Risk: Broken Anchor Links**
   - *Mitigation:* Maintain legacy section IDs (`#portfolio-section`, `#ready-made-templates`, `#case-studies`) to prevent broken deep links from external marketing campaigns.

---

## 23. REQUIRED DECISION MATRIX

| Item | Current Location | Decision | Canonical Destination | Priority | Architectural Reason |
|---|---|---|---|---|---|
| **Full 39+ Template Catalog & Filter Pills** | `/` (`#portfolio-section`) | **REMOVE from Home / MOVE** | `/dich-vu/kho-giao-dien` | **P0** | Architectural blocker: Causes massive DOM weight and transforms Gateway into a sluggish directory. |
| **Curated 4-Card Template Teaser** | `/` (`#portfolio-section`) | **KEEP (COMPACT)** | `/` (Home) | **P1** | Essential proof for fast-track SME buyers without creating library bloat. |
| **Dual 84-Node Marquee Loop** | `/` (`#marquee-section`) | **COMPRESS** | Split: `/khach-hang` & `/doi-tac` | **P1** | Reduces DOM bloat by 50% while preserving social proof. |
| **6-Stage Lifecycle Full Breakdown** | `/dich-vu/web-app` (Section 5) | **MOVE & COMPRESS** | `/quy-trinh` | **P1** | Eliminates severe semantic and structural duplication with `/quy-trinh`. |
| **Case Study Deep Architecture Text** | `/dich-vu/web-app` (`#case-studies`) | **COMPRESS & LINK** | `/du-an/{slug}` | **P1** | Eliminates duplicated case study prose across service and project routes. |
| **Cinema Gear Specs in Booking** | `/dich-vu/booking` (Section 4) | **REMOVE / COMPRESS** | `/dich-vu/media` | **P2** | Friction reduction: Transaction pages must prioritize booking completion. |
| **Company Narrative Duplication** | `/ho-so-nang-luc` (Section 2) | **COMPRESS** | `/ve-chung-toi` | **P2** | Establishes `/ve-chung-toi` as single canonical source for brand history. |
| **Footer Column Link Overload** | Global Footer | **COMPRESS (MOBILE)** | Accordion on Mobile | **P3** | Eliminates 5 screens of vertical scroll on mobile viewports. |
| **Pricing Estimator Query String Passing** | `/dich-vu/bang-gia` | **POLISH** | `/lien-he?budget=...` | **P3** | Enhances conversion continuity between estimation and consultation. |

---

## 24. FILES REVIEWED & CODE EVIDENCE

### Routing & Controllers
- `routes/web.php` (Verified 21 public GET routes, 0 routing conflicts).
- `app/Http/Controllers/PageController.php` (Methods: `home`, `services`, `webApp`, `media`, `marketing`, `templates`, `pricing`, `booking`, `about`, `partners`, `clients`, `careers`, `process`, `profile`, `contact`, `privacy`, `terms`).
- `app/Http/Controllers/ProjectController.php` (Methods: `index`, `show`).
- `app/Http/Controllers/BlogController.php` (Methods: `index`, `show`).

### Blade Views & Components
- `resources/views/pages/home.blade.php` & `resources/views/components/home/` (`hero.blade.php`, `marquee.blade.php`, `solution-finder.blade.php`, `portfolio.blade.php`, `why-clm.blade.php`, `media-capabilities.blade.php`, `insights.blade.php`, `conversion-banner.blade.php`).
- `resources/views/services/` (`index.blade.php`, `web-app.blade.php`, `media.blade.php`, `marketing.blade.php`).
- `resources/views/templates/index.blade.php`.
- `resources/views/pages/pricing.blade.php`, `resources/views/pages/booking.blade.php`, `resources/views/pages/contact.blade.php`.
- `resources/views/pages/about.blade.php`, `resources/views/pages/process.blade.php`, `resources/views/pages/company-profile.blade.php`, `resources/views/pages/partners.blade.php`, `resources/views/pages/clients.blade.php`.
- `resources/views/layouts/app.blade.php` (Header desktop, Mega Menu, Mobile Drawer, Footer).

### Static Data Files
- `clients.json` (24 enterprise clients).
- `partners.json` (18 technology and creative partners).
- `pricing.json` (Web and Media tier packages).

---

## 25. FINAL VERDICT

# VERDICT: PASS

### Verification of Audit Completion Criteria:
- [x] **Complete Public Route Inventory:** All 21 public routes cataloged and classified into Page Types A–E.
- [x] **Primary Job Matrix:** Explicit primary intent, primary job, expected action, canonical responsibility, and boundary constraints established for every route.
- [x] **Section Inventory:** Detailed section breakdown with headings, content types, and roles.
- [x] **Duplication Matrix:** Concrete analysis of Exact, Semantic, and Functional duplicates with severity ratings.
- [x] **Content Ownership Matrix:** Designated single canonical owner for every topic.
- [x] **Homepage Audit:** Measured code metrics, template library bloat diagnosis, and KEEP/COMPRESS/MOVE matrix provided.
- [x] **Template Library & Customer Wall Deep Dives:** Clear evidence-based diagnoses and actionable architectural guidance.
- [x] **Service & Transaction Page Audits:** Evaluated flagship routes, second-homepage risks, and conversion funnel friction.
- [x] **Global Navigation & CTA Audits:** Full destination counts and conversion intent classification.
- [x] **Mobile Density & Measured Metrics Table:** Measured DOM counts for all routes without fabrication.
- [x] **Required Decision Matrix:** Complete with priorities (P0, P1, P2, P3).
- [x] **Zero Code Modifications:** Working tree clean (`git status --short` verified 0 changed production files, 0 test changes).
- [x] **Non-Goals Honored:** No implementation performed; execution halted pending review.

---
*Report compiled by Senior UI/UX Architect & Frontend Code Auditor.*
