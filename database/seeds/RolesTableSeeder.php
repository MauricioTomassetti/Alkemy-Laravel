<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('roles')->insert([
            'name_role' => 'Desarrollador',
            'description_role' => 'Permite acceso al sistema como Desarrollador',

        ]);

        DB::table('roles')->insert([
            'name_role' => 'Cliente',
            'description_role' => 'Permite acceso al sistema como Cliente',
        ]);
    }
}
