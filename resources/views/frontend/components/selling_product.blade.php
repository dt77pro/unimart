<div class="section" id="selling-wp">
    <div class="section-head">
        <h3 class="section-title">Sản phẩm bán chạy</h3>
    </div>
    <div class="section-detail">
        <ul class="list-item">
            @foreach ($product_sells as $item)
                <li class="clearfix">
                    <a href="{{route('detail_product', $item->slug)}}" title="{{$item->name}}" class="thumb fl-left">
                        <img src="{{asset($item->featured_img_path)}}" alt="{{$item->name}}">
                    </a>
                    <div class="info fl-right">
                        <a href="{{route('detail_product', $item->slug)}}" title="" class="product-name">{{$item->name}}</a>
                        <div class="price">
                            <span class="new">{{number_format($item->price, 0, ',', '.')}}đ</span>
                        </div>
                        <a href="{{route('buy_now.cart', $item->slug)}}" title="{{$item->name}}" class="buy-now">Mua ngay</a>
                    </div>
                </li>
            @endforeach
          
        </ul>
    </div>
</div>