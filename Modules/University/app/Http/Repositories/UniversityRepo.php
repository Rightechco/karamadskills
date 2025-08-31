<?php

namespace Modules\University\Http\Repositories;

use Modules\University\Models\University;
use Modules\User\Models\User;

class UniversityRepo
{
    public static function getUniversityUser($request,$uniId)
    {
        $columns_list = array(
            0 => 'id',
            1 => 'name',
            2 => 'nationalCode',
            3 => 'mobile',
            4 => 'resume'
        );
        $linkObj = new User();
        $linkObj = $linkObj->where('university_id',$uniId);
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
                        ->orWhere('nationalCode', 'Like', "%{$search_text}%")
                        ->orWhere('mobile', 'Like', "%{$search_text}%");
                });
            if ($request->input('length') != '-1') {
                $post_data = $post_data->offset($start_val);
            }
            $post_data = $post_data->limit($limit_val)->orderBy($order_val, $dir_val)->get();

            $totalFilteredRecord = $linkObj
                ->where(function ($query) use ($search_text) {
                    $query->where('id', 'Like', "%{$search_text}%")
                        ->orWhere('name', 'Like', "%{$search_text}%")
                        ->orWhere('nationalCode', 'Like', "%{$search_text}%")
                        ->orWhere('mobile', 'Like', "%{$search_text}%");
                })
                ->count();
        }

        $data_val = array();
        if (!empty($post_data)) {
            foreach ($post_data as $key => $post_val) {
                $postnestedData['id'] = $post_val->id ?? '-';
                $postnestedData['name'] = $post_val->name ?? '-';
                $postnestedData['nationalCode'] = $post_val->nationalCode ?? '-';
                $postnestedData['mobile'] = $post_val->mobile ?? '-';
                if ($post_val->resume) {
                    $postnestedData['resume'] = '<td>
                                                 <a target="_blank" class="btn btn-icon  btn-info" href="' . route('seeResume', $post_val->id) . '" data-toggle="tooltip" data-placement="bottom" title="مشاهده روزمه"><i class="mdi mdi-account-badge-outline"></i></a>
                                                 </td>';
                } else {
                    $postnestedData['resume'] = '<a href="'. route("panel.ticket.send",$post_val->slug) .'" class="btn btn-outline-info" style="font-size: 16px">ارسال پیام</a>';
                }

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

    public static function getUniversities($request)
    {
        $columns_list = array(
            0 => 'id',
            1 => 'admins',
            2 => 'name',
            3 => 'link',
            4 => 'state',
            5 => 'type',
            6 => 'parent',
            7 => 'detail'
        );
        $linkObj = new University();
        if (!auth()->user()->can('UniversityPermission')){
            $linkObj = $linkObj->where(function ($query) {
                $query->with('admins')->whereHas('admins', function ($q) {
                    $q->where('user_id', auth()->user()->id);
                });
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
                        ->orWhere('slug', 'Like', "%{$search_text}%")
                        ->orWhere('tell', 'Like', "%{$search_text}%")
                        ->orWhere('text', 'Like', "%{$search_text}%")
                        ->orWhere('website', 'Like', "%{$search_text}%");
                });
            if ($request->input('length') != '-1') {
                $post_data = $post_data->offset($start_val);
            }
            $post_data = $post_data->limit($limit_val)->orderBy($order_val, $dir_val)->get();

            $totalFilteredRecord = $linkObj
                ->where(function ($query) use ($search_text) {
                    $query->where('id', 'Like', "%{$search_text}%")
                        ->orWhere('name', 'Like', "%{$search_text}%")
                        ->orWhere('slug', 'Like', "%{$search_text}%")
                        ->orWhere('tell', 'Like', "%{$search_text}%")
                        ->orWhere('text', 'Like', "%{$search_text}%")
                        ->orWhere('website', 'Like', "%{$search_text}%");
                })
                ->count();
        }

        $data_val = array();
        if (!empty($post_data)) {
            foreach ($post_data as $key => $post_val) {
                $postnestedData['id'] = $post_val->id ?? '-';
                $adminsText = '';
                foreach ($post_val->admins as $admin) {
                    $adminsText .= '<span class="badge bg-secondary mx-1">'.$admin->name.' - '.$admin->mobile.'</span>';
                }
                $postnestedData['admins'] = $adminsText;
                $postnestedData['name'] = $post_val->name ?? '-';
                $postnestedData['link'] = '<a target="_blank" href="'.route('university.uni',$post_val->slug).'" class="btn btn-sm bg-secondary">مشاهده</a>';
                $postnestedData['state'] = __('messages.' . $post_val->state) ?? '-';
                $postnestedData['type'] = __('messages.' . $post_val->type) ?? '-';
                $postnestedData['parent'] = $post_val->parent->name ?? '-';
                $postnestedData['detail'] = '<td>
                                            <a class="btn btn-icon btn-success" href="' . route('panel.university.universityUsers', $post_val->id) . '" data-toggle="tooltip" data-placement="bottom" title="لیست دانشجوبان"><i class="fas fa-align-justify"></i></a>
                                            <a class="btn btn-icon btn-info" href="' . route('panel.university.universityEditContent', $post_val->id) . '" data-toggle="tooltip" data-placement="bottom" title="ویرایش صفحه"><i class="fas fa-edit"></i></a>';
                if (auth()->user()->can('UniversityPermission')) {
                    $postnestedData['detail'] .= '<a class="btn btn-icon  btn-warning mx-1" href="' . route('panel.university.universityEdit', $post_val->id) . '" data-toggle="tooltip" data-placement="bottom" title="ویرایش"><i class="fas fa-edit"></i></a>';
                }
                $postnestedData['detail'] .= '</td>';
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
