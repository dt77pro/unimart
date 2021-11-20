@extends('layouts.master_frontEnd')
@section('content')
<div id="main-content-wp" class="clearfix blog-page">
    <div class="wp-inner">
        @include('frontend.pages.post.include.breadcrumb')
        <div class="main-content fl-right">
            <div class="section" id="list-blog-wp">
                <div class="section-head clearfix">
                    <h3 class="section-title">Blog</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item">
                        @foreach ($posts as $post)
                            <li class="clearfix">
                                <a href="{{route('detail_post', $post->slug)}}" title="" class="thumb fl-left">
                                    <img src="{{url($post->thumbnail)}}" alt="">
                                </a>
                                <div class="info fl-right">
                                    <a href="{{route('detail_post', $post->slug)}}">
                                        <h3 style="line-height: 26px;color: #333;font-size: 20px;font-weight: normal; margin-bottom: 5px;">{{$post->title}}</h3>
                                        <span class="create-date"><?php echo \Carbon\Carbon::createFromTimeStamp(strtotime($post->created_at))->diffForHumans() ?></span>
                                        <p class="desc">{{$post->description}}</p>
                                    </a>
                                </div>
                            </li>
                        @endforeach
                    </ul> 
                </div>
            </div>
        </div>
        <div class="sidebar fl-left">
            @include('frontend.components.selling_product')
            @include('frontend.components.banner')
        </div>
    </div>
</div>
@endsection