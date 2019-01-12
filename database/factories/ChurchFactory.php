<?php

use Faker\Generator as Faker;

$factory->define(\App\Church::class, function (Faker $faker) {
    return [
        // Fix อำเภอ เมืองเชียงราย
        'district_id' => 657,
        'name' => $faker->unique()->word
    ];
});
