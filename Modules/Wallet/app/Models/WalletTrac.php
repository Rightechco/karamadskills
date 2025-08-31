<?php

namespace Modules\Wallet\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

// use Modules\Wallet\Database\Factories\WalletTracFactory;

class WalletTrac extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded = [];

    public const DEPOSIT = 'deposit';
    public const WITHDRAW = 'withdraw';

    public static array $types = [self::DEPOSIT,self::WITHDRAW];

    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }
}
