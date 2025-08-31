<?php

namespace Modules\Company\Http\Repositories;

use Modules\Company\Models\Company;

class CompanyRepo
{
    public static function getCompanies($request)
    {
        $columns_list = array(
            0 => 'id',
            1 => 'user',
            2 => 'status',
            3 => 'name',
            4 => 'slug',
            5 => 'logo',
            6 => 'detail'
        );
        $linkObj = new Company();
        if (!auth()->user()->can('CompanyPermission')){
            $linkObj = $linkObj->where('user_id', auth()->user()->id);
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

            $post_data = $linkObj
                ->where(function ($query) use ($search_text) {
                    $query->where('id', 'Like', "%{$search_text}%")
                        ->orWhere('name', 'Like', "%{$search_text}%")
                        ->orWhere('slug', 'Like', "%{$search_text}%")
                        ->orWhere('expert', 'Like', "%{$search_text}%")
                        ->orWhere('des', 'Like', "%{$search_text}%");
                });
            if ($request->input('length') != '-1') {
                $post_data = $post_data->offset($start_val);
            }
            $post_data = $post_data->limit($limit_val)->orderBy($order_val, $dir_val)->get();

            $totalFilteredRecord = $linkObj
                ->where(function ($query) use ($search_text) {
                    $query->where('id', 'Like', "%{$search_text}%")
                        ->orWhere('name', 'Like', "%{$search_text}%")
                        ->orWhere('slug', 'Like', "%{$search_text}%")
                        ->orWhere('expert', 'Like', "%{$search_text}%")
                        ->orWhere('des', 'Like', "%{$search_text}%");
                })
                ->count();
        }

        $data_val = array();
        if (!empty($post_data)) {
            foreach ($post_data as $key => $post_val) {
                $postnestedData['id'] = $post_val->id ?? '-';
                $postnestedData['user'] = $post_val->user->name ?? '-';
                $postnestedData['status'] = '<span class="badge bg-' . $post_val->classStatus() . '">' . $post_val->nameStatus() . '</span>' ?? '-';
                $postnestedData['name'] = $post_val->name ?? '-';
                $postnestedData['slug'] = $post_val->slug ?? '-';
                $postnestedData['logo'] = isset($post_val->logo['currentImage']) ? '<img width="50px" height="50px" src="' . asset($post_val->logo['indexArray']['small']) . '">' : '-';
                $postnestedData['detail'] = '<td>
                                            <a class="btn btn-icon  btn-primary" href="' . route('panel.company.companiesEdit', $post_val->id) . '" data-toggle="tooltip" data-placement="bottom" title="ویرایش"><i class="fas fa-edit"></i></a>
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
