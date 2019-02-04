<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\ServiceRound::class, function (Faker $faker) {
    return [
        'member_id' => factory(\App\Models\Member::class),
        'date' => $faker->date(),
        'financial_witnesses' => $faker->name
    ];
});
