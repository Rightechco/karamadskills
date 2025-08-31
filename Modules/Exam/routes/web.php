<?php

use Illuminate\Support\Facades\Route;
use Modules\Exam\Http\Controllers\ExamController;

Route::middleware(['auth','isNotBlock'])->prefix('panel')->as('panel.exam.')->group(function(){
    Route::get('/createExam/{course}', [ExamController::class, 'createExam'])->name('createExam');
    Route::post('/storeExam/{course}', [ExamController::class, 'storeExam'])->name('storeExam');

    Route::get('/takeExam/{exam}', [ExamController::class, 'takeExam'])->name('takeExam');
    Route::post('/takeExamStore/{exam}', [ExamController::class, 'takeExamStore'])->name('takeExamStore');
    Route::get('/deleteExam/{exam}', [ExamController::class, 'deleteExam'])->name('deleteExam');
});
