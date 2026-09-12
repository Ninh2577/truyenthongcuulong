<?php

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

if (!function_exists('get_setting')) {
    /**
     * Get a setting value by key, with a fallback.
     * Caches the value forever until cleared.
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    function get_setting(string $key, $default = null)
    {
        return Cache::rememberForever("setting_{$key}", function () use ($key, $default) {
            $setting = Setting::where('key', $key)->first();
            return $setting ? $setting->value : $default;
        });
    }
}

if (!function_exists('setting')) {
    /**
     * Alias for get_setting.
     */
    function setting(string $key, $default = null)
    {
        return get_setting($key, $default);
    }
}
