@extends('layouts.admin')
@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            {{ $page->title }}
        </div>
        <div class="card-body">
            {!!$page->content!!}
        </div>
    </div>
</div>
@endsection
