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

    #[TitleFa('معلق')]
    #[BadgeColor('primary')]
    case SUSPENDED = 'SP';

    #[TitleFa('در حال پردازش')]
    #[BadgeColor('info')]
    case PROCESSING = 'PR';

    #[TitleFa('لغو شده')]
    #[BadgeColor('gray')]
    case CANCELLED = 'CA';

    #[TitleFa('ارسال شده')]
    #[BadgeColor('success')]
    case SHIPPED = 'SH';

    #[TitleFa('مرجوع شده')]
    #[BadgeColor('danger')]
    case RETURNED = 'RE';
}
