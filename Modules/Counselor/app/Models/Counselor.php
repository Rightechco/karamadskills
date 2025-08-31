<?php

namespace Modules\Counselor\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\BBB\Models\BBB;
use Modules\Common\Models\Pay;
use Modules\User\Models\User;

class Counselor extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function bbbs()
    {
        return $this->morphMany(BBB::class,'bbbable');
    }

    public function pay()
    {
        return $this->belongsTo(Pay::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function counselor()
    {
        return $this->belongsTo(User::class,'counselor_id');
    }
}
