<?php

namespace App\Http\Controllers\Data;

use App\Church;
use App\District;
use App\Province;
use App\Region;
use App\SubDistrict;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GeolocationController extends Controller
{
    /**
     * Get all regions.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getRegions() {
        return Region::all();
    }

    /**
     * Get provinces by a region.
     *
     * @param Region $region
     * @return mixed
     */
    public function getProvinces(Region $region) {
        return Province::whereRegionId($region->id)->get();
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
     * Get churches by a district.
     *
     * @param District $district
     * @return mixed
     */
    public function getChurches(District $district) {
        return Church::whereDistrictId($district->id)->get();
    }
}
