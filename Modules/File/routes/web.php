<?php

use Illuminate\Support\Facades\Route;
use Modules\File\Http\Controllers\FileController;

Route::middleware(['auth','isNotBlock'])->prefix('panel')->as('panel.file.')->group(function(){
    Route::get('/ticketFileShow/{file}',[FileController::class,'ticketFileShow'])->name('ticketFileShow');
    Route::get('/courseFileShow/{file}',[FileController::class,'courseFileShow'])->name('courseFileShow');
    Route::get('/incentiveFileShow/{file}',[FileController::class,'incentiveFileShow'])->name('incentiveFileShow');
});
