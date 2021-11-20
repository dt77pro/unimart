<div class="section-head clearfix" >
    <div class="filter-wp fl-right">
        <p class="desc" style="padding-right: 42px">Hiển thị <strong>({{$products->count()}})</strong> sản phẩm</p>
        <div class="form-filter">
            <form method="GET" action="" id="filter-order">
                @csrf
                <select name="order_by" class="order-by-product">
                    <option {{Request::get('order_by') == "none" || !Request::get('order_by') ? "selected='selected'" : ""}} value="{{Request::url()}}?order_by=none">Sắp xếp</option>
                    <option {{Request::get('order_by') == "a-z" ? "selected='selected'" : ""}} value="{{Request::url()}}?order_by=a-z">Từ A-Z</option>
                    <option {{Request::get('order_by') == "z-a" ? "selected='selected'" : ""}} value="{{Request::url()}}?order_by=z-a">Từ Z-A</option>
                    <option {{Request::get('order_by') == "tang-dan" ? "selected='selected'" : ""}} value="{{Request::url()}}?order_by=tang-dan">Giá thấp lên cao</option>
                    <option {{Request::get('order_by') == "giam-dan" ? "selected='selected'" : ""}} value="{{Request::url()}}?order_by=giam-dan">Giá cao xuống thấp</option>
                </select>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $(".order-by-product").on('change', function() {
            var url = $(this).val();
            if (url) {
                window.location = url;
            }
            return false;
            
        })
    });
</script>