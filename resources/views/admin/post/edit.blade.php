@extends('layouts.admin')
@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            <h4>Cập nhật bài viết</h4>
        </div>
        <div class="card-body">
            <form action="{{route('post.update', $post->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="title"><h5 class="text-primary">Tiêu đề bài viết</h5></label>
                            <input class="form-control mb-2" type="text" name="title" value="{{$post->title}}" id="slug" onkeyup="ChangeToSlug();">
                            @error('title')
                                <small class="alert alert-danger">{{$message}}</small>
                            @enderror
                        </div>
        
                        <div class="form-group">
                            <label for="slug"><h5 class="text-primary">Slug</h5></label>
                            <input class="form-control mb-2" type="text" name="slug" value="{{$post->slug}}" id="convert_slug">
                            @error('slug')
                                <small class="alert alert-danger">{{$message}}</small>
                            @enderror
                        </div>
        
                        <div class="form-group">
                            <label for="thumbnail"><h5 class="text-primary">Hình ảnh bài viết</h5></label>
                            <input class="form-control mb-2" type="file" name="thumbnail" id="thumbnail">
                            <a href="{{route('post.edit', $post->id)}}" class="d-block"><img src="{{url($post->thumbnail)}}" alt="" height="100" width="100"></a>
                            @php
                                echo $post->thumbnail;
                            @endphp
                            @error('thumbnail')
                                <small class="alert alert-danger">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                   
                    <div class="col-6">
                        <div class="form-group">
                            <label for="description"><h5 class="text-primary">Mô tả bài viết</h5></label>
                            <textarea class="form-control mb-2" id="description" name="description" cols="30" rows="5">{!!$post->description!!}</textarea>
                            @error('description')
                                <small class="alert alert-danger">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                    <div class="form-group">
                        <label for="content"><h5 class="text-primary">Nội dung bài viết</h5></label>
                        <textarea class="form-control text-content mb-3" id="content" name="content"  cols="30" rows="5">{!!$post->content!!}</textarea>
                        @error('content')
                            <small class="alert alert-danger">{{$message}}</small>
                        @enderror
                    </div>
    
                <div class="form-group">
                    <label for=""><h5 class="text-primary">Danh mục</h5></label>
                    <select class="form-control" name="parent_id">
                        @php
                            cate_parent($cate,0,'',$post->cat_id)
                        @endphp
                    </select>
                </div>
                <button type="submit" name="btn-update" value="Cập nhật bài viết" class="btn btn-primary">Cập nhật</button>
            </form>
            
        </div>
    </div>
</div>
@endsection
