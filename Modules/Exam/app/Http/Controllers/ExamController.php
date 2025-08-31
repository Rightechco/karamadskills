<?php

namespace Modules\Exam\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Course\Models\Course;
use Modules\Exam\Http\Requests\ExamRequest;
use Modules\Exam\Http\Services\ExamService;
use Modules\Exam\Http\Services\GradeService;
use Modules\Exam\Models\Exam;
use Modules\Exam\Models\Grade;
use Modules\University\Models\University;
use Modules\User\Models\User;

class ExamController extends Controller
{
    public function createExam(Course $course)
    {
        if(($course->courseable_type == 'Modules\University\Models\University' && in_array($course->courseable_id,array_column(auth()->user()->universities->select('id')->toArray(),'id')))
            || ($course->courseable_type == User::class && $course->courseable_id == auth()->user()->id || $course->teacher_id == auth()->user()->id || auth()->user()->can('CoursePermission'))) {
            return view('exam::panel.create',compact('course'));
        }
        abort(403);
    }

    public function storeExam(ExamRequest $request,Course $course)
    {
        if(($course->courseable_type == 'Modules\University\Models\University' && in_array($course->courseable_id,array_column(auth()->user()->universities->select('id')->toArray(),'id')))
            || ($course->courseable_type == User::class && $course->courseable_id == auth()->user()->id || $course->teacher_id == auth()->user()->id || auth()->user()->can('CoursePermission'))) {
            $sumRate = 0;
            foreach ($request->qrate as $rate) {
                $sumRate += $rate;
            }
            if ($request->pass > $sumRate) {
                $toasts = ['toast' => [
                    [
                        'message' => 'نمره قبولی نمی تواند از جمع نمرات بیشتر باشد',
                        'alert-type' => 'error'
                    ]
                ]];
                return back()->with($toasts);
            }
            if (count($request->qname) !== count(array_unique($request->qname))) {
                $toasts = ['toast' => [
                    [
                        'message' => 'عنوان سوال نباید تکراری باشد',
                        'alert-type' => 'error'
                    ]
                ]];
                return back()->with($toasts);
            }
            $exam = ExamService::create($request->validated(),$course->id);
            $toasts = ['toast' => [
                [
                    'message' => 'آزمون شما با موفقیت ایجاد شد',
                    'alert-type' => 'success'
                ]
            ]];
            return to_route('panel.course.courses')->with($toasts);
        }
    }

    public function takeExam(Exam $exam)
    {
        if(in_array($exam->course->id,array_column(auth()->user()->courses->select('id')->toArray(),'id'))) {
            $grade = Grade::query()->where('exam_id',$exam->id)->where('user_id',auth()->user()->id)->first();
            if ($grade) {
                $toasts = ['toast' => [
                    [
                        'message' => 'قبلا در این آزمون شرکت کرده اید',
                        'alert-type' => 'error'
                    ]
                ]];
                return to_route('panel.course.courses')->with($toasts);
            }
            return view('exam::panel.takeExam',compact('exam'));
        }
        $toasts = ['toast' => [
            [
                'message' => 'می بایست عضو دوره باشید',
                'alert-type' => 'error'
            ]
        ]];
        return to_route('panel.course.courses')->with($toasts);
    }

    public function takeExamStore(Request $request , Exam $exam)
    {
        if(in_array($exam->course->id,array_column(auth()->user()->courses->select('id')->toArray(),'id'))) {
            $grade = Grade::query()->where('exam_id',$exam->id)->where('user_id',auth()->user()->id)->first();
            if ($grade) {
                $toasts = ['toast' => [
                    [
                        'message' => 'قبلا در این آزمون شرکت کرده اید',
                        'alert-type' => 'error'
                    ]
                ]];
                return to_route('panel.course.courses')->with($toasts);
            }
            $answer = [];
            for ($i = 0; $i < count(json_decode($exam->exam)); $i++) {
                if (is_numeric($request->{"answer" . $i})) {
                    $answer[] = $request->{"answer" . $i};
                } else {
                    $answer[] = 0;
                }
            }
            GradeService::create($answer,$exam->id,auth()->user()->id);
            $toasts = ['toast' => [
                [
                    'message' => 'نتیجه آزمون شما ثبت شد',
                    'alert-type' => 'success'
                ]
            ]];
            return to_route('panel.course.courses')->with($toasts);
        }
        $toasts = ['toast' => [
            [
                'message' => 'می بایست عضو دوره باشید',
                'alert-type' => 'error'
            ]
        ]];
        return to_route('panel.course.courses')->with($toasts);
    }

    public function deleteExam(Exam $exam)
    {
        if(($exam->course->courseable_type == University::class && in_array($exam->course->courseable_id,array_column(auth()->user()->universities->select('id')->toArray(),'id')))
            || ($exam->course->courseable_type == User::class && $exam->course->courseable_id == auth()->user()->id || $exam->course->teacher_id == auth()->user()->id || auth()->user()->can('CoursePermission'))) {
            $exam->delete();
            $toasts = ['toast' => [
                [
                    'message' => 'آزمون حزف شد',
                    'alert-type' => 'success'
                ]
            ]];
            return to_route('panel.course.courses')->with($toasts);
        }
        abort(403);
    }
}
