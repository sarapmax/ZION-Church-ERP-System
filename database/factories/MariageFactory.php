<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Mariage::class, function (Faker $faker) {
    return [
        'status' => $faker->randomElement(\App\Enums\MariageStatus::getValues()),
        'spouse_name' => $faker->name,
        'spouse_nickname' => $faker->userName,
        'spouse_birthday' => $faker->date(),
        'spouse_christian' => $faker->boolean,
    ];
});
