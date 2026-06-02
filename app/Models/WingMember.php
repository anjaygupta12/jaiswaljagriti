<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WingMember extends Model
{
    protected $fillable = [
        'name',
        'designation',
        'short_description',
        'phone',
        'email',
        'image',
        'type',
        'sort_order',
        'status'
    ];
}
