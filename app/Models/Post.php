<?php

namespace App\Models;

use App\Enums\PostStatus;
use App\Traits\AuthorsTrait;
use App\Traits\TimestampTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory, AuthorsTrait, TimestampTrait;

    protected $fillable = [
        'title',
        'slug',
        'text',
        'status',
        'author_id',
        'posted_at',
    ];

    protected $casts = [
        'status' => PostStatus::class,
    ];
}
