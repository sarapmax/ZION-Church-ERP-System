<?php

namespace App\Http\Controllers\ChurchStructure;

use App\Enums\SpiritualStatusGroup;
use App\Models\Cell;
use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShepardController extends Controller
{
    /**
     * Get shepards by a cell.
     *
     * @param Cell $cell
     * @return mixed
     */
    public function index(Cell $cell) {
        return Member::whereCellId($cell->id)->whereIn('spiritual_status', SpiritualStatusGroup::ABOVE_SHEPARD)->get();
    }
}
