<?php

use Illuminate\Support\Facades\Route;
use Modules\Visit\Http\Controllers\VisitController;
use Modules\Visit\Http\Controllers\VisitFrontController;


Route::middleware(['auth','isNotBlock'])->prefix('panel')->as('panel.visit.')->group(function(){
    Route::get('/visits',[VisitController::class,'visits'])->name('visits');
    Route::post('/getVisits',[VisitController::class,'getVisits'])->name('getVisits');
    Route::get('/visitCreate',[VisitController::class,'visitCreate'])->name('visitCreate');
    Route::post('/visitStore',[VisitController::class,'visitStore'])->name('visitStore');
    Route::get('/visitEdit/{visit}',[VisitController::class,'visitEdit'])->name('visitEdit');
    Route::post('/visitUpdate/{visit}',[VisitController::class,'visitUpdate'])->name('visitUpdate');
    Route::get('/visitDelete/{visit}',[VisitController::class,'visitDelete'])->name('visitDelete');
});

Route::prefix('visit')->as('visit.')->group(function () {
    Route::get('/visits', [VisitFrontController::class, 'visits'])->name('visits');
    Route::post('/moreVisits', [VisitFrontController::class, 'moreVisits'])->name('moreVisits');
});

