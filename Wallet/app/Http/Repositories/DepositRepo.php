<?php

namespace Modules\Wallet\Http\Repositories;

use Modules\Wallet\Models\Deposit;

class DepositRepo
{
    public static function getDeposits($request)
    {
        $columns_list = array(
            0 => 'id',
            1 => 'trac',
            2 => 'amount',
            3 => 'ref',
            4 => 'date'
        );
        $user = auth()->user();
        $walletId = $user->wallet->id;
        $linkObj = new Deposit();
        $linkObj = $linkObj->where('wallet_id', $walletId);
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
                    $query->where('id', 'Like', "%{$search_text}%");
                });
            if ($request->input('length') != '-1') {
                $post_data = $post_data->offset($start_val);
            }
            $post_data = $post_data->limit($limit_val)->orderBy($order_val, $dir_val)->get();

            $totalFilteredRecord = $linkObj
                ->where(function ($query) use ($search_text) {
                    $query->where('id', 'Like', "%{$search_text}%");
                })
                ->count();
        }
        $data_val = array();
        if (!empty($post_data)) {
            foreach ($post_data as $key => $post_val) {
                $postnestedData['id'] = $post_val->id ?? '-';
                $postnestedData['trac'] = $post_val->pay->transactionId ?? '-';
                $postnestedData['amount'] = $post_val->pay->amount ?? '-';
                $postnestedData['ref'] = $post_val->pay->ref ?? '-';
                $postnestedData['date'] = ($post_val->created_at->toJalali()->format('Y/m/d')) ?? '-';
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
