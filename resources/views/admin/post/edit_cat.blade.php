@extends('layouts.admin')
@section('content')
    <div id="content" class="container-fluid">
        @include('show_error')
        <div class="row">
                @csrf
            <div class="col-4">
                <div class="card">
                    <div class="card-header font-weight-bold">
                        Cập nhật danh mục
                    </div>
                    <div class="card-body">
                        <form action="{{route('post_cat.update',$category->id)}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">Tên danh mục</label> 
                                <input class="form-control" type="text" name="name" value="{!! old('name', isset($category) ? $category['name'] : '')  !!}" id="slug" onkeyup="ChangeToSlug();">
                                
                            </div>
                            @error('name')
                                <small class="alert alert-danger message">{{$message}}</small>
                            @enderror
                            
                            <div class="form-group">
                                <label for="name">Slug đường dẫn</label>
                                <input class="form-control" type="text" value="{!! old('slug', isset($category) ? $category['slug'] : '')  !!}" name="slug" id="convert_slug">
                            </div>
                            @error('slug')
                                <small class="alert alert-danger message">{{$message}}</small>
                            @enderror
                            
                            <div class="form-group">
                                <label for="">Danh mục cha</label>
                                <select class="form-control" name="parent_id">
                                    <option value="">Chọn danh mục</option>
                                    <?php
                                        cate_parent($select_post_cate,0,'',$category->parent_id);
                                    ?>
                                </select>
                            </div>
                            <button type="submit" name="btn-update" value="Cập nhật danh mục" id="btn-update_category" class="btn btn-primary">Cập nhật</button>
                        </form>    
                    </div>
                </div>
            </div>
            <div class="col-8">
                <div class="card">
                    <div class="card-header font-weight-bold">
                        Danh mục bài viết
                    </div>
                    <div class="card-body">
                        <table class="table table-striped" name="parent_id">
                            <thead>
                                <tr>
                                    <th scope="col">Tên danh mục</th>
                                    <th scope="col">Slug</th>
                                    <th scope="col">Tác vụ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($parents as $parent)
                                    <tr>
                                        @if ($parent->parent_id == 0)
                                            <td style="color: #212529;font-size: 16px;font-weight: 600;">{{str_repeat('|---', $parent->level).' '.$parent->name}}</td>
                                        @else
                                            <td>{{str_repeat('|---', $parent->level).' '.$parent->name}}</td>
                                        @endif
                                        <td>{{$parent->slug}}</td>
                                        <td>
                                            @can('update-post-cate')
                                                <a href="{{route('post_cat.edit', $parent->id)}}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                                            @endcan
                                            @can('delete-post-cate')
                                                <a href="{{route('post_cat.delete', $parent->id)}}" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirm('Bạn chắc chắn muốn xóa bài viết này!')"><i class="fa fa-trash"></i></a>
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


