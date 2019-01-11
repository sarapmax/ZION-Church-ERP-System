<?php

use App\SubDistrict;
use Illuminate\Database\Seeder;

class SubDistrictsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subDistricts = [];

        if (($handle = fopen('resources/data/geolocation/subdistricts.csv', 'r')) !== false) {
            // skip header
            fgetcsv($handle);

            // parse non blank line
            while (($data = fgetcsv($handle)) !== false) {
                $id = $data[0];
                $subdistrictCode = $data[1];
                $name = $data[2];
                $districtId = $data[4];
                $subDistricts[] = [
                    'id' => $id,
                    'district_id' => $districtId,
                    'subdistrict_code' => $subdistrictCode,
                    'name' => $name,
                ];
                unset($data);
            }

            fclose($handle);
        }

        Subdistrict::insert($subDistricts);
    }
}
