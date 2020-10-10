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
            'slug'=>'Music-10',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea sunt, quibusdam vitae voluptate, nemo fugit cum reprehenderit aut repellat, adipisci recusandae at error dolorum iure eum officiis consequuntur alias. Nostrum!',
            'vote' => 50,
            'is_online'=>true,
            'image_src' => 'images/applications/imageApp1-music.png',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('applications')->insert([
            'name' => 'Arcade Games',
            'price' => 111.37,
            'category_id' => 2,
            'slug'=>'Games-10',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea sunt, quibusdam vitae voluptate, nemo fugit cum reprehenderit aut repellat, adipisci recusandae at error dolorum iure eum officiis consequuntur alias. Nostrum!',
            'vote' => 35,
            'is_online'=>true,
            'image_src' => 'images/applications/imageApp3-games.png',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('applications')->insert([
            'name' => 'Pothoshop course',
            'price' => 999.37,
            'category_id' => 3,
            'slug'=>'Educational-5',
            'is_online'=>true,
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea sunt, quibusdam vitae voluptate, nemo fugit cum reprehenderit aut repellat, adipisci recusandae at error dolorum iure eum officiis consequuntur alias. Nostrum!',
            'vote' => 10,
            'image_src' => 'images/applications/imageApp1-educational.png',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('applications')->insert([
            'name' => 'PUGB',
            'price' => 1232.37,
            'category_id' => 2,
            'slug'=>'Games-4',
            'is_online'=>true,
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea sunt, quibusdam vitae voluptate, nemo fugit cum reprehenderit aut repellat, adipisci recusandae at error dolorum iure eum officiis consequuntur alias. Nostrum!',
            'vote' => 16,
            'image_src' => 'images/applications/imageApp4-games.png',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
           DB::table('applications')->insert([
            'name' => 'New Aventure ',
            'price' => 1232.37,
            'category_id' => 2,
            'slug'=>'Games-3',
            'is_online'=>true,
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea sunt, quibusdam vitae voluptate, nemo fugit cum reprehenderit aut repellat, adipisci recusandae at error dolorum iure eum officiis consequuntur alias. Nostrum!',
            'vote' => 1,
            'image_src' => 'images/applications/imageApp5-games.png',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
           DB::table('applications')->insert([
            'name' => 'Music App Shaz',
            'price' => 1232.37,
            'category_id' => 1,
            'slug'=>'Music-2',
            'is_online'=>true,
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea sunt, quibusdam vitae voluptate, nemo fugit cum reprehenderit aut repellat, adipisci recusandae at error dolorum iure eum officiis consequuntur alias. Nostrum!',
            'vote' => 0,
            'image_src' => 'images/applications/imageapp14-music.png',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
         DB::table('applications')->insert([
            'name' => 'Englis Learn',
            'price' => 1232.37,
            'category_id' => 3,
            'slug'=>'Educational-11',
            'is_online'=>true,
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea sunt, quibusdam vitae voluptate, nemo fugit cum reprehenderit aut repellat, adipisci recusandae at error dolorum iure eum officiis consequuntur alias. Nostrum!',
            'vote' => 1,
            'image_src' => 'images/applications/imageApp6-educational.png',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('applications')->insert([
            'name' => 'Granadp Espada',
            'price' => 1232.37,
            'category_id' => 2,
            'slug'=>'Game-7',
            'is_online'=>true,
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea sunt, quibusdam vitae voluptate, nemo fugit cum reprehenderit aut repellat, adipisci recusandae at error dolorum iure eum officiis consequuntur alias. Nostrum!',
            'vote' => 12,
            'image_src' => 'images/applications/imageapp11-games.png',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('applications')->insert([
            'name' => 'Educational Society',
            'price' => 1232.37,
            'category_id' => 3,
            'slug'=>'Educational-17',
            'is_online'=>true,
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea sunt, quibusdam vitae voluptate, nemo fugit cum reprehenderit aut repellat, adipisci recusandae at error dolorum iure eum officiis consequuntur alias. Nostrum!',
            'vote' => 13,
            'image_src' => 'images/applications/imageApp7-educational.png',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('applications')->insert([
            'name' => 'Educational Kids',
            'price' => 1232.37,
            'category_id' => 3,
            'slug'=>'Educational-new.app',
            'is_online'=>true,
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea sunt, quibusdam vitae voluptate, nemo fugit cum reprehenderit aut repellat, adipisci recusandae at error dolorum iure eum officiis consequuntur alias. Nostrum!',
            'vote' => 14,
            'image_src' => 'images/applications/imageApp8-educational.png',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('applications')->insert([
            'name' => 'Educational Course',
            'price' => 1232.37,
            'category_id' => 3,
            'slug'=>'Educational-3-4',
            'is_online'=>true,
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea sunt, quibusdam vitae voluptate, nemo fugit cum reprehenderit aut repellat, adipisci recusandae at error dolorum iure eum officiis consequuntur alias. Nostrum!',
            'vote' => 15,
            'image_src' => 'images/applications/imageApp9-educational.png',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('applications')->insert([
            'name' => 'Music tunes',
            'price' => 1232.37,
            'category_id' => 1,
            'slug'=>'Musical-22',
            'is_online'=>true,
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea sunt, quibusdam vitae voluptate, nemo fugit cum reprehenderit aut repellat, adipisci recusandae at error dolorum iure eum officiis consequuntur alias. Nostrum!',
            'vote' => 13,
            'image_src' => 'images/applications/imageapp14-music.png',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('applications')->insert([
            'name' => 'Music Live',
            'price' => 1232.37,
            'category_id' => 1,
            'slug'=>'Musical-Live-1',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea sunt, quibusdam vitae voluptate, nemo fugit cum reprehenderit aut repellat, adipisci recusandae at error dolorum iure eum officiis consequuntur alias. Nostrum!',
            'vote' => 3,
            'is_online'=>true,
            'image_src' => 'images/applications/imageapp15-music.png',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('applications')->insert([
            'name' => 'CS Movile',
            'price' => 1232.37,
            'category_id' => 2,
            'slug'=>'GameStore-1',
            'is_online'=>true,
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea sunt, quibusdam vitae voluptate, nemo fugit cum reprehenderit aut repellat, adipisci recusandae at error dolorum iure eum officiis consequuntur alias. Nostrum!',
            'vote' => 100,
            'image_src' => 'images/applications/imageapp13-games.png',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
