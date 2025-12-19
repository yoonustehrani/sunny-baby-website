<?php

namespace Database\Seeders;

use App\Enums\UserRoleType;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class HamkarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $af_user = new User([
            'name' => 'همکار تستی',
            'phone_number' => '09101234568',
            'email' => 'af@sunnybaby.ir',
            'email_verified_at' => now(),
            'password' => Hash::make('hello1234'),
            'role_type' => UserRoleType::AFFILIATE
        ]);
        $af_user->save();
        // Order::factory()->affiliate()->complete()->state(['user_id' => $af_user])->create();
        // Order::factory()->affiliate()->complete()->shipped()->state(['user_id' => $af_user])->create();
        // $sho2 = Order::factory()->affiliate()->complete()->processing()->state(['user_id' => $af_user])->create();
        // $sho2->shipment()->save(new Shipment([
        //     'address_id' => $address->id,
        //     'carrier_class' => PeykCarrier::class,
        //     'cost' => null
        // ]));
        // Order::factory()->affiliate()->complete()->mutable()->state(['user_id' => $af_user])->create();
        // Order::factory()->affiliate()->complete()->mutable()->processing()->state(['user_id' => $af_user])->create();
    }
}
