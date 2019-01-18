<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(RegionsTableSeeder::class);
        $this->call(ProvincesTableSeeder::class);
        $this->call(DistrictsTableSeeder::class);
        $this->call(SubDistrictsTableSeeder::class);
        $this->call(PostcodesTableSeeder::class);

        factory(App\Models\User::class, 50)->create()->each(function($user) {
            $user->addresses()->save(factory(\App\Models\Address::class)->make([
                'type' => \App\Enums\AddressTypeEnum::CURRENT
            ]));

            $user->addresses()->save(factory(App\Models\Address::class)->make([
                'type' => \App\Enums\AddressTypeEnum::ORIGINAL
            ]));


            $user->mariage()->save(factory(\App\Models\Mariage::class)->make());


            $emergencyContact = $user->emergencyContact()->save(factory(\App\Models\EmergencyContact::class)->make());

            $emergencyContact->address()->save(factory(\App\Models\Address::class)->make([
                'type' => \App\Enums\AddressTypeEnum::EMERGENCY
            ]));
        });
    }
}
