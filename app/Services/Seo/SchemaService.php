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
            'schema_org_url' => config('app.url', 'https://truyenthongcuulong.com'),
            'schema_org_logo' => 'https://truyenthongcuulong.com/images/logo-ttcl.png',
            'schema_org_email' => 'truyenthongcuulong@gmail.com',
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
     * Build Organization / Local Business Schema
     */
    public function getOrganizationSchema(): array
    {
        $baseUrl = rtrim($this->getVal('schema_org_url', config('app.url', 'https://truyenthongcuulong.com')), '/');
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
            'email' => $this->getVal('schema_org_email', 'truyenthongcuulong@gmail.com'),
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
        $baseUrl = rtrim($this->getVal('schema_org_url', config('app.url', 'https://truyenthongcuulong.com')), '/');
        
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
     * Build WebPage Schema
     */
    public function getWebPageSchema(?string $title = null, ?string $url = null, bool $isHome = false): array
    {
        $baseUrl = rtrim($this->getVal('schema_org_url', config('app.url', 'https://truyenthongcuulong.com')), '/');
        $currentUrl = $url ?: url()->current();
        $pageTitle = $title ?: trim((string) View::yieldContent('title', 'Truyền Thông Cửu Long - Giải pháp Công nghệ & Truyền thông'));
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

        if ($isHome && $this->getVal('schema_enable_breadcrumb', '1') == '1') {
            $webpage['breadcrumb'] = [
                '@id' => $baseUrl . '/#breadcrumb',
            ];
        }

        return $webpage;
    }

    /**
     * Build Home BreadcrumbList Schema
     */
    public function getHomeBreadcrumbSchema(): array
    {
        $baseUrl = rtrim($this->getVal('schema_org_url', config('app.url', 'https://truyenthongcuulong.com')), '/');
        return [
            '@type' => 'BreadcrumbList',
            '@id' => $baseUrl . '/#breadcrumb',
            'itemListElement' => [
                [
                    '@type' => 'ListItem',
                    'position' => 1,
                    'name' => 'Trang chủ',
                    'item' => $baseUrl,
                ],
            ],
        ];
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
        // Kiểm tra chế độ tự chỉnh sửa toàn bộ file JSON thủ công
        $useOverride = (string) $this->getVal('schema_use_manual_override', '0');
        if ($useOverride === '1' || $useOverride === 'true') {
            $manualJson = trim((string) $this->getVal('schema_manual_override_json', ''));
            if (!empty($manualJson)) {
                $decoded = json_decode($manualJson, true);
                if (is_array($decoded)) {
                    return $decoded;
                }
            }
        }

        $graph = [
            $this->getOrganizationSchema(),
            $this->getWebSiteSchema(),
            $this->getWebPageSchema($title, $url, $isHome),
        ];

        if ($isHome && $this->getVal('schema_enable_breadcrumb', '1') == '1') {
            $graph[] = $this->getHomeBreadcrumbSchema();
        }

        // Custom JSON-LD if provided and valid JSON
        $customJson = trim((string) $this->getVal('schema_custom_jsonld', ''));
        if (!empty($customJson)) {
            $decoded = json_decode($customJson, true);
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
     * Render HTML <script type="application/ld+json"> tag
     */
    public function renderGraph(?string $title = null, ?string $url = null): string
    {
        $isHome = request()->routeIs('home');
        $data = $this->getGraphArray($title, $url, $isHome);
        $json = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
        
        $html = "<!-- Schema JSON-LD Graph: Generated dynamically via Rank Math Schema Manager -->\n";
        $html .= "<script type=\"application/ld+json\">\n" . $json . "\n</script>";

        return $html;
    }
}
