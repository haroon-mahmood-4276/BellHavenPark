<?php

namespace App\Utils\Enums;

use App\Utils\Enums\Traits\EnumHelpers;

enum UtilityBillsStatus: string
{
    use EnumHelpers;

    case PENDING_GENERATION = 'pending_generation';
    case PROCESSING = 'processing';
    case PROCESSED = 'processed';
}
