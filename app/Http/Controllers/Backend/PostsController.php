<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

class PostsController extends BackendController
{
    public function index() {
        return view('backend.posts.index', 
                    ['posts' => \App\Post::with('author')
                                        ->latestFirst()
                                        ->Paginate(5)
                    ]);
    }

    public function create() {
        return view('backend.posts.create');
    }
}
