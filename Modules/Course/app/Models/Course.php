<?php

namespace Modules\Course\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\BBB\Models\BBB;
use Modules\Category\Models\Category;
use Modules\Comment\Models\Comment;
use Modules\Exam\Models\Exam;
use Modules\File\Models\File;
use Modules\User\Models\User;

class Course extends Model
{
    use HasFactory,SoftDeletes,Sluggable;

    protected $guarded = [];

    protected $casts = ['cover' => 'array'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public const STATUS_WAIT = 'wait';
    public const STATUS_FINISHED = 'finished';
    public const STATUS_VERIFIED = 'verified';
    public const STATUS_STOP = 'stop';
    public static array $statuses = [
        self::STATUS_WAIT,
        self::STATUS_VERIFIED,
        self::STATUS_FINISHED,
        self::STATUS_STOP
    ];

    public function classStatus(): string
    {
        switch ($this->status) {
            case self::STATUS_WAIT:
                return 'info';
            case self::STATUS_VERIFIED:
                return 'success';
            case self::STATUS_FINISHED:
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
                return 'در حال برگزاری';
            case self::STATUS_FINISHED:
                return 'پایان یافته';
            case self::STATUS_STOP:
                return 'متوقف شده';
        }
    }

    public function courseable()
    {
        return $this->morphTo();
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function teacher()
    {
        return $this->belongsTo(User::class);
    }

    public function parent()
    {
        return $this->belongsTo(__CLASS__,'parent_id');
    }

    public function childs()
    {
        return $this->hasMany(__CLASS__,'parent_id');
    }

    public function files()
    {
        return $this->morphMany(File::class,'fileable');
    }

    public function bbbs()
    {
        return $this->morphMany(BBB::class,'bbbable');
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class,'commentable');
    }

    public function exams()
    {
        return $this->hasMany(Exam::class);
    }
}
