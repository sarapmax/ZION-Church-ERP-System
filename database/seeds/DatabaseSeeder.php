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

        // Wipe up 5 churches, and each church has 5 cells, and each cell has 20 members associated with.
        // In other word, we wipe up 500 church members.
        for ($i = 0; $i < 5; $i++) {
            $church = factory(\App\Models\Church::class)->create();

            $church->cells()->saveMany(factory(\App\Models\Cell::class, 5)->create()->each(function($cell) {
                $cell->members()->saveMany(factory(App\Models\Member::class, 20)->create()->each(function($member) {
                    $member->addresses()->save(factory(\App\Models\Address::class)->make([
                        'type' => \App\Enums\AddressTypeEnum::CURRENT
                    ]));

                    $member->addresses()->save(factory(App\Models\Address::class)->make([
                        'type' => \App\Enums\AddressTypeEnum::ORIGINAL
                    ]));

                    $member->mariage()->save(factory(\App\Models\Mariage::class)->make());

                    $emergencyContact = $member->emergencyContact()->save(factory(\App\Models\EmergencyContact::class)->make());

                    $emergencyContact->address()->save(factory(\App\Models\Address::class)->make([
                        'type' => \App\Enums\AddressTypeEnum::EMERGENCY
                    ]));
                }));
            }));
        }
    }
}
