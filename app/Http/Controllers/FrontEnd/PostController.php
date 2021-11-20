<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdminPost;
use Carbon\Carbon;

class PostController extends Controller
{
    public function index() {
        $posts = AdminPost::where('status', 'public')->select(['title','thumbnail','description','slug', 'created_at'])->orderBy('id', 'desc')->get();
        return view('frontend.pages.post.index', compact('posts'));
    }

    public function detail_post($slug) {
        $post = AdminPost::where('slug', $slug)->first();
        return view('frontend.pages.post_detail.index', compact('post'));
    }

    
}
