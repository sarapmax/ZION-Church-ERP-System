<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class SpiritualStatusGroup extends Enum
{
    const ABOVE_SHEPARD = [
        SpiritualStatus::SHEPHERD,
        SpiritualStatus::CELL_LEADER,
        SpiritualStatus::AREA_LEADER,
        SpiritualStatus::CHURCH_LEADER,
        SpiritualStatus::DISTRICT_LEADER,
        SpiritualStatus::PROVINCE_LEADER,
        SpiritualStatus::REGION_LEADER,
        SpiritualStatus::PASTOR,
    ];
}
