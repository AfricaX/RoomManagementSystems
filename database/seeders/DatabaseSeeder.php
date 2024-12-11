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
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'admin'
        ]);
        RoomType::create([
            "room_type" => "Laboratory"
        ]);
        RoomType::create([
            "room_type" => "Classroom"
        ]);
        RoomType::create([
            "room_type" => "Auditorium"
        ]);
        RoomType::create([
            "room_type" => "Conference Room"
        ]);
        RoomType::create([
            "room_type" => "Library"
        ]);
        Section::create([
            "section_name" => "1e2",
            "section_type" => "DTS"
        ]);
        Section::create([
            "section_name" => "1e1",
            "section_type" => "DTS"
        ]);

        Section::create([
            "section_name" => "stem",
            "section_type" => "Senior High"
        ]);
        Artisan::call('passport:keys');
        Artisan::call('passport:client --personal --no-interaction');

    }
}
