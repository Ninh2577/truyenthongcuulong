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
