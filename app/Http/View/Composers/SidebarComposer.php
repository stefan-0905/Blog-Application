<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;

class SidebarComposer
{
    protected $categories;
    protected $popularPosts;
    protected $tags;
    protected $archives;

    public function __construct() {
        
    }

    public function compose(View $view) {
        $this->composeCategories($view);
        $this->composePopularPosts($view);
        $this->composeTags($view);
        $this->composeArchives($view);
    }

    private function composeCategories($view) {
        if(!$this->categories = \App\Category::with('posts')->orderBy('title', 'asc')->get())
            $this->categories = [];

        $view->with('categories', $this->categories);
    }
    
    private function composePopularPosts($view) {
        /**
         * Get published posts ordered by published_at at take 3 of them 
         */
        if(!$this->popularPosts = \App\Post::published()->popular()->take(3)->get())
            $this->popularPosts = [];
        
        $view->with('popularPosts', $this->popularPosts);
    }

    private function composeTags($view) {
        /**
         * Get tags that are assocciated with published posts
         */
        if(!$this->tags = \App\Tag::hasPublishedPosts()->get())
            $this->tags = [];

        $view->with('tags', $this->tags);
    }

    private function composeArchives($view) {
        $this->archives = \App\Post::selectRaw("count(id) AS post_count,
		            date_part('year', published_at) AS year,
                    to_char(published_at, 'Month') AS month")
                    ->published()
                    ->groupBy('year', 'month')
                    ->orderByRaw('min(published_at) desc')->get();

        if(!$this->archives)
            $this->archives = [];
        
        $view->with('archives', $this->archives);
    }
}