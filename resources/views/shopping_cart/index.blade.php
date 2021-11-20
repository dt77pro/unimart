@extends('layouts.shopping_cart')
@section('content')
<style>
    .empty {
        background: rgb(255, 255, 255);
        padding: 40px 20px;
        border-radius: 4px;
        text-align: center;
        width: 100%;
    }
    .empty__img {
        width: 190px;
    }  
    img {
      max-width: 100%;
      border-style: none;
    } 
    .empty__note {
        font-size: 18px;
        padding: 5px 0px;
    }
</style>
<div id="main-content-wp" class="cart-page">
    <div class="section" id="breadcrumb-wp">
        <div class="wp-inner">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="?page=home" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Giỏ hàng</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="wrapper" class="wp-inner clearfix">
        <div class="section" id="info-cart-wp">
            @if (Cart::count() > 0)
            <h2 id="btn-cart" class="my-2" style="font-weight: 500; font-size: 20px">Giỏ hàng <small style="color: rgb(51 51 51 / 63%)">(</small><span class="num-qty" style="color: rgb(51 51 51 / 63%)">{{Cart::count()}}</span><small style="color: rgb(51 51 51 / 63%)"> sản phẩm)</small></h2>
                <div class="section-detail table-responsive"><section></section>
                    <table class="table">
                        <thead>
                            <tr>
                                <td>#</td>
                                <td>Ảnh sản phẩm</td>
                                <td>Tên sản phẩm</td>
                                <td>Giá sản phẩm</td>
                                <td>Số lượng</td>
                                <td colspan="2">Thành tiền</td>
                            </tr>
                        </thead>
                            <tbody>
                                <?php $t = 0 ?>
                                @foreach (Cart::content() as $product)
                                <?php $t++ ?>
                                    <form action="{{route('update.cart', $product->id)}}" method="POST">
                                        @csrf
                                        <tr class="cartpage">
                                            <td>{{$t}}</td>
                                            <td>
                                                <a href="{{route('detail_product', $product->options->slug)}}" class="thumbnail">
                                                    <img class="img-fluid img-thumbnail" width="150" height="150" src="{{asset($product->options->featured_img_path)}}">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{route('detail_product', $product->options->slug)}}" title="{{$product->name}}" class="name-product">{{$product->name}}</a>
                                            </td>
                                            <td><span class="font-weight-bold" style="font-size: 18px">{{number_format($product->price, 0, ',', '.')}}đ</span></td>
                                            <td>
                                                <div class="input-group quantity" style="max-width: 120px; margin-left: 25px;">
                                                    <div class="input-group-prepend decrement-btn changeQuantity" style="cursor: pointer;">
                                                        <span class="input-group-text" style="background: white; padding-right: 18px">-</span>
                                                    </div>
                                                    <input type="hidden" class="product-id" value="{{$product->id}}">
                                                    <input type="hidden" class="product-row-id" value="{{$product->rowId}}">
                                                    <input type="text"  class="qty-input form-control text text-center" min="1" value="{{$product->qty}}" style="pointer-events: none">
                                                    <div class="input-group-append increment-btn changeQuantity" style="cursor: pointer">
                                                        <span class="input-group-text" style="background: white;">+</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><span class="font-weight-bold" id="sub-total-{{$product->rowId}}" style="font-size: 18px">{{Cart::get($product->rowId)->subtotal(0, ',', '.')}}đ</span></td>
                                            <td>
                                                <a href="javascript:void(0)" title="Xóa sản phẩm" class="del-product"><i class="fa fa-trash-o" data-id="{{$product->rowId}}"></i></a>
                                            </td>
                                        </tr>
                                    </form>   
                                @endforeach
                            </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="7">
                                    
                                    <div class="clearfix">
                                        <p id="total-price" class="fl-right">Tổng giá: <span class="text-lowercase">{{Cart::subtotal(0, ',', '.')}}đ</span></p>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="7">
                                    <div class="clearfix">
                                        <div class="fl-right">
                                            <a href="{{route('destroy.cart')}}" title="" id="update-cart">Xóa toàn bộ giỏ hàng</a>
                                            <a href="{{route('get.payment.cart')}}" title="" id="checkout-cart">Thanh toán</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            <div class="section-detail">
                <a href="{{route('home')}}" title="Mua tiếp" id="buy-more" style="text-decoration: underline!important">MUA TIẾP</a><br>
                <a href="{{route('destroy.cart')}}" title="Xóa toàn bộ giỏ hàng" id="delete-cart" style="text-decoration: underline!important">XÓA GIỎ HÀNG</a>
            </div>
        </div>
        @else
        <div class="styles__StyledCartPage-sc-1n0ze23-0 BTbnH">
            <h2 class="my-2" style="font-weight: 500; font-size: 20px">Giỏ hàng <span style="color: rgb(51 51 51 / 63%)">(0 sản phẩm)</span></h2>
            <div class="empty">
                <img src="https://salt.tikicdn.com/desktop/img/mascot@2x.png" alt="" class="empty__img center-block mb-2">
                <p class="empty__note my-2">Không có sản phẩm nào trong giỏ hàng của bạn.</p>
                <a href="{{route('home')}}" class="empty__btn btn btn-danger my-2">Tiếp tục mua sắm</a>
            </div>
        </div>
        @endif
     </div>
<script>
    
    //Js nút số lượng
    $(document).ready(function () {

        $('.increment-btn').click(function (e) {
            e.preventDefault();
            var incre_value = $(this).parents('.quantity').find('.qty-input').val();
            var value = parseInt(incre_value, 10);
            value = isNaN(value) ? 0 : value;
            if(value<100){
                value++;
                $(this).parents('.quantity').find('.qty-input').val(value);
               
            }
        });

        $('.decrement-btn').click(function (e) {
            e.preventDefault();
            var decre_value = $(this).parents('.quantity').find('.qty-input').val();
            var value = parseInt(decre_value, 10);
            value = isNaN(value) ? 0 : value;
            if(value>1){
                value--;
                $(this).parents('.quantity').find('.qty-input').val(value);
                
            }
           
        });

    });


    // Update Cart Data
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.changeQuantity').click(function (e) {
            e.preventDefault();

            var quantity = $(this).closest(".cartpage").find('.qty-input').val();
            var product_id = $(this).closest(".cartpage").find('.product-id').val();
            var rowId = $(this).closest(".cartpage").find('.product-row-id').val();
            var url = "http://localhost/laravel_unimart/unimart/cart/update_cart/";

            var data = {
                qty: quantity,
                product_id: product_id,
                rowId: rowId
            };
            $.ajax({
                url: url+product_id,
                type: "POST",
                data: data,
                dataType: 'json',
                success: function (response) {
                    
                    if (response.status) {
                        alert(response.status);
                        window.location.reload();

                    } else {
                        $("#sub-total-"+rowId).html(response.sub_total);
                        $("#total-price span").html(response.total);
                        $('#btn-cart span').html(response.total_qty);
                        $(".qty-"+rowId).html(response.sub_qty);
                        $(".count-item span").html(response.total_qty);
                    }
                    // console.log(response);
                }
            });
        });

        
    });

    //Delete Cart Ajax
    $(document).ready(function() {
        $(".cartpage").on('click', '.del-product i', function() {
            var id = $(this).attr('data-id');
            var url = 'http://localhost/laravel_unimart/unimart/cart/delete/';
            var data = {
                id: id
            };
            $.ajax({
                url: url+id,
                method: "GET",
                data: data,
                success: function(response) {
                    $("body").html(response);
                }
            
            });
        });
    }); 


</script>
@endsection




