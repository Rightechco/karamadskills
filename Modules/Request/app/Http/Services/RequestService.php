<?php

namespace Modules\Request\Http\Services;

use Modules\Request\Models\Request;

class RequestService
{
    public static function create($user_id,$announcement_id)
    {
        return Request::query()->create([
           'user_id' => $user_id,
           'announcement_id' => $announcement_id
        ]);
    }

}
