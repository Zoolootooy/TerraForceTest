<?php

namespace App\Repositories\Posts;

use App\Enums\PostStatus;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PostRepository implements PostRepositoryInterface
{
    /**
     * @param int $perPage
     * @return mixed
     */
    public function getAllPostsPaginated(int $perPage = 10): mixed
    {
        $posts = Post::paginate($perPage);

        return $posts;
    }

    /**
     * @param int $perPage
     * @return mixed
     */
    public function getPublishedPostsPaginated(int $perPage = 10): mixed
    {
        $posts = Post::where('status', PostStatus::Posted)
            ->orderBy('posted_at', 'desc')
            ->paginate($perPage);

        return $posts;
    }

    /**
     * @param int $id
     * @return Post|ModelNotFoundException
     */
    public function getPostByIdOrFail(int $id): Post|ModelNotFoundException
    {
        $post = Post::findOrFail($id);

        return $post;
    }

    /**
     * @param string $slug
     * @return Post|ModelNotFoundException
     */
    public function getPostBySlugOrFail(string $slug): Post|null
    {
        $post = Post::where('slug', $slug)
            ->when(!Auth::check(), function ($q) {
                $q->where('status', PostStatus::Posted);
            })
            ->first();

        return $post;
    }

    /**
     * @param array $attributes
     * @return Post
     * @throws \Exception
     */
    public function store(array $attributes): Post
    {
        try {
            $post = new Post($attributes);
            $post->slug = Str::slug($attributes['title']);
            $post->author_id = Auth::id();

            if (isset($attributes['post_now'])) {
                $post->status = PostStatus::Posted;
                $post->posted_at = Carbon::now()->toDateTimeString();
            } else {
                $post->status = PostStatus::Draft;
            }
            $post->save();

            return $post;
        } catch (\Throwable $e) {
            Log::error($e);
            throw new \Exception('Can\'t store post');
        }
    }

    /**
     * @throws \Exception
     */
    public function update(int $id, array $attributes): Post
    {
        $post = Post::findOrFail($id);

        try {
            $post->slug = Str::slug($attributes['title']);
            $post->author_id = Auth::id();

            if (isset($attributes['post_now'])) {
                $post->status = PostStatus::Posted;
                $post->posted_at = Carbon::now()->toDateTimeString();
            } else {
                $post->status = PostStatus::Draft;
                $post->posted_at = null;
            }
            $post->save();
        } catch (\Throwable $e) {
            Log::error($e);
            throw new \Exception('Can\'t update post');
        }

        return $post;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        $post?->delete();

        return $post;
    }
}