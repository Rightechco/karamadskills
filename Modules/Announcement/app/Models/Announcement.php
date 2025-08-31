<?php

namespace Modules\Announcement\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Category\Models\Category;
use Modules\Common\Models\Ostan;
use Modules\Common\Models\Shahrestan;
use Modules\Company\Models\Company;

class Announcement extends Model
{
    use HasFactory,SoftDeletes,Sluggable;

    protected $guarded = [];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public const STATUS_WAIT = 'wait';
    public const STATUS_UNVERIFIED = 'unverified';
    public const STATUS_VERIFIED = 'verified';
    public const STATUS_STOP = 'stop';
    public static array $statuses = [
        self::STATUS_WAIT,
        self::STATUS_VERIFIED,
        self::STATUS_UNVERIFIED,
        self::STATUS_STOP
    ];

    public function classStatus(): string
    {
        switch ($this->status) {
            case self::STATUS_WAIT:
                return 'info';
            case self::STATUS_VERIFIED:
                return 'success';
            case self::STATUS_UNVERIFIED:
                return 'warning';
            case self::STATUS_STOP:
                return 'danger';
        }
    }

    public function nameStatus(): string
    {
        switch ($this->status) {
            case self::STATUS_WAIT:
                return 'در انتظار';
            case self::STATUS_VERIFIED:
                return 'تایید شده';
            case self::STATUS_UNVERIFIED:
                return 'تایید نشده';
            case self::STATUS_STOP:
                return 'متوقف شده';
        }
    }

    public const MALE = 'male';
    public const FEMALE = 'female';
    public static array $genders = [
        self::MALE,
        self::FEMALE
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function ostan()
    {
        return $this->belongsTo(Ostan::class);
    }

    public function shahrestan()
    {
        return $this->belongsTo(Shahrestan::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
