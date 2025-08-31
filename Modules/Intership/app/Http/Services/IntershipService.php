<?php

namespace Modules\Intership\Http\Services;

use Modules\Intership\Models\Intership;

class IntershipService
{
    public static function create($user_id,$announcement_id)
    {
        return Intership::query()->create([
            'user_id' => $user_id,
            'announcement_id' => $announcement_id,
            'university_id' => auth()->user()->university_id
        ]);
    }
}
