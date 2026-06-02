<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobListing extends Model
{
    protected $fillable = [
        'job_category_id', 'title', 'link_type', 'link', 'description', 'show_apply', 'is_featured', 'status',
    ];

    public function category()
    {
        return $this->belongsTo(JobCategory::class, 'job_category_id');
    }

    /** True when the job detail is hosted internally on the portal */
    public function isInternal(): bool
    {
        return $this->link_type === 'internal';
    }

    public function applications()
    {
        return $this->hasMany(JobApplication::class);
    }
}
