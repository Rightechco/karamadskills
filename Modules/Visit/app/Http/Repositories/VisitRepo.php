<?php

namespace Modules\Visit\Http\Repositories;

use Modules\University\Models\University;
use Modules\User\Models\User;
use Modules\Visit\Models\Visit;

class VisitRepo
{
    public static function getVisits($request)
    {
        $columns_list = array(
            0 => 'id',
            1 => 'status',
            2 => 'name',
            3 => 'uni',
            4 => 'detail',
        );
        $linkObj = new Visit();
        if (!auth()->user()->can('VisitPermission')){
            $linkObj = $linkObj->where(function ($query) {
                $query->with('university')->whereHas('university',function ($q) {
                    $q->whereHas('admins', function ($qq) {
                        $qq->where('user_id', auth()->user()->id);
                    });
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

            $post_data = $linkObj->where(function ($query) use ($search_text) {
                $query->where('id', 'Like', "%{$search_text}%")
                    ->orWhere('name', 'Like', "%{$search_text}%")
                    ->orWhere('slug', 'Like', "%{$search_text}%")
                    ->orWhere('des', 'Like', "%{$search_text}%")
                    ->orWhere('expert', 'Like', "%{$search_text}%")
                    ->orWhere('tag', 'Like', "%{$search_text}%")
                    ->orWhere(function ($query) use ($search_text) {
                        $query->with('university')->whereHas('university', function ($q) use ($search_text) {
                            $q->where('name','Like', "%{$search_text}%");
                        });
                    });
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
                        ->orWhere('des', 'Like', "%{$search_text}%")
                        ->orWhere('expert', 'Like', "%{$search_text}%")
                        ->orWhere('tag', 'Like', "%{$search_text}%")
                        ->orWhere(function ($query) use ($search_text) {
                            $query->with('university')->whereHas('university', function ($q) use ($search_text) {
                                $q->where('name','Like', "%{$search_text}%");
                            });
                        });
                })
                ->count();
        }

        $data_val = array();
        if (!empty($post_data)) {
            foreach ($post_data as $key => $post_val) {
                $postnestedData['id'] = $post_val->id ?? '-';
                $postnestedData['status'] = '<span class="badge bg-' . $post_val->classStatus() . '">' . $post_val->nameStatus() . '</span>' ?? '-';
                $postnestedData['name'] = $post_val->name ?? '-';
                $postnestedData['uni'] = $post_val->university->name ?? '-';
                $postnestedData['detail'] = '<td>';
                $postnestedData['detail'] .= '<a href="'.route('panel.visit.visitEdit',$post_val->id).'" class="btn btn-info m-1" data-toggle="tooltip" data-placement="bottom" title="ویرایش"><i class="mdi mdi-pencil"></i></button>';
                $postnestedData['detail'] .= '<a onClick="sweetConfirm(event)" href="'.route('panel.visit.visitDelete',$post_val->id).'" class="btn btn-danger m-1" data-toggle="tooltip" data-placement="bottom" title="حذف"><i class="mdi mdi-trash-can"></i></button>';
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
