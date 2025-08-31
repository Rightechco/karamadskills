<?php

namespace Modules\Test\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Common\Models\Pay;
use Modules\User\Models\User;

class Test extends Model
{
    use HasFactory;

    protected $guarded = [];

    public const RAVEN = 'raven';
    public const HOLLAND = 'holland';
    public const MBTI = 'MBTI';
    public const EQ = 'EQ';
    public static array $types = [
        self::RAVEN,
        self::HOLLAND,
        self::MBTI,
        self::EQ
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function pay()
    {
        return $this->belongsTo(Pay::class);
    }

}
