<?php

namespace Modules\File\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Ticket\Models\Ticket;

class File extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded = [];

    public function fileable()
    {
        return $this->morphTo();
    }
}
