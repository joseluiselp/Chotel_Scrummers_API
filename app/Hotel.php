<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'address', 'email', 'phone'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id', 'created_at', 'updated_at'
    ];
    
    public function rooms()
    {
        return $this->hasMany('App\Room', 'hotel_id');
    }

}
