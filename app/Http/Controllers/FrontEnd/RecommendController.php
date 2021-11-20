<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdminPage;
use App\Models\Recommend;

class RecommendController extends Controller
{
    public function index() {
        $recommend = Recommend::orderBy('id', 'desc')->first();
        return view('frontend.pages.recommend.index', compact('recommend'));
    }
}
