@extends('layouts.master_frontEnd')
@section('content')
<style>
    .toggle-content {
        position: relative;
        overflow: hidden; 
        height: 100px;

    }
    .toggle-main {
        height: auto;
    }
    .gradient {
        position: absolute;
        bottom: 0px;
        left: 0px;
        width: 100%; 
        height: 50px; 
        background-image: linear-gradient(rgba(255, 255, 255, 0), rgb(255, 255, 255));
    }
    .zoomContainer {
        width: 350px!important;
        height: 350px!important;
    }
    .zoomLens {
        width: 100px!important;
        height: 100px!important;
    }
    #zoom {
        width: 350px!important;
        height: 350px!important
    }
    #zoom-1 {
        width: 50px!important;
        height: 50px!important
    }
</style>
<div id="main-content-wp" class="clearfix detail-product-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">{{$parent_cate->name}}</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="section" id="detail-product-wp">
                @if ($product->qty > 0)
                    <div class="section-detail clearfix">
                        <div class="thumb-wp fl-left">
                            <a href="#" title="" id="main-thumb">
                                <img id="zoom" width="350" height="350" src="{{asset($product->featured_img_path)}}" data-zoom-image="{{asset($product->featured_img_path)}}"/>
                            </a> 
                            <div id="list-thumb">
                                @foreach ($product_img_detail as $item_img)
                                    <a href="#" data-image="{{asset('/storage/product_detail/'.$item_img->image)}}" data-zoom-image="{{asset('/storage/product_detail/'.$item_img->image)}}">
                                        <img id="zoom-1" src="{{asset('/storage/product_detail/'.$item_img->image)}}">
                                    </a>
                                @endforeach
                            </div>
                        </div>
                        <div class="thumb-respon-wp fl-left">
                            <img src="{{asset($product->featured_img_path)}}" alt="">
                        </div>
                        <div class="info fl-right">
                            <h3 class="product-name">{{$product->name}}</h3>
                            <div class="desc">
                            {{$product->description}}
                            </div>
                            <p class="price">{{number_format($product->price, 0, '', '.')}}₫</p>
                            <div class="num-product">
                                <span class="title">Sản phẩm: </span>
                                @if ($product->qty > 0)
                                <span style="color: #219653; font-weight: bold; text-transform: uppercase;">Còn hàng</span>
                                @else
                                <span style="color: #333; font-weight: bold; text-transform: uppercase;">Hết hàng</span>
                                @endif
                            </div>
                            {{-- <p>Tồn kho: {{$product->qty}}</p> --}}
                            <p class="text-muted mb-1" style="font-size: 20px">Số lượng</p>
                            <div id="num-order-wp" style="margin-top: 15px;">
                                <a title="" id="minus"><i class="fa fa-minus"></i></a>
                                <input type="text" name="qty" value="1" id="num-order">
                                <a title="" id="plus"><i class="fa fa-plus"></i></a>
                            </div>
                            <p class="error-status" style="color: red;"></p>
                            <button data-url="{{route('add.cart', ['id' => $product->id])}}" data-id="{{$product->id}}" class="btn add-cart" id="add-to-cart" style="margin-top: 15px;">Chọn Mua</button>
                        </div>
                    </div>    
                @else
                    <div class="section-detail clearfix">
                        <div class="thumb-wp fl-left">
                            <a href="#" title="" id="main-thumb">
                                <img id="zoom" width="350" height="350" src="{{asset($product->featured_img_path)}}" data-zoom-image="{{asset($product->featured_img_path)}}"/>
                            </a> 
                            <div id="list-thumb">
                                @foreach ($product_img_detail as $item_img)
                                    <a href="#" data-image="{{asset('/storage/product_detail/'.$item_img->image)}}" data-zoom-image="{{asset('/storage/product_detail/'.$item_img->image)}}">
                                        <img id="zoom-1" src="{{asset('/storage/product_detail/'.$item_img->image)}}">
                                    </a>
                                @endforeach
                            </div>
                        </div>
                        <div class="thumb-respon-wp fl-left">
                            <img src="{{asset($product->featured_img_path)}}" alt="">
                        </div>
                        <div class="info fl-right">
                            <h3 class="product-name">{{$product->name}}</h3>
                            <div class="desc">
                                {{$product->description}}
                            </div>
                            <p class="price">{{number_format($product->price, 0, '', '.')}}₫</p>
                            <div class="num-product">
                                <span class="title">Sản phẩm: </span>
                                @if ($product->qty > 0)
                                <span style="color: #219653; font-weight: bold; text-transform: uppercase;">Còn hàng</span>
                                @else
                                <span style="color: #333; font-weight: bold; text-transform: uppercase;">Hết hàng</span>
                                @endif
                            </div>
                        </div>
                    </div> 
                @endif
            </div>
            <div class="section" id="post-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Mô tả sản phẩm</h3>
                </div>
              
                <div class="section-detail text-center">
                    <div class="toggle-content">
                        <div class="view-content">{!!$product->content!!}</div>
                        <div class="gradient"></div>
                    </div>
                    <button type="button" class="btn btn-outline-primary load-more mt-1">Xem Thêm Nội Dung</button>
                </div>
            </div>
            <div class="section" id="same-category-wp">
                <div class="section-head">
                    <h3 class="section-title">Cùng chuyên mục</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item">
                        @foreach($products_with_cate as $product)
                            <li style="text-align:center;position: relative;">
                                @if ($product->qty < 1) 
                                    <span style="font-size: 14px;position: absolute;background: #e6007f;border-radius: 5px;top: -1px;left: 125px;color: #fff">Tạm hết hàng</span>
                                @endif
                                <a href="{{route('detail_product', $product->slug)}}" title="{{$product->name}}" class="thumb">
                                    <img src="{{asset($product->featured_img_path)}}">
                                </a>
                                <a href="{{route('detail_product', $product->slug)}}" title="{{$product->name}}" class="product-name">{{Str::of($product->name)->limit(22)}}</a>
                                <div class="price">
                                    <span class="new">{{number_format($product->price, 0, '' ,'.')}}đ</span>
                                </div>
                                <div class="action clearfix">
                                    <a href="{{route('buy_now.cart', $product->slug)}}" id="buy-now">MUA NGAY</a>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="sidebar fl-left">
            @include('frontend.pages.product_detail.include.cate_product')
            <div class="section" id="banner-wp">
                <div class="section-detail">
                    <a href="" title="" class="thumb">
                        <img src="{{asset('css/user/images/banner.png')}}" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div> 

<script>
    $(document).ready(function() {
        $(".add-cart").on('click', function() {
            let url = $(this).data('url');
            let id = $(this).attr('data-id');
            let qty = $("#num-order").val();
            var data = {
                id: id,
                qty: qty
            };

            $.ajax({
                url: url,
                method: "GET",
                dataType: 'json',
                data: data,
                success: function(response) {

                    if (response.status) {
                        alert(response.status);
                        window.location.reload();
                    } else {
                        alertify.set('notifier','position','top-right');
                        alertify.success('Thêm vào giỏ hàng thành công!');

                        $('#btn-cart #num').html(response.data.total_qty);
                        $(".count-item span").html(response.data.total_qty);
                        $("#total-price span").html(response.data.total);
                        // $("#info-cart #sub-qty-"+id).html(response.data.sub_qty);

                       

                    }
                }
                
            });
        });

    });

    $(".load-more").click(function() {

        $(".toggle-content").toggleClass('toggle-main');
        var replaceText = $(".toggle-content").hasClass('toggle-main') ? 'Thu Gọn Nội Dung' : 'Xem Thêm Nội Dung';

        //Check trạng thái khi click chuột
        if (replaceText == 'Thu Gọn Nội Dung') {
            $(".gradient").css('display', 'none');
        } else {
            $(".gradient").css('display', 'block');
        }

        // Truyền trạng thái lên server
        $(".load-more").html(replaceText);

    }); 
</script>

@endsection
