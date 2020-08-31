<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Creo Usuarios
        factory(App\User::class, 10)->create();
         
        //Tomo el id de esos usuarios
        $getUsersId = App\User::pluck('id');
       
        //Los inserto en la tabla user_roles, con un tipo de rol
        foreach ($getUsersId as $value) {
                DB::table('roles_user')->insert([
                    'user_id' =>$value,
                    'roles_id' => rand(1,2),
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        }

        // $role_user = Role::where('name', 'user')->first();
        // $role_admin = Role::where('name', 'admin')->first();                   

        // $user = new User();
        // $user->name = 'User';
        // $user->email = 'user@example.com';
        // $user->password = bcrypt('secret');
        // $user->save();
        // $user->roles()->attach($role_user);

        // $user = new User();
        // $user->name = 'Admin';
        // $user->email = 'admin@example.com';
        // $user->password = bcrypt('secret');
        // $user->save();
        // $user->roles()->attach($role_admin);

    }
}
