<?php

namespace Modules\User\Http\Services;

use Hekmatinasser\Verta\Verta;
use Illuminate\Support\Facades\DB;
use Modules\Auth\Http\Services\AuthService;
use Modules\Role\Http\Services\RoleService;
use Modules\User\Models\User;

class UserService
{
    public static function getUsersByPermission($per)
    {
        $users = User::query()->select('id', 'name')->get();
        $sellers = [];
        foreach ($users as $user) {
            if ($user->can($per)) {
                $sellers[] = $user;
            }
        }
        return $sellers;
    }

    public static function createUser($request)
    {
        DB::transaction(function () use ($request) {
            $user = AuthService::createUser(['mobile' => $request['mobile']]);
            $user = AuthService::createFullUser($request, $user->id,auth()->user()->id);
            if (!empty($request['roles']) && auth()->user()->can('AddUserPermission')) {
                foreach ($request['roles'] as $role) {
                    RoleService::giveRoleTo(RoleService::getRole($role), $user);
                }
            }
        });
        return User::query()->where('mobile',$request['mobile'])->first();
    }

    public static function updateUser($request, User $user)
    {
        DB::transaction(function () use ($request, $user) {
            $user = AuthService::updateUser($request, $user->id);
            RoleService::syncRoles($request['roles'] ?? null, $user);
        });
    }

//    public static function createUserfront($request)
//    {
//        return User::query()->updateOrCreate([
//            'name' => $request['name'],
//            'mobile' => $request['mobile'],
//            'ostan_id' => $request['ostan'],
//            'shahrestan_id' => $request['shahrestan'],
//            'bakhsh_id' => $request['bakhsh'],
//            'shahr_id' => $request['shahr'] ?? null,
//            'degree' => $request['degree'] ?? null,
//            'job' => $request['job'] ?? null,
//            'about' => $request['about'] ?? null,
//            'expertise' => $request['expertise'] ?? null,
//            'skill' => $request['skill'] ?? null,
//            'resume' => $request['resume'] ?? null,
//            'request' => User::EMPLOYEE
//        ]);
//    }

    public static function getUsers($request)
    {
        $columns_list = array(
            0 => 'id',
            1 => 'status',
            2 => 'name',
            3 => 'mobile',
            4 => 'nationalCode',
            5 => 'created_at',
            6 => 'detail'
        );
        $linkObj = new User();


        if (isset($request->filter['status']) && $request->filter['status'] != 'null') {
            $linkObj = $linkObj->where('status', $request->filter['status']);
        }
        if (isset($request->filter['role']) && $request->filter['role'] != 'null') {
            $linkObj = $linkObj->with('roles')->whereHas('roles', function ($q) use ($request) {
                $q->where('role_id', $request->filter['role']);
            });
        }

        $totalDataRecord = $linkObj->count();
        $totalFilteredRecord = $totalDataRecord;
        $limit_val = $request->input('length');
        $start_val = $request->input('start');
        $order_val = $columns_list[$request->input('order.0.column')] ?? 'id';
        $dir_val = $request->input('order.0.dir') ?? 'asc';

        if (empty($request->input('search.value'))) {
            $post_data = $linkObj;
            if ($request->input('length') != -1) {
                $post_data = $post_data->offset($start_val);
            }
            $post_data = $post_data->limit($limit_val)->orderBy($order_val, $dir_val)->get();
        } else {
            $search_text = $request->input('search.value');

            $post_data = $linkObj
                ->where(function ($query) use ($search_text) {
                    $query->where('id', 'Like', "%{$search_text}%")
                        ->orWhere('name', 'Like', "%{$search_text}%")
                        ->orWhere('mobile', 'Like', "%{$search_text}%")
                        ->orWhere('nationalCode', 'Like', "%{$search_text}%");
                });
            if ($request->input('length') != '-1') {
                $post_data = $post_data->offset($start_val);
            }
            $post_data = $post_data->limit($limit_val)->orderBy($order_val, $dir_val)->get();

            $totalFilteredRecord = $linkObj
                ->where(function ($query) use ($search_text) {
                    $query->where('id', 'Like', "%{$search_text}%")
                        ->orWhere('name', 'Like', "%{$search_text}%")
                        ->orWhere('mobile', 'Like', "%{$search_text}%")
                        ->orWhere('nationalCode', 'Like', "%{$search_text}%");
                })
                ->count();
        }

        $data_val = array();
        if (!empty($post_data)) {
            foreach ($post_data as $key => $post_val) {
                $postnestedData['id'] = $post_val->id ?? '-';
                $postnestedData['status'] = '<span class="badge bg-' . $post_val->classStatus() . '">' . $post_val->nameStatus() . '</span>' ?? '-';
                $postnestedData['name'] = $post_val->name ?? '-';
                $postnestedData['nationalCode'] = $post_val->nationalCode ?? '-';
                $postnestedData['mobile'] = $post_val->mobile . ' ' ?? '-';
                $postnestedData['roles'] = '' ?? '-';
                foreach ($post_val->roles as $role) {
                    $postnestedData['roles'] .= '<span class="badge badge-secondary m-1 p-1">' . $role->name . '</span> ';
                }
                $postnestedData['created_at'] = Verta::instance($post_val->created_at). ' ' ?? '-';
                $postnestedData['detail'] = '<td>
                                            <a class="btn btn-icon  btn-primary" href="' . route('panel.user.usersEdit', $post_val->id) . '" data-toggle="tooltip" data-placement="bottom" title="ویرایش"><i class="fas fa-edit"></i></a>
                                            </td>';
                $data_val[$key] = $postnestedData;
            }
        }
        $draw_val = $request->input('draw');
        $get_json_data = array(
            "draw" => intval($draw_val),
            "recordsTotal" => intval($totalDataRecord),
            "recordsFiltered" => intval($totalFilteredRecord),
            "data" => $data_val
        );
        return json_encode($get_json_data);
    }
}
