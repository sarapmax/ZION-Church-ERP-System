<?php

namespace App\Http\Controllers\ChurchStructure;

use App\Enums\SpiritualStatusGroup;
use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShepardController extends Controller
{
    /**
     * Get all shepards.
     *
     * @return mixed
     */
    public function index() {
        return Member::whereIn('spiritual_status', SpiritualStatusGroup::ABOVE_SHEPARD)->get();
    }
}
