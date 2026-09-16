<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'fullname',
        'phone',
        'email',
        'service_interested',
        'message',
        'status',
        'ip_address',
        'admin_note',
        'replied_at',
    ];

    protected $casts = [
        'replied_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            if ($model->isDirty('status') && $model->status === 'resolved' && is_null($model->replied_at)) {
                $model->replied_at = now();
            }
        });
    }
}
