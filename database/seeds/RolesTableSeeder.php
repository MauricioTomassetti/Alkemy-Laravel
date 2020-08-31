<?php

use Illuminate\Database\Seeder;
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
            'name_role' => 'desarrollador',
            'description_role' => 'Permite acceso al sistema como desarrollador',

        ]);

        DB::table('roles')->insert([
            'name_role' => 'cliente',
            'description_role' => 'Permite acceso al sistema como cliente',
        ]);

        DB::table('roles')->insert([
            'name_role' => 'visitante',
            'description_role' => 'Permite acceso al sistema como visitante',
        ]);
    }
}
