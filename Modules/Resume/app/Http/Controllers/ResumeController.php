<?php

namespace Modules\Resume\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Hekmatinasser\Verta\Verta;
use Modules\User\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Category\Models\Category;
use Modules\Common\Models\Ostan;
use Modules\Resume\Http\Requests\ResumeRequest;
use Modules\Resume\Models\Resume;

class ResumeController extends Controller
{
    public function resume()
    {
        if (auth()->user()->email) {
            $resume = auth()->user()->resume;
            $ostans = Ostan::all();
            $categories = Category::query()->whereNull('parent_id')->get();
            return view('resume::edit',compact('resume','ostans','categories'));
        } else {
            $toasts = ['toast' => [
                [
                    'message' => 'قبل از ساخت رزومه، ایمیل و تصویر پروفایل خود را انتخاب کنید',
                    'alert-type' => 'info'
                ]
            ]];
            return to_route('panel.user.profile')->with($toasts);
        }
    }

    public function editResume(ResumeRequest $request)
    {
        $input = $request->validated();
        $links = $langs = $skills = $courses = $projects = $edues = $careers = null;
        for ($i = 0; $i < count($input['career_name']); $i++) {
            if ($input['career_name'][$i]) {
                $careers[$i]['career_name'] = $input['career_name'][$i];
                $careers[$i]['career_title'] = $input['career_title'][$i];
                $careers[$i]['career_time'] = $input['career_time'][$i];
                $careers[$i]['career_job'] = $input['career_job'][$i];
                $careers[$i]['career_des'] = $input['career_des'][$i];
            }
        }
        for ($i = 0; $i < count($input['edu_name']); $i++) {
            if ($input['edu_degree'][$i]) {
                $edues[$i]['edu_degree'] = $input['edu_degree'][$i];
                $edues[$i]['edu_name'] = $input['edu_name'][$i];
                $edues[$i]['edu_field'] = $input['edu_field'][$i];
                $edues[$i]['edu_time'] = $input['edu_time'][$i];
                $edues[$i]['edu_point'] = $input['edu_point'][$i];
                $edues[$i]['edu_continue'] = $input['edu_continue'][$i];
                $edues[$i]['edu_des'] = $input['edu_des'][$i];
            }
        }
        for ($i = 0; $i < count($input['project_name']); $i++) {
            if ($input['project_name'][$i]) {
                $projects[$i]['project_name'] = $input['project_name'][$i];
                $projects[$i]['project_address'] = $input['project_address'][$i];
                $projects[$i]['project_time'] = $input['project_time'][$i];
                $projects[$i]['project_skills'] = $input['project_skills'][$i];
                $projects[$i]['project_des'] = $input['project_des'][$i];
            }
        }
        for ($i = 0; $i < count($input['course_name']); $i++) {
            if ($input['course_name'][$i]) {
                $courses[$i]['course_name'] = $input['course_name'][$i];
                $courses[$i]['course_link'] = $input['course_link'][$i];
                $courses[$i]['course_time'] = $input['course_time'][$i];
            }
        }
        for ($i = 0; $i < count($input['skill_name']); $i++) {
            if ($input['skill_name'][$i]) {
                $skills[$i]['skill_name'] = $input['skill_name'][$i];
                $skills[$i]['skill_level'] = $input['skill_level'][$i];
            }
        }
        for ($i = 0; $i < count($input['lang_name']); $i++) {
            if ($input['lang_name'][$i]) {
                $langs[$i]['lang_name'] = $input['lang_name'][$i];
                $langs[$i]['lang_level'] = $input['lang_level'][$i];
            }
        }
        for ($i = 0; $i < count($input['social_name']); $i++) {
            if ($input['social_name'][$i]) {
                $links[$i]['social_name'] = $input['social_name'][$i];
                $links[$i]['social_value'] = $input['social_value'][$i];
            }
        }
        DB::transaction(function () use ($input,$links,$langs,$skills,$courses,$projects,$edues,$careers) {
            $resume = Resume::updateOrCreate(['user_id' => auth()->user()->id],[
                'skill' => $input['skill'],
                'birthday' => Verta::parse($input['birthday'].' 14:12:32')->datetime(),
                'gender' => $input['gender'],
                'military' => $input['military'] ?? null,
                'status' => $input['status'],
                'martial' => $input['martial'],
                'aboutMe' => $input['aboutMe'],
                'jobType' => (isset($input['jobType'])) ? json_encode($input['jobType'],JSON_UNESCAPED_UNICODE) : null,
                'wageDemand' => $input['wageDemand'] ?? null,
                'links' => ($links) ? json_encode($links,JSON_UNESCAPED_UNICODE) : null,
                'career' => ($careers) ? json_encode($careers,JSON_UNESCAPED_UNICODE) : null,
                'edu' => ($edues) ? json_encode($edues,JSON_UNESCAPED_UNICODE) : null,
                'langs' => ($langs) ? json_encode($langs,JSON_UNESCAPED_UNICODE) : null,
                'projects' => ($projects) ? json_encode($projects,JSON_UNESCAPED_UNICODE) : null,
                'courses' => ($courses) ? json_encode($courses,JSON_UNESCAPED_UNICODE) : null,
                'skills' => ($skills) ? json_encode($skills,JSON_UNESCAPED_UNICODE) : null
            ]);
            if (isset($input['category_id'])) $resume->categories()->sync($input['category_id']);
            if (isset($input['shahrestan'])) $resume->shahrestan()->sync($input['shahrestan']);
        });
        $toasts = ['toast' => [
            [
                'message' => 'رزومه شما ساخته شد',
                'alert-type' => 'success'
            ]
        ]];
        return to_route('panel.resume.resume')->with($toasts);
    }

    public function seeResume($id)
    {
        $user = User::query()->where('id',$id)->first();
        if ($user && isset($user->resume)) {
            $resume = $user->resume;
            return view('resume::resume',compact('resume'));
        } else {
            $toasts = ['toast' => [
                [
                    'message' => 'رزومه موردنظر یافت نشد',
                    'alert-type' => 'info'
                ]
            ]];
            return to_route('home')->with($toasts);
        }
    }
}
