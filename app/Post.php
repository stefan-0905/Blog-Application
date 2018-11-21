<?php

namespace App;

use Markdown;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $dates = ['published_at'];

    // Accessor for getting full image url 
    public function getImageUrlAttribute($value) {
        $imageUrl = '';
        if(!is_null($this->image)) {
            $imagePath = public_path().'/img/'.$this->image;
            if(file_exists($imagePath)) $imageUrl = asset('img/'.$this->image);
        }
        return $imageUrl;
    }

    // Get date when post was published 
    public function getDateAttribute($value) {
        return is_null($this->published_at) ? '' : $this->published_at->diffForHumans();
    }

    // Convert body markdown text into html 
    public function getBodyHtmlAttribute($value) {
        return $this->body ? Markdown::convertToHtml(e($this->body)) : NULL;
    }

    // One to many relationship with user
    public function author() {
        return $this->belongsTo(User::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    // Scope with latest posts ordered by created_at column
    public function scopeLatestFirst($query) {
        return $query->orderBy('created_at', 'desc');
    }

    // Scope with published posts 
    public function scopePublished($query) {
        return $query->where('published_at', '<=', now());
    }
}
