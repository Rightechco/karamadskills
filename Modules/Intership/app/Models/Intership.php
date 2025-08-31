<?php

namespace Modules\Intership\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Announcement\Models\Announcement;
use Modules\University\Models\University;
use Modules\User\Models\User;

class Intership extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded = [];

    protected $casts = ['introduction' => 'array','report' => 'array'];

    public const STATUS_WAIT = 'wait';
    public const STATUS_REJECTED = 'rejected';
    public const STATUS_UNIVERSITY_ACCEPT = 'universityAccept';
    public const STATUS_COMPANY_ACCEPT = 'companyAccept';
    public const STATUS_FINISH = 'finish';
    public static array $statuses = [
        self::STATUS_WAIT,
        self::STATUS_REJECTED,
        self::STATUS_UNIVERSITY_ACCEPT,
        self::STATUS_COMPANY_ACCEPT,
        self::STATUS_FINISH
    ];

    public function classStatus(): string
    {
        switch ($this->status) {
            case self::STATUS_WAIT:
                return 'warning';
            case self::STATUS_REJECTED:
                return 'danger';
            case self::STATUS_UNIVERSITY_ACCEPT:
                return 'info';
            case self::STATUS_COMPANY_ACCEPT:
                return 'primary';
            case self::STATUS_FINISH:
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
            case self::STATUS_UNIVERSITY_ACCEPT:
                return 'تایید دانشگاه';
            case self::STATUS_COMPANY_ACCEPT:
                return 'تایید شرکت';
            case self::STATUS_FINISH:
                return 'پایان یافته';
        }
    }

    public function announcement(){
        return $this->belongsTo(Announcement::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function university()
    {
        return $this->belongsTo(University::class);
    }
}
