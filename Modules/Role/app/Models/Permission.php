<?php

namespace Modules\Role\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Role\Database\Factories\PermissionFactory;
use Modules\User\Models\User;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug'];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}

