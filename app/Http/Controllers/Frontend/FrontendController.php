<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Function_;

class FrontendController extends Controller
{
    public function index()
    {
        $query = Post::with('category', 'sub_category', 'tag', 'user')->where('is_approved', 1)->where('status', 1);
        $posts = $query->latest()->take(5)->get();
        $banner_posts = $query->inRandomOrder()->take(6)->get();

        return view('frontend.modules.index', compact('posts','banner_posts'));
    }
    public function single(string $slug)
    {
        $post = Post::with('category', 'sub_category', 'user', 'tag', 'comment', 'comment.user', 'comment.reply')
        ->where('is_approved', 1 )
        ->where('status', 1)
        ->where('slug', $slug)
        ->firstOrFail();
        return view('frontend.modules.single', compact('post'));
    }

    public function all_post()
    {
        $posts =Post::with('category', 'sub_category','tag', 'user')->where('is_approved', 1)->where('status', 1)->inRandomOrder()->latest()->paginate(2);
        $title = 'View All Post List';
        $sub_title =  'All Post';
        return view('frontend.modules.all_post', compact('posts', 'title', 'sub_title'));
    }
    public function search(Request $request)
    {
        $posts =Post::with('category', 'sub_category', 'tag', 'user')
        ->where('is_approved', 1)
        ->where('status', 1)
        ->where('title', 'like', '%'.$request->input('search').'%')
        ->latest()
        ->paginate(2);

        $title = 'View Search Results';
        $sub_title =  $request->input('search');

        return view('frontend.modules.all_post', compact('posts', 'title', 'sub_title'));
    }

    public function category($slug)
    {
        $category = Category::where('slug', $slug)->first();
        if ($category) {
            $posts =Post::with('category', 'sub_category', 'tag', 'user')
            ->where('is_approved', 1)
            ->where('status', 1)
            ->where('category_id', $category->id)
            ->latest()
            ->paginate(2);
        }
        $title = $category->name;
        $sub_title = 'Post By Category';

        return view('frontend.modules.all_post', compact('posts', 'title','sub_title'));
    }
    public function sub_category($slug, $sub_slug)
    {
        $sub_category = SubCategory::where('slug', $sub_slug)->first();
        if ($sub_category) {
            $posts =Post::with('category', 'sub_category', 'tag', 'user')
            ->where('is_approved', 1)
            ->where('status', 1)
            ->where('sub_category_id', $sub_category->id)
            ->latest()
            ->paginate(2);
        }
        $title = $sub_category->name;
        $sub_title = 'Post By Sub Category';

        return view('frontend.modules.all_post', compact('posts', 'title','sub_title'));
    }
    public function tag($slug)
    {
        $tag = Tag::where('slug', $slug)->first();
        $post_ids = DB::table('post_tag')->where('tag_id', $tag->id)->distinct('post_id')->pluck('post_id');
        if ($tag) {
            $posts =Post::with('category', 'sub_category', 'tag', 'user')
            ->where('is_approved', 1)
            ->where('status', 1)
            ->whereIn('id', $post_ids)
            ->latest()
            ->paginate(2);
        }
        $title = $tag->name;
        $sub_title = 'Post By Sub Category';

        return view('frontend.modules.all_post', compact('posts', 'title','sub_title'));

    }

    final public Function contact_us()
    {
        return view('frontend.modules.contact_us');
    }



}