<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\CaseStudy;

class NewCaseStudiesConsistencyTest extends TestCase
{
    public function test_all_new_and_updated_case_studies_exist_and_render_correctly(): void
    {
        $expectedProjects = [
            'ung-dung-quan-ly-phong-kham' => [
                'client' => 'Phòng Khám Gia Phước',
                'tech' => 'PHP, Laravel, React, Node.js, MySQL, REST API',
            ],
            'website-phong-kham-da-khoa' => [
                'client' => 'Nha Khoa Nụ Cười',
                'tech' => 'WordPress, PHP, MySQL, Technical SEO, Schema Y Khoa',
            ],
            'website-dakhoacantho' => [
                'client' => 'Đa Khoa Cần Thơ (dakhoacantho)',
                'tech' => 'PHP, Laravel, MySQL, REST API, Blade, Tailwind CSS',
            ],
            'website-da-khoa-gia-phuoc' => [
                'client' => 'Đa Khoa Gia Phước',
                'tech' => 'WordPress, PHP, MySQL, Technical SEO',
            ],
            'website-phong-kham-gia-phuoc' => [
                'client' => 'Phòng Khám Gia Phước',
                'tech' => 'WordPress, PHP, MySQL',
            ],
            'website-tieu-dao-tu' => [
                'client' => 'Tiêu Dao Tử',
                'tech' => 'WordPress, PHP, MySQL, Advanced SEO',
            ],
            'website-tui-la-nguoi-mien-tay' => [
                'client' => 'Tui Là Người Miền Tây',
                'tech' => 'WordPress, PHP, MySQL, Caching System',
            ],
        ];

        foreach ($expectedProjects as $slug => $data) {
            $case = CaseStudy::where('slug', $slug)->first();
            $this->assertNotNull($case, "Case study with slug '{$slug}' must exist in database.");
            $this->assertEquals($data['client'], $case->client_name);
            $this->assertEquals($data['tech'], $case->tech_stack);

            $response = $this->get('/du-an/' . $slug);
            $response->assertStatus(200);
            $response->assertSee($case->title);
            $response->assertSee($data['client']);
        }
    }

    public function test_web_app_page_renders_accurate_technologies(): void
    {
        $response = $this->get('/dich-vu/web-app');
        $response->assertStatus(200);
        $html = $response->getContent();

        // Card 1 must have React, Node.js
        $this->assertStringContainsString('React, Node.js', $html);

        // Card 2 must have WordPress, PHP, MySQL
        $this->assertStringContainsString('WordPress, PHP, MySQL', $html);

        // Both cards must not share duplicate fallback text
        $this->assertStringContainsString('Nha Khoa Nụ Cười', $html);
        $this->assertStringContainsString('Phòng Khám Gia Phước', $html);
    }
}
