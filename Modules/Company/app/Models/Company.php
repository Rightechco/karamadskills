<?php

namespace Modules\Company\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Announcement\Models\Announcement;
use Modules\Comment\Models\Comment;
use Modules\User\Models\User;

// use Modules\Company\Database\Factories\CompanyFactory;

class Company extends Model
{
    use HasFactory,Sluggable,SoftDeletes;

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    protected $guarded = [];

    protected $casts = ['logo' => 'array','cover' => 'array'];

    public const STATUS_WAIT = 'wait';
    public const STATUS_UNVERIFIED = 'unverified';
    public const STATUS_VERIFIED = 'verified';
    public static array $statuses = [
        self::STATUS_WAIT,
        self::STATUS_VERIFIED,
        self::STATUS_UNVERIFIED
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
        }
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function announcements()
    {
        return $this->hasMany(Announcement::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class,'commentable');
    }
}
