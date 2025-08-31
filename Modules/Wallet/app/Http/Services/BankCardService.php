<?php

namespace Modules\Wallet\Http\Services;

use Modules\Wallet\Models\BankCard;

class BankCardService
{
    public static function createCard($request, $user)
    {
        return BankCard::query()->create([
            'user_id' => $user->id,
            'card_number' => $request->card_number,
            'shaba_number' => $request->shaba_number,
            'card_holder_name' => $user->name
        ]);
    }
}
