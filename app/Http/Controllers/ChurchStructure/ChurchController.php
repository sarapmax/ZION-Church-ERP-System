<?php

namespace App\Http\Controllers\ChurchStructure;

use App\Models\Church;
use App\Models\District;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChurchController extends Controller
{
    /**
     * Get churches by a district.
     *
     * @param District $district
     * @return mixed
     */
    public function index(District $district) {
        return Church::whereDistrictId($district->id)->get();
    }
}
