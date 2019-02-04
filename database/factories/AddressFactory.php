<?php

use Faker\Generator as Faker;
use App\Models\SubDistrict;

$factory->define(\App\Models\Address::class, function (Faker $faker) {
    return [
        'sub_district_id' =>
            env('APP_ENV') == 'testing' ? factory(SubDistrict::class) : SubDistrict::all()->random()->id,
        'type' => '',
        'detail' => $faker->address,
        'postcode' => $faker->numberBetween(55555, 99999)
    ];
});
