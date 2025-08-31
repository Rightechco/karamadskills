<?php

namespace Modules\Course\Http\Services;

use Illuminate\Support\Facades\DB;
use Modules\Category\Models\Category;
use Modules\Common\Models\Pay;
use Modules\Course\Models\Course;
use Modules\University\Models\University;
use Modules\User\Models\User;

class CourseService
{
    public static function create($request)
    {
        $course = DB::transaction(function () use ($request) {
            if (strpos($request['courseable'],'u') === false) {
                $courseable = User::query()->where('id',$request['courseable'])->first();
            } else {
                $str = explode('_',$request['courseable']);
                $courseable = University::query()->where('id',$str[1])->first();
            }
            $course = Course::query()->create([
                'name' => $request['name'],
                'slug' => $request['slug'] ?? null,
                'courseable_type' => get_class($courseable),
                'courseable_id' => $courseable->id,
                'teacher_id' => $request['teacher'],
                'cover'=> $request['cover'],
                'expert' => $request['expert'] ?? null,
                'des' => $request['des'] ?? null,
                'tags' => $request['tags'] ?? null,
                'note'=> $request['note'] ?? null,
                'price' => $request['price'] ?? 0,
                'ownerPercent' => $request['ownerPercent'] ?? config('tests.ownerPercent'),
                'teacherPercent' => $request['teacherPercent'] ?? config('tests.teacherPercent'),
                'limit' => $request['limit'] ?? 0,
            ]);
            if (isset($request['category_id'])) $course->categories()->sync($request['category_id']);
            return $course;
        });
        return $course;
    }

    public static function update($request,Course $course)
    {
        $course = DB::transaction(function () use ($request,$course) {
            if (strpos($request['courseable'],'u') === false) {
                $courseable = User::query()->where('id',$request['courseable'])->first();
            } else {
                $str = explode('_',$request['courseable']);
                $courseable = University::query()->where('id',$str[1])->first();
            }
            $course->update([
                'name' => $request['name'] ?? $course->name,
                'slug' => $request['slug'] ?? $course->name,
                'status' => $request['status'] ?? $course->status,
                'courseable_type' => get_class($courseable),
                'courseable_id' => $courseable->id,
                'teacher_id' => $request['teacher'] ?? $course->teacher_id,
                'cover'=> $request['cover'] ?? $course->cover,
                'expert' => $request['expert'] ?? $course->expert,
                'des' => $request['des'] ?? $course->des,
                'tags' => $request['tags'] ?? $course->tags,
                'note'=> $request['note'] ?? $course->note,
                'price' => $request['price'] ?? $course->price,
                'ownerPercent' => $request['ownerPercent'] ?? $course->ownerPercent,
                'teacherPercent' => $request['teacherPercent'] ?? $course->teacherPercent,
                'limit' => $request['limit'] ?? $course->limit,
            ]);
            if (isset($request['category_id'])) $course->categories()->sync($request['category_id']);
            return $course;
        });
        return $course;
    }

    public static function join(Course $course,User $user,$pay_id = null)
    {
        $course->users()->attach($user->id,['pay_id' => $pay_id]);
    }
}
