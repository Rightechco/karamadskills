<?php

use Illuminate\Support\Facades\Route;
use Modules\Role\Http\Controllers\RoleController;

Route::middleware(['auth','isNotBlock'])->prefix('panel')->as('panel.role.')->group(function(){
    Route::get('/roles',[RoleController::class,'roles'])->name('roles');
    Route::post('/get-roles',[RoleController::class,'getRoles'])->name('getRoles');

    Route::get('/roles-create',[RoleController::class,'rolesCreate'])->name('rolesCreate');
    Route::post('/roles-store',[RoleController::class,'rolesStore'])->name('rolesStore');
    Route::get('/roles-edit/{role}',[RoleController::class,'rolesEdit'])->name('rolesEdit');
    Route::post('/roles-update/{role}',[RoleController::class,'rolesUpdate'])->name('rolesUpdate');
    Route::get('/roles-delete/{role}',[RoleController::class,'rolesDelete'])->name('rolesDelete');
});
