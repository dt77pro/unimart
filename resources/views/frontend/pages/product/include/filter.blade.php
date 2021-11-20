<div class="section" id="filter-product-wp">
    <div class="section-head">
        <h3 class="section-title">Bộ lọc</h3>
    </div>
    <div class="section-detail">
        <form method="GET" action="" id="filter-price-product">
            <table>
                <thead>
                    <tr>
                        <td colspan="2">Giá</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input {{Request::get('p') == "duoi-1-trieu" ? "checked='checked'" : ""}} type="radio" class="filter-price" name="p" value="duoi-1-trieu"></td>
                        <td>Dưới 1.000.000đ</td>
                    </tr>
                    <tr>
                        <td><input {{Request::get('p') == "tu-1-3-trieu" ? "checked='checked'" : ""}} type="radio" class="filter-price" name="p" value="tu-1-3-trieu"></td>
                        <td>1.000.000đ - 3.000.000đ</td>
                    </tr>
                    <tr>
                        <td><input {{Request::get('p') == "tu-3-5-trieu" ? "checked='checked'" : ""}} type="radio" class="filter-price" name="p" value="tu-3-5-trieu"></td>
                        <td>3.000.000đ - 5.000.000đ</td>
                    </tr>
                    <tr>
                        <td><input {{Request::get('p') == "tu-5-7-trieu" ? "checked='checked'" : ""}} type="radio" class="filter-price" name="p" value="tu-5-7-trieu"></td>
                        <td>5.000.000đ - 7.000.000đ</td>
                    </tr>
                    <tr>
                        <td><input {{Request::get('p') == "tu-7-10-trieu" ? "checked='checked'" : ""}} type="radio" class="filter-price" name="p" value="tu-7-10-trieu"></td>
                        <td>7.000.000đ - 10.000.000đ</td>
                    </tr>
                    <tr>
                        <td><input {{Request::get('p') == "tren-10-trieu" ? "checked='checked'" : ""}} type="radio" class="filter-price" name="p" value="tren-10-trieu"></td>
                        <td>Trên 10.000.000đ</td>
                    </tr>
                </tbody>
            </table>
            <table>
                <thead>
                    <tr>
                        <td colspan="2">Thương hiệu</td>
                    </tr>
                </thead>
                <tbody>
                    @if ($list_brands)
                            <tr>
                                <td><input type="radio" class="brand-product" name="brand" checked value="all_product"></td>
                                <td>Tất cả</td>
                            </tr>
                        @foreach ($list_brands as $brand)    
                            <tr>
                                <td><input type="radio" class="brand-product" name="brand" {{Request::get('brand') == $brand->name ? "checked='checked'" : ""}} value="{{$brand->name}}"></td>
                                <td>{{$brand->name}}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </form>
    </div>
</div> 

 <script>
    $(document).ready(function() {
        $(".filter-price").on('change', function() {
            $("#filter-price-product").submit();
        });
        
        $(".brand-product").on('change', function() {
            $("#filter-price-product").submit();
        });

    });
</script> 