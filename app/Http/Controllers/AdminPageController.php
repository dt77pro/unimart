<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdminPage;
use Illuminate\Support\Str;

class AdminPageController extends Controller
{
    //
    function __construct()
    {
        $this->middleware(function($request, $next) {
            session(['module_active' => 'page']);
            return $next($request);
        });
        
    }

    public function list(Request $request) {
        // return $request->input('keyword');
        $status = $request->input('status');
        $active_page = $request->input('active_page');
        $list_act = [
            'delete' => 'Xóa tạm thời'
        ];
        
        if ($status == 'trash') {
            $list_act = [
                'restore' => 'Khôi phục',
                'forceDelete' => 'Xóa vĩnh viễn'
            ];
            $pages = AdminPage::onlyTrashed()->paginate(5);

            $count_page_pending = AdminPage::where('active_page', '0')->count();
            $count_page_public = AdminPage::where('active_page', '1')->count();
            $count_page_trash = AdminPage::onlyTrashed()->count();
            $count = [$count_page_pending, $count_page_public];
            $total_count = $count[0] + $count[1];
            return view('admin.page.trash', compact('pages','count','count_page_trash','total_count', 'list_act'));
        } else {

            if ($active_page == '0') {
                $pages = AdminPage::where('active_page', '0')->orderBy('id', 'desc')->paginate(3);

            } elseif ($active_page == '1'){
                $pages = AdminPage::where('active_page', '1')->orderBy('id', 'desc')->paginate(3);

            } else { 
               
                $keyword = "";
                if ($request->input('keyword')) {
                    $keyword = $request->input('keyword');
                }
                $pages = AdminPage::where('title', 'LIKE', "%{$keyword}%")->orderBy('id', 'desc')->paginate(3);
            }
            
        }
  
        $count_page_pending = AdminPage::where('active_page', '0')->count();
        $count_page_public = AdminPage::where('active_page', '1')->count();
        $count_page_trash = AdminPage::onlyTrashed()->count();
        $count = [$count_page_pending, $count_page_public];
        $total_count = $count[0] + $count[1];
        return view('admin.page.list', compact('pages','count','count_page_trash','total_count', 'list_act'));
    }

    public function forceDelete_trash($id) {
        AdminPage::withTrashed()
        ->where('id', $id)
        ->forceDelete();
        return redirect()->back()->with('status', 'Đã xóa vĩnh viễn thành công');
    }
    public function restore_trash($id) {
        AdminPage::withTrashed()
        ->where('id', $id)
        ->restore();
        return redirect()->back()->with('status', 'Bạn đã khôi phục thành công');
    }

    public function detail_trash($id) {
        $page = AdminPage::withTrashed()
        ->where('id', $id)
        ->find($id);
        return view('admin.page.detail', compact('page'));
    }
    function add() {
        return view('admin.page.add');
    }

    function store(Request $request) {
        // return $request->input();
        if ($request->input('btn-add')) {
            $request->validate(
                [
                    'title' => 'required',
                    // 'slug' => 'required',
                    'content' => 'required'
                ],
                [
                    'required' => ':attribute không được để trống!'
                ],
                [
                    'title' => 'Tiêu đề',
                    'content' => 'Nội dung'
                ]

            );
            AdminPage::create([
                'title' => $request->title,
                'active_page' => $request->active_page,
                'content' => $request->content,
                'slug' => Str::of($request->title)->slug('-'),

            ]);
            return redirect('admin/page/list')->with('status', 'Thêm trang mới thành công');

        }
        
    }

    public function delete($id) {
        $page = AdminPage::find($id);
        $page->delete();
        return redirect('admin/page/list')->with('status', 'Đã xóa trang thành công');
    }

    public function edit($id) {
        $page = AdminPage::find($id);
        return view('admin.page.edit', compact('page'));
    }

    function update(Request $request, $id) {
        $request->validate(
            [
                'title' => 'required',
                // 'slug' => 'required',
                'content' => 'required'
            ],
            [
                'required' => ':attribute không được để trống!'
            ],
            [
                'title' => 'Tiêu đề',
                'content' => 'Nội dung'
            ]
        );

        AdminPage::where('id', $id)->update([
            'title' => $request->title,
            'active_page' => $request->active_page,
            'content' => $request->content,
            'slug' => Str::of($request->title)->slug('-')
        ]);
        return redirect('admin/page/list')->with('status', 'Đã cập nhật thành công');
    }

    public function action(Request $request) {
        $list_check = $request->input('list_check');
        if ($list_check) {
            if (!empty($list_check)) {
                $act = $request->input('act');
                if ($act == 'delete') {
                    AdminPage::destroy($list_check);
                    return redirect('admin/page/list')->with('status', 'Đã xóa tạm thời thành công');

                }
                if ($act == 'restore') {
                    AdminPage::withTrashed()
                    ->whereIn('id', $list_check)
                    ->restore();
                    return redirect('admin/page/list')->with('status', 'Bạn đã khôi phục thành công');

                }
                if ($act == 'forceDelete') {
                    AdminPage::withTrashed()
                    ->whereIn('id', $list_check)
                    ->forceDelete();
                    return redirect('admin/page/list')->with('status', 'Đã xóa vĩnh viễn thành công');
                }
            }
            return redirect()->back()->with('status', 'Cần lựa chọn tác vụ!');
        } else {
            return redirect()->back()->with('status', 'Bạn chưa lựa chọn trang!');
        }
    }

    public function detail($id) {
        $page = AdminPage::find($id);
        return view('admin.page.detail', compact('page'));
    }
}
