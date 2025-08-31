<?php

namespace Modules\Comment\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\User\Models\User;

// use Modules\Comment\Database\Factories\CommentFactory;

class Comment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public const NEW = 'new';
    public const ACTIVE = 'verified';
    public const INACTIVE = 'notVerified';
    public static array $statuses = [
        self::NEW,
        self::ACTIVE,
        self::INACTIVE
    ];

    public function classStatus(): string
    {
        switch ($this->status) {
            case self::NEW;
                return 'warning';
            case self::ACTIVE;
                return 'success';
            case self::INACTIVE;
                return 'danger';
        }
    }

    public function nameStatus(): string
    {
        switch ($this->status) {
            case self::NEW;
                return 'جدید';
            case self::ACTIVE;
                return 'تایید شده';
            case self::INACTIVE;
                return 'تایید نشده';
        }
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function commentable() {
        return $this->morphTo();
    }

    public function parent()
    {
        return $this->belongsTo(__CLASS__,'parent_id');
    }

    public function childs()
    {
        return $this->hasMany(__CLASS__,'parent_id');
    }
}
