<?php

namespace Modules\Wallet\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\User\Models\User;
use Modules\Wallet\Http\Repositories\BankCardRepo;
use Modules\Wallet\Http\Requests\BankCardRequest;
use Modules\Wallet\Http\Services\BankCardService;
use Modules\Wallet\Models\BankCard;

class BankCardController extends Controller
{
    public function userCards()
    {
        $cards = BankCard::query()->where('user_id', auth()->user()->id)->get();
        return view('wallet::userCards',compact('cards'));
    }

    public function cards()
    {
        if (auth()->user()->can(['CardPermission'])) {
            return view('wallet::cards');
        } else {
            $toasts = ['toast' => [
                [
                    'message' => 'عدم دسترسی',
                    'alert-type' => 'error'
                ]
            ]];
            return to_route('panel.wallet.wallet')->with($toasts);
        }
    }

    public function getCards(Request $request){
        if (auth()->user()->can(['CardPermission'])) {
            return BankCardRepo::getCards($request);
        }
    }

    public function approveStatus($id)
    {
        if (auth()->user()->can(['CardPermission'])) {
            BankCardRepo::changeStatus($id, BankCard::APPROVED);
            $toasts = ['toast' => [
                [
                    'message' => 'عملیات تایید شماره کارت با موفقیت انجام شد',
                    'alert-type' => 'success'
                ]
            ]];
            return back()->with($toasts);
        }
    }

    public function NotApproveStatus($id)
    {
        if (auth()->user()->can(['CardPermission'])) {
            BankCardRepo::changeStatus($id, BankCard::NOT_APPROVED);
            $toasts = ['toast' => [
                [
                    'message' => 'عملیات عدم تایید شماره کارت با موفقیت انجام شد',
                    'alert-type' => 'success'
                ]
            ]];

            return back()->with($toasts);
        }
    }

    public function postCard(BankCardRequest $request, User $user)
    {
        $cards = BankCard::query()->where('user_id', auth()->user()->id)->get();
        if ($cards->count() > 9) {
            $toasts = ['toast' => [
                [
                    'message' => 'تعداد کارت های ثبت شده شما بیش از حد مجاز می باشد',
                    'alert-type' => 'error'
                ]
            ]];
            return to_route('panel.wallet.wallet')->with($toasts);
        } else {
            BankCardService::createCard($request, $user);
            $toasts = ['toast' => [
                [
                    'message' => 'کارت شما با موفقیت ثبت شد. پس از تایید در پنل نمایش داده خواهد شد',
                    'alert-type' => 'success'
                ]
            ]];
            return to_route('panel.wallet.wallet')->with($toasts);
        }
    }
}
