@extends('layouts.admin')
@section('content')
    <div class="container-fluid py-5">
        <div class="row list-card mb-3">
            <div class="col card-item">
                <div class="card text-white bg-primary mb-3  h-100" style="max-width: 18rem;">
                    <div class="card-header">ĐƠN HÀNG THÀNH CÔNG</div>
                    <div class="card-body">
                        <h5 class="card-title">{{$count_status_success}}</h5>
                        <p class="card-text">Số đơn hàng thành công</p>
                    </div>
                </div>
            </div>
            <div class="col card-item">
                <div class="card text-white bg-danger mb-3 h-100" style="max-width: 18rem;">
                    <div class="card-header">ĐANG XỬ LÝ</div>
                    <div class="card-body">
                        <h5 class="card-title">{{$count_status_processing}}</h5>
                        <p class="card-text">Số đơn hàng đang xử lý</p>
                    </div>
                </div>
            </div>
            <div class="col card-item">
                <div class="card text-white bg-info mb-3  h-100" style="max-width: 18rem;">
                    <div class="card-header">ĐANG VẬN CHUYỂN</div>
                    <div class="card-body">
                        <h5 class="card-title">{{$count_status_transport}}</h5>
                        <p class="card-text">Số đơn hàng đang vận chuyển</p>
                    </div>
                </div>
            </div>

            <div class="col card-item">
                <div class="card text-white bg-success mb-3 h-100" style="max-width: 18rem;">
                    <div class="card-header">DOANH SỐ</div>
                    <div class="card-body">
                        <h5 class="card-title">{{number_format($total_of_system, 0, ',', '.')}} VND</h5>
                        <p class="card-text">Doanh số hệ thống</p>
                    </div>
                </div>
            </div>
            <div class="col card-item">
                <div class="card text-white bg-dark mb-3 h-100" style="max-width: 18rem;">
                    <div class="card-header">ĐƠN HÀNG HỦY</div>
                    <div class="card-body">
                        <h5 class="card-title">{{$count_status_cancel}}</h5>
                        <p class="card-text">Số đơn bị hủy trong hệ thống</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- end analytic  -->
        <div class="card">
            <div class="card-header font-weight-bold">
                ĐƠN HÀNG MỚI
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">#</th>
                            <th scope="col">Khách hàng</th>
                            <th scope="col">Email</th>
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
                                        <input type="checkbox">
                                    </td>
                                    <td>{{$t}}</td>
                                    <td>
                                        {{$transaction->name}} <br>
                                        {{$transaction->phone_number}}
                                    </td>
                                    <td>{{$transaction->email}}</td>
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
                                <td colspan="10" class="text-danger">Hiện tại không có đơn hàng nào!</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
               
            </div>
        </div>
         

        {{-- Detail order --}}

        <div class="modal fade" id="modal-preview-transaction" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Chi tiết đơn hàng</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="ml-3 font-weight-500 info-order">
                        
                    </div>
                    <div class="modal-body">
                        <div class="content-order">
                            
                        </div> 
                    </div>
                    <div class="modal-footer">
                       
                    </div>
                </div>
            </div>
        </div>
    </div>  
@endsection
