<?php

use Illuminate\Support\Facades\Route;
use Modules\Post\Http\Controllers\PostController;
use Modules\Post\Http\Controllers\PostFrontController;


Route::middleware(['auth','isNotBlock'])->prefix('panel')->as('panel.post.')->group(function(){
    Route::get('/posts',[PostController::class,'posts'])->name('posts');
    Route::post('/getPosts',[PostController::class,'getPosts'])->name('getPosts');
    Route::get('/postCreate',[PostController::class,'postCreate'])->name('postCreate');
    Route::post('/postStore',[PostController::class,'postStore'])->name('postStore');
    Route::get('/postEdit/{post}',[PostController::class,'postEdit'])->name('postEdit');
    Route::post('/postUpdate/{post}',[PostController::class,'postUpdate'])->name('postUpdate');
    Route::get('/postDelete/{post}',[PostController::class,'postDelete'])->name('postDelete');
});

Route::prefix('post')->as('post.')->group(function () {
   Route::get('/posts', [PostFrontController::class, 'posts'])->name('posts');
    Route::get('/postsContent/{post}', [PostFrontController::class, 'postsContent'])->name('postsContent');
   Route::post('/morePosts', [PostFrontController::class, 'morePosts'])->name('morePosts');
});
