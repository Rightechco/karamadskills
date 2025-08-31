<?php

namespace Modules\Common\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Common\Database\Factories\ShahrFactory;

class Shahr extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'shahr';
}
