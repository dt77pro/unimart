@extends('layouts.admin')
@section('content')
<style>
.analytic a {
    color: #007bff;
}
.analytic a:hover {
    color: blue;
}
</style>
<div id="content" class="container-fluid">
    <div class="card">
        @if (session('status'))
            <div class="alert alert-success">
                <p>{{session('status')}}</p>
            </div>
        @endif 
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0 ">Danh sách đơn hàng</h5>
            <div class="form-search form-inline">
                <form action="#">
                    <input type="" class="form-control form-search" name="keyword" value="{{Request::input('keyword')}}" placeholder="Tìm kiếm">
                    <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="analytic">
                <form action="" class="form-transaction">
                    <a href="{{route('admin.transaction')}}">Đang hoạt động  ({{ $count_transactions}})</a>
                    <a href="{{route('admin.trash.transaction')}}">Vô hiệu hóa  ({{$count_trash_transactions}})</a>
                </form>
            </div>
            <form action="{{route('action.transaction')}}" method="POST"> 
                @csrf
                <div class="form-action form-inline py-3">
                    <select class="form-control mr-1" name="act"> 
                        <option>Chọn tác vụ</option>
                        @foreach ($list_act as $k => $act)
                            <option value="{{$k}}">{{$act}}</option>
                        @endforeach
                    </select>
                    <input type="submit" name="btn-search" value="Áp dụng" class="btn btn-primary">
                </div>
                <table class="table table-striped table-checkall">
                    <thead>
                        <tr>
                            <th>
                                <input type="checkbox" name="checkall">
                            </th>
                            <th scope="col">#</th>
                            <th scope="col">Khách hàng</th>
                            <th scope="col">Email</th>
                            <th scope="col">Địa chỉ</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">Tổng tiền</th>
                            <th scope="col">Thời gian</th>
                            <th scope="col">Chi tiết</th>
                            <th scope="col">Tác vụ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($transactions->count() > 0)
                            @php
                                $t = 0;
                            @endphp
                                @foreach ($transactions as $transaction)
                                    @php
                                        $t++;
                                    @endphp
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="list_check[]" value="{{$transaction->id}}">
                                        </td>
                                        <td>{{$t}}</td>
                                        <td>
                                            {{$transaction->name}} <br>
                                            {{$transaction->phone_number}}
                                        </td>
                                        <td>{{$transaction->email}}</td>
                                        <td>
                                            {{$transaction->address}}
                                        </td>
                                        <td>
                                            <span class="badge badge-{{$transaction->getStatus($transaction->status)['class']}}">
                                                {{$transaction->getStatus($transaction->status)['name']}}
                                            </span>
                                        </td>
                                        <td><span class="font-weight-bold">{{number_format($transaction->total_money, 0, ',', '.')}}đ</span></td>
                                        <td>{{$transaction->created_at}}</td>
                                        <td><a style="font-size: 16px" href="javascript:void(0);" data-url={{route('detail.transaction', $transaction->id)}}  class="preview-transaction btn btn-primary btn-sm"><i class="fa fa-eye"></i></a></td>
                                        <td>
                                            <div class="dropdown show btn-group btn-group-sm">
                                                <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                  Edit
                                                </a>
                                              
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                  <a class="dropdown-item" href="{{route('status.transaction', ['đang xử lý', $transaction->id])}}">Đang xử lý</a>
                                                  <a class="dropdown-item" href="{{route('status.transaction', ['đang vận chuyển', $transaction->id])}}">Đang vận chuyển</a>
                                                  <a class="dropdown-item" href="{{route('status.transaction', ['hoàn thành', $transaction->id])}}">Thành công</a>
                                                  <a class="dropdown-item" href="{{route('status.transaction', ['hủy bỏ', $transaction->id])}}">Đã hủy</a>
                                                </div>
                                            </div>
                                            <a href="{{route('delete.transaction', $transaction->id)}}" onclick="return confirm('Bạn có chắc chắn muốn xóa đơn hàng này không?')" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i>Delete</a>
                                        </td>
                                    </tr>
                                    
                                @endforeach
                        @else
                            <tr>
                                <td colspan="10" class="text-danger">Không tồn tại đơn hàng nào!</td>
                            </tr>
                        @endif
                        
                    </tbody>
                </table>
            </form>
            
            <div class="mt-3">
                {!!$transactions->links()!!}
            </div>
        </div>

        <!-- Detail Order -->

         <div class="modal fade" id="modal-preview-transaction" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Chi tiết đơn hàng</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="content-order">
                            
                        </div> 
                    </div>
                    <div class="text-right p-4 modal-footer-trash">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 

@endsection
