<?php

namespace App\Utils\Enums;

use App\Utils\Enums\Traits\EnumHelpers;

enum CabinStatus: string
{
    use EnumHelpers;

    case VACANT = 'vacant';
    case NEEDS_CLEANING = 'needs_cleaning';
    case OCCUPIED = 'occupied';
    case MAINTENANCE = 'maintenance';
    case CLOSED_PERMANENTLY = 'closed_permanently';
    case CLOSED_TEMPORARILY = 'closed_temporarily';
}
