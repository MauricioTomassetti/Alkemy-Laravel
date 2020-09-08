<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Application;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(Application::class, function (Faker $faker) {
    return [
        'name' => 'TestApplication',
        'price' => rand(12, 57) / 10,
        'category_id' => rand(1, 3),
        'vote' =>  $faker->randomDigit(),
        'slug'=> 'Music',
        'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea sunt, quibusdam vitae voluptate, nemo fugit cum reprehenderit aut repellat, adipisci recusandae at error dolorum iure eum officiis consequuntur alias. Nostrum!',
        //'image_src' => $faker->image(public_path('/images/applications'), $width = 240, $height = 240),
        'image_src' => '/images/applications',
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
    ];
});
