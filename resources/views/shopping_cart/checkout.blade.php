@extends('layouts.shopping_cart')
@section('content')
<div id="main-content-wp" class="checkout-page">
    <div style="width: 1170px; margin: 0px auto;">
        @include('show_error')
    </div>
   
    <div class="section" id="breadcrumb-wp">
        <div class="wp-inner">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="?page=home" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Thanh toán</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="wrapper" class="wp-inner clearfix">
        <form action="{{route('post.payment.cart')}}" method="POST" >
            @csrf
            <div class="section" id="customer-info-wp">
                <div class="section-head">
                    <h1 class="section-title">Thông tin khách hàng</h1>
                </div>
                <div class="section-detail">
                    <div class="form-row clearfix">
                        <div class="form-col fl-left">
                            <label for="fullname">Họ và tên</label>
                            <input type="text" name="fullname"  id="fullname">
                            @error('fullname')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-col fl-right">
                            <label for="email">Email</label>
                            <input type="email" name="email"  id="email">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row clearfix">
                        <div class="form-col fl-left">
                            <label for="phone">Số điện thoại</label>
                            <input type="tel" name="phone"  id="phone">
                            @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                  
                    <div class="form-row clearfix">
                        <div class="form-group col-md-6 fl-left">
                            <label for="province">Tỉnh / Thành Phố</label>
                            <select id="province" name="province" class="form-control" style="color: #333; font-size: 15px;">
                            <option selected value="">---Chọn Tỉnh / Thành Phố---</option>
                            @foreach ($provinces as $province)
                                <option value="{{$province->id}}:{{$province->name }}">{{$province->name}}</option>
                            @endforeach
                            </select>
                            @error('province')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-5 fl-right">
                            <label for="district">Quận / Huyện</label>
                            <select id="district" name="district" class="form-control" style="color: #333; font-size: 15px">
                                <option selected value="">---Chọn Quận / Huyện---</option>
                            </select>
                            @error('district')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6 fl-left mt-3">
                            <label for="ward">Phường / Xã</label>
                            <select id="ward" name="ward" class="form-control" style="color: #333; font-size: 15px">
                                <option selected value="">---Chọn Phường / Xã---</option>
                            </select>
                            @error('ward')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-5 fl-right mt-3">
                            <label for="other">Khác</label>
                            <input type="text" class="form-control" name="other" placeholder="Số nhà, tên đường" style="color: #333; font-size: 15px">
                            @error('other')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-col">
                            <label for="notes">Ghi chú</label>
                            <textarea name="note" rows="5" cols="75"></textarea>
                            @error('note')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="section" id="order-review-wp">
                <div class="section-head">
                    <h1 class="section-title">Thông tin đơn hàng</h1>
                </div>
                <div class="section-detail">
                    <table class="shop-table">
                        <thead>
                            <tr>
                                <td>Sản phẩm</td>
                                <td>Tổng</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (Cart::content() as $item)
                                <tr class="cart-item">
                                    <td class="product-name">{{$item->name}}<strong class="product-quantity">x {{$item->qty}}</strong></td>
                                    <td class="product-total">{{number_format($item->subtotal, 0, ',', '.')}} VNĐ</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="order-total">
                                <td>Tổng đơn hàng:</td>
                                <td><strong class="total-price text-danger">{{Cart::subtotal(0, ',', '.')}} VNĐ</strong></td>
                            </tr>
                        </tfoot>
                    </table>
                    <div id="payment-checkout-wp">
                        <ul id="payment_methods">
                            @php
                                $transactions = DB::table('transactions')->get();
                            @endphp
                            <li>
                                <input type="radio" id="direct-payment" name="payment" value="pay_shop" {{ old("payment") == 'pay_shop' ? "checked" : "" }}>
                                <label for="payment">Thanh toán tại cửa hàng</label>
                            </li>
                            <li>
                                <input type="radio" id="payment-home" name="payment" checked value="pay_home" {{ old("payment") == 'pay_home' ? "checked" : "" }}>
                                <label for="payment">Thanh toán tại nhà</label>
                            </li>
                        </ul>
                    </div>
                    <div class="place-order-wp clearfix">
                        <input type="submit" id="order-now" value="Đặt hàng">
                    </div>
                </div>
            </div>
        </form>
        
    </div>
</div>

<script>
    $(document).ready(function() {

        // GET DISTRICT
        $("#province").change(function(e) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            }); 
            e.preventDefault();
            let province_id = $(this).val();
            let url = '{{route('payment.district')}}';
            let data = {
                province_id: province_id
            };
            $.ajax({
                url: url,
                method: "POST",
                data: data,
                success: function(response) {
                    $("#district").html(response.html);
                    // console.log(response);
                }    
            });
        });

        // GET WARD
        $("#district").change(function(e) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            }); 
            e.preventDefault();
            let district_id = $(this).val();
            let url = '{{route('payment.ward')}}';
            let data = {
                district_id: district_id
            };
            $.ajax({
                url: url,
                method: "POST",
                data: data,
                success: function(response) {
                    $("#ward").html(response.html);
                    // console.log(response);
                }    
            });
        });
    })
    $(document).ready(function() {
        $("div.alert").delay(3000).slideToggle("3000");
        $(".message").delay(3000).fadeToggle("3000");
    });

    
</script>
{{-- <script type="text/javascript">
    if(typeof type_massage != 'undefined'){

        switch (type_massage) {
            case 'success':
                toastr.success(massage)
                break;
        
            case 'error':
                toastr.error(massage)
                break;
        }
    }

</script> --}}
@endsection
 

