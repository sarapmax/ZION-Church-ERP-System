<?php

namespace App\Http\Controllers\ChurchStructure;

use App\Models\Province;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProvinceController extends Controller
{
    /**
     * Get provinces where they have church.
     *
     * @return mixed
     */
    public function index() {
        return Province::has('districts.churches')->get();
    }
}
