<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;

class SidebarComposer
{
    protected $categories;
    protected $popularPosts;
    protected $tags;

    public function __construct() {
        
    }

    public function compose(View $view) {
        $this->composeCategories($view);
        $this->composePopularPosts($view);
        $this->composeTags($view);
    }

    public function composeCategories($view) {
        if(!$this->categories = \App\Category::with('posts')->orderBy('title', 'asc')->get())
            $this->categories = ['0'=>'There are no categories.'];

        $view->with('categories', $this->categories);
    }
    
    public function composePopularPosts($view) {
        if(!$this->popularPosts = \App\Post::with('author')->published()->popular()->take(3)->get())
            $this->popularPosts = ['0'=>'There are no popular posts.'];
        
        $view->with('popularPosts', $this->popularPosts);
    }

    public function composeTags($view) {
        if(!$this->tags = \App\Tag::has('posts')->get())
            $this->tags = ['0' => 'There are no tags.'];

        $view->with('tags', $this->tags);
    }
}