<?php

namespace App\Models;

use App\Enums\DiscountRuleType;
use Illuminate\Database\Eloquent\Model;

/**
 * @property DiscountRuleType $type
 */
class DiscountRule extends Model
{
    public function casts(): array
    {
        return [
            'type' => DiscountRuleType::class
        ];
    }
}
