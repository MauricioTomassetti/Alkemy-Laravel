<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Purcharse;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(Purcharse::class, function (Faker $faker) {
    return [
        'user_id' => rand(1, 7),
        'app_id' => rand(1, 3),
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
    ];
});
