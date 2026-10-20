<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Services\Content\ContentSanitizerService;

class ContentSanitizerServiceTest extends TestCase
{
    public function test_cleans_gemini_angular_wrapper_and_citations()
    {
        $dirtyHtml = '
<div class="code-block ng-tns-c126005359-51 ng-animate-disabled ng-trigger ng-trigger-codeBlockRevealAnimation">
  <div class="formatted-code-block-internal-container ng-tns-c126005359-51">
    <div class="animated-opacity ng-tns-c126005359-51"> 
      <div class="container">
        <div class="markdown markdown-main-panel md-content enable-luminous-fast-follows enable-updated-hr-color">
          <p>Nội dung bài viết chuẩn SEO.</p>
        </div>
      </div>
    </div>
  </div>
</div>
<p>Đoạn văn có chứa trích dẫn <span class="citation-89 citation-end-89">nguồn bài viết</span> và <span class="citation-88 citation-end-88"></span>.</p>
';

        $cleaned = ContentSanitizerService::clean($dirtyHtml);

        // Đảm bảo không còn bất kỳ class nào của Angular / Gemini
        $this->assertStringNotContainsString('ng-tns-', $cleaned);
        $this->assertStringNotContainsString('ng-animate', $cleaned);
        $this->assertStringNotContainsString('ng-trigger', $cleaned);
        $this->assertStringNotContainsString('markdown-main-panel', $cleaned);
        $this->assertStringNotContainsString('enable-luminous-fast-follows', $cleaned);
        $this->assertStringNotContainsString('formatted-code-block-internal-container', $cleaned);
        $this->assertStringNotContainsString('citation-89', $cleaned);
        $this->assertStringNotContainsString('citation-end-89', $cleaned);
        $this->assertStringNotContainsString('citation-88', $cleaned);

        // Đảm bảo nội dung thực tế vẫn được giữ nguyên vẹn
        $this->assertStringContainsString('Nội dung bài viết chuẩn SEO.', $cleaned);
        $this->assertStringContainsString('nguồn bài viết', $cleaned);
    }

    public function test_cleans_chatgpt_and_claude_classes()
    {
        $dirtyHtml = '<div class="conversation-turn"><div class="markdown prose prose-invert dark:bg-gray-950 text-token-text-primary"><p class="font-claude-message">Nội dung từ ChatGPT và Claude.</p></div></div>';

        $cleaned = ContentSanitizerService::clean($dirtyHtml);

        $this->assertStringNotContainsString('conversation-turn', $cleaned);
        $this->assertStringNotContainsString('prose-invert', $cleaned);
        $this->assertStringNotContainsString('dark:bg-gray-950', $cleaned);
        $this->assertStringNotContainsString('text-token-text-primary', $cleaned);
        $this->assertStringNotContainsString('font-claude-message', $cleaned);
        $this->assertStringContainsString('Nội dung từ ChatGPT và Claude.', $cleaned);
    }
}
