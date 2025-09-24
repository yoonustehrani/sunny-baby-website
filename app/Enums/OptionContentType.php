<?php

namespace App\Enums;

use App\Attributes\TitleFa;
use App\Traits\EnumHelpers;

enum OptionContentType: string
{
    use EnumHelpers;

    #[TitleFa('متنی')]
    case SIMPLE = 'T';
    #[TitleFa('رنگ')]
    case COLOR = 'C';
    #[TitleFa('تصویر')]
    case IMAGE = 'I';
}
