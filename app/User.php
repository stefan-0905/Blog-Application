<?php

namespace App;

use Markdown;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable
{
    use Notifiable, LaratrustUserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'bio', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // One to Many relationship with posts
    public function posts() {
        return $this->hasMany(Post::class, 'author_id');
    }

    public function getRouteKeyName() {
        return 'slug';
    }

    // Convert bio markdown text into html 
    public function getBioHtmlAttribute($value) {
        return $this->bio ? Markdown::convertToHtml(e($this->bio)) : NULL;
    }

    public function setNameAttribute($value) {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = str_slug($value);
    }
}
