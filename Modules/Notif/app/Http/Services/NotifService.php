<?php

namespace Modules\Notif\Http\Services;

use Carbon\Carbon;
use Modules\Notif\Models\Notif;
use Modules\User\Models\User;

class NotifService
{
    public static function sendSMS(User $user, $admin_id, $time, $text, $code = null)
    {
        $notif = Notif::query()->create([
            'user_id' => $user->id,
            'name' => $user->name ?? 'کاربر جدید',
            'admin_id' => $admin_id == 0 ? null : $admin_id,
            'time' => $time,
            'type' => Notif::TYPE_SMS,
            'text' => json_encode($text,JSON_UNESCAPED_UNICODE),
            'subject' => $code
        ]);
        if ($time == Notif::EVERY_SECOND) {
            $res = SMSService::send($user->mobile,json_encode($text,JSON_UNESCAPED_UNICODE),strval($code));
            $notif->update([
                'status' => Notif::STATUS_SENT,
                'sented_at' => Carbon::now(),
                'res' => $res
            ]);
        }
    }

    public static function sendMail(User $user, $admin_id, $time, $subject, $text)
    {
        Notif::query()->create([
            'user_id' => $user->id,
            'name' => $user->name ?? 'کاربر جدید',
            'admin_id' => $admin_id == 0 ? null : $admin_id,
            'time' => $time,
            'type' => Notif::TYPE_EMAIL,
            'subject' => $subject,
            'text' => $text
        ]);
    }

    public static function sendTelegram(User $user, $admin_id, $time, $text)
    {
        Notif::query()->create([
            'user_id' => $user->id,
            'name' => $user->name ?? 'کاربر جدید',
            'admin_id' => $admin_id == 0 ? null : $admin_id,
            'time' => $time,
            'type' => Notif::TYPE_TELEGRAM,
            'text' => $text
        ]);
    }
}
