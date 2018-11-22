<?php

namespace App\Http\Controllers;

use App\User;
use App\Post;
use App\Category;
use Illuminate\Http\Request;

class FrontEndController extends Controller
{
    public function index() {
        $posts = Post::with('author')
                    ->latestFirst()
                    ->published()
                    ->simplePaginate(4);
        
        return view('index', ['posts' => $posts]);
    }
    
    /**
     * Injecting Post which we registered in our RouteServiceProvider
     */
    public function show(Post $post) {
        return view('show', ['post' => $post]);
    }

    public function category_search(Category $category) {
        $posts = $category->posts()
                        ->with('author')
                        ->latestFirst()
                        ->published()
                        ->simplePaginate(4);

        return view('search', ['posts' => $posts, 'search_result' => $category->title]);
    }

    public function author_search(User $author) {
        $posts = $author->posts()
                        ->with('category')
                        ->latestFirst()
                        ->published()
                        ->simplePaginate(4);
                        
        return view('search', ['posts' => $posts, 'search_result' => $author->name]);
    }
}
