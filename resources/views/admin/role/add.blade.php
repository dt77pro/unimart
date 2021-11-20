@extends('layouts.admin')
@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold">
                Thêm vai trò quản trị
            </div>
            <div class="card-body">
                <form method="POST" action="{{route('role.store')}}">
                    @csrf
                    <div class="form-group">
                        <label for="name">Tên vai trò</label>
                        <input class="form-control mb-3" type="text" value="" name="name" id="name">
                        @error('name')
                            <small class="alert alert-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="username">Mô tả</label>
                        <textarea class="form-control mb-3" type="text" value="" name="display_name" id="username"></textarea>
                        @error('username')
                            <small class="alert alert-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label>
                                <input type="checkbox" class="check-all-wrapper" style="cursor: pointer">
                                    Chọn tất cả
                            </label>
                        </div>
                        @foreach($permissionParent as $permissionParentItem)
                        <div class="card mb-3 col-md-12" style="border: none!important;">
                            <div class="card-header" style="background-color: rgb(21, 179, 214); color: #333">
                                <label>
                                    <input type="checkbox" value="" class="checkbox_wrapper" style="cursor: pointer">
                                </label>
                                Module {{$permissionParentItem->name}}
                            </div>
                            <div class="row">
                                @foreach($permissionParentItem->permissionsChildren as $permissionChildrenItem)
                                    <div class="card-body text-primary col-md-3">
                                        <h5 class="card-title">
                                            <label>
                                                <input type="checkbox" name="permission_id[]"
                                                    class="checkbox_children"
                                                    value="{{$permissionChildrenItem->id}}" style="cursor: pointer">
                                            </label>
                                            <span style="font-size: 15px; color: #333">{{ $permissionChildrenItem->name }}</span>
                                        </h5>
                                    </div>
                                @endforeach
                            </div>
                            <hr>
                        </div>
                        @endforeach
                    </div>

                    <button type="submit" name="btn-add" value="Thêm mới" class="btn btn-primary">Thêm mới</button>
                </form>
            </div>
        </div>
    </div>  
@endsection
