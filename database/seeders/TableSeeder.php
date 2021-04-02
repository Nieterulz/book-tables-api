<?php

namespace Database\Seeders;

use App\Models\Table;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Table::create([
            'code' => 1,
            'min_capacity' => 1,
            'max_capacity' => 2,
        ]);

        Table::create([
            'code' => 2,
            'min_capacity' => 1,
            'max_capacity' => 2,
        ]);

        Table::create([
            'code' => 3,
            'min_capacity' => 3,
            'max_capacity' => 4,
        ]);

        Table::create([
            'code' => 4,
            'min_capacity' => 3,
            'max_capacity' => 4,
        ]);
    }
}
