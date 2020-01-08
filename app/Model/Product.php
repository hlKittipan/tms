<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $with = ['Period','Province'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'province_id','code','name','staff_id','product_type_id','number_of_pax','duration_days','duration_nights','includes','excludes','conditions','itinerary',
        'remark','status','overview'
    ];


    public function Period()
    {
        return $this->hasMany(Period::class,'product_id','id');
    }

    public function Province()
    {
        return $this->hasOne(Province::class,'id','province_id');
    }

    /*public function ProductManyImage()
    {
        return $this->hasMany(ProductManyImage::class,'product_id','id');
    }*/
}
