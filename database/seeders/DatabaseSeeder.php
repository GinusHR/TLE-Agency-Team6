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
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            CompanySeeder::class
        ]);
        $this->call([
            DemandSeeder::class
        ]);
        $this->call([
            VacatureSeeder::class
        ]);
        $this->call([
            DemandVacatureSeeder::class
        ]);
        $this->call([
            UserSeeder::class
        ]);
        $this->call([
            ReviewSeeder::class
        ]);
        $this->call([
            ApplicationSeeder::class
        ]);
        $this->call([
            ApplicationDemandSeeder::class
        ]);
        $this->call([
            DemandUserSeeder::class
        ]);
    }
}
