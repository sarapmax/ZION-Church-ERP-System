<?php

use Faker\Generator as Faker;

$factory->define(\App\Cell::class, function (Faker $faker) {
    return [
        'church_id' => factory(App\Church::class)->create()->id,
        'name' => $faker->unique()->word
    ];
});
