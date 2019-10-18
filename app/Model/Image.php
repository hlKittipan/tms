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
        'title','src', 'alt', 'description','type',
    ];

    /**
     * Get the images that owns the product_many_images.
     */
    public function product_many_images()
    {
        return $this->belongsTo('App\Model\Product_many_image');
    }
}
