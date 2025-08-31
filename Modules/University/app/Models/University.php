<?php

namespace Modules\University\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Course\Models\Course;
use Modules\Post\Models\Post;
use Modules\User\Models\User;
use Modules\Visit\Models\Visit;

class University extends Model
{
    use HasFactory,SoftDeletes,Sluggable;

    protected $guarded = [];

    protected $casts = ['gallery' => 'array','logo' => 'array','stamp' => 'array'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public const SARASARI = 'sarasari';
    public const ELMYKARBORDI = 'elmykarbordi';
    public const PAYAMNOOR = 'payamnoor';
    public const PARDIS = 'pardis';
    public const GHEYRENTEFAI = 'gheyrentefai';
    public const AZAD = 'azad';
    public const MAJAZI = 'majazi';
    public const INSTITUTE = 'institute';
    public static array $types = [
        self::SARASARI,
        self::ELMYKARBORDI,
        self::PAYAMNOOR,
        self::PARDIS,
        self::GHEYRENTEFAI,
        self::AZAD,
        self::MAJAZI,
        self::INSTITUTE,
    ];

    public const COUNTRY = 'country';
    public const OSTANY = 'ostany';
    public const VAHED = 'vahed';
    public static array $states = [
      self::COUNTRY,
      self::OSTANY,
      self::VAHED
    ];

    public function admins()
    {
        return $this->belongsToMany(User::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function parent()
    {
        return $this->belongsTo(__CLASS__,'parent_id');
    }

    public function childs()
    {
        return $this->hasMany(__CLASS__,'parent_id');
    }

    public function publishes()
    {
        return $this->morphMany(Course::class,'courseable');
    }

    public function visits()
    {
        return $this->hasMany(Visit::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
