@extends('layouts.admin')
@section('content')
    <div id="content" class="container-fluid">
        @if (session('status'))
            <div class="alert alert-success">
                <p>{{session('status')}}</p>
            </div>
        @endif
        <div class="card">
            <div class="card-header font-weight-bold">
                Tạo giới thiệu mới
            </div>
            <div class="card-body">
                <form  action="{{url('admin/recommend/store')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="content">Nội dung</label>
                        <textarea name="content" class="form-control mb-2 text-content" id="content" cols="30" rows="5">{!! old('content') !!}</textarea> 
                        @error('content')
                            <div style="margin-top: 20px"></div>
                            <small class="alert alert-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <button type="submit" name="add-recommend" value="Thêm mới" class="btn btn-primary">Thêm mới</button>
                </form> 
            </div>
        </div>
    </div>
@endsection



