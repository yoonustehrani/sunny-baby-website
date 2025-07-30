<?php

namespace App\Enums;

use App\Attributes\TitleFa;

enum TransactionStatus: int
{
    #[TitleFa('در انتظار پرداخت')]
    case PENDING = 0;
    #[TitleFa('پرداخت موفق')]
    case PAID = 1;
    #[TitleFa('خطا در پرداخت')]
    case ERROR = 2;
    #[TitleFa('لغو شده')]
    case CANCELLED = 3;
}
