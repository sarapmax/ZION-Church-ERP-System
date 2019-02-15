<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

class OfferingType extends Enum
{
    const TITHE = 1;
    const BUILDING = 2;
    const LAND = 3;
    const CELL = 4;
    const MISSION = 5;
    const BLESSING = 6;
    const CAMP = 7;
    const OTHER = 8;
}
