<div class="section" id="category-product-wp">
    <div class="section-head">
        <h3 class="section-title">Danh mục sản phẩm</h3>
    </div>
    <div class="secion-detail">
        <ul class="list-item">
            @foreach ($menu_categories as $category)
                <li class="cate-parent">
                    <a href="{{route('cate_product', $category->slug.'-'.$category->id)}}" title="">{{$category->name}}</a>
                    @include('frontend.pages.product.include.child_category', ['category' => $category]) 
                </li>  
            @endforeach
        </ul>
    </div>
</div>
