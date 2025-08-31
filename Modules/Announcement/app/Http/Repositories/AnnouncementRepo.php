<?php

namespace Modules\Announcement\Http\Repositories;

use Modules\Announcement\Models\Announcement;

class AnnouncementRepo
{
    public static function announcementsMore($request)
    {
        $announcements = new Announcement();
        $announcements = $announcements->query()->where('status',Announcement::STATUS_VERIFIED);
        if ($request->req['s']){
            $announcements = $announcements->where('name','like','%'.$request->req['s'].'%');
        }
        if ($request->req['ostan']){
            $announcements = $announcements->where('ostan_id',$request->req['ostan']);
        }
        if ($request->req['gender']){
            $announcements = $announcements->where('gender',$request->req['gender']);
        }
        if(!empty($request->req['jobType'])) {
            if (count($request->req['jobType']) == 1) {
                $announcements = $announcements->where('jobType','like','%'.$request->req['jobType'][0].'%');
            } else {
                $announcements = $announcements->where(function($query) use ($request){
                    $query = $query->where('jobType','like','%'.$request->req['jobType'][0].'%');
                    for ($i= 1;$i<count($request->req['jobType']);$i++){
                        $query = $query->orWhere('jobType','like','%'.$request->req['jobType'][$i].'%');
                    }
                });
            }
        }
        $num = $request->num*10;
        $announcements = $announcements->skip($num)->take(10)->orderBy('id','DESC')->get();
        $string = '';
        if($announcements->count()) {
            foreach ($announcements as $announcement) {
                $string .= '<div class="test-pages__box modern-shadow">
                    <div class="test-pages__box-text">
                        <h2>' . $announcement->name . '</h2>
                        <div class="advertisements-box-info">
                            <div class="d-flex gap-2">
                                <span>نام شرکت:</span>
                                <span>' . $announcement->company->name . '</span>
                            </div>
                            <div class="d-flex gap-2">
                                <span>تاریخ آگهی:</span>
                                <span>' . verta($announcement->created_at)->formatDifference() . '</span>
                            </div>
                            <div class="d-flex gap-2">
                                <span>نوع همکاری:</span>
                                <span>';
                foreach (json_decode($announcement->jobType, true) as $jobType) {
                    $string .= __("messages." . $jobType) . ', ';
                }
                $string .= '</span>
                            </div>
                            <div class="d-flex gap-2">
                                <span>حقوق پرداختی:</span>
                                <span>' . $announcement->wage . ' میلیون تومان</span>
                            </div>
                            <div class="d-flex gap-2">
                                <span>شهر:</span>
                                <span>' . $announcement->shahrestan->name . '</span>
                            </div>
                        </div>
                    </div>
                    <div class="test-pages__box-image">';
                if ($announcement->company->logo) {
                    $string .= '<img src="' . asset($announcement->company->logo["indexArray"][$announcement->company->logo["currentImage"]]) . '" alt="company logo"/>';
                } else {
                    $string .= '<img src="' . asset("assets-front/img/resume.png") . '" alt="company logo"/>';
                }
                $string .= '</div>
                    <div class="send-resume-btn">
                        <a href="'. route('announcement.announcement',$announcement->slug).'">ارسال رزومه</a>
                    </div>
                </div>';
            }
            return $string;
        } else {
            return false;
        }
    }

    public static function intershipsMore($request)
    {
        $announcements = new Announcement();
        $announcements = $announcements->query()->where('status',Announcement::STATUS_VERIFIED)->where('universityIntership',true);
        if ($request->req['s']){
            $announcements = $announcements->where('name','like','%'.$request->req['s'].'%');
        }
        if ($request->req['ostan']){
            $announcements = $announcements->where('ostan_id',$request->req['ostan']);
        }
        if ($request->req['gender']){
            $announcements = $announcements->where('gender',$request->req['gender']);
        }
        if(!empty($request->req['jobType'])) {
            if (count($request->req['jobType']) == 1) {
                $announcements = $announcements->where('jobType','like','%'.$request->req['jobType'][0].'%');
            } else {
                $announcements = $announcements->where(function($query) use ($request){
                    $query = $query->where('jobType','like','%'.$request->req['jobType'][0].'%');
                    for ($i= 1;$i<count($request->req['jobType']);$i++){
                        $query = $query->orWhere('jobType','like','%'.$request->req['jobType'][$i].'%');
                    }
                });
            }
        }
        $num = $request->num*10;
        $announcements = $announcements->skip($num)->take(10)->orderBy('id','DESC')->get();
        $string = '';
        if($announcements->count()) {
            foreach ($announcements as $announcement) {
                $string .= '<div class="test-pages__box modern-shadow">
                    <div class="test-pages__box-text">
                        <h2>' . $announcement->name . '</h2>
                        <div class="advertisements-box-info">
                            <div class="d-flex gap-2">
                                <span>نام شرکت:</span>
                                <span>' . $announcement->company->name . '</span>
                            </div>
                            <div class="d-flex gap-2">
                                <span>تاریخ آگهی:</span>
                                <span>' . verta($announcement->created_at)->formatDifference() . '</span>
                            </div>
                            <div class="d-flex gap-2">
                                <span>نوع همکاری:</span>
                                <span>';
                foreach (json_decode($announcement->jobType, true) as $jobType) {
                    $string .= __("messages." . $jobType) . ', ';
                }
                $string .= '</span>
                            </div>
                            <div class="d-flex gap-2">
                                <span>حقوق پرداختی:</span>
                                <span>' . $announcement->wage . ' میلیون تومان</span>
                            </div>
                            <div class="d-flex gap-2">
                                <span>شهر:</span>
                                <span>' . $announcement->shahrestan->name . '</span>
                            </div>
                        </div>
                    </div>
                    <div class="test-pages__box-image">';
                if ($announcement->company->logo) {
                    $string .= '<img src="' . asset($announcement->company->logo["indexArray"][$announcement->company->logo["currentImage"]]) . '" alt="company logo"/>';
                } else {
                    $string .= '<img src="' . asset("assets-front/img/resume.png") . '" alt="company logo"/>';
                }
                $string .= '</div>
                    <div class="send-resume-btn">
                        <a href="'. route('announcement.announcement',$announcement->slug).'">ارسال رزومه</a>
                    </div>
                </div>';
            }
            return $string;
        } else {
            return false;
        }
    }
    public static function getAnnouncements($request)
    {
        $columns_list = array(
            0 => 'id',
            1 => 'status',
            2 => 'name',
            3 => 'company',
            4 => 'shahrestan',
            5 => 'gender',
            6 => 'jobType',
            7 => 'detail',
        );
        $linkObj = new Announcement();
        if (!auth()->user()->can('AnnouncementPermission')){
            $linkObj = $linkObj->where(function ($query) {
                $query->with('company')->whereHas('company', function ($q) {
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

            $post_data = $linkObj->where(function ($query) use ($search_text) {
                $query->where('id', 'Like', "%{$search_text}%")
                    ->orWhere('name', 'Like', "%{$search_text}%")
                    ->orWhere('des', 'Like', "%{$search_text}%")
                    ->orWhere(function ($query) use ($search_text) {
                        $query->with('shahrestan')->whereHas('shahrestan', function ($q) use ($search_text) {
                            $q->where('name','Like', "%{$search_text}%");
                        });
                    })
                    ->orWhere(function ($query) use ($search_text) {
                        $query->with('company')->whereHas('company', function ($q) use ($search_text) {
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
                        ->orWhere('des', 'Like', "%{$search_text}%")
                        ->orWhere(function ($query) use ($search_text) {
                            $query->with('shahrestan')->whereHas('shahrestan', function ($q) use ($search_text) {
                                $q->where('name','Like', "%{$search_text}%");
                            });
                        })
                        ->orWhere(function ($query) use ($search_text) {
                            $query->with('company')->whereHas('company', function ($q) use ($search_text) {
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
                $postnestedData['company'] = $post_val->company->name ?? '-';
                $postnestedData['shahrestan'] = $post_val->shahrestan->name ?? '-';
                $postnestedData['gender'] = ($post_val->gender) ? __('messages.'.$post_val->gender) : 'فرقی نمی کند';
                $jobTypes = json_decode($post_val->jobType,true);
                foreach ($jobTypes as $jobType) {
                    $jobs[] = __('messages.'.$jobType);
                }
                $postnestedData['jobType'] = implode(',',$jobs);
                $jobs = [];
                $postnestedData['detail'] = '<td>
                                <a class="btn btn-icon btn-info mx-1" href="' . route('panel.request.announcementRequests', $post_val) . '" data-toggle="tooltip" data-placement="bottom" title="درخواست ها"><i class="mdi mdi-briefcase-search "></i></a>';
                $postnestedData['detail'] .= '<a class="btn btn-icon btn-primary mx-1" href="' . route('panel.announcement.announcementsEdit', $post_val->id) . '" data-toggle="tooltip" data-placement="bottom" title="ویرایش"><i class="fas fa-edit"></i></a>';
                if ($post_val->status == Announcement::STATUS_VERIFIED) {
                    $postnestedData['detail'] .= '<a onClick="sweetConfirm(event)" class="btn btn-icon btn-danger mx-1" href="' . route('panel.announcement.announcementsStop', $post_val->id) . '" data-toggle="tooltip" data-placement="bottom" title="توقف آگهی"><i class="far fa-stop-circle"></i></a>';
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
