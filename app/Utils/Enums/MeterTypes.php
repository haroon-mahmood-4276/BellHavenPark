<?php

namespace App\Utils\Enums;

use App\Utils\Enums\Traits\EnumHelpers;

enum MeterTypes: string
{
    use EnumHelpers;

    case ELECTRICITY = 'electricity';
    case GAS = 'gas';
    case WATER = 'water';
}
