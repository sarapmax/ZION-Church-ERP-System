<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\AdministrativeStatus::class, function (Faker $faker) {
    return [
        'status' => \App\Enums\AdministrativeStatus::MEMBER
    ];
});
