<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ApplicationDemandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['id' => 0, 'demand_id' => 1, 'application_id' => 1],
            ['id' => 1, 'demand_id' => 12, 'application_id' => 4],
        ];
        DB::table('application_demands_not_met')->insert($data);
    }
}
