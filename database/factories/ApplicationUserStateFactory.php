<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ApplicationUserState;
use App\Model;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(ApplicationUserState::class, function (Faker $faker) {
    return [
        'application_id' => '1',
        'user_id' => 1,
        'state_id' => 4,
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
    ];
});
