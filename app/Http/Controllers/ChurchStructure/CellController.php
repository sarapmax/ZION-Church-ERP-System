<?php

namespace App\Http\Controllers\ChurchStructure;

use App\Models\Area;
use App\Models\Cell;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CellController extends Controller
{
    /**
     * Get cells by a church.
     *
     * @param Area $area
     * @return mixed
     */
    public function index(Area $area) {
        return Cell::whereAreaId($area->id)->get();
    }
}
