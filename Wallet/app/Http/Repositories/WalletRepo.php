<?php

namespace Modules\Wallet\Http\Repositories;

use Modules\Wallet\Models\WalletTrac;

class WalletRepo
{
    public static function getTransactions($request)
    {
        $columns_list = array(
            0 => 'id',
            1 => 'date',
            2 => 'amount',
            3 => 'type',
            4 => 'des',
            5 => 'detail'
        );
        $user = auth()->user();
        $walletId = $user->wallet->id;
        $linkObj = new WalletTrac();
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
                    $query->where('id', 'Like', "%{$search_text}%")
                        ->orWhere('amount', 'Like', "%{$search_text}%")
                        ->orWhere('type', 'Like', "%{$search_text}%")
                        ->orWhere('des', 'Like', "%{$search_text}%");
                });
            if ($request->input('length') != '-1') {
                $post_data = $post_data->offset($start_val);
            }
            $post_data = $post_data->limit($limit_val)->orderBy($order_val, $dir_val)->get();

            $totalFilteredRecord = $linkObj
                ->where(function ($query) use ($search_text) {
                    $query->where('id', 'Like', "%{$search_text}%")
                        ->orWhere('amount', 'Like', "%{$search_text}%")
                        ->orWhere('type', 'Like', "%{$search_text}%")
                        ->orWhere('des', 'Like', "%{$search_text}%");
                })
                ->count();
        }
        $data_val = array();
        if (!empty($post_data)) {
            foreach ($post_data as $key => $post_val) {
                $postnestedData['id'] = $post_val->id;
                $postnestedData['date'] = ($post_val->created_at->toJalali()->format('Y/m/d')) ?? '-';
                $postnestedData['amount'] = $post_val->amount ?? '-';
                if ($post_val->type == WalletTrac::DEPOSIT)
                    $postnestedData['type'] = '<span class="badge bg-success">'.__('messages.' . $post_val->type ?? '-').'</span>';
                else
                    $postnestedData['type'] = '<span class="badge bg-danger">'.__('messages.' . $post_val->type ?? '-').'</span>';
                $postnestedData['des'] = $post_val->des ?? '-';
                $postnestedData['detail'] = '<td>
                                            <a class="btn btn-icon  btn-primary" href="' . route('panel.wallet.factor', $post_val->id) . '" data-toggle="tooltip" data-placement="bottom" title="فاکتور"><i class="fas fa-list"></i></a>
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
