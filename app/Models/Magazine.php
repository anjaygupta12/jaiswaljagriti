<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Magazine extends Model
{
    protected $fillable = [
        'title', 'slug', 'description', 'thumbnail',
        'pdf_file', 'plan_id', 'is_active', 'magazine_date',
    ];

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    /** True when the magazine is free (no plan or plan price is 0) */
    public function isFree(): bool
    {
        return is_null($this->plan_id) || ($this->plan && $this->plan->price == 0);
    }
}
