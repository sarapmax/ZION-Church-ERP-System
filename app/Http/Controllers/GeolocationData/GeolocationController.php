<?php

namespace App\Http\Controllers\GeolocationData;

use App\Models\District;
use App\Models\Postcode;
use App\Models\Province;
use App\Models\SubDistrict;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GeolocationController extends Controller
{
    /**
     * Get all provinces.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getProvinces() {
        return Province::all();
    }

    /**
     * Get districts by a province.
     *
     * @param Province $province
     * @return mixed
     */
    public function getDistricts(Province $province) {
        return District::whereProvinceId($province->id)->get();
    }

    /**
     * Get sub districts by a district.
     *
     * @param District $district
     * @return mixed
     */
    public function getSubDistricts(District $district) {
        return SubDistrict::whereDistrictId($district->id)->get();
    }

    /**
     * Get postcode by a sub district.
     *
     * @param SubDistrict $subDistrict
     * @return mixed
     */
    public function getPostcode(SubDistrict $subDistrict) {
        return Postcode::whereSubDistrictId($subDistrict->id)->first();
    }
}
