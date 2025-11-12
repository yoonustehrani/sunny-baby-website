<?php

namespace Database\Factories;

use App\Enums\OrderStatus;
use App\Enums\OrderType;
use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    // public 
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'mutable_until' => null,
            'status' => OrderStatus::PENDING,
            'type' => OrderType::CUSTOMER_ORDER
        ];
    }

    protected function notMutable()
    {
        return $this->state(function(array $state) {
            return [
                'mutable_until' => $state['mutable_until'] == null ? null : now()
            ];
        });
    }

    public function affiliate()
    {
        return $this->state(function(array $state) {
            return [
                'type' => OrderType::AFFILIATE_ORDER
            ];
        });
    }

    public function complete()
    {
        $factory = OrderItem::factory()->count(
            random_int(1, 6)
        );
        $attrs = $this->getRawAttributes(null);
        if ($attrs['type'] == OrderType::AFFILIATE_ORDER) {
            $factory = $factory->withAffiliatePrice();
        }
        $order_items = $factory->make();
        $subtotal = $order_items->map(fn($x) => $x->unit_price * $x->quantity)->sum();
        $total_discount = $order_items->map(fn($x) => $x->unit_discount * $x->quantity)->sum();
        $total = $subtotal - $total_discount;
        // return new self()
        return $this->has($factory, 'items')->state(fn() => [
            'subtotal' => $subtotal,
            'total_discount' => $total_discount,
            'total' => $total,
            'total_paid' => 0
        ]);
    }

    public function shipped()
    {
        return $this->notMutable()->state(fn() => [
            'status' => OrderStatus::SHIPPED
        ]);
    }

    public function processing()
    {
        return $this->notMutable()->state(function(array $state) {
            return [
                'status' => OrderStatus::PROCESSING,
                'total_paid' => $state['total']
            ];
        });
    }

    public function mutable(): self
    {
        return $this->state(function(array $state) {
            return [
                'mutable_until' => now()->addMonth(),
                'status' => OrderStatus::SUSPENDED
            ];
        });
    }
}
