<?php

namespace Modules\Ticket\Http\Services;

use Modules\Ticket\Models\Ticket;

class TicketService
{
    public static function create($request,$receiver,$user)
    {
        return Ticket::query()->create([
            'user_id' => $user,
            'receiver_id' => $receiver,
            'name' => $request['name'],
            'text' => $request['text'],
        ]);
    }

    public static function reply($request,$receiver,$user,$parent)
    {
        return Ticket::query()->create([
            'user_id' => $user,
            'receiver_id' => $receiver,
            'parent_id' => $parent,
            'text' => $request['text'],
            'unSeenReceiver' => 0
        ]);
    }
}
