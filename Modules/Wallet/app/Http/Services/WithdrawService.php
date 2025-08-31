<?php

namespace Modules\Wallet\Http\Services;

class WithdrawService
{
    public static function statusUpdate($withdraw, $request)
    {
        $withdraw->status = $request['status'];
        $withdraw->transaction_id = $request['transaction'] ?? $withdraw->transaction;
        $withdraw->save();
    }
}
