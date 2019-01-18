<?php

use App\Models\Postcode;
use Illuminate\Database\Seeder;

class PostcodesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $postcodes = [];

        if (($handle = fopen('resources/data/geolocation/postcodes.csv', 'r')) !== false) {
            // skip header
            fgetcsv($handle);

            // parse non blank line
            while (($data = fgetcsv($handle)) !== false) {
                $id = $data[0];
                $code = $data[2];
                $subdistrictId = $data[3];
                if($subdistrictId) {
                    $postcodes[] = [
                        'id' => $id,
                        'sub_district_id' => $subdistrictId,
                        'code' => $code
                    ];
                }
                unset($data);
            }

            fclose($handle);
        }

        Postcode::insert($postcodes);
    }
}
