@extends('layouts.admin')
@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold">
                Thêm thành viên
            </div>
            <div class="card-body">
                <form method="POST" action="{{url('admin/user/store')}}">
                    @csrf
                    <div class="form-group">
                        <label for="name">Họ và tên</label>
                        <input class="form-control mb-3" type="text" value="{{request()->input('name')}}" name="name" id="name">
                        @error('name')
                            <small class="alert alert-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input class="form-control mb-3" type="text" value="{{request()->input('username')}}" name="username" id="username">
                        @error('username')
                            <small class="alert alert-danger">{{$message}}</small>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input class="form-control mb-3" value="{{request()->input('email')}}"  type="text" name="email" id="email">
                        @error('email')
                            <small class="alert alert-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="password">
                        <label for="email">Mật khẩu</label>
                        <input class="form-control mb-3" type="password" name="password" id="password">
                        @error('password')
                            <small class="alert alert-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group mt-3">
                        <label for="confirm-password">Xác nhận mật khẩu</label>
                        <input class="form-control" type="password" name="password_confirmation" id="confirm-password">
                        @error('confirm-password')
                            <small class="alert alert-danger">{{$message}}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">Nhóm quyền</label>
                        <select class="form-control select-role" name="role_id[]" multiple="multiple">
                            <option value=""></option> 
                            @foreach ($roles as $role)
                               <option value="{{$role->id}}">{{$role->name}}</option>
                            @endforeach
                        </select> 
                    </div>

                    <button type="submit" name="btn-add" value="Thêm mới" class="btn btn-primary">Thêm mới</button>
                </form>
            </div>
        </div>
    </div>  
@endsection
