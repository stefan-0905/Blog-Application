<?php

namespace App\Http\Controllers\Backend;

use Image;
use DateTime;
use Auth;
use Illuminate\Http\Request;
use App\Http\Requests;

class PostsController extends BackendController
{
    protected $uploadPath;

    public function __construct() {
        parent::__construct();
        $this->uploadPath = public_path(config('cms.image.directory'));
    }

    public function index() {
        return view('backend.posts.index', 
                    ['posts' => \App\Post::with('author', 'category')
                                        ->latestFirst()
                                        ->Paginate(5)
                    ]);
    }

    public function create() {
        return view('backend.posts.create', ['categories' => \App\Category::all()]);
    }

    public function store(Requests\CreatePostRequest $request) {

        $fileName = $this->handleImage($request);

        $post = \App\Post::create([
            'title' => $request->title,
            'slug' => str_slug($request->title),
            'body' => $request->body,
            'published_at' => $request->published,
            'category_id' => $request->category_id,
            'author_id' => Auth::user()->id,
            'image' => $fileName
        ]);

        return redirect()->route('posts')->with('success', 'Your post was created successfully!');
    }

    public function handleImage(Request $request) {
        if($request->hasFile('image')) {
            $fileName = time().$request->image->getClientOriginalName();
            $destination = $this->uploadPath;
            
            $successUpload = $request->image->move($destination, $fileName);
            
            if($successUpload) {
                $extension = $request->image->getClientOriginalExtension();
                $thumbnail = str_replace(".{$extension}", "_thumb.{$extension}", $fileName);
                
                // Creating thumbnail image by resizing original
                // Using intervention/image package
                Image::make($destination . '/' . $fileName)
                        ->resize(config('cms.image.thumbnail.width'), config('cms.image.thumbnail.height'))
                        ->save($destination . '/' . $thumbnail);
            }

            return $fileName;
        }
    }
}
