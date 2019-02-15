<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class ChurchBankAccount extends Enum
{
    const TITHE_ACCOUNT = [OfferingType::TITHE];
    const BUILDING_ACCOUNT = [OfferingType::BUILDING];
    const LAND_ACCOUNT = [OfferingType::LAND];
    const MISSION_ACCOUNT = [OfferingType::MISSION];
    const CAMP_ACCOUNT = [OfferingType::CAMP];
    const MANAGEMENT_ACCOUNT = [OfferingType::CELL, OfferingType::BLESSING, OfferingType::OTHER];
}
