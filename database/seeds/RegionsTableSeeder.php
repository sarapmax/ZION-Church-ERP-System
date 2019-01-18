<?php

use App\Models\Region;
use Illuminate\Database\Seeder;

class RegionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $regions = [];

        if (($handle = fopen('resources/data/geolocation/regions.csv', 'r')) !== false) {
            // skip header
            fgetcsv($handle);

            // parse non blank line
            while (($data = fgetcsv($handle)) !== false) {
                $id = $data[0];
                $name = $data[1];
                $regions[] = [
                    'id' => $id,
                    'name' => $name,
                ];
                unset($data);
            }

            fclose($handle);
        }

        Region::insert($regions);
    }
}
