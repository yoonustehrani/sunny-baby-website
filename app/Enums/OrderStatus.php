<?php

namespace App\Enums;

use App\Attributes\TitleFa;
use App\Traits\EnumHelpers;

enum OrderStatus: int
{
    use EnumHelpers;
    
    #[TitleFa('در انتظار پرداخت')]
    case PENDING = 'PE';
    #[TitleFa('رزرو (سبد خرید)')]
    case RESERVED = 'RV';
    #[TitleFa('در حال پردازش')]
    case PROCESSING = 'PR';
    #[TitleFa('لغو شده')]
    case CANCELLED = 'CA';
    #[TitleFa('ارسال شده')]
    case SHIPPED = 'SH';
    #[TitleFa('مرجوع شده')]
    case RETURNED = 'RE';
}
