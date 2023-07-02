@extends('layouts.app', ['title' => __("Edit post $post->id")])

@section('content')
    <div class="row">
        <div class="col-12">
            <form action="{{route('posts.update', ['post' => $post->id])}}" method="POST" enctype='multipart/form-data'>
                @csrf
                @method('put')

                @include('helpers.simpleErrorsDisplay')

                <div class="row mt-4">
                    <div class="col-2 label-container">Title</div>
                    <div class="col-6">
                        <input type="text" class="form-control" name="title" value="{{ $post->title }}" required>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-2 label-container">Text</div>
                    <div class="col-6">
                        <textarea class="form-control" rows="5" name="text" required>{{ $post->text}}</textarea>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-2 label-container">
                        <label for="post_now" class="cp">Is posted</label>
                    </div>
                    <div class="col-6">
                        <input id="post_now" type="checkbox" class="form-check-input cp" name="post_now"
                               @if(!is_null($post->posted_at)) checked @endif>
                    </div>
                </div>

                <button type="submit" class="btn btn-success mt-4">Save</button>
            </form>
        </div>
    </div>
@endsection
