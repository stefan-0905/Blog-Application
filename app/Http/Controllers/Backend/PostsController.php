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

    public function index(Request $request) {
        $onlyTrashed = FALSE;
        if(($status = $request->get('status')) && $status == 'trashed') {
            $posts = \App\Post::onlyTrashed()->with('author', 'category')->latestFirst()->Paginate(5);
            $onlyTrashed = TRUE;
        } elseif($status == 'published') {
            $posts = \App\Post::published()->with('author', 'category')->latestFirst()->Paginate(5);
        } elseif($status == 'scheduled') {
            $posts = \App\Post::scheduled()->with('author', 'category')->latestFirst()->Paginate(5);
        } elseif($status == 'draft') {
            $posts = \App\Post::draft()->with('author', 'category')->latestFirst()->Paginate(5);
        } elseif($status == 'own') {
            $posts = \App\Post::own()->with('author', 'category')->latestFirst()->Paginate(5);
        } else {
            $posts = \App\Post::with('author', 'category')->latestFirst()->Paginate(5);
        }
        $statusList = $this->statusList();
        return view('backend.posts.index', compact('posts', 'onlyTrashed', 'statusList'));
    }

    private function statusList() {
        return [
            'own' => auth()->user()->posts()->count(), 
            'all' => \App\Post::all()->count(),
            'published' => \App\Post::published()->count(),
            'scheduled' => \App\Post::scheduled()->count(),
            'draft' => \App\Post::draft()->count(),
            'trashed' => \App\Post::onlyTrashed()->count()
        ];
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

    public function edit($id) {
        return view('backend.posts.edit', ['post' => \App\Post::findOrFail($id)]);
    }

    public function update(Requests\CreatePostRequest $request, $id) {
        $post = \App\Post::findOrFail($id);
        
        $post->title = $request->title;
        $post->body = $request->body;
        $post->published_at = $request->published;
        $post->category_id = $request->category_id;
        
        if($fileName = $this->handleImage($request)) {
            if($post->image != '')
                $this->removeImage($post->image);
            $post->image = $fileName;
        }

        $post->save();

        return redirect()->route('posts')->with('success', 'Your post was updated successfully!');
    }

    public function delete($id) {
        $post = \App\Post::findOrFail($id);
        $post->delete();
        return redirect()->back()->with('trash-message', ['Post successfully moved to trash!', $post->id]);
    }

    public function restore($id) {
        $post = \App\Post::onlyTrashed()->findOrFail($id);
        $post->restore();

        return redirect()->back()->with('success', 'Post Restored!');
    }

    /**
     * Removing Specified Image and it's thumbnail image
     */
    private function removeImage($image) {
        if(!empty($image) && $this->notDefaultImage($image)) {
            $imagePath = $this->uploadPath . '/' . $image;
            $extension = substr(strrchr($image, '.'), 1);
            $thumbnail = str_replace(".{$extension}", "_thumb.{$extension}", $image);
            $thumbnailPath = $this->uploadPath . '/' . $thumbnail;
            
            if(file_exists($imagePath)) unlink($imagePath);
            if(file_exists($thumbnailPath)) unlink($thumbnailPath);

            return true;
        } else return false;
    }

    /**
     * Preventing deletion of default images
     */
    private function notDefaultImage($image) {
        $defaultImages = array(
            'Post_Image_1.jpg',
            'Post_Image_2.jpg',
            'Post_Image_3.jpg',
            'Post_Image_4.jpg',
            'Post_Image_5.jpg'
        );
        
        if(in_array($image, $defaultImages)) 
            return false; 
        else 
            return true;
    }

    public function destroy($id) {
        $post = \App\Post::onlyTrashed()->findOrFail($id);
        $this->removeImage($post->image);
        $post->forceDelete();
        return redirect('/admin/posts?status=trashed')->with('success', 'Your post has been deleted successfully.');

    }
}
