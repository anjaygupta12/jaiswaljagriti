<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdvertisementType extends Model
{
    protected $fillable = ['name'];

    public function normals()
    {
        return $this->hasMany(AdvertisementNormal::class);
    }
}
