<?php

use Illuminate\Support\Facades\Route;
use Modules\Comment\Http\Controllers\CommentController;

Route::middleware(['auth','isNotBlock'])->prefix('panel')->as('panel.comment.')->group(function() {
    Route::get('/comments', [CommentController::class, 'comments'])->name('comments');
    Route::post('/getComments',[CommentController::class,'getComments'])->name('getComments');
    Route::get('/getText/{comment}',[CommentController::class,'getText'])->name('getText');
    Route::get('/commentVerify/{comment}',[CommentController::class,'commentVerify'])->name('commentVerify');
    Route::get('/commentUnVerify/{comment}',[CommentController::class,'commentUnVerify'])->name('commentUnVerify');

    Route::post('/createComment',[CommentController::class,'createComment'])->name('createComment');
    Route::post('/reply',[CommentController::class,'reply'])->name('reply');
});
