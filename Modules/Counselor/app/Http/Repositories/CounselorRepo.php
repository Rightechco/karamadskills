<?php

namespace Modules\Counselor\Http\Repositories;

use Carbon\Carbon;
use Modules\BBB\Http\Services\BBBServices;
use Modules\Counselor\Models\Counselor;

class CounselorRepo
{
    public static function getCounselors($request)
    {
        $columns_list = array(
            0 => 'id',
            1 => 'name',
            2 => 'counselor',
            3 => 'user',
            4 => 'price',
            5 => 'detail'
        );
        $linkObj = new Counselor();
        $linkObj = $linkObj->whereNotNull('pay_id');
        if (!auth()->user()->can('CounselorPermission')){
            $linkObj = $linkObj->where(function ($query) {
                $query->where('user_id', auth()->user()->id)->orWhere('counselor_id', auth()->user()->id);
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
                        ->orWhere('price', 'Like', "%{$search_text}%")
                        ->orWhere(function ($query) use ($search_text) {
                            $query->with('user')->whereHas('user', function ($q) use ($search_text) {
                                $q->where('name','Like', "%{$search_text}%");
                            });
                        })->orWhere(function ($query) use ($search_text) {
                            $query->with('counselor')->whereHas('counselor', function ($q) use ($search_text) {
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
                        ->orWhere('price', 'Like', "%{$search_text}%")
                        ->orWhere(function ($query) use ($search_text) {
                            $query->with('user')->whereHas('user', function ($q) use ($search_text) {
                                $q->where('name','Like', "%{$search_text}%");
                            });
                        })->orWhere(function ($query) use ($search_text) {
                            $query->with('counselor')->whereHas('counselor', function ($q) use ($search_text) {
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
                $postnestedData['name'] = $post_val->name ?? '-';
                $postnestedData['counselor'] = $post_val->counselor->name ?? '-';
                $postnestedData['user'] = $post_val->user->name ?? '-';
                $postnestedData['price'] = $post_val->price ?? '-';
                $postnestedData['detail'] = '<td>';
                if ($post_val->counselor->id == auth()->user()->id || auth()->user()->can('CounselorPermission')) {
                    $t = 1;
                    if ($post_val->bbbs->count()) {
                        foreach($post_val->bbbs as $bbb) {
                            if (Carbon::create($bbb->date)->greaterThan(Carbon::now())) {
                                $postnestedData['detail'] .= '<span class="badge bg-info m-1">جلسه: '.verta($bbb->date)->format('%d %B %Y').'</span>';
                                $t = 0;
                            } elseif (Carbon::create($bbb->date)->isCurrentDay(Carbon::now())) {
                                if ($bbb->internalMeetingID) {
                                    if(BBBServices::info($bbb)){
                                        $postnestedData['detail'] .= '<a target="_blank" href="'.route('bbb.join',["id" => $bbb->internalMeetingID,"pass" => $bbb->moderatorPW]).'" class="btn bg-primary m-1">شروع جلسه</a>';
                                    } else {
                                        $postnestedData['detail'] .= '<span class="badge bg-danger m-1">جلسه تمام شده</span>';
                                    }
                                } else {
                                    $postnestedData['detail'] .= '<td><a target="_blank" href="'.route('bbb.create',$bbb->id).'" class="btn bg-primary text-white m-1">شروع مصاحبه</a></td>';
                                }
                            }
                        }
                        $postnestedData['detail'] .= '<button onclick="setIdBBB('.$post_val->id.')" type="button" class="btn btn-warning m-1" data-toggle="modal" data-target="#createBBB" class="btn btn-icon  btn-warning" data-toggle="tooltip" data-placement="bottom" title="ایجاد جلسه آنلاین"><i class="mdi mdi-microphone"></i> ایجاد جلسه آنلاین</button>';
                    } else {
                        $postnestedData['detail'] .= '<button onclick="setIdBBB('.$post_val->id.')" type="button" class="btn btn-warning m-1" data-toggle="modal" data-target="#createBBB" class="btn btn-icon  btn-warning" data-toggle="tooltip" data-placement="bottom" title="ایجاد جلسه آنلاین"><i class="mdi mdi-microphone"></i> ایجاد جلسه آنلاین</button>';
                    }
                } else {
                    if ($post_val->bbbs->count()) {
                        foreach($post_val->bbbs as $bbb) {
                            if (Carbon::create($bbb->date)->greaterThan(Carbon::now())) {
                                $postnestedData['detail'] .= '<span class="badge bg-info m-1">زمان جلسه: '.verta($bbb->date)->format('%d %B %Y').'</span>';
                            } elseif (Carbon::create($bbb->date)->isCurrentDay(Carbon::now())) {
                                if ($bbb->internalMeetingID) {
                                    if (BBBServices::info($bbb)) {
                                        $postnestedData['detail'] .= '<a target="_blank" href="'.route('bbb.join',["id" => $bbb->internalMeetingID,"pass" => $bbb->attendeePW]).'" class="btn bg-info m-1">برو به جلسه</a>';
                                    } else {
                                        $postnestedData['detail'] .= '<span class="badge bg-danger m-1">جلسه تمام شده</span>';
                                    }
                                } else {
                                    $postnestedData['detail'] .= '<span class="badge bg-warning m-1 text-white">در انتظار برای شروع</span>';
                                }
                            } else {
                                $postnestedData['detail'] .= '<span class="badge bg-danger m-1 text-white">پایان یافته</span>';
                            }
                        }
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
