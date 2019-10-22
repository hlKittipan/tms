<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title','src', 'alt', 'description','type','file_path','file_name'
    ];

    /**
     * Get the images that owns the product_many_images.
     */
    /*public function ProductManyImage()
    {
        return $this->hasMany(ProductManyImage::class,'images_id','id');
    }*/
}
