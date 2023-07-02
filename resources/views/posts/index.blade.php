@extends('layouts.app', ['title' => __('Posts List')])

@section('content')
    <div class="row">
        <div class="col-12">
            <a href="{{route('posts.create')}}" class="btn btn-success">Add new post</a>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>#ID</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Status</th>
                    <th>Posted at</th>
                    <th>Created at</th>
                    <th>Updated at</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($posts as $post)
                    <tr>
                        <td>{{$post->id}}</td>
                        <td>{{$post->title}}</td>
                        <td>{{$post->author->name}}</td>
                        <td>{{Str::ucfirst($post->status->value)}}</td>
                        <td>{{$post->getCustomFullAttribute('posted_at')}}</td>
                        <td>{{$post->getCreatedFullAttribute()}}</td>
                        <td>{{$post->getUpdatedFullAttribute()}}</td>
                        <td>
                            <a href="{{route('posts.show', ['slug' => $post->slug])}}" target="_blank"
                               class="btn btn-success" title="{{__('Show')}}">
                                <i class="bi bi-eye-fill"></i>
                            </a>

                            <a href="{{route('posts.edit', ['post' => $post->id])}}" class="btn btn-warning"
                               title="{{__('Edit')}}">
                                <i class="bi bi-pencil-square"></i>
                            </a>

                            <a href="{{route('posts.destroy', ['post' => $post->id])}}" class="btn btn-danger"
                               title="{{__('Delete')}}" onclick="event.preventDefault();
                               document.getElementById('deletePost').submit();">
                                <i class="bi bi-trash-fill"></i>
                            </a>

                            <form id="deletePost" action="{{route('posts.destroy', ['post' => $post->id])}}" method="POST" class="d-none">
                                @csrf
                                @method('delete')
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            {{ $posts->withQueryString()->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
