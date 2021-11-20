@extends('layouts.admin')
@section('content')
    <div id="content" class="container-fluid">
        @include('show_error')
        <div class="row">
            <div class="col-4">
                 <div class="card">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="card-header font-weight-bold">
                        Thêm danh mục
                    </div>
                    <div class="card-body">
                        <form action="{{route('permission.add')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">Tên danh mục</label> 
                                <input class="form-control" type="text" value="{{old('name')}}" name="name">
                                
                            </div>
                            
                            <div class="form-group">
                                <label for="name">Display_name</label>
                                <input class="form-control" type="text" name="display_name" value="{{old('display_name')}}">
                            </div>
                        
                            <div class="form-group">
                                <label for="name">Key_code</label>
                                <input class="form-control" type="text" name="key_code" value="{{old('key_code')}}">
                            </div>
                        
                            <div class="form-group">
                                <label for="">Danh mục cha</label>
                                <select class="form-control" name="parent_id">
                                    <option value="0">Chọn danh mục</option>
                                    @php
                                        cate_parent($parent_permission);
                                    @endphp
                                </select>
                            </div>
                            
                            <button type="submit" name="btn-add" value="Thêm danh mục" id="btn-add_category" class="btn btn-primary">Thêm mới</button>
                        </form>    
                    </div>
                </div>
            </div>
            <div class="col-8">
                    <div class="card">
                        <div class="card-header font-weight-bold">
                            Danh mục
                        </div>
                        <div class="card-body">
                            <table class="table table-striped" name="parent_id">
                                <thead>
                                    <tr>
                                        <th scope="col">Tên danh mục</th>
                                        <th scope="col">Slug</th>
                                        <th scope="col">Key code</th>
                                        <th scope="col">Tác vụ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($categories_permission->count())
                                        <?php tablePermissionCategories($categories_permission); ?>
                                    @else
                                        <tr>
                                            <td colspan="4" class="text-danger">Không tìm thấy danh mục nào!</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="mt-3 d-flex justify-content-center">
                        {{-- {{$categories_permission->links()}} --}}
                    </div>
                    
            </div>
           
        </div>
    </div> 
@endsection 


