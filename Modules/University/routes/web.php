<?php

use Illuminate\Support\Facades\Route;
use Modules\University\Http\Controllers\UniversityController;
use Modules\University\Http\Controllers\UniversityFrontController;

Route::middleware(['auth','isNotBlock'])->prefix('panel')->as('panel.university.')->group(function(){
    Route::get('/universities',[UniversityController::class,'universities'])->name('universities');
    Route::post('/getUniversities',[UniversityController::class,'getUniversities'])->name('getUniversities');
    Route::get('/universityUsers/{university}',[UniversityController::class,'universityUsers'])->name('universityUsers');
    Route::post('/getUniversityUser/{university}',[UniversityController::class,'getUniversityUser'])->name('getUniversityUser');
    Route::get('/universityCreate',[UniversityController::class,'universityCreate'])->name('universityCreate');
    Route::get('/universityCreateMulti',[UniversityController::class,'universityCreateMulti'])->name('universityCreateMulti');
    Route::post('/universityStore',[UniversityController::class,'universityStore'])->name('universityStore');
    Route::post('/universityStoreMulti',[UniversityController::class,'universityStoreMulti'])->name('universityStoreMulti');
    Route::get('/universityRemoveGallery/{university}',[UniversityController::class,'removeGallery'])->name('removeGallery');
    Route::get('/universityEdit/{university}',[UniversityController::class,'universityEdit'])->name('universityEdit');
    Route::get('/universityEditContent/{university}',[UniversityController::class,'universityEditContent'])->name('universityEditContent');
    Route::post('/universityUpdate/{university}',[UniversityController::class,'universityUpdate'])->name('universityUpdate');
    Route::post('/universityUpdateContent/{university}',[UniversityController::class,'universityUpdateContent'])->name('universityUpdateContent');
});

Route::prefix('uni')->as('university.')->group(function(){
    Route::get('/universities',[UniversityFrontController::class,'universities'])->name('universities');
    Route::post('/moreUniversities',[UniversityFrontController::class,'moreUniversities'])->name('moreUniversities');
    Route::get('/getOstany',[UniversityController::class,'getOstany'])->name('getOstany');
    Route::get('/getVaheds',[UniversityController::class,'getVaheds'])->name('getVaheds');
    Route::get('/{slug}',[UniversityFrontController::class,'uni'])->name('uni');
});


