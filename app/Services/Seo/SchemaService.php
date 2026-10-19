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

            // Content Type Defaults (Rank Math)
            'schema_default_post_type' => 'Article',
            'schema_default_service_type' => 'Service',
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
    public function getWebPageSchema(?string $title = null, ?string $url = null, bool $isHome = false): array
    {
        $baseUrl = $this->getBaseUrl();
        $currentUrl = $url ?: url()->current();
        if (str_contains($currentUrl, '127.0.0.1') || str_contains($currentUrl, 'localhost')) {
            $currentUrl = preg_replace('#^https?://[^/]+#', $baseUrl, $currentUrl);
        }
        $rawTitle = $title ?: trim((string) View::yieldContent('title', 'Truyền Thông Cửu Long - Giải pháp Công nghệ & Truyền thông'));
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

        if ($this->getVal('schema_enable_breadcrumb', '1') == '1') {
            $webpage['breadcrumb'] = [
                '@id' => ($isHome ? $baseUrl : $currentUrl) . '#breadcrumb',
            ];
        }

        return $webpage;
    }

    /**
     * Build Dynamic BreadcrumbList Schema for any page based on URL hierarchy and models.
     * Compliant with Google Search Console Rich Results standard.
     */
    public function getDynamicBreadcrumbsSchema(?string $title = null, ?string $url = null, bool $isHome = false): array
    {
        $baseUrl = $this->getBaseUrl();
        $currentUrl = $url ?: url()->current();
        if (str_contains($currentUrl, '127.0.0.1') || str_contains($currentUrl, 'localhost')) {
            $currentUrl = preg_replace('#^https?://[^/]+#', $baseUrl, $currentUrl);
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

                // A. TRƯỜNG HỢP 1: BÀI VIẾT (POST)
                $postModel = \App\Models\Post::with('category')->where('slug', $lastSegment)->first();
                if ($postModel) {
                    // 1. Thêm cấp 'Tin tức' làm mục cha nếu chưa có
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
     * Get Complete Graph Array
     */
    public function getGraphArray(?string $title = null, ?string $url = null, bool $isHome = false): array
    {
        // 1. Nếu người dùng BẬT công tắc ghi đè thủ công và có JSON hợp lệ:
        $useOverride = (string) $this->getVal('schema_use_manual_override', '0');
        $manualJson = trim((string) $this->getVal('schema_manual_override_json', ''));

        if (($useOverride === '1' || $useOverride === 'true') && !empty($manualJson)) {
            $cleanedJson = html_entity_decode($manualJson, ENT_QUOTES | ENT_HTML5, 'UTF-8');
            $cleanedJson = str_replace(['\\&quot;', '&quot;'], ['"', '"'], $cleanedJson);
            $decoded = json_decode($cleanedJson, true);
            if (is_array($decoded) && (isset($decoded['@context']) || isset($decoded['@graph']))) {
                // Đảm bảo BreadcrumbList luôn hiện diện nếu bật schema_enable_breadcrumb
                if ($this->getVal('schema_enable_breadcrumb', '1') == '1' && isset($decoded['@graph']) && is_array($decoded['@graph'])) {
                    $hasBreadcrumb = false;
                    foreach ($decoded['@graph'] as &$node) {
                        if (isset($node['@type']) && $node['@type'] === 'BreadcrumbList') {
                            $hasBreadcrumb = true;
                            // Nếu duyệt trang con thực tế, cập nhật BreadcrumbList theo trang hiện tại
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

        $graph = [
            $this->getOrganizationSchema(),
            $this->getWebSiteSchema(),
            $this->getWebPageSchema($title, $url, $isHome),
        ];

        // Dynamic Breadcrumbs on ALL pages (Home, Article, Service, Category, etc.)
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
     */
    public function getArticleSchema(\App\Models\Post $post): array
    {
        $baseUrl = $this->getBaseUrl();
        $currentUrl = url()->current();
        if (str_contains($currentUrl, '127.0.0.1') || str_contains($currentUrl, 'localhost')) {
            $currentUrl = preg_replace('#^https?://[^/]+#', $baseUrl, $currentUrl);
        }

        $headline = self::cleanSchemaString($post->title);
        
        // Raw description from excerpt, meta_description, or summary
        $rawDesc = $post->excerpt ?: ($post->meta_description ?: $post->summary);
        // Clean and convert internal double quotes to single quotes as requested
        $description = self::cleanSchemaString($rawDesc, true);

        $imageUrl = $post->thumbnail ? $post->thumbnail_url : ($baseUrl . '/images/logo-ttcl.png');
        $publishedAt = ($post->published_at ?? $post->created_at)->toIso8601String();
        $modifiedAt = ($post->updated_at ?? $post->published_at ?? $post->created_at)->toIso8601String();

        $categoryName = self::cleanSchemaString($post->category?->name ?? 'Tin tức & Dự án');
        $keywords = self::cleanSchemaString(
            $post->category 
                ? ($post->category->name . ', Thiết kế Website, Lập trình Web App, UI/UX, SEO Tổng Thể, Media Sự Kiện, Truyền Thông Cửu Long')
                : 'Thiết kế Website, Lập trình Web App, Media Sự Kiện, SEO Tổng Thể, Truyền Thông Cửu Long'
        );

        $postType = $this->getVal('schema_default_post_type', 'Article');

        return [
            '@context' => 'https://schema.org',
            '@type' => $postType,
            '@id' => $currentUrl . '#article',
            'isPartOf' => [
                '@id' => $baseUrl . '/#website',
            ],
            'mainEntityOfPage' => [
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
            ],
            'datePublished' => $publishedAt,
            'dateModified' => $modifiedAt,
            'author' => [
                '@type' => 'Organization',
                '@id' => $baseUrl . '/#organization',
                'name' => self::cleanSchemaString($this->getVal('schema_org_name', 'Truyền Thông Cửu Long')),
                'url' => $baseUrl,
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
            'about' => [
                [
                    '@type' => 'Thing',
                    'name' => 'Thiết kế Website Chuẩn SEO & Lập trình Web App',
                ],
                [
                    '@type' => 'Thing',
                    'name' => 'Dịch vụ Media, Quay Phim & Chụp Ảnh Sự Kiện Chuyên Nghiệp',
                ],
            ],
        ];
    }

    /**
     * Render HTML <script type="application/ld+json"> tag
     */
    public function renderGraph(?string $title = null, ?string $url = null): string
    {
        $isHome = request()->routeIs('home');
        if (empty($title) && View::hasSection('title')) {
            $title = trim(strip_tags((string) View::yieldContent('title')));
        }
        $data = $this->getGraphArray($title, $url, $isHome);
        $json = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
        
        $html = "<!-- Schema JSON-LD Graph: Generated dynamically via Rank Math Schema Manager -->\n";
        $html .= "<script type=\"application/ld+json\">\n" . $json . "\n</script>";

        return $html;
    }
}
