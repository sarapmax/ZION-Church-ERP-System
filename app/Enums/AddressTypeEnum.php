<?php

namespace App\Enums;

use Nasyrov\Laravel\Enums\Enum;

class AddressTypeEnum extends Enum
{
    const ORIGINAL = 1;
    const CURRENT = 2;
    const EMERGENCY = 3;
}
