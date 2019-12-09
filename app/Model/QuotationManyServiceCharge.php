<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class QuotationManyServiceCharge extends Model
{
    protected $table = 'quotation_many_service_charges';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'quo_id','charge_id','price',
    ];
}
