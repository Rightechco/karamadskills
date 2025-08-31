<?php

namespace Modules\Counselor\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Modules\BBB\Http\Services\BBBServices;
use Modules\Common\Http\Services\CommonServices;
use Modules\Counselor\Http\Repositories\CounselorRepo;
use Modules\Counselor\Http\Services\CounselorService;
use Modules\Counselor\Models\Counselor;
use Modules\Notif\Http\Services\NotifService;
use Modules\Notif\Models\Notif;
use Modules\Role\Models\Permission;
use Modules\User\Models\User;

class CounselorController extends Controller
{
    public function counselors()
    {
        $counselorPermission = Permission::query()->where('slug','Counselor')->first();
        return view('counselor::counselors',compact('counselorPermission'));
    }

    public function reserve(Request $request)
    {
        if (is_numeric($request->counselor)) {
            $counselor = User::query()->where('id',$request->counselor)->first();
            if ($counselor) {
                if($counselor->can('Counselor')) {
                    if(config()->has('tests.'.$request->type.'Name')) {
                        $price = isset($counselor->counselorPrice) ? $counselor->counselorPrice : config('tests.defaultCounselorPrice');
                        $counselorPrice = ($price*config('tests.'.$request->type.'x'))-(($price*config('tests.'.$request->type.'x'))*(config('tests.'.$request->type)/100));
                        $counselorRow = CounselorService::create(config('tests.'.$request->type.'Name'),auth()->user()->id,$counselor->id,$counselorPrice);
                        return CommonServices::pay($counselorPrice,route('panel.counselor.reserveBack',$counselorRow));
                    }
                }
            }
        }
    }

    public function reserveBack(Counselor $counselor,Request $request)
    {
        if ($request->Status == 'OK') {
            $verify = CommonServices::verify($counselor->price, $request->Authority);
            if ($verify) {
                $counselor->pay_id = $verify;
                $counselor->save();
                $toasts = ['toast' => [
                    [
                        'message' => 'جلسه مشاوره شما ثبت شد، به زودی مشاور زمان جلسات رو تعیین می کند',
                        'alert-type' => 'success'
                    ]
                ]];
                return to_route('panel.counselor.counselorsPanel')->with($toasts);
            } else {
                $toasts = ['toast' => [
                    [
                        'message' => 'پرداخت شما ناموفق بود! ; پرداخت شما طی 48 ساعت به حساب شما عودت داده می شود',
                        'alert-type' => 'error'
                    ]
                ]];
                return to_route('counselor.counselors')->with($toasts);
            }
        } else {
            $toasts = ['toast' => [
                [
                    'message' => 'پرداخت شما ناموفق بود! ; پرداخت شما طی 48 ساعت به حساب شما عودت داده می شود',
                    'alert-type' => 'error'
                ]
            ]];
            return to_route('counselor.counselors')->with($toasts);
        }
    }

    public function counselorsPanel()
    {
        return view('counselor::panel.counselors');
    }

    public function getCounselors(Request $request)
    {
        return CounselorRepo::getCounselors($request);
    }

    public function createMeet(Request $request)
    {
        $rules = array(
            'id' => 'required|numeric|exists:counselors,id',
            'date' => ['required','regex:/^\d+\/(0[1-9]|1[0-2])\/(0[1-9]|[12][0-9]|3[01])$/'],
            'time' => ['required','regex:/^(0?[0-9]|1[0-9]|2[0-4]):([0-5][0-9]|60)$/'],
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()):
            $toasts = ['toast' => [
                [
                    'message' => 'زمان جلسه را به درستی وارد کنید',
                    'alert-type' => 'error'
                ]
            ]];
            return back()->with($toasts);
        endif;
        $counselor = Counselor::query()->where('id',$request->id)->first();
        if ($counselor) {
            $bbb = BBBServices::create($counselor->id,'جلسه مشاوره '.$counselor->id,$counselor->counselor->slug,$counselor,false,CommonServices::pickerToDate($request->date));
            if ($bbb) {
                NotifService::sendSMS($counselor->user,0,Notif::EVERY_SECOND,'برای مشاوره شما در تاریخ '.$request->date.' ساعت '.$request->time.' جلسه ثبت شده است لطفا در زمان ذکر شده از طریق پنل کارآمد وارد جلسه شوید کارآمد');
                $toasts = ['toast' => [
                    [
                        'message' => 'جلسه ایجاد شد و به کاربر پیامک شد، در روز موردنظر می توانید جلسه را شروع کنید',
                        'alert-type' => 'success'
                    ]
                ]];
                return back()->with($toasts);
            } else {
                $toasts = ['toast' => [
                    [
                        'message' => 'ایجاد جلسه با مشکل رو به رو شد، لطفا با پشتیبانی در ارتباط باشید',
                        'alert-type' => 'error'
                    ]
                ]];
                return back()->with($toasts);
            }
        }
        abort(404);
    }
}
