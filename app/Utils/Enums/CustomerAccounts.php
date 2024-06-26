<?php

namespace App\Utils\Enums;

use App\Utils\Enums\Traits\EnumHelpers;

enum CustomerAccounts: string
{
    use EnumHelpers;

    case CREDIT_ACCOUNT = 'credit_account';
    case ELECTRICITY = 'electricity';
    case GAS = 'gas';
    case WATER = 'water';
    case RENT = 'rent';
    case LAUNDRY = 'laundry';
}
