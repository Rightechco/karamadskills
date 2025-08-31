<?php

use Illuminate\Support\Facades\Route;
use Modules\Counselor\Http\Controllers\CounselorController;

Route::middleware(['auth','isNotBlock'])->prefix('panel/counselor')->as('panel.counselor.')->group(function(){
    Route::post('/reserve', [CounselorController::class, 'reserve'])->name('reserve');
    Route::get('/reserveBack/{counselor}', [CounselorController::class, 'reserveBack'])->name('reserveBack');
    Route::get('/counselors', [CounselorController::class, 'counselorsPanel'])->name('counselorsPanel');
    Route::post('/getCounselors', [CounselorController::class, 'getCounselors'])->name('getCounselors');
    Route::post('/createMeet',[CounselorController::class,'createMeet'])->name('createMeet');
});

Route::prefix('counselor')->as('counselor.')->group(function () {
    Route::get('/counselors', [CounselorController::class, 'counselors'])->name('counselors');
});
