<?php

namespace App\Enums;

enum UserRoleType: string
{
    case CUSTOMER = 'CU';
    case AFFILIATE = 'AF';
    case ADMIN = 'AD';
}
