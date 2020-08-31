<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ApplicationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('applications')->insert([
            'name' => 'Spotify',
            'price' => 284.37,
            'id_category' => 1,
            'user_id' => 1,
            'vote' => 1,
            'image_src' => 'images/applications/imageApp1.jpg',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('applications')->insert([
            'name' => 'Game 1',
            'price' => 300.37,
            'id_category' => 2,
            'user_id' => 1,
            'vote' => 15,
            'image_src' => 'images/applications/imageApp2.jpg',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('applications')->insert([
            'name' => 'Education 1',
            'price' => 380.37,
            'id_category' => 3,
            'user_id' => 2,
            'vote' => 35,
            'image_src' => 'images/applications/imageApp3.jpg', 'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
