<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdvertisementNormal extends Model
{
    protected $fillable = ['image_path', 'advertisement_type_id', 'link', 'is_active'];

    public function type()
    {
        return $this->belongsTo(AdvertisementType::class, 'advertisement_type_id');
    }
}
