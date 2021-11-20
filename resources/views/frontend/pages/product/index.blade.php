@extends('layouts.master_frontEnd')
@section('content')
    <div id="main-content-wp" class="clearfix category-product-page">
        <div class="wp-inner">
            @include('frontend.components.index_breadcrumb')
            <div class="main-content fl-right">
                <div class="section" id="list-product-wp" style="margin-top: -39px;">
                    @include('frontend.pages.product.include.product_filter')
                    <div class="section-detail" style="margin-top: -45px">
                        @foreach ($cate_parent as $cate )
                            <div class="cate-product">
                                <h3 class="section-title fl-left" style="padding-bottom: 10px">{{$cate->name}}</h3>
                            </div>
                            <ul class="list-item clearfix" style="padding-bottom: 15px">
                                @if ($list_product_by_cateParent[$cate->id]->count() > 0) 
                                    @foreach($list_product_by_cateParent[$cate->id] as $product)
                                        <li style="text-align:center; position: relative;">
                                            @if ($product->qty < 1) 
                                                <span style="font-size: 14px;position: absolute;background: #e6007f;border-radius: 5px;top: -1px;left: 125px;color: #fff">Tạm hết hàng</span>
                                            @endif
                                            <a href="{{route('detail_product', $product->slug)}}" title="{{$product->name}}" class="thumb">
                                                <img src="{{asset($product->featured_img_path)}}">
                                            </a>
                                            <a href="{{route('detail_product', $product->slug)}}" title="{{$product->name}}" class="product-name">{{Str::of($product->name)->limit(22)}}</a>
                                            <div class="price">
                                                <span class="new">{{number_format($product->price, 0, '', '.')}}₫</span>
                                            </div>
                                            <div class="action">
                                                <a href="{{route('buy_now.cart', $product->slug)}}" id="buy-now">MUA NGAY</a>
                                            </div>
                                        </li>
                                    @endforeach
                                @else
                                    <p class="text text-danger">Hiện tại không có sản phẩm nào!</p>
                                @endif

                            </ul> 
                                <div class="pagging d-flex justify-content-center" style="font-size: 11px">
                                    {{$list_product_by_cateParent[$cate->id]->withQueryString()->links()}}
                                </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="sidebar fl-left">
                @include('frontend.pages.product.include.cate_product')
                @include('frontend.components.selling_product')
                @include('frontend.components.banner')
            </div>
        </div>
    </div>

    {{-- Script index--}}
    <script>
        $(document).ready(function() {
            $('.pagination a').unbind('click').on('click', function(e) {
                e.preventDefault();
                var page = $(this).attr('href').split('html')[1];
                getListProducts(page);
            });
        
            function getListProducts(page)
            {
                $.ajax({
                    type: "GET",
                    url: page
                })
                .success(function(data) {
                    $('body').html(data);
                });
            }
        });
    </script>
    
@endsection 





 