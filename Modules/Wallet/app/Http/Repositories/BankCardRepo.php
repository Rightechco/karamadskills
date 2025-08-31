<?php

namespace Modules\Wallet\Http\Repositories;


use Modules\Wallet\Models\BankCard;

class BankCardRepo
{

    public static function changeStatus($id, $status)
    {
        $card = BankCard::query()->find($id);
        return $card->update(['status' => $status]);
    }

    public static function getCards($request)
    {
        $columns_list = array(
            0 => 'id',
            1 => 'user_id',
            2 => 'shaba_number',
            3 => 'card_number',
            4 => 'cardName',
            5 => 'default',
            6 => 'date',
            7 => 'status',
            8 => 'detail'
        );
        $linkObj = new BankCard();
        $totalDataRecord = $linkObj->count();
        $totalFilteredRecord = $totalDataRecord;
        $limit_val = $request->input('length');
        $start_val = $request->input('start');
        $order_val = $columns_list[$request->input('order.0.column')] ?? 'id';
        $dir_val = $request->input('order.0.dir') ?? 'asc';

        if (empty($request->input('search.value'))) {
            $post_data = $linkObj;
            if ($request->input('length') != '-1') {
                $post_data = $post_data->offset($start_val);
            }
            $post_data = $post_data->limit($limit_val)->orderBy($order_val, $dir_val)->get();
        } else {
            $search_text = $request->input('search.value');

            $post_data = $linkObj
                ->where(function ($query) use ($search_text) {
                    $query->where('id', 'Like', "%{$search_text}%")
                        ->orWhere('userId', 'Like', "%{$search_text}%")
                        ->orWhere('shaba_number', 'Like', "%{$search_text}%")
                        ->orWhere('card_number', 'Like', "%{$search_text}%")
                        ->orWhere('date', 'Like', "%{$search_text}%")
                        ->orWhere('status', 'Like', "%{$search_text}%");
                });
            if ($request->input('length') != '-1') {
                $post_data = $post_data->offset($start_val);
            }
            $post_data = $post_data->limit($limit_val)->orderBy($order_val, $dir_val)->get();

            $totalFilteredRecord = $linkObj
                ->where(function ($query) use ($search_text) {
                    $query->where('id', 'Like', "%{$search_text}%")
                        ->orWhere('userId', 'Like', "%{$search_text}%")
                        ->orWhere('shaba_number', 'Like', "%{$search_text}%")
                        ->orWhere('card_number', 'Like', "%{$search_text}%")
                        ->orWhere('date', 'Like', "%{$search_text}%")
                        ->orWhere('status', 'Like', "%{$search_text}%");
                })
                ->count();
        }
        $data_val = array();
        if (!empty($post_data)) {
            foreach ($post_data as $key => $post_val) {
                $postnestedData['id'] = $post_val->id;
                $postnestedData['user_id'] = $post_val->user_id ?? '-';
                $postnestedData['shaba_number'] = $post_val->shaba_number ?? '-';
                $postnestedData['card_number'] = $post_val->card_number ?? '-';
                $postnestedData['cardName'] = $post_val->card_holder_name ?? '-';
                $postnestedData['default'] = $post_val->default ?? '-';
                $postnestedData['date'] = ($post_val->created_at->toJalali()->format('H:i:s Y/m/d')) ?? '-';
                $postnestedData['status'] = '<span class="badge bg-' . $post_val->classStatus() . '">' . $post_val->nameStatus() . '</span>' ?? '-';
                $postnestedData['detail'] = '<td>
                                            <a class="btn btn-icon  btn-success" href="' . route('panel.card.approveStatus', $post_val->id) . '" data-toggle="tooltip" data-placement="bottom" title="تایید"><i class="mdi mdi-check"></i></a>
                                            </td>
                                            <td>
                                            <a class="btn btn-icon  btn-danger" href="' . route('panel.card.NotApproveStatus', $post_val->id) . '" data-toggle="tooltip" data-placement="bottom" title="عدم تایید"><i class="mdi mdi-window-close"></i></a>
                                            </td>';
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
