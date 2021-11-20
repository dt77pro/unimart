@extends('layouts.master_frontEnd')
@section('content')
<style>
.container {
    width: 1170px;
    background-color: #fff;
}
h1.title-contact {
    font-size: 17px;
    line-height: 28px;
    margin: 0 0 10px;
    font-weight: 700;
    padding: 5px 15px;
    color: #444;
    border-bottom: 2px solid #ddd;
}
span.label {
    display: block;
    width: 100px;
    font-weight: 700;
    float: left;
    color: #666;
}
.desc-more {
    margin-bottom: 10px;
    padding-bottom: 10px;
    border-bottom: solid 1px #DCE2E7;
}
.ctn-label {
   float: left;
   width: 90%;
}
</style>
<div id="main-content-wp" class="home-page clearfix">
    <div class="wp-inner">
        @include('frontend.pages.contact.include.breadcrumb')
        <div class="container">
            <div class="row" style="padding: 15px 0 5px; margin: 0 auto">
                <h1 class="title-contact">Liên hệ với chúng tôi</h1>
                <div class="col-12 desc-more">
                    <span class="label">Danh mục</span>
                    <p>{{$contact->category}}</p>
                </div>
                <div class="col-12 desc-more">
                    <span class="label">Địa chỉ</span>
                    <p>{{$contact->address}}</p>
                </div>
                <div class="col-12 desc-more">
                    <span class="label">Hotline</span>
                    <p>{{$contact->hotline}}</p>
                </div>
                <div class="col-12 desc-more">
                    <span class="label">Mô tả</span>
                    <div class="ctn-label">
                       {!!$contact->description!!}
                    </div>
                </div>
                <div class="col-12 desc-more">
                    <span class="label">Fanpage</span>
                    <div class="fb-page"
                        data-href="https://www.facebook.com/facebook" 
                        data-width="340"
                        data-hide-cover="false"
                        data-show-facepile="true">
                    </div>
                </div>
                <div class="col-12 desc-more">
                    <span class="label">Bản đồ</span>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d61924.12799894476!2d109.00239986420871!3d14.061936477615577!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x316f3a83910b6753%3A0xac5b0972a5f68c48!2zQ8OhdCBIYW5oLCBQaMO5IEPDoXQsIELDrG5oIMSQ4buLbmgsIFZp4buHdCBOYW0!5e0!3m2!1svi!2s!4v1624411396650!5m2!1svi!2s" width="100%" height="550" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div> 
        </div>
    </div>
</div>
    
@endsection