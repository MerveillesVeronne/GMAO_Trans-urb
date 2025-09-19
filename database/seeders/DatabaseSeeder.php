<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Ordre important : Directions -> Services -> Roles -> Users -> LignesTransport
        $this->call([
            DirectionSeeder::class,
            ServiceSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            LigneTransportSeeder::class,
            CarburationSeeder::class,
        ]);
    }
}
