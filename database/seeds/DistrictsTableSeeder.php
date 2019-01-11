<?php

use App\District;
use Illuminate\Database\Seeder;

class DistrictsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (($handle = fopen('resources/data/geolocation/districts.csv', 'r')) !== false) {
            // skip header
            fgetcsv($handle);

            // parse non blank line
            while (($data = fgetcsv($handle)) !== false) {
                $id = $data[0];
                $districtCode = $data[1];
                $name = $data[2];
                $provinceId = $data[5];
                $districts[] = [
                    'id' => $id,
                    'province_id' => $provinceId,
                    'district_code' => $districtCode,
                    'name' => $name,
                ];
                unset($data);
            }

            fclose($handle);
        }

        District::insert($districts);
    }
}
