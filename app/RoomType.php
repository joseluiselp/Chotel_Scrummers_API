<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'name'
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
        return $this->hasMany('App\Room', 'room_type_id');
    }

}