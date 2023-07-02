@extends('layouts.app', ['title' => __("$post->title")])

@section('content')
    <div class="row">
        <div class="col-lg-8 offset-lg-2 col-12">
            <h3>{{ $post->title  }}</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4 offset-lg-2 col-12">
            <div class="author-field">
                By <span class="author-name">{{ $post->author->name }}</span>
            </div>
        </div>

        <div class="col-lg-4 col-12 text-lg-end">
            <div class="time-field">
                {{ $post->getCustomFullAttribute('posted_at') ?? 'It\'s a draft' }}
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-lg-8 offset-lg-2 col-12">
            <p>
                {{ $post->text }}
            </p>
        </div>
    </div>
@endsection
