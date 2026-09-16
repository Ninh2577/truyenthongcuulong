<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Services\ArticleEditorialFormatter;

class ArticleEditorialFormatterTest extends TestCase
{
    public function test_standard_listicle_html_is_parsed_correctly()
    {
        $html = '
            <h3>1. Trò chơi Kéo co</h3>
            <p><strong>Số lượng:</strong> 20 người</p>
            <p><b>Đạo cụ:</b> 1 sợi dây thừng</p>
            <p>Luật chơi: Kéo qua vạch</p>
            <p><strong>Mẹo tổ chức:</strong> Nên có trọng tài</p>
        ';

        $result = ArticleEditorialFormatter::format($html);
        $content = $result['content'];

        $this->assertStringContainsString('editorial-list-card', $content);
        $this->assertStringContainsString('highlight-box', $content);
        $this->assertStringContainsString('<svg', $content); // Icons injected
    }

    public function test_missing_keyword_html_is_not_wrapped()
    {
        $html = '
            <h3>2. Trò chơi Chạy tiếp sức</h3>
            <p><strong>Số lượng:</strong> 20 người</p>
            <p>Luật chơi: Chạy nhanh</p>
        '; // Missing "Đạo cụ"

        $result = ArticleEditorialFormatter::format($html);
        $content = $result['content'];

        $this->assertStringNotContainsString('editorial-list-card', $content);
    }

    public function test_broken_html_does_not_crash_and_returns_gracefully()
    {
        $html = '
            <h3>3. Trò chơi Lỗi thẻ <p><strong>Số lượng:</strong> 20 người</p>
            <b>Đạo cụ:</b> dây</p>
            Luật chơi:</h3> kéo
        ';

        $result = ArticleEditorialFormatter::format($html);
        $content = $result['content'];

        $this->assertNotEmpty($content);
    }

    public function test_standard_article_does_not_get_listicle_formatting()
    {
        $html = '
            <h3>Giới thiệu</h3>
            <p>Đây là bài viết bình thường, không có các keyword của trò chơi.</p>
        ';

        $result = ArticleEditorialFormatter::format($html);
        $content = $result['content'];

        $this->assertStringNotContainsString('editorial-list-card', $content);
        $this->assertStringContainsString('<h3 id="section-1">Giới thiệu</h3>', $content);
    }

    public function test_contextual_cta_is_parsed_correctly_preserving_link_attributes()
    {
        $html = '
            <p>[CTA] <a href="https://example.com/dich-vu" target="_blank" rel="noopener noreferrer">Xem thêm dịch vụ Team Building</a></p>
            <p>[cta]<a href="/internal">Link nội bộ</a></p>
            <blockquote><p>[CTA] <a href="#">Trong quote không parse</a></p></blockquote>
        ';

        $result = ArticleEditorialFormatter::format($html);
        $content = $result['content'];

        // Kiểm tra parse thành công và giữ nguyên thuộc tính
        $this->assertStringContainsString('<a href="https://example.com/dich-vu"', $content);
        $this->assertStringContainsString('target="_blank"', $content);
        $this->assertStringContainsString('rel="noopener noreferrer"', $content);
        $this->assertStringContainsString('aria-hidden="true"', $content); // SVG icon
        $this->assertStringContainsString('Xem thêm dịch vụ Team Building', $content);

        // Kiểm tra thẻ p thứ 2 (case-insensitive [cta])
        $this->assertStringContainsString('<a href="/internal"', $content);
        $this->assertStringContainsString('Link nội bộ', $content);

        // Kiểm tra blockquote không bị ảnh hưởng (p không phải cấp cha ngoài cùng)
        $this->assertStringContainsString('<blockquote><p>[CTA] <a href="#">Trong quote không parse</a></p></blockquote>', $content);
    }
}
