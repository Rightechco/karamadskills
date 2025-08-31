<?php

use Illuminate\Support\Facades\Route;
use Modules\Incentive\Http\Controllers\IncentiveController;

Route::middleware(['auth','isNotBlock'])->prefix('panel')->as('panel.incentive.')->group(function(){
    Route::get('/incentives',[IncentiveController::class,'incentivesPanel'])->name('incentives');
    Route::post('/getIncentives',[IncentiveController::class,'getIncentives'])->name('getIncentives');
    Route::get('/getExcel',[IncentiveController::class,'getExcel'])->name('getExcel');
    Route::get('/getIncentive/{incentive}',[IncentiveController::class,'getIncentive'])->name('getIncentive');
    Route::get('/incentiveCreate',[IncentiveController::class,'incentiveCreate'])->name('incentiveCreate');
    Route::post('/incentiveStore',[IncentiveController::class,'incentiveStore'])->name('incentiveStore');
    Route::post('/incentiveStatusChange/{incentive}',[IncentiveController::class,'incentiveStatusChange'])->name('incentiveStatusChange');
    Route::get('/incentiveEdit/{incentive}',[IncentiveController::class,'incentiveEdit'])->name('incentiveEdit');
    Route::post('/incentiveUpdate/{incentive}',[IncentiveController::class,'incentiveUpdate'])->name('incentiveUpdate');
    Route::get('/incentiveAcceptItem/{incentive}/{id}',[IncentiveController::class,'incentiveAcceptItem'])->name('incentiveAcceptItem');
    Route::get('/incentiveRejectItem/{incentive}/{id}',[IncentiveController::class,'incentiveRejectItem'])->name('incentiveRejectItem');
    Route::get('/incentiveDelete/{incentive}',[IncentiveController::class,'incentiveDelete'])->name('incentiveDelete');
});

Route::prefix('uni')->as('incentive.')->group(function(){
    Route::get('/incentives',[IncentiveController::class,'incentives'])->name('incentives');
});
