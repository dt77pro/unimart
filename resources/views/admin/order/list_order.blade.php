<div class="content-order">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Tên sản phẩm</th>
                <th scope="col">Avatar</th>
                <th scope="col">Giá</th>
                <th scope="col">Số lượng</th>
                <th scope="col">Tổng tiền</th>
                <th scope="col">Tác vụ</th>
            </tr>
        </thead>
        <tbody>
            @if ($orders->count() > 0)
                @php
                    $t = 0;
                @endphp
                @foreach ($orders as $order)
                    @php
                        $t++;
                    @endphp
                    <tr>
                        <td><span style="">{{$t}}.</span></td>
                        <td>
                            <a href="{{route('detail_product', Str::slug($order->product->name))}}" target="_blank">{{isset($order->product->name) ? $order->product->name : ''}}</a>
                        </td>
                        <td>
                            <a href="{{route('detail_product', Str::slug($order->product->name))}}" target="_blank"><img class="img-fluid img-thumbnail" style="width: 90px; height: 80px" src="{{isset($order->product->featured_img_path) ? asset($order->product->featured_img_path) : ''}}" alt=""></a>
                        </td>
                        <td>{{number_format($order->price, 0, ',', '.')}}đ</td>
                        <td>{{$order->qty}}</td>
                        <td>{{number_format($order->price * $order->qty, 0, ',', '.')}}đ</td>
                        <td> 
                            <a href="javascript:void(0)" data-url="{{route('delete.orderItem', $order->id)}}"  class="btn btn-danger btn-sm rounded-0 text-white order-item-delete" type="button" data-toggle="tooltip" data-placement="top" title="Xóa"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="8" class="text-danger">Không có sản phẩm nào tồn tại!</td>
                </tr>
            @endif 
         
        </tbody>

    </table>
</div>


