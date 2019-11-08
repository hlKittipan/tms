<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    protected $with = ['Quotation_details'];

    protected $fillable = [
        'staff_id','client_id','quo_date','total','discount_per','discount_price','vat','net'
    ];

    public function Quotation_details(){
        return $this->hasMany(Quotation_detail::class,'quo_id');
    }
}


