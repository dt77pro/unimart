<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdminPage;

class PageDetailController extends Controller
{
    public function index($slug) {
        $page = AdminPage::where('slug', $slug)->first(); 
        return view('frontend.pages.page_detail.index', compact('page'));
    }
}
