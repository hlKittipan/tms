<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'first_name','last_name','id_card','address','city','province','country','postal_code','tel','phone','email','hotel_name','room_number','hotel_tel','passport'
    ];
}
