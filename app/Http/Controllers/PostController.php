<?php

namespace App\Http\Controllers;
use App\Http\Requests\postUpdateRequest;
use App\Models\SubCategory;
use App\Models\Tag;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\PostCreateRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = post::with('category', 'sub_category', 'user', 'tag')->latest();
        if(Auth::user()->role === User::USER){
            $posts =  $query->where('user_id', Auth::id());
        }

        $posts  = $query->paginate(20);
        return view('Backend.modules.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('status', 1)->pluck('name','id');
        $tags = Tag::where('status', 1)->select('name','id')->get();
        return view('Backend.modules.post.create', compact('categories','tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostCreateRequest $request)
    {
        $post_data = $request->except('photo','slug','tag_ids');
        $post_data['slug'] = Str::slug($request->input('slug'));
        $post_data['user_id'] = Auth::user()->id;
        $post_data['is_approved'] = 1;

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $name = Str::slug($request->input('slug'));
            $height = 400;
            $width = 1000;
            $thumb_height = 150;
            $thumb_width = 300;
            $path = 'image/post/Original/';
            $thumbnail_path = 'image/post/Thumbnail/';

            $post_data['photo'] =  PhotoUploadController::imageUpload($name,$height,$width,$path,$file);
                                   PhotoUploadController::imageUpload($name,$thumb_height,$thumb_width,$thumbnail_path,$file);
        }

        $post = Post::create($post_data);
        $post->tag()->attach($request->input('tag_ids'));
        return redirect()->route('post.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        if(Auth::user()->role == User::USER && $post->user_id != Auth::id()){
            abort(403);
        }
        $post->load(['category', 'sub_category', 'user', 'tag']);
        return view('Backend.modules.post.show', compact('post'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $categories = Category::where('status', 1)->pluck('name','id');
        $tags = Tag::where('status', 1)->select('name','id')->get();
        $selected_tags = DB::table('post_tag')->where('post_id', $post->id)->pluck('tag_id')->toArray();
        return view('Backend.modules.post.edit', compact('post', 'categories', 'tags','selected_tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(postUpdateRequest $request, Post $post)
    {
        $post_data = $request->except('photo','slug','tag_ids');
        $post_data['slug'] = Str::slug($request->input('slug'));
        $post_data['user_id'] = Auth::user()->id;
        $post_data['is_approved'] = 1;

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $name = Str::slug($request->input('slug'));
            $height = 400;
            $width = 1000;
            $thumb_height = 150;
            $thumb_width = 300;
            $path = 'image/post/Original/';
            $thumbnail_path = 'image/post/Thumbnail/';
            PhotoUploadController::imageUnlink($path, $post->photo);
            PhotoUploadController::imageUnlink($thumbnail_path, $post->photo);

            $post_data['photo'] =  PhotoUploadController::imageUpload($name,$height,$width,$path,$file);
                                   PhotoUploadController::imageUpload($name,$thumb_height,$thumb_width,$thumbnail_path,$file);
        }

        $post->update($post_data);
        $post->tag()->sync($request->input('tag_ids'));
        return redirect()->route('post.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        session()->flash('cls','danger');
        session()->flash('msg','Post Deleted Successfully');
        return redirect()->route('post.index');
    }
}
