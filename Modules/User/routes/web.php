<?php

use Illuminate\Support\Facades\Route;
use Modules\User\Http\Controllers\UserController;

Route::middleware(['auth','isNotBlock'])->prefix('panel')->as('panel.user.')->group(function () {
    Route::get('/users', [UserController::class, 'users'])->name('users');
    Route::post('/get-users', [UserController::class, 'getUsers'])->name('getUsers');

    Route::get('/users-create', [UserController::class, 'usersCreate'])->name('usersCreate');
    Route::post('/users-store', [UserController::class, 'usersStore'])->name('usersStore');
    Route::get('/users-edit/{user}', [UserController::class, 'usersEdit'])->name('usersEdit');
    Route::post('/users-update/{user}', [UserController::class, 'usersUpdate'])->name('usersUpdate');
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::post('/usersProfile', [UserController::class, 'usersProfile'])->name('usersProfile');
    Route::post('/usersVerify', [UserController::class, 'usersVerify'])->name('usersVerify');

    Route::get('/file-show/{file}/{folder}', [UserController::class, 'fileShow'])->name('fileShow');
});

Route::prefix('user')->as('user.')->group(function () {
    Route::get('/avatar-show/{file}/{folder}', [UserController::class, 'avatarShow'])->name('avatarShow');
    Route::get('/profile/{slug}', [UserController::class, 'profileFront'])->name('profileFront');
});
