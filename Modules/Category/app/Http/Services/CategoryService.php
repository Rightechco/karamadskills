<?php

namespace Modules\Category\Http\Services;

use Modules\Category\Models\Category;

class CategoryService
{
    public static function store($request)
    {
        return Category::query()->create([
            'parent_id' => ($request['parent_id'] == 0) ? null : $request['parent_id'],
            'name' => $request['name'],
            'slug' => $request['slug'] ?? null
        ]);
    }

    public static function update(Category $category,$request)
    {
        $category->update([
            'parent_id' => ($request['parent_id'] == 0) ? null : $request['parent_id'],
            'name' => $request['name'] ?? $category->name,
            'slug' => $request['slug'] ?? $category->slug
        ]);
    }
}
