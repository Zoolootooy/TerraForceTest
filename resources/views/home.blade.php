@extends('layouts.app', ['title' => __('Home')])

@section('content')
<div class="row">
    <div class="col-12">
        <a href="{{route('posts.index')}}" class="btn btn-primary">Posts</a>
    </div>
</div>
@endsection
