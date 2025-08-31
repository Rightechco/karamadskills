<?php

namespace Modules\University\Http\Services;

use Modules\University\Models\University;

class UniversityService
{
    public static function create($request)
    {
        $university = University::query()->create([
           'name' => $request['name'],
            'slug' => $request['slug'] ?? null,
            'state' => $request['state'],
            'type' => $request['type'],
            'parent_id' => $request['parent_id'] ?? null,
            'text' => $request['text'] ?? null,
            'tell' => $request['tell'] ?? null,
            'website' => $request['website'] ?? null,
            'gallery' => $request['gallery'] ?? null,
            'logo' => $request['logo'] ?? null,
            'stamp' => $request['stamp'] ?? null
        ]);
        $university->admins()->sync($request['admins'] ?? []);
        return $university;
    }

    public static function updateContent($request,University $university)
    {
        $university->update([
            'text' => $request['text'] ?? $university->name,
            'tell' => $request['tell'] ?? $university->slug,
            'website' => $request['website'] ?? $university->website,
            'gallery' => $request['gallery'] ?? $university->gallery,
            'logo' => $request['logo'] ?? $university->logo,
            'stamp' => $request['stamp'] ?? $university->stamp,
        ]);
        return $university;
    }

    public static function update($request,University $university)
    {
        $university->update([
            'name' => $request['name'] ?? $university->name,
            'slug' => $request['slug'] ?? $university->slug,
            'state' => $request['state'] ?? $university->state,
            'type' => $request['type'] ?? $university->type,
            'parent_id' => $request['parent_id'] ?? $university->parent_id,
            'text' => $request['text'] ?? $university->text,
            'tell' => $request['tell'] ?? $university->tell,
            'website' => $request['website'] ?? $university->website,
            'gallery' => $request['gallery'] ?? $university->gallery,
            'logo' => $request['logo'] ?? $university->logo,
            'stamp' => $request['stamp'] ?? $university->stamp,
        ]);
        $university->admins()->sync($request['admins'] ?? []);
        return $university;
    }
}
