@extends('layouts.master_frontEnd')
@section('content')
    <div id="main-content-wp" class="clearfix category-product-page">
        <div class="wp-inner">
            @include('frontend.pages.product.include.breadcrumb.breadcrumb_cate')
            <div class="main-content fl-right">
                <div class="section" id="list-product-wp" style="margin-top: -39px;">
                    @include('frontend.pages.product.include.cate_filter')
                    <div class="section-detail" style="margin-top: -45px">
                        <div class="cate-product">
                            <h3 class="section-title fl-left text-transform-none" style="padding-bottom: 10px; text-transform: none;">{{$count_products.' '.$cate->name}}</h3> 
                        </div>
                            <ul class="list-item clearfix" style="padding-bottom: 15px"> 
                                <div id="loadmore">  
                                    @foreach ($list_product_by_cates as $product_item)
                                        <li id="list-product-cate" style="text-align:center; position: relative;">
                                            @if ($product_item->qty < 1) 
                                                <span style="font-size: 14px;position: absolute;background: #e6007f;border-radius: 5px;top: -1px;left: 125px;color: #fff">Tạm hết hàng</span>
                                            @endif
                                            <a href="{{route('detail_product', $product_item->slug)}}" title="{{$product_item->name}}" class="thumb">
                                                <img src="{{asset($product_item->featured_img_path)}}" class="fluid image">
                                            </a>
                                            <a href="{{route('detail_product', $product_item->slug)}}" title="" class="product-name">{{Str::of($product_item->name)->limit(22)}}</a>
                                            <div class="price">
                                                <span class="new">{{number_format($product_item->price, 0, '', '.')}}₫</span>
                                            </div>
                                            <div class="action clearfix">
                                                <a href="{{route('buy_now.cart', $product_item->slug)}}" id="buy-now">MUA NGAY</a>
                                            </div>
                                        </li>
                                    @endforeach 
                                </div>
                            </ul>   
                    </div>
                </div>
                <div class="section" id="paging-wp">
                     <div class="section-detail"> 
                        <div id="load-more-pro" class="ajax-loading"></div>
                        {{-- @if ($list_product_by_cates->count())
                           {!!$list_product_by_cates->withQueryString()->links()!!}
                       @else
                           <p class="text text-danger">Hiện tại không tồn tại sản phẩm nào!</p>
                       @endif  --}}
                    </div> 
                </div>
            </div>
            <div class="sidebar fl-left">
                @include('frontend.pages.product.include.cate_product')
                @include('frontend.pages.product.include.filter')
                @include('frontend.components.banner')
            </div>
        </div>
    </div>
<script>
 
var page = 1; //track user scroll as page number, right now page number is 1
$(window).scroll(function () { //detect page scroll 
    if ($(window).scrollTop() + 600 + $(window).height() >= $(document).height()) { //if user scrolled from top to bottom of the page
        page++; //page number increment
        load_more(page); //load content   
    }
});
function load_more(page) {
    $.ajax({
            url: '?page=' + page,
            type: "GET",
            datatype: "html",
            beforeSend: function () {
                $('.ajax-loading').show();
            }
        })
        .done(function (data) {
            if (data.length == 0) {
                $('.ajax-loading').html("");
                return;
            }
            $('.ajax-loading').hide(); //hide loading animation once data is received
            $("#loadmore").append(data); //append data into #results element          
        })
        .fail(function (jqXHR, ajaxOptions, thrownError) {
            alert('No response from server');
        });
}
 
 
</script>
    
@endsection






