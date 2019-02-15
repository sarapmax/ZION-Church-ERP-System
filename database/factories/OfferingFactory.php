<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Offering::class, function (Faker $faker) {
    return [
        'financial_officer_id' => factory(\App\Models\Member::class),
        'service_round_id' => factory(\App\Models\ServiceRound::class),
        'member_id' => factory(\App\Models\Member::class),
        'type' => $faker->randomElement(\App\Enums\OfferingType::getValues()),
        'amount' => $faker->numberBetween(1000, 100000)
    ];
});
