<?php

namespace App\Http\Controllers\GeolocationData;

use App\Cell;
use App\Church;
use App\District;
use App\Postcode;
use App\Province;
use App\SubDistrict;
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
     * Get churches by a district.
     *
     * @param District $district
     * @return mixed
     */
    public function getChurches(District $district) {
        return Church::whereDistrictId($district->id)->get();
    }

    /**
     * Get cells by a church.
     *
     * @param Church $church
     * @return mixed
     */
    public function getCells(Church $church) {
        return Cell::whereChurchId($church->id)->get();
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
