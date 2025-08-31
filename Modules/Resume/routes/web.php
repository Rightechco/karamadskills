<?php

use Illuminate\Support\Facades\Route;
use Modules\Resume\Http\Controllers\ResumeController;

Route::middleware(['auth','isNotBlock'])->prefix('panel')->as('panel.resume.')->group(function(){
    Route::get('/resume',[ResumeController::class,'resume'])->name('resume');
    Route::post('/editResume',[ResumeController::class,'editResume'])->name('editResume');
});

Route::get('/seeResume/{id}',[ResumeController::class,'seeResume'])->name('seeResume');

