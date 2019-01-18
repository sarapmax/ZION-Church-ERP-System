<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Cell::class, function (Faker $faker) {
    return [
        'church_id' => factory(App\Models\Church::class)->create()->id,
        'name' => $faker->unique()->word
    ];
});
