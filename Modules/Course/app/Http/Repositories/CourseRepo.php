<?php

namespace Modules\Course\Http\Repositories;
use Modules\Category\Models\Category;
use Modules\Course\Models\Course;
use Modules\University\Models\University;
use Modules\User\Models\User;

class CourseRepo
{
    public static function getCourses($request)
    {
        $columns_list = array(
            0 => 'id',
            1 => 'status',
            2 => 'name',
            3 => 'slug',
            4 => 'courseable',
            5 => 'teacher',
            6 => 'limit',
            7 => 'price',
            8 => 'detail',
        );
        $linkObj = new Course();
        if (!auth()->user()->can('CoursePermission')){
            $linkObj = $linkObj->where(function ($query) {
                $query->with('courseable')->whereHasMorph('courseable',University::class, function ($q) {
                    $q->whereHas('admins', function ($qq) {
                        $qq->where('user_id', auth()->user()->id);
                    });
                });
            });
            $linkObj = $linkObj->orWhere(function ($q2) {
                $q2->where('courseable_type',User::class)->where('courseable_id',auth()->user()->id);
            });
            $linkObj = $linkObj->orWhereHas('users',function ($q3) {
                $q3->where('user_id', auth()->user()->id);
            });
            $linkObj = $linkObj->orWhere('teacher_id',auth()->user()->id);
        }
        $totalDataRecord = $linkObj->count();
        $totalFilteredRecord = $totalDataRecord;
        $limit_val = $request->input('length');
        $start_val = $request->input('start');
        $order_val = $columns_list[$request->input('order.0.column')] ?? 'id';
        $dir_val = $request->input('order.0.dir') ?? 'asc';

        if (empty($request->input('search.value'))) {
            $post_data = $linkObj;
            if ($request->input('length') != -1) {
                $post_data = $post_data->offset($start_val);
            }
            $post_data = $post_data->limit($limit_val)->orderBy($order_val, $dir_val)->get();
        } else {
            $search_text = $request->input('search.value');

            $post_data = $linkObj->where(function ($query) use ($search_text) {
                $query->where('id', 'Like', "%{$search_text}%")
                    ->orWhere('name', 'Like', "%{$search_text}%")
                    ->orWhere('slug', 'Like', "%{$search_text}%")
                    ->orWhere('des', 'Like', "%{$search_text}%")
                    ->orWhere(function ($query) use ($search_text) {
                        $query->with('teacher')->whereHas('teacher', function ($q) use ($search_text) {
                            $q->where('name','Like', "%{$search_text}%");
                        });
                    })->orWhere(function ($query) use ($search_text) {
                        $query->with('courseable')->whereHas('courseable', function ($q) use ($search_text) {
                            $q->where('name','Like', "%{$search_text}%");
                        });
                    });
            });
            if ($request->input('length') != '-1') {
                $post_data = $post_data->offset($start_val);
            }
            $post_data = $post_data->limit($limit_val)->orderBy($order_val, $dir_val)->get();

            $totalFilteredRecord = $linkObj
                ->where(function ($query) use ($search_text) {
                    $query->where('id', 'Like', "%{$search_text}%")
                        ->orWhere('name', 'Like', "%{$search_text}%")
                        ->orWhere('slug', 'Like', "%{$search_text}%")
                        ->orWhere('des', 'Like', "%{$search_text}%")
                        ->orWhere(function ($query) use ($search_text) {
                            $query->with('teacher')->whereHas('teacher', function ($q) use ($search_text) {
                                $q->where('name','Like', "%{$search_text}%");
                            });
                        })->orWhere(function ($query) use ($search_text) {
                            $query->with('courseable')->whereHas('courseable', function ($q) use ($search_text) {
                                $q->where('name','Like', "%{$search_text}%");
                            });
                        });
                })
                ->count();
        }

        $data_val = array();
        if (!empty($post_data)) {
            foreach ($post_data as $key => $post_val) {
                $postnestedData['id'] = $post_val->id ?? '-';
                $postnestedData['status'] = '<span class="badge bg-' . $post_val->classStatus() . '">' . $post_val->nameStatus() . '</span>' ?? '-';
                $postnestedData['name'] = $post_val->name ?? '-';
                $postnestedData['slug'] = '<a href="'.route('course.course',$post_val->id).'" class="btn btn-sm btn-secondary">'.$post_val->slug.'</a>'; // TODO
                $postnestedData['courseable'] = $post_val->courseable->name ?? '-';
                $postnestedData['teacher'] = $post_val->teacher->name ?? '-';
                $postnestedData['limit'] = $post_val->limit ?? '-'; // TODO
                $postnestedData['price'] = number_format($post_val->price) .' تومان';
                $postnestedData['detail'] = '<td>';
                $postnestedData['detail'] .= '<button onclick="setIdBBB('.$post_val->id.',this)" lll="'.route('panel.course.getBBBs',$post_val->id).'" type="button" class="btn btn-info m-1" data-toggle="modal" data-target="#bbb" data-toggle="tooltip" data-placement="bottom" title="جلسات آنلاین"><i class="mdi mdi-microphone mr-1"></i>جلسات آنلاین</button>';
                $postnestedData['detail'] .= '<button onclick="setIdFile('.$post_val->id.',this)" lll="'.route('panel.course.getFiles',$post_val->id).'" type="button" class="btn btn-secondary m-1" data-toggle="modal" data-target="#files" data-toggle="tooltip" data-placement="bottom" title="فایل های دوره"><i class="mdi mdi-file mr-1"></i>فایل های دوره</button>';
                $postnestedData['detail'] .= '<button onclick="setBBBFiles('.$post_val->id.',this)" lll="'.route('panel.course.getBBBFiles',$post_val->id).'" type="button" class="btn btn-success m-1" data-toggle="modal" data-target="#bbbFiles" data-toggle="tooltip" data-placement="bottom" title="فایل های جلسات"><i class="mdi mdi-file-video mr-1"></i>فایل های جلسات</button>';
                $postnestedData['detail'] .= '<button onclick="setExams('.$post_val->id.',this)" lll="'.route('panel.course.getExams',$post_val->id).'" type="button" class="btn btn-pink m-1" data-toggle="modal" data-target="#exams" data-toggle="tooltip" data-placement="bottom" title="آزمون های دوره"><i class="mdi mdi-check-all mr-1"></i>آزمون های دوره</button>';
                if(($post_val->courseable_type == 'Modules\University\Models\University' && in_array($post_val->courseable_id,array_column(auth()->user()->universities->select('id')->toArray(),'id')))
                    || ($post_val->courseable_type == 'Modules\User\Models\User' && $post_val->courseable_id == auth()->user()->id || auth()->user()->can('CoursePermission'))) {
                    $postnestedData['detail'] .= '<a class="btn btn-icon  btn-warning" href="' . route('panel.course.courseEdit', $post_val->id) . '" data-toggle="tooltip" data-placement="bottom" title="ویرایش"><i class="fas fa-edit"></i></a>';
                    $postnestedData['detail'] .= '<button class="btn btn-icon mx-1 btn-primary" onclick="setUsers('.$post_val->id.',this)" lll="'.route('panel.course.courseUsers',$post_val->id).'" data-toggle="modal" data-target="#users" data-toggle="tooltip" data-placement="bottom" title="کاربران دوره"><i class="fas fa-users"></i></button>';
                    if ($post_val->status !== Course::STATUS_STOP) {
                        $postnestedData['detail'] .= '<a onClick="sweetConfirm(event)" class="btn btn-icon  btn-danger mx-1" href="' . route('panel.course.courseStop', $post_val->id) . '" data-toggle="tooltip" data-placement="bottom" title="توقف دوره"><i class="far fa-stop-circle"></i></a>';
                    }
                } else {
                    if ($post_val->status == Course::STATUS_FINISHED) {
                        $postnestedData['detail'] .= '<a class="btn btn-purple m-1" href="' . route('panel.course.certificate', $post_val->id) . '" data-toggle="tooltip" data-placement="bottom" title="گواهینامه دوره"><i class="fas fa-award mr-1"></i>گواهینامه دوره</a>';
                    }
                }
                $postnestedData['detail'] .= '</td>';
                $data_val[$key] = $postnestedData;

            }
        }
        $draw_val = $request->input('draw');
        $get_json_data = array(
            "draw" => intval($draw_val),
            "recordsTotal" => intval($totalDataRecord),
            "recordsFiltered" => intval($totalFilteredRecord),
            "data" => $data_val
        );
        return json_encode($get_json_data);
    }

    public static function moreCourses($request)
    {
        if ($request->req['category']) {
            $category = Category::query()->where('id',request()->query('category'))->first();
            if(isset($category->courses)) {
                $courses = $category->courses->whereIn('status',[Course::STATUS_VERIFIED,Course::STATUS_FINISHED]);
            } else {
                return false;
            }
        } else {
            $courses = Course::query()->whereIn('status',[Course::STATUS_VERIFIED,Course::STATUS_FINISHED]);
        }
        if ($request->req['free']) {
            $courses = $courses->where('price','0');
        }
        if ($request->req['s']){
            if (get_class($courses) === 'Illuminate\Database\Eloquent\Builder') {
                $courses = $courses->where('name','like','%'.request()->query('s').'%');
            } elseif (get_class($courses) === 'Illuminate\Database\Eloquent\Collection') {
                $courses = $courses->filter(function ($course) {
                    return stripos($course->name, request()->query('s')) !== false;
                });
            }
        }
        $num = $request->num*9;
        if (get_class($courses) === 'Illuminate\Database\Eloquent\Builder') {
            $courses = $courses->skip($num)->take(10)->orderBy('id','DESC')->get();
        } elseif (get_class($courses) === 'Illuminate\Database\Eloquent\Collection') {
            $courses = $courses->skip($num)->take(10)->sortBy('id');
        }
        $string = '';
        if ($courses->count()) {
            foreach ($courses as $course) {
                $string .= '<a href="'. route("course.course",$course->id) .'" style="display: flex; justify-content: center;">
                    <div class="card-test d-flex flex-column">
                        <div class="top">';
                            if($course->cover) {
                                $string .= '<img src="'. asset($course->cover["indexArray"][$course->cover["currentImage"]]) .'" alt="company logo"/>';
                            } else {
                                $string .= '<img src="'. asset("assets-front/img/ka.png") .'" alt="company logo"/>';
                            }
                $string .= '</div>
                        <div class="bottom flex-grow-1 d-flex flex-column">
                            <div class="content d-flex flex-column flex-grow-1">
                                <h2 class="fs-16 fw-sb le-6">'. $course->name .'</h2>
                            </div>
                            <div class="card-footer">
                                <div class="d-flex flex-row justify-content-between pb-4">
                                    <span class="d-flex align-items-center gap-2 color-gray-3 fs-14 fw-r le-6"><i class="fas fa-school"></i>برگزاری توسط: '. $course->courseable->name .'</span>
                                </div>
                                <div class="d-flex flex-row justify-content-between pb-4 bb-1">
                                    <span class="d-flex align-items-center gap-2 color-gray-3 fs-14 fw-r le-6"><i class="fas fa-chalkboard-teacher"></i>مدرس: '. $course->teacher->name .'</span>
                                </div>
                                <div class="d-flex flex-row justify-content-between pb-4 mt-2">
                                    <span class="d-flex align-items-end gap-2 color-gray-3 fs-16 fw-r le-6"><i
                                            class="fas fa-users"
                                            style="padding-bottom: .5rem;"></i> <span>ظرفیت: '. (($course->limit) ? $course->limit . 'نفر' : 'نامحدود') .'</span></span>
                                    <span class="d-flex flex-column">
                                            <span class="fs-16 fw-b le-6"
                                                  style="color: var(--green)"> '. (($course->price) ? number_format($course->price) . 'تومان' : 'رایگان') .'</span>
                                        </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>';
            }
            return $string;
        } else {
            return false;
        }
    }
}
