<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DemandVacatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['id' => 0, 'demand_id' => 1, 'vacature_id' => 3],
            ['id' => 1, 'demand_id' => 3, 'vacature_id' => 3],
            ['id' => 2, 'demand_id' => 12, 'vacature_id' => 1],
            ['id' => 3, 'demand_id' => 8, 'vacature_id' => 2],
        ];
        DB::table('demand_vacature')->insert($data);
    }
}
