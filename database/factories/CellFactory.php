<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Cell::class, function (Faker $faker) {
    return [
        'church_id' => factory(\App\Models\Church::class),
        'name' => $faker->unique()->company
    ];
});
