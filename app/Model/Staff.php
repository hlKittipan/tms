<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'user_id',
    ];

    /**
     * Get the user.
     */
    public function user()
    {
        return $this->hasOne('App\Model\User');
    }
}
