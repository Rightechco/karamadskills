<?php

use Illuminate\Support\Facades\Route;
use Modules\Wallet\Http\Controllers\WalletController;
use Modules\Wallet\Http\Controllers\WithdrawController;
use Modules\Wallet\Http\Controllers\BankCardController;
use Modules\Wallet\Http\Controllers\DepositController;

Route::middleware(['auth','isNotBlock'])->prefix('panel')->as('panel.wallet.')->group(function () {
    Route::get('/wallet', [WalletController::class, 'show'])->name('wallet');
    Route::get('/wallet/withdraw', [WalletController::class, 'withdraw'])->name('withdraw');
    Route::post('/wallet/withdraw/store', [WalletController::class, 'withdrawStore'])->name('withdrawStore');
    Route::post('/get-trans', [WalletController::class, 'getTrans'])->name('getTrans');
    Route::get('/factor/{id}', [WalletController::class, 'factor'])->name('factor');
    Route::post('/user-withdraw', [WalletController::class, 'userWithdraw'])->name('userWithdraw');
    Route::post('/user-trans/{user}', [WalletController::class, 'userTrans'])->name('userTrans');
    Route::post('/update-auto-withdraw/{wallet}', [WalletController::class, 'updateAutoWithdraw'])->name('update.autoWithdraw');
});

Route::middleware(['auth','isNotBlock'])->prefix('panel')->as('panel.withdraw.')->group(function () {
    Route::get('/withdraws', [WithdrawController::class, 'withdraw'])->name('withdraws');
    Route::post('/get-withdraws', [WithdrawController::class, 'getWithdraws'])->name('getWithdraws');
    Route::get('/withdraws-edit/{withdraw}', [WithdrawController::class, 'withdrawEdit'])->name('withdrawEdit');
    Route::post('/status-update/{withdraw}', [WithdrawController::class, 'statusUpdate'])->name('statusUpdate');
});

Route::middleware(['auth','isNotBlock'])->prefix('panel')->as('panel.deposit.')->group(function () {
    Route::get('/deposit', [DepositController::class, 'deposit'])->name('deposit');
    Route::post('/get-deposits', [DepositController::class, 'getDeposits'])->name('getDeposits');
    Route::post('/depositStore', [DepositController::class, 'depositStore'])->name('depositStore');
    Route::get('/depositPay', [DepositController::class, 'depositPay'])->name('depositPay');
});

Route::middleware(['auth','isNotBlock'])->prefix('panel')->as('panel.card.')->group(function () {
    Route::post('/post-card/{user}', [BankCardController::class, 'postCard'])->name('postCard');
    Route::post('/get-cards', [BankCardController::class, 'getCards'])->name('getCards');
    Route::get('/cards', [BankCardController::class, 'cards'])->name('cards');
    Route::get('/all-cards', [BankCardController::class, 'userCards'])->name('userCards');
    Route::post('/get-user-cards', [BankCardController::class, 'getUserCards'])->name('getUserCards');
    Route::get('/update/card/{id}/status/approve', [BankCardController::class, 'approveStatus'])->name('approveStatus');
    Route::get('/update/card/{id}/status/Not-approve', [BankCardController::class, 'NotApproveStatus'])->name('NotApproveStatus');
    Route::get('/update/card/{id}/default', [BankCardController::class, 'default'])->name('default');
});

Route::get('/autoWithdraw', [WalletController::class, 'autoWithdraw'])->name('autoWithdraw');
