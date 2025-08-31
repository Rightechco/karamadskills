<?php

namespace Modules\Common\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Common\Database\Factories\DehestanFactory;

class Dehestan extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'dehestan';
}
