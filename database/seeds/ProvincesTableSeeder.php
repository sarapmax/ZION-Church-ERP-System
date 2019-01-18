<?php

use App\Models\Province;
use Illuminate\Database\Seeder;

class ProvincesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $provinces = [];

        if (($handle = fopen('resources/data/geolocation/provinces.csv', 'r')) !== false) {
            // skip header
            fgetcsv($handle);

            // parse non blank line
            while (($data = fgetcsv($handle)) !== false) {
                $id = $data[0];
                $provinceCode = $data[1];
                $name = $data[2];
                $regionId = $data[4];
                $provinces[] = [
                    'id' => $id,
                    'region_id' => $regionId,
                    'province_code' => $provinceCode,
                    'name' => $name,
                ];
                unset($data);
            }

            fclose($handle);
        }

        Province::insert($provinces);
    }
}
