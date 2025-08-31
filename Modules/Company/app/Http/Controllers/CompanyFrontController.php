<?php

namespace Modules\Company\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Announcement\Models\Announcement;
use Modules\Company\Models\Company;

class CompanyFrontController
{
    public function companies() {
        $companies = Company::query()->where('status',Company::STATUS_VERIFIED)->whereNotNull('logo')->select('id','name','slug','logo')->take(9)->orderBy('id','DESC')->get();
        return view('company::companies',compact('companies'));
    }

    public function moreCompanies(Request $request)
    {
        $num = $request->num*9;
        $string = '';
        $companies = Company::query()->where('status',Company::STATUS_VERIFIED)->whereNotNull('logo')->select('id','name','slug','logo')->skip($num)->take(9)->orderBy('id','DESC')->get();
        if ($companies->count()) {
            foreach ($companies as $company) {
                $string .= '<div class="box_item">
                <a href="'. route('company.company',$company->slug) .'">
                    <img src="'. asset($company->logo['indexArray']['full']) .'" alt="image">
                    <h3>'. $company->name .'</h3>
                    </a>
                </div>';
            }
            return $string;
        } else {
            return false;
        }
    }

    public function company($slug)
    {
        $company = Company::query()->where('slug',$slug)->where('status',Company::STATUS_VERIFIED)->first();
        if ($company) {
            return view('company::company',compact('company'));
        } else {
            $toasts = ['toast' => [
                [
                    'message' => 'شرکت موردنظر یافت نشد',
                    'alert-type' => 'error'
                ]
            ]];
            return to_route('announcement.announcements')->with($toasts);
        }
    }

    public function companyJobs($slug)
    {
        $company = Company::query()->where('slug',$slug)->where('status',Company::STATUS_VERIFIED)->first();
        if ($company) {
            $announcements = Announcement::query()->where('company_id',$company->id)->whereIn('status',[Announcement::STATUS_VERIFIED,Announcement::STATUS_STOP])->orderBy('id','DESC')->get();
            return view('company::companyJobs',compact('company','announcements'));
        } else {
            $toasts = ['toast' => [
                [
                    'message' => 'شرکت موردنظر یافت نشد',
                    'alert-type' => 'error'
                ]
            ]];
            return to_route('announcement.announcements')->with($toasts);
        }
    }
}
