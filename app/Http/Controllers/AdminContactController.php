<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;


class AdminContactController extends Controller

{
    function __construct()
    {
        $this->middleware(function($request, $next) {
            session(['module_active' => 'about']);
            return $next($request);
        });
        
    }

    public function add() {
        return view('admin.about.add_contact');
    }

    public function store(Request $request) {
        if ($request->input('add-contact')) {

            $data = new Contact;
            $data['category'] = $request->category;
            $data['hotline'] = $request->hotline;
            $data['address'] = $request->address;
            $data['description'] = $request->description;
            $data->save();

            return redirect()->back()->with(['status' => 'Thêm mới thành công']);
        }

    }

    public function edit() {
        $contact = Contact::orderBy('id', 'desc')->first();
        return view('admin.about.edit_contact', compact('contact'));
    }

    public function update(Request $request, $id) {
        if ($request->input('update-contact')) {

            $data['category'] = $request->category;
            $data['hotline'] = $request->hotline;
            $data['address'] = $request->address;
            $data['description'] = $request->description;
            
            Contact::where('id', $id)->update($data);

            return redirect()->back()->with(['status' => 'Cập nhật thông tin thành công']);
        }
    }
}
