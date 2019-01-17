<?php

use Faker\Generator as Faker;

$factory->define(\App\Address::class, function (Faker $faker) {
    return [
        'sub_district_id' => \App\SubDistrict::all()->random()->id,
        'type' => '',
        'detail' => $faker->address,
        'postcode' => $faker->numberBetween(55555, 99999)
    ];
});
