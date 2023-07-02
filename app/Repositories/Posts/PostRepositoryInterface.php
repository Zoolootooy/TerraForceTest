<?php

namespace App\Repositories\Posts;

use App\Models\Post;
use Illuminate\Database\Eloquent\ModelNotFoundException;

interface PostRepositoryInterface
{
    public function getAllPostsPaginated(int $perPage);

    public function store(array $attributes): Post;

    public function update(int $id, array $attributes): Post;

    public function getPostByIdOrFail(int $id): Post|ModelNotFoundException;

    public function getPostBySlugOrFail(string $slug): Post|null;
}