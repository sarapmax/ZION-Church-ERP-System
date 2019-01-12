<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'cell_id' => factory(App\Cell::class)->create()->id,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',
        'remember_token' => str_random(10),
        'administrative_status' => 1,
        'spiritual_status' => 6,
        'first_name' => $faker->name,
        'last_name' => $faker->lastName,
        'nickname' => $faker->name,
        'birthday' => $faker->date(),
        'idcard' => $faker->numberBetween(13, 13),
        'race' => $faker->word,
        'nationality' => $faker->word,
        'mobile_number' => $faker->numberBetween(10, 10),
        'facebook' => $faker->word,
        'line' => $faker->word,
    ];
});
