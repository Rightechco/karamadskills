<?php

if (!function_exists('get_type_incentive')) {
    function get_type_incentive($type) {
        switch ($type) {
            case 1:
                return 'مهارت های تخصصی';
            case 2:
                return 'مهارت های شغلی عمومی';
            case 3:
                return 'سابقه دستیار پژوهشی';
            case 4:
                return 'سابقه دستیار آزمایشگاهی , کارآموزی , انجام امور کارگاهی , کارورزی';
            case 5:
                return 'سابقه تدریس دروس دانشگاهی و دوره های تخصصی';
            case 6:
                return 'دروس عملی و آزمایشگاهی و کارگاهی هر رشته';
        }
    }
}

if (!function_exists('get_point_incentive')) {
    function get_point_incentive($type,$time) {
        switch ($type) {
            case 1:
                return $time;
            case 2:
                return floor($time/3);
            case 5:
            case 4:
            case 3:
                return floor($time/5);
        }
    }
}
