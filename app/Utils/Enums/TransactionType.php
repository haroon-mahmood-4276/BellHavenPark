<?php

namespace App\Utils\Enums;

use App\Utils\Enums\Traits\EnumHelpers;

enum TransactionType: string
{
    use EnumHelpers;

    case ADVANCE = 'advance';
    case REFUND = 'refund';
    case CASH = 'cash';
}
