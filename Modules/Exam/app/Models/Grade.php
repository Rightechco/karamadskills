<?php

namespace Modules\Exam\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\User\Models\User;

// use Modules\Exam\Database\Factories\GradeFactory;

class Grade extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded = [];

    protected $casts = ['grade' => 'array'];

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
