<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    DB::table('users')->insert([
        'name' => 'Usuario 1',
        'email' =>'user_client@alkemy.com',
        'email_verified_at' => now(),
        'password' => bcrypt('cliente1234'), // password,
        'slug' => ucfirst('user-1'),
        'remember_token' => Str::random(10),
        ]);

        DB::table('users')->insert([
            'name' => 'Desarrolador',
            'email' =>'user_developer@alkemy.com',
            'email_verified_at' => now(),
            'password' => bcrypt('cliente1234'), // password,
            'slug' => ucfirst('admin-1'),
            'remember_token' => Str::random(10),
    ]);
    }
}
