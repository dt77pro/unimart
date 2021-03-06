 <!DOCTYPE html>
 <html> 
     <head> 
         <title>UNIMART</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <link href="{{asset('/css/user/css/bootstrap/bootstrap-theme.min.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('/css/user/css/bootstrap/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('/css/user/reset.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('/css/user/css/carousel/owl.carousel.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('/css/user/css/carousel/owl.theme.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('/css/user/css/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('/css/user/style.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('/css/user/responsive.css')}}" rel="stylesheet" type="text/css"/>

        <script src="{{asset('/js/user/js/jquery-2.2.4.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('/js/user/js/elevatezoom-master/jquery.elevatezoom.js')}}" type="text/javascript"></script>
        <script src="{{asset('/js/user/js/bootstrap/bootstrap.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('/js/user/js/carousel/owl.carousel.js')}}" type="text/javascript"></script>
        <script src="{{asset('/js/user/js/main.js')}}" type="text/javascript"></script>
        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
        
        <!-- JavaScript -->
        <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
        <!-- CSS -->
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
        <!-- Default theme -->
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
        <!-- Semantic UI theme -->
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css"/>
        <!-- Bootstrap theme -->
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>
        {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
   
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
        <style>
            .ui-widget { 
                position: relative;
                width: 750px;
                background: #fff;
                z-index: 100000;
                left: 2px;
                right: 2px;
                box-shadow: 0 1px 8px rgb(0 0 0 / 30%);
                cursor: pointer; 
             } 
            .ui-widget li {
                display: block;
                overflow: hidden;
                padding: 10px;
                border-bottom: 1px solid #eee;
            }
            #search-text {
                display: inline-block;
                width: 400px;
                border: none;
                outline: none;
                padding: 8px 20px;
                line-height: normal;
            }
        </style>
    </head>
    <body> 
         <div id="site">
            <div id="container">
                <div id="header-wp">
                    <div id="head-top" class="clearfix">
                        <div class="wp-inner">
                            <a href="" title="" id="payment-link" class="fl-left">H??nh th???c thanh to??n</a>
                            <div id="main-menu-wp" class="fl-right">
                                <ul id="main-menu" class="clearfix">
                                    <li>
                                        <a href="{{route('index')}}" title="">Trang ch???</a>
                                    </li>
                                    <li>
                                        <a href="{{route('list_product')}}" title="">S???n ph???m</a>
                                    </li>
                                    <li>
                                        <a href="{{route('post')}}" title="">Blog</a>
                                    </li>
                                    <li>
                                        <a href="{{route('recommend')}}" title="">Gi???i thi???u</a>
                                    </li>
                                    <li>
                                        <a href="{{route('contact')}}" title="">Li??n h???</a>
                                    </li>
                                    
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div id="head-body" class="clearfix">
                        <div class="wp-inner">
                            <a href="{{route('home')}}" title="" id="logo" class="fl-left"><img src="{{asset('/css/user/images/logo.png')}}"/></a>
                            <div id="search-wp" class="fl-left">
                                <form id="search-form" action="{{route('searchproductajax')}}" method="POST">
                                    @csrf
                                    <input type="text" name="search_product" id="search-text" placeholder="Nh???p t??? kh??a t??m ki???m t???i ????y!">
                                    <button type="submit" name="searchbtn" id="sm-s">T??m ki???m</button>
                                </form>
                            </div>
                            <div id="action-wp" class="fl-right">
                                <div id="advisory-wp" class="fl-left">
                                    <span class="title">T?? v???n</span>
                                    <span class="phone">0987.654.321</span>
                                </div>
                                <div id="btn-respon" class="fl-right"><i class="fa fa-bars" aria-hidden="true"></i></div>
                                <a href="" title="gi??? h??ng" id="cart-respon-wp" class="fl-right">
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                    <span id="num"></span>
                                </a>
                                <div id="cart-wp" class="fl-right">
                                    <div id="btn-cart">
                                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                        <span id="num">{{Cart::count()}}</span>
                                    </div>
                                    <div id="dropdown">
                                        <p class="desc count-item">C?? <span>{{Cart::count()}}</span> s???n ph???m trong gi??? h??ng</p> 
                                        <ul class="list-cart">
                                            @foreach (Cart::content() as $val => $product)
                                                <li class="clearfix">
                                                    <a href="" title="" class="thumb fl-left">
                                                        <img src="{{asset($product->options->featured_img_path)}}" alt="">
                                                    </a>
                                                    <div id="info-cart" class="info fl-right">
                                                        <a href="" title="" class="product-name-{{$product->rowId}}">{{$product->name}}</a>
                                                        <p class="price">{{number_format($product->price, 0, ',', '.')}}??</p>
                                                        <input type="hidden" class="product_id" value="{{$product->rowId}}">
                                                        <p class="qty-{{$product->rowId}}" id="sub-qty">S??? l?????ng: <span>{{$product->qty}}</span></p>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul> 
                                        <div class="total-price clearfix">
                                            <p id="total-price" class="fl-right">T???ng gi??: <span class="text-lowercase">{{Cart::subtotal(0, ',', '.')}}??</span></p>
                                        </div>
                                        <div class="action-cart clearfix">
                                            <a href="{{route('cart')}}" title="Gi??? h??ng" class="view-cart fl-left">Gi??? h??ng</a>
                                            <a href="" title="Thanh to??n" class="checkout fl-right">Thanh to??n</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>   