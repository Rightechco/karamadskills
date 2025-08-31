<?php

namespace Modules\Incentive\Http\Repositories;

use Modules\Incentive\Models\Incentive;
use Modules\University\Models\University;
use Modules\User\Models\User;

class IncentiveRepo
{
    public static function getIncentives($request)
    {

        $columns_list = array(
            0 => 'id',
            1 => 'status',
            2 => 'name',
            3 => 'university',
            4 => 'created_at',
            5 => 'score',
            6 => 'detail',
        );
        $linkObj = new Incentive();
        if (!auth()->user()->can('IncentivePermission')){
            $linkObj = $linkObj->where(function ($query) {
                $query->with('type')->whereHas('type', function ($q) {
                    $q->whereHas('admins', function ($qq) {
                        $qq->where('user_id', auth()->user()->id);
                    });
                });
            });
            $linkObj = $linkObj->orWhere(function ($query) {
                $query->with('ostan')->whereHas('ostan', function ($q) {
                    $q->whereHas('admins', function ($qq) {
                        $qq->where('user_id', auth()->user()->id);
                    });
                });
            });
            $linkObj = $linkObj->orWhere(function ($query) {
                $query->with('university')->whereHas('university', function ($q) {
                    $q->whereHas('admins', function ($qq) {
                        $qq->where('user_id', auth()->user()->id);
                    });
                });
            });
            $linkObj = $linkObj->orWhere('user_id',auth()->user()->id);
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
                    ->orWhere('incentive', 'Like', "%{$search_text}%")
                    ->orWhere(function ($query) use ($search_text) {
                        $query->with('type')->whereHas('type', function ($q) use ($search_text) {
                            $q->where('name','Like', "%{$search_text}%");
                        });
                    })->orWhere(function ($query) use ($search_text) {
                        $query->with('ostan')->whereHas('ostan', function ($q) use ($search_text) {
                            $q->where('name','Like', "%{$search_text}%");
                        });
                    })->orWhere(function ($query) use ($search_text) {
                        $query->with('university')->whereHas('university', function ($q) use ($search_text) {
                            $q->where('name','Like', "%{$search_text}%");
                        });
                    })->orWhere(function ($query) use ($search_text) {
                        $query->with('user')->whereHas('user', function ($q) use ($search_text) {
                            $q->where('name','Like', "%{$search_text}%")
                            ->orWhere('mobile','Like', "%{$search_text}%")
                            ->orWhere('nationalCode','Like', "%{$search_text}%");
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
                        ->orWhere('incentive', 'Like', "%{$search_text}%")
                        ->orWhere(function ($query) use ($search_text) {
                            $query->with('type')->whereHas('type', function ($q) use ($search_text) {
                                $q->where('name','Like', "%{$search_text}%");
                            });
                        })->orWhere(function ($query) use ($search_text) {
                            $query->with('ostan')->whereHas('ostan', function ($q) use ($search_text) {
                                $q->where('name','Like', "%{$search_text}%");
                            });
                        })->orWhere(function ($query) use ($search_text) {
                            $query->with('university')->whereHas('university', function ($q) use ($search_text) {
                                $q->where('name','Like', "%{$search_text}%");
                            });
                        })->orWhere(function ($query) use ($search_text) {
                            $query->with('user')->whereHas('user', function ($q) use ($search_text) {
                                $q->where('name','Like', "%{$search_text}%");
                            });
                        });
                })
                ->count();
        }

        $data_val = array();
        $userUnis = array_column(auth()->user()->universities->select('id')->toArray(),'id');
        if (!empty($post_data)) {
            foreach ($post_data as $key => $post_val) {
                $postnestedData['id'] = $post_val->id ?? '-';
                $postnestedData['status'] = '<span class="badge bg-' . $post_val->classStatus() . '">' . $post_val->nameStatus() . '</span>' ?? '-';
                $postnestedData['name'] = $post_val->user->name;
                $postnestedData['score'] = $post_val->score ?? '-';
                $postnestedData['created_at'] = verta($post_val->created_at)->format('Y-m-d');
                $postnestedData['university'] = $post_val->university->name.' / '.$post_val->ostan->name.' / '.$post_val->type->name;
                $postnestedData['detail'] = '<td>';
                if(auth()->user()->can('IncentivePermission') ||
                    in_array($post_val->type_id,$userUnis) ||
                    in_array($post_val->ostan_id,$userUnis) ||
                    in_array($post_val->university_id,$userUnis)) {
                    $postnestedData['detail'] .= '<button onclick="setIdIncentive('.$post_val->id.',this)" lll="'.route('panel.incentive.getIncentive',$post_val->id).'" type="button" class="btn btn-icon btn-info" data-toggle="modal" data-target="#incentiveModal"><i class="fas fa-eye"></i> مشاهده</button>';
                    $postnestedData['detail'] .= '<a onClick="sweetConfirm(event)" class="btn btn-icon btn-danger mx-1" href="' . route('panel.incentive.incentiveDelete', $post_val->id) . '" data-toggle="tooltip" data-placement="bottom" title="حذف"><i class="fas fa-trash"></i></a>';
                } else {
                    if ($post_val->status == Incentive::STATUS_REJECT) {
                        $postnestedData['detail'] .= '<a class="btn btn-icon btn-warning" href="' . route('panel.incentive.incentiveEdit', $post_val->id) . '" data-toggle="tooltip" data-placement="bottom" title="ویرایش"><i class="fas fa-edit"></i></a>';
                    }
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
