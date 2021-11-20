 <div class="section-head clearfix" >
    <div class="filter-wp fl-right">
        <p class="desc text text-danger" style="padding-right: 42px">Hiển thị {{$count_products}} sản phẩm</p>
        <div class="form-filter">
            <form method="GET" action="" id="filter-order">
                <input type="hidden" name="p" value="{{Request::get('p')}}">
                <input type="hidden" name="brand" value="{{Request::get('brand')}}">
                <select name="order_by" class="orderby">
                    <option {{Request::get('order_by') == "none" || !Request::get('order_by') ? "selected='selected'" : ""}} value="none">Sắp xếp</option>
                    <option {{Request::get('order_by') == "a-z" ? "selected='selected'" : ""}} value="a-z">Từ A-Z</option>
                    <option {{Request::get('order_by') == "z-a" ? "selected='selected'" : ""}} value="z-a">Từ Z-A</option>
                    <option {{Request::get('order_by') == "tang-dan" ? "selected='selected'" : ""}} value="tang-dan">Giá thấp lên cao</option>
                    <option {{Request::get('order_by') == "giam-dan" ? "selected='selected'" : ""}} value="giam-dan">Giá cao xuống thấp</option>
                </select>
             </form>
        </div>
    </div>
</div> 
<script>
    $(function() {
        $(".orderby").on('change', function() {
            $("#filter-order").submit();
        })
    });
</script>
