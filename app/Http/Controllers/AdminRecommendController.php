<?php

namespace App\Http\Controllers;

use App\Models\Recommend;
use Illuminate\Http\Request;

class AdminRecommendController extends Controller
{
    public function add() {
        return view('admin.about.add_recommend');
    }

    public function store(Request $request) {
        if ($request->input('add-recommend')) {

            $request->validate([
                'content' => 'required'
            ],
            [
                'required'    => ':attribute không được để trống!',
            ],
            [
                'content' => 'Nội dung'
            ]
        
            );
            $data = new Recommend();
            $data['content'] = $request->content;
            $data->save();

            return redirect()->back()->with(['status' => 'Thêm mới thành công']);
        }

    }

    public function edit($id) {
        $recommend = Recommend::orderBy('id', 'desc')->first();
        return view('admin.about.edit_recommend', compact('recommend'));
    }

    public function update(Request $request, $id) {
        if ($request->input('update-recommend')) {

            $data['content'] = $request->content;
            Recommend::where('id', $id)->update($data);

            return redirect()->back()->with(['status' => 'Cập nhật thông tin thành công']);
        }
    }
}
