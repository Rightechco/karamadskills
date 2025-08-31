<?php

use Illuminate\Support\Facades\Route;
use Modules\Test\Http\Controllers\TestController;

Route::middleware([])->prefix('test')->as('test.')->group(function(){
    Route::get('/tests', [TestController::class, 'tests'])->name('tests');

    Route::get('/raven', [TestController::class, 'raven'])->name('raven');
    Route::post('/ravenStore', [TestController::class, 'ravenStore'])->name('ravenStore');
    Route::get('/ravenResult/{id}', [TestController::class, 'ravenResult'])->name('ravenResult');
    Route::get('/ravenResultShow/{test}', [TestController::class, 'ravenResultShow'])->name('ravenResultShow');

    Route::get('/holland', [TestController::class, 'holland'])->name('holland');
    Route::post('/hollandStore', [TestController::class, 'hollandStore'])->name('hollandStore');
    Route::get('/hollandResult/{id}', [TestController::class, 'hollandResult'])->name('hollandResult');
    Route::get('/hollandResultShow/{test}', [TestController::class, 'hollandResultShow'])->name('hollandResultShow');

    Route::get('/mbti', [TestController::class, 'mbti'])->name('mbti');
    Route::post('/mbtiStore', [TestController::class, 'mbtiStore'])->name('mbtiStore');
    Route::get('/mbtiResult/{id}', [TestController::class, 'mbtiResult'])->name('mbtiResult');
    Route::get('/mbtiResultShow/{test}', [TestController::class, 'mbtiResultShow'])->name('mbtiResultShow');

    Route::get('/eq', [TestController::class, 'eq'])->name('eq');
    Route::post('/eqStore', [TestController::class, 'eqStore'])->name('eqStore');
    Route::get('/eqResult/{id}', [TestController::class, 'eqResult'])->name('eqResult');
    Route::get('/eqResultShow/{test}', [TestController::class, 'eqResultShow'])->name('eqResultShow');
});
