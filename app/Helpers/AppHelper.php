<?php
namespace App\Helpers;

class AppHelper
{
    public function bladeHelper($someValue)
    {
        return "increment $someValue";
    }

    public function startQueryLog()
    {
        \DB::enableQueryLog();
    }

    public function showQueries()
    {
       //
    }

    public static function instance()
    {
        return new AppHelper();
    }
}
