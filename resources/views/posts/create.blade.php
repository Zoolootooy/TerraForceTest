@extends('layouts.app', ['title' => __('Create Post')])

@section('content')
    <div class="row">
        <div class="col-12">
            <form action="{{route('posts.store')}}" method="POST" enctype='multipart/form-data'>
                @csrf
                @include('helpers.simpleErrorsDisplay')

                <div class="row mt-4">
                    <div class="col-2 label-container">Title</div>
                    <div class="col-6">
                        <input type="text" class="form-control" name="title" value="{{old('title')}}" required>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-2 label-container">Text</div>
                    <div class="col-6">
                        <textarea class="form-control" rows="5" name="text" required>{{old('text')}}</textarea>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-2 label-container">
                        <label for="post_now" class="cp">Post it now?</label>
                    </div>
                    <div class="col-6">
                        <input id="post_now" type="checkbox" class="form-check-input cp" name="post_now"
                               @if(!is_null(old('post_now'))) checked @endif>
                    </div>
                </div>

                <button type="submit" class="btn btn-success mt-4">Save</button>
            </form>
        </div>
    </div>
@endsection
