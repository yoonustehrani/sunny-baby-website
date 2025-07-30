<?php

namespace App\Enums;

use App\Attributes\TitleFa;
use App\Traits\EnumHelpers;

enum DiscountTargetType: string
{
    use EnumHelpers;
    #[TitleFa('محصول')]
    case PRODUCT = 'P';
    #[TitleFa('هزینه ارسال')]
    case SHIPPING = 'S';
    #[TitleFa('پرداختی سفارش')]
    case ORDER = 'O';
}
