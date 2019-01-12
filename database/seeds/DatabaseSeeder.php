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

        factory(App\Cell::class, 50)->create();

        factory(App\User::class, 1)->create([
           'email' => 'teerpong.me@gmail.com',
            'password' => bcrypt('123456')
        ]);
    }
}
