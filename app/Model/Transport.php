<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Transport extends Model
{
    protected $table = 'service_charges';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','price','type','status',
    ];
}
