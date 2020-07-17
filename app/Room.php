<?php

namespace App;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{

    use Filterable;
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'name', 'floor', 'room_type_id', 'hotel_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id', 'created_at', 'updated_at', 'room_type_id',  'hotel_id'
    ];

    public function reservations()
    {
        return $this->hasMany('App\Reservation', 'room_id');
    }

    public function hotel()
    {
        return $this->belongsTo('App\Hotel', 'hotel_id');
    }

    public function type()
    {
        return $this->belongsTo('App\RoomType', 'room_type_id');
    }

}