<?php

if (!function_exists('routeIsActive')) {
    function routeIsActive($routes, $print = 'active')
    {
        if (is_array($routes)) {
            foreach ($routes as $route) {
                if (Route::currentRouteName() === $route) {
                    return $print;
                }
            }
            return '';
        }
        return Route::is($routes) ? $print : '';
    }
}
/*  Code Format           Result
 * ('g:i a l jS F Y');    // 3:45 pm Friday 16th March 2018
 * ('Y-m-d H:i');         // "2019-12-22 00:00"
 * ('H:i:s.u');           // 15:32:45.654000
 * ('H:i:s');             // 15:32:00
 * ('Y-m-d');             // 2012-03-01
 * */
if (!function_exists('changeFormatDate')) {
    function changeFormatDate ($date , $format = 'd-m-y') {
        return \Carbon\Carbon::parse($date)->format($format);
    }
}

if (!function_exists('loopKeyValue')){
    function loopKeyValue ($key,$value) {
        $object = new stdClass();
        //$object->{$key} = new stdClass();
        foreach ($value as $k => $v) {
            $object->{$k} = $v;
        }
        return $object;
    }
}
