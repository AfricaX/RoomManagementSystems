<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Artisan;
use App\Models\RoomType;
use App\Models\Room;
use App\Models\Booking;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        /**
         * Generate passport keys
         */
        Artisan::call('passport:keys');
        Artisan::call('passport:client --personal --no-interaction');

        /**
         * Seed Users
         */
            User::create([
                'name' => 'Admin',
                'email' => 'Admin@example.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]);

       

        /**
         * Seed Room Types
         */
            RoomType::create([
                'room_type' => 'Lecture Room',
            ]);

            RoomType::create([
                'room_type' => 'Gym Room',
            ]);

            RoomType::create([
                'room_type' => 'IT Laboratory Room',
            ]);

            RoomType::create([
                'room_type' => 'Faculty Room',
            ]);

            RoomType::create([
                'room_type' => 'Registrar Office',
            ]);

        /**
         * Seed Rooms
         */

            Room::create([
                'room_name' => '101',
                'room_type_id' => '1',
                'location' => 'Main Building',
                'description' => 'Lecture Room',
                'capacity' => '50',
            ]);

    }
}
