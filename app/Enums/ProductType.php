<?php

namespace App\Enums;

use App\Attributes\TitleFa;
use App\Traits\EnumHelpers;

enum ProductType: string
{
    use EnumHelpers;

    #[TitleFa('عادی')]
    case SIMPLE = 'S';
    #[TitleFa('دارای متغیر')]
    case VARIABLE = 'C';
    #[TitleFa('متغیر')]
    case VARIATION = 'V';
    // case BUNDLE = 'B';
    // case GROUP = 'G';
}
