<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

class AddressType extends Enum
{
    const ORIGINAL = 1;
    const CURRENT = 2;
    const EMERGENCY = 3;
}
