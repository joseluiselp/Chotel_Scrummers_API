<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Hotel;
use App\Reservation;
use App\Room;
use App\RoomType;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    	$this->call('UserTableSeeder');
    	$this->command->info('User table seeded!');

    	$this->call('HotelsTableSeeder');
    	$this->command->info('Hotel table seeded!');

    	$this->call('RoomTypesTableSeeder');
    	$this->command->info('Room Type table seeded!');

    	$this->call('RoomsTableSeeder');
    	$this->command->info('Rooms table seeded!');

    	$this->call('ReservationTableSeeder');
    	$this->command->info('Fields table seeded!');

    }
}

class UserTableSeeder extends Seeder {

	public function run()
	{
		DB::table('users')->delete();

		User::create(['email'=>'ceo@company.com', 'password'=>'$2y$10$5XcOeIFOJeKXDfKBfoyfuOhf3ZY6d/cHGVVhgH0QeW6BFA9oEpOcy']);
	}

}

class HotelsTableSeeder extends Seeder {

	public function run()
	{
		DB::table('hotels')->delete();

		Hotel::create(['name'=>'CHotel', 'email'=>'chotel@company.com', 'phone'=>'4245686200', 'address'=>'Jirahara bqto']);
	}
}

class RoomTypesTableSeeder extends Seeder {

	public function run()
	{
		DB::table('room_types')->delete();

		RoomType::create(['name'=>'Single']);
		RoomType::create(['name'=>'Double']);
		RoomType::create(['name'=>'Familiar']);
	}

}

class RoomsTableSeeder extends Seeder {

	public function run()
	{
		DB::table('rooms')->delete();

		Room::create(['name'=>'101', 'floor'=>1, 'room_type_id'=>1, 'hotel_id'=>1]);
		Room::create(['name'=>'102', 'floor'=>1, 'room_type_id'=>1, 'hotel_id'=>1]);
		Room::create(['name'=>'103', 'floor'=>1, 'room_type_id'=>1, 'hotel_id'=>1]);
		Room::create(['name'=>'104', 'floor'=>1, 'room_type_id'=>1, 'hotel_id'=>1]);
		Room::create(['name'=>'105', 'floor'=>2, 'room_type_id'=>1, 'hotel_id'=>1]);
		Room::create(['name'=>'201', 'floor'=>2, 'room_type_id'=>2, 'hotel_id'=>1]);
		Room::create(['name'=>'202', 'floor'=>2, 'room_type_id'=>2, 'hotel_id'=>1]);
		Room::create(['name'=>'203', 'floor'=>2, 'room_type_id'=>2, 'hotel_id'=>1]);
		Room::create(['name'=>'204', 'floor'=>3, 'room_type_id'=>2, 'hotel_id'=>1]);
		Room::create(['name'=>'205', 'floor'=>3, 'room_type_id'=>2, 'hotel_id'=>1]);
		Room::create(['name'=>'301', 'floor'=>2, 'room_type_id'=>3, 'hotel_id'=>1]);
		Room::create(['name'=>'302', 'floor'=>2, 'room_type_id'=>3, 'hotel_id'=>1]);
		Room::create(['name'=>'303', 'floor'=>2, 'room_type_id'=>3, 'hotel_id'=>1]);
		Room::create(['name'=>'304', 'floor'=>3, 'room_type_id'=>3, 'hotel_id'=>1]);
		Room::create(['name'=>'305', 'floor'=>3, 'room_type_id'=>3, 'hotel_id'=>1]);
	}

}

class ReservationTableSeeder extends Seeder {

	public function run()
	{
		DB::table('reservations')->delete();

		Reservation::create(['room_id'=>1, 'checkin'=>'2020-07-21', 'checkout'=>'2020-07-22']);
		Reservation::create(['room_id'=>2, 'checkin'=>'2020-07-22', 'checkout'=>'2020-07-26']);
		Reservation::create(['room_id'=>3, 'checkin'=>'2020-07-22', 'checkout'=>'2020-07-29']);
		Reservation::create(['room_id'=>4, 'checkin'=>'2020-07-23', 'checkout'=>'2020-07-25']);
		Reservation::create(['room_id'=>1, 'checkin'=>'2020-07-25', 'checkout'=>'2020-07-27']);
		Reservation::create(['room_id'=>6, 'checkin'=>'2020-07-23', 'checkout'=>'2020-07-30']);
		Reservation::create(['room_id'=>7, 'checkin'=>'2020-07-24', 'checkout'=>'2020-07-25']);
		Reservation::create(['room_id'=>8, 'checkin'=>'2020-07-25', 'checkout'=>'2020-07-26']);
		Reservation::create(['room_id'=>9, 'checkin'=>'2020-07-25', 'checkout'=>'2020-07-28']);
	}

}
