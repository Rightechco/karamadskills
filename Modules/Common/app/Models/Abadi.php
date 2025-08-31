<?php

namespace Modules\Common\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Common\Database\Factories\AbadiFactory;

class Abadi extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'abadi';
}
