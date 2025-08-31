<?php

namespace Modules\Wallet\Http\Services;

use Modules\Wallet\Models\Deposit;

class DepositService
{
    public static function create($request)
    {
        return Deposit::query()->create([
           'wallet_id' => $request['wallet_id'],
           'pay_id' => $request['pay_id']
        ]);
    }
}
