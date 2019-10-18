<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Product_many_image extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'images_id','product_id',
    ];

    public function images()
    {
        return $this->hasMany('App\Model\Image');
    }
}
