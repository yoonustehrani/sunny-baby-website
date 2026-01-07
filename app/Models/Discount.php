<?php

namespace App\Models;

use App\Enums\DiscountMethod;
use App\Enums\DiscountTargetType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute as CastsAttribute;

class Discount extends Model
{
    /** @use HasFactory<\Database\Factories\DiscountFactory> */
    use HasFactory;

    public function casts(): array
    {
        return [
            'method' => DiscountMethod::class,
            'target' => DiscountTargetType::class,
            'expires_at' => 'datetime'
        ];
    }

    public function usages()
    {
        return $this->hasMany(DiscountUsage::class);
    }

    public function rules()
    {
        return $this->hasMany(DiscountRule::class);
    }

    public function isApplicable(): CastsAttribute
    {
        return CastsAttribute::make(
            get: function() {
                if ($this->max_usage && $this->usages()->count() >= $this->max_usage) {
                    return false;
                }
                if ($this->max_user_usage && $this->usages()->whereUserId()->count() >= $this->max_user_usage) {
                    return false;
                }
            }
        );
    }

    #[Scope]
    public function unexpired(Builder $query)
    {
        $query->where(function(Builder $q) {
            $q->whereNull('expires_at')->orWhere('expires_at', '>', now());
        });
    }

    #[Scope]
    public function active(Builder $query)
    {
        $query->where('is_active', true)->where('activates_at', '<=', now());
    }

    // #[Scope]
    // public function forProduct(Builder $query)
    // {
    //     $query->where('target', DiscountTargetType::PRODUCT);
    // }
}
