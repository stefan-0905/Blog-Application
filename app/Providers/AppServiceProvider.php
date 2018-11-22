<?php

namespace App\Providers;

use View;
use App\Post;
use App\Category;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $categories = Category::with('posts')->orderBy('title', 'asc')->get();
        $popularPosts = Post::with('author')->published()->popular()->take(3)->get();
        View::share(['categories' => $categories, 'popularPosts' => $popularPosts]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
