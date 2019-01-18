<?php

namespace App\Http\Controllers\ChurchStructure;

use App\Models\Cell;
use App\Models\Church;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CellController extends Controller
{
    /**
     * Get cells by a church.
     *
     * @param Church $church
     * @return mixed
     */
    public function index(Church $church) {
        return Cell::whereChurchId($church->id)->get();
    }
}
