<?php

namespace App\Enums;

use App\Attributes\TitleFa;
use App\Traits\EnumHelpers;

enum OrderType: string
{
    use EnumHelpers;

    #[TitleFa('مشتریان')]
    case CUSTOMER_ORDER = 'C';

    #[TitleFa('همکاران')]
    case AFFILIATE_ORDER = 'A';

    #[TitleFa('دستی ادمین')]
    case ADMIN_ORDER = 'M';
}
