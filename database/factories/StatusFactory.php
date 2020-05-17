<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models;
use Faker\Generator as Faker;
use App\Models\Status;

$factory->define(Status::class, function (Faker $faker) {
    $date_time = $faker->date .' '. $faker->time;
    return [
        'content' => $faker->text(140),
        'created_at' => $date_time,
        'updated_at' => $date_time
    ];
});
