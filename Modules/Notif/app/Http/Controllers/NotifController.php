<?php

namespace Modules\Notif\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Modules\Notif\Http\Services\SMSService;
use Modules\Notif\Models\Notif;

class NotifController extends Controller
{
    public function second($id)
    {
        if ($id == config('notif.gate')){
            $this->sendNotif(Notif::EVERY_SECOND);
        } else {
            abort(404);
        }
    }

    public function minute($id)
    {
        if ($id == config('notif.gate')){
            $this->sendNotif(Notif::EVERY_MINUTE);
        } else {
            abort(404);
        }
    }

    public function hour($id)
    {
        if ($id == config('notif.gate')){
            $this->sendNotif(Notif::EVERY_HOUR);
        } else {
            abort(404);
        }
    }

    public function hour4($id)
    {
        if ($id == config('notif.gate')){
            $this->sendNotif(Notif::EVERY_4HOUR);
        } else {
            abort(404);
        }
    }

    public function hour12($id)
    {
        if ($id == config('notif.gate')){
            $this->sendNotif(Notif::EVERY_12HOUR);
        } else {
            abort(404);
        }
    }

    public function daily($id)
    {
        if ($id == config('notif.gate')){
            $this->sendNotif(Notif::EVERY_DAY);
        } else {
            abort(404);
        }
    }

    public function sendNotif($time)
    {
        $notif = Notif::query()->where('time',$time)
            ->where('status',Notif::STATUS_NOT_SENT)->first();
        if ($notif){
            switch ($notif->type) {
                case Notif::TYPE_SMS:
                    $res = SMSService::send($notif->user->mobile,strval($notif->text),$notif->subject);
                    $notif->update([
                       'status' => Notif::STATUS_SENT,
                       'sented_at' => Carbon::now(),
                       'res' => $res
                    ]);
                break;
                case Notif::TYPE_EMAIL:
                    // TODO
                break;
                case Notif::TYPE_TELEGRAM:
                    // TODO
                break;
                default:
                    abort(500);
            }
        } else {
            abort(500);
        }
    }
}
