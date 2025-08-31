<?php

namespace Modules\Course\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Modules\BBB\Http\Services\BBBServices;
use Modules\BBB\Models\BBB;
use Modules\Category\Models\Category;
use Modules\Common\Http\Services\CommonServices;
use Modules\Common\Http\Services\Image\ImageService;
use Modules\Course\Http\Repositories\CourseRepo;
use Modules\Course\Http\Requests\CourseRequest;
use Modules\Course\Http\Requests\CourseUpdateRequest;
use Modules\Course\Http\Services\CourseService;
use Modules\Course\Models\Course;
use Modules\Exam\Http\Services\ExamService;
use Modules\Exam\Http\Services\GradeService;
use Modules\Exam\Models\Grade;
use Modules\File\Http\Services\FileService;
use Modules\Notif\Http\Services\NotifService;
use Modules\Notif\Models\Notif;
use Modules\Role\Models\Role;
use Modules\University\Models\University;
use Modules\User\Models\User;
use Modules\Wallet\Http\Services\WalletService;

class CourseController extends Controller
{
    public function courses()
    {
        return view('course::panel.courses');
    }

    public function getCourses(Request $request)
    {
        return CourseRepo::getCourses($request);
    }

    public function courseCreate()
    {
        $categories = Category::query()->whereNull('parent_id')->get();
        if (auth()->user()->can('CoursePermission')) {
            $users = User::query()->where('status', User::STATUS_VERIFIED)->select('id', 'name')->get()->toArray();
            $universities = University::query()->where('state', University::VAHED)->select('id', 'name')->get()->toArray();
        } else {
            $users = [['id' => auth()->user()->id, 'name' => 'خودم']];
            $universities = University::query()->where(function ($query) {
                $query->with('admins')->whereHas('admins', function ($q) {
                    $q->where('user_id', auth()->user()->id);
                });
            })->select('id', 'name')->get()->toArray();
        }
        $teachers = auth()->user()->subs->select('id', 'name')->toArray();
        $role = Role::query()->where('slug','teacher')->first();
        $tts = $role->users->select('id','name')->toArray();
        foreach ($tts as $tt){
            array_push($teachers,$tt);
        }
        array_push($teachers,['id' => auth()->user()->id, 'name' => 'خودم']);
        return view('course::panel.create',compact('categories','users','universities','teachers'));
    }

    public function courseStore(CourseRequest $request,ImageService $imageService)
    {
        $input = $request->validated();
        $teacherPercent = $input['teacherPercent'] ?? config('tests.teacherPercent');
        $teacherPercent = $input['ownerPercent'] ?? config('tests.ownerPercent');
        if (($input['teacherPercent'] + $input['ownerPercent'] + config('tests.coursePercent')) > 100) {
            $toasts = ['toast' => [
                [
                    'message' => 'مجموع سهم مدرس و ایجاد کننده نباید بیشتر از '.(100-config('tests.coursePercent')).' باشد',
                    'alert-type' => 'error'
                ]
            ]];
            return back()->with($toasts);
        }
        if ($request->des && str_contains($request->des, 'base64')) {
            $des = CommonServices::saveSummerNote($request->des,'courseDesImg');
            $input['des'] = $des;
        }

        if ($request->hasFile('cover')) {
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'courseCover');
            $resulCover = $imageService->createIndexAndSave($request->file('cover'));
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
        $input['cover'] = $resulCover ?? null;
        $course = CourseService::create($input);
        $toasts = ['toast' => [
            [
                'message' => 'دوره با موفقیت ایجاد شد، در انتظار تایید توسط پشتیبانی باشید',
                'alert-type' => 'success'
            ]
        ]];
        return to_route('panel.course.courses')->with($toasts);
    }

    public function courseEdit(Course $course)
    {
        $categories = Category::query()->whereNull('parent_id')->get();
        if (auth()->user()->can('CoursePermission')) {
            $users = User::query()->where('status', User::STATUS_VERIFIED)->select('id', 'name')->get()->toArray();
            $universities = University::query()->where('state', University::VAHED)->select('id', 'name')->get()->toArray();
        } else {
            $users = [['id' => auth()->user()->id, 'name' => 'خودم']];
            $universities = University::query()->where(function ($query) {
                $query->with('admins')->whereHas('admins', function ($q) {
                    $q->where('user_id', auth()->user()->id);
                });
            })->select('id', 'name')->get()->toArray();
        }
        $teachers = auth()->user()->subs->select('id', 'name')->toArray();
        $role = Role::query()->where('slug','teacher')->first();
        $tts = $role->users->select('id','name')->toArray();
        foreach ($tts as $tt){
            array_push($teachers,$tt);
        }
        array_push($teachers,['id' => auth()->user()->id, 'name' => 'خودم']);
        return view('course::panel.edit',compact('categories','users','universities','course','teachers'));
    }

    public function courseUsers(Course $course)
    {
        $string = '<h4>کاربران دوره</h4><table class="table table-borderless"><thead><tr class="w-100"><th>#</th><th>نام</th><th>دانشگاه</th></tr></thead><tbody>';
        foreach ($course->users as $user) {
            $string .= '<tr>';
            $string .= '<td>'.$user->id.'</td>';
            $nn = $user->name ?? '-';
            $string .= '<td>'.$nn.'</td>';
            $uu = $user->university->name ?? '-';
            $string .= '<td>'.$uu.'</td>';
            $string .= '</tr>';
        }
        $string .= '</tbody></table>';
        return $string;
    }

    public function courseUpdate(CourseUpdateRequest $request,Course $course,ImageService $imageService)
    {
        if(($course->courseable_type == 'Modules\University\Models\University' && in_array($course->courseable_id,array_column(auth()->user()->universities->select('id')->toArray(),'id')))
        || ($course->courseable_type == User::class && $course->courseable_id == auth()->user()->id || auth()->user()->can('CoursePermission'))) {
            $input = $request->validated();
            if (($input['teacherPercent'] + $input['ownerPercent'] + config('tests.coursePercent')) > 100) {
                $toasts = ['toast' => [
                    [
                        'message' => 'مجموع سهم مدرس و ایجاد کننده نباید بیشتر از '.(100-config('tests.coursePercent')).' باشد',
                        'alert-type' => 'error'
                    ]
                ]];
                return back()->with($toasts);
            }
            if ($request->des && str_contains($request->des, 'base64')) {
                $des = CommonServices::saveSummerNote($request->des,'courseDesImg');
                $input['des'] = $des;
            }

            if ($request->hasFile('cover')) {
                $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'courseCover');
                $resulCover = $imageService->createIndexAndSave($request->file('cover'));
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
            $input['cover'] = $resulCover ?? null;
            if(!auth()->user()->can('CoursePermission')) {
                unset($input['status']);
            }
            $course = CourseService::update($input,$course);
            $toasts = ['toast' => [
                [
                    'message' => 'دوره با موفقیت ویرایش شد',
                    'alert-type' => 'success'
                ]
            ]];
            return to_route('panel.course.courses')->with($toasts);
        } else {
            $toasts = ['toast' => [
                [
                    'message' => 'عدم دسترسی',
                    'alert-type' => 'error'
                ]
            ]];
            return to_route('panel.course.courses')->with($toasts);
        }
    }

    public function courseStop(Course $course)
    {
        $course->status = Course::STATUS_STOP;
        $course->save();
        $toasts = ['toast' => [
            [
                'message' => 'دوره با موفقیت متوقف شد',
                'alert-type' => 'success'
            ]
        ]];
        return to_route('panel.course.courses')->with($toasts);
    }

    public function join(Course $course)
    {
        $exists = DB::table('course_user')->where('course_id',$course->id)->where('user_id',auth()->user()->id)->count() > 0;
        if($course->price) {
            return CommonServices::pay($course->price,route('panel.course.joinVerify',$course->id));
        } else {
            if (!$exists) { CourseService::join($course,auth()->user()); }
            $toasts = ['toast' => [
                [
                    'message' => 'ثبت نام شما در این دوره انجام شد',
                    'alert-type' => 'success'
                ]
            ]];
            return to_route('course.course',$course->id)->with($toasts);
        }
    }

    public function joinVerify(Request $request, Course $course)
    {
        if ($request->Status == 'OK') {
            $verify = CommonServices::verify($course->price, $request->Authority);
            if ($verify) {
                CourseService::join($course,auth()->user(),$verify);
                WalletService::deposit(1,$course->price,'پرداخت هزینه ثبت نام در دوره  '.$course->id . ' توسط کاربر شماره ' .auth()->user()->id);
                $toasts = ['toast' => [
                    [
                        'message' => 'ثبت نام شما در این دوره تکمیل شد',
                        'alert-type' => 'success'
                    ]
                ]];
                return to_route('course.course',$course->id)->with($toasts);
            } else {
                $toasts = ['toast' => [
                    [
                        'message' => 'پرداخت شما ناموفق بود! ; پرداخت شما طی 48 ساعت به حساب شما عودت داده می شود',
                        'alert-type' => 'error'
                    ]
                ]];
                return to_route('course.course',$course->id)->with($toasts);
            }
        } else {
            $toasts = ['toast' => [
                [
                    'message' => 'پرداخت شما ناموفق بود! ; پرداخت شما طی 48 ساعت به حساب شما عودت داده می شود',
                    'alert-type' => 'error'
                ]
            ]];
            return to_route('course.course',$course->id)->with($toasts);
        }
    }

    public function createBBB(Request $request)
    {
        $rules = array(
            'id' => 'required|numeric|exists:courses,id',
            'name' => 'required|string|min:2|max:125',
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
        $course = Course::query()->where('id',$request->id)->first();
        if ($course) {
            if(($course->courseable_type == 'Modules\University\Models\University' && in_array($course->courseable_id,array_column(auth()->user()->universities->select('id')->toArray(),'id')))
                || ($course->courseable_type == User::class && $course->courseable_id == auth()->user()->id || $course->teacher_id == auth()->user()->id || auth()->user()->can('CoursePermission'))) {
                $bbb = BBBServices::create($course->id,$request->name,$course->slug,$course,true,CommonServices::pickerToDate($request->date));
                if ($bbb) {
//                    NotifService::sendSMS($counselor->user,0,Notif::EVERY_MINUTE,[$request->date,$request->time],288484); // TODO send all users sms
                    $toasts = ['toast' => [
                        [
                            'message' => 'جلسه ایجاد شد و به کاربران پیامک شد، در روز موردنظر می توانید جلسه را شروع کنید',
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
        }
        abort(404);
    }

    public function getBBBs(Course $course)
    {
        $string = '<h4>جلسات گذشته</h4><table class="table table-borderless"><thead><tr class="w-100"><th>#</th><th>نام</th><th>عملیات</th></tr></thead><tbody>';
        foreach ($course->bbbs as $bbb) {
            $string .= '<tr>';
            $string .= '<td>'.$bbb->id.'</td>';
            $string .= '<td>'.$bbb->name.'</td>';
            if (Carbon::create($bbb->date)->greaterThan(Carbon::now())) {
                $string .= '<td><span class="badge bg-info m-1 text-white">جلسه شروع نشده</span></td>';
            } elseif (Carbon::create($bbb->date)->isCurrentDay(Carbon::now())) {
                    if(($course->courseable_type == 'Modules\University\Models\University' && in_array($course->courseable_id,array_column(auth()->user()->universities->select('id')->toArray(),'id')))
                        || ($course->courseable_type == User::class && $course->courseable_id == auth()->user()->id || $course->teacher_id == auth()->user()->id || auth()->user()->can('CoursePermission'))) {
                        if ($bbb->internalMeetingID) {
                            if (BBBServices::info($bbb)) {
                                $string .= '<td><a target="_blank" href="' . route('bbb.join', ["id" => $bbb->internalMeetingID, "pass" => $bbb->moderatorPW]) . '" class="btn bg-primary text-white m-1">برو به جلسه</a></td>';
                            } else {
                                $string .= '<td><span class="badge bg-danger m-1 text-white">جلسه تمام شده</span></td>';
                            }
                        } else {
                            $string .= '<td><a target="_blank" href="'.route('bbb.create',$bbb->id).'" class="btn bg-primary text-white m-1">شروع جلسه</a></td>';
                        }
                    } else {
                        if ($bbb->internalMeetingID) {
                            if (BBBServices::info($bbb)) {
                                $string .= '<td><a target="_blank" href="' . route('bbb.join', ["id" => $bbb->internalMeetingID, "pass" => $bbb->attendeePW]) . '" class="btn bg-info text-white m-1">برو به جلسه</a></td>';
                            } else {
                                $string .= '<td><span class="badge bg-danger m-1 text-white">جلسه تمام شده</span></td>';
                            }
                        } else {
                            $string .= '<td><span class="badge bg-warning m-1 text-white">در انتظار برای شروع</span></td>';
                        }
                    }
            } else {
                $string .= '<td><span class="badge bg-danger m-1 text-white">پایان یافته</span></td>';
            }
            $string .= '</tr>';
        }
        $string .= '</tbody></table>';
        if(($course->courseable_type == 'Modules\University\Models\University' && in_array($course->courseable_id,array_column(auth()->user()->universities->select('id')->toArray(),'id')))
            || ($course->courseable_type == User::class && $course->courseable_id == auth()->user()->id || $course->teacher_id == auth()->user()->id || auth()->user()->can('CoursePermission'))) {
            $string .= '<form class="row p-4 justify-content-center" action="'. route('panel.course.createBBB') .'" method="post">
                        <input type="hidden" name="_token" value="'.csrf_token().'">
                        <h5>ایجاد جلسه جدید</h5>
                        <input type="hidden" name="id" id="courseId">
                        <div class="col-12 my-1">
                            <label for="name">نام جلسه</label><span class="text-danger">*</span>
                            <input name="name" type="text" id="name" placeholder="مثل: جلسه سوم یا نام سرفصل"
                                   class="form-control" value="">
                        </div>
                        <div class="col-12 my-1">
                            <label for="birthday">تاریخ جلسه</label><span class="text-danger">*</span>
                            <input data-jdp name="date" type="text" id="date"
                                   class="form-control" value="">
                        </div>
                        <div class="col-12 my-1">
                            <label>زمان جلسه</label>
                            <div class="input-group">
                                <input type="text" class="form-control" onfocus="timeP(this)" name="time" style="height: 39.2px">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="mdi mdi-clock-outline"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 my-1">
                            <p class="mb-0 mt-3"><i class="mdi mdi-alert mr-2 text-warning" style="font-size: 20px"></i>جلسه را می توانید در روزی که مشخص کرده اید، آغاز کنید</p>
                        </div>
                        <button type="submit" class="btn btn-primary">ایجاد جلسه</button>
                    </form>';
        }
        return $string;
    }

    public function getFiles(Course $course)
    {
        $string = '<h4>فایل های دوره</h4><table class="table table-borderless"><thead><tr class="w-100"><th>#</th><th>نام</th><th>فایل</th></tr></thead><tbody>';
        foreach ($course->files as $file) {
            $string .= '<tr>';
            $string .= '<td>'.$file->id.'</td>';
            $string .= '<td>'.$file->name.'</td>';
            if ($file->path == 'link') {
                $string .= '<td><a href="'.$file->link.'" class="badge bg-primary m-1 text-white">دانلود</a></td>';
            } else {
                $string .= '<td><a href="'.route('panel.file.courseFileShow',$file->id).'" class="badge bg-info m-1 text-white">دانلود</a></td>';
            }
            $string .= '</tr>';
        }
        $string .= '</tbody></table>';
        if(($course->courseable_type == 'Modules\University\Models\University' && in_array($course->courseable_id,array_column(auth()->user()->universities->select('id')->toArray(),'id')))
            || ($course->courseable_type == User::class && $course->courseable_id == auth()->user()->id || $course->teacher_id == auth()->user()->id || auth()->user()->can('CoursePermission'))) {
            $string .= '<form class="row p-4 justify-content-center" action="'. route('panel.course.createFile') .'" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="'.csrf_token().'">
                            <h5>ایجاد فایل جدید</h5>
                            <input type="hidden" name="id" id="fileCourseId" value="'.$course->id.'">
                            <div class="col-12 my-1">
                                <label for="name">نام فایل</label><span class="text-danger">*</span>
                                <input name="name" type="text" id="name" placeholder="مثل: جزوه جلسه دوم"
                                       class="form-control" value="">
                            </div>
                            <div class="col-12 my-1">
                                <label for="file">فایل</label><span class="text-danger">*</span>
                                <input name="file" type="file" id="file" class="form-control" value="">
                            </div>
                            <div class="col-12 my-1">
                                <label for="link">لینک دانلود</label><span class="text-danger">*</span>
                                <input name="link" type="text" id="link" class="form-control" value="" placeholder="می بایست با http:// یا https:// شروع شود">
                            </div>
                            <span class="text-info w-100">یکی از موارد فایل یا لینک باید پر شود</span>
                            <span class="text-danger w-100">فایل های حجیم را در جای دیگر آپلود کرده و لینک قرار دهید</span>
                            <button type="submit" class="btn btn-primary mt-3">ذخیره</button>
                        </form>';
        }
        return $string;
    }

    public function getExams(Course $course)
    {
        $string = '<h4>آزمون های دوره</h4><table class="table table-borderless"><thead><tr class="w-100"><th>#</th><th>نام</th><th>عملیات</th></tr></thead><tbody>';
        foreach ($course->exams as $exam) {
            $string .= '<tr>';
            $string .= '<td>'.$exam->id.'</td>';
            $string .= '<td>'.$exam->name.'</td>';
            if(($course->courseable_type == 'Modules\University\Models\University' && in_array($course->courseable_id,array_column(auth()->user()->universities->select('id')->toArray(),'id')))
                || ($course->courseable_type == User::class && $course->courseable_id == auth()->user()->id || $course->teacher_id == auth()->user()->id || auth()->user()->can('CoursePermission'))) {
                if($exam->grades->count()) {
                    $string .= '<td>';
                    $string .= '<small class="mb-2">شرکت کنندگان:</small><ul>';
                    foreach ($exam->grades as $grade) {
                        $color = ($exam->pass <= GradeService::getGrade($grade)) ? 'success' : 'danger';
                        $string .= '<li>نام: '.$grade->user->name .'<span class="badge bg-'.$color.' mx-2">'. GradeService::getGrade($grade) .' از '. ExamService::sumRates($exam).'</span></li>';
                    }
                    $string .= '</ul></td>';
                } else {
                    $string .= '<td><a target="_blank" onClick="sweetConfirm(event)" href="' . route('panel.exam.deleteExam',$exam->id) . '" class="badge bg-danger m-1 text-white">حذف آزمون</a></td>';
                }
            } else {
                $grade = Grade::query()->where('exam_id',$exam->id)->where('user_id',auth()->user()->id)->first();
                if ($grade) {
                    $userGrade = GradeService::getGrade($grade);
                    $color = ($exam->pass <= $userGrade) ? 'success' : 'danger';
                    $string .= '<td><span class="badge bg-'.$color.' m-1 text-white">نمره شما: '.$userGrade.' از '.ExamService::sumRates($exam).'</span></td>';
                } else {
                    $string .= '<td><a target="_blank" href="' . route('panel.exam.takeExam',$exam->id). '" class="badge bg-info m-1 text-white">شرکت در آزمون</a></td>';
                }
            }
            $string .= '</tr>';
        }
        $string .= '</tbody></table>';
        if(($course->courseable_type == 'Modules\University\Models\University' && in_array($course->courseable_id,array_column(auth()->user()->universities->select('id')->toArray(),'id')))
            || ($course->courseable_type == User::class && $course->courseable_id == auth()->user()->id || $course->teacher_id == auth()->user()->id || auth()->user()->can('CoursePermission'))) {
            $string .= '<a href="'.route('panel.exam.createExam',$course->id).'" class="btn btn-block btn-pink">ایجاد آزمون</a>';
        }
        return $string;
    }

    public function createFile(Request $request)
    {
        $rules = array(
            'id' => 'required|numeric|exists:courses,id',
            'name' => 'required|string|min:2|max:125',
            'link' => 'nullable|url',
            'file' => 'nullable|mimes:jpg,bmp,png,webp,pdf,zip,rar,txt,mp4|max:1024000',
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
        if (!isset($request->link) && !$request->file) {
            $toasts = ['toast' => [
                [
                    'message' => 'وارد لینک یا فایل الزامیست',
                    'alert-type' => 'error'
                ]
            ]];
            return back()->with($toasts);
        }
        $course = Course::query()->where('id',$request->id)->first();
        if ($course) {
            if ($request->link) {
                FileService::linkSave($course, $request->link,$request->name);
            } else {
                FileService::save('courseFiles', $request->file, $course,$request->name);
            }
            $toasts = ['toast' => [
                [
                    'message' => 'فایل ذخیره شد و برای شرکت کنندگان قابل رویت شد',
                    'alert-type' => 'success'
                ]
            ]];
            return back()->with($toasts);
        }
        abort(404);
    }

    public function getBBBFiles(Course $course)
    {
        $allRecords = BBBServices::getRecordings();
        $string = '<h4>فایل های جلسات</h4><table class="table table-borderless"><thead><tr class="w-100"><th>نام</th><th>فایل</th></tr></thead><tbody>';
        foreach ($allRecords->getRecords() as $file) {
            if (in_array($file->getMeetingId(),array_column($course->bbbs->select('meetingID')->toArray(),'meetingID'))) {
                $string .= '<tr>';
                $string .= '<td>' . $file->getName() . '</td>';
                $string .= '<td><a target="_blank" href="' .$file->getPlaybackUrl() . '" class="badge bg-info m-1 text-white">مشاهده</a></td>';
                $string .= '</tr>';
            }
        }
        $string .= '</tbody></table>';
        return $string;
    }

    public function getAllBBBFiles()
    {
        if (auth()->user()->can('CoursePermission')) {
            $allRecords = BBBServices::getRecordings();
            $string = '<h4>فایل های جلسات</h4><table class="table table-borderless"><thead><tr class="w-100"><th>نام دوره</th><th>نام فایل</th><th>تاریخ</th><th>فایل</th><th>حذف</th></tr></thead><tbody>';
            foreach ($allRecords->getRecords() as $file) {
                $string .= '<tr>';
                $bbb = BBB::query()->where('meetingID',$file->getMeetingId())->first();
                if ($bbb && $bbb->bbbable) {
                    $string .= '<td>' . $bbb->bbbable->name . '</td>';
                    $string .= '<td>' . $file->getName() . '</td>';
                    $string .= '<td>' . verta(Carbon::parse($bbb->date))->formatDifference() . '</td>';
                } else {
                    $string .= '<td>نامشخص</td>';
                    $string .= '<td>' . $file->getName() . '</td>';
                    $string .= '<td>نامشخص</td>';
                }
                $string .= '<td><a target="_blank" href="' .$file->getPlaybackUrl() . '" class="badge bg-info m-1 text-white">مشاهده</a></td>';
                $string .= '<td><a onClick="sweetConfirm(event)" target="_blank" href="' . route('bbb.deleteRecord',$file->getRecordId()) . '" class="badge bg-danger m-1 text-white">حذف</a></td>';
                $string .= '</tr>';
            }
            $string .= '</tbody></table>';
            return $string;
        }
        abort(403);
    }

    public function certificate(Course $course)
    {
        if(DB::table('course_user')->where('course_id',$course->id)->where('user_id',auth()->user()->id)->count() > 0 && $course->status == Course::STATUS_FINISHED) {
            return view('course::panel.certificate',compact('course'));
        }
        abort(403);
    }
}
