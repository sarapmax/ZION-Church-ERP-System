<?php

namespace App\Enums;

use Nasyrov\Laravel\Enums\Enum;

class AdministrativeStatusEnum extends Enum
{
    const MEMBER = 1;
    const ADMIN = 2;
    const DEVELOPER = 3;
    const FINANCIAL_OFFICER = 4;
}
