<?php

namespace Modules\Wallet\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Common\Models\Pay;

// use Modules\Wallet\Database\Factories\DepositFactory;

class Deposit extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded = [];

    public const PENDING = 'pending';
    public const COMPLETED = 'completed';
    public const FAILED = 'failed';

    public static array $status = [
        self::PENDING,
        self::COMPLETED,
        self::FAILED
    ];

    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }

    public function pay()
    {
        return $this->belongsTo(Pay::class);
    }
}
