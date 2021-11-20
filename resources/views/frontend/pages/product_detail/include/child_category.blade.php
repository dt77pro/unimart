{{-- <li>
    <a href="{{route('menu_cate', [$child_category->slug.'-'.$child_category->id])}}.html"> {{ $child_category->name }}</a>    
    @if ($child_category->categories->count())
        @foreach ($child_category->categories as $childCategory)
            <ul class="sub-menu">
                @include('frontend.pages.product.include.child_category', ['child_category' => $childCategory])
            </ul>
        @endforeach
    @endif
</li> --}}

@if ($category->childrenCategories->count())
    <ul class="sub-menu">
        @foreach ($category->childrenCategories as $childCategory)
            <li class="cate-parent">
                <a href="{{route('cate_product', $childCategory->slug.'-'.$childCategory->id)}}">{{$childCategory->name}}</a>
                @if ($category->childrenCategories->count())
                    @include('frontend.pages.product.include.child_category', ['category' => $childCategory])
                @endif
            </li>
        @endforeach
    </ul>
@endif
