<?php

namespace App\Utils\Enums;

use App\Utils\Enums\Traits\EnumHelpers;

enum CabinStatus: string
{
    use EnumHelpers;

    case OPEN = 'open';
    case CLOSED_PERMANENTLY = 'closed_permanently';
    case CLOSED_TEMPORARILY = 'closed_temporarily';
}
