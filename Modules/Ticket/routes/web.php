<?php

use Illuminate\Support\Facades\Route;
use Modules\Ticket\Http\Controllers\TicketController;

Route::middleware(['auth','isNotBlock'])->prefix('panel')->as('panel.ticket.')->group(function(){
    Route::get('/tickets',[TicketController::class,'tickets'])->name('tickets');
    Route::post('/getTickets',[TicketController::class,'getTickets'])->name('getTickets');

    Route::get('/ticket/{ticket}',[TicketController::class,'ticket'])->name('ticket');
    Route::post('/sendReply',[TicketController::class,'sendReply'])->name('sendReply');

    Route::get('/send/{slug}',[TicketController::class,'send'])->name('send');
    Route::post('/sendMessage',[TicketController::class,'sendMessage'])->name('sendMessage');
});

