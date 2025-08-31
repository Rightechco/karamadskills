<?php

namespace Modules\Course\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Category\Models\Category;
use Modules\Course\Http\Repositories\CourseRepo;
use Modules\Course\Models\Course;

class CourseFrontController
{
    public function courses()
    {
        $categories = Category::query()->whereNull('parent_id')->select('id','name')->get();
        if (request()->query('category')) {
            $category = Category::query()->where('id',request()->query('category'))->first();
            $courses = $category->courses->whereIn('status',[Course::STATUS_VERIFIED,Course::STATUS_FINISHED]);
        } else {
            $courses = Course::query()->whereIn('status',[Course::STATUS_VERIFIED,Course::STATUS_FINISHED]);
        }
        if (request()->query('free')) {
            $courses = $courses->where('price','0');
        }
        if (request()->query('s')){
            if (get_class($courses) === 'Illuminate\Database\Eloquent\Builder') {
                $courses = $courses->where('name','like','%'.request()->query('s').'%');
            } elseif (get_class($courses) === 'Illuminate\Database\Eloquent\Collection') {
                $courses = $courses->filter(function ($course) {
                    return stripos($course->name, request()->query('s')) !== false;
                });
            }
        }
        if (get_class($courses) === 'Illuminate\Database\Eloquent\Builder') {
            $courses = $courses->take(9)->orderBy('id','DESC')->get();
        } elseif (get_class($courses) === 'Illuminate\Database\Eloquent\Collection') {
            $courses = $courses->take(9)->sortBy('id');
        }
        return view('course::courses',compact('categories','courses'));
    }

    public function moreCourses(Request $request)
    {
        return CourseRepo::moreCourses($request);
    }

    public function course(Course $course)
    {
        return view('course::course',compact('course'));
    }
}
