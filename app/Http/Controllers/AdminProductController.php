<?php

namespace App\Http\Controllers;

use App\Models\AdminProduct;
use App\Models\AdminProductCategory;
use App\Models\ProductImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Traits\StorageImagesTrait;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;


class AdminProductController extends Controller
{

    use StorageImagesTrait;
    //
    function __construct()
    {
        $this->middleware(function($request, $next) {
            session(['module_active' => 'product']);
            return $next($request);
        });
    }
    public function list(Request $request) {
        $page = 5;
        $status_products = $request->input('status');
        $list_act = [
            'delete' => 'Xóa tạm thời'
        ];
        if ($status_products) {
            switch ($status_products) {
                case '1':
                    $products = AdminProduct::where('status', 1)->orderBy('id', 'desc')->paginate($page)->withQueryString();                     
                    break;
                case '2':
                    $products = AdminProduct::where('status', 2)->orderBy('id', 'desc')->paginate($page)->withQueryString();                     
                    break;
            }   
            
        } else {
            $keyword = "";
            if ($request->input('keyword')) {
                $keyword = $request->input('keyword');
            }
            $products = AdminProduct::where('name', 'LIKE', "%$keyword%")->orderBy('id', 'desc')->paginate($page);

        }
       
        $count_status_public = AdminProduct::where('status', 'public')->count();
        $count_status_pending = AdminProduct::where('status', 'pending')->count();
        $count_product_trash = AdminProduct::onlyTrashed()->count();
        $count_total_products = AdminProduct::count();
        return view('admin.product.list_product', compact('products', 'count_status_public', 'count_status_pending', 'count_total_products', 'count_product_trash', 'list_act'));
    }
    
    public function add() {
        $cate = AdminProductCategory::all();
        return view('admin.product.add_product', compact('cate',));
    }

    public function store(Request $request) {
        if ($request->input('btn-add')) {
            $this->validate($request,
                [
                    'name'        => 'required|min:2|max:255|unique:products|string',
                    'price'       => 'required|numeric',
                    'qty'       => 'required|numeric',
                    'description' => 'required|max:255',
                    'content'     => 'required',
                    'file_name'   => 'required|mimes:jpeg,jpg,png,gif|image',
                    // 'file_path'   => 'required|mimes:jpeg,jpg,png,gif|image',
                    'parent_id'   => 'required'
                ],
                [
                    'required'          => ':attribute không được để trống!',
                    'name.min'          => 'Tên sản phẩm phải lớn hơn :min kí tự!',
                    'name.unique'       => 'Tên sản phẩm đã tồn tại',
                    'price.numeric'     => 'Dữ liệu nhập phải có dạng chữ số',
                    'file_name.mimes'   => 'Định dạng file ảnh có dạng jpeg,jpg,png,gif!'

                ],
                [
                    'name'          => 'Tên sản phẩm',      
                    'price'         => 'Giá sản phẩm',
                    'qty'         => 'Số lượng sản phẩm',
                    'content'       => 'Chi tiết sản phẩm',
                    'description'   => 'Mô tả sản phẩm',
                    'file_name'     => 'Hình ảnh sản phẩm',
                    'parent_id'     => 'Danh mục sản phẩm'
                ]
           );

            $data = new AdminProduct;

            $dataUpload = $this->storageUploadFile($request, 'file_name', 'product');
            $data->featured_img_path =  $dataUpload['file_path'];
            $data->featured_img_name = $dataUpload['file_name'];

            $data->name = $request->name;
            $data->slug = $request->slug;
            $data->description = $request->description;
            $data->content = $request->content;
            $data->cate_id = $request->parent_id;
            $data->status = $request->status;
            $data->qty = $request->qty;
            $data->price = $request->price;
            $data->hot = $request->hot;
            $data->user_id = auth()->id();
            $data->save();

            $product_id = $data->id;
            if ($request->hasFile("images_detail")) {
                foreach ($request->file("images_detail") as $file) {
                    $product_img = new ProductImages();
                    if (isset($file)) {
                        $product_img->product_id = $product_id;
                        $product_img->image = $file->getClientOriginalName();
                        $file->move('public/storage/product_detail/', $file->getClientOriginalName());
                        $product_img->save();
                    }
                }
            }
            return redirect('admin/product/list')->with('status', 'Thêm sản phẩm mới thành công');
        }
        
    }

    public function status(Request $request, $act) {
        $list_act = [
            'delete' => 'Xóa tạm thời'
        ];
        $keyword = "";
        if ($request->input('keyword')) {
            $keyword = $request->input('keyword');
        }
        switch ($act) {
           case 'public':
                $products = AdminProduct::where('status', 'public')->where('name', 'LIKE', "%{$keyword}%")->paginate(4);
                break;
           case 'pending':
               $products = AdminProduct::where('status', 'pending')->where('name', 'LIKE', "%{$keyword}%")->paginate(4);
               break;
        }
        
        $count_status_public = AdminProduct::where('status', 'public')->count();
        $count_status_pending = AdminProduct::where('status', 'pending')->count();
        $count_product_trash = AdminProduct::onlyTrashed()->count();
        $count_total_products = AdminProduct::count();
        return view('admin.product.list_product', compact('products', 'count_status_public', 'count_status_pending', 'count_total_products', 'count_product_trash', 'list_act'));


    }

    public function update_status($id) {
        $product = AdminProduct::find($id);
        if ($product->status == 'public') {
            $status = 'pending';
        } else {
            $status = 'public';
        }
        $data = array('status' => $status);
        AdminProduct::where('id', $id)->update($data);
            
        return redirect()->back();
    }

    public function hot($id) {
        $product = AdminProduct::find($id);
        $product->hot = !$product->hot;
        $product->save();
        return redirect()->back();
    }

    public function delete($id) {
        $product = AdminProduct::find($id);
        $product->delete();
        return redirect('admin/product/list')->with('status', 'Xóa sản phẩm  thành công');
    }

    public function edit($id) {
        $product = AdminProduct::find($id);
        $cate = AdminProductCategory::all();
        $product_img_detail = AdminProduct::find($id)->product_images->toArray();
        return view('admin.product.edit_product', compact('product', 'cate', 'product_img_detail'));
    }

    public function delImg(Request $request, $id) {
        if ($request->ajax()) {
            $id_img = (int)$request->get('id_img');
            $img_detail = ProductImages::find($id);
            
            if (!empty($img_detail)) {
                $img = ('public/storage/product_detail/'.$img_detail->image);
                // return $img;
                if (!empty($img)) {
                    File::delete($img);
                }
                $img_detail->delete();
            }
            return true;
        }
    }
    public function update(Request $request, $id) {
        if ($request->input('btn-update')) {
                $this->validate($request,
                [
                    'name'        => 'required|min:2|max:255|string',
                    'price'       => 'required|numeric',
                    'qty'         => 'required|numeric',
                    'description' => 'required|max:255',
                    'content'     => 'required',
                    'file_name'   => 'required|mimes:jpeg,jpg,png,gif|image',
                    // 'file_path'   => 'required|mimes:jpeg,jpg,png,gif|image',
                    'parent_id'   => 'required'
                ],
                [
                    'required'          => ':attribute không được để trống!',
                    'name.min'          => 'Tên sản phẩm phải lớn hơn :min kí tự!',
                    'price.numeric'     => 'Dữ liệu nhập phải có dạng chữ số',
                    'file_name.mimes'   => 'Định dạng file ảnh có dạng jpeg,jpg,png,gif!'

                ],
                [
                    'name'          => 'Tên sản phẩm',      
                    'price'         => 'Giá sản phẩm',
                    'qty'           => 'Số lượng sản phẩm',
                    'content'       => 'Chi tiết sản phẩm',
                    'description'   => 'Mô tả sản phẩm',
                    'file_name'     => 'Hình ảnh sản phẩm',
                    'parent_id'     => 'Danh mục sản phẩm'
                ]
        );

            

            $data = AdminProduct::find($id);

            $data->name = $request->name;
            $data->slug = $request->slug;
            $data->description = $request->description;
            $data->content = $request->content;
            $data->cate_id = $request->parent_id;
            $data->status = $request->status;
            $data->qty = $request->qty;
            $data->price = $request->price;
            $data->user_id = auth()->id();

            $dataUpload = $this->storageUploadFile($request, 'file_name', 'product');
            if (!empty($dataUpload)) {
                unlink('public'.'/'.$data->featured_img_path);
            }
            $data->featured_img_path =  $dataUpload['file_path'];
            $data->featured_img_name = $dataUpload['file_name'];

            $data->save();

            if ($request->hasFile("images_detail")) {
                foreach ($request->file("images_detail") as $file) {
                    $product_img = new ProductImages();
                    if (isset($file)) {
                        $product_img->product_id = $id;
                        $product_img->image = $file->getClientOriginalName();
                        $file->move('public/storage/product_detail/', $file->getClientOriginalName());
                        $product_img->save();
                    }
                }
            }
            return redirect('admin/product/list')->with('status', 'Cập nhật sản phẩm thành công');

        }
    }

    public function detail($id) {
        $product = AdminProduct::where('id', $id)->first();
        $product_img_detail = AdminProduct::find($product->id)->product_images()->get();
        return view('admin.product.detail_product', compact('product', 'product_img_detail'));
    }

    public function trash(Request $request) {
        $page = 5;
        $keyword = "";
        if ($request->input('keyword')) {
            $keyword = $request->input('keyword');
        }
        $list_act = [
            'restore' => 'Khôi phục',
            'forceDelete' => 'Xóa vĩnh viễn'
        ];
        $products = AdminProduct::where('name', 'LIKE', "%{$keyword}%")->onlyTrashed()->paginate($page);
        $count_product_trash = AdminProduct::onlyTrashed()->count();
        $count_status_public = AdminProduct::where('status', 'public')->count();
        $count_status_pending = AdminProduct::where('status', 'pending')->count();
        $count_total_products = AdminProduct::count();
        return view('admin.product.trash_product', compact('count_product_trash', 'products', 'count_total_products', 'count_status_public', 'count_status_pending', 'list_act'));
    }

    public function restore_trash($id) {
        AdminProduct::withTrashed()
        ->where('id', $id)
        ->restore();
        return back()->with('status', 'Bạn đã khôi phục sản phẩm thành công');
    }

    public function forceDelete_trash($id) {
       
        $product = AdminProduct::withTrashed()
        ->where('id', $id)->find($id);
        $product_img_detail = AdminProduct::withTrashed()->where('id', $id)->find($id)->product_images->toArray();
        foreach ($product_img_detail as $value) {
            File::delete('public/storage/product_detail/'.$value['image']);
        }
        $product_images = $product->featured_img_name;
        $product_images_path = $product->featured_img_path;
        if ($product_images_path) {
            unlink('public'.'/'.$product->featured_img_path);
        }
        $product->forceDelete();
        return back()->with('status', 'Xóa vĩnh viễn sản phẩm thành công');
    }

    public function action(Request $request) {
        $list_check = $request->input('list_check');
        if ($list_check) {
            if (!empty($list_check)) {
                $act = $request->input('action');
                if ($act == 'delete') {
                    AdminProduct::destroy($list_check);
                    return redirect('admin/product/list')->with('status', 'Xóa sản phẩm tạm thời thành công');

                }
                if ($act == 'restore') {
                    AdminProduct::withTrashed()
                    ->whereIn('id', $list_check)
                    ->restore();
                    return redirect('admin/product/list')->with('status', 'Khôi phục sản phẩm thành công');

                }
                if ($act == 'forceDelete') {
                    AdminProduct::withTrashed()
                    ->whereIn('id', $list_check)
                    ->forceDelete();
                    return redirect('admin/product/list')->with('status', 'Xóa vĩnh viễn sản phẩm thành công');
                }
               
            } 
            return redirect('admin/product/list')->with('status', 'Cần lựa chọn tác vụ!');
            
        } else {
            return redirect()->back()->with('status', 'Cần lựa chọn sản phẩm!');
        }
    }
}
