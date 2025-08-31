<?php

namespace Modules\Incentive\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\File\Models\File;
use Modules\University\Models\University;
use Modules\User\Models\User;

// use Modules\Incentive\Database\Factories\IncentiveFactory;

class Incentive extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = ['incentive' => 'array'];

    public const STATUS_WAIT = 'wait';
    public const STATUS_VAHED = 'vahed';
    public const STATUS_OSTAN = 'ostan';
    public const STATUS_TYPE = 'type';
    public const STATUS_FINISH = 'finish';
    public const STATUS_MEETING = 'meeting';
    public const STATUS_REJECT = 'reject';
    public static array $statuses = [
        self::STATUS_WAIT,
        self::STATUS_VAHED,
        self::STATUS_OSTAN,
        self::STATUS_TYPE,
        self::STATUS_MEETING,
        self::STATUS_FINISH,
        self::STATUS_REJECT
    ];

    public function classStatus(): string
    {
        switch ($this->status) {
            case self::STATUS_WAIT:
                return 'secondary';
            case self::STATUS_VAHED:
                return 'info';
            case self::STATUS_OSTAN:
                return 'pink';
            case self::STATUS_TYPE:
                return 'purple';
            case self::STATUS_FINISH:
                return 'success';
            case self::STATUS_MEETING:
                return 'warning';
            case self::STATUS_REJECT:
                return 'danger';
        }
    }

    public function nameStatus(): string
    {
        switch ($this->status) {
            case self::STATUS_WAIT:
                return 'در انتظار';
            case self::STATUS_VAHED:
                return 'تایید دانشگاه';
            case self::STATUS_OSTAN:
                return 'تایید مرکز استان';
            case self::STATUS_TYPE:
                return 'تایید کشوری';
            case self::STATUS_FINISH:
                return 'تایید وزارت';
            case self::STATUS_MEETING:
                return 'جلسه';
            case self::STATUS_REJECT:
                return 'رد شده';
        }
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function university()
    {
        return $this->belongsTo(University::class);
    }

    public function ostan()
    {
        return $this->belongsTo(University::class,'ostan_id');
    }

    public function type()
    {
        return $this->belongsTo(University::class,'type_id');
    }

    public function files()
    {
        return $this->morphMany(File::class,'fileable');
    }
}
