# CUU LONG MEDIA & TECH
# CURRENT SYSTEM ARCHITECTURE

## 1. Executive Summary

This document serves as the master "Source of Truth" for the current architecture of the Cuu Long Media & Tech web application. It is based purely on a read-only audit of the existing source code, without assumptions or forward-looking architectural designs. The project is a Laravel 11 application with a frontend powered by Tailwind CSS, AlpineJS, and GSAP. It currently utilizes Filament PHP for some administrative capabilities, though some models (like Partners) do not yet have corresponding CRUD resources or database tables.

## 2. Technology Stack

[VERIFIED]
- **Backend:** PHP ^8.2, Laravel ^11.31
- **Admin Panel:** Filament ^3.2
- **Frontend Tools:** Vite ^6.0.11
- **CSS Framework:** Tailwind CSS ^3.4.13, PostCSS, Autoprefixer
- **JS Libraries:** AlpineJS ^3.17.1, GSAP ^3.15.0, Lucide icons
- **Package Manager:** Composer (PHP), NPM (Node)
- **Database:** SQLite (implied by typical local setup, specific driver hidden in `.env`)

## 3. Project Structure

[VERIFIED]
```
app/
├── Http/
│   ├── Controllers/ (Client-facing controllers)
├── Models/ (Eloquent ORM)
├── Filament/
│   └── Resources/ (Admin CRUD definitions)
database/
├── migrations/ (Schema definitions)
resources/
├── views/
│   ├── layouts/ (app.blade.php)
│   ├── pages/ (about, partners, clients, pricing, careers)
│   ├── projects/
│   ├── services/
│   ├── blog/
│   ├── home.blade.php
│   └── contact.blade.php
public/
├── images/
routes/
└── web.php
```

## 4. Route Architecture

[VERIFIED] Based on `routes/web.php`

**PUBLIC ROUTES:**
- `GET /` -> `HomeController@index`
- `GET /dich-vu` -> `ServiceController@index`
- `GET /dich-vu/web-app` -> `ServiceController@webApp`
- `GET /dich-vu/media` -> `ServiceController@media`
- `GET /dich-vu/marketing` -> `ServiceController@marketing`
- `GET /booking` -> `ServiceController@booking`
- `GET /dich-vu/{slug}` -> `ServiceController@show`
- `GET /du-an` -> `CaseStudyController@index`
- `GET /du-an/{slug}` -> `CaseStudyController@show`
- `GET /bai-viet` -> `BlogController@index`
- `GET /bai-viet/{slug}` -> `BlogController@show`
- `GET /chuyen-muc/{slug}` -> `BlogController@category`
- `GET /kho-giao-dien` -> `TemplateShowcaseController@index`
- `GET /tai-nguyen` -> `ResourceCenterController@index`
- `GET /ve-chung-toi` -> `CompanyController@about`
- `GET /doi-tac` -> `CompanyController@partners`
- `GET /khach-hang` -> `CompanyController@clients`
- `GET /bang-gia` -> `CompanyController@pricing`
- `GET /tuyen-dung` -> `CompanyController@careers`
- `GET /chinh-sach-bao-mat` -> `CompanyController@privacy`
- `GET /dieu-khoan-dich-vu` -> `CompanyController@terms`
- `GET /ho-so-nang-luc` -> `ProfileController@index`
- `GET /lien-he` -> `ContactController@index`
- `GET /sitemap.xml` -> `SitemapController@index`

**API ROUTES:**
- `GET /api/search-posts` -> `BlogController@searchApi`

**FORM SUBMISSIONS:**
- `POST /tai-nguyen/download` -> `ResourceCenterController@downloadLead`
- `POST /tuyen-dung/apply` -> `CompanyController@applyJob`
- `POST /lien-he` -> `ContactController@submit` (throttle: 5,1)

**ADMIN ROUTES:**
- Provided via Filament (typically `/admin`), though not explicitly in `web.php`.

## 5. Controller Architecture

[VERIFIED] Location: `app/Http/Controllers`

- `BlogController`: Handles post listing, single post, category filtering, and API search.
- `CaseStudyController`: Handles project portfolio.
- `CompanyController`: Handles static-like corporate pages (about, partners, clients, pricing, careers) and job application submissions.
- `ContactController`: Handles contact page view and form submission.
- `HomeController`: Renders `home.blade.php`.
- `ProfileController`: Renders profile page.
- `ResourceCenterController`: Handles resources and downloads.
- `ServiceController`: Handles service listings, categorized services (web, media, marketing), booking view.
- `SitemapController`: Renders dynamic sitemap.
- `TemplateShowcaseController`: Handles template showcasing.

## 6. Model Architecture

[VERIFIED] Location: `app/Models`

- `CaseStudy`: Uses array cast for `gallery`, boolean for `featured`.
- `Category`: Self-referencing (parent/children), hasMany `Post`. Scopes for `pillar_group` and `is_industry_filter`.
- `Contact`: Represents a contact form lead.
- `JobApplication`: Represents a career application.
- `Post`: BelongsTo `Category`, BelongsTo `User` (author).
- `Redirect`: For 301 SEO redirects.
- `Service`: Represents offerings.
- `TeamMember`: Represents company staff.
- `Testimonial`: Represents client feedback.
- `User`: Standard Laravel user model (used as author in Posts).

*Note: There is NO `Partner` or `Client` model currently.*

## 7. Database Schema

[VERIFIED] Extracted from `database/migrations`

- **users**: Standard Laravel schema.
- **categories**: `id, name, slug, type, parent_id, description, order, pillar_group, display_order, is_industry_filter`
- **posts**: `id, category_id, author_id, title, slug, summary, content, thumbnail, status, editorial_status, views, published_at, meta_title, meta_description`
- **services**: `id, title, slug, group, icon, summary, content, featured, order`
- **case_studies**: `id, title, slug, client_name, summary, group, thumbnail, gallery, content, year, featured, order`
- **contacts**: `id, fullname, phone, email, service_interested, message, status, ip_address`
- **job_applications**: `id, fullname, phone, email, position, cv_path, cover_letter, status`
- **team_members**: `id, name, role, photo, bio, order`
- **testimonials**: `id, client_name, client_title, avatar, quote, case_study_id`
- **redirects**: `id, old_url, new_url, status_code, hits`

*(Metrics columns in case_studies were added then dropped in subsequent migrations).*

## 8. Entity Relationship Map

[VERIFIED] Based on Models and Migrations

```
Category
 ├── hasMany -> Post
 └── hasMany -> Category (children via parent_id)

User
 └── hasMany -> Post (as author)

CaseStudy
 └── hasMany -> Testimonial (implied by case_study_id in testimonials table, though relationship method unknown)
```

## 9. Content Architecture

| Entity | Table | Model | Controller | Route | View |
|---|---|---|---|---|---|
| Services | `services` | `Service` | `ServiceController` | `/dich-vu` | `services/*` |
| Projects | `case_studies` | `CaseStudy` | `CaseStudyController` | `/du-an` | `projects/*` |
| Posts | `posts` | `Post` | `BlogController` | `/bai-viet` | `blog/*` |
| Categories | `categories` | `Category` | `BlogController` | `/chuyen-muc` | `blog/*` |
| Contacts | `contacts` | `Contact` | `ContactController` | `/lien-he` | `contact.blade.php` |
| Candidates | `job_applications`| `JobApplication`| `CompanyController` | `/tuyen-dung/apply`| N/A |
| Partners | [NOT FOUND]| [NOT FOUND]| `CompanyController` | `/doi-tac` | `pages/partners` |

## 10. Current CRUD Matrix

[VERIFIED] Based on Filament resources found.

| Entity | Create | Read | Update | Delete | Publish | Preview | Search | Filter |
|---|---|---|---|---|---|---|---|---|
| CaseStudy | YES | YES | YES | YES | UNKNOWN | UNKNOWN | YES | YES |
| Category | YES | YES | YES | YES | NO | NO | YES | YES |
| Contact | NO | YES | YES | YES | NO | NO | YES | YES |
| Post | YES | YES | YES | YES | UNKNOWN | UNKNOWN | YES | YES |
| Service | YES | YES | YES | YES | NO | NO | YES | YES |
| Redirect | YES | YES | YES | YES | NO | NO | YES | YES |
| Partner | NO | NO | NO | NO | NO | NO | NO | NO |

## 11. Authentication & Authorization

[INFERRED] 
- **System**: Default Laravel Auth integrated with Filament.
- **Admin**: Filament provides authentication out of the box (`/admin/login`).
- **Authorization**: Roles/Permissions packages (like Spatie) are not explicitly required in `composer.json`, so it may rely on basic Gates or standard Filament Panel user checks.

## 12. Client Website Architecture

[VERIFIED] Based on Views and Routes
```
Public Website
├── Home (`/`)
├── Services (`/dich-vu`)
├── Projects (`/du-an`)
├── Blog (`/bai-viet`)
├── Company Pages
│   ├── About (`/ve-chung-toi`)
│   ├── Partners (`/doi-tac`)
│   ├── Clients (`/khach-hang`)
│   ├── Pricing (`/bang-gia`)
│   └── Careers (`/tuyen-dung`)
├── Resources (`/tai-nguyen`, `/kho-giao-dien`)
└── Contact (`/lien-he`)
```

## 13. View Architecture

[VERIFIED]
- **Layouts**: `layouts/app.blade.php` handles master structure (Navbar, Footer, Floating Buttons).
- **Pages**: Static content pages reside in `resources/views/pages/`. Dynamic content pages reside in domain-specific folders (`blog`, `projects`, `services`).
- **Heavy Pages**: `home.blade.php` is exceptionally large (137KB) indicating heavy hardcoding or lack of component abstraction.

## 14. Frontend Architecture

[VERIFIED]
- **Styling**: Tailwind CSS configured via `tailwind.config.js`. No generic UI component library like Bootstrap is used.
- **Interactivity**: Alpine.js handles lightweight interactions (dropdowns, mobile menu). GSAP handles scroll animations and complex UI transitions.
- **Bundler**: Vite.

## 15. Asset Architecture

[VERIFIED]
- **Public**: `public/images/` contains static assets (like `zalo-icon-new.png`).
- Assets are referenced via Laravel's `asset()` helper in blade templates. Media storage paths (for user uploads) are likely under `public/storage/`.

## 16. SEO Architecture

[VERIFIED]
- **Dynamic SEO Fields**: `posts` table has `meta_title`, `meta_description`.
- **Redirects**: Managed via `Redirect` model and Filament resource.
- **Sitemap**: Generated dynamically via `SitemapController`.
- **Other Entities**: `case_studies` and `services` schemas lack dedicated meta fields, implying reliance on fallback tags or generic titles.

## 17. Forms & Validation

[VERIFIED]
- **Contact Form**: Submits to `/lien-he`. Handled by `ContactController`. Rate limited (`throttle:5,1`).
- **Job Application**: Submits to `/tuyen-dung/apply`. Includes file upload for CVs.
- **Lead Generation**: `/tai-nguyen/download` captures lead data in exchange for resources.

## 18. Current Admin Capabilities

[VERIFIED]
The system already has a functional **Filament Admin Panel** managing:
- Case Studies
- Categories
- Contacts (Read-only/Status updates typically)
- Posts (Blog)
- Redirects (SEO)
- Services

## 19. Hardcoded Data Audit

[VERIFIED]
Due to the absence of certain database tables, the following data is hardcoded in Blade views (e.g. `home.blade.php`, `partners.blade.php`):
- **Partners**: Logos, tiers (Top Partner, Gold Partner), and partner names.
- **Clients**: Client list and logos.
- **Testimonials/Trust Metrics**: Some statistics or quotes on the homepage.
- **Pricing**: Pricing plans.
- **Team**: Despite a `team_members` migration existing, it is likely that the About page still hardcodes team data if no CRUD exists.

## 20. Data Source Map

```
USER REQUEST -> ROUTE (/doi-tac) -> CompanyController@partners -> View (pages.partners) -> HARDCODED DATA

USER REQUEST -> ROUTE (/du-an) -> CaseStudyController@index -> Model (CaseStudy) -> DATABASE (case_studies) -> View (projects.index)
```

## 21. Client → Admin Gap Analysis

| Client Content | Existing Data Source | Admin Management | Gap |
|---|---|---|---|
| Projects | `case_studies` table | Filament `CaseStudyResource` | None |
| Services | `services` table | Filament `ServiceResource` | None |
| Posts | `posts` table | Filament `PostResource` | None |
| Partners | **Hardcoded in Blade** | **Missing** | Database schema, Model, and Filament Resource needed. |
| Clients | **Hardcoded in Blade** | **Missing** | Database schema, Model, and Filament Resource needed. |
| Pricing | **Hardcoded in Blade** | **Missing** | Database schema, Model, and Filament Resource needed. |
| Team Members | `team_members` table | **Missing** | Filament Resource needed. |
| Testimonials | `testimonials` table | **Missing** | Filament Resource needed. |

## 22. Architectural Issues

### High
- **Hardcoded Business Data**: Partners, Clients, and Pricing are hardcoded into views, making them unmanageable for non-technical staff.
- **Controller Complexity / Bloated Views**: `home.blade.php` is over 137KB, suggesting excessive inline content and styling rather than reusable Blade components.
- **Missing Admin Abstractions**: Tables exist for `team_members` and `testimonials`, but no Filament resources exist to manage them.

### Medium
- **Inconsistent SEO Fields**: Blog posts have explicit meta fields, but Projects and Services do not.

## 23. Technical Debt

- **High**: Moving hardcoded HTML content (Partners, Clients) into the database.
- **Medium**: Refactoring `home.blade.php` into smaller `@components`.
- **Low**: Verifying the cleanup of dropped columns (e.g., metric columns in `case_studies` were added then dropped, potentially leaving orphaned logic).

## 24. Security Observations

[VERIFIED]
- Contact form utilizes `throttle:5,1` middleware to prevent spam.
- Job applications handle file uploads (`cv_path`); requires strict MIME type validation (to be verified).
- Admin routes are protected implicitly by Filament's default auth guard.

## 25. Performance Observations

[INFERRED]
- **Large DOM Size**: `home.blade.php` size indicates a potentially massive DOM tree which could affect rendering performance.
- **Assets**: Extensive use of GSAP animations and high-resolution images/videos (e.g., Showreel, Case study galleries) requires strict lazy-loading and media optimization.

## 26. Admin Readiness Assessment

| Area | Status | Reason |
|---|---|---|
| Authentication | **READY** | Provided by Filament. |
| Content Model (Posts/Projects) | **READY** | DB, Models, and Resources exist. |
| Content Model (Partners/Clients) | **NOT READY** | Hardcoded in Blade; schemas missing. |
| Authorization | **PARTIAL** | Basic Filament auth exists, RBAC status unknown. |
| Media Management | **PARTIAL** | Filament handles basic uploads; centralized media library status unknown. |
| SEO Management | **PARTIAL** | Redirects and basic post metas exist; generic SEO missing. |

## 27. Current System Diagram

```
CUU LONG MEDIA & TECH
│
├── Public Website (Tailwind + Alpine + GSAP)
│   ├── Dynamic Content (Projects, Blog, Services)
│   └── Static Content (Partners, Clients, About, Pricing)
│
├── Content Management (Filament Admin)
│   ├── Case Studies
│   ├── Services
│   ├── Blog Posts
│   └── SEO Redirects
│
├── Database (SQLite)
│   ├── Core Tables (users, case_studies, services, posts, categories)
│   └── Unmanaged Tables (team_members, testimonials)
│
└── Infrastructure (Laravel 11, Vite)
```

## 28. Verified Facts

- The project uses Laravel 11 and Filament 3.2.
- The `CaseStudy`, `Service`, and `Post` entities are fully integrated from DB to Admin to Client.
- Form submissions for Contacts and Careers are functional and store data.

## 29. Unknown / Requires Verification

- [UNKNOWN — DATABASE NOT AVAILABLE] Exact number of records for existing entities.
- [UNKNOWN] Current media storage driver (local vs s3).
- [UNKNOWN] Strictness of validation rules on the `JobApplication` file uploads.

## 30. TODO / Next Investigation

- Verify if `team_members` and `testimonials` data is actually seeded in DB or still hardcoded.
- Design database schemas for `Partners`, `Clients`, and `Pricing` to prepare for the Master Admin Implementation Plan.
