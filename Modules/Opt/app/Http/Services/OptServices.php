<?php

namespace Modules\Opt\Http\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Config;
use Modules\Opt\Models\Opt;
use Modules\User\Models\User;

class OptServices
{
    public static function create(User $user)
    {
        $opt = Opt::query()->where('user_id',$user->id)->orderBy('created_at', 'desc')->first();
        if ($opt && self::validateOpt($opt->code,$user->id)) {
            $opt->expire_time = Carbon::now()->addMinute(Config::get('opt.expire_time'));
            $opt->save();
            return $opt->code;
        } else {
            $opt = mt_rand(100000,999999);
            Opt::query()->create([
                'user_id' => $user->id,
                'name' => $user->name ?? 'کاربر جدید',
                'code' => $opt,
                'expire_time' => Carbon::now()->addMinute(Config::get('opt.expire_time'))
            ]);
            return $opt;
        }
    }

    public static function validateOpt($code,$user_id)
    {
        $opt = Opt::query()->where('code',$code)->where('user_id',$user_id)->orderBy('created_at', 'desc')->first();
        if ($opt) {
            if (Carbon::create($opt->expire_time)->greaterThan(Carbon::now())){
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
