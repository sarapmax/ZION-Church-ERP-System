<?php

namespace App\Enums;

use Nasyrov\Laravel\Enums\Enum;

class AdministrativeStatusEnum extends Enum
{
    const MEMBER = 1;
    const DEVELOPER = 2;
    const ADMIN = 3;
}
