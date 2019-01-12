<?php

namespace App\Enums;

use Nasyrov\Laravel\Enums\Enum;

class AdministrativeStatusEnum extends Enum
{
    const USER = 0;
    const DEVELOPER = 1;
    const ADMIN = 2;
}
