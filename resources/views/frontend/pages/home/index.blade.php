@extends('layouts.master_frontEnd')
@section('content')
    <div id="main-content-wp" class="home-page clearfix">
        <div class="wp-inner">
            <div class="main-content fl-right">
                @include('frontend.pages.home.include.slider')
                @include('frontend.pages.home.include.other_detail')
                @include('frontend.pages.home.include.hot_product')
                @foreach ($cate_parent as $cate )
                    <div class="section" id="list-product-wp">
                        <div class="section-head">
                            <h3 class="section-title">{{$cate->name}} NỔI BẬT</h3>
                        </div>
                        <div class="section-detail">
                            @if ($list_product_by_cateParent[$cate->id]->count() > 0)
                            <ul class="list-item clearfix">
                                @foreach ($list_product_by_cateParent[$cate->id] as $product)
                                    <li style="text-align: center; position: relative">
                                        @if ($product->qty < 1) 
                                            <span style="font-size: 14px;position: absolute;background: #e6007f;border-radius: 5px;top: -1px;left: 125px;color: #fff">Tạm hết hàng</span>
                                        @endif
                                        <a href="{{route('detail_product', $product->slug)}}" title="{{$product->name}}" class="thumb">
                                            <img src="{{asset($product->featured_img_path)}}">
                                        </a>
                                        <a href="{{route('detail_product', $product->slug)}}" class="product-name">{{Str::of($product->name)->limit(22)}}</a>

                                        <div class="price" name="price">
                                            <span class="new">{{number_format($product->price, 0, '', '.')}}₫</span>

                                        </div>
                                        <div class="action clearfix">
                                            <a href="{{route('buy_now.cart', $product->slug)}}" id="buy-now">MUA NGAY</a>
                                            {{-- <a href="{{route('add.cart', $product->id)}}" id="buy-now">MUA NGAY</a> --}}
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                            @else
                                <p class="text text-danger">Hiện tại không có sản phẩm nào!</p>
                            @endif
                        </div>
                    </div>
                @endforeach
                 
            </div>
            <div class="sidebar fl-left">
                @include('frontend.pages.home.include.cate_product')
                @include('frontend.components.selling_product')
                @include('frontend.components.banner')
            </div>
        </div>
    </div>
@endsection
