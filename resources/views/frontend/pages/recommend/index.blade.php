@extends('layouts.master_frontEnd')
@section('content')
<style>
.container {
    width: 1170px;
    background-color: #fff;
    font-family: sans-serif;
    font-size: 14px;
    color: #333
}
h1.title-recommend {
    font-size: 17px;
    line-height: 28px;
    margin: 0 0 10px;
    font-weight: 700;
    padding: 5px 15px;
    color: #444;
    border-bottom: 2px solid #ddd;
}
h3 {
    font-size: 16px;
    font-weight: 700;
    margin-top: 20px;
    margin-bottom: 10px;
}
</style>
<div id="main-content-wp" class="home-page clearfix">
    <div class="wp-inner">
    @include('frontend.pages.recommend.include.breadcrumb')
        <div class="container" style="margin:0 auto;">
            <div>
                <h1 style="padding: 15px 0 5px;" class="title-recommend">Giới thiệu về chúng tôi</h1>
                <div class="content">
                    {!!$recommend->content!!}
                    <br>
                    <h3>Văn phòng Unimart</h3>
                    <div style="text-align:center;"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d61924.12799894476!2d109.00239986420871!3d14.061936477615577!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x316f3a83910b6753%3A0xac5b0972a5f68c48!2zQ8OhdCBIYW5oLCBQaMO5IEPDoXQsIELDrG5oIMSQ4buLbmgsIFZp4buHdCBOYW0!5e0!3m2!1svi!2s!4v1624411396650!5m2!1svi!2s" width="100%" height="550" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
            </div>
            <div class="col-lg-2"></div>
        </div>
    </div>
</div>
    
@endsection