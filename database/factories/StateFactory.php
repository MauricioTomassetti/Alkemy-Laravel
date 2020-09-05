<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\State;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(State::class, function (Faker $faker) {
    return [
        'id' => '4',
        'description' => 'Created',
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
    ];
});
