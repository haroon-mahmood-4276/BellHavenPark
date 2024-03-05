<?php

namespace App\Utils\Enums;

use App\Utils\Enums\Traits\EnumHelpers;

enum MeterTypes: string
{
    use EnumHelpers;

    case ELECTRIC = 'electric';
    case GAS = 'gas';
    case WATER = 'water';
}
