@extends('layouts.admin')
@section('content')
<style>
span.label {
    display: block;
    width: 20%;
    font-weight: 700;
    float: left;
    color: #666;
}
.desc-more {
    display: block;
    margin-bottom: 10px;
    padding-bottom: 10px;
}
.ctn-label {
    float: left;
    width: 80%;
    margin-bottom: 10px;
    padding-bottom: 10px;
}
</style>
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5>Chi tiết sản phẩm</h5>
        </div>
        <div class="card-body">
            <div class="col-12 desc-more">
                <span class="label">Tên sản phẩm</span>
                <p>{{$product->name}}</p>
            </div>
            <div class="col-12 desc-more">
                <span class="label">Hình ảnh sản phẩm</span>
                <img width="250" height="250" src="{{asset($product->featured_img_path)}}" alt="{{$product->name}}">
            </div>
            <div class="col-12 desc-more">
                <span class="label">Giá sản phẩm</span>
                <p>{{number_format($product->price, 0, ',', '.')}}đ</p>
            </div>
            <div class="col-12 desc-more">
                <span class="label">Số lượng trong kho</span>
                @if ($product->qty > 0)
                    <p>{{$product->qty}}</p>
                @else
                    <p>Hết hàng</p>
                @endif
            </div>
            <div class="col-12 desc-more">
                <span class="label">Mô tả sản phẩm</span>
                <div class="ctn-label">
                    {{$product->description}}
                </div>
            </div>
            <div class="col-12 desc-more">
                <span class="label">Nội dung sản phẩm</span>
                <div class="ctn-label">
                    {!!$product->content!!}
                </div>
            </div>
            
        </div>  
    </div>
</div>

     
@endsection