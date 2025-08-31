<?php

namespace Modules\Visit\Http\Services;

use Modules\Visit\Models\Visit;

class VisitService
{
    public static function create($request)
    {
        $visit = Visit::query()->create([
            'name' => $request['name'],
            'slug' => $request['slug'] ?? null,
            'university_id' => $request['university_id'] ?? null,
            'image' => $request['image'] ?? null,
            'expert' => $request['expert'] ?? null,
            'des' => $request['des'] ?? null,
            'tags' => $request['tags'] ?? null,
            'video' => $request['video'] ?? null,
            'videoLink' => $request['videoLink'] ?? null,
        ]);
        return $visit;
    }

    public static function update($request,$item)
    {
        $item = $item->update([
            'name' => $request['name'] ?? $item->name,
            'slug' => $request['slug'] ?? $item->slug,
            'status' => $request['status'] ?? $item->status,
            'university_id' => $request['university_id'] ?? null,
            'image' => $request['image'] ?? $item->image,
            'expert' => $request['expert'] ?? $item->expert,
            'des' => $request['des'] ?? $item->des,
            'tags' => $request['tags'] ?? $item->tags,
            'video' => $request['video'] ?? $item->videolink,
            'videoLink' => $request['videoLink'] ?? $item->videolink,
        ]);
        return $item;
    }
}
