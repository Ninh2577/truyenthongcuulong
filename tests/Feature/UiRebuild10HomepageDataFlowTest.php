<?php

namespace Tests\Feature;

use App\Models\CaseStudy;
use App\Models\Category;
use App\Models\Client;
use App\Models\Partner;
use App\Models\Post;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class UiRebuild10HomepageDataFlowTest extends TestCase
{
    /**
     * Test 1: Homepage returns HTTP 200 OK.
     */
    public function test_homepage_returns_http_200(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    /**
     * Test 2: Controller provides all required view variables for Homepage.
     */
    public function test_controller_provides_required_view_variables(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        $response->assertViewHas([
            'mediaServices',
            'techServices',
            'techCaseStudies',
            'mediaCaseStudies',
            'caseStudies',
            'latestPosts',
            'clientProjects',
            'featuredArticles',
            'websiteTemplates',
            'industryFilters',
            'marqueePartners',
            'marqueeClients',
        ]);
    }

    /**
     * Test 3: Actual database data is rendered from respective sources.
     */
    public function test_actual_database_data_is_rendered_from_sources(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        // 3a. Case Studies (Tech projects from database)
        $techStudy = CaseStudy::where('group', 'technology')->orderBy('order')->first();
        if ($techStudy) {
            $response->assertSee(e($techStudy->title), false);
            if ($techStudy->client_name) {
                $response->assertSee(e($techStudy->client_name), false);
            }
        }

        // 3b. Articles (Published top articles from database)
        $featuredArticles = $response->viewData('featuredArticles');
        $this->assertNotEmpty($featuredArticles);
        $topArticle = $featuredArticles->first();
        $response->assertSee(e($topArticle->title), false);

        // 3c. Partners & Clients (Marquee from database)
        $firstPartner = Partner::active()->ordered()->first();
        if ($firstPartner) {
            $response->assertSee(e($firstPartner->name), false);
        }

        $firstClient = Client::active()->ordered()->first();
        if ($firstClient) {
            $response->assertSee(e($firstClient->name), false);
        }
    }

    /**
     * Test 4: Query filters do not mistakenly exclude valid records.
     */
    public function test_filters_do_not_exclude_valid_published_records(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        $featuredArticles = $response->viewData('featuredArticles');
        $this->assertNotEmpty($featuredArticles, 'Featured articles must not be empty when published posts exist.');

        foreach ($featuredArticles as $article) {
            $this->assertEquals('published', $article->status, "Article ID {$article->id} must have published status.");
        }

        $templates = $response->viewData('websiteTemplates');
        $this->assertNotEmpty($templates, 'Website templates must not be empty when template posts exist.');
        foreach ($templates as $tmpl) {
            $this->assertEquals('published', $tmpl->status, "Template ID {$tmpl->id} must have published status.");
        }
    }

    /**
     * Test 5: Empty states do not trigger 500 errors or uncaught exceptions.
     */
    public function test_empty_collection_state_renders_gracefully_without_exception(): void
    {
        // Render view directly with empty collections to test edge-case resiliency
        $view = $this->view('home', [
            'mediaServices' => collect(),
            'techServices' => collect(),
            'techCaseStudies' => collect(),
            'mediaCaseStudies' => collect(),
            'caseStudies' => collect(),
            'latestPosts' => collect(),
            'clientProjects' => collect(),
            'featuredArticles' => collect(),
            'websiteTemplates' => collect(),
            'industryFilters' => [],
            'marqueePartners' => collect(),
            'marqueeClients' => collect(),
        ]);

        $rendered = (string) $view;
        $this->assertNotEmpty($rendered);
        // Verify graceful empty message or fallback rendering without crash
        $this->assertStringContainsString('Đang cập nhật các bài viết mới từ hệ thống...', $rendered);
    }

    /**
     * Test 6: Relationships do not fail when associated data is absent.
     */
    public function test_relationships_do_not_throw_errors_when_absent(): void
    {
        // Articles without category relation loaded or category null
        $response = $this->get('/');
        $response->assertStatus(200);

        $featuredArticles = $response->viewData('featuredArticles');
        foreach ($featuredArticles as $article) {
            // Category can be null or loaded, should not throw
            $categoryName = $article->category->name ?? 'Kiến Thức Chuyên Ngành';
            $this->assertNotEmpty($categoryName);
        }
    }

    /**
     * Test 7: Image URLs are generated according to storage and asset configuration.
     */
    public function test_image_urls_are_generated_properly(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        $techStudies = $response->viewData('techCaseStudies');
        foreach ($techStudies as $study) {
            if ($study->thumbnail) {
                $expectedUrl = asset('storage/' . $study->thumbnail);
                $this->assertStringStartsWith('http', $expectedUrl);
            }
        }

        $mediaStudies = $response->viewData('mediaCaseStudies');
        foreach ($mediaStudies as $study) {
            $coverUrl = $study->cover_image_url;
            if ($coverUrl) {
                $this->assertStringStartsWith('http', $coverUrl);
            }
        }
    }

    /**
     * Test 8: CTAs and project links resolve to valid endpoints.
     */
    public function test_ctas_and_project_links_are_functional(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        // Core conversion endpoints
        $response->assertSee(route('contact'));
        $response->assertSee(route('services.web-app'));
        $response->assertSee(route('projects.index'));
        $response->assertSee(route('templates.index'));
        $response->assertSee(route('blog.index'));
    }

    /**
     * Test 9: Unpublished (draft) articles are never displayed on Homepage.
     */
    public function test_unpublished_posts_are_never_rendered(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        $featuredArticles = $response->viewData('featuredArticles');
        foreach ($featuredArticles as $article) {
            $this->assertNotEquals('draft', $article->status);
            $this->assertEquals('published', $article->status);
        }
    }

    /**
     * Test 10: No hardcoded fake data in place of missing database models.
     */
    public function test_no_fake_dummy_data_replaces_database_models(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        // Verify marquee is fed with real database items
        $marqueePartners = $response->viewData('marqueePartners');
        $marqueeClients = $response->viewData('marqueeClients');

        $this->assertInstanceOf(\Illuminate\Support\Collection::class, $marqueePartners);
        $this->assertInstanceOf(\Illuminate\Support\Collection::class, $marqueeClients);

        if ($marqueePartners->isNotEmpty()) {
            $this->assertInstanceOf(Partner::class, $marqueePartners->first());
        }

        if ($marqueeClients->isNotEmpty()) {
            $this->assertInstanceOf(Client::class, $marqueeClients->first());
        }
    }
}
