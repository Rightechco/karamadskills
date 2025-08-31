<?php

namespace Modules\Ticket\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\File\Models\File;
use Modules\User\Models\User;

// use Modules\Ticket\Database\Factories\TicketFactory;

class Ticket extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded = [];

    public const OPEN = 'open';
    public const CLOSE = 'close';

    public static array $statuses = [
        self::OPEN,
        self::CLOSE,
    ];

    public function classStatus(): string
    {
        switch ($this->status) {
            case self::OPEN:
                return 'success';
            case self::CLOSE:
                return 'danger';
        }
    }

    public function nameStatus(): string
    {
        switch ($this->status) {
            case self::OPEN:
                return 'در انتظار پاسخ';
            case self::CLOSE:
                return 'بسته شده';
        }
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function receiver()
    {
        return $this->belongsTo(User::class,'receiver_id');
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
}
