<?php

namespace Modules\Wallet\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\User\Models\User;

// use Modules\Wallet\Database\Factories\BankCardFactory;

class BankCard extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded = [];

    public const NEW = 'new';
    public const APPROVED = 'approved';
    public const NOT_APPROVED = 'not_approved';

    public static array $status = [
        self::NEW,
        self::APPROVED,
        self::NOT_APPROVED
    ];

    public function classStatus(): string
    {
        switch ($this->status) {
            case self::NEW:
                return 'primary';
            case self::APPROVED:
                return 'success';
            case self::NOT_APPROVED:
                return 'danger';
        }
    }

    public function nameStatus(): string
    {
        switch ($this->status) {
            case self::NEW:
                return 'جدید';
            case self::APPROVED:
                return 'تایید شده';
            case self::NOT_APPROVED:
                return 'تایید نشده';
        }
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function withdraw()
    {
        return $this->hasMany(Withdraw::class);
    }
}
