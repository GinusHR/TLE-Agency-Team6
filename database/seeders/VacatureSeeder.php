<?php

namespace Database\Seeders;

use App\Models\Vacature;
use Illuminate\Database\Seeder;

class VacatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vacatures = [
            [
                'company_id' => 1, // Albert Heijn
                'function' => 'Vakkenvuller',
                'salary' => 1200,
                'workhours' => 24,
                'location' => 'Amsterdam',
                'time_id' => 0, // Parttime
                'description' => 'Als vakkenvuller ben je verantwoordelijk voor het netjes houden van de schappen en het aanvullen van producten.',
                'secondary_info_needed' => false,
                'image' => null,
                'status' => 1,
            ],
            [
                'company_id' => 2, // McDonald’s
                'function' => 'Crewlid Keuken',
                'salary' => 1500,
                'workhours' => 40,
                'location' => 'Rotterdam',
                'time_id' => 1, // Fulltime
                'description' => 'Bereid de lekkerste burgers en zorg voor een schone en georganiseerde keuken.',
                'secondary_info_needed' => false,
                'image' => null,
                'status' => 1,
            ],
            [
                'company_id' => 1, // Albert Heijn
                'function' => 'Bezorger',
                'salary' => 1800,
                'workhours' => 32,
                'location' => 'Utrecht',
                'time_id' => 1, // Fulltime
                'description' => 'Als bezorger ben je het visitekaartje van Albert Heijn en zorg je ervoor dat bestellingen tijdig en correct worden afgeleverd.',
                'secondary_info_needed' => true,
                'image' => null,
                'status' => 1,
            ],
        ];

        foreach ($vacatures as $vacature) {
            Vacature::create($vacature);
        }
    }
}
