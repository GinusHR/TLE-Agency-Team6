<?php

namespace Database\Seeders;

use App\Models\Demand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DemandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $demands = [
            ['name' => '18 jaar of ouder'],
            ['name' => 'Rijbewijs A'],
            ['name' => 'Rijbewijs B'],
            ['name' => 'Rijbewijs C'],
            ['name' => 'MBO werk- en denkniveau'],
            ['name' => 'Bereidheid om in ploegendiensten te werken'],
            ['name' => 'Goede beheersing van de Nederlandse taal'],
            ['name' => 'Ervaring in een soortgelijke functie'],
            ['name' => 'Beschikbaar voor minimaal 32 uur per week'],
            ['name' => 'In bezit van eigen vervoer'],
            ['name' => 'Flexibele werkhouding'],
            ['name' => 'Klantvriendelijk'],
            ['name' => 'Goede communicatieve vaardigheden'],
        ];
        foreach ($demands as $demand) {
            Demand::create($demand);
        }
    }
}
