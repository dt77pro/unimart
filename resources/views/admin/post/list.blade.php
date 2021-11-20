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
                <form action="#" class="form-search__item">
                    <input type="text" name="keyword" value="{{Request::input('keyword')}}" class="form-control form-search" placeholder="Tìm kiếm">
                    <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="analytic">
                <a href="{{url('admin/post/list')}}" class="text-primary">Danh sách<span class="text-muted">({{$count_total}})</span></a>
                <a href="{{route('post.active', ['action' => 'public'])}}" class="text-primary">Công khai<span class="text-muted">({{$count[1]}})</span></a>
                <a href="{{route('post.active', ['action' => 'pending'])}}" class="text-primary">Chờ duyệt<span class="text-muted">({{$count[0]}})</span></a>
                <a href="{{route('post.trash')}}" class="text-primary">Thùng rác<span class="text-muted">({{$count_post_trash}})</span></a> 
             </div> 
            <form action="{{route('post.action')}}" method="POST"> 
                @csrf 
                <div class="form-action form-inline py-3"> 
                    @can('action-post')
                        <select class="form-control mr-1"  name="act"> 
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
                            <th scope="col">Thời gian</th>
                            <th scope="col">Tác vụ</th>
                        </tr>
                    </thead>
                    <tbody> 
                        @if ($posts->count() > 0)
                            @foreach ($posts as $key => $post)
                                <tr>
                                    <td>
                                        <input type="checkbox" name="list_check[]" value="{{$post->id}}">
                                    </td>
                                    <td scope="row">{{$posts->firstItem() + $key}}</td>
                                    <td>
                                        <a href="{{route('post.detail', $post->id)}}"><img src="{{url($post->thumbnail)}}" height="100" width="100" alt=""></a>
                                    </td>
                                    <td style="width: 20%; font-weight: bold; font-size: 14.5px">{{$post->title}}</td>
                                    <td style="width: 20%">{{$post->slug}}</td>
                                    <td>
                                        @can('detail-post')
                                          <a href="{{route('post.detail', $post->id)}}" style="font-size: 14px" class="badge badge-info">Detail</a>
                                        @endcan
                                    </td>
                                    <td>
                                        <?php $cate_post = DB::table('post_categories')->where('id',$post['cat_id'])->first(); ?> 
                                        @if (!empty($cate_post->name))
                                            {{$cate_post->name}}
                                        @endif
                                    </td>
                                    <td>
                                        @can('status-post')
                                            @if ($post->status == 'public')
                                                <a href="{{route('post.active_update', $post->id)}}" class="badge badge-primary">Công khai</a>
                                            @else
                                                <a href="{{route('post.active_update', $post->id)}}" class="badge badge-dark">Chờ duyệt</a>
                                            @endif
                                        @endcan
                                    </td>
                                    <td><?php echo $post->created_at ?></td>
                                    <td> 
                                        @can('update-post',$post)
                                           <a href="{{route('post.edit', $post->id)}}"><button class="btn btn-success btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Sửa"><i class="fa fa-edit"></i></button></a>          
                                        @endcan
                                        @can('delete-post')
                                            <a href="{{route('post.delete', $post->id)}}" onclick="return confirm('Bạn có chắc chắn muốn xóa tạm thời bài viết này không?')"><button class="btn btn-danger btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Xóa"><i class="fa fa-trash"></i></button></a>
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
        </div>
        {{$posts->links()}} 
    </div>
</div> 
@endsection 
 


