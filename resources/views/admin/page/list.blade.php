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
                <h5 class="m-0 ">Danh sách trang</h5>
                <div class="form-search form-inline">
                    <form action="#" class="form-search__item">
                        <input type="text" name="keyword"  value="{{Request::input('keyword')}}" class="form-control form-search" placeholder="Tìm kiếm">
                        <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
                    </form>
                </div>
            </div>
            <div class="card-body">
                <div class="analytic">
                    <a href="{{Request::url('admin/page/list')}}" class="text-primary">Danh sách<span class="text-muted">({{$total_count}})</span></a>
                    <a href="{{Request::fullUrlWithQuery(['status' => 'active','active_page' => '0'])}}" class="text-primary">Chờ duyệt<span class="text-muted">({{$count[0]}})</span></a>
                    <a href="{{Request::fullUrlWithQuery(['status' => 'active','active_page' => '1'])}}" class="text-primary">Công khai<span class="text-muted">({{$count[1]}})</span></a>
                    <a href="{{Request::fullUrlWithQuery(['status' => 'trash'])}}" class="text-primary">Thùng rác<span class="text-muted">({{$count_page_trash}})</span></a>
                </div>
                <form action="{{route('action_page')}}" method="POST">
                    @csrf
                    <div class="form-action form-inline py-3">
                        @can('action-page')
                            <select class="form-control mr-1" name="act" id="">
                                <option>Chọn</option>
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
                                <th scope="col">Tiêu đề</th>
                                <th scope="col">Slug</th>
                                <th scope="col">Chi tiết</th>
                                <th scope="col">Trạng thái</th>
                                <th scope="col">Ngày tạo</th>
                                <th scope="col">Tác vụ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($pages->count() > 0)
                                @php
                                $t = 0;
                                @endphp
                                @foreach ($pages as $page)
                                @php
                                    $t++;
                                @endphp
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="list_check[]" value="{{$page->id}}">
                                        </td>
                                        <td style="font-weght: bold" scope="row">{{$t}}</td>
                                        <td style="font-weight: bold; font-size: 14.5px">{{$page->title}}</td>
                                        <td>{{$page->slug}}</td>
                                        <td><a href="{{route('page.detail', $page->id)}}" style="font-size: 13px" class="badge badge-info">Detail</a></td>
                                        <td>
                                            <span class="badge {{$page->getStatus($page->status)['class']}}">{{$page->getStatus($page->active_page)['name']}}</span>
                                        </td>
                                        <td>{{$page->created_at}}</td>
                                        <td>
                                            @can('update-page')
                                               <a href="{{route('edit.page', $page->id)}}"><button class="btn btn-success btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Sửa"><i class="fa fa-edit"></i></button></a>
                                            @endcan
                                            @can('delete-page')
                                               <a href="{{route('delete_page', $page->id)}}" onclick="return confirm('Bạn có muốn xóa tạm thời trang {{$page->title}} ?')"><button class="btn btn-danger btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Xóa"><i class="fa fa-trash"></i></button></a>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                    <tr>
                                        <td colspan="8" class="text-danger">Không tìm thấy kết quả {{Request::input('keyword')}} nào!</td>
                                    </tr>
                            @endif
                           
                            
                        </tbody>
                    </table>
                </form>
                
                {{$pages->links()}}
                {{-- <i class="far fa-comment-dots fa-3x"></i> --}}
                {{-- <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Previous">
                                <span aria-hidden="true">Trước</span>
                                <span class="sr-only">Sau</span>
                            </a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                                <span class="sr-only">Next</span>
                            </a>
                        </li>
                    </ul>
                </nav> --}}
            </div>
        </div>
    </div> 
@endsection
