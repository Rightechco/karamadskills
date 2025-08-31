<?php

use Illuminate\Support\Facades\Route;
use Modules\Common\Http\Controllers\CommonController;

Route::prefix('common')->as('common.')->group(function() {
    Route::get('/get-shahrestan', [CommonController::class, 'getShahrestan'])->name('getShahrestan');
    Route::get('/get-bakhsh', [CommonController::class, 'getBakhsh'])->name('getBakhsh');
    Route::get('/get-shahr', [CommonController::class, 'getShahr'])->name('getShahr');
    Route::get('/get-dehestan', [CommonController::class, 'getDehestan'])->name('getDehestan');
    Route::get('/get-abadi', [CommonController::class, 'getAbadi'])->name('getAbadi');
});
