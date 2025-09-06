<?php

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
        Schema::create('discounts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code', 50)->unique()->nullable();
            $table->char('method', 1);
            $table->string('target', 1);
            $table->bigInteger('value')->unsigned();
            $table->bigInteger('max_discount_amount')->unsigned()->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('is_exclusive')->default(false); // If TRUE, it cannot be combined with other discounts in one order.
            $table->timestamp('activates_at')->useCurrent();
            $table->timestamp('expires_at')->nullable();
            $table->integer('max_usage')->unsigned()->nullable();
            $table->integer('max_user_usage')->unsigned()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discounts');
    }
};
