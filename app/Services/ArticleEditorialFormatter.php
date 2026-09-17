<?php

namespace App\Services;

use DOMDocument;
use DOMXPath;
use DOMElement;
use DOMNode;
use Illuminate\Support\Facades\Log;

class ArticleEditorialFormatter
{
    /**
     * SVG Icons for the listicle card
     */
    const ICON_USERS = '<span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-orange-100 text-primary mr-2 shrink-0"><svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/></svg></span>';
    const ICON_BOX = '<span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-orange-100 text-primary mr-2 shrink-0"><svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M21 16.5c0 .38-.21.71-.53.88l-7.9 4.44c-.16.12-.36.18-.57.18-.21 0-.41-.06-.57-.18l-7.9-4.44A.991.991 0 013 16.5v-9c0-.38.21-.71.53-.88l7.9-4.44c.16-.12.36-.18.57-.18.21 0 .41.06.57.18l7.9 4.44c.32.17.53.5.53.88v9zM12 4.15L6.04 7.5 12 10.85l5.96-3.35L12 4.15z"/></svg></span>';
    const ICON_LIST = '<span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-orange-100 text-primary mr-2 shrink-0"><svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M4 6h2v2H4zm0 5h2v2H4zm0 5h2v2H4zm16-8V6H8.02v2H20zm0 5v-2H8v2h12zm0 5v-2H8v2h12z"/></svg></span>';
    const ICON_BULB = '<span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-orange-500 text-white mr-2 shrink-0"><svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M9 21c0 .55.45 1 1 1h4c.55 0 1-.45 1-1v-1H9v1zm3-19C8.14 2 5 5.14 5 9c0 2.38 1.19 4.47 3 5.74V17c0 .55.45 1 1 1h6c.55 0 1-.45 1-1v-2.26c1.81-1.27 3-3.36 3-5.74 0-3.86-3.14-7-7-7zm2.85 11.1l-.85.6V16h-4v-1.3l-.85-.6C7.8 12.16 7 10.63 7 9c0-2.76 2.24-5 5-5s5 2.24 5 5c0 1.63-.8 3.16-2.15 4.1z"/></svg></span>';

    /**
     * Tự động format nội dung bài viết theo chuẩn Editorial Design
     * Bọc các thẻ listicle (H3 + content) thành card, chèn SVG icon, tạo TOC.
     * 
     * @param string|null $html
     * @return array ['content' => string, 'toc' => array]
     */
    public static function format(?string $html): array
    {
        $toc = [];
        if (!$html) {
            return ['content' => '', 'toc' => $toc];
        }

        try {
            libxml_use_internal_errors(true);
            $dom = new DOMDocument();
            // Đảm bảo UTF-8 Encoding cho Tiếng Việt
            $htmlWithMeta = '<meta http-equiv="Content-Type" content="text/html; charset=utf-8"><div>' . $html . '</div>';
            
            // Dùng trick để wrap thành một body, tránh việc DOMDocument thêm các thẻ DOCTYPE hay html/body rác
            $dom->loadHTML($htmlWithMeta, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            libxml_clear_errors();

            $xpath = new DOMXPath($dom);
            
            // 1. Build TOC
            $headings = $xpath->query('//h2 | //h3');
            foreach ($headings as $i => $heading) {
                $level = (int)substr($heading->nodeName, 1);
                $anchor = 'section-' . ($i + 1);
                $heading->setAttribute('id', $anchor);
                $toc[] = [
                    'level' => $level,
                    'title' => trim($heading->textContent),
                    'anchor' => $anchor,
                ];
            }

            // 2. Phân tích & Bọc khối Listicle (H3)
            self::processListicleCards($dom, $xpath);

            // 3. Phân tích H2 (Bí Quyết Tổ Chức)
            self::processSecretStepCard($dom, $xpath);

            // 4. Phân tích Inline Contextual CTA ([CTA])
            self::processContextualCTAs($dom, $xpath);

            // Lấy lại HTML bên trong thẻ <div> root (được bọc ở trên)
            $rootDiv = $dom->getElementsByTagName('div')->item(0);
            $formattedHtml = '';
            if ($rootDiv) {
                foreach ($rootDiv->childNodes as $child) {
                    $formattedHtml .= $dom->saveHTML($child);
                }
            } else {
                $formattedHtml = $html;
            }
            
            return ['content' => $formattedHtml, 'toc' => $toc];
        } catch (\Exception $e) {
            Log::error('ArticleEditorialFormatter error: ' . $e->getMessage());
            // Graceful degradation: trả về HTML gốc và TOC thô (nếu có thể lấy được)
            return ['content' => $html, 'toc' => $toc];
        }
    }

    private static function processListicleCards(DOMDocument $dom, DOMXPath $xpath)
    {
        $h3s = $xpath->query('//h3');
        $cardsToProcess = [];

        // Lọc qua các H3 để tìm những khối đủ điều kiện
        foreach ($h3s as $h3) {
            $siblings = [];
            $node = $h3->nextSibling;
            
            $hasSoLuong = false;
            $hasDaoCu = false;
            $hasLuatChoi = false;
            
            while ($node && !in_array(strtolower($node->nodeName), ['h2', 'h3'])) {
                if ($node->nodeType === XML_ELEMENT_NODE) {
                    $text = $node->textContent;
                    if (preg_match('/^\s*(số lượng)\s*:/ui', $text)) $hasSoLuong = true;
                    if (preg_match('/^\s*(đạo cụ)\s*:/ui', $text)) $hasDaoCu = true;
                    if (preg_match('/^\s*(luật chơi|cách chơi)\s*:/ui', $text)) $hasLuatChoi = true;
                }
                $siblings[] = $node;
                $node = $node->nextSibling;
            }

            // Nếu đủ 3 keywords bắt buộc
            if ($hasSoLuong && $hasDaoCu && $hasLuatChoi) {
                $cardsToProcess[] = [
                    'h3' => $h3,
                    'siblings' => $siblings
                ];
            }
        }

        // Bọc vào editorial-list-card
        foreach ($cardsToProcess as $index => $card) {
            $h3 = $card['h3'];
            $siblings = $card['siblings'];
            
            $wrapper = $dom->createElement('div');
            $wrapper->setAttribute('class', 'editorial-list-card relative bg-slate-50/50 hover:bg-slate-50 rounded-3xl p-6 md:p-8 mb-8 border border-slate-200 shadow-sm transition-colors');
            
            // Xử lý Badge số thứ tự trên H3
            $h3Text = trim($h3->textContent);
            $numberMatch = [];
            if (preg_match('/^(\d+)[.\-]?\s+(.*)$/', $h3Text, $numberMatch)) {
                $number = $numberMatch[1];
                $cleanTitle = $numberMatch[2];
                $h3->textContent = ''; // clear
                
                // Tạo thẻ span chứa Badge
                $badge = $dom->createElement('span', $number);
                $badge->setAttribute('class', 'inline-flex items-center justify-center w-8 h-8 rounded-full bg-primary text-white text-sm font-black mr-3 shadow-md');
                
                $titleText = $dom->createTextNode($cleanTitle);
                
                $h3->appendChild($badge);
                $h3->appendChild($titleText);
                $h3->setAttribute('class', 'flex items-center text-xl md:text-2xl mt-0 mb-5 pb-5 border-b border-slate-200/80');
            } else {
                $h3->setAttribute('class', 'text-xl md:text-2xl mt-0 mb-5 pb-5 border-b border-slate-200/80');
            }

            // Move H3 into wrapper
            $h3->parentNode->insertBefore($wrapper, $h3);
            $wrapper->appendChild($h3);

            // Move siblings into wrapper and inject icons
            foreach ($siblings as $sib) {
                if ($sib->nodeType === XML_ELEMENT_NODE) {
                    $text = $sib->textContent;
                    
                    // Xử lý "Mẹo tổ chức"
                    if (preg_match('/^\s*(mẹo tổ chức|mẹo|lưu ý)\s*:/ui', $text)) {
                        $sib->setAttribute('class', 'highlight-box mt-5 p-4 rounded-xl bg-orange-50 border-l-4 border-primary text-sm font-medium flex items-start text-orange-900');
                        $selfContent = $sib->nodeValue; // Get raw text to replace
                        $sib->nodeValue = ''; // Clear node
                        
                        // Parse injected SVG string using a temp document frag
                        $frag = $dom->createDocumentFragment();
                        $frag->appendXML(self::ICON_BULB . '<span>' . htmlspecialchars($selfContent) . '</span>');
                        $sib->appendChild($frag);
                    } 
                    // Xử lý các keyword còn lại
                    else {
                        $matched = false;
                        $iconStr = '';
                        if (preg_match('/^\s*(số lượng)\s*:/ui', $text)) { $matched = true; $iconStr = self::ICON_USERS; }
                        elseif (preg_match('/^\s*(đạo cụ)\s*:/ui', $text)) { $matched = true; $iconStr = self::ICON_BOX; }
                        elseif (preg_match('/^\s*(luật chơi|cách chơi)\s*:/ui', $text)) { $matched = true; $iconStr = self::ICON_LIST; }
                        
                        if ($matched) {
                            $sib->setAttribute('class', 'flex items-start text-sm md:text-base mb-3 text-slate-700');
                            $rawInnerHtml = self::getInnerHtml($sib);
                            $sib->nodeValue = '';
                            $frag = $dom->createDocumentFragment();
                            $frag->appendXML($iconStr . '<div>' . $rawInnerHtml . '</div>');
                            $sib->appendChild($frag);
                        }
                    }
                }
                $wrapper->appendChild($sib);
            }
        }
    }

    private static function processSecretStepCard(DOMDocument $dom, DOMXPath $xpath)
    {
        // Tùy biến sau nếu cần thiết, ví dụ H2 có chữ "Bí quyết" sẽ được xử lý riêng.
    }

    private static function processContextualCTAs(DOMDocument $dom, DOMXPath $xpath)
    {
        // Lấy thẻ div gốc do ta tự động bọc ở hàm format()
        $rootDiv = $dom->getElementsByTagName('div')->item(0);
        if (!$rootDiv) return;

        // Quét các thẻ <p>
        $paragraphs = $xpath->query('.//p', $rootDiv);

        $arrowSvg = '<svg aria-hidden="true" class="w-5 h-5 ml-2 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>';

        foreach ($paragraphs as $p) {
            // Chỉ xử lý các thẻ <p> là con trực tiếp của thẻ <div> root (để tránh <blockquote> hay <li>)
            if ($p->parentNode === $rootDiv) {
                
                $text = trim($p->textContent);
                // Kiểm tra xem đoạn text có bắt đầu bằng [CTA] hoặc >>> (không phân biệt hoa thường) không
                if (preg_match('/^(\[CTA\]|&gt;&gt;&gt;|>>>)\s*/ui', $text)) {
                    // Kiểm tra xem bên trong <p> có thẻ <a> không
                    $links = $xpath->query('.//a', $p);
                    if ($links->length > 0) {
                        $aNode = $links->item(0);
                        
                        // Lấy các thuộc tính của thẻ <a> gốc
                        $href = $aNode->getAttribute('href');
                        $target = $aNode->hasAttribute('target') ? $aNode->getAttribute('target') : null;
                        $rel = $aNode->hasAttribute('rel') ? $aNode->getAttribute('rel') : null;
                        
                        // Nội dung chữ sạch bên trong thẻ <a> (lấy trực tiếp từ <a> thay vì toàn bộ <p>)
                        $cleanText = trim($aNode->textContent);
                        
                        // Xóa marker [CTA] hoặc >>> bên trong thẻ <a> nếu editor lỡ bôi đen cả marker làm link
                        $cleanText = preg_replace('/^(\[CTA\]|&gt;&gt;&gt;|>>>)\s*/ui', '', $cleanText);

                        // Tạo thẻ <a> mới làm block CTA
                        $ctaBlock = $dom->createElement('a');
                        $ctaBlock->setAttribute('href', $href);
                        if ($target) $ctaBlock->setAttribute('target', $target);
                        if ($rel) $ctaBlock->setAttribute('rel', $rel);

                        $ctaBlock->setAttribute('class', 'group flex items-center justify-between bg-orange-50/80 hover:bg-orange-100/80 border-l-4 border-orange-500 text-orange-700 font-headline font-bold text-[15px] sm:text-base px-5 sm:px-6 py-4 rounded-r-xl transition-all duration-300 shadow-sm hover:shadow my-6 no-underline');

                        // Tạo nội dung bên trong CTA
                        $frag = $dom->createDocumentFragment();
                        $frag->appendXML('<span>' . htmlspecialchars($cleanText) . '</span>' . $arrowSvg);
                        $ctaBlock->appendChild($frag);

                        // Thay thế <p> bằng <a> mới
                        $p->parentNode->replaceChild($ctaBlock, $p);
                    }
                }
            }
        }
    }

    private static function getInnerHtml(DOMNode $node) { 
        $innerHTML = ''; 
        $children = $node->childNodes; 
        foreach ($children as $child) { 
            $innerHTML .= $child->ownerDocument->saveXML($child); 
        } 
        return $innerHTML; 
    } 
}
