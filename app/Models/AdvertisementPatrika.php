<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdvertisementPatrika extends Model
{
    protected $fillable = ['image_path', 'type', 'link', 'is_active'];
}
