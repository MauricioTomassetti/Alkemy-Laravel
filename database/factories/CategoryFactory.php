<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'id' => 1,
        'name' => $faker->word(),
        'description' => $faker->sentence(),
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
    ];
});
