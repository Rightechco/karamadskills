<?php

namespace Modules\Announcement\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Announcement\Http\Repositories\AnnouncementRepo;
use Modules\Announcement\Models\Announcement;
use Modules\Category\Models\Category;
use Modules\Common\Models\Ostan;

class AnnouncementFrontController
{
    public function announcements(Request $request)
    {
        $announcements = new Announcement();
        $announcements = $announcements->query()->where('status',Announcement::STATUS_VERIFIED);
        if ($request->s){
            $announcements = $announcements->where('name','like','%'.$request->s.'%');
        }
        if ($request->ostan){
            $announcements = $announcements->where('ostan_id',$request->ostan);
        }
        if ($request->gender){
            $announcements = $announcements->where('gender',$request->gender);
        }
        if(!empty($request->jobType)) {
            if (count($request->jobType) == 1) {
                $announcements = $announcements->where('jobType','like','%'.$request->jobType[0].'%');
            } else {
                $announcements = $announcements->where(function($query) use ($request){
                    $query = $query->where('jobType','like','%'.$request->jobType[0].'%');
                    for ($i= 1;$i<count($request->jobType);$i++){
                        $query = $query->orWhere('jobType','like','%'.$request->jobType[$i].'%');
                    }
                });
            }
        }
        $announcements = $announcements->take(10)->orderBy('id','DESC')->get();
        $ostans = Ostan::all();
        $categories = Category::query()->whereNull('parent_id')->get();
        return view('announcement::announcements',compact('announcements','ostans','categories'));
    }

    public function announcementsMore(Request $request)
    {
        return AnnouncementRepo::announcementsMore($request);
    }

    public function announcement($id)
    {
        $announcement = Announcement::query()->where('slug',$id)->where('status',Announcement::STATUS_VERIFIED)->first();
        if ($announcement) {
            $catArray = $announcement->categories->select('id')->toArray();
            $catArray = array_column($catArray,'id');
            $relatedAnnouncements = Announcement::query()->where(function ($query) use ($catArray){
                $query->with('categories')->whereHas('categories',function ($q) use ($catArray){
                    $q->whereIn('category_id',$catArray);
                });
            })->where('status', Announcement::STATUS_VERIFIED)->orderBy('id', 'desc')->take(10)->get();
            return view('announcement::announcement',compact('announcement','relatedAnnouncements'));
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

    public function interships(Request $request)
    {
        $announcements = new Announcement();
        $announcements = $announcements->query()->where('status',Announcement::STATUS_VERIFIED)->where('universityIntership',true);
        if ($request->s){
            $announcements = $announcements->where('name','like','%'.$request->s.'%');
        }
        if ($request->ostan){
            $announcements = $announcements->where('ostan_id',$request->ostan);
        }
        if ($request->gender){
            $announcements = $announcements->where('gender',$request->gender);
        }
        if(!empty($request->jobType)) {
            if (count($request->jobType) == 1) {
                $announcements = $announcements->where('jobType','like','%'.$request->jobType[0].'%');
            } else {
                $announcements = $announcements->where(function($query) use ($request){
                    $query = $query->where('jobType','like','%'.$request->jobType[0].'%');
                    for ($i= 1;$i<count($request->jobType);$i++){
                        $query = $query->orWhere('jobType','like','%'.$request->jobType[$i].'%');
                    }
                });
            }
        }
        $announcements = $announcements->take(10)->orderBy('id','DESC')->get();
        $ostans = Ostan::all();
        $categories = Category::query()->whereNull('parent_id')->get();
        return view('announcement::interships',compact('announcements','ostans','categories'));
    }

    public function intershipsMore(Request $request)
    {
        return AnnouncementRepo::intershipsMore($request);
    }

    public function intership($id)
    {
        $announcement = Announcement::query()->where('slug',$id)->where('status',Announcement::STATUS_VERIFIED)->where('universityIntership',true)->first();
        if ($announcement) {
            $catArray = $announcement->categories->select('id')->toArray();
            $catArray = array_column($catArray,'id');
            $relatedAnnouncements = Announcement::query()->where(function ($query) use ($catArray){
                $query->with('categories')->whereHas('categories',function ($q) use ($catArray){
                    $q->whereIn('category_id',$catArray);
                });
            })->where('status', Announcement::STATUS_VERIFIED)->where('universityIntership',true)->orderBy('id', 'desc')->take(10)->get();
            return view('announcement::intership',compact('announcement','relatedAnnouncements'));
        } else {
            $toasts = ['toast' => [
                [
                    'message' => 'آگهی موردنظر یافت نشد',
                    'alert-type' => 'error'
                ]
            ]];
            return to_route('announcement.interships')->with($toasts);
        }
    }
}
