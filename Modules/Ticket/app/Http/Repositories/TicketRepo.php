<?php

namespace Modules\Ticket\Http\Repositories;

use Modules\Ticket\Models\Ticket;

class TicketRepo
{
    public static function getTickets($request)
    {
        $columns_list = array(
            0 => 'id',
            1 => 'status',
            2 => 'title',
            3 => 'receiver',
            4 => 'detail',
        );
        $linkObj = new Ticket();
        $linkObj = $linkObj->whereNull('parent_id');
        if (!auth()->user()->can('TicketPermission')){
            $linkObj = $linkObj->where(function ($query) {
                $query->where('user_id',auth()->user()->id)->orWhere('receiver_id',auth()->user()->id);
            });
        }
        $totalDataRecord = $linkObj->count();
        $totalFilteredRecord = $totalDataRecord;
        $limit_val = $request->input('length');
        $start_val = $request->input('start');
        $order_val = $columns_list[$request->input('order.0.column')] ?? 'id';
        $dir_val = $request->input('order.0.dir') ?? 'asc';

        if (empty($request->input('search.value'))) {
            $post_data = $linkObj;
            if ($request->input('length') != -1) {
                $post_data = $post_data->offset($start_val);
            }
            $post_data = $post_data->limit($limit_val)->orderBy($order_val, $dir_val)->get();
        } else {
            $search_text = $request->input('search.value');

            $post_data = $linkObj->where(function ($query) use ($search_text) {
                $query->where('id', 'Like', "%{$search_text}%")
                    ->orWhere('name', 'Like', "%{$search_text}%")
                    ->orWhere('text', 'Like', "%{$search_text}%");
            });
            if ($request->input('length') != '-1') {
                $post_data = $post_data->offset($start_val);
            }
            $post_data = $post_data->limit($limit_val)->orderBy($order_val, $dir_val)->get();

            $totalFilteredRecord = $linkObj
                ->where(function ($query) use ($search_text) {
                    $query->where('id', 'Like', "%{$search_text}%")
                        ->orWhere('name', 'Like', "%{$search_text}%")
                        ->orWhere('text', 'Like', "%{$search_text}%");
                })
                ->count();
        }

        $data_val = array();
        if (!empty($post_data)) {
            foreach ($post_data as $key => $post_val) {
                $postnestedData['id'] = $post_val->id ?? '-';
                $postnestedData['status'] = '<span class="badge bg-' . $post_val->classStatus() . '">' . $post_val->nameStatus() . '</span>' ?? '-';
                $postnestedData['title'] = $post_val->name ?? '-';
                $postnestedData['receiver'] = ($post_val->user_id == auth()->user()->id) ? $post_val->receiver->name : $post_val->user->name;
                $bb = (($post_val->unSeenSender && $post_val->user_id == auth()->user()->id) || ($post_val->unSeenReceiver && $post_val->receiver_id == auth()->user()->id)) ? 'btn-danger' : 'btn-info';
                $postnestedData['detail'] = '<td><a class="btn btn-icon  '.$bb.'" href="' . route('panel.ticket.ticket', $post_val->id) . '" data-toggle="tooltip" data-placement="bottom" title="مشاهده"><i class="mdi mdi-eye"></i> مشاهده</a></td>';
                $data_val[$key] = $postnestedData;

            }
        }
        $draw_val = $request->input('draw');
        $get_json_data = array(
            "draw" => intval($draw_val),
            "recordsTotal" => intval($totalDataRecord),
            "recordsFiltered" => intval($totalFilteredRecord),
            "data" => $data_val
        );
        return json_encode($get_json_data);
    }
}
