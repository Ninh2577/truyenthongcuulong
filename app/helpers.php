<?php

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

if (!function_exists('get_setting')) {
    /**
     * Get a setting value by key, with a fallback.
     * Caches all settings in a single dictionary with in-memory memoization.
     *
     * @param string $key
     * @param mixed $default
     * @param bool $fresh
     * @return mixed
     */
    function get_setting(string $key, $default = null, bool $fresh = false)
    {
        static $settings = null;
        if ($fresh || $settings === null) {
            $settings = Cache::remember('settings_all_dict', 86400, function () {
                try {
                    return Setting::pluck('value', 'key')->toArray();
                } catch (\Throwable $e) {
                    return [];
                }
            });
        }
        return array_key_exists($key, $settings) ? $settings[$key] : $default;
    }
}

if (!function_exists('clear_setting_cache')) {
    /**
     * Clear both Redis/File cache and in-memory static memoization for settings.
     */
    function clear_setting_cache(): void
    {
        Cache::forget('settings_all_dict');
        get_setting('', null, true);
    }
}

if (!function_exists('setting')) {
    /**
     * Alias for get_setting.
     */
    function setting(string $key, $default = null, bool $fresh = false)
    {
        return get_setting($key, $default, $fresh);
    }
}

if (!function_exists('asset_v')) {
    /**
     * Generate an asset path with cache-busting version query string based on file modification time.
     *
     * @param string $path
     * @return string
     */
    function asset_v(string $path): string
    {
        $cleanPath = ltrim($path, '/');
        $fullPath = public_path($cleanPath);
        if (file_exists($fullPath)) {
            return asset($cleanPath) . '?v=' . filemtime($fullPath);
        }
        return asset($cleanPath);
    }
}

if (!function_exists('clean_special_chars')) {
    /**
     * Decode HTML entities recursively and standardize special characters, quotes, and non-breaking spaces.
     *
     * @param string|null $string
     * @return string|null
     */
    function clean_special_chars(?string $string): ?string
    {
        if ($string === null || $string === '') {
            return $string;
        }

        $cleaned = $string;

        // Loop up to 4 times to resolve nested or double-encoded entities (e.g. &amp;amp; or &amp;quot;)
        for ($i = 0; $i < 4; $i++) {
            if (!str_contains($cleaned, '&')) {
                break;
            }
            $decoded = html_entity_decode($cleaned, ENT_QUOTES | ENT_HTML5, 'UTF-8');
            if ($decoded === $cleaned) {
                break;
            }
            $cleaned = $decoded;
        }

        // Standardize common special character escapes, non-breaking spaces and typography entities
        $cleaned = str_replace(
            [
                "\xC2\xA0", '&nbsp;', '&#160;',
                '\\&quot;', '&quot;', '\\"',
                '\\&#039;', '&#039;', "\\'",
                '&#8211;', '&ndash;',
                '&#8212;', '&mdash;',
                '&#8220;', '&ldquo;',
                '&#8221;', '&rdquo;',
                '&#8216;', '&lsquo;',
                '&#8217;', '&rsquo;',
                '&#038;', '&amp;'
            ],
            [
                ' ', ' ', ' ',
                '"', '"', '"',
                "'", "'", "'",
                '–', '–',
                '—', '—',
                '“', '“',
                '”', '”',
                '‘', '‘',
                '’', '’',
                '&', '&'
            ],
            $cleaned
        );

        // Normalize extraneous spaces and tabs while preserving newlines
        return trim(preg_replace('/[ \t]+/u', ' ', $cleaned));
    }
}

if (!function_exists('clean_ai_content')) {
    /**
     * Clean all AI/Chatbot artifacts (Google Gemini, ChatGPT, Claude) including citations and Angular classes.
     *
     * @param string|null $html
     * @return string|null
     */
    function clean_ai_content(?string $html): ?string
    {
        return \App\Services\Content\ContentSanitizerService::clean($html);
    }
}

if (!function_exists('render_ad_position')) {
    /**
     * Render an advertisement unit for a specific position if enabled.
     *
     * @param string $position (post_top, post_middle, post_bottom, sidebar, footer_banner)
     * @return string
     */
    function render_ad_position(string $position): string
    {
        if (!filter_var(setting('google_adsense_enabled', false), FILTER_VALIDATE_BOOLEAN)) {
            return '';
        }

        $enabledKey = "ads_{$position}_enabled";
        if (!filter_var(setting($enabledKey, false), FILTER_VALIDATE_BOOLEAN)) {
            return '';
        }

        $codeKey = "ads_{$position}_code";
        $code = trim(setting($codeKey, ''));
        if (empty($code)) {
            return '';
        }

        return '<div class="cl-ad-wrapper cl-ad-' . e($position) . ' my-6 text-center overflow-hidden clear-both w-full max-w-full">'
            . '<div class="inline-block text-[10px] uppercase font-bold tracking-wider text-slate-400/80 mb-1.5 px-2 py-0.5 rounded bg-slate-100/75 dark:bg-slate-800">Quảng cáo</div>'
            . '<div class="cl-ad-inner flex justify-center items-center w-full overflow-x-auto">'
            . $code
            . '</div>'
            . '</div>';
    }
}

if (!function_exists('inject_ad_into_content')) {
    /**
     * Inject an in-article ad after a specific paragraph in HTML content.
     *
     * @param string $content
     * @return string
     */
    function inject_ad_into_content(string $content): string
    {
        $adHtml = render_ad_position('post_middle');
        if (empty($adHtml)) {
            return $content;
        }

        $paragraphNumber = (int) setting('ads_post_middle_paragraph', 3);
        if ($paragraphNumber < 1) {
            $paragraphNumber = 3;
        }

        $closingP = '</p>';
        $paragraphs = explode($closingP, $content);

        // If content has fewer paragraphs than target, append at the end of article
        if (count($paragraphs) <= $paragraphNumber) {
            return $content . $adHtml;
        }

        $newContent = '';
        foreach ($paragraphs as $index => $p) {
            $newContent .= $p;
            if ($index < count($paragraphs) - 1) {
                $newContent .= $closingP;
            }
            if ($index + 1 === $paragraphNumber) {
                $newContent .= $adHtml;
            }
        }

        return $newContent;
    }
}


