<?php 

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;
use Illuminate\Support\Facades\Auth; 

class RoomFilter extends ModelFilter
{
    protected $whitelist = [];

    public function reservations($arrayData)
    {
        $type = $arrayData['type'];
        $checkin = $arrayData['checkin'];
        $checkout = $arrayData['checkout'];
        return $this->where('room_type_id',$type)
                    ->where(function($query) use ($checkin, $checkout){
                        $query
                            ->orWhereDoesntHave('reservations', function($subquery) use ($checkin, $checkout){
                                $subquery->where('deleted', false)
                                    ->where(function($q) use ($checkin, $checkout){
                                        $q->where(function($subquery2) use ($checkin, $checkout){
                                            $subquery2->where('checkin', '<', $checkout)
                                                    ->where('checkin', '>=', $checkin);
                                        })
                                        ->orWhere(function($subquery2) use ($checkin, $checkout){
                                            $subquery2->where('checkout', '<=', $checkout)
                                                    ->where('checkout', '>', $checkin);
                                        })
                                        ->orWhere(function($subquery2) use ($checkin, $checkout){
                                            $subquery2->where('checkout', '>', $checkout)
                                                    ->where('checkin', '<', $checkin);
                                        });
                                    });
                            });
                    });
    }
}
