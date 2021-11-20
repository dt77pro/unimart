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
                Cập nhật thông tin liên hệ
            </div>
            <div class="card-body">
                <form  action="{{url('admin/contact/update', $contact->id)}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="category">Danh mục</label>
                        <input class="form-control mb-2" type="text" value="{{ $contact->category }}"  name="category" > 
                        @error('category')
                            <small class="alert alert-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="address">Địa chỉ</label>
                        <input class="form-control mb-2" type="text" value="{{ $contact->address }}" name="address">
                        @error('address')
                            <small class="alert alert-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="hotline">Hotline</label>
                        <input class="form-control mb-2" type="number" value="{{ $contact->hotline }}" maxlength="10" name="hotline">
                        @error('hotline')
                            <small class="alert alert-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="content">Mô tả</label>
                        <textarea name="description" class="form-control mb-2 text-content" id="content" cols="30" rows="5">{!! $contact->description !!}</textarea>
                        @error('description')
                            <small class="alert alert-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <button type="submit" name="update-contact" value="Cập nhật" class="btn btn-primary">Cập nhật</button>
                </form> 
            </div>
        </div>
    </div>
@endsection


