<?php

namespace App\Models;

use Singsys\LQ\Models\Media as BaseMedia;

class Media extends BaseMedia
{
    protected $fillable = [
        'path',
        'type',
        'user_id',
        'thumbnails',
        'info',
        'mediable_id',
        'mediable_type',
        'created_at',
        'driver',
    ];
}
