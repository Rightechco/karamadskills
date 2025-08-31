<?php

namespace Modules\Visit\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Common\Http\Services\Image\ImageService;
use Modules\University\Models\University;
use Modules\Visit\Http\Repositories\VisitRepo;
use Modules\Visit\Http\Requests\VisitRequest;
use Modules\Common\Http\Services\CommonServices;
use Modules\Visit\Http\Requests\VisitUpdateRequest;
use Modules\Visit\Http\Services\VisitService;
use Modules\Visit\Models\Visit;

class VisitController extends Controller
{
    public function visits()
    {
        return view('visit::panel.visits');
    }

    public function getVisits(Request $request)
    {
        return VisitRepo::getVisits($request);
    }

    public function visitCreate()
    {
        if (auth()->user()->can('VisitPermission') || auth()->user()->universities->count()) {
            if (auth()->user()->can('VisitPermission')) {
                $universities = University::query()->where('state', University::VAHED)->select('id', 'name')->get()->toArray();
            } else {
                $universities = University::query()->where('state', University::VAHED)->where(function ($query) {
                    $query->with('admins')->whereHas('admins', function ($q) {
                        $q->where('user_id', auth()->user()->id);
                    });
                })->select('id', 'name')->get()->toArray();
            }
            return view('visit::panel.create',compact('universities'));
        } else {
            $toasts = ['toast' => [
                [
                    'message' => 'دسترسی ندارید',
                    'alert-type' => 'error'
                ]
            ]];
            return back()->with($toasts);
        }
    }

    public function visitStore(VisitRequest $request,ImageService $imageService)
    {
        if (auth()->user()->can('VisitPermission') || auth()->user()->universities->count()) {
            $input = $request->validated();
            if ($request->des && str_contains($request->des, 'base64')) {
                $des = CommonServices::saveSummerNote($request->des,'visitDesImg');
                $input['des'] = $des;
            }
            if ($request->expert && str_contains($request->expert, 'base64')) {
                $expert = CommonServices::saveSummerNote($request->expert,'visitExpertImg');
                $input['expert'] = $expert;
            }

            if ($request->hasFile('image')) {
                $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'visitImage');
                $resulCover = $imageService->createIndexAndSave($request->file('image'));
                if ($resulCover === false) {
                    $toasts = ['toast' => [
                        [
                            'message' => 'ذخیره تصویر با خطا مواجه شد',
                            'alert-type' => 'error'
                        ]
                    ]];
                    return back()->with($toasts);
                }
            }
            $input['image'] = $resulCover ?? null;
            if ($request->hasFile('video')) {
                $video = $request->video;
                $vidName = time().'.'.$video->getClientOriginalExtension();
                $path = public_path().'/visitsVideos/';
                if(!is_dir($path)){
                    mkdir($path);
                }
                $video->move($path, $vidName);
                $input['video'] = '/visitsVideos/'.$vidName;
                unset($input['videoLink']);
            }
            $visit = VisitService::create($input);
            $toasts = ['toast' => [
                [
                    'message' => 'بازدید با موفقیت ایجاد شد، در انتظار تایید توسط پشتیبانی باشید',
                    'alert-type' => 'success'
                ]
            ]];
            return to_route('panel.visit.visits')->with($toasts);
        } else {
            $toasts = ['toast' => [
                [
                    'message' => 'دسترسی ندارید',
                    'alert-type' => 'error'
                ]
            ]];
            return back()->with($toasts);
        }
    }

    public function visitEdit(Visit $visit)
    {
        if (auth()->user()->can('VisitPermission') || in_array($visit->university_id,array_column(auth()->user()->universities->toArray(),'id'))) {
            if (auth()->user()->can('VisitPermission')) {
                $universities = University::query()->where('state', University::VAHED)->select('id', 'name')->get()->toArray();
            } else {
                $universities = University::query()->where('state', University::VAHED)->where(function ($query) {
                    $query->with('admins')->whereHas('admins', function ($q) {
                        $q->where('user_id', auth()->user()->id);
                    });
                })->select('id', 'name')->get()->toArray();
            }
            return view('visit::panel.edit',compact('universities','visit'));
        } else {
            $toasts = ['toast' => [
                [
                    'message' => 'دسترسی ندارید',
                    'alert-type' => 'error'
                ]
            ]];
            return back()->with($toasts);
        }
    }

    public function visitUpdate(Visit $visit,VisitUpdateRequest $request,ImageService $imageService)
    {
        if (auth()->user()->can('VisitPermission') || in_array($visit->university_id,array_column(auth()->user()->universities->toArray(),'id'))) {
            $input = $request->validated();
            if ($request->des && str_contains($request->des, 'base64')) {
                $des = CommonServices::saveSummerNote($request->des,'visitDesImg');
                $input['des'] = $des;
            }
            if ($request->expert && str_contains($request->expert, 'base64')) {
                $expert = CommonServices::saveSummerNote($request->expert,'visitExpertImg');
                $input['expert'] = $expert;
            }

            if ($request->hasFile('image')) {
                $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'visitImage');
                $resulCover = $imageService->createIndexAndSave($request->file('image'));
                if ($resulCover === false) {
                    $toasts = ['toast' => [
                        [
                            'message' => 'ذخیره تصویر با خطا مواجه شد',
                            'alert-type' => 'error'
                        ]
                    ]];
                    return back()->with($toasts);
                }
            }
            $input['image'] = $resulCover ?? null;
            if ($request->hasFile('video')) {
                $video = $request->video;
                $vidName = time().'.'.$video->getClientOriginalExtension();
                $path = public_path().'/visitsVideos/';
                if(!is_dir($path)){
                    mkdir($path);
                }
                $video->move($path, $vidName);
                $input['video'] = '/visitsVideos/'.$vidName;
                unset($input['videoLink']);
            }

            if(!auth()->user()->can('VisitPermission')) {
                $input['status'] = $visit::STATUS_WAIT;
            }

            $visit = VisitService::update($input,$visit);
            $toasts = ['toast' => [
                [
                    'message' => 'بازدید با موفقیت ویرایش، در انتظار تایید توسط پشتیبانی باشید',
                    'alert-type' => 'success'
                ]
            ]];
            return to_route('panel.visit.visits')->with($toasts);
        } else {
            $toasts = ['toast' => [
                [
                    'message' => 'دسترسی ندارید',
                    'alert-type' => 'error'
                ]
            ]];
            return back()->with($toasts);
        }
    }

    public function visitDelete(Visit $visit)
    {
        if (auth()->user()->can('VisitPermission') || in_array($visit->university_id,array_column(auth()->user()->universities->toArray(),'id'))) {
            $visit->delete();
            $toasts = ['toast' => [
                [
                    'message' => 'بازدید حذف شد',
                    'alert-type' => 'success'
                ]
            ]];
            return to_route('panel.visit.visits')->with($toasts);
        } else {
            $toasts = ['toast' => [
                [
                    'message' => 'دسترسی ندارید',
                    'alert-type' => 'error'
                ]
            ]];
            return back()->with($toasts);
        }
    }
}
