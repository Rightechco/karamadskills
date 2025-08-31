<?php

namespace Modules\Intership\Http\Repositories;

use Carbon\Carbon;
use Modules\BBB\Http\Services\BBBServices;
use Modules\Intership\Models\Intership;

class IntershipRepo
{
    public static function getInterships($request)
    {
        $columns_list = array(
            0 => 'id',
            1 => 'status',
            2 => 'name',
            3 => 'company',
            4 => 'university',
            5 => 'detail',
        );
        $linkObj = new Intership();
        if (!auth()->user()->can('ّIntershipPermission')){
            $linkObj = $linkObj->where('user_id',auth()->user()->id);
            $linkObj = $linkObj->orWhere(function ($query) {
                $query->with('university')->whereHas('university',function ($q) {
                    $q->whereHas('admins', function ($qq) {
                        $qq->where('user_id', auth()->user()->id);
                    });
                });
            });
            $linkObj = $linkObj->orWhere(function ($query) {
                $query->with('announcement')->whereHas('announcement',function ($q) {
                    $q->whereHas('company', function ($qq) {
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
                    ->orWhere(function ($query) use ($search_text) {
                        $query->with('announcement')->whereHas('announcement', function ($q) use ($search_text) {
                            $q->where('name','Like', "%{$search_text}%")
                                ->orWhere(function ($q) use ($search_text) {
                                    $q->with('company')->whereHas('company', function ($qq) use ($search_text) {
                                        $qq->where('name','Like', "%{$search_text}%");
                                    });
                                });
                        });
                    })
                    ->orWhere(function ($query) use ($search_text) {
                        $query->with('university')->whereHas('university', function ($q) use ($search_text) {
                            $q->where('name','Like', "%{$search_text}%");
                        });
                    })
                    ->orWhere(function ($query) use ($search_text) {
                        $query->with('user')->whereHas('user', function ($q) use ($search_text) {
                            $q->where('name','Like', "%{$search_text}%");
                        });
                    });
            });
            if ($request->input('length') != '-1') {
                $post_data = $post_data->offset($start_val);
            }
            $post_data = $post_data->limit($limit_val)->orderBy($order_val, $dir_val)->get();

            $totalFilteredRecord = $linkObj->where(function ($query) use ($search_text) {
                $query->where('id', 'Like', "%{$search_text}%")
                    ->orWhere(function ($query) use ($search_text) {
                        $query->with('announcement')->whereHas('announcement', function ($q) use ($search_text) {
                            $q->where('name','Like', "%{$search_text}%")
                                ->orWhere(function ($q) use ($search_text) {
                                    $q->with('company')->whereHas('company', function ($qq) use ($search_text) {
                                        $qq->where('name','Like', "%{$search_text}%");
                                    });
                                });
                        });
                    })
                    ->orWhere(function ($query) use ($search_text) {
                        $query->with('university')->whereHas('university', function ($q) use ($search_text) {
                            $q->where('name','Like', "%{$search_text}%");
                        });
                    })
                    ->orWhere(function ($query) use ($search_text) {
                        $query->with('user')->whereHas('user', function ($q) use ($search_text) {
                            $q->where('name','Like', "%{$search_text}%");
                        });
                    });
            })->count();
        }

        $data_val = array();
        if (!empty($post_data)) {
            foreach ($post_data as $key => $post_val) {
                $postnestedData['id'] = $post_val->id ?? '-';
                $postnestedData['status'] = '<span class="badge bg-' . $post_val->classStatus() . '">' . $post_val->nameStatus() . '</span>' ?? '-';
                $postnestedData['name'] = $post_val->user->name ?? '-';
                $postnestedData['university'] = $post_val->university->name ?? '-';
                $postnestedData['company'] = $post_val->announcement->company->name ?? '-';
                $postnestedData['detail'] = '<td>';
                $postnestedData['detail'] .= '<a target="_blank" class="btn btn-icon btn-info" href="' . route('seeResume', $post_val->user->id) . '" data-toggle="tooltip" data-placement="bottom" title="مشاهده روزمه"><i class="mdi mdi-account-badge-outline"></i></a>';
                if ($post_val->introduction) {
                    $postnestedData['detail'] .= '<a target="_blank" href="'. route('panel.intership.introductionShow',$post_val->id) .'" class="btn btn-purple m-1">مشاهده معرفی نامه</a>';
                }
                if ($post_val->report) {
                    $postnestedData['detail'] .= '<a target="_blank" href="'. route('panel.intership.reportShow',$post_val->id) .'" class="btn btn-pink m-1">مشاهده گزارش پایان کار</a>';
                }
                if ($post_val->announcement->company->user_id == auth()->user()->id || auth()->user()->can('ّIntershipPermission')) {
                    if ($post_val->status == Intership::STATUS_WAIT){
                        $postnestedData['detail'] .= '<a class="btn btn-icon btn-warning m-1" href="' . route('panel.intership.companyAccept', $post_val->id) . '" data-toggle="tooltip" data-placement="bottom">تایید و ارسال به دانشگاه</a>';
                    }
                }
                if (in_array(auth()->user()->id,array_column($post_val->university->admins->select('id')->toArray(),'id')) || $post_val->announcement->company->user_id == auth()->user()->id || auth()->user()->can('ّIntershipPermission')) {
                    $postnestedData['detail'] .= '<button onclick="setId(' . $post_val->id . ')" type="button" class="btn btn-danger m-1" data-toggle="modal" data-target="#rejectModal" data-toggle="tooltip" data-placement="bottom" title="رد درخواست" ><i class="mdi mdi-close"></i></button>';
                }

                if ($post_val->status == Intership::STATUS_COMPANY_ACCEPT && (in_array(auth()->user()->id,array_column($post_val->university->admins->select('id')->toArray(),'id')) || auth()->user()->can('ّIntershipPermission'))) {
                    $postnestedData['detail'] .= '<button onclick="setUni(' . $post_val->id . ')" type="button" class="btn btn-info m-1" data-toggle="modal" data-target="#uniModal" data-toggle="tooltip" data-placement="bottom">درج معرفی نامه</button>';
                }

                if ($post_val->status == Intership::STATUS_UNIVERSITY_ACCEPT && ($post_val->user_id == auth()->user()->id || auth()->user()->can('IntershipPermission'))) {
                    $postnestedData['detail'] .= '<button onclick="setUser(' . $post_val->id . ')" type="button" class="btn btn-secondary m-1" data-toggle="modal" data-target="#userModal" data-toggle="tooltip" data-placement="bottom">درج گزارش پایان کار</button>';
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
