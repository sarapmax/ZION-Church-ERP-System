<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Address::class, function (Faker $faker) {
    return [
        'sub_district_id' => \App\Models\SubDistrict::all()->random()->id,
        'type' => '',
        'detail' => $faker->address,
        'postcode' => $faker->numberBetween(55555, 99999)
    ];
});
