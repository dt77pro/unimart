@extends('layouts.admin')
@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        @if (session('status'))
            <div class="alert alert-success">
                <p>{{session('status')}}</p>
            </div>
        @endif 
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0 ">Danh sách sản phẩm</h5>
            <div class="form-search form-inline">
                <form action="#">
                    <input type="" class="form-control form-search" value="{{request()->input('keyword')}}" name="keyword" placeholder="Tìm kiếm">
                    <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="analytic">
                <a href="{{route('product.list')}}" class="text-primary">Danh sách<span class="text-muted">({{$count_total_products}})</span></a>
                <a href="{{route('product.status', ['act' => 'public'])}}" class="text-primary">Công khai<span class="text-muted">({{$count_status_public}})</span></a>
                <a href="{{route('product.status', ['act' => 'pending'])}}" class="text-primary">Chờ duyệt<span class="text-muted">({{$count_status_pending}})</span></a>
                <a href="{{route('product.trash')}}" class="text-primary">Thùng rác<span class="text-muted">({{$count_product_trash}})</span></a>
            </div>
            <form action="{{route('product.action')}}" method="POST">
                @csrf
                <div class="form-action form-inline py-3">
                    @can('action-product')
                        <select class="form-control mr-1" name="action">
                            <option>Chọn tác vụ</option>
                            @foreach ($list_act as $key => $act)
                                <option value="{{$key}}">{{$act}}</option>
                            @endforeach
                        </select>
                    <input type="submit" name="btn-search" value="Áp dụng" class="btn btn-primary">
                    @endcan
                </div>
                <table class="table table-striped table-checkall">
                    <thead>
                        <tr>
                            <th scope="col">
                                <input name="checkall" type="checkbox">
                            </th>
                            <th scope="col">#</th>
                            <th scope="col">Ảnh</th>
                            <th scope="col">Tên sản phẩm</th>
                            <th scope="col">Giá</th>
                            <th scope="col">Danh mục</th>
                            <th scope="col">Ngày tạo</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">Tác vụ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($products->count() > 0)
                            @foreach ($products as $key => $product)
                                <tr>
                                    <td>
                                        <input type="checkbox" name="list_check[]" value="{{$product->id}}">
                                    </td>
                                    <td>{{$products->firstItem() + $key}}</td>
                                    <td><img src="{{asset($product->featured_img_path)}}" width="100" height="100"></td>
                                    <td><a href="#" class="text text-dark">{{Str::limit($product->name, 22)}}</a></td>
                                    <td><span class="text text-danger">{{number_format($product->price, 0, '', '.')}}₫</span></td>
                                    <td>
                                        <?php $cate_product = DB::table('product_categories')->where('id',$product['cate_id'])->first(); ?> 
                                        @if (!empty($cate_product->name))
                                            {{$cate_product->name}}
                                        @endif
                                    </td>
                                    <td>{{$product->created_at}}</td>
                                    <td>
                                        <span style="font-size: 13px" class="badge {{$product->getStatus($product->status)['class']}}">{{$product->getStatus($product->status)['name']}}</span>
                                    </td>
                                    <td>
                                        @can('restore-product')
                                            <a href="{{route('product.restore', $product->id)}}" onclick="return confirm('Bạn có chắc chắn muốn khôi phục sản phẩm này không?')"><button style="font-size: 1rem" class="btn btn-success btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Khôi phục"><i class="far fa-trash-undo"></i></button></a>
                                        @endcan
                                        @can('forceDelete-product')
                                            <a href="{{route('product.forceDelete', $product->id)}}" onclick="return confirm('Bạn có chắc chắn muốn xóa vĩnh viễn sản phẩm này không?')"><button style="font-size: 1rem" class="btn btn-danger btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Xóa vĩnh viễn"><i class="far fa-trash-alt fa-1x"></i></button></a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="10" class="text-danger">Không tìm thấy kết quả {{Request::input('keyword')}} nào!</td>
                            </tr>
                        @endif
                        
                    </tbody>
                </table>
            </form>
            {{$products->links()}}
        </div>
    </div>
</div>   
@endsection
