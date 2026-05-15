<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobCategory extends Model
{
    protected $fillable = ['name', 'slug', 'status'];

    public function listings()
    {
        return $this->hasMany(JobListing::class, 'job_category_id');
    }}
