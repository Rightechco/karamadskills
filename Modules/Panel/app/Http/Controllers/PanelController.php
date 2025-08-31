<?php

namespace Modules\Panel\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Announcement\Models\Announcement;
use Modules\Category\Models\Category;
use Modules\Company\Models\Company;
use Modules\Request\Models\Request;
use Modules\Resume\Models\Resume;
use Modules\Role\Http\Repositories\RoleRepo;
use Modules\Ticket\Models\Ticket;
use Modules\User\Models\User;
use Modules\Wallet\Http\Services\WalletService;

class PanelController extends Controller
{
    public function index()
    {
        $allPer = array_column(RoleRepo::permissionAll()->toArray(), 'slug');

//      users
        $user = auth()->user();
        $balance = WalletService::getWalletBalance($user);
        $wallet = $user->wallet;
        $userRequests = Request::query()->where('user_id',$user->id)->take(10)->get();
        $relatedAnnouncements = null;
        if($user->resume) {
            $cats = array_column($user->resume->categories->select('id')->toArray(),'id');
            $relatedAnnouncements = Announcement::with('categories')->whereHas('categories',function ($q) use ($cats){
               $q->whereIn('announcement_category.category_id',$cats);
            })->orderBy('id','DESC')->take(10)->get();
        }

//      admin
        $usersCount = User::all()->count();
        $userWaitCount = User::query()->where('status',User::STATUS_UNVERIFIED)->count();
        $companyCount = Company::all()->count();
        $companyWaitCount = Company::query()->where('status',Company::STATUS_WAIT)->count();
        $announcementCount = Announcement::all()->count();
        $announcementWaitCount = Announcement::query()->where('status',Announcement::STATUS_WAIT)->count();
        $requestCount = Request::all()->count();
        $requestWaitCount = Request::query()->where('status',Request::STATUS_WAIT)->count();

//      companies
        $relatedCatsJob = null;
        $relatedResumes = null;
        if ($user->announcements->count()) {
            foreach ($user->announcements as $announcement) {
                $ids = array_column($announcement->categories->select('id')->toArray(), 'id');
                foreach ($ids as $id) {
                    $relatedCatsJob[] = $id;
                }
            }
            $relatedResumeIds = null;
            if ($relatedCatsJob) {
                $relatedCatsJob = array_unique($relatedCatsJob);
                foreach ($relatedCatsJob as $relatedCatJob) {
                    $relatedCatJob = Category::query()->where('id', $relatedCatJob)->first();
                    $ids = array_column($relatedCatJob->resumes->where('status','!=',Resume::NOTSEARCH)->select('id')->toArray(), 'id');
                    foreach ($ids as $id) {
                        $relatedResumeIds[] = $id;
                    }
                }
                if ($relatedResumeIds) {
                    $relatedResumeIds = array_unique($relatedResumeIds);
                    $relatedResumes = Resume::query()->where('status','!=',Resume::NOTSEARCH)->select('id','user_id')->whereIn('id',$relatedResumeIds)->orderBy('id','DESC')->limit(12)->get();
                } else {
                    $relatedResumes = Resume::query()->where('status','!=',Resume::NOTSEARCH)->select('id','user_id')->inRandomOrder()->limit(12)->get();
                }
            } else {
                $relatedResumes = Resume::query()->where('status','!=',Resume::NOTSEARCH)->select('id','user_id')->inRandomOrder()->limit(12)->get();
            }
        }

        return view('panel::index',
            compact('allPer', 'user',
                'usersCount','userWaitCount','userRequests',
                'companyCount','companyWaitCount',
                'announcementCount','announcementWaitCount',
                'requestCount','requestWaitCount',
                'balance','wallet',
                'relatedAnnouncements',
                'relatedResumes'
            ));
    }
}
