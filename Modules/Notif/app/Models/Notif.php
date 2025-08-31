<?php

namespace Modules\Notif\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\User\Models\User;

class Notif extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'admin_id',
        'time',
        'status',
        'type',
        'subject',
        'text',
        'sented_at',
        'res'
    ];

    public const EVERY_SECOND = 'everySecond';
    public const EVERY_MINUTE = 'everyMinute';
    public const EVERY_HOUR = 'everyHour';
    public const EVERY_4HOUR = 'every4hour';
    public const EVERY_12HOUR = 'every12hour';
    public const EVERY_DAY = 'everyDay';
    public static array $time = [self::EVERY_SECOND,self::EVERY_MINUTE,self::EVERY_HOUR,self::EVERY_4HOUR,self::EVERY_12HOUR,self::EVERY_DAY];

    public const STATUS_SENT = 'sent';
    public const STATUS_NOT_SENT = 'notSent';
    public static array $statuses = [self::STATUS_SENT,self::STATUS_NOT_SENT];

    public const TYPE_EMAIL = 'email';
    public const TYPE_SMS = 'sms';
    public const TYPE_TELEGRAM = 'telegram';
    public static array $type = [self::TYPE_EMAIL,self::TYPE_SMS,self::TYPE_TELEGRAM];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function admin()
    {
        return $this->belongsTo(User::class,'admin_id');
    }
}
