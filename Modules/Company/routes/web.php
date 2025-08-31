<?php

use Illuminate\Support\Facades\Route;
use Modules\Company\Http\Controllers\CompanyController;
use Modules\Company\Http\Controllers\CompanyFrontController;

Route::middleware(['auth','isNotBlock'])->prefix('panel')->as('panel.company.')->group(function(){
    Route::get('/companies',[CompanyController::class,'companies'])->name('companies');
    Route::post('/get-companies',[CompanyController::class,'getCompanies'])->name('getCompanies');

    Route::get('/companies-create',[CompanyController::class,'companiesCreate'])->name('companiesCreate');
    Route::post('/companies-store',[CompanyController::class,'companiesStore'])->name('companiesStore');
    Route::get('/companies-edit/{company}',[CompanyController::class,'companiesEdit'])->name('companiesEdit');
    Route::post('/companies-update/{company}',[CompanyController::class,'companiesUpdate'])->name('companiesUpdate');
    Route::get('/companies-delete/{company}',[CompanyController::class,'companiesDelete'])->name('companiesDelete');
});

Route::prefix('company')->as('company.')->group(function () {
    Route::get('/companies',[CompanyFrontController::class,'companies'])->name('companies');
    Route::post('/moreCompanies',[CompanyFrontController::class,'moreCompanies'])->name('moreCompanies');
    Route::get('/company/{id}',[CompanyFrontController::class,'company'])->name('company');
    Route::get('/companyJobs/{id}',[CompanyFrontController::class,'companyJobs'])->name('companyJobs');
});
