<?php

namespace Modules\Role\Http\Traits;

use Modules\Role\Models\Permission;

trait HasPermissionsTrait
{
    public function hasPermission(Permission $permission)
    {
        return (bool) $this->permissions->where('slug',$permission->slug)->count();
    }

    public function hasRole(...$roles)
    {
        foreach ($roles as $role){
            if ($this->roles->contains('slug',$role)){
                return true;
            }
        }
        return false;
    }

    public function hasPermissionThroughRole(Permission $permission)
    {
        foreach ($permission->roles as $role) {
            if ($this->roles->contains($role)) {
                return true;
            }
        }
        return false;
    }

    public function hasPermissionTo(Permission $permission)
    {
        if ($this->hasPermission($permission) || $this->hasPermissionThroughRole($permission)) {
            return true;
        }
        return false;
    }
}
