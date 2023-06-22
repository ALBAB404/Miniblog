<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $query = Post::with('category', 'tag', 'user')->where('is_approved', 1)->where('status', 1);
        $posts = $query->latest()->take(5)->get();
        $banner_posts = $query->inRandomOrder()->take(6)->get();

        return view('frontend.modules.index', compact('posts','banner_posts'));
    }
    public function single()
    {
        return view('frontend.modules.single');
    }

    public function all_post()
    {
        $posts =Post::with('category', 'tag', 'user')->where('is_approved', 1)->where('status', 1)->inRandomOrder()->latest()->paginate(2);

        return view('frontend.modules.all_post', compact('posts'));
    }
}