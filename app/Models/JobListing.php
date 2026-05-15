<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobListing extends Model
{
    protected $fillable = ['job_category_id', 'title', 'link', 'is_featured', 'status'];

    public function category()
    {
        return $this->belongsTo(JobCategory::class, 'job_category_id');
    }}
