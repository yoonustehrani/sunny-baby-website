<?php

namespace Database\Seeders;

use App\Enums\OrderStatus;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call(CitySeeder::class);
        $this->call(ProductSeeder::class);

        $user = new User([
            'phone_number' => '09101234567'
        ]);
        $user->save();
        $user->refresh();
        $order_items = OrderItem::factory()->count(6)->make();
        $subtotal = $order_items->map(fn($x) => $x->unit_price * $x->quantity)->sum();
        $total_discount = $order_items->map(fn($x) => $x->unit_discount * $x->quantity)->sum();
        $order = $user->orders()->save(new Order([
            'status' => OrderStatus::SUSPENDED,
            'mutable_until' => now()->addMonth(),
            'subtotal' => $subtotal,
            'total_discount' => $total_discount,
            'total' => $subtotal - $total_discount
        ]));
        $order->refresh();
        $order->items()->saveMany($order_items);
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
