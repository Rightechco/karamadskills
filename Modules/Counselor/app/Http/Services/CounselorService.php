<?php

namespace Modules\Counselor\Http\Services;

use Modules\Counselor\Models\Counselor;

class CounselorService
{
    public static function create($name,$user,$counselor,$price)
    {
        return Counselor::query()->create([
           'name' => $name,
            'user_id' => $user,
            'counselor_id' => $counselor,
            'price' => $price
        ]);
    }
}
