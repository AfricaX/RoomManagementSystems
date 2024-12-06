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

    }
}
