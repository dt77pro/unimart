<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index() {
        $contact = Contact::orderBy('id', 'desc')->first();
        return view('frontend.pages.contact.index', compact('contact'));
    }
}
