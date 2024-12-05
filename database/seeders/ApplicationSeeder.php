<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ApplicationSeeder extends Seeder
{
    public function run()
    {
        $applications = [
            // Sollicitatie 1
            [
                'email' => 'user1@example.com', // Gebruik email in plaats van user_id
                'user_id' => null,
                'vacature_id' => 1,
                'secondary_info' => null, // Geen secundaire info voor vacature_id 1
                'accepted' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Sollicitatie 2
            [
                'email' => null,
                'user_id' => 2, // Gebruik user_id
                'vacature_id' => 2,
                'secondary_info' => null, // Geen secundaire info voor vacature_id 2
                'accepted' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Sollicitatie 3
            [
                'email' => 'user3@example.com',
                'user_id' => null,
                'vacature_id' => 3,
                'secondary_info' => 'Extra informatie voor vacature 3', // Secundaire info voor vacature_id 3
                'accepted' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Sollicitatie 4
            [
                'email' => null,
                'user_id' => 4,
                'vacature_id' => 1,
                'secondary_info' => null, // Geen secundaire info voor vacature_id 1
                'accepted' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Sollicitatie 5
            [
                'email' => 'user5@example.com',
                'user_id' => null,
                'vacature_id' => 2,
                'secondary_info' => null, // Geen secundaire info voor vacature_id 2
                'accepted' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Sollicitatie 6
            [
                'email' => null,
                'user_id' => 1, // Gebruik user_id
                'vacature_id' => 3,
                'secondary_info' => 'Motivatie en ervaring voor vacature 3', // Secundaire info voor vacature_id 3
                'accepted' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Sollicitatie 7
            [
                'email' => null,
                'user_id' => 2, // Gebruik user_id
                'vacature_id' => 1,
                'secondary_info' => null, // Geen secundaire info voor vacature_id 1
                'accepted' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Sollicitatie 8
            [
                'email' => 'user4@example.com',
                'user_id' => null,
                'vacature_id' => 3,
                'secondary_info' => 'Aanvullende ervaring voor vacature 3', // Secundaire info voor vacature_id 3
                'accepted' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Sollicitatie 9
            [
                'email' => null,
                'user_id' => 3, // Gebruik user_id
                'vacature_id' => 2,
                'secondary_info' => null, // Geen secundaire info voor vacature_id 2
                'accepted' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Sollicitatie 10
            [
                'email' => 'user2@example.com',
                'user_id' => null,
                'vacature_id' => 3,
                'secondary_info' => 'Details voor vacature 3', // Secundaire info voor vacature_id 3
                'accepted' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        DB::table('applications')->insert($applications);
    }
}
