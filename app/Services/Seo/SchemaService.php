<?php

namespace App\Services\Seo;

use Illuminate\Support\Facades\View;

class SchemaService
{
    /**
     * Get default values for all schema configurations (matching Rank Math SEO defaults).
     */
    public static function getDefaults(): array
    {
        return [
            // Entity / Organization
            'schema_entity_type' => 'ProfessionalService',
            'schema_org_name' => 'Truyền Thông Cửu Long',
            'schema_org_legal_name' => 'Công Ty TNHH Truyền Thông Cửu Long',
            'schema_org_alternate_names' => 'Cửu Long Media, Truyền Thông Cửu Long - Technology & Digital Solutions',
            'schema_org_url' => 'https://truyenthongcuulong.com',
            'schema_org_logo' => 'https://truyenthongcuulong.com/images/logo-ttcl.png',
            'schema_org_email' => 'info@truyenthongcuulong.com',
            'schema_org_telephone' => '+84939363262',
            'schema_org_price_range' => '$$',
            'schema_org_description' => 'Đơn vị cung cấp giải pháp công nghệ, thiết kế Website chuẩn SEO, phát triển Web App, SEO tổng thể và dịch vụ quay phim, chụp ảnh sự kiện chuyên nghiệp tại Cần Thơ và ĐBSCL.',

            // Address & Geo
            'schema_address_street' => 'Lầu 5, 57 Hùng Vương',
            'schema_address_locality' => 'Ninh Kiều',
            'schema_address_region' => 'Cần Thơ',
            'schema_address_postal_code' => '900000',
            'schema_address_country' => 'VN',
            'schema_geo_latitude' => '10.0438252',
            'schema_geo_longitude' => '105.7789027',
            'schema_area_served' => 'Cần Thơ, Đồng bằng sông Cửu Long, Toàn quốc',

            // Opening hours & Social Profiles (sameAs)
            'schema_opening_days' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
            'schema_opening_hours_open' => '07:30',
            'schema_opening_hours_close' => '17:30',
            'schema_social_facebook' => 'https://www.facebook.com/truyenthongcuulong',
            'schema_social_youtube' => '',
            'schema_social_tiktok' => '',
            'schema_social_twitter' => 'https://twitter.com/nguyenhophuc87',
            'schema_social_linkedin' => '',
            'schema_social_zalo' => '',

            // Content Type Defaults & Templates
            'schema_default_post_type' => 'Article',
            'schema_default_article_keywords' => 'Thiết kế Website, Lập trình Web App, UI/UX, SEO Tổng Thể, Media Sự Kiện, Truyền Thông Cửu Long',
            'schema_default_article_about' => "Thiết kế Website Chuẩn SEO & Lập trình Web App\nDịch vụ Media, Quay Phim & Chụp Ảnh Sự Kiện Chuyên Nghiệp",
            'schema_article_custom_jsonld' => '',

            'schema_default_service_type' => 'Service',
            'schema_service_sub_type' => 'Thiết kế Website Chuẩn SEO, Lập trình Web App & Media Sự Kiện',
            'schema_default_service_area' => 'Cần Thơ, Đồng bằng sông Cửu Long, Toàn quốc',
            'schema_service_default_price' => '',
            'schema_service_default_currency' => 'VND',
            'schema_service_default_terms' => 'Bảo hành kỹ thuật 12 tháng, hỗ trợ vận hành 24/7',
            'schema_service_custom_jsonld' => '',

            'schema_default_page_type' => 'WebPage',
            'schema_enable_breadcrumb' => '1',
            'schema_enable_sitelinks_search' => '1',

            // Knows About & Offer Catalog
            'schema_knows_about' => "Thiết kế Website chuẩn SEO\nLập trình Web App & Ứng dụng di động\nThiết kế UI/UX\nDịch vụ SEO tổng thể\nSản xuất Video & Media sự kiện 4K\nQuay phim Teambuilding & Chụp ảnh sự kiện\nDịch vụ Flycam chuyên nghiệp",
            'schema_enable_offer_catalog' => '1',

            // Custom Extra JSON-LD & Full Manual Override
            'schema_custom_jsonld' => '',
            'schema_use_manual_override' => '0',
            'schema_manual_override_json' => '',
        ];
    }

    /**
     * Get a setting value with fallback to defaults and general settings.
     */
    protected function getVal(string $key, $fallback = null)
    {
        $defaults = self::getDefaults();
        $defaultVal = $defaults[$key] ?? $fallback;
        return get_setting($key, $defaultVal);
    }

    /**
     * Get official production base URL for schema.org
     */
    public function getBaseUrl(): string
    {
        $url = $this->getVal('schema_org_url');
        if (!empty($url) && !str_contains($url, '127.0.0.1') && !str_contains($url, 'localhost')) {
            return rtrim($url, '/');
        }
        return 'https://truyenthongcuulong.com';
    }

    /**
     * Build Organization / Local Business Schema
     */
    public function getOrganizationSchema(): array
    {
        $baseUrl = $this->getBaseUrl();

        $entityType = $this->getVal('schema_entity_type', 'ProfessionalService');
        
        $types = in_array($entityType, ['Organization', 'Corporation']) 
            ? [$entityType] 
            : [$entityType, 'Organization'];

        // Alternate Names
        $altNamesRaw = $this->getVal('schema_org_alternate_names', '');
        $altNames = array_values(array_filter(array_map('trim', explode(',', (string) $altNamesRaw))));

        // Area Served
        $areaServedRaw = $this->getVal('schema_area_served', '');
        $areas = array_values(array_filter(array_map('trim', explode(',', (string) $areaServedRaw))));
        $areaServedObjects = [];
        foreach ($areas as $area) {
            $areaServedObjects[] = [
                '@type' => (stripos($area, 'Cần Thơ') !== false) ? 'City' : 'AdministrativeArea',
                'name' => $area,
            ];
        }

        // Knows About
        $knowsAboutRaw = $this->getVal('schema_knows_about', '');
        $knowsAbout = array_values(array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', (string) $knowsAboutRaw))));

        // Social Profiles (sameAs)
        $sameAs = [];
        $socialKeys = [
            'schema_social_facebook' => 'social_facebook',
            'schema_social_youtube' => 'social_youtube',
            'schema_social_tiktok' => '',
            'schema_social_twitter' => '',
            'schema_social_linkedin' => '',
            'schema_social_zalo' => 'social_zalo',
        ];
        foreach ($socialKeys as $schemaKey => $generalKey) {
            $url = $this->getVal($schemaKey);
            if (empty($url) && !empty($generalKey)) {
                $url = get_setting($generalKey);
            }
            if (!empty($url)) {
                if ($schemaKey === 'schema_social_zalo' && !str_starts_with($url, 'http')) {
                    $url = 'https://zalo.me/' . preg_replace('/[^0-9]/', '', $url);
                }
                $sameAs[] = $url;
            }
        }
        $sameAs = array_values(array_unique(array_filter($sameAs)));

        // Opening Hours Days
        $days = $this->getVal('schema_opening_days', ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday']);
        if (is_string($days)) {
            $days = json_decode($days, true) ?: array_map('trim', explode(',', $days));
        }

        $org = [
            '@type' => $types,
            '@id' => $baseUrl . '/#organization',
            'name' => $this->getVal('schema_org_name', 'Truyền Thông Cửu Long'),
            'legalName' => $this->getVal('schema_org_legal_name', 'Công Ty TNHH Truyền Thông Cửu Long'),
            'url' => $baseUrl,
            'email' => $this->getVal('schema_org_email', 'info@truyenthongcuulong.com'),
            'telephone' => $this->getVal('schema_org_telephone', '+84939363262'),
            'priceRange' => $this->getVal('schema_org_price_range', '$$'),
            'description' => $this->getVal('schema_org_description', ''),
            'address' => [
                '@type' => 'PostalAddress',
                'streetAddress' => $this->getVal('schema_address_street', 'Lầu 5, 57 Hùng Vương'),
                'addressLocality' => $this->getVal('schema_address_locality', 'Ninh Kiều'),
                'addressRegion' => $this->getVal('schema_address_region', 'Cần Thơ'),
                'postalCode' => $this->getVal('schema_address_postal_code', '900000'),
                'addressCountry' => $this->getVal('schema_address_country', 'VN'),
            ],
            'geo' => [
                '@type' => 'GeoCoordinates',
                'latitude' => (float) $this->getVal('schema_geo_latitude', 10.0438252),
                'longitude' => (float) $this->getVal('schema_geo_longitude', 105.7789027),
            ],
            'logo' => [
                '@type' => 'ImageObject',
                '@id' => $baseUrl . '/#logo',
                'url' => $this->getVal('schema_org_logo', $baseUrl . '/images/logo-ttcl.png'),
                'contentUrl' => $this->getVal('schema_org_logo', $baseUrl . '/images/logo-ttcl.png'),
                'caption' => $this->getVal('schema_org_name', 'Truyền Thông Cửu Long'),
                'inLanguage' => 'vi-VN',
            ],
            'image' => [
                '@id' => $baseUrl . '/#logo',
            ],
            'openingHoursSpecification' => [
                [
                    '@type' => 'OpeningHoursSpecification',
                    'dayOfWeek' => !empty($days) ? array_values($days) : ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
                    'opens' => $this->getVal('schema_opening_hours_open', '07:30'),
                    'closes' => $this->getVal('schema_opening_hours_close', '17:30'),
                ],
            ],
        ];

        if (!empty($altNames)) {
            $org['alternateName'] = $altNames;
        }

        if (!empty($sameAs)) {
            $org['sameAs'] = $sameAs;
        }

        if (!empty($areaServedObjects)) {
            $org['areaServed'] = $areaServedObjects;
        }

        if (!empty($knowsAbout)) {
            $org['knowsAbout'] = $knowsAbout;
        }

        // Offer Catalog
        if ($this->getVal('schema_enable_offer_catalog', '1') == '1') {
            $org['hasOfferCatalog'] = $this->getDefaultOfferCatalog($baseUrl);
        }

        return $org;
    }

    /**
     * Build WebSite Schema with optional Sitelinks Search Box
     */
    public function getWebSiteSchema(): array
    {
        $baseUrl = $this->getBaseUrl();
        
        $website = [
            '@type' => 'WebSite',
            '@id' => $baseUrl . '/#website',
            'url' => $baseUrl,
            'name' => $this->getVal('schema_org_name', 'Truyền Thông Cửu Long'),
            'description' => 'Technology • Digital Solutions',
            'publisher' => [
                '@id' => $baseUrl . '/#organization',
            ],
            'inLanguage' => 'vi-VN',
        ];

        if ($this->getVal('schema_enable_sitelinks_search', '1') == '1') {
            $website['potentialAction'] = [
                '@type' => 'SearchAction',
                'target' => [
                    '@type' => 'EntryPoint',
                    'urlTemplate' => $baseUrl . '/tin-tuc?search={search_term_string}',
                ],
                'query-input' => 'required name=search_term_string',
            ];
        }

        return $website;
    }

    /**
     * Universal string sanitizer for Schema JSON-LD.
     * Decodes HTML entities (&amp; -> &, &quot; -> ", etc.), strips tags,
     * removes unescaped slashes, and optionally converts double quotes to single quotes.
     */
    public static function cleanSchemaString(?string $str, bool $convertQuotesToSingle = false): string
    {
        if ($str === null || $str === '') {
            return '';
        }

        // 1. Strip HTML tags
        $clean = strip_tags($str);

        // 2. Decode HTML entities twice to handle any double-encoded entities (&amp;amp; -> &)
        $clean = html_entity_decode($clean, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $clean = html_entity_decode($clean, ENT_QUOTES | ENT_HTML5, 'UTF-8');

        // 3. Normalize escaped backslashes (&quot;, \", \')
        $clean = str_replace(['\\"', "\\'", '\\&quot;', '&quot;'], ['"', "'", '"', '"'], $clean);

        // 4. Convert double quotes to single quotes to prevent any JSON breaking or unsightly escape slashes
        if ($convertQuotesToSingle) {
            $clean = str_replace('"', "'", $clean);
        }

        // 5. Clean up redundant spaces and line breaks
        $clean = preg_replace('/\s+/', ' ', $clean);

        return trim($clean);
    }

    /**
     * Build WebPage Schema
     */
    public function getWebPageSchema(?string $title = null, ?string $url = null, bool $isHome = false, ?\App\Models\Post $post = null, bool $hasFaq = false): array
    {
        $baseUrl = $this->getBaseUrl();
        $currentUrl = $url ?: url()->current();
        if (str_contains($currentUrl, '127.0.0.1') || str_contains($currentUrl, 'localhost')) {
            $currentUrl = preg_replace('#^https?://[^/]+#', $baseUrl, $currentUrl);
        }

        // Lỗi 3 Fix: Tuyệt đối không bao giờ cho phép URL trang quản trị (cuulongteam/schema-settings hoặc livewire) rò rỉ vào schema
        if ($post) {
            $currentUrl = $baseUrl . '/' . ltrim($post->slug, '/');
        } elseif ($isHome || str_contains($currentUrl, '/cuulongteam') || str_contains($currentUrl, '/livewire')) {
            $currentUrl = $baseUrl;
        }

        $rawTitle = $title ?: ($post ? ($post->meta_title ?: $post->title) : trim((string) View::yieldContent('title', 'Truyền Thông Cửu Long - Giải pháp Công nghệ & Truyền thông')));
        $pageTitle = self::cleanSchemaString($rawTitle);
        $pageType = $this->getVal('schema_default_page_type', 'WebPage');

        $webpage = [
            '@type' => $pageType,
            '@id' => $currentUrl . '#webpage',
            'url' => $currentUrl,
            'name' => $pageTitle,
            'isPartOf' => [
                '@id' => $baseUrl . '/#website',
            ],
            'about' => [
                '@id' => $baseUrl . '/#organization',
            ],
            'primaryImageOfPage' => [
                '@id' => $baseUrl . '/#logo',
            ],
            'inLanguage' => 'vi-VN',
        ];

        if ($post) {
            $rawDesc = $post->excerpt ?: ($post->meta_description ?: $post->summary);
            if (!empty($rawDesc)) {
                $webpage['description'] = self::cleanSchemaString($rawDesc, true);
            }
            if ($post->published_at) {
                $webpage['datePublished'] = $post->published_at->toIso8601String();
            }
            if ($post->updated_at) {
                $webpage['dateModified'] = $post->updated_at->toIso8601String();
            }
            if ($post->thumbnail) {
                $imageUrl = $post->thumbnail_url;
                if (str_starts_with($imageUrl, 'http://') && str_contains($imageUrl, 'truyenthongcuulong.com')) {
                    $imageUrl = preg_replace('#^http://#', 'https://', $imageUrl);
                }
                $webpage['primaryImageOfPage'] = [
                    '@type' => 'ImageObject',
                    '@id' => $currentUrl . '#primaryimage',
                    'url' => $imageUrl,
                ];
            }
        }

        if ($this->getVal('schema_enable_breadcrumb', '1') == '1') {
            $webpage['breadcrumb'] = [
                '@id' => ($isHome ? $baseUrl : $currentUrl) . '#breadcrumb',
            ];
        }

        if ($post && ($post->isPillarPage() || $post->isLandingPage())) {
            $schemaType = in_array($post->schema_type, ['Article', 'WebPage', 'Service']) ? $post->schema_type : ($post->isLandingPage() ? 'Service' : 'Article');
            if ($schemaType === 'Service') {
                $webpage['mainEntity'] = [
                    '@id' => $currentUrl . '#service',
                ];
            } elseif ($schemaType === 'Article') {
                $webpage['mainEntity'] = [
                    '@id' => $currentUrl . '#article',
                ];
            }
            // If schemaType === 'WebPage', the WebPage is itself the primary entity
        } elseif ($post || request()->routeIs('blog.resolve') || request()->routeIs('blog.show') || request()->routeIs('post.preview')) {
            $webpage['mainEntity'] = [
                '@id' => $currentUrl . '#article',
            ];
        }

        if ($hasFaq) {
            $webpage['hasPart'] = [
                [
                    '@id' => $currentUrl . '#faq',
                ],
            ];
        }

        return $webpage;
    }

    /**
     * Build Dynamic BreadcrumbList Schema for any page based on URL hierarchy and models.
     * Compliant with Google Search Console Rich Results standard.
     */
    public function getDynamicBreadcrumbsSchema(?string $title = null, ?string $url = null, bool $isHome = false, ?\App\Models\Post $post = null): array
    {
        $baseUrl = $this->getBaseUrl();
        $currentUrl = $url ?: url()->current();
        if (str_contains($currentUrl, '127.0.0.1') || str_contains($currentUrl, 'localhost')) {
            $currentUrl = preg_replace('#^https?://[^/]+#', $baseUrl, $currentUrl);
        }

        if ($post) {
            $currentUrl = $baseUrl . '/' . ltrim($post->slug, '/');
        } elseif ($isHome || str_contains($currentUrl, '/cuulongteam') || str_contains($currentUrl, '/livewire')) {
            $currentUrl = $baseUrl;
        }

        // Base Breadcrumb with Item 1: Trang chủ
        $items = [
            [
                '@type' => 'ListItem',
                'position' => 1,
                'name' => 'Trang chủ',
                'item' => $baseUrl,
            ],
        ];

        // Dictionary of friendly human-readable Vietnamese names for standard slugs
        $knownSegmentNames = [
            'tin-tuc' => 'Tin tức',
            'bai-viet' => 'Tin tức & Bài viết',
            'blog' => 'Blog',
            'dich-vu' => 'Dịch vụ',
            'du-an' => 'Dự án',
            'kho-giao-dien' => 'Kho giao diện',
            'web-demo' => 'Giao diện mẫu',
            've-chung-toi' => 'Về chúng tôi',
            'lien-he' => 'Liên hệ',
            'doi-tac' => 'Đối tác',
            'khach-hang' => 'Khách hàng',
            'tuyen-dung' => 'Tuyển dụng',
            'quy-trinh' => 'Quy trình',
            'dieu-khoan-dich-vu' => 'Điều khoản dịch vụ',
            'chinh-sach-bao-mat' => 'Chính sách bảo mật',
            'ho-so-nang-luc' => 'Hồ sơ năng lực',
            'bang-gia' => 'Bảng giá',
            'tai-nguyen' => 'Tài nguyên',
            'web-app' => 'Web App & Phần mềm',
            'ui-ux' => 'Thiết kế UI/UX',
            'marketing' => 'SEO & Digital Marketing',
            'quan-tri-website' => 'Quản trị Website',
            'chup-anh-su-kien' => 'Chụp ảnh sự kiện',
            'chup-anh-teambuilding' => 'Chụp ảnh Teambuilding',
            'quay-phim-su-kien' => 'Quay phim sự kiện',
            'quay-phim-teambuilding' => 'Quay phim Teambuilding',
            'quay-chup-flycam' => 'Quay chụp Flycam',
        ];

        if (!$isHome) {
            $path = trim((string) parse_url($currentUrl, PHP_URL_PATH), '/');
            if (!empty($path)) {
                $segments = explode('/', $path);
                $position = 2;
                $lastSegment = end($segments);

                // Helper: kiểm tra xem item URL đã có trong danh sách chưa
                $hasItem = function (string $urlToCheck) use (&$items): bool {
                    $normCheck = rtrim($urlToCheck, '/');
                    foreach ($items as $it) {
                        if (rtrim($it['item'], '/') === $normCheck) {
                            return true;
                        }
                    }
                    return false;
                };

                // Helper: làm sạch tiêu đề (loại bỏ hậu tố thương hiệu để tên Breadcrumb gọn đẹp)
                $cleanName = function (string $raw): string {
                    $cleaned = self::cleanSchemaString($raw);
                    $cleaned = preg_replace('/\s*[-–|]\s*(Cửu Long Media|Truyền Thông Cửu Long).*$/iu', '', $cleaned);
                    return trim($cleaned ?: $raw);
                };

                // A. TRƯỜNG HỢP 1: BÀI VIẾT (POST) HOẶC TRANG ĐẶC BIỆT (PAGE)
                $postModel = $post ?: \App\Models\Post::with('category')->where('slug', $lastSegment)->first();
                if ($postModel) {
                    $isPage = (bool) $postModel->is_page || in_array($postModel->page_template, ['pillar_page', 'landing_page']);
                    if ($isPage) {
                        // Cấu trúc breadcrumb dành riêng cho Trang (Page): Trang chủ › [Tên bài viết]
                        // Chuẩn SEO cho trang đơn (Page): Trỏ thẳng từ Trang chủ tới Tên bài viết (không qua Tin tức / Chuyên mục)
                        $items[] = [
                            '@type' => 'ListItem',
                            'position' => $position++,
                            'name' => $cleanName($title ?: $postModel->title),
                            'item' => $currentUrl,
                        ];

                        return [
                            '@type' => 'BreadcrumbList',
                            '@id' => $currentUrl . '#breadcrumb',
                            'itemListElement' => $items,
                        ];
                    }

                    // 1. Thêm cấp 'Tin tức' làm mục cha nếu chưa có (Dành riêng cho bài viết tiêu chuẩn)
                    $blogUrl = $baseUrl . '/bai-viet';
                    if (!$hasItem($blogUrl) && !in_array('bai-viet', $segments) && !in_array('tin-tuc', $segments)) {
                        $items[] = [
                            '@type' => 'ListItem',
                            'position' => $position++,
                            'name' => 'Tin tức',
                            'item' => $blogUrl,
                        ];
                    }

                    // 2. Thêm cấp Danh mục (Category) của bài viết (ví dụ: Media, Tin tức, v.v.)
                    if ($postModel->category) {
                        $cat = $postModel->category;
                        $catUrl = $baseUrl . '/' . $cat->slug;
                        if (!$hasItem($catUrl)) {
                            $items[] = [
                                '@type' => 'ListItem',
                                'position' => $position++,
                                'name' => $cleanName($cat->name),
                                'item' => $catUrl,
                            ];
                        }
                    }

                    // 3. Thêm chính bài viết (Mục cuối cùng)
                    $items[] = [
                        '@type' => 'ListItem',
                        'position' => $position++,
                        'name' => $cleanName($title ?: $postModel->title),
                        'item' => $currentUrl,
                    ];

                    return [
                        '@type' => 'BreadcrumbList',
                        '@id' => $currentUrl . '#breadcrumb',
                        'itemListElement' => $items,
                    ];
                }

                // B. TRƯỜNG HỢP 2: CHUYÊN MỤC BÀI VIẾT (CATEGORY)
                $categoryModel = \App\Models\Category::where('slug', $lastSegment)->first();
                if ($categoryModel && count($segments) === 1) {
                    $blogUrl = $baseUrl . '/bai-viet';
                    if (!$hasItem($blogUrl)) {
                        $items[] = [
                            '@type' => 'ListItem',
                            'position' => $position++,
                            'name' => 'Tin tức',
                            'item' => $blogUrl,
                        ];
                    }

                    $items[] = [
                        '@type' => 'ListItem',
                        'position' => $position++,
                        'name' => $cleanName($categoryModel->name),
                        'item' => $currentUrl,
                    ];

                    return [
                        '@type' => 'BreadcrumbList',
                        '@id' => $currentUrl . '#breadcrumb',
                        'itemListElement' => $items,
                    ];
                }

                // C. TRƯỜNG HỢP 3: DỰ ÁN TIÊU BIỂU (CASE STUDY)
                $caseStudyModel = \App\Models\CaseStudy::where('slug', $lastSegment)->first();
                if ($caseStudyModel) {
                    $projectUrl = $baseUrl . '/du-an';
                    if (!$hasItem($projectUrl) && !in_array('du-an', $segments)) {
                        $items[] = [
                            '@type' => 'ListItem',
                            'position' => $position++,
                            'name' => 'Dự án',
                            'item' => $projectUrl,
                        ];
                    }

                    $items[] = [
                        '@type' => 'ListItem',
                        'position' => $position++,
                        'name' => $cleanName($title ?: $caseStudyModel->title),
                        'item' => $currentUrl,
                    ];

                    return [
                        '@type' => 'BreadcrumbList',
                        '@id' => $currentUrl . '#breadcrumb',
                        'itemListElement' => $items,
                    ];
                }

                // D. TRƯỜNG HỢP 4: CÁC TRANG PHÂN CẤP THEO URL PATH THÔNG THƯỜNG
                $accumulatedPath = $baseUrl;
                $totalSegments = count($segments);

                foreach ($segments as $index => $segment) {
                    if (empty($segment)) {
                        continue;
                    }
                    $accumulatedPath .= '/' . $segment;
                    $isLast = ($index === $totalSegments - 1);

                    if (isset($knownSegmentNames[$segment])) {
                        $name = $knownSegmentNames[$segment];
                    } elseif ($isLast && !empty($title)) {
                        $name = $cleanName($title);
                    } else {
                        $serviceModel = \App\Models\Service::where('slug', $segment)->first();
                        if ($serviceModel) {
                            $name = $serviceModel->title ?: $serviceModel->name;
                        } else {
                            $name = ucwords(str_replace(['-', '_'], ' ', $segment));
                        }
                    }

                    $items[] = [
                        '@type' => 'ListItem',
                        'position' => $position++,
                        'name' => $cleanName($name),
                        'item' => $accumulatedPath,
                    ];
                }
            }
        }

        return [
            '@type' => 'BreadcrumbList',
            '@id' => ($isHome ? $baseUrl : $currentUrl) . '#breadcrumb',
            'itemListElement' => $items,
        ];
    }

    /**
     * Backward compatibility wrapper for Home Breadcrumb
     */
    public function getHomeBreadcrumbSchema(): array
    {
        return $this->getDynamicBreadcrumbsSchema(null, null, true);
    }

    /**
     * Get default Offer Catalog
     */
    protected function getDefaultOfferCatalog(string $baseUrl): array
    {
        return [
            '@type' => 'OfferCatalog',
            'name' => 'Dịch vụ Công nghệ & Truyền thông',
            'itemListElement' => [
                [
                    '@type' => 'OfferCatalog',
                    'name' => 'Website & Phần mềm',
                    'itemListElement' => [
                        [
                            '@type' => 'Offer',
                            'itemOffered' => [
                                '@type' => 'Service',
                                'name' => 'Thiết kế Website',
                                'description' => 'Website chuẩn SEO, tốc độ cao & tối ưu chuyển đổi với hơn 70+ mẫu giao diện.',
                                'url' => $baseUrl . '/kho-giao-dien',
                            ],
                        ],
                        [
                            '@type' => 'Offer',
                            'itemOffered' => [
                                '@type' => 'Service',
                                'name' => 'Thiết kế Web App & Ứng Dụng Di Động',
                                'description' => 'Số hóa quy trình nghiệp vụ & phần mềm quản lý.',
                                'url' => $baseUrl . '/dich-vu/web-app',
                            ],
                        ],
                        [
                            '@type' => 'Offer',
                            'itemOffered' => [
                                '@type' => 'Service',
                                'name' => 'Thiết kế UI/UX Theo Yêu Cầu',
                                'description' => 'Trải nghiệm người dùng tinh tế, chuẩn thương hiệu.',
                                'url' => $baseUrl . '/dich-vu/web-app#ui-ux',
                            ],
                        ],
                        [
                            '@type' => 'Offer',
                            'itemOffered' => [
                                '@type' => 'Service',
                                'name' => 'Dịch Vụ SEO Tổng Thể',
                                'description' => 'Technical SEO, từ khóa lên Top & tăng trưởng tự nhiên.',
                                'url' => $baseUrl . '/dich-vu/marketing',
                            ],
                        ],
                        [
                            '@type' => 'Offer',
                            'itemOffered' => [
                                '@type' => 'Service',
                                'name' => 'Quản Trị Website',
                                'description' => 'Bảo trì kỹ thuật, bảo mật, tối ưu tốc độ & backup.',
                                'url' => $baseUrl . '/dich-vu/quan-tri-website',
                            ],
                        ],
                    ],
                ],
                [
                    '@type' => 'OfferCatalog',
                    'name' => 'Quay chụp & Media',
                    'itemListElement' => [
                        [
                            '@type' => 'Offer',
                            'itemOffered' => [
                                '@type' => 'Service',
                                'name' => 'Chụp Ảnh Sự Kiện',
                                'description' => 'Hội nghị, hội thảo, khai trương & lễ kỷ niệm.',
                                'url' => $baseUrl . '/dich-vu/chup-anh-su-kien',
                            ],
                        ],
                        [
                            '@type' => 'Offer',
                            'itemOffered' => [
                                '@type' => 'Service',
                                'name' => 'Quay Phim Sự Kiện',
                                'description' => 'Sản xuất video sự kiện, teambuilding, gala dinner, hội nghị chuyên nghiệp.',
                                'url' => $baseUrl . '/dich-vu/quay-phim-su-kien',
                            ],
                        ],
                        [
                            '@type' => 'Offer',
                            'itemOffered' => [
                                '@type' => 'Service',
                                'name' => 'Chụp Ảnh Teambuilding',
                                'description' => 'Ghi lại khoảnh khắc gắn kết, dã ngoại sôi nổi của doanh nghiệp.',
                                'url' => $baseUrl . '/dich-vu/chup-anh-teambuilding',
                            ],
                        ],
                        [
                            '@type' => 'Offer',
                            'itemOffered' => [
                                '@type' => 'Service',
                                'name' => 'Quay Phim Teambuilding',
                                'description' => 'Video recap tràn đầy năng lượng, cảm xúc và truyền lửa thương hiệu.',
                                'url' => $baseUrl . '/dich-vu/quay-phim-teambuilding',
                            ],
                        ],
                        [
                            '@type' => 'Offer',
                            'itemOffered' => [
                                '@type' => 'Service',
                                'name' => 'Quay Chụp Flycam',
                                'description' => 'Góc nhìn toàn cảnh trên không mãn nhãn, độ nét 4K HDR cho dự án và sự kiện.',
                                'url' => $baseUrl . '/dich-vu/quay-chup-flycam',
                            ],
                        ],
                    ],
                ],
            ],
        ];
    }

    /**
     * Build rich E-E-A-T Person schema for Article author (Lỗi 4 Fix).
     * Provides author @id, profile URL, official jobTitle, worksFor, sameAs social profiles and bio description.
     */
    public function getAuthorPersonSchema(?\App\Models\User $author = null, ?string $fallbackName = null): array
    {
        $baseUrl = $this->getBaseUrl();
        $name = trim((string) ($author?->name ?: ($fallbackName ?: 'Minh Thành')));
        $cleanName = self::cleanSchemaString($name);
        if (empty($cleanName)) {
            $cleanName = 'Minh Thành';
        }
        $slug = \Illuminate\Support\Str::slug($cleanName ?: 'minh-thanh');
        $authorId = $baseUrl . '/#author-' . $slug;

        // E-E-A-T author profile URL (Trang giới thiệu tác giả & đội ngũ chuyên gia)
        $profileUrl = $baseUrl . '/ve-chung-toi';

        // Known titles and bios for Google E-E-A-T authority
        $jobTitle = 'Chuyên gia Cố vấn Công nghệ & Technical SEO';
        $description = 'Chuyên gia cố vấn giải pháp chuyển đổi số, thiết kế website chuẩn SEO và chiến lược nội dung số tại Cửu Long Media.';

        if (stripos($cleanName, 'Minh Thành') !== false) {
            $jobTitle = 'Chuyên gia Cố vấn Công nghệ & Technical SEO';
            $description = 'Hơn 8 năm kinh nghiệm trong lĩnh vực tư vấn kiến trúc công nghệ, thiết kế website chuẩn SEO và tối ưu hóa giải pháp số cho doanh nghiệp.';
        } elseif (stripos($cleanName, 'Cửu Long') !== false) {
            $jobTitle = 'Ban Biên Tập Cửu Long Media';
            $description = 'Đội ngũ chuyên gia nội dung số, thiết kế website chuẩn SEO và truyền thông thương hiệu tại Công ty TNHH Truyền Thông Cửu Long.';
        }

        // Social profiles for Google E-E-A-T verification (sameAs)
        $sameAs = [];
        $fb = $this->getVal('schema_social_facebook', get_setting('social_facebook', 'https://www.facebook.com/truyenthongcuulong'));
        $tw = $this->getVal('schema_social_twitter', 'https://twitter.com/nguyenhophuc87');
        $li = $this->getVal('schema_social_linkedin');
        if (!empty($fb)) $sameAs[] = $fb;
        if (!empty($tw)) $sameAs[] = $tw;
        if (!empty($li)) $sameAs[] = $li;

        $person = [
            '@type' => 'Person',
            '@id' => $authorId,
            'name' => $cleanName,
            'url' => $profileUrl,
            'jobTitle' => $jobTitle,
            'worksFor' => [
                '@type' => 'Organization',
                '@id' => $baseUrl . '/#organization',
                'name' => $this->getVal('schema_org_name', 'Truyền Thông Cửu Long'),
            ],
            'description' => $description,
        ];

        if (!empty($sameAs)) {
            $person['sameAs'] = array_values(array_unique($sameAs));
        }

        return $person;
    }

    /**
     * Extract FAQ questions and answers from article content to build FAQPage schema (Lỗi 2 Fix).
     * Automatically scans for FAQ section headings, question marks (?), or question phrases,
     * and extracts the accompanying answers into Google FAQPage Rich Results format.
     */
    public function extractFaqFromContent(?string $html, string $currentUrl): ?array
    {
        if (empty($html)) {
            return null;
        }

        $cleanHtml = \App\Services\Content\ContentSanitizerService::clean($html);
        if (empty($cleanHtml)) {
            return null;
        }

        try {
            libxml_use_internal_errors(true);
            $dom = new \DOMDocument();
            $dom->loadHTML('<meta http-equiv="Content-Type" content="text/html; charset=utf-8"><div>' . $cleanHtml . '</div>', LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            libxml_clear_errors();

            $xpath = new \DOMXPath($dom);
            $headings = $xpath->query('//h2 | //h3');

            $faqItems = [];
            $inFaqSection = false;

            foreach ($headings as $heading) {
                $headingText = trim($heading->textContent);
                $isH2 = (strtolower($heading->nodeName) === 'h2');
                $isH3 = (strtolower($heading->nodeName) === 'h3');

                // Check if this heading indicates an FAQ section start
                if ($isH2) {
                    if (preg_match('/(câu hỏi|thắc mắc|hỏi đáp|faq|f\.a\.q|những thắc mắc|giải đáp)/iu', $headingText)) {
                        $inFaqSection = true;
                        continue;
                    } else {
                        // Exited FAQ section
                        $inFaqSection = false;
                    }
                }

                // Question detection criteria:
                // 1) Inside FAQ section and is an H3
                // 2) Heading ends with question mark (?)
                // 3) Heading starts with common question patterns (thời gian, chi phí, bao lâu, có nên, doanh nghiệp ở các tỉnh, quy trình, làm sao, tại sao...)
                $isQuestion = false;
                if ($inFaqSection && $isH3) {
                    $isQuestion = true;
                } elseif (preg_match('/(\?|？)$/u', $headingText)) {
                    $isQuestion = true;
                } elseif (preg_match('/^\s*(\d+[.\-]\s*)?(thời gian|chi phí|giá|bao lâu|làm sao|tại sao|có nên|có được|doanh nghiệp.*(ở|có)|quy trình|bảo hành|hỗ trợ|khi nào|ai là|lợi ích|tại sao nên)/iu', $headingText)) {
                    $isQuestion = true;
                }

                if (!$isQuestion) {
                    continue;
                }

                // Gather answers from following sibling nodes until the next heading
                $answerTexts = [];
                $node = $heading->nextSibling;
                while ($node && !in_array(strtolower($node->nodeName), ['h1', 'h2', 'h3'])) {
                    if ($node->nodeType === XML_ELEMENT_NODE) {
                        $txt = trim(strip_tags($dom->saveHTML($node)));
                        if (!empty($txt)) {
                            $answerTexts[] = $txt;
                        }
                    }
                    $node = $node->nextSibling;
                }

                $answer = implode(' ', $answerTexts);
                $cleanAnswer = self::cleanSchemaString($answer);
                $cleanQuestion = self::cleanSchemaString(preg_replace('/^\s*\d+[.\-]\s*/u', '', $headingText));

                if (mb_strlen($cleanQuestion) >= 10 && mb_strlen($cleanAnswer) >= 15) {
                    // Avoid duplicate questions
                    $exists = false;
                    foreach ($faqItems as $item) {
                        if ($item['name'] === $cleanQuestion) {
                            $exists = true;
                            break;
                        }
                    }
                    if (!$exists) {
                        $faqItems[] = [
                            '@type' => 'Question',
                            'name' => $cleanQuestion,
                            'acceptedAnswer' => [
                                '@type' => 'Answer',
                                'text' => $cleanAnswer,
                            ],
                        ];
                    }
                }
            }

            if (empty($faqItems)) {
                return null;
            }

            return [
                '@type' => 'FAQPage',
                '@id' => $currentUrl . '#faq',
                'isPartOf' => [
                    '@id' => $currentUrl . '#webpage',
                ],
                'mainEntity' => $faqItems,
            ];
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::warning('FAQ extraction error: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Get Complete Graph Array (Lỗi 1 & Lỗi 3 Fix).
     * Unifies all entities (Organization, WebSite, WebPage, BreadcrumbList, Person, Article, FAQPage)
     * into ONE single @graph array interconnected via referencing @ids.
     */
    public function getGraphArray(?string $title = null, ?string $url = null, bool $isHome = false, ?\App\Models\Post $post = null): array
    {
        $baseUrl = $this->getBaseUrl();

        // 1. Tự động nhận diện bài viết ($post) nếu chưa được truyền vào
        if (!$post) {
            $post = \Illuminate\Support\Facades\View::shared('currentPost') ?: \Illuminate\Support\Facades\View::shared('post');
        }
        if (!$post && (request()->routeIs('blog.resolve') || request()->routeIs('blog.show') || request()->routeIs('post.preview'))) {
            $slug = request()->route('slug');
            if ($slug) {
                $post = \App\Models\Post::with(['category', 'author'])->where('slug', $slug)->first();
            }
        }

        // 2. NẾU ĐANG LÀ BÀI VIẾT: Luôn xuất cấu trúc Schema ĐỘNG chuẩn mực, KHÔNG dùng Manual Override
        if ($post) {
            $canonicalUrl = $baseUrl . '/' . ltrim($post->slug, '/');
            $url = $canonicalUrl;
            $title = $title ?: ($post->meta_title ?: $post->title);
            $isHome = false;

            // Xác định loại schema cho bài viết:
            // Chỉ áp dụng schema_type tùy biến khi bài viết là Pillar Page hoặc Landing Page
            $schemaType = 'Article';
            if ($post->isPillarPage() || $post->isLandingPage()) {
                $configuredType = $post->schema_type;
                if (in_array($configuredType, ['Article', 'WebPage', 'Service'])) {
                    $schemaType = $configuredType;
                } elseif ($post->isLandingPage()) {
                    $schemaType = 'Service';
                }
            }

            // Trích xuất FAQ từ nội dung bài viết (Lỗi 2)
            $faqSchema = $this->extractFaqFromContent($post->content, $canonicalUrl);

            // Xây dựng thực thể tác giả Person chuẩn Google E-E-A-T (Lỗi 4)
            $authorPerson = $this->getAuthorPersonSchema($post->author, $post->author?->name ?: 'Minh Thành');

            // Xây dựng các node thuộc graph
            $webPageSchema = $this->getWebPageSchema($title, $url, false, $post, (bool) $faqSchema);
            $breadcrumbsSchema = $this->getDynamicBreadcrumbsSchema($title, $url, false, $post);

            $graph = [
                $this->getOrganizationSchema(),
                $this->getWebSiteSchema(),
                $webPageSchema,
            ];

            if ($this->getVal('schema_enable_breadcrumb', '1') == '1') {
                $graph[] = $breadcrumbsSchema;
            }

            if ($schemaType === 'Article') {
                // Gắn Person (Tác giả) vào graph (Lỗi 4)
                $graph[] = $authorPerson;

                // Gắn Article vào graph kết nối toàn diện với WebPage & WebSite & Author (Lỗi 1)
                $articleSchema = $this->getArticleSchema($post, $canonicalUrl, $authorPerson);
                unset($articleSchema['@context']); // Loại bỏ context cấp con khi nằm trong @graph
                $graph[] = $articleSchema;
            } elseif ($schemaType === 'Service') {
                // Gắn Service vào graph cho Pillar Page định hướng dịch vụ (Phase 4)
                $serviceSchema = $this->getServiceSchema($post, $canonicalUrl);
                unset($serviceSchema['@context']);
                $graph[] = $serviceSchema;
            } elseif ($schemaType === 'WebPage') {
                // Với WebPage Pillar Page, thực thể chính đã là WebPage node
                if ($post->show_author_date) {
                    $graph[] = $authorPerson;
                }
            }

            // Gắn FAQPage vào graph nếu có câu hỏi (Lỗi 2)
            if ($faqSchema) {
                unset($faqSchema['@context']);
                $graph[] = $faqSchema;
            }

            // Gắn Custom JSON-LD tùy chỉnh riêng cho bài Page hoặc từ Template Cấu hình Schema (SEO)
            $isPage = (bool) $post->is_page || in_array($post->page_template, ['pillar_page', 'landing_page']);
            $schemaData = is_array($post->schema_data) ? $post->schema_data : [];
            $schemaMode = $schemaData['schema_mode'] ?? 'preset';
            $customMode = $schemaData['custom_mode'] ?? 'merge';
            $postCustomJson = trim((string) ($schemaData['custom_jsonld'] ?? ''));

            // Nếu là bài Page và người dùng bật chế độ Custom Schema tự do với mã JSON-LD riêng:
            if ($isPage && $schemaMode === 'custom' && !empty($postCustomJson)) {
                $cleanedCustom = html_entity_decode($postCustomJson, ENT_QUOTES | ENT_HTML5, 'UTF-8');
                $decoded = json_decode($cleanedCustom, true);

                if (is_array($decoded)) {
                    // Nếu chọn Ghi đè toàn bộ @graph (override): người dùng toàn quyền kiểm soát mã schema
                    if ($customMode === 'override') {
                        if (isset($decoded['@context']) || isset($decoded['@graph'])) {
                            return $decoded;
                        }
                        return [
                            '@context' => 'https://schema.org',
                            '@graph' => array_is_list($decoded) ? $decoded : [$decoded],
                        ];
                    }

                    // Nếu chọn Bổ sung vào Graph chung (merge): chèn thêm các node tùy chỉnh vào $graph
                    if (isset($decoded['@graph']) && is_array($decoded['@graph'])) {
                        foreach ($decoded['@graph'] as $node) {
                            $graph[] = $node;
                        }
                    } elseif (isset($decoded['@context'])) {
                        unset($decoded['@context']);
                        $graph[] = $decoded;
                    } else {
                        $graph[] = $decoded;
                    }

                    return [
                        '@context' => 'https://schema.org',
                        '@graph' => $graph,
                    ];
                }
            }

            // Chế độ Preset hoặc bài viết tiêu chuẩn: lấy từ template tập trung
            $templateCustomJson = ($schemaType === 'Service')
                ? (string) $this->getVal('schema_service_custom_jsonld', '')
                : (string) $this->getVal('schema_article_custom_jsonld', '');
            
            $customJsonToApply = !empty($postCustomJson) ? $postCustomJson : $templateCustomJson;

            if (!empty($customJsonToApply)) {
                $cleanedCustom = html_entity_decode((string)$customJsonToApply, ENT_QUOTES | ENT_HTML5, 'UTF-8');
                $decoded = json_decode($cleanedCustom, true);
                if (is_array($decoded)) {
                    if (isset($decoded['@graph']) && is_array($decoded['@graph'])) {
                        foreach ($decoded['@graph'] as $node) {
                            $graph[] = $node;
                        }
                    } elseif (isset($decoded['@context'])) {
                        unset($decoded['@context']);
                        $graph[] = $decoded;
                    } else {
                        $graph[] = $decoded;
                    }
                }
            }

            return [
                '@context' => 'https://schema.org',
                '@graph' => $graph,
            ];
        }

        // 3. NẾU LÀ TRANG THÔNG THƯỜNG / TRANG CHỦ: Kiểm tra ghi đè thủ công (nếu có bật)
        $useOverride = (string) $this->getVal('schema_use_manual_override', '0');
        $manualJson = trim((string) $this->getVal('schema_manual_override_json', ''));

        if (($useOverride === '1' || $useOverride === 'true') && !empty($manualJson)) {
            // Khử độc admin URL nếu mã manual override từng bị dính cuulongteam/schema-settings (Lỗi 3 Fix)
            if (str_contains($manualJson, 'cuulongteam/schema-settings')) {
                $manualJson = str_replace(
                    ['https://truyenthongcuulong.com/cuulongteam/schema-settings', '/cuulongteam/schema-settings'],
                    [$baseUrl, ''],
                    $manualJson
                );
            }

            $cleanedJson = html_entity_decode($manualJson, ENT_QUOTES | ENT_HTML5, 'UTF-8');
            $cleanedJson = str_replace(['\\&quot;', '&quot;'], ['"', '"'], $cleanedJson);
            $decoded = json_decode($cleanedJson, true);
            if (is_array($decoded) && (isset($decoded['@context']) || isset($decoded['@graph']))) {
                if ($this->getVal('schema_enable_breadcrumb', '1') == '1' && isset($decoded['@graph']) && is_array($decoded['@graph'])) {
                    $hasBreadcrumb = false;
                    foreach ($decoded['@graph'] as &$node) {
                        if (isset($node['@type']) && $node['@type'] === 'BreadcrumbList') {
                            $hasBreadcrumb = true;
                            if (!$isHome) {
                                $node = $this->getDynamicBreadcrumbsSchema($title, $url, false);
                            }
                            break;
                        }
                    }
                    unset($node);

                    if (!$hasBreadcrumb) {
                        $decoded['@graph'][] = $this->getDynamicBreadcrumbsSchema($title, $url, $isHome);
                    }
                }
                return $decoded;
            }
        }

        // 4. Mặc định cho các trang không phải bài viết:
        $graph = [
            $this->getOrganizationSchema(),
            $this->getWebSiteSchema(),
            $this->getWebPageSchema($title, $url, $isHome),
        ];

        if ($this->getVal('schema_enable_breadcrumb', '1') == '1') {
            $graph[] = $this->getDynamicBreadcrumbsSchema($title, $url, $isHome);
        }

        // Custom JSON-LD if provided and valid JSON
        $customJson = trim((string) $this->getVal('schema_custom_jsonld', ''));
        if (!empty($customJson)) {
            $cleanedCustom = html_entity_decode($customJson, ENT_QUOTES | ENT_HTML5, 'UTF-8');
            $decoded = json_decode($cleanedCustom, true);
            if (is_array($decoded)) {
                if (isset($decoded['@graph']) && is_array($decoded['@graph'])) {
                    foreach ($decoded['@graph'] as $node) {
                        $graph[] = $node;
                    }
                } elseif (isset($decoded['@context'])) {
                    unset($decoded['@context']);
                    $graph[] = $decoded;
                } else {
                    $graph[] = $decoded;
                }
            }
        }

        return [
            '@context' => 'https://schema.org',
            '@graph' => $graph,
        ];
    }

    /**
     * Build Article Schema for blog post detail pages.
     * Fully sanitizes titles and descriptions (converts double quotes to single quotes,
     * strips tags, decodes HTML entities to prevent &amp; and \&quot; errors).
     * Connects seamlessly with Person author schema and Organization publisher schema.
     */
    public function getArticleSchema(\App\Models\Post $post, ?string $canonicalUrl = null, ?array $authorPerson = null): array
    {
        $baseUrl = $this->getBaseUrl();
        $currentUrl = $canonicalUrl ?: ($baseUrl . '/' . ltrim($post->slug, '/'));

        if (!$authorPerson) {
            $authorPerson = $this->getAuthorPersonSchema($post->author, $post->author?->name ?: 'Minh Thành');
        }

        $schemaData = is_array($post->schema_data) ? ($post->schema_data['article'] ?? $post->schema_data) : [];

        $headline = !empty($schemaData['headline']) 
            ? self::cleanSchemaString($schemaData['headline']) 
            : self::cleanSchemaString($post->title);
        
        // Raw description from excerpt, meta_description, or summary
        $rawDesc = !empty($schemaData['description'])
            ? $schemaData['description']
            : ($post->excerpt ?: ($post->meta_description ?: $post->summary));
        // Clean and convert internal double quotes to single quotes as requested
        $description = self::cleanSchemaString($rawDesc, true);

        $imageUrl = $post->thumbnail ? $post->thumbnail_url : ($baseUrl . '/images/logo-ttcl.png');
        if (str_starts_with($imageUrl, 'http://') && str_contains($imageUrl, 'truyenthongcuulong.com')) {
            $imageUrl = preg_replace('#^http://#', 'https://', $imageUrl);
        }
        $publishedAt = ($post->published_at ?? $post->created_at)->toIso8601String();
        $modifiedAt = ($post->updated_at ?? $post->published_at ?? $post->created_at)->toIso8601String();

        $categoryName = !empty($schemaData['article_section'])
            ? self::cleanSchemaString($schemaData['article_section'])
            : self::cleanSchemaString($post->category?->name ?? 'Tin tức & Dự án');

        if (!empty($schemaData['keywords'])) {
            $keywords = self::cleanSchemaString($schemaData['keywords']);
        } elseif (!empty($this->getVal('schema_default_article_keywords'))) {
            $keywords = self::cleanSchemaString(
                $post->category 
                    ? ($post->category->name . ', ' . $this->getVal('schema_default_article_keywords'))
                    : $this->getVal('schema_default_article_keywords')
            );
        } else {
            $keywords = self::cleanSchemaString(
                $post->category 
                    ? ($post->category->name . ', Thiết kế Website, Lập trình Web App, UI/UX, SEO Tổng Thể, Media Sự Kiện, Truyền Thông Cửu Long')
                    : 'Thiết kế Website, Lập trình Web App, Media Sự Kiện, SEO Tổng Thể, Truyền Thông Cửu Long'
            );
        }

        // About entities: Ưu tiên từ schema_data -> Global Setting -> Fallback mặc định
        $aboutEntities = [];
        if (!empty($schemaData['about'])) {
            $aboutLines = is_array($schemaData['about']) 
                ? $schemaData['about'] 
                : preg_split('/\r\n|\r|\n/', (string)$schemaData['about']);
            foreach ($aboutLines as $line) {
                $line = trim($line);
                if (!empty($line)) {
                    $aboutEntities[] = [
                        '@type' => 'Thing',
                        'name' => self::cleanSchemaString($line),
                    ];
                }
            }
        } elseif (!empty($this->getVal('schema_default_article_about'))) {
            $aboutLines = preg_split('/\r\n|\r|\n/', (string)$this->getVal('schema_default_article_about'));
            foreach ($aboutLines as $line) {
                $line = trim($line);
                if (!empty($line)) {
                    $aboutEntities[] = [
                        '@type' => 'Thing',
                        'name' => self::cleanSchemaString($line),
                    ];
                }
            }
        }

        if (empty($aboutEntities)) {
            $aboutEntities = [
                [
                    '@type' => 'Thing',
                    'name' => 'Thiết kế Website Chuẩn SEO & Lập trình Web App',
                ],
                [
                    '@type' => 'Thing',
                    'name' => 'Dịch vụ Media, Quay Phim & Chụp Ảnh Sự Kiện Chuyên Nghiệp',
                ],
            ];
        }

        $postType = !empty($schemaData['type']) ? $schemaData['type'] : $this->getVal('schema_default_post_type', 'Article');

        return [
            '@context' => 'https://schema.org',
            '@type' => $postType,
            '@id' => $currentUrl . '#article',
            'isPartOf' => [
                '@id' => $baseUrl . '/#website',
            ],
            'mainEntityOfPage' => [
                '@type' => 'WebPage',
                '@id' => $currentUrl . '#webpage',
            ],
            'headline' => $headline,
            'name' => $headline,
            'description' => $description,
            'image' => [
                '@type' => 'ImageObject',
                '@id' => $currentUrl . '#primaryimage',
                'url' => $imageUrl,
                'caption' => $headline,
                'width' => 1200,
                'height' => 675,
            ],
            'datePublished' => $publishedAt,
            'dateModified' => $modifiedAt,
            'author' => [
                '@type' => 'Person',
                '@id' => $authorPerson['@id'],
                'name' => $authorPerson['name'],
                'url' => $authorPerson['url'],
            ],
            'publisher' => [
                '@type' => 'Organization',
                '@id' => $baseUrl . '/#organization',
                'name' => self::cleanSchemaString($this->getVal('schema_org_name', 'Truyền Thông Cửu Long')),
                'url' => $baseUrl,
                'logo' => [
                    '@type' => 'ImageObject',
                    '@id' => $baseUrl . '/#logo',
                    'url' => $this->getVal('schema_org_logo', $baseUrl . '/images/logo-ttcl.png'),
                ],
            ],
            'inLanguage' => 'vi-VN',
            'articleSection' => $categoryName,
            'keywords' => $keywords,
            'about' => $aboutEntities,
        ];
    }

    /**
     * Build Service Schema for Service-focused Pillar Pages & Landing Pages.
     * Complies strictly with schema.org/Service standard. Supports per-post customization
     * (name, serviceType, description, areaServed, price/offers, terms).
     */
    public function getServiceSchema(\App\Models\Post $post, ?string $canonicalUrl = null): array
    {
        $baseUrl = $this->getBaseUrl();
        $currentUrl = $canonicalUrl ?: ($baseUrl . '/' . ltrim($post->slug, '/'));
        
        $schemaData = is_array($post->schema_data) ? ($post->schema_data['service'] ?? $post->schema_data) : [];

        $name = !empty($schemaData['name']) 
            ? self::cleanSchemaString($schemaData['name']) 
            : self::cleanSchemaString($post->title);

        $rawDesc = !empty($schemaData['description']) 
            ? $schemaData['description'] 
            : ($post->excerpt ?: ($post->meta_description ?: $post->summary));
        $description = self::cleanSchemaString($rawDesc, true);

        $serviceType = $this->getVal('schema_default_service_type', 'Service');

        $service = [
            '@type' => $serviceType,
            '@id' => $currentUrl . '#service',
            'name' => $name,
            'url' => $currentUrl,
            'description' => $description,
            'provider' => [
                '@id' => $baseUrl . '/#organization',
            ],
            'inLanguage' => 'vi-VN',
        ];

        // Service Type: Ưu tiên từ bài viết -> Category -> Template Schema Settings
        if (!empty($schemaData['service_type'])) {
            $service['serviceType'] = self::cleanSchemaString($schemaData['service_type']);
        } elseif ($post->category) {
            $service['serviceType'] = self::cleanSchemaString($post->category->name);
        } elseif (!empty($this->getVal('schema_service_sub_type'))) {
            $service['serviceType'] = self::cleanSchemaString($this->getVal('schema_service_sub_type'));
        }

        // Area Served: Ưu tiên từ bài viết -> Template Schema Settings
        if (!empty($schemaData['area_served'])) {
            $service['areaServed'] = self::cleanSchemaString($schemaData['area_served']);
        } elseif (!empty($this->getVal('schema_default_service_area'))) {
            $service['areaServed'] = self::cleanSchemaString($this->getVal('schema_default_service_area'));
        }

        // Offers / Pricing: Ưu tiên từ bài viết -> Template Schema Settings
        $price = !empty($schemaData['price']) ? $schemaData['price'] : $this->getVal('schema_service_default_price');
        $priceRange = !empty($schemaData['price_range']) ? $schemaData['price_range'] : '';
        if (!empty($price) || !empty($priceRange)) {
            $currency = !empty($schemaData['price_currency']) 
                ? self::cleanSchemaString($schemaData['price_currency']) 
                : self::cleanSchemaString($this->getVal('schema_service_default_currency', 'VND'));
            $offers = [
                '@type' => 'Offer',
                'url' => $currentUrl . '#lead-form',
                'priceCurrency' => $currency,
                'availability' => 'https://schema.org/InStock',
            ];
            if (!empty($price)) {
                $offers['price'] = self::cleanSchemaString($price);
            }
            if (!empty($priceRange)) {
                $offers['description'] = self::cleanSchemaString($priceRange);
            }
            $service['offers'] = $offers;
        }

        // Terms of Service: Ưu tiên từ bài viết -> Template Schema Settings
        $terms = !empty($schemaData['terms']) ? $schemaData['terms'] : $this->getVal('schema_service_default_terms');
        if (!empty($terms)) {
            $service['termsOfService'] = self::cleanSchemaString($terms);
        }

        if ($post->thumbnail) {
            $imageUrl = $post->thumbnail_url;
            if (str_starts_with($imageUrl, 'http://') && str_contains($imageUrl, 'truyenthongcuulong.com')) {
                $imageUrl = preg_replace('#^http://#', 'https://', $imageUrl);
            }
            $service['image'] = [
                '@type' => 'ImageObject',
                '@id' => $currentUrl . '#primaryimage',
                'url' => $imageUrl,
                'caption' => $name,
            ];
        }

        return $service;
    }

    /**
     * Render HTML <script type="application/ld+json"> tag (Lỗi 1 Fix).
     * Strictly produces ONE SINGLE <script> tag for the entire page's unified @graph.
     */
    public function renderGraph(?string $title = null, ?string $url = null, ?\App\Models\Post $post = null): string
    {
        $isHome = request()->routeIs('home');
        if (empty($title) && View::hasSection('title')) {
            $title = trim(strip_tags((string) View::yieldContent('title')));
        }
        $data = $this->getGraphArray($title, $url, $isHome, $post);
        $json = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
        
        $html = "<!-- Schema JSON-LD Unified Knowledge Graph: Compliant with Google Rich Results & E-E-A-T -->\n";
        $html .= "<script type=\"application/ld+json\">\n" . $json . "\n</script>";

        return $html;
    }
}
