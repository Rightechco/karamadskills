<?php

namespace Modules\Wallet\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Common\Http\Services\CommonServices;
use Modules\Common\Models\Pay;
use Modules\Wallet\Http\Repositories\DepositRepo;
use Modules\Wallet\Http\Requests\DepositRequest;
use Modules\Wallet\Http\Services\DepositService;
use Modules\Wallet\Http\Services\WalletService;
use Modules\Wallet\Models\BankCard;
use Modules\Wallet\Models\Deposit;

class DepositController extends Controller
{
    public function deposit()
    {
        $user = auth()->user();
        return view('wallet::deposit', compact('user'));
    }

    public function getDeposits(Request $request)
    {
        return DepositRepo::getDeposits($request);
    }

    public function depositStore(DepositRequest $request)
    {
        $user = auth()->user();
        if ($request->amount > 2000 || $request->amount < 100000000) {
            return CommonServices::pay($request->amount, route('panel.deposit.depositPay'));
        } else {
            $toasts = ['toast' => [
                [
                    'message' => 'مبلغ برداشت حد مجاز نمی باشد',
                    'alert-type' => 'error'
                ]
            ]];

            return back()->with($toasts);
        }
    }

    public function depositPay(Request $request)
    {
        if ($request->Status == 'OK') {
            $pay = Pay::query()->where('transactionId',$request->Authority)->first();
            if ($pay) {
                $verify = CommonServices::verify($pay->amount, $request->Authority);
                if ($verify) {
                    $deposit = DepositService::create(['wallet_id' => auth()->user()->wallet->id,'pay_id' => $verify]);
                    WalletService::deposit(auth()->user()->id,$pay->amount,'واریز شماره '.$deposit->id.' به کیف پول');
                    $toasts = ['toast' => [
                        [
                            'message' => 'مبلغ پرداختی به کیف پول شما اضافه شد',
                            'alert-type' => 'success'
                        ]
                    ]];
                    return to_route('panel.wallet.wallet')->with($toasts);
                }
            }
        }
        $toasts = ['toast' => [
            [
                'message' => 'پرداخت شما ناموفق بود! ; پرداخت شما طی 48 ساعت به حساب شما عودت داده می شود',
                'alert-type' => 'error'
            ]
        ]];
        return to_route('panel.deposit.deposit')->with($toasts);

    }
}
