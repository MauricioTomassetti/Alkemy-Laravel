<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Roles;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(Roles::class, function (Faker $faker) {
    return [
        'id' => 2,
        'name_role' => 'cliente',
        'description_role' => 'Permite acceso al sistema como desarrollador',
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
    ];
});
