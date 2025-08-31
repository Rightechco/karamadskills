<?php

namespace Modules\User\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Modules\Announcement\Models\Announcement;
use Modules\Comment\Models\Comment;
use Modules\Company\Models\Company;
use Modules\Counselor\Models\Counselor;
use Modules\Course\Models\Course;
use Modules\Incentive\Models\Incentive;
use Modules\Notif\Models\Notif;
use Modules\Opt\Models\Opt;
use Modules\Request\Models\Request;
use Modules\Resume\Models\Resume;
use Modules\Role\Http\Traits\HasPermissionsTrait;
use Modules\Role\Models\Permission;
use Modules\Role\Models\Role;
use Modules\Test\Models\Test;
use Modules\Ticket\Models\Ticket;
use Modules\University\Models\University;
use Modules\Wallet\Models\BankCard;
use Modules\Wallet\Models\Wallet;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasPermissionsTrait,SoftDeletes,Sluggable;

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public const STATUS_NEW = 'new';
    public const STATUS_UNVERIFIED = 'unverified';
    public const STATUS_VERIFIED = 'verified';
    public const STATUS_BLOCK = 'block';
    public static array $statuses = [
        self::STATUS_NEW,
        self::STATUS_VERIFIED,
        self::STATUS_UNVERIFIED,
        self::STATUS_BLOCK
    ];

    protected $fillable = [
        'status',
        'subset_id',
        'email',
        'name',
        'mobile',
        'nationalCode',
        'nationalCodePic',
        'pic',
        'referral',
        'hash',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function classStatus(): string
    {
        switch ($this->status) {
            case self::STATUS_NEW:
                return 'info';
            case self::STATUS_VERIFIED:
                return 'success';
            case self::STATUS_UNVERIFIED:
                return 'warning';
            case self::STATUS_BLOCK:
                return 'danger';
        }
    }

    public function nameStatus(): string
    {
        switch ($this->status) {
            case self::STATUS_NEW:
                return 'عضو جدید';
            case self::STATUS_VERIFIED:
                return 'تایید شده';
            case self::STATUS_UNVERIFIED:
                return 'تایید نشده';
            case self::STATUS_BLOCK:
                return 'مسدود';
        }
    }

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function opts()
    {
        return $this->hasMany(Opt::class);
    }

    public function incentives()
    {
        return $this->hasMany(Incentive::class);
    }

    public function notifs()
    {
        return $this->hasMany(Notif::class);
    }

    public function sendNotifs()
    {
        return $this->hasMany(Notif::class, 'admin_id');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function referral()
    {
        return $this->belongsTo(__CLASS__,'subset_id');
    }

    public function subs()
    {
        return $this->hasMany(__CLASS__,'subset_id');
    }

    public function resume()
    {
        return $this->hasOne(Resume::class);
    }

    public function companies()
    {
        return $this->hasMany(Company::class);
    }

    public function requests()
    {
        return $this->hasMany(Request::class);
    }

    public function universities()
    {
        return $this->belongsToMany(University::class);
    }

    public function university()
    {
        return $this->belongsTo(University::class);
    }

    public function wallet()
    {
        return $this->hasOne(Wallet::class);
    }

    public function cards()
    {
        return $this->hasMany(BankCard::class);
    }

    public function tests()
    {
        return $this->hasMany(Test::class);
    }

    public function announcements()
    {
        return $this->hasManyThrough(Announcement::class,Company::class);
    }

    public function requestReceive() {
        $companiesIds = array_column($this->companies->select('id')->toArray(),'id');
        $announcementIds = array_column(Announcement::query()->whereIn('company_id',$companiesIds)->select('id')->get()->toArray(),'id');
        return Request::query()->whereIn('announcement_id',$announcementIds)->orderBy('id','DESC')->take(10)->get();
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function receivedTickets()
    {
        return $this->hasMany(Ticket::class,'receiver_id');
    }

    public function counselors()
    {
        return $this->hasMany(Counselor::class,'counselor_id');
    }

    public function advices()
    {
        return $this->hasMany(Counselor::class,'user_id');
    }

    public function publishes()
    {
        return $this->morphMany(Course::class,'courseable');
    }

    public function teachers()
    {
        return $this->hasMany(Course::class,'teacher_id');
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class,'commentable');
    }
}
