<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\EmergencyContact::class, function (Faker $faker) {
    return [
        'user_id' => '',
        'name' => $faker->name,
        'nickname' => $faker->userName,
        'age' => $faker->numberBetween(20, 50),
        'relationship' => $faker->word,
        'mobile_number' => $faker->unique()->numberBetween(8000000000, 9999999999),
    ];
});
