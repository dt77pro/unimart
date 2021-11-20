
<div class="section" id="feature-product-wp">
    <div class="section-head">
        <h3 class="section-title">Sản phẩm nổi bật</h3>
    </div>
    <div class="section-detail">
        <ul class="list-item">
            @foreach ($product_hots as $item)
                <li class="product-hots" style="height: 337px; text-align: center;">
                    @if ($item->qty < 1) 
                        <span style="font-size: 14px;position: absolute;background: #e6007f;border-radius: 5px;top: -1px;left: 125px;color: #fff">Tạm hết hàng</span>
                    @endif
                    <a href="{{route('detail_product', $item->slug)}}" title="{{$item->name}}" class="thumb" >
                        <img src="{{asset($item->featured_img_path)}}">
                    </a>
                    <a href="{{route('detail_product', $item->slug)}}" title="{{$item->name}}" class="product-name">{{Str::of($item->name)->limit(20)}}</a>
                    <div class="price">
                        <span class="new" name="price">{{number_format($item->price, 0, ',', '.')}}đ</span>
                    </div>
                    <div class="action clearfix"> 
                        <a href="{{route('buy_now.cart', $item->slug)}}" id="buy-now">MUA NGAY</a>
                    </div>  
                </li>
            @endforeach
        </ul>
    </div>
</div>    

