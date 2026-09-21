<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Backup Storage Disk
    |--------------------------------------------------------------------------
    |
    | The filesystem disk on which backups will be stored. Defaults to 'local'
    | which in Laravel 11 maps to 'storage/app/private' ensuring backups are
    | never publicly accessible via HTTP.
    |
    */
    'disk' => env('BACKUP_DISK', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Backup Directory
    |--------------------------------------------------------------------------
    |
    | Relative path inside the specified disk. Full path will resolve to:
    | storage/app/private/backups
    |
    */
    'path' => env('BACKUP_PATH', 'backups'),

    /*
    |--------------------------------------------------------------------------
    | mysqldump Binary Path
    |--------------------------------------------------------------------------
    |
    | Path to the mysqldump binary. If null, the backup command will
    | automatically detect standard paths on Windows and Linux/Production.
    |
    */
    'mysqldump_path' => env('DB_DUMP_BINARY_PATH'),

    /*
    |--------------------------------------------------------------------------
    | Retention Policy
    |--------------------------------------------------------------------------
    |
    | Number of latest backup archives to retain. Older backups will be pruned
    | automatically to prevent unbounded disk growth.
    |
    */
    'keep_count' => (int) env('BACKUP_KEEP_COUNT', 7),

    /*
    |--------------------------------------------------------------------------
    | Compression
    |--------------------------------------------------------------------------
    |
    | Whether to compress backup dumps with GZIP. Reduces dump size by ~85%.
    |
    */
    'compress' => env('BACKUP_COMPRESS', true),

    /*
    |--------------------------------------------------------------------------
    | Concurrency Lock Timeout (seconds)
    |--------------------------------------------------------------------------
    |
    | Maximum duration to hold the backup lock to prevent overlapping runs.
    |
    */
    'lock_timeout' => (int) env('BACKUP_LOCK_TIMEOUT', 3600),

];
