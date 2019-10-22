<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ProductManyImage extends Model
{
   /* protected $with = ['Image'];*/

    protected $fillable = [
        'product_id','images_id'
    ];

    /*public function Image()
    {
        return $this->hasMany(Image::class,'id','images_id');
    }
    public function Product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }*/
}
