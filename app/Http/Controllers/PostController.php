<?php

namespace App\Http\Controllers;

use App\Http\Requests\Posts\StoreRequest;
use App\Http\Requests\Posts\UpdateRequest;
use App\Repositories\Posts\PostRepository;
use App\Repositories\Posts\PostRepositoryInterface;
use Illuminate\Http\Request;

class PostController extends Controller
{
    protected PostRepositoryInterface $repository;

    /**
     * @param PostRepository $repository
     */
    public function __construct(PostRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $posts = $this->repository->getAllPostsPaginated();

        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(StoreRequest $request)
    {
        try {
            $post = $this->repository->store($request->validated());
        } catch (\Throwable $e) {
            return back()->withErrors($e->getMessage())->withInput($request->all());
        }

        return redirect(route('posts.index'));
    }

    public function edit($id)
    {
        $post = $this->repository->getPostByIdOrFail($id);

        return view('posts.edit', compact('post'));
    }

    public function update(UpdateRequest $request, $id)
    {
        try {
            $post = $this->repository->update($id, $request->validated());
        } catch (\Throwable $e) {
            return back()->withErrors($e->getMessage())->withInput($request->all());
        }

        return redirect(route('posts.index'));
    }

    public function destroy($id)
    {
        try {
            $post = $this->repository->destroy($id);
        } catch (\Throwable $e) {
            return back()->withErrors($e->getMessage());
        }

        return redirect(route('posts.index'));
    }
}
