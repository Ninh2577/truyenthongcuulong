<?php

namespace App\Services;

class SeoScoreCalculator
{
    /**
     * Calculate SEO Score and Breakdown based on raw array data.
     * This is useful for real-time livewire form calculation.
     *
     * @param array $data
     * @return array
     */
    public static function calculate(array $data): array
    {
        $breakdown = [];
        $totalScore = 0;

        $metaTitle = $data['meta_title'] ?? '';
        $metaDesc = $data['meta_description'] ?? '';
        $thumbnail = $data['thumbnail'] ?? '';
        $focusKeyword = trim($data['focus_keyword'] ?? '');
        $title = $data['title'] ?? '';
        $slug = $data['slug'] ?? '';
        $contentRaw = $data['content'] ?? '';

        // 1. Meta Title (50-60 chars)
        $mtLen = mb_strlen((string)$metaTitle, 'UTF-8');
        $hasMt = $mtLen >= 50 && $mtLen <= 60;
        $breakdown['meta_title'] = [
            'label' => 'Meta Title (50-60 ký tự)',
            'status' => $hasMt,
            'score' => $hasMt ? 10 : 0
        ];
        $totalScore += $breakdown['meta_title']['score'];

        // 2. Meta Description (120-160 chars)
        $mdLen = mb_strlen((string)$metaDesc, 'UTF-8');
        $hasMd = $mdLen >= 120 && $mdLen <= 160;
        $breakdown['meta_description'] = [
            'label' => 'Meta Description (120-160 ký tự)',
            'status' => $hasMd,
            'score' => $hasMd ? 10 : 0
        ];
        $totalScore += $breakdown['meta_description']['score'];

        // 3. Thumbnail
        $hasThumb = !empty($thumbnail);
        $breakdown['thumbnail'] = [
            'label' => 'Có ảnh đại diện (Thumbnail)',
            'status' => $hasThumb,
            'score' => $hasThumb ? 10 : 0
        ];
        $totalScore += $breakdown['thumbnail']['score'];

        // 4. Focus Keyword check
        $keyword = mb_strtolower($focusKeyword, 'UTF-8');
        
        $hasKeywordInTitle = false;
        $hasKeywordInSlug = false;
        $hasKeywordInMetaDesc = false;
        $hasKeywordInContent = false;

        $contentStr = is_array($contentRaw) ? json_encode($contentRaw) : (string)$contentRaw;
        
        if (is_array($contentRaw)) {
            $cleanContentText = '';
            array_walk_recursive($contentRaw, function ($item, $key) use (&$cleanContentText) {
                if (is_string($item) && $key === 'text') {
                    $cleanContentText .= ' ' . $item;
                }
            });
            $cleanContent = mb_strtolower(trim($cleanContentText), 'UTF-8');
            $wordCount = str_word_count($cleanContentText);
        } else {
            $cleanContent = mb_strtolower(strip_tags($contentStr), 'UTF-8');
            $wordCount = str_word_count(strip_tags($contentStr));
        }

        if ($keyword !== '') {
            $lowerTitle = mb_strtolower((string)$title, 'UTF-8');
            $lowerSlug = mb_strtolower((string)$slug, 'UTF-8');
            $lowerMetaDesc = mb_strtolower((string)$metaDesc, 'UTF-8');

            $hasKeywordInTitle = str_contains($lowerTitle, $keyword);
            $hasKeywordInSlug = str_contains($lowerSlug, \Illuminate\Support\Str::slug($keyword));
            $hasKeywordInMetaDesc = str_contains($lowerMetaDesc, $keyword);
            $hasKeywordInContent = str_contains($cleanContent, $keyword);
        }

        $breakdown['keyword_in_title'] = [
            'label' => 'Từ khóa chính có trong Tiêu đề',
            'status' => $hasKeywordInTitle,
            'score' => $hasKeywordInTitle ? 15 : 0
        ];
        $totalScore += $breakdown['keyword_in_title']['score'];

        $breakdown['keyword_in_slug'] = [
            'label' => 'Từ khóa chính có trong Đường dẫn',
            'status' => $hasKeywordInSlug,
            'score' => $hasKeywordInSlug ? 15 : 0
        ];
        $totalScore += $breakdown['keyword_in_slug']['score'];

        $breakdown['keyword_in_meta'] = [
            'label' => 'Từ khóa chính có trong Meta Description',
            'status' => $hasKeywordInMetaDesc,
            'score' => $hasKeywordInMetaDesc ? 10 : 0
        ];
        $totalScore += $breakdown['keyword_in_meta']['score'];

        $breakdown['keyword_in_content'] = [
            'label' => 'Từ khóa chính có trong Nội dung',
            'status' => $hasKeywordInContent,
            'score' => $hasKeywordInContent ? 15 : 0
        ];
        $totalScore += $breakdown['keyword_in_content']['score'];

        // Content length > 600 words
        $goodLength = $wordCount >= 600;
        $breakdown['content_length'] = [
            'label' => 'Nội dung dài hơn 600 từ',
            'status' => $goodLength,
            'score' => $goodLength ? 5 : 0
        ];
        $totalScore += $breakdown['content_length']['score'];

        // Images / alt
        $hasImg = str_contains($contentStr, '<img ') || str_contains($contentStr, '"type":"image"');
        $breakdown['content_images'] = [
            'label' => 'Bài viết có chứa hình ảnh',
            'status' => $hasImg,
            'score' => $hasImg ? 5 : 0
        ];
        $totalScore += $breakdown['content_images']['score'];
        
        // Internal links
        $hasLink = str_contains($contentStr, '<a ') || str_contains($contentStr, '"type":"link"');
        $breakdown['internal_links'] = [
            'label' => 'Bài viết có chứa liên kết',
            'status' => $hasLink,
            'score' => $hasLink ? 5 : 0
        ];
        $totalScore += $breakdown['internal_links']['score'];

        return [
            'score' => min(100, $totalScore),
            'breakdown' => $breakdown
        ];
    }
}
