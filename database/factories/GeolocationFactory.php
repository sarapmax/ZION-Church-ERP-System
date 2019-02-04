<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Region::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->country
    ];
});

$factory->define(\App\Models\Province::class, function (Faker $faker) {
    return [
        'region_id' => factory(\App\Models\Region::class)->create()->id,
        'province_code' => $faker->countryCode,
        'name' => $faker->unique()->country
    ];
});

$factory->define(\App\Models\District::class, function (Faker $faker) {
    return [
        'province_id' => factory(\App\Models\Province::class)->create()->id,
        'district_code' => $faker->countryCode,
        'name' => $faker->unique()->country
    ];
});

$factory->define(\App\Models\SubDistrict::class, function (Faker $faker) {
    return [
        'district_id' => factory(\App\Models\District::class)->create()->id,
        'subdistrict_code' => $faker->countryCode,
        'name' => $faker->unique()->country
    ];
});

