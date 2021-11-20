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
            Thêm sản phẩm
        </div>
        <div class="card-body">
            <form action="{{route('product.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="name">Tên sản phẩm</label>
                            <input class="form-control" type="text" name="name" value="{!!old('name')!!}" id="slug" onkeyup="ChangeToSlug();">
                        </div>

                        <div class="form-group">
                            <label for="slug">Slug</label>
                            <input class="form-control" type="text" name="slug" id="convert_slug">
                        </div>
                        
                        <div class="form-group">
                            <label for="file_name">Hình ảnh sản phẩm</label>
                            <input class="form-control" type="file" name="file_name">
                        </div>

                        <div class="form-group">
                            <label for="file_name">Số lượng sản phẩm</label>
                            <input class="form-control" type="number" name="qty">
                        </div>
                        
                        <div class="form-group">
                            <label for="price">Giá</label>
                            <input class="form-control" type="number"  value="{!!old('price')!!}" name="price" >
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group col-md-12">
                            <label for="description">Mô tả sản phẩm</label>
                            <textarea class="form-control" name="description" cols="30" rows="5">{!!old('description')!!}</textarea>
                        </div>
                        
                        <div class="form-group col-md-12">
                            <button type="button" class="border border-none" id="add-images">Thêm ảnh chi tiết</button>
                            <div id="insert-images"></div>
                            
                        </div>
                        
                    </div>
                    
                </div>
                
                <div class="form-group">
                    <label for="content">Chi tiết sản phẩm</label>
                    <textarea class="form-control text-content mb-3" id="content" name="content" >{!!old('content')!!}</textarea>
                </div>

                <div class="form-group">
                    <label for="hot">Sản phẩm nổi bật</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="hot" id="hot" value="1" style="cursor: pointer">
                        <label class="form-check-label" for="hot" style="cursor: pointer">
                            Hot
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="hot" value="2" id="none" checked style="cursor: pointer">
                        <label class="form-check-label" for="none" style="cursor: pointer">
                           None
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <label for="">Danh mục</label>
                    <select class="form-control" name="parent_id">
                        <option value="">Chọn danh mục</option>
                        @php
                            cate_parent($cate,0,'',old('parent_id'))
                        @endphp
                    </select>
                </div>
                <div class="form-group">
                    <label for="status">Trạng thái</label>
                    @if (Auth::user()->roles->first()->name === "Admin")
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" value="pending" id="pending" checked style="cursor: pointer">
                            <label class="form-check-label" for="pending" style="cursor: pointer">
                                Chờ duyệt
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="public" value="public" style="cursor: pointer">
                            <label class="form-check-label" for="public" style="cursor: pointer">
                                Công khai
                            </label>
                        </div>
                    @else
                        <div class="form-check" style="cursor: pointer">
                            <input class="form-check-input" type="radio" name="status" value="pending" id="pending" checked style="cursor: pointer">
                            <label class="form-check-label" for="pending" style="cursor: pointer">
                                Chờ duyệt
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="public" value="public" disabled style="cursor: pointer">
                            <label class="form-check-label" for="public" style="cursor: pointer">
                                Công khai
                            </label>
                        </div>
                    @endif
                  
                </div>
                <button type="submit" name="btn-add" value="Thêm mới sản phẩm" class="btn btn-primary">Thêm mới</button>
            </form>
        </div>
    </div>
</div> 
@endsection
