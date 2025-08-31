<?php

namespace Modules\Comment\Http\Repositories;

use Modules\Comment\Models\Comment;

class CommentRepo
{
    public static function getComments($request)
    {
        $columns_list = array(
            0 => 'id',
            1 => 'status',
            2 => 'name',
            3 => 'commentable',
            4 => 'rate',
            5 => 'detail'
        );
        $linkObj = new Comment();
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

            $post_data = $linkObj
                ->where(function ($query) use ($search_text) {
                    $query->where('id', 'Like', "%{$search_text}%")
                        ->orWhere('title', 'Like', "%{$search_text}%")
                        ->orWhere('body', 'Like', "%{$search_text}%");
                });
            if ($request->input('length') != '-1') {
                $post_data = $post_data->offset($start_val);
            }
            $post_data = $post_data->limit($limit_val)->orderBy($order_val, $dir_val)->get();

            $totalFilteredRecord = $linkObj
                ->where(function ($query) use ($search_text) {
                    $query->where('id', 'Like', "%{$search_text}%")
                        ->orWhere('title', 'Like', "%{$search_text}%")
                        ->orWhere('body', 'Like', "%{$search_text}%");
                })
                ->count();
        }

        $data_val = array();
        if (!empty($post_data)) {
            foreach ($post_data as $key => $post_val) {
                $postnestedData['id'] = $post_val->id ?? '-';
                $postnestedData['name'] = $post_val->user->name ?? '-';
                $postnestedData['commentable'] = $post_val->commentable->name ?? '-';
                $postnestedData['rate'] = $post_val->rating ?? '-';
                $postnestedData['detail'] = '<td>
                                            <button onclick="setText('.$post_val->id.',this)" lll="'.route('panel.comment.getText',$post_val->id).'" type="button" class="btn btn-primary m-1" data-toggle="modal" data-target="#replyModal" class="btn btn-icon  btn-primary" data-toggle="tooltip" data-placement="bottom" title="مشاهده"><i class="mdi mdi-eye"></i></button>';
                if (is_null($post_val->parent_id)) {
                    $postnestedData['detail'] .= '<a onClick = "sweetConfirm(event)" class="btn btn-icon  btn-success mx-1" href = "' . route('panel.comment.commentVerify', $post_val->id) . '" data-toggle = "tooltip" data-placement = "bottom" title = "تایید" ><i class="far fa-check-circle" ></i></a>
                                                  <a onClick = "sweetConfirm(event)" class="btn btn-icon  btn-danger mx-1" href = "' . route('panel.comment.commentUnVerify', $post_val->id) . '" data-toggle = "tooltip" data-placement = "bottom" title = "رد" ><i class="fas fa-plus-circle" style="rotate: 45deg"></i></a>';
                    $postnestedData['status'] = '<span class="badge bg-' . $post_val->classStatus() . '">' . $post_val->nameStatus() . '</span>' ?? '-';
                } else {
                    $postnestedData['status'] = '<span class="badge bg-secondary">پاسخ ادمین</span>' ?? '-';
                }
                $postnestedData['detail'] .= '</td>';
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
