@extends('layouts.app', ['title' => __('Welcome page')])

@section('content')
    @foreach($posts as $post)
        <div class="row mt-3">
            <div class="col-lg-6 offset-lg-3 col-12">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">By {{ $post->author->name }}</h6>
                        <a href="{{route('posts.show', ['slug' => $post->slug])}}">
                            Preview
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection