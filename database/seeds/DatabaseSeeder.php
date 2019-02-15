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

        if (env('APP_ENV') !== 'production') {
            // Wipe up 5 churches, and each church has 5 cells, and each cell has 20 members associated with.
            // In other word, we wipe up 500 church members.
            for ($i = 0; $i < 2; $i++) {
                $church = factory(\App\Models\Church::class)->create();

                $church->cells()->saveMany(factory(\App\Models\Cell::class, 2)->create([
                    'church_id' => $church->id
                ])->each(function($cell) {
                    $cell->members()->saveMany(factory(App\Models\Member::class, 10)->create([
                        'cell_id' => $cell
                    ]));
                }));
            }
        }
    }
}
