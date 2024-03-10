<?php

namespace App\Utils\Enums;

use App\Utils\Enums\Traits\EnumHelpers;

enum PaymentType: string
{
    use EnumHelpers;

    case RENT = 'rent';
    case ELECTRIC = 'electric';
    case GAS = 'gas';
    case WATER = 'water';
}
