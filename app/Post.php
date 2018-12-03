<?php

namespace App;

use Markdown;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 
                            'slug', 
                            'body', 
                            'category_id', 
                            'author_id', 
                            'published_at',
                            'image'
                        ];
    protected $dates = ['published_at'];

    // Accessor for getting full image url 
    public function getImageUrlAttribute($value) {
        $imageUrl = '';
        if(!is_null($this->image)) {
            $directory = config('cms.image.directory');
            $imagePath = public_path()."/{$directory}/".$this->image;
            if(file_exists($imagePath)) $imageUrl = asset('img/'.$this->image);
        }
        return $imageUrl;
    }

    // Accessor for getting full thumb image url 
    public function getImageThumbAttribute($value) {
        $imageUrl = '';
        if(!is_null($this->image)) {
            $directory = config('cms.image.directory');
            $ext = substr(strrchr($this->image, '.'), 1);
            $thumbnail = str_replace('.jpg', "_thumb.{$ext}", $this->image);
            $imagePath = public_path()."/{$directory}/".$thumbnail;
            if(file_exists($imagePath)) $imageUrl = asset("{$directory}/".$thumbnail);
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

    public function setPublishedAtAttribute($value) {
        $this->attributes['published_at'] = $value ?: NULL;
    }

    public function setTitleAttribute($value) {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = str_slug($value);
    }

    // One to many relationship with user
    public function author() {
        return $this->belongsTo(User::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function publicationLabel() {
        if(!$this->published_at)
            return '<span class="label label-warning">Draft</span>';
        elseif($this->published_at && $this->published_at->isFuture())  
            return '<span class="label label-info">Scheduled</span>';
        else
            return '<span class="label label-success">Published</span>';
    }

    // Scope with latest posts ordered by created_at column
    public function scopeLatestFirst($query) {
        return $query->orderBy('created_at', 'desc');
    }

    // Scope with published posts 
    public function scopePublished($query) {
        return $query->where('published_at', '<=', now());
    }

    public function scopePopular($query) {
        return $query->orderBy('view_count', 'desc');
    }

    public function scopeScheduled($query) {
        return $query->where('published_at', '>', now());
    }

    public function scopeDraft($query) {
        return $query->whereNull('published_at');
    }

    public function scopeOwn($query) {
        return $query->where('author_id', auth()->user()->id);
    }
}
