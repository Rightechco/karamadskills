<?php

namespace Modules\Announcement\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Announcement\Http\Repositories\AnnouncementRepo;
use Modules\Announcement\Http\Requests\AnnouncementRequest;
use Modules\Announcement\Http\Requests\AnnouncementUpdateRequest;
use Modules\Announcement\Http\Services\AnnouncementService;
use Modules\Announcement\Models\Announcement;
use Modules\Category\Models\Category;
use Modules\Common\Http\Services\CommonServices;
use Modules\Common\Models\Ostan;
use Modules\Company\Models\Company;
use Modules\Wallet\Http\Services\WalletService;

class AnnouncementController extends Controller
{
    public function announcements()
    {
        return view('announcement::panel.announcements');
    }

    public function announcementsCreate()
    {
        if (auth()->user()->companies->count() || auth()->user()->can('AnnouncementPermission')) {
            if (WalletService::getWalletBalance(auth()->user()) >= config('tests.adFee') || auth()->user()->can('AnnouncementPermission') || !auth()->user()->announcements->count()) {
                $ostans = Ostan::all();
                $categories = Category::query()->whereNull('parent_id')->get();
                $companies = auth()->user()->companies;
                $allCompanies = Company::all();
                return view('announcement::panel.create',compact('ostans','categories','companies','allCompanies'));
            } else {
                $toasts = ['toast' => [
                    [
                        'message' => 'ابتدا کیف پول خود را شارژ کنید',
                        'alert-type' => 'error'
                    ]
                ]];
                return to_route('panel.wallet.wallet')->with($toasts);
            }
        } else {
            $toasts = ['toast' => [
                [
                    'message' => 'ابتدا می بایست یک شرکت ثبت کنید',
                    'alert-type' => 'error'
                ]
            ]];
            return to_route('panel.announcement.announcements')->with($toasts);
        }
    }

    public function announcementsStore(AnnouncementRequest $request)
    {
        if (in_array($request->company,array_column(auth()->user()->companies->select('id')->toArray(),'id')) || auth()->user()->can('AnnouncementPermission') || !auth()->user()->announcements->count()) {
            if (WalletService::getWalletBalance(auth()->user()) >= config('tests.adFee') || auth()->user()->can('AnnouncementPermission') || !auth()->user()->announcements->count()) {
                $input = $request->validated();
                if ($request->des && str_contains($request->des, 'base64')) {
                    $des = CommonServices::saveSummerNote($request->des,'announcementDesImg');
                    $input['des'] = $des;
                }
                $announcement = AnnouncementService::create($input);
                if (!auth()->user()->can('AnnouncementPermission') && auth()->user()->announcements->count()) {
                    WalletService::withdraw(auth()->user()->id,config('tests.adFee'),'هزینه ثبت آگهی شماره '.$announcement->id);
                    WalletService::deposit(1,config('tests.adFee'),'هزینه ثبت آگهی شماره '.$announcement->id);
                }
                $toasts = ['toast' => [
                    [
                        'message' => 'آگهی شما ذخیره شد، بعد از تایید توسط پشتیبانی، منتشر خواهد شد',
                        'alert-type' => 'success'
                    ]
                ]];
                return to_route('panel.announcement.announcements')->with($toasts);
            } else {
                $toasts = ['toast' => [
                    [
                        'message' => 'ابتدا کیف پول خود را شارژ کنید',
                        'alert-type' => 'error'
                    ]
                ]];
                return to_route('panel.wallet.wallet')->with($toasts);
            }
        } else {
            $toasts = ['toast' => [
                [
                    'message' => 'عدم دسترسی',
                    'alert-type' => 'error'
                ]
            ]];
            return to_route('panel.announcement.announcements')->with($toasts);
        }
    }

    public function getAnnouncements(Request $request)
    {
        return AnnouncementRepo::getAnnouncements($request);
    }

    public function announcementsEdit(Announcement $announcement)
    {
        if($announcement->company->user->id == auth()->user()->id || auth()->user()->can('AnnouncementPermission')) {
            if ($announcement->status == Announcement::STATUS_VERIFIED && !auth()->user()->can('AnnouncementPermission')) {
                $toasts = ['toast' => [
                    [
                        'message' => 'آگهی تایید شده را نمی توانید تغییر دهید',
                        'alert-type' => 'error'
                    ]
                ]];
                return to_route('panel.announcement.announcements')->with($toasts);
            }
            $ostans = Ostan::all();
            $categories = Category::query()->whereNull('parent_id')->get();
            $companies = auth()->user()->companies->where('status',Company::STATUS_VERIFIED);
            $allCompanies = Company::all();
            return view('announcement::panel.edit',compact('ostans','categories','companies','announcement','allCompanies'));
        } else {
            $toasts = ['toast' => [
                [
                    'message' => 'عدم دسترسی',
                    'alert-type' => 'error'
                ]
            ]];
            return to_route('panel.announcement.announcements')->with($toasts);
        }
    }

    public function announcementsUpdate(AnnouncementUpdateRequest $request,Announcement $announcement)
    {
        if($announcement->company->user->id == auth()->user()->id || auth()->user()->can('AnnouncementPermission')) {
            if ($announcement->status == Announcement::STATUS_VERIFIED && !auth()->user()->can('AnnouncementPermission')) {
                $toasts = ['toast' => [
                    [
                        'message' => 'آگهی تایید شده را نمی توانید تغییر دهید',
                        'alert-type' => 'error'
                    ]
                ]];
                return to_route('panel.announcement.announcements')->with($toasts);
            }
            $input = $request->validated();
            if ($request->des && str_contains($request->des, 'base64')) {
                $des = CommonServices::saveSummerNote($request->des,'announcementDesImg');
                $input['des'] = $des;
            }
            if (!auth()->user()->can('AnnouncementPermission')) {
                $input['status'] = Announcement::STATUS_WAIT;
            }
            $announcement = AnnouncementService::update($input,$announcement);
            $toasts = ['toast' => [
                [
                    'message' => 'آگهی شما ویرایش شد، منتظر تایید از سمت پشتیبانی باشید',
                    'alert-type' => 'success'
                ]
            ]];
            return to_route('panel.announcement.announcements')->with($toasts);
        } else {
            $toasts = ['toast' => [
                [
                    'message' => 'عدم دسترسی',
                    'alert-type' => 'error'
                ]
            ]];
            return to_route('panel.announcement.announcements')->with($toasts);
        }
    }

    public function announcementsStop(Announcement $announcement)
    {
        $announcement->status = Announcement::STATUS_STOP;
        $announcement->save();
        $toasts = ['toast' => [
            [
                'message' => 'آگهی موردنظر متوقف گردید',
                'alert-type' => 'success'
            ]
        ]];
        return to_route('panel.announcement.announcements')->with($toasts);
    }
}
