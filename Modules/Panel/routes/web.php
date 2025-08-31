<?php

use Illuminate\Support\Facades\Route;
use Modules\Panel\Http\Controllers\PanelController;

Route::prefix('panel')->middleware(['auth','isNotBlock'])->group(function (){
    Route::get('/',[PanelController::class,'index'])->name('panel');
});
