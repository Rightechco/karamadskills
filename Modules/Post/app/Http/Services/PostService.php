<?php

namespace Modules\Post\Http\Services;

use Modules\Post\Models\Post;

class PostService
{
    public static function create($request)
    {
        $post = Post::query()->create([
            'name' => $request['name'],
            'user_id' => auth()->user()->id,
            'slug' => $request['slug'] ?? null,
            'university_id' => $request['university_id'] ?? null,
            'image' => $request['image'] ?? null,
            'expert' => $request['expert'] ?? null,
            'des' => $request['des'] ?? null,
            'tags' => $request['tags'] ?? null,
            'slider' => $request['slider'] ?? 0
        ]);
        return $post;
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
            'slider' => $request['slider'] ?? 0
        ]);
        return $item;
    }
}
