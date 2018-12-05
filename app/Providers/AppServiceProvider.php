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
        /**
         * Sharing sidebar's categories and popular posts with multiple views
         */
        View::composer(
            ['index', 'search', 'show'], 'App\Http\View\Composers\SidebarComposer'
        );
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
