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

                    <form action="{{route('cat_product.add')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Tên danh mục</label>
                            <input class="form-control" type="text" name="name" id="slug" onkeyup="ChangeToSlug();">
                        </div>
                        
                        <div class="form-group">
                            <label for="slug">Slug đường dẫn</label>
                            <input class="form-control" type="text" name="slug" id="convert_slug">
                        </div>
                        
                        <div class="form-group">
                            <label for="parent_id">Danh mục cha</label>
                            <select class="form-control" name="parent_id">
                                <option value="0">Chọn danh mục</option>
                                @php
                                    cate_parent($parent);
                                @endphp
                            </select>
                        </div>
                        
                        <button type="submit" name="btn-add" value="Thêm danh mục sản phẩm" class="btn btn-primary">Thêm mới</button>
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
                            @foreach($categories as $category)
                                <tr>
                                    @if ($category->parent_id == 0)
                                        <td style="color: #212529;font-size: 16px;font-weight: 600;">{{str_repeat('|---', $category->level).' '.$category->name}}</td>
                                    @else
                                        <td>{{str_repeat('|---', $category->level).' '.$category->name}}</td>
                                    @endif
                                    <td>{{$category->slug}}</td>
                                    <td>
                                        @can('update-product-cate')
                                            <a href="{{route('cat_product.edit', $category->id)}}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                                        @endcan
                                        @can('delete-product-cate')
                                            <a href="{{route('cat_product.delete', $category->id)}}" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirm('Bạn chắc chắn muốn sản phẩm này không!')"><i class="fa fa-trash"></i></a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach 
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
