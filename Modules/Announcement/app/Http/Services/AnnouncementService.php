<?php

namespace Modules\Announcement\Http\Services;
use Illuminate\Support\Facades\DB;
use Modules\Announcement\Models\Announcement;
use Modules\Category\Models\Category;

class AnnouncementService
{
    public static function create($request)
    {
        $announcement = DB::transaction(function () use ($request) {
            $announcement = Announcement::query()->create([
                'name' => $request['name'],
                'company_id' => $request['company'],
                'ostan_id' => $request['ostan'],
                'shahrestan_id' => $request['shahrestan'],
                'wage' => $request['wage'] ?? null,
                'background' => $request['background'] ?? null,
                'edu' => $request['edu'] ?? null,
                'des' => $request['des'] ?? null,
                'tags' => $request['tags'] ?? null,
                'gender' => $request['gender'] ?? null,
                'military' => $request['military'] ?? null,
                'universityIntership' => $request['universityIntership'] ?? 0,
                'jobType' => ($request['jobType']) ? json_encode($request['jobType'], JSON_UNESCAPED_UNICODE) : null,
                'test' => (isset($request['test'])) ? json_encode($request['test'], JSON_UNESCAPED_UNICODE) : null,
                'location' => json_encode([$request['announcementLat'],$request['announcementLang']])
            ]);
            $cats = [$request['category_id']];
            $father = Category::query()->where('id',$request['category_id'])->first();
            if ($father) {
                $father = $father->parent;
                array_push($cats,$father->id);
            }
            if (isset($request['category_id'])) $announcement->categories()->sync($cats);
            return $announcement;
        });
        return $announcement;
    }

    public static function update($request,Announcement $announcement)
    {
        $announcement = DB::transaction(function () use ($request,$announcement) {
            $announcement->update([
                'name' => $request['name'] ?? $announcement->name,
                'status' => $request['status'] ?? $announcement->status,
                'company_id' => $request['company'] ?? $announcement->company,
                'ostan_id' => $request['ostan'] ?? $announcement->ostan,
                'shahrestan_id' => $request['shahrestan'] ?? $announcement->shahrestan,
                'wage' => $request['wage'] ?? $announcement->wage,
                'background' => $request['background'] ?? $announcement->background,
                'edu' => $request['edu'] ?? $announcement->edu,
                'des' => $request['des'] ?? $announcement->des,
                'tags' => $request['tags'] ?? $announcement->tags,
                'gender' => $request['gender'] ?? $announcement->gender,
                'military' => $request['military'] ?? $announcement->martial,
                'universityIntership' => $request['universityIntership'] ?? $announcement->universityIntership,
                'jobType' => ($request['jobType']) ? json_encode($request['jobType'], JSON_UNESCAPED_UNICODE) : $announcement->jobType,
                'test' => (isset($request['test'])) ? json_encode($request['test'], JSON_UNESCAPED_UNICODE) : null,
                'location' => ($request['announcementLat'] && $request['announcementLang']) ? json_encode([$request['announcementLat'],$request['announcementLang']]) : $announcement->location
            ]);
            if (isset($request['category_id'])) $announcement->categories()->sync($request['category_id']);
            return $announcement;
        });
        return $announcement;
    }
}
