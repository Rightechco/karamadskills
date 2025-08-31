<?php

namespace Modules\Resume\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Category\Models\Category;
use Modules\Common\Models\Shahrestan;
use Modules\User\Models\User;

// use Modules\Resume\Database\Factories\ResumeFactory;

class Resume extends Model
{
    use HasFactory;

    protected $guarded = [];

    public const GENDER_MALE = 'male';
    public const GENDER_FEMALE = 'female';
    public static array $genders = [
        self::GENDER_MALE,
        self::GENDER_FEMALE
    ];

    public const SINGLE = 'single';
    public const MARRIED = 'married';
    public static array $martials = [
        self::SINGLE,
        self::MARRIED
    ];

    public const FULLTIME = 'fulltime';
    public const PARTTIME = 'parttime';
    public const REMOTE = 'remote';
    public const INTERSHIP = 'internship';
    public static array $jobTypes = [
        self::FULLTIME,
        self::PARTTIME,
        self::REMOTE,
        self::INTERSHIP
    ];

    public const SEARCHING = 'searching';
    public const SEMISEARCH = 'semiSearch';
    public const NOTSEARCH = 'notSearch';
    public static array $status = [
        self::SEARCHING,
        self::SEMISEARCH,
        self::NOTSEARCH,
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function shahrestan()
    {
        return $this->belongsToMany(Shahrestan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
