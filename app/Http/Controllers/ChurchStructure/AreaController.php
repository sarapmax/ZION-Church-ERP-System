<?php

namespace App\Http\Controllers\ChurchStructure;

use App\Models\Area;
use App\Models\Church;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AreaController extends Controller
{
    /**
     * Get areas by a church.
     *
     * @param Church $church
     * @return mixed
     */
    public function index(Church $church) {
        return Area::whereChurchId($church->id)->get();
    }
}
