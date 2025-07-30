<?php

namespace App\Enums;

use App\Attributes\TitleFa;
use App\Traits\EnumHelpers;

enum VariableType: string
{
    use EnumHelpers;

    #[TitleFa('عادی')]
    case SIMPLE = 'S';
    #[TitleFa('رنگ')]
    case COLOR = 'C';
    #[TitleFa('تصویر')]
    case IMAGE = 'I';
}
