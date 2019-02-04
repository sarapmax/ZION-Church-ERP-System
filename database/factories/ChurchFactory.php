<?php

use Faker\Generator as Faker;
use App\Models\District;

$factory->define(\App\Models\Church::class, function (Faker $faker) {
    return [
        'district_id' => env('APP_ENV') == 'testing' ? factory(District::class) : District::all()->random()->id,
        'name' => $faker->unique()->city
    ];
});
