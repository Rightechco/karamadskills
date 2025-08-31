<?php

namespace Modules\Role\Http\Repositories;

use Modules\Role\Models\Permission;
use Modules\Role\Models\Role;

class RoleRepo
{
    public static function index()
    {
        return Role::query()->latest();
    }

    public static function findById($id)
    {
        return Role::query()->findOrFail($id);
    }

    public static function permissionAll()
    {
        return Permission::all();
    }

    public static function rolesAll()
    {
        return Role::all();
    }

    public static function delete($id)
    {
        return Role::query()->where('id',$id)->delete();
    }

    public static function getRoles($request)
    {
        $columns_list = array(
            0 => 'id',
            1 => 'name',
            2 => 'slug',
            3 => 'permissions',
            4 => 'detail',
        );
        $linkObj = new Role();
        $totalDataRecord = $linkObj->count();
        $totalFilteredRecord = $totalDataRecord;
        $limit_val = $request->input('length');
        $start_val = $request->input('start');
        $order_val = $columns_list[$request->input('order.0.column')] ?? 'id';
        $dir_val = $request->input('order.0.dir') ?? 'asc';

        if(empty($request->input('search.value')))
        {
            $post_data = $linkObj;
            if ($request->input('length') != '-1') {
                $post_data = $post_data->offset($start_val);
            }
            $post_data = $post_data->limit($limit_val)->orderBy($order_val, $dir_val)->get();
        } else {
            $search_text = $request->input('search.value');

            $post_data =  $linkObj
                ->where(function ($query) use($search_text) {
                    $query->where('id','Like',"%{$search_text}%")
                        ->orWhere('name', 'Like',"%{$search_text}%")
                        ->orWhere('slug', 'Like',"%{$search_text}%");
                });
            if ($request->input('length') != '-1') {
                $post_data = $post_data->offset($start_val);
            }
            $post_data = $post_data->limit($limit_val)->orderBy($order_val, $dir_val)->get();

            $totalFilteredRecord = $linkObj
                ->where(function ($query) use($search_text) {
                    $query->where('id','Like',"%{$search_text}%")
                        ->orWhere('name', 'Like',"%{$search_text}%")
                        ->orWhere('slug', 'Like',"%{$search_text}%");
                })
                ->count();
        }

        $data_val = array();
        if(!empty($post_data))
        {
            foreach ($post_data as $key => $post_val)
            {
                $postnestedData['id'] = $post_val->id ?? '-';
                $postnestedData['name'] = $post_val->name ?? '-';
                $postnestedData['slug'] = $post_val->slug ?? '-';
                $postnestedData['permissions'] = '' ?? '-';
                foreach ($post_val->permissions as $permission) {
                    $postnestedData['permissions'] .= '<span class="badge badge-secondary m-1 p-1">'.$permission->name.'</span>';
                }
                $postnestedData['detail'] = '<td>
                                            <a class="btn btn-icon  btn-primary" href="'.route('panel.role.rolesEdit',$post_val->id).'" data-toggle="tooltip" data-placement="bottom" title="ویرایش"><i class="fas fa-edit"></i></a>
                                            </td>
                                            <td>
                                            <a onClick="sweetConfirm(event)" class="btn btn-icon  btn-primary" href="'.route('panel.role.rolesDelete',$post_val->id).'" data-toggle="tooltip" data-placement="bottom" title="حذف"><i class="fas fa-trash"></i></a>
                                            </td>';
                $data_val[$key] = $postnestedData;

            }
        }
        $draw_val = $request->input('draw');
        $get_json_data = array(
            "draw"            => intval($draw_val),
            "recordsTotal"    => intval($totalDataRecord),
            "recordsFiltered" => intval($totalFilteredRecord),
            "data"            => $data_val
        );
        return json_encode($get_json_data);
    }
}
