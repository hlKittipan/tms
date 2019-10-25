<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    protected $with = ['Price'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id','price_id', 'staff_id', 'date_start','date_end','sun','mon','tue','wed','thu','fri','sat','remark','status'
    ];

    public function Price()
    {
        return $this->hasMany(Price::class,'period_id','id');
    }

    public function Product()
    {
        return $this->belongsTo(Price::class,'period_id','id');
    }

}
