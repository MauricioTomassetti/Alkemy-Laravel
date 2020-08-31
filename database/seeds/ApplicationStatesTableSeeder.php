<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
class ApplicationStatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('states_applications')->insert([
            'id_app' => 1,
            'id_state' =>1,
            'id_user' => 101,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            
        ]);

        DB::table('states_applications')->insert([
            'id_app' => 2,
            'id_state' =>2,
            'id_user' => 102,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
           
        ]);

        DB::table('states_applications')->insert([
            'id_app' => 1,
            'id_state' =>3,
            'id_user' => 103,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
           
        ]);
    }
}
