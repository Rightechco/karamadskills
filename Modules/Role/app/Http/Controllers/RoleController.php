<?php

namespace Modules\Role\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Role\Http\Repositories\RoleRepo;
use Modules\Role\Http\Requests\RoleRequest;
use Modules\Role\Http\Requests\RoleUpdateRequest;
use Modules\Role\Http\Services\RoleService;
use Modules\Role\Models\Role;

class RoleController extends Controller
{
    public function roles()
    {
        if (auth()->user()->can('RolePermission')){
            return view('role::roles');
        } else {
            $toasts = [ 'toast' => [
                [
                    'message' => 'شما به این صفحه دسترسی ندارید',
                    'alert-type' => 'error'
                ]
            ]];
            return back()->with($toasts);
        }
    }

    public function getRoles(Request $request)
    {
        if (auth()->user()->can('RolePermission')){
            return RoleRepo::getRoles($request);
        } else {
            $toasts = [ 'toast' => [
                [
                    'message' => 'شما به این صفحه دسترسی ندارید',
                    'alert-type' => 'error'
                ]
            ]];
            return back()->with($toasts);
        }
    }

    public function rolesCreate()
    {
        if (auth()->user()->can('RolePermission')){
            $permissions = RoleRepo::permissionAll();
            return view('role::create',compact('permissions'));
        } else {
            $toasts = [ 'toast' => [
                [
                    'message' => 'شما به این صفحه دسترسی ندارید',
                    'alert-type' => 'error'
                ]
            ]];
            return back()->with($toasts);
        }
    }

    public function rolesStore(RoleRequest $request)
    {
        if (auth()->user()->can('RolePermission')){
            if (!empty($request->permissions) && in_array('RolePermission', array_keys($request->permissions))) {
                $toasts = ['toast' => [
                    [
                        'message' => 'دسترسی نقش ها را نمی توانید به کسی دهید',
                        'alert-type' => 'error'
                    ]
                ]];
                return back()->with($toasts);
            }
            RoleService::store($request->validated());
            $toasts = [ 'toast' => [
                [
                    'message' => 'نقش موردنظر ایجاد شد',
                    'alert-type' => 'success'
                ]
            ]];
            return to_route('panel.role.roles')->with($toasts);
        } else {
            $toasts = [ 'toast' => [
                [
                    'message' => 'شما به این صفحه دسترسی ندارید',
                    'alert-type' => 'error'
                ]
            ]];
            return back()->with($toasts);
        }
    }

    public function rolesEdit(Role $role)
    {
        if (auth()->user()->can('RolePermission')){
            if($role->slug == 'admin') {
                $toasts = [ 'toast' => [
                    [
                        'message' => 'نقش مدیر را نمی توانید تغییر دهید',
                        'alert-type' => 'error'
                    ]
                ]];
                return back()->with($toasts);
            }
            $permissions = RoleRepo::permissionAll();
            return view('role::edit',compact('permissions','role'));
        } else {
            $toasts = [ 'toast' => [
                [
                    'message' => 'شما به این صفحه دسترسی ندارید',
                    'alert-type' => 'error'
                ]
            ]];
            return back()->with($toasts);
        }
    }

    public function rolesUpdate(RoleUpdateRequest $request,Role $role)
    {
        if (auth()->user()->can('RolePermission')){
            if($role->slug == 'admin') {
                $toasts = [ 'toast' => [
                    [
                        'message' => 'نقش مدیر را نمی توانید تغییر دهید',
                        'alert-type' => 'error'
                    ]
                ]];
                return back()->with($toasts);
            }
            if (!empty($request->permissions) && in_array('RolePermission', array_keys($request->permissions))) {
                $toasts = ['toast' => [
                    [
                        'message' => 'دسترسی نقش ها را نمی توانید به کسی دهید',
                        'alert-type' => 'error'
                    ]
                ]];
                return back()->with($toasts);
            }
            RoleService::update($request->validated(),$role);
            $toasts = [ 'toast' => [
                [
                    'message' => 'نقش موردنظر ویرایش شد',
                    'alert-type' => 'success'
                ]
            ]];
            return to_route('panel.role.roles')->with($toasts);
        } else {
            $toasts = [ 'toast' => [
                [
                    'message' => 'شما به این صفحه دسترسی ندارید',
                    'alert-type' => 'error'
                ]
            ]];
            return back()->with($toasts);
        }
    }

    public function rolesDelete(Role $role)
    {
        if (auth()->user()->can('RolePermission')){
            if ($role->slug == 'admin'){
                abort(403);
            }
            RoleService::syncPermission([],$role);
            $role->delete();
            $toasts = [ 'toast' => [
                [
                    'message' => 'نقش موردنظر حذف شد',
                    'alert-type' => 'success'
                ]
            ]];
            return to_route('panel.role.roles')->with($toasts);
        } else {
            $toasts = [ 'toast' => [
                [
                    'message' => 'شما به این صفحه دسترسی ندارید',
                    'alert-type' => 'error'
                ]
            ]];
            return back()->with($toasts);
        }
    }
}
