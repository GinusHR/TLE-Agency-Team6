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
            ['name' => 'Rijbewijs AM (scooter)'],
            ['name' => 'Rijbewijs B (auto)'],
            ['name' => 'Rijbewijs C (vrachtwagen)'],
            ['name' => 'MBO werk- en denkniveau'],
            ['name' => 'Bereidheid om in ploegendiensten te werken'],
            ['name' => 'Goede beheersing van de Nederlandse taal'],
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
