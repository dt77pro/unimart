<div id="footer-wp">
    <div id="foot-body">
        <div class="wp-inner clearfix">
            <div class="block" id="info-company">
                <h3 class="title">ISMART</h3>
                <p class="desc">ISMART luôn cung cấp luôn là sản phẩm chính hãng có thông tin rõ ràng, chính sách ưu đãi cực lớn cho khách hàng có thẻ thành viên.</p>
                <div id="payment">
                    <div class="thumb">
                        <img src="public/images/img-foot.png" alt="">
                    </div>
                </div>
            </div>
            <div class="block menu-ft" id="info-shop">
                <h3 class="title">Thông tin cửa hàng</h3>
                <ul class="list-item">
                    <li>
                        <p>106 - Trần Bình - Cầu Giấy - Hà Nội</p>
                    </li>
                    <li>
                        <p>0987.654.321 - 0989.989.989</p>
                    </li>
                    <li>
                        <p>vshop@gmail.com</p>
                    </li>
                </ul>
            </div>
            <div class="block menu-ft policy" id="info-shop">
                <h3 class="title">Chính sách mua hàng</h3>
                <ul class="list-item">
                    <li>
                        <a href="" title="">Quy định - chính sách</a>
                    </li>
                    <li>
                        <a href="" title="">Chính sách bảo hành - đổi trả</a>
                    </li>
                    <li>
                        <a href="" title="">Chính sách hội viện</a>
                    </li>
                    <li>
                        <a href="" title="">Giao hàng - lắp đặt</a>
                    </li>
                </ul>
            </div>
            <div class="block" id="newfeed">
                <h3 class="title">Bảng tin</h3>
                <p class="desc">Đăng ký với chung tôi để nhận được thông tin ưu đãi sớm nhất</p>
                <div id="form-reg">
                    <form method="POST" action="">
                        <input type="email" name="email" id="email" placeholder="Nhập email tại đây">
                        <button type="submit" id="sm-reg">Đăng ký</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="foot-bot">
        <div class="wp-inner">
            <p id="copyright">© Bản quyền thuộc về unitop.vn | Php Master</p>
        </div>
    </div>
</div>
</div>
<div id="menu-respon">
    <a href="{{route('home')}}" title="" class="logo">Unimart</a>
    <div id="menu-respon-wp">
        <ul class="" id="main-menu-respon">
            <li>
                <a href="{{route('home')}}" title>Trang chủ</a>
            </li>
            <li>
                <a href="{{route('list_product')}}" title>Sản phẩm</a>
            </li>
            <li>
                <a href="{{route('post')}}" title>Blog</a>
            </li>
            <li>
                <a href="{{route('recommend')}}" title>Giới thiệu</a>
            </li>
            <li>
                <a href="{{route('contact')}}" title>Liên hệ</a>
            </li>
        </ul>
    </div>
    <a href="{{route('home')}}" title="" class="logo">Danh mục sản phẩm</a>
    <div id="menu-respon-wp">
        <ul class="list-item" id="main-menu-respon">
            @foreach ($menu_categories as $category)
                <li class="cate-parent">
                    <a href="{{route('cate_product', $category->slug.'-'.$category->id)}}" title="">{{$category->name}}</a>
                    @include('frontend.pages.product.include.child_category', ['category' => $category]) 
                </li>  
            @endforeach
        </ul>
    </div>
</div>
<div id="btn-top"><img src="{{asset('/css/user/images/icon-to-top.png')}}" alt=""/></div>
<div id="fb-root"></div>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $(document).ready(function () {

        let src = "{{route('searchproductajax')}}";
        $( "#search-text" ).autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: src,
                    data: {
                        term: request.term
                    },
                    dataType: "json",
                    success: function(data) {
                        response(data);
                        // alert(data);
                    }    
                }); 
            },
            minLenght: 1,
        });
        $(document).on('click', '.ui-menu-item', function() {
            $('#search-form').submit();
        });
    });
</script>
<script>(function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id))
            return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.8&appId=849340975164592";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
<script type="text/javascript">
    if(typeof type_massage != 'undefined'){

        switch (type_massage) {
            case 'success':
                toastr.success(massage)
                break;
        
            case 'error':
                toastr.error(massage)
                break;

            case 'warning':
                toastr.warning(massage)
                break;

            case 'info':
                toastr.info(massage)
                break;
        }
    }

</script>

</body>
</html>