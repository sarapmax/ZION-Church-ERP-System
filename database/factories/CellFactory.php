<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Cell::class, function (Faker $faker) {
    return [
        'area_id' => factory(\App\Models\Area::class),
        'name' => $faker->unique()->company
    ];
});
