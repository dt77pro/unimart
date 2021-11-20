@extends('layouts.admin')
@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            <h4>Thêm bài viết</h4>
        </div>
        <div class="card-body">
            <form action="{{url('admin/post/store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="title"><h5 class="text-primary">Tiêu đề bài viết</h5></label>
                            <input class="form-control mb-2" type="text" name="title" value="{{old('title')}}" id="slug" onkeyup="ChangeToSlug();">
                            @error('title')
                                <small class="alert alert-danger message">{{$message}}</small>
                            @enderror
                        </div>
        
                        <div class="form-group">
                            <label for="slug"><h5 class="text-primary">Slug</h5></label>
                            <input class="form-control mb-2" type="text" name="slug" id="convert_slug">
                            @error('slug')
                                <small class="alert alert-danger message">{{$message}}</small>
                            @enderror
                        </div>
        
                        <div class="form-group">
                            <label for="thumbnail"><h5 class="text-primary">Hình ảnh bài viết</h5></label>
                            <input class="form-control mb-2" type="file" name="thumbnail" id="thumbnail">
                            @error('thumbnail')
                                <small class="alert alert-danger message">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                   
                    <div class="col-6">
                        <div class="form-group">
                            <label for="description"><h5 class="text-primary">Mô tả bài viết</h5></label>
                            <textarea class="form-control mb-2" id="description" name="description" cols="30" rows="5">{!!old('description')!!}</textarea>
                            @error('description')
                                <small class="alert alert-danger message">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                    <div class="form-group">
                        <label for="content"><h5 class="text-primary">Nội dung bài viết</h5></label>
                        <textarea class="form-control text-content mb-3" id="content" name="content"  cols="30" rows="5">{!!old('content')!!}</textarea>
                        @error('content')
                            <small class="alert alert-danger message">{{$message}}</small>
                        @enderror
                    </div>
    
                <div class="form-group">
                    <label for=""><h5 class="text-primary">Danh mục</h5></label>
                    <select class="form-control" name="parent_id">
                        <option value="">Chọn danh mục</option>
                        @php
                            cate_parent($cate,0,'',old('parent_id'))
                        @endphp
                    </select>
                    @error('parent_id')
                        <small class="alert alert-danger message">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="status"><h5 class="text-primary">Trạng thái</h5></label>
                    @if (Auth::user()->roles->first()->name === "Admin")
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="exampleRadios1" value="pending" checked>
                            <label class="form-check-label" for="exampleRadios1">
                                Chờ duyệt
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="exampleRadios2" value="public">
                            <label class="form-check-label" for="exampleRadios2">
                                Công khai
                            </label>
                        </div>
                    @else
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="exampleRadios1" value="pending" checked>
                            <label class="form-check-label" for="exampleRadios1">
                                Chờ duyệt
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="exampleRadios2" value="public" disabled>
                            <label class="form-check-label" for="exampleRadios2">
                                Công khai
                            </label>
                        </div>
                    @endif
                </div>
                <button type="submit" name="btn-add" value="Thêm mới bài viết" class="btn btn-primary">Thêm mới</button>
            </form>
        </div>
    </div>
</div>
@endsection
