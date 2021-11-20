@extends('layouts.admin')
@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold">
                Thêm trang
            </div>
            <div class="card-body">
                <form  action="{{url('admin/page/store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="title">Tiêu đề trang</label>
                        <input class="form-control mb-2" type="text" value="{{ old('title') }}" onkeyup="ChangeToSlug();" name="title" id="slug">
                        @error('title')
                            <small class="alert alert-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="slug">Slug</label>
                        <input class="form-control mb-2" type="text" value="{{ old('slug') }}" name="slug" id="convert_slug">
                        @error('slug')
                            <small class="alert alert-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="content">Nội dung bài viết</label>
                        <textarea name="content" class="form-control mb-2 text-content" id="content" cols="30" rows="5">{!! old('content') !!}</textarea>
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
                                    <input class="form-check-input" type="radio" name="active_page" id="exampleRadios1"  value="0" checked>
                                    <label class="form-check-label" for="exampleRadios1">
                                    Chờ duyệt
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="active_page" id="exampleRadios2"   value="1" >
                                    <label class="form-check-label" for="exampleRadios2">
                                    Công khai
                                    </label>
                                </div>
                            </div>
                    <button type="submit" name="btn-add" value="Thêm mới" class="btn btn-primary">Thêm mới</button>
                </form> 
            </div>
        </div>
    </div>
@endsection


