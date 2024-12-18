<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RatingSeeder extends Seeder
{
    public function run()
    {
        $ratings = [
            [
                'rating' => 5,
                'review' => 'Uitstekende vacature! Zeer informatief en goed gestructureerd.',
                'user_id' => 1, // user_id 1
                'vacature_id' => 1, // vacature_id 1
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'rating' => 4,
                'review' => 'Goede vacature, maar er ontbreekt wat details over de werkzaamheden.',
                'user_id' => 2, // user_id 2
                'vacature_id' => 2, // vacature_id 2
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'rating' => 3,
                'review' => 'Vacature was okay, maar niet helemaal wat ik zocht.',
                'user_id' => 3, // user_id 3
                'vacature_id' => 3, // vacature_id 3
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'rating' => 2,
                'review' => 'De vacature beschreef niet goed wat de functie inhield.',
                'user_id' => 4, // user_id 4
                'vacature_id' => 1, // vacature_id 1 (herhaalt)
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'rating' => 1,
                'review' => 'Zeer teleurstellende vacature, de informatie was onduidelijk en verwarrend.',
                'user_id' => 5, // user_id 5
                'vacature_id' => 2, // vacature_id 2 (herhaalt)
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'rating' => 5,
                'review' => 'Fantastische vacature, precies wat ik zocht!',
                'user_id' => 1, // user_id 1 (herhaalt)
                'vacature_id' => 3, // vacature_id 3 (herhaalt)
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'rating' => 4,
                'review' => 'Goede vacature, maar had meer details over de locatie moeten bevatten.',
                'user_id' => 2, // user_id 2 (herhaalt)
                'vacature_id' => 1, // vacature_id 1 (herhaalt)
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'rating' => 3,
                'review' => 'De vacature was oké, maar de vereisten waren te vaag.',
                'user_id' => 3, // user_id 3 (herhaalt)
                'vacature_id' => 2, // vacature_id 2 (herhaalt)
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'rating' => 2,
                'review' => 'Vacature was onvoldoende duidelijk, miste belangrijke informatie.',
                'user_id' => 4, // user_id 4 (herhaalt)
                'vacature_id' => 3, // vacature_id 3 (herhaalt)
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'rating' => 1,
                'review' => 'Vacature was totaal niet relevant voor mijn ervaring.',
                'user_id' => 5, // user_id 5 (herhaalt)
                'vacature_id' => 1, // vacature_id 1 (herhaalt)
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        DB::table('ratings')->insert($ratings);
    }
}
