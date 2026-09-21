<?php

/*
|--------------------------------------------------------------------------
| Livewire Configuration — Project: Truyền Thông Cửu Long
|--------------------------------------------------------------------------
|
| This file overrides the Livewire package defaults. Only settings that
| differ from the vendor defaults are specified here.
|
| SEC-004 Remediation (2026-09-21):
|   temporary_file_upload.disk is set to 'livewire_tmp' (defined in
|   config/filesystems.php) which stores files under
|   storage/app/private/livewire-tmp/ — outside the public web root.
|   This eliminates anonymous HTTP access to temporary uploads via
|   /storage/livewire-tmp/... that existed when disk was null (fallback
|   to FILESYSTEM_DISK=public).
|
*/

return [

    /*
    |---------------------------------------------------------------------------
    | Temporary File Uploads
    |---------------------------------------------------------------------------
    |
    | SEC-004: Use a dedicated private disk so that temporary uploads are
    | stored in storage/app/private/livewire-tmp/ instead of the public
    | disk (storage/app/public/livewire-tmp/). This prevents anonymous
    | HTTP access through the public/storage symlink.
    |
    | The 'livewire_tmp' disk is defined in config/filesystems.php with:
    |   root  => storage_path('app/private')
    |   (no url / visibility — not public)
    |
    | Livewire will store uploads in: <root>/livewire-tmp/{file}
    | which resolves to:  storage/app/private/livewire-tmp/{file}
    |
    */

    'temporary_file_upload' => [
        'disk'       => 'livewire_tmp', // SEC-004: private disk, not the public default
        'rules'      => null,           // default: ['required', 'file', 'max:12288']
        'directory'  => null,           // default: 'livewire-tmp'
        'middleware' => null,           // default: 'throttle:60,1'
        'preview_mimes' => [
            'png', 'gif', 'bmp', 'svg', 'wav', 'mp4',
            'mov', 'avi', 'wmv', 'mp3', 'm4a',
            'jpg', 'jpeg', 'mpga', 'webp', 'wma',
        ],
        'max_upload_time' => 5,
        'cleanup'         => true,      // auto-delete uploads older than 24h
    ],

];
