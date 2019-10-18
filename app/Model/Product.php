<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code','name','staff_id','number_of_pax','duration_days','duration_nights','includes','excludes','conditions','itinerary',
        'remark','status'
    ];
}
