<?php

namespace App\Enums;

enum CheckoutType: string
{
    case DEFAULT = 'default';
    case ADD_TO_PREVIOUS_ORDER = 'add-to-order';
    case MUTABLE_ORDER = 'make-mutable';
}
