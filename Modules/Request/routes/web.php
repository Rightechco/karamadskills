<?php

use Illuminate\Support\Facades\Route;
use Modules\Request\Http\Controllers\RequestController;

Route::middleware(['auth','isNotBlock'])->as('request.')->group(function(){
    Route::get('request/{id}', [RequestController::class,'request'])->name('request');
});

Route::middleware(['auth','isNotBlock'])->prefix('panel')->as('panel.request.')->group(function(){
    Route::get('/requests',[RequestController::class,'requests'])->name('requests');
    Route::post('/getRequests',[RequestController::class,'getRequests'])->name('getRequests');

    Route::get('/announcementRequests/{announcement}',[RequestController::class,'announcementRequests'])->name('announcementRequests');
    Route::post('/getAnnouncementRequests/{announcement}',[RequestController::class,'getAnnouncementRequests'])->name('getAnnouncementRequests');

    Route::get('/allRequests',[RequestController::class,'allRequests'])->name('allRequests');
    Route::post('/getAllRequests',[RequestController::class,'getAllRequests'])->name('getAllRequests');

    Route::get('/interviewRequests/{request}',[RequestController::class,'interviewRequests'])->name('interviewRequests');
    Route::get('/hiredRequests/{request}',[RequestController::class,'hiredRequests'])->name('hiredRequests');
    Route::post('/rejectRequests',[RequestController::class,'rejectRequests'])->name('rejectRequests');

    Route::post('/createMeet',[RequestController::class,'createMeet'])->name('createMeet');
    Route::get('/storeMeet',[RequestController::class,'storeMeet'])->name('storeMeet');
});
