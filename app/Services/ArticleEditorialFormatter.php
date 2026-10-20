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

        // Tự động quét và loại bỏ sạch sẽ toàn bộ mã rác/citation của AI trước khi bóc tách format & TOC
        $html = \App\Services\Content\ContentSanitizerService::clean($html);

        try {
            libxml_use_internal_errors(true);
            $dom = new DOMDocument();
            
            // Dùng ID ngẫu nhiên duy nhất cho root div để không bị nhầm lẫn với bất kỳ thẻ div nào bên trong nội dung bài viết
            $wrapperId = 'editorial-root-' . bin2hex(random_bytes(6));
            $htmlWithMeta = '<meta http-equiv="Content-Type" content="text/html; charset=utf-8"><div id="' . $wrapperId . '">' . $html . '</div>';
            
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

            // 5. Tự động thêm rel="nofollow" cho toàn bộ link ngoại bộ
            self::processEditorialLinks($xpath);

            // Lấy lại HTML chính xác từ thẻ wrapper đã đánh dấu ID duy nhất
            $rootNodeList = $xpath->query('//*[@id="' . $wrapperId . '"]');
            $rootDiv = ($rootNodeList && $rootNodeList->length > 0) ? $rootNodeList->item(0) : null;
            $formattedHtml = '';
            if ($rootDiv) {
                foreach ($rootDiv->childNodes as $child) {
                    $formattedHtml .= $dom->saveHTML($child);
                }
            } else {
                $formattedHtml = $html;
            }
            
            // Quét và chuyển đổi toàn bộ link video / embed thành iframe sau cùng (tránh việc DOMDocument làm hỏng thẻ iframe)
            $formattedHtml = self::processVideoEmbeds($formattedHtml);

            return ['content' => $formattedHtml, 'toc' => $toc];
        } catch (\Exception $e) {
            Log::error('ArticleEditorialFormatter error: ' . $e->getMessage());
            // Graceful degradation: trả về HTML sau khi convert video và TOC thô (nếu có)
            return ['content' => self::processVideoEmbeds($html), 'toc' => $toc];
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

    /**
     * Quét và chuyển đổi các link video / shortcode / Gutenberg block thành responsive video embed (YouTube / Vimeo / MP4)
     */
    public static function processVideoEmbeds(?string $html): string
    {
        if (empty($html)) {
            return '';
        }

        // 1. Gutenberg Embed Blocks (Thường sinh ra từ WordPress Gutenberg Editor)
        // Dạng: <figure class="wp-block-embed is-type-video is-provider-youtube ..."><div class="wp-block-embed__wrapper">URL</div></figure>
        $patternGutenberg = '/<figure[^>]*class="[^"]*wp-block-embed[^"]*"[^>]*>.*?<div[^>]*class="[^"]*wp-block-embed__wrapper[^"]*"[^>]*>\s*(https?:\/\/[^\s<]+)\s*<\/div>.*?<\/figure>/is';
        $html = preg_replace_callback($patternGutenberg, function ($matches) {
            return self::renderVideoEmbedHtml(trim($matches[1]));
        }, $html);

        // Bọc lẻ wp-block-embed__wrapper
        $patternGutenbergWrapper = '/<div[^>]*class="[^"]*wp-block-embed__wrapper[^"]*"[^>]*>\s*(https?:\/\/[^\s<]+)\s*<\/div>/is';
        $html = preg_replace_callback($patternGutenbergWrapper, function ($matches) {
            return self::renderVideoEmbedHtml(trim($matches[1]));
        }, $html);

        // 2. Loại bỏ thẻ <p> bọc ngoài [embed]...[/embed] hoặc [video]...[/video]
        $html = preg_replace('/<p[^>]*>\s*(\[(?:embed|video)[^\]]*\].*?\[\/(?:embed|video)\])\s*<\/p>/is', '$1', $html);

        // 3. Chuyển đổi [embed]...[/embed] (hỗ trợ cả [embed width="..." height="..."]URL[/embed])
        $patternEmbed = '/\[embed[^\]]*\]\s*(https?:\/\/[^\s<\]]+)\s*\[\/embed\]/iu';
        $html = preg_replace_callback($patternEmbed, function ($matches) {
            return self::renderVideoEmbedHtml(trim($matches[1]));
        }, $html);

        // 4. Chuyển đổi [video src="..."] hoặc [video]...[/video]
        $patternVideoSrc = '/\[video[^\]]*src=[\'"]([^\'"]+)[\'"][^\]]*\](?:\[\/video\])?/iu';
        $html = preg_replace_callback($patternVideoSrc, function ($matches) {
            return self::renderVideoEmbedHtml(trim($matches[1]));
        }, $html);

        $patternVideoTag = '/\[video[^\]]*\]\s*(https?:\/\/[^\s<\]]+)\s*\[\/video\]/iu';
        $html = preg_replace_callback($patternVideoTag, function ($matches) {
            return self::renderVideoEmbedHtml(trim($matches[1]));
        }, $html);

        // 5. Chuyển đổi link YouTube / Vimeo đứng trong thẻ <p> hoặc <div>
        $patternStandalone = '/<(?:p|div)[^>]*>\s*(?:<a[^>]*href=[\'"][^\'"]+[\'"][^>]*>)?\s*(https?:\/\/(?:www\.|m\.)?(?:youtube\.com\/(?:watch\?[^\s<"\'\)]+|embed\/[^\s<"\'\)]+|shorts\/[^\s<"\'\)]+)|youtu\.be\/[a-zA-Z0-9_-]{11}|player\.vimeo\.com\/video\/\d+|vimeo\.com\/\d+)[^\s<"\'\)]*)\s*(?:<\/a>)?\s*<\/(?:p|div)>/iu';
        $html = preg_replace_callback($patternStandalone, function ($matches) {
            return self::renderVideoEmbedHtml(trim($matches[1]));
        }, $html);

        // 6. Chuyển đổi link YouTube đứng đơn độc sau dòng text hoặc thẻ đóng (VD: </ul>\nhttps://www.youtube.com/...)
        $patternRawLine = '/(?:^|>|\r?\n)\s*(?:<a[^>]*href=[\'"][^\'"]+[\'"][^>]*>)?\s*(https?:\/\/(?:www\.|m\.)?(?:youtube\.com\/(?:watch\?[^\s<"\'\)]+|embed\/[^\s<"\'\)]+|shorts\/[^\s<"\'\)]+)|youtu\.be\/[a-zA-Z0-9_-]{11})[^\s<"\'\)]*)\s*(?:<\/a>)?(?=\s*(?:<|\r?\n|$))/iu';
        $html = preg_replace_callback($patternRawLine, function ($matches) {
            return self::renderVideoEmbedHtml(trim($matches[1]));
        }, $html);

        return $html;
    }

    /**
     * Render HTML iframe responsive 16:9 cho YouTube / Vimeo hoặc video HTML5
     */
    public static function renderVideoEmbedHtml(string $url): string
    {
        // 1. YouTube
        $youtubeId = self::extractYouTubeId($url);
        if ($youtubeId) {
            return '<div class="video-responsive-wrapper my-8 w-full clear-both">' .
                '<div class="video-responsive relative w-full overflow-hidden rounded-2xl shadow-xl bg-slate-950 border border-slate-200/80" style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden;">' .
                '<iframe class="absolute top-0 left-0 w-full h-full border-0" ' .
                'style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: 0;" ' .
                'src="https://www.youtube.com/embed/' . htmlspecialchars($youtubeId, ENT_QUOTES, 'UTF-8') . '?rel=0" ' .
                'width="100%" height="100%" frameborder="0" ' .
                'allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" ' .
                'title="YouTube video player" allowfullscreen></iframe>' .
                '</div></div>';
        }

        // 2. Vimeo
        $vimeoId = self::extractVimeoId($url);
        if ($vimeoId) {
            return '<div class="video-responsive-wrapper my-8 w-full clear-both">' .
                '<div class="video-responsive relative w-full overflow-hidden rounded-2xl shadow-xl bg-slate-950 border border-slate-200/80" style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden;">' .
                '<iframe class="absolute top-0 left-0 w-full h-full border-0" ' .
                'style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: 0;" ' .
                'src="https://player.vimeo.com/video/' . htmlspecialchars($vimeoId, ENT_QUOTES, 'UTF-8') . '" ' .
                'width="100%" height="100%" frameborder="0" ' .
                'allow="autoplay; fullscreen; picture-in-picture" ' .
                'title="Vimeo video player" allowfullscreen></iframe>' .
                '</div></div>';
        }

        // 3. File video MP4/WebM trực tiếp
        $parsedPath = parse_url($url, PHP_URL_PATH) ?? '';
        if (preg_match('/\.(mp4|webm|ogg)$/i', $parsedPath)) {
            return '<div class="video-responsive-wrapper my-8 w-full clear-both">' .
                '<div class="overflow-hidden rounded-2xl shadow-xl bg-slate-950 border border-slate-200/80">' .
                '<video controls class="w-full h-auto rounded-2xl">' .
                '<source src="' . htmlspecialchars($url, ENT_QUOTES, 'UTF-8') . '" type="video/mp4">' .
                'Trình duyệt không hỗ trợ xem video trực tiếp.' .
                '</video></div></div>';
        }

        // 4. Fallback thẻ link trực quan nếu là liên kết ngoài
        return '<div class="video-responsive-wrapper my-6 p-4 rounded-xl bg-orange-50/80 border border-orange-200/80 text-sm flex items-center gap-3">' .
            '<svg class="w-5 h-5 text-orange-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>' .
            '<a href="' . htmlspecialchars($url, ENT_QUOTES, 'UTF-8') . '" target="_blank" rel="noopener noreferrer" class="font-medium text-orange-600 hover:underline break-all">' .
            htmlspecialchars($url, ENT_QUOTES, 'UTF-8') .
            '</a></div>';
    }

    /**
     * Trích xuất YouTube Video ID từ nhiều định dạng URL khác nhau (watch?v=, youtu.be, embed, shorts)
     */
    public static function extractYouTubeId(string $url): ?string
    {
        $url = html_entity_decode(trim($url), ENT_QUOTES | ENT_HTML5, 'UTF-8');
        
        // 1. Phân tích query string (?v=...)
        $parsed = parse_url($url);
        if (isset($parsed['query'])) {
            parse_str($parsed['query'], $queryParams);
            if (!empty($queryParams['v']) && preg_match('/^[a-zA-Z0-9_-]{11}$/', $queryParams['v'])) {
                return $queryParams['v'];
            }
        }

        // 2. youtu.be/{id}
        if (isset($parsed['host']) && in_array(strtolower($parsed['host']), ['youtu.be', 'www.youtu.be'])) {
            $pathId = trim($parsed['path'] ?? '', '/');
            if (preg_match('/^[a-zA-Z0-9_-]{11}$/', $pathId)) {
                return $pathId;
            }
        }

        // 3. /embed/{id}, /shorts/{id}, /v/{id}
        if (isset($parsed['path']) && preg_match('#/(?:embed|shorts|v)/([a-zA-Z0-9_-]{11})#i', $parsed['path'], $m)) {
            return $m[1];
        }

        // 4. Fallback Regex bao quát
        if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?|shorts)/|.*[?&]v=)|youtu\.be/)([a-zA-Z0-9_-]{11})%i', $url, $match)) {
            return $match[1];
        }

        return null;
    }

    /**
     * Trích xuất Vimeo Video ID từ URL
     */
    public static function extractVimeoId(string $url): ?string
    {
        if (preg_match('/(?:vimeo\.com\/(?:channels\/(?:\w+\/)?|groups\/([^\/]*)\/videos\/|album\/(\d+)\/video\/|video\/|)|player\.vimeo\.com\/video\/)(\d+)/i', $url, $match)) {
            return end($match);
        }
        return null;
    }

    private static function getInnerHtml(DOMNode $node) { 
        $innerHTML = ''; 
        $children = $node->childNodes; 
        foreach ($children as $child) { 
            $innerHTML .= $child->ownerDocument->saveXML($child); 
        } 
        return $innerHTML; 
    } 

    /**
     * Xử lý chuẩn hóa thuộc tính liên kết trong nội dung bài viết:
     * - Tự động thêm rel="nofollow noopener noreferrer" và target="_blank" cho tất cả link ngoài (external links).
     * - Bảo toàn link nội bộ (internal links) để tối ưu điểm PageRank SEO cho website.
     */
    private static function processEditorialLinks(DOMXPath $xpath): void
    {
        $links = $xpath->query('//a[@href]');
        if (!$links) return;

        $internalDomains = [
            'truyenthongcuulong.com',
            'www.truyenthongcuulong.com',
            '127.0.0.1',
            'localhost',
        ];

        foreach ($links as $link) {
            /** @var DOMElement $link */
            $href = trim($link->getAttribute('href'));
            if ($href === '' || str_starts_with($href, '#') || str_starts_with($href, 'tel:') || str_starts_with($href, 'mailto:') || str_starts_with($href, 'javascript:')) {
                continue;
            }

            // Kiểm tra link nội bộ hay link ngoài
            $isInternal = false;
            if (str_starts_with($href, '/') && !str_starts_with($href, '//')) {
                $isInternal = true;
            } else {
                $host = parse_url($href, PHP_URL_HOST);
                if (!$host) {
                    $isInternal = true;
                } else {
                    $hostLower = strtolower($host);
                    foreach ($internalDomains as $domain) {
                        if ($hostLower === $domain || str_ends_with($hostLower, '.' . $domain)) {
                            $isInternal = true;
                            break;
                        }
                    }
                }
            }

            $currentRel = trim($link->getAttribute('rel'));
            $relParts = $currentRel !== '' ? preg_split('/\s+/', strtolower($currentRel)) : [];

            if ($isInternal) {
                // Link nội bộ: Thêm class internal-link nếu chưa có
                $currentClass = $link->getAttribute('class');
                if (!str_contains($currentClass, 'internal-link')) {
                    $link->setAttribute('class', trim($currentClass . ' internal-link'));
                }
            } else {
                // Link ngoại bộ: BẮT BUỘC có nofollow và noopener noreferrer
                if (!in_array('nofollow', $relParts)) {
                    $relParts[] = 'nofollow';
                }
                if (!in_array('noopener', $relParts)) {
                    $relParts[] = 'noopener';
                }
                if (!in_array('noreferrer', $relParts)) {
                    $relParts[] = 'noreferrer';
                }
                $link->setAttribute('rel', implode(' ', $relParts));

                if (!$link->hasAttribute('target') || $link->getAttribute('target') === '') {
                    $link->setAttribute('target', '_blank');
                }

                $currentClass = $link->getAttribute('class');
                if (!str_contains($currentClass, 'external-link')) {
                    $link->setAttribute('class', trim($currentClass . ' external-link'));
                }
            }
        }
    }
}
