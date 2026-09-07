<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Post;
use App\Models\Redirect;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ImportLegacyWordPressCommand extends Command
{
    protected $signature = 'app:import-legacy-wp';
    protected $description = 'Import categories, posts, inline images and redirects from legacy WordPress database';

    public function handle(): int
    {
        $this->info('=====================================================');
        $this->info('Starting Legacy WordPress Import for Truyền Thông Cửu Long');
        $this->info('=====================================================');

        $wp = DB::connection('wordpress_legacy');
        $sourceUploads = base_path('legacy_assets/uploads');
        $targetUploads = storage_path('app/public/uploads');
        File::ensureDirectoryExists($targetUploads);

        // ---------------------------------------------------------
        // 1. IMPORT & MAPPING CATEGORIES
        // ---------------------------------------------------------
        $this->info('1. Creating structured Parent Categories & Mapping...');

        $parentMedia = Category::firstOrCreate(
            ['slug' => 'truyen-thong'],
            ['name' => 'Truyền Thông & Sáng Tạo', 'type' => 'media', 'order' => 1]
        );
        $parentTech = Category::firstOrCreate(
            ['slug' => 'cong-nghe-giai-phap'],
            ['name' => 'Công Nghệ & Giải Pháp', 'type' => 'technology', 'order' => 2]
        );
        $parentKnowledge = Category::firstOrCreate(
            ['slug' => 'kien-thuc-tin-tuc'],
            ['name' => 'Kiến Thức & Tin Tức', 'type' => 'general', 'order' => 3]
        );
        $parentResources = Category::firstOrCreate(
            ['slug' => 'tai-nguyen-tuyen-dung'],
            ['name' => 'Tài Nguyên & Tuyển Dụng', 'type' => 'general', 'order' => 4]
        );

        $wpTerms = $wp->table('terms as t')
            ->join('term_taxonomy as tt', 't.term_id', '=', 'tt.term_id')
            ->where('tt.taxonomy', 'category')
            ->select('t.term_id', 't.name', 't.slug', 'tt.description', 'tt.count')
            ->get();

        $categoryMap = []; // old_term_id => new_category_id

        foreach ($wpTerms as $term) {
            $slug = Str::slug($term->slug ?: $term->name);
            $cleanName = html_entity_decode($term->name, ENT_QUOTES | ENT_HTML5, 'UTF-8');

            $parentId = $parentKnowledge->id;
            $type = 'general';

            if (in_array($slug, ['media', 'social-media', 'socical-media', 'marketing-online', 'tu-van-marketing', 'quang-cao'])) {
                $parentId = $parentMedia->id;
                $type = 'media';
            } elseif (in_array($slug, ['website-seo', 'template-website', 'thiet-ke-website', 'cong-nghe'])) {
                $parentId = $parentTech->id;
                $type = 'technology';
            } elseif (in_array($slug, ['download-center', 'abc', 'tuyen-dung'])) {
                $parentId = $parentResources->id;
                $type = 'general';
            }

            $cat = Category::firstOrCreate(
                ['slug' => $slug],
                [
                    'name' => $cleanName,
                    'parent_id' => $parentId,
                    'type' => $type,
                    'description' => $term->description ?: null,
                    'order' => 10,
                ]
            );

            $categoryMap[$term->term_id] = $cat->id;
        }
        $this->info("✓ Mapped and created " . count($categoryMap) . " categories.");

        // ---------------------------------------------------------
        // 2. FETCH ATTACHMENTS (THUMBNAILS MAPPING)
        // ---------------------------------------------------------
        $this->info('2. Pre-loading attachments & thumbnails metadata...');
        $attachments = $wp->table('posts')
            ->where('post_type', 'attachment')
            ->select('ID', 'guid')
            ->pluck('guid', 'ID');

        $attachmentFiles = $wp->table('postmeta')
            ->where('meta_key', '_wp_attached_file')
            ->pluck('meta_value', 'post_id');

        // ---------------------------------------------------------
        // 3. FETCH RANK MATH METADATA
        // ---------------------------------------------------------
        $rankTitles = $wp->table('postmeta')
            ->where('meta_key', 'rank_math_title')
            ->pluck('meta_value', 'post_id');
        $rankDescs = $wp->table('postmeta')
            ->where('meta_key', 'rank_math_description')
            ->pluck('meta_value', 'post_id');
        $thumbMetas = $wp->table('postmeta')
            ->where('meta_key', '_thumbnail_id')
            ->pluck('meta_value', 'post_id');

        // ---------------------------------------------------------
        // 4. IMPORT POSTS & PROCESS INLINE IMAGES & REDIRECTS
        // ---------------------------------------------------------
        $this->info('3. Importing published posts & inline assets...');

        $wpPosts = $wp->table('posts')
            ->where('post_status', 'publish')
            ->where('post_type', 'post')
            ->orderBy('ID', 'asc')
            ->get();

        $postTermRels = $wp->table('term_relationships as tr')
            ->join('term_taxonomy as tt', 'tr.term_taxonomy_id', '=', 'tt.term_taxonomy_id')
            ->where('tt.taxonomy', 'category')
            ->select('tr.object_id', 'tt.term_id')
            ->get()
            ->groupBy('object_id');

        $importedCount = 0;
        $copiedImagesCount = 0;
        $redirectsCount = 0;

        foreach ($wpPosts as $wpPost) {
            $postId = $wpPost->ID;

            // Map category
            $newCategoryId = null;
            if (isset($postTermRels[$postId]) && count($postTermRels[$postId]) > 0) {
                $oldTermId = $postTermRels[$postId]->first()->term_id;
                $newCategoryId = $categoryMap[$oldTermId] ?? null;
            }

            // Map thumbnail
            $thumbnailPath = null;
            if (isset($thumbMetas[$postId])) {
                $thumbId = $thumbMetas[$postId];
                $relFile = $attachmentFiles[$thumbId] ?? null;
                if ($relFile) {
                    $srcFile = $sourceUploads . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $relFile);
                    if (File::exists($srcFile)) {
                        $destFile = $targetUploads . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $relFile);
                        File::ensureDirectoryExists(dirname($destFile));
                        if (!File::exists($destFile)) {
                            File::copy($srcFile, $destFile);
                            $copiedImagesCount++;
                        }
                        $thumbnailPath = 'uploads/' . str_replace('\\', '/', $relFile);
                    }
                }
            }

            // Process inline images in content
            $content = $wpPost->post_content;
            if ($content) {
                // Regex find all img src
                $content = preg_replace_callback('/(https?:\/\/[^\/"]+)?\/wp-content\/uploads\/([a-zA-Z0-9_\-\.\/]+)/i', function ($matches) use ($sourceUploads, $targetUploads, &$copiedImagesCount) {
                    $relImgPath = $matches[2];
                    $srcImg = $sourceUploads . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $relImgPath);
                    if (File::exists($srcImg)) {
                        $destImg = $targetUploads . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $relImgPath);
                        File::ensureDirectoryExists(dirname($destImg));
                        if (!File::exists($destImg)) {
                            File::copy($srcImg, $destImg);
                            $copiedImagesCount++;
                        }
                    }
                    return '/storage/uploads/' . $relImgPath;
                }, $content);
            }

            $slug = $wpPost->post_name ?: Str::slug($wpPost->post_title);

            // Ensure unique slug
            $originalSlug = $slug;
            $slugSuffix = 1;
            while (Post::where('slug', $slug)->where('id', '!=', $postId)->exists()) {
                $slug = $originalSlug . '-' . $slugSuffix;
                $slugSuffix++;
            }

            // Extract summary
            $summary = $wpPost->post_excerpt;
            if (!$summary && $content) {
                $summary = Str::limit(strip_tags($content), 200);
            }

            $post = Post::updateOrCreate(
                ['id' => $postId],
                [
                    'category_id' => $newCategoryId,
                    'title' => $wpPost->post_title,
                    'slug' => $slug,
                    'summary' => $summary,
                    'content' => $content,
                    'thumbnail' => $thumbnailPath,
                    'status' => 'published',
                    'editorial_status' => 'keep',
                    'published_at' => $wpPost->post_date,
                    'meta_title' => $rankTitles[$postId] ?? null,
                    'meta_description' => $rankDescs[$postId] ?? null,
                ]
            );

            // -----------------------------------------------------
            // 5. REGISTER 301 REDIRECTS
            // -----------------------------------------------------
            $oldUrls = [
                '/' . $wpPost->post_name . '/',
                '/' . $wpPost->post_name,
            ];
            $newUrl = '/bai-viet/' . $slug;

            foreach ($oldUrls as $oldUrl) {
                Redirect::firstOrCreate(
                    ['old_url' => $oldUrl],
                    [
                        'new_url' => $newUrl,
                        'status_code' => 301,
                        'hits' => 0,
                    ]
                );
                $redirectsCount++;
            }

            $importedCount++;
        }

        $this->info("✓ Successfully imported $importedCount published posts.");
        $this->info("✓ Copied and verified $copiedImagesCount images to storage/app/public/uploads.");
        $this->info("✓ Registered $redirectsCount 301 Redirect rules for SEO preservation.");

        // ---------------------------------------------------------
        // 6. SEED SAMPLE SERVICES & CASE STUDIES FOR AGENCY
        // ---------------------------------------------------------
        $this->info('4. Seeding Core Services & Case Studies for Agency...');
        $this->seedServicesAndCaseStudies();

        $this->info('=====================================================');
        $this->info('IMPORT COMPLETED SUCCESSFULLY!');
        $this->info('=====================================================');

        return Command::SUCCESS;
    }

    private function seedServicesAndCaseStudies(): void
    {
        $services = [
            [
                'title' => 'Sản Xuất Video & Media Chuyên Nghiệp',
                'slug' => 'san-xuat-video-media',
                'group' => 'media',
                'icon' => 'video',
                'summary' => 'Sản xuất TVC, phim doanh nghiệp, Travel video, Wedding clip & video quảng cáo đa nền tảng.',
                'content' => 'Truyền Thông Cửu Long cung cấp giải pháp sản xuất video trọn gói từ kịch bản, tiền kỳ, quay phim với thiết bị 4K/Flycam hiện đại đến hậu kỳ kỹ xảo và âm thanh chuyên nghiệp.',
                'featured' => true,
                'order' => 1,
            ],
            [
                'title' => 'Digital Marketing & Quảng Cáo Đa Kênh',
                'slug' => 'digital-marketing-quang-cao',
                'group' => 'media',
                'icon' => 'megaphone',
                'summary' => 'Chiến dịch Facebook Ads, Google Ads, TikTok Ads tối ưu chuyển đổi và gia tăng doanh số.',
                'content' => 'Giải pháp tiếp thị số toàn diện giúp doanh nghiệp tiếp cận đúng đối tượng khách hàng mục tiêu, tối ưu chi phí quảng cáo và đo lường ROI minh bạch.',
                'featured' => true,
                'order' => 2,
            ],
            [
                'title' => 'Thiết Kế Website & Nền Tảng Trực Tuyến',
                'slug' => 'thiet-ke-website-chuyen-nghiep',
                'group' => 'technology',
                'icon' => 'code',
                'summary' => 'Phát triển website chuẩn SEO, tốc độ cao trên nền tảng Laravel, tối ưu trải nghiệm người dùng UI/UX.',
                'content' => 'Xây dựng website doanh nghiệp, cổng thông tin, sàn thương mại điện tử với kiến trúc bảo mật cao cấp, chuẩn Core Web Vitals và giao diện độc quyền.',
                'featured' => true,
                'order' => 3,
            ],
            [
                'title' => 'Tích Hợp Trí Tuệ Nhân Tạo (AI Solutions)',
                'slug' => 'tich-hop-ai-solutions',
                'group' => 'technology',
                'icon' => 'cpu',
                'summary' => 'Tự động hóa truyền thông, Chatbot CSKH thông minh và trợ lý ảo cá nhân hóa doanh nghiệp.',
                'content' => 'Ứng dụng công nghệ LLM và AI hiện đại giúp doanh nghiệp tự động hóa quy trình tư vấn khách hàng 24/7, sinh nội dung tiếp thị tự động và phân tích dữ liệu chuyên sâu.',
                'featured' => true,
                'order' => 4,
            ],
        ];

        foreach ($services as $srv) {
            \App\Models\Service::updateOrCreate(['slug' => $srv['slug']], $srv);
        }

        $caseStudies = [
            [
                'title' => 'Chiến Dịch Video Quảng Bá Du Lịch Miền Tây',
                'slug' => 'quang-ba-du-lich-mien-tay',
                'client_name' => 'Sở Du Lịch & Khách Sạn Đối Tác',
                'group' => 'media',
                'summary' => 'Series video 4K khám phá văn hóa sông nước Cửu Long đạt hơn 2 triệu lượt xem.',
                'year' => '2024',
                'featured' => true,
            ],
            [
                'title' => 'Hệ Thống Quản Trị ERP & Marketing Tự Động',
                'slug' => 'he-thong-erp-marketing-tu-dong',
                'client_name' => 'Tập Đoàn Bán Lẻ & Dịch Vụ',
                'group' => 'technology',
                'summary' => 'Xây dựng nền tảng quản lý đa chi nhánh tích hợp bot AI trả lời tự động.',
                'year' => '2025',
                'featured' => true,
            ],
        ];

        foreach ($caseStudies as $cs) {
            \App\Models\CaseStudy::updateOrCreate(['slug' => $cs['slug']], $cs);
        }
    }
}
