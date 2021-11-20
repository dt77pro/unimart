
@if ($category->childrenCategories->count())
    <ul class="sub-menu">
        @foreach ($category->childrenCategories as $childCategory)
            <li class="cate-parent" style="text-align:center; position: relative;">
                <a href="{{route('cate_product', $childCategory->slug.'-'.$childCategory->id)}}">{{$childCategory->name}}</a>
                @if ($category->childrenCategories->count())
                    @include('frontend.pages.product.include.child_category', ['category' => $childCategory])
                @endif
            </li>
        @endforeach
    </ul>
@endif
