<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(Role::class, function (Faker $faker) {
    return [
        'id' => 1,
        'name_role' => 'developer',
        'description_role' => 'Permite acceso al sistema como Desarrollador',
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
    ];
});
