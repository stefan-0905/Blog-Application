<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function posts() {
        return $this->belongsToMany(\App\Post::class);
    }

    public function setNameAttribute($value) {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = str_slug($value);
    }

    public function getRouteKeyName() {
        return 'slug';
    }
    public function scopeHasPublishedPosts($query) {
        $query->whereHas('posts', function($qr) {
                $qr->where('published_at', '<=', now());
            });
    }
}
