<?php

use Illuminate\Support\Facades\Route;
use Modules\Announcement\Http\Controllers\AnnouncementController;
use Modules\Announcement\Http\Controllers\AnnouncementFrontController;

Route::middleware(['auth','isNotBlock'])->prefix('panel')->as('panel.announcement.')->group(function(){
    Route::get('/announcements',[AnnouncementController::class,'announcements'])->name('announcements');
    Route::post('/get-announcements',[AnnouncementController::class,'getAnnouncements'])->name('getAnnouncements');

    Route::get('/announcements-create',[AnnouncementController::class,'announcementsCreate'])->name('announcementsCreate');
    Route::post('/announcements-store',[AnnouncementController::class,'announcementsStore'])->name('announcementsStore');
    Route::get('/announcements-edit/{announcement}',[AnnouncementController::class,'announcementsEdit'])->name('announcementsEdit');
    Route::post('/announcements-update/{announcement}',[AnnouncementController::class,'announcementsUpdate'])->name('announcementsUpdate');
    Route::get('/announcements-stop/{announcement}',[AnnouncementController::class,'announcementsStop'])->name('announcementsStop');
});

Route::prefix('announcement')->as('announcement.')->group(function () {
    Route::get('/announcements', [AnnouncementFrontController::class, 'announcements'])->name('announcements');
    Route::post('/announcementsMore', [AnnouncementFrontController::class, 'announcementsMore'])->name('announcementsMore');
    Route::get('/announcement/{id}', [AnnouncementFrontController::class, 'announcement'])->name('announcement');

    Route::get('/interships', [AnnouncementFrontController::class, 'interships'])->name('interships');
    Route::post('/intershipsMore', [AnnouncementFrontController::class, 'intershipsMore'])->name('intershipsMore');
    Route::get('/intership/{id}', [AnnouncementFrontController::class, 'intership'])->name('intership');
});

