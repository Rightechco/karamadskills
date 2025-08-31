<?php

namespace Modules\University\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Common\Http\Services\CommonServices;
use Modules\Common\Http\Services\Image\ImageService;
use Modules\University\Http\Imports\UniImport;
use Modules\University\Http\Repositories\UniversityRepo;
use Modules\University\Http\Requests\UniversityEditContentRequest;
use Modules\University\Http\Requests\UniversityEditRequest;
use Modules\University\Http\Requests\UniversityRequest;
use Modules\University\Http\Services\UniversityService;
use Modules\University\Models\University;
use Modules\User\Models\User;

class UniversityController extends Controller
{
    public function universities()
    {
        if (auth()->user()->universities->count() || auth()->user()->can('UniversityPermission')) {
            return view('university::panel.universities');
        }
    }

    public function getUniversities(Request $request)
    {
        if (auth()->user()->universities->count() || auth()->user()->can('UniversityPermission')) {
            return UniversityRepo::getUniversities($request);
        }
    }

    public function universityUsers(University $university){
        if (auth()->user()->can('UniversityPermission') || in_array($university->id,array_column(auth()->user()->universities->select('id')->toArray(),'id'))) {
            return view('university::panel.universityUsers',compact('university'));
        } else {
            $toasts = ['toast' => [
                [
                    'message' => 'عدم دسترسی',
                    'alert-type' => 'error'
                ]
            ]];
            return back()->with($toasts);
        }
    }

    public function getUniversityUser(University $university,Request $request) {
        if (auth()->user()->can('UniversityPermission') || in_array($university->id,array_column(auth()->user()->universities->select('id')->toArray(),'id'))) {
            return UniversityRepo::getUniversityUser($request,$university->id);
        }
    }

    public function universityCreate()
    {
        if (auth()->user()->can('UniversityPermission')) {
            $users = User::query()->select('id','name','mobile')->where('status',User::STATUS_VERIFIED)->get();
            return view('university::panel.create',compact('users'));
        }
    }

    public function universityCreateMulti()
    {
        if (auth()->user()->can('UniversityPermission')) {
            return view('university::panel.createMulti');
        }
    }

    public function getOstany(Request $request)
    {
        $ostanies = University::query()->where('state',University::OSTANY)->where('type',$request['type'])->get();
        return $ostanies;
    }

    public function getVaheds(Request $request)
    {
        $vaheds = University::query()->where('parent_id',$request['id'])->get();
        return $vaheds;
    }

    public function universityStore(UniversityRequest $request,ImageService $imageService)
    {
        if (auth()->user()->can('UniversityPermission')) {
            $input = $request->validated();
            if ($request['state'] == 'ostany') {
                $parent = University::query()->where('state',University::COUNTRY)->where('type',$request['type'])->first();
                if($parent) {
                    $input['parent_id'] = $parent->id;
                } else {
                    $toasts = ['toast' => [
                        [
                            'message' => 'ابتدا واحد کشوری را ثبت کنید',
                            'alert-type' => 'error'
                        ]
                    ]];
                    return back()->with($toasts);
                }
            } elseif ($request['state'] == 'vahed') {
                if ($input['ostan']) {
                    $parent = University::query()->where('id',$input['ostan'])->first();
                    $input['parent_id'] = $parent->id;
                } else {
                    $toasts = ['toast' => [
                        [
                            'message' => 'مرکز استان را انتخاب کنید',
                            'alert-type' => 'error'
                        ]
                    ]];
                    return back()->with($toasts);
                }
            }
            if ($request->text && str_contains($request->text, 'base64')) {
                $text = CommonServices::saveSummerNote($request->text, 'universityTextImg');
                $input['text'] = $text;
            }
            if ($request->hasFile('logo')) {
                $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'universityLogo');
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
            if ($request->hasFile('stamp')) {
                $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'universityStamp');
                $resulStamp = $imageService->createIndexAndSave($request->file('stamp'));
                if ($resulStamp === false) {
                    $toasts = ['toast' => [
                        [
                            'message' => 'ذخیره تصویر با خطا مواجه شد',
                            'alert-type' => 'error'
                        ]
                    ]];
                    return back()->with($toasts);
                }
            }
            $input['stamp'] = $resulStamp ?? null;
            if ($request->hasFile('gallery')) {
                $input['gallery'] = [];
                foreach ($request->file('gallery') as $gallery) {
                    $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'universityGallery');
                    $resulGallery = $imageService->createIndexAndSave($gallery);
                    if ($resulGallery === false) {
                        $toasts = ['toast' => [
                            [
                                'message' => 'ذخیره تصویر با خطا مواجه شد',
                                'alert-type' => 'error'
                            ]
                        ]];
                        return back()->with($toasts);
                    }
                    $input['gallery'][] = $resulGallery;
                }
            };
            $university = UniversityService::create($input);
            $toasts = ['toast' => [
                [
                    'message' => 'دانشگاه با موفقیت ثبت شد',
                    'alert-type' => 'success'
                ]
            ]];
            return to_route('panel.university.universities')->with($toasts);
        }
    }

    public function universityStoreMulti(Request $request)
    {
        if (auth()->user()->can('UniversityPermission')) {
            $rules = array(
                'name.*' => 'nullable|string|min:2|max:390',
                'excel' => 'nullable|mimes:xlsx,xls,csv',
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
            if($request->excel) {
                $unis = Excel::toArray(UniImport::class,$request->excel);
                foreach ($unis[0] as $uni) {
                    University::query()->create([
                        'name' => $uni[0],
                        'state' => University::VAHED,
                        'type' => $request->type,
                        'parent_id' => $request->ostan
                    ]);
                }
            } else {
                foreach ($request->name as $uni) {
                    University::query()->create([
                        'name' => $uni,
                        'state' => University::VAHED,
                        'type' => $request->type,
                        'parent_id' => $request->ostan
                    ]);
                }
            }
            $toasts = ['toast' => [
                [
                    'message' => 'دانشگاه با موفقیت ثبت شد',
                    'alert-type' => 'success'
                ]
            ]];
            return to_route('panel.university.universities')->with($toasts);
        }
    }

    public function removeGallery(University $university)
    {
        if (auth()->user()->can('UniversityPermission') || in_array($university->id,array_column(auth()->user()->universities->select('id')->toArray(),'id'))) {
            $university->gallery = null;
            $university->save();
            $toasts = ['toast' => [
                [
                    'message' => 'عکس ها حذف شد',
                    'alert-type' => 'success'
                ]
            ]];
            return to_route('panel.university.universities')->with($toasts);
        } else {
            $toasts = ['toast' => [
                [
                    'message' => 'عدم دسترسی',
                    'alert-type' => 'error'
                ]
            ]];
            return to_route('panel.university.universities')->with($toasts);
        }
    }

    public function universityEditContent(University $university)
    {
        if (auth()->user()->can('UniversityPermission') || in_array($university->id,array_column(auth()->user()->universities->select('id')->toArray(),'id'))) {
            return view('university::panel.editContent',compact('university'));
        } else {
            $toasts = ['toast' => [
                [
                    'message' => 'عدم دسترسی',
                    'alert-type' => 'error'
                ]
            ]];
            return back()->with($toasts);
        }
    }

    public function universityUpdateContent(UniversityEditContentRequest $request,University $university,ImageService $imageService)
    {
        if (auth()->user()->can('UniversityPermission') || in_array($university->id,array_column(auth()->user()->universities->select('id')->toArray(),'id'))) {
            $input = $request->validated();
            if ($request->text && str_contains($request->text, 'base64')) {
                $text = CommonServices::saveSummerNote($request->text, 'universityTextImg');
                $input['text'] = $text;
            }
            if ($request->hasFile('logo')) {
                $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'universityLogo');
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
            if ($request->hasFile('stamp')) {
                $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'universityStamp');
                $resulStamp = $imageService->createIndexAndSave($request->file('stamp'));
                if ($resulStamp === false) {
                    $toasts = ['toast' => [
                        [
                            'message' => 'ذخیره تصویر با خطا مواجه شد',
                            'alert-type' => 'error'
                        ]
                    ]];
                    return back()->with($toasts);
                }
            }
            $input['stamp'] = $resulStamp ?? null;
            if ($request->hasFile('gallery')) {
                $input['gallery'] = [];
                foreach ($request->file('gallery') as $gallery) {
                    $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'universityGallery');
                    $resulGallery = $imageService->createIndexAndSave($gallery);
                    if ($resulGallery === false) {
                        $toasts = ['toast' => [
                            [
                                'message' => 'ذخیره تصویر با خطا مواجه شد',
                                'alert-type' => 'error'
                            ]
                        ]];
                        return back()->with($toasts);
                    }
                    $input['gallery'][] = $resulGallery;
                }
            };
            $university = UniversityService::updateContent($input,$university);
            $toasts = ['toast' => [
                [
                    'message' => 'دانشگاه با موفقیت ویرایش شد',
                    'alert-type' => 'success'
                ]
            ]];
            return to_route('panel.university.universities')->with($toasts);
        } else {
            $toasts = ['toast' => [
                [
                    'message' => 'عدم دسترسی',
                    'alert-type' => 'error'
                ]
            ]];
            return back()->with($toasts);
        }
    }

    public function universityEdit(University $university)
    {
        if (auth()->user()->can('UniversityPermission')) {
            $users = User::query()->select('id','name','mobile')->where('status',User::STATUS_VERIFIED)->get();
            return view('university::panel.edit',compact('university','users'));
        } else {
            $toasts = ['toast' => [
                [
                    'message' => 'عدم دسترسی',
                    'alert-type' => 'error'
                ]
            ]];
            return back()->with($toasts);
        }
    }

    public function universityUpdate(UniversityEditRequest $request,University $university,ImageService $imageService)
    {
        if (auth()->user()->can('UniversityPermission')) {
            $input = $request->validated();
            if ($request['state'] == 'ostany') {
                $parent = University::query()->where('state',University::COUNTRY)->where('type',$request['type'])->first();
                if($parent) {
                    $input['parent_id'] = $parent->id;
                } else {
                    $toasts = ['toast' => [
                        [
                            'message' => 'ابتدا واحد کشوری را ثبت کنید',
                            'alert-type' => 'error'
                        ]
                    ]];
                    return back()->with($toasts);
                }
            } elseif ($request['state'] == 'vahed') {
                if ($input['ostan']) {
                    $parent = University::query()->where('id',$input['ostan'])->first();
                    $input['parent_id'] = $parent->id;
                } else {
                    $toasts = ['toast' => [
                        [
                            'message' => 'مرکز استان را انتخاب کنید',
                            'alert-type' => 'error'
                        ]
                    ]];
                    return back()->with($toasts);
                }
            }
            if ($request->text && str_contains($request->text, 'base64')) {
                $text = CommonServices::saveSummerNote($request->text, 'universityTextImg');
                $input['text'] = $text;
            }
            if ($request->hasFile('logo')) {
                $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'universityLogo');
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
            if ($request->hasFile('stamp')) {
                $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'universityStamp');
                $resulStamp = $imageService->createIndexAndSave($request->file('stamp'));
                if ($resulStamp === false) {
                    $toasts = ['toast' => [
                        [
                            'message' => 'ذخیره تصویر با خطا مواجه شد',
                            'alert-type' => 'error'
                        ]
                    ]];
                    return back()->with($toasts);
                }
            }
            $input['stamp'] = $resulStamp ?? null;
            if ($request->hasFile('gallery')) {
                $input['gallery'] = $university->gallery;
                foreach ($request->file('gallery') as $gallery) {
                    $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'universityGallery');
                    $resulGallery = $imageService->createIndexAndSave($gallery);
                    if ($resulGallery === false) {
                        $toasts = ['toast' => [
                            [
                                'message' => 'ذخیره تصویر با خطا مواجه شد',
                                'alert-type' => 'error'
                            ]
                        ]];
                        return back()->with($toasts);
                    }
                    $input['gallery'][] = $resulGallery;
                }
            };
            $university = UniversityService::update($input,$university);
            $toasts = ['toast' => [
                [
                    'message' => 'دانشگاه با موفقیت ویرایش شد',
                    'alert-type' => 'success'
                ]
            ]];
            return to_route('panel.university.universities')->with($toasts);
        } else {
            $toasts = ['toast' => [
                [
                    'message' => 'عدم دسترسی',
                    'alert-type' => 'error'
                ]
            ]];
            return back()->with($toasts);
        }
    }
}
