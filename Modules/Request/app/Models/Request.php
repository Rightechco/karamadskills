<?php

namespace Modules\Request\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Announcement\Models\Announcement;
use Modules\BBB\Models\BBB;
use Modules\User\Models\User;

class Request extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded = [];

    public const STATUS_WAIT = 'wait';
    public const STATUS_REJECTED = 'rejected';
    public const STATUS_INTERVIEW = 'interview';
    public const STATUS_HIRED = 'hired';
    public static array $statuses = [
        self::STATUS_WAIT,
        self::STATUS_REJECTED,
        self::STATUS_INTERVIEW,
        self::STATUS_HIRED
    ];

    public function classStatus(): string
    {
        switch ($this->status) {
            case self::STATUS_WAIT:
                return 'info';
            case self::STATUS_REJECTED:
                return 'danger';
            case self::STATUS_INTERVIEW:
                return 'warning';
            case self::STATUS_HIRED:
                return 'success';
        }
    }

    public function nameStatus(): string
    {
        switch ($this->status) {
            case self::STATUS_WAIT:
                return 'در انتظار';
            case self::STATUS_REJECTED:
                return 'رد شده';
            case self::STATUS_INTERVIEW:
                return 'قبول برای مصاحبه';
            case self::STATUS_HIRED:
                return 'استخدام شده';
        }
    }

    public function announcement(){
        return $this->belongsTo(Announcement::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bbbs()
    {
        return $this->morphMany(BBB::class,'bbbable');
    }

}
