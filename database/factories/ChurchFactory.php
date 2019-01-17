<?php

use Faker\Generator as Faker;

$factory->define(\App\Church::class, function (Faker $faker) {
    return [
        'district_id' => \App\District::all()->random()->id,
        'name' => $faker->unique()->word
    ];
});
