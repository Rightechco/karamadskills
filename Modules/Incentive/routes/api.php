<?php

use Illuminate\Support\Facades\Route;
use Modules\Incentive\Http\Controllers\IncentiveController;

Route::prefix('skilledSoldier')->as('api.')->group(function(){
    Route::post('/notify',[IncentiveController::class,'apiNotify'])->name('apiNotify');
    Route::post('/inform',[IncentiveController::class,'apiInform'])->name('apiInform');
});
