<?php

namespace Modules\Common\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Common\Database\Factories\ShahrestanFactory;

class Shahrestan extends Model
{
    use HasFactory;

    protected $fillable = [];

    protected $table = 'shahrestan';
}
