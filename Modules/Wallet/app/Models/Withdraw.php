<?php

namespace Modules\Wallet\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

// use Modules\Wallet\Database\Factories\WhitdrawFactory;

class Withdraw extends Model
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

    public function classStatus(): string
    {
        switch ($this->status) {
            case self::PENDING:
                return 'warning';
            case self::COMPLETED:
                return 'success';
            case self::FAILED:
                return 'danger';
        }
    }

    public function nameStatus(): string
    {
        switch ($this->status) {
            case self::PENDING:
                return 'در حال بررسی';
            case self::COMPLETED:
                return 'تایید شده';
            case self::FAILED:
                return 'تایید نشده';
        }
    }

    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }

    public function card()
    {
        return $this->belongsTo(BankCard::class,'bank_card_id');
    }
}
