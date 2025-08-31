<?php

namespace Modules\Incentive\Http\Services;

use Modules\Incentive\Models\Incentive;
use Modules\User\Models\User;

class IncentiveService
{
    public static function create(User $user)
    {
        return Incentive::query()->create([
           'user_id' => $user->id,
            'type_id' => $user->university->parent->parent->id,
            'ostan_id' => $user->university->parent->id,
            'university_id' => $user->university->id,
        ]);
    }

    public static function addIncentive(Incentive $incentive,$json)
    {
        $incentive->incentive = $json;
        $incentive->save();
    }

    public static function updateIncentive(Incentive $incentive,$json)
    {
        $incentive->incentive = $json;
        $incentive->score = null;
        $incentive->meeting = null;
        $incentive->reject = null;
        $incentive->status = Incentive::STATUS_WAIT;
        $incentive->save();
    }
}
