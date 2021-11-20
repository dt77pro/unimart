@extends('layouts.admin')
@section('content')
<div id="content" class="container-fluid">
    @include('show_error')
    <div class="row">
        <div class="col-4">
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
                    Danh mục sản phẩm
                </div>
                <div class="card-body">
                    <form action="{{route('cat_product.update', $category->id)}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="name">Tên danh mục</label>
                            <input class="form-control" type="text" name="name" value="{{$category->name}}" id="slug" onkeyup="ChangeToSlug();">
                        </div>
                        
                        <div class="form-group">
                            <label for="slug">Slug đường dẫn</label>
                            <input class="form-control" type="text" name="slug" value="{{$category->slug}}" id="convert_slug">
                        </div>
                        
                        <div class="form-group">
                            <label for="parent_id">Danh mục cha</label>
                            <select class="form-control" name="parent_id">
                                <option value="0">Chọn danh mục</option>
                                @php
                                    cate_parent($parent,0,'',$category->parent_id);
                                @endphp
                            </select>
                        </div>
                        
                        <button type="submit" name="btn-update" value="Cập nhật danh mục sản phẩm" class="btn btn-primary">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="card">
                <div class="card-header font-weight-bold">
                    Danh sách
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Tên danh mục</th>
                                <th scope="col">Slug</th>
                                <th scope="col">Tác vụ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($categories->count() > 0)
                                @php
                                    tableProductCategories($categories)
                                @endphp
                            @else
                                <tr>
                                    <td colspan="4" class="text-danger">Không tìm thấy danh mục sản phẩm nào!</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
