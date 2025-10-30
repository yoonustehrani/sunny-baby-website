<?php

namespace App\Enums;

use App\Attributes\BadgeColor;
use App\Attributes\TitleFa;
use App\Traits\EnumHelpers;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum OrderStatus: string implements HasLabel, HasColor
{
    use EnumHelpers;
    
    #[TitleFa('در انتظار پرداخت')]
    #[BadgeColor('warning')]
    case PENDING = 'PE';

    #[TitleFa('سبد خرید')]
    #[BadgeColor('primary')]
    case SUSPENDED = 'SP';

    #[TitleFa('در حال انجام')]
    #[BadgeColor('info')]
    case PROCESSING = 'PR';

    #[TitleFa('لغو شده')]
    #[BadgeColor('gray')]
    case CANCELLED = 'CA';

    #[TitleFa('بسته بندی شده')]
    #[BadgeColor('success')]
    case PACKAGED = 'PK';

    #[TitleFa('ارسال شده')]
    #[BadgeColor('success')]
    case SHIPPED = 'SH';

    #[TitleFa('مرجوع شده')]
    #[BadgeColor('danger')]
    case RETURNED = 'RE';
}
