<?php

namespace Modules\Ticket\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\File\Http\Services\FileService;
use Modules\Ticket\Http\Repositories\TicketRepo;
use Modules\Ticket\Http\Requests\ReplyRequest;
use Modules\Ticket\Http\Requests\SendRequest;
use Modules\Ticket\Http\Services\TicketService;
use Modules\Ticket\Models\Ticket;
use Modules\User\Models\User;

class TicketController extends Controller
{
    public function tickets()
    {
        return view('ticket::panel.tickets');
    }

    public function getTickets(Request $request)
    {
        return TicketRepo::getTickets($request);
    }

    public function send($slug)
    {
        $user = User::query()->where('slug',$slug)->first();
        if ($user) {
            return view('ticket::panel.send',compact('slug','user'));
        } else {
            $toasts = ['toast' => [
                [
                    'message' => 'کاربر یافت نشد!',
                    'alert-type' => 'error'
                ]
            ]];
            return back()->with($toasts);
        }
    }

    public function sendMessage(SendRequest $request)
    {
        $receiver = User::query()->where('slug',$request->slug)->first();
        if ($receiver) {
            $ticket = TicketService::create($request->validated(),$receiver->id,auth()->user()->id);
            if ($request->hasFile('input')) {
                foreach($request->file('input') as $file){
                    FileService::save('ticketFiles',$file,$ticket);
                }
            }
            $toasts = ['toast' => [
                [
                    'message' => 'پیام شما با موفقیت ارسال شد',
                    'alert-type' => 'success'
                ]
            ]];
            return to_route('panel.ticket.tickets')->with($toasts);
        } else {
            $toasts = ['toast' => [
                [
                    'message' => 'کاربر یافت نشد!',
                    'alert-type' => 'error'
                ]
            ]];
            return back()->with($toasts);
        }
    }

    public function ticket(Ticket $ticket)
    {
        if ($ticket->user_id == auth()->user()->id || $ticket->receiver_id == auth()->user()->id || auth()->user()->can('TicketPermission')) {
            if($ticket->user_id == auth()->user()->id) {
                $ticket->unSeenSender = 0;
            } elseif ($ticket->receiver_id == auth()->user()->id) {
                $ticket->unSeenReceiver = 0;
            }
            $ticket->save();
        } else {
            abort(403);
        }
        return view('ticket::panel.ticket',compact('ticket'));
    }

    public function sendReply(ReplyRequest $request)
    {
        $ticket = Ticket::query()->where('id',$request->id)->first();
        if ($ticket){
            if ($ticket->user_id == auth()->user()->id || $ticket->receiver_id == auth()->user()->id || auth()->user()->can('TicketPermission')) {
                if (auth()->user()->id == $ticket->receiver_id) {
                    $newTicket = TicketService::reply($request->validated(),$ticket->user_id,auth()->user()->id,$ticket->id);
                } else {
                    $newTicket = TicketService::reply($request->validated(),$ticket->receiver_id,auth()->user()->id,$ticket->id);
                }
                if ($request->hasFile('input')) {
                    foreach($request->file('input') as $file){
                        FileService::save('ticketFiles',$file,$newTicket);
                    }
                }
                if($ticket->user_id == auth()->user()->id) {
                    $ticket->unSeenSender = 0;
                    $ticket->unSeenReceiver = 1;
                } else {
                    $ticket->unSeenSender = 1;
                    $ticket->unSeenReceiver = 0;
                }
                $ticket->save();
                $toasts = ['toast' => [
                    [
                        'message' => 'پیام شما با موفقیت ارسال شد',
                        'alert-type' => 'success'
                    ]
                ]];
                return to_route('panel.ticket.tickets')->with($toasts);
            }
        }
        $toasts = ['toast' => [
            [
                'message' => 'خطایی رخ داده!',
                'alert-type' => 'error'
            ]
        ]];
        return back()->with($toasts);
    }
}
