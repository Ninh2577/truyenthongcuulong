<?php

namespace App\Services\Content;

use DOMDocument;
use DOMXPath;

class ContentSanitizerService
{
    /**
     * Tự động lọc sạch 100% mã rác sinh ra từ việc copy-paste từ chatbot/AI
     * (Google Gemini, ChatGPT, Claude, Copilot, Perplexity, v.v...)
     * 
     * Loại bỏ triệt để:
     * - Các thẻ trích dẫn AI: <span class="citation-89 citation-end-89"> (giữ lại nội dung văn bản)
     * - Các class Angular nội bộ: ng-tns-*, ng-trigger-*, ng-animate-*, ng-star-inserted
     * - Các thuộc tính framework: ng-*, _ngcontent-*, _nghost-*, data-message-*
     * - Các container AI: markdown-main-panel, formatted-code-block-internal-container, enable-luminous-fast-follows, enable-updated-hr-color
     * - Các class token của ChatGPT: text-token-*, bg-token-*, conversation-turn
     * - Bóc tách (unwrap) các thẻ <div> bọc rác dư thừa, trả về cấu trúc HTML ngữ nghĩa sạch (H2, H3, P, Table, List, Img)
     *
     * @param string|null $html
     * @return string|null
     */
    public static function clean(?string $html): ?string
    {
        if ($html === null || trim($html) === '') {
            return $html;
        }

        $cleaned = $html;

        // 1. Loại bỏ các nút bấm copy mã, thanh công cụ AI đi kèm code block
        $cleaned = preg_replace('/<button[^>]*class="[^"]*(?:copy-code-button|copy-button|copy-to-clipboard)[^"]*"[^>]*>.*?<\/button>/is', '', $cleaned);
        $cleaned = preg_replace('/<div[^>]*class="[^"]*(?:code-block-action-bar|code-block-decoration)[^"]*"[^>]*>.*?<\/div>/is', '', $cleaned);

        // 2. Xóa bỏ thẻ span trích dẫn AI (giữ nguyên văn bản bên trong, chỉ bỏ thẻ span citation)
        // Ví dụ: <span class="citation-89 citation-end-89">Nội dung</span> -> Nội dung
        // Hoặc các thẻ citation rỗng: <span class="citation-89 citation-end-89"></span> -> xóa sạch
        $cleaned = preg_replace('/<span[^>]*class="[^"]*citation(?:-\d+|-[a-z0-9_-]+)?[^"]*"[^>]*>\s*<\/span>/is', '', $cleaned);
        $cleaned = preg_replace('/<span[^>]*class="[^"]*citation(?:-\d+|-[a-z0-9_-]+)?[^"]*"[^>]*>(.*?)<\/span>/is', '$1', $cleaned);

        // 3. Loại bỏ thuộc tính nội bộ của Angular và Chatbot DOM:
        // ng-*, _ngcontent-*, _nghost-*, data-message-*, data-testid
        $cleaned = preg_replace('/\s+(?:ng-[a-zA-Z0-9_\-]+|_ngcontent-[a-zA-Z0-9_\-]+|_nghost-[a-zA-Z0-9_\-]+|data-message-[a-zA-Z0-9_\-]+|data-testid)="[^"]*"/i', '', $cleaned);
        $cleaned = preg_replace('/\s+ng-[a-zA-Z0-9_\-]+\b/i', '', $cleaned);

        // 4. Loại bỏ các class AI đặc thù bên trong class="..."
        $aiClassPatterns = [
            'ng-tns-[a-zA-Z0-9_\-]+',
            'ng-animate-[a-zA-Z0-9_\-]+',
            'ng-trigger-[a-zA-Z0-9_\-]+',
            'ng-trigger',
            'ng-star-inserted',
            'markdown-main-panel',
            'md-content',
            'enable-luminous-fast-follows',
            'enable-updated-hr-color',
            'formatted-code-block-internal-container',
            'animated-opacity',
            'code-block',
            'code-block-internal-container',
            'text-token-[a-zA-Z0-9_\-]+',
            'bg-token-[a-zA-Z0-9_\-]+',
            'font-claude-[a-zA-Z0-9_\-]+',
            'claude-user-message',
            'dark:bg-[a-zA-Z0-9_\-]+',
            'contain-inline-size',
            'prose-invert',
            'conversation-turn',
            'attribution-item',
        ];

        $cleaned = preg_replace_callback('/\bclass="([^"]*)"/i', function ($matches) use ($aiClassPatterns) {
            $classes = preg_split('/\s+/', trim($matches[1]));
            $filtered = array_filter($classes, function ($cls) use ($aiClassPatterns) {
                if (empty($cls)) return false;
                foreach ($aiClassPatterns as $pattern) {
                    if (preg_match('/^' . $pattern . '$/i', $cls)) {
                        return false;
                    }
                }
                return true;
            });

            if (empty($filtered)) {
                return ''; // Xóa hoàn toàn thuộc tính class nếu đã rỗng
            }
            return 'class="' . implode(' ', $filtered) . '"';
        }, $cleaned);

        // Xóa thuộc tính class rỗng dư thừa
        $cleaned = preg_replace('/\s+class=["\']\s*["\']/i', '', $cleaned);

        // 5. Bóc tách các thẻ div bao bọc vô nghĩa sinh ra bởi giao diện chatbot (Gemini / Claude / ChatGPT)
        try {
            $cleaned = self::unwrapRedundantAiDivs($cleaned);
        } catch (\Throwable $e) {
            $cleaned = self::regexUnwrapDivs($cleaned);
        }

        // 6. Chuẩn hóa khoảng trắng trong các thẻ HTML (ví dụ: <div  > thành <div>)
        $cleaned = preg_replace('/<([a-z0-9]+)\s+>/i', '<$1>', $cleaned);

        return trim($cleaned);
    }

    /**
     * Bóc tách (unwrap) các thẻ <div> rỗng thuộc tính hoặc chỉ có class container/markdown do AI sinh ra
     */
    private static function unwrapRedundantAiDivs(string $html): string
    {
        libxml_use_internal_errors(true);
        $dom = new DOMDocument();
        $wrapperId = 'cuulong-cleaner-' . bin2hex(random_bytes(4));
        $meta = '<meta http-equiv="Content-Type" content="text/html; charset=utf-8">';
        $dom->loadHTML($meta . '<div id="' . $wrapperId . '">' . $html . '</div>', LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        libxml_clear_errors();

        $xpath = new DOMXPath($dom);
        $root = $xpath->query('//*[@id="' . $wrapperId . '"]')->item(0);

        if (!$root) {
            return $html;
        }

        // Duyệt tối đa 5 lần để unwrap các thẻ div lồng nhau đa tầng
        for ($i = 0; $i < 5; $i++) {
            $divs = $xpath->query('.//div', $root);
            $changed = false;

            foreach ($divs as $div) {
                $class = trim($div->getAttribute('class'));
                $id = trim($div->getAttribute('id'));
                $style = trim($div->getAttribute('style'));

                // Nếu thẻ div không có id, style và class rỗng hoặc là container/markdown vô nghĩa
                $isAiWrapper = empty($id) && empty($style) && ($class === '' || $class === 'container' || $class === 'markdown');

                if ($isAiWrapper) {
                    $parent = $div->parentNode;
                    while ($div->firstChild) {
                        $parent->insertBefore($div->firstChild, $div);
                    }
                    $parent->removeChild($div);
                    $changed = true;
                }
            }

            if (!$changed) {
                break;
            }
        }

        $result = '';
        foreach ($root->childNodes as $child) {
            $result .= $dom->saveHTML($child);
        }

        return $result ?: $html;
    }

    /**
     * Phương án dự phòng dùng Regex unwrap khi DOMDocument gặp lỗi cú pháp
     */
    private static function regexUnwrapDivs(string $html): string
    {
        for ($i = 0; $i < 3; $i++) {
            $html = preg_replace('/<div>\s*(<(?:p|h[1-6]|ul|ol|table|blockquote|pre)[^>]*>.*?<\/(?:p|h[1-6]|ul|ol|table|blockquote|pre)>)\s*<\/div>/is', '$1', $html);
        }
        return $html;
    }
}
