<?php

namespace Modules\Request\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Modules\BBB\Http\Services\BBBServices;
use Modules\Common\Http\Services\CommonServices;
use Modules\Notif\Http\Services\NotifService;
use Modules\Notif\Models\Notif;
use Modules\Request\Http\Requests\RejectRequestRequest;
use Modules\Request\Models\Request as Rq;
use Modules\Announcement\Models\Announcement;
use Modules\Request\Http\Repositories\RequestRepo;
use Modules\Request\Http\Services\RequestService;

class RequestController extends Controller
{

    public function request($slug)
    {
        $announcement = Announcement::query()->where('slug',$slug)->where('status',Announcement::STATUS_VERIFIED)->first();
        if ($announcement) {
            if(auth()->user()->resume) {
                $usersTests = array_column(auth()->user()->tests->select('type')->toArray(),'type');
                if (!empty(json_decode($announcement->test,true)) && !empty(array_diff(json_decode($announcement->test,true),$usersTests))) {
                    $toasts = ['toast' => [
                        [
                            'message' => 'برای ارسال درخواست به این آگهی می بایست تمامی های تست های درخواست شده را گذارنده باشید',
                            'alert-type' => 'error'
                        ]
                    ]];
                    return to_route('announcement.announcement',$announcement->slug)->with($toasts);
                }
                NotifService::sendSMS($announcement->company->user,0,Notif::EVERY_SECOND,'یک درخواست استخدام برای آگهی '.$announcement->name.' ارسال شد کارآمد');
                $request = RequestService::create(auth()->user()->id, $announcement->id);
                $toasts = ['toast' => [
                    [
                        'message' => 'درخواست شما ارسال شد، منتظر پاسخ از طرف کارفرما باشید',
                        'alert-type' => 'success'
                    ]
                ]];
                return to_route('announcement.announcement',$announcement->slug)->with($toasts);
            } else {
                $toasts = ['toast' => [
                    [
                        'message' => 'درخواست شما ارسال نشد، می بایست ابتدا رزومه خود را از ناحیه کاربری ایجاد کنید',
                        'alert-type' => 'error'
                    ]
                ]];
                return to_route('announcement.announcement',$announcement->slug)->with($toasts);
            }
        } else {
            $toasts = ['toast' => [
                [
                    'message' => 'آگهی موردنظر یافت نشد',
                    'alert-type' => 'error'
                ]
            ]];
            return to_route('announcement.announcements')->with($toasts);
        }
    }

    public function requests()
    {
        return view('request::panel.requests');
    }

    public function getRequests(Request $request)
    {
        return RequestRepo::getRequests($request);
    }

    public function allRequests()
    {
        if(auth()->user()->announcements->count() || auth()->user()->can('RequestPermission')){
            return view('request::panel.allRequests');
        } else {
            $toasts = ['toast' => [
                [
                    'message' => 'عدم وجود دسترسی',
                    'alert-type' => 'error'
                ]
            ]];
            return to_route('panel')->with($toasts);
        }
    }

    public function getAllRequests(Request $request)
    {
        if(auth()->user()->announcements->count() || auth()->user()->can('RequestPermission')){
            return RequestRepo::getAllRequests($request);
        } else {
            abort('403');
        }
    }

    public function announcementRequests(Announcement $announcement)
    {
        if($announcement->company->user_id == auth()->user()->id || auth()->user()->can('RequestPermission')){
            return view('request::panel.announcementRequests',compact('announcement'));
        } else {
            $toasts = ['toast' => [
                [
                    'message' => 'عدم وجود دسترسی',
                    'alert-type' => 'error'
                ]
            ]];
            return to_route('panel')->with($toasts);
        }
    }

    public function getAnnouncementRequests(Request $request,Announcement $announcement)
    {
        if($announcement->company->user_id == auth()->user()->id || auth()->user()->can('RequestPermission')){
            return RequestRepo::getAnnouncementRequests($request,$announcement);
        } else {
            abort('403');
        }
    }

    public function interviewRequests(Rq $request)
    {
        if($request->announcement->company->user_id == auth()->user()->id || auth()->user()->can('RequestPermission')){
            $request->status = Rq::STATUS_INTERVIEW;
            NotifService::sendSMS($request->user,0,Notif::EVERY_MINUTE,'رزومه شما برای آگهی '.$request->announcement->name.' به وضعیت تایید برای مصاحبه تغییر یافت کارآمد');
            $request->save();
            $toasts = ['toast' => [
                [
                    'message' => 'وضعیت درخواست به در حال محاسبه تغییر یافت',
                    'alert-type' => 'info'
                ]
            ]];
            return back()->with($toasts);
        } else {
            $toasts = ['toast' => [
                [
                    'message' => 'عدم وجود دسترسی',
                    'alert-type' => 'error'
                ]
            ]];
            return to_route('panel')->with($toasts);
        }
    }

    public function hiredRequests(Rq $request)
    {
        if($request->announcement->company->user_id == auth()->user()->id || auth()->user()->can('RequestPermission')){
            $request->status = Rq::STATUS_HIRED;
            $request->save();
            $toasts = ['toast' => [
                [
                    'message' => 'وضعیت درخواست به استخدام شده تغییر یافت',
                    'alert-type' => 'info'
                ]
            ]];
            return back()->with($toasts);
        } else {
            $toasts = ['toast' => [
                [
                    'message' => 'عدم وجود دسترسی',
                    'alert-type' => 'error'
                ]
            ]];
            return to_route('panel')->with($toasts);
        }
    }

    public function rejectRequests(RejectRequestRequest $formRequest)
    {
        $request = Rq::query()->where('id',$formRequest->id)->first();
        if($request && ($request->announcement->company->user_id == auth()->user()->id || auth()->user()->can('RequestPermission'))){
            $request->status = Rq::STATUS_REJECTED;
            $request->rejectedText = $formRequest->rejectedText;
            $request->save();
            $text = $request->announcement->name.' به دلیل '.$formRequest->rejectedText;
            NotifService::sendSMS($request->user,0,Notif::EVERY_MINUTE,'درخواست شغلی شما برای آگهی '.$text.' رد شد karamad.msrt.ir');
            $toasts = ['toast' => [
                [
                    'message' => 'وضعیت درخواست به رد شده تغییر یافت و دلیل رد درخواست به کاربر پیامک شد',
                    'alert-type' => 'info'
                ]
            ]];
            return back()->with($toasts);
        } else {
            $toasts = ['toast' => [
                [
                    'message' => 'عدم وجود دسترسی',
                    'alert-type' => 'error'
                ]
            ]];
            return to_route('panel')->with($toasts);
        }
    }

    public function createMeet(Request $request)
    {
        $rules = array(
            'id' => 'required|numeric|exists:requests,id',
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
        $rq = Rq::query()->where('id',$request->id)->first();
        if ($rq) {
            if (config('tests.requestMeet') && !auth()->user()->can('RequestPermission')) {
                return CommonServices::pay(config('tests.requestMeet'),route('panel.request.storeMeet',['r' => $rq->id,'d' => $request->date,'t' => $request->time]));
            } else {
                return to_route('panel.request.storeMeet',['r' => $rq->id,'d' => $request->date,'t' => $request->time]);
            }
        }
        abort(404);
    }

    public function storeMeet(Request $request)
    {
        if ($request->Status == 'OK' || auth()->user()->can('RequestPermission')) {
            $rq = Rq::query()->where('id',$request->r)->first();
            if ($rq) {
                $bbb = BBBServices::create($rq->id,'جلسه مصاحبه '.$rq->id,$rq->announcement->slug,$rq,false,CommonServices::pickerToDate($request->d));
                if ($bbb) {
                    $verify = CommonServices::verify(config('tests.requestMeet'), $request->Authority);
                    if ($verify || auth()->user()->can('RequestPermission')) {
                        NotifService::sendSMS($rq->user,0,Notif::EVERY_MINUTE,'یک وقت مصاحبه برای آگهی '.$rq->announcement->name.' شما در تاریخ '.$request->d.' ساعت '.$request->t.' ثبت شده است لطفا در زمان ذکر شده از طریق پنل کارآمد وارد جلسه مصاحبه شوید کارآمد');
                        $toasts = ['toast' => [
                            [
                                'message' => 'جلسه ایجاد و به کاربر اطلاع داده شد، در روز و ساعت تعیین شده اقدام به شروع جلسه نمائید',
                                'alert-type' => 'success'
                            ]
                        ]];
                        return to_route('panel.request.allRequests')->with($toasts);
                    }
                }
            }
        }
        $toasts = ['toast' => [
            [
                'message' => 'خطایی رخ داده است! ; پرداخت شما طی 48 ساعت به حساب شما عودت داده می شود',
                'alert-type' => 'error'
            ]
        ]];
        return to_route('panel.request.allRequests')->with($toasts);
    }

}
