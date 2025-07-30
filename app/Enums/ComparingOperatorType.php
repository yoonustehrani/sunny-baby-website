<?php

namespace App\Enums;

use App\Attributes\TitleFa;
use App\Traits\EnumHelpers;

enum ComparingOperatorType
{
    use EnumHelpers;
    
    #[TitleFa('و')]
    case AND;
    #[TitleFa('یا')]
    case OR;
    #[TitleFa('شامل بشود')]
    case IN;
    #[TitleFa('شامل نشود')]
    case NOT_IN;
    #[TitleFa('بیشتر از')]
    case GREATER;
    #[TitleFa('بیشتر مساوی')]
    case GREATER_OR_EQUAL;
    #[TitleFa('کمتر از')]
    case LESS;
    #[TitleFa('کمتر مساوی')]
    case LESS_OR_EQUAL;
    #[TitleFa('برابر با')]
    case EQUAL;
}
