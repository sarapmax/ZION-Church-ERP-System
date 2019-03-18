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
$factory->define(App\Models\Member::class, function (Faker $faker) {
    return [
        'cell_id' => factory(\App\Models\Cell::class),
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',
        'remember_token' => str_random(10),
        'spiritual_status' => $faker->randomElement(\App\Enums\SpiritualStatus::getValues()),
        'name_prefix' => $faker->randomElement(\App\Enums\NamePrefix::getValues()),
        'first_name' => $faker->name,
        'last_name' => $faker->lastName,
        'nickname' => $faker->userName,
        'gender' => $faker->randomElement(['male', 'female']),
        'birthday' => $faker->date(),
        'idcard' => $faker->unique()->numberBetween(1000000000000, 9999999999999),
        'race' => $faker->word,
        'nationality' => $faker->word,
        'mobile_number' => $faker->unique()->numberBetween(8000000000, 9999999999),
        'facebook' => $faker->word,
        'line' => $faker->word,
    ];
});

$factory->afterCreating(\App\Models\Member::class, function ($member, $faker) {
    $member->addresses()->save(factory(\App\Models\Address::class)->make([
        'type' => \App\Enums\AddressType::CURRENT
    ]));

    $member->addresses()->save(factory(App\Models\Address::class)->make([
        'type' => \App\Enums\AddressType::ORIGINAL
    ]));

    $member->mariage()->save(factory(\App\Models\Mariage::class)->make());

    $emergencyContact = $member->emergencyContact()->save(factory(\App\Models\EmergencyContact::class)->make());

    $emergencyContact->address()->save(factory(\App\Models\Address::class)->make([
        'type' => \App\Enums\AddressType::EMERGENCY
    ]));
//
//    if (env('APP_ENV') == 'testing') {
//        $member->administrativeStatuses()->create([
//            'status' => \App\Enums\AdministrativeStatusEnum::MEMBER
//        ]);
//    }
});
