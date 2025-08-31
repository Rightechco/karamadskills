<?php

namespace Modules\Wallet\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Wallet\Http\Repositories\WithdrawRepo;
use Modules\Wallet\Http\Requests\TransRequest;
use Modules\Wallet\Http\Requests\WithdrawStatusRequest;
use Modules\Wallet\Http\Services\WalletService;
use Modules\Wallet\Models\Withdraw;
use Modules\Wallet\Http\Services\WithdrawService;

class WithdrawController extends Controller
{
    public function withdraw()
    {
        if (auth()->user()->can(['WithdrawPermission'])) {
            return view('wallet::withdraws');
        } else {
            $toasts = ['toast' => [
                [
                    'message' => 'شما به این صفحه دسترسی ندارید',
                    'alert-type' => 'error'
                ]
            ]];
            return back()->with($toasts);
        }
    }

    public function getWithdraws(Request $request)
    {
        if (auth()->user()->can(['WithdrawPermission'])) {
            return WithdrawRepo::getWithraw($request);
        } else {
            $toasts = ['toast' => [
                [
                    'message' => 'شما به این صفحه دسترسی ندارید',
                    'alert-type' => 'error'
                ]
            ]];
            return back()->with($toasts);
        }
    }

    public function withdrawEdit(Withdraw $withdraw)
    {
        if (auth()->user()->can(['WithdrawPermission'])) {
            return view('wallet::withdrawEdit', compact('withdraw'));
        } else {
            $toasts = ['toast' => [
                [
                    'message' => 'شما به این صفحه دسترسی ندارید',
                    'alert-type' => 'error'
                ]
            ]];
            return back()->with($toasts);
        }
    }

    public function statusUpdate(WithdrawStatusRequest $request, Withdraw $withdraw)
    {
        if (auth()->user()->can(['WithdrawPermission'])) {
            if ($request['status'] == Withdraw::COMPLETED && $withdraw->status == Withdraw::FAILED) {
                $toasts = ['toast' => [
                    [
                        'message' => 'نمی توانید برداشت تایید شده را به حالت تایید برگردانید',
                        'alert-type' => 'error'
                    ]
                ]];
                return to_route('panel.withdraw.withdraws')->with($toasts);
            }

            WithdrawService::statusUpdate($withdraw, $request);

            if ($request['status'] == Withdraw::FAILED) {
                WalletService::deposit($withdraw->wallet->user->id, $withdraw->amount, 'رد برداشت '.$withdraw->id);
            }

            $toasts = ['toast' => [
                [
                    'message' => 'تغییر وضعیت برداشت با موفقیت بروزرسانی شد',
                    'alert-type' => 'success'
                ]
            ]];
            return to_route('panel.withdraw.withdraws')->with($toasts);
        } else {
            $toasts = ['toast' => [
                [
                    'message' => 'شما به این صفحه دسترسی ندارید',
                    'alert-type' => 'error'
                ]
            ]];
            return back()->with($toasts);
        }
    }
}
