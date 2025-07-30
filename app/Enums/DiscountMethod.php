<?php

namespace App\Enums;

use App\Attributes\TitleFa;
use App\Traits\EnumHelpers;

enum DiscountMethod: string
{
    use EnumHelpers;
    
    #[TitleFa('درصد')]
    case PERCENTAGE = 'P';
    #[TitleFa('قیمت ثابت')]
    case FIXED_AMOUNT = 'A';
}
