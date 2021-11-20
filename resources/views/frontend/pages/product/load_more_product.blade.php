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