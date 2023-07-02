<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\PublicPostsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::resource('posts', PostController::class)->except(['show']);
});

Route::get('posts-list', [PublicPostsController::class, 'postsList'])->name('posts.list');
Route::get('posts/{slug}', [PublicPostsController::class, 'show'])->name('posts.show');
