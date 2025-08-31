<?php

namespace Modules\Role\Http\Services;

use Modules\Role\Http\Repositories\RoleRepo;
use Modules\Role\Models\Role;
use Modules\User\Models\User;

class RoleService
{
    public static function getRole($id)
    {
        return Role::query()->find($id);
    }

    public static function store($request)
    {
        $role = Role::query()->create(['name' => $request['name'],'slug' => $request['slug'] ?? null]);
        RoleService::givePermissionTo($request['permissions'] ?? [],$role);
        return $role;
    }

    public static function update($request,Role $role)
    {
        $role = RoleRepo::findById($role->id);
        $role->permissions()->sync($request['permissions'] ?? []);
        $role->update(['name' => $request['name'],'slug' => $request['slug'] ?? $role->slug]);
        return $role;
    }

    public static function givePermissionTo($request,Role $role)
    {
        $role = RoleRepo::findById($role->id);
        $role->permissions()->attach($request);
    }

    public static function giveRoleTo(Role $role,User $user)
    {
        $user->roles()->attach($role);
    }

    public static function syncRoles($roles,User $user)
    {
        $user->roles()->sync($roles);
    }

    public static function syncPermission($permissions,Role $role)
    {
        $role->permissions()->sync($permissions);
    }
}
