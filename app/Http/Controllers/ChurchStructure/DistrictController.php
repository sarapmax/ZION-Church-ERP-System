<?php

namespace App\Http\Controllers\ChurchStructure;

use App\District;
use App\Province;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DistrictController extends Controller
{
    /**
     * Get districts where they have church.
     *
     * @param Province $province
     * @return mixed
     */
    public function index(Province $province) {
        return District::whereProvinceId($province->id)->has('churches')->get();
    }
}
