<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_role')->insert([
            'id_user' => 10,
            'id_rol' => 1,
        ]);

        DB::table('user_role')->insert([
            'id_user' => 11,
            'id_rol' => 2,
        ]);
    }
}
