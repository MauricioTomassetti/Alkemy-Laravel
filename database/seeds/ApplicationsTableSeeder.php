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
            'category_id' => 1,
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea sunt, quibusdam vitae voluptate, nemo fugit cum reprehenderit aut repellat, adipisci recusandae at error dolorum iure eum officiis consequuntur alias. Nostrum!',
            'vote' => 1,
            'image_src' => 'images/applications/imageApp1.jpg',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('applications')->insert([
            'name' => 'Game',
            'price' => 111.37,
            'category_id' => 2,
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea sunt, quibusdam vitae voluptate, nemo fugit cum reprehenderit aut repellat, adipisci recusandae at error dolorum iure eum officiis consequuntur alias. Nostrum!',
            'vote' => 1,
            'image_src' => 'images/applications/imageApp2.jpg',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('applications')->insert([
            'name' => 'Education',
            'price' => 999.37,
            'category_id' => 3,
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea sunt, quibusdam vitae voluptate, nemo fugit cum reprehenderit aut repellat, adipisci recusandae at error dolorum iure eum officiis consequuntur alias. Nostrum!',
            'vote' => 1,
            'image_src' => 'images/applications/imageApp3.jpg',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('applications')->insert([
            'name' => 'Game 2 ',
            'price' => 1232.37,
            'category_id' => 2,
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea sunt, quibusdam vitae voluptate, nemo fugit cum reprehenderit aut repellat, adipisci recusandae at error dolorum iure eum officiis consequuntur alias. Nostrum!',
            'vote' => 10,
            'image_src' => 'images/applications/imageApp2.jpg',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
