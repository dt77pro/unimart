@extends('layouts.admin')
@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        @if (session('status'))
            <div class="alert alert-success">
                <p>{{session('status')}}</p>
            </div>
        @endif 
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0 ">Danh sách bài viết</h5>
            <div class="form-search form-inline">
                <form action="#">
                    <input type="text" name="keyword" value="{{Request::input('keyword')}}" class="form-control form-search" placeholder="Tìm kiếm">
                    <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="analytic">
                <a href="{{url('admin/post/list')}}" class="text-primary">Danh sách<span class="text-muted">({{$count_total}})</span></a>
                <a href="{{route('post.active', 'pending'), Request::fullUrlWithQuery(['post_status' => 'active', 'status' => 'pending'])}}" class="text-primary">Chờ duyệt<span class="text-muted">({{$count[0]}})</span></a>
                <a href="{{route('post.active', 'public'), Request::fullUrlWithQuery(['post_status' => 'active', 'status' => 'public'])}}" class="text-primary">Công khai<span class="text-muted">({{$count[1]}})</span></a>
                <a href="{{route('post.trash'), Request::fullUrlWithQuery(['post_status' => 'trash'])}}" class="text-primary">Thùng rác<span class="text-muted">({{$count_post_trash}})</span></a>
            </div>
            <form action="{{route('post.action')}}" method="POST">
                @csrf
                <div class="form-action form-inline py-3">
                    @can('action-post')
                        <select class="form-control mr-1" id="" name="act">
                            <option>Chọn tác vụ</option>
                            @foreach ($list_act as $k => $act)
                                <option value="{{$k}}">{{$act}}</option>
                            @endforeach
                        </select>
                        <input type="submit" name="btn-search" value="Áp dụng" class="btn btn-primary">
                    @endcan
                </div>
                <table class="table table-striped table-checkall">
                    <thead>
                        <tr>
                            <th scope="col">
                                <input name="checkall" type="checkbox">
                            </th>
                            <th scope="col">#</th>
                            <th scope="col">Ảnh</th>
                            <th scope="col">Tiêu đề</th>
                            <th scope="col">Slug</th>
                            <th scope="col">Chi tiết</th>
                            <th scope="col">Danh mục</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">Tác vụ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($posts->total() > 0)
                            @foreach ($posts as $key => $post)
                                <tr>
                                    <td>
                                        <input type="checkbox" name="list_check[]" value="{{$post->id}}">
                                    </td>
                                    <td scope="row">{{$posts->firstItem() + $key}}</td>
                                    <td><a href="#"><img src="{{url($post->thumbnail)}}" height="100" width="100" alt=""></a></td>
                                    <td style="width: 20%; font-weight: bold; font-size: 14.5px">{{$post->title}}</td>
                                    <td style="width: 20%">{{$post->slug}}</td>
                                    <td><a href="#" style="font-size: 14px" class="badge badge-info">Detail</a></td>
                                    <td>
                                        <?php $cate_post = DB::table('post_categories')->where('id',$post['cat_id'])->first(); ?> 
                                        @if (!empty($cate_post->name))
                                            {{$cate_post->name}}
                                        @endif
                                    </td>
                                    <td><span style="font-size: 13px" class="badge {{$post->getStatus($post->status)['class']}}">{{$post->getStatus($post->status)['name']}}</span></td>
                                    <td> 
                                        @can('restore-post')
                                            <a href="{{route('post.restore', $post->id)}}" onclick="return confirm('Bạn có chắc chắn muốn khôi phục bài viết này không?')"><button style="font-size: 1rem" class="btn btn-success btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Khôi phục"><i class="far fa-trash-undo"></i></button></a>
                                        @endcan
                                        @can('forceDelete-post')
                                            <a href="{{route('post.forceDelete', $post->id)}}" onclick="return confirm('Bạn có chắc chắn muốn xóa vĩnh viễn bài viết không?')"><button style="font-size: 1rem" class="btn btn-danger btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Xóa vĩnh viễn"><i class="far fa-trash-alt fa-1x"></i></button></a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="10" class="text-danger">Không tìm thấy kết quả {{Request::input('keyword')}} nào!</td>
                            </tr>
                        @endif
                        
                    </tbody>
                </table>
            </form>
           
            {{$posts->links()}}
        </div>
    </div>
</div> 
@endsection
