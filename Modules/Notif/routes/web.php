<?php

use Illuminate\Support\Facades\Route;
use Modules\Notif\Http\Controllers\NotifController;

Route::prefix('notif')->as('notif.')->group(function () {
   Route::get('/second/{id}',[NotifController::class,'second'])->name('second')->middleware(['throttle:3,1']);
   Route::get('/minute/{id}',[NotifController::class,'minute'])->name('minute')->middleware(['throttle:3,1']);
   Route::get('/hour/{id}',[NotifController::class,'hour'])->name('hour')->middleware(['throttle:3,1']);
   Route::get('/hour-4/{id}',[NotifController::class,'hour4'])->name('hour4')->middleware(['throttle:3,1']);
   Route::get('/hour-12/{id}',[NotifController::class,'hour12'])->name('hour12')->middleware(['throttle:3,1']);
   Route::get('/daily/{id}',[NotifController::class,'daily'])->name('daily')->middleware(['throttle:3,1']);
});
