<?php

use Illuminate\Support\Facades\Route;
use Modules\Intership\Http\Controllers\IntershipController;

Route::middleware(['auth','isNotBlock'])->as('intership.')->group(function(){
    Route::get('intership/{id}', [IntershipController::class,'intership'])->name('intership');
});

Route::middleware(['auth','isNotBlock'])->prefix('panel')->as('panel.intership.')->group(function(){
    Route::get('/interships',[IntershipController::class,'interships'])->name('interships');
    Route::post('/getInterships',[IntershipController::class,'getInterships'])->name('getInterships');

    Route::get('/companyAccept/{intership}',[IntershipController::class,'companyAccept'])->name('companyAccept');
    Route::post('/rejectIntership',[IntershipController::class,'rejectIntership'])->name('rejectIntership');

    Route::post('/universityAccept',[IntershipController::class,'universityAccept'])->name('universityAccept');
    Route::post('/userReport',[IntershipController::class,'userReport'])->name('userReport');

    Route::get('/introductionShow/{intership}',[IntershipController::class,'introductionShow'])->name('introductionShow');
    Route::get('/reportShow/{intership}',[IntershipController::class,'reportShow'])->name('reportShow');
});
