@extends('layouts.admin')
@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="card-header font-weight-bold">
            Cập nhật sản phẩm
        </div>
        <div class="card-body">
            <form action="{{route('product.update', $product->id)}}" name="formEditProduct" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <div class="form-group text text-primary">
                            <label for="name">Tên sản phẩm</label>
                            <input class="form-control" type="text" name="name" value="{{$product->name}}" id="slug" onkeyup="ChangeToSlug();">
                        </div>

                        <div class="form-group text text-primary">
                            <label for="slug">Slug</label>
                            <input class="form-control" type="text" name="slug" value="{{$product->slug}}" id="convert_slug">
                        </div>

                        <div class="form-group text text-primary">
                            <label for="thumbnail">Hình ảnh cũ</label><br>
                            <img src="{{asset($product->featured_img_path)}}" height="120" alt="">
                        </div>

                        <div class="form-group">
                            <label class="text text-primary">Hình ảnh mới</label><br> 
                            <input type="file" name="file_name">
                        </div>

                        <div class="form-group">
                            <label for="file_name">Số lượng sản phẩm</label>
                            <input class="form-control" type="number" name="qty" value="{{($product->qty)}}">
                        </div>

                        <div class="form-group text text-primary">
                            <label for="price">Giá</label>
                            <input class="form-control" type="number" value="{{$product->price}}" name="price" >
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group text text-primary col-md-12">
                            <label for="description">Mô tả sản phẩm</label>
                            <textarea class="form-control" name="description" cols="30" rows="5">{{$product->description}}</textarea>
                        </div>

                        <div class="form-group col-md-12">
                            <label class="text text-primary">Ảnh chi tiết</label><br>
                            <?php
                                foreach ($product_img_detail as $key => $item) {
                                   ?>
                                        <div class="form-group d-inline-block" id="{{$key}}">
                                            <img src="{!!asset('/storage/product_detail/'.$item['image'])!!}" class="product_img_detail" height="200" width="200" id="{{$key}}" id_img="{{$item['id']}}">
                                            <a href="javascript:void(0)" type="button" id="delete-img" class="btn btn-danger icon-del"><i class="fa fa-times"></i></a>
                                        </div>
                                <?php
                                }
                            ?>
                            <div class="mt-1">
                                <button type="button" class="border border-none text text-primary" id="add-images">Thêm ảnh</button>
                                <div id="insert-images"></div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="form-group text text-primary">
                    <label for="content">Chi tiết sản phẩm</label>
                    <textarea class="form-control text-content mb-3" id="content" name="content" >{!!$product->content!!}</textarea>
                </div>


                <div class="form-group text text-primary">
                    <label for="">Danh mục</label>
                    <select class="form-control" name="parent_id">
                        @php
                            cate_parent($cate,0,'',$product->cate_id);
                        @endphp
                        
                    </select>
                </div>
                <button type="submit" name="btn-update" value="Cập nhật sản phẩm" class="btn btn-primary">Cập nhật sản phẩm</button>
            </form>
        </div>
    </div>
</div> 
@endsection
