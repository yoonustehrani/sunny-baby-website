<?php

namespace App\Enums;

use App\Attributes\TitleFa;
use App\Traits\EnumHelpers;

enum DiscountRuleType
{
    use EnumHelpers;

    #[TitleFa('حداقل سبد')]
    case CART_MIN; //  = 'CMN';
    #[TitleFa('حداکثر سبد')]
    case CART_MAX; //  = 'CMX';
    #[TitleFa('دسته بندی مشتری')]
    case CUSTOMER_SEGMENT; //  = 'CSG';
    #[TitleFa('تعداد سفارشات قبلی')]
    case SUCCESSFUL_PREVIOUS_ORDERS; //  = 'SPO';
    #[TitleFa('محصول مشخصی در سبد')]
    case SPECIFIC_PRODUCT_IN_CART; //  = 'PIC';
    #[TitleFa('دسته بندی مشخصی در سبد')]
    case CATEGORY_IN_CART; //  = 'CIC';
    #[TitleFa('استان آدرس ارسال')]
    case ORDER_ADDRESS_STATE; //  = 'OAS';
    #[TitleFa('شهر آدرس ارسال')]
    case ORDER_ADDRESS_CITY; //  = 'OAC';
    #[TitleFa('روش پرداختی')]
    case PAYMENT_METHOD;
    #[TitleFa('روش ارسال')]
    case SHIPPING_METHOD;
}
