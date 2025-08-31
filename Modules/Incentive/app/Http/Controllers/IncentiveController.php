<?php

namespace Modules\Incentive\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;
use Modules\File\Http\Services\FileService;
use Modules\Incentive\Http\Exports\IncentiveExport;
use Modules\Incentive\Http\Repositories\IncentiveRepo;
use Modules\Incentive\Http\Requests\IncentiveRequest;
use Modules\Incentive\Http\Services\IncentiveService;
use Modules\Incentive\Models\Incentive;
use Modules\User\Models\User;

class IncentiveController extends Controller
{
    public function incentives()
    {
        return view('incentive::incentives');
    }

    public function incentivesPanel()
    {
        return view('incentive::panel.incentives');
    }

    public function getIncentives(Request $request)
    {
        return IncentiveRepo::getIncentives($request);
    }

    public function incentiveCreate()
    {
        if (auth()->user()->incentives->count()) {
            $toasts = ['toast' => [
                [
                    'message' => 'تنها یک مشوق می توانید ثبت کنید',
                    'alert-type' => 'error'
                ]
            ]];
            return back()->with($toasts);
        } else {

                if (is_null(auth()->user()->university_id)) {
                    $toasts = ['toast' => [
                        [
                            'message' => 'ابتدا دانشگاه خود را انتخاب کنید',
                            'alert-type' => 'error'
                        ]
                    ]];
                    return to_route('panel.user.profile')->with($toasts);
                } else {
                    return view('incentive::panel.create');
                }

        }
    }

    public function incentiveStore(IncentiveRequest $request)
    {
        if (auth()->user()->incentives->count()) {
            $toasts = ['toast' => [
                [
                    'message' => 'تنها یک مشوق می توانید ثبت کنید',
                    'alert-type' => 'error'
                ]
            ]];
            return back()->with($toasts);
        } else {

                if (is_null(auth()->user()->university_id)) {
                    $toasts = ['toast' => [
                        [
                            'message' => 'ابتدا دانشگاه خود را انتخاب کنید',
                            'alert-type' => 'error'
                        ]
                    ]];
                    return to_route('panel.user.profile')->with($toasts);
                } else {
                    $input = $request->validated();
                    $incentive = IncentiveService::create(auth()->user());
                    $incentiveJson = [];
                    for ($i=0;$i<count($input['name']);$i++) {
                        $incentiveJson[] = [
                            'name' => $input['name'][$i],
                            'time' => $input['time'][$i],
                            'location' => $input['location'][$i],
                            'type' => $input['type'][$i],
                            'unit' => $input['unit'][$i],
                            'file' => FileService::save('incentiveFiles', $input['file'][$i],$incentive,$input['name'][$i]),
                            'status' => 0
                        ];
                    }
                    IncentiveService::addIncentive($incentive,json_encode($incentiveJson,JSON_UNESCAPED_UNICODE));
                    $toasts = ['toast' => [
                        [
                            'message' => 'مشوق شما با موفقیت ثبت شد، در انتظار تاییدیه باشید',
                            'alert-type' => 'success'
                        ]
                    ]];
                    return to_route('panel.incentive.incentives')->with($toasts);
                }

        }
    }

    public function apiNotify(Request $request)
    {
        if (isset($request->nationalNumber) && strlen($request->nationalNumber) == 10){
            $user = User::query()->where('nationalCode',$request->nationalNumber)->first();
            if ($user) {
                $incentive = Incentive::query()->where('user_id',$user->id)->where('status',Incentive::STATUS_FINISH)->first();
                if ($incentive) {
                    $type1 = $type2 = $type3 = $type4 = $type5 = $type6 = 0;
                    if ($incentive->incentive) {
                        foreach (json_decode($incentive->incentive, true) as $key => $inc) {
                            if ($inc['status'] == 1) {
                                ${"type" . $inc['type']} += (isset($inc['type']) && $inc['type'] == 6) ? $inc['unit'] * 5 : get_point_incentive($inc['type'], $inc['time']);
                            }
                        }
                    }
                    if ($type1 > 100) { $type1 = 100; }
                    if ($type2 > 40) { $type2 = 40; }
                    if ($type3 > 40) { $type3 = 40; }
                    if ($type4 > 60) { $type4 = 60; }
                    if ($type5 > 40) { $type5 = 40; }
                    if ($type6 > 50) { $type6 = 50; }
                    return response()->json([
                        'statusCode' => 200,
                        'message' => 'ok',
                        'data' => [
                            'nationalNumber' => $user->nationalCode,
                            'mobileNumber' => $user->mobile,
                            'firstName' => $user->name,
                            'lastName' => $user->name,
                            'request_id' => $request->request_id,
                            'PROFICIENCY' => $type1,
                            'GENERAL_SKILL' => $type2,
                            'RESEARCH_ASSISTANT_RECORD' => $type3,
                            'SPECIALIZED_LABORATORY_RECORD' => $type4,
                            'INSTRUCT_RECORD' => $type5,
                            'CREATION_TIME' => verta($user->created_at)->format('Y-m-d'),
                            'LAST_UPDATE_TIME' => verta($incentive->created_at)->format('Y-m-d'),
                        ]
                    ]);
                }
            }
        }
        return response()->json([
            'statusCode' => 204,
            'message' => 'شخص در سامانه داده ای ندارد',
            'data' => null
        ]);
    }

    public function apiInform(Request $request)
    {
        if (isset($request->nationalNumber) && strlen($request->nationalNumber) == 10) {
            $user = User::query()->where('nationalCode', $request->nationalNumber)->first();
            if (!$user) {
                $rules = array(
                    'nationalNumber' => ['required','digits:10','unique:users,nationalCode'],
                    'mobileNumber' => ['required','numeric','regex:/(0|\+98)?([ ]|-|[()]){0,2}9[0-9]([ ]|-|[()]){0,2}(?:[0-9]([ ]|-|[()]){0,2}){8}/'],
                    'firstName' => 'required|string|min:1|max:3000',
                    'lastName' => 'required|string|min:1|max:3000',
                    'request_id' => 'required|numeric|min:1',
                    'PROFICIENCY' => 'required|numeric|min:1|max:100',
                    'GENERAL_SKILL' => 'required|numeric|min:1|max:100',
                    'RESEARCH_ASSISTANT_RECORD' => 'required|numeric|min:1|max:100',
                    'SPECIALIZED_LABORATORY_RECORD' => 'required|numeric|min:1|max:100',
                    'INSTRUCT_RECORD' => 'required|numeric|min:1|max:100',
                    'CREATION_TIME' => 'required|date',
                    'LAST_UPDATE_TIME' => 'required|date',
                );

                $validator = Validator::make($request->all(), $rules);

                if ($validator->fails()):
                    return response()->json([
                        'statusCode' => 204,
                        'message' => 'خطا در ورودی ها',
                        'data' => $validator->errors()
                    ]);
                endif;
                $user = User::query()->create([
                    'mobile' => $request->mobileNumber,
                    'nationalCode' => $request->nationalNumber,
                    'name' => $request->firstName.' '.$request->lastName
                ]);
                Incentive::query()->create([
                    'user_id' => $user->id,
                    'score' => ($request->PROFICIENCY+$request->GENERAL_SKILL+$request->RESEARCH_ASSISTANT_RECORD+$request->SPECIALIZED_LABORATORY_RECORD+$request->INSTRUCT_RECORD),
                ]);
                return response()->json([
                    'statusCode' => 200,
                    'message' => 'ok',
                    'data' => [
                        'nationalNumber' => $request->nationalNumber,
                        'mobileNumber' => $request->mobileNumber,
                        'firstName' => $request->firstName,
                        'lastName' => $request->lastName,
                        'request_id' => $request->request_id,
                        'PROFICIENCY' => $request->PROFICIENCY,
                        'GENERAL_SKILL' => $request->GENERAL_SKILL,
                        'RESEARCH_ASSISTANT_RECORD' => $request->RESEARCH_ASSISTANT_RECORD,
                        'SPECIALIZED_LABORATORY_RECORD' => $request->SPECIALIZED_LABORATORY_RECORD,
                        'INSTRUCT_RECORD' => $request->INSTRUCT_RECORD,
                        'CREATION_TIME' => $request->CREATION_TIME,
                        'LAST_UPDATE_TIME' => $request->LAST_UPDATE_TIME,
                    ]
                ]);
            }
        }
        return response()->json([
            'statusCode' => 204,
            'message' => 'شخص قبلا مشوقی ثبت کرده است',
            'data' => null
        ]);
    }

    public function getExcel()
    {
        return Excel::download(new IncentiveExport,'incentives.xlsx');
    }

    public function getIncentive(Incentive $incentive)
    {
        $userUnis = array_column(auth()->user()->universities->select('id')->toArray(),'id');
        if(auth()->user()->can('IncentivePermission') ||
            in_array($incentive->type_id,$userUnis) ||
            in_array($incentive->ostan_id,$userUnis) ||
            in_array($incentive->university_id,$userUnis)) {
            $string = '<ul class="row w-100 mx-0 justify-content-between" style="list-style: none">';
            $string .= '<li class="col-12 col-sm-5 p-2" style="background-color: var(--gray-100);border-radius: var(--radius)"><p>نام کاربر: ' . $incentive->user->name . '</p></li>';
            if ($incentive->user->pic) {
                $string .= '<li class="col-12 col-sm-2"><img class="w-100 h-100" class="user-avatar" src = "'.route('user.avatarShow',[$incentive->user->pic,'userAvatar']) .'" alt = "تصویر کاربر" title = "'. $incentive->user->name .'" ></li>';
            } else {
                $string .= '<li class="col-12 col-sm-2"><img class="w-100 h-100" class="user-avatar" src = "'. asset('assets/images/users/user-1.jpg') .'" alt = "تصویر کاربر" title = "'. $incentive->user->name .'" ></li>';
            }
            $string .= '<li class="col-12 col-sm-5 p-2" style="background-color: var(--gray-100);border-radius: var(--radius)"><p>کد ملی: '.$incentive->user->nationalCode ?? 1 .'</p></li>';
            $allPoint = 0;
            foreach (json_decode($incentive->incentive,true) as $key => $inc) {
                if ($inc['status'] == 1) {
                    $string .= '<li class="col-12 my-2 row mx-0 p-2" style="background-color: lightgreen;border-radius: var(--radius)">';
                } elseif ($inc['status'] == 2) {
                    $string .= '<li class="col-12 my-2 row mx-0 p-2" style="background-color: lightpink;border-radius: var(--radius)">';
                } else {
                    $string .= '<li class="col-12 my-2 row mx-0 p-2" style="background-color: var(--gray-100);border-radius: var(--radius)">';
                }
                $string .= '<div class="col-12 col-sm-9 row mx-0 justify-content-between">';
                $string .= '<div class="col-12 col-sm-6 my-1">'.'نام دوره یا مهارت: '.$inc['name'].'</div>';
                $string .= '<div class="col-12 col-sm-6 my-1">'.'مدت زمان دوره: '.$inc['time'].'</div>';
                $string .= '<div class="col-12 col-sm-6 my-1">'.' محل: '.$inc['location'].'</div>';
                $string .= '<div class="col-12 col-sm-6 my-1">'.' مدرک: '.'<a href="'. route('panel.file.incentiveFileShow',$inc['file']) .'" target="_blank" class="text-black"><i class="fe-file text-black"></i></a>'.'</div>';
                $string .= '<div class="col-12 col-sm-6 my-1">'.' نوع مهارت: '.get_type_incentive($inc['type']).'</div>';
                if ($inc['unit'])
                    $string .= '<div class="col-12 col-sm-6 my-1">'.'تعداد واحد: '.$inc['unit'].'</div>';
                $string .= '</div>';
                $string .= '<div class="col-12 col-sm-3 d-flex flex-column mx-0 justify-content-between">';
                $point = (isset($inc['type']) && $inc['type'] == 6) ? $inc['unit']*5 : get_point_incentive($inc['type'],$inc['time']);
                if ($inc['status'] == 1) {
                    $allPoint += $point;
                }
                $string .= '<span class="text-center">امتیاز در صورت تایید: '.$point.'</span>';
                $string .= '<button type="submit" class="btn btn-success" ll="'.route('panel.incentive.getIncentive',$incentive->id).'" lll="'. route('panel.incentive.incentiveAcceptItem',[$incentive,$key]).'" onclick="confirmItem(this)">تایید</button>';
                $string .= '<button type="submit" class="btn btn-danger" ll="'.route('panel.incentive.getIncentive',$incentive->id).'" lll="'. route('panel.incentive.incentiveRejectItem',[$incentive,$key]).'" onclick="rejectItem(this)">رد</button>';
                $string .= '</div>';
                $string .= '</li>';
            }
            $string .= '<li class="col-12 my-2 row mx-0 p-2" style="background-color: var(--gray);border-radius: var(--radius)">';
            $string .= '<form ll="'.route('panel.incentive.getIncentive',$incentive->id).'" id="formInc" onsubmit="formInc(event)" class="w-100 row mx-0" method="post" action="'. route('panel.incentive.incentiveStatusChange',$incentive->id).'">';
            $string .= '<input type="hidden" name="_token" value="'.csrf_token().'">';
            $string .= '<input type="hidden" name="id" value="'.$incentive->id.'">';
            $string .= '<div class="col-12 col-ms-3 col-lg-3 my-1">
                            <label for="score">امتیاز</label>
                            <input type="number" name="score" class="form-control" id="score" value="'.$allPoint.'">
                        </div>
                        <div class="col-12 col-ms-9 col-lg-9 my-1">
                            <label for="meeting">جلسه حضوری</label>
                            <input type="text" name="meeting" class="form-control" id="meeting" placeholder="مثلا: روز دوشنبه ساعت ۱۶ بخش تحصیلات تکمیلی دانشگاه مغان" value="'.$incentive->meeting.'">
                        </div>
                        <div class="col-12 col-ms-9 col-lg-9 my-1">
                            <label for="reject">دلیل رد درخواست</label>
                            <input type="text" name="reject" class="form-control" id="reject" placeholder="مثلا: کافی نبودن مدارک" value="'.$incentive->reject.'">
                        </div>';
            $string .= '<div class="col-12 col-ms-3 col-lg-3 my-1">
                        <label for="statusI">وضعیت</label><span class="text-danger">*</span>
                        <select class="form-control w-100 select2" id="statusI" name="status">
                            <option selected value="'.$incentive->status.'">'.$incentive->nameStatus().'</option>
                            <option value="'.Incentive::STATUS_MEETING.'">جلسه حضوری</option>
                            <option value="'.Incentive::STATUS_WAIT.'">در دست بررسی</option>
                            <option value="'.Incentive::STATUS_REJECT.'">رد درخواست</option>';
            if(auth()->user()->can('IncentivePermission') ){
                $string .= '<option value="'.Incentive::STATUS_FINISH.'">تایید وزارت</option>';
            }
            if (in_array($incentive->type_id,$userUnis)) {
                $string .= '<option value="'.Incentive::STATUS_TYPE.'">تایید کشوری</option>';
            }
            if (in_array($incentive->ostan_id,$userUnis)) {
                $string .= '<option value="'.Incentive::STATUS_OSTAN.'">تایید مرکز استان</option>';
            }
            if (in_array($incentive->university_id,$userUnis)) {
                $string .= '<option value="'.Incentive::STATUS_VAHED.'">تایید دانشگاه</option>';
            }
            $string .=  '</select>
                        </div>
                        <p class="w-100 my-1 text-warning"><i class="mdi mdi-alert"></i> در صورت انتخاب وضعیت جلسه، فیلد جلسه حضوری را پر کنید</p>
                        <p class="w-100 my-1 text-warning"><i class="mdi mdi-alert"></i> در صورت انتخاب وضعیت رد درخواست، فیلد دلیل را پر کنید</p>
                        <button type="submit" class="btn btn-primary col-12 mt-3">ثبت</button>';
            $string .= '</form>';
            $string .= '</li>';
            $string .= '</ul>';
            return $string;
        } else {
            return 'عدم دسترسی';
        }
    }

    public function incentiveAcceptItem(Incentive $incentive,$id)
    {
        $inc = json_decode($incentive->incentive,true);
        $inc[$id]['status'] = 1;
        $incentive->incentive = json_encode($inc,JSON_UNESCAPED_UNICODE);
        $incentive->save();
        return 'تایید شد';
    }

    public function incentiveRejectItem(Incentive $incentive,$id)
    {
        $inc = json_decode($incentive->incentive,true);
        $inc[$id]['status'] = 2;
        $incentive->incentive = json_encode($inc,JSON_UNESCAPED_UNICODE);
        $incentive->save();
        return 'رد شد';
    }

    public function incentiveStatusChange(Request $request,Incentive $incentive) {
        $rules = array(
            'id' => 'required|numeric|exists:incentives,id',
            'score' => 'nullable|numeric|max:3000',
            'meeting' => 'nullable|string|min:1|max:3000',
            'reject' => 'nullable|string|min:1|max:3000',
            'status' => ['required',Rule::in(Incentive::$statuses)],
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()):
            $toasts = ['toast' => [
                [
                    'message' => 'ورودی نادرست',
                    'alert-type' => 'error'
                ]
            ]];
            return back()->with($toasts);
        endif;
        $userUnis = array_column(auth()->user()->universities->select('id')->toArray(),'id');
        if(auth()->user()->can('IncentivePermission') ||
            in_array($incentive->type_id,$userUnis) ||
            in_array($incentive->ostan_id,$userUnis) ||
            in_array($incentive->university_id,$userUnis)) {
            $incentive->score = $request->score ?? null;
            $incentive->meeting = $request->meeting ?? null;
            $incentive->reject = $request->reject ?? null;
            $incentive->status = $request->status;
            $incentive->save();
            return 'با موفقیت ویرایش شد';
        }
    }

    public function incentiveEdit(Incentive $incentive)
    {
        $userUnis = array_column(auth()->user()->universities->select('id')->toArray(),'id');
        if(auth()->user()->can('IncentivePermission') ||
            in_array($incentive->type_id,$userUnis) ||
            in_array($incentive->ostan_id,$userUnis) ||
            in_array($incentive->university_id,$userUnis) ||
            $incentive->user->id = auth()->user()->id) {
            return view('incentive::panel.edit',compact('incentive'));
        }
        abort(403);
    }

    public function incentiveUpdate(IncentiveRequest $request,Incentive $incentive)
    {
        $userUnis = array_column(auth()->user()->universities->select('id')->toArray(),'id');
        if(auth()->user()->can('IncentivePermission') ||
            in_array($incentive->type_id,$userUnis) ||
            in_array($incentive->ostan_id,$userUnis) ||
            in_array($incentive->university_id,$userUnis) ||
            $incentive->user->id = auth()->user()->id) {
            $input = $request->validated();
            $oldJson = json_decode($incentive->incentive, true);
            $incentiveJson = [];
            for ($i = 0; $i < count($input['name']); $i++) {
                $incentiveJson[] = [
                    'name' => $input['name'][$i],
                    'time' => $input['time'][$i],
                    'location' => $input['location'][$i],
                    'type' => $input['type'][$i],
                    'unit' => $input['unit'][$i],
                    'file' => (isset($input['file'][$i])) ? FileService::save('incentiveFiles', $input['file'][$i], $incentive, $input['name'][$i]) : $oldJson[$i]['file'],
                    'status' => (isset($oldJson[$i]['status']) && $oldJson[$i]['status'] == 1) ? 1 : 0
                ];
            }
            IncentiveService::updateIncentive($incentive, json_encode($incentiveJson, JSON_UNESCAPED_UNICODE));
            $toasts = ['toast' => [
                [
                    'message' => 'مشوق شما با موفقیت ثبت شد، در انتظار تاییدیه باشید',
                    'alert-type' => 'success'
                ]
            ]];
            return to_route('panel.incentive.incentives')->with($toasts);
        }
        abort(403);
    }

    public function incentiveDelete(Incentive $incentive)
    {
        $userUnis = array_column(auth()->user()->universities->select('id')->toArray(),'id');
        if(auth()->user()->can('IncentivePermission') ||
            in_array($incentive->type_id,$userUnis) ||
            in_array($incentive->ostan_id,$userUnis) ||
            in_array($incentive->university_id,$userUnis)) {
            $incentive->delete();
            $toasts = ['toast' => [
                [
                    'message' => 'مشوق حذف شد',
                    'alert-type' => 'success'
                ]
            ]];
            return to_route('panel.incentive.incentives')->with($toasts);
        }
        abort(403);
    }
}
