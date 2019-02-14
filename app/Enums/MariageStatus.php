<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

class MariageStatus extends Enum
{
    const SINGLE = 1;
    const MARRIED = 2;
    const DIVORCED = 3;
    const WIDOWED = 4;
    const SEPARATED = 5;
}
