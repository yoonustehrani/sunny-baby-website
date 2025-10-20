<?php

namespace App\Enums;

use App\Attributes\TitleFa;
use App\Traits\EnumHelpers;

enum OrderStatus: string
{
    use EnumHelpers;
    
    #[TitleFa('در انتظار پرداخت')]
    case PENDING = 'PE';
    #[TitleFa('معلق')]
    case SUSPENDED = 'SP';
    #[TitleFa('در حال پردازش')]
    case PROCESSING = 'PR';
    #[TitleFa('لغو شده')]
    case CANCELLED = 'CA';
    #[TitleFa('ارسال شده')]
    case SHIPPED = 'SH';
    #[TitleFa('مرجوع شده')]
    case RETURNED = 'RE';
}
