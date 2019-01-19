<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Cell::class, function (Faker $faker) {
    return [
        'church_id' => 1,
        'name' => $faker->unique()->company
    ];
});
