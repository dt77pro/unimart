@extends('layouts.admin')
@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5>Chi tiết bài viết</h5>
        </div>
        <div class="card-body">
            <h6>{{$post->title}}</h6>
            {!!$post->content!!} 
        </div>  
    </div>
</div>
    
@endsection
