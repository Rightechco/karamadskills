<?php

namespace Modules\Opt\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opt extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'name',
        'code',
        'expire_time'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
