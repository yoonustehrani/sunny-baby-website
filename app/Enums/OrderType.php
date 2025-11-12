<?php

namespace App\Enums;

use App\Attributes\BadgeColor;
use App\Attributes\TitleFa;
use App\Traits\EnumHelpers;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum OrderType: string implements HasColor, HasLabel
{
    use EnumHelpers;

    #[TitleFa('مشتری')]
    #[BadgeColor('primary')]
    case CUSTOMER_ORDER = 'C';

    #[TitleFa('همکار')]
    #[BadgeColor('info')]
    case AFFILIATE_ORDER = 'A';

    #[TitleFa('ادمین')]
    #[BadgeColor('gray')]
    case ADMIN_ORDER = 'M';
}
