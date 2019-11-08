<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Quotation_detail extends Model
{
    protected $table = 'quotation_details';
    protected $fillable = [
        'quo_id','product_id','price_id','period_id','unit_adult','unit_child','unit_infant','price','vat','total','discount'
    ];

    public function Quotations(){
        return $this->belongsTo($this->Quotations(),'quo_id');
    }
}
