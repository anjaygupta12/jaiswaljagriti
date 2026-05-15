<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title', 'slug', 'content', 'event_date', 
        'location', 'thumbnail', 'banner', 'is_active', 'author', 'category', 'views', 'event_category_id'
    ];

    public function eventCategory()
    {
        return $this->belongsTo(EventCategory::class);
    }

    public function relatedMagazines()
    {
        return $this->belongsToMany(Magazine::class, 'event_magazine');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function images()
    {
        return $this->hasMany(EventImage::class);
    }
}
