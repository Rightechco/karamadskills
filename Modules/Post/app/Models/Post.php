<?php

namespace Modules\Post\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Comment\Models\Comment;
use Modules\University\Models\University;
use Modules\User\Models\User;

class Post extends Model
{
    use HasFactory,Sluggable,SoftDeletes;

    protected $guarded = [];

    protected $casts = ['image' => 'array'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public const STATUS_WAIT = 'wait';
    public const STATUS_VERIFIED = 'verified';
    public const STATUS_UNVERIFIED = 'unverified';
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
                return 'رد شده';
        }
    }

    public function university()
    {
        return $this->belongsTo(University::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class,'commentable');
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
