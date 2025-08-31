<?php

namespace Modules\Incentive\Http\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Modules\Incentive\Models\Incentive;

class IncentiveExport implements FromArray,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function array(): array
    {
        $incentives = Incentive::all();
        $excel = [];
        foreach ($incentives as $incentive) {
            $type1 = $type2 = $type3 = $type4 = $type5 = $type6 = 0;
            if ($incentive->incentive) {
                foreach (json_decode($incentive->incentive, true) as $key => $inc) {
                    if ($inc['status'] == 1) {
                        ${"type" . $inc['type']} += (isset($inc['type']) && $inc['type'] == 6) ? $inc['unit'] * 5 : get_point_incentive($inc['type'], $inc['time']);
                    }
                }
            }
            if ($type1 > 100) { $type1 = 100; }
            if ($type2 > 40) { $type2 = 40; }
            if ($type3 > 40) { $type3 = 40; }
            if ($type4 > 60) { $type4 = 60; }
            if ($type5 > 40) { $type5 = 40; }
            if ($type6 > 50) { $type6 = 50; }
            $excel[$incentive->id][] = [
              $incentive->id,
              $incentive->user->name,
              $incentive->user->mobile.' ',
              $incentive->user->nationalCode.' ',
              $incentive->ostan->name,
              $incentive->university->name,
                __("messages." . $incentive->status),
              verta($incentive->created_at)->format('Y-m-d'),
                $type1,$type2,$type3,$type4,$type5,$type6,
                ($type1+$type2+$type3+$type4+$type5+$type6)
            ];
        }
        return $excel;
    }

    public function headings(): array
    {
        return ['ردیف','نام و نام خانوادگی','موبایل','کدملی','استان','نام دانشگاه','وضعیت','تاریخ ثبت','مهارت تخصصی','مهارت شغل عمومی','سابقه پژوهشی','سابقه دستیاری','سابقه تدریس','سابقه علمی','جمع امتیازات'];
    }
}
