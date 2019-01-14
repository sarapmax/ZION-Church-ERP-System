<?php

namespace App\Enums;

use Nasyrov\Laravel\Enums\Enum;

class SpiritualStatusEnum extends Enum
{
    const NEW_COMER = 1;
    const NEW_BELIEVER = 2;
    const REGULAR_BELIEVER = 3;
    const IRREGULAR_BELIEVER = 4;
    const LOST_BELIEVER = 5;
    const CHURCH_MEMBER = 6;
    const SHEPHERD = 7;
    const SMALL_GROUP_LEADER = 8;
    const GROUP_LEADER = 9;
    const DISTRICT_LEADER = 10;
    const REGION_LEADER = 11;
    const MISSION_LEADER = 12;
    const CHURCH_LEADER = 13;
}
