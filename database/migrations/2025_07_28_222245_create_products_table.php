<?php

use App\Enums\ProductType;
use App\Models\Brand;
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
            $table->foreignIdFor(Product::class, 'parent_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Brand::class)->nullable();
            $table->char('type', 1)->default(ProductType::SIMPLE);
            $table->string('sku', 60)->nullable()->unique();
            $table->string('title')->nullable();
            $table->string('slug')->nullable()->unique();
            $table->text('description')->nullable();
            $table->bigInteger('price')->unsigned()->nullable();
            $table->integer('stock')->unsigned()->default(0);
            $table->integer('reserved')->unsigned()->default(0);
            $table->integer('weight')->nullable()->unsigned();
            $table->boolean('is_active')->default(true);
            $table->softDeletes();
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
