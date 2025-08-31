<?php

namespace Modules\Wallet\Http\Repositories;

use Modules\Wallet\Models\Withdraw;

class WithdrawRepo
{
    public static function getTransactions($request)
    {
        $columns_list = array(
            0 => 'id',
            1 => 'card',
            2 => 'amount',
            3 => 'trans',
            4 => 'status',
            5 => 'date',
        );

        $user = auth()->user();
        $walletId = $user->wallet->id;
        $linkObj = new Withdraw();
        $linkObj = $linkObj->where('wallet_id', $walletId);
        $totalDataRecord = $linkObj->count();
        $totalFilteredRecord = $totalDataRecord;
        $limit_val = $request->input('length');
        $start_val = $request->input('start');
        $order_val = $columns_list[$request->input('wallet.0.column')] ?? 'id';
        $dir_val = $request->input('wallet.0.dir') ?? 'asc';

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
                        ->orWhere('status', 'Like', "%{$search_text}%")
                        ->orWhere('transaction_id', 'Like', "%{$search_text}%");
                });
            if ($request->input('length') != '-1') {
                $post_data = $post_data->offset($start_val);
            }
            $post_data = $post_data->limit($limit_val)->orderBy($order_val, $dir_val)->get();

            $totalFilteredRecord = $linkObj
                ->where(function ($query) use ($search_text) {
                    $query->where('id', 'Like', "%{$search_text}%")
                        ->orWhere('amount', 'Like', "%{$search_text}%")
                        ->orWhere('status', 'Like', "%{$search_text}%")
                        ->orWhere('transaction_id', 'Like', "%{$search_text}%");
                })
                ->count();
        }
        $data_val = array();
        if (!empty($post_data)) {
            foreach ($post_data as $key => $post_val) {
                $postnestedData['id'] = $user->id ?? '-';
                $postnestedData['card'] = $post_val->user->wallet->card->shaba_number ?? '-';
                $postnestedData['amount'] = ($post_val->amount) ? number_format($post_val->amount) : '-';
                $postnestedData['trans'] = $post_val->transaction_id ?? '-';
                $postnestedData['status'] = '<span class="badge bg-' . $post_val->classStatus() . '">' . $post_val->nameStatus() . '</span>' ?? '-';
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

    public static function getWithraw($request)
    {
        if (auth()->user()->can(['WithdrawPermission'])) {
            $columns_list = array(
                0 => 'id',
                1 => 'card_id',
                2 => 'shaba_number',
                3 => 'card_number',
                4 => 'cardName',
                5 => 'amount',
                6 => 'date',
                7 => 'transaction',
                8 => 'status',
                9 => 'detail'
            );
            $linkObj = new Withdraw();
            $totalDataRecord = $linkObj->count();
            $totalFilteredRecord = $totalDataRecord;
            $limit_val = $request->input('length');
            $start_val = $request->input('start');
            $order_val = $columns_list[$request->input('order.0.column')] ?? 'id';
            $dir_val = $request->input('order.0.dir') ?? 'asc';
            $user = auth()->user();

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
                            ->orWhere('status', 'Like', "%{$search_text}%")
                            ->orWhere('transaction_id', 'Like', "%{$search_text}%");
                    });
                if ($request->input('length') != '-1') {
                    $post_data = $post_data->offset($start_val);
                }
                $post_data = $post_data->limit($limit_val)->orderBy($order_val, $dir_val)->get();

                $totalFilteredRecord = $linkObj
                    ->where(function ($query) use ($search_text) {
                        $query->where('id', 'Like', "%{$search_text}%")
                            ->orWhere('amount', 'Like', "%{$search_text}%")
                            ->orWhere('status', 'Like', "%{$search_text}%")
                            ->orWhere('transaction_id', 'Like', "%{$search_text}%");
                    })
                    ->count();
            }
            $data_val = array();
            if (!empty($post_data)) {
                foreach ($post_data as $key => $post_val) {
                    $postnestedData['id'] = $post_val->id ?? '-';
                    $postnestedData['user_id'] = $post_val->wallet->user->id ?? '-';
                    $postnestedData['shaba_number'] = $post_val->card->shaba_number ?? '-';
                    $postnestedData['card_number'] = $post_val->card->card_number ?? '-';
                    $postnestedData['cardName'] = $post_val->card->card_holder_name ?? '-';
                    $postnestedData['amount'] = $post_val->amount ?? '-';
                    $postnestedData['date'] = ($post_val->created_at->toJalali()->format('Y/m/d')) ?? '-';
                    $postnestedData['transaction'] = $post_val->transaction_id ?? '-';
                    $postnestedData['status'] = '<span class="badge bg-' . $post_val->classStatus() . '">' . $post_val->nameStatus() . '</span>' ?? '-';
                    $postnestedData['detail'] = '<td>
                                            <a class="btn btn-icon  btn-info" href="' . route('panel.withdraw.withdrawEdit', $post_val->id) . '" data-toggle="tooltip" data-placement="bottom" title="ویرایش"><i class="mdi mdi-square-edit-outline"></i></a>
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
}
