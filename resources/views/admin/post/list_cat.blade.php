@extends('layouts.admin')
@section('content')
    <div id="content" class="container-fluid">
        @include('show_error')
        <div class="row">
                @csrf
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
                        Thêm danh mục
                    </div>
                    <div class="card-body">
                        <form action="{{route('cat.add')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">Tên danh mục</label> 
                                <input class="form-control" type="text" value="{{old('name')}}" name="name" id="slug" onkeyup="ChangeToSlug();">
                                
                            </div>
                            
                            <div class="form-group">
                                <label for="name">Slug đường dẫn</label>
                                <input class="form-control" type="text" name="slug" value="{{old('slug')}}" id="convert_slug">
                            </div>
                            
                            <div class="form-group">
                                <label for="">Danh mục cha</label>
                                <select class="form-control"  name="parent_id">
                                    <option value="0">Chọn danh mục</option>
                                    @php
                                        cate_parent($parents)
                                    @endphp
                                </select>
                            </div>
                            @can('add-post-cate')
                                <button type="submit" name="btn-add" value="Thêm danh mục" id="btn-add_category" class="btn btn-primary">Thêm mới</button>
                            @endcan
                        </form>    
                    </div>
                </div>
            </div>
            <div class="col-8">
                <div class="card">
                    <div class="card-header font-weight-bold">
                        Danh mục
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


