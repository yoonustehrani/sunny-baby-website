<?php

use App\Models\Address;
use App\Models\Order;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('shipments', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Order::class);
            $table->foreignIdFor(Address::class);
            $table->string('carrier_class');
            $table->string('tracking_number')->nullable();
            $table->bigInteger('cost')->unsigned()->nullable();
            $table->timestamp('shipped_at')->nullable();
            $table->json('meta')->default(json_encode([]));
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipments');
    }
};
