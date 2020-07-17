<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use App\Room; 
use App\RoomType; 
use App\Hotel;
use App\Reservation;
use Validator;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppController extends Controller
{
    public $successStatus = 200;

    public function availability(Request $request) { 
        $validator = Validator::make($request->all(), [ 
            'type' => 'required|numeric|exists:room_types,id',  
            'checkin' => 'required|date|after_or_equal:today',
            'checkout' => 'required|date|after:checkin',
        ],
        [
            'type.required'=> 'El tipo de hab es requerido (1: single, 2: double, 3: familiar)',
            'type.numeric'=> 'El tipo de hab debe ser un numero',
            'type.exists'=> 'El tipo de hab debe existir (1: single, 2: double, 3: familiar)',
            'checkin.required'=> 'La fecha de entrada de la reserva es requerida',
            'checkin.date'=> 'La fecha de la reserva debe ser en formato fecha ej: 2020-07-17',
            'checkin.after_or_equal'=> 'La fecha de la reserva debe ser despues de ayer',
            'checkout.required'=> 'La fecha de salida de la reserva es requerida',
            'checkout.date'=> 'La fecha de salida debe ser en formato fecha ej: 2020-07-17',
            'checkout.after'=> 'La fecha de la reserva debe ser despues a la fecha de entrada',
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        $input = $request->all();
        $rooms = Room::filter(['reservations'=>['type'=>$input['type'], 'checkin'=>$input['checkin'], 'checkout'=>$input['checkout']]])->with('type')->get();
        if(count($rooms)==0)
            return response()->json(['data'=>array('message'=>'No hay hab disponibles')], $this->successStatus); 
        return response()->json($rooms, $this->successStatus);         
    }

    public function createReservation(Request $request) { 
        $validator = Validator::make($request->all(), [ 
            'type' => 'required|numeric|exists:room_types,id',  
            'checkin' => 'required|date|after_or_equal:today',
            'checkout' => 'required|date|after:checkin',
        ],
        [
            'type.required'=> 'El tipo de hab es requerido (1: single, 2: double, 3: familiar)',
            'type.numeric'=> 'El tipo de hab debe ser un numero',
            'type.exists'=> 'El tipo de hab debe existir (1: single, 2: double, 3: familiar)',
            'checkin.required'=> 'La fecha de entrada de la reserva es requerida',
            'checkin.date'=> 'La fecha de la reserva debe ser en formato fecha ej: 2020-07-17',
            'checkin.after_or_equal'=> 'La fecha de la reserva debe ser despues de ayer',
            'checkout.required'=> 'La fecha de salida de la reserva es requerida',
            'checkout.date'=> 'La fecha de salida debe ser en formato fecha ej: 2020-07-17',
            'checkout.after'=> 'La fecha de la reserva debe ser despues a la fecha de entrada',
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        $input = $request->all();
        $room = Room::filter(['reservations'=>['type'=>$input['type'], 'checkin'=>$input['checkin'], 'checkout'=>$input['checkout']]])->with('type')->first();
        if(!$room)
            return response()->json(['error'=>'No hay hab disponibles'], 401);      
        else
        {
           $reservation =  Reservation::create(['room_id'=>$room->id, 'checkin'=>$input['checkin'], 'checkout'=>$input['checkout']]);
           $reservation->load('room');
        }
        return response()->json($reservation, $this->successStatus);
    }

    public function updateReservation(Request $request) { 
        $validator = Validator::make($request->all(), [ 
            'id' => 'required|numeric|exists:reservations,id',
            'type' => 'required|numeric|exists:room_types,id',  
            'checkin' => 'required|date|after_or_equal:today',
            'checkout' => 'required|date|after:checkin',
        ],
        [
            'id.required'=> 'El id de la reserva es requerido',
            'id.numeric'=> 'El id de la reserva debe ser un numero',
            'id.exists'=> 'El id de la reserva debe existir en la base de datos',
            'type.required'=> 'El tipo de hab es requerido (1: single, 2: double, 3: familiar)',
            'type.numeric'=> 'El tipo de hab debe ser un numero',
            'type.exists'=> 'El tipo de hab debe existir (1: single, 2: double, 3: familiar)',
            'checkin.required'=> 'La fecha de entrada de la reserva es requerida',
            'checkin.date'=> 'La fecha de la reserva debe ser en formato fecha ej: 2020-07-17',
            'checkin.after_or_equal'=> 'La fecha de la reserva debe ser despues de ayer',
            'checkout.required'=> 'La fecha de salida de la reserva es requerida',
            'checkout.date'=> 'La fecha de salida debe ser en formato fecha ej: 2020-07-17',
            'checkout.after'=> 'La fecha de la reserva debe ser despues a la fecha de entrada',
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        $input = $request->all();
        $room = Room::filter(['reservations'=>['type'=>$input['type'], 'checkin'=>$input['checkin'], 'checkout'=>$input['checkout']]])->with('type')->first();
        if(!$room)
            return response()->json(['error'=>'No hay hab disponibles'], 401);      
        else
        {
           $reservation = Reservation::where('id', $input['id'])->first();
           $reservation->room_id = $room->id;
           $reservation->checkin = $input['checkin'];
           $reservation->checkout = $input['checkout'];
           $reservation->update();
           $reservation->load('room');
        }
        return response()->json($reservation, $this->successStatus);
    }

    public function deleteReservation(Request $request) { 
        $validator = Validator::make($request->all(), [ 
            'id' => 'required|numeric|exists:reservations,id'
        ],
        [
            'id.required'=> 'El id de la reserva es requerido',
            'id.numeric'=> 'El id de la reserva debe ser un numero',
            'id.exists'=> 'El id de la reserva debe existir en la base de datos',
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        $input = $request->all();
        $reservation = Reservation::where('id', $input['id'])->first();
        $reservation->deleted = true;
        $reservation->update();
        $reservation->load('room');
        return response()->json($reservation, $this->successStatus);
    }
}