<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('states')->insert([
            'id' => 1,
            'description' => 'No purcharse',
        ]);
        DB::table('states')->insert([
            'id' => 2,
            'description' => 'Purcharse',
        ]);
        DB::table('states')->insert([
            'id' => 3,
            'description' => 'Desired',
        ]);
        DB::table('states')->insert([
            'id' => 4,
            'description' => 'Created',
        ]);
    }
}
