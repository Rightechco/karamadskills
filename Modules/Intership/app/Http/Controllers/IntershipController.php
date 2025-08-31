<?php

namespace Modules\Intership\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File as Fi;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Modules\Announcement\Models\Announcement;
use Modules\Intership\Http\Repositories\IntershipRepo;
use Modules\Intership\Http\Services\IntershipService;
use Modules\Intership\Models\Intership;
use Modules\Notif\Http\Services\NotifService;
use Modules\Notif\Models\Notif;
use Modules\Request\Http\Requests\RejectRequestRequest;
use Nette\FileNotFoundException;

class IntershipController extends Controller
{
    public function intership($slug)
    {
        $announcement = Announcement::query()->where('slug',$slug)->where('status',Announcement::STATUS_VERIFIED)->first();
        if ($announcement) {
            if (auth()->user()->university_id) {
                if (auth()->user()->resume) {
                    $usersTests = array_column(auth()->user()->tests->select('type')->toArray(), 'type');
                    if (!empty(json_decode($announcement->test, true)) && !empty(array_diff(json_decode($announcement->test, true), $usersTests))) {
                        $toasts = ['toast' => [
                            [
                                'message' => 'برای ارسال درخواست به این آگهی می بایست تمامی های تست های درخواست شده را گذارنده باشید',
                                'alert-type' => 'error'
                            ]
                        ]];
                        return to_route('announcement.intership', $announcement->slug)->with($toasts);
                    }
                    NotifService::sendSMS($announcement->company->user, 0, Notif::EVERY_SECOND, 'یک درخواست کارآموزی دانشگاه برای آگهی ' . $announcement->name . ' ارسال شد کارآمد');
                    $request = IntershipService::create(auth()->user()->id, $announcement->id);
                    $toasts = ['toast' => [
                        [
                            'message' => 'درخواست شما ارسال شد، منتظر پاسخ از طرف کارفرما باشید',
                            'alert-type' => 'success'
                        ]
                    ]];
                    return to_route('announcement.intership', $announcement->slug)->with($toasts);
                } else {
                    $toasts = ['toast' => [
                        [
                            'message' => 'درخواست شما ارسال نشد، می بایست ابتدا رزومه خود را از ناحیه کاربری ایجاد کنید',
                            'alert-type' => 'error'
                        ]
                    ]];
                    return to_route('announcement.intership', $announcement->slug)->with($toasts);
                }
            } else {
                $toasts = ['toast' => [
                    [
                        'message' => 'ابتدا از پنل کاربری دانشگاه خود را انتخاب کنید',
                        'alert-type' => 'error'
                    ]
                ]];
                return to_route('announcement.intership', $announcement->slug)->with($toasts);
            }
        } else {
            $toasts = ['toast' => [
                [
                    'message' => 'آگهی موردنظر یافت نشد',
                    'alert-type' => 'error'
                ]
            ]];
            return to_route('announcement.intership')->with($toasts);
        }
    }

    public function interships()
    {
        return view('intership::panel.interships');
    }

    public function getInterships(Request $request)
    {
        return IntershipRepo::getInterships($request);
    }

    public function companyAccept(Intership $intership)
    {
        if ($intership->status == Intership::STATUS_WAIT || auth()->user()->can('IntershipPermission')) {
            if($intership->announcement->company->user_id == auth()->user()->id || auth()->user()->can('IntershipPermission')){
                $intership->status = Intership::STATUS_COMPANY_ACCEPT;
                $intership->save();
                NotifService::sendSMS($intership->user->mobile,0,Notif::EVERY_SECOND,'درخواست کارآموزی شما توسط شرکت تایید به دانشگاه ارسال شد، کارآمد');
                $toasts = ['toast' => [
                    [
                        'message' => 'درخواست به دانشگاه ارسال شد',
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
                return to_route('panel.intership.interships')->with($toasts);
            }
        } else {
            $toasts = ['toast' => [
                [
                    'message' => 'درخواست از این مرحله رد شده است',
                    'alert-type' => 'error'
                ]
            ]];
            return to_route('panel.intership.interships')->with($toasts);
        }
    }

    public function rejectIntership(RejectRequestRequest $formRequest)
    {
        $request = Intership::query()->where('id',$formRequest->id)->first();
        if ($request && (in_array(auth()->user()->id,array_column($request->university->admins->select('id')->toArray(),'id')) || $request->announcement->company->user_id == auth()->user()->id || auth()->user()->can('IntershipPermission'))) {
            $request->status = Intership::STATUS_REJECTED;
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
            return to_route('panel.intership.interships')->with($toasts);
        }
    }

    public function universityAccept(Request $request)
    {
        $rules = array(
            'id' => 'required|numeric|exists:interships,id',
            'file' => 'required|mimes:jpg,jpeg,png,webp,pdf|max:4048',
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()):
            $toasts = ['toast' => [
                [
                    'message' => 'فایل معرفی نامه می بایست بارگذاری شود',
                    'alert-type' => 'error'
                ]
            ]];
            return back()->with($toasts);
        endif;
        $intership = Intership::query()->where('id',$request->id)->first();
        if ($intership) {
            if (in_array(auth()->user()->id, array_column($intership->university->admins->select('id')->toArray(), 'id')) || auth()->user()->can('IntershipPermission')) {
                if ($intership->status == Intership::STATUS_COMPANY_ACCEPT) {
                    $path = Storage::disk('intershipFiles')->putFile($request->file);
                    $intership->introduction = $path;
                    $intership->status = Intership::STATUS_UNIVERSITY_ACCEPT;
                    $intership->save();
                    NotifService::sendSMS($intership->user->mobile,0,Notif::EVERY_SECOND,'معرفی نامه شما برای درخواست کارآموزی توسط دانشگاه آپلود شد، کارآمد');
                    $toasts = ['toast' => [
                        [
                            'message' => 'معرفی نامه درج شد',
                            'alert-type' => 'info'
                        ]
                    ]];
                    return back()->with($toasts);
                } else {
                    $toasts = ['toast' => [
                        [
                            'message' => 'درخواست از این مرحله رد شده است',
                            'alert-type' => 'error'
                        ]
                    ]];
                    return to_route('panel.intership.interships')->with($toasts);
                }
            } else {
                $toasts = ['toast' => [
                    [
                        'message' => 'عدم وجود دسترسی',
                        'alert-type' => 'error'
                    ]
                ]];
                return to_route('panel.intership.interships')->with($toasts);
            }
        } else {
            abort(404);
        }
    }

    public function userReport(Request $request)
    {
        $rules = array(
            'id' => 'required|numeric|exists:interships,id',
            'file' => 'required|mimes:jpg,jpeg,png,webp,pdf|max:4048',
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()):
            $toasts = ['toast' => [
                [
                    'message' => 'فایل گزارش کار می بایست بارگذاری شود',
                    'alert-type' => 'error'
                ]
            ]];
            return back()->with($toasts);
        endif;
        $intership = Intership::query()->where('id',$request->id)->first();
        if ($intership) {
            if ($intership->user_id == auth()->user()->id || auth()->user()->can('IntershipPermission')) {
                if ($intership->status == Intership::STATUS_UNIVERSITY_ACCEPT) {
                    $path = Storage::disk('intershipFiles')->putFile($request->file);
                    $intership->report = $path;
                    $intership->status = Intership::STATUS_FINISH;
                    $intership->save();
                    $toasts = ['toast' => [
                        [
                            'message' => 'گزارش پایان کار درج شد',
                            'alert-type' => 'info'
                        ]
                    ]];
                    return back()->with($toasts);
                } else {
                    $toasts = ['toast' => [
                        [
                            'message' => 'درخواست از این مرحله رد شده است',
                            'alert-type' => 'error'
                        ]
                    ]];
                    return to_route('panel.intership.interships')->with($toasts);
                }
            } else {
                $toasts = ['toast' => [
                    [
                        'message' => 'عدم وجود دسترسی',
                        'alert-type' => 'error'
                    ]
                ]];
                return to_route('panel.intership.interships')->with($toasts);
            }
        } else {
            abort(404);
        }
    }

    public function introductionShow(Intership $intership) {
        if (auth()->user()->id == $intership->user_id || in_array(auth()->user()->id,array_column($intership->university->admins->select('id')->toArray(),'id')) || auth()->user()->id == $intership->announcement->company->user_id || auth()->user()->can('ّIntershipPermission')) {
            $path = storage_path('app' . DIRECTORY_SEPARATOR . 'storage' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'intershipFiles' . DIRECTORY_SEPARATOR . $intership->introduction);
            try {
                $file = Fi::get($path);
                $type = Fi::mimeType($path);
                $response = Response::make($file, 200);
                $response->header("Content-Type", $type);
                return $response;
            } catch (FileNotFoundException $exception) {
                abort(403);
            }
        } else {
            return 'عدم دسترسی';
        }
    }

    public function reportShow(Intership $intership)
    {
        if (auth()->user()->id == $intership->user_id || in_array(auth()->user()->id,array_column($intership->university->admins->select('id')->toArray(),'id')) || auth()->user()->id == $intership->announcement->company->user_id || auth()->user()->can('ّIntershipPermission')) {
            $path = storage_path('app' . DIRECTORY_SEPARATOR . 'storage' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'intershipFiles' . DIRECTORY_SEPARATOR . $intership->report);
            try {
                $file = Fi::get($path);
                $type = Fi::mimeType($path);
                $response = Response::make($file, 200);
                $response->header("Content-Type", $type);
                return $response;
            } catch (FileNotFoundException $exception) {
                abort(403);
            }
        } else {
            return 'عدم دسترسی';
        }
    }
}
