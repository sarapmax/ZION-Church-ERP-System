<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Church::class, function (Faker $faker) {
    return [
        'district_id' => \App\Models\District::all()->random()->id,
        'name' => $faker->unique()->word
    ];
});
