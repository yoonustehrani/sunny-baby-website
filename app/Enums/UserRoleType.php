<?php

namespace App\Enums;

use App\Attributes\BadgeColor;
use App\Attributes\TitleFa;
use App\Traits\EnumHelpers;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum UserRoleType: string implements HasLabel, HasColor
{
    use EnumHelpers;

    #[TitleFa('مشتری')]
    #[BadgeColor('success')]
    case CUSTOMER = 'CU';

    #[TitleFa('همکار در فروش')]
    #[BadgeColor('warning')]
    case AFFILIATE = 'AF';

    #[TitleFa('ادمین')]
    #[BadgeColor('gray')]
    case ADMIN = 'AD';
}
