<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdminPost;
use App\Models\AdminPostCategory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;




class AdminPostController extends Controller
{
    public function __construct()
    {
        $this->middleware(function($request, $next) {
            session(['module_active' => 'post']);
            return $next($request);
        });
    }

    public function list(Request $request) {
        $post_status = $request->input('post_status');
        $status = $request->input('status');
        $list_act = [
            'delete' => 'Xóa tạm thời'
        ];
        $keyword = "";
        if ($request->input('keyword')) {
            $keyword = $request->input('keyword');
        }
        
        $posts = AdminPost::where('title', 'LIKE', "%{$keyword}%")->orderBy('id', 'desc')->paginate(4);
        $count_post_pending = AdminPost::where('status', 'pending')->count();
        $count_post_public = AdminPost::where('status', 'public')->count();
        $count_post_trash = AdminPost::onlyTrashed()->count();
        $count = [$count_post_pending, $count_post_public];
        $count_total = $count[0] + $count[1];
        return view('admin.post.list',compact('posts','count','count_post_trash','count_total','list_act'));
        
    }

    public function add() {
        $cate = AdminPostCategory::all();
        return view('admin.post.add',compact('cate'));
    }

    public function store(Request $request) {
        // return $request->input();
        if ($request->input('btn-add')) {
            $request->validate(
                [
                    'title' => 'required|unique:posts|max:255',
                    'slug' => 'required',
                    'description' => 'required',
                    'content' => 'required',
                    'parent_id' => 'required',
                    'thumbnail' => 'mimes:jpeg,jpg,png,gif|required|max:1000',
                ],

                [
                    'required' => ':attribute không được để trống!',
                    'title.unique' => 'Tiêu đề bài viết đã tồn tại!',
                    'thumbnail.mimes' => 'Định dạng file ảnh chưa đúng phải là dạng jpeg,jpg,png,gif!',
                    'thumbnail.max' => 'Kích thước ảnh vượt quá :maxMB!'
                ],

                [
                    'title'       => 'Tiêu đề bài viết',
                    'content'     => 'Nội dung bài viết',
                    'description' => 'Nội dung bài viết',
                    'thumbnail'   => 'Hình ảnh bài viết',
                    'slug'        => 'Slug bài viết',
                    'parent_id'   => 'Danh mục bài viết'
                ]
                
            );
            
            if ($request->hasFile('thumbnail')) {
                $thumbnail = $request->thumbnail;
                $fileName = $thumbnail->getClientOriginalName(); //Lấy tên file
                $thumbnail->getClientOriginalExtension(); //Lấy đuôi file
                $thumbnail->getSize(); //Lấy kích thước file
                $thumbnail->move('public/uploads/post/', $fileName);
                $thumbnail = 'public/uploads/post/'.$fileName;
                $data['thumbnail'] = $thumbnail;
            };
            
            $data['title'] = $request->title;
            $data['description'] = $request->description;
            $data['content'] = $request->content;
            $data['slug'] = $request->slug;
            $data['status'] = $request->status;
            $data['cat_id'] = $request->parent_id;
            $data['created_at'] = Carbon::now('Asia/Ho_Chi_Minh');
            $data['user_id'] = Auth::id();

            AdminPost::create($data);

            return redirect('admin/post/list')->with('status', 'Thêm bài viết mới thành công');
        }
    }

    public function edit($id) {
        $cate = AdminPostCategory::all();
        $post = AdminPost::find($id);
        return view('admin.post.edit', compact('post','cate'));
    }

    public function action(Request $request) {
        $list_check = $request->input('list_check');
        if ($list_check) {
            if (!empty($list_check)) {
                $act = $request->input('act');
                if ($act == 'delete') {
                    AdminPost::destroy($list_check);
                    return redirect('admin/post/list')->with('status', 'Đã xóa tạm thời thành công');

                }
                if ($act == 'restore') {
                    AdminPost::withTrashed()
                    ->whereIn('id', $list_check)
                    ->restore();
                    return redirect('admin/post/list')->with('status', 'Bạn đã khôi phục thành công');

                }
                if ($act == 'forceDelete') {
                    AdminPost::withTrashed()
                    ->whereIn('id', $list_check)
                    ->forceDelete();
                    return redirect('admin/post/list')->with('status', 'Đã xóa vĩnh viễn thành công');
                }
            }
            return redirect()->back()->with('status', 'Cần lựa chọn tác vụ!');
        } else {
            return redirect()->back()->with('status', 'Bạn chưa lựa chọn bài viết!');
        }
    }
    public function update(Request $request, $id) {
        if ($request->input('btn-update')) {
            $request->validate(
                [
                    'title' => 'required|max:255',
                    'slug' => 'required',
                    'description' => 'required',
                    'content' => 'required',
                    'thumbnail' => 'mimes:jpeg,jpg,png,gif|required|max:1000',
                    'parent_id' => 'required'
                ],

                [
                    'required' => ':attribute không được để trống!',
                    'thumbnail.mimes' => 'Định dạng file ảnh chưa đúng phải là dạng jpeg,jpg,png,gif',
                    'thumbnail.max' => 'Kích thước ảnh vượt quá :maxMB'
                ],
                [
                    'title' => 'Tiêu đề bài viết',
                    'content' => 'Nội dung bài viết',
                    'description' => 'Nội dung bài viết',
                    'thumbnail' => 'Hình ảnh bài viết',
                    'slug' => 'Slug bài viết',
                    'parent_id' => 'Danh mục bài viết'

                ]
            );
            if ($request->hasFile('thumbnail')) {
                $thumbnail = $request->thumbnail;

                $fileName = $thumbnail->getClientOriginalName(); //Lấy tên file
                $thumbnail->getClientOriginalExtension(); //Lấy đuôi file
                $thumbnail->getSize(); //Lấy kích thước file
                $thumbnail->move('public/uploads/post/', $fileName);
                $thumbnail = 'public/uploads/post/'.$fileName;
                $data['thumbnail'] = $thumbnail;
            }
            
            $data['title'] = $request->title;
            $data['description'] = $request->description;
            $data['content'] = $request->content;
            $data['slug'] = $request->slug;
            $data['status'] = $request->status;
            $data['cat_id'] = $request->parent_id;
            
            AdminPost::where('id', $id)->update($data);
            return redirect('admin/post/list')->with('status', 'Cập nhật bài viết thành công');

        }
    }

    public function delete($id) {
        $post = AdminPost::find($id);
        $post->delete();
        return redirect('admin/post/list')->with('status', 'Xóa bài viết thành công');
    }

    public function trash(Request $request) {
        $post_status = $request->input('post_status');
        $list_act = [
            'restore' => 'Khôi phục',
            'forceDelete' => 'Xóa vĩnh viễn'
        ];
        $keyword = "";
        if ($request->input('keyword')) {
            $keyword = $request->input('keyword');
        }
        $posts = AdminPost::where('title', 'LIKE', "%{$keyword}%")->onlyTrashed()->paginate(4);
        $count_post_trash = AdminPost::onlyTrashed()->count();
        $count_post_pending = AdminPost::where('status', 'pending')->count();
        $count_post_public = AdminPost::where('status', 'public')->count();
        $count = [$count_post_pending, $count_post_public];
        $count_total = $count[0] + $count[1];
        return view('admin.post.trash', compact('posts', 'count_post_trash', 'count', 'count_total', 'list_act'));
        
        
    }

    public function restore_trash($id) {
        AdminPost::withTrashed()
        ->where('id', $id)
        ->restore();
        return back()->with('status', 'Bạn đã khôi phục bài viết thành công');
    }

    public function forceDelete_trash($id) {
        $post = AdminPost::withTrashed()
        ->where('id', $id)->find($id);
        $post_thumbnail = $post->thumbnail;
        $path = $post_thumbnail;
        if ($post_thumbnail) {
            unlink($path);
        }
        $post->forceDelete();
        return back()->with('status', 'Đã xóa vĩnh viễn thành công');
    }

    public function active(Request $request, $action) {
        $post_status = $request->input('post_status');
        $status = $request->input('status');
        $list_act = [
            'delete' => 'Xóa tạm thời'
        ];
        $keyword = "";
        if ($request->input('keyword')) {
            $keyword = $request->input('keyword');
        }
        switch ($action) {
            case 'pending':
                $posts = AdminPost::where('title', 'LIKE', "%{$keyword}%")->orderBy('id', 'desc')->paginate(4);
                $posts = AdminPost::where('status', 'pending')->orderBy('id', 'desc')->paginate(4);
                break;
            case 'public':
                $posts = AdminPost::where('title', 'LIKE', "%{$keyword}%")->orderBy('id', 'desc')->paginate(4);
                $posts = AdminPost::where('status', 'public')->orderBy('id', 'desc')->paginate(4);
                break;
            
        }
        $count_post_pending = AdminPost::where('status', 'pending')->count();
        $count_post_public = AdminPost::where('status', 'public')->count();
        $count_post_trash = AdminPost::onlyTrashed()->count();
        $count = [$count_post_pending, $count_post_public];
        $count_total = $count[0] + $count[1];
        return view('admin.post.list', compact('posts', 'count', 'count_total', 'count_total', 'count_post_trash', 'list_act'));
    }
        
    public function active_update($id) {
        $post = AdminPost::find($id);
        if ($post->status == 'public') {
            $status = 'pending';
        } else {
            $status = 'public';
        }
        $data = array('status' => $status);
        AdminPost::where('id', $id)->update($data);
        return redirect()->back();
    }

    public function detail($id) {
        $post = AdminPost::find($id);
        return view('admin.post.detail', compact('post'));
    }

   
}
