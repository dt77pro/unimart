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
                Tạo liên hệ mới
            </div>
            <div class="card-body">
                <form  action="{{url('admin/contact/store')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="category">Danh mục</label>
                        <input class="form-control mb-2" type="text" value="{{ old('category') }}"  name="category" required> 
                        @error('category')
                            <small class="alert alert-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="address">Địa chỉ</label>
                        <input class="form-control mb-2" type="text" value="{{ old('address') }}" name="address" required>
                        @error('address')
                            <small class="alert alert-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="hotline">Hotline</label>
                        <input class="form-control mb-2" type="number" value="{{ old('hotline') }}" max="10" name="hotline" required>
                        @error('hotline')
                            <small class="alert alert-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="content">Mô tả</label>
                        <textarea name="description" class="form-control mb-2 text-content" id="content" cols="30" rows="5" required>{!! old('description') !!}</textarea>
                        @error('description')
                            <small class="alert alert-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <button type="submit" name="add-contact" value="Thêm mới" class="btn btn-primary">Thêm mới</button>
                </form> 
            </div>
        </div>
    </div>
@endsection


