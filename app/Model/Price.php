<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id','period_id', 'staff_id', 'cost_adult','cost_child','cost_infant','public_adult','public_child','public_infant','remark','status'
    ];

    public function Period()
    {
        return $this->belongsTo(Period::class,'period_id');
    }
}
