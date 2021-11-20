<p><strong>Tên khách hàng:</strong> {{ucfirst(trans($transaction->name))}}</p>
<p><strong>Địa chỉ:</strong> {{$transaction->address}}</p>
<p><strong>Hình thức thanh toán:</strong> 
    @if ($transaction->payment == 'pay_home')
        Thanh toán tại nhà
    @else
        Thanh toán tại cửa hàng
    @endif
</p>
<p><strong>Ghi chú của khách hàng:</strong> {{ucfirst(trans($transaction->note))}}</p>