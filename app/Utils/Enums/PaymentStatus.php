<?php

namespace App\Utils\Enums;

use App\Utils\Enums\Traits\EnumHelpers;

enum PaymentStatus: string
{
    use EnumHelpers;

    case PAID = 'paid';
    case PAYABLE = 'payable';
    case RECEIVED = 'received';
    case RECEIVABLE = 'receivable';
    case PENDING = 'pending';
}
