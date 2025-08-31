<?php

namespace Modules\Request\Http\Repositories;

use Carbon\Carbon;
use Modules\BBB\Http\Services\BBBServices;
use Modules\Request\Models\Request;

class RequestRepo
{

    public static function getRequests($request)
    {
        $columns_list = array(
            0 => 'id',
            1 => 'status',
            2 => 'name',
            3 => 'announcement',
            4 => 'company',
            5 => 'city',
            6 => 'meet',
        );
        $linkObj = new Request();
        if (!auth()->user()->can('RequestPermission')){
            $linkObj = $linkObj->where('user_id',auth()->user()->id);
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
                              })->orWhere(function ($q) use ($search_text) {
                                    $q->with('shahrestan')->whereHas('shahrestan', function ($qq) use ($search_text) {
                                        $qq->where('name','Like', "%{$search_text}%");
                                    });
                                });
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
                                })->orWhere(function ($q) use ($search_text) {
                                    $q->with('shahrestan')->whereHas('shahrestan', function ($qq) use ($search_text) {
                                        $qq->where('name','Like', "%{$search_text}%");
                                    });
                                });
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
                $postnestedData['announcement'] = $post_val->announcement->name ?? '-';
                $postnestedData['company'] = $post_val->announcement->company->name ?? '-';
                $postnestedData['city'] = $post_val->announcement->shahrestan->name ?? '-';
                $postnestedData['meet'] = '';
                if ($post_val->bbbs->count()) {
                    foreach($post_val->bbbs as $bbb) {
                        if (Carbon::create($bbb->date)->greaterThan(Carbon::now())) {
                            $postnestedData['meet'] .= '<span class="badge bg-info m-1">مصاحبه: '.verta($bbb->date)->format('%d %B %Y').'</span>';
                        } elseif (Carbon::create($bbb->date)->isCurrentDay(Carbon::now())) {
                            if ($bbb->internalMeetingID) {
                                if (BBBServices::info($bbb)) {
                                    $postnestedData['meet'] .= '<a target="_blank" href="'.route('bbb.join',["id" => $bbb->internalMeetingID,"pass" => $bbb->attendeePW]).'" class="btn bg-info m-1">برو به مصاحبه</a>';
                                } else {
                                    $postnestedData['meet'] .= '<span class="badge bg-danger m-1">جلسه تمام شده</span>';
                                }
                            } else {
                                $postnestedData['meet'] .= '<span class="badge bg-warning m-1 text-white">در انتظار برای شروع</span>';
                            }
                        }
                    }
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

    public static function getAnnouncementRequests($request,$announcement)
    {
        if($announcement->company->user_id == auth()->user()->id || auth()->user()->can('RequestPermission')) {
            $columns_list = array(
                0 => 'id',
                1 => 'status',
                2 => 'name',
                3 => 'age',
                4 => 'martial',
                5 => 'detail',
            );
            $linkObj = new Request();
            $linkObj = $linkObj->where('announcement_id', $announcement->id);
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
                                $q->where('name', 'Like', "%{$search_text}%");
                            });
                        })
                        ->orWhere(function ($query) use ($search_text) {
                            $query->with('user')->whereHas('user', function ($q) use ($search_text) {
                                $q->where('name', 'Like', "%{$search_text}%");
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
                                $q->where('name', 'Like', "%{$search_text}%");
                            });
                        })
                        ->orWhere(function ($query) use ($search_text) {
                            $query->with('user')->whereHas('user', function ($q) use ($search_text) {
                                $q->where('name', 'Like', "%{$search_text}%");
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
                    $postnestedData['age'] = ($post_val->user->resume->birthday) ? verta($post_val->user->resume->birthday)->diffYears(now()).' سال' : '-';
                    $postnestedData['martial'] = ($post_val->user->resume->martial) ? __('messages.'.$post_val->user->resume->martial) : '-';
                    $postnestedData['detail'] = '<td>
                                                    <a target="_blank" class="btn btn-icon  btn-info" href="' . route('seeResume', $post_val->user->id) . '" data-toggle="tooltip" data-placement="bottom" title="مشاهده روزمه"><i class="mdi mdi-account-badge-outline"></i></a>
                                                    <a class="btn btn-icon  btn-warning" href="' . route('panel.request.interviewRequests', $post_val) . '" data-toggle="tooltip" data-placement="bottom" title="تایید برای مصاحبه"><i class="mdi mdi-microphone"></i></a>
                                                    <a class="btn btn-icon  btn-success" href="' . route('panel.request.hiredRequests', $post_val) . '" data-toggle="tooltip" data-placement="bottom" title="استخدام شد!"><i class="mdi mdi-bookmark-check"></i></a>
                                                    <button onclick="setId('.$post_val->id.')" type="button" class="btn btn-danger" data-toggle="modal" data-target="#rejectModal" class="btn btn-icon  btn-danger" data-toggle="tooltip" data-placement="bottom" title="رد درخواست" ><i class="mdi mdi-close"></i></button>
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

    public static function getAllRequests($request)
    {
        $columns_list = array(
            0 => 'id',
            1 => 'status',
            2 => 'name',
            3 => 'age',
            4 => 'martial',
            5 => 'detail',
        );
        $linkObj = new Request();
        if (!auth()->user()->can('RequestPermission')) {
            $linkObj = $linkObj->whereIn('announcement_id', array_column(auth()->user()->announcements->select('id')->toArray(),'id'));
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
                            $q->where('name', 'Like', "%{$search_text}%");
                        });
                    })
                    ->orWhere(function ($query) use ($search_text) {
                        $query->with('user')->whereHas('user', function ($q) use ($search_text) {
                            $q->where('name', 'Like', "%{$search_text}%");
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
                            $q->where('name', 'Like', "%{$search_text}%");
                        });
                    })
                    ->orWhere(function ($query) use ($search_text) {
                        $query->with('user')->whereHas('user', function ($q) use ($search_text) {
                            $q->where('name', 'Like', "%{$search_text}%");
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
                $postnestedData['age'] = (isset($post_val->user->resume)) ? verta($post_val->user->resume->birthday)->diffYears(now()).' سال' : '-';
                $postnestedData['martial'] = (isset($post_val->user->resume)) ? __('messages.'.$post_val->user->resume->martial) : '-';
                $postnestedData['detail'] = '<td>
                                                <a target="_blank" class="btn btn-icon  btn-info" href="' . route('seeResume', $post_val->user->id) . '" data-toggle="tooltip" data-placement="bottom" title="مشاهده روزمه"><i class="mdi mdi-account-badge-outline"></i></a>
                                                <a class="btn btn-icon  btn-warning" href="' . route('panel.request.interviewRequests', $post_val) . '" data-toggle="tooltip" data-placement="bottom" title="تایید برای مصاحبه"><i class="mdi mdi-microphone"></i></a>
                                                <a class="btn btn-icon  btn-success" href="' . route('panel.request.hiredRequests', $post_val) . '" data-toggle="tooltip" data-placement="bottom" title="استخدام شد!"><i class="mdi mdi-bookmark-check"></i></a>
                                                <button onclick="setId('.$post_val->id.')" type="button" class="btn btn-danger" data-toggle="modal" data-target="#rejectModal" class="btn btn-icon  btn-danger" data-toggle="tooltip" data-placement="bottom" title="رد درخواست" ><i class="mdi mdi-close"></i></button>';
                $t = 1;
                if ($post_val->bbbs->count()) {
                    foreach($post_val->bbbs as $bbb) {
                        if (Carbon::create($bbb->date)->greaterThan(Carbon::now())) {
                            $postnestedData['detail'] .= '<span class="badge bg-info m-1">مصاحبه: '.verta($bbb->date)->format('%d %B %Y').'</span>';
                            $t = 0;
                        } elseif (Carbon::create($bbb->date)->isCurrentDay(Carbon::now())) {
                            if ($bbb->internalMeetingID) {
                                if(BBBServices::info($bbb)){
                                    $postnestedData['detail'] .= '<a target="_blank" href="'.route('bbb.join',["id" => $bbb->internalMeetingID,"pass" => $bbb->moderatorPW]).'" class="btn bg-primary m-1">برو به مصاحبه</a>';
                                    $t = 0;
                                } else {
                                    $postnestedData['detail'] .= '<span class="badge bg-danger m-1">جلسه تمام شده</span>';
                                }
                            } else {
                                $postnestedData['detail'] .= '<td><a target="_blank" href="'.route('bbb.create',$bbb->id).'" class="btn bg-primary text-white m-1">شروع مصاحبه</a></td>';
                            }
                        }
                    }
                    if ($t) {
                        $postnestedData['detail'] .= '<button onclick="setIdBBB('.$post_val->id.')" type="button" class="btn btn-warning m-1" data-toggle="modal" data-target="#createBBB" class="btn btn-icon  btn-warning" data-toggle="tooltip" data-placement="bottom" title="ایجاد مصاحبه آنلاین"><i class="mdi mdi-microphone"></i> ایجاد مصاحبه آنلاین</button>';
                    }
                } else {
                    $postnestedData['detail'] .= '<button onclick="setIdBBB('.$post_val->id.')" type="button" class="btn btn-warning m-1" data-toggle="modal" data-target="#createBBB" class="btn btn-icon  btn-warning" data-toggle="tooltip" data-placement="bottom" title="ایجاد مصاحبه آنلاین"><i class="mdi mdi-microphone"></i> ایجاد مصاحبه آنلاین</button>';
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
