<?php

namespace Modules\Wallet\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Wallet\Http\Repositories\UserWithdrawRepo;
use Modules\Wallet\Http\Repositories\WalletRepo;
use Modules\Wallet\Http\Repositories\WithdrawRepo;
use Modules\Wallet\Http\Requests\CheckboxRequest;
use Modules\Wallet\Http\Requests\WithdrawRequest;
use Modules\Wallet\Models\BankCard;
use Modules\Wallet\Http\Services\WalletService;
use Modules\Wallet\Models\Wallet;
use Modules\Wallet\Models\WalletTrac;

class WalletController extends Controller
{
    public function show()
    {
        $user = auth()->user();
        $balance = WalletService::getWalletBalance($user);
        $wallet = $user->wallet;
        $card = BankCard::query()->where('user_id', $user->id)->where('status', BankCard::APPROVED)->where('default', 1)->first();

        if ($card) {
            $card_number = $card->card_number;
        } else {
            $card_number = '**** **** **** ****';
        }

        return view('wallet::wallet', compact('user', 'balance', 'card_number', 'wallet','card'));
    }

    public function updateAutoWithdraw(CheckboxRequest $request, Wallet $wallet)
    {
        $wallet->autoWithdraw = $request->input('autoWithdraw');
        $wallet->save();

        return $wallet->autoWithdraw;
    }

    public function getTrans(Request $request)
    {
        return WalletRepo::getTransactions($request);
    }

    public function withdraw()
    {
        $user = auth()->user();
        $cards = BankCard::query()->where('user_id', $user->id)->where('status', BankCard::APPROVED)->get();
        return view('wallet::withdraw', compact('user', 'cards'));
    }

    public function factor($id)
    {
        $trac = WalletTrac::query()->where('id',$id)->first();
        if($trac && (auth()->user()->id == $trac->wallet->user->id || auth()->user()->can(['WithdrawPermission']))) {
            return view('wallet::factor',compact('trac'));
        } else {
            $toasts = ['toast' => [
                [
                    'message' => 'فاکتور یافت نشد',
                    'alert-type' => 'error'
                ]
            ]];
            return back()->with($toasts);
        }
    }

    public function userWithdraw(Request $request)
    {
        return WithdrawRepo::getTransactions($request);
    }

    public function withdrawStore(WithdrawRequest $request)
    {
        $user = auth()->user();
        $des = 'برداشت مبلغ' . ' ' . $request->amount . ' ' . 'تومان از کیف پول شما با موفقیت انجام شد';
        if ($user->wallet->balance >= $request->amount && $request->amount > 2000 || $request->amount < 100000000) {
            WalletService::withdrawRequest($request, $user);
            WalletService::withdraw($user->id, $request->amount, $des);
            $toasts = ['toast' => [
                [
                    'message' => 'درخواست برداشت شما با موفقیت ثبت شد',
                    'alert-type' => 'success'
                ]
            ]];

            return to_route('panel.wallet.withdraw')->with($toasts);
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
}
