@extends('layouts.admin')
@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold">
                Cập nhật trang 
            </div>
            <div class="card-body">
                <form method="POST" action="{{route('update.page', $page->id)}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="title">Tiêu đề trang</label>
                        <input class="form-control mb-2" type="text" value="{{ $page->title }}" onkeyup="ChangeToSlug();" name="title" id="slug">
                        @error('title')
                            <small class="alert alert-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="slug">Slug</label>
                        <input class="form-control mb-2" type="text" value="{{ $page->slug }}" name="slug" id="convert_slug">
                        @error('slug')
                            <small class="alert alert-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="content">Nội dung bài viết</label>
                        <textarea name="content" class="form-control mb-2 text-content" value=""  id="content" cols="30" rows="5">{!!$page->content!!}</textarea>
                        @error('content')
                            <small class="alert alert-danger">{{$message}}</small>
                        @enderror
                    </div>
                    {{-- <div class="form-group">
                        <label for="">Danh mục</label>
                        <select class="form-control" id="">
                        <option>Chọn danh mục</option>
                        <option>Danh mục 1</option>
                        <option>Danh mục 2</option>
                        <option>Danh mục 3</option>
                        <option>Danh mục 4</option>
                        </select>
                    </div> --}}
                    
                            <div class="form-group">
                                <label for="">Trạng thái</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="active_page" id="exampleRadios1" value="0" {{ $page->active_page == '0' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="exampleRadios1">
                                    Chờ duyệt
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="active_page" id="exampleRadios2" value="1" {{ $page->active_page == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="exampleRadios2">
                                    Công khai
                                    </label>
                                </div>
                                    
                            </div>
                    <button type="submit" name="btn-update" value="Cập nhật" class="btn btn-primary">Cập nhật</button>
                </form> 
            </div>
        </div>
    </div>
@endsection


