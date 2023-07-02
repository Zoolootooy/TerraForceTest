<?php

namespace App\Http\Controllers;

use App\Repositories\Posts\PostRepository;
use App\Repositories\Posts\PostRepositoryInterface;
use Illuminate\Http\Request;

class PublicPostsController extends Controller
{
    protected PostRepositoryInterface $repository;

    /**
     * @param PostRepository $repository
     */
    public function __construct(PostRepository $repository)
    {
        $this->repository = $repository;
    }

    public function show($slug)
    {
        $post = $this->repository->getPostBySlugOrFail($slug);
        if (!$post) {
            abort(404);
        }

        return view('posts.show', compact('post'));
    }

    public function postsList()
    {
        $posts = $this->repository->getPublishedPostsPaginated();

        return view('postsList', compact('posts'));
    }
}
