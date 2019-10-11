<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'system_setups';

    protected $fillable = [
        'setting_name','code','type','value',
    ];
}
