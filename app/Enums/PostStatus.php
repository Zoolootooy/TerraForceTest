<?php

namespace App\Enums;

enum PostStatus: string
{
    case Draft = 'draft';
    case Posted = 'posted';
}