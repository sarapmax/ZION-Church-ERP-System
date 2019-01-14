<?php

namespace App\Enums;

use Nasyrov\Laravel\Enums\Enum;

class MariageStatusEnum extends Enum
{
    const SINGLE = 1;
    const MARRIED = 2;
    const DIVORCED = 3;
    const WIDOWED = 4;
    const SEPARATED = 5;
}
