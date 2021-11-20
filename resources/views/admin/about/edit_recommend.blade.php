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
                Cập nhật thông tin giới thiệu
            </div>
            <div class="card-body">
                <form  action="{{url('admin/recommend/update', $recommend->id)}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="content">Nội dung</label>
                        <textarea name="content" class="form-control mb-2 text-content" id="content" cols="30" rows="5">{!! $recommend->content !!}</textarea>
                    </div>
                    <button type="submit" name="update-recommend" value="Cập nhật" class="btn btn-primary">Cập nhật</button>
                </form> 
            </div>
        </div>
    </div>
@endsection


