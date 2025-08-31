<?php

namespace Modules\Wallet\Http\Services;

use Modules\User\Models\User;
use Modules\Wallet\Models\Wallet;
use Modules\Wallet\Models\WalletTrac;
use Modules\Wallet\Models\Withdraw;

class WalletService
{
    public static function getWalletBalance(User $user)
    {
        if ($user->wallet) {
            return $user->wallet->balance;
        } else {
            $wallet = self::createWallet($user->id);
            return $wallet->balance;
        }
    }

    public static function createWallet($id)
    {
        return Wallet::query()->create([
            'user_id' => $id
        ]);
    }

    public static function deposit($user_id, $amount, $des)
    {
        $user = User::query()->where('id', $user_id)->first();
        self::getWalletBalance($user);
        $wallet = Wallet::query()->where('user_id', $user_id)->first();

        try {
            $walletTrac = WalletTrac::query()->create([
                'wallet_id' => $wallet->id,
                'type' => WalletTrac::DEPOSIT,
                'amount' => $amount,
                'des' => $des
            ]);
            $wallet->balance = $wallet->balance + $amount;
            $wallet->save();
            return $walletTrac->id;
        } catch (\Exception $e) {
            return false;
        }
    }

    public static function withdraw($user_id, $amount, $des)
    {
        $wallet = Wallet::query()->where('user_id', $user_id)->first();

        try {
            $walletTrac = WalletTrac::query()->create([
                'wallet_id' => $wallet->id,
                'type' => WalletTrac::WITHDRAW,
                'amount' => $amount,
                'des' => $des
            ]);
            $wallet->balance = $wallet->balance - $amount;
            $wallet->save();
            return $walletTrac->id;
        } catch (\Exception $e) {
            return false;
        }
    }

    public static function withdrawRequest($request, User $user)
    {
        return Withdraw::create([
            'wallet_id' => $user->wallet->id,
            'bank_card_id' => $request->card,
            'amount' => $request->amount,
            'status' => Withdraw::PENDING,
        ]);
    }
}
