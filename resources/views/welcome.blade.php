@extends('layouts.app', ['title' => __('Welcome page')])

@section('content')
<div class="col-lg-6 offset-lg-3 col-12">
    <a href="{{route('posts.list')}}" class="btn btn-primary">Posts list</a>
</div>
@endsection