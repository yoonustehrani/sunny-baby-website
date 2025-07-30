<?php

use App\Enums\ProductType;
use App\Models\Product;
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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Product::class)->constrained()->cascadeOnDelete();
            $table->char('type', 1)->default(ProductType::SIMPLE);
            $table->string('sku', 60)->unique()->nullable();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            $table->bigInteger('price')->unsigned()->nullable();
            $table->integer('stock')->unsigned();
            $table->integer('reserved')->unsigned()->default(0);
            $table->integer('weight')->unsigned();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
