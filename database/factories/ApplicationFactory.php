<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Application;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(Application::class, function (Faker $faker) {
    return [
        'name' => 'TestApplication',
        'price' => rand(12, 57) / 10,
        'id_category' => rand(1, 3),
        'user_id' => rand(1, 5),
        'vote' =>  $faker->randomDigit(),
        //'image_src' => $faker->image(public_path('/images/applications'), $width = 240, $height = 240),
        'image_src' => '/images/applications',
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
    ];
});
