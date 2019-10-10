<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product_type extends Model
{
    protected $table = 'product_types';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];
}
