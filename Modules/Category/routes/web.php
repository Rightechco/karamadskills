<?php

use Illuminate\Support\Facades\Route;
use Modules\Category\Http\Controllers\CategoryController;

Route::middleware(['auth','isNotBlock'])->prefix('panel')->as('panel.category.')->group(function(){
    Route::get('/categories',[CategoryController::class,'categories'])->name('categories');
    Route::post('/get-categories',[CategoryController::class,'getCategories'])->name('getCategories');
    Route::get('/get-categoriesList',[CategoryController::class,'getCategoriesList'])->name('getCategoriesList');
    Route::get('/getCategories',[CategoryController::class,'getCategoriesAjax'])->name('getCategoriesAjax');

    Route::post('/categories-store',[CategoryController::class,'categoriesStore'])->name('categoriesStore');
    Route::post('/categories-update',[CategoryController::class,'categoriesUpdate'])->name('categoriesUpdate');
    Route::get('/categories-delete/{category}',[CategoryController::class,'categoriesDelete'])->name('categoriesDelete');
});
