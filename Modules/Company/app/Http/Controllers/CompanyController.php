<?php

namespace Modules\Company\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Common\Http\Services\CommonServices;
use Modules\Common\Http\Services\Image\ImageService;
use Modules\Company\Http\Repositories\CompanyRepo;
use Modules\Company\Http\Requests\CompanyRequest;
use Modules\Company\Http\Requests\CompanyUpdateRequest;
use Modules\Company\Http\Services\CompanyService;
use Modules\Company\Models\Company;
use Modules\User\Models\User;

class CompanyController extends Controller
{
    public function companies()
    {
        return view('company::panel.companies');
    }

    public function getCompanies(Request $request)
    {
        return CompanyRepo::getCompanies($request);
    }

    public function companiesCreate()
    {
        if (auth()->user()->status != User::STATUS_NEW || auth()->user()->can('CompanyPermission')) {
            $users = [];
            if (auth()->user()->can('CompanyPermission')) {
                $users = User::query()->select('id','name','mobile')->where('status',User::STATUS_VERIFIED)->get();
                $users = json_decode(json_encode($users,false));
            }
            return view('company::panel.create',compact('users'));
        } else {
            $toasts = ['toast' => [
                [
                    'message' => 'برای ثبت شرکت ابتدا می بایست احراز هویت انجام دهید',
                    'alert-type' => 'error'
                ]
            ]];
            return to_route('panel.user.profile')->with($toasts);
        }
    }

    public function companiesStore(CompanyRequest $request,ImageService $imageService)
    {
        if (auth()->user()->status != User::STATUS_NEW || auth()->user()->can('CompanyPermission')) {
            $input = $request->validated();
            if ($request->expert && str_contains($request->expert, 'base64')) {
                $expert = CommonServices::saveSummerNote($request->expert,'companyExpertImg');
                $input['expert'] = $expert;
            }
            if ($request->des && str_contains($request->des, 'base64')) {
                $des = CommonServices::saveSummerNote($request->des,'companyDesImg');
                $input['des'] = $des;
            }

            if ($request->hasFile('logo')) {
                $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'companyLogo');
                $resulLogo = $imageService->createIndexAndSave($request->file('logo'));
                if ($resulLogo === false) {
                    $toasts = ['toast' => [
                        [
                            'message' => 'ذخیره تصویر با خطا مواجه شد',
                            'alert-type' => 'error'
                        ]
                    ]];
                    return back()->with($toasts);
                }
            }
            $input['logo'] = $resulLogo ?? null;

            if ($request->hasFile('cover')) {
                $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'companyCover');
                $resultCover = $imageService->createIndexAndSave($request->file('cover'));
                if ($resultCover === false) {
                    $toasts = ['toast' => [
                        [
                            'message' => 'ذخیره تصویر با خطا مواجه شد',
                            'alert-type' => 'error'
                        ]
                    ]];
                    return back()->with($toasts);
                }
            }
            $input['cover'] = $resultCover ?? null;
            if (!auth()->user()->can('CompanyPermission')) {
                $input['user'] = null;
            }
            $company = CompanyService::create($input);
            $toasts = ['toast' => [
                [
                    'message' => 'شرکت با موفقیت ثبت شد، منتظر تایید توسط پشتیبانی باشید',
                    'alert-type' => 'success'
                ]
            ]];
            return to_route('panel.company.companies')->with($toasts);
        } else {
            $toasts = ['toast' => [
                [
                    'message' => 'برای ثبت شرکت ابتدا می بایست احراز هویت انجام دهید',
                    'alert-type' => 'error'
                ]
            ]];
            return to_route('panel.user.profile')->with($toasts);
        }
    }

    public function companiesEdit(Company $company)
    {
        if (auth()->user()->can('CompanyPermission') || ($company->user_id == auth()->user()->id && ($company->status == Company::STATUS_UNVERIFIED || $company->status == Company::STATUS_WAIT ))) {
            $users = [];
            if (auth()->user()->can('CompanyPermission')) {
                $users = User::query()->select('id','name','mobile')->where('status',User::STATUS_VERIFIED)->get();
                $users = json_decode(json_encode($users,false));
            }
            return view('company::panel.edit',compact('company','users'));
        } else {
            $toasts = ['toast' => [
                [
                    'message' => 'شما به این قسمت دسترسی ندارید',
                    'alert-type' => 'error'
                ]
            ]];
            return to_route('panel.company.companies')->with($toasts);
        }
    }

    public function companiesUpdate(CompanyUpdateRequest $request,Company $company,ImageService $imageService)
    {
        if (auth()->user()->can('CompanyPermission') || ($company->user_id == auth()->user()->id && ($company->status == Company::STATUS_UNVERIFIED || $company->status == Company::STATUS_WAIT ))) {
            $input = $request->validated();
            if ($request->expert && str_contains($request->expert, 'base64')) {
                $expert = CommonServices::saveSummerNote($request->expert,'companyExpertImg');
                $input['expert'] = $expert;
            }
            if ($request->des && str_contains($request->des, 'base64')) {
                $des = CommonServices::saveSummerNote($request->des,'companyDesImg');
                $input['des'] = $des;
            }

            if ($request->hasFile('logo')) {
                $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'companyLogo');
                $resultLogo = $imageService->createIndexAndSave($request->file('logo'));
                if ($resultLogo === false) {
                    $toasts = ['toast' => [
                        [
                            'message' => 'ذخیره تصویر با خطا مواجه شد',
                            'alert-type' => 'error'
                        ]
                    ]];
                    return back()->with($toasts);
                }
            }
            $input['logo'] = $resultLogo ?? null;

            if ($request->hasFile('cover')) {
                $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'companyCover');
                $resultCover = $imageService->createIndexAndSave($request->file('cover'));
                if ($resultCover === false) {
                    $toasts = ['toast' => [
                        [
                            'message' => 'ذخیره تصویر با خطا مواجه شد',
                            'alert-type' => 'error'
                        ]
                    ]];
                    return back()->with($toasts);
                }
            }
            $input['cover'] = $resultCover ?? null;
            if(!auth()->user()->can('CompanyPermission')) {
                $input['status'] = Company::STATUS_WAIT ?? $company->status;
            }
            if (!auth()->user()->can('CompanyPermission')) {
                $input['status'] = null;
            }
            if (!auth()->user()->can('CompanyPermission')) {
                $input['user'] = null;
            }
            if (!auth()->user()->can('CompanyPermission')) {
                $input['user'] = null;
            }
            $company = CompanyService::update($input,$company);
            $toasts = ['toast' => [
                [
                    'message' => 'شرکت با موفقیت ویرایش شد، منتظر تایید توسط پشتیبانی باشید',
                    'alert-type' => 'success'
                ]
            ]];
            return to_route('panel.company.companies')->with($toasts);
        } else {
            $toasts = ['toast' => [
                [
                    'message' => 'شما به این قسمت دسترسی ندارید',
                    'alert-type' => 'error'
                ]
            ]];
            return to_route('panel.company.companies')->with($toasts);
        }
    }
}
