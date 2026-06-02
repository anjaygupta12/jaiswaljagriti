<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable = [
        'title',
        'description',
        'location',
        'image_path',
        'is_active',
        'sort_order',
    ];
}
