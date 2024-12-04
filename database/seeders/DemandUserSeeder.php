<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DemandUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['demand_id' => 1, 'user_id' => 3],
            ['demand_id' => 3, 'user_id' => 3],
            ['demand_id' => 12, 'user_id' => 1],
            ['demand_id' => 1, 'user_id' => 1],
            ['demand_id' => 8, 'user_id' => 1],
            ['demand_id' => 9, 'user_id' => 1],
            ['demand_id' => 8, 'user_id' => 2],
        ];
        DB::table('demand_user')->insert($data);
    }
}
