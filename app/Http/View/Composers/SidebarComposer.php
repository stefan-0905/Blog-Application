<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;

class SidebarComposer
{
    protected $categories;
    protected $popularPosts;

    public function __construct() {
        if(!$this->categories = \App\Category::with('posts')->orderBy('title', 'asc')->get())
            $this->categories = ['0'=>'There are no categories'];
        if(!$this->popularPosts = \App\Post::with('author')->published()->popular()->take(3)->get())
            $this->popularPosts = ['0'=>'There are no popular posts'];
    }

    public function compose(View $view) {
        $view->with('categories', $this->categories)->with('popularPosts', $this->popularPosts);
    }
}