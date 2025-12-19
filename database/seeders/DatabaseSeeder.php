<?php

namespace Database\Seeders;

use App\Enums\OrderStatus;
use App\Enums\OrderType;
use App\Enums\UserRoleType;
use App\Models\Address;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Shipment;
use App\Models\User;
use App\Services\Shipping\PeykCarrier;
use App\Services\Shipping\PishtazCarrier;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call(CitySeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(BrandSeeder::class);
        $this->call(AttributeSeeder::class);
        $this->call(HamkarSeeder::class);
        $this->call(ProductSeeder::class);

    //     $user = new User([
    //         'phone_number' => '09101234567'
    //     ]);
    //     $user->save();
    //     $user->refresh();

    //     $address = $user->addresses()->save(Address::factory()->make());
    // // $shipment = ;
    //     Order::factory()->complete()->state(['user_id' => $user])->create();
    //     Order::factory()->complete()->shipped()->state(['user_id' => $user])->create();
    //     $sho1 = Order::factory()->complete()->processing()->state(['user_id' => $user])->create();
    //     $sho1->shipment()->save(new Shipment([
    //         'address_id' => $address->id,
    //         'carrier_class' => PishtazCarrier::class,
    //         'cost' => 60_000
    //     ]));
    //     Order::factory()->complete()->mutable()->state(['user_id' => $user])->create();
    //     $sho3 = Order::factory()->complete()->mutable()->processing()->state(['user_id' => $user])->create();
    //     $sho3->shipment()->save(new Shipment([
    //         'address_id' => $address->id,
    //         'carrier_class' => PishtazCarrier::class,
    //         'cost' => 60_000
    //     ]));

    

        // $admin_user = new User([
        //     'name' => 'ادمین',
        //     'phone_number' => '09150000567',
        //     'email' => 'admin@sunnybaby.ir',
        //     'email_verified_at' => now(),
        //     'password' => Hash::make('hello1234'),
        //     'role_type' => UserRoleType::ADMIN
        // ]);
        // $admin_user->save();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
